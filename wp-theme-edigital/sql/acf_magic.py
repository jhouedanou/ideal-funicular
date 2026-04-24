import re
from bs4 import BeautifulSoup, NavigableString

def inject_wp_loops(soup, page_slug):
    if page_slug == 'page_nos-projets':
        container = soup.find('div', class_='grid-masonary')
        if not container: return
        items = container.find_all('div', class_=re.compile('grid-item-p'))
        if not items: return
        
        # Keep only the first template item
        template = items[0]
        for item in items[1:]:
            item.decompose()
            
        # Hook WP functions
        a_tag = template.find('a')
        if a_tag: a_tag['href'] = "<?php the_permalink(); ?>"
        
        img = template.find('img')
        if img: img['src'] = "<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?: ''; ?>"
        
        h3 = template.find('h3')
        if h3:
            h3.clear()
            h3.append(NavigableString("<?php the_title(); ?>"))
            
        span = template.find('span')
        if span:
            span.clear()
            span.append(NavigableString("<?php echo get_field('sous_titre') ?: 'Projet'; ?>"))
            
        # Wrap with WP Loop
        loop_start = NavigableString("<?php $q = new WP_Query(['post_type'=>'projet', 'posts_per_page'=>-1]); if($q->have_posts()): while($q->have_posts()): $q->the_post(); ?>")
        loop_end = NavigableString("<?php endwhile; wp_reset_postdata(); endif; ?>")
        
        template.insert_before(loop_start)
        template.insert_after(loop_end)

    elif page_slug in ['page_blog', 'page_blog-list']:
        articles = soup.find_all('article')
        if not articles: return
        container = articles[0].parent
        
        template = articles[0]
        for item in articles[1:]:
            item.decompose()
            
        for a in template.find_all('a'):
            if not a.get('class') or 'category' not in a.get('class', []):
                a['href'] = "<?php the_permalink(); ?>"
                
        img = template.find('img')
        if img: img['src'] = "<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?: ''; ?>"
        
        for h in template.find_all(['h2', 'h3', 'h4']):
            if h.get('class') and 'title' in ' '.join(h.get('class')).lower() or not h.get('class'):
                h.clear()
                h.append(NavigableString("<?php the_title(); ?>"))
                break # Only replace the first title
                
        p = template.find('p')
        if p:
            p.clear()
            p.append(NavigableString("<?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>"))
            
        loop_start = NavigableString("<?php if(have_posts()): while(have_posts()): the_post(); ?>")
        loop_end = NavigableString("<?php endwhile; endif; ?>")
        
        template.insert_before(loop_start)
        template.insert_after(loop_end)

def acfify_html(html_string, page_slug):

    """
    Parse HTML string, replace translatable text strings with ACF get_field() calls.
    Returns:
        (modified_html, list_of_fields_dict)
    """
    soup = BeautifulSoup(html_string, 'html.parser')
    fields = []
    
    # We maintain a counter for duplicate slugs
    slug_counts = {}

    def get_slug(text):
        base_slug = re.sub(r'[^a-zA-Z0-9]+', '_', text.strip()[:25].lower()).strip('_')
        if not base_slug:
            base_slug = 'texte'
        if base_slug not in slug_counts:
            slug_counts[base_slug] = 0
            return base_slug
        slug_counts[base_slug] += 1
        return f"{base_slug}_{slug_counts[base_slug]}"

    for tag in soup.find_all(['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'span', 'b', 'strong', 'a', 'img']):
        if tag.name == 'img':
            src = tag.get('src')
            if not src or '<?php' in src: continue
            
            slug = get_slug('img_' + src.split('/')[-1].split('.')[0])
            # Save the image field schema
            fields.append({
                'key': f'field_{page_slug}_{slug}',
                'label': f"Image : {src.split('/')[-1][:30]}",
                'name': slug,
                'type': 'image',
                'return_format': 'url',
                'default_value': '' # images have no default string
            })
            
            # Replace src with PHP call
            php_code = f"<?php $acf_img = get_field('{slug}'); echo $acf_img ? esc_url($acf_img) : esc_url('{src}'); ?>"
            tag['src'] = php_code

        else:
            # Text tags
            if all(isinstance(child, NavigableString) for child in tag.children):
                text = tag.get_text(strip=True)
                if len(text) > 2:
                    slug = get_slug(text)
                    if '<?php' in text: continue

                    is_long = len(text) > 80
                    fields.append({
                        'key': f'field_{page_slug}_{slug}',
                        'label': text[:30] + ('...' if len(text) > 30 else ''),
                        'name': slug,
                        'type': 'wysiwyg' if is_long else 'text',
                        'default_value': text
                    })
                    
                    tag.clear()
                    if is_long:
                        php_code = f"<?php $acf_val = get_field('{slug}'); echo $acf_val ? wp_kses_post($acf_val) : '{text.replace(chr(39), chr(92)+chr(39))}'; ?>"
                    else:
                        php_code = f"<?php $acf_val = get_field('{slug}'); echo $acf_val ? esc_html($acf_val) : '{text.replace(chr(39), chr(92)+chr(39))}'; ?>"
                    tag.append(NavigableString(php_code))

    inject_wp_loops(soup, page_slug)

    return str(soup).replace("&lt;?php", "<?php").replace("?&gt;", "?>"), fields

def generate_acf_php(all_page_fields):
    """
    all_page_fields: dict { page_template_php_file: [ fields ] }
    """
    php = ["<?php", "if( function_exists('acf_add_local_field_group') ):"]
    
    for template_name, fields in all_page_fields.items():
        if not fields: continue
        
        group_key = f"group_{template_name.replace('.php', '').replace('-', '_')}"
        
        php_fields = []
        for f in fields:
            php_fields.append(f"""
        array(
            'key' => '{f['key']}',
            'label' => '{f['label'].replace(chr(39), chr(92)+chr(39))}',
            'name' => '{f['name']}',
            'type' => '{f['type']}',
        )
            """)
            
        fields_str = ",".join(php_fields)
        
        # Détermination dynamique de l'emplacement cible
        if 'page-projet.php' in template_name:
            location_code = """
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'projet',
                ),
            ),
            """
        elif 'blog-single' in template_name:
            location_code = """
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ),
            ),
            """
        else:
            location_code = f"""
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'templates/{template_name}',
                ),
            ),
            """
        
        php.append(f"""
    acf_add_local_field_group(array(
        'key' => '{group_key}',
        'title' => 'Champs : {template_name}',
        'fields' => array(
            {fields_str}
        ),
        'location' => array(
            {location_code}
        ),
    ));
        """)
        
    php.append("endif;")
    return "\n".join(php)

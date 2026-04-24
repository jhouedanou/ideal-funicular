<?php
/**
 * Template Name: E-Digital — Blog List
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'wp_enqueue_scripts', function() { wp_add_inline_style( 'edigital-style', '' ); }, 20 );
get_header();
?>
<main class="ms-main">
<div class="page-header-content project-single">
<div class="container">
<h1 class="page-header__title"><?php $acf_val = get_field('latest_stories'); echo $acf_val ? esc_html($acf_val) : 'LATEST STORIES'; ?></h1>
</div>
</div>
<div class="blog-post-area pt-0">
<div class="container">
<div class="row">
<div class="col-lg-8">
<div class="ms-posts--wrap">
<div class="ms-posts--list" data-order="order_1" id="0b8aa0e">
<?php if(have_posts()): while(have_posts()): the_post(); ?><article class="grid-item row post-54 post type-post status-publish format-standard has-post-thumbnail hentry category-fashion category-technology tag-fashioninspo tag-productivityhacks tag-technews">
<div class="col-lg-4 col-md-4 col-sm-12 pb-lg-0 pb-4 grid-item__thumb">
<a "="" )="" );="" ?="" blog-single="" class="post-thumbnail" href="<?php the_permalink(); ?>">"&gt;
                                            <figure class="media-wrapper media-wrapper--16:9">
<img alt="Visualizing Data: A Deep Dive into AI" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?: ''; ?>"/>
</figure>
</a>
</div>
<div class="col grid-item__content">
<div class="post-content">
<a "="" )="" );="" ?="" blog-single="" href="<?php the_permalink(); ?>">"&gt;
                                                <h2><?php the_title(); ?></h2>
</a>
<div class="post-meta-header">
<div class="post-meta__info">
<div class="card__header">
<span class="post-meta__date"><?php $acf_val = get_field('06_01_2024'); echo $acf_val ? esc_html($acf_val) : '06.01.2024'; ?></span>
<span class="ms-p--ttr"><?php $acf_val = get_field('4_min_read'); echo $acf_val ? esc_html($acf_val) : '4 min read'; ?></span>
</div>
</div>
</div>
<p class="post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
<div class="post-category__list"><span><?php $acf_val = get_field('category'); echo $acf_val ? esc_html($acf_val) : 'Category:'; ?></span><a href="<?php the_permalink(); ?>" rel="category tag"><?php $acf_val = get_field('fashion'); echo $acf_val ? esc_html($acf_val) : 'Fashion'; ?></a> <a href="<?php the_permalink(); ?>" rel="category tag"><?php $acf_val = get_field('technology'); echo $acf_val ? esc_html($acf_val) : 'Technology'; ?></a></div>
<div class="post-footer">
<a "="" )="" );="" ?="" blog-single="" href="<?php the_permalink(); ?>">"&gt;
                                                    <span><?php $acf_val = get_field('read_article'); echo $acf_val ? esc_html($acf_val) : 'Read Article'; ?></span>
</a>
</div>
</div>
</div>
</article><?php endwhile; endif; ?>




<nav aria-label="Pagination" class="pagination">
<ol class="pagination__list">
<li class="page-item active"><a class="pagination__item" href="#">1</a></li>
<li class="display--sm"><a class="pagination__item pagination__item--ellipsis" href="#">2</a></li>
<li class="page-item next"><a href="#"><?php $acf_val = get_field('next'); echo $acf_val ? esc_html($acf_val) : 'Next'; ?></a></li>
</ol>
</nav>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="ms-sidebar">
<aside class="ms_widget_recent_posts">
<div class="text-divider">
<h5><?php $acf_val = get_field('recent_posts'); echo $acf_val ? esc_html($acf_val) : 'Recent Posts'; ?></h5>
</div>
<ul>
<li class="recent-post">
<a "="" )="" );="" ?="" blog-single="" href="<?php echo esc_url( home_url( ">"&gt;
                                            <div class="post-image">
<div class="ms-p-arrow">
<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
</svg>
</div>
<img alt="Visualizing Data: A Deep Dive into AI" class="attachment-mokko-recent-post-thumb size-mokko-recent-post-thumb wp-post-image" height="90" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/07.jpg" width="90"/>
</div>
<div class="recent-post__info">
                                                Visualizing Data: A Deep Dive into AI
                                                <span class="post-date"><?php $acf_val = get_field('06_01_2024_5'); echo $acf_val ? esc_html($acf_val) : '06.01.2024'; ?></span>
</div>
</a>
</li>
<li class="recent-post">
<a "="" )="" );="" ?="" blog-single="" href="<?php echo esc_url( home_url( ">"&gt;
                                            <div class="post-image">
<div class="ms-p-arrow">
<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
</svg>
</div>
<img alt="Why AI Is Perspective" class="attachment-mokko-recent-post-thumb size-mokko-recent-post-thumb wp-post-image" height="90" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/15.jpg" width="90"/>
</div>
<div class="recent-post__info">
                                                Why AI Is Perspective <span class="post-date"><?php $acf_val = get_field('06_01_2024_6'); echo $acf_val ? esc_html($acf_val) : '06.01.2024'; ?></span>
</div>
</a>
</li>
<li class="recent-post">
<a "="" )="" );="" ?="" blog-single="" href="<?php echo esc_url( home_url( ">"&gt;
                                            <div class="post-image">
<div class="ms-p-arrow">
<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
</svg>
</div>
<img alt="A Day in the Life of a Photographer" class="attachment-mokko-recent-post-thumb size-mokko-recent-post-thumb wp-post-image" height="90" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/16.jpg" width="90"/>
</div>
<div class="recent-post__info">
                                                A Day in the Life of a Photographer
                                                <span class="post-date"><?php $acf_val = get_field('06_01_2024_7'); echo $acf_val ? esc_html($acf_val) : '06.01.2024'; ?></span>
</div>
</a>
</li>
<li class="recent-post">
<a "="" )="" );="" ?="" blog-single="" href="<?php echo esc_url( home_url( ">"&gt;
                                            <div class="post-image">
<div class="ms-p-arrow">
<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
</svg>
</div>
<img alt="My Take on the Future of AI" class="attachment-mokko-recent-post-thumb size-mokko-recent-post-thumb wp-post-image" height="90" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/13.jpg" width="90"/>
</div>
<div class="recent-post__info">
                                                My Take on the Future of AI
                                                <span class="post-date"><?php $acf_val = get_field('06_01_2024_8'); echo $acf_val ? esc_html($acf_val) : '06.01.2024'; ?></span>
</div>
</a>
</li>
<li class="recent-post">
<a "="" )="" );="" ?="" blog-single="" href="<?php echo esc_url( home_url( ">"&gt;
                                            <div class="post-image">
<div class="ms-p-arrow">
<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
</svg>
</div>
<img alt="Spring Cleaning Your Home – A Comprehensive Guide" class="attachment-mokko-recent-post-thumb size-mokko-recent-post-thumb wp-post-image" height="90" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/17.jpg" width="90"/>
</div>
<div class="recent-post__info">
                                                Spring Cleaning Your Home – A Comprehensive Guide <span class="post-date"><?php $acf_val = get_field('06_01_2024_9'); echo $acf_val ? esc_html($acf_val) : '06.01.2024'; ?></span>
</div>
</a>
</li>
</ul>
</aside>
<aside class="widget_categories" id="categories-2">
<div class="text-divider">
<h5><?php $acf_val = get_field('categories'); echo $acf_val ? esc_html($acf_val) : 'Categories'; ?></h5>
</div>
<ul>
<li class="cat-item cat-item-3"><a href="category.html"><?php $acf_val = get_field('business_2'); echo $acf_val ? esc_html($acf_val) : 'Business'; ?></a>
</li>
<li class="cat-item cat-item-8"><a href="category.html"><?php $acf_val = get_field('fashion_1'); echo $acf_val ? esc_html($acf_val) : 'Fashion'; ?></a>
</li>
<li class="cat-item cat-item-5"><a href="category.html"><?php $acf_val = get_field('finance_1'); echo $acf_val ? esc_html($acf_val) : 'Finance'; ?></a>
</li>
<li class="cat-item cat-item-7"><a href="category.html"><?php $acf_val = get_field('lifestyle_2'); echo $acf_val ? esc_html($acf_val) : 'Lifestyle'; ?></a>
</li>
<li class="cat-item cat-item-6"><a href="category.html"><?php $acf_val = get_field('technology_3'); echo $acf_val ? esc_html($acf_val) : 'Technology'; ?></a>
</li>
<li class="cat-item cat-item-4"><a href="category.html"><?php $acf_val = get_field('travel_1'); echo $acf_val ? esc_html($acf_val) : 'Travel'; ?></a>
</li>
</ul>
</aside>
<aside class="widget_tag_cloud" id="tag_cloud-2">
<div class="text-divider">
<h5><?php $acf_val = get_field('tags'); echo $acf_val ? esc_html($acf_val) : 'Tags'; ?></h5>
</div>
<div class="tagcloud">
<a aria-label="BookReview (3 items)" class="tag-cloud-link tag-link-9 tag-link-position-1" href="category.html" style="font-size: 13.6pt;"><?php $acf_val = get_field('bookreview'); echo $acf_val ? esc_html($acf_val) : 'BookReview'; ?></a>
<a aria-label="DIYProjects (2 items)" class="tag-cloud-link tag-link-13 tag-link-position-2" href="category.html" style="font-size: 8pt;"><?php $acf_val = get_field('diyprojects'); echo $acf_val ? esc_html($acf_val) : 'DIYProjects'; ?></a>
<a aria-label="FashionInspo (2 items)" class="tag-cloud-link tag-link-12 tag-link-position-3" href="category.html" style="font-size: 8pt;"><?php $acf_val = get_field('fashioninspo'); echo $acf_val ? esc_html($acf_val) : 'FashionInspo'; ?></a>
<a aria-label="LifeHack (4 items)" class="tag-cloud-link tag-link-16 tag-link-position-4" href="category.html" style="font-size: 18.266666666667pt;"><?php $acf_val = get_field('lifehack'); echo $acf_val ? esc_html($acf_val) : 'LifeHack'; ?></a>
<a aria-label="ProductivityHacks (5 items)" class="tag-cloud-link tag-link-10 tag-link-position-5" href="category.html" style="font-size: 22pt;"><?php $acf_val = get_field('productivityhacks'); echo $acf_val ? esc_html($acf_val) : 'ProductivityHacks'; ?></a>
<a aria-label="StartupAdvice (3 items)" class="tag-cloud-link tag-link-11 tag-link-position-6" href="category.html" style="font-size: 13.6pt;"><?php $acf_val = get_field('startupadvice'); echo $acf_val ? esc_html($acf_val) : 'StartupAdvice'; ?></a>
<a aria-label="TechNews (4 items)" class="tag-cloud-link tag-link-14 tag-link-position-7" href="category.html" style="font-size: 18.266666666667pt;"><?php $acf_val = get_field('technews'); echo $acf_val ? esc_html($acf_val) : 'TechNews'; ?></a>
<a aria-label="TravelTips (2 items)" class="tag-cloud-link tag-link-15 tag-link-position-8" href="category.html" style="font-size: 8pt;"><?php $acf_val = get_field('traveltips'); echo $acf_val ? esc_html($acf_val) : 'TravelTips'; ?></a>
</div>
</aside>
<aside class="widget_mc4wp_form_widget" id="mc4wp_form_widget-2">
<div class="text-divider">
<h5><?php $acf_val = get_field('newsletter'); echo $acf_val ? esc_html($acf_val) : 'Newsletter'; ?></h5>
</div>
<form class="mc4wp-form mc4wp-form-116" data-id="116" data-name="Mokko Newsletter" id="mc4wp-form-1" method="post">
<div class="mc4wp-form-fields">
<div class="ms-mc4wp--wrap">
<p>Subscribe to receive inspiring ideas,<br/> project updates, and everyday
                                                experiments.</p>
<div class="ms-mc4wp--action">
<input class="form-control" name="EMAIL" placeholder="Your e-mail address" required="" type="email"/>
<button class="btn btn-default btn--md btn--primary" role="button" type="submit">
<span class="ms-btn__text">
<svg class="ms-btt-i" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
</svg>
</span>
</button>
</div>
</div>
</div>
<label style="display: none !important;">Leave this field empty if you're
                                        human:
                                        <input autocomplete="off" name="_mc4wp_honeypot" tabindex="-1" type="text" value=""/></label><input name="_mc4wp_timestamp" type="hidden" value="1720592910"/><input name="_mc4wp_form_id" type="hidden" value="116"/><input name="_mc4wp_form_element_id" type="hidden" value="mc4wp-form-1"/>
<div class="mc4wp-response"></div>
</form>
</aside>
</div>
</div>
</div>
</div>
</div>
</main>
<!--================= Footer Area Start Here =================-->
<?php get_footer(); 
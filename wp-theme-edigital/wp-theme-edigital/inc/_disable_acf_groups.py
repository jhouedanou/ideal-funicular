#!/usr/bin/env python3
"""One-shot helper to disable ACF groups migrated to Gutenberg."""
import re
import sys

GROUPS = [
    'group_page_services',
    'group_page_service_creation_web',
    'group_page_service_mobile_native',
    'group_page_service_app_metier',
    'group_page_service_branding',
    'group_page_service_visibilite_seo',
    'group_page_service_visibilite_google_ads',
    'group_page_service_maintenance',
    'group_page_nos_technologies',
    'group_page_nos_projets',
    'group_page_blog',
    'group_page_contact',
]

path = sys.argv[1] if len(sys.argv) > 1 else 'acf-registry.php'
with open(path, 'r', encoding='utf-8') as f:
    src = f.read()

count = 0
for g in GROUPS:
    pat = re.compile(r"('key'\s*=>\s*'" + re.escape(g) + r"',)")
    matches = pat.findall(src)
    if not matches:
        print('MISS', g); continue
    if len(matches) > 1:
        print('AMBIG', g, len(matches)); continue
    # Skip if already disabled right after the key
    idx = src.find("'key' => '" + g + "',")
    if idx != -1 and "'active' => false" in src[idx:idx+200]:
        print('SKIP-already-disabled', g); continue
    src = pat.sub(r"\1" + "\n\t'active' => false, // Désactivé Phase 2-4 migration Gutenberg", src, count=1)
    count += 1
    print('OK', g)

with open(path, 'w', encoding='utf-8') as f:
    f.write(src)
print('TOTAL', count)

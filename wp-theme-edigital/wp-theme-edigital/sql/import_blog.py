import subprocess
import os
import sys
sys.stdout.reconfigure(encoding='utf-8')

posts = [
  {
    "title": "Développement d'applications mobiles à Paris 📱",
    "image": "blog-mobile-dev.png"
  },
  {
    "title": "Agence Marketing des Médias Sociaux : Les Clés du Succès",
    "image": "blog-smma.png"
  },
  {
    "title": "Création de Site Internet : Donnez Vie à Vos Idées",
    "image": "blog-web-creation.png"
  },
  {
    "title": "Création Application Spécifique : Pourquoi le sur-mesure ?",
    "image": "blog-custom-app.png"
  },
  {
    "title": "Vendre en Ligne : Les Erreurs à Éviter en 2024",
    "image": "blog-ecommerce.png"
  },
  {
    "title": "Accompagnement Stratégique pour votre Croissance",
    "image": "blog-strategy.png"
  }
]

def run_wp_cli(args):
    cmd = ["docker-compose", "run", "--rm", "--entrypoint", "wp", "wp-install"] + args
    result = subprocess.run(cmd, capture_output=True, text=True)
    return result.stdout.strip()

for p in posts:
    print(f"Création de l'article : {p['title']} ...")
    post_id = run_wp_cli([
        "post", "create", 
        "--post_type=post", 
        f"--post_title={p['title']}", 
        "--post_status=publish", 
        "--porcelain"
    ])
    
    if post_id:
        print(f"  -> Upload et assignation de l'image (ID: {post_id})...")
        image_path = f"/var/www/html/wp-content/themes/edigital/assets/images/blog/{p['image']}"
        run_wp_cli(["media", "import", image_path, f"--post_id={post_id}", "--featured_image"])

print("Tous les articles de blog ont été importés avec succès !")

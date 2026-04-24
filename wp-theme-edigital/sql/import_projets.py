import json
import subprocess
import os

projects = [
  {
    "title": "Logic Design Solutions",
    "sous_titre": "Développement",
    "image": "LDSolutions.png"
  },
  {
    "title": "Quitus Immobilier",
    "sous_titre": "Design | Développement",
    "image": "Design-sans-titre-2-e1732180073249.jpg"
  },
  {
    "title": "Pouret Medical",
    "sous_titre": "Design | Développement",
    "image": "Design-sans-titre-3-e1732180334178.jpg"
  },
  {
    "title": "Ruaud Industries",
    "sous_titre": "Design | Développement",
    "image": "Design-sans-titre-4-e1732204171914.jpg"
  },
  {
    "title": "Yvanick conseil",
    "sous_titre": "Design | Développement",
    "image": "Design-yvanik.jpg"
  },
  {
    "title": "Bike service",
    "sous_titre": "Design | Développement",
    "image": "bike-service-developpeur-ulrich-kouame.webp"
  },
  {
    "title": "Dupain",
    "sous_titre": "Design | Développement",
    "image": "Design-dupain.jpg"
  },
  {
    "title": "Fer play",
    "sous_titre": "Design | Développement",
    "image": "Design-sans-titre-5-e1732204755993.jpg"
  },
  {
    "title": "Cabinet FAMCHON",
    "sous_titre": "Développement | Portfolio",
    "image": "cabinet-famchon-developpeur-ulrich-kouame.webp"
  },
  {
    "title": "Maintenance PC Paris",
    "sous_titre": "Développement | Portfolio",
    "image": "maintenance-pc-paris-developpeur-ulrich-kouame.webp"
  }
]

def run_wp_cli(args):
    cmd = ["docker-compose", "run", "--rm", "--entrypoint", "wp", "wp-install"] + args
    result = subprocess.run(cmd, capture_output=True, text=True)
    return result.stdout.strip()

for p in projects:
    print(f"Création de {p['title']} ...")
    post_id = run_wp_cli([
        "post", "create", 
        "--post_type=projet", 
        f"--post_title={p['title']}", 
        "--post_status=publish", 
        "--porcelain"
    ])
    
    if post_id:
        print(f"  -> Modifiant les champs personnalisés...")
        run_wp_cli(["post", "meta", "add", post_id, "sous_titre", p['sous_titre']])
        
        print(f"  -> Upload et assignation de l'image...")
        image_path = f"/var/www/html/wp-content/themes/edigital/assets/images/portfolio/{p['image']}"
        run_wp_cli(["media", "import", image_path, f"--post_id={post_id}", "--featured_image"])

print("Tous les projets ont été importés avec succès !")

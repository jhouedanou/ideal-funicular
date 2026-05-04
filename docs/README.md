# Documentation

Ce dossier contient le guide d'administration du site, à destination des éditeurs et administrateurs.

## Fichiers

- **`guide-admin-gutenberg.md`** — source du guide (Markdown).
- **`guide-admin-gutenberg.pdf`** — version PDF prête à diffuser (générée à partir du Markdown).
- **`guide-admin-gutenberg.html`** — rendu HTML intermédiaire utilisé par le générateur PDF.
- **`build-pdf.py`** — script de génération du PDF.

## Régénérer le PDF

Le script utilise Python (`markdown`) pour convertir le Markdown en HTML stylé, puis Chromium en mode headless pour produire le PDF.

```bash
pip install markdown
python docs/build-pdf.py
```

Le PDF est écrit dans `docs/guide-admin-gutenberg.pdf`.

> Pré-requis : Chromium (commande `chromium`) installé sur le système.

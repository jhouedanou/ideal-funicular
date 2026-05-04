#!/usr/bin/env python3
"""Convertit docs/guide-admin-gutenberg.md en PDF via Chromium headless."""
import shutil
import subprocess
import sys
from pathlib import Path

import markdown

ROOT = Path(__file__).resolve().parent.parent
MD_FILE = ROOT / "docs" / "guide-admin-gutenberg.md"
HTML_FILE = ROOT / "docs" / "guide-admin-gutenberg.html"
PDF_FILE = ROOT / "docs" / "guide-admin-gutenberg.pdf"

# Common Chromium / Chrome executable names across platforms.
BROWSER_CANDIDATES = (
    "chromium",
    "chromium-browser",
    "google-chrome",
    "google-chrome-stable",
    "chrome",
)


def find_browser() -> str:
    for name in BROWSER_CANDIDATES:
        path = shutil.which(name)
        if path:
            return path
    raise RuntimeError(
        "Chromium/Chrome introuvable. Installez l'un de : "
        + ", ".join(BROWSER_CANDIDATES)
    )

CSS = """
@page { size: A4; margin: 18mm 16mm; }
* { box-sizing: border-box; }
body {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  color: #1f2933;
  font-size: 11pt;
  line-height: 1.55;
  margin: 0;
}
h1, h2, h3, h4 { color: #0b3d91; font-weight: 700; line-height: 1.25; }
h1 { font-size: 26pt; margin: 0 0 0.4em; border-bottom: 3px solid #0b3d91; padding-bottom: 0.3em; }
h2 { font-size: 17pt; margin-top: 1.6em; border-bottom: 1px solid #d0d7de; padding-bottom: 0.2em; page-break-after: avoid; }
h3 { font-size: 13pt; margin-top: 1.3em; color: #1f4fb6; page-break-after: avoid; }
h4 { font-size: 11.5pt; margin-top: 1.1em; }
p { margin: 0.5em 0; }
ul, ol { margin: 0.5em 0 0.7em 1.4em; padding: 0; }
li { margin: 0.25em 0; }
a { color: #0b65c2; text-decoration: none; }
a:hover { text-decoration: underline; }
code {
  background: #f3f5f8;
  border: 1px solid #e1e6ec;
  padding: 0.05em 0.4em;
  border-radius: 3px;
  font-family: "SF Mono", Menlo, Consolas, monospace;
  font-size: 0.92em;
}
pre {
  background: #0f172a;
  color: #e2e8f0;
  padding: 12px 14px;
  border-radius: 6px;
  overflow-x: auto;
  font-size: 0.88em;
}
pre code { background: transparent; border: 0; padding: 0; color: inherit; }
blockquote {
  margin: 0.8em 0;
  padding: 0.6em 1em;
  border-left: 4px solid #f5a623;
  background: #fff8e7;
  color: #4a3a00;
  border-radius: 0 4px 4px 0;
}
blockquote p { margin: 0.2em 0; }
table {
  border-collapse: collapse;
  width: 100%;
  margin: 1em 0;
  font-size: 0.95em;
  page-break-inside: avoid;
}
th, td {
  border: 1px solid #d0d7de;
  padding: 7px 10px;
  text-align: left;
  vertical-align: top;
}
th { background: #0b3d91; color: #fff; font-weight: 600; }
tr:nth-child(even) td { background: #f6f8fb; }
hr { border: 0; border-top: 1px solid #d0d7de; margin: 1.6em 0; }
strong { color: #0b3d91; }
.cover {
  text-align: center;
  padding: 30mm 0 14mm;
  border-bottom: 4px solid #0b3d91;
  margin-bottom: 18mm;
}
.cover .badge {
  display: inline-block;
  background: #0b3d91;
  color: #fff;
  padding: 6px 16px;
  border-radius: 999px;
  font-size: 9pt;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  margin-bottom: 18px;
}
.cover h1 { border: 0; margin: 0 0 0.2em; font-size: 30pt; }
.cover .subtitle { color: #4a5568; font-size: 13pt; margin-top: 8px; }
.cover .meta { color: #6b7280; font-size: 10pt; margin-top: 24px; }
@media print {
  h2 { page-break-before: auto; }
  table, pre, blockquote { page-break-inside: avoid; }
}
"""

HTML_TMPL = """<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Guide d'administration — E-Digital</title>
<style>{css}</style>
</head>
<body>
<div class="cover">
  <span class="badge">Documentation</span>
  <h1>Guide d'administration</h1>
  <div class="subtitle">Mettre à jour le site avec Gutenberg, éditer les pages et créer des articles de blog</div>
  <div class="meta">Site E-Digital — version 1.0</div>
</div>
{body}
</body>
</html>
"""


def main() -> int:
    md_text = MD_FILE.read_text(encoding="utf-8")
    body = markdown.markdown(
        md_text,
        extensions=["extra", "tables", "toc", "sane_lists"],
    )
    HTML_FILE.write_text(HTML_TMPL.format(css=CSS, body=body), encoding="utf-8")

    cmd = [
        find_browser(),
        "--headless=new",
        "--no-sandbox",
        "--disable-gpu",
        "--no-pdf-header-footer",
        f"--print-to-pdf={PDF_FILE}",
        HTML_FILE.as_uri(),
    ]
    print("→", " ".join(cmd))
    result = subprocess.run(cmd, capture_output=True, text=True)
    if result.returncode != 0:
        sys.stderr.write(result.stdout)
        sys.stderr.write(result.stderr)
        return result.returncode
    print(f"✓ PDF généré : {PDF_FILE.relative_to(ROOT)} ({PDF_FILE.stat().st_size // 1024} Ko)")
    return 0


if __name__ == "__main__":
    sys.exit(main())

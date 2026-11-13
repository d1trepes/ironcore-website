#!/usr/bin/env python3
"""Добавляет сгенерированные картинки в подбор демо.

    python3 demo/tools/add.py путь/к/hero-b.png путь/к/папке_с_картинками ...

Имя файла: <место>-<вариант>.(png|jpg|jpeg|webp), например hero-b.png, eng-cooling-c.jpg.
Создаёт demo/variants/<место>/<вариант>.webp (+ -1024w, -640w) и пересобирает variants.js.
"""
import os, re, sys
sys.path.insert(0, os.path.dirname(__file__))
from PIL import Image  # noqa: E402
from slots import SLOTS  # noqa: E402
import build  # noqa: E402

ROOT = build.ROOT
IDS = sorted((s["id"] for s in SLOTS), key=len, reverse=True)
WIDE = {"hero", "security", "band"}  # большие кадры храним шире


def parse(name):
    stem = os.path.splitext(os.path.basename(name))[0].lower()
    for sid in IDS:
        m = re.fullmatch(re.escape(sid) + r"[-_ ]([a-z])", stem)
        if m:
            return sid, m.group(1)
    return None, None


def save(im, path, width):
    if im.width > width:
        im = im.resize((width, round(im.height * width / im.width)), Image.LANCZOS)
    im.save(path, "WEBP", quality=84, method=6)


def add(path):
    sid, vid = parse(path)
    if not sid:
        print(f"пропущен {path}: имя должно быть <место>-<буква>, места: {', '.join(sorted(IDS))}")
        return False
    if vid == "a":
        print(f"пропущен {path}: A — текущая картинка, новым вариантам давать b, c, d…")
        return False
    out = os.path.join(ROOT, "demo", "variants", sid)
    os.makedirs(out, exist_ok=True)
    im = Image.open(path).convert("RGB")
    save(im, os.path.join(out, f"{vid}.webp"), 2560 if sid in WIDE else 1920)
    save(im, os.path.join(out, f"{vid}-1024w.webp"), 1024)
    save(im, os.path.join(out, f"{vid}-640w.webp"), 640)
    print(f"{sid}-{vid}: {im.width}×{im.height} → demo/variants/{sid}/{vid}.webp")
    return True


if __name__ == "__main__":
    files = []
    for a in sys.argv[1:]:
        if os.path.isdir(a):
            files += [os.path.join(a, f) for f in sorted(os.listdir(a))
                      if f.lower().endswith((".png", ".jpg", ".jpeg", ".webp"))]
        else:
            files.append(a)
    if not files:
        sys.exit(__doc__)
    n = sum(add(f) for f in files)
    print(f"добавлено: {n}")
    build.build()

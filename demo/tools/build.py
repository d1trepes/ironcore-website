#!/usr/bin/env python3
"""Собирает demo/variants.js (данные для панели подбора) и docs/image-prompts.md из slots.py.

    python3 demo/tools/build.py
"""
import json, os, sys
sys.path.insert(0, os.path.dirname(__file__))
from slots import SLOTS, STYLE  # noqa: E402

ROOT = os.path.abspath(os.path.join(os.path.dirname(__file__), "..", ".."))
VAR_DIR = os.path.join(ROOT, "demo", "variants")


def size_of(path):
    from PIL import Image
    with Image.open(path) as im:
        return im.size


def build():
    data = []
    for s in SLOTS:
        variants = [dict(id="a", label=s["a"], base=s["base"], w=s["w"], h=s["h"], ready=True, current=True)]
        for v in s["variants"]:
            rel = f"demo/variants/{s['id']}/{v['id']}"
            full = os.path.join(ROOT, rel + ".webp")
            item = dict(id=v["id"], label=v["label"], base=rel, ready=os.path.exists(full))
            if item["ready"]:
                item["w"], item["h"] = size_of(full)
            variants.append(item)
        # дополнительные варианты (d, e…), присланные сверх промптов
        known = {v["id"] for v in variants}
        sdir = os.path.join(VAR_DIR, s["id"])
        if os.path.isdir(sdir):
            for fn in sorted(os.listdir(sdir)):
                vid = fn[:-5]
                if fn.endswith(".webp") and "-" not in vid and vid not in known:
                    w, h = size_of(os.path.join(sdir, fn))
                    variants.append(dict(id=vid, label=f"Вариант {vid.upper()}", base=f"demo/variants/{s['id']}/{vid}",
                                         w=w, h=h, ready=True))
        slot ={k: s[k] for k in ("id", "section", "title", "sel") if k in s}
        for k in ("key", "activate", "scroll", "warn"):
            if k in s:
                slot[k] = s[k]
        slot["variants"] = variants
        data.append(slot)

    js = "/* Генерируется demo/tools/build.py из slots.py — не править руками. */\nwindow.IC_VARIANTS = " \
         + json.dumps(data, ensure_ascii=False, indent=1) + ";\n"
    with open(os.path.join(ROOT, "demo", "variants.js"), "w", encoding="utf-8") as f:
        f.write(js)

    ready = sum(1 for s in data for v in s["variants"][1:] if v["ready"])
    total = sum(len(s["variants"]) - 1 for s in data)
    write_prompts(ready, total)
    print(f"variants.js: {len(data)} мест, новых вариантов готово {ready} из {total}")


def write_prompts(ready, total):
    L = []
    L.append("# IRONCORE — промпты для новых изображений (подбор в демо)\n")
    L.append("> Файл генерируется `demo/tools/build.py` из `demo/tools/slots.py`. Править промпты — там.\n")
    L.append("## Зачем\nСейчас все 21 картинка из одной серии: сумерки, степь, графитовый бетон, одно и то же небо. "
             "Для подбора на каждое место есть 2 новых варианта (B, C), они отличаются от текущего (A) "
             "временем суток, сезоном, материалами фасада и типом кадра: снаружи, внутри, деталь, стройка, документы. "
             "Цвет даём материалами (светлый бетон, кортен, терракота, кирпич, белые модули) "
             "и цветовой маркировкой инженерии (трубы, кабели, ДГУ). Красный (#E60028) — только точечно, как в логотипе.\n")
    L.append(f"Готово новых вариантов: **{ready} из {total}**.\n")
    L.append("## Как генерировать\n"
             "1. В начало каждого промпта (или в системную инструкцию генератора) добавить общий стиль:\n\n"
             f"   ```\n   {STYLE}\n   ```\n"
             "2. Пропорции и размер — в строке «Кадр» у каждого места. Лучше генерировать с запасом по ширине: ≥ 1920 px "
             "(hero и полоса ≥ 2560 px).\n"
             "3. **Hero и Безопасность** — только правкой текущей картинки: приложить файл из `assets/images/…` "
             "и дать промпт «Edit the attached image…». Иначе выноски и 6 точек окажутся не на своих местах.\n"
             "4. Назвать файл `<место>-<вариант>.png`, например `hero-b.png`, `eng-cooling-c.jpg`, и прислать в чат. "
             "Можно прислать и свой вариант D, E — назовите `hero-d.png`, он добавится в панель.\n"
             "5. Отбраковать сразу: читаемый текст и логотипы, кривые стойки и кабели, фантастические пропорции, "
             "лишние люди с лицами.\n")
    L.append("**Первая волна** (сильнее всего меняют впечатление): hero, 3 масштаба, 4 формата, 4 инженерии, "
             "«Инженерная инфраструктура» в услугах, полоса.\n")
    section = None
    for s in SLOTS:
        if s["section"] != section:
            section = s["section"]
            L.append(f"\n## {section}\n")
        L.append(f"### `{s['id']}` — {s['title']}\n")
        L.append(f"- Кадр: {s['ratio']}")
        L.append(f"- A (сейчас): {s['a']} — `{s['base']}.webp`")
        if s.get("warn"):
            L.append(f"- ⚠ {s['warn']}")
        L.append("")
        for v in s["variants"]:
            done = os.path.exists(os.path.join(VAR_DIR, s["id"], v["id"] + ".webp"))
            mark = "✅ готов" if done else "ждёт генерации"
            L.append(f"**{s['id']}-{v['id']}** · {v['label']} · _{mark}_\n")
            L.append(f"```\n{v['prompt'].strip()}\n```\n")
    with open(os.path.join(ROOT, "docs", "image-prompts.md"), "w", encoding="utf-8") as f:
        f.write("\n".join(L))


if __name__ == "__main__":
    build()

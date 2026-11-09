# Промпты для картинок (Gemini)

Просто прикрепите готовую картинку в чат — Claude сам сохранит её с нужным именем.
Статус: ⬜ нужно · ✅ готово.

## Первый экран (hero)

✅ `hero-a-model` — вариант A, 16:9, картинка на весь первый экран (макет справа, слева пустой студийный фон под текст). Фон страницы под ней `#D8DFE9`.
```
Wide 16:9 studio product photograph of a white architectural scale model of a secure data center, cut in vertical cross-section. The model stands on a seamless infinite light grey-blue paper backdrop (color close to #EEF0F4), no visible horizon line, no table edge, no wall corner. The model is placed in the right half of the frame; the entire left half is empty, evenly lit backdrop. Above ground: a two-storey building with rooftop cooling units and an external staircase. Below ground: a reinforced underground hall with rows of tiny server racks; only the racks are deep red (#D62839), everything else matte white paper and pale grey cardboard. Two small containers on the surface. Soft diffused key light from the upper left, natural soft contact shadow. Medium-format, 80mm, three-quarter view from slightly above. No text, no people, no vignette.
```

✅ `hero-b-night` — вариант B. Gemini сделал кадр с пустой левой половиной; в файле оставлена только правая половина (вертикальная), фон слева на сайте — цвет `#1D283A`, переход градиентом.
```
Photorealistic architectural visualization at blue hour, cross-section cutaway of a secure data center campus. The left 45% of the frame is empty dark sky and dark ground (space for text). On the right half: a modern two-storey dark concrete data center building with softly lit windows and rooftop cooling units; the ground in front of it is cut open, revealing a reinforced underground server hall lit in cool white, rows of black server racks, with exactly one rack row softly glowing red; next to the building, three dark grey container data center modules on a concrete pad. Visible soil and rock layers in the cut. Wet asphalt, perimeter fence, overcast dark blue sky. Camera: wide shot, eye level, 35mm, realistic proportions. Muted cool color grading, deep navy and graphite tones. No text, no logos, no people, no neon, no lens flare, no sci-fi.
```

✅ `hero-c-ground`, `hero-c-underground`, `hero-c-container` — вариант C, три вертикальные 4:5 (1200×1500). Генерировать по очереди в одном чате Gemini, чтобы стиль совпал; в конце каждого промпта: «Same photographic style, light and color grading as the previous image.»
```
1) Architectural photograph of a modern minimalist data center building made of grey concrete and dark perforated metal panels, flat landscape, overcast soft daylight, muted natural colors, vertical composition, shot on a medium-format camera, 35mm, eye level. No text, no logos, no people.

2) Architectural photograph inside an underground data center hall: reinforced concrete vaulted ceiling, rows of black server racks with cold aisle containment, cool white linear lighting, clean polished concrete floor, one small red accent light at the far end, vertical composition, symmetrical one-point perspective, medium-format camera. No text, no logos, no people.

3) Architectural photograph of three dark grey container data center modules standing on a concrete pad, cooling units on top, cable trays, gravel and a fence around, overcast soft daylight, muted natural colors, vertical composition, medium-format camera, 35mm. No text, no logos, no people.
```

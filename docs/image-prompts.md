# IRONCORE — промпты для новых изображений (подбор в демо)

> Файл генерируется `demo/tools/build.py` из `demo/tools/slots.py`. Править промпты — там.

## Зачем
Сейчас все 21 картинка из одной серии: сумерки, степь, графитовый бетон, одно и то же небо. Для подбора на каждое место есть 2 новых варианта (B, C), они отличаются от текущего (A) временем суток, сезоном, материалами фасада и типом кадра: снаружи, внутри, деталь, стройка, документы. Цвет даём материалами (светлый бетон, кортен, терракота, кирпич, белые модули) и цветовой маркировкой инженерии (трубы, кабели, ДГУ). Красный (#E60028) — только точечно, как в логотипе.

Готово новых вариантов: **22 из 46**.

## Как генерировать
1. В начало каждого промпта (или в системную инструкцию генератора) добавить общий стиль:

   ```
   Photorealistic architectural visualization, looks like professional architectural photography for an engineering firm's portfolio. Realistic proportions and credible engineering details. Natural, clean colour grading. No text, no lettering, no signage, no logos, no watermarks, no UI. No sci-fi, no neon, no glowing holograms, no lens flare, no futuristic shapes.
   ```
2. Пропорции и размер — в строке «Кадр» у каждого места. Лучше генерировать с запасом по ширине: ≥ 1920 px (hero и полоса ≥ 2560 px).
3. **Hero и Безопасность** — только правкой текущей картинки: приложить файл из `assets/images/…` и дать промпт «Edit the attached image…». Иначе выноски и 6 точек окажутся не на своих местах.
4. Назвать файл `<место>-<вариант>.png`, например `hero-b.png`, `eng-cooling-c.jpg`, и прислать в чат. Можно прислать и свой вариант D, E — назовите `hero-d.png`, он добавится в панель.
5. Отбраковать сразу: читаемый текст и логотипы, кривые стойки и кабели, фантастические пропорции, лишние люди с лицами.

**Первая волна** (сильнее всего меняют впечатление): hero, 3 масштаба, 4 формата, 4 инженерии, «Инженерная инфраструктура» в услугах, полоса.


## 01 · Первый экран

### `hero` — Главный рендер

- Кадр: 16:9, ≥ 2560 px по ширине
- A (сейчас): Текущий: сумерки, степь, графитовый корпус — `assets/images/hero/hero-overview.webp`
- ⚠ На рендер наложены 3 выноски: корпус (справа вверху), контейнеры (по центру), заглублённый уровень (справа внизу). Новый вариант генерировать ПРАВКОЙ текущей картинки, сохраняя расположение объектов.

**hero-b** · Золотой час, светлый бетон + кортен · _✅ готов_

```
Edit the attached image. Keep the exact composition, camera angle and the positions of all objects: the main data center building on the right, the row of container modules in the centre-left, and the cut-away underground hall in the lower right. Change the time to late golden hour with warm low sunlight and a clear sky with a few clouds. Change the facade to light grey precast concrete with vertical weathering-steel (corten, rust-red) fins. Landscape: green summer meadow with low grass, a line of birch trees far behind. Container modules in off-white. Warm light in a few windows.
```

**hero-c** · Зима, ясный день, красный акцент · _ждёт генерации_

```
Edit the attached image. Keep the exact composition, camera angle and the positions of the main building (right), container modules (centre-left) and the cut-away underground hall (lower right). Change the season to winter: fresh snow on the ground and roofs, clear cold blue sky, crisp daylight with long soft shadows. Facade: dark graphite panels with one thin horizontal signal-red (#E60028) band at the parapet. Container modules light grey. Snow-covered spruce forest on the horizon.
```


## 02 · Безопасность

### `security` — Разрез площадки (6 точек)

- Кадр: 16:9
- A (сейчас): Текущий: сумерки, графит — `assets/images/security/security-cutaway.webp`
- ⚠ На картинке 6 точек рисков в фиксированных местах (КПП слева, корпус, периметр, инженерия справа, заглублённый уровень). Генерировать правкой текущей картинки с той же композицией.

**security-b** · Летний день, зелёная площадка · _✅ готов_

```
Edit the attached image. Keep the exact composition, camera angle and every object in the same place: checkpoint and fence on the left, the main building in the centre, engineering yard on the right, and the cut-away underground level in front. Change to a bright summer day with soft high-overcast light. Green lawn and young trees around the site, light grey concrete paths, facade in light warm-grey concrete with dark window bands. Fence dark green. Keep it realistic and calm.
```

**security-c** · Ночь, тёплый свет, мокрый асфальт · _ждёт генерации_

```
Edit the attached image. Keep the exact composition and every object in the same place. Change to night after rain: wet asphalt with reflections, warm 3000K perimeter lighting, warm light from the checkpoint and windows, deep navy sky. Facade dark with subtle rust-red corten details at the entrance.
```


## 03 · Решения

### `scale-compact` — Компактный ЦОД

- Кадр: 4:3 (на desktop кадр обрезается до 7:6 — главное в центре)
- A (сейчас): Текущий: сумерки, чёрный корпус — `assets/images/concepts/scale-compact.webp`

**scale-compact-b** · Белый корпус у кромки леса, лето · _✅ готов_

```
Compact single-storey data center building, about 40 × 25 m, white insulated metal composite facade with a dark grey plinth, a small row of dry coolers on the roof, two diesel generator enclosures beside it, fenced yard. Located at the edge of a pine forest, green grass, overcast summer daylight. Eye-level 3/4 view from a slightly raised camera.
```

**scale-compact-c** · Осень, кирпич и кортен, промзона · _ждёт генерации_

```
Compact single-storey data center building in an industrial park, facade of dark red-brown brick with vertical weathering-steel (corten) panels, flat roof with coolers, neat asphalt yard with a small checkpoint. Autumn: yellow birches, soft afternoon sun. 3/4 view from a slightly raised camera.
```

### `scale-medium` — ЦОД среднего масштаба

- Кадр: 4:3
- A (сейчас): Текущий: сумерки, графит — `assets/images/concepts/scale-medium.webp`

**scale-medium-b** · Ясный день, терракотовые ламели · _✅ готов_

```
Two-storey data center building about 90 × 40 m, facade of vertical terracotta-coloured louvers over dark glazing, ground floor in light concrete, rooftop cooling plant behind a screen, generator yard and transformer substation to the side, landscaped entrance with young trees. Clear sunny day, blue sky, city outskirts far behind. Aerial 3/4 view, about 40 m high.
```

**scale-medium-c** · Синий час, тёплые окна, после дождя · _ждёт генерации_

```
Two-storey data center building about 90 × 40 m with a light grey concrete facade and a long horizontal ribbon window lit warm from inside, signal-red (#E60028) entrance canopy as the only accent. Blue hour after rain, wet asphalt reflections, street lights on. Aerial 3/4 view, about 40 m high.
```

### `scale-campus` — Крупный ЦОД или кампус

- Кадр: 4:3
- A (сейчас): Текущий: сумерки, степь — `assets/images/concepts/scale-campus.webp`

**scale-campus-b** · Летний кампус с высоты, озеленение · _✅ готов_

```
Data center campus seen from a drone at about 120 m: three large identical data hall buildings in white and light grey, a separate administrative building with glass facade, an electrical substation, generator yards, internal roads, green landscaping, a small pond and solar canopies over the car park. Bright summer day, fields and forest around.
```

**scale-campus-c** · Кампус зимой, снег · _ждёт генерации_

```
Data center campus seen from a drone at about 120 m in winter: three large data hall buildings with dark graphite facades and light roofs, substation, generator yards, cleared roads, everything else under fresh snow. Low winter sun, long shadows, pale blue sky, spruce forest around.
```


## 03 · Форматы

### `format-classic` — Классический ЦОД

- Кадр: 4:3
- A (сейчас): Текущий: сумерки, графит — `assets/images/formats/format-classic.webp`

**format-classic-b** · День, светлый бетон и стекло · _✅ готов_

```
Classic stand-alone data center building, rectangular, three storeys of data halls, facade of light sand-coloured precast concrete with a glazed entrance lobby, rooftop cooling behind a perforated screen. Bright day, light clouds, landscaped lawn, eye-level 3/4 view.
```

**format-classic-c** · Закат, красный козырёк · _ждёт генерации_

```
Classic stand-alone data center building, dark graphite metal facade with horizontal lines, signal-red (#E60028) entrance canopy, sunset with orange sky behind the building, warm reflections on the facade, eye-level 3/4 view.
```

### `format-modular` — Модульный ЦОД

- Кадр: 4:3
- A (сейчас): Текущий: сумерки, ряд модулей — `assets/images/formats/format-modular.webp`

**format-modular-b** · Монтаж модуля краном, день · _✅ готов_

```
A prefabricated data center module being lifted by a mobile crane onto a concrete foundation next to three already installed modules. Modules in white with light grey trim, workers in orange hi-vis vests far away (small, faces not visible). Clear day, construction site neat and organised.
```

**format-modular-c** · Белые модули, яркий день · _ждёт генерации_

```
A row of six identical prefabricated data center modules in white with dark grey service doors, connected by a covered corridor, coolers on top, gravel yard, blue sky with clouds, green field around. Eye-level 3/4 view.
```

### `format-container` — Контейнерный ЦОД

- Кадр: 4:3
- A (сейчас): Текущий: сумерки, графит — `assets/images/formats/format-container.webp`

**format-container-b** · Открытый контейнер, видны стойки · _ждёт генерации_

```
A single 40-foot data center container on a concrete pad with its end doors open, showing two rows of server racks lit with cool white light inside. Container painted light grey, cable trays entering from the side, a small cooler unit on top. Overcast daylight, industrial site.
```

**format-container-c** · Контейнеры у промплощадки, день · _ждёт генерации_

```
Three 40-foot data center containers in a row on an industrial site next to a power substation, containers painted deep blue-grey with orange safety railings on the access stairs. Bright daylight, gravel ground, eye-level 3/4 view.
```

### `format-underground` — Подземный ЦОД

- Кадр: 4:3
- A (сейчас): Текущий: сумерки, портал + вставка — `assets/images/formats/format-underground.webp`

**format-underground-b** · Портал в холме, зелёная кровля, лето · _✅ готов_

```
Entrance portal of a partially buried data center set into a gentle hillside: exposed concrete retaining walls, a steel security door, a ramp, the roof covered with grass and meadow flowers, ventilation shafts as low concrete boxes. Summer day, soft sun. Moderate scale, realistic, not a bunker from a film.
```

**format-underground-c** · Заглублённый зал изнутри · _ждёт генерации_

```
Interior of a below-ground data hall: cast-in-place concrete ceiling with beams, two rows of server racks with hot-aisle containment, warm neutral lighting, clean epoxy floor, visible structural columns. Realistic engineering, moderate size.
```


## 04 · Услуги

### `svc-concept` — Разработка концепции

- Кадр: 3:2
- A (сейчас): Текущий: макет на тёмном столе — `assets/images/services/service-concept.webp`

**svc-concept-b** · Светлая мастерская, макет и зонирование · _✅ готов_

```
Architect's studio in daylight: a white physical massing model of a data center campus on a light oak table, a large site plan with coloured zoning (blue, green, orange areas) under it, tracing paper rolls, a window with soft daylight. Product / still-life photography of printed engineering documents. All drawings are abstract line work; any text must be unreadable tiny grey lines, no real words, no logos.
```

**svc-concept-c** · Обсуждение вариантов у стола · _ждёт генерации_

```
Two engineers seen from behind and from the side (faces not visible) at a table comparing three printed layout variants of a data center site, coloured markers, a laptop closed. Bright office with daylight. Product / still-life photography of printed engineering documents. All drawings are abstract line work; any text must be unreadable tiny grey lines, no real words, no logos.
```

### `svc-architecture` — Архитектура и конструктив

- Кадр: 3:2
- A (сейчас): Текущий: недостроенный каркас, сумерки — `assets/images/services/service-architecture.webp`

**svc-architecture-b** · Стройка: каркас и кран, день · _✅ готов_

```
Construction site of a data center: reinforced concrete frame of a two-storey building, a tower crane, formwork, rebar, workers in orange hi-vis and white helmets far away (faces not visible). Clear day, blue sky.
```

**svc-architecture-c** · Деталь конструктива: колонны и плиты · _ждёт генерации_

```
Close architectural detail of a data center under construction: precast concrete columns and hollow-core slabs, steel connection plates, natural daylight from the side, strong texture, shallow depth of field.
```

### `svc-infra` — Инженерная инфраструктура

- Кадр: 3:2
- A (сейчас): Текущий: коридор серверного зала (как в инженерии) — `assets/images/interior/interior-hall.webp`

**svc-infra-b** · Кабельные лотки над стойками · _✅ готов_

```
View up at overhead cable trays above server racks: yellow fibre trays, wire-mesh trays with blue copper cables, grey busway with tap-off boxes, white lighting. Real data center interior photography, wide-angle 24 mm, clean and orderly, credible equipment layout, accurate cable management. Equipment fronts without readable labels or brand names.
```

**svc-infra-c** · Фальшпол поднят, видны коммуникации · _ждёт генерации_

```
Data hall with one raised-floor tile lifted, revealing chilled-water pipes with blue and red insulation bands and cable trays under the floor, racks in the background slightly out of focus. Real data center interior photography, wide-angle 24 mm, clean and orderly, credible equipment layout, accurate cable management. Equipment fronts without readable labels or brand names.
```

### `svc-security` — Физическая защищённость

- Кадр: 3:2
- A (сейчас): Текущий: КПП, сумерки — `assets/images/services/service-security.webp`

**svc-security-b** · Шлюз и турникеты внутри · _✅ готов_

```
Security entrance zone inside a data center: a glass mantrap airlock with two doors, full-height turnstile, a card reader and a biometric panel without any screen text, light stone floor, daylight from a high window. Calm, realistic.
```

**svc-security-c** · Периметр: забор, камеры, снег · _ждёт генерации_

```
Perimeter of a data center site in winter: double security fence with anti-climb mesh, CCTV cameras on poles, a patrol road, light snow, overcast daylight, the building far behind out of focus.
```

### `svc-modular` — Модульные и контейнерные

- Кадр: 3:2
- A (сейчас): Текущий: открытый модуль, сумерки — `assets/images/services/service-modular.webp`

**svc-modular-b** · Сборка модулей в цехе · _✅ готов_

```
Bright factory hall where prefabricated data center modules are assembled: two modules on assembly stands, one with racks being installed, yellow overhead crane, polished concrete floor, daylight from roof windows, workers small and far away.
```

**svc-modular-c** · Модуль внутри: стойки и охлаждение · _ждёт генерации_

```
Inside a prefabricated data center module: a single narrow aisle between racks, in-row cooling units, white ceiling with cable trays, cool white light, compact and orderly. Real data center interior photography, wide-angle 24 mm, clean and orderly, credible equipment layout, accurate cable management. Equipment fronts without readable labels or brand names.
```

### `svc-analysis` — Анализ документации

- Кадр: 3:2
- A (сейчас): Текущий: чертежи на столе — `assets/images/services/service-analysis.webp`

**svc-analysis-b** · Чертежи с цветными пометками, день · _✅ готов_

```
Top-down view of a set of engineering drawings on a light desk in daylight, red and blue pencil markups, sticky tabs in orange and yellow, a ruler and a scale rule. Product / still-life photography of printed engineering documents. All drawings are abstract line work; any text must be unreadable tiny grey lines, no real words, no logos.
```

**svc-analysis-c** · Папки проекта и планшет · _ждёт генерации_

```
Stack of project binders with coloured spine tabs, an open binder with a folded drawing, a tablet showing an abstract floor plan (lines only), soft window light. Product / still-life photography of printed engineering documents. All drawings are abstract line work; any text must be unreadable tiny grey lines, no real words, no logos.
```


## 06 · Инженерия

### `eng-power` — Электроснабжение

- Кадр: 3:2
- A (сейчас): Текущий: щитовая — `assets/images/engineering/eng-power.webp`

**eng-power-b** · Зал ИБП, светлый · _✅ готов_

```
UPS room: a row of modular UPS cabinets in light grey, battery cabinets opposite, overhead busway, bright white lighting, light grey epoxy floor, small red emergency stop buttons as the only colour accent. Real data center interior photography, wide-angle 24 mm, clean and orderly, credible equipment layout, accurate cable management. Equipment fronts without readable labels or brand names.
```

**eng-power-c** · Зал дизель-генераторов · _ждёт генерации_

```
Indoor diesel generator hall: two large industrial generator sets painted in a muted yellow, exhaust pipes with silver insulation going up, cable trays, bright industrial lighting, clean floor. Real data center interior photography, wide-angle 24 mm, clean and orderly, credible equipment layout, accurate cable management. Equipment fronts without readable labels or brand names.
```

### `eng-cooling` — Охлаждение

- Кадр: 3:2
- A (сейчас): Текущий: драйкулеры на кровле, сумерки — `assets/images/engineering/eng-cooling.webp`

**eng-cooling-b** · Холодильный центр, цветные трубы · _✅ готов_

```
Chiller plant room: two chillers, pumps and large pipes with colour-coded insulation (blue supply, red return, green condenser water), valves and gauges without readable text, bright lighting. Real data center interior photography, wide-angle 24 mm, clean and orderly, credible equipment layout, accurate cable management. Equipment fronts without readable labels or brand names.
```

**eng-cooling-c** · Жидкостное охлаждение стоек · _ждёт генерации_

```
Close view of high-density server racks with liquid cooling: rear-door heat exchangers and a coolant distribution unit, blue and red flexible hoses with quick connectors, cool white light, shallow depth of field. Real data center interior photography, wide-angle 24 mm, clean and orderly, credible equipment layout, accurate cable management. Equipment fronts without readable labels or brand names.
```

### `eng-redundancy` — Резервирование

- Кадр: 3:2 (на картинке 4 одинаковых модуля — смысл «N+1»)
- A (сейчас): Текущий: 4 ДГУ у корпуса, сумерки — `assets/images/engineering/eng-redundancy.webp`

**eng-redundancy-b** · Четыре одинаковых модуля ИБП · _✅ готов_

```
Four identical modular UPS frames standing side by side in a white electrical room, symmetrical composition, each with a small green status light, two separate overhead busways labelled only by colour (one blue, one orange) — paths A and B. Real data center interior photography, wide-angle 24 mm, clean and orderly, credible equipment layout, accurate cable management. Equipment fronts without readable labels or brand names.
```

**eng-redundancy-c** · Четыре ДГУ днём, светлые · _ждёт генерации_

```
Four identical containerised diesel generators in a row on a concrete pad next to a data center, enclosures painted light grey, bright daylight, blue sky, green grass around, eye-level view emphasising repetition.
```

### `eng-efficiency` — Энергоэффективность (PUE)

- Кадр: 3:2
- A (сейчас): Текущий: коридор зала (как в услугах) — `assets/images/interior/interior-hall.webp`

**eng-efficiency-b** · Изолированный холодный коридор · _✅ готов_

```
Cold aisle containment in a data hall: glass sliding doors at the end, glass roof panels, two rows of racks with blanking panels, perforated floor tiles, bright cool white light, very clean, symmetrical one-point perspective. Real data center interior photography, wide-angle 24 mm, clean and orderly, credible equipment layout, accurate cable management. Equipment fronts without readable labels or brand names.
```

**eng-efficiency-c** · Свободное охлаждение на улице, день · _ждёт генерации_

```
Adiabatic free-cooling units in a row next to a data center on a bright spring day, green grass, light facade, blue sky, a little steam from the units, eye-level view.
```


## Полоса «Начинаем с требований»

### `band` — Фон полосы

- Кадр: 21:9 или 16:9, ≥ 2400 px; на фоне текст справа — правая половина спокойная
- A (сейчас): Текущий: тот же кадр, что «Классический ЦОД» — `assets/images/formats/format-classic.webp`

**band-b** · Панорама кампуса, золотой час · _✅ готов_

```
Wide panoramic view of a data center campus at golden hour from a low drone height: long buildings with light facades on the left third, fields and sky filling the right two thirds (calm area for text). Warm light, soft haze.
```

**band-c** · Фасад крупно, графит + красная линия · _ждёт генерации_

```
Close abstract view of a dark graphite metal facade with fine vertical ribs and a single thin signal-red (#E60028) horizontal line, raking side light, calm minimal composition, most of the frame quiet for text overlay.
```


## 08 · Материалы

### `doc-concept` — Пример концепции

- Кадр: 4:5
- A (сейчас): Текущий: буклет на тёмном столе — `assets/images/materials/doc-concept.webp`

**doc-concept-b** · Буклет на светлом столе, день · _✅ готов_

```
A printed A4 concept booklet lying open on a light oak desk in daylight: the left page shows a daytime aerial render of a data center, the right page a site plan with coloured zones. Product / still-life photography of printed engineering documents. All drawings are abstract line work; any text must be unreadable tiny grey lines, no real words, no logos.
```

**doc-concept-c** · Стопка буклетов, кортен-обложка · _ждёт генерации_

```
Three bound A4 concept booklets fanned on a light concrete surface, covers in rust-red and graphite, soft side light, minimal composition. Product / still-life photography of printed engineering documents. All drawings are abstract line work; any text must be unreadable tiny grey lines, no real words, no logos.
```

### `doc-composition` — Состав материалов

- Кадр: 4:5
- A (сейчас): Текущий: альбом чертежей — `assets/images/materials/doc-composition.webp`

**doc-composition-b** · Комплект: альбомы, схемы, папки · _✅ готов_

```
Flat lay of a complete set of concept materials: drawing album, folded schematics, a binder with coloured tabs, a USB drive, on a light grey surface, daylight. Product / still-life photography of printed engineering documents. All drawings are abstract line work; any text must be unreadable tiny grey lines, no real words, no logos.
```

**doc-composition-c** · Разложенные листы чертежей · _ждёт генерации_

```
Several large drawing sheets fanned out on a white table: floor plan, section, single-line power diagram, all as abstract line work, one sheet with blue highlights. Product / still-life photography of printed engineering documents. All drawings are abstract line work; any text must be unreadable tiny grey lines, no real words, no logos.
```

### `doc-checklist` — Чек-лист

- Кадр: 4:5
- A (сейчас): Текущий: планшет с чек-листом — `assets/images/materials/doc-checklist.webp`

**doc-checklist-b** · Чек-лист на светлом столе · _✅ готов_

```
A printed checklist on a clipboard on a light desk in daylight, several items ticked with a red pen, a cup of coffee and a pencil nearby. Checklist lines are unreadable grey bars. Product / still-life photography of printed engineering documents. All drawings are abstract line work; any text must be unreadable tiny grey lines, no real words, no logos.
```

**doc-checklist-c** · Блокнот и техзадание · _ждёт генерации_

```
An open notebook with hand-drawn tick boxes next to a printed technical brief, a red marker, soft window light, top-down view. Product / still-life photography of printed engineering documents. All drawings are abstract line work; any text must be unreadable tiny grey lines, no real words, no logos.
```

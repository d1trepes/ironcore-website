# -*- coding: utf-8 -*-
"""
Единый источник для подбора изображений в ДЕМО (GitHub Pages).
Не используется WordPress-темой: build-theme.sh копирует только css/, js/main.js и assets/.

Слот = конкретное место на странице. Вариант A — текущая картинка из assets/images.
Варианты B, C… — новые, лежат в demo/variants/<slot>/<id>.webp (+ -1024w, -640w).
Готовность варианта определяется наличием файла (см. build.py).
"""

# Общие части промптов -----------------------------------------------------------

STYLE = (
    "Photorealistic architectural visualization, looks like professional architectural "
    "photography for an engineering firm's portfolio. Realistic proportions and credible "
    "engineering details. Natural, clean colour grading. "
    "No text, no lettering, no signage, no logos, no watermarks, no UI. "
    "No sci-fi, no neon, no glowing holograms, no lens flare, no futuristic shapes."
)

INTERIOR = (
    "Real data center interior photography, wide-angle 24 mm, clean and orderly, "
    "credible equipment layout, accurate cable management. Equipment fronts without "
    "readable labels or brand names."
)

DESK = (
    "Product / still-life photography of printed engineering documents. "
    "All drawings are abstract line work; any text must be unreadable tiny grey lines, "
    "no real words, no logos."
)

# Порядок слотов = порядок на странице -------------------------------------------

SLOTS = [
    # ---------------- 01 HERO ----------------
    dict(
        id="hero", section="01 · Первый экран", title="Главный рендер",
        base="assets/images/hero/hero-overview", w=1672, h=941,
        sel=".hero__scene > img",
        ratio="16:9, ≥ 2560 px по ширине",
        warn="На рендер наложены 3 выноски: корпус (справа вверху), контейнеры (по центру), "
             "заглублённый уровень (справа внизу). Новый вариант генерировать ПРАВКОЙ текущей картинки, "
             "сохраняя расположение объектов.",
        a="Текущий: сумерки, степь, графитовый корпус",
        variants=[
            dict(id="b", label="Золотой час, светлый бетон + кортен",
                 layout={"pos": {".hero__dot": [[78, 34], [51, 62], [75, 86]],
                                 ".hero__tag": [[78, 12], [58.5, 52], [64.5, 86]]},
                         "points": {".hero__lines:not(.hero__lines--m) polyline":
                                        ["780,86 780,191", "510,349 510,306", "750,484 657,484"],
                                    ".hero__lines--m polyline":
                                        ["780,86 780,191", "510,349 510,404", "750,484 750,512 682,512"]}},
                 prompt="Edit the attached image. Keep the exact composition, camera angle and the positions "
                        "of all objects: the main data center building on the right, the row of container modules "
                        "in the centre-left, and the cut-away underground hall in the lower right. "
                        "Change the time to late golden hour with warm low sunlight and a clear sky with a few clouds. "
                        "Change the facade to light grey precast concrete with vertical weathering-steel (corten, rust-red) fins. "
                        "Landscape: green summer meadow with low grass, a line of birch trees far behind. "
                        "Container modules in off-white. Warm light in a few windows. " ),
            dict(id="c", label="Зима, ясный день, красный акцент",
                 layout={"pos": {".hero__dot": [[88, 45], [63, 60], [80, 85]],
                                 ".hero__tag": [[88, 22], [61.8, 72], [67, 85]]},
                         "points": {".hero__lines:not(.hero__lines--m) polyline":
                                        ["880,138 880,253", "630,338 630,405 618,405", "800,479 680,479"],
                                    ".hero__lines--m polyline":
                                        ["880,138 880,253", "630,338 630,404", "800,479 800,512 682,512"]}},
                 prompt="Edit the attached image. Keep the exact composition, camera angle and the positions "
                        "of the main building (right), container modules (centre-left) and the cut-away "
                        "underground hall (lower right). Change the season to winter: fresh snow on the ground "
                        "and roofs, clear cold blue sky, crisp daylight with long soft shadows. "
                        "Facade: dark graphite panels with one thin horizontal signal-red (#E60028) band at the parapet. "
                        "Container modules light grey. Snow-covered spruce forest on the horizon."),
        ],
    ),
    # ---------------- 02 БЕЗОПАСНОСТЬ ----------------
    dict(
        id="security", section="02 · Безопасность", title="Разрез площадки (6 точек)",
        base="assets/images/security/security-cutaway", w=1672, h=941,
        sel=".atlas__img > img",
        ratio="16:9",
        warn="На картинке 6 точек рисков в фиксированных местах (КПП слева, корпус, периметр, "
             "инженерия справа, заглублённый уровень). Генерировать правкой текущей картинки "
             "с той же композицией.",
        a="Текущий: сумерки, графит",
        variants=[
            dict(id="b", label="Летний день, зелёная площадка",
                 layout={"pos": {".atlas .pin": [[11, 47], [45, 30], [16, 20], [76, 43], [60, 76], [78, 74]]}},
                 prompt="Edit the attached image. Keep the exact composition, camera angle and every object in "
                        "the same place: checkpoint and fence on the left, the main building in the centre, "
                        "engineering yard on the right, and the cut-away underground level in front. "
                        "Change to a bright summer day with soft high-overcast light. Green lawn and young trees "
                        "around the site, light grey concrete paths, facade in light warm-grey concrete with "
                        "dark window bands. Fence dark green. Keep it realistic and calm."),
            dict(id="c", label="Ночь, тёплый свет, мокрый асфальт",
                 layout={"pos": {".atlas .pin": [[13, 48], [45, 33], [10, 25], [88, 46], [66, 77], [85, 75]]}},
                 prompt="Edit the attached image. Keep the exact composition and every object in the same place. "
                        "Change to night after rain: wet asphalt with reflections, warm 3000K perimeter lighting, "
                        "warm light from the checkpoint and windows, deep navy sky. Facade dark with "
                        "subtle rust-red corten details at the entrance."),
        ],
    ),
    # ---------------- 03 МАСШТАБЫ ----------------
    dict(
        id="scale-compact", section="03 · Решения", title="Компактный ЦОД",
        base="assets/images/concepts/scale-compact", w=1122, h=1402,
        sel="#sc-p1 .scale__img img", activate="#sc-t1",
        ratio="4:3 (на desktop кадр обрезается до 7:6 — главное в центре)",
        a="Текущий: сумерки, чёрный корпус",
        variants=[
            dict(id="b", label="Белый корпус у кромки леса, лето",
                 prompt="Compact single-storey data center building, about 40 × 25 m, white insulated metal "
                        "composite facade with a dark grey plinth, a small row of dry coolers on the roof, two "
                        "diesel generator enclosures beside it, fenced yard. Located at the edge of a pine forest, "
                        "green grass, overcast summer daylight. Eye-level 3/4 view from a slightly raised camera."),
            dict(id="c", label="Осень, кирпич и кортен, промзона",
                 prompt="Compact single-storey data center building in an industrial park, facade of dark "
                        "red-brown brick with vertical weathering-steel (corten) panels, flat roof with coolers, "
                        "neat asphalt yard with a small checkpoint. Autumn: yellow birches, soft afternoon sun. "
                        "3/4 view from a slightly raised camera."),
        ],
    ),
    dict(
        id="scale-medium", section="03 · Решения", title="ЦОД среднего масштаба",
        base="assets/images/concepts/scale-medium", w=1122, h=1402,
        sel="#sc-p2 .scale__img img", activate="#sc-t2",
        ratio="4:3",
        a="Текущий: сумерки, графит",
        variants=[
            dict(id="b", label="Ясный день, терракотовые ламели",
                 prompt="Two-storey data center building about 90 × 40 m, facade of vertical terracotta-coloured "
                        "louvers over dark glazing, ground floor in light concrete, rooftop cooling plant behind a "
                        "screen, generator yard and transformer substation to the side, landscaped entrance with "
                        "young trees. Clear sunny day, blue sky, city outskirts far behind. Aerial 3/4 view, "
                        "about 40 m high."),
            dict(id="c", label="Синий час, тёплые окна, после дождя",
                 prompt="Two-storey data center building about 90 × 40 m with a light grey concrete facade and "
                        "a long horizontal ribbon window lit warm from inside, signal-red (#E60028) entrance "
                        "canopy as the only accent. Blue hour after rain, wet asphalt reflections, street lights "
                        "on. Aerial 3/4 view, about 40 m high."),
        ],
    ),
    dict(
        id="scale-campus", section="03 · Решения", title="Крупный ЦОД или кампус",
        base="assets/images/concepts/scale-campus", w=1122, h=1402,
        sel="#sc-p3 .scale__img img", activate="#sc-t3",
        ratio="4:3",
        a="Текущий: сумерки, степь",
        variants=[
            dict(id="b", label="Летний кампус с высоты, озеленение",
                 prompt="Data center campus seen from a drone at about 120 m: three large identical data hall "
                        "buildings in white and light grey, a separate administrative building with glass "
                        "facade, an electrical substation, generator yards, internal roads, green landscaping, "
                        "a small pond and solar canopies over the car park. Bright summer day, fields and forest "
                        "around."),
            dict(id="c", label="Кампус зимой, снег",
                 prompt="Data center campus seen from a drone at about 120 m in winter: three large data hall "
                        "buildings with dark graphite facades and light roofs, substation, generator yards, "
                        "cleared roads, everything else under fresh snow. Low winter sun, long shadows, pale blue "
                        "sky, spruce forest around."),
        ],
    ),
    # ---------------- 03 ФОРМАТЫ ----------------
    dict(
        id="format-classic", section="03 · Форматы", title="Классический ЦОД",
        base="assets/images/formats/format-classic", w=1448, h=1086,
        sel=".format__img img", key="format-classic",
        ratio="4:3",
        a="Текущий: сумерки, графит",
        variants=[
            dict(id="b", label="День, светлый бетон и стекло",
                 prompt="Classic stand-alone data center building, rectangular, three storeys of data halls, "
                        "facade of light sand-coloured precast concrete with a glazed entrance lobby, rooftop "
                        "cooling behind a perforated screen. Bright day, light clouds, landscaped lawn, eye-level "
                        "3/4 view."),
            dict(id="c", label="Закат, красный козырёк",
                 prompt="Classic stand-alone data center building, dark graphite metal facade with horizontal "
                        "lines, signal-red (#E60028) entrance canopy, sunset with orange sky behind the building, "
                        "warm reflections on the facade, eye-level 3/4 view."),
        ],
    ),
    dict(
        id="format-modular", section="03 · Форматы", title="Модульный ЦОД",
        base="assets/images/formats/format-modular", w=1448, h=1086,
        sel=".format__img img", key="format-modular",
        ratio="4:3",
        a="Текущий: сумерки, ряд модулей",
        variants=[
            dict(id="b", label="Монтаж модуля краном, день",
                 prompt="A prefabricated data center module being lifted by a mobile crane onto a concrete "
                        "foundation next to three already installed modules. Modules in white with light grey "
                        "trim, workers in orange hi-vis vests far away (small, faces not visible). Clear day, "
                        "construction site neat and organised."),
            dict(id="c", label="Белые модули, яркий день",
                 prompt="A row of six identical prefabricated data center modules in white with dark grey "
                        "service doors, connected by a covered corridor, coolers on top, gravel yard, blue sky "
                        "with clouds, green field around. Eye-level 3/4 view."),
        ],
    ),
    dict(
        id="format-container", section="03 · Форматы", title="Контейнерный ЦОД",
        base="assets/images/formats/format-container", w=1448, h=1086,
        sel=".format__img img", key="format-container",
        ratio="4:3",
        a="Текущий: сумерки, графит",
        variants=[
            dict(id="b", label="Открытый контейнер, видны стойки",
                 prompt="A single 40-foot data center container on a concrete pad with its end doors open, "
                        "showing two rows of server racks lit with cool white light inside. Container painted "
                        "light grey, cable trays entering from the side, a small cooler unit on top. Overcast "
                        "daylight, industrial site."),
            dict(id="c", label="Контейнеры у промплощадки, день",
                 prompt="Three 40-foot data center containers in a row on an industrial site next to a power "
                        "substation, containers painted deep blue-grey with orange safety railings on the "
                        "access stairs. Bright daylight, gravel ground, eye-level 3/4 view."),
        ],
    ),
    dict(
        id="format-underground", section="03 · Форматы", title="Подземный ЦОД",
        base="assets/images/formats/format-underground", w=1448, h=1086,
        sel=".format__img img", key="format-underground",
        ratio="4:3",
        a="Текущий: сумерки, портал + вставка",
        variants=[
            dict(id="b", label="Портал в холме, зелёная кровля, лето",
                 prompt="Entrance portal of a partially buried data center set into a gentle hillside: "
                        "exposed concrete retaining walls, a steel security door, a ramp, the roof covered "
                        "with grass and meadow flowers, ventilation shafts as low concrete boxes. Summer day, "
                        "soft sun. Moderate scale, realistic, not a bunker from a film."),
            dict(id="c", label="Заглублённый зал изнутри",
                 prompt="Interior of a below-ground data hall: cast-in-place concrete ceiling with beams, "
                        "two rows of server racks with hot-aisle containment, warm neutral lighting, "
                        "clean epoxy floor, visible structural columns. Realistic engineering, moderate size."),
        ],
    ),
    # ---------------- 04 УСЛУГИ ----------------
    dict(
        id="svc-concept", section="04 · Услуги", title="Разработка концепции",
        base="assets/images/services/service-concept", w=1536, h=1024,
        sel='.svc__media img[data-for="sv-p1"], #sv-p1 .svc__pic img', activate="#sv-t1", scroll=".svc",
        ratio="3:2",
        a="Текущий: макет на тёмном столе",
        variants=[
            dict(id="b", label="Светлая мастерская, макет и зонирование",
                 prompt="Architect's studio in daylight: a white physical massing model of a data center campus "
                        "on a light oak table, a large site plan with coloured zoning (blue, green, orange "
                        "areas) under it, tracing paper rolls, a window with soft daylight. " + DESK),
            dict(id="c", label="Обсуждение вариантов у стола",
                 prompt="Two engineers seen from behind and from the side (faces not visible) at a table comparing "
                        "three printed layout variants of a data center site, coloured markers, a laptop "
                        "closed. Bright office with daylight. " + DESK),
        ],
    ),
    dict(
        id="svc-architecture", section="04 · Услуги", title="Архитектура и конструктив",
        base="assets/images/services/service-architecture", w=1536, h=1024,
        sel='.svc__media img[data-for="sv-p2"], #sv-p2 .svc__pic img', activate="#sv-t2", scroll=".svc",
        ratio="3:2",
        a="Текущий: недостроенный каркас, сумерки",
        variants=[
            dict(id="b", label="Стройка: каркас и кран, день",
                 prompt="Construction site of a data center: reinforced concrete frame of a two-storey building, "
                        "a tower crane, formwork, rebar, workers in orange hi-vis and white helmets far away "
                        "(faces not visible). Clear day, blue sky."),
            dict(id="c", label="Деталь конструктива: колонны и плиты",
                 prompt="Close architectural detail of a data center under construction: precast concrete columns "
                        "and hollow-core slabs, steel connection plates, natural daylight from the side, strong "
                        "texture, shallow depth of field."),
        ],
    ),
    dict(
        id="svc-infra", section="04 · Услуги", title="Инженерная инфраструктура",
        base="assets/images/interior/interior-hall", w=1672, h=941,
        sel='.svc__media img[data-for="sv-p3"], #sv-p3 .svc__pic img', activate="#sv-t3", scroll=".svc",
        ratio="3:2",
        a="Текущий: коридор серверного зала (как в инженерии)",
        variants=[
            dict(id="b", label="Кабельные лотки над стойками",
                 prompt="View up at overhead cable trays above server racks: yellow fibre trays, wire-mesh trays "
                        "with blue copper cables, grey busway with tap-off boxes, white lighting. " + INTERIOR),
            dict(id="c", label="Фальшпол поднят, видны коммуникации",
                 prompt="Data hall with one raised-floor tile lifted, revealing chilled-water pipes with blue and red "
                        "insulation bands and cable trays under the floor, racks in the background slightly out "
                        "of focus. " + INTERIOR),
        ],
    ),
    dict(
        id="svc-security", section="04 · Услуги", title="Физическая защищённость",
        base="assets/images/services/service-security", w=1536, h=1024,
        sel='.svc__media img[data-for="sv-p4"], #sv-p4 .svc__pic img', activate="#sv-t4", scroll=".svc",
        ratio="3:2",
        a="Текущий: КПП, сумерки",
        variants=[
            dict(id="b", label="Шлюз и турникеты внутри",
                 prompt="Security entrance zone inside a data center: a glass mantrap airlock with two doors, "
                        "full-height turnstile, a card reader and a biometric panel without any screen text, "
                        "light stone floor, daylight from a high window. Calm, realistic."),
            dict(id="c", label="Периметр: забор, камеры, снег",
                 prompt="Perimeter of a data center site in winter: double security fence with anti-climb "
                        "mesh, CCTV cameras on poles, a patrol road, light snow, overcast daylight, the building "
                        "far behind out of focus."),
        ],
    ),
    dict(
        id="svc-modular", section="04 · Услуги", title="Модульные и контейнерные",
        base="assets/images/services/service-modular", w=1536, h=1024,
        sel='.svc__media img[data-for="sv-p5"], #sv-p5 .svc__pic img', activate="#sv-t5", scroll=".svc",
        ratio="3:2",
        a="Текущий: открытый модуль, сумерки",
        variants=[
            dict(id="b", label="Сборка модулей в цехе",
                 prompt="Bright factory hall where prefabricated data center modules are assembled: two modules "
                        "on assembly stands, one with racks being installed, yellow overhead crane, polished "
                        "concrete floor, daylight from roof windows, workers small and far away."),
            dict(id="c", label="Модуль внутри: стойки и охлаждение",
                 prompt="Inside a prefabricated data center module: a single narrow aisle between racks, "
                        "in-row cooling units, white ceiling with cable trays, cool white light, compact and "
                        "orderly. " + INTERIOR),
        ],
    ),
    dict(
        id="svc-analysis", section="04 · Услуги", title="Анализ документации",
        base="assets/images/services/service-analysis", w=1536, h=1024,
        sel='.svc__media img[data-for="sv-p6"], #sv-p6 .svc__pic img', activate="#sv-t6", scroll=".svc",
        ratio="3:2",
        a="Текущий: чертежи на столе",
        variants=[
            dict(id="b", label="Чертежи с цветными пометками, день",
                 prompt="Top-down view of a set of engineering drawings on a light desk in daylight, red and "
                        "blue pencil markups, sticky tabs in orange and yellow, a ruler and a scale rule. " + DESK),
            dict(id="c", label="Папки проекта и планшет",
                 prompt="Stack of project binders with coloured spine tabs, an open binder with a folded drawing, "
                        "a tablet showing an abstract floor plan (lines only), soft window light. " + DESK),
        ],
    ),
    # ---------------- 06 ИНЖЕНЕРИЯ ----------------
    dict(
        id="eng-power", section="06 · Инженерия", title="Электроснабжение",
        base="assets/images/engineering/eng-power", w=1536, h=1024,
        sel="#en-p1 .eng__img img", activate="#en-t1",
        ratio="3:2",
        a="Текущий: щитовая",
        variants=[
            dict(id="b", label="Зал ИБП, светлый",
                 prompt="UPS room: a row of modular UPS cabinets in light grey, battery cabinets opposite, "
                        "overhead busway, bright white lighting, light grey epoxy floor, small red emergency "
                        "stop buttons as the only colour accent. " + INTERIOR),
            dict(id="c", label="Зал дизель-генераторов",
                 prompt="Indoor diesel generator hall: two large industrial generator sets painted in a "
                        "muted yellow, exhaust pipes with silver insulation going up, cable trays, bright "
                        "industrial lighting, clean floor. " + INTERIOR),
        ],
    ),
    dict(
        id="eng-cooling", section="06 · Инженерия", title="Охлаждение",
        base="assets/images/engineering/eng-cooling", w=1536, h=1024,
        sel="#en-p2 .eng__img img", activate="#en-t2",
        ratio="3:2",
        a="Текущий: драйкулеры на кровле, сумерки",
        variants=[
            dict(id="b", label="Холодильный центр, цветные трубы",
                 prompt="Chiller plant room: two chillers, pumps and large pipes with colour-coded insulation "
                        "(blue supply, red return, green condenser water), valves and gauges without readable "
                        "text, bright lighting. " + INTERIOR),
            dict(id="c", label="Жидкостное охлаждение стоек",
                 prompt="Close view of high-density server racks with liquid cooling: rear-door heat exchangers "
                        "and a coolant distribution unit, blue and red flexible hoses with quick connectors, "
                        "cool white light, shallow depth of field. " + INTERIOR),
        ],
    ),
    dict(
        id="eng-redundancy", section="06 · Инженерия", title="Резервирование",
        base="assets/images/engineering/eng-redundancy", w=1536, h=1024,
        sel="#en-p3 .eng__img img", activate="#en-t3",
        ratio="3:2 (на картинке 4 одинаковых модуля — смысл «N+1»)",
        a="Текущий: 4 ДГУ у корпуса, сумерки",
        variants=[
            dict(id="b", label="Четыре одинаковых модуля ИБП",
                 prompt="Four identical modular UPS frames standing side by side in a white electrical room, "
                        "symmetrical composition, each with a small green status light, two separate overhead "
                        "busways labelled only by colour (one blue, one orange) — paths A and B. " + INTERIOR),
            dict(id="c", label="Четыре ДГУ днём, светлые",
                 prompt="Four identical containerised diesel generators in a row on a concrete pad next to a "
                        "data center, enclosures painted light grey, bright daylight, blue sky, green grass "
                        "around, eye-level view emphasising repetition."),
        ],
    ),
    dict(
        id="eng-efficiency", section="06 · Инженерия", title="Энергоэффективность (PUE)",
        base="assets/images/interior/interior-hall", w=1672, h=941,
        sel="#en-p4 .eng__img img", activate="#en-t4",
        ratio="3:2",
        a="Текущий: коридор зала (как в услугах)",
        variants=[
            dict(id="b", label="Изолированный холодный коридор",
                 prompt="Cold aisle containment in a data hall: glass sliding doors at the end, glass roof panels, "
                        "two rows of racks with blanking panels, perforated floor tiles, bright cool white light, "
                        "very clean, symmetrical one-point perspective. " + INTERIOR),
            dict(id="c", label="Свободное охлаждение на улице, день",
                 prompt="Adiabatic free-cooling units in a row next to a data center on a bright spring day, "
                        "green grass, light facade, blue sky, a little steam from the units, eye-level view."),
        ],
    ),
    # ---------------- ФИНАЛЬНАЯ ПОЛОСА ----------------
    dict(
        id="band", section="Полоса «Начинаем с требований»", title="Фон полосы",
        base="assets/images/formats/format-classic", w=1448, h=1086,
        sel=".band__bg",
        ratio="21:9 или 16:9, ≥ 2400 px; на фоне текст справа — правая половина спокойная",
        a="Текущий: тот же кадр, что «Классический ЦОД»",
        variants=[
            dict(id="b", label="Панорама кампуса, золотой час",
                 prompt="Wide panoramic view of a data center campus at golden hour from a low drone height: "
                        "long buildings with light facades on the left third, fields and sky filling the right "
                        "two thirds (calm area for text). Warm light, soft haze."),
            dict(id="c", label="Фасад крупно, графит + красная линия",
                 prompt="Close abstract view of a dark graphite metal facade with fine vertical ribs and a single "
                        "thin signal-red (#E60028) horizontal line, raking side light, calm minimal composition, "
                        "most of the frame quiet for text overlay."),
        ],
    ),
    # ---------------- 08 МАТЕРИАЛЫ ----------------
    dict(
        id="doc-concept", section="08 · Материалы", title="Пример концепции",
        base="assets/images/materials/doc-concept", w=1122, h=1402,
        sel=".doc__img img", key="doc-concept",
        ratio="4:5",
        a="Текущий: буклет на тёмном столе",
        variants=[
            dict(id="b", label="Буклет на светлом столе, день",
                 prompt="A printed A4 concept booklet lying open on a light oak desk in daylight: the left page "
                        "shows a daytime aerial render of a data center, the right page a site plan with "
                        "coloured zones. " + DESK),
            dict(id="c", label="Стопка буклетов, кортен-обложка",
                 prompt="Three bound A4 concept booklets fanned on a light concrete surface, covers in "
                        "rust-red and graphite, soft side light, minimal composition. " + DESK),
        ],
    ),
    dict(
        id="doc-composition", section="08 · Материалы", title="Состав материалов",
        base="assets/images/materials/doc-composition", w=1122, h=1402,
        sel=".doc__img img", key="doc-composition",
        ratio="4:5",
        a="Текущий: альбом чертежей",
        variants=[
            dict(id="b", label="Комплект: альбомы, схемы, папки",
                 prompt="Flat lay of a complete set of concept materials: drawing album, folded schematics, "
                        "a binder with coloured tabs, a USB drive, on a light grey surface, daylight. " + DESK),
            dict(id="c", label="Разложенные листы чертежей",
                 prompt="Several large drawing sheets fanned out on a white table: floor plan, section, single-line "
                        "power diagram, all as abstract line work, one sheet with blue highlights. " + DESK),
        ],
    ),
    dict(
        id="doc-checklist", section="08 · Материалы", title="Чек-лист",
        base="assets/images/materials/doc-checklist", w=1122, h=1402,
        sel=".doc__img img", key="doc-checklist",
        ratio="4:5",
        a="Текущий: планшет с чек-листом",
        variants=[
            dict(id="b", label="Чек-лист на светлом столе",
                 prompt="A printed checklist on a clipboard on a light desk in daylight, several items ticked with "
                        "a red pen, a cup of coffee and a pencil nearby. Checklist lines are unreadable grey "
                        "bars. " + DESK),
            dict(id="c", label="Блокнот и техзадание",
                 prompt="An open notebook with hand-drawn tick boxes next to a printed technical brief, a red "
                        "marker, soft window light, top-down view. " + DESK),
        ],
    ),
]

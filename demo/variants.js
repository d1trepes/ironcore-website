/* Генерируется demo/tools/build.py из slots.py — не править руками. */
window.IC_VARIANTS = [
 {
  "id": "hero",
  "section": "01 · Первый экран",
  "title": "Главный рендер",
  "sel": ".hero__scene > img",
  "warn": "На рендер наложены 3 выноски: корпус (справа вверху), контейнеры (по центру), заглублённый уровень (справа внизу). Новый вариант генерировать ПРАВКОЙ текущей картинки, сохраняя расположение объектов.",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: сумерки, степь, графитовый корпус",
    "base": "assets/images/hero/hero-overview",
    "w": 1672,
    "h": 941,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Золотой час, светлый бетон + кортен",
    "base": "demo/variants/hero/b",
    "ready": true,
    "w": 1672,
    "h": 941,
    "layout": {
     "pos": {
      ".hero__dot": [
       [
        78,
        34
       ],
       [
        51,
        62
       ],
       [
        75,
        86
       ]
      ],
      ".hero__tag": [
       [
        78,
        12
       ],
       [
        58.5,
        52
       ],
       [
        64.5,
        86
       ]
      ]
     },
     "points": {
      ".hero__lines:not(.hero__lines--m) polyline": [
       "780,86 780,191",
       "510,349 510,306",
       "750,484 657,484"
      ],
      ".hero__lines--m polyline": [
       "780,86 780,191",
       "510,349 510,404",
       "750,484 750,512 682,512"
      ]
     }
    }
   },
   {
    "id": "c",
    "label": "Зима, ясный день, красный акцент",
    "base": "demo/variants/hero/c",
    "ready": false
   }
  ]
 },
 {
  "id": "security",
  "section": "02 · Безопасность",
  "title": "Разрез площадки (6 точек)",
  "sel": ".atlas__img > img",
  "warn": "На картинке 6 точек рисков в фиксированных местах (КПП слева, корпус, периметр, инженерия справа, заглублённый уровень). Генерировать правкой текущей картинки с той же композицией.",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: сумерки, графит",
    "base": "assets/images/security/security-cutaway",
    "w": 1672,
    "h": 941,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Летний день, зелёная площадка",
    "base": "demo/variants/security/b",
    "ready": true,
    "w": 1672,
    "h": 941,
    "layout": {
     "pos": {
      ".atlas .pin": [
       [
        11,
        47
       ],
       [
        45,
        30
       ],
       [
        16,
        20
       ],
       [
        76,
        43
       ],
       [
        60,
        76
       ],
       [
        78,
        74
       ]
      ]
     }
    }
   },
   {
    "id": "c",
    "label": "Ночь, тёплый свет, мокрый асфальт",
    "base": "demo/variants/security/c",
    "ready": false
   }
  ]
 },
 {
  "id": "scale-compact",
  "section": "03 · Решения",
  "title": "Компактный ЦОД",
  "sel": "#sc-p1 .scale__img img",
  "activate": "#sc-t1",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: сумерки, чёрный корпус",
    "base": "assets/images/concepts/scale-compact",
    "w": 1122,
    "h": 1402,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Белый корпус у кромки леса, лето",
    "base": "demo/variants/scale-compact/b",
    "ready": true,
    "w": 1448,
    "h": 1086
   },
   {
    "id": "c",
    "label": "Осень, кирпич и кортен, промзона",
    "base": "demo/variants/scale-compact/c",
    "ready": false
   }
  ]
 },
 {
  "id": "scale-medium",
  "section": "03 · Решения",
  "title": "ЦОД среднего масштаба",
  "sel": "#sc-p2 .scale__img img",
  "activate": "#sc-t2",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: сумерки, графит",
    "base": "assets/images/concepts/scale-medium",
    "w": 1122,
    "h": 1402,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Ясный день, терракотовые ламели",
    "base": "demo/variants/scale-medium/b",
    "ready": true,
    "w": 1448,
    "h": 1086
   },
   {
    "id": "c",
    "label": "Синий час, тёплые окна, после дождя",
    "base": "demo/variants/scale-medium/c",
    "ready": false
   }
  ]
 },
 {
  "id": "scale-campus",
  "section": "03 · Решения",
  "title": "Крупный ЦОД или кампус",
  "sel": "#sc-p3 .scale__img img",
  "activate": "#sc-t3",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: сумерки, степь",
    "base": "assets/images/concepts/scale-campus",
    "w": 1122,
    "h": 1402,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Летний кампус с высоты, озеленение",
    "base": "demo/variants/scale-campus/b",
    "ready": true,
    "w": 1448,
    "h": 1086
   },
   {
    "id": "c",
    "label": "Кампус зимой, снег",
    "base": "demo/variants/scale-campus/c",
    "ready": false
   }
  ]
 },
 {
  "id": "format-classic",
  "section": "03 · Форматы",
  "title": "Классический ЦОД",
  "sel": ".format__img img",
  "key": "format-classic",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: сумерки, графит",
    "base": "assets/images/formats/format-classic",
    "w": 1448,
    "h": 1086,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "День, светлый бетон и стекло",
    "base": "demo/variants/format-classic/b",
    "ready": true,
    "w": 1448,
    "h": 1086
   },
   {
    "id": "c",
    "label": "Закат, красный козырёк",
    "base": "demo/variants/format-classic/c",
    "ready": false
   }
  ]
 },
 {
  "id": "format-modular",
  "section": "03 · Форматы",
  "title": "Модульный ЦОД",
  "sel": ".format__img img",
  "key": "format-modular",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: сумерки, ряд модулей",
    "base": "assets/images/formats/format-modular",
    "w": 1448,
    "h": 1086,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Монтаж модуля краном, день",
    "base": "demo/variants/format-modular/b",
    "ready": true,
    "w": 1448,
    "h": 1086
   },
   {
    "id": "c",
    "label": "Белые модули, яркий день",
    "base": "demo/variants/format-modular/c",
    "ready": false
   }
  ]
 },
 {
  "id": "format-container",
  "section": "03 · Форматы",
  "title": "Контейнерный ЦОД",
  "sel": ".format__img img",
  "key": "format-container",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: сумерки, графит",
    "base": "assets/images/formats/format-container",
    "w": 1448,
    "h": 1086,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Открытый контейнер, видны стойки",
    "base": "demo/variants/format-container/b",
    "ready": false
   },
   {
    "id": "c",
    "label": "Контейнеры у промплощадки, день",
    "base": "demo/variants/format-container/c",
    "ready": false
   }
  ]
 },
 {
  "id": "format-underground",
  "section": "03 · Форматы",
  "title": "Подземный ЦОД",
  "sel": ".format__img img",
  "key": "format-underground",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: сумерки, портал + вставка",
    "base": "assets/images/formats/format-underground",
    "w": 1448,
    "h": 1086,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Портал в холме, зелёная кровля, лето",
    "base": "demo/variants/format-underground/b",
    "ready": true,
    "w": 1448,
    "h": 1086
   },
   {
    "id": "c",
    "label": "Заглублённый зал изнутри",
    "base": "demo/variants/format-underground/c",
    "ready": false
   }
  ]
 },
 {
  "id": "svc-concept",
  "section": "04 · Услуги",
  "title": "Разработка концепции",
  "sel": ".svc__media img[data-for=\"sv-p1\"], #sv-p1 .svc__pic img",
  "activate": "#sv-t1",
  "scroll": ".svc",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: макет на тёмном столе",
    "base": "assets/images/services/service-concept",
    "w": 1536,
    "h": 1024,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Светлая мастерская, макет и зонирование",
    "base": "demo/variants/svc-concept/b",
    "ready": true,
    "w": 1536,
    "h": 1024
   },
   {
    "id": "c",
    "label": "Обсуждение вариантов у стола",
    "base": "demo/variants/svc-concept/c",
    "ready": false
   }
  ]
 },
 {
  "id": "svc-architecture",
  "section": "04 · Услуги",
  "title": "Архитектура и конструктив",
  "sel": ".svc__media img[data-for=\"sv-p2\"], #sv-p2 .svc__pic img",
  "activate": "#sv-t2",
  "scroll": ".svc",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: недостроенный каркас, сумерки",
    "base": "assets/images/services/service-architecture",
    "w": 1536,
    "h": 1024,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Стройка: каркас и кран, день",
    "base": "demo/variants/svc-architecture/b",
    "ready": true,
    "w": 1536,
    "h": 1024
   },
   {
    "id": "c",
    "label": "Деталь конструктива: колонны и плиты",
    "base": "demo/variants/svc-architecture/c",
    "ready": false
   }
  ]
 },
 {
  "id": "svc-infra",
  "section": "04 · Услуги",
  "title": "Инженерная инфраструктура",
  "sel": ".svc__media img[data-for=\"sv-p3\"], #sv-p3 .svc__pic img",
  "activate": "#sv-t3",
  "scroll": ".svc",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: коридор серверного зала (как в инженерии)",
    "base": "assets/images/interior/interior-hall",
    "w": 1672,
    "h": 941,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Кабельные лотки над стойками",
    "base": "demo/variants/svc-infra/b",
    "ready": true,
    "w": 1536,
    "h": 1024
   },
   {
    "id": "c",
    "label": "Фальшпол поднят, видны коммуникации",
    "base": "demo/variants/svc-infra/c",
    "ready": false
   }
  ]
 },
 {
  "id": "svc-security",
  "section": "04 · Услуги",
  "title": "Физическая защищённость",
  "sel": ".svc__media img[data-for=\"sv-p4\"], #sv-p4 .svc__pic img",
  "activate": "#sv-t4",
  "scroll": ".svc",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: КПП, сумерки",
    "base": "assets/images/services/service-security",
    "w": 1536,
    "h": 1024,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Шлюз и турникеты внутри",
    "base": "demo/variants/svc-security/b",
    "ready": true,
    "w": 1536,
    "h": 1024
   },
   {
    "id": "c",
    "label": "Периметр: забор, камеры, снег",
    "base": "demo/variants/svc-security/c",
    "ready": false
   }
  ]
 },
 {
  "id": "svc-modular",
  "section": "04 · Услуги",
  "title": "Модульные и контейнерные",
  "sel": ".svc__media img[data-for=\"sv-p5\"], #sv-p5 .svc__pic img",
  "activate": "#sv-t5",
  "scroll": ".svc",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: открытый модуль, сумерки",
    "base": "assets/images/services/service-modular",
    "w": 1536,
    "h": 1024,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Сборка модулей в цехе",
    "base": "demo/variants/svc-modular/b",
    "ready": true,
    "w": 1536,
    "h": 1024
   },
   {
    "id": "c",
    "label": "Модуль внутри: стойки и охлаждение",
    "base": "demo/variants/svc-modular/c",
    "ready": false
   }
  ]
 },
 {
  "id": "svc-analysis",
  "section": "04 · Услуги",
  "title": "Анализ документации",
  "sel": ".svc__media img[data-for=\"sv-p6\"], #sv-p6 .svc__pic img",
  "activate": "#sv-t6",
  "scroll": ".svc",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: чертежи на столе",
    "base": "assets/images/services/service-analysis",
    "w": 1536,
    "h": 1024,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Чертежи с цветными пометками, день",
    "base": "demo/variants/svc-analysis/b",
    "ready": true,
    "w": 1536,
    "h": 1024
   },
   {
    "id": "c",
    "label": "Папки проекта и планшет",
    "base": "demo/variants/svc-analysis/c",
    "ready": false
   }
  ]
 },
 {
  "id": "eng-power",
  "section": "06 · Инженерия",
  "title": "Электроснабжение",
  "sel": "#en-p1 .eng__img img",
  "activate": "#en-t1",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: щитовая",
    "base": "assets/images/engineering/eng-power",
    "w": 1536,
    "h": 1024,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Зал ИБП, светлый",
    "base": "demo/variants/eng-power/b",
    "ready": true,
    "w": 1536,
    "h": 1024
   },
   {
    "id": "c",
    "label": "Зал дизель-генераторов",
    "base": "demo/variants/eng-power/c",
    "ready": false
   }
  ]
 },
 {
  "id": "eng-cooling",
  "section": "06 · Инженерия",
  "title": "Охлаждение",
  "sel": "#en-p2 .eng__img img",
  "activate": "#en-t2",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: драйкулеры на кровле, сумерки",
    "base": "assets/images/engineering/eng-cooling",
    "w": 1536,
    "h": 1024,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Холодильный центр, цветные трубы",
    "base": "demo/variants/eng-cooling/b",
    "ready": true,
    "w": 1536,
    "h": 1024
   },
   {
    "id": "c",
    "label": "Жидкостное охлаждение стоек",
    "base": "demo/variants/eng-cooling/c",
    "ready": false
   }
  ]
 },
 {
  "id": "eng-redundancy",
  "section": "06 · Инженерия",
  "title": "Резервирование",
  "sel": "#en-p3 .eng__img img",
  "activate": "#en-t3",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: 4 ДГУ у корпуса, сумерки",
    "base": "assets/images/engineering/eng-redundancy",
    "w": 1536,
    "h": 1024,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Четыре одинаковых модуля ИБП",
    "base": "demo/variants/eng-redundancy/b",
    "ready": true,
    "w": 1536,
    "h": 1024
   },
   {
    "id": "c",
    "label": "Четыре ДГУ днём, светлые",
    "base": "demo/variants/eng-redundancy/c",
    "ready": false
   }
  ]
 },
 {
  "id": "eng-efficiency",
  "section": "06 · Инженерия",
  "title": "Энергоэффективность (PUE)",
  "sel": "#en-p4 .eng__img img",
  "activate": "#en-t4",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: коридор зала (как в услугах)",
    "base": "assets/images/interior/interior-hall",
    "w": 1672,
    "h": 941,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Изолированный холодный коридор",
    "base": "demo/variants/eng-efficiency/b",
    "ready": true,
    "w": 1536,
    "h": 1024
   },
   {
    "id": "c",
    "label": "Свободное охлаждение на улице, день",
    "base": "demo/variants/eng-efficiency/c",
    "ready": false
   }
  ]
 },
 {
  "id": "band",
  "section": "Полоса «Начинаем с требований»",
  "title": "Фон полосы",
  "sel": ".band__bg",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: тот же кадр, что «Классический ЦОД»",
    "base": "assets/images/formats/format-classic",
    "w": 1448,
    "h": 1086,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Панорама кампуса, золотой час",
    "base": "demo/variants/band/b",
    "ready": true,
    "w": 1672,
    "h": 941
   },
   {
    "id": "c",
    "label": "Фасад крупно, графит + красная линия",
    "base": "demo/variants/band/c",
    "ready": false
   }
  ]
 },
 {
  "id": "doc-concept",
  "section": "08 · Материалы",
  "title": "Пример концепции",
  "sel": ".doc__img img",
  "key": "doc-concept",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: буклет на тёмном столе",
    "base": "assets/images/materials/doc-concept",
    "w": 1122,
    "h": 1402,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Буклет на светлом столе, день",
    "base": "demo/variants/doc-concept/b",
    "ready": false
   },
   {
    "id": "c",
    "label": "Стопка буклетов, кортен-обложка",
    "base": "demo/variants/doc-concept/c",
    "ready": false
   }
  ]
 },
 {
  "id": "doc-composition",
  "section": "08 · Материалы",
  "title": "Состав материалов",
  "sel": ".doc__img img",
  "key": "doc-composition",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: альбом чертежей",
    "base": "assets/images/materials/doc-composition",
    "w": 1122,
    "h": 1402,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Комплект: альбомы, схемы, папки",
    "base": "demo/variants/doc-composition/b",
    "ready": false
   },
   {
    "id": "c",
    "label": "Разложенные листы чертежей",
    "base": "demo/variants/doc-composition/c",
    "ready": false
   }
  ]
 },
 {
  "id": "doc-checklist",
  "section": "08 · Материалы",
  "title": "Чек-лист",
  "sel": ".doc__img img",
  "key": "doc-checklist",
  "variants": [
   {
    "id": "a",
    "label": "Текущий: планшет с чек-листом",
    "base": "assets/images/materials/doc-checklist",
    "w": 1122,
    "h": 1402,
    "ready": true,
    "current": true
   },
   {
    "id": "b",
    "label": "Чек-лист на светлом столе",
    "base": "demo/variants/doc-checklist/b",
    "ready": false
   },
   {
    "id": "c",
    "label": "Блокнот и техзадание",
    "base": "demo/variants/doc-checklist/c",
    "ready": false
   }
  ]
 }
];

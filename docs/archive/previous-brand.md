# Бренд IronCore: логотип, цвета, картинки

## Цвета (из эскиза заказчика)
| Роль | HEX | Где |
|---|---|---|
| Синий (основной) | `#1E3A8A` | «IRON», кнопки, ссылки, линии схем |
| Красный (акцент) | `#D62839` | «CORE», ядро знака, главная CTA, активные состояния |
| Графит | `#141821` | текст, тёмные фоны |
| Серый текст | `#5B6475` | второстепенный текст |
| Светлый фон | `#F4F6FA` | фоны секций |
Точные оттенки фона и нейтралей подбирает каждый вариант hero; синий и красный общие.

## Логотип — УТВЕРЖДЁН (5 ноября 2026)
Сделан точно по эскизу заказчика, генерировать ничего не нужно. Образец: холст https://claude.ai/artifact/2YTvUwpTLDRfi2W4fS1b6W, лист «Логотип по эскизу».

**Надпись IRONCORE** (набирается в HTML, шрифт Montserrat 900, Google Fonts):
- I, R, N — синие `#1E3A8A`; C, R, E — красные `#D62839`.
- Обе буквы O заменены сплошными кругами высотой с заглавную букву (`0.72em`, отступ по бокам `0.035em`): первая O — красный круг с графитовой точкой-«ядром» в центре (`0.22em`, `#141821`), вторая O — синий круг.
- На тёмном фоне: I, R, N белые, синий светлее `#3B63D9`, ядро цвета фона.

**Значок** (из кружков внизу эскиза): синий круг позади, красный круг перекрывает его слева, на красном ядро. Файлы:
- `assets/img/mark.svg` — значок для светлого фона
- `assets/img/mark-dark.svg` — для тёмного фона
- `assets/img/favicon.svg` — иконка вкладки браузера

**Шапка сайта:** значок + надпись, под надписью мелко «Проектирование ЦОД» (серый `#5B6475`).

HTML надписи (вставлять как есть, размер задаётся `font-size` у `.logo__word`):
```html
<span class="logo__word" aria-label="IronCore"><span class="b">IR</span><span class="o o--core"></span><span class="b">N</span><span class="r">C</span><span class="o o--blue"></span><span class="r">RE</span></span>
```
```css
.logo__word{font-family:Montserrat,sans-serif;font-weight:900;line-height:1;white-space:nowrap}
.logo__word .b{color:#1E3A8A}.logo__word .r{color:#D62839}
.logo__word .o{display:inline-block;width:.72em;height:.72em;border-radius:50%;margin:0 .035em;position:relative}
.logo__word .o--core{background:#D62839}
.logo__word .o--core::after{content:"";position:absolute;left:50%;top:50%;width:.22em;height:.22em;margin:-.11em 0 0 -.11em;border-radius:50%;background:#141821}
.logo__word .o--blue{background:#1E3A8A}
```

## Картинки для сайта (Gemini)
Общий стиль, добавлять в конец каждого промпта:
```
Photorealistic architectural visualization, realistic materials (concrete, steel, glass), believable scale and human-height details, natural soft daylight or blue-hour light, muted cool color grading with deep blues, a single small red accent element, no text, no logos, no people close-up, no sci-fi, no neon glow, 16:9, high detail.
```
Правила:
- Разрезы ЦОД (вид в разрезе, cutaway) — главный повторяющийся приём: так видно и здание, и подземный уровень, и инженерку.
- Один ракурс и свет на весь набор, иначе сайт выглядит лоскутным.
- Конкретные промпты для каждого блока пишутся в `docs/image-prompts.md` в тот момент, когда блок делается.
- Готовые картинки: формат `.webp` или `.jpg`, ширина 1920px для hero и 1200px для карточек, имена — как указано в `image-prompts.md`, папка `assets/img/`.

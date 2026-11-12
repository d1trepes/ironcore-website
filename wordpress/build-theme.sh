#!/usr/bin/env bash
# Собирает тему WordPress из исходников репозитория:
#   wordpress/ironcore/   — PHP-шаблоны темы
#   css/, js/, assets/    — те же файлы, что у статической версии (единый источник)
# Результат: wordpress/dist/ironcore-theme.zip (Внешний вид → Темы → Добавить → Загрузить).
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
SRC="$ROOT/wordpress/ironcore"
OUT="$ROOT/wordpress/dist"
TMP="$(mktemp -d)"
STAGE="$TMP/ironcore"
trap 'rm -rf "$TMP"' EXIT

cp -R "$SRC" "$STAGE"
mkdir -p "$STAGE/assets/css" "$STAGE/assets/js" "$STAGE/assets/logos/current"

# CSS лежит в assets/css/, шрифты в assets/fonts/ — путь из статической версии меняется на ../fonts/
sed 's#\.\./assets/fonts/#../fonts/#g' "$ROOT/css/styles.css" > "$STAGE/assets/css/styles.css"
cp "$ROOT/js/main.js" "$STAGE/assets/js/main.js"
cp -R "$ROOT/assets/fonts" "$STAGE/assets/fonts"
cp -R "$ROOT/assets/images" "$STAGE/assets/images"
cp "$ROOT"/assets/logos/current/*.svg "$STAGE/assets/logos/current/"

if grep -q '\.\./assets/' "$STAGE/assets/css/styles.css"; then
  echo "Ошибка: в CSS остались пути ../assets/" >&2; exit 1
fi

mkdir -p "$OUT"
rm -f "$OUT/ironcore-theme.zip"
(cd "$TMP" && zip -qr -X "$OUT/ironcore-theme.zip" ironcore -x '*.DS_Store')
echo "Готово: $OUT/ironcore-theme.zip ($(du -h "$OUT/ironcore-theme.zip" | cut -f1))"

/* IRONCORE — подбор изображений. Только для демо (GitHub Pages), в WordPress-тему не входит.
   Данные: demo/variants.js (генерируется demo/tools/build.py).
   URL: ?img=hero.b,eng-cooling.c — выбор; ?pick — открыть панель; ?clean — скрыть кнопку. */
(function () {
  'use strict';
  var SLOTS = window.IC_VARIANTS || [];
  if (!SLOTS.length) return;
  var LS = 'ic-img-pick-v1';
  var params = new URLSearchParams(location.search);
  var state = {};

  function qsa(s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); }
  function el(tag, cls, html) { var e = document.createElement(tag); if (cls) e.className = cls; if (html != null) e.innerHTML = html; return e; }
  function esc(s) { return String(s).replace(/[&<>"]/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]; }); }
  function variant(slot, id) { return slot.variants.filter(function (v) { return v.id === id; })[0]; }
  function letter(id) { return id.toUpperCase(); }

  // Находим картинки каждого места ДО любых подмен (по исходному src).
  SLOTS.forEach(function (s) {
    s.els = qsa(s.sel).filter(function (im) { return !s.key || (im.getAttribute('src') || '').indexOf(s.key) > -1; });
  });

  function srcset(v) {
    return v.base + '-640w.webp 640w, ' + v.base + '-1024w.webp 1024w, ' + v.base + '.webp ' + (v.w || 1920) + 'w';
  }

  // Раскладка выносок/точек под конкретный кадр. Исходные значения запоминаются и возвращаются для вариантов без layout.
  var orig = new Map();
  function remember(e, prop, val) { var k = orig.get(e) || {}; if (!(prop in k)) k[prop] = val; orig.set(e, k); }
  function layout(s, v) {
    (s.layoutSels || []).forEach(function (sel) {
      qsa(sel).forEach(function (e) {
        var k = orig.get(e) || {};
        if ('left' in k) { e.style.left = k.left; e.style.top = k.top; }
        if ('points' in k) e.setAttribute('points', k.points);
      });
    });
    var L = v.layout;
    if (!L) return;
    Object.keys(L.pos || {}).forEach(function (sel) {
      qsa(sel).forEach(function (e, i) {
        var p = L.pos[sel][i]; if (!p) return;
        remember(e, 'left', e.style.left); remember(e, 'top', e.style.top);
        e.style.left = p[0] + '%'; e.style.top = p[1] + '%';
      });
    });
    Object.keys(L.points || {}).forEach(function (sel) {
      qsa(sel).forEach(function (e, i) {
        var p = L.points[sel][i]; if (!p) return;
        remember(e, 'points', e.getAttribute('points'));
        e.setAttribute('points', p);
      });
    });
  }
  SLOTS.forEach(function (s) {
    var sels = {};
    s.variants.forEach(function (v) { if (v.layout) { Object.keys(v.layout.pos || {}).concat(Object.keys(v.layout.points || {})).forEach(function (k) { sels[k] = 1; }); } });
    s.layoutSels = Object.keys(sels);
  });

  // Первый экран: новые кадры закрывают весь блок (cover), без синей подложки и маски. A — как утверждено.
  var hero = document.querySelector('.hero'), heroScene = hero && hero.querySelector('.hero__scene');
  var wide = window.matchMedia('(min-width: 961px)');
  function fitHero() {
    if (!hero || !heroScene) return;
    var full = (state.hero || 'a') !== 'a';
    hero.classList.toggle('icp-full', full);
    if (!full) { heroScene.style.width = heroScene.style.height = heroScene.style.left = heroScene.style.top = ''; return; }
    var W = hero.clientWidth, H = hero.clientHeight, r = 1672 / 941, w, h, x, y;
    if (W / H > r) { w = W; h = W / r; x = 0; y = (H - h) / 2; }
    else { h = H; w = H * r; y = 0; x = Math.min(0, Math.max(W - w, W / 2 - w * (wide.matches ? 0.62 : 0.72))); }
    heroScene.style.width = w + 'px'; heroScene.style.height = h + 'px';
    heroScene.style.left = x + 'px'; heroScene.style.top = y + 'px';
  }
  window.addEventListener('resize', fitHero);
  window.addEventListener('load', fitHero);
  if (document.fonts && document.fonts.ready) document.fonts.ready.then(fitHero);

  function apply(s, id, quiet) {
    var v = variant(s, id);
    if (!v || !v.ready) return;
    layout(s, v);
    s.els.forEach(function (im) {
      im.srcset = srcset(v);
      im.src = v.base + '-1024w.webp';
      if (v.w) { im.width = v.w; im.height = v.h; }
    });
    if (id === 'a') delete state[s.id]; else state[s.id] = id;
    if (s.id === 'hero') fitHero();
    if (!quiet) save();
    renderSlot(s);
  }

  function save() {
    try { localStorage.setItem(LS, JSON.stringify(state)); } catch (e) { /* приватный режим */ }
    updateBadge();
  }

  function load() {
    var saved = {};
    try { saved = JSON.parse(localStorage.getItem(LS) || '{}') || {}; } catch (e) { saved = {}; }
    var fromUrl = params.get('img');
    if (fromUrl) {
      saved = {};
      fromUrl.split(',').forEach(function (p) { var kv = p.split('.'); if (kv[0] && kv[1]) saved[kv[0]] = kv[1]; });
    }
    SLOTS.forEach(function (s) { if (saved[s.id]) apply(s, saved[s.id], true); });
    save();
  }

  function visibleEl(s) {
    return s.els.filter(function (im) { return im.getClientRects().length; })[0] || s.els[0];
  }

  function show(s) {
    if (s.activate) {
      var b = document.querySelector(s.activate);
      if (b && b.getAttribute('aria-selected') !== 'true' && b.getAttribute('aria-expanded') !== 'true') b.click();
    }
    setTimeout(function () {
      var im = visibleEl(s);
      if (!im) return;
      var box = im.parentElement;
      var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
      box.scrollIntoView({ block: 'center', behavior: reduce ? 'auto' : 'smooth' });
      if (s.id === 'hero') return;
      box.classList.remove('icp-flash'); void box.offsetWidth; box.classList.add('icp-flash');
      setTimeout(function () { box.classList.remove('icp-flash'); }, 1600);
    }, 60);
  }

  // ---------- UI ----------
  var css = '' +
    '.icp{position:fixed;top:0;right:0;bottom:0;z-index:9999;width:400px;max-width:calc(100vw - 44px);background:#0E1521;color:#E8ECF2;font-family:inherit;box-shadow:-12px 0 40px rgba(0,0,0,.4);transform:translateX(100%);transition:transform .35s cubic-bezier(.22,.7,.18,1)}' +
    '.icp.is-open{transform:none}' +
    '.icp__in{display:flex;flex-direction:column;height:100%}' +
    '.icp__tab{position:absolute;top:50%;left:-40px;width:40px;transform:translateY(-50%);display:flex;flex-direction:column;align-items:center;gap:14px;padding:18px 0 20px;border:1px solid rgba(255,255,255,.12);border-right:0;border-radius:6px 0 0 6px;background:#0E1521;color:#E8ECF2;font-family:inherit;font-size:13px;font-weight:500;letter-spacing:.01em;line-height:1;cursor:pointer;box-shadow:-6px 0 20px rgba(0,0,0,.28);transition:background .2s}' +
    '.icp__tab:hover{background:#162133}.icp__tab span{writing-mode:vertical-rl;transform:rotate(180deg);white-space:nowrap}' +
    '.icp__tab svg{flex:none;width:16px;height:16px;transition:transform .35s}.icp.is-open .icp__tab svg{transform:rotate(180deg)}' +
    '.icp button:focus-visible{outline:2px solid #E60028;outline-offset:2px}' +
    '.icp__body{scrollbar-width:thin;scrollbar-color:#0757C8 transparent}.icp__body::-webkit-scrollbar{width:6px}.icp__body::-webkit-scrollbar-track{background:transparent}.icp__body::-webkit-scrollbar-thumb{background:#0757C8;border-radius:3px}' +
    'html{scrollbar-color:#0757C8 #0F151D}html::-webkit-scrollbar{width:10px}html::-webkit-scrollbar-track{background:#0F151D}html::-webkit-scrollbar-thumb{background:#0757C8;border:2px solid #0F151D;border-radius:5px}' +
    '.hero.icp-full{background:#0F151D}' +
    '.hero.icp-full::before{background:linear-gradient(90deg,rgba(11,15,21,.66) 0,rgba(11,15,21,.4) 30%,rgba(11,15,21,.08) 54%,rgba(11,15,21,0) 66%),linear-gradient(180deg,rgba(11,15,21,.5) 0,rgba(11,15,21,0) 18%)}' +
    '.hero.icp-full .hero__scene{right:auto;bottom:auto;aspect-ratio:auto;transform:none}' +
    '.hero.icp-full .hero__scene img{height:100%;-webkit-mask-image:none;mask-image:none}' +
    '.hero.icp-full .hero__title,.hero.icp-full .hero__lead{text-shadow:0 1px 18px rgba(8,11,16,.45)}' +
    '.hero.icp-full .btn--line{background:rgba(11,15,21,.28);-webkit-backdrop-filter:blur(8px);backdrop-filter:blur(8px)}' +
    '@media (max-width:960px){.hero.icp-full::before{background:linear-gradient(180deg,rgba(11,15,21,.62) 0,rgba(11,15,21,.5) 38%,rgba(11,15,21,.12) 62%,rgba(11,15,21,0) 78%)}' +
    '.hero.icp-full .hero__lines,.hero.icp-full .hero__dot,.hero.icp-full .hero__tag{display:none!important}}' +
    '.icp__head{padding:22px 24px 16px;border-bottom:1px solid rgba(255,255,255,.1)}.icp__head h2{margin:0 0 6px;font-size:18px;font-weight:600}' +
    '.icp__head p{margin:0;color:#8F9BAD;font-size:13px;line-height:1.45}.icp__head{position:relative}.icp__x{position:absolute;top:14px;right:14px;width:40px;height:40px;border:0;background:none;color:#E8ECF2;font-size:24px;cursor:pointer}' +
    '.icp__body{flex:1;overflow:auto;padding:4px 24px 24px;overscroll-behavior:contain}' +
    '.icp__sec{margin:22px 0 4px;color:#8F9BAD;font-size:11px;letter-spacing:.08em;text-transform:uppercase}' +
    '.icp-s{padding:12px 0 14px;border-bottom:1px solid rgba(255,255,255,.07)}' +
    '.icp-s__t{display:flex;justify-content:space-between;align-items:baseline;gap:8px;width:100%;padding:0;border:0;background:none;color:inherit;font:inherit;font-size:14px;font-weight:500;text-align:left;cursor:pointer}' +
    '.icp-s__t span{color:#8F9BAD;font-size:12px;font-weight:400;white-space:nowrap}.icp-s__t:hover span{color:#E8ECF2}' +
    '.icp-s__row{display:flex;gap:8px;margin:10px 0 8px}' +
    '.icp-th{position:relative;flex:0 0 auto;width:96px;height:64px;padding:0;border:1px solid rgba(255,255,255,.14);background:#1A2333;cursor:pointer;overflow:hidden}' +
    '.icp-th img{width:100%;height:100%;object-fit:cover;display:block}' +
    '.icp-th i{position:absolute;left:4px;top:4px;display:flex;align-items:center;justify-content:center;width:22px;height:22px;background:rgba(14,21,33,.85);color:#fff;font-family:inherit;font-size:12px;font-weight:600;line-height:1;font-style:normal}' +
    '.icp-th[aria-pressed=true]{border:2px solid #E60028}.icp-th[aria-pressed=true] i{background:#E60028}' +
    '.icp-th:disabled{cursor:default;border-style:dashed;background:transparent;color:#5E6A7D}' +
    '.icp-th:disabled em{position:absolute;left:0;right:0;bottom:6px;font-size:10px;font-style:normal;text-align:center}' +
    '.icp-s__lab{margin:0;color:#B4BECC;font-size:12.5px;line-height:1.4}' +
    '.icp-s__warn{margin:6px 0 0;color:#8F9BAD;font-size:11.5px;line-height:1.4}' +
    '.icp__foot{display:grid;grid-template-columns:1fr 1fr;gap:8px;padding:16px 24px 20px;border-top:1px solid rgba(255,255,255,.1)}' +
    '.icp__foot button{height:44px;padding:0 10px;text-align:center;border:1px solid rgba(255,255,255,.2);background:none;color:#E8ECF2;font:inherit;font-size:13.5px;cursor:pointer}' +
    '.icp__foot button:hover{border-color:rgba(255,255,255,.5)}.icp__foot .icp__main{grid-column:1/-1;background:#E60028;border-color:#E60028;color:#fff;font-weight:500}' +
    '.icp__wide{grid-column:1/-1}.icp__msg{grid-column:1/-1;min-height:16px;margin:0;color:#8F9BAD;font-size:12px}' +
    '.icp-flash{outline:3px solid #E60028!important;outline-offset:-3px;transition:outline-color 1.4s}' +
    '@media (max-width:600px){.icp{width:calc(100vw - 36px);max-width:calc(100vw - 36px)}.icp__tab{left:-36px;width:36px;top:auto;bottom:20px;transform:none;gap:12px;padding:16px 0 18px;font-size:12px}.icp__tab svg{width:14px;height:14px}.icp__head{padding:18px 18px 12px}.icp__body{padding:4px 18px 18px}.icp__foot{padding:12px 18px 16px}.icp-th{width:84px;height:56px}}' +
    '';
  document.head.appendChild(el('style', null, css));

  var ready = 0;
  SLOTS.forEach(function (s) { s.variants.forEach(function (v) { if (v.ready && v.id !== 'a') ready++; }); });

  var panel = el('aside', 'icp');
  panel.id = 'icp';
  panel.setAttribute('aria-label', 'Подбор изображений');
  panel.innerHTML =
    '<button class="icp__tab" type="button" aria-controls="icp-in" aria-expanded="false">' +
    '<svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 3 5 8l5 5"/></svg>' +
    '<span>Подбор изображений</span></button>' +
    '<div class="icp__in" id="icp-in"><div class="icp__head"><h2>Подбор изображений</h2>' +
    '<p>Демо-режим. Выберите вариант для каждого места — картинка сразу меняется на странице. ' +
    'A — текущая. Выбор сохраняется в этом браузере; кнопками ниже его можно отправить нам.</p>' +
    '<button class="icp__x" type="button" aria-label="Закрыть">×</button></div>' +
    '<div class="icp__body"></div>' +
    '<div class="icp__foot"><button class="icp__main" type="button" data-act="copy">Скопировать выбор списком</button>' +
    '<button type="button" data-act="allb">Все B (новые)</button><button type="button" data-act="reset">Все A (как было)</button><button class="icp__wide" type="button" data-act="link">Ссылка с выбором</button>' +
    '<p class="icp__msg" role="status"></p></div></div>';
  var tab = panel.querySelector('.icp__tab');
  var inner = panel.querySelector('.icp__in');
  var body = panel.querySelector('.icp__body');
  var msg = panel.querySelector('.icp__msg');

  var lastSec = null;
  SLOTS.forEach(function (s) {
    if (s.section !== lastSec) { lastSec = s.section; body.appendChild(el('p', 'icp__sec', esc(s.section))); }
    s.box = el('div', 'icp-s');
    body.appendChild(s.box);
    if (!s.els.length) s.box.hidden = true;
  });

  function renderSlot(s) {
    if (!s.box) return;
    var cur = state[s.id] || 'a';
    var n = s.variants.filter(function (v) { return v.ready; }).length;
    var h = '<button class="icp-s__t" type="button" data-show>' + esc(s.title) + '<span>' +
      (n > 1 ? n + ' вар. · показать ↓' : 'показать ↓') + '</span></button><div class="icp-s__row">';
    s.variants.forEach(function (v) {
      if (v.ready) {
        h += '<button class="icp-th" type="button" data-v="' + v.id + '" aria-pressed="' + (v.id === cur) + '" title="' + esc(letter(v.id) + ' — ' + v.label) + '">' +
          '<img src="' + v.base + '-640w.webp" alt="" loading="lazy" decoding="async"><i>' + letter(v.id) + '</i></button>';

      }
    });
    var cv = variant(s, cur);
    h += '</div><p class="icp-s__lab">' + letter(cur) + ' — ' + esc(cv.label) + '</p>';
    s.box.innerHTML = h;
  }
  SLOTS.forEach(renderSlot);

  body.addEventListener('click', function (e) {
    var t = e.target.closest('button');
    if (!t) return;
    var idx = Array.prototype.indexOf.call(body.querySelectorAll('.icp-s'), t.closest('.icp-s'));
    var s = SLOTS[idx];
    if (!s) return;
    if (t.hasAttribute('data-v')) { apply(s, t.getAttribute('data-v')); show(s); s.box.querySelector('[data-v="' + t.getAttribute('data-v') + '"]').focus(); }
    else if (t.hasAttribute('data-show')) show(s);
  });

  function selectionUrl() {
    var u = new URL(location.href);
    u.search = '';
    var p = Object.keys(state).map(function (k) { return k + '.' + state[k]; }).join(',');
    if (p) u.searchParams.set('img', p);
    return u.toString().replace(/%2C/g, ',');
  }

  function selectionText() {
    var lines = ['IRONCORE — выбор изображений'];
    var sec = null;
    SLOTS.forEach(function (s) {
      if (!s.els.length) return;
      if (s.section !== sec) { sec = s.section; lines.push('', sec); }
      var id = state[s.id] || 'a';
      lines.push('— ' + s.title + ': ' + letter(id) + ' (' + variant(s, id).label + ')');
    });
    lines.push('', 'Ссылка: ' + selectionUrl());
    return lines.join('\n');
  }

  function copy(text, ok) {
    function fallback() {
      var ta = el('textarea'); ta.value = text; ta.style.cssText = 'position:fixed;opacity:0';
      panel.appendChild(ta); ta.select();
      try { document.execCommand('copy'); msg.textContent = ok; } catch (e) { msg.textContent = 'Не удалось скопировать — выделите текст вручную.'; }
      panel.removeChild(ta);
    }
    if (navigator.clipboard && window.isSecureContext) navigator.clipboard.writeText(text).then(function () { msg.textContent = ok; }, fallback);
    else fallback();
  }

  panel.querySelector('.icp__foot').addEventListener('click', function (e) {
    var a = e.target.getAttribute('data-act');
    if (a === 'copy') copy(selectionText(), 'Список скопирован — вставьте его в сообщение.');
    if (a === 'link') copy(selectionUrl(), 'Ссылка скопирована: по ней откроется сайт с этим выбором.');
    if (a === 'allb') { SLOTS.forEach(function (s) { var v = variant(s, 'b'); if (v && v.ready) apply(s, 'b', true); }); save(); msg.textContent = 'Везде, где есть вариант B, стоит B.'; }
    if (a === 'reset') { SLOTS.forEach(function (s) { apply(s, 'a', true); }); save(); msg.textContent = 'Все места вернулись к варианту A.'; }
  });

  function updateBadge() {}


  function toggle(open) {
    panel.classList.toggle('is-open', open);
    tab.setAttribute('aria-expanded', String(open));
    tab.setAttribute('aria-label', open ? 'Скрыть подбор изображений' : 'Открыть подбор изображений');
    if (open) inner.removeAttribute('inert'); else inner.setAttribute('inert', '');
  }
  tab.addEventListener('click', function () { toggle(!panel.classList.contains('is-open')); });
  panel.querySelector('.icp__x').addEventListener('click', function () { toggle(false); tab.focus({ preventScroll: true }); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && panel.classList.contains('is-open')) { toggle(false); tab.focus({ preventScroll: true }); } });

  if (params.has('clean')) tab.hidden = true;
  document.body.appendChild(panel);
  toggle(false);
  load();
  if (params.has('pick')) toggle(true);
})();

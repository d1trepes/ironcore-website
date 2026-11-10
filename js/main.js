/* IRONCORE demo v2 — vanilla, no dependencies. */
(function () {
  'use strict';
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var $ = function (s, r) { return (r || document).querySelector(s); };
  var $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };

  $$('[data-year]').forEach(function (el) { el.textContent = new Date().getFullYear(); });

  /* ---- Header: solid after hero top, hides on scroll down, returns on scroll up ---- */
  var header = $('#header'), burger = $('.burger'), drawer = $('#drawer');
  var mobile = window.matchMedia('(max-width: 960px)');
  var lastY = window.scrollY, locked = false;
  function onScroll() {
    if (locked) return;
    var y = window.scrollY;
    header.classList.toggle('is-solid', y > 24);
    var edge = mobile.matches ? 240 : 480;
    if (y > edge && y > lastY + 4) header.classList.add('is-hidden');
    else if (y < lastY - 4 || y <= edge) header.classList.remove('is-hidden');
    lastY = y;
  }

  /* ---- Page scroll lock (works on iOS too): used by the drawer ---- */
  var lockY = 0;
  function lockScroll() {
    if (locked) return;
    lockY = window.scrollY; locked = true;
    var b = document.body.style;
    b.position = 'fixed'; b.top = -lockY + 'px'; b.left = '0'; b.right = '0'; b.width = '100%';
  }
  function unlockScroll() {
    if (!locked) return;
    var b = document.body.style;
    b.position = b.top = b.left = b.right = b.width = '';
    document.documentElement.style.scrollBehavior = 'auto';
    window.scrollTo(0, lockY);
    document.documentElement.style.scrollBehavior = '';
    lastY = lockY; locked = false;
  }

  /* ---- Mobile drawer menu: slides in from the right ---- */
  var drawerPanel = $('.drawer__panel', drawer), drawerTimer = null;
  function focusables() { return $$('a[href], button:not([disabled])', drawerPanel); }
  function openMenu() {
    clearTimeout(drawerTimer);
    drawer.hidden = false;
    lockScroll();
    drawer.offsetWidth; // start the slide from the closed state
    drawer.classList.add('is-open');
    burger.setAttribute('aria-expanded', 'true');
    burger.setAttribute('aria-label', 'Закрыть меню');
    $('.drawer__close', drawer).focus({ preventScroll: true });
  }
  function closeMenu(returnFocus) {
    if (drawer.hidden) return;
    drawer.classList.remove('is-open');
    burger.setAttribute('aria-expanded', 'false');
    burger.setAttribute('aria-label', 'Открыть меню');
    unlockScroll();
    if (returnFocus) burger.focus({ preventScroll: true });
    drawerTimer = setTimeout(function () { drawer.hidden = true; }, reduce ? 0 : 380);
  }
  burger.addEventListener('click', function () { if (drawer.hidden || !drawer.classList.contains('is-open')) openMenu(); else closeMenu(true); });
  drawer.addEventListener('click', function (e) {
    if (e.target.closest('[data-drawer-close]')) closeMenu(true);
    else if (e.target.closest('.drawer__nav a')) closeMenu(false); // page scroll is restored first, then the anchor jump runs
  });
  drawer.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') { e.preventDefault(); closeMenu(true); return; }
    if (e.key !== 'Tab') return;
    var f = focusables(), first = f[0], lastF = f[f.length - 1];
    if (e.shiftKey && document.activeElement === first) { e.preventDefault(); lastF.focus(); }
    else if (!e.shiftKey && document.activeElement === lastF) { e.preventDefault(); first.focus(); }
  });
  function onMq() { if (!mobile.matches) closeMenu(false); }
  if (mobile.addEventListener) mobile.addEventListener('change', onMq); else mobile.addListener(onMq);

  /* ---- Active nav item ---- */
  var links = $$('.nav a, .drawer__nav a');
  if ('IntersectionObserver' in window) {
    var navIO = new IntersectionObserver(function (es) {
      es.forEach(function (en) {
        if (!en.isIntersecting) return;
        links.forEach(function (a) { a.classList.toggle('is-active', a.getAttribute('href') === '#' + en.target.id); });
      });
    }, { rootMargin: '-45% 0px -50% 0px' });
    $$('main section[id]').forEach(function (s) { navIO.observe(s); });
  }

  /* ---- Image reveal (only for images that start below the fold) ---- */
  var reveals = $$('.reveal');
  if (!reduce && 'IntersectionObserver' in window) {
    var revIO = new IntersectionObserver(function (es) {
      es.forEach(function (en) { if (en.isIntersecting) { en.target.classList.remove('is-pending'); revIO.unobserve(en.target); } });
    }, { rootMargin: '0px 0px 0px 0px' });
    reveals.forEach(function (el) {
      if (el.getBoundingClientRect().top > window.innerHeight) { el.classList.add('is-pending'); revIO.observe(el); }
    });
  }

  /* ---- Statement lines in the photo band ---- */
  $$('[data-lines]').forEach(function (el) {
    if (reduce || !('IntersectionObserver' in window) || el.getBoundingClientRect().top < window.innerHeight) return;
    el.classList.add('is-pending');
    var io = new IntersectionObserver(function (es) {
      if (es[0].isIntersecting) { el.classList.remove('is-pending'); io.disconnect(); }
    }, { rootMargin: '0px 0px -20% 0px' });
    io.observe(el);
  });

  /* ---- Fast images: once the first screen is in, fetch every other picture in the background,
     a few at a time, at the size this screen needs. Scrolling then never waits for the network.
     The variant that is hidden at this width (service photos differ on desktop and mobile) is skipped. */
  function loadAllImages() {
    var queue = $$('img[loading="lazy"]').filter(function (im) {
      var box = im.closest('.svc__media, .svc__pic');
      return !(box && getComputedStyle(box).display === 'none');
    });
    var active = 0;
    function next() {
      while (active < 4 && queue.length) {
        var im = queue.shift();
        if (im.complete && im.naturalWidth) continue;
        active++;
        var done = function () { active--; next(); };
        im.addEventListener('load', done, { once: true });
        im.addEventListener('error', done, { once: true });
        im.loading = 'eager';
      }
    }
    next();
  }
  if (document.readyState === 'complete') setTimeout(loadAllImages, 0);
  else window.addEventListener('load', function () { setTimeout(loadAllImages, 0); });

  /* ---- Warm up images inside tabs before the visitor reaches them ---- */
  if ('IntersectionObserver' in window) {
    var warm = new IntersectionObserver(function (es) {
      es.forEach(function (en) {
        if (!en.isIntersecting) return;
        $$('img[loading="lazy"]', en.target).forEach(function (im) {
          var box = im.closest('.svc__media, .svc__pic'); // only the variant shown at this width
          if (box && getComputedStyle(box).display === 'none') return;
          var pre = new Image();
          if (im.srcset) { pre.sizes = im.sizes; pre.srcset = im.srcset; }
          pre.src = im.currentSrc || im.src;
        });
        warm.unobserve(en.target);
      });
    }, { rootMargin: '800px 0px' });
    $$('[data-tabs], [data-svc]').forEach(function (el) { warm.observe(el); });
  }

  /* ---- Hero parallax + process steps lit by reading position ---- */
  var scene = $('[data-parallax]'), stepsEl = $('[data-steps]');
  var steps = stepsEl ? $$('.step', stepsEl) : [];
  var ticking = false;
  function frame() {
    ticking = false;
    var vh = window.innerHeight;
    if (scene && !reduce && !mobile.matches) {
      var y = Math.min(window.scrollY, vh);
      scene.style.transform = 'translate3d(0,' + (y * 0.12).toFixed(1) + 'px,0)';
    }
    if (stepsEl) {
      var line = vh * 0.62, last = -1;
      steps.forEach(function (li, i) {
        var on = reduce || li.getBoundingClientRect().top + 22 < line;
        li.classList.toggle('is-on', on);
        if (on) last = i;
      });
      var r = stepsEl.getBoundingClientRect();
      var p = reduce ? 1 : Math.max(0, Math.min(1, (line - r.top - 28) / Math.max(1, r.height - 56)));
      if (last === steps.length - 1 && !reduce) p = Math.max(p, 1);
      stepsEl.style.setProperty('--p', p.toFixed(3));
    }
  }
  window.addEventListener('scroll', function () {
    onScroll();
    if (!ticking) { ticking = true; requestAnimationFrame(frame); }
  }, { passive: true });
  window.addEventListener('resize', frame);
  onScroll(); frame();

  /* ---- Tabs (scale switcher, engineering) ---- */
  $$('[data-tabs]').forEach(function (root) {
    var tabs = $$('[role="tab"]', root);
    function select(tab, focus) {
      tabs.forEach(function (t) {
        var on = t === tab;
        t.setAttribute('aria-selected', String(on));
        t.tabIndex = on ? 0 : -1;
        document.getElementById(t.getAttribute('aria-controls')).hidden = !on;
      });
      if (focus) tab.focus({ preventScroll: true });
      // On phones the picker is a swipe strip: bring the chosen card into view inside it, never scroll the page
      var strip = tab.parentNode;
      if (strip.scrollWidth > strip.clientWidth + 2) {
        var pad = parseFloat(getComputedStyle(strip).paddingLeft) || 0;
        var to = tab.offsetLeft - strip.offsetLeft - pad;
        if (strip.scrollTo) strip.scrollTo({ left: to, behavior: reduce ? 'auto' : 'smooth' }); else strip.scrollLeft = to;
      }
    }
    tabs.forEach(function (tab, i) {
      tab.addEventListener('click', function () { select(tab); });
      tab.addEventListener('keydown', function (e) {
        var j = null;
        if (e.key === 'ArrowRight') j = (i + 1) % tabs.length;
        else if (e.key === 'ArrowLeft') j = (i - 1 + tabs.length) % tabs.length;
        else if (e.key === 'Home') j = 0;
        else if (e.key === 'End') j = tabs.length - 1;
        if (j !== null) { e.preventDefault(); select(tabs[j], true); }
      });
    });
  });

  /* ---- Services: click opens one service, image follows ---- */
  $$('[data-svc]').forEach(function (root) {
    var btns = $$('.svc__btn', root), imgs = $$('.svc__media img', root);
    function open(btn) {
      var closing = btn.getAttribute('aria-expanded') === 'true';
      btns.forEach(function (b) {
        var on = b === btn && !closing;
        b.setAttribute('aria-expanded', String(on));
        document.getElementById(b.getAttribute('aria-controls')).hidden = !on;
      });
      if (closing) return;
      var id = btn.getAttribute('aria-controls');
      imgs.forEach(function (im) { im.classList.toggle('is-on', im.getAttribute('data-for') === id); });
    }
    btns.forEach(function (b) { b.addEventListener('click', function () { open(b); }); });
  });

  /* ---- Security atlas: pins and legend share one state; a second click closes ---- */
  $$('[data-atlas]').forEach(function (root) {
    var pins = $$('.pin', root), btns = $$('.legend__btn', root), cur = null;
    function set(i) {
      cur = (i === cur) ? null : i;
      pins.forEach(function (p) { var on = p.getAttribute('data-risk') === cur; p.classList.toggle('is-on', on); p.setAttribute('aria-pressed', String(on)); });
      btns.forEach(function (b) {
        var on = b.getAttribute('data-risk') === cur;
        b.setAttribute('aria-expanded', String(on));
        document.getElementById(b.getAttribute('aria-controls')).hidden = !on;
      });
    }
    pins.forEach(function (p) { p.addEventListener('click', function () { set(p.getAttribute('data-risk')); }); });
    btns.forEach(function (b) { b.addEventListener('click', function () { set(b.getAttribute('data-risk')); }); });
    set('0');
  });

  /* ---- Forms: one template, inline (#contact) and modal ---- */
  var tpl = $('#form-tpl');
  function mount(host, suffix) {
    var frag = tpl.content.cloneNode(true);
    $$('[id]', frag).forEach(function (el) { el.id += suffix; });
    $$('label[for]', frag).forEach(function (el) { el.htmlFor += suffix; });
    $$('[aria-labelledby]', frag).forEach(function (el) { el.setAttribute('aria-labelledby', el.getAttribute('aria-labelledby') + suffix); });
    host.appendChild(frag);
    var form = $('form', host);
    wire(form);
    return form;
  }
  function wire(form) {
    var name = form.elements.name, phone = form.elements.phone, files = form.elements.files;
    var status = $('.form__status', form), list = $('.file__list', form), hint = list.textContent;
    function err(input, show) {
      var e = $('.field__err', input.parentNode);
      e.id = input.id + '-err';
      input.setAttribute('aria-invalid', show ? 'true' : 'false');
      if (show) input.setAttribute('aria-describedby', e.id); else input.removeAttribute('aria-describedby');
      e.hidden = !show;
    }
    function check() {
      var okN = name.value.trim().length > 0, okP = phone.value.replace(/\D/g, '').length >= 10;
      err(name, !okN); err(phone, !okP);
      return !okN ? name : (!okP ? phone : null);
    }
    [name, phone].forEach(function (el) { el.addEventListener('input', function () { if (el.getAttribute('aria-invalid') === 'true') check(); status.hidden = true; }); });
    var comment = form.elements.comment;
    $$('.chip', form).forEach(function (chip) {
      chip.setAttribute('aria-pressed', 'false');
      chip.addEventListener('click', function () {
        var line = chip.getAttribute('data-chip') + ': ';
        var v = comment.value;
        if (v.indexOf(line) === -1) comment.value = (v && !/\n$/.test(v) ? v + '\n' : v) + line;
        chip.setAttribute('aria-pressed', 'true');
        comment.focus();
        comment.setSelectionRange(comment.value.length, comment.value.length);
      });
    });
    comment.addEventListener('input', function () {
      $$('.chip', form).forEach(function (chip) {
        chip.setAttribute('aria-pressed', String(comment.value.indexOf(chip.getAttribute('data-chip') + ':') !== -1));
      });
    });
    files.addEventListener('change', function () {
      list.textContent = files.files.length ? Array.prototype.map.call(files.files, function (f) { return f.name; }).join(', ') : hint;
    });
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var bad = check();
      if (bad) { bad.focus(); status.hidden = true; return; }
      status.innerHTML = 'Демо-режим: заявка <b>не отправлена</b>, форма ещё не подключена. Позвоните, чтобы обсудить проект: <a href="tel:+79284160938">8 (928) 416-09-38</a>.';
      status.hidden = false;
    });
  }
  $$('[data-form-host="inline"]').forEach(function (h) { mount(h, '-c').elements.source.value = 'Форма в разделе «Контакты»'; });

  /* ---- Modal ---- */
  var modal = $('#modal'), mForm = mount($('[data-form-host="modal"]', modal), '-m'), mTitle = $('#modal-title'), last = null;
  function openModal(label, trigger) {
    last = trigger && trigger.closest('#drawer') ? burger : trigger;
    mTitle.textContent = label === 'Связаться' ? 'Обсудить проект' : label;
    mForm.elements.source.value = label;
    $('.form__status', mForm).hidden = true;
    if (modal.showModal) modal.showModal(); else modal.setAttribute('open', '');
    document.body.classList.add('no-scroll');
    closeMenu(false);
    setTimeout(function () { mForm.elements.name.focus(); }, 40);
  }
  function onClose() { document.body.classList.remove('no-scroll'); if (last) last.focus(); }
  modal.addEventListener('close', onClose);
  modal.addEventListener('click', function (e) {
    if (e.target === modal || e.target.closest('[data-close]')) { if (modal.close) modal.close(); else { modal.removeAttribute('open'); onClose(); } }
  });
  document.addEventListener('click', function (e) {
    var t = e.target.closest('[data-modal]');
    if (t) { e.preventDefault(); openModal(t.getAttribute('data-modal'), t); }
  });
})();

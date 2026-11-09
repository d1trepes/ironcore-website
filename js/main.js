/* IRONCORE demo v2 — vanilla, no dependencies. */
(function () {
  'use strict';
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var $ = function (s, r) { return (r || document).querySelector(s); };
  var $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };

  $$('[data-year]').forEach(function (el) { el.textContent = new Date().getFullYear(); });

  /* ---- Header: solid after hero top, hides on scroll down, returns on scroll up ---- */
  var header = $('#header'), nav = $('#nav'), burger = $('.burger');
  var lastY = window.scrollY;
  function onScroll() {
    var y = window.scrollY;
    header.classList.toggle('is-solid', y > 24);
    var menuOpen = nav.classList.contains('is-open');
    if (!menuOpen && y > 480 && y > lastY + 4) header.classList.add('is-hidden');
    else if (y < lastY - 4 || y <= 480) header.classList.remove('is-hidden');
    lastY = y;
  }

  /* ---- Mobile menu (basic; final mobile is stage 03) ---- */
  function closeMenu() { nav.classList.remove('is-open'); burger.setAttribute('aria-expanded', 'false'); burger.setAttribute('aria-label', 'Открыть меню'); }
  burger.addEventListener('click', function () {
    var open = !nav.classList.contains('is-open');
    nav.classList.toggle('is-open', open);
    burger.setAttribute('aria-expanded', String(open));
    burger.setAttribute('aria-label', open ? 'Закрыть меню' : 'Открыть меню');
    header.classList.add('is-solid');
  });
  nav.addEventListener('click', function (e) { if (e.target.closest('a')) closeMenu(); });

  /* ---- Active nav item ---- */
  var links = $$('.nav a');
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
    }, { rootMargin: '0px 0px -12% 0px' });
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

  /* ---- Warm up images inside tabs before the visitor reaches them ---- */
  if ('IntersectionObserver' in window) {
    var warm = new IntersectionObserver(function (es) {
      es.forEach(function (en) {
        if (!en.isIntersecting) return;
        $$('img[loading="lazy"]', en.target).forEach(function (im) {
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
    if (scene && !reduce) {
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
      if (focus) tab.focus();
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
      btns.forEach(function (b) {
        var on = b === btn;
        b.setAttribute('aria-expanded', String(on));
        document.getElementById(b.getAttribute('aria-controls')).hidden = !on;
      });
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
    last = trigger;
    mTitle.textContent = label === 'Связаться' ? 'Обсудить проект' : label;
    mForm.elements.source.value = label;
    $('.form__status', mForm).hidden = true;
    if (modal.showModal) modal.showModal(); else modal.setAttribute('open', '');
    document.body.classList.add('no-scroll');
    closeMenu();
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

/* IRONCORE demo — header, menu, tabs, modal, demo form. No dependencies. */
(function () {
  'use strict';

  /* ---- Year ---- */
  document.querySelectorAll('[data-year]').forEach(function (el) { el.textContent = new Date().getFullYear(); });

  /* ---- Header: solid on scroll ---- */
  var header = document.getElementById('header');
  function onScroll() { header.classList.toggle('is-solid', window.scrollY > 24); }
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  /* ---- Mobile menu (basic, final mobile in stage 03) ---- */
  var burger = document.querySelector('.burger');
  var nav = document.getElementById('nav');
  function closeMenu() { nav.classList.remove('is-open'); burger.setAttribute('aria-expanded', 'false'); burger.setAttribute('aria-label', 'Открыть меню'); }
  burger.addEventListener('click', function () {
    var open = !nav.classList.contains('is-open');
    nav.classList.toggle('is-open', open);
    burger.setAttribute('aria-expanded', String(open));
    burger.setAttribute('aria-label', open ? 'Закрыть меню' : 'Открыть меню');
    header.classList.add('is-solid');
  });
  nav.addEventListener('click', function (e) { if (e.target.closest('a')) closeMenu(); });

  /* ---- Active nav link ---- */
  var links = Array.prototype.slice.call(document.querySelectorAll('.nav__list a'));
  var targets = links.map(function (a) { return document.querySelector(a.getAttribute('href')); });
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (!en.isIntersecting) return;
        links.forEach(function (a, i) { a.classList.toggle('is-active', targets[i] === en.target); });
      });
    }, { rootMargin: '-45% 0px -50% 0px' });
    targets.forEach(function (t) { if (t) io.observe(t); });
  }

  /* ---- Tabs (WAI-ARIA, manual activation by click, arrows move + activate) ---- */
  document.querySelectorAll('[data-tabs]').forEach(function (root) {
    var tabs = Array.prototype.slice.call(root.querySelectorAll('[role="tab"]'));
    var vertical = root.querySelector('[role="tablist"]').getAttribute('aria-orientation') === 'vertical';
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
      tab.addEventListener('click', function () { select(tab, false); });
      tab.addEventListener('keydown', function (e) {
        var next = vertical ? 'ArrowDown' : 'ArrowRight';
        var prev = vertical ? 'ArrowUp' : 'ArrowLeft';
        var j = null;
        if (e.key === next) j = (i + 1) % tabs.length;
        else if (e.key === prev) j = (i - 1 + tabs.length) % tabs.length;
        else if (e.key === 'Home') j = 0;
        else if (e.key === 'End') j = tabs.length - 1;
        if (j !== null) { e.preventDefault(); select(tabs[j], true); }
      });
    });
  });

  /* ---- Forms: one template, two instances (inline #contact and modal) ---- */
  var tpl = document.getElementById('form-tpl');
  function mountForm(host, suffix) {
    var frag = tpl.content.cloneNode(true);
    frag.querySelectorAll('[id]').forEach(function (el) { el.id = el.id + suffix; });
    frag.querySelectorAll('label[for]').forEach(function (el) { el.htmlFor = el.htmlFor + suffix; });
    host.appendChild(frag);
    var form = host.querySelector('form');
    wireForm(form, suffix);
    return form;
  }

  function digits(s) { return (s || '').replace(/\D/g, ''); }

  function wireForm(form, suffix) {
    var name = form.elements.name, phone = form.elements.phone, files = form.elements.files;
    var status = form.querySelector('.form__status');
    var fileList = form.querySelector('.file__list');
    var fileHint = fileList.textContent;

    function setErr(input, show) {
      var err = input.parentNode.querySelector('.field__err');
      input.setAttribute('aria-invalid', show ? 'true' : 'false');
      if (show) input.setAttribute('aria-describedby', err.id); else input.removeAttribute('aria-describedby');
      err.hidden = !show;
    }
    function check() {
      var okName = name.value.trim().length > 0;
      var okPhone = digits(phone.value).length >= 10;
      setErr(name, !okName); setErr(phone, !okPhone);
      return okName ? (okPhone ? null : phone) : name;
    }
    [name, phone].forEach(function (el) {
      el.addEventListener('input', function () { if (el.getAttribute('aria-invalid') === 'true') check(); status.hidden = true; });
    });
    files.addEventListener('change', function () {
      var n = files.files.length;
      fileList.textContent = n ? Array.prototype.map.call(files.files, function (f) { return f.name; }).join(', ') : fileHint;
    });
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var bad = check();
      if (bad) { bad.focus(); status.hidden = true; return; }
      // Demo: no integration yet. Never claim the request was delivered.
      status.innerHTML = 'Демо-режим: заявка <b>не отправлена</b> — форма ещё не подключена к Telegram. ' +
        'Чтобы обсудить проект сейчас, позвоните: <a href="tel:+79284160938">8 (928) 416-09-38</a>.';
      status.hidden = false;
    });
  }

  document.querySelectorAll('[data-form-host="inline"]').forEach(function (h) {
    var f = mountForm(h, '-c');
    f.elements.source.value = 'Форма в разделе «Контакты»';
  });

  /* ---- Modal ---- */
  var modal = document.getElementById('modal');
  var modalForm = mountForm(modal.querySelector('[data-form-host="modal"]'), '-m');
  var modalTitle = document.getElementById('modal-title');
  var lastTrigger = null;

  function openModal(label, trigger) {
    lastTrigger = trigger;
    modalTitle.textContent = label === 'Связаться' ? 'Обсудить проект' : label;
    modalForm.elements.source.value = label;
    modalForm.querySelector('.form__status').hidden = true;
    if (typeof modal.showModal === 'function') modal.showModal(); else modal.setAttribute('open', '');
    document.body.classList.add('no-scroll');
    closeMenu();
    setTimeout(function () { modalForm.elements.name.focus(); }, 30);
  }
  function closeModal() {
    if (typeof modal.close === 'function') modal.close(); else { modal.removeAttribute('open'); onClose(); }
  }
  function onClose() {
    document.body.classList.remove('no-scroll');
    if (lastTrigger) lastTrigger.focus();
  }
  modal.addEventListener('close', onClose);
  modal.addEventListener('click', function (e) {
    if (e.target === modal || e.target.closest('[data-close]')) closeModal();
  });
  document.addEventListener('click', function (e) {
    var t = e.target.closest('[data-modal]');
    if (t) { e.preventDefault(); openModal(t.getAttribute('data-modal'), t); }
  });
})();

<?php
/**
 * Раздел 01 — HERO. Разметка 1:1 со статической версией (index.html).
 * Тексты по docs/content.md. Пути к картинкам — через IC_ASSETS.
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="hero" id="hero" aria-labelledby="hero-title">
  <div class="hero__scene" data-parallax>
    <img decoding="async" src="<?php echo IC_ASSETS; ?>images/hero/hero-overview-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/hero/hero-overview-640w.webp 640w, <?php echo IC_ASSETS; ?>images/hero/hero-overview-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/hero/hero-overview.webp 1672w" sizes="(max-width: 600px) 190vw, (max-width: 960px) 132vw, 78vw" width="1672" height="941" alt="Корпус ЦОД из светлого бетона с ржаво-красными ламелями, рядом контейнерные модули, в разрезе грунта виден заглублённый серверный зал" fetchpriority="high">
    <div class="hero__blur" aria-hidden="true"><i></i><i></i><i></i></div>
    <svg class="hero__lines" viewBox="0 0 1000 563" preserveAspectRatio="none" aria-hidden="true">
      <polyline points="780,128 780,191"/>
      <polyline points="510,349 510,306"/>
      <polyline points="750,484 657,484"/>
    </svg>
    <svg class="hero__lines hero__lines--m" viewBox="0 0 1000 563" preserveAspectRatio="none" aria-hidden="true">
      <polyline points="780,128 780,191"/>
      <polyline points="510,349 510,404"/>
      <polyline points="750,484 750,512 682,512"/>
    </svg>
    <i class="hero__dot" style="left:78%;top:34%"></i>
    <i class="hero__dot" style="left:51%;top:62%"></i>
    <i class="hero__dot" style="left:75%;top:86%"></i>
    <span class="hero__tag hero__tag--c" style="left:78%;top:20%">Наземный корпус</span>
    <span class="hero__tag hero__tag--l" style="left:58.5%;top:52%">Контейнерные модули</span>
    <span class="hero__tag hero__tag--l" style="left:64.5%;top:86%">Заглублённый уровень</span>
  </div>
  <div class="hero__in wrap">
    <h1 class="hero__title" id="hero-title">Защищенность начинается с&nbsp;проекта</h1>
    <p class="hero__lead">Проектируем дата-центры с учетом физических угроз – от выбора площадки и архитектуры до защиты критической инженерной инфраструктуры.</p>
    <div class="hero__cta">
      <button class="btn btn--red" type="button" data-modal="Обсудить проект">Обсудить проект</button>
      <a class="btn btn--line" href="#solutions">Наши решения</a>
    </div>
  </div>
</section>

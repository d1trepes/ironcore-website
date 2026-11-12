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
    <img decoding="async" src="<?php echo IC_ASSETS; ?>images/hero/hero-overview-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/hero/hero-overview-640w.webp 640w, <?php echo IC_ASSETS; ?>images/hero/hero-overview-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/hero/hero-overview.webp 1672w" sizes="(max-width: 600px) 190vw, (max-width: 960px) 132vw, 78vw" width="1672" height="941" alt="Корпус ЦОД в степи, рядом контейнерные модули, в разрезе грунта виден заглублённый серверный зал" fetchpriority="high">
    <svg class="hero__lines" viewBox="0 0 1000 563" preserveAspectRatio="none" aria-hidden="true">
      <polyline points="830,96 830,190"/>
      <polyline points="600,334 600,405 588,405"/>
      <polyline points="728,474 662,474"/>
    </svg>
    <svg class="hero__lines hero__lines--m" viewBox="0 0 1000 563" preserveAspectRatio="none" aria-hidden="true">
      <polyline points="830,96 830,190"/>
      <polyline points="600,334 600,404"/>
      <polyline points="728,474 728,512 682,512"/>
    </svg>
    <i class="hero__dot" style="left:83%;top:33.7%"></i>
    <i class="hero__dot" style="left:60%;top:59.3%"></i>
    <i class="hero__dot" style="left:72.8%;top:84.2%"></i>
    <span class="hero__tag hero__tag--c" style="left:83%;top:14%">Наземный корпус</span>
    <span class="hero__tag hero__tag--l" style="left:58.8%;top:72%">Контейнерные модули</span>
    <span class="hero__tag hero__tag--l" style="left:66.2%;top:84.2%">Заглублённый уровень</span>
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

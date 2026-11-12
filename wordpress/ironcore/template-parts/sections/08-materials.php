<?php
/**
 * Раздел 08 — MATERIALS. Разметка 1:1 со статической версией (index.html).
 * Тексты по docs/content.md. Пути к картинкам — через IC_ASSETS.
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="sec sec--dark" id="materials" aria-labelledby="mat-title">
  <div class="wrap">
    <div class="head">
      <div class="head__text">
        <h2 class="h2" id="mat-title">От идеи к концепции ЦОД</h2>
        <p class="lead">Материалы, которые помогут начать работу над проектом.</p>
      </div>
    </div>
    <div class="docs">
      <article class="doc">
        <div class="doc__img reveal"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/materials/doc-concept-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/materials/doc-concept-640w.webp 640w, <?php echo IC_ASSETS; ?>images/materials/doc-concept-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/materials/doc-concept.webp 1122w" sizes="(max-width: 600px) 100vw, (max-width: 960px) 40vw, 420px" width="1122" height="1402" loading="lazy" alt="Буклет концепции ЦОД и разворот с генпланом"></div>
        <p class="doc__meta">PDF, демонстрационный пример</p>
        <h3>Пример концепции ЦОД</h3>
        <p>Параметры объекта, зонирование, варианты исполнения и принципиальные инженерные решения.</p>
        <button class="btn btn--line" type="button" data-modal="Запросить пример концепции">Запросить пример</button>
      </article>
      <article class="doc">
        <div class="doc__img reveal"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/materials/doc-composition-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/materials/doc-composition-640w.webp 640w, <?php echo IC_ASSETS; ?>images/materials/doc-composition-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/materials/doc-composition.webp 1122w" sizes="(max-width: 600px) 100vw, (max-width: 960px) 40vw, 420px" width="1122" height="1402" loading="lazy" alt="Стопка томов проектной документации и раскрытый лист с планом"></div>
        <p class="doc__meta">PDF, пример проектных решений</p>
        <h3>Состав проектных материалов</h3>
        <p>Что готовится на каждом этапе — от сравнения концепций до проектных решений.</p>
        <button class="btn btn--line" type="button" data-modal="Запросить состав проектных материалов">Запросить состав</button>
      </article>
      <article class="doc">
        <div class="doc__img reveal"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/materials/doc-checklist-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/materials/doc-checklist-640w.webp 640w, <?php echo IC_ASSETS; ?>images/materials/doc-checklist-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/materials/doc-checklist.webp 1122w" sizes="(max-width: 600px) 100vw, (max-width: 960px) 40vw, 420px" width="1122" height="1402" loading="lazy" alt="Чек-лист на планшете"></div>
        <p class="doc__meta">PDF, рабочий чек-лист</p>
        <h3>Чек-лист исходных данных</h3>
        <p>Мощность, площадка, надежность, инфраструктура. Подходит, даже если ТЗ ещё нет.</p>
        <button class="btn btn--line" type="button" data-modal="Запросить чек-лист исходных данных">Запросить чек-лист</button>
      </article>
    </div>
  </div>
</section>

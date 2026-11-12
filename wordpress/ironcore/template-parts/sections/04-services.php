<?php
/**
 * Раздел 04 — SERVICES. Разметка 1:1 со статической версией (index.html).
 * Тексты по docs/content.md. Пути к картинкам — через IC_ASSETS.
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="sec sec--dark" id="services" aria-labelledby="services-title">
  <div class="wrap">
    <div class="head">
      <div class="head__text">
        <h2 class="h2" id="services-title">Проектирование ЦОД – от концепции до проектной документации</h2>
        <p class="lead">Для дата-центров любого масштаба и исполнения.</p>
      </div>
      <button class="btn btn--red" type="button" data-modal="Начать работу над проектом">Начать работу над проектом</button>
    </div>

    <div class="svc" data-svc>
      <div class="svc__media reveal" aria-hidden="true">
        <img decoding="async" src="<?php echo IC_ASSETS; ?>images/services/service-concept-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/services/service-concept-640w.webp 640w, <?php echo IC_ASSETS; ?>images/services/service-concept-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/services/service-concept.webp 1536w" sizes="(max-width: 960px) 100vw, 700px" width="1536" height="1024" loading="lazy" alt="" data-for="sv-p1" class="is-on">
        <img decoding="async" src="<?php echo IC_ASSETS; ?>images/services/service-architecture-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/services/service-architecture-640w.webp 640w, <?php echo IC_ASSETS; ?>images/services/service-architecture-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/services/service-architecture.webp 1536w" sizes="(max-width: 960px) 100vw, 700px" width="1536" height="1024" loading="lazy" alt="" data-for="sv-p2">
        <img decoding="async" src="<?php echo IC_ASSETS; ?>images/interior/interior-hall-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/interior/interior-hall-640w.webp 640w, <?php echo IC_ASSETS; ?>images/interior/interior-hall-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/interior/interior-hall.webp 1672w" sizes="(max-width: 960px) 100vw, 700px" width="1672" height="941" loading="lazy" alt="" data-for="sv-p3">
        <img decoding="async" src="<?php echo IC_ASSETS; ?>images/services/service-security-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/services/service-security-640w.webp 640w, <?php echo IC_ASSETS; ?>images/services/service-security-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/services/service-security.webp 1536w" sizes="(max-width: 960px) 100vw, 700px" width="1536" height="1024" loading="lazy" alt="" data-for="sv-p4">
        <img decoding="async" src="<?php echo IC_ASSETS; ?>images/services/service-modular-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/services/service-modular-640w.webp 640w, <?php echo IC_ASSETS; ?>images/services/service-modular-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/services/service-modular.webp 1536w" sizes="(max-width: 960px) 100vw, 700px" width="1536" height="1024" loading="lazy" alt="" data-for="sv-p5">
        <img decoding="async" src="<?php echo IC_ASSETS; ?>images/services/service-analysis-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/services/service-analysis-640w.webp 640w, <?php echo IC_ASSETS; ?>images/services/service-analysis-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/services/service-analysis.webp 1536w" sizes="(max-width: 960px) 100vw, 700px" width="1536" height="1024" loading="lazy" alt="" data-for="sv-p6">
      </div>
      <div class="svc__list">
        <button class="svc__btn" type="button" id="sv-t1" aria-controls="sv-p1" aria-expanded="true"><b>Разработка концепции ЦОД</b><i>Отправная точка проекта</i></button>
        <div class="svc__panel" id="sv-p1">
          <figure class="svc__pic" aria-hidden="true"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/services/service-concept-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/services/service-concept-640w.webp 640w, <?php echo IC_ASSETS; ?>images/services/service-concept-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/services/service-concept.webp 1536w" sizes="100vw" width="1536" height="1024" loading="lazy" alt=""></figure>
          <p>Основные параметры объекта, сравнение вариантов размещения и исполнения, предварительная оценка площадей, мощности и инфраструктуры.</p>
          <p class="res"><span>Результат</span>Концептуальные решения и исходные параметры для проектирования.</p>
        </div>
        <button class="svc__btn" type="button" id="sv-t2" aria-controls="sv-p2" aria-expanded="false"><b>Архитектурное и конструктивное проектирование</b><i>Здание, планировка и конструкции</i></button>
        <div class="svc__panel" id="sv-p2" hidden>
          <figure class="svc__pic" aria-hidden="true"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/services/service-architecture-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/services/service-architecture-640w.webp 640w, <?php echo IC_ASSETS; ?>images/services/service-architecture-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/services/service-architecture.webp 1536w" sizes="100vw" width="1536" height="1024" loading="lazy" alt=""></figure>
          <p>Функциональное зонирование, планировка, конструктивная схема и взаимное расположение технических помещений.</p>
          <p class="res"><span>Результат</span>Архитектурные и конструктивные проектные решения.</p>
        </div>
        <button class="svc__btn" type="button" id="sv-t3" aria-controls="sv-p3" aria-expanded="false"><b>Проектирование инженерной инфраструктуры</b><i>Электроснабжение, охлаждение и технические системы</i></button>
        <div class="svc__panel" id="sv-p3" hidden>
          <figure class="svc__pic" aria-hidden="true"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/interior/interior-hall-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/interior/interior-hall-640w.webp 640w, <?php echo IC_ASSETS; ?>images/interior/interior-hall-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/interior/interior-hall.webp 1672w" sizes="100vw" width="1672" height="941" loading="lazy" alt=""></figure>
          <p>Электроснабжение, охлаждение, вентиляция, водоснабжение и водоотведение, другие системы по составу работ.</p>
          <p class="res"><span>Результат</span>Увязанные между собой инженерные решения и разделы документации.</p>
        </div>
        <button class="svc__btn" type="button" id="sv-t4" aria-controls="sv-p4" aria-expanded="false"><b>Проектирование с учетом физической защищенности</b><i>Уязвимости, зонирование и конструктивные решения</i></button>
        <div class="svc__panel" id="sv-p4" hidden>
          <figure class="svc__pic" aria-hidden="true"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/services/service-security-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/services/service-security-640w.webp 640w, <?php echo IC_ASSETS; ?>images/services/service-security-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/services/service-security.webp 1536w" sizes="100vw" width="1536" height="1024" loading="lazy" alt=""></figure>
          <p>Угрозы учитываем при выборе площадки, планировке, размещении критических помещений и технических доступов. Заглубление — когда оно обосновано.</p>
          <p class="res"><span>Результат</span>Решения под согласованные требования к физической безопасности.</p>
        </div>
        <button class="svc__btn" type="button" id="sv-t5" aria-controls="sv-p5" aria-expanded="false"><b>Проектирование модульных и контейнерных ЦОД</b><i>Альтернативные форматы размещения</i></button>
        <div class="svc__panel" id="sv-p5" hidden>
          <figure class="svc__pic" aria-hidden="true"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/services/service-modular-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/services/service-modular-640w.webp 640w, <?php echo IC_ASSETS; ?>images/services/service-modular-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/services/service-modular.webp 1536w" sizes="100vw" width="1536" height="1024" loading="lazy" alt=""></figure>
          <p>Размещение оборудования, коммуникаций, технических зон и подключений к внешней инфраструктуре.</p>
          <p class="res"><span>Результат</span>Проектная концепция или документация для выбранного формата.</p>
        </div>
        <button class="svc__btn" type="button" id="sv-t6" aria-controls="sv-p6" aria-expanded="false"><b>Анализ исходных решений и проектной документации</b><i>Проверка перед дальнейшими этапами</i></button>
        <div class="svc__panel" id="sv-p6" hidden>
          <figure class="svc__pic" aria-hidden="true"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/services/service-analysis-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/services/service-analysis-640w.webp 640w, <?php echo IC_ASSETS; ?>images/services/service-analysis-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/services/service-analysis.webp 1536w" sizes="100vw" width="1536" height="1024" loading="lazy" alt=""></figure>
          <p>Анализ требований и материалов, поиск несогласованностей, оценка проектных альтернатив.</p>
          <p class="res"><span>Результат</span>Перечень замечаний, выводы и рекомендации.</p>
        </div>
      </div>
    </div>
  </div>
</section>

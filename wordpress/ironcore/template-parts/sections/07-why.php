<?php
/**
 * Раздел 07 — WHY. Разметка 1:1 со статической версией (index.html).
 * Тексты по docs/content.md. Пути к картинкам — через IC_ASSETS.
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="sec sec--light" id="why" aria-labelledby="why-title">
  <div class="wrap">
    <h2 class="h2 h2--xl" id="why-title">Инженерная логика вместо решений по&nbsp;умолчанию</h2>
    <div class="why">
      <div class="why__row">
        <h3>Сравниваем варианты, а не продвигаем один формат</h3>
        <p>Классический, модульный, контейнерный или подземный — выбор зависит от мощности, площадки, защищенности и развития объекта.</p>
        <p class="why__get">Вы получаете сравнение концепций, их преимущества и ограничения.</p>
      </div>
      <div class="why__row">
        <h3>Обосновываем инженерные решения</h3>
        <p>Резервирование, охлаждение, электроснабжение и физическую защиту увязываем между собой, а не рассматриваем по отдельности.</p>
        <p class="why__get">Вы понимаете допущения и ограничения до принятия решения.</p>
      </div>
      <div class="why__row">
        <h3>Делаем процесс понятным</h3>
        <p>Состав работ, этапы и точки согласования известны с начала. Изменения требований видны и учитываются.</p>
        <p class="why__get">Вы видите, что уже решено и что требует уточнения.</p>
      </div>
      <div class="why__row">
        <h3>Учитываем эксплуатацию, а не только запуск</h3>
        <p>Доступ к оборудованию, обслуживание, сценарии отказов и рост IT-нагрузки.</p>
        <p class="why__get">Вы заранее знаете последствия схемы для развития объекта.</p>
      </div>
    </div>
  </div>
</section>

<section class="band" aria-labelledby="band-title">
  <img decoding="async" class="band__bg" src="<?php echo IC_ASSETS; ?>images/formats/format-classic-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/formats/format-classic-640w.webp 640w, <?php echo IC_ASSETS; ?>images/formats/format-classic-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/formats/format-classic.webp 1448w" sizes="100vw" width="1448" height="1086" loading="lazy" alt="">
  <div class="wrap band__in">
    <h2 class="band__title" id="band-title" data-lines>
      <span>Начинаем с требований.</span>
      <span>Обосновываем решения.</span>
      <span>Согласуем результат.</span>
    </h2>
    <div class="band__side">
      <p>Расскажите о задаче и исходных параметрах. Определим, какие варианты рассмотреть и какие данные нужны для предварительной концепции.</p>
      <button class="btn btn--red" type="button" data-modal="Запросить предварительную концепцию">Запросить предварительную концепцию</button>
    </div>
  </div>
</section>

<?php
/**
 * Раздел 03 — SOLUTIONS. Разметка 1:1 со статической версией (index.html).
 * Тексты по docs/content.md. Пути к картинкам — через IC_ASSETS.
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="sec sec--light" id="solutions" aria-labelledby="solutions-title">
  <div class="wrap">
    <div class="head">
      <div class="head__text">
        <h2 class="h2" id="solutions-title">ЦОД под разные задачи и масштабы</h2>
        <p class="lead">Подбираем концепцию под IT-мощность, количество стоек, площадь, условия площадки и требования к защищенности.</p>
      </div>
      <button class="btn btn--red" type="button" data-modal="Подобрать решение для ЦОД">Подобрать решение для ЦОД</button>
    </div>

    <div class="scale" data-tabs>
      <div class="picker" role="tablist" aria-label="Типовые концепции">
        <button role="tab" id="sc-t1" aria-controls="sc-p1" aria-selected="true"><b>Компактный ЦОД</b><span>0,5–1,5 МВт, 50–150 стоек</span></button>
        <button role="tab" id="sc-t2" aria-controls="sc-p2" aria-selected="false" tabindex="-1"><b>ЦОД среднего масштаба</b><span>1,5–5 МВт, 150–500 стоек</span></button>
        <button role="tab" id="sc-t3" aria-controls="sc-p3" aria-selected="false" tabindex="-1"><b>Крупный ЦОД или кампус</b><span>5–15 МВт, 500–1 500 стоек</span></button>
      </div>
      <div class="scale__panel" role="tabpanel" id="sc-p1" aria-labelledby="sc-t1">
        <figure class="scale__img"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/concepts/scale-compact-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/concepts/scale-compact-640w.webp 640w, <?php echo IC_ASSETS; ?>images/concepts/scale-compact-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/concepts/scale-compact.webp 1122w" sizes="(max-width: 960px) 100vw, 720px" width="1122" height="1402" loading="lazy" alt="Компактный одноэтажный корпус ЦОД с ДГУ и трансформатором"></figure>
        <div class="scale__info">
          <p class="tag">Концепция</p>
          <h3 class="h3">Компактный ЦОД</h3>
          <p class="scale__desc">Для частной инфраструктуры, корпоративных IT-систем и локальных вычислительных задач.</p>
          <dl class="figs">
            <div><dt>Площадь здания</dt><dd>1&nbsp;000–2&nbsp;500<small>м²</small></dd></div>
            <div><dt>IT-мощность</dt><dd>0,5–1,5<small>МВт</small></dd></div>
            <div><dt>Количество</dt><dd>50–150<small>стоек</small></dd></div>
          </dl>
          <p class="scale__fmt"><span>Возможные форматы</span>Классическое здание, модульное исполнение, контейнерная конфигурация.</p>
        </div>
      </div>
      <div class="scale__panel" role="tabpanel" id="sc-p2" aria-labelledby="sc-t2" hidden>
        <figure class="scale__img"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/concepts/scale-medium-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/concepts/scale-medium-640w.webp 640w, <?php echo IC_ASSETS; ?>images/concepts/scale-medium-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/concepts/scale-medium.webp 1122w" sizes="(max-width: 960px) 100vw, 720px" width="1122" height="1402" loading="lazy" alt="Двухэтажный корпус ЦОД с площадкой ДГУ и резервной площадкой под расширение"></figure>
        <div class="scale__info">
          <p class="tag">Концепция</p>
          <h3 class="h3">ЦОД среднего масштаба</h3>
          <p class="scale__desc">Для корпоративных платформ, размещения IT-инфраструктуры и коммерческих сервисов.</p>
          <dl class="figs">
            <div><dt>Площадь здания</dt><dd>3&nbsp;000–8&nbsp;000<small>м²</small></dd></div>
            <div><dt>IT-мощность</dt><dd>1,5–5<small>МВт</small></dd></div>
            <div><dt>Количество</dt><dd>150–500<small>стоек</small></dd></div>
          </dl>
          <p class="scale__fmt"><span>Возможные форматы</span>Отдельное здание, поэтапно развиваемый комплекс, модульная структура.</p>
        </div>
      </div>
      <div class="scale__panel" role="tabpanel" id="sc-p3" aria-labelledby="sc-t3" hidden>
        <figure class="scale__img"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/concepts/scale-campus-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/concepts/scale-campus-640w.webp 640w, <?php echo IC_ASSETS; ?>images/concepts/scale-campus-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/concepts/scale-campus.webp 1122w" sizes="(max-width: 960px) 100vw, 720px" width="1122" height="1402" loading="lazy" alt="Кампус ЦОД: три корпуса, подстанция и фундамент следующей очереди"></figure>
        <div class="scale__info">
          <p class="tag">Концепция</p>
          <h3 class="h3">Крупный ЦОД или кампус</h3>
          <p class="scale__desc">Для масштабной цифровой инфраструктуры, крупных нагрузок и последовательного наращивания мощностей.</p>
          <dl class="figs">
            <div><dt>Площадь здания</dt><dd>10&nbsp;000–30&nbsp;000<small>м²</small></dd></div>
            <div><dt>IT-мощность</dt><dd>5–15<small>МВт</small></dd></div>
            <div><dt>Количество</dt><dd>500–1&nbsp;500<small>стоек</small></dd></div>
          </dl>
          <p class="scale__fmt"><span>Возможные форматы</span>Несколько зданий, очереди строительства, сочетание капитальных и модульных решений.</p>
        </div>
      </div>
    </div>

    <div class="formats-head">
      <h3 class="h2" id="formats-title">Форматы размещения</h3>
      <p class="lead">Масштаб не определяет формат. Сравниваем варианты под условия площадки.</p>
    </div>
    <div class="formats">
      <figure class="format">
        <div class="format__img reveal"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/formats/format-classic-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/formats/format-classic-640w.webp 640w, <?php echo IC_ASSETS; ?>images/formats/format-classic-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/formats/format-classic.webp 1448w" sizes="(max-width: 600px) 100vw, (max-width: 960px) 50vw, 320px" width="1448" height="1086" loading="lazy" alt="Капитальное здание ЦОД"></div>
        <figcaption><b>Классический</b>Отдельное здание: архитектура, конструкции и инженерия в одной концепции.</figcaption>
      </figure>
      <figure class="format">
        <div class="format__img reveal"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/formats/format-modular-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/formats/format-modular-640w.webp 640w, <?php echo IC_ASSETS; ?>images/formats/format-modular-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/formats/format-modular.webp 1448w" sizes="(max-width: 600px) 100vw, (max-width: 960px) 50vw, 320px" width="1448" height="1086" loading="lazy" alt="Ряд модулей ЦОД и площадка под следующий модуль"></div>
        <figcaption><b>Модульный</b>Объект из функциональных модулей с поэтапным развитием, если его подтверждают требования.</figcaption>
      </figure>
      <figure class="format">
        <div class="format__img reveal"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/formats/format-container-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/formats/format-container-640w.webp 640w, <?php echo IC_ASSETS; ?>images/formats/format-container-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/formats/format-container.webp 1448w" sizes="(max-width: 600px) 100vw, (max-width: 960px) 50vw, 320px" width="1448" height="1086" loading="lazy" alt="Контейнерные модули ЦОД на бетонной площадке"></div>
        <figcaption><b>Контейнерный</b>Оборудование в контейнерных блоках с учетом транспортировки, обслуживания, климата и подключений.</figcaption>
      </figure>
      <figure class="format">
        <div class="format__img reveal"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/formats/format-underground-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/formats/format-underground-640w.webp 640w, <?php echo IC_ASSETS; ?>images/formats/format-underground-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/formats/format-underground.webp 1448w" sizes="(max-width: 600px) 100vw, (max-width: 960px) 50vw, 320px" width="1448" height="1086" loading="lazy" alt="Обвалованный ЦОД: въездной портал и разрез с серверным залом"></div>
        <figcaption><b>Подземный</b>Когда заглубление обосновано оценкой рисков, геологией, гидрогеологией и расчетами.</figcaption>
      </figure>
    </div>
  </div>
</section>

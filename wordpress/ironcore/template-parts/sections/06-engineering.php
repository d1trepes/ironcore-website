<?php
/**
 * Раздел 06 — ENGINEERING. Разметка 1:1 со статической версией (index.html).
 * Тексты по docs/content.md. Пути к картинкам — через IC_ASSETS.
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="sec sec--dark" id="engineering" aria-labelledby="eng-title">
  <div class="wrap">
    <div class="head">
      <div class="head__text">
        <h2 class="h2" id="eng-title">Инженерные решения, рассчитанные на работу ЦОД</h2>
        <p class="lead">Основные параметры определяем на стадии концепции и уточняем при проектировании.</p>
      </div>
      <button class="btn btn--red" type="button" data-modal="Отправить исходные данные">Отправить исходные данные</button>
    </div>

    <div class="eng" data-tabs>
      <div class="picker picker--dark" role="tablist" aria-label="Инженерные направления">
        <button role="tab" id="en-t1" aria-controls="en-p1" aria-selected="true"><b>Электроснабжение</b><span>UPS, ДГУ, схемы A/B, автономность</span></button>
        <button role="tab" id="en-t2" aria-controls="en-p2" aria-selected="false" tabindex="-1"><b>Охлаждение</b><span>кВт на стойку, воздушное и жидкостное</span></button>
        <button role="tab" id="en-t3" aria-controls="en-p3" aria-selected="false" tabindex="-1"><b>Резервирование</b><span>N, N+1, 2N, отказные сценарии</span></button>
        <button role="tab" id="en-t4" aria-controls="en-p4" aria-selected="false" tabindex="-1"><b>Энергоэффективность</b><span>PUE, частичные режимы</span></button>
      </div>

      <div class="eng__panel" role="tabpanel" id="en-p1" aria-labelledby="en-t1">
        <figure class="eng__img reveal"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/engineering/eng-power-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/engineering/eng-power-640w.webp 640w, <?php echo IC_ASSETS; ?>images/engineering/eng-power-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/engineering/eng-power.webp 1536w" sizes="(max-width: 960px) 100vw, 700px" width="1536" height="1024" loading="lazy" alt="Электрощитовая ЦОД: два ряда шкафов ИБП и аккумуляторных стеллажей, отдельные лотки для каждого пути"></figure>
        <div class="eng__body">
          <p class="eng__lead">Схема от внешнего источника до стойки: UPS, ДГУ, распределение и независимые пути питания A/B.</p>
          <dl class="big">
            <div><dd>1,2<small>МВт</small></dd><dt>Пример IT-нагрузки</dt></div>
            <div><dd>10<small>мин</small></dd><dt>Условная автономия UPS</dt></div>
          </dl>
          <p class="eng__note">Полную нагрузку объекта при 1,2&nbsp;МВт IT считаем отдельно: с охлаждением, потерями и вспомогательными системами. 10 минут UPS — исходное требование.</p>
          <p class="eng__calc">Рассчитываем: IT-нагрузку, схему A/B, конфигурацию UPS и время автономии, мощность ДГУ, время запуска и запас топлива.</p>
        </div>
      </div>

      <div class="eng__panel" role="tabpanel" id="en-p2" aria-labelledby="en-t2" hidden>
        <figure class="eng__img"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/engineering/eng-cooling-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/engineering/eng-cooling-640w.webp 640w, <?php echo IC_ASSETS; ?>images/engineering/eng-cooling-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/engineering/eng-cooling.webp 1536w" sizes="(max-width: 960px) 100vw, 700px" width="1536" height="1024" loading="lazy" alt="Кровля ЦОД: два ряда сухих охладителей с трубопроводами"></figure>
        <div class="eng__body">
          <p class="eng__lead">Отвод тепла с учётом плотности нагрузки, планировки залов, климата и требований производителей оборудования.</p>
          <p class="formula">100 <small>стоек</small> × 12 <small>кВт</small> = 1,2 <small>МВт IT-нагрузки</small></p>
          <p class="eng__note">Для оценки принимается, что почти вся потребляемая IT-оборудованием энергия превращается в тепло. Итоговая мощность системы охлаждения определяется отдельным расчетом.</p>
          <p class="eng__calc">Рассматриваем: воздушное охлаждение с изоляцией горячих и холодных коридоров, жидкостное — для высокоплотного оборудования, резерв холода, сезонные режимы и обслуживание.</p>
        </div>
      </div>

      <div class="eng__panel" role="tabpanel" id="en-p3" aria-labelledby="en-t3" hidden>
        <figure class="eng__img"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/engineering/eng-redundancy-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/engineering/eng-redundancy-640w.webp 640w, <?php echo IC_ASSETS; ?>images/engineering/eng-redundancy-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/engineering/eng-redundancy.webp 1536w" sizes="(max-width: 960px) 100vw, 700px" width="1536" height="1024" loading="lazy" alt="Четыре одинаковых дизель-генератора в ряд у корпуса ЦОД"></figure>
        <div class="eng__body">
          <p class="eng__lead">Проверяем, как объект работает при отказе компонента и что можно обслуживать без остановки нагрузки.</p>
          <div class="red">
            <div class="red__col"><b>N</b><span class="mods" aria-hidden="true"><i></i><i></i><i></i></span><p><strong>3 модуля</strong>Без резерва</p></div>
            <div class="red__col"><b>N+1</b><span class="mods" aria-hidden="true"><i></i><i></i><i></i><i class="sp"></i></span><p><strong>4 модуля</strong>Один резервный</p></div>
            <div class="red__col"><b>2N</b><span class="mods" aria-hidden="true"><i></i><i></i><i></i><u></u><i class="b"></i><i class="b"></i><i class="b"></i></span><p><strong>2 × 3 модуля</strong>Две независимые системы</p></div>
          </div>
          <p class="key"><i class="k1"></i>рабочий модуль 400 кВт<i class="k3"></i>резервный</p>
          <p class="eng__note">Пример: нагрузка 1,2&nbsp;МВт, модули по 400&nbsp;кВт. Конкретная схема зависит от характеристик оборудования и требований к доступности.</p>
        </div>
      </div>

      <div class="eng__panel" role="tabpanel" id="en-p4" aria-labelledby="en-t4" hidden>
        <figure class="eng__img"><img decoding="async" src="<?php echo IC_ASSETS; ?>images/interior/interior-hall-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/interior/interior-hall-640w.webp 640w, <?php echo IC_ASSETS; ?>images/interior/interior-hall-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/interior/interior-hall.webp 1672w" sizes="(max-width: 960px) 100vw, 700px" width="1672" height="941" loading="lazy" alt="Серверный зал: ряды стоек и кабельные лотки"></figure>
        <div class="eng__body">
          <p class="formula formula--pue">PUE = <span class="frac"><span>Энергия ЦОД</span><span>Энергия IT</span></span></p>
          <table class="pue">
            <caption>Условный расчет при IT-нагрузке 1 МВт</caption>
            <thead><tr><th scope="col">PUE</th><th scope="col">Полная мощность</th><th scope="col"><span class="sr">Состав нагрузки</span></th></tr></thead>
            <tbody>
              <tr><td>1,3</td><td>1,3 МВт</td><td><span class="bar" style="--v:1.3"><i></i></span></td></tr>
              <tr><td>1,5</td><td>1,5 МВт</td><td><span class="bar" style="--v:1.5"><i></i></span></td></tr>
              <tr><td>1,8</td><td>1,8 МВт</td><td><span class="bar" style="--v:1.8"><i></i></span></td></tr>
            </tbody>
          </table>
          <p class="key"><i class="k1"></i>IT-нагрузка<i class="k2"></i>инженерные системы и потери</p>
          <p class="eng__note">Значения PUE приведены исключительно для демонстрации расчёта. Фактический показатель зависит от климата, нагрузки, архитектуры объекта и методики измерения. Целевой PUE задается и проверяется для конкретного проекта.</p>
        </div>
      </div>
    </div>
  </div>
</section>

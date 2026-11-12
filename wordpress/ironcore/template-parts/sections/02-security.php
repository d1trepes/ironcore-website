<?php
/**
 * Раздел 02 — SECURITY. Разметка 1:1 со статической версией (index.html).
 * Тексты по docs/content.md. Пути к картинкам — через IC_ASSETS.
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="sec sec--dark" id="security" aria-labelledby="security-title">
  <div class="wrap">
    <div class="head">
      <div class="head__text">
        <h2 class="h2" id="security-title">Закладываем в проект физическую безопасность</h2>
        <p class="lead">Шесть рисков, которые мы учитываем с первого эскиза. Нажмите на точку на разрезе.</p>
      </div>
      <button class="btn btn--red" type="button" data-modal="Обсудить требования к защищенности">Обсудить требования</button>
    </div>

    <div class="atlas" data-atlas>
      <figure class="atlas__img reveal">
        <img decoding="async" src="<?php echo IC_ASSETS; ?>images/security/security-cutaway-1024w.webp" srcset="<?php echo IC_ASSETS; ?>images/security/security-cutaway-640w.webp 640w, <?php echo IC_ASSETS; ?>images/security/security-cutaway-1024w.webp 1024w, <?php echo IC_ASSETS; ?>images/security/security-cutaway.webp 1672w" sizes="(max-width: 960px) 100vw, (max-width: 1200px) 60vw, 860px" width="1672" height="941" loading="lazy" alt="Разрез площадки ЦОД: ограждение и КПП, корпус со вскрытым серверным залом, заглублённый уровень с гидроизоляцией, кабельные траншеи и люк">
        <button class="pin" type="button" style="left:16%;top:53%" data-risk="0" aria-label="1. Несанкционированный доступ">1</button>
        <button class="pin" type="button" style="left:56.5%;top:47%" data-risk="1" aria-label="2. Физическое воздействие на здание">2</button>
        <button class="pin" type="button" style="left:13%;top:22%" data-risk="2" aria-label="3. Уязвимость расположения">3</button>
        <button class="pin" type="button" style="left:90%;top:66%" data-risk="3" aria-label="4. Повреждение инженерной инфраструктуры">4</button>
        <button class="pin" type="button" style="left:66%;top:73%" data-risk="4" aria-label="5. Вода, пожар и внешние факторы">5</button>
        <button class="pin" type="button" style="left:44%;top:56.5%" data-risk="5" aria-label="6. Технические и сервисные зоны">6</button>
      </figure>

      <ol class="legend">
        <li>
          <button class="legend__btn" type="button" data-risk="0" aria-expanded="true" aria-controls="risk-0"><span>1</span>Несанкционированный доступ</button>
          <div class="legend__body" id="risk-0">
            <p><b>Риск</b>Посторонние в критических зонах.</p>
            <p><b>В проекте</b>Зонирование территории и здания, контролируемые входы, раздельные служебные и технические маршруты, места под системы доступа и наблюдения.</p>
          </div>
        </li>
        <li>
          <button class="legend__btn" type="button" data-risk="1" aria-expanded="false" aria-controls="risk-1"><span>2</span>Физическое воздействие на здание</button>
          <div class="legend__body" id="risk-1" hidden>
            <p><b>Риск</b>Повреждение конструкций и критических помещений.</p>
            <p><b>В проекте</b>Обоснованная конструктивная схема, расчёт на заданные воздействия, размещение критических помещений по оценке рисков.</p>
          </div>
        </li>
        <li>
          <button class="legend__btn" type="button" data-risk="2" aria-expanded="false" aria-controls="risk-2"><span>3</span>Уязвимость расположения</button>
          <div class="legend__body" id="risk-2" hidden>
            <p><b>Риск</b>Открытая площадка, неблагоприятное окружение.</p>
            <p><b>В проекте</b>Анализ площадки и застройки вокруг. Заглубление или частичное заглубление — там, где оно обосновано условиями проекта.</p>
          </div>
        </li>
        <li>
          <button class="legend__btn" type="button" data-risk="3" aria-expanded="false" aria-controls="risk-3"><span>4</span>Повреждение инженерной инфраструктуры</button>
          <div class="legend__body" id="risk-3" hidden>
            <p><b>Риск</b>Отказ электроснабжения, охлаждения, коммуникаций.</p>
            <p><b>В проекте</b>Анализ критических зависимостей, разнесение трасс и резервирование по требованиям к надежности.</p>
          </div>
        </li>
        <li>
          <button class="legend__btn" type="button" data-risk="4" aria-expanded="false" aria-controls="risk-4"><span>5</span>Вода, пожар и внешние факторы</button>
          <div class="legend__body" id="risk-4" hidden>
            <p><b>Риск</b>Затопление, проникновение воды, пожар.</p>
            <p><b>В проекте</b>Оценка природных и техногенных рисков, водоотведение и гидроизоляция, противопожарные мероприятия.</p>
          </div>
        </li>
        <li>
          <button class="legend__btn" type="button" data-risk="5" aria-expanded="false" aria-controls="risk-5"><span>6</span>Технические и сервисные зоны</button>
          <div class="legend__body" id="risk-5" hidden>
            <p><b>Риск</b>Доступ через технические проходы, кабельные вводы и люки.</p>
            <p><b>В проекте</b>Контролируемые техпомещения, защита вводов и люков, раздельные потоки персонала, посетителей и обслуживания.</p>
          </div>
        </li>
      </ol>
    </div>
  </div>
</section>

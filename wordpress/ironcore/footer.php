<?php
/**
 * Footer, shared modal and the form template (cloned by JS into #contact and the modal).
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;

$ic_messengers = ic_messengers();
$ic_requisites = ic_opt( 'requisites' );
$ic_privacy    = ic_privacy_url();
?>
<footer class="footer">
  <div class="wrap footer__top">
    <div class="footer__brand">
      <img src="<?php echo IC_ASSETS; ?>logos/current/ironcore-logo-on-dark.svg" alt="IronCore" width="150" height="34">
      <p>Проектирование ЦОД<br><span lang="en">Data Center Engineering</span></p>
    </div>
    <nav class="footer__col" aria-label="Разделы сайта">
      <p class="footer__label">Разделы</p>
      <ul class="footer__links">
        <?php foreach ( ic_menu_links( 'footer' ) as $ic_l ) : ?>
        <li><a href="<?php echo esc_url( $ic_l['url'] ); ?>"><?php echo esc_html( $ic_l['label'] ); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <div class="footer__col">
      <p class="footer__label">Связаться</p>
      <a class="footer__phone" href="<?php echo esc_attr( ic_phone_href() ); ?>"><?php echo esc_html( ic_phone() ); ?></a>
      <button class="btn btn--red btn--sm" type="button" data-modal="Обсудить проект">Обсудить проект</button>
    </div>
  </div>
  <div class="wrap footer__bottom">
    <span>© IronCore, <?php echo esc_html( wp_date( 'Y' ) ); ?></span>
    <?php if ( $ic_requisites || $ic_messengers || $ic_privacy ) : ?>
    <span class="footer__legal">
      <?php
      $ic_bits = array();
      if ( $ic_requisites ) {
          $ic_bits[] = nl2br( esc_html( $ic_requisites ) );
      }
      foreach ( $ic_messengers as $ic_m ) {
          $ic_bits[] = '<a href="' . esc_url( $ic_m['url'] ) . '" target="_blank" rel="noopener">' . esc_html( $ic_m['label'] ) . '</a>';
      }
      if ( $ic_privacy ) {
          $ic_bits[] = '<a href="' . esc_url( $ic_privacy ) . '">Политика обработки персональных данных</a>';
      }
      echo implode( ' · ', $ic_bits ); // phpcs:ignore -- escaped above.
      ?>
    </span>
    <?php else : ?>
    <span>Реквизиты компании и мессенджеры будут добавлены</span>
    <?php endif; ?>
  </div>
</footer>

<dialog class="modal" id="modal" aria-labelledby="modal-title">
  <div class="modal__box">
    <button class="modal__close" type="button" data-close aria-label="Закрыть"><svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4,4 16,16 M16,4 4,16"/></svg></button>
    <h2 class="modal__title" id="modal-title">Обсудить проект</h2>
    <div data-form-host="modal"></div>
  </div>
</dialog>

<template id="form-tpl">
  <form class="form" novalidate>
    <input type="hidden" name="source" value="">
    <div class="form__hp" aria-hidden="true">
      <label for="f-website">Не заполняйте это поле</label>
      <input id="f-website" name="website" type="text" tabindex="-1" autocomplete="off">
    </div>
    <div class="field">
      <input id="f-name" name="name" type="text" autocomplete="name" required placeholder=" " maxlength="120">
      <label for="f-name">Имя<span aria-hidden="true"> *</span></label>
      <p class="field__err" hidden>Укажите имя</p>
    </div>
    <div class="field">
      <input id="f-phone" name="phone" type="tel" autocomplete="tel" inputmode="tel" required placeholder=" " maxlength="30">
      <label for="f-phone">Телефон<span aria-hidden="true"> *</span></label>
      <p class="field__err" hidden>Укажите телефон, не меньше 10 цифр</p>
    </div>
    <div class="field">
      <textarea id="f-comment" name="comment" rows="3" placeholder=" " maxlength="5000"></textarea>
      <label for="f-comment">Комментарий</label>
    </div>
    <div class="chips" role="group" aria-labelledby="f-chips">
      <p class="chips__label" id="f-chips">Что известно о проекте? Нажмите, чтобы добавить в комментарий</p>
      <button class="chip" type="button" data-chip="IT-мощность, МВт">IT-мощность, МВт</button>
      <button class="chip" type="button" data-chip="Стойки и нагрузка на стойку, кВт">Стойки и кВт на стойку</button>
      <button class="chip" type="button" data-chip="Резервирование электроснабжения и охлаждения">Резервирование</button>
      <button class="chip" type="button" data-chip="Автономность при отключении внешнего электроснабжения">Автономность</button>
      <button class="chip" type="button" data-chip="Очереди развития и условия площадки">Очереди и площадка</button>
    </div>
    <label class="file" for="f-files">
      <input id="f-files" name="files[]" type="file" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.odt,.ods,.jpg,.jpeg,.png,.zip">
      <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20,12 12.5,19.5A5,5 0 0 1 5.5,12.5L13,5A3.3,3.3 0 0 1 17.7,9.7L10.3,17A1.7,1.7 0 0 1 7.9,14.6L14.5,8"/></svg>
      <span class="file__list">Прикрепить файлы: ТЗ, схемы, исходные данные</span>
    </label>
    <?php if ( $ic_privacy ) : ?>
    <div class="consent">
      <input id="f-consent" name="consent" type="checkbox" value="1" required>
      <label for="f-consent">Согласен на обработку персональных данных в соответствии с <a href="<?php echo esc_url( $ic_privacy ); ?>" target="_blank" rel="noopener">политикой</a></label>
      <p class="field__err" hidden>Нужно согласие на обработку данных</p>
    </div>
    <?php endif; ?>
    <button class="btn btn--red btn--block" type="submit">Отправить заявку</button>
    <div class="form__status" role="status" aria-live="polite" hidden></div>
  </form>
</template>

<?php wp_footer(); ?>
</body>
</html>

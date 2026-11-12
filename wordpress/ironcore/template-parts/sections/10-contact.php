<?php
/**
 * Раздел 10 — CONTACT. Разметка 1:1 со статической версией (index.html).
 * Тексты по docs/content.md. Пути к картинкам — через IC_ASSETS.
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="sec sec--dark contact" id="contact" aria-labelledby="contact-title">
  <div class="wrap contact__grid">
    <div class="contact__text">
      <h2 class="h2" id="contact-title">Расскажите о задаче. Определим, с&nbsp;чего начать</h2>
      <ul class="theses">
        <li>Можно обратиться без готового ТЗ</li>
        <li>Можно начать с предварительной концепции</li>
        <li>Состав работ уточняется под задачу</li>
      </ul>
      <div class="call">
        <span>Удобнее голосом</span>
        <a href="<?php echo esc_attr( ic_phone_href() ); ?>"><?php echo esc_html( ic_phone() ); ?></a>
      </div>
    </div>
    <div class="contact__form" data-form-host="inline"></div>
  </div>
</section>

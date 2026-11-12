<?php
/**
 * Header: logo | centred menu | «Связаться» + mobile drawer.
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip" href="#main">Перейти к содержанию</a>

<header class="header<?php echo is_front_page() ? '' : ' is-solid'; ?>" id="header">
  <div class="header__in wrap">
    <a class="brand" href="<?php echo esc_url( ic_anchor( '#hero' ) ); ?>" aria-label="IronCore, в начало страницы">
      <img src="<?php echo IC_ASSETS; ?>logos/current/ironcore-logo-on-dark.svg" alt="IronCore" width="150" height="34">
    </a>
    <nav class="nav" id="nav" aria-label="Основная навигация">
      <?php ic_menu_anchors( 'primary' ); ?>
    </nav>
    <div class="header__end">
      <button class="btn btn--red btn--sm" type="button" data-modal="Связаться">Связаться</button>
      <button class="burger" type="button" aria-expanded="false" aria-controls="drawer" aria-label="Открыть меню"><span></span><span></span></button>
    </div>
  </div>
</header>

<div class="drawer" id="drawer" hidden>
  <div class="drawer__scrim" data-drawer-close></div>
  <div class="drawer__panel" role="dialog" aria-modal="true" aria-label="Меню">
    <div class="drawer__top">
      <img src="<?php echo IC_ASSETS; ?>logos/current/ironcore-logo-on-dark.svg" alt="" width="150" height="34">
      <button class="drawer__close" type="button" data-drawer-close aria-label="Закрыть меню"><svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4,4 16,16 M16,4 4,16"/></svg></button>
    </div>
    <nav class="drawer__nav" aria-label="Меню разделов">
      <?php ic_menu_anchors( 'primary' ); ?>
    </nav>
    <div class="drawer__end">
      <a class="drawer__phone" href="<?php echo esc_attr( ic_phone_href() ); ?>"><?php echo esc_html( ic_phone() ); ?></a>
      <button class="btn btn--red btn--block" type="button" data-modal="Обсудить проект">Обсудить проект</button>
    </div>
  </div>
</div>

<?php
/**
 * IronCore theme bootstrap.
 *
 * inc/helpers.php    — телефон, якоря, меню, настройки
 * inc/setup.php      — поддержка темы, меню, подключение CSS/JS, <head>
 * inc/customizer.php — Внешний вид → Настроить → «IronCore: контакты и заявки»
 * inc/form.php       — приём заявок (AJAX), тип записи «Заявки», письмо, Telegram
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;

define( 'IC_VERSION', '1.0.0' );
define( 'IC_DIR', get_template_directory() );
define( 'IC_ASSETS', esc_url( get_template_directory_uri() ) . '/assets/' );

require IC_DIR . '/inc/helpers.php';
require IC_DIR . '/inc/setup.php';
require IC_DIR . '/inc/customizer.php';
require IC_DIR . '/inc/form.php';

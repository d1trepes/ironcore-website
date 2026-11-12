<?php
/**
 * 404.
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main" class="inner">
  <div class="wrap inner__in">
    <h1 class="h2 inner__title">Страница не найдена</h1>
    <p class="lead">Возможно, ссылка устарела. Все разделы сайта — на главной странице.</p>
    <p class="inner__actions"><a class="btn btn--red" href="<?php echo esc_url( home_url( '/' ) ); ?>">На главную</a></p>
  </div>
</main>
<?php
get_footer();

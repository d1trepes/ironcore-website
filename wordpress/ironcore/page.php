<?php
/**
 * Ordinary pages (политика обработки ПДн, реквизиты и т. п.).
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main" class="inner">
  <div class="wrap inner__in">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article <?php post_class( 'inner__article' ); ?>>
          <h1 class="h2 inner__title"><?php the_title(); ?></h1>
          <div class="inner__content"><?php the_content(); ?></div>
        </article>
        <?php
    endwhile;
    ?>
  </div>
</main>
<?php
get_footer();

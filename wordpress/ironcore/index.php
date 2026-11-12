<?php
/**
 * Fallback template. The site is a one-pager; blog/archives are not designed.
 * If posts are needed later, add single.php / archive.php in the same style as page.php.
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main" class="inner">
  <div class="wrap inner__in">
    <?php if ( have_posts() ) : ?>
      <?php
      while ( have_posts() ) :
          the_post();
          ?>
          <article <?php post_class( 'inner__article' ); ?>>
            <h1 class="h2 inner__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <div class="inner__content"><?php the_content(); ?></div>
          </article>
      <?php endwhile; ?>
    <?php else : ?>
      <h1 class="h2 inner__title">Ничего не найдено</h1>
      <p class="inner__content"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">На главную</a></p>
    <?php endif; ?>
  </div>
</main>
<?php
get_footer();

<?php
/**
 * Landing page: 11 sections in the approved order.
 * Порядок и состав разделов — docs/page-blueprint.md. Раздел 11 (футер) — footer.php.
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main">

<?php
foreach ( array( '01-hero', '02-security', '03-solutions', '04-services', '05-process', '06-engineering', '07-why', '08-materials', '09-faq', '10-contact' ) as $ic_part ) {
	get_template_part( 'template-parts/sections/' . $ic_part );
}
?>

</main>
<?php
get_footer();

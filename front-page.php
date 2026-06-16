<?php
/**
 * The template for displaying the front page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package era_ai
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php get_template_part( 'template-parts/homepage/hero' ); ?>

		<?php get_template_part( 'template-parts/homepage/posts' ); ?>

		<?php get_template_part( 'template-parts/homepage/filtered-posts' ); ?>

		<?php get_template_part( 'template-parts/homepage/services-promo' ); ?>

	</main><!-- #main -->

<?php
get_footer();

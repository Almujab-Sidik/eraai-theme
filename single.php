<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package era_ai
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'template-parts/single/content', 'post' ); ?>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>

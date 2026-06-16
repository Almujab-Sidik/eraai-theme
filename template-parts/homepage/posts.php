<?php
/**
 * Homepage — latest posts section.
 *
 * Excludes posts in the 'hero' category (already featured in the hero section).
 *
 * @package era_ai
 */

$query = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
?>

<?php if ( $query->have_posts() ) : ?>
<section class="posts-section">
    <div class="wrapper__border">
        <div class="posts-section__inner container">

            <div class="posts-section__header">
                <span class="posts-section__label">Artikel Terbaru</span>
            </div>

            <div class="grid-cards">
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <?php get_template_part( 'template-parts/content', 'card' ); ?>
                <?php endwhile; ?>
            </div>

        </div>
    </div>
</section>
<?php endif; wp_reset_postdata(); ?>

<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package era_ai
 */

get_header();
?>

<main id="primary" class="site-main blog-page">
    
    <!-- ═══ HEADER SECTION ═══ -->
    <section class="blog-hero">
        <div class="wrapper__border">
            <div class="blog-hero__inner container">
                <span class="posts-section__label">Arsip Kategori</span>
                <?php
                the_archive_title( '<h1 class="blog-title">', '</h1>' );
                the_archive_description( '<p class="blog-subheading">', '</p>' );
                ?>
            </div>
        </div>
    </section>

    <!-- ═══ POSTS SECTION ═══ -->
    <section class="blog-posts-section">
        <div class="wrapper__border">
            <div class="blog-posts__inner container">

                <!-- Grid Cards Container -->
                <div class="grid-cards filter-grid">
                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php
                            $post_author      = get_field('author') ?: get_the_author();
                            $post_date        = get_field('publish_date') ?: get_the_date('F j, Y');
                            $post_subheadline = get_field('subheadline');
                            $cats             = get_the_category();
                            $cat_name         = ! empty( $cats ) ? $cats[0]->name : '';
                            ?>

                            <article class="card is-filtered">
                                <a href="<?php the_permalink(); ?>" class="cover">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail('medium_large', ['loading' => 'lazy']); ?>
                                    <?php endif; ?>
                                    <?php if ( $cat_name ) : ?>
                                        <span class="ctag"><?php echo esc_html( $cat_name ); ?></span>
                                    <?php endif; ?>
                                </a>

                                <div class="body">
                                    <h3 class="ttl">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>

                                    <?php if ( $post_subheadline ) : ?>
                                        <p class="dek"><?php echo esc_html( $post_subheadline ); ?></p>
                                    <?php endif; ?>

                                    <div class="byl">
                                        <span><b>oleh <?php echo esc_html( $post_author ); ?></b></span>
                                        <span><?php echo esc_html( $post_date ); ?></span>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p class="error-msg">Belum ada artikel di kategori ini.</p>
                    <?php endif; ?>
                </div>

                <!-- Navigation -->
                <div class="blog-pagination">
                    <?php the_posts_navigation(); ?>
                </div>

            </div>
        </div>
    </section>

</main>

<?php
get_footer();

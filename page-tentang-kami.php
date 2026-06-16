<?php
/**
 * Template Name: Halaman Tentang Kami
 *
 * @package era_ai
 */

get_header();

$headline     = get_field('about_headline') ?: get_the_title();
$subheadline  = get_field('about_subheadline');
$featured_img = get_field('about_featured_image');
$story        = get_field('about_story');
?>

<main id="primary" class="site-main about-page">
    
    <!-- ═══ HEADER SECTION ═══ -->
    <section class="about-hero">
        <div class="wrapper__border">
            <div class="about-hero__inner container">
                <span class="posts-section__label">Tentang Kami</span>
                <h1 class="about-title"><?php echo esc_html( $headline ); ?></h1>
                <?php if ( $subheadline ) : ?>
                    <p class="about-subheading"><?php echo esc_html( $subheadline ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ═══ FEATURED IMAGE SECTION ═══ -->
    <?php if ( $featured_img ) : ?>
        <?php 
        $img_url = is_array( $featured_img ) ? $featured_img['url'] : $featured_img; 
        $img_alt = is_array( $featured_img ) ? $featured_img['alt'] : get_the_title();
        ?>
        <section class="about-featured">
            <div class="wrapper__border">
                <div class="about-featured__inner container">
                    <figure class="about-figure">
                        <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
                    </figure>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- ═══ STORY / CONTENT SECTION ═══ -->
    <?php if ( $story ) : ?>
        <section class="about-story">
            <div class="wrapper__border">
                <div class="about-story__inner container">
                    <div class="about-content prose">
                        <?php echo wp_kses_post( $story ); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php get_template_part( 'template-parts/homepage/services-promo' ); ?>


</main>

<?php
get_footer();

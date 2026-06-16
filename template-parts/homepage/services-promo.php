<?php
/**
 * Homepage — Web development services promotion section.
 *
 * @package era_ai
 */

$grid = 9;

// Query CPT 'cta'
$cta_query = new WP_Query([
    'post_type'      => 'cta',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
]);

if ( $cta_query->have_posts() ) :
    $cta_query->the_post();
    $post_id = get_the_ID();
    
    $promo_label   = get_field('label', $post_id);
    $promo_title   = get_field('headline', $post_id);
    $promo_desc    = get_field('subheadline', $post_id);
    $promo_details = get_field('detail', $post_id); // Repeater
    $promo_link    = get_field('link', $post_id);
    
    wp_reset_postdata();

    $cta_text = 'Konsultasi Gratis via WhatsApp ↗';
    if ( $promo_link && strpos( $promo_link, 'wa.me' ) === false && strpos( $promo_link, 'whatsapp.com' ) === false ) {
        $cta_text = 'Hubungi Kami ↗';
    }
?>

<section class="services-promo-section">
    <div class="wrapper__border">
        <div class="services-promo__container container">
            
            <div class="services-promo__content-left">
                <div class="content-wrapper">
                    <?php if ( $promo_label ) : ?>
                        <span class="posts-section__label"><?php echo esc_html( $promo_label ); ?></span>
                    <?php endif; ?>
                    
                    <?php if ( $promo_title ) : ?>
                        <h2 class="promo-title"><?php echo esc_html( $promo_title ); ?></h2>
                    <?php endif; ?>
                    
                    <?php if ( $promo_desc ) : ?>
                        <p class="promo-desc"><?php echo esc_html( $promo_desc ); ?></p>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $promo_details ) && is_array( $promo_details ) ) : ?>
                        <ul class="promo-usp">
                            <?php foreach ( $promo_details as $item ) : ?>
                                <?php
                                $title = isset( $item['title'] ) ? $item['title'] : '';
                                $desc  = isset( $item['description'] ) ? $item['description'] : '';
                                ?>
                                <?php if ( $title || $desc ) : ?>
                                    <li>
                                        <span class="usp-icon">✦</span>
                                        <div class="usp-text">
                                            <?php if ( $title ) : ?>
                                                <strong><?php echo esc_html( $title ); ?></strong>
                                            <?php endif; ?>
                                            <?php if ( $desc ) : ?>
                                                <span><?php echo esc_html( $desc ); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <?php if ( $promo_link ) : ?>
                    <div class="promo-cta">
                        <a href="<?php echo esc_url( $promo_link ); ?>" class="btn btn--primary" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $cta_text ); ?></a>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Right panel: Interactive Retro Browser Visual -->
            <div class="services-promo__content-right">
                <div class="promo-card-visual">
                    <div class="window-header">
                        <span class="dot red"></span>
                        <span class="dot yellow"></span>
                        <span class="dot green"></span>
                        <span class="window-title">your-website.com</span>
                    </div>
                    <div class="window-body">
                        <div class="visual-line title-line"></div>
                        <div class="visual-line desc-line-1"></div>
                        <div class="visual-line desc-line-2"></div>
                        <div class="visual-grid">
                            <?php for ($i = 0; $i < 9; $i++) { ?>
                                <div class="grid-box"></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php endif; ?>

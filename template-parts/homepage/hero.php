<?php
/**
 * Homepage — Hero section.
 *
 * Fields (SCF): headline, subheadline, author, link_post, banner_hero, publish_date
 *
 * @package era_ai
 */

$hero_headline    = get_field('headline');
$hero_subheadline = get_field('subheadline');
$hero_author      = get_field('author');
$hero_url         = get_field('link_post');
$hero_banner      = get_field('banner_hero');
$hero_date        = get_field('publish_date') ?: '';
?>

<section class="hero">
    <div class="wrapper__border">
        <div class="hero__container container">

            <div class="hero__content-left">
                <div class="content-wrapper">
                    <div class="hero__author">
                        <p class="name"><span>oleh</span> <?php echo esc_html( $hero_author ); ?></p>
                        <p class="date"><?php echo esc_html( $hero_date ); ?></p>
                    </div>
                    <div class="line"></div>
                    <h1 class="hero__headline"><?php echo esc_html( $hero_headline ); ?></h1>
                </div>

                <div class="cta-wrapper">
                    <p class="subheading ornament"><?php echo esc_html( $hero_subheadline ); ?></p>
                    <a href="<?php echo esc_url( $hero_url ); ?>" class="btn btn--primary">Baca Artikel</a>
                </div>
            </div>

            <?php if ( $hero_banner ) : ?>
            <div class="hero__content-right">
                <img src="<?php echo esc_url( $hero_banner ); ?>"
                     alt="<?php echo esc_attr( $hero_headline ); ?>">
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php

/**
 * Template Name: Halaman Jasa Pembuatan Website
 *
 * @package era_ai
 */
get_header();
$hero = get_field('hero_section');
$hero_label = (is_array($hero) && isset($hero['label'])) ? $hero['label'] : '';
$hero_headline = (is_array($hero) && isset($hero['headline'])) ? $hero['headline'] : '';
$hero_subheadline = (is_array($hero) && isset($hero['subheadline'])) ? $hero['subheadline'] : '';

$services = get_field('services_grid');
$service_list = (is_array($services) && isset($services['services_list'])) ? $services['services_list'] : [];

$why_choose_section = get_field('why_choose_section');
$why_choose_label = (is_array($why_choose_section) && isset($why_choose_section['label'])) ? $why_choose_section['label'] : '';
$why_choose_title = (is_array($why_choose_section) && isset($why_choose_section['title'])) ? $why_choose_section['title'] : '';
$why_choose_list = (is_array($why_choose_section) && isset($why_choose_section['list'])) ? $why_choose_section['list'] : '';
?>

<main id="primary" class="site-main services-page">

    <!-- ═══ HERO SECTION ═══ -->
    <section class="services-hero">
        <div class="wrapper__border">
            <div class="services-hero__inner container">
                <?php if (!empty($hero_label)): ?>
                    <span class="posts-section__label"><?php echo esc_html($hero_label); ?></span>
                <?php endif; ?>
                <?php if (!empty($hero_headline)): ?>
                    <h1 class="services-title"><?php echo esc_html($hero_headline); ?></h1>
                <?php endif; ?>
                <?php if (!empty($hero_subheadline)): ?>
                    <p class="services-subheading"><?php echo esc_html($hero_subheadline); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ═══ SERVICES GRID SECTION ═══ -->
    <section class="services-list">
        <div class="wrapper__border">
            <div class="services-grid container">

            <?php if (!empty($service_list)): ?>
                <?php foreach ($service_list as $service): ?>
                    <div class="service-card">
                        <?php if (!empty($service['number'])): ?>
                            <span class="service-num"><?php echo esc_html($service['number']); ?></span>
                        <?php endif; ?>

                        <?php if (!empty($service['title'])): ?>
                            <h3 class="service-name"><?php echo esc_html($service['title']); ?></h3>
                        <?php endif; ?>

                        <?php if (!empty($service['description'])): ?>
                            <p class="service-desc"><?php echo esc_html($service['description']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($service['features']) && is_array($service['features'])): ?>
                            <ul class="service-features">
                                <?php foreach ($service['features'] as $feature): ?>
                                    <?php if (!empty($feature['feature'])): ?>
                                        <li><?php echo esc_html($feature['feature']); ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ═══ WHY US / PROCESS SECTION ═══ -->
    <section class="services-why">
        <div class="wrapper__border">
            <div class="why-inner container">
                
                <div class="why-header">
                    <?php if (!empty($why_choose_label)): ?>
                        <span class="posts-section__label"><?php echo esc_html($why_choose_label); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($why_choose_title)): ?>
                        <h2 class="why-title"><?php echo esc_html($why_choose_title); ?></h2>
                    <?php endif; ?>
                </div>

                <?php if (!empty($why_choose_list)): ?>
                    <div class="why-grid">
                        <?php foreach ($why_choose_list as $list): ?>
                    <div class="why-col">
                        <?php if (!empty($list['title'])): ?>
                        <h4><?php echo esc_html($list['title']) ?></h4>
                        
                            <?php endif; ?>
                            <?php if (!empty($list['description'])): ?>
                            <p><?php echo esc_html($list['description']) ?></p>                        
                            <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ═══ SERVICES PROMO SECTION ═══ -->
    <?php get_template_part('template-parts/homepage/services-promo'); ?>

</main>

<?php
get_footer();

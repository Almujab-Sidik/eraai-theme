<?php

/**
 * Template Name: Halaman Automation
 *
 * @package era_ai
 */

// Hero
$hero = get_field('hero');
$hero_label = $hero['label'];
$hero_heading = $hero['hero_heading'];
$hero_subheading = $hero['hero_subheading'];
$hero_cta_button = $hero['hero_cta_label'];
$hero_cta_url = $hero['hero_cta_link'];

//  Intro
$intro = get_field('intro');
$intro_heading = $intro['intro_heading'];
$intro_subheading = $intro['intro_subheading'];

// Feature
$solution = get_field('solution');

// Quote
$quote = get_field('quote');
$quote_title = $quote['quote_title'];
$quote_subtitle = $quote['quote_subtitle'];
$quote_extra = $quote['quote_extra'];

// CTA
$cta = get_field('cta');
$cta_title = $cta['cta_title'];
$cta_subtitle = $cta['cta_subtitle'];
$cta_button_label = $cta['cta_button_label'];
$cta_btn_url = $cta['cta_button_link'];
get_header();
?>


<main id="primary" class="site-main automation-page">

	<!-- ═══ HERO SECTION ═══ -->
	<section class="automation-hero">
		<div class="wrapper__border">
			<div class="automation-hero__inner container">
				<div class="automation-hero__content">
					<span class="posts-section__label"><?php echo esc_html($hero_label); ?></span>
					<h1 class="automation-title"><?php echo esc_html($hero_heading); ?></h1>
					<p class="automation-subheading"><?php echo esc_html($hero_subheading); ?></p>
					<div class="automation-hero__actions">
						<a href="<?php echo esc_url($hero_cta_url); ?>" class="btn btn--primary">
							<?php echo esc_html($hero_cta_button); ?>
						</a>
					</div>
				</div>

				<div class="automation-hero__image-wrapper">
					<!-- Visual Browser Mockup matching the style of services promo -->
					<div class="promo-card-visual">
						<div class="window-header">
							<span class="dot red"></span>
							<span class="dot yellow"></span>
							<span class="dot green"></span>
							<span class="window-title">workflow_automation.sh</span>
						</div>
						<div class="window-body">
							<div class="visual-line title-line"></div>
							<div class="visual-line desc-line-1"></div>
							<div class="visual-line desc-line-2"></div>
							<div class="visual-grid">
								<div class="grid-box"></div>
								<div class="grid-box"></div>
								<div class="grid-box"></div>
								<div class="grid-box"></div>
								<div class="grid-box"></div>
								<div class="grid-box"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ═══ INTRO SECTION ═══ -->
	<section class="automation-intro">
		<div class="wrapper__border">
			<div class="automation-intro__inner container">
				<h2 class="automation-intro__title"><?php echo esc_html($intro_heading); ?></h2>
				<div class="automation-intro__text prose">
					<p><?php echo esc_html($intro_subheading); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- ═══ FEATURES SECTION ═══ -->
	<section class="automation-features">
		<div class="wrapper__border">
			<div class="automation-features__inner container">
				<h2 class="automation-features__title"><?php echo esc_html($solution['solution_heading']); ?></h2>
				
				<div class="features-grid">
					<?php foreach ($solution['feature_items'] as $feature): ?>
					<div class="feature-card">
						<div class="feature-icon"><?php echo esc_html($feature['item_icon']) ?>
						</div>
						<h3 class="feature-title"><?php echo esc_html($feature['item_title']) ?></h3>
						<p class="feature-desc"><?php echo esc_html($feature['item_subtitle']) ?></p>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- ═══ EXTRA CONTENT SECTION ═══ -->
	<section class="automation-extra">
		<div class="wrapper__border">
			<div class="automation-extra__inner container">
				<h2 class="automation-extra__title"><?php echo esc_html($quote_title); ?></h2>
				<div class="automation-extra__content prose">
					<p><?php echo esc_html($quote_subtitle); ?></p>
					<blockquote>
						<p><?php echo esc_html($quote_extra); ?></p>
					</blockquote>
				</div>
			</div>
		</div>
	</section>

	<!-- ═══ CTA PENUTUP SECTION ═══ -->
	<section class="automation-cta">
		<div class="wrapper__border">
			<div class="automation-cta__inner container">
				<h2 class="automation-cta__title"><?php echo esc_html($cta_title); ?></h2>
				<p class="automation-cta__text"><?php echo esc_html($cta_subtitle); ?></p>
				<div class="automation-cta__action">
					<a href="<?php echo esc_url($cta_btn_url); ?>" class="btn btn--primary">
						<?php echo esc_html($cta_button_label); ?>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- ═══ SERVICES PROMO SECTION ═══ -->
	<?php get_template_part('template-parts/homepage/services-promo'); ?>

</main>

<?php
get_footer();

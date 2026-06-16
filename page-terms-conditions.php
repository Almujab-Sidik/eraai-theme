<?php

/**
 * Template Name: Terms & Conditions
 *
 * @package era_ai
 */
get_header();
?>

<main id="primary" class="site-main legal-page">

	<?php
	while (have_posts()):
		the_post();
		?>
		<!-- ═══ HERO SECTION ═══ -->
		<section class="legal-hero">
			<div class="wrapper__border">
				<div class="legal-hero__inner container">
					<span class="posts-section__label"><?php esc_html_e('Legal', 'era-ai'); ?></span>
					<h1 class="legal-title"><?php the_title(); ?></h1>
					<p class="legal-last-updated">
						<?php
						/* translators: %s: modified date */
						printf(esc_html__('Terakhir diperbarui: %s', 'era-ai'), get_the_modified_date('j F Y'));
						?>
					</p>
				</div>
			</div>
		</section>

		<!-- ═══ CONTENT SECTION ═══ -->
		<section class="legal-body">
			<div class="wrapper__border">
				<div class="legal-body__inner container">
					<div class="legal-content prose">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</section>
		<?php
	endwhile;  // End of the loop.
	?>

</main>

<?php
get_footer();

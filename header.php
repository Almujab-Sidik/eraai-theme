<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package era_ai
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php
	if ( is_front_page() ) {
		$hero_banner = get_field('banner_hero');
		if ( $hero_banner ) {
			$hero_banner_id = attachment_url_to_postid( $hero_banner );
			if ( $hero_banner_id ) {
				$img_src = wp_get_attachment_image_url( $hero_banner_id, 'large' );
				$img_srcset = wp_get_attachment_image_srcset( $hero_banner_id, 'large' );
				// Let's match the standard sizes attribute or use large
				$img_sizes = wp_get_attachment_image_sizes( $hero_banner_id, 'large' );
				
				if ( $img_srcset && $img_sizes ) {
					echo '	<link rel="preload" fetchpriority="high" as="image" href="' . esc_url( $img_src ) . '" imagesrcset="' . esc_attr( $img_srcset ) . '" imagesizes="' . esc_attr( $img_sizes ) . '">' . "\n";
				} else {
					echo '	<link rel="preload" fetchpriority="high" as="image" href="' . esc_url( $img_src ) . '">' . "\n";
				}
			} else {
				echo '	<link rel="preload" fetchpriority="high" as="image" href="' . esc_url( $hero_banner ) . '">' . "\n";
			}
		}
	}
	?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'era-ai'); ?></a>

	<header id="masthead" class="navbar is-top">
		<div class="inner container">

			<?php
			$logo_url = has_custom_logo() ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : '';
			?>
			<a href="<?php echo esc_url(home_url('/')); ?>" class="nb-mini">
				<?php if ($logo_url): ?>
					<img class="mark" src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>">
				<?php endif; ?>
				<?php bloginfo('name'); ?>
			</a>

			<?php
			// Primary nav links
			wp_nav_menu([
				'theme_location' => 'menu-1',
				'container' => 'nav',
				'container_class' => 'nav-links',
				'menu_class' => '',
				'items_wrap' => '%3$s',
				'link_before' => '',
				'link_after' => '',
				'walker' => new Eraai_Navbar_Walker(),
			]);
			?>

			<div class="nb-right">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle menu', 'era-ai'); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="square">
						<line class="line-1" x1="2" y1="7"  x2="18" y2="7"/>
						<line class="line-2" x1="2" y1="13" x2="18" y2="13"/>
					</svg>
				</button>
			</div>

		</div>
	</header><!-- #masthead -->

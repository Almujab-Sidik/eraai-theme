<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package era_ai
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="wrapper__border">
			<div class="footer__inner container">
				
				<!-- Top Part: Newsletter + Columns -->
				<div class="footer-top">
					
					<!-- Left: Newsletter & Socials -->
					<div class="footer-subscribe">
						<h3 class="footer-heading">Era AI</h3>
						<p class="footer-description">Di sini, kami membagikan ulasan ringan seputar dunia kecerdasan buatan, web, dan tren teknologi masa kini agar mudah dinikmati dan dipahami siapa saja.</p>
						
						<div class="footer-contact-info">
							<a href="mailto:info@era-ai.id" class="contact-email">info@eraai.id</a>
						</div>
						
						<div class="footer-socials">
							<a href="https://www.instagram.com/eraai.official/" class="social-icon" aria-label="Instagram">ig</a>
							<a href="https://www.threads.com/@eraai.official?hl=en" class="social-icon" aria-label="Threads">ts</a>
						</div>
					</div>
					
					<!-- Right: Link Columns -->
					<div class="footer-links">
						
						<div class="footer-col">
							<h4>Sitemap</h4>
							<?php
							if (has_nav_menu('footer-sitemap')):
								wp_nav_menu(array(
									'theme_location' => 'footer-sitemap',
									'container' => false,
									'menu_class' => '',
									'fallback_cb' => false,
								));
							else:
								?>
								<ul>
									<li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
									<li><a href="<?php echo esc_url(home_url('/tentang-kami')); ?>">Tentang Kami</a></li>
									<li><a href="<?php echo esc_url(home_url('/artikel')); ?>">Artikel</a></li>
									<li><a href="<?php echo esc_url(home_url('/kontak')); ?>">Hubungi Kami</a></li>
								</ul>
							<?php endif; ?>
						</div>
						
						<div class="footer-col">
							<h4>Layanan</h4>
							<?php
							if (has_nav_menu('footer-layanan')):
								wp_nav_menu(array(
									'theme_location' => 'footer-layanan',
									'container' => false,
									'menu_class' => '',
									'fallback_cb' => false,
								));
							else:
								?>
								<ul>
									<li><a href="<?php echo esc_url(home_url('/jasa-pembuatan-website')); ?>">Jasa Website</a></li>
									<li><a href="<?php echo esc_url(home_url('/automation')); ?>">Automation</a></li>
									<li><a href="<?php echo esc_url(home_url('/konsultasi')); ?>">Konsultasi</a></li>
								</ul>
							<?php endif; ?>
						</div>
						
						<div class="footer-col">
							<h4>Kategori</h4>
							<?php
							if (has_nav_menu('footer-kategori')):
								wp_nav_menu(array(
									'theme_location' => 'footer-kategori',
									'container' => false,
									'menu_class' => '',
									'fallback_cb' => false,
								));
							else:
								?>
								<ul>
									<?php
									$cats = get_categories(array(
										'number' => 4,
										'orderby' => 'count',
										'order' => 'DESC'
									));
									foreach ($cats as $cat) {
										echo '<li><a href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . '</a></li>';
									}
									?>
								</ul>
							<?php endif; ?>
						</div>
						
					</div>
				</div>
				
				<!-- Middle Part: Huge Brand Text -->
				<div class="footer-brand">
					<span class="brand-text">ERA AI<span class="brand-tm">®</span></span>
				</div>
				
				<!-- Bottom Part: Copyright -->
				<div class="footer-bottom">
					<p class="copyright">© <?php echo date('Y'); ?> ERA AI. Hak Cipta Dilindungi.</p>
					<div class="footer-bottom-links">
						<a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy Policy</a>
						<span class="sep">·</span>
						<a href="<?php echo esc_url(home_url('/terms-and-conditions')); ?>">Terms & Conditions</a>
					</div>
				</div>

			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

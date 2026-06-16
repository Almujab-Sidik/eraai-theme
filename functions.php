<?php

/**
 * era ai functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package era_ai
 */
if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function era_ai_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on era ai, use a find and replace
	 * to change 'era-ai' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('era-ai', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'era-ai'),
			'footer-sitemap' => esc_html__('Footer Sitemap', 'era-ai'),
			'footer-layanan' => esc_html__('Footer Layanan', 'era-ai'),
			'footer-kategori' => esc_html__('Footer Kategori', 'era-ai'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'era_ai_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}

add_action('after_setup_theme', 'era_ai_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function era_ai_content_width()
{
	$GLOBALS['content_width'] = apply_filters('era_ai_content_width', 640);
}

add_action('after_setup_theme', 'era_ai_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function era_ai_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'era-ai'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'era-ai'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}

add_action('widgets_init', 'era_ai_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function era_ai_scripts()
{
	wp_enqueue_style('era-ai-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('era-ai-style', 'rtl', 'replace');

	wp_enqueue_script('era-ai-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// Google Fonts - Inter + JetBrains Mono
	wp_enqueue_style(
		'eraai-google-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap',
		array(),
		null
	);

	// global css
	wp_enqueue_style(
		'eraai-global',
		get_template_directory_uri() . '/css/global.css',
		array(),
		_S_VERSION
	);

	// token css
	wp_enqueue_style(
		'eraai-tokens',
		get_template_directory_uri() . '/css/tokens.css',
		array('eraai-google-fonts'),
		_S_VERSION
	);

	// typography css
	wp_enqueue_style(
		'eraai-typography',
		get_template_directory_uri() . '/css/typography.css',
		array('eraai-tokens'),
		_S_VERSION
	);

	// button css
	wp_enqueue_style(
		'eraai-button',
		get_template_directory_uri() . '/css/components/button.css',
		array('eraai-tokens'),
		_S_VERSION
	);

	// navbar css
	wp_enqueue_style(
		'eraai-navbar',
		get_template_directory_uri() . '/css/components/navbar.css',
		array('eraai-tokens'),
		_S_VERSION
	);

	// navbar js
	wp_enqueue_script(
		'eraai-navbar',
		get_template_directory_uri() . '/js/navbar.js',
		array(),
		_S_VERSION,
		true
	);

	// homepage css
	if (is_front_page()) {
		wp_enqueue_style(
			'eraai-homepage',
			get_template_directory_uri() . '/css/homepage.css',
			array(),
			_S_VERSION
		);

		wp_enqueue_style(
			'eraai-post',
			get_template_directory_uri() . '/css/post.css',
			array(),
			_S_VERSION
		);

		// card css
		wp_enqueue_style(
			'eraai-card',
			get_template_directory_uri() . '/css/components/card.css',
			array('eraai-tokens'),
			_S_VERSION
		);
	}

	// single post css
	if (is_singular('post')) {
		wp_enqueue_style(
			'eraai-single',
			get_template_directory_uri() . '/css/single.css',
			array('eraai-tokens'),
			_S_VERSION
		);
	}

	// page tentang kami css
	if (is_page('tentang-kami')) {
		wp_enqueue_style(
			'eraai-about',
			get_template_directory_uri() . '/css/about.css',
			array('eraai-tokens'),
			_S_VERSION
		);
	}

	// page artikel, archive, search, & home css
	if (is_page_template('page-artikel.php') || is_archive() || is_search() || is_home()) {
		wp_enqueue_style(
			'eraai-blog',
			get_template_directory_uri() . '/css/blog.css',
			array('eraai-tokens'),
			_S_VERSION
		);
		wp_enqueue_style(
			'eraai-card',
			get_template_directory_uri() . '/css/components/card.css',
			array('eraai-tokens'),
			_S_VERSION
		);
	}

	// page artikel filter js
	if (is_page_template('page-artikel.php')) {
		wp_enqueue_script(
			'eraai-blog-filter',
			get_template_directory_uri() . '/js/blog-filter.js',
			array(),
			_S_VERSION,
			true
		);
		wp_localize_script(
			'eraai-blog-filter',
			'eraai_ajax',
			array(
				'ajax_url' => admin_url('admin-ajax.php')
			)
		);
	}

	// page kontak css & js
	if (is_page('kontak') || is_page_template('page-kontak.php')) {
		wp_enqueue_style(
			'eraai-contact',
			get_template_directory_uri() . '/css/contact.css',
			array('eraai-tokens'),
			_S_VERSION
		);
		wp_enqueue_script(
			'eraai-contact-form',
			get_template_directory_uri() . '/js/contact-form.js',
			array(),
			_S_VERSION,
			true
		);
		wp_localize_script(
			'eraai-contact-form',
			'eraai_contact_ajax',
			array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('eraai_contact_nonce')
			)
		);
	}

	// page jasa pembuatan website css
	if (is_page('jasa-pembuatan-website') || is_page_template('page-jasa-website.php')) {
		wp_enqueue_style(
			'eraai-services',
			get_template_directory_uri() . '/css/services.css',
			array('eraai-tokens'),
			_S_VERSION
		);
	}

	// page automation css
	if (is_page('automation') || is_page_template('page-automation.php')) {
		wp_enqueue_style(
			'eraai-automation',
			get_template_directory_uri() . '/css/automation.css',
			array('eraai-tokens'),
			_S_VERSION
		);
	}

	// page legal (privacy policy & terms conditions) css
	if (is_page('privacy-policy') || is_page('terms-conditions') || is_page_template('page-privacy-policy.php') || is_page_template('page-terms-conditions.php')) {
		wp_enqueue_style(
			'eraai-legal',
			get_template_directory_uri() . '/css/legal.css',
			array('eraai-tokens'),
			_S_VERSION
		);
	}
}

add_action('wp_enqueue_scripts', 'era_ai_scripts');

/** Load Composer autoloader. */
if ( file_exists( get_template_directory() . '/vendor/autoload.php' ) ) {
	require_once get_template_directory() . '/vendor/autoload.php';
}

/** Load Theme Updater. */
require_once get_template_directory() . '/inc/updater.php';

/** Navbar Walker. */
require get_template_directory() . '/inc/navbar-walker.php';

/** Implement the Custom Header feature. */
require get_template_directory() . '/inc/custom-header.php';

/** Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

/** Functions which enhance the theme by hooking into WordPress. */
require get_template_directory() . '/inc/template-functions.php';

/** Customizer additions. */
require get_template_directory() . '/inc/customizer.php';

/** Login page customizations. */
require get_template_directory() . '/inc/login.php';

/** Load Jetpack compatibility file. */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/** AJAX Callback for loading and filtering posts on Halaman Artikel */
add_action('wp_ajax_load_more_posts', 'era_ai_load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'era_ai_load_more_posts');

function era_ai_load_more_posts()
{
	$paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$category_slug = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

	// Setup query args
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => 6,
		'paged' => $paged,
		'orderby' => 'date',
		'order' => 'DESC',
	);

	if ($category_slug && 'all' !== $category_slug) {
		$args['category_name'] = $category_slug;
	}

	$query = new WP_Query($args);

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();

			get_template_part( 'template-parts/content', 'card', [
				'class' => 'is-filtered',
			] );
		}
		wp_reset_postdata();
	}

	wp_die();
}

/**
 * Register Custom Post Type "Pesan Masuk" (Inquiries)
 */
function era_ai_register_inquiry_cpt()
{
	$labels = array(
		'name' => _x('Pesan Masuk', 'post type general name', 'era-ai'),
		'singular_name' => _x('Pesan Masuk', 'post type singular name', 'era-ai'),
		'menu_name' => _x('Pesan Masuk', 'admin menu', 'era-ai'),
		'name_admin_bar' => _x('Pesan Masuk', 'add new on admin bar', 'era-ai'),
		'add_new' => _x('Tambah Baru', 'pesan_masuk', 'era-ai'),
		'add_new_item' => __('Tambah Pesan Baru', 'era-ai'),
		'new_item' => __('Pesan Baru', 'era-ai'),
		'edit_item' => __('Lihat Pesan', 'era-ai'),
		'view_item' => __('Lihat Pesan', 'era-ai'),
		'all_items' => __('Semua Pesan', 'era-ai'),
		'search_items' => __('Cari Pesan', 'era-ai'),
		'parent_item_colon' => __('Induk Pesan:', 'era-ai'),
		'not_found' => __('Tidak ada pesan ditemukan.', 'era-ai'),
		'not_found_in_trash' => __('Tidak ada pesan di dalam kotak sampah.', 'era-ai')
	);

	$args = array(
		'labels' => $labels,
		'public' => false,  // We do not want these to be publicly queryable via theme urls
		'show_ui' => true,  // Show in WordPress Admin Dashboard
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'pesan-masuk'),
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => false,
		'menu_position' => 25,
		'menu_icon' => 'dashicons-email-alt',  // email icon
		'supports' => array('title', 'editor')  // title = sender's name, editor = message body
	);

	register_post_type('pesan_masuk', $args);
}

add_action('init', 'era_ai_register_inquiry_cpt');

// Custom columns for the Pesan Masuk list
add_filter('manage_pesan_masuk_posts_columns', 'era_ai_set_pesan_masuk_columns');

function era_ai_set_pesan_masuk_columns($columns)
{
	unset($columns['date']);  // Remove date temporarily to reposition it
	$columns['sender_email'] = __('Email Pengirim', 'era-ai');
	$columns['sender_subject'] = __('Subjek', 'era-ai');
	$columns['date'] = __('Tanggal', 'era-ai');
	return $columns;
}

// Populate the custom columns
add_action('manage_pesan_masuk_posts_custom_column', 'era_ai_pesan_masuk_custom_column', 10, 2);

function era_ai_pesan_masuk_custom_column($column, $post_id)
{
	switch ($column) {
		case 'sender_email':
			$email = get_post_meta($post_id, '_sender_email', true);
			echo esc_html($email ?: '-');
			break;
		case 'sender_subject':
			$subject = get_post_meta($post_id, '_sender_subject', true);
			echo esc_html($subject ?: '-');
			break;
	}
}

// Add read-only details meta box for Pesan Masuk
add_action('add_meta_boxes', 'era_ai_add_inquiry_meta_boxes');

function era_ai_add_inquiry_meta_boxes()
{
	add_meta_box(
		'era_ai_inquiry_details',
		__('Detail Pesan Masuk', 'era-ai'),
		'era_ai_inquiry_meta_box_callback',
		'pesan_masuk',
		'normal',
		'high'
	);
}

function era_ai_inquiry_meta_box_callback($post)
{
	$email = get_post_meta($post->ID, '_sender_email', true);
	$subject = get_post_meta($post->ID, '_sender_subject', true);
	$message = $post->post_content;
	?>
	<table class="form-table">
		<tr>
			<th><label><?php _e('Nama Pengirim', 'era-ai'); ?></label></th>
			<td><input type="text" class="regular-text" style="width: 100%; max-width: 500px;" value="<?php echo esc_attr($post->post_title); ?>" readonly /></td>
		</tr>
		<tr>
			<th><label><?php _e('Email', 'era-ai'); ?></label></th>
			<td><input type="text" class="regular-text" style="width: 100%; max-width: 500px;" value="<?php echo esc_attr($email); ?>" readonly /></td>
		</tr>
		<tr>
			<th><label><?php _e('Subjek', 'era-ai'); ?></label></th>
			<td><input type="text" class="regular-text" style="width: 100%; max-width: 500px;" value="<?php echo esc_attr($subject); ?>" readonly /></td>
		</tr>
		<tr>
			<th><label><?php _e('Pesan', 'era-ai'); ?></label></th>
			<td><textarea class="large-text" style="width: 100%; max-width: 500px;" rows="8" readonly><?php echo esc_textarea($message); ?></textarea></td>
		</tr>
	</table>
	<style>
		#era_ai_inquiry_details input[readonly], 
		#era_ai_inquiry_details textarea[readonly] {
			background-color: #f0f0f1;
			border-color: #dcdcde;
			color: #2c3338;
			cursor: default;
		}
	</style>
	<?php
}

/** AJAX Callback for processing Contact Form Submission */
add_action('wp_ajax_submit_contact_form', 'era_ai_submit_contact_form');
add_action('wp_ajax_nopriv_submit_contact_form', 'era_ai_submit_contact_form');

function era_ai_submit_contact_form()
{
	// Verify nonce for security
	if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'eraai_contact_nonce')) {
		wp_send_json_error(array('message' => __('Keamanan tidak valid. Silakan muat ulang halaman.', 'era-ai')));
	}

	// Validate inputs
	$fullname = isset($_POST['fullname']) ? sanitize_text_field($_POST['fullname']) : '';
	$email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
	$subject = isset($_POST['subject']) ? sanitize_text_field($_POST['subject']) : '';
	$message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

	if (empty($fullname) || empty($email) || empty($subject) || empty($message)) {
		wp_send_json_error(array('message' => __('Harap isi seluruh kolom yang wajib diisi.', 'era-ai')));
	}

	if (!is_email($email)) {
		wp_send_json_error(array('message' => __('Alamat email tidak valid.', 'era-ai')));
	}

	// Create post data
	$post_data = array(
		'post_title' => $fullname,
		'post_content' => $message,
		'post_status' => 'publish',
		'post_type' => 'pesan_masuk',
	);

	// Insert the post into database
	$post_id = wp_insert_post($post_data);

	if (is_wp_error($post_id)) {
		wp_send_json_error(array('message' => __('Gagal menyimpan pesan. Silakan coba lagi.', 'era-ai')));
	}

	// Save custom fields
	update_post_meta($post_id, '_sender_email', $email);
	update_post_meta($post_id, '_sender_subject', $subject);

	// Send notification email to admin
	$admin_email = get_option('admin_email');
	$email_subject = sprintf(__('[Era AI] Pesan Baru dari %s: %s', 'era-ai'), $fullname, $subject);

	$email_body = "Anda telah menerima pesan kontak baru dari website Era AI.\n\n";
	$email_body .= "--------------------------------------------------\n";
	$email_body .= 'Nama Lengkap : ' . $fullname . "\n";
	$email_body .= 'Email        : ' . $email . "\n";
	$email_body .= 'Subjek       : ' . $subject . "\n";
	$email_body .= "Pesan        :\n" . $message . "\n";
	$email_body .= "--------------------------------------------------\n\n";
	$email_body .= "Anda dapat melihat dan mengelola pesan ini di dashboard admin WordPress:\n";
	$email_body .= admin_url('post.php?post=' . $post_id . '&action=edit') . "\n";

	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		'Reply-To: ' . $fullname . ' <' . $email . '>'
	);

	@wp_mail($admin_email, $email_subject, $email_body, $headers);

	// Return success response
	wp_send_json_success(array('message' => __('Pesan Anda berhasil dikirim! Terima kasih telah menghubungi kami.', 'era-ai')));
}

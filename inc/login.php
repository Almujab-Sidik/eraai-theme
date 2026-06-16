<?php

add_action('login_enqueue_scripts', function () {
	wp_enqueue_style(
		'eraai-font',
		'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap',
		[],
		null
	);

	wp_enqueue_style(
		'eraai-tokens',
		get_template_directory_uri() . '/css/tokens.css',
		['eraai-font'],
		wp_get_theme()->get('Version')
	);

	wp_enqueue_style(
		'eraai-typography',
		get_template_directory_uri() . '/css/typography.css',
		['eraai-tokens'],
		wp_get_theme()->get('Version')
	);

	wp_enqueue_style(
		'eraai-login',
		get_template_directory_uri() . '/css/login.css',
		['eraai-typography'],
		wp_get_theme()->get('Version')
	);
});

add_filter('login_message', function ($message) {
	$user_icon = esc_url(get_template_directory_uri() . '/assets/images/user-icon.svg');

	$action = $_REQUEST['action'] ?? '';
	$title = ($action === 'lostpassword') ? 'Forgot Your Password?' : 'Login to ' . get_bloginfo('name');
	$desc = ($action === 'lostpassword') ? 'No worries, we’ll send you reset instructions.' : 'Enter your details to login.';

	$html = '<div class="login-intro">';
	$html .= '<div class="user-icon-wrap">';
	$html .= "<img class='user-icon' src='$user_icon' alt='icon for form login' />";
	$html .= '</div>';
	$html .= '<h6>' . esc_html($title) . '</h6>';
	$html .= '<p>' . esc_html($desc) . '</p>';
	$html .= '</div>';

	return $html . $message;
});

add_action('login_form', function () {
	$forgot_url = wp_lostpassword_url();
	?>
    <div class="wrapper-login__forgot">
        <a class="login-forgot" href="<?php echo esc_url($forgot_url) ?>">Forgot Password?</a>
    </div>
    <?php
});

add_filter('gettext', function ($translated, $original, $domain) {
	if ($original === 'Log in' && isset($_REQUEST['action']) && $_REQUEST['action'] === 'lostpassword') {
		return '← Back to Login';
	}
	return $translated;
}, 10, 3);

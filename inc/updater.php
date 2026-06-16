<?php
/**
 * era ai theme updater configuration.
 *
 * @package era_ai
 */

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Make sure PucFactory class exists before using it.
if ( ! class_exists( 'YahnisElsts\PluginUpdateChecker\v5\PucFactory' ) ) {
	return;
}

/**
 * Initialize the update checker for the theme.
 */
$theme_updater = PucFactory::buildUpdateChecker(
	'https://github.com/Almujab-Sidik/eraai-theme/',
	get_template_directory() . '/style.css', // Path to the main stylesheet/theme folder.
	'eraai' // Theme folder directory name (slug).
);

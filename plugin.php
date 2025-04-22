<?php

/**
 * Plugin Name:       Block Word Switcher
 * Description:       A block with the Interactivity API.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       block-word-switcher
 *
 * @package           create-block
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}


/**
 * Register the scripts for the word switcher format.
 */
function juanmablocks_word_switcher_register_scripts()
{
	$dir = __DIR__;

	// --- Editor Script (Format Registration) ---
	$script_asset_path_editor = "$dir/build/registerFormatType.asset.php";
	if (! file_exists($script_asset_path_editor)) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "juanmablocks/word-switcher" block first.'
		);
	}
	$script_asset_editor = require($script_asset_path_editor);
	wp_register_script(
		'juanma-blocks-word-switcher-editor',
		plugins_url('build/registerFormatType.js', __FILE__),
		$script_asset_editor['dependencies'],
		$script_asset_editor['version'],
		true // Load in footer
	);

	// Localize script for i18n if needed - assuming 'juanmablocks' text domain
	wp_set_script_translations('juanma-blocks-word-switcher-editor', 'juanmablocks');



	wp_register_script_module(
		'@juanma-blocks/word-switcher', // Use a module-style ID
		plugins_url('assets/iapi.js', __FILE__),
		array(), // Use mapped module dependencies
		filemtime(plugin_dir_path(__FILE__) . 'assets/iapi.js') // Use file modification time
		// No 'strategy' => 'defer' for modules
	);

	// register style
	wp_register_style(
		'juanma-blocks-word-switcher',
		plugins_url('assets/style.css', __FILE__),
		array(),
		filemtime(plugin_dir_path(__FILE__) . 'assets/style.css') // Use file modification time
	);
}
add_action('init', 'juanmablocks_word_switcher_register_scripts');

/**
 * Enqueue the editor script.
 */
function juanmablocks_word_switcher_enqueue_editor_assets()
{
	wp_enqueue_script('juanma-blocks-word-switcher-editor');
}
add_action('enqueue_block_editor_assets', 'juanmablocks_word_switcher_enqueue_editor_assets');

// Include the logic to extend core blocks.
require_once __DIR__ . '/inc/extend-core-blocks.php';

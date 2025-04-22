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

	// --- iApi Script (Interactivity API Logic) ---
	$script_asset_path_iapi = "$dir/build/iapi.asset.php";
	if (! file_exists($script_asset_path_iapi)) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "juanmablocks/word-switcher" block first.'
		);
	}
	$script_asset_iapi = require($script_asset_path_iapi);

	// Map script dependencies to module dependencies if needed.
	// Assumes 'wp-interactivity' is present and maps it to '@wordpress/interactivity'.
	// Other script dependencies listed in the asset file might not be available as modules yet.
	$module_dependencies = array_map(function ($dependency) {
		if ($dependency === 'wp-interactivity') {
			return '@wordpress/interactivity';
		}
		// Add mappings for other known core modules if necessary
		// Or handle/warn about non-module dependencies
		return $dependency; // Keep others as is for now, might cause issues
	}, $script_asset_iapi['dependencies']);

	wp_register_script_module(
		'@juanma-blocks/word-switcher', // Use a module-style ID
		plugins_url('build/iapi.js', __FILE__),
		$module_dependencies, // Use mapped module dependencies
		$script_asset_iapi['version']
		// No 'strategy' => 'defer' for modules
	);

	// register style
	wp_register_style(
		'juanma-blocks-word-switcher',
		plugins_url('build/style-iapi.css', __FILE__),
		array(),
		$script_asset_iapi['version']
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

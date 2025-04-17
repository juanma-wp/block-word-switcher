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

// Include block filters
require_once plugin_dir_path(__FILE__) . 'src/block-filters.php';

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_word_switcher_block_init()
{
	register_block_type_from_metadata(__DIR__ . '/build');
}
add_action('init', 'create_block_word_switcher_block_init');

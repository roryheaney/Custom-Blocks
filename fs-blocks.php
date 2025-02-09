<?php
/**
 * Plugin Name:       FancySquare Blocks
 * Description:       A collection of custom blocks
 * Version:           0.1.1
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * Text Domain:       fs-blocks
 *
 * @package Fancysquares
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// 1) Include your render callback definitions
require_once plugin_dir_path( __FILE__ ) . 'lib/render-callbacks.php';

// 2) Include admin settings
require_once plugin_dir_path( __FILE__ ) . 'lib/admin-settings.php';

/**
 * Registers all blocks on init.
 */
function fancysquares_fs_blocks_block_init() {
	// container block
	register_block_type(
		__DIR__ . '/build/container',
		array(
			'render_callback' => 'fsblocks_render_container_block',
		)
	);

	// row block
	register_block_type(
		__DIR__ . '/build/row',
		array(
			'render_callback' => 'fsblocks_render_row_block',
		)
	);

	// column block
	register_block_type(
		__DIR__ . '/build/column',
		array(
			'render_callback' => 'fsblocks_render_column_block',
		)
	);

	// accordion (parent) block
	register_block_type(
		__DIR__ . '/build/accordion',
		array(
			'render_callback' => 'fsblocks_render_accordion_block', // function in render-callbacks.php
		)
	);

	// accordion item (child) block
	register_block_type(
		__DIR__ . '/build/accordion-item',
		array(
			'render_callback' => 'fsblocks_render_accordion_item_block',
		)
	);
}
add_action( 'init', 'fancysquares_fs_blocks_block_init' );

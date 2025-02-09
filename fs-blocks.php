<?php
/**
 * Plugin Name:       FancySquare Blocks
 * Description:       A collection of custom blocks
 * Version:           0.1.1
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       fs-blocks
 *
 * @package Fancysquares
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function fancysquares_fs_blocks_block_init() {
	// register_block_type( __DIR__ . '/build/container' );
	// register container block
	register_block_type( __DIR__ . '/build/container', array(
		'render_callback' => 'fsblocks_render_container_block',
	) );
	// register row block
	register_block_type( __DIR__ . '/build/row', array(
		'render_callback' => 'fsblocks_render_row_block',
	) );
	// register column block
	register_block_type( __DIR__ . '/build/column', array(
		'render_callback' => 'fsblocks_render_column_block',
	) );
}
add_action( 'init', 'fancysquares_fs_blocks_block_init' );


/**
 * Render callback for the container block.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Inner block markup.
 * @return string            HTML markup.
 */
function fsblocks_render_container_block( $attributes, $content ) {
	// Get the additional class (if set) and sanitize it.
	$additional_class = isset( $attributes['additionalClass'] ) ? sanitize_html_class( $attributes['additionalClass'] ) : '';
	$classes = 'container';
	if ( ! empty( $additional_class ) ) {
		$classes .= ' ' . $additional_class;
	}

	// Make the $classes and $content variables available to the partial.
	ob_start();
	include plugin_dir_path( __FILE__ ) . 'build/container/render.php';
	return ob_get_clean();
}

/**
 * Render callback for the row block.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Inner block markup.
 * @return string            HTML markup.
 */
function fsblocks_render_row_block( $attributes, $content ) {
	// "additionalClasses" is the final merged array from the editor
	$additional_classes = ( isset( $attributes['additionalClasses'] ) && is_array( $attributes['additionalClasses'] ) )
		? $attributes['additionalClasses']
		: [];

	// We'll build the final class name in the partial
	ob_start();
	include plugin_dir_path( __FILE__ ) . 'build/row/render.php';
	return ob_get_clean();
}


/**
 * Render callback for the column block.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Inner block markup.
 * @return string            HTML markup.
 */
function fsblocks_render_column_block( $attributes, $content ) {
	// additionalClasses is now an ARRAY of strings.
	// If it's not set or not an array, default to empty array.
	$additional_classes = ( isset( $attributes['additionalClasses'] ) && is_array( $attributes['additionalClasses'] ) )
		? $attributes['additionalClasses']
		: [];

	// We'll actually combine/sanitize them in the included file below.
	ob_start();
	include plugin_dir_path( __FILE__ ) . 'build/column/render.php';
	return ob_get_clean();
}

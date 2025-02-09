<?php
/**
 * Render callbacks for FancySquare Blocks.
 *
 * All these functions just return rendered HTML for each block type.
 * We assume the partial (render.php) in each build folder does the final output.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Render callback for the container block.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Inner block markup.
 * @return string            HTML markup.
 */
function fsblocks_render_container_block( $attributes, $content ) {
	$additional_class = isset( $attributes['additionalClass'] )
		? sanitize_html_class( $attributes['additionalClass'] )
		: '';

	$classes = 'container';
	if ( ! empty( $additional_class ) ) {
		$classes .= ' ' . $additional_class;
	}

	ob_start();
	include plugin_dir_path( __FILE__ ) . '../build/container/render.php';
	return ob_get_clean();
}

/**
 * Render callback for the row block.
 */
function fsblocks_render_row_block( $attributes, $content ) {
	$additional_classes = ( isset( $attributes['additionalClasses'] ) && is_array( $attributes['additionalClasses'] ) )
		? $attributes['additionalClasses']
		: [];

	ob_start();
	include plugin_dir_path( __FILE__ ) . '../build/row/render.php';
	return ob_get_clean();
}

/**
 * Render callback for the column block.
 */
function fsblocks_render_column_block( $attributes, $content ) {
	$additional_classes = ( isset( $attributes['additionalClasses'] ) && is_array( $attributes['additionalClasses'] ) )
		? $attributes['additionalClasses']
		: [];

	ob_start();
	include plugin_dir_path( __FILE__ ) . '../build/column/render.php';
	return ob_get_clean();
}

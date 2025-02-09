<?php
/**
 * Render callback for the container block.
 *
 * Available variables:
 * - $attributes: Block attributes.
 * - $content: The inner blocks’ saved markup.
 */

// Build the final class list.
$additional_class = isset( $attributes['additionalClass'] ) ? sanitize_html_class( $attributes['additionalClass'] ) : '';
$classes = 'wp-block-fancysquares-container-block container';
if ( ! empty( $additional_class ) ) {
	$classes .= ' ' . $additional_class;
}
?>
<div class="<?php echo esc_attr( $classes ); ?>">
	<?php
		// Output the inner block markup.
		echo $content;
	?>
</div>

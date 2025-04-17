<?php

/**
 * Render the block on the front end.
 *
 * @param array    $attributes     Block attributes.
 * @param string   $content        Block default content.
 * @param WP_Block $block_instance Block instance.
 */

// Direct debug output in HTML comments for inspection

$processor = new WP_HTML_Tag_Processor($content);

// Process the parent div
if ($processor->next_tag(['tag_name' => 'div', 'class_name' => 'wp-block-juanmablocks-word-switcher'])) {
	// Add interactivity attributes to the parent div
	$processor->set_attribute('data-wp-interactive', 'juanma-blocks/word-switcher');
	$processor->set_attribute('data-wp-init', 'callbacks.init');
	$processor->set_attribute('data-wp-context', wp_json_encode([
		'words' => isset($attributes['switchingWords']) ? $attributes['switchingWords'] : [],
		'currentIndex' => 0,
		'isFading' => false
	]));
}

// Process all word-switcher spans
while ($processor->next_tag(['tag_name' => 'span', 'class_name' => 'word-switcher'])) {
	$processor->set_attribute('data-wp-text', 'state.currentWord');
	$processor->set_attribute('data-wp-class--fade', 'context.isFading');
}

echo $processor->get_updated_html();

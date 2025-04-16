<?php

/**
 * Render the block on the front end.
 *
 * @param array    $attributes     Block attributes.
 * @param string   $content        Block default content.
 * @param WP_Block $block_instance Block instance.
 */

// Direct debug output in HTML comments for inspection


$_processor = new WP_HTML_Tag_Processor($content);

// Set a bookmark at the start for multiple passes
$_processor->next_tag();
$_processor->set_bookmark('start');

// First collect all words from word-switcher spans and add their attributes
$all_words = [];
while ($_processor->next_tag(['tag_name' => 'span', 'class_name' => 'word-switcher'])) {
	$_processor->set_attribute('data-wp-text', 'state.currentWord');
	$_processor->set_attribute('data-wp-class--fade', 'context.isFading');
	// Move to the next token (should be the text content)
	if ($_processor->next_token()) {
		$text_content = $_processor->get_modifiable_text();

		if ($text_content) {
			$words = array_map('trim', explode(',', $text_content));
			$words = array_filter($words); // Remove empty values
			$all_words = array_merge($all_words, $words);
		}
	}
}

// Reset to the beginning to find the parent div
$processor = new WP_HTML_Tag_Processor($_processor->get_updated_html());
if ($processor->next_tag(['tag_name' => 'div', 'class_name' => 'wp-block-juanmablocks-word-switcher'])) {

	// Add interactivity attributes to the parent div
	$processor->set_attribute('data-wp-interactive', 'juanma-blocks/word-switcher');
	$processor->set_attribute('data-wp-init', 'callbacks.init');
	$processor->set_attribute('data-wp-context', wp_json_encode([
		'words' => $all_words,
		'currentIndex' => 0,
		'isFading' => false
	]));
}

$html = $processor->get_updated_html();
?>

<?php echo $html; ?>
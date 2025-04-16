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

// First, find and process the parent div
if ($processor->next_tag(['tag_name' => 'div', 'class_name' => 'wp-block-juanmablocks-word-switcher'])) {
	// Set a bookmark at the parent div for later reference
	$processor->set_bookmark('parent');

	// Collect all words from word-switcher spans
	$all_words = [];

	// Move to the first span with word-switcher class
	while ($processor->next_tag(['tag_name' => 'span', 'class_name' => 'word-switcher'])) {
		$processor->set_attribute('data-wp-text', 'state.currentWord');
		$processor->set_attribute('data-wp-class--fade', 'context.isFading');

		// Get the text content if it's a text node
		if ($processor->next_token()) {
			$text_content = $processor->get_modifiable_text();
			if ($text_content) {
				$words = array_map('trim', explode(',', $text_content));
				$words = array_filter($words); // Remove empty values
				$all_words = array_merge($all_words, $words);
			}
		}
	}

	// Return to the parent div using the bookmark
	$processor->seek('parent');

	// Add interactivity attributes to the parent div
	$processor->set_attribute('data-wp-interactive', 'juanma-blocks/word-switcher');
	$processor->set_attribute('data-wp-init', 'callbacks.init');
	$processor->set_attribute('data-wp-context', wp_json_encode([
		'words' => $all_words,
		'currentIndex' => 0,
		'isFading' => false
	]));
}

echo $processor->get_updated_html();

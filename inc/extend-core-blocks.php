<?php

namespace JuanmaBlocks\WordSwitcher;

use WP_HTML_Tag_Processor;

/**
 * Extends core blocks to add word-switcher interactivity.
 *
 * @param string $block_content The block content.
 * @param array  $block         The full block, including name and attributes.
 * @return string Filtered block content.
 */
function extend_core_blocks_with_interactivity($block_content, $block)
{
    // Only process specific core blocks
    $allowed_blocks = ['core/heading', 'core/paragraph'];
    if (! in_array($block['blockName'], $allowed_blocks, true)) {
        return $block_content;
    }

    // Quick check: if the specific class isn't present, bail early.
    if (strpos($block_content, 'class="word-switcher"') === false) {
        return $block_content;
    }

    $processor = new WP_HTML_Tag_Processor($block_content);

    // Find the main block tag first and store its bookmark.
    if (! $processor->next_tag()) {
        // No tags found in the content at all.
        return $block_content;
    }
    $processor->set_bookmark("main-tag");

    $found_switcher = false;
    $words = [];

    // Find all word-switcher spans and collect words (continues from current position).
    while ($processor->next_tag(['tag_name' => 'span', 'class_name' => 'word-switcher'])) {
        $found_switcher = true;
        $processor->set_attribute('data-wp-text', 'state.currentWord');
        $processor->set_attribute('data-wp-class--fade', 'context.isFading');

        // Get the text content of the span
        if ($processor->next_token(['token_type' => 'text'])) {
            $text_content = $processor->get_modifiable_text();
            if ($text_content) {
                $words = array_map('trim', explode(',', $text_content));
                $words = array_filter($words); // Remove empty values
            } else {
                // Handle potentially empty spans if needed, otherwise they are just skipped
            }
        } else {
            // Span has no text content node immediately following it.
            // Decide if this is an error or just means the span is empty.
        }
    }

    // If no switcher spans were found or no words were collected, bail.
    if (! $found_switcher || empty($words)) {
        return $block_content;
    }

    // Seek back to the main block tag.
    $processor->seek("main-tag");

    // Add interactivity attributes to the main block tag.
    $processor->set_attribute('data-wp-interactive', 'juanma-blocks/word-switcher');
    $processor->set_attribute('data-wp-init', 'callbacks.init');
    $processor->set_attribute('data-wp-context', wp_json_encode([
        'words' => array_values(array_unique($words)), // Ensure unique words and reset keys
        'currentIndex' => 0,
        'isFading' => false,
    ]));

    // Enqueue the view script module only when interactivity is added AND on the front-end.
    if (! is_admin()) {
        wp_enqueue_script_module('@juanma-blocks/word-switcher');
        wp_enqueue_style('juanma-blocks-word-switcher');
    }

    return $processor->get_updated_html();
}

add_filter('render_block', __NAMESPACE__ . '\extend_core_blocks_with_interactivity', 10, 2);

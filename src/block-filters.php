<?php

/**
 * Add server-side block filters
 */

/**
 * Pre-process block attributes before rendering
 *
 * @param array $parsed_block The block being rendered.
 * @param array $source_block The source block.
 * @param WP_Block $parent_block The parent block.
 * @return array The modified block
 */
function juanmablocks_word_switcher_attributes($parsed_block, $source_block, $parent_block)
{
    // Only process our block
    if ($parsed_block['blockName'] !== 'juanmablocks/word-switcher') {
        return $parsed_block;
    }

    // Initialize attributes if not set
    if (!isset($parsed_block['attrs'])) {
        $parsed_block['attrs'] = array();
    }

    // Process HTML content if available
    if (isset($parsed_block['innerHTML'])) {
        $processor = new WP_HTML_Tag_Processor($parsed_block['innerHTML']);
        $words = array();

        // Find all spans with word-switcher class
        while ($processor->next_tag(['tag_name' => 'span', 'class_name' => 'word-switcher'])) {
            // Get the text content
            if ($processor->next_token()) {
                $text_content = $processor->get_modifiable_text();
                if ($text_content) {
                    $spanWords = array_map('trim', explode(',', $text_content));
                    $spanWords = array_filter($spanWords); // Remove empty values
                    $words = array_merge($words, $spanWords);
                }
            }
        }

        // Add words to block attributes
        $parsed_block['attrs']['switchingWords'] = $words;
    }

    return $parsed_block;
}

// Add the filter
add_filter('render_block_data', 'juanmablocks_word_switcher_attributes', 10, 3);

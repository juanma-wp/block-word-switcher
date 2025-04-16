# Word Switcher Block

A dynamic WordPress block that allows you to create animated text transitions where words smoothly switch between different options. Perfect for creating engaging headlines, call-to-actions, or any text that needs to cycle through multiple variations.

## Features

- **Smooth Animations**: Words transition with a polished vertical flow effect
- **Easy to Use**: Simply select text and mark it as a switching word
- **Keyboard Shortcut**: Use Ctrl/Cmd + W to quickly mark text
- **Customizable**: Words can be separated by commas to create multiple options
- **Responsive**: Works seamlessly across all device sizes

## How to Use

1. Add the Word Switcher block to your page
2. Type your text content
3. Select the text you want to animate
4. Click the "Mark as switching word" button in the toolbar (or use Ctrl/Cmd + W)
5. Add multiple words separated by commas (e.g., "Hello,Hi,Hey")
6. The words will automatically cycle through with a smooth animation

## Technical Details

This block is built using the WordPress Interactivity API, which provides a modern way to create interactive blocks without complex JavaScript frameworks. The animations are handled through CSS transitions and transforms for optimal performance.

### Animation Details

- Words fade out while moving downward
- New words appear from above with a smooth slide-in effect
- Transitions use a natural easing curve for a polished feel
- Animations are hardware-accelerated for smooth performance

## Example Usage

```html
<!-- Example of how the block renders -->
<div class="wp-block-juanmablocks-word-switcher">
  <p>Say <span class="word-switcher">Hello,Hi,Hey</span> to the world!</p>
</div>
```

## Requirements

- WordPress 6.7 or higher
- PHP 7.4 or higher

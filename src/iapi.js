/**
 * WordPress dependencies
 */
import { store, getContext } from "@wordpress/interactivity";
import "./style.scss";
store("juanma-blocks/word-switcher", {
  state: {
    get currentWord() {
      const context = getContext();
      return context.words[context.currentIndex];
    },
  },
  callbacks: {
    init: () => {
      const context = getContext();
      // Apply the fade class
      setInterval(() => {
        context.isFading = true;
        // Wait before changing the word
        setTimeout(() => {
          context.currentIndex =
            (context.currentIndex + 1) % context.words.length;
          context.isFading = false;
        }, 200); // Reduced from 100ms to 50ms for faster transition
      }, 3000); // Reduced from 5000ms to 2000ms for faster switching
    },
  },
  computed: {
    currentWord: () => {
      const context = getContext();
      return context.words[context.currentIndex];
    },
  },
});

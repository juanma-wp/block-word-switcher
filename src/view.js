/**
 * WordPress dependencies
 */
import { store, getContext } from "@wordpress/interactivity";

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
      // Aplica la clase 'fade'
      setInterval(() => {
        context.isFading = true;
        // Espera un poco antes de cambiar la palabra
        setTimeout(() => {
          context.currentIndex =
            (context.currentIndex + 1) % context.words.length;
          context.isFading = false;
        }, 100); // 300ms para permitir el fade-out antes de cambiar
      }, 5000); // cambia cada 2 segundos
    },
  },
  computed: {
    currentWord: () => {
      const context = getContext();
      return context.words[context.currentIndex];
    },
  },
});

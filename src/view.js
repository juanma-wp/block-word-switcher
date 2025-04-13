/**
 * WordPress dependencies
 */
import { store, getContext } from "@wordpress/interactivity";

store("myplugin/animatedword", {
  state: {
    get currentWord() {
      const context = getContext();
      return context.words[context.currentIndex];
    },
  },
  actions: {
    init() {
      const context = getContext();
      // Aplica la clase 'fade'
      setInterval(() => {
        context.isFading = true;
        // Espera un poco antes de cambiar la palabra
        setTimeout(() => {
          context.currentIndex =
            (context.currentIndex + 1) % context.words.length;
          context.isFading = false;
        }, 300); // 300ms para permitir el fade-out antes de cambiar
      }, 2000); // cambia cada 2 segundos
    },
  },
  computed: {
    currentWord: () => {
      const context = getContext();
      return context.words[context.currentIndex];
    },
  },
});

// const { state } = store("create-block", {
//   state: {
//     get themeText() {
//       return state.isDark ? state.darkText : state.lightText;
//     },
//   },
//   actions: {
//     toggleOpen() {
//       const context = getContext();
//       context.isOpen = !context.isOpen;
//     },
//     toggleTheme() {
//       state.isDark = !state.isDark;
//     },
//   },
//   callbacks: {
//     logIsOpen: () => {
//       const { isOpen } = getContext();
//       // Log the value of `isOpen` each time it changes.
//       console.log(`Is open: ${isOpen}`);
//     },
//   },
// });

// import { store } from "@wordpress/interactivity";

// const { state } = store("myplugin/animatedword", {
//   actions: {
//     init({ context }) {
//       setInterval(() => {
//         context.currentIndex =
//           (context.currentIndex + 1) % context.words.length;
//       }, 2000); // cambia cada 2 segundos
//     },
//   },
//   computed: {
//     currentWord: ({ context }) => {
//       return context.words[context.currentIndex];
//     },
//   },
// });

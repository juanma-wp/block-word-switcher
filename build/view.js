import * as __WEBPACK_EXTERNAL_MODULE__wordpress_interactivity_8e89b257__ from "@wordpress/interactivity";
/******/ var __webpack_modules__ = ({

/***/ "@wordpress/interactivity":
/*!*******************************************!*\
  !*** external "@wordpress/interactivity" ***!
  \*******************************************/
/***/ ((module) => {

module.exports = __WEBPACK_EXTERNAL_MODULE__wordpress_interactivity_8e89b257__;

/***/ })

/******/ });
/************************************************************************/
/******/ // The module cache
/******/ var __webpack_module_cache__ = {};
/******/ 
/******/ // The require function
/******/ function __webpack_require__(moduleId) {
/******/ 	// Check if module is in cache
/******/ 	var cachedModule = __webpack_module_cache__[moduleId];
/******/ 	if (cachedModule !== undefined) {
/******/ 		return cachedModule.exports;
/******/ 	}
/******/ 	// Create a new module (and put it into the cache)
/******/ 	var module = __webpack_module_cache__[moduleId] = {
/******/ 		// no module.id needed
/******/ 		// no module.loaded needed
/******/ 		exports: {}
/******/ 	};
/******/ 
/******/ 	// Execute the module function
/******/ 	__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 
/******/ 	// Return the exports of the module
/******/ 	return module.exports;
/******/ }
/******/ 
/************************************************************************/
/******/ /* webpack/runtime/make namespace object */
/******/ (() => {
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = (exports) => {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/ })();
/******/ 
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!*********************!*\
  !*** ./src/view.js ***!
  \*********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/interactivity */ "@wordpress/interactivity");
/**
 * WordPress dependencies
 */

(0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.store)("myplugin/animatedword", {
  state: {
    get currentWord() {
      const context = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getContext)();
      return context.words[context.currentIndex];
    }
  },
  actions: {
    init() {
      const context = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getContext)();
      // Aplica la clase 'fade'
      setInterval(() => {
        context.isFading = true;
        // Espera un poco antes de cambiar la palabra
        setTimeout(() => {
          context.currentIndex = (context.currentIndex + 1) % context.words.length;
          context.isFading = false;
        }, 300); // 300ms para permitir el fade-out antes de cambiar
      }, 2000); // cambia cada 2 segundos
    }
  },
  computed: {
    currentWord: () => {
      const context = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getContext)();
      return context.words[context.currentIndex];
    }
  }
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
})();


//# sourceMappingURL=view.js.map
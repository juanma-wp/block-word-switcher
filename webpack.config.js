const defaultConfig = require("@wordpress/scripts/config/webpack.config");

module.exports = {
  ...defaultConfig,
  entry: {
    registerFormatType: "./src/registerFormatType.js",
  },
};

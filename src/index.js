import { registerBlockType } from "@wordpress/blocks";
import "./style.scss";
import "./editor.scss";
import Edit from "./edit";
import metadata from "./block.json";
import Save from "./save";

import { registerWordSwitcherFormatType } from "./registerFormatType";

// Destructure the metadata to ensure attributes are registered
const { name, ...settings } = metadata;

registerBlockType(name, {
  ...settings,
  edit: Edit,
  save: Save,
});

registerWordSwitcherFormatType();

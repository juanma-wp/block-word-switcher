import { __ } from "@wordpress/i18n";
import { registerFormatType } from "@wordpress/rich-text";
import { useCallback } from "@wordpress/element";
import { toggleFormat } from "@wordpress/rich-text";
import {
  RichTextShortcut,
  RichTextToolbarButton,
} from "@wordpress/block-editor";
import { useSelect } from "@wordpress/data";
import metadata from "./block.json";

export const WORD_SWITCHER_FORMAT = metadata.name;
const BLOCK_NAME = metadata.name;

export const registerWordSwitcherFormatType = () => {
  registerFormatType(WORD_SWITCHER_FORMAT, {
    title: __("Word Switcher", "juanmablocks"),
    tagName: "span",
    className: "word-switcher",
    edit: ({ isActive, value, onChange }) => {
      const { selectedBlock } = useSelect((select) => ({
        selectedBlock: select("core/block-editor").getSelectedBlock(),
      }));

      // Only show the format if we're in the correct block
      if (!selectedBlock || selectedBlock.name !== BLOCK_NAME) {
        return null;
      }

      const onToggle = useCallback(() => {
        const format = {
          type: WORD_SWITCHER_FORMAT,
        };

        // Apply the format to the selected text
        onChange(toggleFormat(value, format));
      }, [value, onChange]);

      return (
        <>
          <RichTextShortcut type="primary" character="w" onUse={onToggle} />
          <RichTextToolbarButton
            icon="update"
            title={__("Mark as switching word", "juanmablocks")}
            onClick={onToggle}
            isActive={isActive}
          />
        </>
      );
    },
  });
};

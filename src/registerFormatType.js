import { __ } from "@wordpress/i18n";
import { registerFormatType } from "@wordpress/rich-text";
import { useCallback } from "@wordpress/element";
import { toggleFormat } from "@wordpress/rich-text";
import {
  RichTextShortcut,
  RichTextToolbarButton,
} from "@wordpress/block-editor";

export const WORD_SWITCHER_FORMAT = "juanmablocks/word-switcher";

registerFormatType(WORD_SWITCHER_FORMAT, {
  title: __("Word Switcher", "juanmablocks"),
  tagName: "span",
  className: "word-switcher",
  edit: ({ isActive, value, onChange }) => {
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

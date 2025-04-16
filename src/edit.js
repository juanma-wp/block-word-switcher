import { __ } from "@wordpress/i18n";
import { useBlockProps, RichText } from "@wordpress/block-editor";

import { WORD_SWITCHER_FORMAT } from "./registerFormatType";

export default function Edit({ attributes, setAttributes }) {
  const blockProps = useBlockProps();
  const { content, switchingWords } = attributes;

  const handleFormatChange = (newContent) => {
    setAttributes({ content: newContent });
  };

  return (
    <div {...blockProps}>
      <RichText
        tagName="p"
        value={content}
        onChange={handleFormatChange}
        placeholder={__("Write your content here...")}
        allowedFormats={[WORD_SWITCHER_FORMAT]}
      />
    </div>
  );
}

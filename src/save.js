import { useBlockProps } from "@wordpress/block-editor";
import { RichText } from "@wordpress/block-editor";

export default function save({ attributes }) {
  const { content } = attributes;

  return (
    <div {...useBlockProps.save()}>
      <RichText.Content tagName="p" value={content || ""} />
    </div>
  );
}

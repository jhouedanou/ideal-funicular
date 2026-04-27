import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	useInnerBlocksProps,
	RichText,
} from '@wordpress/block-editor';

const ALLOWED = [ 'core/paragraph', 'core/list', 'core/heading' ];
const TEMPLATE = [
	[ 'core/paragraph', { placeholder: 'Décrivez ce service…' } ],
];

export default function Edit( { attributes, setAttributes } ) {
	const { titre } = attributes;
	const blockProps = useBlockProps( {
		className: 'edigital-accordion-item-editor',
	} );
	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'edigital-accordion-item-editor__content' },
		{ allowedBlocks: ALLOWED, template: TEMPLATE }
	);

	return (
		<div { ...blockProps }>
			<RichText
				tagName="h4"
				className="edigital-accordion-item-editor__title"
				value={ titre }
				onChange={ ( v ) => setAttributes( { titre: v } ) }
				placeholder={ __( 'Titre du service', 'edigital' ) }
				allowedFormats={ [] }
			/>
			<div { ...innerBlocksProps } />
		</div>
	);
}

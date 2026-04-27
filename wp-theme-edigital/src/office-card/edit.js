import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function Edit( { attributes, setAttributes } ) {
	const { label, adresse } = attributes;
	const blockProps = useBlockProps( { className: 'edigital-office-card-editor' } );
	return (
		<div { ...blockProps }>
			<RichText
				tagName="h4"
				value={ label }
				onChange={ ( v ) => setAttributes( { label: v } ) }
				placeholder={ __( 'Libellé (ex: Paris — Siège)', 'edigital' ) }
				allowedFormats={ [] }
			/>
			<RichText
				tagName="p"
				value={ adresse }
				onChange={ ( v ) => setAttributes( { adresse: v } ) }
				placeholder={ __( 'Adresse complète', 'edigital' ) }
			/>
		</div>
	);
}

import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function Edit( { attributes, setAttributes } ) {
	const { titre } = attributes;
	const blockProps = useBlockProps( { className: 'edigital-service-intro-editor' } );

	return (
		<div { ...blockProps }>
			<RichText
				tagName="h2"
				value={ titre }
				onChange={ ( v ) => setAttributes( { titre: v } ) }
				placeholder={ __( 'Titre introductif (un span sera appliqué)', 'edigital' ) }
				allowedFormats={ [ 'core/bold', 'core/italic' ] }
				style={ { textAlign: 'center', fontSize: '2em', fontWeight: 700 } }
			/>
		</div>
	);
}

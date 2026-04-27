import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const { titre, texte, libelleCta, lienCta } = attributes;
	const blockProps = useBlockProps( {
		className: 'edigital-service-cta-editor',
		style: { background: '#111', color: '#fff', padding: '60px 24px', textAlign: 'center' },
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Bouton', 'edigital' ) }>
					<TextControl
						label={ __( 'Libellé du bouton', 'edigital' ) }
						value={ libelleCta }
						onChange={ ( v ) => setAttributes( { libelleCta: v } ) }
					/>
					<TextControl
						label={ __( 'URL', 'edigital' ) }
						value={ lienCta }
						onChange={ ( v ) => setAttributes( { lienCta: v } ) }
					/>
				</PanelBody>
			</InspectorControls>

			<section { ...blockProps }>
				<RichText
					tagName="h2"
					value={ titre }
					onChange={ ( v ) => setAttributes( { titre: v } ) }
					placeholder={ __( 'Titre CTA', 'edigital' ) }
					allowedFormats={ [] }
					style={ { fontSize: '2rem', marginBottom: 16 } }
				/>
				<RichText
					tagName="p"
					value={ texte }
					onChange={ ( v ) => setAttributes( { texte: v } ) }
					placeholder={ __( 'Texte d\'accompagnement', 'edigital' ) }
					style={ { maxWidth: 700, margin: '0 auto 24px' } }
				/>
				<span className="btn-cta-preview" style={ { background: '#e31414', color: '#fff', padding: '14px 28px', fontWeight: 700 } }>
					{ libelleCta }
				</span>
			</section>
		</>
	);
}

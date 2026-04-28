import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

const ALLOWED = [ 'edigital/expertise-card' ];
const TEMPLATE = [
	[ 'edigital/expertise-card' ],
	[ 'edigital/expertise-card' ],
	[ 'edigital/expertise-card' ],
];

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps( { className: 'edigital-expertise-grid-editor' } );
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Contenu', 'edigital' ) } initialOpen={ true }>
					<TextControl
						label={ __( 'Titre', 'edigital' ) }
						value={ attributes.titre || '' }
						onChange={ ( v ) => setAttributes( { titre: v } ) }
					/>
					<TextControl
						label={ __( 'Texte CTA', 'edigital' ) }
						value={ attributes.texteCta || '' }
						onChange={ ( v ) => setAttributes( { texteCta: v } ) }
					/>
					<TextControl
						label={ __( 'Libellé CTA', 'edigital' ) }
						value={ attributes.libelleCta || '' }
						onChange={ ( v ) => setAttributes( { libelleCta: v } ) }
					/>
					<TextControl
						label={ __( 'Lien CTA', 'edigital' ) }
						value={ attributes.lienCta || '' }
						onChange={ ( v ) => setAttributes( { lienCta: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<h2 className="edigital-expertise-grid-editor__title">{ attributes.titre || __( 'Notre Expertise', 'edigital' ) }</h2>
				<InnerBlocks allowedBlocks={ ALLOWED } template={ TEMPLATE } />
			</div>
		</>
	);
}

import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';

const ALLOWED = [ 'edigital/pricing-card' ];
const TEMPLATE = [
	[ 'edigital/pricing-card' ],
	[ 'edigital/pricing-card' ],
	[ 'edigital/pricing-card' ],
];

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps( { className: 'edigital-pricing-editor' } );
	const extrasJson = JSON.stringify( attributes.extras || [], null, 2 );
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
						label={ __( 'Ancre HTML (id)', 'edigital' ) }
						value={ attributes.ancre || '' }
						onChange={ ( v ) => setAttributes( { ancre: v } ) }
					/>
					<TextareaControl
						label={ __( 'Bandeau extras (JSON)', 'edigital' ) }
						help={ __( 'Format JSON — un objet par ligne.', 'edigital' ) }
						value={ extrasJson }
						onChange={ ( v ) => {
							try { setAttributes( { extras: JSON.parse( v ) } ); } catch ( e ) {}
						} }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<h2 className="edigital-pricing-editor__title">{ attributes.titre || __( 'Nos Tarifs', 'edigital' ) }</h2>
				<InnerBlocks allowedBlocks={ ALLOWED } template={ TEMPLATE } />
			</div>
		</>
	);
}

import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';

const ALLOWED = [ 'edigital/accordion-item' ];
const TEMPLATE = [
	[ 'edigital/accordion-item' ],
	[ 'edigital/accordion-item' ],
	[ 'edigital/accordion-item' ],
];

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps( { className: 'edigital-services-accordion-editor' } );
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Contenu', 'edigital' ) } initialOpen={ true }>
					<TextControl
						label={ __( 'Titre', 'edigital' ) }
						value={ attributes.titre || '' }
						onChange={ ( v ) => setAttributes( { titre: v } ) }
					/>
					<SelectControl
						label={ __( 'Alignement', 'edigital' ) }
						value={ attributes.alignement || 'right' }
						options={ [
							{ label: __( 'Gauche', 'edigital' ), value: 'left' },
							{ label: __( 'Droite', 'edigital' ), value: 'right' },
						] }
						onChange={ ( v ) => setAttributes( { alignement: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<h2 className="edigital-services-accordion-editor__title">{ attributes.titre || __( 'Services', 'edigital' ) }</h2>
				<InnerBlocks allowedBlocks={ ALLOWED } template={ TEMPLATE } />
			</div>
		</>
	);
}

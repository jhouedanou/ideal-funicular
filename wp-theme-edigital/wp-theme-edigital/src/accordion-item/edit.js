import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

const ALLOWED = [ 'core/paragraph', 'core/heading', 'core/list', 'core/image' ];
const TEMPLATE = [ [ 'core/paragraph', { placeholder: __( 'Contenu de l’item…', 'edigital' ) } ] ];

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps( { className: 'edigital-accordion-item-editor' } );
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Contenu', 'edigital' ) } initialOpen={ true }>
					<TextControl
						label={ __( 'Titre', 'edigital' ) }
						value={ attributes.titre || '' }
						onChange={ ( v ) => setAttributes( { titre: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<h3 className="edigital-accordion-item-editor__title">{ attributes.titre || __( 'Titre de l’item', 'edigital' ) }</h3>
				<div className="edigital-accordion-item-editor__body">
					<InnerBlocks allowedBlocks={ ALLOWED } template={ TEMPLATE } />
				</div>
			</div>
		</>
	);
}

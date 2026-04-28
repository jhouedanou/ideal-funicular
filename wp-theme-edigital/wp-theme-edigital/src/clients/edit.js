import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

const ALLOWED = [ 'edigital/client-logo' ];
const TEMPLATE = [
	[ 'edigital/client-logo' ],
	[ 'edigital/client-logo' ],
	[ 'edigital/client-logo' ],
];

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps( { className: 'edigital-clients-editor' } );
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Contenu', 'edigital' ) } initialOpen={ true }>
					<TextControl
						label={ __( 'Titre — ligne 1', 'edigital' ) }
						value={ attributes.titreLigne1 || '' }
						onChange={ ( v ) => setAttributes( { titreLigne1: v } ) }
					/>
					<TextControl
						label={ __( 'Titre — ligne 2', 'edigital' ) }
						value={ attributes.titreLigne2 || '' }
						onChange={ ( v ) => setAttributes( { titreLigne2: v } ) }
					/>
					<TextControl
						label={ __( 'URL image de fond', 'edigital' ) }
						value={ attributes.backgroundUrl || '' }
						onChange={ ( v ) => setAttributes( { backgroundUrl: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<h2 className="edigital-clients-editor__title">
					{ attributes.titreLigne1 } { attributes.titreLigne2 }
				</h2>
				<InnerBlocks allowedBlocks={ ALLOWED } template={ TEMPLATE } />
			</div>
		</>
	);
}

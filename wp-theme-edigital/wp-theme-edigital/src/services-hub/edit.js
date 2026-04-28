import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import { PanelBody, TextareaControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	const itemsJson = JSON.stringify( attributes.items || [], null, 2 );
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Contenu', 'edigital' ) } initialOpen={ true }>
					<TextareaControl
						label={ __( 'Items (JSON)', 'edigital' ) }
						help={ __( 'Format JSON — un objet par ligne.', 'edigital' ) }
						value={ itemsJson }
						onChange={ ( v ) => {
							try { setAttributes( { items: JSON.parse( v ) } ); } catch ( e ) {}
						} }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="edigital/services-hub"
					attributes={ attributes }
					httpMethod="POST"
					EmptyResponsePlaceholder={ () => <p>{ __( 'Aucun contenu pour le moment.', 'edigital' ) }</p> }
					LoadingResponsePlaceholder={ () => <p>{ __( 'Chargement…', 'edigital' ) }</p> }
				/>
			</div>
		</>
	);
}

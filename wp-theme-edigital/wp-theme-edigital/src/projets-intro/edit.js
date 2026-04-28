import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	const filtresJson = JSON.stringify( attributes.filtres || [], null, 2 );
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Contenu', 'edigital' ) } initialOpen={ true }>
					<TextControl
						label={ __( 'Titre', 'edigital' ) }
						value={ attributes.titre || '' }
						onChange={ ( v ) => setAttributes( { titre: v } ) }
					/>
					<TextareaControl
						label={ __( 'Sous-titre', 'edigital' ) }
						value={ attributes.sousTitre || '' }
						onChange={ ( v ) => setAttributes( { sousTitre: v } ) }
					/>
					<TextareaControl
						label={ __( 'Filtres (JSON)', 'edigital' ) }
						help={ __( 'Format JSON — un objet par ligne.', 'edigital' ) }
						value={ filtresJson }
						onChange={ ( v ) => {
							try { setAttributes( { filtres: JSON.parse( v ) } ); } catch ( e ) {}
						} }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="edigital/projets-intro"
					attributes={ attributes }
					httpMethod="POST"
					EmptyResponsePlaceholder={ () => <p>{ __( 'Aucun contenu pour le moment.', 'edigital' ) }</p> }
					LoadingResponsePlaceholder={ () => <p>{ __( 'Chargement…', 'edigital' ) }</p> }
				/>
			</div>
		</>
	);
}

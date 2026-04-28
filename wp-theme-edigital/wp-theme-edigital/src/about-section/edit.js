import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Contenu', 'edigital' ) } initialOpen={ true }>
					<TextControl
						label={ __( 'Numéro', 'edigital' ) }
						value={ attributes.numero || '' }
						onChange={ ( v ) => setAttributes( { numero: v } ) }
					/>
					<TextareaControl
						label={ __( 'Titre principal', 'edigital' ) }
						value={ attributes.titrePrincipal || '' }
						onChange={ ( v ) => setAttributes( { titrePrincipal: v } ) }
					/>
					<TextControl
						label={ __( 'URL image', 'edigital' ) }
						value={ attributes.imageUrl || '' }
						onChange={ ( v ) => setAttributes( { imageUrl: v } ) }
					/>
					<TextControl
						label={ __( 'URL vidéo', 'edigital' ) }
						value={ attributes.videoUrl || '' }
						onChange={ ( v ) => setAttributes( { videoUrl: v } ) }
					/>
					<TextareaControl
						label={ __( 'Sous-titre', 'edigital' ) }
						value={ attributes.sousTitre || '' }
						onChange={ ( v ) => setAttributes( { sousTitre: v } ) }
					/>
					<TextControl
						label={ __( 'Étiquette', 'edigital' ) }
						value={ attributes.etiquette || '' }
						onChange={ ( v ) => setAttributes( { etiquette: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="edigital/about-section"
					attributes={ attributes }
					httpMethod="POST"
					EmptyResponsePlaceholder={ () => <p>{ __( 'Aucun contenu pour le moment.', 'edigital' ) }</p> }
					LoadingResponsePlaceholder={ () => <p>{ __( 'Chargement…', 'edigital' ) }</p> }
				/>
			</div>
		</>
	);
}

import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import { PanelBody, TextControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
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
						label={ __( 'Catégorie', 'edigital' ) }
						value={ attributes.categorie || '' }
						onChange={ ( v ) => setAttributes( { categorie: v } ) }
					/>
					<TextControl
						label={ __( 'URL image', 'edigital' ) }
						value={ attributes.imageUrl || '' }
						onChange={ ( v ) => setAttributes( { imageUrl: v } ) }
					/>
					<TextControl
						label={ __( 'Texte alternatif', 'edigital' ) }
						value={ attributes.imageAlt || '' }
						onChange={ ( v ) => setAttributes( { imageAlt: v } ) }
					/>
					<TextControl
						label={ __( 'Lien', 'edigital' ) }
						value={ attributes.lien || '' }
						onChange={ ( v ) => setAttributes( { lien: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="edigital/expertise-card"
					attributes={ attributes }
					httpMethod="POST"
					EmptyResponsePlaceholder={ () => <p>{ __( 'Aucun contenu pour le moment.', 'edigital' ) }</p> }
					LoadingResponsePlaceholder={ () => <p>{ __( 'Chargement…', 'edigital' ) }</p> }
				/>
			</div>
		</>
	);
}

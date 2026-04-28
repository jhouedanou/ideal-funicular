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
						label={ __( 'Icône (Font Awesome)', 'edigital' ) }
						help={ __( 'Ex. fa-laptop', 'edigital' ) }
						value={ attributes.icone || '' }
						onChange={ ( v ) => setAttributes( { icone: v } ) }
					/>
					<TextControl
						label={ __( 'Famille (fas, far, fab…)', 'edigital' ) }
						value={ attributes.icoFamille || '' }
						onChange={ ( v ) => setAttributes( { icoFamille: v } ) }
					/>
					<TextControl
						label={ __( 'Tag', 'edigital' ) }
						value={ attributes.tag || '' }
						onChange={ ( v ) => setAttributes( { tag: v } ) }
					/>
					<TextControl
						label={ __( 'Titre', 'edigital' ) }
						value={ attributes.titre || '' }
						onChange={ ( v ) => setAttributes( { titre: v } ) }
					/>
					<TextareaControl
						label={ __( 'Texte', 'edigital' ) }
						value={ attributes.texte || '' }
						onChange={ ( v ) => setAttributes( { texte: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="edigital/service-text-card"
					attributes={ attributes }
					httpMethod="POST"
					EmptyResponsePlaceholder={ () => <p>{ __( 'Aucun contenu pour le moment.', 'edigital' ) }</p> }
					LoadingResponsePlaceholder={ () => <p>{ __( 'Chargement…', 'edigital' ) }</p> }
				/>
			</div>
		</>
	);
}

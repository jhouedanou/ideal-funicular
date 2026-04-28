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
						label={ __( 'URL image de fond', 'edigital' ) }
						value={ attributes.backgroundUrl || '' }
						onChange={ ( v ) => setAttributes( { backgroundUrl: v } ) }
					/>
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
				</PanelBody>
				<PanelBody title={ __( 'Fil d’Ariane', 'edigital' ) } initialOpen={ false }>
					<TextControl
						label={ __( 'Niveau 1 — libellé', 'edigital' ) }
						value={ attributes.breadcrumb1Label || '' }
						onChange={ ( v ) => setAttributes( { breadcrumb1Label: v } ) }
					/>
					<TextControl
						label={ __( 'Niveau 1 — URL', 'edigital' ) }
						value={ attributes.breadcrumb1Url || '' }
						onChange={ ( v ) => setAttributes( { breadcrumb1Url: v } ) }
					/>
					<TextControl
						label={ __( 'Niveau 2 — libellé', 'edigital' ) }
						value={ attributes.breadcrumb2Label || '' }
						onChange={ ( v ) => setAttributes( { breadcrumb2Label: v } ) }
					/>
					<TextControl
						label={ __( 'Niveau 2 — URL', 'edigital' ) }
						value={ attributes.breadcrumb2Url || '' }
						onChange={ ( v ) => setAttributes( { breadcrumb2Url: v } ) }
					/>
					<TextControl
						label={ __( 'Page courante', 'edigital' ) }
						value={ attributes.breadcrumbCurrent || '' }
						onChange={ ( v ) => setAttributes( { breadcrumbCurrent: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="edigital/service-hero"
					attributes={ attributes }
					httpMethod="POST"
					EmptyResponsePlaceholder={ () => <p>{ __( 'Aucun contenu pour le moment.', 'edigital' ) }</p> }
					LoadingResponsePlaceholder={ () => <p>{ __( 'Chargement…', 'edigital' ) }</p> }
				/>
			</div>
		</>
	);
}

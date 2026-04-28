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
						label={ __( 'Étiquette', 'edigital' ) }
						value={ attributes.etiquette || '' }
						onChange={ ( v ) => setAttributes( { etiquette: v } ) }
					/>
					<TextControl
						label={ __( 'Ancre HTML (id)', 'edigital' ) }
						value={ attributes.ancre || '' }
						onChange={ ( v ) => setAttributes( { ancre: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="edigital/intro"
					attributes={ attributes }
					httpMethod="POST"
					EmptyResponsePlaceholder={ () => <p>{ __( 'Aucun contenu pour le moment.', 'edigital' ) }</p> }
					LoadingResponsePlaceholder={ () => <p>{ __( 'Chargement…', 'edigital' ) }</p> }
				/>
			</div>
		</>
	);
}

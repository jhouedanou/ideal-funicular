import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import { PanelBody, TextareaControl, TextControl, SelectControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Contenu', 'edigital' ) } initialOpen={ true }>
					<TextareaControl
						label={ __( 'Titre', 'edigital' ) }
						value={ attributes.titre || '' }
						onChange={ ( v ) => setAttributes( { titre: v } ) }
					/>
					<TextControl
						label={ __( 'Étiquette', 'edigital' ) }
						value={ attributes.etiquette || '' }
						onChange={ ( v ) => setAttributes( { etiquette: v } ) }
					/>
					<SelectControl
						label={ __( 'Variante', 'edigital' ) }
						value={ attributes.variante || 'default' }
						options={ [
							{ label: __( 'Défaut', 'edigital' ), value: 'default' },
							{ label: __( 'Dernier', 'edigital' ), value: 'last' },
						] }
						onChange={ ( v ) => setAttributes( { variante: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="edigital/section-heading"
					attributes={ attributes }
					httpMethod="POST"
					EmptyResponsePlaceholder={ () => <p>{ __( 'Aucun contenu pour le moment.', 'edigital' ) }</p> }
					LoadingResponsePlaceholder={ () => <p>{ __( 'Chargement…', 'edigital' ) }</p> }
				/>
			</div>
		</>
	);
}

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
						label={ __( 'Label téléphone', 'edigital' ) }
						value={ attributes.telLabel || '' }
						onChange={ ( v ) => setAttributes( { telLabel: v } ) }
					/>
					<TextControl
						label={ __( 'Téléphone', 'edigital' ) }
						value={ attributes.telValue || '' }
						onChange={ ( v ) => setAttributes( { telValue: v } ) }
					/>
					<TextControl
						label={ __( 'Label email', 'edigital' ) }
						value={ attributes.emailLabel || '' }
						onChange={ ( v ) => setAttributes( { emailLabel: v } ) }
					/>
					<TextControl
						label={ __( 'Email', 'edigital' ) }
						value={ attributes.emailValue || '' }
						onChange={ ( v ) => setAttributes( { emailValue: v } ) }
					/>
					<TextControl
						label={ __( 'Label horaires', 'edigital' ) }
						value={ attributes.horairesLabel || '' }
						onChange={ ( v ) => setAttributes( { horairesLabel: v } ) }
					/>
					<TextareaControl
						label={ __( 'Horaires', 'edigital' ) }
						value={ attributes.horairesValue || '' }
						onChange={ ( v ) => setAttributes( { horairesValue: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="edigital/contact-info"
					attributes={ attributes }
					httpMethod="POST"
					EmptyResponsePlaceholder={ () => <p>{ __( 'Aucun contenu pour le moment.', 'edigital' ) }</p> }
					LoadingResponsePlaceholder={ () => <p>{ __( 'Chargement…', 'edigital' ) }</p> }
				/>
			</div>
		</>
	);
}

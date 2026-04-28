import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import { PanelBody, TextControl, TextareaControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	const ligne1Json = JSON.stringify( attributes.ligne1 || [], null, 2 );
	const ligne2Json = JSON.stringify( attributes.ligne2 || [], null, 2 );
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Contenu', 'edigital' ) } initialOpen={ true }>
					<TextareaControl
						label={ __( 'Ligne 1 (JSON)', 'edigital' ) }
						help={ __( 'Format JSON — un objet par ligne.', 'edigital' ) }
						value={ ligne1Json }
						onChange={ ( v ) => {
							try { setAttributes( { ligne1: JSON.parse( v ) } ); } catch ( e ) {}
						} }
					/>
					<TextareaControl
						label={ __( 'Ligne 2 (JSON)', 'edigital' ) }
						help={ __( 'Format JSON — un objet par ligne.', 'edigital' ) }
						value={ ligne2Json }
						onChange={ ( v ) => {
							try { setAttributes( { ligne2: JSON.parse( v ) } ); } catch ( e ) {}
						} }
					/>
					<TextControl
						label={ __( 'URL séparateur', 'edigital' ) }
						value={ attributes.separateurUrl || '' }
						onChange={ ( v ) => setAttributes( { separateurUrl: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="edigital/text-ticker"
					attributes={ attributes }
					httpMethod="POST"
					EmptyResponsePlaceholder={ () => <p>{ __( 'Aucun contenu pour le moment.', 'edigital' ) }</p> }
					LoadingResponsePlaceholder={ () => <p>{ __( 'Chargement…', 'edigital' ) }</p> }
				/>
			</div>
		</>
	);
}

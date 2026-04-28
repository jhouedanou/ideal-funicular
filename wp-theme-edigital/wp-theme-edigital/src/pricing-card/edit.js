import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import { PanelBody, TextControl, TextareaControl, ToggleControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	const pointsJson = JSON.stringify( attributes.points || [], null, 2 );
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
					<TextControl
						label={ __( 'Prix', 'edigital' ) }
						value={ attributes.prix || '' }
						onChange={ ( v ) => setAttributes( { prix: v } ) }
					/>
					<TextareaControl
						label={ __( 'Points (JSON)', 'edigital' ) }
						help={ __( 'Format JSON — une chaîne par ligne.', 'edigital' ) }
						value={ pointsJson }
						onChange={ ( v ) => {
							try { setAttributes( { points: JSON.parse( v ) } ); } catch ( e ) {}
						} }
					/>
					<TextControl
						label={ __( 'Libellé CTA', 'edigital' ) }
						value={ attributes.libelleCta || '' }
						onChange={ ( v ) => setAttributes( { libelleCta: v } ) }
					/>
					<TextControl
						label={ __( 'Lien CTA', 'edigital' ) }
						value={ attributes.lienCta || '' }
						onChange={ ( v ) => setAttributes( { lienCta: v } ) }
					/>
					<ToggleControl
						label={ __( 'Carte mise en avant', 'edigital' ) }
						checked={ !! attributes.accent }
						onChange={ ( v ) => setAttributes( { accent: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="edigital/pricing-card"
					attributes={ attributes }
					httpMethod="POST"
					EmptyResponsePlaceholder={ () => <p>{ __( 'Aucun contenu pour le moment.', 'edigital' ) }</p> }
					LoadingResponsePlaceholder={ () => <p>{ __( 'Chargement…', 'edigital' ) }</p> }
				/>
			</div>
		</>
	);
}

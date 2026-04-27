import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const { icone, icoFamille, tag, titre, texte } = attributes;
	const blockProps = useBlockProps( {
		className: 'edigital-service-text-card-editor',
		style: {
			background: '#f8f8f8',
			borderLeft: '4px solid #e31414',
			padding: '32px 24px',
		},
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Icône Font Awesome', 'edigital' ) }>
					<SelectControl
						label={ __( 'Famille', 'edigital' ) }
						value={ icoFamille }
						options={ [
							{ label: 'Solid (fas)', value: 'fas' },
							{ label: 'Regular (far)', value: 'far' },
							{ label: 'Brands (fab)', value: 'fab' },
						] }
						onChange={ ( v ) => setAttributes( { icoFamille: v } ) }
					/>
					<TextControl
						label={ __( 'Classe d\'icône (ex: fa-laptop)', 'edigital' ) }
						value={ icone }
						onChange={ ( v ) => setAttributes( { icone: v } ) }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<div style={ { fontSize: '1.8rem', color: '#e31414', marginBottom: 12 } }>
					<i className={ `${ icoFamille } ${ icone }` }></i>
				</div>
				<RichText
					tagName="span"
					value={ tag }
					onChange={ ( v ) => setAttributes( { tag: v } ) }
					placeholder={ __( 'Tag (ex: Présence en ligne)', 'edigital' ) }
					allowedFormats={ [] }
					style={ {
						display: 'inline-block',
						fontSize: '0.72rem',
						fontWeight: 700,
						textTransform: 'uppercase',
						letterSpacing: '1.5px',
						color: '#e31414',
						marginBottom: 10,
					} }
				/>
				<RichText
					tagName="h3"
					value={ titre }
					onChange={ ( v ) => setAttributes( { titre: v } ) }
					placeholder={ __( 'Titre de la carte', 'edigital' ) }
					allowedFormats={ [] }
					style={ { fontSize: '1.25rem', fontWeight: 700, marginBottom: 12 } }
				/>
				<RichText
					tagName="p"
					value={ texte }
					onChange={ ( v ) => setAttributes( { texte: v } ) }
					placeholder={ __( 'Description', 'edigital' ) }
					style={ { fontSize: '0.95rem', lineHeight: 1.7, color: '#666', margin: 0 } }
				/>
			</div>
		</>
	);
}

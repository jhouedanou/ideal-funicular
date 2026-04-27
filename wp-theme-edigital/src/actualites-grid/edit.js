import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	SelectControl,
	RangeControl,
} from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const { titre, nombre, colonnes, libelleCta, lienCta, variante } = attributes;
	const blockProps = useBlockProps( { className: 'edigital-actualites-editor' } );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Grille', 'edigital' ) }>
					<RangeControl
						label={ __( 'Nombre d\'articles', 'edigital' ) }
						value={ nombre }
						min={ 1 }
						max={ 12 }
						onChange={ ( v ) => setAttributes( { nombre: v } ) }
					/>
					<SelectControl
						label={ __( 'Colonnes', 'edigital' ) }
						value={ colonnes }
						options={ [
							{ label: '2', value: '2' },
							{ label: '3', value: '3' },
							{ label: '4', value: '4' },
						] }
						onChange={ ( v ) => setAttributes( { colonnes: v } ) }
					/>
					<SelectControl
						label={ __( 'Variante', 'edigital' ) }
						value={ variante }
						options={ [
							{ label: __( 'Histoire (avec ticker)', 'edigital' ), value: 'histoire' },
							{ label: __( 'Section indépendante', 'edigital' ), value: 'section' },
						] }
						onChange={ ( v ) => setAttributes( { variante: v } ) }
					/>
				</PanelBody>
				<PanelBody title={ __( 'Bouton CTA', 'edigital' ) }>
					<TextControl
						label={ __( 'Libellé', 'edigital' ) }
						value={ libelleCta }
						onChange={ ( v ) => setAttributes( { libelleCta: v } ) }
					/>
					<TextControl
						label={ __( 'URL', 'edigital' ) }
						value={ lienCta }
						onChange={ ( v ) => setAttributes( { lienCta: v } ) }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<p className="edigital-actualites-editor__label">
					{ __( 'Bloc : Grille actualités (rendu dynamique depuis le CPT « Actualités »)', 'edigital' ) }
				</p>
				{ ( titre || variante === 'section' ) && (
					<RichText
						tagName="h2"
						value={ titre }
						onChange={ ( v ) => setAttributes( { titre: v } ) }
						placeholder={ __( 'Titre (optionnel)', 'edigital' ) }
						allowedFormats={ [] }
						style={ { fontSize: '1.5em', fontWeight: 700 } }
					/>
				) }
				<div
					style={ {
						display: 'grid',
						gridTemplateColumns: `repeat(${ Math.min( colonnes, nombre ) }, 1fr)`,
						gap: '12px',
						marginTop: '12px',
					} }
				>
					{ Array.from( { length: Math.min( nombre, 6 ) } ).map( ( _, idx ) => (
						<div
							key={ idx }
							style={ {
								background: '#f3f3f3',
								padding: '12px',
								borderRadius: '4px',
								fontSize: '0.85em',
								color: '#666',
							} }
						>
							{ __( 'Article', 'edigital' ) } #{ idx + 1 }
						</div>
					) ) }
				</div>
				<p style={ { fontSize: '0.85em', color: '#888', marginTop: '12px' } }>
					{ __(
						`Aperçu seulement — le rendu front affichera les ${ nombre } dernières actualités.`,
						'edigital'
					) }
				</p>
			</div>
		</>
	);
}

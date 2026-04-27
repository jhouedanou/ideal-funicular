import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	RichText,
} from '@wordpress/block-editor';
import { PanelBody, Button, TextControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const { titre, sousTitre, filtres } = attributes;
	const blockProps = useBlockProps( { className: 'edigital-projets-intro-editor' } );

	const update = ( i, key, val ) => {
		const next = filtres.slice();
		next[ i ] = { ...next[ i ], [ key ]: val };
		setAttributes( { filtres: next } );
	};
	const addItem = () =>
		setAttributes( { filtres: [ ...filtres, { label: '', slug: '' } ] } );
	const removeItem = ( i ) => {
		const next = filtres.slice();
		next.splice( i, 1 );
		setAttributes( { filtres: next } );
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Filtres', 'edigital' ) }>
					{ filtres.map( ( f, i ) => (
						<div
							key={ i }
							style={ { borderBottom: '1px solid #eee', marginBottom: 8, paddingBottom: 8 } }
						>
							<TextControl
								label={ __( 'Libellé', 'edigital' ) }
								value={ f.label || '' }
								onChange={ ( v ) => update( i, 'label', v ) }
							/>
							<TextControl
								label={ __( 'Slug (catégorie ou * pour tous)', 'edigital' ) }
								value={ f.slug || '' }
								onChange={ ( v ) => update( i, 'slug', v ) }
							/>
							<Button isDestructive variant="link" onClick={ () => removeItem( i ) }>
								{ __( 'Retirer', 'edigital' ) }
							</Button>
						</div>
					) ) }
					<Button variant="primary" onClick={ addItem }>
						{ __( '+ Ajouter un filtre', 'edigital' ) }
					</Button>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps } style={ { textAlign: 'center', padding: 24 } }>
				<RichText
					tagName="h2"
					value={ titre }
					onChange={ ( v ) => setAttributes( { titre: v } ) }
					placeholder={ __( 'Titre', 'edigital' ) }
					allowedFormats={ [ 'core/bold', 'core/italic' ] }
				/>
				<RichText
					tagName="p"
					value={ sousTitre }
					onChange={ ( v ) => setAttributes( { sousTitre: v } ) }
					placeholder={ __( 'Sous-titre (optionnel)', 'edigital' ) }
				/>
				<div style={ { marginTop: 16, display: 'flex', justifyContent: 'center', gap: 8, flexWrap: 'wrap' } }>
					{ filtres.map( ( f, i ) => (
						<span
							key={ i }
							style={ {
								padding: '6px 14px',
								borderRadius: 999,
								background: '#eee',
								fontSize: 13,
							} }
						>
							{ f.label || '—' }
						</span>
					) ) }
				</div>
			</div>
		</>
	);
}

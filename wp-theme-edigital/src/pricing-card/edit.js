import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	ToggleControl,
	Button,
	__experimentalVStack as VStack,
} from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const {
		titre,
		sousTitre,
		prix,
		points,
		libelleCta,
		lienCta,
		accent,
	} = attributes;
	const list = points || [];

	const blockProps = useBlockProps( {
		className: `edigital-pricing-card-editor${ accent ? ' is-accent' : '' }`,
		style: {
			border: '1px solid #eee',
			padding: '20px',
			borderRadius: '20px',
			background: accent ? '#000' : '#f9f9f9',
			color: accent ? '#fff' : 'inherit',
		},
	} );

	const updatePoint = ( idx, val ) => {
		const next = list.slice();
		next[ idx ] = val;
		setAttributes( { points: next } );
	};
	const addPoint = () => setAttributes( { points: [ ...list, '' ] } );
	const removePoint = ( idx ) => {
		const next = list.slice();
		next.splice( idx, 1 );
		setAttributes( { points: next } );
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Style', 'edigital' ) }>
					<ToggleControl
						label={ __( 'Carte mise en avant (fond noir)', 'edigital' ) }
						checked={ !! accent }
						onChange={ ( v ) => setAttributes( { accent: v } ) }
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
				<PanelBody title={ __( 'Points inclus', 'edigital' ) }>
					<VStack spacing={ 3 }>
						{ list.map( ( pt, idx ) => (
							<div
								key={ idx }
								style={ { display: 'flex', alignItems: 'flex-end', gap: 4 } }
							>
								<TextControl
									label={ `${ __( 'Point', 'edigital' ) } ${ idx + 1 }` }
									value={ pt }
									onChange={ ( v ) => updatePoint( idx, v ) }
								/>
								<Button
									isDestructive
									variant="secondary"
									size="small"
									onClick={ () => removePoint( idx ) }
								>
									{ __( '×', 'edigital' ) }
								</Button>
							</div>
						) ) }
						<Button variant="primary" onClick={ addPoint }>
							{ __( 'Ajouter un point', 'edigital' ) }
						</Button>
					</VStack>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<RichText
					tagName="h4"
					value={ titre }
					onChange={ ( v ) => setAttributes( { titre: v } ) }
					placeholder={ __( 'Titre offre', 'edigital' ) }
					allowedFormats={ [] }
				/>
				<RichText
					tagName="p"
					value={ sousTitre }
					onChange={ ( v ) => setAttributes( { sousTitre: v } ) }
					placeholder={ __( 'Sous-titre / cible', 'edigital' ) }
					allowedFormats={ [] }
					style={ { fontSize: '0.9rem', opacity: 0.8 } }
				/>
				<RichText
					tagName="div"
					value={ prix }
					onChange={ ( v ) => setAttributes( { prix: v } ) }
					placeholder={ __( 'Prix', 'edigital' ) }
					allowedFormats={ [] }
					style={ {
						fontSize: '1.6rem',
						fontWeight: 700,
						color: '#e31414',
						margin: '12px 0',
					} }
				/>
				<ul style={ { listStyle: 'none', padding: 0, fontSize: '0.9rem' } }>
					{ list.map( ( pt, idx ) => (
						<li key={ idx }>✓ { pt || <em>—</em> }</li>
					) ) }
				</ul>
			</div>
		</>
	);
}

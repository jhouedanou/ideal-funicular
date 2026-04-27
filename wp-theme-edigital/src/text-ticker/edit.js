import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	Button,
	__experimentalVStack as VStack,
} from '@wordpress/components';

function TickerLine( { label, items, onChange } ) {
	const update = ( idx, key, value ) => {
		const next = items.slice();
		next[ idx ] = { ...next[ idx ], [ key ]: value };
		onChange( next );
	};
	const add = () => onChange( [ ...items, { avant: '', mot: '', apres: '' } ] );
	const remove = ( idx ) => {
		const next = items.slice();
		next.splice( idx, 1 );
		onChange( next );
	};

	return (
		<PanelBody title={ label } initialOpen={ true }>
			<VStack spacing={ 4 }>
				{ items.map( ( item, idx ) => (
					<div
						key={ idx }
						style={ {
							border: '1px solid #ddd',
							padding: '8px',
							borderRadius: '4px',
						} }
					>
						<TextControl
							label={ __( 'Texte avant', 'edigital' ) }
							value={ item.avant || '' }
							onChange={ ( v ) => update( idx, 'avant', v ) }
						/>
						<TextControl
							label={ __( 'Mot mis en valeur', 'edigital' ) }
							value={ item.mot || '' }
							onChange={ ( v ) => update( idx, 'mot', v ) }
						/>
						<TextControl
							label={ __( 'Texte après', 'edigital' ) }
							value={ item.apres || '' }
							onChange={ ( v ) => update( idx, 'apres', v ) }
						/>
						<Button
							isDestructive
							variant="secondary"
							size="small"
							onClick={ () => remove( idx ) }
						>
							{ __( 'Retirer cet item', 'edigital' ) }
						</Button>
					</div>
				) ) }
				<Button variant="primary" onClick={ add }>
					{ __( 'Ajouter un item', 'edigital' ) }
				</Button>
			</VStack>
		</PanelBody>
	);
}

export default function Edit( { attributes, setAttributes } ) {
	const { ligne1, ligne2, separateurUrl } = attributes;
	const blockProps = useBlockProps( { className: 'edigital-ticker-editor' } );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Séparateur', 'edigital' ) }>
					<MediaUploadCheck>
						<MediaUpload
							allowedTypes={ [ 'image' ] }
							onSelect={ ( m ) =>
								setAttributes( { separateurUrl: m.url } )
							}
							render={ ( { open } ) => (
								<Button variant="secondary" onClick={ open }>
									{ separateurUrl
										? __( 'Changer l\'image séparateur', 'edigital' )
										: __( 'Choisir une image séparateur', 'edigital' ) }
								</Button>
							) }
						/>
					</MediaUploadCheck>
					{ separateurUrl && (
						<>
							<img
								src={ separateurUrl }
								alt=""
								style={ { maxWidth: '60px', marginTop: '8px' } }
							/>
							<Button
								isDestructive
								variant="link"
								onClick={ () => setAttributes( { separateurUrl: '' } ) }
							>
								{ __( 'Retirer le séparateur', 'edigital' ) }
							</Button>
						</>
					) }
				</PanelBody>
				<TickerLine
					label={ __( 'Ligne 1', 'edigital' ) }
					items={ ligne1 || [] }
					onChange={ ( v ) => setAttributes( { ligne1: v } ) }
				/>
				<TickerLine
					label={ __( 'Ligne 2', 'edigital' ) }
					items={ ligne2 || [] }
					onChange={ ( v ) => setAttributes( { ligne2: v } ) }
				/>
			</InspectorControls>

			<div { ...blockProps }>
				<p className="edigital-ticker-editor__label">
					{ __( 'Bloc : Bande défilante (texte)', 'edigital' ) }
				</p>
				<p>
					<strong>{ __( 'Ligne 1 :', 'edigital' ) }</strong>{ ' ' }
					{ ( ligne1 || [] )
						.map( ( i ) =>
							[ i.avant, i.mot, i.apres ].filter( Boolean ).join( ' ' )
						)
						.join( ' • ' ) || __( '— vide —', 'edigital' ) }
				</p>
				<p>
					<strong>{ __( 'Ligne 2 :', 'edigital' ) }</strong>{ ' ' }
					{ ( ligne2 || [] )
						.map( ( i ) =>
							[ i.avant, i.mot, i.apres ].filter( Boolean ).join( ' ' )
						)
						.join( ' • ' ) || __( '— vide —', 'edigital' ) }
				</p>
				<p style={ { fontSize: '12px', color: '#666' } }>
					{ __( 'Édition : panneau latéral droit.', 'edigital' ) }
				</p>
			</div>
		</>
	);
}

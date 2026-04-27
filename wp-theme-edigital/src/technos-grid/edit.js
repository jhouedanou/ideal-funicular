import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
	RichText,
} from '@wordpress/block-editor';
import { PanelBody, Button } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const { items } = attributes;
	const blockProps = useBlockProps( { className: 'edigital-technos-grid-editor' } );

	const update = ( i, key, val ) => {
		const next = items.slice();
		next[ i ] = { ...next[ i ], [ key ]: val };
		setAttributes( { items: next } );
	};
	const addItem = () =>
		setAttributes( {
			items: [
				...items,
				{ label: '', description: '', iconUrl: '', iconId: undefined },
			],
		} );
	const removeItem = ( i ) => {
		const next = items.slice();
		next.splice( i, 1 );
		setAttributes( { items: next } );
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Technologies', 'edigital' ) }>
					<Button variant="primary" onClick={ addItem }>
						{ __( '+ Ajouter une techno', 'edigital' ) }
					</Button>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<p style={ { fontWeight: 700, marginBottom: 16 } }>
					{ __( 'Grille Technologies', 'edigital' ) }
				</p>
				<div
					style={ {
						display: 'grid',
						gridTemplateColumns: 'repeat(auto-fill, minmax(220px, 1fr))',
						gap: 16,
					} }
				>
					{ items.map( ( item, i ) => (
						<div
							key={ i }
							style={ {
								border: '1px dashed #aaa',
								padding: 12,
								borderRadius: 8,
								textAlign: 'center',
							} }
						>
							<MediaUploadCheck>
								<MediaUpload
									allowedTypes={ [ 'image' ] }
									value={ item.iconId }
									onSelect={ ( m ) => {
										update( i, 'iconUrl', m.url );
										update( i, 'iconId', m.id );
									} }
									render={ ( { open } ) => (
										<Button variant="secondary" onClick={ open }>
											{ item.iconUrl
												? __( 'Changer icône', 'edigital' )
												: __( 'Choisir icône', 'edigital' ) }
										</Button>
									) }
								/>
							</MediaUploadCheck>
							{ item.iconUrl && (
								<img
									src={ item.iconUrl }
									alt=""
									style={ {
										width: 64,
										height: 64,
										objectFit: 'contain',
										margin: '8px auto',
										display: 'block',
									} }
								/>
							) }
							<RichText
								tagName="strong"
								value={ item.label }
								onChange={ ( v ) => update( i, 'label', v ) }
								placeholder={ __( 'Nom techno', 'edigital' ) }
								allowedFormats={ [] }
							/>
							<RichText
								tagName="p"
								value={ item.description }
								onChange={ ( v ) => update( i, 'description', v ) }
								placeholder={ __( 'Description', 'edigital' ) }
							/>
							<Button
								isDestructive
								variant="link"
								onClick={ () => removeItem( i ) }
							>
								{ __( 'Retirer', 'edigital' ) }
							</Button>
						</div>
					) ) }
				</div>
			</div>
		</>
	);
}

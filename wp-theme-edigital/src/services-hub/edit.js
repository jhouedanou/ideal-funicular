import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
	RichText,
} from '@wordpress/block-editor';
import { PanelBody, Button, TextControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const { items } = attributes;
	const blockProps = useBlockProps( { className: 'edigital-services-hub-editor' } );

	const update = ( i, key, val ) => {
		const next = items.slice();
		next[ i ] = { ...next[ i ], [ key ]: val };
		setAttributes( { items: next } );
	};
	const addItem = () =>
		setAttributes( {
			items: [
				...items,
				{
					titre: '',
					description: '',
					url: '',
					imageUrl: '',
					imageId: undefined,
				},
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
				<PanelBody title={ __( 'Services', 'edigital' ) }>
					<Button variant="primary" onClick={ addItem }>
						{ __( '+ Ajouter un service', 'edigital' ) }
					</Button>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<p style={ { fontWeight: 700, marginBottom: 16 } }>
					{ __( 'Hub Services', 'edigital' ) }
				</p>
				<div
					style={ {
						display: 'grid',
						gridTemplateColumns: 'repeat(3, 1fr)',
						gap: 24,
					} }
				>
					{ items.map( ( item, i ) => (
						<div
							key={ i }
							style={ {
								border: '1px dashed #aaa',
								padding: 16,
								borderRadius: 8,
							} }
						>
							<MediaUploadCheck>
								<MediaUpload
									allowedTypes={ [ 'image' ] }
									value={ item.imageId }
									onSelect={ ( m ) => {
										update( i, 'imageUrl', m.url );
										update( i, 'imageId', m.id );
									} }
									render={ ( { open } ) => (
										<Button variant="secondary" onClick={ open }>
											{ item.imageUrl
												? __( 'Changer image', 'edigital' )
												: __( 'Choisir image', 'edigital' ) }
										</Button>
									) }
								/>
							</MediaUploadCheck>
							{ item.imageUrl && (
								<img
									src={ item.imageUrl }
									alt=""
									style={ {
										width: '100%',
										height: 120,
										objectFit: 'cover',
										marginTop: 8,
									} }
								/>
							) }
							<RichText
								tagName="h4"
								value={ item.titre }
								onChange={ ( v ) => update( i, 'titre', v ) }
								placeholder={ __( 'Titre', 'edigital' ) }
								allowedFormats={ [] }
							/>
							<RichText
								tagName="p"
								value={ item.description }
								onChange={ ( v ) => update( i, 'description', v ) }
								placeholder={ __( 'Description', 'edigital' ) }
							/>
							<TextControl
								label={ __( 'Lien', 'edigital' ) }
								value={ item.url || '' }
								onChange={ ( v ) => update( i, 'url', v ) }
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

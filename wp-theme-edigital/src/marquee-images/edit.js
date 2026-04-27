import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	MediaPlaceholder,
	MediaUploadCheck,
	MediaUpload,
} from '@wordpress/block-editor';
import { Button, ButtonGroup } from '@wordpress/components';

const ALLOWED_TYPES = [ 'image' ];

export default function Edit( { attributes, setAttributes } ) {
	const { images } = attributes;
	const blockProps = useBlockProps( { className: 'edigital-marquee-editor' } );

	const onSelect = ( media ) => {
		const list = Array.isArray( media ) ? media : [ media ];
		const next = list.map( ( m ) => ( {
			id: m.id,
			url: m.url,
			alt: m.alt || '',
		} ) );
		setAttributes( { images: next } );
	};

	const removeImage = ( idx ) => {
		const next = images.slice();
		next.splice( idx, 1 );
		setAttributes( { images: next } );
	};

	if ( ! images || images.length === 0 ) {
		return (
			<div { ...blockProps }>
				<MediaPlaceholder
					accept="image/*"
					allowedTypes={ ALLOWED_TYPES }
					multiple="add"
					labels={ {
						title: __( 'Bande défilante d\'images', 'edigital' ),
						instructions: __(
							'Sélectionnez plusieurs images pour la bande défilante.',
							'edigital'
						),
					} }
					onSelect={ onSelect }
				/>
			</div>
		);
	}

	return (
		<div { ...blockProps }>
			<p className="edigital-marquee-editor__label">
				{ __( 'Bloc : Bande défilante (images)', 'edigital' ) }
			</p>
			<div className="edigital-marquee-editor__grid">
				{ images.map( ( img, idx ) => (
					<figure key={ img.id || idx } className="edigital-marquee-editor__item">
						<img src={ img.url } alt={ img.alt } />
						<Button
							isDestructive
							variant="secondary"
							size="small"
							onClick={ () => removeImage( idx ) }
						>
							{ __( 'Retirer', 'edigital' ) }
						</Button>
					</figure>
				) ) }
			</div>
			<MediaUploadCheck>
				<ButtonGroup>
					<MediaUpload
						multiple
						gallery
						allowedTypes={ ALLOWED_TYPES }
						value={ images.map( ( i ) => i.id ).filter( Boolean ) }
						onSelect={ onSelect }
						render={ ( { open } ) => (
							<Button variant="primary" onClick={ open }>
								{ __( 'Modifier la sélection', 'edigital' ) }
							</Button>
						) }
					/>
					<Button
						variant="secondary"
						isDestructive
						onClick={ () => setAttributes( { images: [] } ) }
					>
						{ __( 'Tout retirer', 'edigital' ) }
					</Button>
				</ButtonGroup>
			</MediaUploadCheck>
		</div>
	);
}

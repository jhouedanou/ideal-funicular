import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
	MediaPlaceholder,
} from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const { titre, categorie, imageUrl, imageAlt, lien } = attributes;
	const blockProps = useBlockProps( {
		className: 'edigital-expertise-card-editor',
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Lien', 'edigital' ) }>
					<TextControl
						label={ __( 'URL de destination', 'edigital' ) }
						value={ lien }
						onChange={ ( v ) => setAttributes( { lien: v } ) }
						help={ __(
							'Chemin relatif (/projet/...) ou URL complète.',
							'edigital'
						) }
					/>
				</PanelBody>
				<PanelBody title={ __( 'Image', 'edigital' ) }>
					<TextControl
						label={ __( 'Texte alternatif', 'edigital' ) }
						value={ imageAlt }
						onChange={ ( v ) => setAttributes( { imageAlt: v } ) }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				{ imageUrl ? (
					<figure>
						<img src={ imageUrl } alt={ imageAlt } />
						<MediaUploadCheck>
							<MediaUpload
								allowedTypes={ [ 'image' ] }
								value={ attributes.imageId }
								onSelect={ ( m ) =>
									setAttributes( {
										imageUrl: m.url,
										imageId: m.id,
										imageAlt: m.alt || imageAlt,
									} )
								}
								render={ ( { open } ) => (
									<Button variant="secondary" size="small" onClick={ open }>
										{ __( 'Changer l\'image', 'edigital' ) }
									</Button>
								) }
							/>
						</MediaUploadCheck>
					</figure>
				) : (
					<MediaPlaceholder
						accept="image/*"
						allowedTypes={ [ 'image' ] }
						labels={ { title: __( 'Image de la carte', 'edigital' ) } }
						onSelect={ ( m ) =>
							setAttributes( {
								imageUrl: m.url,
								imageId: m.id,
								imageAlt: m.alt || '',
							} )
						}
					/>
				) }
				<RichText
					tagName="h3"
					value={ titre }
					onChange={ ( v ) => setAttributes( { titre: v } ) }
					placeholder={ __( 'Titre de l\'expertise', 'edigital' ) }
					allowedFormats={ [] }
				/>
				<RichText
					tagName="span"
					className="edigital-expertise-card-editor__cat"
					value={ categorie }
					onChange={ ( v ) => setAttributes( { categorie: v } ) }
					placeholder={ __( 'Catégorie', 'edigital' ) }
					allowedFormats={ [] }
				/>
			</div>
		</>
	);
}

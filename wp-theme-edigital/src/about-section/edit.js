import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const {
		numero,
		titrePrincipal,
		imageUrl,
		videoUrl,
		sousTitre,
		etiquette,
	} = attributes;
	const blockProps = useBlockProps( {
		className: 'edigital-about-editor',
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Image parallax', 'edigital' ) }>
					<MediaUploadCheck>
						<MediaUpload
							allowedTypes={ [ 'image' ] }
							value={ attributes.imageId }
							onSelect={ ( m ) =>
								setAttributes( {
									imageUrl: m.url,
									imageId: m.id,
								} )
							}
							render={ ( { open } ) => (
								<Button variant="secondary" onClick={ open }>
									{ imageUrl
										? __( 'Changer l\'image', 'edigital' )
										: __( 'Choisir une image', 'edigital' ) }
								</Button>
							) }
						/>
					</MediaUploadCheck>
					{ imageUrl && (
						<>
							<img
								src={ imageUrl }
								alt=""
								style={ { maxWidth: '100%', marginTop: '8px' } }
							/>
							<Button
								isDestructive
								variant="link"
								onClick={ () =>
									setAttributes( {
										imageUrl: '',
										imageId: undefined,
									} )
								}
							>
								{ __( 'Retirer l\'image', 'edigital' ) }
							</Button>
						</>
					) }
				</PanelBody>
				<PanelBody title={ __( 'Vidéo popup', 'edigital' ) }>
					<TextControl
						label={ __( 'URL de la vidéo (mp4)', 'edigital' ) }
						value={ videoUrl }
						onChange={ ( v ) => setAttributes( { videoUrl: v } ) }
						help={ __(
							'Chemin relatif (/wp-content/...) ou URL complète. Laisser vide pour masquer le bouton lecture.',
							'edigital'
						) }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<p className="edigital-about-editor__label">
					{ __( 'Bloc : Section À Propos (numéro + image + vidéo)', 'edigital' ) }
				</p>
				<RichText
					tagName="p"
					className="edigital-about-editor__numero"
					value={ numero }
					onChange={ ( v ) => setAttributes( { numero: v } ) }
					placeholder={ __( 'Numéro (ex. -01)', 'edigital' ) }
					allowedFormats={ [] }
				/>
				<RichText
					tagName="h2"
					className="edigital-about-editor__title"
					value={ titrePrincipal }
					onChange={ ( v ) => setAttributes( { titrePrincipal: v } ) }
					placeholder={ __( 'Titre principal', 'edigital' ) }
					allowedFormats={ [ 'core/bold', 'core/italic' ] }
					style={ {
						fontSize: '1.6em',
						lineHeight: 1.2,
						fontWeight: 700,
					} }
				/>
				{ imageUrl && (
					<figure
						style={ {
							margin: '16px 0',
							position: 'relative',
							maxHeight: '240px',
							overflow: 'hidden',
						} }
					>
						<img
							src={ imageUrl }
							alt=""
							style={ {
								width: '100%',
								height: '100%',
								objectFit: 'cover',
							} }
						/>
						{ videoUrl && (
							<span
								style={ {
									position: 'absolute',
									top: '50%',
									left: '50%',
									transform: 'translate(-50%, -50%)',
									background: 'rgba(255,255,255,0.9)',
									color: '#000',
									padding: '12px 16px',
									borderRadius: '50%',
									fontSize: '20px',
								} }
							>
								▶
							</span>
						) }
					</figure>
				) }
				<RichText
					tagName="h3"
					className="edigital-about-editor__subtitle"
					value={ sousTitre }
					onChange={ ( v ) => setAttributes( { sousTitre: v } ) }
					placeholder={ __( 'Sous-titre', 'edigital' ) }
					allowedFormats={ [ 'core/bold', 'core/italic' ] }
					style={ {
						fontSize: '1.2em',
						lineHeight: 1.3,
						marginTop: '24px',
					} }
				/>
				<RichText
					tagName="p"
					className="edigital-about-editor__tag"
					value={ etiquette }
					onChange={ ( v ) => setAttributes( { etiquette: v } ) }
					placeholder={ __( 'Étiquette (ex. Expertise)', 'edigital' ) }
					allowedFormats={ [] }
					style={ {
						fontSize: '0.85em',
						color: '#666',
						textTransform: 'uppercase',
						letterSpacing: '1px',
					} }
				/>
			</div>
		</>
	);
}

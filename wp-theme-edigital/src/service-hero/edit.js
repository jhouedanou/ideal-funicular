import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import { PanelBody, TextControl, Button, ToggleControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';

export default function Edit( { attributes, setAttributes } ) {
	const {
		backgroundUrl,
		useFeaturedImage,
		breadcrumb1Label,
		breadcrumb1Url,
		breadcrumb2Label,
		breadcrumb2Url,
		breadcrumbCurrent,
		titre,
		sousTitre,
	} = attributes;

	// Récupère l'image mise en avant de la page courante (éditeur).
	const featuredImageUrl = useSelect( ( select ) => {
		const editor = select( 'core/editor' );
		if ( ! editor ) return '';
		const id = editor.getEditedPostAttribute( 'featured_media' );
		if ( ! id ) return '';
		const media = select( 'core' ).getMedia( id );
		return media?.source_url || '';
	}, [] );

	const effectiveBackground = useFeaturedImage && featuredImageUrl
		? featuredImageUrl
		: backgroundUrl;

	const blockProps = useBlockProps( {
		className: 'edigital-service-hero-editor',
		style: {
			background: effectiveBackground
				? `linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url(${ effectiveBackground }) center/cover no-repeat`
				: '#222',
			color: '#fff',
			padding: '120px 24px 80px',
			textAlign: 'center',
		},
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Image de fond', 'edigital' ) }>
					<ToggleControl
						label={ __( 'Utiliser l\'image mise en avant de la page', 'edigital' ) }
						help={ useFeaturedImage
							? __( 'L\'image mise en avant définie en sidebar sera utilisée.', 'edigital' )
							: __( 'Choisissez ci-dessous une image dédiée à ce bandeau.', 'edigital' ) }
						checked={ !! useFeaturedImage }
						onChange={ ( v ) => setAttributes( { useFeaturedImage: !! v } ) }
					/>
					{ ! useFeaturedImage && (
						<>
							<MediaUploadCheck>
								<MediaUpload
									allowedTypes={ [ 'image' ] }
									value={ attributes.backgroundId }
									onSelect={ ( m ) =>
										setAttributes( { backgroundUrl: m.url, backgroundId: m.id } )
									}
									render={ ( { open } ) => (
										<Button variant="secondary" onClick={ open }>
											{ backgroundUrl
												? __( 'Changer l\'image', 'edigital' )
												: __( 'Choisir une image', 'edigital' ) }
										</Button>
									) }
								/>
							</MediaUploadCheck>
							{ backgroundUrl && (
								<Button
									isDestructive
									variant="link"
									onClick={ () => setAttributes( { backgroundUrl: '', backgroundId: undefined } ) }
								>
									{ __( 'Retirer l\'image', 'edigital' ) }
								</Button>
							) }
						</>
					) }
					{ useFeaturedImage && ! featuredImageUrl && (
						<p style={ { fontSize: 12, color: '#cc1818' } }>
							{ __( 'Aucune image mise en avant définie pour cette page. Utilisez la sidebar « Image mise en avant ».', 'edigital' ) }
						</p>
					) }
				</PanelBody>

				<PanelBody title={ __( 'Fil d\'Ariane', 'edigital' ) } initialOpen={ false }>
					<TextControl
						label={ __( 'Libellé n°1', 'edigital' ) }
						value={ breadcrumb1Label }
						onChange={ ( v ) => setAttributes( { breadcrumb1Label: v } ) }
					/>
					<TextControl
						label={ __( 'URL n°1', 'edigital' ) }
						value={ breadcrumb1Url }
						onChange={ ( v ) => setAttributes( { breadcrumb1Url: v } ) }
					/>
					<TextControl
						label={ __( 'Libellé n°2', 'edigital' ) }
						value={ breadcrumb2Label }
						onChange={ ( v ) => setAttributes( { breadcrumb2Label: v } ) }
					/>
					<TextControl
						label={ __( 'URL n°2', 'edigital' ) }
						value={ breadcrumb2Url }
						onChange={ ( v ) => setAttributes( { breadcrumb2Url: v } ) }
					/>
					<TextControl
						label={ __( 'Page courante', 'edigital' ) }
						value={ breadcrumbCurrent }
						onChange={ ( v ) => setAttributes( { breadcrumbCurrent: v } ) }
					/>
				</PanelBody>
			</InspectorControls>

			<section { ...blockProps }>
				<div style={ { fontSize: 13, opacity: 0.7, marginBottom: 12 } }>
					{ breadcrumb1Label } / { breadcrumb2Label } /{ ' ' }
					{ breadcrumbCurrent || __( 'Page courante', 'edigital' ) }
				</div>
				<RichText
					tagName="h1"
					value={ titre }
					onChange={ ( v ) => setAttributes( { titre: v } ) }
					placeholder={ __( 'Titre de la page', 'edigital' ) }
					allowedFormats={ [] }
					style={ { fontSize: 48, fontWeight: 700, margin: '0 0 16px' } }
				/>
				<RichText
					tagName="p"
					value={ sousTitre }
					onChange={ ( v ) => setAttributes( { sousTitre: v } ) }
					placeholder={ __( 'Sous-titre / accroche', 'edigital' ) }
					style={ { fontSize: 18, color: '#cfcfcf', maxWidth: 800, margin: '0 auto' } }
				/>
			</section>
		</>
	);
}

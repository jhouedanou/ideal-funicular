import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import { PanelBody, Button } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const { backgroundUrl, titreLigne1, titreLigne2 } = attributes;
	const blockProps = useBlockProps( {
		className: 'edigital-parallax-editor',
		style: backgroundUrl
			? {
					backgroundImage: `url(${ backgroundUrl })`,
					backgroundSize: 'cover',
					backgroundPosition: 'center',
					padding: '80px 24px',
					color: '#fff',
					textShadow: '0 1px 4px rgba(0,0,0,0.4)',
			  }
			: { padding: '80px 24px', background: '#222', color: '#fff' },
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Image de fond', 'edigital' ) }>
					<MediaUploadCheck>
						<MediaUpload
							allowedTypes={ [ 'image' ] }
							value={ attributes.backgroundId }
							onSelect={ ( m ) =>
								setAttributes( {
									backgroundUrl: m.url,
									backgroundId: m.id,
								} )
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
							onClick={ () =>
								setAttributes( {
									backgroundUrl: '',
									backgroundId: undefined,
								} )
							}
						>
							{ __( 'Retirer l\'image', 'edigital' ) }
						</Button>
					) }
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<RichText
					tagName="h2"
					value={ titreLigne1 }
					onChange={ ( v ) => setAttributes( { titreLigne1: v } ) }
					placeholder={ __( 'Titre — ligne 1', 'edigital' ) }
					allowedFormats={ [] }
					style={ { fontSize: '2.4em', margin: 0 } }
				/>
				<RichText
					tagName="h2"
					value={ titreLigne2 }
					onChange={ ( v ) => setAttributes( { titreLigne2: v } ) }
					placeholder={ __( 'Titre — ligne 2', 'edigital' ) }
					allowedFormats={ [] }
					style={ { fontSize: '2.4em', margin: 0 } }
				/>
			</div>
		</>
	);
}

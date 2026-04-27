import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	useInnerBlocksProps,
	RichText,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import { PanelBody, Button } from '@wordpress/components';

const ALLOWED = [ 'edigital/client-logo' ];
const TEMPLATE = [
	[ 'edigital/client-logo', { libelle: 'TOTAL CI', police: 'cinzel' } ],
	[ 'edigital/client-logo', { libelle: 'Yves Rocher', police: 'playfair' } ],
	[ 'edigital/client-logo', { libelle: 'Raufils Assurance', police: 'caveat' } ],
];

export default function Edit( { attributes, setAttributes } ) {
	const { titreLigne1, titreLigne2, backgroundUrl, backgroundId } = attributes;
	const blockProps = useBlockProps( { className: 'edigital-clients-editor' } );
	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'edigital-clients-editor__logos' },
		{ allowedBlocks: ALLOWED, template: TEMPLATE, orientation: 'horizontal' }
	);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Image de fond', 'edigital' ) }>
					<MediaUploadCheck>
						<MediaUpload
							allowedTypes={ [ 'image' ] }
							value={ backgroundId }
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
							{ __( 'Retirer', 'edigital' ) }
						</Button>
					) }
				</PanelBody>
			</InspectorControls>

			<section { ...blockProps }>
				<RichText
					tagName="h2"
					value={ titreLigne1 }
					onChange={ ( v ) => setAttributes( { titreLigne1: v } ) }
					placeholder={ __( 'Titre — ligne 1', 'edigital' ) }
					allowedFormats={ [] }
				/>
				<RichText
					tagName="h2"
					value={ titreLigne2 }
					onChange={ ( v ) => setAttributes( { titreLigne2: v } ) }
					placeholder={ __( 'Titre — ligne 2', 'edigital' ) }
					allowedFormats={ [] }
				/>
				<div { ...innerBlocksProps } />
			</section>
		</>
	);
}

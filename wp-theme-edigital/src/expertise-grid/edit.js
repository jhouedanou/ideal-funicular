import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	useInnerBlocksProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

const ALLOWED = [ 'edigital/expertise-card' ];
const TEMPLATE = [
	[ 'edigital/expertise-card', {} ],
	[ 'edigital/expertise-card', {} ],
	[ 'edigital/expertise-card', {} ],
];

export default function Edit( { attributes, setAttributes } ) {
	const { titre, texteCta, libelleCta, lienCta } = attributes;
	const blockProps = useBlockProps( {
		className: 'edigital-expertise-grid-editor',
	} );
	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'edigital-expertise-grid-editor__cards' },
		{
			allowedBlocks: ALLOWED,
			template: TEMPLATE,
			orientation: 'horizontal',
		}
	);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Bouton CTA', 'edigital' ) }>
					<TextControl
						label={ __( 'Texte d\'introduction', 'edigital' ) }
						value={ texteCta }
						onChange={ ( v ) => setAttributes( { texteCta: v } ) }
					/>
					<TextControl
						label={ __( 'Libellé du lien', 'edigital' ) }
						value={ libelleCta }
						onChange={ ( v ) => setAttributes( { libelleCta: v } ) }
					/>
					<TextControl
						label={ __( 'URL du lien', 'edigital' ) }
						value={ lienCta }
						onChange={ ( v ) => setAttributes( { lienCta: v } ) }
					/>
				</PanelBody>
			</InspectorControls>

			<section { ...blockProps }>
				<RichText
					tagName="h2"
					className="edigital-expertise-grid-editor__title"
					value={ titre }
					onChange={ ( v ) => setAttributes( { titre: v } ) }
					placeholder={ __( 'Titre de la section', 'edigital' ) }
					allowedFormats={ [ 'core/bold', 'core/italic' ] }
				/>
				<div { ...innerBlocksProps } />
			</section>
		</>
	);
}

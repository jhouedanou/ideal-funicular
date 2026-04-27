import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	useInnerBlocksProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';

const ALLOWED = [ 'edigital/accordion-item' ];
const TEMPLATE = [
	[ 'edigital/accordion-item', { titre: 'CRÉATION WEB' } ],
	[ 'edigital/accordion-item', { titre: 'APP MOBILE' } ],
	[ 'edigital/accordion-item', { titre: 'APP MÉTIER' } ],
];

export default function Edit( { attributes, setAttributes } ) {
	const { titre, alignement } = attributes;
	const blockProps = useBlockProps( {
		className: 'edigital-accordion-editor',
	} );
	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'edigital-accordion-editor__items' },
		{ allowedBlocks: ALLOWED, template: TEMPLATE }
	);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Affichage', 'edigital' ) }>
					<SelectControl
						label={ __( 'Alignement', 'edigital' ) }
						value={ alignement }
						options={ [
							{ label: __( 'Droite', 'edigital' ), value: 'right' },
							{ label: __( 'Gauche', 'edigital' ), value: 'left' },
						] }
						onChange={ ( v ) => setAttributes( { alignement: v } ) }
					/>
				</PanelBody>
			</InspectorControls>

			<section { ...blockProps }>
				<RichText
					tagName="h2"
					className="edigital-accordion-editor__title"
					value={ titre }
					onChange={ ( v ) => setAttributes( { titre: v } ) }
					placeholder={ __( 'Titre de la section', 'edigital' ) }
					allowedFormats={ [] }
				/>
				<div { ...innerBlocksProps } />
			</section>
		</>
	);
}

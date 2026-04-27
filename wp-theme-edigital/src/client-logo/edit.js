import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, SelectControl, RangeControl } from '@wordpress/components';

const FONT_OPTIONS = [
	{ label: 'Cinzel', value: 'cinzel' },
	{ label: 'Playfair Display (italic)', value: 'playfair' },
	{ label: 'Caveat', value: 'caveat' },
	{ label: 'Oswald', value: 'oswald' },
	{ label: 'Dancing Script', value: 'dancing' },
	{ label: 'Unbounded', value: 'unbounded' },
	{ label: 'Montserrat (Black)', value: 'montserrat' },
];

const FONT_CSS = {
	cinzel: "'Cinzel', serif",
	playfair: "'Playfair Display', serif",
	caveat: "'Caveat', cursive",
	oswald: "'Oswald', sans-serif",
	dancing: "'Dancing Script', cursive",
	unbounded: "'Unbounded', sans-serif",
	montserrat: "'Montserrat', sans-serif",
};

export default function Edit( { attributes, setAttributes } ) {
	const { libelle, police, taille } = attributes;
	const blockProps = useBlockProps( {
		className: 'edigital-client-logo-editor',
		style: {
			fontFamily: FONT_CSS[ police ] || 'inherit',
			fontStyle: police === 'playfair' ? 'italic' : 'normal',
			fontWeight: police === 'montserrat' ? 900 : 700,
			fontSize: `${ taille }px`,
			color: '#9e9e9e',
			textAlign: 'center',
			padding: '12px',
		},
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Typographie', 'edigital' ) }>
					<SelectControl
						label={ __( 'Police', 'edigital' ) }
						value={ police }
						options={ FONT_OPTIONS }
						onChange={ ( v ) => setAttributes( { police: v } ) }
					/>
					<RangeControl
						label={ __( 'Taille (px)', 'edigital' ) }
						value={ taille }
						min={ 20 }
						max={ 60 }
						onChange={ ( v ) => setAttributes( { taille: v } ) }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<RichText
					tagName="span"
					value={ libelle }
					onChange={ ( v ) => setAttributes( { libelle: v } ) }
					placeholder={ __( 'Nom du client', 'edigital' ) }
					allowedFormats={ [] }
				/>
			</div>
		</>
	);
}

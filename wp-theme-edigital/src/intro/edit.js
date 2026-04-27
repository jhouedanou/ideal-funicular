import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const { titreLigne1, titreLigne2, etiquette, ancre } = attributes;
	const blockProps = useBlockProps( { className: 'edigital-intro-editor' } );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Paramètres', 'edigital' ) }>
					<TextControl
						label={ __( 'Ancre HTML (id)', 'edigital' ) }
						help={ __( 'Permet de cibler la section avec un lien #ancre.', 'edigital' ) }
						value={ ancre || '' }
						onChange={ ( v ) => setAttributes( { ancre: v } ) }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<p className="edigital-intro-editor__label">
					{ __( 'Bloc : Intro « À Propos »', 'edigital' ) }
				</p>
				<RichText
					tagName="h1"
					className="edigital-intro-editor__title"
					value={ titreLigne1 }
					onChange={ ( v ) => setAttributes( { titreLigne1: v } ) }
					placeholder={ __( 'Titre — ligne 1', 'edigital' ) }
					allowedFormats={ [] }
				/>
				<RichText
					tagName="h1"
					className="edigital-intro-editor__title"
					value={ titreLigne2 }
					onChange={ ( v ) => setAttributes( { titreLigne2: v } ) }
					placeholder={ __( 'Titre — ligne 2', 'edigital' ) }
					allowedFormats={ [] }
				/>
				<RichText
					tagName="h2"
					className="edigital-intro-editor__tag"
					value={ etiquette }
					onChange={ ( v ) => setAttributes( { etiquette: v } ) }
					placeholder={ __( 'Étiquette (ex. À Propos)', 'edigital' ) }
					allowedFormats={ [] }
				/>
			</div>
		</>
	);
}

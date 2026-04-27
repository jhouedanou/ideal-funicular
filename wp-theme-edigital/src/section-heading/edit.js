import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const { titre, etiquette, variante } = attributes;
	const blockProps = useBlockProps( { className: 'edigital-section-heading-editor' } );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Variante', 'edigital' ) }>
					<SelectControl
						label={ __( 'Style', 'edigital' ) }
						value={ variante }
						options={ [
							{ label: __( 'Standard', 'edigital' ), value: 'default' },
							{ label: __( 'Dernière (avec espace bas)', 'edigital' ), value: 'last' },
						] }
						onChange={ ( v ) => setAttributes( { variante: v } ) }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<p className="edigital-section-heading-editor__label">
					{ __( 'Bloc : Titre de section', 'edigital' ) }
				</p>
				<RichText
					tagName="h2"
					value={ titre }
					onChange={ ( v ) => setAttributes( { titre: v } ) }
					placeholder={ __( 'Grand titre éditorial', 'edigital' ) }
					allowedFormats={ [ 'core/bold', 'core/italic' ] }
					style={ { fontSize: '1.5em', lineHeight: 1.3, fontWeight: 700 } }
				/>
				<RichText
					tagName="p"
					value={ etiquette }
					onChange={ ( v ) => setAttributes( { etiquette: v } ) }
					placeholder={ __( 'Tag (ex. Histoire)', 'edigital' ) }
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

import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import { PanelBody, TextControl, SelectControl, RangeControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Contenu', 'edigital' ) } initialOpen={ true }>
					<TextControl
						label={ __( 'Libellé', 'edigital' ) }
						value={ attributes.libelle || '' }
						onChange={ ( v ) => setAttributes( { libelle: v } ) }
					/>
					<SelectControl
						label={ __( 'Police', 'edigital' ) }
						value={ attributes.police || 'cinzel' }
						options={ [
							{ label: 'Cinzel', value: 'cinzel' },
							{ label: 'Playfair', value: 'playfair' },
							{ label: 'Caveat', value: 'caveat' },
							{ label: 'Oswald', value: 'oswald' },
							{ label: 'Dancing', value: 'dancing' },
							{ label: 'Unbounded', value: 'unbounded' },
							{ label: 'Montserrat', value: 'montserrat' },
						] }
						onChange={ ( v ) => setAttributes( { police: v } ) }
					/>
					<RangeControl
						label={ __( 'Taille (px)', 'edigital' ) }
						value={ attributes.taille || 38 }
						onChange={ ( v ) => setAttributes( { taille: v } ) }
						min={ 12 }
						max={ 100 }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="edigital/client-logo"
					attributes={ attributes }
					httpMethod="POST"
					EmptyResponsePlaceholder={ () => <p>{ __( 'Aucun contenu pour le moment.', 'edigital' ) }</p> }
					LoadingResponsePlaceholder={ () => <p>{ __( 'Chargement…', 'edigital' ) }</p> }
				/>
			</div>
		</>
	);
}

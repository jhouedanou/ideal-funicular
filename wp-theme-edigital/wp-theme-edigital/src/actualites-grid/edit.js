import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import { PanelBody, TextControl, RangeControl, SelectControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Contenu', 'edigital' ) } initialOpen={ true }>
					<TextControl
						label={ __( 'Titre', 'edigital' ) }
						value={ attributes.titre || '' }
						onChange={ ( v ) => setAttributes( { titre: v } ) }
					/>
					<RangeControl
						label={ __( 'Nombre d’articles', 'edigital' ) }
						value={ attributes.nombre || 6 }
						onChange={ ( v ) => setAttributes( { nombre: v } ) }
						min={ 1 }
						max={ 24 }
					/>
					<SelectControl
						label={ __( 'Colonnes', 'edigital' ) }
						value={ attributes.colonnes || '3' }
						options={ [
							{ label: '2', value: '2' },
							{ label: '3', value: '3' },
							{ label: '4', value: '4' },
						] }
						onChange={ ( v ) => setAttributes( { colonnes: v } ) }
					/>
					<SelectControl
						label={ __( 'Variante', 'edigital' ) }
						value={ attributes.variante || 'histoire' }
						options={ [
							{ label: __( 'Histoire', 'edigital' ), value: 'histoire' },
							{ label: __( 'Section', 'edigital' ), value: 'section' },
						] }
						onChange={ ( v ) => setAttributes( { variante: v } ) }
					/>
					<TextControl
						label={ __( 'Libellé CTA', 'edigital' ) }
						value={ attributes.libelleCta || '' }
						onChange={ ( v ) => setAttributes( { libelleCta: v } ) }
					/>
					<TextControl
						label={ __( 'Lien CTA', 'edigital' ) }
						value={ attributes.lienCta || '' }
						onChange={ ( v ) => setAttributes( { lienCta: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="edigital/actualites-grid"
					attributes={ attributes }
					httpMethod="POST"
					EmptyResponsePlaceholder={ () => <p>{ __( 'Aucun contenu pour le moment.', 'edigital' ) }</p> }
					LoadingResponsePlaceholder={ () => <p>{ __( 'Chargement…', 'edigital' ) }</p> }
				/>
			</div>
		</>
	);
}

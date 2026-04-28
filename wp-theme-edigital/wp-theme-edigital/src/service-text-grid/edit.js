import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, RangeControl } from '@wordpress/components';

const ALLOWED = [ 'edigital/service-text-card' ];
const TEMPLATE = [
	[ 'edigital/service-text-card' ],
	[ 'edigital/service-text-card' ],
	[ 'edigital/service-text-card' ],
];

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps( { className: 'edigital-service-text-grid-editor' } );
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Mise en page', 'edigital' ) } initialOpen={ true }>
					<RangeControl
						label={ __( 'Colonnes', 'edigital' ) }
						value={ attributes.colonnes || 3 }
						onChange={ ( v ) => setAttributes( { colonnes: v } ) }
						min={ 1 }
						max={ 6 }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<InnerBlocks allowedBlocks={ ALLOWED } template={ TEMPLATE } />
			</div>
		</>
	);
}

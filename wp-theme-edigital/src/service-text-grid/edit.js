import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	useInnerBlocksProps,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody, RangeControl } from '@wordpress/components';

const ALLOWED = [ 'edigital/service-text-card' ];
const TEMPLATE = [
	[ 'edigital/service-text-card', {} ],
	[ 'edigital/service-text-card', {} ],
	[ 'edigital/service-text-card', {} ],
];

export default function Edit( { attributes, setAttributes } ) {
	const { colonnes } = attributes;
	const blockProps = useBlockProps( { className: 'edigital-service-text-grid-editor' } );
	const innerBlocksProps = useInnerBlocksProps(
		{
			className: 'edigital-service-text-grid-editor__inner',
			style: {
				display: 'grid',
				gridTemplateColumns: `repeat(${ colonnes }, 1fr)`,
				gap: 32,
			},
		},
		{ allowedBlocks: ALLOWED, template: TEMPLATE, orientation: 'horizontal' }
	);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Disposition', 'edigital' ) }>
					<RangeControl
						label={ __( 'Colonnes', 'edigital' ) }
						min={ 1 }
						max={ 4 }
						value={ colonnes }
						onChange={ ( v ) => setAttributes( { colonnes: v } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<div { ...innerBlocksProps } />
			</div>
		</>
	);
}

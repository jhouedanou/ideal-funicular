import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	useInnerBlocksProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	Button,
	__experimentalVStack as VStack,
} from '@wordpress/components';

const ALLOWED = [ 'edigital/pricing-card' ];
const TEMPLATE = [
	[ 'edigital/pricing-card', { titre: 'Site Vitrine', accent: false } ],
	[ 'edigital/pricing-card', { titre: 'Site E-commerce', accent: true } ],
	[ 'edigital/pricing-card', { titre: 'App Mobile', accent: false } ],
];

export default function Edit( { attributes, setAttributes } ) {
	const { titre, ancre, extras } = attributes;
	const blockProps = useBlockProps( { className: 'edigital-pricing-editor' } );
	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'edigital-pricing-editor__cards' },
		{ allowedBlocks: ALLOWED, template: TEMPLATE, orientation: 'horizontal' }
	);

	const list = extras || [];
	const updateExtra = ( idx, key, val ) => {
		const next = list.slice();
		next[ idx ] = { ...next[ idx ], [ key ]: val };
		setAttributes( { extras: next } );
	};
	const addExtra = () =>
		setAttributes( { extras: [ ...list, { libelle: '', prix: '' } ] } );
	const removeExtra = ( idx ) => {
		const next = list.slice();
		next.splice( idx, 1 );
		setAttributes( { extras: next } );
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Section', 'edigital' ) }>
					<TextControl
						label={ __( 'Ancre HTML (id)', 'edigital' ) }
						value={ ancre || '' }
						onChange={ ( v ) => setAttributes( { ancre: v } ) }
					/>
				</PanelBody>
				<PanelBody
					title={ __( 'Bandeau additionnel (lignes prix)', 'edigital' ) }
					initialOpen={ false }
				>
					<VStack spacing={ 4 }>
						{ list.map( ( item, idx ) => (
							<div
								key={ idx }
								style={ {
									border: '1px solid #ddd',
									padding: '8px',
									borderRadius: '4px',
								} }
							>
								<TextControl
									label={ __( 'Libellé', 'edigital' ) }
									value={ item.libelle || '' }
									onChange={ ( v ) => updateExtra( idx, 'libelle', v ) }
								/>
								<TextControl
									label={ __( 'Prix / mention', 'edigital' ) }
									value={ item.prix || '' }
									onChange={ ( v ) => updateExtra( idx, 'prix', v ) }
								/>
								<Button
									isDestructive
									variant="secondary"
									size="small"
									onClick={ () => removeExtra( idx ) }
								>
									{ __( 'Retirer', 'edigital' ) }
								</Button>
							</div>
						) ) }
						<Button variant="primary" onClick={ addExtra }>
							{ __( 'Ajouter une ligne', 'edigital' ) }
						</Button>
					</VStack>
				</PanelBody>
			</InspectorControls>

			<section { ...blockProps }>
				<RichText
					tagName="h2"
					className="edigital-pricing-editor__title"
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

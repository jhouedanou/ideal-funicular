import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function Edit( { attributes, setAttributes } ) {
	const {
		telLabel,
		telValue,
		emailLabel,
		emailValue,
		horairesLabel,
		horairesValue,
	} = attributes;
	const blockProps = useBlockProps( {
		className: 'edigital-contact-info-editor',
		style: {
			background: '#f8f8f8',
			padding: 24,
			borderRadius: 12,
		},
	} );

	return (
		<div { ...blockProps }>
			<RichText
				tagName="h4"
				value={ telLabel }
				onChange={ ( v ) => setAttributes( { telLabel: v } ) }
				placeholder={ __( 'Label téléphone', 'edigital' ) }
				allowedFormats={ [] }
			/>
			<RichText
				tagName="p"
				value={ telValue }
				onChange={ ( v ) => setAttributes( { telValue: v } ) }
				placeholder={ __( 'Numéro', 'edigital' ) }
				style={ { fontSize: '1.1rem', fontWeight: 700 } }
			/>
			<RichText
				tagName="h4"
				value={ emailLabel }
				onChange={ ( v ) => setAttributes( { emailLabel: v } ) }
				placeholder={ __( 'Label email', 'edigital' ) }
				allowedFormats={ [] }
			/>
			<RichText
				tagName="p"
				value={ emailValue }
				onChange={ ( v ) => setAttributes( { emailValue: v } ) }
				placeholder={ __( 'Adresse email', 'edigital' ) }
			/>
			<RichText
				tagName="h4"
				value={ horairesLabel }
				onChange={ ( v ) => setAttributes( { horairesLabel: v } ) }
				placeholder={ __( 'Label horaires', 'edigital' ) }
				allowedFormats={ [] }
			/>
			<RichText
				tagName="p"
				value={ horairesValue }
				onChange={ ( v ) => setAttributes( { horairesValue: v } ) }
				placeholder={ __( 'Horaires', 'edigital' ) }
			/>
		</div>
	);
}

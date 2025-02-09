import { InspectorControls, InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import './editor.scss';

const ALLOWED_BLOCKS = [
	'fs-blocks/row-block',
	'core/spacer',
	'core/separator',
	'core/group',
	'core/columns'
];

const additionalClassOptions = [
	{ label: __( 'Default', 'fs-blocks' ), value: '' },
	{ label: __( 'Fluid', 'fs-blocks' ), value: 'container-fluid' }
];

const Edit = ( { attributes, setAttributes } ) => {
	const { additionalClass } = attributes;
	// Always include the default "container" class.
	const containerClasses = additionalClass ? `wp-block-fancysquares-container-block container ${ additionalClass }` : 'wp-block-fancysquares-container-block container';

	const blockProps = useBlockProps();

	return (
		<Fragment>
			<InspectorControls>
				<PanelBody title={ __( 'Container Settings', 'fs-blocks' ) } initialOpen={ true }>
					<SelectControl
						label={ __( 'Additional Class', 'fs-blocks' ) }
						value={ additionalClass }
						options={ additionalClassOptions }
						onChange={ ( newVal ) => setAttributes( { additionalClass: newVal } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps } className={ containerClasses }>
				{/* <InnerBlocks /> */}
				<InnerBlocks
					allowedBlocks={ ALLOWED_BLOCKS }
					template={[['fs-blocks/row-block']]}
				/>
			</div>
		</Fragment>
	);
};

export default Edit;

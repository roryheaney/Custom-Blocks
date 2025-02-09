import { InspectorControls, InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, FormTokenField } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import './editor.scss';

// Import your class definition arrays
import {
  rowOptions,
  justifyContentOptions,
  alignItemsOptions,
  marginOptions,
  paddingOptions,
} from '../../data/bootstrap-classes/classes.js';

// Convert each array of { label, value } to an array of strings for FormTokenField suggestions
const rowSuggestions              = rowOptions.map( (item) => item.value );
const justifyContentSuggestions   = justifyContentOptions.map( (item) => item.value );
const alignItemsSuggestions       = alignItemsOptions.map( (item) => item.value );
const marginSuggestions           = marginOptions.map( (item) => item.value );
const paddingSuggestions          = paddingOptions.map( (item) => item.value );

/**
 * Utility to combine all selected sets into one final array.
 */
function combineAllClasses(
  rowArr,
  justifyArr,
  alignArr,
  marginArr,
  paddingArr
) {
  return [
    ...rowArr,
    ...justifyArr,
    ...alignArr,
    ...marginArr,
    ...paddingArr
  ];
}

// Define which child blocks are allowed (as in your original code).
const ALLOWED_BLOCKS = [ 'fs-blocks/column-block' ];

export default function Edit( { attributes, setAttributes } ) {
  const {
    rowOptions: rowValues,
    justifyContentOptions: justifyValues,
    alignItemsOptions: alignValues,
    marginOptions: marginValues,
    paddingOptions: paddingValues,
    additionalClasses,
  } = attributes;

  // For each token field, when it changes, update that part's attribute + re-merge everything.
  const onChangeRowOptions = ( newTokens ) => {
    setAttributes( { rowOptions: newTokens } );
    const merged = combineAllClasses(
      newTokens,
      justifyValues,
      alignValues,
      marginValues,
      paddingValues
    );
    setAttributes( { additionalClasses: merged } );
  };

  const onChangeJustifyContentOptions = ( newTokens ) => {
    setAttributes( { justifyContentOptions: newTokens } );
    const merged = combineAllClasses(
      rowValues,
      newTokens,
      alignValues,
      marginValues,
      paddingValues
    );
    setAttributes( { additionalClasses: merged } );
  };

  const onChangeAlignItemsOptions = ( newTokens ) => {
    setAttributes( { alignItemsOptions: newTokens } );
    const merged = combineAllClasses(
      rowValues,
      justifyValues,
      newTokens,
      marginValues,
      paddingValues
    );
    setAttributes( { additionalClasses: merged } );
  };

  const onChangeMarginOptions = ( newTokens ) => {
    setAttributes( { marginOptions: newTokens } );
    const merged = combineAllClasses(
      rowValues,
      justifyValues,
      alignValues,
      newTokens,
      paddingValues
    );
    setAttributes( { additionalClasses: merged } );
  };

  const onChangePaddingOptions = ( newTokens ) => {
    setAttributes( { paddingOptions: newTokens } );
    const merged = combineAllClasses(
      rowValues,
      justifyValues,
      alignValues,
      marginValues,
      newTokens
    );
    setAttributes( { additionalClasses: merged } );
  };

  // For the editor preview, we can combine a base class + the final `additionalClasses`.
  // You might always want "row" as a base class.
  const previewClassString = [
    'wp-block-fancysquares-row-block',
    'row',
    ...additionalClasses
  ].join( ' ' );

  const blockProps = useBlockProps();

  return (
    <Fragment>
      <InspectorControls>
        <PanelBody title={ __( 'Row Settings', 'fs-blocks' ) } initialOpen={ true }>

          <FormTokenField
            label={ __( 'Row Classes', 'fs-blocks' ) }
            value={ rowValues }
            suggestions={ rowSuggestions }
            onChange={ onChangeRowOptions }
          />

          <FormTokenField
            label={ __( 'Justify Content Classes', 'fs-blocks' ) }
            value={ justifyValues }
            suggestions={ justifyContentSuggestions }
            onChange={ onChangeJustifyContentOptions }
          />

          <FormTokenField
            label={ __( 'Align Items Classes', 'fs-blocks' ) }
            value={ alignValues }
            suggestions={ alignItemsSuggestions }
            onChange={ onChangeAlignItemsOptions }
          />

          <FormTokenField
            label={ __( 'Margin Classes', 'fs-blocks' ) }
            value={ marginValues }
            suggestions={ marginSuggestions }
            onChange={ onChangeMarginOptions }
          />

          <FormTokenField
            label={ __( 'Padding Classes', 'fs-blocks' ) }
            value={ paddingValues }
            suggestions={ paddingSuggestions }
            onChange={ onChangePaddingOptions }
          />

        </PanelBody>
      </InspectorControls>

      <div { ...blockProps } className={ previewClassString }>
        <InnerBlocks
          allowedBlocks={ ALLOWED_BLOCKS }
          template={ [ [ 'fs-blocks/column-block' ] ] }
        />
      </div>
    </Fragment>
  );
}

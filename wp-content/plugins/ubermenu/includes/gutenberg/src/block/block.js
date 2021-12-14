/**
 * BLOCK: ubermenu-block
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './style.scss';
import './editor.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { ServerSideRender, SelectControl, PanelBody } = wp.components;
const { Fragment } = wp.element;
const {
	//RichText,
	//BlockControls,
	//AlignmentToolbar,
	InspectorControls,
} = wp.editor;

/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType( 'ubermenu/ubermenu-block', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'UberMenu' ), // Block title.
	description: __( 'Display an UberMenu Mega Menu.' ),
	icon: 'menu', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'menu' ),
		__( 'navigation' ),
		__( 'UberMenu' ),
	],

	// attributes: {
	// 	menuId: {
	// 		type: 'integer',
	// 		//default: 0,
	// 	},
	// 	configId: {
	// 		type: 'string',
	// 		//default: 'main',
	// 	},
	// },

	edit: function( props ) {
		// ensure the block attributes matches this plugin's name

		// const options = [
		// 	{ value: 'a', label: 'User A' },
		// 	{ value: 'b', label: 'User B' },
		// 	{ value: 'c', label: 'User c' },
		// ];

		const menuOptions = Object.keys( window.ubermenu_block.menu_options ).map( menuId => {
			return { value: menuId, label: window.ubermenu_block.menu_options[ menuId ] };
		} );

		const configOptions = Object.keys( window.ubermenu_block.config_options ).map( configId => {
			return { value: configId, label: window.ubermenu_block.config_options[ configId ] };
		} );

		//console.log( 'um atts' , props.attributes );

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody>
						<SelectControl
							label={ __( 'Menu' ) }
							value={ props.attributes.menuId }
							onChange={ ( value ) => props.setAttributes( { menuId: +value } ) }
							options={ menuOptions }
						/>

						<SelectControl
							label={ __( 'Configuration' ) }
							value={ props.attributes.configId }
							onChange={ ( value ) => props.setAttributes( { configId: value } ) }
							options={ configOptions }
						/>
					</PanelBody>
				</InspectorControls>

				<ServerSideRender
					block="ubermenu/ubermenu-block"
					attributes={ props.attributes }
				/>

			</Fragment>
		);
	},

	save: function() {
		// @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
		//render in PHP
		return null;
	},
} );

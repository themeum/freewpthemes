/* global colorScheme, Color */
/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */

( function( api ) {
	var cssTemplate = wp.template( 'twentyfifteen-color-scheme' ),
		colorSchemeKeys = [
			'background_color',
			'header_background_color',
			'box_background_color',
			'textcolor',
			'sidebar_textcolor',
			'meta_box_background_color'
		],
		colorSettings = [
			'background_color',
			'header_background_color',
			'sidebar_textcolor'
		];

	api.controlConstructor.radio_image = api.Control.extend( {
		ready: function() {
			if ( 'preset' === this.id ) {
				this.setting.bind( 'change', function( value ) {
					// Update Major Color.
					api( 'major_color' ).set( value );
					api.control( 'major_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', value )
						.wpColorPicker( 'defaultColor', value );

					// Update Event Overlyer Color.
					api( 'event_overlayer_bg_color' ).set( value );
					api.control( 'event_overlayer_bg_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', value )
						.wpColorPicker( 'defaultColor', value );

					// Update Navbar Text  Color.
					api( 'navbar_hover_text_color' ).set( value );
					api.control( 'navbar_hover_text_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', value )
						.wpColorPicker( 'defaultColor', value );

					// Update Sub menu Text hover  Color.
					api( 'sub_menu_text_color_hover' ).set( value );
					api.control( 'sub_menu_text_color_hover' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', value )
						.wpColorPicker( 'defaultColor', value );

					// Update Background Color.
					api( 'button_bg_color' ).set( value );
					api.control( 'button_bg_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', value )
						.wpColorPicker( 'defaultColor', value );

					// Update Background Color.
					api( 'navbar_bracket_color' ).set( value );
					api.control( 'navbar_bracket_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', value )
						.wpColorPicker( 'defaultColor', value );

					// Update Background Color.
					api( 'button_hover_bg_color' ).set( ColorLuminance(value, -0.1) );
					api.control( 'button_hover_bg_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', ColorLuminance(value, -0.1) )
						.wpColorPicker( 'defaultColor', ColorLuminance(value, -0.1) );

					// Update Background Color.
					api( 'hover_color' ).set( ColorLuminance(value, -0.1) );
					api.control( 'hover_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', ColorLuminance(value, -0.1) )
						.wpColorPicker( 'defaultColor', ColorLuminance(value, -0.1) );

					// Update footer_widget_link_color_hvr Color.
					api( 'footer_widget_link_color_hvr' ).set( value );
					api.control( 'footer_widget_link_color_hvr' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', value )
						.wpColorPicker( 'defaultColor', value );

					// Update footer_copyright_link_color Color.
					api( 'footer_copyright_link_color' ).set( value );
					api.control( 'footer_copyright_link_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', value )
						.wpColorPicker( 'defaultColor', value );


					// Update footer_copyright_link_color_hvr Color.
					api( 'footer_copyright_link_color_hvr' ).set( ColorLuminance(value, -0.1) );
					api.control( 'footer_copyright_link_color_hvr' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', ColorLuminance(value, -0.1) )
						.wpColorPicker( 'defaultColor', ColorLuminance(value, -0.1) );

				} );
			}
		}
	} );

	function ColorLuminance(hex, lum) {

		// validate hex string
		hex = String(hex).replace(/[^0-9a-f]/gi, '');
		if (hex.length < 6) {
			hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
		}
		lum = lum || 0;

		// convert to decimal and change luminosity
		var rgb = "#", c, i;
		for (i = 0; i < 3; i++) {
			c = parseInt(hex.substr(i*2,2), 16);
			c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
			rgb += ("00"+c).substr(c.length);
		}

		return rgb;
	}

} )( wp.customize );

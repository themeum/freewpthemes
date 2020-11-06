;(function ( $ ) {
	'use strict';

	if( typeof Color.fn.toString !== undefined ) {
		Color.fn.toString = function ( removeAlpha ) {

			if (removeAlpha == 'no-alpha') {
				return this.toCSS('rgba', '1').replace(/\s+/g, '');
			}

			// Check if _alpha is set lessthen 1
			if ( this._alpha < 1 ) {
				return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
			}

			var hex = parseInt( this._color, 10 ).toString( 16 );

			if ( this.error ) { return ''; }

			if ( hex.length < 6 ) {
				for (var i = 6 - hex.length - 1; i >= 0; i--) {
					hex = '0' + hex;
				}
			}

			return '#' + hex;
		};
	}

	$.parseColorValue = function( val ) {

		var value = val.replace(/\s+/g, ''),
			alpha = ( value.indexOf('rgba') !== -1 ) ? parseFloat( value.replace(/^.*,(.+)\)/, '$1') * 100 ) : 100,
			rgba  = ( alpha < 100 ) ? true : false;

		return { value: value, alpha: alpha, rgba: rgba };
	};

	$.thmcRgbaColorPicker = function (self) {
		var picker = $.parseColorValue( self.val() );

		self.wpColorPicker({
			clear: function() {
				self.trigger('keyup');
			},
			change: function( event, ui ) {
				var colorValueBG = ui.color.toString('no-alpha'),
					colorValue = ui.color.toString();

				self.closest('.wp-picker-container').find('.thmc-alpha-slider-offset').css('background-color', colorValueBG);

				self.val(colorValue).trigger('change');
			},
			create: function() {
				var iris = self.data('a8cIris'),
					container = self.closest('.wp-picker-container'),
					alphaMurkup = $('<div class="thmc-alpha-wrap"><div class="thmc-alpha-slider"></div><div class="thmc-alpha-slider-offset"></div><div class="thmc-alpha-text"></div></div>').appendTo( container.find('.wp-picker-holder') ),
					alphaSlider = alphaMurkup.find('.thmc-alpha-slider'),
					alphaText   = alphaMurkup.find('.thmc-alpha-text'),
					alphaOffset = alphaMurkup.find('.thmc-alpha-slider-offset');

				alphaSlider.slider({
					value: picker.alpha,
					step: 1,
					min: 1,
					max: 100,
					slide: function( event, ui ) {

						var slideValue = parseFloat( ui.value / 100 );

						iris._color._alpha = slideValue;
						self.wpColorPicker( 'color', iris._color.toString() );
						alphaText.text( ( slideValue < 1 ? slideValue : '' ) );
					},
					create: function() {
						var slideValue = parseFloat( picker.alpha / 100 ),
							alphaTextValue = slideValue < 1 ? slideValue : '';

						alphaText.text(alphaTextValue);
						alphaOffset.css('background-color', picker.value);

						container.on('click', '.wp-picker-clear', function() {

							iris._color._alpha = 1;
							alphaText.text('');
							alphaSlider.slider('option', 'value', 100).trigger('slide');

						});

						container.on('click', '.wp-picker-default', function() {

							var defaultPicker = $.parseColorValue( self.data('default-color') ),
								defaultValue  = parseFloat( defaultPicker.alpha / 100 ),
								defaultText   = defaultValue < 1 ? defaultValue : '';

							iris._color._alpha = defaultValue;
							alphaText.text(defaultText);
							alphaSlider.slider('option', 'value', defaultPicker.alpha).trigger('slide');

						});

						container.on('click', '.wp-color-result', function() {
							alphaMurkup.toggle();
						});

						$('body').on( 'click.wpcolorpicker', function() {
							alphaMurkup.hide();
						});
					}
				});
			}
		});
	};

	$.fn.thmcWpColorPicker = function() {
		return this.each(function() {
			$.thmcRgbaColorPicker($(this));
		});
	};
})( jQuery );
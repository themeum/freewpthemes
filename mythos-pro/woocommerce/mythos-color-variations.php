<?php
/**
 * Color Variations Product in WooCommerce 
 *
 * @author  WooThemes
 * @package WooCommerce
 * @version 1.0.0
 */	

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    get_template_part('lib/class-tgm-plugin-activation');

	if (!class_exists('phoen_attr_color_add_Plugin')) {

		class phoen_attr_color_add_Plugin {		
			private $product_attribute_images;
			public function __construct() {
                get_template_part('woocommerce/classes/class-wc-swatches-product-attribute-images');
                get_template_part('woocommerce/classes/class-wc-swatch-term');

				add_action('init', array(&$this, 'on_init'));
				add_action( 'admin_enqueue_scripts',array(&$this, 'wp_enqueue_color_picker') );
				add_action( 'woocommerce_locate_template',array(&$this, 'phoen_locate_template'), 20, 5 );	
				$this->product_attribute_images = new WC_attr_image_add_Product_Attribute_Images('swatches_id', 'attr_image_size');
			}
			

			# Template select.
			public function phoen_locate_template( $template, $template_name, $template_path ) {	
				global $product;
				if ( strstr( $template, 'variable.php' ) ) {
					# Look within passed path within the theme - this is priority
					$template = locate_template(
						array(
							trailingslashit( 'woocommerce-swatches' ) . 'single-product/variable.php',
							$template_name
						)
					);

					# Get default template
					if ( !$template ) {
						$template = plugin_dir_path( __FILE__ ) . '/templates/single-product/variable.php';	
					}
				}
				return $template;
			}
			
			# Color Picker
			public function wp_enqueue_color_picker( $hook_suffix ) {
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script( 'wp-color-picker');
				wp_enqueue_script( 'wp-color-picker');
			}

			# plate color and size
			public function on_init() {
				global $woocommerce;
				$image_size = get_option('attr_image_size', array());
				$size = array();
				$size['width'] = isset($image_size['width']) && !empty($image_size['width']) ? $image_size['width'] : '32';
				$size['height'] = isset($image_size['height']) && !empty($image_size['height']) ? $image_size['height'] : '32';
				$size['crop'] = isset($image_size['crop']) ? $image_size['crop'] : 1;
				$image_size = apply_filters('woocommerce_get_image_size_swatches_image_size', $size);

				add_image_size('attr_image_size', apply_filters('woocommerce_swatches_size_width_default', $image_size['width']), apply_filters('woocommerce_swatches_size_height_default', $image_size['height']), $image_size['crop']);
			} 
			
		}

	}

	$GLOBALS['phoen_attr_color_swatches_add'] = new phoen_attr_color_add_Plugin();
}

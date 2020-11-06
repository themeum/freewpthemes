<?php
class WC_attr_image_add_Product_Attribute_Images {
	
	private $taxonomy;
	private $meta_key;
	private $image_size = 'shop_thumb';
	private $image_width = 40;
	private $image_height = 40; 

	/**
	* Constructor.
	*
	* Sets up a new Product Attribute image type
	*
	* @since 1.0.0
	* @access public
	*
	* @param string $attribute_image_key a meta key to store the custom image for
	* @param string $image_size a registered image size to use for this product attribute image
	* 
	* @return WC_Product_Attribute_Images
	*/
	public function __construct($attribute_image_key = 'thumbnail_id', $image_size = 'shop_thumb') {
		$this->meta_key = $attribute_image_key;
		$this->image_size = $image_size;

		if (is_admin()) {
			add_action('admin_enqueue_scripts', array(&$this, 'on_admin_scripts'));
			add_action('current_screen', array(&$this, 'init_attribute_image_selector'));

			add_action('created_term', array(&$this, 'woocommerce_attribute_thumbnail_field_save'), 10, 3);
			add_action('edit_term', array(&$this, 'woocommerce_attribute_thumbnail_field_save'), 10, 3);
		}
	}

	# Enqueue the scripts if on a product attribute page
	public function on_admin_scripts() {
		global $woocommerce_swatches;
		$screen = get_current_screen();
		if (strpos($screen->id, 'pa_') !== false) :
		
			wp_enqueue_media();
			
		endif;
	}
	
	# Initalize the actions for all product attribute taxonomoies
	public function init_attribute_image_selector() {
		global $woocommerce, $_wp_additional_image_sizes;
		$screen = get_current_screen();

		if (strpos($screen->id, 'pa_') !== false) :

			$this->taxonomy = $_REQUEST['taxonomy'];

			$attribute_taxonomies = wc_get_attribute_taxonomies();

			if ($attribute_taxonomies) {
				foreach ($attribute_taxonomies as $tax) {

					add_action('pa_' . $tax->attribute_name . '_add_form_fields', array(&$this, 'woocommerce_add_attribute_thumbnail_field'));
					add_action('pa_' . $tax->attribute_name . '_edit_form_fields', array(&$this, 'woocommerce_edit_attributre_thumbnail_field'), 10, 2);

					add_filter('manage_edit-pa_' . $tax->attribute_name . '_columns', array(&$this, 'woocommerce_product_attribute_columns'));
					add_filter('manage_pa_' . $tax->attribute_name . '_custom_column', array(&$this, 'woocommerce_product_attribute_column'), 10, 3);
				}
			}

		endif;
	} 
 
	# The field used when adding a new term to an attribute taxonomy
	public function woocommerce_add_attribute_thumbnail_field() {
		global $woocommerce;
		?>
		<div class="form-field ">
			<label for="product_attribute_swatchtype_<?php echo $this->meta_key; ?>">Swatch Type</label>
			<select name="product_attribute_meta[<?php echo $this->meta_key; ?>][type]" id="product_attribute_swatchtype_<?php echo $this->meta_key; ?>" class="postform">
				<option value="-1">None</option>
				<option value="phoen_color">Color</option>
			</select>

			<script type="text/javascript">
				jQuery(document).ready(function($) {

					$('#product_attribute_swatchtype_<?php echo $this->meta_key; ?>').change(function() {
						$('.swatch-field-active').hide().removeClass('swatch-field-active');
						$('.swatch-field-' + $(this).val()).slideDown().addClass('swatch-field-active');
					});

				});
			</script>
		</div>

		<div class="form-field swatch-field swatch-field-phoen_color" style="overflow:visible;display:none;">
			<div id="swatch-photo" class="<?php echo sanitize_title($this->meta_key); ?>-phoen_color">
                <label><?php _e('Color:', 'calypso'); ?></label>   
                <div >
					<input type="hidden" id="product_attribute_<?php echo $this->meta_key; ?>" name="product_attribute_meta[<?php echo $this->meta_key; ?>][phoen_color]" />
					<input type='text' class="text_for_swatches" name="product_attribute_meta[<?php echo $this->meta_key; ?>][phoen_color]" value="" >
                </div>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						jQuery('.text_for_swatches').wpColorPicker();
					});
				</script>
		        <div class="clear"></div>
			</div>
		</div>
		<?php
	}


	# The field used when editing an existing proeuct attribute taxonomy term
	public function woocommerce_edit_attributre_thumbnail_field($term, $taxonomy) {
		global $woocommerce;

		$swatch_term = new WC_attr_image_add_Term($this->meta_key, $term->term_id, $taxonomy, false, $this->image_size);
		$image = ''; ?>

		<tr class="form-field ">
			<th scope="row" valign="top"><label><?php _e('Type', 'calypso'); ?></label></th>
			<td>
				<label for="product_attribute_swatchtype_<?php echo $this->meta_key; ?>">Swatch Type</label>
				<select name="product_attribute_meta[<?php echo $this->meta_key; ?>][type]" id="product_attribute_swatchtype_<?php echo $this->meta_key; ?>" class="postform">
					<option <?php selected('none', $swatch_term->get_type()); ?> value="-1"><?php _e('None', 'calypso'); ?></option>
					<option <?php selected('phoen_color', $swatch_term->get_type()); ?> value="phoen_color"><?php _e('Color', 'calypso'); ?></option>
				</select>
				
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						$('#product_attribute_swatchtype_<?php echo $this->meta_key; ?>').change(function() {
							$('.swatch-field-active').hide().removeClass('swatch-field-active');
							$('.swatch-field-' + $(this).val()).show().addClass('swatch-field-active');
						});
					});
				</script>
			</td>
		</tr>

		<?php $style = $swatch_term->get_type() != 'phoen_color' ? 'display:none;' : ''; ?>
	
		<tr class="form-field swatch-field swatch-field-phoen_color" style="overflow:visible;<?php echo $style; ?>">
			<th scope="row" valign="top"><label><?php _e('Color', 'calypso'); ?></label></th>
			<td>
				<div >
					<input type="hidden" id="product_attribute_<?php echo $this->meta_key; ?>" name="product_attribute_meta[<?php echo $this->meta_key; ?>][phoen_color]" value="<?php echo $swatch_term->phoen_color; ?>" />
					<input type='text' class="text_for_swatches" name='product_attribute_meta[<?php echo $this->meta_key; ?>][phoen_color]' value="<?php echo $swatch_term->phoen_color; ?>" >
				</div>
				<script type="text/javascript">
				jQuery(document).ready(function(){
					
					jQuery('.text_for_swatches').wpColorPicker();
					
				});
				</script>
					
		        <div class="clear"></div>
			</td>
		</tr>
		<?php
	}
	
	
		
	
	# Saves the product attribute taxonomy term data
	public function woocommerce_attribute_thumbnail_field_save($term_id, $tt_id, $taxonomy) {
		if (isset($_POST['product_attribute_meta'])) {

			$metas = $_POST['product_attribute_meta'];
			$data = $metas[$this->meta_key];
			
			if (isset($metas[$this->meta_key])) {
				$data = $metas[$this->meta_key];
				
				$phoen_color = isset($data['phoen_color']) ? $data['phoen_color'] : '';
				$type = isset($data['type']) ? $data['type'] : '';

				update_woocommerce_term_meta($term_id, $taxonomy . '_' . $this->meta_key . '_type', $type);
				update_woocommerce_term_meta($term_id, $taxonomy . '_' . $this->meta_key . '_phoen_color', $phoen_color);
				
			}
			
		}
	}

	//Registers a column for this attribute taxonomy for this image
	public function woocommerce_product_attribute_columns($columns) {
		$new_columns = array();
		$new_columns['cb'] = $columns['cb'];
		$new_columns[$this->meta_key] = __('Thumbnail', 'calypso');
		unset($columns['cb']);
		$columns = array_merge($new_columns, $columns);
		return $columns;
	}

	//Renders the custom column as defined in woocommerce_product_attribute_columns
	public function woocommerce_product_attribute_column($columns, $column, $id) {
		if ($column == $this->meta_key) :
			$swatch_term = new WC_attr_image_add_Term($this->meta_key, $id, $this->taxonomy, false, $this->image_size);
			$columns .= $swatch_term->get_output();
		endif;
		return $columns;
	}

}
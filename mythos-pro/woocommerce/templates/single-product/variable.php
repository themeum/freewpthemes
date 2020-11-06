<?php
/**
* Variable product add to cart
*
* @author  Themeum
* @package WooCommerce/Templates
* @version 3.6.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$attribute_keys = array_keys( $attributes );
do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" method="post" style="display:none" enctype='multipart/form-data' data-product_id="<?php echo get_the_ID(); ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">

		<div class="variations">
				
			<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; 
				if( 'variation_'.sanitize_title( $name )  == 'variation_pa_frame'){
					$displayBlock = 'none';
				}else {
					$displayBlock = 'block';
				}
			?>
				
				<div id="variation_<?php echo esc_attr(sanitize_title( $name )); ?>" class="variation" style="display:<?php echo esc_attr($displayBlock); ?>">
					<div class="label">
						<label for="<?php echo esc_attr(sanitize_title( $name )); ?>"><?php echo esc_attr(wc_attribute_label( $name )); ?></label>
					</div>

					<div class="variation_name_value" style="display:none"><?php echo esc_attr(wc_attribute_label( $name )); ?></div>
					<div class="value">
						<select style="display:none;" id="<?php echo esc_attr( sanitize_title( $name ) ); ?>" name="attribute_<?php echo esc_attr(sanitize_title( $name )); ?>" data-attribute_name="attribute_<?php echo esc_attr(sanitize_title( $name )); ?>">
							<option value=""><?php echo esc_attr( 'Choose an option', 'mythos-pro' ) ?>&hellip;</option>
							<?php
								if ( is_array( $options ) ) {

									if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) ) {
										$selected_value = sanitize_key(wp_unslash($_REQUEST[ 'attribute_' . sanitize_title( $name ) ]));
									} elseif ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) {
										$selected_value = $selected_attributes[ sanitize_title( $name ) ];
									} else {
										$selected_value = '';
									}

									# Get terms if this is a taxonomy - ordered
									if ( taxonomy_exists( $name ) ) {
										$terms = wc_get_product_terms( get_the_ID(), $name, array( 'fields' => 'all' ) );
										foreach ( $terms as $term1 ) {
											$term_id =  $term1->term_id;
											$thumbnail_id = get_term_meta( $term_id,'', 'phoen_color', true );
										
											if ( ! in_array( $term1->slug, $options ) ) {
												continue;
											}
											echo '<option value="' . esc_attr( $term1->slug ). '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $term1->slug ), false ) . '>' . esc_attr(apply_filters( 'woocommerce_variation_option_name', $term1->name )).'</option>';
										}

									} else {

										foreach ( $options as $option ) {
											echo '<option value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
										}

									 } 
								}
							?>
						</select>
					
					
						<div class="variation_descriptions_wrapper">
	                        <div class="variation_descriptions" id="<?php echo esc_attr(sanitize_title( $name )); ?>_descriptions" style="display:none;">
	                        	<div rel="<?php echo esc_attr(sanitize_title( $name )); ?>_buttons" class="var-notice header-font" style="opacity: 1; right: 0px;">
									<div class="vertAlign" style="margin-top: 0px;"><?php esc_html_e('Please select', 'mythos-pro'); ?></div>
								</div>
								<?php foreach($terms as $term1) { ?>
										<div class="variation_description" id="<?php echo esc_attr(sanitize_title( $name )); ?>_<?php echo esc_url($term1->slug); ?>_description" style="display: none;">
											<?php
												$term_id =  $term1->term_id;
												$thumbnail_id = get_term_meta( $term_id,'', 'phoen_color', true );
												if($thumbnail_id[sanitize_title( $name ).'_swatches_id_phoen_color'][0] != ''){		
													echo "<div class='".esc_attr($term1->slug)."_image'>
														<span class='phoen_swatches' style='height:32px; line-height:30px; width:32px; display:block; border:1px solid #ccc;  background-color:".$thumbnail_id[sanitize_title( $name ).'_swatches_id_phoen_color'][0]."'>
														<i class='fas fa-check'></i>
														</span>
													</div>";	
												}else{
													echo "<div class='".esc_attr($term1->slug)."_image'><span class='phoen_swatches' style='height:32px; line-height:30px; min-width:22px; width:auto; display:inline-block; border:1px solid #ccc; text-align: center; padding:0 5px; margin-bottom:0;'>".esc_attr($term1->name)."</span></div>";	
												}?>
												<style>
												.variation_buttons_wrapper .variation_button {display:inline-block; vertical-align:top; margin-right:5px;} 
												</style>
												
										</div>
										<?php
									
									}
								?>
							</div>
	                    </div>

						<?php
							if ( sizeof( $attributes ) === $loop ) {
								echo '<a class="reset_variations" href="#reset">' . esc_attr( 'Clear selection', 'mythos-pro' ) . '</a>';
							}
						?>
					</div>
				</div>
	        <?php endforeach;?>

		</div>

		<!-- Add to cart Button -->
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		<div class="single_variation_wrap">
			<?php
				do_action( 'woocommerce_before_single_variation' );
				do_action( 'woocommerce_single_variation' );
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		<!-- Add to cart Button -->
</form>


<style type="text/css">
	.select-wrapper{
		display:none!important;
	}
	.variation_buttons .variation_button.selected {
	    border: 1px solid #000;
	}	
</style>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

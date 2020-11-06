<?php
/**
 * Variable product add to cart
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>




<form class="variations_form cart" method="post" style="display:none" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">

		<div class="variations">
				
			<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; 
				if( 'variation_'.sanitize_title( $name )  == 'variation_pa_frame'){
					$display = 'none';
				}else {
					$display = 'block';
				}
			?>
				
				<div id="variation_<?php echo sanitize_title( $name ); ?>" class="variation" style="display:<?php echo $display; ?>">
					<div class="label"><label for="<?php echo sanitize_title( $name ); ?>"><?php echo wc_attribute_label( $name ); ?></label></div>
					<div class="variation_name_value" style="display:none"><?php echo wc_attribute_label( $name ); ?></div>
					<div class="value">
					<select style="display:none;" id="<?php echo esc_attr( sanitize_title( $name ) ); ?>" name="attribute_<?php echo sanitize_title( $name ); ?>" data-attribute_name="attribute_<?php echo sanitize_title( $name ); ?>">
						<option value=""><?php echo __( 'Choose an option', 'calypso' ) ?>&hellip;</option>
						<?php
							if ( is_array( $options ) ) {

								if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) ) {
									$selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $name ) ];
								} elseif ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) {
									$selected_value = $selected_attributes[ sanitize_title( $name ) ];
								} else {
									$selected_value = '';
								}

								// Get terms if this is a taxonomy - ordered
								if ( taxonomy_exists( $name ) ) {

									$terms = wc_get_product_terms( $post->ID, $name, array( 'fields' => 'all' ) );

									foreach ( $terms as $term ) {
										$term_id =  $term->term_id;
										$thumbnail_id = get_woocommerce_term_meta( $term_id,'', 'phoen_color', true );
										
									
										if ( ! in_array( $term->slug, $options ) ) {
											continue;
										}
										echo '<option value="' . esc_attr( $term->slug ). '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $term->slug ), false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ).'</option>';
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
                        <div class="variation_descriptions" id="<?php echo sanitize_title( $name ); ?>_descriptions" style="display:none;">
                        	<div rel="<?php echo sanitize_title( $name ); ?>_buttons" class="var-notice header-font" style="opacity: 1; right: 0px;">
								<div class="vertAlign" style="margin-top: 0px;">Please select</div>
							</div>
							<?php
								foreach($terms as $term)
								{
									?>
									<div class="variation_description" id="<?php echo sanitize_title( $name ); ?>_<?php echo $term->slug; ?>_description" style="display: none;">
										<?php
											$term_id =  $term->term_id;
											
											$thumbnail_id = get_woocommerce_term_meta( $term_id,'', 'phoen_color', true );
											
											if($thumbnail_id[sanitize_title( $name ).'_swatches_id_phoen_color'][0] != ''){
													
												echo "<div class='".$term->slug."_image'><span class='phoen_swatches' style='height:32px; line-height:30px; width:32px; display:block; border:1px solid #ccc;  background-color:".$thumbnail_id[sanitize_title( $name ).'_swatches_id_phoen_color'][0]."'></span></div>";	
												
											}else{
												echo "<div class='".$term->slug."_image'><span class='phoen_swatches' style='height:32px; line-height:30px; min-width:22px; width:auto; display:inline-block; border:1px solid #ccc; text-align: center; padding:0 5px; margin-bottom:0;'>".$term->name."</span></div>";	
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
							echo '<a class="reset_variations" href="#reset">' . __( 'Clear selection', 'calypso' ) . '</a>';
						}
					?></div>
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


<script type="text/javascript">
(function($){
	
jQuery(document).ready(function() {

	
	if(jQuery('.variations_form').length) {
				
		makealloptions();
		
	}
	
	jQuery(document).on('click','.reset_variations',function(){
		
		jQuery('.selected').each(function(){
			
			jQuery(this).removeClass('unselected');  
			
		});
	
	});
	jQuery(document).on('click','.variation_button',function(){
		//console.log(jQuery(this));
		if( jQuery('#'+jQuery(this).attr('rel')).val() == jQuery(this).attr('id') ){
			jQuery('#'+jQuery(this).attr('rel')).val('');
			jQuery(this).removeClass('selected').addClass('unselected');
		}else{
			jQuery('#'+jQuery(this).attr('rel')).val(jQuery(this).attr('id'));
			jQuery('#'+jQuery(this).attr('rel')+'_buttons .variation_button').removeClass('selected').addClass('unselected');
			jQuery(this).removeClass('unselected').addClass('selected');
			//if(jQuery(this).attr('rel')!='pa_frame'){
				jQuery('#variation_'+jQuery(this).attr('rel')+' .var-notice').stop(true,true).hide();
				var notTarget = jQuery(this).attr('rel')+'_'+jQuery(this).attr('id')+'_description';
				jQuery('#'+jQuery(this).attr('rel')+'_descriptions .variation_description').each(function(){
					if(jQuery(this).attr('id')!=notTarget){
						jQuery(this).hide();
					}
				});
				
			//}
			
		}
		
		jQuery('#'+jQuery(this).attr('rel')).change();
		
	});
	
	jQuery('.variation_descriptions_wrapper:first-child').append('');
	
	jQuery(document).on('change','.variations_form select',function(){
		
		makealloptions();
		
	});
	
	function makealloptions(){
		
		jQuery('.variations_form select').each(function(index, element) {
			
			var curr_select = jQuery(this).attr('id');
			
			if(jQuery('#'+curr_select+'_buttons').length){
				
				if(!jQuery('#'+curr_select+'_buttons').find('.selected').length){
					jQuery('#'+curr_select+'_buttons').html('');
					jQuery('#'+curr_select+'_descriptions .variation_description').stop(true,true).slideUp("fast");
				}else{
					jQuery('#'+curr_select+'_buttons .unselected').hide();
				}
				
			}else{
				
				jQuery( '<div class="variation_buttons_wrapper"><div id="'+curr_select+'_buttons" class="variation_buttons"></div></div><div class="variation_descriptions_wrapper"><div id="'+curr_select+'_descriptions" class="variation_descriptions"></div></div>' ).insertBefore( jQuery(this) );
				
			}
			jQuery('#'+jQuery(this).attr('id')+' option').each(function(index, element) {
				if(jQuery(this).val()!=''){
					// Get Image
					var image = jQuery('#'+curr_select+'_'+jQuery(this).val()+'_description .image img');
					
					if(jQuery('#'+jQuery(this).val()).length){
						jQuery('#'+jQuery(this).val()).show();
					}else{
						
						jQuery( "#"+curr_select+'_buttons' ).append( '<a href="javascript:void(0);" class="variation_button'+((jQuery('#'+curr_select).val()==jQuery(this).val())?' selected':' unselected')+'" id="'+jQuery(this).val()+'" title="'+jQuery(this).text()+'" rel="'+curr_select+'">'+jQuery('.'+jQuery(this).val()+'_image').html()+'</a>' );
						
						if(jQuery('#'+curr_select).val()==jQuery(this).val()){
							jQuery('#'+curr_select+'_'+jQuery(this).val()+'_description .var-notice').stop(true,true).hide();
							jQuery('#'+curr_select+'_'+jQuery(this).val()+'_description').stop(true,true).slideDown("fast")
						}
					}
				}else{
					if(  jQuery('#'+curr_select+' option').length == 1 && jQuery('#'+curr_select+' option[value=""]').length){
						 jQuery( "#"+curr_select+'_buttons' ).append( 'Combination Not Avalable <a href="javascript:void(0);" class="variation_reset">Reset</a>' );
					}
				}
			});
		});
		if(jQuery('.single_variation .price .amount').is(':visible') || jQuery('.single_add_to_cart_button').is(':visible')){
			jQuery('p.lead-time').show();
			jQuery('p.price-prompt').hide();
			if(jQuery('.single_variation .price .amount').is(':visible')){
				//jQuery('div [itemprop="offers"] .price').hide();
			}else{
				jQuery('div [itemprop="offers"] .price').clone().appendTo( jQuery( ".single_variation" ) );
			}
		}
		
		jQuery('form.variations_form').fadeIn();
		jQuery('.product_meta').fadeIn();
		
		
	}
	
});
})(jQuery)
function goToFrames()
{
	jQuery('<div class="current_selection_prompt">Current selection</div>').insertBefore('.entry-summary h1');
	jQuery('.variations .variation').each(function(index, element) {
		jQuery(this).stop(true,true).slideUp( "fast");
	});
	var current_selections;
	jQuery('#current_selections').html();
	
	
	jQuery('.variation_button.selected').each(function(){
		
		jQuery('#current_selections').html(jQuery('#current_selections').html()+'<span>'+jQuery('#variation_'+jQuery(this).attr('rel')+' .variation_name_value').html()+':</span> '+jQuery(this).attr('title')+'  &nbsp; ');
		
	});
	
	jQuery('.variation_descriptions_wrapper img').attr('data-parent','.variation_descriptions_wrapper');
	
}
</script>
<style type="text/css">
	
.select-wrapper{
	display:none!important;
}
.variation_buttons .variation_button.selected {
    border: 1px solid #000;
}	

</style>


<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

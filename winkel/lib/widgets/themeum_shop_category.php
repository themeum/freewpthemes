<?php

add_action('widgets_init','register_winkel_shop_category_widget');

function register_winkel_shop_category_widget()
{
	register_widget('winkel_shop_category_widget');
}

class winkel_shop_category_widget extends WP_Widget{

	function __construct()
	{
		parent::__construct( 'winkel_shop_category_widget','Winkel Shop Category',array('description' => 'Winkel Shop Children Category Post'));
	}


	/*-------------------------------------------------------
	 *				Front-end display of widget
	 *-------------------------------------------------------*/

	function widget($args, $instance)
	{
		extract($args);
		global $wp_query, $post;

		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;

		$output = '';

		if ( $title ){
			echo $before_title . $title . $after_title;
		}
		if( is_shop() ) {
			  $args = array(
	           'hierarchical'       => 1,
	           'show_option_none'   => '',
	           'hide_empty'         => 0,
	           'taxonomy'           => 'product_cat'
			  );
		} else {
	        $cate = get_queried_object();
	        $cateID = $cate->term_id;
	    	if( $cateID ){
	    		if( get_term_children( $cateID,'product_cat' ) ){
	    			$cateID = $cateID;
	    			$args = array(
			           'hierarchical'       => 1,
			           'show_option_none'   => '',
			           'hide_empty'         => 0,
			           'parent'             => $cateID,
			           'taxonomy'           => 'product_cat'
			        );	
	 			} else {
	 				$args = array(
			           'hierarchical'       => 1,
			           'show_option_none'   => '',
			           'hide_empty'         => 0,
			           'taxonomy'           => 'product_cat'
			        );
	 			}
	 		} 
		}
	    $subcats = get_categories($args);


        echo '<select class="wooc-cats-list chosen-select">';
         $i = 1;
          foreach ($subcats as $woosc) {
              $selected = '';
              if ( ! empty($cateID)){
                  $selected = ($cateID == $woosc->term_id) ? 'selected="selected"' : '';
              }
            $link = get_term_link( $woosc->slug, $woosc->taxonomy );
            if ($i == 1) {
            	echo '<option value="'. get_the_permalink(get_option('woocommerce_shop_page_id')) .'" '.$selected.' ><a href="'. $link .'">All</a></option>';
            }
            echo '<option value='. $link .' '.$selected.'><a href="'. $link .'">'.$woosc->name.'</a></option>';
            $i++;
          }
        echo '</select>';


		echo $after_widget;
	}


	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;

		$instance['title'] 			= strip_tags( $new_instance['title'] );

		return $instance;
	}


	function form($instance)
	{
		$defaults = array( 
			'title' 	=> 'Popular Posts',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Widget Title', 'winkel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
	<?php
	}
}
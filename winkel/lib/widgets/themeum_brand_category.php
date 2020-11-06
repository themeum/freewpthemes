<?php

add_action('widgets_init','register_winkel_brand_category_widget');

function register_winkel_brand_category_widget()
{
	register_widget('winkel_brand_category_widget');
}

class winkel_brand_category_widget extends WP_Widget{

	function __construct()
	{
		parent::__construct( 'winkel_brand_category_widget','Winkel brand Category',array('description' => 'Brand Category Post'));
	}


	/*-------------------------------------------------------
	 *				Front-end display of widget
	 *-------------------------------------------------------*/

	function widget($args, $instance)
	{
		extract($args);
		global $post;

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
	           'taxonomy'           => 'product_brand'
			  );
	    } else {
			$cate = get_queried_object();
	        $cateID = $cate->term_id;
			$args = array(
	           'hierarchical'       => 1,
	           'show_option_none'   => '',
	           'hide_empty'         => 0,
	           'taxonomy'           => 'product_brand'
	        );
	    }
	    $cate = get_categories($args);
    	if( $cate ){
	        echo '<select class="wooc-cats-list chosen-select">';
	          $i = 1;
	          foreach ( $cate as $category ) {
		          $selected = '';
		          if ( ! empty($cateID)){
		              $selected = ($cateID == $category->cat_ID) ? 'selected="selected"' : '';
		          }
	              if($i==1){
		          	echo '<option value="'. get_the_permalink(get_option('woocommerce_shop_page_id')) .'" '.$selected.'><a href="'. $category->cat_ID .'">All</a></option>';
		          }
	            echo '<option value='. get_category_link($category->cat_ID) .' '.$selected.'><a href="'. get_category_link($category->cat_ID) .'">'.$category->name.'</a></option>';
	          $i++;
	          }
	        echo '</select>';
    	}
        
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
			'title' 	=> 'Brand',
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
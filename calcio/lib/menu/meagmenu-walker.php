<?php
/*
 * Front-end Megamenu Class
 */

class calcio_Megamenu_Walker extends Walker_Nav_menu{

	private $megamenuId;
	private $columnId;
	private $containerType = '';

	function start_lvl( &$output, $depth = 0, $args = array() ) {

        $indent = str_repeat("\t", $depth);
        

        if($this->megamenuId == 1 && $this->containerType == 'stretch-container'){
        	$output .= "\n$indent<div class=\"megamenu-container\"><ul role=\"menu\" class=\"sub-menu megamenu megacol-".$this->columnId." ".$this->containerType."\">\n";
        } else if($this->megamenuId == 1){
        	$output .= "\n$indent<ul role=\"menu\" class=\"sub-menu megamenu megacol-".$this->columnId." ".$this->containerType."\">\n";
        }else{
        	$output .= "\n$indent<ul role=\"menu\" class=\"sub-menu\">\n";
        }
    }




    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element ) {
            return;
        }
 
        $id_field = $this->db_fields['id'];
        $id       = $element->$id_field;

        $this->has_children = ! empty( $children_elements[ $id ] );
        if ( isset( $args[0] ) && is_array( $args[0] ) ) {
            $args[0]['has_children'] = $this->has_children;
        }
 
        $cb_args = array_merge( array(&$output, $element, $depth), $args);
        call_user_func_array(array($this, 'start_el'), $cb_args);
 
        if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {
 
            foreach ( $children_elements[ $id ] as $child ){
 
                if ( !isset($newlevel) ) {
                    $newlevel = true;
                    $cb_args = array_merge( array(&$output, $depth), $args);
                    call_user_func_array(array($this, 'start_lvl'), $cb_args);
                }
                $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
            }
            unset( $children_elements[ $id ] );
        }
 
        if ( isset($newlevel) && $newlevel ){
            $cb_args = array_merge( array(&$output, $depth), $args);
            if( get_post_meta( $element->ID, '_menu_item_megamenu', true ) == 1 && get_post_meta( $element->ID, '_menu_item_container', true ) == '2'){
	        	$output .= "</ul></div>";
	        } else {
	        	$output .= "</ul>";
	        }
        }
 
        // end this element
        $cb_args = array_merge( array(&$output, $element, $depth), $args);
        call_user_func_array(array($this, 'end_el'), $cb_args);
    }



	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{
		global $wp_query;

		$megamenu = 0;
		$column = 1;
		$container = 0;

		if($depth == 1){            
			$column = get_post_meta( $item->menu_item_parent, '_menu_item_column', true );
			$megamenu = get_post_meta( $item->menu_item_parent, '_menu_item_megamenu', true );
		}

		$this->megamenuId	 = get_post_meta( $item->ID, '_menu_item_megamenu', true );
		$this->columnId		 = get_post_meta( $item->ID, '_menu_item_column', true );
		$containerType 		 = get_post_meta( $item->ID, '_menu_item_container', true );

		$containerType = (int) $containerType;

		$this->containerType = '';
		if ($containerType === 1) {
			$this->containerType = 'fullwidth-container';
		} else if ($containerType === 2) {
			$this->containerType = 'stretch-container';
		}


		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join(' ', $classes);

		$class_megamenu = ( $item->megamenu )? ' has-megasub': '';

		if ( $megamenu == 1 ) {
			$class_megamenu .= ' mega-child';
		} else {
			$class_megamenu .= ' has-menu-child';
		}

		
		
		$post = get_post($item->object_id,ARRAY_A);
		$slug = $post['post_name'];

		if (is_singular('portfolio') &&  $slug == 'portfolio') {
			$class_names = 'class="'.esc_attr( $class_names ) . $class_megamenu.' active"';
		}else if (is_singular('album') &&  $slug == 'albums') {
			$class_names = 'class="'.esc_attr( $class_names ) . $class_megamenu.' active"';
		}else if (is_singular('gallery') &&  $slug == 'gallery') {
			$class_names = 'class="'.esc_attr( $class_names ) . $class_megamenu.' active"';
		}else if(is_singular('event') || is_singular('album') || is_singular('gallery')){
			$class_names = 'class="'.esc_attr( $class_names ) . $class_megamenu.'"';
		}else{
			if(in_array('current-menu-parent', $classes)) { $class_names .= ' active'; }
			if(in_array('current-menu-item', $classes)) { $class_names .= ' active'; }
			$class_names = 'class="'.esc_attr( $class_names ) . $class_megamenu.'"';
		}

		$output .= $indent . '<li ' . $value . $class_names.'>';

       	$attributes = ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
       	$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
       	$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

       	$img  = !empty( $item->img ) ? '<img src="'.esc_url( $item->img ).'" alt="Images" class="img-responsive" />' : '';

       	$item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );            
        $item_output .= $args->link_after;
        $item_output .= '</a>';
        $item_output .= $img;
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}



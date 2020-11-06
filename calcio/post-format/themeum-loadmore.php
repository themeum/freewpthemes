<?php

add_action( 'wp_ajax_thmloadmore', 'thm_load_more_posts' );
add_action( 'wp_ajax_nopriv_thmloadmore', 'thm_load_more_posts' );
function thm_load_more_posts() {
	global $wpdb; # this is how you get access to the database

	$output = '';
	$posts = 0;
	$paged = 1;
	$perpage = $show_author = $show_date = $show_category  = $category = $layout = '';

	if(isset( $_POST['perpage'] )){ $perpage = $_POST['perpage']; }

	if(isset( $_POST['show_author'] )){ $show_author = $_POST['show_author']; }
	if(isset( $_POST['show_date'] )){ $show_date = $_POST['show_date']; }
	if(isset( $_POST['show_category'] )){ $show_category = $_POST['show_category']; }
	if(isset( $_POST['category'] )){ $category = $_POST['category']; }
	if(isset( $_POST['paged'] )){ $paged = $_POST['paged']; }
	if(isset( $_POST['layout'] )){ $layout = $_POST['layout']; }

	if (isset($category) && $category!='') {
 		$idObj 	= get_category_by_slug( $category );
 		if (isset($idObj) && $idObj!='') {
			$idObj 	= get_category_by_slug( $category );
			$cat_id = $idObj->term_id;

			$args = array( 
		    	'category' 			=> $cat_id,
    			'orderby' 			=> 'meta_value_num',
    			'meta_key' 			=> 'themeum_highlight',
		        'order' 			=> 'ASC',
		        'posts_per_page' 	=> 4,
		        'paged' 			=> $paged
		    );
		    $posts = get_posts($args);
 		}else{
 			echo "Please Enter a valid category name";
 			$args = 0;
 		}
	}else{
		$args = array(
	        'order' 			=> 'ASC',
			'orderby' 			=> 'meta_value_num',
			'meta_key' 			=> 'themeum_highlight',
	        'posts_per_page' 	=> 4,
	        'paged' 			=> $paged
	    );
	    $posts = get_posts($args);
 	}
 	
	if(count($posts)>0){
	
		if( $layout == 'style1' ){
			foreach ($posts as $key=>$post): setup_postdata($post);
		    $output .= '<div class="themeum-latest-item">';
		    $output .= '<div class="all-highlights-style2-item clearfix">';
		    if ( has_post_thumbnail($post->ID) ) {
			    $output .= '<div class="themeum-overlay-wrap highlight-post-thumb yes">';
					    $output .= '<a href="'.get_permalink($post->ID).'">'.get_the_post_thumbnail($post->ID, 'full', array('class' => 'img-responsive')).'</a>';
				$output .= '</div>';
			    
				$output .= '<div class="highlight-post-content">';	
					if ( $show_category == 'yes'){
						$output .= '<span class="entry-category">';
						$output .= get_the_category_list(' ', '', $post->ID);
						$output .= '</span>';
					}
					$output .= '<h3 class="entry-title"><a href="'.get_permalink($post->ID).'">'. get_the_title($post->ID) .'</a></h3>';

					if ( $show_author == 'yes'){
						$output .= '<span class="author">'.__('By ', 'calcio').''.get_the_author_link().'</span>';	
					}
					if ( $show_date == 'yes'){
						$output .= '<span class="entry-date">';
						$output .= get_the_date('d M Y', $post->ID);
						$output .= '</span>';	
					}	
					
				$output .= '</div>';

			}else {
				$output .= '<div class="col-sm-12 latest-post-intro">';	
					if ( $show_category == 'yes'){
						$output .= '<span class="entry-category">';
						$output .= get_the_category_list(', ', '', $post->ID);
						$output .= '</span>';
					}
					$output .= '<h3 class="entry-title"><a href="'.get_permalink($post->ID).'">'. get_the_title($post->ID) .'</a></h3>';


					if ( $show_author == 'yes'){
						$output .= '<span class="author">'.__('By ', 'calcio').''.get_the_author_link().'</span>';	
					}
					if ( $show_date == 'yes'){
						$output .= '<span class="entry-date">';
						$output .= get_the_date('d M Y', $post->ID);
						$output .= '</span>';	
					}	
					
				$output .= '</div>';
			}
			$output .= '</div>';
			$output .= '</div>';
			endforeach;
		}else{

			$output .= '<div class="row">';
			foreach ($posts as $key=>$post): setup_postdata($post);
			$output .= '<div class="themeum-latest-item">';
		    $output .= '<div class="highlights-item all-items style3-wrapper col-md-6">';
		    $output .= '<div class="themeum-default-wrapper highlights-wrapper themeum-overlay-wrap-3 single-feature-slide yes">';
		    if ( has_post_thumbnail($post->ID) ) {

				$output .= '<a href="'.get_permalink($post->ID).'">'.get_the_post_thumbnail($post->ID, 'calcio-highlight-small', array('class' => 'img-responsive')).'</a>';
				
			    $video_icon 	= get_parent_theme_file_uri('images/video-icon-big.png');
				$output .= '<div class="themeum-default-intro highlights-intro themeum-overlay blog-feature-content">';	
					$output .= '<div class="overlay"></div>';		
					$output .= '<div class="themeum-overlay-inner">';	
						if ( $show_category == 'yes'){
							$output .= '<span class="entry-category">';
							$output .= get_the_category_list(' ', '', $post->ID);
							$output .= '</span>';
						}
						$output .= '<h3 class="entry-title"><a href="'.get_permalink($post->ID).'">'. get_the_title($post->ID) .'</a></h3>';

						if ( $show_author == 'yes'){
							 $output .= '<span class="author">'.__('By ', 'calcio').''.get_the_author_link().'</span>';	
						}
						if ( $show_date == 'yes'){
							$output .= '<span class="entry-date">';
							$output .= get_the_date('d M Y', $post->ID);
							$output .= '</span>';	
						}			
					$output .= '</div>'; # themeum-overlay-inner
				$output .= '</div>'; # themeum-default-intro
			}
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			endforeach;
			$output .= '</div>';
		}
		
		wp_reset_postdata();   
	
	}

	print $output;

	wp_die(); # die 
}
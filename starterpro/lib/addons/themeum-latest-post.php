<?php
add_action('init', 'themeum_latest_post', 99);

function themeum_latest_post(){
    global $kc;
    if (function_exists('kc_add_map')) 
    { 
        kc_add_map(
            array(

        'themeum_latest_p' => array(
                'name'        => 'Latest Post',
                'description' => esc_html__('Add themeum latest post', 'starterpro'),
                'icon'        => 'fa-pencil-square-o',
                'category'    => 'Starter',
                'params'        => array(
                'general'   => array(
                    array(
                        'type'          => 'radio_image',
                        'label'         => esc_html__( 'Select layout', 'starterpro' ),
                        'name'          => 'layout',
                        'admin_label'   => true,
                        'options'       => array(
                            '1' => get_template_directory_uri()  . '/lib/addons/image/latestpost/1.png',
                            '2' => get_template_directory_uri()  . '/lib/addons/image/latestpost/3.png',
                            '3' => get_template_directory_uri()  . '/lib/addons/image/latestpost/2.png',
                        ),
                        'value'         => '1'
                    ),                    
					array(
						'type'			=> 'post_taxonomy',
						'label'			=> esc_html__( 'Content Type', 'starterpro' ),
						'name'			=> 'post_taxonomy',
						'description'	=> esc_html__( 'Choose supported content type such as post, custom post type, etc.', 'starterpro' ),
					), 
                    array(
                        'type'      => 'select',
                        'label'     => esc_html__( 'Order By', 'starterpro' ),
                        'name'      => 'column',
                        'options'   => array(
                            '2'  => esc_html__( 'Column 6', 'starterpro' ),
                            '4'   => esc_html__( 'Column 3', 'starterpro' ),
                            '3'   => esc_html__( 'Column 4', 'starterpro' ),
                            '6'   => esc_html__( 'Column 2', 'starterpro' ),
                        ),
                        'value'         => '4',
                    ),                    
					array(
						'type'			=> 'number_slider',
						'label'			=> esc_html__( 'Number of posts displayed', 'starterpro' ),
						'name'			=> 'number',
						'description'	=> esc_html__( 'The number of posts you want to show.', 'starterpro' ),
						'value'			=> '5',
						'admin_label'	=> true,
						'options' => array(
							'min' => 1,
							'max' => 20
						)
					),  					                  
                    array(
                        'name'    => 'headline',
                        'label'   => esc_html__('Type', 'starterpro'),
                        'type'    => 'select',
                        'admin_label' => true,
                        'options' => array(
                            'h1'  => 'H1',
                            'h2'  => 'H2',
                            'h3'  => 'H3',
                            'h4'  => 'H4',
                            'h5'  => 'H5',
                            'h6'  => 'H6',
                            'div'  => 'div',
                            'span'  => 'Span',
                            'p'  => 'P'
                        ),
                        'value'         => 'h3',
                    ),                     
					array(
						'type'			=> 'dropdown',
						'label'			=> esc_html__( 'Order by', 'starterpro' ),
						'name'			=> 'orderby',
						'admin_label'	=> true,
						'options' 		=> array(
							'ID'		=> esc_html__('Post ID', 'starterpro'),
							'author'	=> esc_html__('Author', 'starterpro'),
							'title'		=> esc_html__('Title', 'starterpro'),
							'name'		=> esc_html__('Post name (post slug)', 'starterpro'),
							'type'		=> esc_html__('Post type (available since Version 4.0)', 'starterpro'),
							'date'		=> esc_html__('Date', 'starterpro'),
							'modified'	=> esc_html__('Last modified date', 'starterpro'),
							'rand'		=> esc_html__('Random order', 'starterpro'),
							'comment_count'	=> esc_html__('Number of comments', 'starterpro')
						)
					),  
					array(
						'type'			=> 'text',
						'label'			=> esc_html__( 'Limit Words', 'starterpro' ),
						'name'			=> 'words',
						'value'			=> 20,
						'description'	=> esc_html__( 'Limit words you want show as short description', 'starterpro' ),
                        'relation'    => array(
                            'parent'    => 'layout',
                            'show_when' => array('1','2'),
                        ),
					),	
					array(
						'type'		=> 'select',
						'label'		=> esc_html__( 'Order By', 'starterpro' ),
						'name'		=> 'order',
						'options'	=> array(
							'DESC'	=> esc_html__( 'Descending', 'starterpro' ),
							'ASC'	=> esc_html__( 'Ascending', 'starterpro' )
						)
					),	
                    array(
                        'type'      => 'select',
                        'label'     => esc_html__( 'Show Author', 'starterpro' ),
                        'name'      => 'en_author',
                        'value'         => '2',
                        'options'   => array(
                            '1'  => esc_html__( 'Yes', 'starterpro' ),
                            '2'   => esc_html__( 'No', 'starterpro' )
                        ),
                        'relation'    => array(
                            'parent'    => 'layout',
                            'show_when' => array('2'),
                        ),

                    ),            
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Custom class', 'starterpro' ),
                        'name'          => 'extra_class',
                        'description'   => esc_html__( 'Enter extra custom class', 'starterpro' )
                    )
                ),
                'styling'   => array(
                    array(
                        'name'      => 'css_custom',
                        'type'      => 'css',
                        'options'   => array(
                            array(
                                "screens" => "any,1024,999,767,479",
                                'Title' => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'starterpro'), 'selector' => '.latest-post-title,.latest-post-title a,.post-author .author-avatar a'),
                                    array('property' => 'color', 'label' => esc_html__('Hover Color', 'starterpro'), 'selector' => '.latest-blog-content-wrapper:hover .latest-post-title a,.latest-blog-content-wrapper:hover .post-author .author-avatar a,.latest-review-single-layout3:hover .latest-post-title a'),
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'starterpro'), 'selector' => '.latest-post-title'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'starterpro'), 'selector' => '.latest-post-title'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'starterpro'), 'selector' => '.latest-post-title'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'starterpro'), 'selector' => '.latest-post-title'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'starterpro'), 'selector' => '.latest-post-title'),
                                    array('property' => 'text-align', 'label' => esc_html__('Text Align', 'starterpro'), 'selector' => '.latest-post-title'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'starterpro'), 'selector' => '.latest-post-title'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'starterpro'), 'selector' => '.latest-post-title'),
                                ),
                                'Date'  => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'starterpro'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'color', 'label' => esc_html__('Hover Color', 'starterpro'), 'selector' => '.latest-blog-content-wrapper:hover .latest-blog-date,.latest-review-single-layout3:hover .latest-blog-date'),
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'starterpro'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'starterpro'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'starterpro'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'starterpro'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'starterpro'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'text-align', 'label' => esc_html__('Text Align', 'starterpro'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'starterpro'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'starterpro'), 'selector' => '.latest-blog-date'),
                                ),
                                'Image' => array(
                                    array('property' => 'background-color', 'label' => esc_html__('Background Color', 'starterpro'), 'selector' => '.latest-blog-image img'),
                                    array('property' => 'border', 'label' => esc_html__('Border', 'starterpro'), 'selector' => '.latest-blog-image img'),
                                    array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'starterpro'), 'selector' => '.latest-blog-image img'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'starterpro'), 'selector' => '.latest-blog-image img'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'starterpro'), 'selector' => '.latest-blog-image img'),
                                ),
                                'Content' => array(
                                    array('property' => 'background-color', 'label' => esc_html__('Background Color', 'starterpro'), 'selector' => '.latest-blog-content-wrapper,.latest-blog-content'),
                                    array('property' => 'background-color', 'label' => esc_html__('Hover BG Color', 'starterpro'), 'selector' => '.latest-blog-content-wrapper:hover,.latest-blog-content:hover'),
                                    array('property' => 'border', 'label' => esc_html__('Border', 'starterpro'), 'selector' => '.latest-blog-content-wrapper,.latest-blog-content'),
                                    array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'starterpro'), 'selector' => '.latest-blog-content-wrapper,.latest-blog-content'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'starterpro'), 'selector' => '.latest-blog-content-wrapper,.latest-blog-content'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'starterpro'), 'selector' => '.latest-blog-content-wrapper,.latest-blog-content'),
                                ),
                                'Desc'  => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'starterpro'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'starterpro'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'starterpro'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'starterpro'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'starterpro'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'starterpro'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'text-align', 'label' => esc_html__('Text Align', 'starterpro'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'starterpro'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'starterpro'), 'selector' => '.latest-blog-content'),
                                ),								
								'Button' => array(
									array('property' => 'color', 'label' => esc_html__('Color', 'starterpro'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'color', 'label' => esc_html__('Hover Color', 'starterpro'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-blog-content-wrapper:hover .latest-post-button,.latest-review-single-layout3:hover .latest-post-button'),
									array('property' => 'background-color', 'label' => esc_html__('BG color', 'starterpro'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'background-color', 'label' => esc_html__('Hover BG Color', 'starterpro'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.kc-list-item-2:hover .latest-post-button,.latest-review-single-layout3:hover .latest-post-button'),
									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'starterpro'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'starterpro'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'starterpro'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'starterpro'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'starterpro'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'border', 'label' => esc_html__('Border', 'starterpro'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'border-color', 'label' => esc_html__('Border Hover Color', 'starterpro'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'starterpro'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'margin', 'label' => esc_html__('Margin', 'starterpro'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'padding', 'label' => esc_html__('Padding', 'starterpro'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
								),                                
                            )
                        )
                    )
                ),
                'animate' => array(
                    array(
                        'name'    => 'animate',
                        'type'    => 'animate'
                    )
                ),

                )//params
            ),//themeum_latest_p

            )//array
        ); // End add map

    } // End if
}



// Register Hover Shortcode
function themeum_latest_post_shortcodes($atts, $content = null){
    $output = $post_taxonomy = $column = $headline = $number = $class = $orderby = $order = $show_date = $extra_class = $en_author = '';$layout = 1;
    extract( shortcode_atts( array(
		'post_taxonomy' 				=> '',
		'layout' 						=> '',
		'headline' 						=> '',
		'column' 						=> '4',
		'number' 						=> '3',
		'class' 						=> '',
        'orderby'                       => 'date',          
        'en_author'  					=> '2',          
        'order'   						=> 'DESC',   
        'words'                         => 'yes',  
        'extra_class'   				=> '',  
    ), $atts ));

    if( empty( $headline ) ) {
        $headline = 'h3';
    }

    $wrap_class  = apply_filters( 'kc-el-class', $atts );

    $class_title = array( 'themeum_latest_p' );
    $wrap_class[] = 'themeum-post-wrap-' . $layout;

    $wrap_class[] = 'themeum-post-wrap';

    if ( !empty( $extra_class ) ) {
        $wrap_class[] = esc_attr($extra_class);
    }

	$post_taxonomy_data = explode( ',', $post_taxonomy );
	$taxonomy_term = array();
	$post_type = 'post';

	if( isset($post_taxonomy_data) ){
		foreach( $post_taxonomy_data as $post_taxonomy ){
			$post_taxonomy_tmp = explode( ':', $post_taxonomy );
			$post_type = $post_taxonomy_tmp[0];

			if( isset($post_taxonomy_tmp[1]) ){
				$taxonomy_term[] = $post_taxonomy_tmp[1];
			}
		}
	}

	$taxonomy_objects = get_object_taxonomies( $post_type, 'objects' );
	$taxonomy = key( $taxonomy_objects );

	$args = array(
		'post_type' 		=> $post_type,
		'posts_per_page' 	=> esc_attr($number),
		'orderby'        	=> esc_attr($orderby),
		'order' 			=> esc_attr($order),
	);

	if( count($taxonomy_term) )
	{
		$tax_query = array(
			'relation' => 'OR'
		);

		foreach( $taxonomy_term as $term ){
			$tax_query[] = array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $term,
			);
		}

		$args['tax_query'] = $tax_query;
	}

	$the_query = new WP_Query( $args );


	if ( $layout == 3 ) {
        if ( $the_query->have_posts() ) {
           global $post;
            $output .= '<div class="latest-review row '.esc_attr( implode( ' ', $wrap_class ) ).'">';
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $output .= '<div class="latest-review-single-item col-sm-'.esc_attr($column).'">';
                    $output .= '<div class="latest-review-single-layout3">';
                        $output .= '<a class="latest-blog-image"  href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'starterpro-medium', array('class' => 'img-responsive')).'</a>';
                        $output .= '<div class="latest-blog-content">';
                            $output .= '<span class="latest-blog-date">'.get_the_date('d M Y').'</span>';
                            $output .= '<'.esc_attr($headline).' class="latest-post-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></'.esc_attr($headline).'>';
                            $output .= '<a class="latest-post-button" href="'.get_permalink().'">'. esc_html__('Read More', 'starterpro') .'</a>';
                        $output .= '</div>';//latest-blog-content
                    $output .= '</div>';//latest-review-single-item
                $output .= '</div>';//latest-review-single-item
            } 
            $output .= '</div>';//latest-review 
        }

	}else if ( $layout == 2 ) {
        if ( $the_query->have_posts() ) {
        global $post;
        $output .= '<div class="latest-review row '.esc_attr( implode( ' ', $wrap_class ) ).'">';
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $output .= '<div class="col-sm-'.esc_attr($column).'">';
            $output .= '<div class="latest-review-single-layout2">';
                $output .= '<a class="latest-blog-image"  href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'starterpro-medium', array('class' => 'img-responsive')).'</a>';
                $output .= '<div class="latest-blog-content-wrapper clearfix">';
                    $output .= '<span class="latest-blog-date">'.get_the_date('d M Y').'</span>';
                    $output .= '<'.esc_attr($headline).' class="latest-post-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></'.esc_attr($headline).'>';
                    if ($en_author == '1') {
                        $output .= '<div class="post-author">';
                            $output .= '<div class="author-avatar pull-left"> <img src='.get_avatar_url( get_the_author_meta('email') ).'> '. get_the_author_posts_link($post->ID) .'</div>';
                        $output .= '</div>';

                        // $output .= '<div class="post-author">';
                        //     $output .= '<div class="author-avatar pull-left">'. get_the_terms( $id, 'category' ) .'</div>';
                        // $output .= '</div>';
                    }
                    $output .= '<div class="blog-arrows"><a class="latest-post-button" href="'.get_permalink().'">'. esc_html__('Read More', 'starterpro') .'<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>';
                $output .= '</div>';
            $output .= '</div>';
            
            $output .= '</div>';
        } 
        $output .= '</div>'; 
        }
    } else {

        if ( $the_query->have_posts() ) {
           global $post;
            $output .= '<div class="latest-review row '.esc_attr( implode( ' ', $wrap_class ) ).'">';
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $output .= '<div class="latest-review-single-item col-sm-'.esc_attr($column).'">';
                    $output .= '<div class="latest-review-single-layout1">';
                        $output .= '<a class="latest-blog-image"  href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'starterpro-medium', array('class' => 'img-responsive')).'</a>';
                        $output .= '<span class="latest-blog-date"><i class="fa fa-clock-o"></i> '.get_the_date('d M Y').'</span>';
                        $output .= '<'.esc_attr($headline).' class="latest-post-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></'.esc_attr($headline).'>';
                        if ( $words > 0 ){
                            $output .= '<div class="latest-blog-content">'.wp_trim_words( $post->post_content, $words ).'</div>';
                        }
                        $output .= '<a class="latest-post-button" href="'.get_permalink().'">'. esc_html__('Read More', 'starterpro') .'</a>';
                    $output .= '</div>';
                $output .= '</div>';
            } 
            $output .= '</div>';  
        }  
    }

	wp_reset_postdata();
	return $output;
}
add_shortcode('themeum_latest_p', 'themeum_latest_post_shortcodes');



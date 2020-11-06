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
                'description' => esc_html__('Add themeum latest post', 'wptixon'),
                'icon'        => 'fa-pencil-square-o',
                'category'    => 'Tixon',
                'params'        => array(
                'general'   => array(                   
					array(
						'type'			=> 'post_taxonomy',
						'label'			=> esc_html__( 'Content Type', 'wptixon' ),
						'name'			=> 'post_taxonomy',
						'description'	=> esc_html__( 'Choose supported content type such as post, custom post type, etc.', 'wptixon' ),
					), 
					array(
						'type'			=> 'number_slider',
						'label'			=> esc_html__( 'Number of posts displayed', 'wptixon' ),
						'name'			=> 'number',
						'description'	=> esc_html__( 'The number of posts you want to show.', 'wptixon' ),
						'value'			=> '5',
						'admin_label'	=> true,
						'options' => array(
							'min' => 1,
							'max' => 20
						)
					),  					                  
                    array(
                        'name'    => 'headline',
                        'label'   => esc_html__('Type', 'wptixon'),
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
						'label'			=> esc_html__( 'Order by', 'wptixon' ),
						'name'			=> 'orderby',
						'admin_label'	=> true,
						'options' 		=> array(
							'ID'		=> esc_html__('Post ID', 'wptixon'),
							'author'	=> esc_html__('Author', 'wptixon'),
							'title'		=> esc_html__('Title', 'wptixon'),
							'name'		=> esc_html__('Post name (post slug)', 'wptixon'),
							'type'		=> esc_html__('Post type (available since Version 4.0)', 'wptixon'),
							'date'		=> esc_html__('Date', 'wptixon'),
							'modified'	=> esc_html__('Last modified date', 'wptixon'),
							'rand'		=> esc_html__('Random order', 'wptixon'),
							'comment_count'	=> esc_html__('Number of comments', 'wptixon')
						)
					),  
					array(
						'type'			=> 'text',
						'label'			=> esc_html__( 'Limit Words', 'wptixon' ),
						'name'			=> 'words',
						'value'			=> 20,
						'description'	=> esc_html__( 'Limit words you want show as short description', 'wptixon' ),
                        'relation'    => array(
                            'parent'    => 'layout',
                            'show_when' => array('1','2'),
                        ),
					),	
					array(
						'type'		=> 'select',
						'label'		=> esc_html__( 'Order By', 'wptixon' ),
						'name'		=> 'order',
						'options'	=> array(
							'DESC'	=> esc_html__( 'Descending', 'wptixon' ),
							'ASC'	=> esc_html__( 'Ascending', 'wptixon' )
						)
					),           
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Custom class', 'wptixon' ),
                        'name'          => 'extra_class',
                        'description'   => esc_html__( 'Enter extra custom class', 'wptixon' )
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
                                    array('property' => 'color', 'label' => esc_html__('Color', 'wptixon'), 'selector' => '.latest-post-title,.latest-post-title a,.post-author .author-avatar a'),
                                    array('property' => 'color', 'label' => esc_html__('Hover Color', 'wptixon'), 'selector' => '.latest-blog-content-wrapper:hover .latest-post-title a,.latest-blog-content-wrapper:hover .post-author .author-avatar a,.latest-review-single-layout3:hover .latest-post-title a'),
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'wptixon'), 'selector' => '.latest-post-title'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'wptixon'), 'selector' => '.latest-post-title'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'wptixon'), 'selector' => '.latest-post-title'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'wptixon'), 'selector' => '.latest-post-title'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'wptixon'), 'selector' => '.latest-post-title'),
                                    array('property' => 'text-align', 'label' => esc_html__('Text Align', 'wptixon'), 'selector' => '.latest-post-title'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.latest-post-title'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.latest-post-title'),
                                ),
                                'Date'  => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'wptixon'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'color', 'label' => esc_html__('Hover Color', 'wptixon'), 'selector' => '.latest-blog-content-wrapper:hover .latest-blog-date,.latest-review-single-layout3:hover .latest-blog-date'),
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'wptixon'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'wptixon'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'wptixon'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'wptixon'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'wptixon'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'text-align', 'label' => esc_html__('Text Align', 'wptixon'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.latest-blog-date'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.latest-blog-date'),
                                ),
                                'Image' => array(
                                    array('property' => 'background-color', 'label' => esc_html__('Background Color', 'wptixon'), 'selector' => '.latest-blog-image img'),
                                    array('property' => 'border', 'label' => esc_html__('Border', 'wptixon'), 'selector' => '.latest-blog-image img'),
                                    array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'wptixon'), 'selector' => '.latest-blog-image img'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.latest-blog-image img'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.latest-blog-image img'),
                                ),
                                'Content' => array(
                                    array('property' => 'background-color', 'label' => esc_html__('Background Color', 'wptixon'), 'selector' => '.latest-blog-content-wrapper,.latest-blog-content'),
                                    array('property' => 'background-color', 'label' => esc_html__('Hover BG Color', 'wptixon'), 'selector' => '.latest-blog-content-wrapper:hover,.latest-blog-content:hover'),
                                    array('property' => 'border', 'label' => esc_html__('Border', 'wptixon'), 'selector' => '.latest-blog-content-wrapper,.latest-blog-content'),
                                    array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'wptixon'), 'selector' => '.latest-blog-content-wrapper,.latest-blog-content'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.latest-blog-content-wrapper,.latest-blog-content'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.latest-blog-content-wrapper,.latest-blog-content'),
                                ),
                                'Desc'  => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'wptixon'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'wptixon'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'wptixon'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'wptixon'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'wptixon'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'wptixon'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'text-align', 'label' => esc_html__('Text Align', 'wptixon'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.latest-blog-content'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.latest-blog-content'),
                                ),								
								'Button' => array(
									array('property' => 'color', 'label' => esc_html__('Color', 'wptixon'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'color', 'label' => esc_html__('Hover Color', 'wptixon'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-blog-content-wrapper:hover .latest-post-button,.latest-review-single-layout3:hover .latest-post-button'),
									array('property' => 'background-color', 'label' => esc_html__('BG color', 'wptixon'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'background-color', 'label' => esc_html__('Hover BG Color', 'wptixon'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.kc-list-item-2:hover .latest-post-button,.latest-review-single-layout3:hover .latest-post-button'),
									array('property' => 'font-family', 'label' => esc_html__('Font Family', 'wptixon'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'font-size', 'label' => esc_html__('Font Size', 'wptixon'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'line-height', 'label' => esc_html__('Line Height', 'wptixon'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'wptixon'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'wptixon'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'border', 'label' => esc_html__('Border', 'wptixon'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'border-color', 'label' => esc_html__('Border Hover Color', 'wptixon'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'wptixon'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
									array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'des' => 'Just applied for layout 1 and layout 2', 'selector' => '.latest-post-button'),
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


	if ( $the_query->have_posts() ) {
       global $post;
        $output .= '<div class="latest-review '.esc_attr( implode( ' ', $wrap_class ) ).'">';
        $output .= '<div class="row">';
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $post_img = '';
            if ( has_post_thumbnail() ) {
                $wpt_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'wptixon-medium');

                $post_img = (isset($wpt_img[0]) && !empty($wpt_img[0])) ? $wpt_img[0] : '';
            }
            $output .= '<article class="wptixon-post col-md-'.$column.'">';
                $output .= (!empty($post_img)) ? '<a href="'.get_permalink().'"><img src="'.esc_url($post_img).'" alt="" class="post-featured-img img-responsive"></a>' : '';
                $output .= '<div class="entry-header wptixon-latest-post has-image">';
                        $output .= '<div class="tixon-blog-title">';
                            $output .= '<div class="blog-date-wrapper"><time datetime="'.get_the_date().'">'.get_the_date().'</time></div>';
                            $output .= '<'.esc_attr($headline).' class="content-item-title"><a href="'.get_permalink().'">'.get_the_title().'</a></'.esc_attr($headline).'>';
                            $output .= '<ul class="blog-post-meta clearfix">';
                                $output .= '<li class="meta-author"><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><i class="fa fa-user"></i> '.get_the_author_meta('display_name').'</a></li>';
                                $output .= '<li class="meta-author"><i class="fa fa-folder-open-o"></i> '.get_the_category_list(', ').'</li>';
                            $output .= '</ul>';
                        $output .= '</div>';
                $output .= '</div>';
            $output .= '</article>';//latest-review-single-item
        } 
        $output .= '</div>';//latest-review 
        $output .= '</div>';//latest-review 
    }

	wp_reset_postdata();
	return $output;
}
add_shortcode('themeum_latest_p', 'themeum_latest_post_shortcodes');



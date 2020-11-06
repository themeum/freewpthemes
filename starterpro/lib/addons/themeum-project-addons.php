<?php
add_action('init', 'themeum_project_shortcode', 99);

function themeum_project_shortcode(){
    global $kc;
    if (function_exists('kc_add_map')) 
    { 
        kc_add_map(
            array(

        'themeum_feature_project' => array(
                'name'        => 'Themeum Porject',
                'description' => esc_html__('Add themeum project', 'starterpro'),
                'icon'        => 'et-genius',
                'category'    => 'Starter',
                'params'        => array(
                'general'   => array(  

                    array(
                        'type'          => 'radio_image',
                        'label'         => esc_html__( 'Select layout', 'starterpro' ),
                        'name'          => 'layout',
                        'admin_label'   => true,
                        'options'       => array(
                            'layout1' => get_template_directory_uri()  . '/lib/addons/image/project/1.png',
                            'layout2' => get_template_directory_uri()  . '/lib/addons/image/project/2.png',
                            'layout3' => get_template_directory_uri()  . '/lib/addons/image/project/3.png',
                        ),
                        'value'         => 'layout1'
                    ), 

                    array(
                        'type'          => 'number_slider',
                        'label'         => esc_html__( 'Number of posts displayed', 'starterpro' ),
                        'name'          => 'number',
                        'description'   => esc_html__( 'The number of posts you want to show.', 'starterpro' ),
                        'value'         => '6',
                        'admin_label'   => true,
                        'options' => array(
                            'min' => 0,
                            'max' => 20
                        )
                    ), 
                    array(
                        'type'          => 'dropdown',
                        'label'         => esc_html__( 'Select Column', 'starterpro' ),
                        'name'          => 'column',
                        'options'       => array( 
                            '6' => esc_html__( 'Column 2', 'starterpro' ),
                            '4' => esc_html__( 'Column 3', 'starterpro' ),
                            '3' => esc_html__( 'Column 4', 'starterpro' ),
                            '2' => esc_html__( 'Column 6', 'starterpro' ),
                        ),
                        'value'         => '3'
                    ), 
                    array(
                        'type'          => 'number_slider',
                        'label'         => esc_html__( 'Space between each item', 'starterpro' ),
                        'name'          => 'empty_space',
                        'description'   => esc_html__( 'The number of posts you want to show.', 'starterpro' ),
                        'value'         => '',
                        'admin_label'   => true,
                        'options' => array(
                            'min' => 0,
                            'max' => 40
                        )
                    ), 
                    array(
                        'name'          => 'show_title',
                        'type'          => 'dropdown',
                        'label'         => esc_html__('Show Title', 'starterpro'),
                        'options'       => array(
                                '1'     => esc_html__('Yes', 'starterpro'),
                                '2'   => esc_html__('No', 'starterpro'),

                          ),
                        'value'         => '1',
                    ), 
                    array(
                        'name'          => 'show_external_link',
                        'type'          => 'dropdown',
                        'label'         => esc_html__('Show external link', 'starterpro'),
                        'options'       => array(
                                '1'     => esc_html__('Yes', 'starterpro'),
                                '2'   => esc_html__('No', 'starterpro'),

                          ),
                        'value'         => '2',
                       'relation'    => array(
                            'parent'    => 'show_title',
                            'show_when' => '1',
                        ),
                    ),                                                            
                    array(
                        'name'          => 'show_category',
                        'type'          => 'dropdown',
                        'label'         => esc_html__('Show category', 'starterpro'),
                        'options'       => array(
                                '1'     => esc_html__('Yes', 'starterpro'),
                                '2'   => esc_html__('No', 'starterpro'),

                          ),
                        'value'         => '1',
                    ), 
                    array(
                        'name'        => 'before_title',
                        'label'       =>  esc_html__('Show category before title', 'starterpro'),
                        'type'        => 'toggle',
                        'relation'    => array(
                            'parent'    => 'show_category',
                            'show_when' => '1',
                        ),
                    ),                                        
                    array(
                        'name'          => 'show_popup',
                        'type'          => 'dropdown',
                        'label'         =>  esc_html__('Show image Popup', 'starterpro'),
                        'options'       => array(
                                '1'     => esc_html__('Yes', 'starterpro'),
                                '2'   => esc_html__('No', 'starterpro'),

                          ),
                        'value'         => '1',
                    ),                     
                    array(
                        'name'          => 'show_filter',
                        'type'          => 'dropdown',
                        'label'         =>  esc_html__('Show Filter', 'starterpro'),
                        'options'       => array(
                                '1'     => esc_html__('Yes', 'starterpro'),
                                '2'   => esc_html__('No', 'starterpro'),

                          ),
                        'value'         => '1',
                    ),    
                    array(
                        'name'          => 'project_order',
                        'type'          => 'dropdown',
                        'label'         => esc_html__('Project order', 'starterpro'),
                        'options'       => array(
                                    'ASC'     => esc_html__('Left', 'starterpro'),
                                    'DESC'   => esc_html__('Center', 'starterpro'),
                          ),
                        'value'         => 'ASC',
                    ),                      
                    array(
                        'name'          => 'project_orderby',
                        'type'          => 'dropdown',
                        'label'         => esc_html__('Project orderby', 'starterpro'),
                        'options'       => array(
                                    'menu_order'     => esc_html__('Menu order', 'starterpro'),
                                    'title'   => esc_html__('Title', 'starterpro'),
                                    'date'   => esc_html__('Date', 'starterpro'),
                                    'rand'   => esc_html__('Rand', 'starterpro'),
                          ),
                        'value'         => 'menu_order',
                    ),                                      
                    array(
                        'name'          => 'project_align',
                        'type'          => 'dropdown',
                        'label'         => esc_html__('Project wrap align', 'starterpro'),
                        'options'       => array(
                                    'left'     => esc_html__('Left', 'starterpro'),
                                    'center'   => esc_html__('Center', 'starterpro'),
                                    'right'    => esc_html__('Right', 'starterpro'),
                          ),
                        'value'         => 'left',
                        'description'   => esc_html__('Select the projet wrap align', 'starterpro'),
                    ),                                                                                                                                                          
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Custom class', 'starterpro' ),
                        'name'          => 'extra_class',
                        'description'   => esc_html__( 'Enter extra custom class', 'starterpro' ),
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
                                    array('property' => 'color', 'label' => esc_html__('Color', 'starterpro'), 'selector' => '.portfolio-title, .portfolio-title a'),                                            
                                    array('property' => 'color', 'label' => esc_html__('Hover color', 'starterpro'), 'selector' => '.portfolio-title, .portfolio-title a:hover'),                                            
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'starterpro'), 'selector' => '.portfolio-title'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'starterpro'), 'selector' => '.portfolio-title'),
                                    array('property' => 'display', 'label' => esc_html__('Display', 'starterpro'), 'selector' => '.portfolio-title'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font weight', 'starterpro'), 'selector' => '.portfolio-title'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line height', 'starterpro'), 'selector' => '.portfolio-title'),
                                    array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'starterpro'), 'selector' => '.portfolio-title'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'starterpro'), 'selector' => '.portfolio-title'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'starterpro'), 'selector' => '.portfolio-title'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'starterpro'), 'selector' => '.portfolio-title')
                                ),                                 
                                'Category' => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'starterpro'), 'selector' => '.portfolio-category, .portfolio-category a'),                                            
                                    array('property' => 'color', 'label' => esc_html__('Hover color', 'starterpro'), 'selector' => '.portfolio-category, .portfolio-category a:hover'),                                            
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'starterpro'), 'selector' => '.portfolio-category'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'starterpro'), 'selector' => '.portfolio-category'),
                                    array('property' => 'display', 'label' => esc_html__('Display', 'starterpro'), 'selector' => '.portfolio-category'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font weight', 'starterpro'), 'selector' => '.portfolio-category'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line height', 'starterpro'), 'selector' => '.portfolio-category'),
                                    array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'starterpro'), 'selector' => '.portfolio-category'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'starterpro'), 'selector' => '.portfolio-category'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'starterpro'), 'selector' => '.portfolio-category'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'starterpro'), 'selector' => '.portfolio-category')
                                ),  
                                'Popup Icon'  => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'starterpro'), 'selector' => '.plus-icon'),
                                    array('property' => 'color', 'label' => esc_html__('Hover', 'starterpro'), 'selector' => '.plus-icon:hover'),
                                    array('property' => 'background', 'label' => esc_html__('Background', 'starterpro'), 'selector' => '.plus-icon'),
                                    array('property' => 'background', 'label' => esc_html__('Hover Background', 'starterpro'), 'selector' => '.plus-icon:hover'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'starterpro'), 'selector' => '.plus-icon'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'starterpro'), 'selector' => '.plus-icon'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'starterpro'), 'selector' => '.plus-icon'),
                                    array('property' => 'width', 'label' => esc_html__('Color', 'starterpro'), 'selector' => '.plus-icon'),
                                    array('property' => 'height', 'label' => esc_html__('Height', 'starterpro'), 'selector' => '.plus-icon'),
                                    array('property' => 'border', 'label' => esc_html__('Border', 'starterpro'), 'selector' => '.plus-icon'),
                                    array('property' => 'border', 'label' => esc_html__('Hover Border', 'starterpro'), 'selector' => '.plus-icon:hover'),
                                    array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'starterpro'), 'selector' => '.plus-icon'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'starterpro'), 'selector' => '.plus-icon'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'starterpro'), 'selector' => '.plus-icon'),
                                ),  
                                'Box' => array(
                                    array('property' => 'background', 'label' => esc_html__('Background', 'starterpro'), 'selector' => '.portfolio-thumb:before'),
                                    array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'starterpro'), 'selector' => '.portfolio-thumb-wrapper,.portfolio-thumb, .portfolio-thumb img,.portfolio-thumb:before'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'starterpro'), 'selector' => '.portfolio-thumb-wrapper'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'starterpro'), 'selector' => '.portfolio-thumb-wrapper'),
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
            ),//themeum_video_popup

            )//array
        ); // End add map

    } // End if
}


function themeum_project_register($atts, $content=null)
{
    $output  = $layout = $layoutstyle = $project_order = $project_orderby = $before_title = $extra_class = $empty_space = $number = $show_external_link = $show_popup = $column = $borderclass = $style = $project_align = $show_category = $align = $show_filter = $show_title = '';
    extract(shortcode_atts(array(
        'layout'                => 'layout1',
        'project_align'         => 'left',
        'number'                => '8',
        'column'                => '4',
        'show_filter'           => '1',
        'show_popup'            => '1',
        'show_title'            => '1',
        'show_external_link'    => '2',
        'project_order'         => 'ASC',
        'project_orderby'       => 'menu_order',
        'show_category'         => '1',
        'before_title'          => '',
        'empty_space'           => '',
        'extra_class'           => '',
    ), $atts));


    $wrap_class  = apply_filters( 'kc-el-class', $atts );

    if ( !empty( $extra_class ) ) {
        $wrap_class[] = esc_attr($extra_class);
    }
    
    if ( !empty($layout) ) {
        $layoutstyle = 'portfolio-filter-'.esc_attr($layout);
    }    
    if ( !empty($empty_space) ) {
        $empty_space = esc_attr($empty_space);
    }

    $borderclass = rand(1,100); 

    //border layout
    if( $project_align ){ 
        if( $project_align == 'left' ){ $align = 'text-left'; }
        if( $project_align == 'right' ){ $align = 'text-right'; }
        if( $project_align == 'center' ){ $align = 'text-center'; }
    }else{
        $align = 'text-left';
    }
 
    if( $empty_space ){
        $style .= '.portfolio-items > .portfolio-item-'.$borderclass.'{padding:'.(int)$empty_space.'px; }';
        $style .= '.row.portfolio-items-'.$borderclass.'{margin: -'.(int)$empty_space.'px; }';
    }
    if ( !empty($empty_space) ) {
       $output .= '<style>'.$style.'</style>';
    }

    $output .= '<div class="themeum-project-shortcode '.esc_attr( implode( ' ', $wrap_class ) ).'">';
        $output .= '<div class="themeum-project-wrap themeum-project-wrap-'.esc_attr($layout).'">';

            //filter
            if ($show_filter == '1') {  
                $filters    = get_terms('project-tag');
                if ( $filters && !is_wp_error( $filters ) ) {
                    $output .= '<ul id="portfolio-filter" class="portfolio-filter text-center '.$layoutstyle.'">';
                        $output .= '<li><a class="btn-link active" href="#" data-filter="*">'.esc_html__('All','starterpro').'</a></li>';
                    foreach ( $filters as $filter ){ 
                        $output .= '<li><a class="btn-link" href="#" data-filter=".'.esc_attr($filter->slug).'">'.esc_html($filter->name).'</a></li>';
                    }
                    $output .= '</ul>';
                }  
            }

            $args = array(
                'post_type'         => 'project',
                'posts_per_page'    => esc_attr($number),
                'orderby'           => esc_attr($project_orderby),
                'order'             => esc_attr($project_order)
            );

            $myproject = get_posts($args);

            $output .= '<div id="themeum-area" class="portfolio-items portfolio-items-'.$borderclass.' row '.$align.'">';

            $total = count($myproject);
            $count = 0;
            $index = 0;

            foreach ($myproject as $post)
            {     
                $external_link    = esc_attr(get_post_meta($post->ID,'external_link',true));
                setup_postdata( $post );

                # Filter List Item
                $terms      = get_the_terms( $post->ID, 'project-tag' );
                $term_name  = '';
                if (is_array( $terms )) {
                    foreach ( $terms as $term ) {
                        $term_name .= ' '.$term->slug;
                    }
                }

                # category list
                $terms2 = get_the_terms( $post->ID, 'project-tag' );
                $term_name2 = '';
                if (is_array( $terms2 ))
                {
                    foreach ( $terms2 as $term2 )
                    {
                        $term_name2 .= $term2->slug.', ';
                    }
                }
                $term_name2 = substr($term_name2, 0, -2);       

                $output .= '<div class="themeum-post-item portfolio-item portfolio-item-'.$borderclass.' '.$term_name.' col-md-'.esc_attr($column).'">';
                $output .= '<div class="portfolio-thumb-wrapper portfolio-thumb-wrapper-'.esc_attr($layout).'">';
                $output .= '<div class="portfolio-thumb">';
                    if(has_post_thumbnail($post->ID))
                    {
                        if ($column == '3' || $column == '2') {
                            $thumb  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
                        }else{
                            $thumb  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'starterpro-medium');
                        }
                        $output .= '<img class="img-responsive" src="'.esc_url($thumb[0]).'"  alt="">';
                    } else {
                        $output .= '<img class="img-responsive" src="'.get_template_directory_uri().'/images/recipes.jpg" alt="'.__('image','starterpro').'">';
                    }
                $output .= '</div>';//portfolio-thumb
                $output .= '<div class="portfolio-item-content">';
                    if ($show_popup == '1') {
                        if(has_post_thumbnail($post->ID)){
                            $fullthumb  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
                            $output .= '<a href="' . $fullthumb[0] . '" class="plus-icon"><i class="sl-magnifier"></i></a>';
                        }
                    }
                    $output .= '<div class="portfolio-item-content-in">';
                        if ($show_category == '1') {
                            if ( $before_title == 'yes' ) {
                               if($term_name != '') { $output .= '<span class="portfolio-category">'.esc_html($term_name2).'</span>'; }
                            }
                        }
                        if ($show_title == '1' ) {
                            if ( $show_external_link == '1' ) {

                                $output .= '<h3 class="portfolio-title"><a href="'.esc_url($external_link).'">'.get_the_title($post->ID).'</a></h3>';
                            } else{
                                $output .= '<h3 class="portfolio-title"><a href="'.get_permalink( $post->ID ).'">'.get_the_title($post->ID).'</a></h3>';
                            }
                        }
                        if ($show_category == '1') {
                            if ( $before_title != 'yes' ) {
                               if($term_name != '') { $output .= '<span class="portfolio-category">'.esc_html($term_name2).'</span>'; }
                            }
                        }
                    $output .= '</div>';//portfolio-item-content-in 
                $output .= '</div>';//portfolio-item-content    
                $output .= '</div>';//portfolio-thumb-wrapper    
                $output .= '</div>';//themeum-post-item

                $count++;
                $index++;
            }
            $output .= '</div>';//portfolio-items 
        $output .= '</div>';//themeum-project-wrap    
    $output .= '</div>';//themeum-project-shortcode  

    wp_reset_postdata();

    return $output;
}

add_shortcode('themeum_feature_project', 'themeum_project_register');


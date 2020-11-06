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
                'description' => esc_html__('Add themeum project', 'wptixon'),
                'icon'        => 'et-genius',
                'category'    => 'Tixon',
                'params'        => array(
                'general'   => array(

                    array(
                        'type'          => 'dropdown',
                        'label'         => esc_html__( 'Select Layout', 'wptixon' ),
                        'name'          => 'layout',
                        'options'       => array(
                            'layout4' => esc_html__( 'Portfolio Classic', 'wptixon' ),
                            'layout7' => esc_html__( 'Portfolio Overlay', 'wptixon' ),
                            'layout6' => esc_html__( 'Masonry Classic', 'wptixon' ),
                            'layout5' => esc_html__( 'Masonry Overlay', 'wptixon' ),
                            'layout1' => esc_html__( 'Title Border', 'wptixon' ),   
                        ),
                        'value'         => 'layout1'
                    ),

                    array(
                        'type'          => 'number_slider',
                        'label'         => esc_html__( 'Number of posts displayed', 'wptixon' ),
                        'name'          => 'number',
                        'description'   => esc_html__( 'The number of posts you want to show.', 'wptixon' ),
                        'value'         => '6',
                        'admin_label'   => true,
                        'options' => array(
                            'min' => 0,
                            'max' => 20
                        )
                    ),
                    array(
                        'type'          => 'dropdown',
                        'label'         => esc_html__( 'Select Column', 'wptixon' ),
                        'name'          => 'column',
                        'options'       => array(
                            '6' => esc_html__( 'Column 2', 'wptixon' ),
                            '4' => esc_html__( 'Column 3', 'wptixon' ),
                            '3' => esc_html__( 'Column 4', 'wptixon' ),
                            '2' => esc_html__( 'Column 6', 'wptixon' ),
                        ),
                        'value'         => '3'
                    ),
                    array(
                        'type'          => 'number_slider',
                        'label'         => esc_html__( 'Space between each item', 'wptixon' ),
                        'name'          => 'empty_space',
                        'description'   => esc_html__( 'The number of posts you want to show.', 'wptixon' ),
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
                        'label'         => esc_html__('Show Title', 'wptixon'),
                        'options'       => array(
                                '1'     => esc_html__('Yes', 'wptixon'),
                                '2'   => esc_html__('No', 'wptixon'),

                          ),
                        'value'         => '1',
                    ),
                    array(
                        'name'          => 'show_external_link',
                        'type'          => 'dropdown',
                        'label'         => esc_html__('Show external link', 'wptixon'),
                        'options'       => array(
                                '1'     => esc_html__('Yes', 'wptixon'),
                                '2'   => esc_html__('No', 'wptixon'),

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
                        'label'         => esc_html__('Show category', 'wptixon'),
                        'options'       => array(
                                '1'     => esc_html__('Yes', 'wptixon'),
                                '2'   => esc_html__('No', 'wptixon'),

                          ),
                        'value'         => '1',
                    ),
                    array(
                        'name'        => 'before_title',
                        'label'       =>  esc_html__('Show category before title', 'wptixon'),
                        'type'        => 'toggle',
                        'relation'    => array(
                            'parent'    => 'show_category',
                            'show_when' => '1',
                        ),
                    ),
                    array(
                        'name'          => 'show_popup',
                        'type'          => 'dropdown',
                        'label'         =>  esc_html__('Show image Popup', 'wptixon'),
                        'options'       => array(
                                '1'     => esc_html__('Yes', 'wptixon'),
                                '2'   => esc_html__('No', 'wptixon'),

                          ),
                        'value'         => '1',
                    ),
                    array(
                        'name'          => 'show_filter',
                        'type'          => 'dropdown',
                        'label'         =>  esc_html__('Show Filter', 'wptixon'),
                        'options'       => array(
                                '1'     => esc_html__('Yes', 'wptixon'),
                                '2'   => esc_html__('No', 'wptixon'),

                          ),
                        'value'         => '1',
                    ),
                    array(
                        'name'          => 'project_order',
                        'type'          => 'dropdown',
                        'label'         => esc_html__('Project order', 'wptixon'),
                        'options'       => array(
                                    'ASC'     => esc_html__('Left', 'wptixon'),
                                    'DESC'   => esc_html__('Center', 'wptixon'),
                          ),
                        'value'         => 'ASC',
                    ),
                    array(
                        'name'          => 'project_orderby',
                        'type'          => 'dropdown',
                        'label'         => esc_html__('Project orderby', 'wptixon'),
                        'options'       => array(
                                    'menu_order'     => esc_html__('Menu order', 'wptixon'),
                                    'title'   => esc_html__('Title', 'wptixon'),
                                    'date'   => esc_html__('Date', 'wptixon'),
                                    'rand'   => esc_html__('Rand', 'wptixon'),
                          ),
                        'value'         => 'menu_order',
                    ),
                    array(
                        'name'          => 'project_align',
                        'type'          => 'dropdown',
                        'label'         => esc_html__('Project wrap align', 'wptixon'),
                        'options'       => array(
                                    'left'     => esc_html__('Left', 'wptixon'),
                                    'center'   => esc_html__('Center', 'wptixon'),
                                    'right'    => esc_html__('Right', 'wptixon'),
                          ),
                        'value'         => 'left',
                        'description'   => esc_html__('Select the projet wrap align', 'wptixon'),
                    ),
                    array(
                        'type'          => 'text',
                        'label'         => esc_html__( 'Custom class', 'wptixon' ),
                        'name'          => 'extra_class',
                        'description'   => esc_html__( 'Enter extra custom class', 'wptixon' ),
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
                                    array('property' => 'color', 'label' => esc_html__('Color', 'wptixon'), 'selector' => '.portfolio-title, .portfolio-title a'),
                                    array('property' => 'color', 'label' => esc_html__('Hover color', 'wptixon'), 'selector' => '.portfolio-title, .portfolio-title a:hover'),
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'wptixon'), 'selector' => '.portfolio-title'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'wptixon'), 'selector' => '.portfolio-title'),
                                    array('property' => 'display', 'label' => esc_html__('Display', 'wptixon'), 'selector' => '.portfolio-title'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font weight', 'wptixon'), 'selector' => '.portfolio-title'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line height', 'wptixon'), 'selector' => '.portfolio-title'),
                                    array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'wptixon'), 'selector' => '.portfolio-title'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'wptixon'), 'selector' => '.portfolio-title'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.portfolio-title'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.portfolio-title')
                                ),
                                'Category' => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'wptixon'), 'selector' => '.portfolio-category, .portfolio-category a'),
                                    array('property' => 'color', 'label' => esc_html__('Hover color', 'wptixon'), 'selector' => '.portfolio-category a:hover'),
                                    array('property' => 'font-family', 'label' => esc_html__('Font Family', 'wptixon'), 'selector' => '.portfolio-category'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'wptixon'), 'selector' => '.portfolio-category'),
                                    array('property' => 'display', 'label' => esc_html__('Display', 'wptixon'), 'selector' => '.portfolio-category'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font weight', 'wptixon'), 'selector' => '.portfolio-category'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line height', 'wptixon'), 'selector' => '.portfolio-category'),
                                    array('property' => 'letter-spacing', 'label' => esc_html__('Letter Spacing', 'wptixon'), 'selector' => '.portfolio-category'),
                                    array('property' => 'text-transform', 'label' => esc_html__('Text Transform', 'wptixon'), 'selector' => '.portfolio-category'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.portfolio-category'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.portfolio-category')
                                ),
                                'Popup Icon'  => array(
                                    array('property' => 'color', 'label' => esc_html__('Color', 'wptixon'), 'selector' => '.plus-icon'),
                                    array('property' => 'color', 'label' => esc_html__('Hover', 'wptixon'), 'selector' => '.plus-icon:hover'),
                                    array('property' => 'background', 'label' => esc_html__('Background', 'wptixon'), 'selector' => '.plus-icon'),
                                    array('property' => 'background', 'label' => esc_html__('Hover Background', 'wptixon'), 'selector' => '.plus-icon:hover'),
                                    array('property' => 'font-size', 'label' => esc_html__('Font Size', 'wptixon'), 'selector' => '.plus-icon'),
                                    array('property' => 'line-height', 'label' => esc_html__('Line Height', 'wptixon'), 'selector' => '.plus-icon'),
                                    array('property' => 'font-weight', 'label' => esc_html__('Font Weight', 'wptixon'), 'selector' => '.plus-icon'),
                                    array('property' => 'width', 'label' => esc_html__('Color', 'wptixon'), 'selector' => '.plus-icon'),
                                    array('property' => 'height', 'label' => esc_html__('Height', 'wptixon'), 'selector' => '.plus-icon'),
                                    array('property' => 'border', 'label' => esc_html__('Border', 'wptixon'), 'selector' => '.plus-icon'),
                                    array('property' => 'border', 'label' => esc_html__('Hover Border', 'wptixon'), 'selector' => '.plus-icon:hover'),
                                    array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'wptixon'), 'selector' => '.plus-icon'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.plus-icon'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.plus-icon'),
                                ),
                                'Box' => array(
                                    array('property' => 'background', 'label' => esc_html__('Background', 'wptixon'), 'selector' => '.portfolio-thumb:before'),
                                    array('property' => 'border-radius', 'label' => esc_html__('Border Radius', 'wptixon'), 'selector' => '.portfolio-thumb-wrapper,.portfolio-thumb, .portfolio-thumb img,.portfolio-thumb:before'),
                                    array('property' => 'margin', 'label' => esc_html__('Margin', 'wptixon'), 'selector' => '.portfolio-thumb-wrapper'),
                                    array('property' => 'padding', 'label' => esc_html__('Padding', 'wptixon'), 'selector' => '.portfolio-thumb-wrapper'),
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
                $filters    = get_terms('project-cat');
                if ( $filters && !is_wp_error( $filters ) ) {
                    $output .= '<ul id="portfolio-filter" class="portfolio-filter text-center '.$layoutstyle.'">';
                        $output .= '<li><a class="active" href="#" data-filter="*">'.esc_html__('All','wptixon').'</a></li>';
                    foreach ( $filters as $filter ){
                        $output .= '<li><a href="#" data-filter=".'.esc_attr($filter->slug).'">'.esc_html($filter->name).'</a></li>';
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
                $terms      = get_the_terms( $post->ID, 'project-cat' );
                $term_name  = '';
                if (is_array( $terms )) {
                    foreach ( $terms as $term ) {
                        $term_name .= ' '.$term->slug;
                    }
                }

                # category list
                $terms2 = get_the_terms( $post->ID, 'project-cat' );
                $term_name2 = '';
                if (is_array( $terms2 ))
                {
                    foreach ( $terms2 as $term2 )
                    {
                        $term_name2 .= $term2->slug.', ';
                    }
                }
                $term_name2 = substr($term_name2, 0, -2);
                $masonry = '';
                $extra_layout = $layout;
                if( $layout == 'layout5' || $layout == 'layout6' ){
                  $masonry = 'element-masonry';
                }
                if($layout == 'layout6'){
                  $extra_layout = 'layout4';
                }
                $output .= '<div class="'.$masonry.' themeum-post-item portfolio-item portfolio-item-'.$borderclass.' '.$term_name.' col-md-'.esc_attr($column).'">';
                $output .= '<div class="portfolio-thumb-wrapper portfolio-thumb-wrapper-'.esc_attr($extra_layout).'">';
                $output .= '<div class="portfolio-thumb">';
                    if(has_post_thumbnail($post->ID))
                    {
                        if( $layout == 'layout5' ){
                            $thumb  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'wptixon-marso-portfo');
                        } elseif ( $layout == 'layout6' ) {
                            $thumb  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'wptixon-marso-portfo');
                        } else {
                            $thumb  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'wptixon-portfo');
                        }
                        $output .= '<img class="img-responsive" src="'.esc_url($thumb[0]).'"  alt="">';
                    } else {
                        $output .= '<img class="img-responsive" src="'.get_template_directory_uri().'/images/recipes.jpg" alt="'.__('image','wptixon').'">';
                    }

                    if(has_post_thumbnail($post->ID)){
                        if($extra_layout=='layout4' || $layout=='layout7' ){
                            $fullthumb  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
                            $output .= '<div class="plus-icon-wrap"><a href="' . $fullthumb[0] . '" class="plus-icon"><i class="sl-eye"></i></a></div>';
                        }
                    }

                $output .= '</div>';//portfolio-thumb
                $output .= '<div class="portfolio-item-content">';
                    if ($show_popup == '1') {
                        if(has_post_thumbnail($post->ID)){
                            if($layout!='layout4'){
                                if($layout!='layout7'){
                                  $fullthumb  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
                                  $output .= '<div class="plus-icon-wrap"><a href="' . $fullthumb[0] . '" class="plus-icon"><i class="sl-eye"></i></a></div>';
                                }
                            }
                        }
                    }
                    $output .= '<div class="portfolio-item-content-in">';
                        $output .= '<div>';
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
                        $output .= '</div>';
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

<?php
add_action('init', 'king_search_data', 99);

function king_search_data(){
    global $kc;
    if( function_exists('kc_add_map') ){
        $kc->add_map(array(
            'kings_search' => array(
                  'name'        => 'Search',
                  'description' => 'Icon Title shortcode of the theme.',
                  'icon'        => 'kc-icon-button',
                  'category'    => 'Crowdfunding',
                  'css_box'     => true,
                  'params'      => array(
                                      array(
                                              'name'          => 'title',
                                              'type'          => 'text',
                                              'label'         => 'Title',
                                              'description'   => 'Put here Title.',
                                              'admin_label'   => true,
                                          ),
                                      array(
                                              'name'          => 'palceholder',
                                              'type'          => 'text',
                                              'label'         => 'Palceholder',
                                              'description'   => 'Put here palceholder.',
                                              'admin_label'   => true,
                                            ),

                                      array(
                                            'name'          => 'color',
                                            'type'          => 'color_picker',
                                            'label'         => 'Color',
                                            'value'         => '#444',
                                            'admin_label'   => true,
                                            
                                        ),
                                        array(
                                            'name'          => 'fontsize',
                                            'type'          => 'number_slider',
                                            'label'         => 'Title Font Size',
                                            'options'       => array(
                                                                'min'       => 0,
                                                                'max'       => 40,
                                                                'unit'      => 'px',
                                                                'show_input'=> true
                                                              ),
                                            'value'         => '20px',
                                            'description'   => 'Chose Font Size here, Default is 20px'
                                        ),
                                        array(
                                            'name'          => 'padding',
                                            'type'          => 'text',
                                            'label'         => 'Padding',
                                            'description'   => 'Padding of the heading eg( 0px 0px 0px 0px )',
                                            'admin_label'   => true,
                                        ),
                                        array(
                                            'name'          => 'margin',
                                            'type'          => 'text',
                                            'label'         => 'Margin',
                                            'description'   => 'Margin of the heading eg( 0px 0px 0px 0px )',
                                            'admin_label'   => true,
                                        ),


                                      )
                                )
                    )
              );
    }
}

// Search Data Shortcode
function king_search_shortcodes($atts, $content = null){

    extract( shortcode_atts( array(
        'title'         => '',
        'palceholder'   => '',
        'margin'        => '',
        'padding'       => '',
        'fontsize'      => '',
        'color'         => '',
    ), $atts ));
    $output = $attribute = $style = '';

    if( $margin ){ $style .= 'margin:'.$margin.';'; }
    if( $padding ){ $style .= 'padding:'.$padding.';'; }
    if( $fontsize ){ $style .= 'font-size:'.$fontsize.';'; }
    if( $color ){ $style .= 'color:'.$color.';'; }
    if( $style ){ $style = 'style="'.$style.'"'; }


    $output .= '<div id="moview_search" class="col-sm-12 moview-search moview_search">';
        $output .= '<h2 class="search-title" '.$style.'>'.$title.'</h2>';
        $output .= '<div class="input-group moview-search-wrap">';
            

            $output .= '<form id="moview-search" action="'.esc_url(home_url("/")).'">';
                $output .= '<div class="search-panel">';
                    $output .= '<div class="select-menu">';
                        $output .= '<select name="searchtype" id="searchtype" class="selectpicker">';
                            $output .= '<option value="all"> '.__('Category','crowdfunding').'</option>';
                            $allcats = get_terms('product_cat');
                            if( is_array($allcats) ){
                                if(!empty($allcats)){
                                    foreach ($allcats as $value) {
                                        $output .= '<option value="'.$value->slug.'"> '.$value->name.'</option>';
                                    }
                                }
                            }
                        $output .= '</select>';
                    $output .= '</div>';
                $output .= '</div>';
                $output .= '<div class="input-box">';
                    $output .= '<input type="text" id="searchword" name="s" class="moview-search-input form-control" value="" placeholder="'.$palceholder.'" autocomplete="off" data-url="">';
                    $output .= '<div class="moview-search-results"></div>';
                $output .= '</div>';
                $output .= '<span class="search-icon">';
                    $output .= '<button type="submit" class="moview-search-submit">';
                        $output .= '<span class="moview-search-icons"> ';
                            $output .= '<i class="fa fa-search"></i>';
                        $output .= '</span>';
                    $output .= '</button>';
                $output .= '</span>';
            $output .= '</form>';
            

        $output .= '</div>';
    $output .= '</div>';


    return $output;
  }
add_shortcode('kings_search', 'king_search_shortcodes');
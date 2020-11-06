<?php
add_action('init', 'king_recent_blog_data', 99);

function king_recent_blog_data(){
    global $kc;
    if( function_exists('kc_add_map') ){
        $kc->add_map(array(
            'kings_recent_blog' => array(
                  'name'          => 'Recent Blog',
                  'description'   => __('Title shortcode of the theme.', 'KingComposer') ,
                  'icon'          => 'kc-icon-box',
                  'category'      => 'Crowdfunding',
                  'css_box'       => true,
                  'params'        => array(
                                        array(
                                            'name'        => 'number',
                                            'label'       => 'Title Font Size',
                                            'type'        => 'number_slider',
                                            'options'     => array(
                                                              'min'         => 0,
                                                              'max'         => 20,
                                                              'unit'        => '',
                                                              'show_input'  => true
                                                          ),
                                            'value'       => '3',
                                            'description' => 'Chose Title Font Size here, Default is 20px'
                                        ),
                                ),
                )
        ));
    }
}
// Register Hover Shortcode
function king_recent_blog_data_shortcodes($atts, $content = null){

  extract( shortcode_atts( array(
        'number'           => '3',
    ), $atts ));
    $output = '';
    
    $args = array(
                  'post_type'       => 'post',
                  'posts_per_page'  => $number
                );
    $thequery = new WP_Query($args);

    if ( $thequery->have_posts() ) :
        while ( $thequery->have_posts() ) : $thequery->the_post();

            $output .= '<div class="ideas-item col-md-4">';
               $output .= '<div class="image">';
                  $output .= '<a href="'.get_permalink().'">';
                     $output .= '<figure>';
                     if ( has_post_thumbnail() && ! post_password_required() ){
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $thequery->ID ), 'full' );
                        $output .= '<img src="'.$image[0].'" class="img-responsive">';
                    }$output .= '<i class="fa fa-location-arrow"></i></figure>';
                  $output .= '</a>';
                $output .= '</div>';
                $output .= '<div class="details">';
                    $output .= '<div class="grid-post-date">'.get_the_date("d F Y").'</div>';
                    $output .= '<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
                    $output .= '<div class="grid-post-meta">';
                        $output .= '<div class="grid-author"><span>#</span>'.get_the_author_posts_link().'</div>';
                        $output .= '<div class="grid-comments-number"><i class="fa fa-twitch"></i> '.get_comments_number().'</div>';
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
            
        endwhile;
    endif;
    wp_reset_postdata();

    return $output;
  }
add_shortcode('kings_recent_blog', 'king_recent_blog_data_shortcodes');
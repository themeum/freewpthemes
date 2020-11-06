<?php 
/* ******************************************************************* */
/* ************************* Shortcode ******************************* */
/* ******************************************************************* */

// Section Shortcode
// [wpneo_section bgcolor="#fff" bgimage="" padding="30px 0px 30px" class=""]Content[/wpneo_section]
function wpneo_section_data( $atts , $content = null ) {
    extract( shortcode_atts( array(
        'bgcolor'           => '#fff',
        'bgimage'           => '',
        'padding'           => '30px 0px 30px',
        'class'             => ''
    ), $atts ));
    $output = $style = $cl ='';

    if( $bgimage ){
        $img = wp_get_attachment_image_src( $bgimage , 'full' );
        $style = 'background: url('.$img[0].') no-repeat; background-size: cover; padding:'.$padding.';'; 
    }else{
        $style = 'background-color:'.$bgcolor.'; background-size: cover; padding:'.$padding.';'; 
    }

    if( $class ){
        $cl = 'class="'.$class.'"';
    }

    $output .= '<section '.$cl.' style="'.$style.'">';
                $output .= do_shortcode($content);
    $output .= '</section>';

    return $output;
}
add_shortcode( 'wpneo_section', 'wpneo_section_data' );


// Container Shortcode
// [wpneo_container bgcolor="#fff" bgimage="" padding="30px 0px 30px" class=""]Content[/wpneo_container]
function wpneo_container_data( $atts , $content = null ) {
    extract( shortcode_atts( array(
        'bgcolor'           => '#fff',
        'bgimage'           => '',
        'padding'           => '30px 0px 30px',
        'class'             => ''
    ), $atts ));
    $output = $style = $cl ='';

    if( $bgimage ){
        $img = wp_get_attachment_image_src( $bgimage , 'full' );
        $style = 'background: url('.$img[0].') no-repeat; background-size: cover; padding:'.$padding.';'; 
    }else{
        $style = 'background-color:'.$bgcolor.'; background-size: cover; padding:'.$padding.';'; 
    }

    if( $class ){
        $cl = 'class="'.$class.'"';
    }

    $output .= '<section '.$cl.' style="'.$style.'">';
        $output .= '<div class="container">';
                $output .= do_shortcode($content);
        $output .= '</div>';
    $output .= '</section>';

    return $output;
}
add_shortcode( 'wpneo_container', 'wpneo_container_data' );


// Row Shortcode
// [wpneo_row]Content[/wpneo_row]
function wpneo_row_data( $atts , $content = null ) {
    $output = '';
    $output .= '<div class="row">';
            $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode( 'wpneo_row', 'wpneo_row_data' );


// Column Shortcode
// [wpneo_col col="col-md-6 col-xs-12" class=""]Content[/wpneo_col]
function wpneo_col_data( $atts , $content = null ) {
    extract( shortcode_atts( array(
        'col' => 'col-md-6',
        'class' => '',
    ), $atts ));
    $output = '';
    if( $class ){ $col = $col.' '.$class; }
    $output .= '<div class="'.$col.'">';
            $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode( 'wpneo_col', 'wpneo_col_data' );


// Sub Head Shortcode
// [sub_head title="" sub_title=""]Content[/sub_head]
function wpneo_sub_head_data( $atts , $content = null ) {
    extract( shortcode_atts( array(
        'title'             => '',
        'sub_title'          => '',
    ), $atts ));
    $output = '';

    $output .= '<div class="feature-content">';
        if( $title ){ $output .= '<h2>'.$title.'</h2>'; }
        $output .= '<div class="sub-head">'.$sub_title.'</div>';
        $output .= '<p>'.$content.'</p>';
    $output .= '</div>';

    return $output;
}
add_shortcode( 'sub_head', 'wpneo_sub_head_data' );


// Image Shortcode
// [wpneo_image image="12" type="full" name="alt name" link="" class=""][/wpneo_image]
function wpneo_image_data( $atts , $content = null ) {
    extract( shortcode_atts( array(
        'name'         => '',
        'image'        => '',
        'type'         => 'full',
        'link'         => '',
        'class'        => '',
    ), $atts ));
    $output = $var = $var2 = '';

    if( $class ){
        $var = 'class="'.$class.'"';
    }

    if( $image ){
        $img = wp_get_attachment_image_src( $image , $type );
        if( $link ){ $output .= '<a '.$var.' href="'.$link.'">'; }
        $output .= '<img class="img-responsive" alt="'.$name.'" src="'.$img[0].'">';
        if( $link ){ $output .= '</a>'; }
    }
    return $output;
}
add_shortcode( 'wpneo_image', 'wpneo_image_data' );



// Sponsor Shortcode
// [wpneo_title title_color="#000" sub_title="" sub_title_color="#4f585f" text_align="center"]Content[/wpneo_title]
function wpneo_title_data( $atts , $content = null ) {
    extract( shortcode_atts( array(
        'title_color'       => '#000',
        'sub_title'         => '',
        'sub_title_color'   => '#4f585f',
        'text_align'        => 'center',
    ), $atts ));
    $output = $align = '';

    if( $text_align ){ 
        if( $text_align == 'left' ){ $align = 'text-left'; }
        if( $text_align == 'right' ){ $align = 'text-right'; }
        if( $text_align == 'center' ){ $align = 'text-center'; }
    }else{
        $align = 'text-center';
    }

    $output .= '<div class="section-title '.$align.'">';
        $output .= '<h2 style="color:'.$title_color.'" class="title wow animated fadeIn animated" data-wow-delay="300ms" data-wow-duration="600ms">'.$content.'</h2>';
        $output .= '<p style="color:'.$sub_title_color.'" class="subtitle wow animated fadeIn animated" data-wow-delay="350ms" data-wow-duration="600ms">'.$sub_title.'</p>';
    $output .= '</div>';

    return $output;
}
add_shortcode( 'wpneo_title', 'wpneo_title_data' );


// Box Feature Shortcode
// [wpneo_box_feature icon_class="fa-university" title="" title_link=""]Content[/wpneo_box_feature]
function wpneo_box_feature_data( $atts , $content = null ) {
    extract( shortcode_atts( array(
        'icon_class'        => 'fa-university',
        'title'             => '',
        'title_link'        => '#',
    ), $atts ));
    $output = '';

    $output .= '<div class="box-feature-content">';
        $output .= '<i class="fa '.$icon_class.'"></i>';
        if( $title ){ 
            $output .= '<h4>';
            if( $title_link ){ $output .= '<a href="'.$title_link.'">'; }
            $output .= $title;
            if( $title_link ){ $output .= '</a>'; }
            $output .= '</h4>'; 
        }
        $output .= '<p>'.$content.'</p>';
    $output .= '</div>';

    return $output;
}
add_shortcode( 'wpneo_box_feature', 'wpneo_box_feature_data' );


// Feature Shortcode
// [wpneo_feature top_text="" top_text_color="#fff" title="" title_link=""]Content[/wpneo_feature]
function wpneo_feature_data( $atts , $content = null ) {
    extract( shortcode_atts( array(
        'top_text'          => '',
        'top_text_color'    => '#fff',
        'title'             => '',
        'title_link'        => '#',
    ), $atts ));
    $output = $var = '';

    $output .= '<div class="feature-content count-down">';
        if(is_numeric($top_text)){
            $var = 'counter';
        }
        $output .= '<div class="top-title '.$var.'" style="color:'.$top_text_color.'">'.$top_text.'</div>';
        if( $title ){
            $output .= '<h4>';
            if( $title_link ){ $output .= '<a href="'.$title_link.'">'; }
            $output .= $title;
            if( $title_link ){ $output .= '</a>'; }
            $output .= '</h4>'; 
        }
        $output .= '<p>'.$content.'</p>';
    $output .= '</div>';

    return $output;
}
add_shortcode( 'wpneo_feature', 'wpneo_feature_data' );




// Person Shortcode
// [wpneo_person images="12" name="Anik Biswas" designation="Web Application Developer"][/wpneo_person]
function wpneo_person_data( $atts , $content = null ) {
    extract( shortcode_atts( array(
        'images'        => '',
        'name'          => '',
        'designation'   => '',
    ), $atts ));
    $output = '';

    $output .= '<div class="person">';
        if( $images ){ $output .= '<img class="img-responsive" alt="'.$name.'" src="'.wp_get_attachment_url( $images ).'">'; }
        $output .= '<div class="name-desig text-center">';
            if( $name ){ $output .= '<h4>'.$name.'</h4>'; }
            if( $designation ){ $output .= '<p>'.$designation.'</p>'; }
        $output .= '</div>';
    $output .= '</div>';

    return $output;
}
add_shortcode( 'wpneo_person', 'wpneo_person_data' );



// Recent Blog Shortcode
// [wpneo_recent_blog number="3"][/wpneo_recent_blog]
function wpneo_recent_blog_data( $atts , $content = null ) {
    extract( shortcode_atts( array(
        'number'        => '3',
    ), $atts ));
    $output = '';

    $args = array( 'post_type' => 'post', 'posts_per_page' => $number );
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
add_shortcode( 'wpneo_recent_blog', 'wpneo_recent_blog_data' );



// Slider Shortcode
// [wpneo_slider images="12,12" project_slug=""][/wpneo_slider]
function wpneo_slider_data( $atts , $content = null ) {
    extract( shortcode_atts( array(
        'images'        => '',
        'project_slug'  => ''
    ), $atts ));
    $output = '';

$data = explode( ',', $project_slug );
$image = explode( ',', $images );

$output .= '<div class="products-slider owl-carousel" id="products-slider">';
  foreach ($data as $key => $value) {
    setup_postdata($value);
    $id = get_page_by_path( $value,'OBJECT','product' );

    if( isset( $id->ID ) ){
        if( $id->ID ){
            $id = $id->ID;
            $style = '';

            //$output .= ''.$id;

          if(isset( $image[$key] )){
            $src = wp_get_attachment_image_src( $image[$key], 'full' ); 
            $style = 'style="background: no-repeat center center url('.$src[0].');"';
          }

            $output .= '<div class="product" '.$style.'>';
                $output .= '<div class="container">';
                    $output .= '<div class="row">';
                        $output .= '<div class="col-sm-5">';
                            $output .= '<div class="product-info">';
                                $output .= '<h1 class="title">'.get_the_title( $id ).'</h1>';
                                $post_content = get_post( $id );
                                if(function_exists('crowdfunding_excerpt_max_charlength')){
                                  $output .= '<p class="info">'.crowdfunding_excerpt_max_charlength( $post_content->post_excerpt, 150 ).'</p>';
                                }
                                $output .= '<div class="product-timeline">';
                                    $output .= '<ul>';
                                        $output .= '<li>';
                                          if(function_exists('wpcf_function')){
                                              $output .= '<h3 class="amount">'.wpcf_function()->price( wpcf_function()->total_goal($id) ).'</h3>';
                                            }
                                            $output .= '<p>'.__('Funding Goal','crowdfunding').'</p>';
                                        $output .= '</li>';
                                        $output .= '<li>';
                                          if(function_exists('wpcf_function')){
                                            $output .= '<h3 class="amount">'.wpcf_function()->price( wpcf_function()->fund_raised($id) ).'</h3>';
                                          }
                                            $output .= '<p>'.__('Fund Raised','crowdfunding').'</p>';
                                        $output .= '</li>';
                                        $output .= '<li>';

                                            $days_remaining = '';
                                            if( function_exists('wpcf_function') ){
                                              $days_remaining = apply_filters('date_expired_msg', __('Date expired', 'crowdfunding'));
                                              if (wpcf_function()->dateRemaining($id)){
                                                  $days_remaining = apply_filters('date_remaining_msg', __(wpcf_function()->dateRemaining($id), 'crowdfunding'));
                                              }
                                            }

                                            $output .= '<h3 class="amount">'.$days_remaining.'</h3>';
                                            $output .= '<p>'.__('Days to go','crowdfunding').'</p>';
                                        $output .= '</li>';
                                    $output .= '</ul>';
                                $output .= '</div>'; //.product-timeline

                                if(function_exists('wpcf_function')){
                                    $output .= '<div class="wpneo-raised-bar">';
                                        $output .= '<div id="progressbar">';
                                            $output .= '<div style="width:'.wpcf_function()->getFundRaisedPercent($id).'%"></div>';
                                        $output .= '</div>';
                                    $output .= '</div>';
                                }

                                $output .= '<a href="'.get_permalink( $id ).'" class="btn btn-default">'.__('View Project','crowdfunding').'</a>';
                            $output .= '</div>'; //.product-info
                        $output .= '</div>'; //.col-sm-5
                    $output .= '</div>'; //.row
                $output .= '</div>'; //.container
            $output .= '</div>'; //.product
        }
        wp_reset_postdata();
    }
  }
$output .= '</div>'; //products-slider


    return $output;
}
add_shortcode( 'wpneo_slider', 'wpneo_slider_data' );



// Icontext Shortcode
// [icontext icon_class="book" color="#000" font_size="14px"]Content[/icontext]
function wpneo_icontext_data( $atts , $content = null ) {
    extract( shortcode_atts( array(
        'color'       => '#000',
        'font_size'   => '',
        'icon_class'  => '',
    ), $atts ));
    $output = $style = '';

    if( $color ){ $style = 'style="color:'.$color.';"'; }
    if( $font_size ){
        $var = '';
        if( $color ){
            $var = 'color:'.$color.';';
        }
        $style = 'style="font-size:'.$font_size.';'.$var.'"';
    }

    $output .= '<span class="icon-title" '.$style.'>';
    if( $icon_class ){ $output .= '<i class="fa '.$icon_class.'"></i>'; }
    if( $content ){ $output .= ' '.$content; }
    $output .= '</span>';

    return $output;
}
add_shortcode( 'icontext', 'wpneo_icontext_data' );




// Icontext Shortcode
// [google_map latitude="43.04446" longitude="-76.130791" minimum_height="200px" map_color="#4bb463" address=""]Content[/google_map]
function wpneo_google_map_data( $atts , $content = null ) {
    extract( shortcode_atts( array(
            'latitude'          => '43.04446',
            'longitude'         => '-76.130791',
            'minimum_height'    => '300px',
            'map_color'         => '#4bb463',
            'address'           => ''
    ), $atts ));
    $output = $style = '';

    $address = preg_replace( '#^<\/p>|<p>$#', '', $address );
    $output .= '<div class="hidden" id="wplatitude">'.esc_attr($latitude).'</div>
                <div class="hidden" id="wplongitude">'.esc_attr($longitude).'</div>
                <div class="hidden" id="wpaddress">'.balanceTags($address).'</div>
                <div class="hidden" id="wpmap_color">'.esc_attr($map_color).'</div>';

    $output .= '<div id="map">';
        $output .= '<div id="gmap-wrap">';
            $output .= '<div id="gmap" style="height:'.esc_attr($minimum_height).';">'; 
            $output .= '</div>';              
        $output .= '</div>';
    $output .= '</div>';


    return $output;
}
add_shortcode( 'google_map', 'wpneo_google_map_data' );




// Icontext Shortcode
// [wpneo_search title="Search the Product Now" palceholder="Search Project"][/wpneo_search]
function wpneo_search_data( $atts , $content = null ) {
    extract( shortcode_atts( array(
            'title'  => 'Search the Product Now',
            'palceholder'  => 'Search Project',
    ), $atts ));
    $output = '';

    $output .= '<div id="moview_search" class="col-sm-12 moview-search moview_search">';
        $output .= '<h2 class="search-title">'.$title.'</h2>';
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
add_shortcode( 'wpneo_search', 'wpneo_search_data' );



<?php

if(!function_exists('personalblog_theme_setup')):

    function personalblog_theme_setup()
    {
        //Textdomain
        load_theme_textdomain( 'personalblog', get_template_directory() . '/languages' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'personalblog-blog', 700, 410, true ); // Used Top Celebrities
        add_image_size( 'personalblog-thumb', 160, 170, true ); // Used Top Celebrities
        add_image_size( 'personalblog-small', 75, 80, true ); // Used Top Celebrities
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-formats', array( 'aside', 'audio','gallery','image','link','quote','video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );

        if ( ! isset( $content_width ) )
        $content_width = 660;
    }

    add_action('after_setup_theme','personalblog_theme_setup');

endif;

if(!function_exists('personalblog_pagination')):

    function personalblog_pagination( $page_numb , $max_page ){

        $big = 999999999; # need an unlikely integer
        echo '<div class="themeum-pagination">';
        echo paginate_links( array(
            'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'        => '?paged=%#%',
            'current'       => $page_numb,
            'prev_text'     => __('<span class="pagination-pre">'.esc_html__('Previous','personalblog').'</span>'),
            'next_text'     => __('<span class="pagination-next">'.esc_html__('Next','personalblog').'</span>'),
            'total'         => $max_page,
            'type'          => 'list',
        ) );
        echo '</div>';
    }
endif;




/*-------------------------------------------------------
 *              Themeum Comment
 *-------------------------------------------------------*/

if(!function_exists('personalblog_comment')):

    function personalblog_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
            // Display trackbacks differently than normal comments.
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

        <?php
            break;
            default :
            global $post;
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-body media">

                    <div class="comment-avartar pull-left">
                        <?php
                            echo get_avatar( $comment, $args['avatar_size'] );
                        ?>
                    </div>
                    <div class="comment-context media-body">
                        <div class="comment-head">
                            <?php
                                printf( '<span class="comment-author">%1$s</span>',
                                    get_comment_author_link());
                            ?>
                            <span class="comment-date"><?php echo get_comment_date('d / m / Y') ?></span>

                            <?php edit_comment_link( esc_html__( 'Edit', 'personalblog' ), '<span class="edit-link">', '</span>' ); ?>

                        </div>

                        <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'personalblog' ); ?></p>
                        <?php endif; ?>

                        <div class="comment-content">
                            <?php comment_text(); ?>
                        </div>

                        <span class="comment-reply">
                            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'personalblog' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                        </span>
                    </div>

            </div>
        <?php
            break;
        endswitch;
    }

endif;


/*-----------------------------------------------------
 *              Coming Soon Page Settings
 *----------------------------------------------------*/
if ( get_theme_mod( 'comingsoon_en', false ) ) {
    if(!function_exists('personalblog_my_page_template_redirect')):
        function personalblog_my_page_template_redirect()
        {
            if( is_page() || is_home() || is_category() || is_single() )
            {
                if( !is_super_admin( get_current_user_id() ) ){
                    get_template_part( 'coming','soon');
                    exit();
                }
            }
        }
        add_action( 'template_redirect', 'personalblog_my_page_template_redirect' );
    endif;

    if(!function_exists('personalblog_cooming_soon_wp_title')):
        function personalblog_cooming_soon_wp_title(){
            return 'Coming Soon';
        }
        add_filter( 'wp_title', 'personalblog_cooming_soon_wp_title' );
    endif;
}



if(!function_exists('personalblog_css_generator')){
    function personalblog_css_generator(){

        $output = '';

        /* *******************************
        **********      Theme Options   **********
        ********************************** */


            $major_color = get_theme_mod( 'major_color', '#00aeef' );
            if($major_color){
                $output .= 'a,.bottom-widget .contact-info i,.bottom-widget .widget ul li a:hover, .latest-blog-content .latest-post-button:hover,.meta-category a:hover,.common-menu-wrap .nav>li>a:hover,.common-menu-wrap .nav>li.active>a,
                .common-menu-wrap .nav>li.menu-item-has-children.active > a:after,.common-menu-wrap .nav>li.menu-item-has-children > a:hover:after,
                .entry-header .entry-title a:hover,.blog-post-meta li a:hover,.entry-content .wrap-btn-style a.btn-style:hover,
                .widget-blog-posts-section .entry-title  a:hover,.widget ul li a:hover,.footer-copyright ul li a:hover, .themeum-pagination ul li:first-child a:hover, .themeum-pagination ul li:last-child a:hover, .single-related-posts .common-post-item-intro a:hover{ color: '. esc_attr($major_color) .'; }';
            }

            if($major_color){
                $output .= '.bg-contact input[type=text]:focus,input:focus, textarea:focus, keygen:focus, select:focus{ border-color: '. esc_attr($major_color) .'; }';
            }
            if($major_color){
                $output .= '.style-title,.comments-title,.comment-reply-title{ border-left :  4px solid '. esc_attr($major_color) .'; }';
            }

            if($major_color){
                $output .= '.themeum-latest-post-content .entry-title a:hover,.common-menu-wrap .nav>li.current>a,
                .header-solid .common-menu-wrap .nav>li.current>a,.portfolio-filter .btn-link.active,.portfolio-filter li a:hover,.latest-review-single-layout2 .latest-post-title a:hover, .blog-arrows a:hover{ color: '. esc_attr($major_color) .'; }';
            }

            if($major_color){
                $output .= '.team-content4,.portfolio-filter li a:before, .classic-slider .owl-dots .active>span, .widget .tagcloud a:hover, .themeum-pagination li span.page-numbers:hover, .themeum-pagination li a.page-numbers:hover,.themeum-pagination li span.page-numbers.current{ background: '. esc_attr($major_color) .'; }';
            }


            if($major_color){
                $output .= '.themeum-pagination li span.page-numbers.current{border-color: '. esc_attr($major_color) .'; }';
            }

            // .select2-container .select2-dropdown .select2-results ul li


            $hover_color = get_theme_mod( 'hover_color', '#0088e2' );
            if( $hover_color ){
                $output .= 'a:hover, .post-content-wrapper-controller:hover, .post-content-wrapper-controller .fa.pull-left:hover, .post-content-wrapper-controller .fa.pull-right:hover , .widget.widget_rss ul li a,.social-share a:hover{ color: '.esc_attr( $hover_color ) .'; }';
                $output .= '.error-page-inner a.btn.btn-primary.btn-lg:hover,.btn.btn-primary:hover,input[type=button]:hover{ background-color: '.esc_attr( $hover_color ) .'; }';
                $output .= '.woocommerce a.button:hover{ border-color: '.esc_attr( $hover_color ) .'; }';
            }


        /* *******************************
        **********  Quick Style **********
        ********************************** */

        $bstyle = $mstyle = $h1style = $h2style = $h3style = $h4style = $h5style = '';
        //body
        if ( get_theme_mod( 'body_font_size', '18' ) ) {
            $bstyle .= 'font-size:'.get_theme_mod( 'body_font_size', '18' ).'px;';
        }
        if ( get_theme_mod( 'body_google_font', 'Source Sans Pro' ) ) {
            $bstyle .= 'font-family:'.get_theme_mod( 'body_google_font', 'Source Sans Pro' ).';';
        }

        //menu
        $mstyle = '';
        if ( get_theme_mod( 'menu_font_size', '14' ) ) {
            $mstyle .= 'font-size:'.get_theme_mod( 'menu_font_size', '14' ).'px;';
        }
        if ( get_theme_mod( 'menu_google_font', 'Roboto Slab' ) ) {
            $mstyle .= 'font-family:'.get_theme_mod( 'menu_google_font', 'Roboto Slab' ).';';
        }

        //heading1
        $h1style = '';
        if ( get_theme_mod( 'h1_font_size', '42' ) ) {
            $h1style .= 'font-size:'.get_theme_mod( 'h1_font_size', '42' ).'px;';
        }
        if ( get_theme_mod( 'h1_google_font', 'Roboto Slab' ) ) {
            $h1style .= 'font-family:'.get_theme_mod( 'h1_google_font', 'Roboto Slab' ).';';
        }

        # heading2
        $h2style = '';
        if ( get_theme_mod( 'h2_font_size', '32' ) ) {
            $h2style .= 'font-size:'.get_theme_mod( 'h2_font_size', '32' ).'px;';
        }
        if ( get_theme_mod( 'h2_google_font', 'Roboto Slab' ) ) {
            $h2style .= 'font-family:'.get_theme_mod( 'h2_google_font', 'Roboto Slab' ).';';
        }


        //heading3
        $h3style = '';
        if ( get_theme_mod( 'h3_font_size', '28' ) ) {
            $h3style .= 'font-size:'.get_theme_mod( 'h3_font_size', '28' ).'px;';
        }
        if ( get_theme_mod( 'h3_google_font', 'Roboto Slab' ) ) {
            $h3style .= 'font-family:'.get_theme_mod( 'h3_google_font', 'Roboto Slab' ).';';
        }

        //heading4
        $h4style = '';
        if ( get_theme_mod( 'h4_font_size', '22' ) ) {
            $h4style .= 'font-size:'.get_theme_mod( 'h4_font_size', '22' ).'px;';
        }
        if ( get_theme_mod( 'h4_google_font', 'Roboto Slab' ) ) {
            $h4style .= 'font-family:'.get_theme_mod( 'h4_google_font', 'Roboto Slab' ).';';
        }

        //heading5
        $h5style = '';
        if ( get_theme_mod( 'h5_font_size', '18' ) ) {
            $h5style .= 'font-size:'.get_theme_mod( 'h5_font_size', '18' ).'px;';
        }
        if ( get_theme_mod( 'h5_google_font', 'Roboto Slab' ) ) {
            $h5style .= 'font-family:'.get_theme_mod( 'h5_google_font', 'Roboto Slab' ).';';
        }


        $output .= 'body{'.$bstyle.'}';
        $output .= '.common-menu-wrap .nav>li>a{'.$mstyle.'}';
        $output .= 'h1{'.$h1style.'}';
        $output .= 'h2{'.$h2style.'}';
        $output .= 'h3{'.$h3style.'}';
        $output .= 'h4{'.$h4style.'}';
        $output .= 'h5{'.$h5style.'}';

        $output .= 'body{ background-color: '.esc_attr( get_theme_mod( 'body_bg_color', '#fff' ) ) .'; }';


        // Button color setting...

        $output .= '.mc4wp-form-fields input[type=submit], .demo-four .mc4wp-form-fields input[type=submit], .common-menu-wrap .nav>li.online-booking-button a, .error-page-inner a.btn.btn-primary.btn-lg,.btn.btn-primary, .package-list-button, 
        .contact-submit input[type=submit],.form-submit input[type=submit]{ background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#32aad6' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#32aad6' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_text_color', '#fff' ) ) .' !important; border-radius: 4px; }';
        

        if ( get_theme_mod( 'button_hover_bg_color', '#00aeef' ) ) {
            $output .= '.mc4wp-form-fields input[type=submit]:hover, .demo-four .mc4wp-form-fields input[type=submit]:hover, .common-menu-wrap .nav>li.online-booking-button a:hover, .error-page-inner a.btn.btn-primary.btn-lg:hover,.btn.btn-primary:hover, .package-list-button:hover, .contact-submit input[type=submit]:hover,.form-submit input[type=submit]:hover{ background-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#00aeef' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#00aeef' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_hover_text_color', '#fff' ) ) .' !important; }';
        }


        $output .= '.subtitle-cover:before{background:'.get_theme_mod( 'sub_header_overlayer_color', 'rgba(0, 0, 0, 0.5)' ).';}';

        $output .= '.subtitle-cover{padding:100px 0; margin-bottom: 100px;}';

        $output .= "body.error404,body.page-template-404{
            width: 100%;
            height: 100%;
            min-height: 100%;
        }";

        return $output;
    }
}


/*-----------------------------------------------------
 *              Author Info
 *----------------------------------------------------*/

function personalblog_modify_user_contact_profile($profile_fields) {

    # Add new fields
    $profile_fields['facebook']     = 'Facebook URL';
    $profile_fields['twitter']      = 'Twitter URL';
    $profile_fields['gplus']        = 'Google+ URL';
    $profile_fields['linkedin']     = 'Linkedin URL';
    $profile_fields['tumblr']       = 'Tumblr URL';
    $profile_fields['pinterest']    = 'Pinterest URL';
    $profile_fields['instagram']    = 'Instagram URL';

    return $profile_fields;
}
add_filter('user_contactmethods', 'personalblog_modify_user_contact_profile');
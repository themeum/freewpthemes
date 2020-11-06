<?php

/*-------------------------------------------------------
*              Themeum Supports and Image Cut
*-------------------------------------------------------*/
if(!function_exists('newskit_setup')):

    function newskit_setup(){
        load_theme_textdomain( 'newskit', get_template_directory() . '/languages' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'newskit-large', 1140, 570, true );
        add_image_size( 'newskit-gallery', 640, 400, true );
        add_image_size( 'newskit-blog', 600, 630, true );
        add_image_size( 'newskit-slider', 442, 390, true );
        add_image_size( 'newskit-latest-post', 594, 340, true ); # Latest Post
        add_image_size( 'newskit-img-wrap', 256, 326, true ); 
        add_image_size( 'newskit-feed', 240, 240, true ); # News Feed
        add_theme_support( 'post-formats', array( 'audio','gallery','image','link','quote','video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );
    }
    add_action('after_setup_theme', 'newskit_setup');

endif;

/*-------------------------------------------------------
*              Themeum Pagination
*-------------------------------------------------------*/
if(!function_exists('newskit_pagination')):

    function newskit_pagination( $page_numb , $max_page ){
        $big = 999999999;
        echo '<div class="themeum-pagination">';
        echo paginate_links( array(
            'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'        => '?paged=%#%',
            'current'       => $page_numb,
            'prev_text'     => __('<i class="fa fa-angle-left" aria-hidden="true"></i> Previous','newskit'),
            'next_text'     => __('Next <i class="fa fa-angle-right" aria-hidden="true"></i>','newskit'),
            'total'         => $max_page,
            'type'          => 'list',
        ) );
        echo '</div>';
    }

endif;

/*-------------------------------------------------------
*              Social Share
*-------------------------------------------------------*/
if(!function_exists('themeum_social_share_cat')):
    
    function themeum_social_share_cat( $post_id ){
        global $themeum_options;
        $output ='';
        $media_url = '';
        $title = get_the_title( $post_id );
        $permalink = get_permalink( $post_id );

        if( has_post_thumbnail( $post_id ) ){
            $thumb_src =  wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' ); 
            $media_url = $thumb_src[0];
        }

        $output .= '<div class="newskit-post-share-social">';
            $output .= '<div class="share-icon"><span class="icon-big"><i class="fa fa-share-square-o"></i></span>';
            if(get_theme_mod( 'blog_share_fb', true )){
            $output .= '<a href="#" data-type="facebook" data-url="'.esc_url( $permalink ).'" data-title="'.esc_html( $title ).'" data-description="'. esc_html( $title ).'" data-media="'.esc_url( $media_url ).'" class="prettySocial fa fa-facebook"></a>';
             }
             if(get_theme_mod( 'blog_share_tw', true )){
            $output .= '<a href="#" data-type="twitter" data-url="'.esc_url( $permalink ).'" data-description="'.esc_html( $title ).'" data-via="'.$themeum_options['twitter-username'].'" class="prettySocial fa fa-twitter"></a>';
            }
            if(get_theme_mod( 'blog_share_gp', true )){
            $output .= '<a href="#" data-type="googleplus" data-url="'.esc_url( $permalink ).'" data-description="'.esc_html( $title ).'" class="prettySocial fa fa-google-plus"></a>';
            }
            if(get_theme_mod( 'blog_share_pn', false )){
            $output .= '<a href="#" data-type="pinterest" data-url="'.esc_url( $permalink ).'" data-description="'.esc_html( $title ).'" class="prettySocial fa fa-pinterest"></a>';
            }

            if(get_theme_mod( 'blog_share_ln', false )){
            $output .= '<a href="#" data-type="linkedin" data-url="'.esc_url( $permalink ).'" data-description="'.esc_html( $title ).'" class="prettySocial fa fa-linkedin"></a>';
            }
        
        $output .= '</div>';
        
        $output .= '</div>';

        return $output;
    }

endif;


/*-------------------------------------------------------
*              Themeum Comment
*-------------------------------------------------------*/
if(!function_exists('newskit_comment')):

    function newskit_comment($comment, $args, $depth){
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <?php
            break;
            default :
            global $post;
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-body">
                <div class="comment-avartar pull-left">
                    <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
                </div>
                <div class="comment-context">
                    <div class="comment-head">
                        <?php echo '<span class="comment-author">' . get_the_author() . '</span>'; ?>
                        <span class="comment-date"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_comment_date() ?></span>
                        <?php edit_comment_link( esc_html__( 'Edit', 'newskit' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'newskit' ); ?></p>
                    <?php endif; ?>
                    <span class="comment-reply">
                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="fa fa-reply" aria-hidden="true"></i> '.esc_html__( 'Reply', 'newskit' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </span>
                </div>
                <div class="comment-content">
                    <?php comment_text(); ?>
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
    if(!function_exists('newskit_my_page_template_redirect')):
        function newskit_my_page_template_redirect()
        {
            if( is_page() || is_home() || is_category() || is_single() )
            {
                if( !is_super_admin( get_current_user_id() ) ){
                    get_template_part( 'coming','soon');
                    exit();
                }
            }
        }
        add_action( 'template_redirect', 'newskit_my_page_template_redirect' );
    endif;

    if(!function_exists('newskit_cooming_soon_wp_title')):
        function newskit_cooming_soon_wp_title(){
            return 'Coming Soon';
        }
        add_filter( 'wp_title', 'newskit_cooming_soon_wp_title' );
    endif;
}

/*-----------------------------------------------------
 *              CSS Generator
 *----------------------------------------------------*/
if(!function_exists('newskit_css_generator')){
    function newskit_css_generator(){

        $output = '';

        $preset = get_theme_mod( 'preset', '1' );
        if( $preset ){

            if( get_theme_mod( 'custom_preset_en', true ) ) {

                // CSS Color
                $major_color = get_theme_mod( 'major_color', '#ef3f48' );

                if($major_color){
                    $output .= '
                    a,
                    .bottom-widget .widget ul li a:hover,
                    .thm-default-postbox h2 a:hover,
                    .widget ul li a:hover,
                    .entry-header h2.entry-title.blog-entry-title a:hover,
                    .entry-summary .wrap-btn-style a.btn-style:hover,
                    .main-menu-wrap .navbar-toggle:hover,
                    .newskit-post .blog-post-meta li a:hover,
                    .newskit-post .content-item-title a:hover,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li:hover>a,
                    #mobile-menu ul li.active>a,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li.active>a,
                    #mobile-menu ul li a:hover,
                    .btn.btn-border-newskit,
                    .entry-summary .wrap-btn-style a.btn-style,
                    .social-share-wrap ul li a:hover,
                    .mc4wp-form-fields p i,
                    .category-feature-post .common-post-item-intro .entry-title a:hover,
                    .overlay-btn,
                    .newskit-post-share-social .share-icon .icon-big,
                    .newskit-blog-content h2 a:hover,
                    .newskit-post .content-item-title a:hover,
                    .newskit-widgets a:hover,.elementor-accordion-title.active .elementor-accordion-icon i,
                    .header-solid .common-menu-wrap .nav>li.active>a:after,
                    .theme-color,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li.current-menu-item a,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li>a:hover,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-parent>a,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-item>a,
                    .main-menu-wrap .navbar-toggle,
                    .thm-heading-wrap .total-content h2 a:hover,
                    .article-details .article-title a:hover,
                    .common-menu-wrap .nav>li.current-menu-item a,
                    .header-borderimage .common-menu-wrap .nav>li.active>a,
                    .site-header .common-menu-wrap .nav>li .sub-menu li a:hover,
                    .common-post-item-intro h4.entry-title a:hover,
                    .widget.widget_themeum_about_widget .themeum-about-info li span.themeum-widget-address,
                    .btn.btn-newskit:hover,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li a:hover
                    { color: '. esc_attr($major_color) .'; }';
                }

                //Css Color Important
                if($major_color){
                    $output .= '.social-share a:hover, .login-link a:hover,
                    .header-borderimage .common-menu-wrap .nav>li.menu-item-has-children:after,
                    .common-menu-wrap .nav>li>a:hover,
                    .common-menu-wrap .nav>li>a:focus,
                    .common-menu-wrap .nav>li.current_page_item a,
                    .site-header .common-menu-wrap .nav>li.current_page_parent a,
                    .widget.widget_themeum_about_widget .themeum-about-info li span.themeum-widget-address,
                    .widget.widget_themeum_social_share_widget .themeum-social-share li a:hover
                    {color: '.$major_color.' !important}';
                }

                // CSS Background Color
                if($major_color){
                    $output .= '
                    .entry-link-post-format, .entry-quote-post-format,
                    .newskit-widgets .meta-category a,
                    .btn-read-more,
                    .newsletter_contact_modal .btn-newsletter,
                    .newskit-post .blog-post-meta .meta-category a,
                    .wpmm_mobile_menu_btn,
                    .thm-search-icon span.search-close::before,
                    .coming-soon-contact-head::before,
                    .newsletter_contact_modal button.btn:active,
                    #comments input[type=submit],
                    .themeum-pagination .page-numbers li span.current,
                    .themeum-pagination .page-numbers li a:hover,
                    .wpmm-mobile-menu a.wpmm_mobile_menu_btn:hover,
                    .newskit-post-share-social .share-icon .icon-big:hover,
                    .classic-slider .owl-dots .active>span,
                    .newskit-blog-content .meta-category a,
                    .thm-default-postbox ul li.meta-category a,
                    .post-meta-info-list-in a:hover,
                    .widget .tagcloud a:hover,
                    .thm-slide-control li.slick-active button,
                    .btn.btn-newskit,
                    .modal .modal-content .modal-body input[type="submit"],
                    .modal .modal-content .modal-body input[type="submit"]:hover,
                    .thm-default-postbox .thm-post-bg,
                    .thm-post-top .meta-category a:hover,
                    .newskit-post .blog-post-meta .meta-category a:hover,
                    .newskit-quote,
                    #sidebar h3.widget_title::before,
                    .featured-wrap-link .entry-link-post-format,
                    .featured-wrap-quite .entry-quote-post-format
                    { background: '. esc_attr($major_color) .'; }';
                }
              
                // CSS Border
                if($major_color){
                    $output .= '
                    input:focus,
                    textarea:focus,
                    keygen:focus,
                    select:focus,
                    .modal .modal-content .modal-body input[type="submit"],
                    .comments-area textarea:focus,
                    .common-menu-wrap .nav>li.current>a,
                    .header-solid .common-menu-wrap .nav>li.current>a,
                    .blog-arrows a:hover,
                    .wpcf7-submit,
                    .themeum-pagination .page-numbers li a:hover,
                    .themeum-pagination .page-numbers li span.current,
                    .wpcf7-form input:focus,
                    .thm-post-top .meta-category a:hover,
                    .thm-fullscreen-search form input[type="text"],
                    .btn.btn-newskit
                    { border-color: '. esc_attr($major_color) .'; }';
                }


            }

            // Custom Color
            if( get_theme_mod( 'custom_preset_en', true ) ) {
                $hover_color = get_theme_mod( 'hover_color', '#ef3f48' );
                if( $hover_color ){
                    $output .= 'a:hover,
                    .bottom-widget .widget ul li a:hover,
                    .thm-default-postbox h2 a:hover,
                    .widget ul li a:hover,
                    .entry-header h2.entry-title.blog-entry-title a:hover,
                    .entry-summary .wrap-btn-style a.btn-style:hover,
                    .main-menu-wrap .navbar-toggle:hover,
                    .newskit-post .blog-post-meta li a:hover,
                    .newskit-post .content-item-title a:hover,
                    #mobile-menu ul li a:hover,
                    .social-share-wrap ul li a:hover,
                    .category-feature-post .common-post-item-intro .entry-title a:hover,
                    .newskit-blog-content h2 a:hover,
                    .newskit-post .content-item-title a:hover,
                    .thm-heading-wrap .total-content h2 a:hover,
                    .article-details .article-title a:hover,
                    .site-header .common-menu-wrap .nav>li .sub-menu li a:hover,
                    .common-post-item-intro h4.entry-title a:hover,
                    .widget.widget_themeum_about_widget .themeum-about-info li span.themeum-widget-address,
                    .btn.btn-newskit:hover,
                    .widget.widget_rss ul li a,
                    .thm-heading-wrap h2 a:hover,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li>a:hover,
                    .thm-slider-wrap .total-content h2 a:hover,
                    .footer-copyright a:hover,
                    .entry-summary .wrap-btn-style a.btn-style:hover{ color: '.esc_attr( $hover_color ) .'; }';

                    $output .= '.error-page-inner a.btn.btn-primary.btn-lg:hover,
                    .btn.btn-primary:hover,
                    input[type=button]:hover,
                    .widget.widget_search #searchform .btn-search:hover,
                     .order-view .label-info:hover{ background-color: '.esc_attr( $hover_color ) .'; }';

                    $output .= '.woocommerce a.button:hover{ border-color: '.esc_attr( $hover_color ) .'; }';
                }
            }
        }

        $bstyle = $mstyle = $h1style = $h2style = $h3style = $h4style = $h5style = '';
        //body
        if ( get_theme_mod( 'body_font_size', '14' ) ) { $bstyle .= 'font-size:'.get_theme_mod( 'body_font_size', '14' ).'px;'; }
        if ( get_theme_mod( 'body_google_font', 'Poppins' ) ) { $bstyle .= 'font-family:'.get_theme_mod( 'body_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'body_font_weight', '400' ) ) { $bstyle .= 'font-weight: '.get_theme_mod( 'body_font_weight', '400' ).';'; }
        if ( get_theme_mod('body_font_height', '24') ) { $bstyle .= 'line-height: '.get_theme_mod('body_font_height', '24').'px;'; }
        if ( get_theme_mod('body_font_color', '#707070') ) { $bstyle .= 'color: '.get_theme_mod('', '#707070').';'; }

        //menu
        $mstyle = '';
        if ( get_theme_mod( 'menu_font_size', '16' ) ) { $mstyle .= 'font-size:'.get_theme_mod( 'menu_font_size', '16' ).'px;'; }
        if ( get_theme_mod( 'menu_google_font', 'Poppins' ) ) { $mstyle .= 'font-family:'.get_theme_mod( 'menu_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'menu_font_weight', '300' ) ) { $mstyle .= 'font-weight: '.get_theme_mod( 'menu_font_weight', '300' ).';'; }
        if ( get_theme_mod('menu_font_height', '54') ) { $mstyle .= 'line-height: '.get_theme_mod('menu_font_height', '34').'px;'; }

        //heading1
        $h1style = '';
        if ( get_theme_mod( 'h1_font_size', '42' ) ) { $h1style .= 'font-size:'.get_theme_mod( 'h1_font_size', '42' ).'px;'; }
        if ( get_theme_mod( 'h1_google_font', 'Poppins' ) ) { $h1style .= 'font-family:'.get_theme_mod( 'h1_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'h1_font_weight', '400' ) ) { $h1style .= 'font-weight: '.get_theme_mod( 'h1_font_weight', '700' ).';'; }
        if ( get_theme_mod('h1_font_height', '42') ) { $h1style .= 'line-height: '.get_theme_mod('h1_font_height', '42').'px;'; }
        if ( get_theme_mod('h1_font_color', '#333') ) { $h1style .= 'color: '.get_theme_mod('h1_font_color', '#333').';'; }

        # heading2
        $h2style = '';
        if ( get_theme_mod( 'h2_font_size', '36' ) ) { $h2style .= 'font-size:'.get_theme_mod( 'h2_font_size', '36' ).'px;'; }
        if ( get_theme_mod( 'h2_google_font', 'Poppins' ) ) { $h2style .= 'font-family:'.get_theme_mod( 'h2_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'h2_font_weight', '400' ) ) { $h2style .= 'font-weight: '.get_theme_mod( 'h2_font_weight', '600' ).';'; }
        if ( get_theme_mod('h2_font_height', '36') ) { $h2style .= 'line-height: '.get_theme_mod('h2_font_height', '36').'px;'; }
        if ( get_theme_mod('h2_font_color', '#222538') ) { $h2style .= 'color: '.get_theme_mod('h2_font_color', '#222538').';'; }

        //heading3
        $h3style = '';
        if ( get_theme_mod( 'h3_font_size', '26' ) ) { $h3style .= 'font-size:'.get_theme_mod( 'h3_font_size', '26' ).'px;'; }
        if ( get_theme_mod( 'h3_google_font', 'Poppins' ) ) { $h3style .= 'font-family:'.get_theme_mod( 'h3_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'h3_font_weight', '400' ) ) { $h3style .= 'font-weight: '.get_theme_mod( 'h3_font_weight', '600' ).';'; }
        if ( get_theme_mod('h3_font_height', '28') ) { $h3style .= 'line-height: '.get_theme_mod('h3_font_height', '28').'px;'; }
        if ( get_theme_mod('h3_font_color', '#222538') ) { $h3style .= 'color: '.get_theme_mod('h3_font_color', '#222538').';'; }

        //heading4
        $h4style = '';
        if ( get_theme_mod( 'h4_font_size', '18' ) ) { $h4style .= 'font-size:'.get_theme_mod( 'h4_font_size', '18' ).'px;'; }
        if ( get_theme_mod( 'h4_google_font', 'Poppins' ) ) { $h4style .= 'font-family:'.get_theme_mod( 'h4_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'h4_font_weight', '400' ) ) { $h4style .= 'font-weight: '.get_theme_mod( 'h4_font_weight', '600' ).';'; }
        if ( get_theme_mod('h4_font_height', '26') ) { $h4style .= 'line-height: '.get_theme_mod('h4_font_height', '26').'px;'; }
        if ( get_theme_mod('h4_font_color', '#222538') ) { $h4style .= 'color: '.get_theme_mod('h4_font_color', '#222538').';'; }

        //heading5
        $h5style = '';
        if ( get_theme_mod( 'h5_font_size', '14' ) ) { $h5style .= 'font-size:'.get_theme_mod( 'h5_font_size', '14' ).'px;'; }
        if ( get_theme_mod( 'h5_google_font', 'Poppins' ) ) { $h5style .= 'font-family:'.get_theme_mod( 'h5_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'h5_font_weight', '400' ) ) { $h5style .= 'font-weight: '.get_theme_mod( 'h5_font_weight', '600' ).';'; }
        if ( get_theme_mod('h5_font_height', '26') ) { $h5style .= 'line-height: '.get_theme_mod('h5_font_height', '26').'px;'; }
        if ( get_theme_mod('h5_font_color', '#222538') ) { $h5style .= 'color: '.get_theme_mod('h5_font_color', '#222538').';'; }

        $output .= 'body{'.$bstyle.'}';
        // $output .= '.common-menu-wrap .nav>li>a{'.$mstyle.'}';
        $output .= 'h1{'.$h1style.'}';
        $output .= 'h2{'.$h2style.'}';
        $output .= 'h3{'.$h3style.'}';
        $output .= 'h4{'.$h4style.'}';
        $output .= 'h5{'.$h5style.'}';
        $output .= '.heading-font, .secondary-font{font-family: '. get_theme_mod( 'h1_google_font', 'Poppins' ).'}';
        $output .= '.body-font, .main-font{font-family: '. get_theme_mod( 'body_google_font', 'Poppins' ).'}';


        //Header
        $body_bgc = get_post_meta( get_the_ID() , 'themeum_body_bgc', true );
        if($body_bgc){
            $output .= 'body{ background-color: '. $body_bgc .'; }';
        }else{
            $output .= 'body{ background-color: '.esc_attr( get_theme_mod( 'body_bg_color', '#e5e5e5' ) ) .'; }';
        }

        $output .= '.site-header{ padding-top: '. (int) esc_attr( get_theme_mod( 'header_padding_top', '0' ) ) .'px; }';
        $output .= '.site-header{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'header_padding_bottom', '0' ) ) .'px; }';
        $output .= '.site-header{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'header_margin_bottom', '0' ) ) .'px; }';

        if(get_theme_mod( 'header_color', '#fff' )){
            $headerbg = get_theme_mod( 'header_color', '#fff');
            $output .= '.site-header .header-wrapper{ background-color: '.$headerbg.';}';
        }
        //sticky Header
        if ( get_theme_mod( 'header_fixed', false ) ){
            $output .= '.site-header.sticky{ position:fixed;top:0;left:auto; z-index:99999;margin:0 auto; width:100%;-webkit-animation: fadeInDown 300ms;animation: fadeInDown 300ms;}';
            $output .= '.site-header.sticky.header-transparent .main-menu-wrap{ margin-top: 0;}';
            if ( get_theme_mod( 'sticky_header_color', '' ) ){
                $sticybg = get_theme_mod( 'sticky_header_color', '#fff');
                $output .= '.site-header.enable-sticky .header-wrapper{ background-color: '.$sticybg.';}';
            }
        }

        if (get_theme_mod( 'logo_width' )) {
            $output .= '.themeum-navbar-header .themeum-navbar-brand img{width:'.get_theme_mod( 'logo_width' ).'px;max-width:none;}';
        }

        if (get_theme_mod( 'logo_height' )) {
            $output .= '.themeum-navbar-header .themeum-navbar-brand img{height:'.get_theme_mod( 'logo_height' ).'px;}';
        }
        
        //body
        if (get_theme_mod( 'body_bg_img')) {
            $output .= 'body{ background-image: url("'.esc_attr( get_theme_mod( 'body_bg_img' ) ) .'");background-size: '.esc_attr( get_theme_mod( 'body_bg_size', 'cover' ) ) .';    background-position: '.esc_attr( get_theme_mod( 'body_bg_position', 'left top' ) ) .';background-repeat: '.esc_attr( get_theme_mod( 'body_bg_repeat', 'no-repeat' ) ) .';background-attachment: '.esc_attr( get_theme_mod( 'body_bg_attachment', 'fixed' ) ) .'; }';
        }

         $output .= '.newskit-login-register a.newskit-dashboard{ background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#ef3f48' ) ) .'; }';

        //menu color

        $nav_color = get_theme_mod( 'navbar_text_color', '#000' );
       
        if ( $nav_color ) {
            $output .= '.logo-wrapper a, .site-header.header-borderimage .header-top-contact, .header-borderimage .common-menu-wrap .nav>li.menu-item-has-children:after, .header-solid .common-menu-wrap .nav>li>a, .header-borderimage .common-menu-wrap .nav>li>a,
            .header-solid .common-menu-wrap .nav>li>a:after, .header-borderimage .common-menu-wrap .nav>li>a:after,.newskit-search, .site-header.header-transparent .common-menu-wrap .nav>li>a, .header-top-contact, .site-header.header-borderimage .header-top-contact, .social-share a, #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li>a{ color: '.esc_attr( $nav_color ) .'; }';

            $output .= '.login-link a:first-child::after{ background: '.esc_attr( $nav_color ) .' }';
        }


        //menu Hover color

        $nav_color = get_theme_mod( 'navbar_hover_text_color', '#ef3f48' );
       
        if ( $nav_color ) {
            $output .= '.logo-wrapper a:hover, .site-header.header-borderimage .header-top-contact, .header-borderimage .common-menu-wrap .nav>li.menu-item-has-children:after, .header-solid .common-menu-wrap .nav>li>a, .header-borderimage .common-menu-wrap .nav>li>a:hover,
            .header-solid .common-menu-wrap .nav>li>a:after, .header-borderimage .common-menu-wrap .nav>li>a:after,.newskit-search, .site-header.header-transparent .common-menu-wrap .nav>li>a:hover, .header-top-contact, .site-header.header-borderimage .header-top-contact, .social-share a, #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li>a:hover{ color: '.esc_attr( $nav_color ) .'; }';

            $output .= '.login-link a:first-child::after{ background: '.esc_attr( $nav_color ) .' }';
        }

        // Active menu color

        $active_menu = get_theme_mod( 'navbar_active_text_color', '#ef3f48' );
        if($active_menu){
            $output .= '#wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-item>a{color: '.esc_attr($active_menu).'}';
        }


        //submenu color
        $output .= '.common-menu-wrap .nav>li ul{ background-color: '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .'; }';
        $output .= '.site-header .common-menu-wrap .nav>li .sub-menu li a{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color', '#000' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'sub_menu_border', '#eef0f2' ) ) .'; }';
        $output .= '.site-header .common-menu-wrap .nav>li .sub-menu li a:hover,
.site-header .common-menu-wrap .nav>li .sub-menu li a:hover{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color_hover', '#ef3f48' ) ) .';}';
        $output .= '.common-menu-wrap .nav>li > ul::after{ border-color: transparent transparent '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .' transparent; }';

        //bottom
        $output .= '#bottom-wrap{ background-color: '.esc_attr( get_theme_mod( 'bottom_color', '#fff' ) ) .'; }';
        $output .= '#bottom-wrap,.bottom-widget .widget h3.widget-title{ color: '.esc_attr( get_theme_mod( 'bottom_text_color', '#232323' ) ) .'; }';
        $output .= '.widget_nav_menu ul li a{ color: '.esc_attr( get_theme_mod( 'bottom_link_color', '#7f7f7f' ) ) .'; }';
        $output .= '#bottom-wrap a:hover, #bottom-wrap a:hover i{ color: '.esc_attr( get_theme_mod( 'bottom_hover_color', '#ef3f48' ) ) .'; }';
        $output .= '#bottom-wrap{ padding-top: '. (int) esc_attr( get_theme_mod( 'bottom_padding_top', '60' ) ) .'px; }';
        $output .= '#bottom-wrap{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'bottom_padding_bottom', '60' ) ) .'px; }';

        //Bottom Link Color
        $bottom_social_color = get_theme_mod('bottom_link_color', '#232323');
        if($bottom_social_color){
            $output .= '.widget.widget_themeum_social_share_widget .themeum-social-share li a,
            .widget_nav_menu ul li a,
            #bottom-wrap .footer-single-wrap.footer-col-one ul li a
            { color: '.esc_attr( $bottom_social_color ) .'}';
        }

        //Bottom Link Hover Color
        $bottom_social_color = get_theme_mod('bottom_hover_color', '#232323');
        if($bottom_social_color){
            $output .= '.widget.widget_themeum_social_share_widget .themeum-social-share li a:hover,
            .widget_nav_menu ul li a:hover,
            #bottom-wrap .footer-single-wrap.footer-col-one ul li a:hover
            { color: '.esc_attr( $bottom_social_color ) .'}';
        }

        //footer
        $output .= '#footer-wrap{ background-color: '.esc_attr( get_theme_mod( 'copyright_bg_color', '#fff' ) ) .'; }';
        $output .= '.footer-copyright, .template-credit, #bottom-wrap ul.themeum-social-share { color: '.esc_attr( get_theme_mod( 'copyright_text_color', '#232323' ) ) .'; }';
        $output .= '.menu-footer-menu a{ color: '.esc_attr( get_theme_mod( 'copyright_link_color', '#7d91aa' ) ) .'; }';
        $output .= '.template-credit a:hover{ color: '.esc_attr( get_theme_mod( 'copyright_hover_color', '#ef3f48' ) ) .'; }';
        $output .= '#footer-wrap{ padding-top: '. (int) esc_attr( get_theme_mod( 'copyright_padding_top', '0' ) ) .'px; }';
        $output .= '#footer-wrap{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'copyright_padding_bottom', '40' ) ) .'px; }';

        // 404 Page
        $output .= "body.error404,body.page-template-404{ width: 100%; height: 100%; min-height: 100%; }";

        return $output;
    }
}


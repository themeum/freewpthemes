<?php

/*-------------------------------------------------------
 *              Themeum Supports and Image Cut
 *-------------------------------------------------------*/



if(!function_exists('floox_setup')):

    function floox_setup(){
        load_theme_textdomain( 'floox', get_template_directory() . '/languages' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'floox-large', 1140, 570, true );
        add_image_size( 'floox-medium', 362, 190, true );
        add_image_size( 'floox-portfo', 600, 630, true );
        add_image_size( 'floox-blog-medium', 352, 197, true );
        add_image_size( 'portfo-small', 82, 64, true );
        add_theme_support( 'post-formats', array( 'audio','gallery','image','link','quote','video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );
        if ( ! isset( $content_width ) ){
            $content_width = 660;
        }
    }
    add_action('after_setup_theme','floox_setup');

endif;



/*-------------------------------------------------------
 *              Themeum Pagination
 *-------------------------------------------------------*/
if(!function_exists('floox_pagination')):

    function floox_pagination( $page_numb , $max_page ){
        $big = 999999999;
        echo '<div class="themeum-pagination">';
        echo paginate_links( array(
            'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'        => '?paged=%#%',
            'current'       => $page_numb,
            'prev_text'     => __('<i class="fa fa-angle-left" aria-hidden="true"></i> Previous','floox'),
            'next_text'     => __('Next <i class="fa fa-angle-right" aria-hidden="true"></i>','floox'),
            'total'         => $max_page,
            'type'          => 'list',
        ) );
        echo '</div>';
    }

endif;


/*-------------------------------------------------------
 *              Themeum Comment
 *-------------------------------------------------------*/
if(!function_exists('floox_comment')):

    function floox_comment($comment, $args, $depth){
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
                        <?php edit_comment_link( esc_html__( 'Edit', 'floox' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'floox' ); ?></p>
                    <?php endif; ?>
                    <span class="comment-reply">
                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="fa fa-reply" aria-hidden="true"></i> '.esc_html__( 'Reply', 'floox' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
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



/*-------------------------------------------------------
*           Themeum Breadcrumb
*-------------------------------------------------------*/
if(!function_exists('floox_breadcrumbs')):

    function floox_breadcrumbs(){ ?>
        <ol class="breadcrumb">
            <li><a href="<?php echo esc_url(site_url()); ?>" class="breadcrumb_home"><?php esc_html_e('Home', 'floox') ?></a></li>
            <li class="active">
                <?php if( is_tag() ) { ?>
                <?php esc_html_e('Posts Tagged ', 'floox') ?><span class="raquo">/</span><?php single_tag_title(); echo('/'); ?>
                <?php } elseif (is_day()) { ?>
                <?php esc_html_e('Posts made in', 'floox') ?> <?php the_time('F jS, Y'); ?>
                <?php } elseif (is_month()) { ?>
                <?php esc_html_e('Posts made in', 'floox') ?> <?php the_time('F, Y'); ?>
                <?php } elseif (is_year()) { ?>
                <?php esc_html_e('Posts made in', 'floox') ?> <?php the_time('Y'); ?>
                <?php } elseif (is_search()) { ?>
                <?php esc_html_e('Search results for', 'floox') ?> <?php the_search_query() ?>
                <?php } elseif (is_single()) { ?>
                <?php $category = get_the_category();
                    if ( $category ) {
                        $catlink = get_category_link( $category[0]->cat_ID );
                        echo ('<a href="'.esc_url($catlink).'">'.esc_html($category[0]->cat_name).'</a> '.'<span class="raquo"></span> ');
                    } elseif (get_post_type() == 'product'){
                        echo get_the_title();
                    } ?>
                <?php } elseif (is_category()) { ?>
                <?php single_cat_title(); ?>
                <?php } elseif (is_tax()) { ?>
                <?php
                $themeum_taxonomy_links = array();
                $themeum_term = get_queried_object();
                $themeum_term_parent_id = $themeum_term->parent;
                $themeum_term_taxonomy = $themeum_term->taxonomy;
                while ( $themeum_term_parent_id ) {
                    $themeum_current_term = get_term( $themeum_term_parent_id, $themeum_term_taxonomy );
                    $themeum_taxonomy_links[] = '<a href="' . esc_url( get_term_link( $themeum_current_term, $themeum_term_taxonomy ) ) . '" title="' . esc_attr( $themeum_current_term->name ) . '">' . esc_html( $themeum_current_term->name ) . '</a>';
                    $themeum_term_parent_id = $themeum_current_term->parent;
                }
                if ( !empty( $themeum_taxonomy_links ) ) echo implode( ' <span class="raquo">/</span> ', array_reverse( $themeum_taxonomy_links ) ) . ' <span class="raquo">/</span> ';
                    echo esc_html( $themeum_term->name );
                } elseif (is_author()) {
                    global $wp_query;
                    $curauth = $wp_query->get_queried_object();
                    esc_html_e('Posts by ', 'floox'); echo ' ',$curauth->nickname;
                } elseif (is_page()) {
                    echo get_the_title();
                } elseif (is_home()) {
                    esc_html_e('Blog', 'floox');
                } ?>
            </li>
        </ol>
    <?php
    }

endif;



/*-----------------------------------------------------
 *              Coming Soon Page Settings
 *----------------------------------------------------*/
if ( get_theme_mod( 'comingsoon_en', false ) ) {
    if(!function_exists('floox_my_page_template_redirect')):
        function floox_my_page_template_redirect()
        {
            if( is_page() || is_home() || is_category() || is_single() )
            {
                if( !is_super_admin( get_current_user_id() ) ){
                    get_template_part( 'coming','soon');
                    exit();
                }
            }
        }
        add_action( 'template_redirect', 'floox_my_page_template_redirect' );
    endif;

    if(!function_exists('floox_cooming_soon_wp_title')):
        function floox_cooming_soon_wp_title(){
            return 'Coming Soon';
        }
        add_filter( 'wp_title', 'floox_cooming_soon_wp_title' );
    endif;
}




/*-----------------------------------------------------
 *              CSS Generator
 *----------------------------------------------------*/
if(!function_exists('floox_css_generator')){
    function floox_css_generator(){

        $output = '';

        $preset = get_theme_mod( 'preset', '1' );
        if( $preset ){

            if( get_theme_mod( 'custom_preset_en', true ) ) {

                // CSS Color
                $major_color = get_theme_mod( 'major_color', '#23d0ec' );

                // secondary gradient color
                $gradient_color = get_theme_mod( 'major_sec_color', '#239cec' );

                $output .= '
                    .slide-popup-media i{background: '.$major_color.';
                    background: -moz-linear-gradient(top, '.$major_color.' 0%, '.$gradient_color.' 100%);
                    background: -webkit-linear-gradient(top, '.$major_color.' 0%,'.$gradient_color.' 100%);
                    background: linear-gradient(to bottom, '.$major_color.' 0%,'.$gradient_color.' 100%);
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$major_color.'", endColorstr="'.$gradient_color.'",GradientType=1 );}
                ';


                if($major_color){
                    $output .= '
                    a,
                    .thm-title-top-wave i,
                    #bottom-wrap a:hover,
                    .mc4wp-form-fields button:hover,
                    .site-header .common-menu-wrap .nav>li .sub-menu li a:hover,
                    .bottom-widget .widget ul li a:hover,
                    #wp-megamenu-primary>.wpmm-nav-wrap .wp-megamenu>li>ul.wp-megamenu-sub-menu li.wpmm-type-widget:hover>a,
                    .widget ul li a:hover,
                    .widget-blog-posts-section .entry-title  a:hover,
                    .entry-header h2.entry-title.blog-entry-title a:hover,
                    .entry-summary .wrap-btn-style a.btn-style:hover,
                    .main-menu-wrap .navbar-toggle:hover,
                    .woocommerce .star-rating span:before,
                    .floox-post .blog-post-meta li a:hover,
                    .floox-post .content-item-title a:hover,
                    .woocommerce ul.products li.product .added_to_cart,
                    .woocommerce ul.products li.product:hover .button.add_to_cart_button,
                    .woocommerce ul.products li.product:hover .added_to_cart,
                    .woocommerce div.product p.price,
                    .woocommerce div.product span.price,
                    .product_meta .sku_wrapper span.sku,
                    .woocommerce-message::before,
                    .woocommerce a.remove,
                    .themeum-campaign-post .entry-category a:hover,
                    .themeum-campaign-post .entry-author a:hover,
                    .woocommerce ul.products li.product .product-thumbnail-outer:hover .product-content-wrapper a h2,
                    .themeum-campaign-post h3 a:hover,
                    .themeum-woo-product-details .product-content h4 a:hover,
                    .wpneo-campaign-creator-details p:first-child a:hover,
                    #mobile-menu ul li.active>a,
                    #mobile-menu ul li a:hover,
                    .woocommerce .product .product-thumbnail-outer .product-content-wrapper a:hover,
                    .tab-rewards-wrapper h3,
                    ul.wpneo-crowdfunding-update li .wpneo-crowdfunding-update-title,
                    .btn.btn-border-floox,
                    .entry-summary .wrap-btn-style a.btn-style,
                    .social-share-wrap ul li a:hover,
                    .wpneo-tabs-menu li a:hover,
                    .product-timeline ul li,
                    .themeum-campaign-post h3 a:hover,
                    .team-content-socials a:hover,
                    .portfolioFilter a.current,
                    .overlay-btn,
                    .floox-post .content-item-title a:hover,
                    .floox-widgets a:hover,.elementor-accordion-title.active .elementor-accordion-icon i,
                    .portfolio-tag-cont li a:hover,
                    .portfolio-single-related-post .portfolio-cat a:hover,
                    .header-solid .common-menu-wrap .nav>li.active>a:after,
                    .theme-color,
                    .widget.widget_themeum_about_widget .themeum-about-info li span.themeum-widget-address,
                    .btn.btn-floox:hover,
                    .elementor-widget-tabs.elementor-tabs-view-horizontal .elementor-tabs .elementor-tab-desktop-title.elementor-active,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li a:hover,
                    .portfolio-items:hover .portfolio-item-content-in .floox-icon
                    { color: '. esc_attr($major_color) .'; }';
                }

                //Css Color Important
                if($major_color){
                    $output .= '.elementor-slick-slider ul.slick-dots li.slick-active button:hover,
                    .elementor-slick-slider ul.slick-dots li.slick-active button:before,
                    .social-share a:hover, .login-link a:hover,
                    .header-borderimage .common-menu-wrap .nav>li.menu-item-has-children:after,
                    .common-menu-wrap .nav>li>a:hover,
                    .common-menu-wrap .nav>li>a:focus,
                    .common-menu-wrap .nav>li.current_page_item a,
                    .template-credit p a,
                    .widget.widget_themeum_about_widget .themeum-about-info li span.themeum-widget-address,
                    #bottom-wrap a:hover,
                    .elementor-slick-slider ul.slick-dots li.slick-active button:before,
                    .widget.widget_themeum_social_share_widget .themeum-social-share li a:hover
                    {color: '.$major_color.' !important}';
                }

                //Css Background Gradient
                if($major_color){
                    $output .= '.#wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-parent>a,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-item>a
                    {background: '.$major_color.' !important}';
                }

                // CSS Background Color
                if($major_color){
                    $output .= '
                    .mc4wp-form-fields button,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li>a:hover,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-item>a,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-parent>a,
                    .site-header .common-menu-wrap .nav>li.current_page_parent a,
                    .woocommerce-tabs .wc-tabs>li.active:before,
                    .team-content4,
                    .classic-slider .owl-dots .active>span,
                    .project-navigator a.prev:hover,
                    .project-navigator a.next:hover,
                    .woocommerce #respond input#submit:hover,
                    .themeum-pagination .page-numbers li a:hover,
                    .themeum-pagination .page-numbers li span.current,
                    .woocommerce nav.woocommerce-pagination ul li a:hover,
                    .woocommerce nav.woocommerce-pagination ul li span.current,
                    .form-submit input[type=submit],
                    .woocommerce div.product span.onsale,
                    .woocommerce-tabs .nav-tabs>li.active>a,
                    .woocommerce-tabs .nav-tabs>li.active>a:focus,
                    .woocommerce-tabs .nav-tabs>li.active>a:hover,
                    .woocommerce a.button:hover,
                    .woocommerce .woocommerce-info,
                    .woocommerce a.added_to_cart,
                    .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,
                    ul.wpneo-crowdfunding-update li:hover span.round-circle,
                    .themeum-product-slider .slick-next:hover,
                    .themeum-product-slider .slick-prev:hover,
                    .floox_wooshop_widgets .ui-slider-range,
                    .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
                    .woocommerce .widget_price_filter .ui-slider-horizontal,
                    .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
                    .floox_wooshop_widgets .widget .button,
                    .thm-progress-bar .progress-bar,
                    .order-view .label-info,
                    .team-content-image,
                    .post-meta-info-list-in a:hover,
                    .portfolio-items:hover .caption-full-width,
                    .portfolio-items:hover .portfolio-layout2,.info-wrapper a.white:hover, .portfolio-social-icons ul li a:hover, .portfolio-info .portfolio-tag-cont li:hover, .floox-service-content .elementor-icon-box-wrapper:hover, .floox-portfolio-button:hover,
                    .widget .tagcloud a:hover,
                    .single_related:hover .overlay-content,.elementor-widget-tabs .themeum-nav-wrapper .elementor-tab-desktop-title.active,
                    .elementor-icon-box-wrapper:hover .feature-box-line,
                    .thm-slide-control li.slick-active button,
                    .btn.btn-floox,
                    .thm-default-postbox .thm-post-bg,
                    .thm-post-top .meta-category a:hover,
                    .floox-post .blog-post-meta .meta-category a:hover,
                    .floox-quote,
                    #sidebar h3.widget_title::before,
                    .featured-wrap-link .entry-link-post-format,
                    .featured-wrap-quite .entry-quote-post-format
                    { background: '. esc_attr($major_color) .'; }';

                    $output .= '.elementor-accordion-title.active{ background: '.esc_attr( $major_color ) .' !important; }';
                    $output .= '.elementor-widget-tabs .themeum-nav-wrapper .elementor-tab-desktop-title.active:after{ border-color: '.esc_attr( $major_color ) .' transparent transparent transparent; }';
                }
                //Css Background Important
                if($major_color){
                    $output .= '#wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-parent>a,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-item>a,
                    .elementor-accordion .elementor-accordion-item .elementor-tab-title.elementor-active
                    {background: '.$major_color.' !important}';
                }
                // CSS Border
                if($major_color){
                    $output .= '
                    input:focus,
                    textarea:focus,
                    keygen:focus,
                    select:focus,
                    .classic-slider.layout2 .classic-slider-btn:hover,
                    .classic-slider.layout3 .classic-slider-btn:hover,
                    .classic-slider.layout4 .classic-slider-btn:hover,
                    .portfolio-slider .portfolio-slider-btn:hover,
                    .carousel-woocommerce .owl-nav .owl-next:hover,
                    .carousel-woocommerce .owl-nav .owl-prev:hover,
                    .themeum-latest-post-content .entry-title a:hover,
                    .common-menu-wrap .nav>li.current>a,
                    .header-solid .common-menu-wrap .nav>li.current>a,
                    .portfolio-filter a:hover,
                    .portfolio-filter a.active,
                    .latest-review-single-layout2 .latest-post-title a:hover,
                    .blog-arrows a:hover,
                    .wpcf7-submit,
                    .themeum-pagination .page-numbers li a:hover,
                    .themeum-pagination .page-numbers li span.current,
                    .woocommerce nav.woocommerce-pagination ul li a:hover,
                    .woocommerce nav.woocommerce-pagination ul li span.current,
                    .portfolio-slider .portfolio-slider-btn,
                    .wpcf7-form input:focus,
                    .btn.btn-border-floox,
                    .btn.btn-border-white:hover,
                    .info-wrapper a.white:hover,
                    .testiminial-home3 .client-wrapper,
                    .thm-post-top .meta-category a:hover,
                    .elementor-widget-tabs.elementor-tabs-view-horizontal .elementor-tabs .elementor-tab-desktop-title.elementor-active,
                    .thm-fullscreen-search form input[type="text"],
                    .btn.btn-floox
                    { border-color: '. esc_attr($major_color) .'; }';
                }

                // CSS Background Color & Border
                if($major_color){
                    $output .= '
                    .wpcf7-submit:hover,
                    .classic-slider.layout2 .classic-slider-btn:hover,
                    .classic-slider.layout3 .classic-slider-btn:hover,
                    .classic-slider.layout4 .classic-slider-btn:hover,
                    .classic-slider.layout4 .container >div,
                    .portfolio-slider .portfolio-slider-btn:hover,
                    .woocommerce #respond input#submit.alt,
                    .woocommerce a.button.alt,
                    .woocommerce button.button.alt,
                    .woocommerce input.button.alt,
                    .mc4wp-form-fields .send-arrow button,
                    .themeum-woo-product-details .addtocart-btn .add_to_cart_button:hover,
                    .themeum-woo-product-details .addtocart-btn .added_to_cart:hover,
                    .post-meta-info-list-in a:hover,
                    .woocommerce-MyAccount-navigation ul li:hover,
                    .carousel-woocommerce .owl-nav .owl-next:hover,
                    .carousel-woocommerce .owl-nav .owl-prev:hover,
                    .woocommerce-MyAccount-navigation ul li.is-active,
                    .portfolio-thumb-wrapper-layout4 .portfolio-thumb:before,
                    .comingsoon .mc4wp-form-fields input[type=submit]
                    {   background-color: '. esc_attr($major_color) .'; border-color: '. esc_attr($major_color) .'; }';
                }

            }

            // Custom Color
            if( get_theme_mod( 'custom_preset_en', true ) ) {
                $hover_color = get_theme_mod( 'hover_color', '#23d0ec' );
                if( $hover_color ){
                    $output .= 'a:hover,
                    .widget.widget_rss ul li a,
                    .footer-copyright a:hover,
                    .entry-summary .wrap-btn-style a.btn-style:hover{ color: '.esc_attr( $hover_color ) .'; }';

                    $output .= '.error-page-inner a.btn.btn-primary.btn-lg:hover,
                    .btn.btn-primary:hover,
                    input[type=button]:hover,
                    .widget.widget_search #searchform .btn-search:hover,
                    .woocommerce #respond input#submit.alt:hover,
                     .woocommerce a.button.alt:hover,
                     .woocommerce button.button.alt:hover,
                     .woocommerce input.button.alt:hover,
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
        if ( get_theme_mod('body_font_color', '#7d91aa') ) { $bstyle .= 'color: '.get_theme_mod('', '#7d91aa').';'; }

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
        if ( get_theme_mod( 'h1_font_weight', '600' ) ) { $h1style .= 'font-weight: '.get_theme_mod( 'h1_font_weight', '700' ).';'; }
        if ( get_theme_mod('h1_font_height', '42') ) { $h1style .= 'line-height: '.get_theme_mod('h1_font_height', '42').'px;'; }
        if ( get_theme_mod('h1_font_color', '#333') ) { $h1style .= 'color: '.get_theme_mod('h1_font_color', '#333').';'; }

        # heading2
        $h2style = '';
        if ( get_theme_mod( 'h2_font_size', '36' ) ) { $h2style .= 'font-size:'.get_theme_mod( 'h2_font_size', '36' ).'px;'; }
        if ( get_theme_mod( 'h2_google_font', 'Poppins' ) ) { $h2style .= 'font-family:'.get_theme_mod( 'h2_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'h2_font_weight', '600' ) ) { $h2style .= 'font-weight: '.get_theme_mod( 'h2_font_weight', '600' ).';'; }
        if ( get_theme_mod('h2_font_height', '36') ) { $h2style .= 'line-height: '.get_theme_mod('h2_font_height', '36').'px;'; }
        if ( get_theme_mod('h2_font_color', '#222538') ) { $h2style .= 'color: '.get_theme_mod('h2_font_color', '#222538').';'; }

        //heading3
        $h3style = '';
        if ( get_theme_mod( 'h3_font_size', '26' ) ) { $h3style .= 'font-size:'.get_theme_mod( 'h3_font_size', '26' ).'px;'; }
        if ( get_theme_mod( 'h3_google_font', 'Poppins' ) ) { $h3style .= 'font-family:'.get_theme_mod( 'h3_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'h3_font_weight', '600' ) ) { $h3style .= 'font-weight: '.get_theme_mod( 'h3_font_weight', '600' ).';'; }
        if ( get_theme_mod('h3_font_height', '28') ) { $h3style .= 'line-height: '.get_theme_mod('h3_font_height', '28').'px;'; }
        if ( get_theme_mod('h3_font_color', '#222538') ) { $h3style .= 'color: '.get_theme_mod('h3_font_color', '#222538').';'; }

        //heading4
        $h4style = '';
        if ( get_theme_mod( 'h4_font_size', '18' ) ) { $h4style .= 'font-size:'.get_theme_mod( 'h4_font_size', '18' ).'px;'; }
        if ( get_theme_mod( 'h4_google_font', 'Poppins' ) ) { $h4style .= 'font-family:'.get_theme_mod( 'h4_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'h4_font_weight', '600' ) ) { $h4style .= 'font-weight: '.get_theme_mod( 'h4_font_weight', '600' ).';'; }
        if ( get_theme_mod('h4_font_height', '26') ) { $h4style .= 'line-height: '.get_theme_mod('h4_font_height', '26').'px;'; }
        if ( get_theme_mod('h4_font_color', '#222538') ) { $h4style .= 'color: '.get_theme_mod('h4_font_color', '#222538').';'; }

        //heading5
        $h5style = '';
        if ( get_theme_mod( 'h5_font_size', '14' ) ) { $h5style .= 'font-size:'.get_theme_mod( 'h5_font_size', '14' ).'px;'; }
        if ( get_theme_mod( 'h5_google_font', 'Poppins' ) ) { $h5style .= 'font-family:'.get_theme_mod( 'h5_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'h5_font_weight', '600' ) ) { $h5style .= 'font-weight: '.get_theme_mod( 'h5_font_weight', '600' ).';'; }
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

        $header_bgc = get_post_meta( get_the_ID() , 'themeum_header_bgc', true );

        if($header_bgc){
            $output .= '.site-header{ background-color: '. $header_bgc .'; }';
        }elseif(get_theme_mod( 'header_color', '#222538' )){
            $output .= '.site-header{ background-color: '.esc_attr( get_theme_mod( 'header_color', '#222538' ) ) .'; }';
        }


        $headerlayout = get_theme_mod( 'head_style', 'transparent' );
        $header_style = get_post_meta( get_the_ID(), "themeum_header_style", true );
        if($header_style){
            if($header_style == 'transparent_header'){
                $headerlayout =  'transparent';
            }else{
                $headerlayout =  'borderimage';
            }
        }


        // Header Transparent
        if ( $headerlayout == 'transparent' ){
            $output .= '.site-header{ background-color: transparent;}';
        }


        $output .= '.site-header{ padding-top: '. (int) esc_attr( get_theme_mod( 'header_padding_top', '0' ) ) .'px; }';
        $output .= '.site-header{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'header_padding_bottom', '0' ) ) .'px; }';
        $output .= '.site-header{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'header_margin_bottom', '0' ) ) .'px; }';

        //sticky Header
        if ( get_theme_mod( 'header_fixed', false ) ){
            $output .= '.site-header.sticky{ position:fixed;top:0;left:auto; z-index:99999;margin:0 auto; width:100%;-webkit-animation: fadeInDown 300ms;animation: fadeInDown 300ms;}';
            $output .= '.site-header.sticky.header-transparent .main-menu-wrap{ margin-top: 0;}';
            if ( get_theme_mod( 'sticky_header_color', 'rgba(28,49,74,0.95)' ) ){
                $sticybg = get_theme_mod( 'sticky_header_color', 'rgba(28,49,74,0.95)');
                $output .= '.site-header.sticky{ background-color: '.$sticybg.';}';
            }
        }


        //logo
        // $output .= '.themeum-navbar-header .themeum-navbar-brand img{width:'.get_theme_mod( 'logo_width', 145 ).'px; max-width:none;}';
        // if (get_theme_mod( 'logo_height' )) {
        //     $output .= '.themeum-navbar-header .themeum-navbar-brand img{height:'.get_theme_mod( 'logo_height' ).'px;}';
        // }

        // sub header
        $output .= '.subtitle-cover h2{font-size:'.get_theme_mod( 'sub_header_title_size', '14' ).'px;color:'.get_theme_mod( 'sub_header_title_color', '#fff' ).';}';
        $output .= '.breadcrumb>li+li:before, .subtitle-cover .breadcrumb, .subtitle-cover .breadcrumb>.active{color:'.get_theme_mod( 'breadcrumb_text_color', '#000' ).';}';
        $output .= '.subtitle-cover .breadcrumb a{color:'.get_theme_mod( 'breadcrumb_link_color', '#000' ).';}';
        $output .= '.subtitle-cover .breadcrumb a:hover{color:'.get_theme_mod( 'breadcrumb_link_color_hvr', '#000' ).';}';
        $output .= '.subtitle-cover{padding:'.get_theme_mod( 'sub_header_padding_top', '215' ).'px 0 '.get_theme_mod( 'sub_header_padding_bottom', '115' ).'px; margin-bottom: '.get_theme_mod( 'sub_header_margin_bottom', '60' ).'px;}';

        //body
        if (get_theme_mod( 'body_bg_img')) {
            $output .= 'body{ background-image: url("'.esc_attr( get_theme_mod( 'body_bg_img' ) ) .'");background-size: '.esc_attr( get_theme_mod( 'body_bg_size', 'cover' ) ) .';    background-position: '.esc_attr( get_theme_mod( 'body_bg_position', 'left top' ) ) .';background-repeat: '.esc_attr( get_theme_mod( 'body_bg_repeat', 'no-repeat' ) ) .';background-attachment: '.esc_attr( get_theme_mod( 'body_bg_attachment', 'fixed' ) ) .'; }';
        }
        $output .= 'body{ background-color: '.esc_attr( get_theme_mod( 'body_bg_color', '#ffffff' ) ) .'; }';



        // Button color setting...
        $output .= 'input[type=submit],input[type="button"].wpneo-image-upload,
                    input[type="button"].wpneo-image-upload-btn,input[type="button"]#addreward,.wpneo-edit-btn,
                    .wpneo-image-upload.float-right,.wpneo-save-btn,.wpneo-cancel-btn,
                    .dashboard-btn-link,#wpneo_active_edit_form,#addcampaignupdate,
                    .wpneo_donate_button,.wpneo-profile-button,.select_rewards_button,
                    .woocommerce-page #payment #place_order,.btn.btn-white:hover,
                    .btn.btn-border-floox:hover,.btn.btn-border-white:hover,.woocommerce input.button,
                    input[type="submit"].wpneo-submit-campaign{ background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#23d0ec' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#23d0ec' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_text_color', '#fff' ) ) .' !important; border-radius: '.get_theme_mod( 'button_radius', 4 ).'px; }';

         $output .= '.floox-login-register a.floox-dashboard{ background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#23d0ec' ) ) .'; }';


        if ( get_theme_mod( 'button_hover_bg_color', '#23d0ec' ) ) {
            $output .= 'input[type=submit]:hover,input[type="button"].wpneo-image-upload:hover,input[type="button"].wpneo-image-upload-btn:hover,
                input[type="button"]#addreward:hover,.wpneo-edit-btn:hover,
                .wpneo-image-upload.float-right:hover,.wpneo-save-btn:hover,
                .dashboard-btn-link:hover,#wpneo_active_edit_form:hover,#addcampaignupdate:hover,
                .wpneo_donate_button:hover,.wpneo-profile-button:hover,.select_rewards_button:hover,
            .woocommerce-page #payment #place_order:hover,
            input[type="submit"].wpneo-submit-campaign:hover{ background-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#23d0ec' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#23d0ec' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_hover_text_color', '#fff' ) ) .' !important; }';

            $output .= '.floox-login-register a.floox-dashboard:hover{ background-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#23d0ec' ) ) .'; }';
        }

        //menu color

        $nav_color = get_theme_mod( 'navbar_text_color', '#ffffff' );
        $menu_color = get_post_meta(get_the_ID(), 'themeum_header_c', true);

        if($menu_color){
            $nav_color = $menu_color;
        }

        if ( $nav_color ) {
            $output .= '.logo-wrapper a, .site-header.header-borderimage .header-top-contact, .login-link a,.header-borderimage .common-menu-wrap .nav>li.menu-item-has-children:after, .header-solid .common-menu-wrap .nav>li>a, .header-borderimage .common-menu-wrap .nav>li>a,
            .header-solid .common-menu-wrap .nav>li>a:after, .header-borderimage .common-menu-wrap .nav>li>a:after,.floox-search, .site-header.header-transparent .common-menu-wrap .nav>li>a, .site-header.header-transparent .social-share a, .site-header.header-transparent .login-link a, .header-top-contact, .site-header.header-borderimage .header-top-contact, .social-share a, .login-link a, #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li>a{ color: '.esc_attr( $nav_color ) .'; }';

            $output .= '.login-link a:first-child::after{ background: '.esc_attr( $nav_color ) .' }';
        }



        $output .= '.floox-login-register ul li a,
        .floox-search-wrap a.floox-search:hover{ color: '.esc_attr( get_theme_mod( 'navbar_hover_text_color', '#23d0ec' ) ) .'; }';

        $output .= '.header-solid .common-menu-wrap .nav>li.active>a, .header-borderimage .common-menu-wrap .nav>li.active>a{ color: '.esc_attr( get_theme_mod( 'navbar_active_text_color', '#23d0ec' ) ) .'; }';

        //submenu color
        $output .= '.common-menu-wrap .nav>li ul{ background-color: '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>ul li a,.common-menu-wrap .nav > li > ul li.mega-child > a{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color', '#191919' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'sub_menu_border', '#eef0f2' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>ul li a:hover,.common-menu-wrap .sub-menu > li.active > a,
        .common-menu-wrap .nav>li>ul li a:hover,
.common-menu-wrap .sub-menu li.active.mega-child a:hover{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color_hover', '#23d0ec' ) ) .';}';
        $output .= '.common-menu-wrap .nav>li > ul::after{ border-color: transparent transparent '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .' transparent; }';



        //bottom
        $output .= '#bottom-wrap{ background-color: '.esc_attr( get_theme_mod( 'bottom_color', '#484848' ) ) .'; }';
        $output .= '#bottom-wrap,.bottom-widget .widget h3.widget-title{ color: '.esc_attr( get_theme_mod( 'bottom_text_color', '#7d91aa' ) ) .'; }';
        $output .= '#bottom-wrap a{ color: '.esc_attr( get_theme_mod( 'bottom_link_color', '#7d91aa' ) ) .'; }';
        $output .= '#bottom-wrap a:hover{ color: '.esc_attr( get_theme_mod( 'bottom_hover_color', '#23d0ec' ) ) .'; }';
        $output .= '#bottom-wrap{ padding-top: '. (int) esc_attr( get_theme_mod( 'bottom_padding_top', '80' ) ) .'px; }';
        $output .= '#bottom-wrap{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'bottom_padding_bottom', '45' ) ) .'px; }';


        //footer
        $output .= '#footer-wrap{ background-color: '.esc_attr( get_theme_mod( 'copyright_bg_color', '#484848' ) ) .'; }';
        $output .= '.footer-copyright, .template-credit { color: '.esc_attr( get_theme_mod( 'copyright_text_color', '#96989d' ) ) .'; }';
        $output .= '.menu-footer-menu a{ color: '.esc_attr( get_theme_mod( 'copyright_link_color', '#7d91aa' ) ) .'; }';
        $output .= '.menu-footer-menu a:hover{ color: '.esc_attr( get_theme_mod( 'copyright_hover_color', '#23d0ec' ) ) .'; }';
        $output .= '#footer-wrap{ padding-top: '. (int) esc_attr( get_theme_mod( 'copyright_padding_top', '25' ) ) .'px; }';
        $output .= '#footer-wrap{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'copyright_padding_bottom', '25' ) ) .'px; }';

        // 404 Page
        $output .= "body.error404,body.page-template-404{ width: 100%; height: 100%; min-height: 100%; }";

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

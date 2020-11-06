<?php

/*-------------------------------------------------------
 *              Themeum Supports and Image Cut
 *-------------------------------------------------------*/
if(!function_exists('zephyr_setup')):

    function zephyr_setup(){
        load_theme_textdomain( 'zephyr', get_template_directory() . '/languages' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'zephyr-large', 1140, 570, true );
        add_image_size( 'zephyr-medium', 362, 190, true );
        add_image_size( 'zephyr-portfo', 600, 500, true );
        add_image_size( 'zephyr-blog-medium', 352, 197, true );
        add_image_size( 'portfo-small', 82, 64, true );
        add_theme_support( 'post-formats', array( 'audio','gallery','image','link','quote','video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );
        if ( ! isset( $content_width ) ){
            $content_width = 660;
        }
    }
    add_action('after_setup_theme','zephyr_setup');

endif;



/*-------------------------------------------------------
 *              Themeum Pagination
 *-------------------------------------------------------*/
if(!function_exists('zephyr_pagination')):

    function zephyr_pagination( $page_numb , $max_page ){
        $big = 999999999;
        echo '<div class="themeum-pagination">';
        echo paginate_links( array(
            'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'        => '?paged=%#%',
            'current'       => $page_numb,
            'prev_text'     => __('<i class="fa fa-long-arrow-left" aria-hidden="true"></i>','zephyr'),
            'next_text'     => __('<i class="fa fa-long-arrow-right" aria-hidden="true"></i>','zephyr'),
            'total'         => $max_page,
            'type'          => 'list',
        ) );
        echo '</div>';
    }

endif;


/*-------------------------------------------------------
 *              Themeum Comment
 *-------------------------------------------------------*/
if(!function_exists('zephyr_comment')):

    function zephyr_comment($comment, $args, $depth){
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
                        <?php edit_comment_link( esc_html__( 'Edit', 'zephyr' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'zephyr' ); ?></p>
                    <?php endif; ?>
                    <span class="comment-reply">
                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="fa fa-reply" aria-hidden="true"></i> '.esc_html__( 'Reply', 'zephyr' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
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
*           Zephyr Breadcrumb
*-------------------------------------------------------*/
if(!function_exists('zephyr_breadcrumbs')):
    function zephyr_breadcrumbs(){ ?>
        <li><a href="<?php echo esc_url(site_url()); ?>" class="breadcrumb_home"><?php esc_html_e('Home ', 'zephyr') ?> &nbsp; /</a></li>
        <?php
            if(function_exists('is_product')){
                $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
                if(is_product()){
                    echo "<li><a href='".$shop_page_url."'>Shop</a></li>";
                }
            }
        ?>
        <li class="active">
            <span>
                <?php if(function_exists('is_shop')){ if(is_shop()){ esc_html_e('shop','zephyr'); } } ?>

                <?php if( is_tag() ) { ?>
                <?php esc_html_e('Posts Tagged ', 'zephyr') ?><span class="raquo">/</span><?php single_tag_title(); echo('/'); ?>
                <?php } elseif (is_day()) { ?>
                <?php esc_html_e('Posts made in', 'zephyr') ?> <?php the_time('F jS, Y'); ?>
                <?php } elseif (is_month()) { ?>
                <?php esc_html_e('Posts made in', 'zephyr') ?> <?php the_time('F, Y'); ?>
                <?php } elseif (is_year()) { ?>
                <?php esc_html_e('Posts made in', 'zephyr') ?> <?php the_time('Y'); ?>
                <?php } elseif (is_search()) { ?>
                <?php esc_html_e('Search results for', 'zephyr') ?> <?php the_search_query() ?>
                <?php } elseif (is_single()) { ?>
                <?php $category = get_the_category();
                    if ( $category ) {
                        $catlink = get_category_link( $category[0]->cat_ID );
                        echo ('<a href="'.esc_url($catlink).'">'.esc_html($category[0]->cat_name).'</a> '.'<span class="raquo">Single Post</span> ');
                    } elseif (get_post_type() == 'product'){
                        echo get_the_title();
                    } elseif (get_post_type() == 'portfolio'){
                        echo get_the_title();
                    }
                ?>
                <?php } elseif (is_category()) { ?>
                <?php single_cat_title(); ?>
                <?php } elseif (is_tax()) { ?>
                <?php
                $charity_taxonomy_links = array();
                $charity_term = get_queried_object();
                $charity_term_parent_id = $charity_term->parent;
                $charity_term_taxonomy = $charity_term->taxonomy;
                while ( $charity_term_parent_id ) {
                    $charity_current_term = get_term( $charity_term_parent_id, $charity_term_taxonomy );
                    $charity_taxonomy_links[] = '<a href="' . esc_url( get_term_link( $charity_current_term, $charity_term_taxonomy ) ) . '" title="' . esc_attr( $charity_current_term->name ) . '">' . esc_html( $charity_current_term->name ) . '</a>';
                    $charity_term_parent_id = $charity_current_term->parent;
                }
                if ( !empty( $charity_taxonomy_links ) ) echo implode( ' <span class="raquo">/</span> ', array_reverse( $charity_taxonomy_links ) ) . ' <span class="raquo">/</span> ';
                    echo esc_html( $charity_term->name );
                } elseif (is_author()) {
                    global $wp_query;
                    $curauth = $wp_query->get_queried_object();
                    esc_html_e('Posts by ', 'zephyr'); echo ' ',$curauth->nickname;
                } elseif (is_page()) {
                    echo get_the_title();
                } elseif (is_home()) {
                    esc_html_e('Blog', 'zephyr');
                } ?>
            </span>
        </li> 
    <?php
    }
endif;















/*-----------------------------------------------------
 *              Coming Soon Page Settings
 *----------------------------------------------------*/
if ( get_theme_mod( 'comingsoon_en', false ) ) {
    if(!function_exists('zephyr_my_page_template_redirect')):
        function zephyr_my_page_template_redirect()
        {
            if( is_page() || is_home() || is_category() || is_single() )
            {
                if( !is_super_admin( get_current_user_id() ) ){
                    get_template_part( 'coming','soon');
                    exit();
                }
            }
        }
        add_action( 'template_redirect', 'zephyr_my_page_template_redirect' );
    endif;

    if(!function_exists('zephyr_cooming_soon_wp_title')):
        function zephyr_cooming_soon_wp_title(){
            return 'Coming Soon';
        }
        add_filter( 'wp_title', 'zephyr_cooming_soon_wp_title' );
    endif;
}




/*-----------------------------------------------------
 *              CSS Generator
 *----------------------------------------------------*/
if(!function_exists('zephyr_css_generator')){
    function zephyr_css_generator(){

        $output = '';

        $preset = get_theme_mod( 'preset', '1' );
        if( $preset ){

            if( get_theme_mod( 'custom_preset_en', true ) ) {

                // CSS Color
                $major_color = get_theme_mod( 'major_color', '#65ca2d' );
                if($major_color){
                    $output .= '
                    a,
                    .bottom-widget .widget ul li a:hover,
                    #wp-megamenu-primary>.wpmm-nav-wrap .wp-megamenu>li>ul.wp-megamenu-sub-menu li.wpmm-type-widget:hover>a,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li.current-menu-item>a,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-ancestor>a,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li.active>a,
                    .widget ul li a:hover,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li:hover>a,
                    .themeum-pagination .page-numbers li a,
                    .widget-blog-posts-section .entry-title  a:hover,
                    .entry-header h2.entry-title.blog-entry-title a:hover,
                    .entry-summary .wrap-btn-style a.btn-style:hover,
                    .main-menu-wrap .navbar-toggle:hover,
                    .woocommerce .star-rating span:before,
                    .zephyr-post .blog-post-meta li a:hover,
                    .zephyr-post .blog-post-meta li i,
                    .zephyr-post .content-item-title a:hover,
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
                    .btn.btn-border-zephyr,
                    .entry-summary .wrap-btn-style a.btn-style:hover,
                    .social-share-wrap ul li a:hover,
                    .wpneo-tabs-menu li a:hover,
                    .product-timeline ul li,
                    .themeum-campaign-post h3 a:hover,
                    .overlay-btn,
                    .zephyr-post .content-item-title a:hover,
                    .zephyr-post .blog-post-meta li a,
                    .zephyr-post .blog-post-meta li,
                    .zephyr-widgets a:hover,.elementor-accordion-title.active .elementor-accordion-icon i,
                    .header-solid .common-menu-wrap .nav>li.active>a:after
                    { color: '. esc_attr($major_color) .'; }';
                }

                // CSS Background Color
                if($major_color){
                    $output .= '
                    .social-share ul li:hover,
                    .info-wrapper a.white,
                    .countdown-section,
                    .comingsoon-warper,
                    .wpmm_mobile_menu_btn,
                    .wpmm_mobile_menu_btn:hover,
                    .wpmm-gridcontrol-left:hover, 
                    .wpmm-gridcontrol-right:hover,
                    .portfolio-items .caption-full-width2 .overlay-cont a i,
                    .header-top .social-share ul li a:hover,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-item>a,
                    .mc4wp-form-fields button,
                    .woocommerce-tabs .wc-tabs>li.active:before,
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
                    .zephyr_wooshop_widgets .ui-slider-range,
                    .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
                    .woocommerce .widget_price_filter .ui-slider-horizontal,
                    .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
                    .order-view .label-info,
                    .widget .tagcloud a:hover,
                    .single_related:hover .overlay-content
                    { background: '. esc_attr($major_color) .'; }';

                } 

                // CSS Border
                if($major_color){
                    $output .= '
                    input:focus,
                    textarea:focus,
                    .wpmm-gridcontrol-left:hover, 
                    .wpmm-gridcontrol-right:hover,
                    keygen:focus,
                    select:focus,
                    .carousel-woocommerce .owl-nav .owl-next:hover,
                    .carousel-woocommerce .owl-nav .owl-prev:hover,
                    .themeum-latest-post-content .entry-title a:hover,
                    .common-menu-wrap .nav>li.current>a,
                    .header-solid .common-menu-wrap .nav>li.current>a,
                    .latest-review-single-layout2 .latest-post-title a:hover,
                    .blog-arrows a:hover,
                    .wpcf7-submit,
                    .themeum-pagination .page-numbers li a:hover,
                    .themeum-pagination .page-numbers li span.current,
                    .woocommerce nav.woocommerce-pagination ul li a:hover,
                    .woocommerce nav.woocommerce-pagination ul li span.current,
                    .wpcf7-form input:focus,
                    .btn.btn-border-zephyr,
                    .btn.btn-border-white:hover,
                    .info-wrapper a.white:hover
                    { border-color: '. esc_attr($major_color) .'; }';
                }

                // CSS Background Color & Border
                if($major_color){
                    $output .= '    
                    .wpcf7-submit:hover,
                    
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
                    .comingsoon .mc4wp-form-fields input[type=submit]
                    {   background-color: '. esc_attr($major_color) .'; border-color: '. esc_attr($major_color) .'; }';
                }

            }

            // Custom Color
            if( get_theme_mod( 'custom_preset_en', true ) ) {
                $hover_color = get_theme_mod( 'hover_color', '#4eaf1e' );
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
        if ( get_theme_mod( 'body_google_font', 'Roboto' ) ) { $bstyle .= 'font-family:'.get_theme_mod( 'body_google_font', 'Roboto' ).';'; }
        if ( get_theme_mod( 'body_font_weight', '400' ) ) { $bstyle .= 'font-weight: '.get_theme_mod( 'body_font_weight', '400' ).';'; }
        if ( get_theme_mod('body_font_height', '24') ) { $bstyle .= 'line-height: '.get_theme_mod('body_font_height', '24').'px;'; }
        if ( get_theme_mod('body_font_color', '#7d91aa') ) { $bstyle .= 'color: '.get_theme_mod('', '#7d91aa').';'; }

        //menu
        $mstyle = '';
        if ( get_theme_mod( 'menu_font_size', '16' ) ) { $mstyle .= 'font-size:'.get_theme_mod( 'menu_font_size', '16' ).'px;'; }
        if ( get_theme_mod( 'menu_google_font', 'Roboto' ) ) { $mstyle .= 'font-family:'.get_theme_mod( 'menu_google_font', 'Roboto' ).';'; }
        if ( get_theme_mod( 'menu_font_weight', '300' ) ) { $mstyle .= 'font-weight: '.get_theme_mod( 'menu_font_weight', '300' ).';'; }
        if ( get_theme_mod('menu_font_height', '54') ) { $mstyle .= 'line-height: '.get_theme_mod('menu_font_height', '54').'px;'; }
        if ( get_theme_mod('menu_font_color', '#191919') ) { $mstyle .= 'color: '.get_theme_mod('menu_font_color', '#191919').';'; }

        //heading1
        $h1style = '';
        if ( get_theme_mod( 'h1_font_size', '42' ) ) { $h1style .= 'font-size:'.get_theme_mod( 'h1_font_size', '42' ).'px;'; }
        if ( get_theme_mod( 'h1_google_font', 'Roboto' ) ) { $h1style .= 'font-family:'.get_theme_mod( 'h1_google_font', 'Roboto' ).';'; }
        if ( get_theme_mod( 'h1_font_weight', '600' ) ) { $h1style .= 'font-weight: '.get_theme_mod( 'h1_font_weight', '700' ).';'; }
        if ( get_theme_mod('h1_font_height', '42') ) { $h1style .= 'line-height: '.get_theme_mod('h1_font_height', '42').'px;'; }
        if ( get_theme_mod('h1_font_color', '#333') ) { $h1style .= 'color: '.get_theme_mod('h1_font_color', '#333').';'; }

        # heading2
        $h2style = '';
        if ( get_theme_mod( 'h2_font_size', '36' ) ) { $h2style .= 'font-size:'.get_theme_mod( 'h2_font_size', '36' ).'px;'; }
        if ( get_theme_mod( 'h2_google_font', 'Roboto' ) ) { $h2style .= 'font-family:'.get_theme_mod( 'h2_google_font', 'Roboto' ).';'; }
        if ( get_theme_mod( 'h2_font_weight', '600' ) ) { $h2style .= 'font-weight: '.get_theme_mod( 'h2_font_weight', '600' ).';'; }
        if ( get_theme_mod('h2_font_height', '36') ) { $h2style .= 'line-height: '.get_theme_mod('h2_font_height', '36').'px;'; }
        if ( get_theme_mod('h2_font_color', '#222538') ) { $h2style .= 'color: '.get_theme_mod('h2_font_color', '#222538').';'; }

        //heading3
        $h3style = '';
        if ( get_theme_mod( 'h3_font_size', '26' ) ) { $h3style .= 'font-size:'.get_theme_mod( 'h3_font_size', '26' ).'px;'; }
        if ( get_theme_mod( 'h3_google_font', 'Roboto' ) ) { $h3style .= 'font-family:'.get_theme_mod( 'h3_google_font', 'Roboto' ).';'; }
        if ( get_theme_mod( 'h3_font_weight', '600' ) ) { $h3style .= 'font-weight: '.get_theme_mod( 'h3_font_weight', '600' ).';'; }
        if ( get_theme_mod('h3_font_height', '28') ) { $h3style .= 'line-height: '.get_theme_mod('h3_font_height', '28').'px;'; }
        if ( get_theme_mod('h3_font_color', '#222538') ) { $h3style .= 'color: '.get_theme_mod('h3_font_color', '#222538').';'; }

        //heading4
        $h4style = '';
        if ( get_theme_mod( 'h4_font_size', '18' ) ) { $h4style .= 'font-size:'.get_theme_mod( 'h4_font_size', '18' ).'px;'; }
        if ( get_theme_mod( 'h4_google_font', 'Roboto' ) ) { $h4style .= 'font-family:'.get_theme_mod( 'h4_google_font', 'Roboto' ).';'; }
        if ( get_theme_mod( 'h4_font_weight', '600' ) ) { $h4style .= 'font-weight: '.get_theme_mod( 'h4_font_weight', '600' ).';'; }
        if ( get_theme_mod('h4_font_height', '26') ) { $h4style .= 'line-height: '.get_theme_mod('h4_font_height', '26').'px;'; }
        if ( get_theme_mod('h4_font_color', '#222538') ) { $h4style .= 'color: '.get_theme_mod('h4_font_color', '#222538').';'; }

        //heading5
        $h5style = '';
        if ( get_theme_mod( 'h5_font_size', '14' ) ) { $h5style .= 'font-size:'.get_theme_mod( 'h5_font_size', '14' ).'px;'; }
        if ( get_theme_mod( 'h5_google_font', 'Roboto' ) ) { $h5style .= 'font-family:'.get_theme_mod( 'h5_google_font', 'Roboto' ).';'; }
        if ( get_theme_mod( 'h5_font_weight', '600' ) ) { $h5style .= 'font-weight: '.get_theme_mod( 'h5_font_weight', '600' ).';'; }
        if ( get_theme_mod('h5_font_height', '26') ) { $h5style .= 'line-height: '.get_theme_mod('h5_font_height', '26').'px;'; }
        if ( get_theme_mod('h5_font_color', '#222538') ) { $h5style .= 'color: '.get_theme_mod('h5_font_color', '#222538').';'; }

        $output .= 'body{'.$bstyle.'}';
        $output .= '.common-menu-wrap .nav>li>a{'.$mstyle.'}';
        $output .= 'h1{'.$h1style.'}';
        $output .= 'h2{'.$h2style.'}';
        $output .= 'h3{'.$h3style.'}';
        $output .= 'h4{'.$h4style.'}';
        $output .= 'h5{'.$h5style.'}';

        //Topbar
         $output .= '.header-top{ background-color: '.esc_attr( get_theme_mod( 'topbar_bg', '#151515' ) ) .'; }';
        
        //Header

        $header_bgc = get_post_meta( get_the_ID() , 'themeum_header_bgc', true );

        if($header_bgc){
            $output .= '.site-header{ background-color: '. $header_bgc .'; }';
        }elseif(get_theme_mod( 'header_color', '#768d94' )){
            $output .= '.site-header{ background-color: '.esc_attr( get_theme_mod( 'header_color', '#151515' ) ) .'; }';
        }


        $headerlayout = get_theme_mod( 'head_style', 'transparent' );
        $header_style = get_post_meta( get_the_ID(), "themeum_header_style", true );
        if($header_style){
            if($header_style == 'transparent_header'){
                $headerlayout =  'transparent';
            }else{
                $headerlayout =  'solid';
            }
        }

        if($headerlayout == 'solid'){
            // $output .= '#main{ padding-top: 75px;}';
            $output .= '#main{ padding-top: '. (int) esc_attr( get_theme_mod( 'content_padding_top', '75' ) ) .'px; }';
        }

        // Header Transparent
        if ( $headerlayout == 'transparent' ){
            $output .= '.site-header{ background-color: transparent;}';
        }

        $output .= '.site-header{ padding-top: '. (int) esc_attr( get_theme_mod( 'header_padding_top', '0' ) ) .'px; }';
        $output .= '.site-header{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'header_padding_bottom', '0' ) ) .'px; }';
        $output .= '.site-header{ margin-bottom: '. (int) esc_attr( get_theme_mod( 'header_margin_bottom', '0' ) ) .'px; }';

        //sticky Header
        if ( get_theme_mod( 'header_fixed', false ) ){
            $output .= '.site-header.sticky{ position:fixed;top:0;left:auto; z-index:99999;margin:0 auto; width:100%;}';
            $output .= '.site-header.sticky.header-transparent .main-menu-wrap{ margin-top: 0;}';
            if ( get_theme_mod( 'sticky_header_color', '#768d94' ) ){
                $sticybg = get_theme_mod( 'sticky_header_color', '#768d94');
                $output .= '.site-header.sticky{ background-color: '.$sticybg.';}';
            }
        }

        //logo
        $output .= '.themeum-navbar-header .themeum-navbar-brand img{width:'.get_theme_mod( 'logo_width').'px; max-width:none;}';
        if (get_theme_mod( 'logo_height' )) {
            $output .= '.themeum-navbar-header .themeum-navbar-brand img{height:'.get_theme_mod( 'logo_height' ).'px;}';
        }

        // sub header
        $output .= '.subtitle-cover h2{font-size:'.get_theme_mod( 'sub_header_title_size', '50' ).'px;color:'.get_theme_mod( 'sub_header_title_color', '#fff' ).';}';
        $output .= '.breadcrumb>li+li:before, .subtitle-cover .breadcrumb, .subtitle-cover .breadcrumb>.active{color:'.get_theme_mod( 'breadcrumb_text_color', '#000' ).';}';
        $output .= '.subtitle-cover .breadcrumb a{color:'.get_theme_mod( 'breadcrumb_link_color', '#000' ).';}';
        $output .= '.subtitle-cover .breadcrumb a:hover{color:'.get_theme_mod( 'breadcrumb_link_color_hvr', '#000' ).';}';
        $output .= '.subtitle-cover{padding:'.get_theme_mod( 'sub_header_padding_top', '130' ).'px 0 '.get_theme_mod( 'sub_header_padding_bottom', '50' ).'px; margin-bottom: '.get_theme_mod( 'sub_header_margin_bottom', '0' ).'px;}';

        //body
        if (get_theme_mod( 'body_bg_img')) {
            $output .= 'body{ background-image: url("'.esc_attr( get_theme_mod( 'body_bg_img' ) ) .'");background-size: '.esc_attr( get_theme_mod( 'body_bg_size', 'cover' ) ) .';    background-position: '.esc_attr( get_theme_mod( 'body_bg_position', 'left top' ) ) .';background-repeat: '.esc_attr( get_theme_mod( 'body_bg_repeat', 'no-repeat' ) ) .';background-attachment: '.esc_attr( get_theme_mod( 'body_bg_attachment', 'fixed' ) ) .'; }';
        }
        $output .= 'body{ background-color: '.esc_attr( get_theme_mod( 'body_bg_color', '#f7f9fb' ) ) .'; }';



        // Button color setting...
        $output .= 'input[type=submit],input[type="button"].wpneo-image-upload,
                    input[type="button"].wpneo-image-upload-btn,input[type="button"]#addreward,.wpneo-edit-btn,
                    .wpneo-image-upload.float-right,.wpneo-save-btn,.wpneo-cancel-btn,
                    .dashboard-btn-link,#wpneo_active_edit_form,#addcampaignupdate,
                    .wpneo_donate_button,.wpneo-profile-button,.select_rewards_button,
                    .woocommerce-page #payment #place_order,.btn.btn-white:hover,
                    .btn.btn-border-zephyr:hover,.btn.btn-border-white:hover,.woocommerce input.button,
                    input[type="submit"].wpneo-submit-campaign{ background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#65ca2d' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#65ca2d' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_text_color', '#fff' ) ) .' !important; border-radius: '.get_theme_mod( 'button_radius', 4 ).'px; }';

         $output .= '.zephyr-login-register a.zephyr-dashboard{ background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#65ca2d' ) ) .'; }';


        if ( get_theme_mod( 'button_hover_bg_color', '#4eaf1e' ) ) {
            $output .= 'input[type=submit]:hover,input[type="button"].wpneo-image-upload:hover,input[type="button"].wpneo-image-upload-btn:hover,
                input[type="button"]#addreward:hover,.wpneo-edit-btn:hover,
                .wpneo-image-upload.float-right:hover,.wpneo-save-btn:hover,
                .dashboard-btn-link:hover,#wpneo_active_edit_form:hover,#addcampaignupdate:hover,
                .wpneo_donate_button:hover,.wpneo-profile-button:hover,.select_rewards_button:hover,
            .woocommerce-page #payment #place_order:hover,
            input[type="submit"].wpneo-submit-campaign:hover{ background-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#4eaf1e' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#4eaf1e' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_hover_text_color', '#fff' ) ) .' !important; }';

            $output .= '.zephyr-login-register a.zephyr-dashboard:hover{ background-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#4eaf1e' ) ) .'; }';
        }

        //menu color
        if ( get_theme_mod( 'navbar_text_color', '#a3d3f1' ) ) {
            $output .= '.header-solid .common-menu-wrap .nav>li.menu-item-has-children:after, .header-borderimage .common-menu-wrap .nav>li.menu-item-has-children:after, .header-solid .common-menu-wrap .nav>li>a, .header-borderimage .common-menu-wrap .nav>li>a, .header-transparent .common-menu-wrap .nav>li>a,
            .header-transparent .common-menu-wrap .nav>li.menu-item-has-children > a:after,
            .header-solid .common-menu-wrap .nav>li>a:after, .header-borderimage .common-menu-wrap .nav>li>a:after,.zephyr-search{ color: '.esc_attr( get_theme_mod( 'navbar_text_color', '#ffffff' ) ) .'; }';
        }

        $output .= '.header-solid .common-menu-wrap .nav>li>a:hover, .header-borderimage .common-menu-wrap .nav>li>a:hover,.zephyr-login-register ul li a,.header-solid .common-menu-wrap .nav>li>a:hover:after, .header-borderimage .common-menu-wrap .nav>li>a:hover:after,
        .zephyr-search-wrap a.zephyr-search:hover{ color: '.esc_attr( get_theme_mod( 'navbar_hover_text_color', '#65ca2d' ) ) .'; }';

        $output .= '.header-solid .common-menu-wrap .nav>li.active>a, .common-menu-wrap .nav>li.current-menu-parent.menu-item-has-children > a:after, .header-borderimage .common-menu-wrap .nav>li.active>a{ color: '.esc_attr( get_theme_mod( 'navbar_active_text_color', '#65ca2d' ) ) .'; }';

        //submenu color
        $output .= '.common-menu-wrap .nav>li ul{ background-color: '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>ul li a,.common-menu-wrap .nav > li > ul li.mega-child > a{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color', '#191919' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'sub_menu_border', '#eef0f2' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>ul li a:hover,.common-menu-wrap .sub-menu > li.active > a,
        .common-menu-wrap .nav>li>ul li a:hover,
.common-menu-wrap .sub-menu li.active.mega-child a:hover{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color_hover', '#65ca2d' ) ) .';}';
        $output .= '.common-menu-wrap .nav>li > ul::after{ border-color: transparent transparent '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .' transparent; }';



        //bottom
        $output .= '#bottom-wrap{ background-color: '.esc_attr( get_theme_mod( 'bottom_color', '#f5f5f5' ) ) .'; }';
        $output .= '#bottom-wrap,.bottom-widget .widget h3.widget-title{ color: '.esc_attr( get_theme_mod( 'bottom_title_color', '#000' ) ) .'; }';
        $output .= '#bottom-wrap a{ color: '.esc_attr( get_theme_mod( 'bottom_link_color', '#808080' ) ) .'; }';
        $output .= '#bottom-wrap .zephyr-widgets .latest-widget-date, #bottom-wrap .bottom-widget ul li, div.about-desc{ color: '.esc_attr( get_theme_mod( 'bottom_text_color', '#808080' ) ) .'; }';
        $output .= '#bottom-wrap a:hover{ color: '.esc_attr( get_theme_mod( 'bottom_hover_color', '#65ca2d' ) ) .'; }';
        $output .= '#bottom-wrap{ padding-top: '. (int) esc_attr( get_theme_mod( 'bottom_padding_top', '80' ) ) .'px; }';
        $output .= '#bottom-wrap{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'bottom_padding_bottom', '45' ) ) .'px; }';


        //footer
        $output .= '#footer-wrap{ background-color: '.esc_attr( get_theme_mod( 'copyright_bg_color', '#2e2e2e' ) ) .'; }';
        $output .= '.footer-copyright { color: '.esc_attr( get_theme_mod( 'copyright_text_color', '#fff' ) ) .'; }';
        $output .= '.menu-footer-menu a{ color: '.esc_attr( get_theme_mod( 'copyright_link_color', '#fff' ) ) .'; }';
        $output .= '.menu-footer-menu a:hover{ color: '.esc_attr( get_theme_mod( 'copyright_hover_color', '#65ca2d' ) ) .'; }';
        $output .= '#footer-wrap{ padding-top: '. (int) esc_attr( get_theme_mod( 'copyright_padding_top', '25' ) ) .'px; }';
        $output .= '#footer-wrap{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'copyright_padding_bottom', '25' ) ) .'px; }';

        // 404 Page
        $output .= "body.error404,body.page-template-404{ width: 100%; height: 100%; min-height: 100%; }";

        return $output;
    }
}

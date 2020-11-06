<?php

/*-------------------------------------------------------
 *              Themeum Supports and Image Cut
 *-------------------------------------------------------*/
if(!function_exists('mythos_setup')): 

    function mythos_setup(){
        load_theme_textdomain( 'mythos-pro', get_template_directory() . '/languages' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'mythos-large', 1140, 570, true );
        add_image_size( 'mythos-medium', 362, 210, true );
        add_image_size( 'mythos-portfo', 600, 500, true );
        add_image_size( 'blog-small', 142, 99, true );
        add_image_size( 'portfo-small', 82, 64, true );
        add_theme_support( 'post-formats', array( 'audio','gallery','image','link','quote','video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );

        # Enable Custom Background.
        add_theme_support( 'custom-background' );

        # Enable Logo 
        add_theme_support( 'custom-logo' );

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Enqueue editor styles.
        add_editor_style( 'style-editor.css' );

        # Add support for font size.
        add_theme_support( 'editor-font-sizes', array(
            array(
                'name' => __( 'small', 'mythos-pro' ),
                'shortName' => __( 'S', 'mythos-pro' ),
                'size' => 16,
                'slug' => 'small'
            ),
            array(
                'name' => __( 'regular', 'mythos-pro' ),
                'shortName' => __( 'M', 'mythos-pro' ),
                'size' => 22,
                'slug' => 'regular'
            ),
            array(
                'name' => __( 'large', 'mythos-pro' ),
                'shortName' => __( 'L', 'mythos-pro' ),
                'size' => 28,
                'slug' => 'large'
            ),
            array(
                'name' => __( 'larger', 'mythos-pro' ),
                'shortName' => __( 'XL', 'mythos-pro' ),
                'size' => 38,
                'slug' => 'larger'
            )
        ) );


        if ( ! isset( $content_width ) ){
            $content_width = 660;
        }
    }
    add_action('after_setup_theme','mythos_setup');

endif;



/*-------------------------------------------------------
 *              Themeum Pagination
 *-------------------------------------------------------*/
if(!function_exists('mythos_pagination')):

    function mythos_pagination( $page_numb , $max_page ){
        $output = '';
        $big = 999999999;
        $output .= '<div class="themeum-pagination" data-preview="'.__( "Previous",'mythos-pro' ).'" data-nextview="'.__( "Next",'mythos-pro' ).'">';
        $output .= paginate_links( array(
            'base'          => esc_url_raw(str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) )),
            'format'        => '?paged=%#%',
            'current'       => $page_numb,
            'prev_text'     => __('Previous','mythos-pro'),
            'next_text'     => __('Next','mythos-pro'),
            'total'         => $max_page,
            'type'          => 'list',
        ) );
        $output .= '</div>';
        return $output;
    }

endif;


/*-------------------------------------------------------
 *              Themeum Comment
 *-------------------------------------------------------*/
if(!function_exists('mythos_comment')):

    function mythos_comment($comment, $args, $depth){
        // $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <?php
            break;
            default :
            // global $post;
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-body">
                <div class="comment-avartar pull-left">
                    <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
                </div>
                <div class="comment-context">
                    <div class="comment-head">
                        <?php echo '<span class="comment-author">' . get_the_author() . '</span>'; ?>
                        <span class="comment-date"><i class="far fa-calendar" aria-hidden="true"></i> <?php echo esc_attr(get_comment_date()); ?></span>
                        <?php edit_comment_link( esc_html__( 'Edit', 'mythos-pro' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'mythos-pro' ); ?></p>
                    <?php endif; ?>
                    <span class="comment-reply">
                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="fas fa-reply"></i> '.esc_html__( 'Reply', 'mythos-pro' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
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
*------------------------------------------------------ */
if ( get_theme_mod( 'comingsoon_en', false ) ) {
    if(!function_exists('mythos_my_page_template_redirect')):
        function mythos_my_page_template_redirect()
        {
            if( is_page() || is_home() || is_category() || is_single() )
            {
                if( !is_super_admin( get_current_user_id() ) ){
                    get_template_part( 'coming','soon');
                    exit();
                }
            }
        }
        add_action( 'template_redirect', 'mythos_my_page_template_redirect' );
    endif;

    if(!function_exists('mythos_cooming_soon_wp_title')):
        function mythos_cooming_soon_wp_title(){
            return 'Coming Soon';
        }
        add_filter( 'wp_title', 'mythos_cooming_soon_wp_title' );
    endif;
}




/*-----------------------------------------------------
 *              CSS Generator
 *----------------------------------------------------*/
if(!function_exists('mythos_css_generator')){
    function mythos_css_generator(){

        $output = '';

        $preset = get_theme_mod( 'preset', '1' );
        if( $preset ){

            if( get_theme_mod( 'custom_preset_en', true ) ) {

                // CSS Color
                $major_color = get_theme_mod( 'major_color', '#01c3ca' );
                $major_color2 = get_theme_mod( 'major_color2', '#00d3a7' );
                if($major_color){
                    $output .= '
                    a,
                    .bottom-widget .widget ul li a:hover,
                    #bottom-wrap .themeum-social-share a:hover, 
                    .woocommerce ul.product_list_widget span.product-title:hover,
                    .woocommerce .product .product-thumbnail-outer .product-content-wrapper h2:hover,
                    span.woocommerce-Price-amount.amount,
                    .page-numbers li span:hover, 
                    .themeum-pagination .page-numbers li a:hover, 
                    .page-numbers li .current:before, 
                    .product_list_widget span.woocommerce-Price-amount.amount, 
                    .page-subleading, 
                    .woocommerce .widget >ul.product-categories li:hover a, 
                    .woocommerce .widget >ul.product-categories li:hover span, 
                    .article-details h3.article-title a:hover, 
                    .rticle-introtext a.blog-btn-wrap, 
                    #sidebar .widget_categories ul li a:hover, 
                    .related-entries .relatedcontent h3 a:hover,
                    .section-content-second .article-details h3.article-title a:hover, 
                    .themeum-pagination .page-numbers li span.current, 
                    .page-numbers li a.page-numbers:hover, 
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
                    .mythos-post .blog-post-meta li a:hover,
                    .mythos-post .blog-post-meta li i,
                    .mythos-post .content-item-title a:hover,
                    .woocommerce ul.products li.product:hover .added_to_cart,
                    .woocommerce div.product p.price,
                    .woocommerce div.product span.price,
                    .product_meta .sku_wrapper span.sku,
                    .woocommerce-message::before,
                    .woocommerce a.remove,
                    .themeum-campaign-post .entry-category a:hover,
                    .themeum-campaign-post .entry-author a:hover,
                    .themeum-campaign-post h3 a:hover,
                    .themeum-woo-product-details .product-content h4 a:hover,
                    .wpneo-campaign-creator-details p:first-child a:hover,
                    #mobile-menu ul li.active>a,
                    #mobile-menu ul li a:hover,
                    .woocommerce .product .product-thumbnail-outer .product-content-wrapper a:hover,
                    .tab-rewards-wrapper h3,
                    ul.wpneo-crowdfunding-update li .wpneo-crowdfunding-update-title,
                    .btn.btn-border-mythos,
                    .entry-summary .wrap-btn-style a.btn-style:hover,
                    .social-share-wrap ul li a:hover,
                    .wpneo-tabs-menu li a:hover,
                    .product-timeline ul li,
                    .themeum-campaign-post h3 a:hover,
                    .overlay-btn,
                    .mythos-post .content-item-title a:hover,
                    .mythos-post .blog-post-meta li a,
                    .mythos-widgets a:hover,.elementor-accordion-title.active .elementor-accordion-icon i,
                    .header-solid .common-menu-wrap .nav>li.active>a:after,
                    .social-share ul li a:hover,
                    .portfolio-grid-title a:hover,
                    .topbar-menu .woocart a:hover,
                    .mythos h3.page-subleading,
                    .portfolio-cat a:hover,
                    .postblock-intro-in a:hover, .postblock-intro a:hover, .postblock-more, .woocommerce-mini-cart__total.total span.woocommerce-Price-amount.amount, .woocommerce.widget_shopping_cart .cart_list li a.remove,
                    .themeum-pagination .page-numbers li a.next.page-numbers:hover, .themeum-pagination .page-numbers li a.prev:hover,
                    .bottom-widget .mc4wp-form-fields button,
                    .widget_shopping_cart_content ul.woocommerce-mini-cart li a.remove,
                    .widget.woocommerce ul li a:hover, .widget_shopping_cart_content ul.woocommerce-mini-cart li.mini_cart_item, .woocommerce.widget_shopping_cart .total strong, .product_list_widget span.woocommerce-Price-amount.amount,
                    ul.wp-block-archives li a, .wp-block-categories li a, .wp-block-latest-posts li a { color: '. esc_attr($major_color) .'; }';
                }

                // CSS Background Color
                if($major_color){
                    $output .= '
                    .info-wrapper a.white,
                    .wpmm_mobile_menu_btn,
                    .wpmm_mobile_menu_btn:hover,
                    .wpmm-gridcontrol-left:hover, 
                    .wpmm-gridcontrol-right:hover,
                    .portfolio-items .caption-full-width2 .overlay-cont a i,
                    .header-top .social-share ul li a:hover,
                    .woocommerce-tabs .wc-tabs>li.active:before,
                    .project-navigator a.prev:hover,
                    .project-navigator a.next:hover,
                    .woocommerce #respond input#submit:hover,
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
                    .mythos_wooshop_widgets .ui-slider-range,
                    .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
                    .woocommerce .widget_price_filter .ui-slider-horizontal,
                    .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
                    .order-view .label-info,
                    .widget .tagcloud a:hover,
                    .single_related:hover .overlay-content,.page-numbers li .current:before
                    { background: '. esc_attr($major_color) .'; }';

                } 


                # Background 
                if($major_color && $major_color2){
                    $gradient_angle = 90;
                    if(!empty($major_color2)){
                        $output .= "
                        .woocommerce input.button, .woocommerce a.button, 
                        .woocommerce div.product form.cart .button, 
                        #pa_size_buttons .variation_button.selected, 
                        .woocommerce-page .woocommerce-message .button, 
                        button.woocommerce-form-login__submit, 
                        body.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a, 
                        body.woocommerce-account .woocommerce-MyAccount-navigation ul li:hover a, 
                        form.woocommerce-EditAccountForm button.woocommerce-Button, 
                        .call-to-action a.btn.btn2, #menu-main-menu .woocart .woocommerce-mini-cart__buttons.buttons a,
                        .woocommerce input.button, .woocommerce a.button, .woocommerce div.product form.cart .button, #pa_size_buttons .variation_button.selected, .woocommerce-page .woocommerce-message .button, button.woocommerce-form-login__submit, body.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a, body.woocommerce-account .woocommerce-MyAccount-navigation ul li:hover a, form.woocommerce-EditAccountForm button.woocommerce-Button, .call-to-action a.btn.btn2, .woocart span.woo-cart-items, .woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce ul.woocommerce-widget-layered-nav-list li a:hover, #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-parent>a, #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-ancestor>a, #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li>a:hover, .wp-megamenu-wrap .wpmm-nav-wrap > ul.wp-megamenu > li.wpmm_dropdown_menu:hover {
                        background-image: linear-gradient({$gradient_angle}deg, $major_color, $major_color2)!important};
                    ";
                    }
                }

                // CSS Border
                if($major_color){
                    $output .= '
                    input:focus,
                    .call-to-action a.btn, 
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
                    .woocommerce nav.woocommerce-pagination ul li a:hover,
                    .woocommerce nav.woocommerce-pagination ul li span.current,
                    .wpcf7-form input:focus,
                    .btn.btn-border-mythos,
                    .btn.btn-border-white:hover,
                    .info-wrapper a.white:hover,
                    .portfolio-cat a:hover, .bottom-widget .mc4wp-form input[type="email"]:focus
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
                    .comingsoon .mc4wp-form-fields input[type=submit],
                    {   background-color: '. esc_attr($major_color) .'; border-color: '. esc_attr($major_color) .'; }';
                }

            }

            // Custom Color
            if( get_theme_mod( 'custom_preset_en', true ) ) {
                $hover_color = get_theme_mod( 'hover_color', '#04a9af' );
                if( $hover_color ){
                    $output .= 'a:hover,
                    .widget.widget_rss ul li a,
                    .footer-copyright a:hover,
                    .entry-summary .wrap-btn-style a.btn-style:hover{ color: '.esc_attr( $hover_color ) .'; }';
                    
                    $output .= '.error-page-inner a.btn.btn-primary.btn-lg:hover,
                    input[type=button]:hover,
                    .widget.widget_search #searchform .btn-search:hover,
                    .woocommerce #respond input#submit.alt:hover,
                     .woocommerce a.button.alt:hover,
                     .woocommerce button.button.alt:hover,
                     .woocommerce input.button.alt:hover,
                     .order-view .label-info:hover
                     { background-color: '.esc_attr( $hover_color ) .'; }';

                    $output .= '.woocommerce a.button:hover, .bottom-widget .mc4wp-form input[type="email"]:focus{ border-color: '.esc_attr( $hover_color ) .'; }';
                }
            }
        }

        $bstyle = $mstyle = $h1style = $h2style = $h3style = $h4style = $h5style = '';
        //body
        if ( get_theme_mod( 'body_font_size', '14' ) ) { $bstyle .= 'font-size:'.get_theme_mod( 'body_font_size', '14' ).'px;'; }
        if ( get_theme_mod( 'body_google_font', 'Open Sans' ) ) { $bstyle .= 'font-family:'.get_theme_mod( 'body_google_font', 'Open Sans' ).';'; }
        if ( get_theme_mod( 'body_font_weight', '400' ) ) { $bstyle .= 'font-weight: '.get_theme_mod( 'body_font_weight', '400' ).';'; }
        if ( get_theme_mod('body_font_height', '27') ) { $bstyle .= 'line-height: '.get_theme_mod('body_font_height', '27').'px;'; }
        if ( get_theme_mod('body_font_color', '#7d91aa') ) { $bstyle .= 'color: '.get_theme_mod('', '#7d91aa').';'; }
        
        //menu
        $mstyle = '';
        if ( get_theme_mod( 'menu_font_size', '14' ) ) { $mstyle .= 'font-size:'.get_theme_mod( 'menu_font_size', '14' ).'px;'; }
        if ( get_theme_mod( 'menu_google_font', 'Open Sans' ) ) { $mstyle .= 'font-family:'.get_theme_mod( 'menu_google_font', 'Open Sans' ).';'; }
        if ( get_theme_mod( 'menu_font_weight', '700' ) ) { $mstyle .= 'font-weight: '.get_theme_mod( 'menu_font_weight', '700' ).';'; }
        if ( get_theme_mod('menu_font_height', '54') ) { $mstyle .= 'line-height: '.get_theme_mod('menu_font_height', '54').'px;'; }
        if ( get_theme_mod('menu_font_color', '#fff') ) { $mstyle .= 'color: '.get_theme_mod('menu_font_color', '#fff').';'; }

        //heading1
        $h1style = '';
        if ( get_theme_mod( 'h1_font_size', '44' ) ) { $h1style .= 'font-size:'.get_theme_mod( 'h1_font_size', '44' ).'px;'; }
        if ( get_theme_mod( 'h1_google_font', 'Open Sans' ) ) { $h1style .= 'font-family:'.get_theme_mod( 'h1_google_font', 'Open Sans' ).';'; }
        if ( get_theme_mod( 'h1_font_weight', '600' ) ) { $h1style .= 'font-weight: '.get_theme_mod( 'h1_font_weight', '600' ).';'; }
        if ( get_theme_mod('h1_font_height', '42') ) { $h1style .= 'line-height: '.get_theme_mod('h1_font_height', '42').'px;'; }
        if ( get_theme_mod('h1_font_color', '#151416') ) { $h1style .= 'color: '.get_theme_mod('h1_font_color', '#151416').';'; }
        
        # heading2
        $h2style = '';
        if ( get_theme_mod( 'h2_font_size', '30' ) ) { $h2style .= 'font-size:'.get_theme_mod( 'h2_font_size', '30' ).'px;'; }
        if ( get_theme_mod( 'h2_google_font', 'Open Sans' ) ) { $h2style .= 'font-family:'.get_theme_mod( 'h2_google_font', 'Open Sans' ).';'; }
        if ( get_theme_mod( 'h2_font_weight', '600' ) ) { $h2style .= 'font-weight: '.get_theme_mod( 'h2_font_weight', '600' ).';'; }
        if ( get_theme_mod('h2_font_height', '36') ) { $h2style .= 'line-height: '.get_theme_mod('h2_font_height', '36').'px;'; }
        if ( get_theme_mod('h2_font_color', '#151416') ) { $h2style .= 'color: '.get_theme_mod('h2_font_color', '#151416').';'; }
        
        //heading3
        $h3style = '';
        if ( get_theme_mod( 'h3_font_size', '22' ) ) { $h3style .= 'font-size:'.get_theme_mod( 'h3_font_size', '22' ).'px;'; }
        if ( get_theme_mod( 'h3_google_font', 'Open Sans' ) ) { $h3style .= 'font-family:'.get_theme_mod( 'h3_google_font', 'Open Sans' ).';'; }
        if ( get_theme_mod( 'h3_font_weight', '600' ) ) { $h3style .= 'font-weight: '.get_theme_mod( 'h3_font_weight', '600' ).';'; }
        if ( get_theme_mod('h3_font_height', '28') ) { $h3style .= 'line-height: '.get_theme_mod('h3_font_height', '28').'px;'; }
        if ( get_theme_mod('h3_font_color', '#151416') ) { $h3style .= 'color: '.get_theme_mod('h3_font_color', '#151416').';'; }
        
        //heading4
        $h4style = '';
        if ( get_theme_mod( 'h4_font_size', '17' ) ) { $h4style .= 'font-size:'.get_theme_mod( 'h4_font_size', '17' ).'px;'; }
        if ( get_theme_mod( 'h4_google_font', 'Open Sans' ) ) { $h4style .= 'font-family:'.get_theme_mod( 'h4_google_font', 'Open Sans' ).';'; }
        if ( get_theme_mod( 'h4_font_weight', '600' ) ) { $h4style .= 'font-weight: '.get_theme_mod( 'h4_font_weight', '600' ).';'; }
        if ( get_theme_mod('h4_font_height', '26') ) { $h4style .= 'line-height: '.get_theme_mod('h4_font_height', '26').'px;'; }
        if ( get_theme_mod('h4_font_color', '#151416') ) { $h4style .= 'color: '.get_theme_mod('h4_font_color', '#151416').';'; }
        
        //heading5
        $h5style = '';
        if ( get_theme_mod( 'h5_font_size', '14' ) ) { $h5style .= 'font-size:'.get_theme_mod( 'h5_font_size', '14' ).'px;'; }
        if ( get_theme_mod( 'h5_google_font', 'Open Sans' ) ) { $h5style .= 'font-family:'.get_theme_mod( 'h5_google_font', 'Open Sans' ).';'; }
        if ( get_theme_mod( 'h5_font_weight', '600' ) ) { $h5style .= 'font-weight: '.get_theme_mod( 'h5_font_weight', '600' ).';'; }
        if ( get_theme_mod('h5_font_height', '26') ) { $h5style .= 'line-height: '.get_theme_mod('h5_font_height', '26').'px;'; }
        if ( get_theme_mod('h5_font_color', '#151416') ) { $h5style .= 'color: '.get_theme_mod('h5_font_color', '#151416').';'; }
        

        $output .= 'body.body-content, .editor-block-list__block, .editor-post-title__block .editor-post-title__input{'.$bstyle.'}';
        $output .= '.common-menu-wrap .nav>li>a{'.$mstyle.'}';
        $output .= '.body-content h1, .edit-post-visual-editor .editor-block-list__block h1{'.$h1style.'}';
        $output .= '.body-content h2, .edit-post-visual-editor .editor-block-list__block h2{'.$h2style.'}';
        $output .= '.body-content h3, .edit-post-visual-editor .editor-block-list__block h3{'.$h3style.'}';
        $output .= '.body-content h4, .edit-post-visual-editor .editor-block-list__block h4{'.$h4style.'}';
        $output .= '.body-content h5, .edit-post-visual-editor .editor-block-list__block h5{'.$h5style.'}';

        //Topbar
        $output .= '.topbar-contact a, .social-share ul li a{ color: '.esc_attr( get_theme_mod( 'topbar_text_color', '#cacaca' ) ) .'; }';

        //Header
        $header_bgc = get_post_meta( get_the_ID() , 'themeum_header_color', true );

        if($header_bgc){
            $output .= '#wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li>a{ color: '. $header_bgc .'; }';
        }


        $headerlayout = get_theme_mod( 'head_style', 'white' );
        $menu_border_c = get_theme_mod( 'menu_border_color', '#fff' );
        
        // $header_style = get_post_meta( get_the_ID(), "themeum_header_style", true );
        // if($header_style){
        //     if($header_style == 'white_color'){
        //         $headerlayout =  'white';
        //     }else{
        //         $headerlayout =  'dark';
        //     }
        // }

        // Header Transparent
        if ( $menu_border_c ){
            $output .= '.wp-megamenu-wrap .wpmm-nav-wrap > ul.wp-megamenu > li.wpmm_dropdown_menu, 
            #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu li:last-child, 
            .wp-megamenu-wrap .wpmm-nav-wrap > ul.wp-megamenu > li.menu-item-has-children, .wp-megamenu-wrap .wpmm-nav-wrap > ul.wp-megamenu > li.wpmm_mega_menu, 
            .wp-megamenu-wrap .wpmm-nav-wrap > ul.wp-megamenu > li.wpmm_dropdown_menu.wpmm-logo-item:hover, .wp-megamenu-wrap .wpmm-nav-wrap > ul.wp-megamenu > li.wpmm_dropdown_menu.wpmm-logo-item, .wp-megamenu-wrap .wpmm-nav-wrap > ul.wp-megamenu > li.wpmm_dropdown_menu:last-child{ border-color: '.esc_attr($menu_border_c).'}';
        }
        $output .= '.site-header{ margin-bottom: '. (int) esc_attr( get_theme_mod( 'header_margin_bottom', '0' ) ) .'px; }';

        //sticky Header
        if ( get_theme_mod( 'header_fixed', false ) ){
            $output .= '.site-header.sticky.header-transparent .main-menu-wrap{ margin-top: 0;}';
            if ( get_theme_mod( 'sticky_header_color', '#768d94' ) ){
                $sticybg = get_theme_mod( 'sticky_header_color', '#768d94');
                $output .= '.site-header.sticky{ background-color: '.esc_attr($sticybg).';}';
            }
        }

        //logo
        $output .= '.themeum-navbar-header .themeum-navbar-brand img{width:'.esc_attr(get_theme_mod( 'logo_width')).'px; max-width:none;}';
        if (get_theme_mod( 'logo_height' )) {
            $output .= '.themeum-navbar-header .themeum-navbar-brand img{height:'.esc_attr(get_theme_mod( 'logo_height' )).'px;}';
        }

        // sub header
        $output .= '.subtitle-cover h2{font-size:'.esc_attr(get_theme_mod( 'sub_header_title_size', '13' )).'px;color:'.esc_attr(get_theme_mod( 'sub_header_title_color', '#7e879a' )).';}';
        $output .= '.breadcrumb>li+li:before, .subtitle-cover .breadcrumb, .subtitle-cover .breadcrumb>.active{color:'.esc_attr(get_theme_mod( 'breadcrumb_text_color', '#000' )).';}';
        $output .= '.subtitle-cover .breadcrumb a{color:'.esc_attr(get_theme_mod( 'breadcrumb_link_color', '#000' )).';}';
        $output .= '.subtitle-cover .breadcrumb a:hover{color:'.esc_attr(get_theme_mod( 'breadcrumb_link_color_hvr', '#000' )).';}';
        $output .= '.subtitle-cover{padding:'.esc_attr(get_theme_mod( 'sub_header_padding_top', '140' )).'px 0 '.esc_attr(get_theme_mod( 'sub_header_padding_bottom', '0' )).'px; }';

        //body
        if (get_theme_mod( 'body_bg_img')) {
            $output .= 'body{ background-image: url("'.esc_attr( get_theme_mod( 'body_bg_img' ) ) .'");background-size: '.esc_attr( get_theme_mod( 'body_bg_size', 'cover' ) ) .';    background-position: '.esc_attr( get_theme_mod( 'body_bg_position', 'left top' ) ) .';background-repeat: '.esc_attr( get_theme_mod( 'body_bg_repeat', 'no-repeat' ) ) .';background-attachment: '.esc_attr( get_theme_mod( 'body_bg_attachment', 'fixed' ) ) .'; }';
        }
        $output .= 'body{ background-color: '.esc_attr( get_theme_mod( 'body_bg_color', '#fff' ) ) .'; }';

        // Button color setting...
        $output .= 'input[type=submit],input[type="button"].wpneo-image-upload,
                    input[type="button"].wpneo-image-upload-btn,input[type="button"]#addreward,.wpneo-edit-btn,
                    .wpneo-image-upload.float-right,.wpneo-save-btn,.wpneo-cancel-btn,
                    .dashboard-btn-link,#wpneo_active_edit_form,#addcampaignupdate,
                    .wpneo_donate_button,.wpneo-profile-button,.select_rewards_button,
                    .woocommerce-page #payment #place_order,.btn.btn-white:hover,
                    .btn.btn-border-mythos:hover,.btn.btn-border-white:hover,.woocommerce input.button,
                input[type="submit"].wpneo-submit-campaign{ background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#01c3ca' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#01c3ca' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_text_color', '#fff' ) ) .' !important; border-radius: '.esc_attr(get_theme_mod( 'button_radius', 4 )).'px; }';
        $output .= '.mythos-login-register a.mythos-dashboard, .mythos-widgets span.blog-cat:before, #sidebar h3.widget_title:before{ background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#01c3ca' ) ) .'; }';

        // Background hover color
        if ( get_theme_mod( 'button_hover_bg_color', '#04a9af' ) ) {
            $output .= 'input[type=submit]:hover,input[type="button"].wpneo-image-upload:hover,input[type="button"].wpneo-image-upload-btn:hover,
                input[type="button"]#addreward:hover,.wpneo-edit-btn:hover,
                .wpneo-image-upload.float-right:hover,.wpneo-save-btn:hover,
                .dashboard-btn-link:hover,#wpneo_active_edit_form:hover,#addcampaignupdate:hover,
                .wpneo_donate_button:hover,.wpneo-profile-button:hover,.select_rewards_button:hover,
            .woocommerce-page #payment #place_order:hover,
            input[type="submit"].wpneo-submit-campaign:hover{ background-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#04a9af' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#04a9af' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_hover_text_color', '#fff' ) ) .' !important; }';

            $output .= '.mythos-login-register a.mythos-dashboard:hover{ background-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#04a9af' ) ) .'; }';
        }

        //menu color
        if ( get_theme_mod( 'navbar_text_color', '#fff' ) ) {
            $output .= '.header-solid .common-menu-wrap .nav>li.menu-item-has-children:after, .header-borderimage .common-menu-wrap .nav>li.menu-item-has-children:after, .header-solid .common-menu-wrap .nav>li>a, .header-borderimage .common-menu-wrap .nav>li>a, .header-transparent .common-menu-wrap .nav>li>a,
            .header-transparent .common-menu-wrap .nav>li.menu-item-has-children > a:after,
            .header-solid .common-menu-wrap .nav>li>a:after, .header-borderimage .common-menu-wrap .nav>li>a:after,.mythos-search{ color: '.esc_attr( get_theme_mod( 'navbar_text_color', '#ffffff' ) ) .'; }';
        }

        $output .= '.header-solid .common-menu-wrap .nav>li>a:hover, .header-borderimage .common-menu-wrap .nav>li>a:hover,.mythos-login-register ul li a,.header-solid .common-menu-wrap .nav>li>a:hover:after, .header-borderimage .common-menu-wrap .nav>li>a:hover:after,
        .mythos-search-wrap a.mythos-search:hover{ color: '.esc_attr( get_theme_mod( 'navbar_hover_text_color', '#02c0d0' ) ) .'; }';

        $output .= '.header-solid .common-menu-wrap .nav>li.active>a, .common-menu-wrap .nav>li.current-menu-parent.menu-item-has-children > a:after, .header-borderimage .common-menu-wrap .nav>li.active>a{ color: '.esc_attr( get_theme_mod( 'navbar_active_text_color', '#02c0d0' ) ) .'; }';

        //submenu color
        $output .= '.common-menu-wrap .nav>li ul{ background-color: '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>ul li a,.common-menu-wrap .nav > li > ul li.mega-child > a{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color', '#191919' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'sub_menu_border', '#eef0f2' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>ul li a:hover,.common-menu-wrap .sub-menu > li.active > a,
        .common-menu-wrap .nav>li>ul li a:hover,
        .common-menu-wrap .sub-menu li.active.mega-child a:hover{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color_hover', '#01c3ca' ) ) .';}';
        $output .= '.common-menu-wrap .nav>li > ul::after{ border-color: transparent transparent '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .' transparent; }';



        //bottom
        $output .= '#bottom-wrap{ background-color: '.esc_attr( get_theme_mod( 'bottom_color', '#21223f' ) ) .'; }';
        $output .= '#bottom-wrap,.bottom-widget .widget h3.widget-title{ color: '.esc_attr( get_theme_mod( 'bottom_title_color', '#fff' ) ) .'; }';
        $output .= '#bottom-wrap a, #menu-footer-menu li a{ color: '.esc_attr( get_theme_mod( 'bottom_link_color', '#a8a9c4' ) ) .'; }';
        $output .= '#bottom-wrap .mythos-widgets .latest-widget-date, #bottom-wrap .bottom-widget ul li, div.about-desc, .bottom-widget .textwidget p{ color: '.esc_attr( get_theme_mod( 'bottom_text_color', '#a8a9c4' ) ) .'; }';
        $output .= '#bottom-wrap a:hover{ color: '.esc_attr( get_theme_mod( 'bottom_hover_color', '#fff' ) ) .'; }';
        $output .= '#bottom-wrap{ padding-top: '. (int) esc_attr( get_theme_mod( 'bottom_padding_top', '70' ) ) .'px; }';
        $output .= '#bottom-wrap{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'bottom_padding_bottom', '0' ) ) .'px; }';


        //footer
        $output .= '#footer-wrap{ background-color: '.esc_attr( get_theme_mod( 'copyright_bg_color', '#21223f' ) ) .'; }';
        $output .= '.footer-copyright, span.footer-theme-design { color: '.esc_attr( get_theme_mod( 'copyright_text_color', '#fff' ) ) .'; }';
        $output .= '.menu-footer-menu a{ color: '.esc_attr( get_theme_mod( 'copyright_link_color', '#fff' ) ) .'; }';
        $output .= '.menu-footer-menu a:hover{ color: '.esc_attr( get_theme_mod( 'copyright_hover_color', '#01c3ca' ) ) .'; }';
        $output .= '#footer-wrap{ padding-top: '. (int) esc_attr( get_theme_mod( 'copyright_padding_top', '25' ) ) .'px; }';
        $output .= '#footer-wrap{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'copyright_padding_bottom', '25' ) ) .'px; }';


        # 404 page.
        $output .= "body.error404, body.page-template-404{
            width: 100%;
            height: 100%;
            min-height: 100%;
            background-image: linear-gradient(288deg, #00d3a7, #02c0d0);
            background-size: contain;
        }";

        $coming_soon_bg = get_theme_mod('coming_soon_bg', get_template_directory_uri().'/images/coming-soon-bg.jpg');

        # 404 page.
        $output .= ".coming-soon-main-wrap{
            width: 100%;
            height: 100%;
            min-height: 100%;
            background-image: url(".esc_url($coming_soon_bg).");
            background-size: cover;
            background-repeat: no-repeat;
        }";


        return $output;
    }
}

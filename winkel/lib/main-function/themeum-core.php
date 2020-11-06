<?php

/*-------------------------------------------------------
 *              Themeum Supports and Image Cut
 *-------------------------------------------------------*/
if(!function_exists('winkel_setup')):

    function winkel_setup(){
        load_theme_textdomain( 'winkel', get_template_directory() . '/languages' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'winkel-large', 1140, 570, true );
        add_image_size( 'winkel-blog-medium', 352, 197, true );
        add_theme_support( 'post-formats', array( 'audio','gallery','image','link','video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );
        if ( ! isset( $content_width ) ){
            $content_width = 660;
        }
    }
    add_action('after_setup_theme','winkel_setup');

endif;

/*-------------------------------------------------------
 *              Themeum Pagination
 *-------------------------------------------------------*/
if(!function_exists('winkel_pagination')):

    function winkel_pagination( $page_numb , $max_page ){
        $big = 999999999;
        echo '<div class="themeum-pagination" data-preview="'.__( "PREV","winkel" ).'" data-nextview="'.__( "NEXT","winkel" ).'">';
        echo paginate_links( array(
            'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'        => '?paged=%#%',
            'current'       => $page_numb,
            'prev_text'     => __('PREV','winkel'),
            'next_text'     => __('NEXT','winkel'),
            'total'         => $max_page,
            'type'          => 'list',
        ) );
        echo '</div>';
    }

endif;


/*-------------------------------------------------------
*           Themeum Breadcrumb
*-------------------------------------------------------*/
if(!function_exists('winkel_breadcrumbs')):
function winkel_breadcrumbs(){ ?>
        <ol class="breadcrumb">
            <li><a href="<?php echo esc_url(site_url()); ?>" class="breadcrumb_home"><?php esc_html_e('Home', 'winkel') ?></a></li>
            <?php
                if(function_exists('is_product')){
                    $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
                    if(is_product()){
                        echo "<li><a href='".$shop_page_url."'>shop</a></li>";
                    }
                }
            ?>
            <li class="active">

                <?php if(function_exists('is_shop')){ if(is_shop()){ esc_html_e('shop','winkel'); } } ?>

                <?php if( is_tag() ) { ?>
                <?php esc_html_e('Posts Tagged ', 'winkel') ?><span class="raquo">/</span><?php single_tag_title(); echo('/'); ?>
                <?php } elseif (is_day()) { ?>
                <?php esc_html_e('Posts made in', 'winkel') ?> <?php the_time('F jS, Y'); ?>
                <?php } elseif (is_month()) { ?>
                <?php esc_html_e('Posts made in', 'winkel') ?> <?php the_time('F, Y'); ?>
                <?php } elseif (is_year()) { ?>
                <?php esc_html_e('Posts made in', 'winkel') ?> <?php the_time('Y'); ?>
                <?php } elseif (is_search()) { ?>
                <?php esc_html_e('Search results for', 'winkel') ?> <?php the_search_query() ?>
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
                $themeum_taxonomy_links     = array();
                $themeum_term               = get_queried_object();
                $themeum_term_parent_id     = $themeum_term->parent;
                $themeum_term_taxonomy      = $themeum_term->taxonomy;
                while ( $themeum_term_parent_id ) {
                    $themeum_current_term       = get_term( $themeum_term_parent_id, $themeum_term_taxonomy );
                    $themeum_taxonomy_links[]   = '<a href="' . esc_url( get_term_link( $themeum_current_term, $themeum_term_taxonomy ) ) . '" title="' . esc_attr( $themeum_current_term->name ) . '">' . esc_html( $themeum_current_term->name ) . '</a>';
                    $themeum_term_parent_id     = $themeum_current_term->parent;
                }
                if ( !empty( $themeum_taxonomy_links ) ) echo implode( ' <span class="raquo">/</span> ', array_reverse( $themeum_taxonomy_links ) ) . ' <span class="raquo">/</span> ';
                    echo esc_html( $themeum_term->name );
                } elseif (is_author()) {
                    global $wp_query;
                    $curauth = $wp_query->get_queried_object();
                    esc_html_e('Posts by ', 'winkel'); echo ' ',$curauth->nickname;
                } elseif (is_page()) {
                    echo get_the_title();
                } elseif (is_home()) {
                    esc_html_e('Blog', 'winkel');
                } ?>
            </li>
        </ol>

<?php
}
endif;

/*-------------------------------------------------------
 *              Themeum Comment
 *-------------------------------------------------------*/
if(!function_exists('winkel_comment')):

    function winkel_comment($comment, $args, $depth){
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
                        <?php edit_comment_link( esc_html__( 'Edit', 'winkel' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'winkel' ); ?></p>
                    <?php endif; ?>
                    <span class="comment-reply">
                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="fa fa-reply" aria-hidden="true"></i> '.esc_html__( 'Reply', 'winkel' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
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
function winkel_coming_soon_body_class($classes) {
    $classes[] = 'page-template-coming-soon';
    return $classes;
}
if ( get_theme_mod( 'comingsoon_en', false ) ) {
    if(!function_exists('winkel_my_page_template_redirect')):
        function winkel_my_page_template_redirect()
        {
            if( is_page() || is_home() || is_category() || is_single() )
            {
                if( !is_super_admin( get_current_user_id() ) ){
                    add_filter('body_class','winkel_coming_soon_body_class');
                    get_template_part( 'coming','soon');
                    exit();
               }
            }
        }
        add_action( 'template_redirect', 'winkel_my_page_template_redirect' );
    endif;

    if(!function_exists('winkel_cooming_soon_wp_title')):
        function winkel_cooming_soon_wp_title(){
            return 'Coming Soon';
        }
        add_filter( 'wp_title', 'winkel_cooming_soon_wp_title' );
    endif;
}




/*-----------------------------------------------------
 *              CSS Generator
 *----------------------------------------------------*/
if(!function_exists('winkel_css_generator')){
    function winkel_css_generator(){

        $output = '';

        $preset = get_theme_mod( 'preset', '1' );
        if( $preset ){

            if( get_theme_mod( 'custom_preset_en', true ) ) {

                // CSS Color
                $major_color = get_theme_mod( 'major_color', '#fd5238' );
                if($major_color){
                    $output .= '
                    a,
                    .bottom-widget .widget ul li a:hover,
                    .widget ul li a:hover,
                    .widget-blog-posts-section .entry-title  a:hover,
                    .entry-header h2.entry-title.blog-entry-title a:hover,
                    .entry-summary .wrap-btn-style a.btn-style:hover,
                    .main-menu-wrap .navbar-toggle:hover,
                    .woocommerce .star-rating span:before,
                    .winkel-post .blog-post-meta li a:hover,
                    .winkel-post .content-item-title a:hover,
                    .woocommerce ul.products li.product .added_to_cart,
                    .woocommerce ul.products li.product:hover .button.add_to_cart_button,
                    .woocommerce ul.products li.product:hover .added_to_cart,
                    .woocommerce div.product p.price,
                    .woocommerce div.product span.price,
                    .product_meta .sku_wrapper span.sku,
                    .woocommerce-message::before,
                    .woocommerce a.remove,
                    .woocommerce ul.products li.product .product-thumbnail-outer:hover .product-content-wrapper a h2,
                    .themeum-woo-product-details .product-content h4 a:hover,
                    #mobile-menu ul li.active>a,
                    #mobile-menu ul li a:hover,
                    .woocommerce .product .product-thumbnail-outer .product-content-wrapper a:hover,
                    .tab-rewards-wrapper h3,
                    .btn.btn-border-winkel,
                    .entry-summary .wrap-btn-style a.btn-style,
                    .social-share-wrap ul li a:hover,
                    .product-timeline ul li,
                    .elementor-slick-slider .slick-prev:before,
                    .elementor-slick-slider .slick-next:before,
                    .team-content-socials a:hover,
                    .overlay-btn,
                    .winkel-post .content-item-title a:hover,
                    .winkel-widgets a:hover,.elementor-accordion-title.active .elementor-accordion-icon i,
                    .header-solid .common-menu-wrap .nav>li.active>a:after,
                    #footer-wrap .menu-footer-menu a:hover,
                    .post-box .inner .post-meta a span,.product-item .inner h4 a:hover,
                    .themeum-pagination .page-numbers li a:hover,
                    .single-product .stock-in-out,
                    .single-product .breadcrumb li.active,
                    .header-transparent .common-menu-wrap .nav>li>a:hover,
                    .header-transparent .common-menu-wrap .nav>li.menu-item-has-children > a:hover:after,
                    .currency-woocs .woocommerce-currency-switcher-form a.dd-option:hover,
                    .woocommerce .woocommerce-info a:hover,
                    .thm-cart-form ul .product-name a.name:hover,
                    .thm-cart-form ul .product-name a.product-category:hover,.post-box .inner .post-meta a span,
                    .post-box .inner a:hover h6,.site-header-cart .woocommerce .widget_shopping_cart .cart_list li span.quantity,
                    .site-header-cart .woocommerce.widget_shopping_cart .cart_list li span.quantity,
                    .product-item .inner .hover-content a,.woocommerce .inner.thm-single-desc .price .woocs_price_code .woocommerce-Price-amount,.thm-single-desc .breadcrumb li,.thm-single-desc .breadcrumb li a:hover,
                    .thm-single-desc .product-price,ul.thm-iconic-category li a:hover i,.button.winkel-grey:hover,
                    .round-btn:hover,.bordered-btn:hover,.woocommerce div.product .woocommerce-Price-amount,
                    .woocommerce div.product p.price ins .woocommerce-Price-amount{ color: '. esc_attr($major_color) .'; }';
                }

                // CSS Background Color
                if($major_color){
                    $output .= '
                    .social-share ul li:hover,
                    .mc4wp-form-fields button,
                    .woocommerce-tabs .wc-tabs>li.active:before,
                    .team-content4,
                    .classic-slider .owl-dots .active>span,
                    .project-navigator a.prev:hover,
                    .project-navigator a.next:hover,
                    .woocommerce #respond input#submit:hover, 
                    .themeum-pagination .page-numbers li span.current,
                    .woocommerce nav.woocommerce-pagination ul li a:hover,
                    .woocommerce nav.woocommerce-pagination ul li span.current,
                    .form-submit input[type=submit],
                    .woocommerce div.product span.onsale,
                    .woocommerce-tabs .nav-tabs>li.active>a,
                    .woocommerce-tabs .nav-tabs>li.active>a:focus,
                    .woocommerce-tabs .nav-tabs>li.active>a:hover,
                    .woocommerce a.button:hover,
                    .woocommerce a.added_to_cart,
                    .woocommerce #respond input#submit, 
                    .woocommerce a.button, 
                    .woocommerce button.button, 
                    .woocommerce input.button,
                    .themeum-product-slider .slick-next:hover,
                    .themeum-product-slider .slick-prev:hover,
                    .winkel_wooshop_widgets .ui-slider-range,
                    .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
                    .woocommerce .widget_price_filter .ui-slider-horizontal,
                    .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
                    .winkel_wooshop_widgets .widget .button,
                    .thm-progress-bar .progress-bar,
                    .order-view .label-info,
                    .team-content-image,
                    .post-meta-info-list-in a:hover,
                    .widget .tagcloud a:hover,
                    .single_related:hover .overlay-content,
                    .elementor-widget-tabs .themeum-nav-wrapper .elementor-tab-desktop-title.active,
                    .themeum-pagination .page-numbers li span.current,
                    .chosen-container .chosen-results li.highlighted,
                    .widget_themeum_social_share_widget .themeum-social-share li a:hover,
                    .woocommerce-cart-form__cart-item .product-quantity a:hover,
                    a.plus:hover,
                    a.minus:hover,.winkel-quote,.gallery .fa-arrow-right,.gallery .fa-arrow-left,
                    .featured-wrap-link .entry-link-post-format,
                    .featured-wrap-quite .entry-quote-post-format,.site-header-cart .cart-contents span,
                    .woocommerce .widget_shopping_cart .buttons a:hover, 
                    .woocommerce.widget_shopping_cart .buttons a:hover,.product-item .inner .hover-content a:hover,
                    .thm-single-desc .product-quantity a:hover,.thm-single-desc .single-product-size label:hover,
                    .thm-single-desc .single-product-size input:checked + label,
                    .thm-product-accordion .woocommerce-checkout #payment div.form-row input#place_order,
                    input[type="submit"].round-btn,.bordered-btn,.round-btn,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce-account:not(.logged-in) .woocommerce form .form-row input[type="submit"],
                    .woocommerce-account .woocommerce form input.woocommerce-Button.button,
                    .woocommerce .cart .button, .woocommerce .cart input.button,.woocomerce-form.login .form-row input.button, .checkout_coupon .form-row input.button,.thm-mailchimp-inner,.account-modal input[type="submit"],
                    .themeum-social-share li a,.woocommerce table.shop_table td:last-child a:hover{ background: '. esc_attr($major_color) .'; }';

                    $output .= '.elementor-accordion-title.active,.woocommerce-checkout #payment input[type="submit"]{ background: '.esc_attr( $major_color ) .' !important; }';                    

                    $output .= 'input[type="submit"].round-btn:hover{ color: '.esc_attr( $major_color ) .' !important; }';

                    $output .= '.elementor-widget-tabs .themeum-nav-wrapper .elementor-tab-desktop-title.active:after{ border-color: '.esc_attr( $major_color ) .' transparent transparent transparent; }';    

                    $output .= '.thm-product-accordion .woocommerce-checkout #payment div.form-row input#place_order,
                    input[type="submit"].round-btn,.bordered-btn,.round-btn,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.button.winkel-grey:hover { border-color: '.esc_attr( $major_color ) .'; }';                    

                    $output .= '.woocommerce-checkout select:focus,.woocommerce-checkout input:focus{ border-color: '.esc_attr( $major_color ) .'!important; }';                   

                    $output .= '.thm-product-accordion .woocommerce-checkout #payment div.form-row input#place_order,
                    input[type="submit"].round-btn:hover{ 1.5px solid : '.esc_attr( $major_color ) .'!important; }'; 

                    $output .= '.thm-product-accordion .woocommerce-checkout #payment div.form-row input#place_order:hover{ color: '.esc_attr( $major_color ) .'!important; }';
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
                    .btn.btn-border-winkel,
                    .btn.btn-border-white:hover,
                    .info-wrapper a.white:hover,
                    .testiminial-home3 .client-wrapper{ border-color: '. esc_attr($major_color) .'; }';
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
                    .comingsoon .mc4wp-form-fields input[type=submit],
                    .testimonial_content_wrapper ul.slick-dots li.slick-active button,
                    .testimonial_content_wrapper .slick-prev,.testimonial_content_wrapper .slick-next
                    {   background-color: '. esc_attr($major_color) .'; border-color: '. esc_attr($major_color) .'; }';
                }

            }

            $output .= '.page-template-coming-soon { background-image: url('.esc_url( get_theme_mod("comming_soon_bg","bg")).')}';

            // Custom Color
            if( get_theme_mod( 'custom_preset_en', true ) ) {
                $hover_color = get_theme_mod( 'hover_color', '#fd5238' );
                if( $hover_color ){
                    $output .= 'a:hover,
                    .widget.widget_rss ul li a,
                    .footer-copyright a:hover,
                    .entry-summary .wrap-btn-style a.btn-style:hover{ color: '.esc_attr( $hover_color ) .'; }';
                    
                    $output .= '.error-page-inner a.btn.btn-primary.btn-lg:hover,
                    .btn.btn-primary:hover,
                    input[type=button]:hover,
                    .widget.widget_search #searchform .btn-search:hover,
                    .team-content2,
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
        if ( get_theme_mod('body_font_color', '#333333') ) { $bstyle .= 'color: '.get_theme_mod('', '#9B9B9C').';'; }

        //menu
        $mstyle = '';
        if ( get_theme_mod( 'menu_font_size', '16' ) ) { $mstyle .= 'font-size:'.get_theme_mod( 'menu_font_size', '14' ).'px;'; }
        if ( get_theme_mod( 'menu_google_font', 'Roboto' ) ) { $mstyle .= 'font-family:'.get_theme_mod( 'menu_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'menu_font_weight', '300' ) ) { $mstyle .= 'font-weight: '.get_theme_mod( 'menu_font_weight', '500' ).';'; }
        if ( get_theme_mod('menu_font_height', '54') ) { $mstyle .= 'line-height: '.get_theme_mod('menu_font_height', '54').'px;'; }
        if ( get_theme_mod('menu_font_color', '#191919') ) { $mstyle .= 'color: '.get_theme_mod('menu_font_color', '#ffffff').';'; }

        //heading1
        $h1style = '';
        if ( get_theme_mod( 'h1_font_size', '42' ) ) { $h1style .= 'font-size:'.get_theme_mod( 'h1_font_size', '42' ).'px;'; }
        if ( get_theme_mod( 'h1_google_font', 'Roboto' ) ) { $h1style .= 'font-family:'.get_theme_mod( 'h1_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'h1_font_weight', '600' ) ) { $h1style .= 'font-weight: '.get_theme_mod( 'h1_font_weight', '700' ).';'; }
        if ( get_theme_mod('h1_font_height', '42') ) { $h1style .= 'line-height: '.get_theme_mod('h1_font_height', '48').'px;'; }
        if ( get_theme_mod('h1_font_color', '#333') ) { $h1style .= 'color: '.get_theme_mod('h1_font_color', '#ffffff').';'; }

        # heading2
        $h2style = '';
        if ( get_theme_mod( 'h2_font_size', '36' ) ) { $h2style .= 'font-size:'.get_theme_mod( 'h2_font_size', '36' ).'px;'; }
        if ( get_theme_mod( 'h2_google_font', 'Roboto' ) ) { $h2style .= 'font-family:'.get_theme_mod( 'h2_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'h2_font_weight', '600' ) ) { $h2style .= 'font-weight: '.get_theme_mod( 'h2_font_weight', '700' ).';'; }
        if ( get_theme_mod('h2_font_height', '36') ) { $h2style .= 'line-height: '.get_theme_mod('h2_font_height', '36').'px;'; }
        if ( get_theme_mod('h2_font_color', '#222538') ) { $h2style .= 'color: '.get_theme_mod('h2_font_color', '#ffffff').';'; }

        //heading3
        $h3style = '';
        if ( get_theme_mod( 'h3_font_size', '26' ) ) { $h3style .= 'font-size:'.get_theme_mod( 'h3_font_size', '26' ).'px;'; }
        if ( get_theme_mod( 'h3_google_font', 'Roboto' ) ) { $h3style .= 'font-family:'.get_theme_mod( 'h3_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'h3_font_weight', '600' ) ) { $h3style .= 'font-weight: '.get_theme_mod( 'h3_font_weight', '600' ).';'; }
        if ( get_theme_mod('h3_font_height', '28') ) { $h3style .= 'line-height: '.get_theme_mod('h3_font_height', '28').'px;'; }
        if ( get_theme_mod('h3_font_color', '#222538') ) { $h3style .= 'color: '.get_theme_mod('h3_font_color', '#ffffff').';'; }

        //heading4
        $h4style = '';
        if ( get_theme_mod( 'h4_font_size', '18' ) ) { $h4style .= 'font-size:'.get_theme_mod( 'h4_font_size', '18' ).'px;'; }
        if ( get_theme_mod( 'h4_google_font', 'Roboto' ) ) { $h4style .= 'font-family:'.get_theme_mod( 'h4_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'h4_font_weight', '600' ) ) { $h4style .= 'font-weight: '.get_theme_mod( 'h4_font_weight', '700' ).';'; }
        if ( get_theme_mod('h4_font_height', '26') ) { $h4style .= 'line-height: '.get_theme_mod('h4_font_height', '26').'px;'; }
        if ( get_theme_mod('h4_font_color', '#222538') ) { $h4style .= 'color: '.get_theme_mod('h4_font_color', '#ffffff').';'; }

        //heading5
        $h5style = '';
        if ( get_theme_mod( 'h5_font_size', '14' ) ) { $h5style .= 'font-size:'.get_theme_mod( 'h5_font_size', '14' ).'px;'; }
        if ( get_theme_mod( 'h5_google_font', 'Roboto' ) ) { $h5style .= 'font-family:'.get_theme_mod( 'h5_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'h5_font_weight', '600' ) ) { $h5style .= 'font-weight: '.get_theme_mod( 'h5_font_weight', '600' ).';'; }
        if ( get_theme_mod('h5_font_height', '26') ) { $h5style .= 'line-height: '.get_theme_mod('h5_font_height', '24').'px;'; }
        if ( get_theme_mod('h5_font_color', '#222538') ) { $h5style .= 'color: '.get_theme_mod('h5_font_color', '#ffffff').';'; }

        $output .= 'body{'.$bstyle.'}';
        $output .= '.common-menu-wrap .nav>li>a{'.$mstyle.'}';
        $output .= 'h1{'.$h1style.'}';
        $output .= 'h2{'.$h2style.'}';
        $output .= 'h3{'.$h3style.'}';
        $output .= 'h4{'.$h4style.'}';
        $output .= 'h5{'.$h5style.'}';


        //Header
        if ( get_theme_mod( 'header_color', '#222538' ) ) {
            $output .= '.site-header, .page-template-homepage-transparent .header-solid{ background-color: '.esc_attr( get_theme_mod( 'header_color', '#222538' ) ) .'; }';
        }
        $output .= '.site-header{ padding-top: '. (int) esc_attr( get_theme_mod( 'header_padding_top', '0' ) ) .'px; }';
        $output .= '.site-header{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'header_padding_bottom', '0' ) ) .'px; }';
        $output .= '.site-header{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'header_margin_bottom', '0' ) ) .'px; }';

        //sticky Header
        if ( get_theme_mod( 'header_fixed', false ) ){
            $output .= '.site-header.sticky{ position:fixed;top:0;left:auto; z-index:99999;margin:0 auto; width:100%;-webkit-animation: fadeInDown 300ms;animation: fadeInDown 300ms;}';
            $output .= '.site-header.sticky.header-transparent .main-menu-wrap{ margin-top: 0;}';
            if ( get_theme_mod( 'sticky_header_color', '#222538' ) ){
                $sticybg = get_theme_mod( 'sticky_header_color', '#222538');
                $output .= '.site-header.sticky{ background-color: '.$sticybg.';}';
            }
        }

        // Header Transparent
        if ( get_theme_mod( 'header_transparent', false ) ){
            $output .= '.site-header{ background-color: transparent;}';
        }

        //logo
        $output .= '.themeum-navbar-header .themeum-navbar-brand img{width:'.get_theme_mod( 'logo_width', 145 ).'px; max-width:none;}';
        if (get_theme_mod( 'logo_height' )) {
            $output .= '.themeum-navbar-header .themeum-navbar-brand img{height:'.get_theme_mod( 'logo_height' ).'px;}';
        }

        // sub header
        $output .= '.subtitle-cover h2{font-size:'.get_theme_mod( 'sub_header_title_size', '72' ).'px;color:'.get_theme_mod( 'sub_header_title_color', '#ffffff' ).';}';
        $output .= '.breadcrumb>li+li:before, .subtitle-cover .breadcrumb, .subtitle-cover .breadcrumb>.active{color:'.get_theme_mod( 'breadcrumb_text_color', '#fff' ).';}';
        $output .= '.subtitle-cover .breadcrumb a, .page-subleading{color:'.get_theme_mod( 'breadcrumb_link_color', '#fff' ).';}';
        $output .= '.subtitle-cover .breadcrumb a:hover{color:'.get_theme_mod( 'breadcrumb_link_color_hvr', '#fff' ).';}';
        $output .= '.subtitle-cover{padding:'.get_theme_mod( 'sub_header_padding_top', '225' ).'px 0 '.get_theme_mod( 'sub_header_padding_bottom', '150' ).'px; margin-bottom: '.get_theme_mod( 'sub_header_margin_bottom', '60' ).'px;}';

        //body
        if (get_theme_mod( 'body_bg_img')) {
            $output .= 'body{ background-image: url("'.esc_attr( get_theme_mod( 'body_bg_img' ) ) .'");background-size: '.esc_attr( get_theme_mod( 'body_bg_size', 'cover' ) ) .';    background-position: '.esc_attr( get_theme_mod( 'body_bg_position', 'left top' ) ) .';background-repeat: '.esc_attr( get_theme_mod( 'body_bg_repeat', 'no-repeat' ) ) .';background-attachment: '.esc_attr( get_theme_mod( 'body_bg_attachment', 'fixed' ) ) .'; }';
        }
        $output .= 'body{ background-color: '.esc_attr( get_theme_mod( 'body_bg_color', '#fff' ) ) .'; }';

        // Button color setting...
        $output .= 'input[type=submit],
                    .woocommerce-page #payment #place_order,.btn.btn-white:hover,
                    .btn.btn-border-winkel:hover,.btn.btn-border-white:hover,.woocommerce input.button{ background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#fd5238' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#fd5238' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_text_color', '#ffffff' ) ) .' !important; border-radius: '.get_theme_mod( 'button_radius', 4 ).'px; }';

         $output .= '.winkel-login-register a.winkel-dashboard{ background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#fd5238' ) ) .'; }';


        if ( get_theme_mod( 'button_hover_bg_color', '#e83333' ) ) {
            $output .= 'input[type=submit]:hover
            .woocommerce-page #payment #place_order:hover{ background-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#e83333' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#e83333' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_hover_text_color', '#fff' ) ) .' !important; }';

            $output .= '.winkel-login-register a.winkel-dashboard:hover{ background-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#e83333' ) ) .'; }';
        }

        //menu color
        if ( get_theme_mod( 'navbar_text_color', '#ffffff' ) ) {
            $output .= '.header-solid .common-menu-wrap .nav>li.menu-item-has-children:after, .header-borderimage .common-menu-wrap .nav>li.menu-item-has-children:after, .header-solid .common-menu-wrap .nav>li>a, .header-borderimage .common-menu-wrap .nav>li>a,
            .header-solid .common-menu-wrap .nav>li>a:after, .header-borderimage .common-menu-wrap .nav>li>a:after,.winkel-search{ color: '.esc_attr( get_theme_mod( 'navbar_text_color', '#ffffff' ) ) .'; }';
        }

        $output .= '.header-solid .common-menu-wrap .nav>li>a:hover, .header-borderimage .common-menu-wrap .nav>li>a:hover,.winkel-login-register ul li a,.header-solid .common-menu-wrap .nav>li>a:hover:after, .header-borderimage .common-menu-wrap .nav>li>a:hover:after,.winkel-search-wrap a.winkel-search:hover{ color: '.esc_attr( get_theme_mod( 'navbar_hover_text_color', '#fd5238' ) ) .'; }';

        $output .= '.header-solid .common-menu-wrap .nav>li.active>a, .common-menu-wrap .nav>li.current-menu-parent.menu-item-has-children > a:after, .header-borderimage .common-menu-wrap .nav>li.active>a{ color: '.esc_attr( get_theme_mod( 'navbar_active_text_color', '#fd5238' ) ) .'; }';

        //submenu color
        $output .= '.common-menu-wrap .nav>li ul{ background-color: '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>ul li a,.common-menu-wrap .nav > li > ul li.mega-child > a{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color', '#191919' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'sub_menu_border', '#eef0f2' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>ul li a:hover,.common-menu-wrap .sub-menu > li.active > a,.common-menu-wrap .nav>li>ul li a:hover,.common-menu-wrap .sub-menu li.active.mega-child a:hover{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color_hover', '#fd5238' ) ) .';}';
        $output .= '.common-menu-wrap .nav>li > ul::after{ border-color: transparent transparent '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .' transparent; }';



        //bottom
        $output .= '#bottom-wrap{ background-color: '.esc_attr( get_theme_mod( 'bottom_color', '#19171a' ) ) .'; }';
        $output .= '#bottom-wrap,.bottom-widget .widget h3.widget-title{ color: '.esc_attr( get_theme_mod( 'bottom_text_color', '#ffffff' ) ) .'; }';
        $output .= '#bottom-wrap a{ color: '.esc_attr( get_theme_mod( 'bottom_link_color', '#9b9b9c' ) ) .'; }';
        $output .= '#bottom-wrap a:hover{ color: '.esc_attr( get_theme_mod( 'bottom_hover_color', '#fd5238' ) ) .'; }';
        $output .= '#bottom-wrap{ padding-top: '. (int) esc_attr( get_theme_mod( 'bottom_padding_top', '68' ) ) .'px; }';
        $output .= '#bottom-wrap{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'bottom_padding_bottom', '38' ) ) .'px; }';


        //footer
        $output .= '#footer-wrap{ background-color: '.esc_attr( get_theme_mod( 'copyright_bg_color', '#000000' ) ) .'; }';
        $output .= '.footer-copyright, #footer-wrap .menu-footer-menu a { color: '.esc_attr( get_theme_mod( 'copyright_text_color', '#7d91aa' ) ) .'; }';
        $output .= '.menu-footer-menu a{ color: '.esc_attr( get_theme_mod( 'copyright_link_color', '#7d91aa' ) ) .'; }';
        $output .= '.menu-footer-menu a:hover{ color: '.esc_attr( get_theme_mod( 'copyright_hover_color', '#fd5238' ) ) .'; }';
        $output .= '#footer-wrap{ padding-top: '. (int) esc_attr( get_theme_mod( 'copyright_padding_top', '48' ) ) .'px; }';
        $output .= '#footer-wrap{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'copyright_padding_bottom', '48' ) ) .'px; }';

        //Footer Menu
        $output .= '#footer-menu{ background-color: '.esc_attr( get_theme_mod( 'footer_menu_bg_color', '#19171A' ) ) .'; }';
        $output .= '#footer-menu ul li a { color: '.esc_attr( get_theme_mod( 'footer_menu_font_color', '#ffffff' ) ) .'; }';
        $output .= '#footer-menu ul li a:hover{ color: '.esc_attr( get_theme_mod( 'footer_menu_hover_color', '#fd5238' ) ) .'; }';
        $output .= '#footer-menu ul li a{ font-size: '. (int) esc_attr( get_theme_mod( 'footer_menu_font_size', '14' ) ) .'px; }';
        $output .= '#footer-menu ul li a{ font-weight: '. (int) esc_attr( get_theme_mod( 'footer_menu_font_weight', '600' ) ) .'; }';
        $output .= '#footer-menu{ padding-top: '. (int) esc_attr( get_theme_mod( 'footer_menu_padding_top', '25' ) ) .'px; }';
        $output .= '#footer-menu{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'footer_menu_padding_bottom', '25' ) ) .'px; }';


        // 404 Page
        $output .= "body.error404,body.page-template-404{ width: 100%; height: 100%; min-height: 100%; }";


        return $output;
    }
}

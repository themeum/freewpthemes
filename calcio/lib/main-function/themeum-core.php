<?php

if(!function_exists('calcio_setup')):

    function calcio_setup()
    {
        load_theme_textdomain( 'calcio', get_parent_theme_file_path() . '/languages' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'calcio-large', 1170, 750, true ); # Used Top Celebrities
        add_image_size( 'calcio-medium', 570, 360, true ); # Used Top Celebrities
        add_image_size( 'calcio-gallery', 360, 315, true ); # Single Gallery Image
        add_image_size( 'calcio-gallery-two', 728, 368, true ); # Shortcode Gallery Image
        add_image_size( 'calcio-thumb', 380, 180, true ); # Used Top Celebrities
        add_image_size( 'calcio-highlight-small', 264, 187, true ); # Used Top Celebrities
        add_image_size( 'calcio-post-small', 132, 90, true ); # Used Top Celebrities
        add_image_size( 'calcio-feature-widget', 262, 190, true ); # Blog Sitebar Image
        add_image_size( 'calcio-feature-post', 422, 340, true ); # Blog Sitebar Image
        add_image_size( 'calcio-small', 70, 54, true ); # Blog Sitebar Image
        add_image_size( 'calcio-thumb', 270, 150, true ); # Players Thum
        add_theme_support( 'post-formats', array( 'gallery','video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );

        if ( ! isset( $content_width ) )
        $content_width = 660;
    }

    add_action('after_setup_theme','calcio_setup');

endif;

if(!function_exists('calcio_pagination')):

    function calcio_pagination( $page_numb , $max_page, $print = true )
    {
        $big = 999999999; # need an unlikely integer
        $output = '<div class="themeum-pagination">';
        $output .= paginate_links( array(
            'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'        => '?paged=%#%',
            'current'       => $page_numb,
            'prev_text'     => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            'next_text'     => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
            'total'         => $max_page,
            'type'          => 'list',
        ) );
        $output .= '</div>';

        if ($print) {
            print $output;
        } else {
            return $output;
        }
    }
endif;


/*-------------------------------------------------------
 *              Themeum Comment
 *-------------------------------------------------------*/

if(!function_exists('calcio_comment')):

    function calcio_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            ?>
            <div class="pingback-list">
            <span><?php esc_html_e( 'Pingback:', 'calcio' ); ?></span>
            <?php 
                printf( '<span class="comment-author">%1$s</span>',
                get_comment_author_link());
                edit_comment_link( esc_html__( 'Edit', 'calcio' ), '<span class="edit-link">', '</span>' );
            ?>
            </div>
            <?php 
            case 'trackback' :
            
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
                                printf( '<span class="comment-author">%1$s</span>', get_comment_author_link());
                            ?>
                            <span class="comment-date"><?php echo get_comment_date() ?></span>

                            <?php edit_comment_link( esc_html__( 'Edit', 'calcio' ), '<span class="edit-link">', '</span>' ); ?>

                        </div>

                        <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'calcio' ); ?></p>
                        <?php endif; ?>

                        <div class="comment-content">
                            <?php comment_text(); ?>
                        </div>

                        <span class="comment-reply">
                            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'calcio' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                        </span>
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
if(!function_exists('calcio_breadcrumbs')):
    function calcio_breadcrumbs(){ ?>
    <div class="post-single-bradcum">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url(site_url()); ?>" class="breadcrumb_home"><?php esc_html_e('Home', 'calcio') ?></a></li>
                <?php
                    if(function_exists('is_product')){
                        $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
                        if(is_product()){
                            echo "<li><a href='".$shop_page_url."'>Shop</a></li>";
                        }
                    }
                ?>
                <li class="breadcrumb-item active">

                    <?php if(function_exists('is_shop')){ if(is_shop()){ esc_html_e('shop','calcio'); } } ?>

                    <?php if( is_tag() ) { ?>
                    <?php esc_html_e('Posts Tagged ', 'calcio') ?><span class="raquo">/</span><?php single_tag_title(); echo('/'); ?>
                    <?php } elseif (is_day()) { ?>
                    <?php esc_html_e('Posts made in', 'calcio') ?> <?php the_time('F jS, Y'); ?>
                    <?php } elseif (is_month()) { ?>
                    <?php esc_html_e('Posts made in', 'calcio') ?> <?php the_time('F, Y'); ?>
                    <?php } elseif (is_year()) { ?>
                    <?php esc_html_e('Posts made in', 'calcio') ?> <?php the_time('Y'); ?>
                    <?php } elseif (is_search()) { ?>
                    <?php esc_html_e('Search results for', 'calcio') ?> <?php the_search_query() ?>
                    <?php } elseif (is_single()) { ?>
                    <?php $category = get_the_category();
                        if ( $category ) {
                            $catlink = get_category_link( $category[0]->cat_ID );
                            echo ('<a href="'.esc_url($catlink).'">'.esc_html($category[0]->cat_name).'</a> '.'<span class="raquo"></span> ');
                        } elseif (get_post_type() == 'club'){
                            echo get_the_title();
                        } elseif (get_post_type() == 'fixture-result'){
                            echo get_the_title();
                        }elseif (get_post_type() == 'player'){
                            echo get_the_title();
                        } elseif (get_post_type() == 'point_table'){
                            echo get_the_title();
                        }  elseif (get_post_type() == 'product'){
                            echo get_the_title();
                        }
                    ?>
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
                        esc_html_e('Posts by ', 'calcio'); echo ' ',$curauth->nickname;
                    } elseif (is_page()) {
                        echo get_the_title();
                    } elseif (is_home()) {
                        esc_html_e('Blog', 'calcio');
                    } ?>
                </li>
            </ol>
        </nav>
    </div>

<?php
}
endif;

/*-----------------------------------------------------
 *              Coming Soon Page Settings
 *----------------------------------------------------*/
if ( get_theme_mod( 'comingsoon_en', false ) ) {
    if(!function_exists('calcio_my_page_template_redirect')):
        function calcio_my_page_template_redirect()
        {
            if( is_page() || is_home() || is_category() || is_single() )
            {
                if( !is_super_admin( get_current_user_id() ) ){
                    get_template_part( 'coming','soon');
                    exit();
                }
            }
        }
        add_action( 'template_redirect', 'calcio_my_page_template_redirect' );
    endif;

    if(!function_exists('calcio_cooming_soon_wp_title')):
        function calcio_cooming_soon_wp_title(){
            return 'Coming Soon';
        }
        add_filter( 'wp_title', 'calcio_cooming_soon_wp_title' );
    endif;
}



if(!function_exists('calcio_css_generator')){
    function calcio_css_generator(){

        $output = '';

        /* ***************************************
        **********      Theme Options   **********
        ****************************************** */
        $preset = get_theme_mod( 'preset', '1' );
        if( $preset ){


            if( get_theme_mod( 'custom_preset_en', true ) ) {
                $major_color = get_theme_mod( 'major_color', '#EF3F48' );

                if($major_color){
                    $output .= 'a,a:focus,.sub-title .breadcrumb>.active,#wp-megamenu-mainmenu>.wpmm-nav-wrap ul.wp-megamenu>li>a:hover, .header-search-wrap a:hover, .thm-topheadline .themeum-course-in a:hover, .popular-news-intro .entry-title a:hover, .group-fixture-teams-lists .team-name1 h4:hover, .secondary_menu .header-social .social-share ul li a:hover, .club-club-list .club-title a:hover, .fixture-team-inner.clearfix a h4:hover,
                    .all-highlights-style2-item .entry-title a:hover, .latest-featured-post-small .entry-title a:hover, .highlights-style2-item .entry-title a:hover, .thm-topheadline .themeum-course-in a:hover, .thm-topheadline.thm-sponsor .entry-title:hover, .thm-topheadline .themeum-course-in a:hover, .post-single-bradcum .breadcrumb>.active, .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover, .themeum-pagination ul li .page-numbers.current, .themeum-pagination ul li a:hover, .mc4wp-form-fields button .fa, .bottom-widget .contact-info i, .themeum-topstories-item .entry-date, .shortcode-upcoming-event .upcoming-event-content i, .notice-list-meta-date, .package-sidebar a:hover, .themeum-notice-list .thm-notice-data .notice-list-title a:hover, .themeum-notice-list .thm-notice-data .notice-list-cats a:hover, .blog-post-meta li a:hover, .section-title span.title, .woocommerce .woocommerce-info a:hover, .footer-wrap .social-share li a:hover,
                    .adons-themeum-feature-course .owl-prev:hover, .adons-themeum-feature-course .owl-next:hover,
                    .themeum-latest-post.themeum-latest-post-v2 .themeum-latest-post-content .entry-title a:hover,.single-event-meta > li > i,
                    .themeum-topstories-item a, .widget ul li a:hover,.common-menu-wrap .sub-menu li.active > a,.entry-summary .post-meta-info-list-in a:hover,.woocommerce table.shop_table td a:hover,.woocommerce div.product p.price, .fixture-team-inner .team-name:hover,
                    .woocommerce div.product span.price, .product_meta a, .thm-topheadline .themeum-course-in a:hover, #wp-megamenu-mainmenu>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li.current-menu-item a, .team-group-taxonomy .team-title a:hover,
                    .wpmm-grid-post-content .grid-post-title a:hover, .wpmm-tab-btns li a:hover,.breadcrumb>li a { color: '. esc_attr($major_color) .'; }';
                }

                if($major_color){
                    $output .= 'input:focus, textarea:focus, keygen:focus, select:focus, .mc4wp-form .mchimp-newsletter input[type=email], .addon-themeum-title .title-leftborder::after{ border-color: '. esc_attr($major_color) .'; }';
                }

                if($major_color){
                    $output .= '.package-list-content .package-list-title a:hover, .themeum-latest-post-content .entry-title a:hover, .thm-tk-search .thm-tk-search-nav ul li a:hover, .thm-tk-search .thm-tk-search-nav ul li a.active i, .thm-tk-search .thm-tk-search-nav ul li a.active, .ui-datepicker .ui-datepicker-calendar td:hover a, .package-sidebar .need-help p i, .package-share li a:hover { color: '. esc_attr($major_color) .'; }';
                }

                if($major_color){
                    $output .= '.single-event-content:hover .event-content-wrapper,.thm-tk-search .thm-tk-search-nav ul li a i:after, .select2-container--default .select2-results__option--highlighted[aria-selected] ,.select2-dropdown .select2-results .select2-results__options .select2-results__option:hover, .ui-slider .ui-slider-handle, .ui-datepicker .ui-datepicker-current-day a, .package-nav-tab.nav-tabs>li.active>a, .package-nav-tab.nav-tabs>li.active>a:focus, .package-nav-tab.nav-tabs>li.active>a:hover, .package-nav-tab.nav-tabs>li>a:hover,.latest-post-title,  .shortcode-upcoming-event .entry-date, .themeum-notice-list .notice-list-meta-date, .educon-blog-date, .entry-summary .wrap-btn-style .btn, .widget .tagcloud a, .single.single-post .post-navigation span>a, .comment-navigation .nav-previous a, .comment-navigation .nav-next a, .form-submit input[type=submit],.themeum-twitter .owl-dot.active>span,.contact-form-wrapper input[type="submit"], .conference-img a,
                        .entry-summary input[type=submit],.woocommerce .product-thumbnail-outer-inner .addtocart-btn a.button,
                        .product-thumbnail-outer:hover .product-content-wrapper,.woocommerce a.added_to_cart,
                        .woocommerce-page table.cart td.actions input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
                        body.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,
                        .owl-dot.active span, .slider_style2 .owl-dot.active>span, .slider-style1 .owl-dot.active span, .woocommerce div.product span.onsale
                        { background: '. esc_attr($major_color) .'; }';
                }
            }

            if($major_color){
                $output .= '.btn.btn-slider:hover, .btn.btn-slider:focus { background-color: '. esc_attr($major_color) .'; border-color: '. esc_attr($major_color) .'; }';
            }            
            if($major_color){
                $output .= '.adons-themeum-feature-course .owl-prev:hover, .adons-themeum-feature-course .owl-next:hover{ border-color: '. esc_attr($major_color) .'; }';
            }

            if( get_theme_mod( 'custom_preset_en', true ) ) {
                $hover_color = get_theme_mod( 'hover_color', '#d73941' );
                if( $hover_color ){
                    $output .= 'a:hover, .widget.widget_rss ul li a,.breadcrumb>li a:hover{ color: '.esc_attr( $hover_color ) .'; }';
                    $output .= '.error-page-inner a.btn.btn-primary.btn-lg:hover,.btn.btn-primary:hover,input[type=button]:hover,
                    .widget.widget_search .searchform .btn-search:hover, .themeum-notice-list:hover .notice-list-meta-date, .entry-summary .wrap-btn-style .btn:hover, .entry-summary .wrap-btn-style .btn:focus, .widget .tagcloud a:hover, .single.single-post .post-navigation span>a:hover, .single.single-post .post-navigation span>a:focus, .comment-navigation .nav-previous:hover a, .comment-navigation .nav-next a:hover, .form-submit input[type=submit]:hover,.contact-form-wrapper input[type="submit"]:hover,.educon-block,
                    .product-thumbnail-outer .product-thumbnail-outer-inner .addtocart-btn a.button:hover,.woocommerce .product-thumbnail-outer .product-thumbnail-outer-inner a.added_to_cart:hover{ background-color: '.esc_attr( $hover_color ) .'; }';
                    $output .= '.woocommerce a.button:hover, .single.single-post .post-navigation span>a:hover, .single.single-post .post-navigation span>a:focus, .comment-navigation .nav-previous:hover a, .comment-navigation .nav-next a:hover{ border-color: '.esc_attr( $hover_color ) .'; }';
                }
            }

        } else {
        $output ='a,a:focus,.sub-title .breadcrumb>.active,.modal-content .lost-pass:hover,#mobile-menu ul li:hover > a,#mobile-menu ul li.active > a,
#sidebar .widget ul li a:hover, .bottom-widget .widget ul li a:hover,
.themeum-pagination ul li .current,.themeum-pagination ul li a:hover,.sub-title-inner h2.leading,.header-transparent .topbar a:hover,
.topbar-contact strong,.menu-social .social-share ul li a:hover,.video-section .video-caption i:hover,
.addon-classic-content >div:hover h4, .addon-classic-content >div:hover .menu-price,
.btn.btn-style:hover,.widget .themeum-social-share li a:hover,.common-menu-wrap .nav>li>a:hover,.woocommerce .star-rating span,
.woocommerce-tabs .nav-tabs>li.active>a, .woocommerce-tabs .nav-tabs>li.active>a:focus, .woocommerce-tabs .nav-tabs>li.active>a:hover,
.woocommerce-tabs .nav>li>a:focus, .woocommerce-tabs .nav>li>a:hover,.cuisine-chef-designation,.breadcrumb>li a{ color: #e7272d; }
.error-page-inner a.btn.btn-primary.btn-lg,.btn.btn-primary,
.widget .tagcloud a,.carousel-left:hover, .carousel-right:hover,input[type=button],.navbar-toggle:hover .icon-bar,
.woocommerce a.button:hover,article.post .entry-blog .blog-date,.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover{background-color: #e7272d; }
.common-menu-wrap .nav>li ul{ background-color: rgba(231,39,45,.8); }
input:focus, textarea:focus, keygen:focus, select:focus{ border-color: #e7272d; }
a:hover, .widget.widget_rss ul li a{ color: #e8141b; }
.error-page-inner a.btn.btn-primary.btn-lg:hover,.btn.btn-primary:hover,input[type=button]:hover,
.widget.widget_search .searchform .btn-search:hover{ background-color: #e8141b; }
.btn.btn-primary,.woocommerce a.button:hover{ border-color: #e8141b; }';
        }

        
        if( get_post_meta(get_the_ID(),"themeum_body_color",true) ){
            $output .= 'body{ background-color: '.esc_attr(get_post_meta(get_the_ID(),"themeum_body_color",true)).' }';
        }else{
            $output .= 'body{ background-color: #f9f9f9; }';
        }


        /* *******************************
        **********  Quick Style **********
        ********************************** */

        $bstyle = $mstyle = $h1style = $h2style = $h3style = $h4style = $h5style = '';
        
        if ( get_theme_mod( 'body_font_size', '14' ) ) {
            $bstyle .= 'font-size:'.get_theme_mod( 'body_font_size', '14' ).'px;';
        }
        if ( get_theme_mod( 'body_google_font', 'Montserrat' ) ) {
            $bstyle .= 'font-family:'.get_theme_mod( 'body_google_font', 'Montserrat' ).';';
        }
        if ( get_theme_mod( 'body_font_weight', '400' ) ) {
            $bstyle .= 'font-weight: '.get_theme_mod( 'body_font_weight', '400' ).';';
        }
        if ( get_theme_mod('body_font_height', '24') ) {
            $bstyle .= 'line-height: '.get_theme_mod('body_font_height', '24').'px;';
        }
        if ( get_theme_mod('body_font_color', '#353535') ) {
            $bstyle .= 'color: '.get_theme_mod('body_font_color', '#353535').';';
        }

        
        $mstyle = '';
        if ( get_theme_mod( 'menu_font_size', '14' ) ) {
            $mstyle .= 'font-size:'.get_theme_mod( 'menu_font_size', '14' ).'px;';
        }
        if ( get_theme_mod( 'menu_google_font', 'Montserrat' ) ) {
            $mstyle .= 'font-family:'.get_theme_mod( 'menu_google_font', 'Montserrat' ).';';
        }
        if ( get_theme_mod( 'menu_font_weight', '400' ) ) {
            $mstyle .= 'font-weight: '.get_theme_mod( 'menu_font_weight', '400' ).';';
        }
        if ( get_theme_mod('menu_font_height', '24') ) {
            $mstyle .= 'line-height: '.get_theme_mod('menu_font_height', '24').'px;';
        }

        
        $h1style = '';
        if ( get_theme_mod( 'h1_font_size', '46' ) ) {
            $h1style .= 'font-size:'.get_theme_mod( 'h1_font_size', '46' ).'px;';
        }
        if ( get_theme_mod( 'h1_google_font', 'Montserrat' ) ) {
            $h1style .= 'font-family:'.get_theme_mod( 'h1_google_font', 'Montserrat' ).';';
        }
        if ( get_theme_mod( 'h1_font_weight', '400' ) ) {
            $h1style .= 'font-weight: '.get_theme_mod( 'h1_font_weight', '400' ).';';
        }
        if ( get_theme_mod('h1_font_height', '24') ) {
            $h1style .= 'line-height: '.get_theme_mod('h1_font_height', '24').'px;';
        }
        if ( get_theme_mod('h1_font_color', '#2E2E2E') ) {
            $h1style .= 'color: '.get_theme_mod('h1_font_color', '#2E2E2E').';';
        }

        
        $h2style = '';
        if ( get_theme_mod( 'h2_font_size', '36' ) ) {
            $h2style .= 'font-size:'.get_theme_mod( 'h2_font_size', '36' ).'px;';
        }
        if ( get_theme_mod( 'h2_google_font', 'Montserrat' ) ) {
            $h2style .= 'font-family:'.get_theme_mod( 'h2_google_font', 'Montserrat' ).';';
        }
        if ( get_theme_mod( 'h2_font_weight', '400' ) ) {
            $h2style .= 'font-weight: '.get_theme_mod( 'h2_font_weight', '400' ).';';
        }
        if ( get_theme_mod('h2_font_height', '24') ) {
            $h2style .= 'line-height: '.get_theme_mod('h2_font_height', '24').'px;';
        }
        if ( get_theme_mod('h2_font_color', '#2E2E2E') ) {
            $h2style .= 'color: '.get_theme_mod('h2_font_color', '#2E2E2E').';';
        }

        
        $h3style = '';
        if ( get_theme_mod( 'h3_font_size', '26' ) ) {
            $h3style .= 'font-size:'.get_theme_mod( 'h3_font_size', '26' ).'px;';
        }
        if ( get_theme_mod( 'h3_google_font', 'Montserrat' ) ) {
            $h3style .= 'font-family:'.get_theme_mod( 'h3_google_font', 'Montserrat' ).';';
        }
        if ( get_theme_mod( 'h3_font_weight', '400' ) ) {
            $h3style .= 'font-weight: '.get_theme_mod( 'h3_font_weight', '400' ).';';
        }
        if ( get_theme_mod('h3_font_height', '24') ) {
            $h3style .= 'line-height: '.get_theme_mod('h3_font_height', '24').'px;';
        }
        if ( get_theme_mod('h3_font_color', '#2E2E2E') ) {
            $h3style .= 'color: '.get_theme_mod('h3_font_color', '#2E2E2E').';';
        }

        
        $h4style = '';
        if ( get_theme_mod( 'h4_font_size', '18' ) ) {
            $h4style .= 'font-size:'.get_theme_mod( 'h4_font_size', '18' ).'px;';
        }
        if ( get_theme_mod( 'h4_google_font', 'Montserrat' ) ) {
            $h4style .= 'font-family:'.get_theme_mod( 'h4_google_font', 'Montserrat' ).';';
        }
        if ( get_theme_mod( 'h4_font_weight', '400' ) ) {
            $h4style .= 'font-weight: '.get_theme_mod( 'h4_font_weight', '400' ).';';
        }
        if ( get_theme_mod('h4_font_height', '24') ) {
            $h4style .= 'line-height: '.get_theme_mod('h4_font_height', '24').'px;';
        }
        if ( get_theme_mod('h4_font_color', '#2E2E2E') ) {
            $h4style .= 'color: '.get_theme_mod('h4_font_color', '#2E2E2E').';';
        }

        
        $h5style = '';
        if ( get_theme_mod( 'h5_font_size', '16' ) ) {
            $h5style .= 'font-size:'.get_theme_mod( 'h5_font_size', '16' ).'px;';
        }
        if ( get_theme_mod( 'h5_google_font', 'Montserrat' ) ) {
            $h5style .= 'font-family:'.get_theme_mod( 'h5_google_font', 'Montserrat' ).';';
        }
        if ( get_theme_mod( 'h5_font_weight', '400' ) ) {
            $h5style .= 'font-weight: '.get_theme_mod( 'h5_font_weight', '400' ).';';
        }
        if ( get_theme_mod('h5_font_height', '24') ) {
            $h5style .= 'line-height: '.get_theme_mod('h5_font_height', '24').'px;';
        }
        if ( get_theme_mod('h5_font_color', '#2E2E2E') ) {
            $h5style .= 'color: '.get_theme_mod('h5_font_color', '#2E2E2E').';';
        }

        $output .= 'body{'.$bstyle.'}';
        $output .= '.common-menu-wrap .nav>li>a{'.$mstyle.'}';
        $output .= 'h1{'.$h1style.'}';
        $output .= 'h2{'.$h2style.'}';
        $output .= 'h3{'.$h3style.'}';
        $output .= 'h4{'.$h4style.'}';
        $output .= 'h5{'.$h5style.'}';

        if ( get_theme_mod( 'header_fixed', false ) ){
            $output .= '.site-header.sticky{ position:fixed;top:0;left:auto; z-index:1000;margin:0 auto 30px; width:100%; background-color:rgba(0,0,0,0.3);}';
            $output .= '.site-header.sticky.header-transparent .main-menu-wrap{ margin-top: 0;}';
            $output .= '.site-header.sticky.common-menu-wrap .nav>li>a{ color: #9d9d9d;}';
            if ( get_theme_mod( 'sticky_header_color', '#fff' ) ){
                $sticybg = get_theme_mod( 'sticky_header_color', '#fff');
                $output .= '.site-header.sticky{ background-color: '.$sticybg.';}';
            }
        }

        $output .= '.site-header{ padding-top: '. (int) esc_attr( get_theme_mod( 'header_padding_top', '0' ) ) .'px; }';
        $output .= '.site-header{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'header_padding_bottom', '0' ) ) .'px; }';
        if (get_theme_mod( 'body_bg_img')) {
            $output .= 'body{ background-image: url("'.esc_attr( get_theme_mod( 'body_bg_img' ) ) .'");background-size: '.esc_attr( get_theme_mod( 'body_bg_size', 'cover' ) ) .';    background-position: '.esc_attr( get_theme_mod( 'body_bg_position', 'left top' ) ) .';background-repeat: '.esc_attr( get_theme_mod( 'body_bg_repeat', 'no-repeat' ) ) .';background-attachment: '.esc_attr( get_theme_mod( 'body_bg_attachment', 'fixed' ) ) .'; }';
        }

        if (get_theme_mod( 'topbar_color' ) ) {
            $output .= '.topbar{ background-color: '.esc_attr( get_theme_mod( 'topbar_color' ) ) .'; }';
        }
        if (get_theme_mod( 'topbar_text_color' ) ) {
            $output .= '.topbar,.topbar a{ color: '.esc_attr( get_theme_mod( 'topbar_text_color' ) ) .'; }';
        }

        if ( get_theme_mod( 'header_color', '#1f1f23' ) ) {
            $output .= '.site-header{ background-color: '.esc_attr( get_theme_mod( 'header_color', '#1f1f23' ) ) .'; }';
        }
        if ( get_theme_mod( 'bottom_color' ) ) {
            $output .= '.bottom{ background-color: '.esc_attr( get_theme_mod( 'bottom_color' ) ) .'; }';
        }

        if ( get_theme_mod( 'button_bg_color', '#EF3F48' ) ) {
            $output .= '.mc4wp-form-fields input[type=submit], .common-menu-wrap .nav>li.online-booking-button a, .error-page-inner a.btn.btn-primary.btn-lg,.btn.btn-primary, .package-list-button{ background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#EF3F48' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#EF3F48' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_text_color', '#fff' ) ) .' !important; }';
        }

        if ( get_theme_mod( 'button_hover_bg_color', '#d73941' ) ) {
            $output .= '.mc4wp-form-fields input[type=submit]:hover, .common-menu-wrap .nav>li.online-booking-button a:hover, .error-page-inner a.btn.btn-primary.btn-lg:hover,.btn.btn-primary:hover, .package-list-button:hover,.btn.btn-transparent:hover{ background-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#d73941' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#d73941' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_hover_text_color', '#fff' ) ) .' !important; }';
        }

        if ( get_theme_mod( 'navbar_text_color' ) ) {
            $output .= '.common-menu-wrap .nav>li.menu-item-has-children:after, .header-borderimage .common-menu-wrap .nav>li.menu-item-has-children:after, .common-menu-wrap .nav>li>a, .header-borderimage .common-menu-wrap .nav>li>a{ color: '.esc_attr( get_theme_mod( 'navbar_text_color' ) ) .'; }';
        }

        if ( get_theme_mod( 'navbar_hover_text_color' ) ) {
            $output .= '.common-menu-wrap .nav>li:hover>a, .common-menu-wrap .nav>li:hover>a:after, .common-menu-wrap .nav>li.active>a:after, .common-menu-wrap .nav>li.active>a, .common-menu-wrap .nav>li.current-menu-ancestor > a, .common-menu-wrap .nav>li.current-menu-ancestor > a:after{ color: '.esc_attr( get_theme_mod( 'navbar_hover_text_color' ) ) .'; }';
        }

        if ( get_theme_mod( 'navbar_bracket_color' ) ) {
            $output .= '.common-menu-wrap .nav>li>a:before{ background-color: '.esc_attr( get_theme_mod( 'navbar_bracket_color' ) ) .'; }';
        }

        $output .= '.footer-wrap{ background-color: '.esc_attr( get_theme_mod( 'footer_color', '#26262B' ) ) .'; padding-top: '.esc_attr( get_theme_mod( 'footer_copyright_top_padding', '26' ) ) .'px; padding-bottom: '.esc_attr( get_theme_mod( 'footer_copyright_bottom_padding', '26' ) ) .'px; }';

        $output .= '.footer-wrap{ color: '.esc_attr( get_theme_mod( 'footer_copyright_text_color', '#9E9E9E' ) ) .'; }';
        $output .= '.footer-wrap a{ color: '.esc_attr( get_theme_mod( 'footer_copyright_link_color', '#EF3F48' ) ) .'; }';
        $output .= '.footer-wrap a:hover{ color: '.esc_attr( get_theme_mod( 'footer_copyright_link_color_hvr', '#d73941' ) ) .'; }';
        $output .= '.footer-wrap .social-share li a{ color: '.esc_attr( get_theme_mod( 'footer_icon_color', '#9E9E9E' ) ) .'; }';
        $output .= '.footer-wrap .social-share li a:hover{ color: '.esc_attr( get_theme_mod( 'footer_icon_color_hvr', '#EC0048' ) ) .'; }';

        if (get_theme_mod( 'footer_widget_bg_color' )) {
            $output .= '.bottom{ background-color: '.esc_attr( get_theme_mod( 'footer_widget_bg_color' ) ) .'; }';
        }

        $output .= '.bottom{ border-top-color: '.esc_attr( get_theme_mod( 'footer_widget_top_border_color', '#eaeaea' ) ) .'; padding-top: '.esc_attr( get_theme_mod( 'footer_widget_top_padding', '85' ) ) .'px; padding-bottom: '.esc_attr( get_theme_mod( 'footer_widget_bottom_padding', '85' ) ) .'px; }';
        $output .= '.bottom-widget .widget ul li a,.bottom-widget .widget a { color: '.esc_attr( get_theme_mod( 'footer_widget_link_color', '#9E9E9E' ) ) .'; }';
        $output .= '.bottom, .bottom-widget .contact-info p{ color: '.esc_attr( get_theme_mod( 'footer_widget_text_color', '#9E9E9E' ) ) .'; }';
        $output .= '.bottom-widget .widget-title{ color: '.esc_attr( get_theme_mod( 'footer_widget_title_color', '#fff' ) ) .'; }';
        $output .= '.bottom a:hover,.widget ul li a:hover{ color: '.esc_attr( get_theme_mod( 'footer_widget_link_color_hvr', '#EF3F48' ) ) .'; }';

        $output .= '.common-menu-wrap .nav>li ul{ background-color: '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>ul li a{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color', '#000' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'sub_menu_border', '#eef0f2' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>.megamenu-container > ul li a, .common-menu-wrap .nav>li>ul li a, .common-menu-wrap .nav>li ul div.custom-output{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color', '#000' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>ul li a:hover{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color_hover', '#EF3F48' ) ) .'; background-color: '.esc_attr( get_theme_mod( 'sub_menu_bg_hover', '#fbfbfc' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>.megamenu-container > ul li a:hover, .common-menu-wrap .nav>li>ul li a:hover, .common-menu-wrap .nav>li>.megamenu-container > ul li.active > a, .common-menu-wrap .megamenu li.active > a{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color_hover', '#EF3F48' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li > ul::after{ border-color: transparent transparent '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .' transparent; }';

        if (get_theme_mod( 'logo_width' )) {
            $output .= '.themeum-navbar-header .themeum-navbar-brand img{width:'.get_theme_mod( 'logo_width' ).'px;max-width:none;}';
        }

        if (get_theme_mod( 'logo_height' )) {
            $output .= '.themeum-navbar-header .themeum-navbar-brand img{height:'.get_theme_mod( 'logo_height' ).'px;}';
        }

        $output .= '.subtitle-cover h2{font-size:'.get_theme_mod( 'header_title_size', '60' ).'px;color:'.get_theme_mod( 'header_title_color', '#000' ).';}';

        $output .= '.page-subleading{font-size:'.get_theme_mod( 'sub_text_size', '18' ).'px;color:'.get_theme_mod( 'sub_text_color', '#000' ).';}';

        $output .= '.subtitle-cover{padding:'.get_theme_mod( 'sub_header_padding_top', '80' ).'px 0 '.get_theme_mod( 'sub_header_padding_bottom', '80' ).'px; margin-bottom: '.get_theme_mod( 'sub_header_margin_bottom', '40' ).'px;}';


        $output .= "body.error404,body.page-template-404{
            width: 100%;
            height: 100%;
            min-height: 100%;
            background: #333 url(".esc_url( get_theme_mod( 'errorbg', false ) ).") no-repeat 100% 0;
        }";

        $output .= '.full-width-events .col-md-3 .entry-date-overlayer{ background-color:'.get_theme_mod( 'event_overlayer_bg_color', '#EF3F48' ).'; }';
        $output .= '.full-width-events:hover .col-md-3 .entry-date-overlayer{ background-color:'.get_theme_mod( 'event_overlayer_hover_bg_color', '#000' ).'; }';

        $output .= '.topbar a:hover{ color:'.get_theme_mod( 'topbar_link_hover_color', '#fff' ).'; }';

        return $output;
    }
}


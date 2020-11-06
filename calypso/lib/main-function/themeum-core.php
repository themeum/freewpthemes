<?php

/*-------------------------------------------------------
 *              Themeum Supports and Image Cut
 *-------------------------------------------------------*/



if(!function_exists('calypso_setup')):

    function calypso_setup(){
        load_theme_textdomain( 'calypso', get_template_directory() . '/languages' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'calypso-large', 1140, 570, true );
        add_image_size( 'calypso-medium', 362, 190, true );
        add_image_size( 'calypso-portfo', 600, 630, true );
        add_image_size( 'calypso-blog', 540, 360, true );
        add_image_size( 'portfo-small', 82, 64, true );
        add_theme_support( 'post-formats', array( 'audio','gallery','image','link','quote','video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );
        if ( ! isset( $content_width ) ){
            $content_width = 660;
        }
    }
    add_action('after_setup_theme','calypso_setup');

endif;



/*-------------------------------------------------------
 *              Themeum Pagination
 *-------------------------------------------------------*/
if(!function_exists('calypso_pagination')):

    function calypso_pagination( $page_numb , $max_page ){
        $big = 999999999;
        echo '<div class="themeum-pagination">';
        echo paginate_links( array(
            'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'        => '?paged=%#%',
            'current'       => $page_numb,
            'prev_text'     => __('<i class="calypso-icon calypso-left-arrow" aria-hidden="true"></i>', 'calypso'),
            'next_text'     => __('<i class="calypso-icon calypso-right-arrow" aria-hidden="true"></i>', 'calypso'),
            'total'         => $max_page,
            'type'          => 'list',
        ) );
        echo '</div>';
    }

endif;


/*-------------------------------------------------------
 *              Themeum Comment
 *-------------------------------------------------------*/
if(!function_exists('calypso_comment')):

    function calypso_comment($comment, $args, $depth){
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
                        <?php edit_comment_link( esc_html__( 'Edit', 'calypso' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'calypso' ); ?></p>
                    <?php endif; ?>
                    <span class="comment-reply">
                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="fa fa-reply" aria-hidden="true"></i> '.esc_html__( 'Reply', 'calypso' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
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
if(!function_exists('calypso_breadcrumbs')):

    function calypso_breadcrumbs(){ ?>
        <ul class="thm-breadcrumb heading-font">
            <li><a href="<?php echo esc_url(site_url()); ?>" class="breadcrumb_home"><?php esc_html_e('Home', 'calypso') ?></a></li>
            <?php
                if(function_exists('is_product')){
                    $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
                    if(is_product()){
                        echo "<li><a href='".$shop_page_url."'>Shop</a></li>";
                    }
                }
            ?>

            <li class="active">
                <?php if(function_exists('is_shop')){ if(is_shop()){ esc_html_e('Shop','calypso'); } } ?>
                <?php if( is_tag() ) { ?>
                <?php esc_html_e('Posts Tagged ', 'calypso') ?><span class="raquo">/</span><?php single_tag_title(); echo('/'); ?>
                <?php } elseif (is_day()) { ?>
                <?php esc_html_e('Posts made in', 'calypso') ?> <?php the_time('F jS, Y'); ?>
                <?php } elseif (is_month()) { ?>
                <?php esc_html_e('Posts made in', 'calypso') ?> <?php the_time('F, Y'); ?>
                <?php } elseif (is_year()) { ?>
                <?php esc_html_e('Posts made in', 'calypso') ?> <?php the_time('Y'); ?>
                <?php } elseif (is_search()) { ?>
                <?php esc_html_e('Search results for', 'calypso') ?> <?php the_search_query() ?>
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
                    esc_html_e('Posts by ', 'calypso'); echo ' ',$curauth->nickname;
                } elseif (is_page()) {
                    echo get_the_title();
                } elseif (is_home()) {
                    esc_html_e('Blog', 'calypso');
                } ?>
            </li>
        </ul>
    <?php
    }

endif;



/*-----------------------------------------------------
 *              Coming Soon Page Settings
 *----------------------------------------------------*/
if ( get_theme_mod( 'comingsoon_en', false ) ) {
    if(!function_exists('calypso_my_page_template_redirect')):
        function calypso_my_page_template_redirect()
        {
            if( is_page() || is_home() || is_category() || is_single() )
            {
                if( !is_super_admin( get_current_user_id() ) ){
                    get_template_part( 'coming','soon');
                    exit();
                }
            }
        }
        add_action( 'template_redirect', 'calypso_my_page_template_redirect' );
    endif;

    if(!function_exists('calypso_cooming_soon_wp_title')):
        function calypso_cooming_soon_wp_title(){
            return 'Coming Soon';
        }
        add_filter( 'wp_title', 'calypso_cooming_soon_wp_title' );
    endif;
}




/*-----------------------------------------------------
 *              CSS Generator
 *----------------------------------------------------*/
if(!function_exists('calypso_css_generator')){
    function calypso_css_generator(){

        $output = '';

        $preset = get_theme_mod( 'preset', '1' );
        if( $preset ){

            if( get_theme_mod( 'custom_preset_en', true ) ) {
                // CSS Color
                $major_color = get_theme_mod( 'major_color', '#23d0ec' );
                // secondary gradient color
                $gradient_color = get_theme_mod( 'major_sec_color', '#239cec' );

                $output .= '.gradient-bg{
                        background: '.$major_color.';
                        background: -moz-linear-gradient(top, '.$major_color.' 0%, '.$gradient_color.' 100%);
                        background: -webkit-linear-gradient(top, '.$major_color.' 0%,'.$gradient_color.' 100%);
                        background: linear-gradient(to bottom, '.$major_color.' 0%,'.$gradient_color.' 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$major_color.'", endColorstr="'.$gradient_color.'",GradientType=1 );
                    }
                ';

                // css color
                if($major_color){
                    $output .= 'body div.woocommerce .widget_shopping_cart .total, body div.woocommerce.widget_shopping_cart .total, .major-color, .modal .modal-footer a, a, .portfolio-single-items.left-image .portfolio-content a i, .countdown-section span.countdown-amount, .btn.btn-calypso:hover, .woocommerce .widget ul li a:hover, .woocommerce .product .product-thumbnail-outer .product-content-wrapper h2:hover, .product_meta .sku_wrapper span.sku, .woocommerce .product .product-thumbnail-outer .product-content-wrapper h2:hover, .themeum-pagination .page-numbers li.act-left:hover a, .themeum-pagination .page-numbers li.act-right:hover a, .themeum-pagination .page-numbers li span, .themeum-pagination .page-numbers li a:hover,.thm-portfolio-slider .owl-arrow:hover,.style2 .calypso-classic-post .content-item-title a:hover,.thm-course-box h4.course-title a:hover,.style3 .calypso-classic-post .content-item-title a:hover,.style2 .calypso-classic-post .classic-post-date a:hover,.calypso-classic-post.post-wide .content-item-title a:hover,.calypso-classic-post.post-wide .thm-readmore:hover,.calypso-classic-post.post-wide .classic-post-date a:hover, .classic-post-date a:hover,  .calypso-classic-post .content-item-title a:hover, .calypso-classic-post .thm-readmore:hover{
                        color: '. esc_attr($major_color) .'; 
                    }';
                }

                //Css Color Important
                if($major_color){
                    $output .= '.major-color-imp{
                        color: '.$major_color.' !important
                    }';
                }

                // CSS Background Color
                if($major_color){
                    $output .= '.major-bg, .portfolio-items .caption-full-width2, .blog-details-img, .featured-wrap-quite .entry-quote-post-format, .thm-post-top .meta-category a:hover, .thm-single-notice .thm-notice-left .thm-notice-date-box, .btn.btn-calypso, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce a.added_to_cart, .woocommerce #respond input#submit, .woocommerce button.button, .woocommerce input.button, .slider_content_wrapper .owl-dots .owl-dot.active .dot-with-bg::before,.product-thumbnail-outer .product-thumbnail-outer-inner:before,.bottom-widget .mc4wp-form input[type="submit"], .wpcf7-form .travel-form input[type=submit]{ 
                        background: '. esc_attr($major_color) .'; 
                    }';
                }
                //Css Background Important
                if($major_color){
                    $output .= '.major-bg-imp, .elementor-accordion .elementor-accordion-item .elementor-tab-title.elementor-active{
                        background: '.esc_attr($major_color).' !important;
                    }';
                }
                // CSS Border
                if($major_color){
                    $output .= '.major-border,  .thm-fullscreen-search form input[type="text"], .btn.btn-calypso, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
                        border-color: '. esc_attr($major_color) .'; 
                    }';
                }


            }

            // Custom Color
            if( get_theme_mod( 'custom_preset_en', true ) ) {
                $hover_color = get_theme_mod( 'hover_color', '#23d0ec' );
                if( $hover_color ){
                    $output .= '.hover-color{
                        color: '.esc_attr( $hover_color ) .'; 
                    }';
                    $output .= '.hover-bg{
                        background-color: '.esc_attr( $hover_color ) .'; 
                    }';

                    $output .= '.hover-border{
                        border-color: '.esc_attr( $hover_color ) .'; 
                    }';
                }
            }
        }

        $bstyle = $mstyle = $h1style = $h2style = $h3style = $h4style = $h5style = '';
        //body
        if ( get_theme_mod( 'body_font_size', '14' ) ) { $bstyle .= 'font-size:'.get_theme_mod( 'body_font_size', '14' ).'px;'; }
        if ( get_theme_mod( 'body_google_font', 'PT Serif' ) ) { $bstyle .= 'font-family:'.get_theme_mod( 'body_google_font', 'PT Serif' ).';'; }
        if ( get_theme_mod( 'body_font_weight', '400' ) ) { $bstyle .= 'font-weight: '.get_theme_mod( 'body_font_weight', '400' ).';'; }
        if ( get_theme_mod('body_font_height', '24') ) { $bstyle .= 'line-height: '.get_theme_mod('body_font_height', '24').'px;'; }
        if ( get_theme_mod('body_font_color', '#7d91aa') ) { $bstyle .= 'color: '.get_theme_mod('', '#7d91aa').';'; }

        //menu
        $mstyle = '';
        if ( get_theme_mod( 'menu_font_size', '14' ) ) { $mstyle .= 'font-size:'.get_theme_mod( 'menu_font_size', '14' ).'px;'; }
        if ( get_theme_mod( 'menu_google_font', 'Montserrat' ) ) { $mstyle .= 'font-family:'.get_theme_mod( 'menu_google_font', 'Montserrat' ).';'; }
        if ( get_theme_mod( 'menu_font_weight', '400' ) ) { $mstyle .= 'font-weight: '.get_theme_mod( 'menu_font_weight', '400' ).';'; }
        if ( get_theme_mod('menu_font_height', '32') ) { $mstyle .= 'line-height: '.get_theme_mod('menu_font_height', '32').'px;'; }

        //heading1
        $h1style = '';
        if ( get_theme_mod( 'h1_font_size', '42' ) ) { $h1style .= 'font-size:'.get_theme_mod( 'h1_font_size', '42' ).'px;'; }
        if ( get_theme_mod( 'h1_google_font', 'PT Serif' ) ) { $h1style .= 'font-family:'.get_theme_mod( 'h1_google_font', 'PT Serif' ).';'; }
        if ( get_theme_mod( 'h1_font_weight', '600' ) ) { $h1style .= 'font-weight: '.get_theme_mod( 'h1_font_weight', '700' ).';'; }
        if ( get_theme_mod('h1_font_height', '42') ) { $h1style .= 'line-height: '.get_theme_mod('h1_font_height', '42').'px;'; }
        if ( get_theme_mod('h1_font_color', '#333') ) { $h1style .= 'color: '.get_theme_mod('h1_font_color', '#333').';'; }

        # heading2
        $h2style = '';
        if ( get_theme_mod( 'h2_font_size', '36' ) ) { $h2style .= 'font-size:'.get_theme_mod( 'h2_font_size', '36' ).'px;'; }
        if ( get_theme_mod( 'h2_google_font', 'PT Serif' ) ) { $h2style .= 'font-family:'.get_theme_mod( 'h2_google_font', 'PT Serif' ).';'; }
        if ( get_theme_mod( 'h2_font_weight', '600' ) ) { $h2style .= 'font-weight: '.get_theme_mod( 'h2_font_weight', '600' ).';'; }
        if ( get_theme_mod('h2_font_height', '36') ) { $h2style .= 'line-height: '.get_theme_mod('h2_font_height', '36').'px;'; }
        if ( get_theme_mod('h2_font_color', '#222538') ) { $h2style .= 'color: '.get_theme_mod('h2_font_color', '#222538').';'; }

        //heading3
        $h3style = '';
        if ( get_theme_mod( 'h3_font_size', '26' ) ) { $h3style .= 'font-size:'.get_theme_mod( 'h3_font_size', '26' ).'px;'; }
        if ( get_theme_mod( 'h3_google_font', 'PT Serif' ) ) { $h3style .= 'font-family:'.get_theme_mod( 'h3_google_font', 'PT Serif' ).';'; }
        if ( get_theme_mod( 'h3_font_weight', '600' ) ) { $h3style .= 'font-weight: '.get_theme_mod( 'h3_font_weight', '600' ).';'; }
        if ( get_theme_mod('h3_font_height', '28') ) { $h3style .= 'line-height: '.get_theme_mod('h3_font_height', '28').'px;'; }
        if ( get_theme_mod('h3_font_color', '#222538') ) { $h3style .= 'color: '.get_theme_mod('h3_font_color', '#222538').';'; }

        //heading4
        $h4style = '';
        if ( get_theme_mod( 'h4_font_size', '18' ) ) { $h4style .= 'font-size:'.get_theme_mod( 'h4_font_size', '18' ).'px;'; }
        if ( get_theme_mod( 'h4_google_font', 'PT Serif' ) ) { $h4style .= 'font-family:'.get_theme_mod( 'h4_google_font', 'PT Serif' ).';'; }
        if ( get_theme_mod( 'h4_font_weight', '600' ) ) { $h4style .= 'font-weight: '.get_theme_mod( 'h4_font_weight', '600' ).';'; }
        if ( get_theme_mod('h4_font_height', '26') ) { $h4style .= 'line-height: '.get_theme_mod('h4_font_height', '26').'px;'; }
        if ( get_theme_mod('h4_font_color', '#222538') ) { $h4style .= 'color: '.get_theme_mod('h4_font_color', '#222538').';'; }

        //heading5
        $h5style = '';
        if ( get_theme_mod( 'h5_font_size', '14' ) ) { $h5style .= 'font-size:'.get_theme_mod( 'h5_font_size', '14' ).'px;'; }
        if ( get_theme_mod( 'h5_google_font', 'PT Serif' ) ) { $h5style .= 'font-family:'.get_theme_mod( 'h5_google_font', 'PT Serif' ).';'; }
        if ( get_theme_mod( 'h5_font_weight', '600' ) ) { $h5style .= 'font-weight: '.get_theme_mod( 'h5_font_weight', '600' ).';'; }
        if ( get_theme_mod('h5_font_height', '26') ) { $h5style .= 'line-height: '.get_theme_mod('h5_font_height', '26').'px;'; }
        if ( get_theme_mod('h5_font_color', '#222538') ) { $h5style .= 'color: '.get_theme_mod('h5_font_color', '#222538').';'; }

        $output .= 'body{'.$bstyle.'}';
        $output .= '.common-menu-wrap .navigation li a, .cat-menu-btn{'.$mstyle.'}';
        $output .= 'h1{'.$h1style.'}';
        $output .= 'h2{'.$h2style.'}';
        $output .= 'h3{'.$h3style.'}';
        $output .= 'h4{'.$h4style.'}';
        $output .= 'h5{'.$h5style.'}';
        $output .= '.heading-font, .secondary-font{font-family: '. get_theme_mod( 'h1_google_font', 'Montserrat' ).'}';
        $output .= '.body-font, .main-font{font-family: '. get_theme_mod( 'body_google_font', 'PT Serif' ).'}';

        $output .= '.site-header{ padding-top: '. (int) esc_attr( get_theme_mod( 'header_padding_top', '0' ) ) .'px; }';
        $output .= '.site-header{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'header_padding_bottom', '0' ) ) .'px; }';
        $output .= '.site-header{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'header_margin_bottom', '0' ) ) .'px; }';

        //sticky Header
        if ( get_theme_mod( 'header_fixed', false ) ){
            $output .= '.site-header.sticky{ position:fixed;top:0;left:auto; z-index:99999;margin:0 auto; width:100%;-webkit-animation: fadeInDown 300ms;animation: fadeInDown 300ms;}';
            $output .= '.site-header.sticky.header-transparent .main-menu-wrap{ margin-top: 0;}';
            $stickybg = get_theme_mod( 'sticky_header_bg_color', 'rgba(3,183,255,0.85)');
            $sticky_page_bg = get_post_meta( get_the_ID(), "themeum_header_sticky_bgc", true );
            if ( $stickybg || $sticky_page_bg ){
                if($sticky_page_bg){
                    $output .= '.site-header.sticky{ background-color: '.$sticky_page_bg.';}';
                }else{
                    $output .= '.site-header.sticky{ background-color: '.$stickybg.';}';
                }
            }
        }

        // header padding
        $header_top_pdng = get_theme_mod('header_padding_top', '20');
        $header_btm_pdng = get_theme_mod('header_padding_bottom', '20');
        $sticky_top_pdng = get_theme_mod('sticky_padding_top', '10');
        $sticky_btm_pdng = get_theme_mod('sticky_padding_bottom', '10');
        if($header_top_pdng){
            $output .= '.header.site-header{
                padding-top: '.$header_top_pdng.'px;
            }';
        }
        if($header_btm_pdng){
            $output .= '.header.site-header{
                padding-bottom: '.$header_btm_pdng.'px;
            }';
        }
        if($sticky_top_pdng){
            $output .= '.header.site-header.sticky{
                padding-top: '.$sticky_top_pdng.'px;
            }';
        }
        if($sticky_btm_pdng){
            $output .= '.header.site-header.sticky{
                padding-bottom: '.$sticky_btm_pdng.'px;
            }';
        }

        // header style

        $header_bgc = get_post_meta( get_the_ID(), "themeum_header_bgc", true );
        $headerlayout = get_theme_mod( 'header_bg_color', 'transparent' );
        if(!$header_bgc){
            $header_bgc = $headerlayout;
        }
        $output .= 'header{
            background-color: '. $header_bgc .' ;
        }';

        // sub-header


        $s_header_pt = get_theme_mod('sub_header_padding_top', 30);
        $s_header_pb = get_theme_mod('sub_header_padding_bottom', 0);
        $s_header_mb = get_theme_mod('sub_header_margin_bottom', 0);
        $s_header_bg = get_theme_mod('sub_header_bg', '#ffffff');
        $s_header_bgi = get_theme_mod('sub_header_banner_img', '');
        $s_header_fs = get_theme_mod('sub_header_title_size', '50');
        $s_header_clr = get_theme_mod('sub_header_title_color', '#222538');
        $s_header_bcr = get_theme_mod('sub_header_breadcumb_color', '#222222');
        $s_header_bacr = get_theme_mod('sub_header_breadcumb_active_color', '#999999');

        $output .= '.subtitle-cover{
            padding-top: '.$s_header_pt.'px;
            padding-bottom: '.$s_header_pb.'px;
            margin-bottom: '.$s_header_mb.'px;
            background-color: '.$s_header_bg.';
            background-image: url('.$s_header_bgi.');
        }';
        $output .= '.subtitle-cover .subtitle{
            color: '.$s_header_clr.';
            font-size: '.$s_header_fs.'px;
        }';
        $output .= '.subtitle-cover ul.thm-breadcrumb a{
            color: '.$s_header_bcr.';
        }';
        $output .= '.subtitle-cover ul.thm-breadcrumb{
            color: '.$s_header_bacr.';
        }';
        $output .= '.subtitle-cover ul.thm-breadcrumb li:not(:last-child)::after{
            background-color: '.$s_header_bacr.';
        }';

        //body
        if (get_theme_mod( 'body_bg_img')) {
            $output .= 'body{ background-image: url("'.esc_attr( get_theme_mod( 'body_bg_img' ) ) .'");background-size: '.esc_attr( get_theme_mod( 'body_bg_size', 'cover' ) ) .';    background-position: '.esc_attr( get_theme_mod( 'body_bg_position', 'left top' ) ) .';background-repeat: '.esc_attr( get_theme_mod( 'body_bg_repeat', 'no-repeat' ) ) .';background-attachment: '.esc_attr( get_theme_mod( 'body_bg_attachment', 'fixed' ) ) .'; }';
        }
        $output .= 'body{ background-color: '.esc_attr( get_theme_mod( 'body_bg_color', '#ffffff' ) ) .'; }';


        $btn_boc =  get_theme_mod( 'button_border_color', '#27AAE1' );
        $btn_bow = get_theme_mod( 'button_border_width', '1' );
        // Button color setting...
        $output .= 'input[type=submit],input[type="button"].wpneo-image-upload,
                    input[type="button"].wpneo-image-upload-btn,input[type="button"]#addreward,.wpneo-edit-btn,
                    .wpneo-image-upload.float-right,.wpneo-save-btn,.wpneo-cancel-btn,
                    .dashboard-btn-link,#wpneo_active_edit_form,#addcampaignupdate,
                    .wpneo_donate_button,.wpneo-profile-button,.select_rewards_button,
                    .woocommerce-page #payment #place_order,.btn.btn-white:hover,
                    .btn.btn-border-calypso:hover,.btn.btn-border-white:hover,.woocommerce input.button,
                    input[type="submit"].wpneo-submit-campaign{
                         background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#ffffff' ) ) .';
                         color: '.esc_attr( get_theme_mod( 'button_text_color', '#86939E' ) ) .' !important; 
                         border-radius: '.get_theme_mod( 'button_radius', 30 ).'px;
                         border: '.$btn_bow.'px solid '.$btn_boc.';
                        }';

         $output .= '.calypso-login-register a.calypso-dashboard{ background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#23d0ec' ) ) .'; }';


        if ( get_theme_mod( 'button_hover_bg_color', '#23d0ec' ) ) {
            $output .= 'input[type=submit]:hover,input[type="button"].wpneo-image-upload:hover,input[type="button"].wpneo-image-upload-btn:hover,
                input[type="button"]#addreward:hover,.wpneo-edit-btn:hover,
                .wpneo-image-upload.float-right:hover,.wpneo-save-btn:hover,
                .dashboard-btn-link:hover,#wpneo_active_edit_form:hover,#addcampaignupdate:hover,
                .wpneo_donate_button:hover,.wpneo-profile-button:hover,.select_rewards_button:hover,
            .woocommerce-page #payment #place_order:hover,
            input[type="submit"].wpneo-submit-campaign:hover{ background-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#23d0ec' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#23d0ec' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_hover_text_color', '#fff' ) ) .' !important; }';

            $output .= '.calypso-login-register a.calypso-dashboard:hover{ background-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#23d0ec' ) ) .'; }';
        }

        //menu color

        $nav_color = get_theme_mod( 'navbar_text_color', '#222' );
        $menu_color = get_post_meta(get_the_ID(), 'themeum_header_c', true);

        if($menu_color){
            $nav_color = $menu_color;
        }

        if ( $nav_color ) {
            $output .= 'header, .header-cat-menu .cat-menu-btn, .common-menu-wrap .navigation li a, .thm-header-icons .single-icon, .main-menu-wrap .navbar-toggle, a.thm-cart-icon-inner{ color: '.esc_attr( $nav_color ) .'; }';

            $output .= '.login-link a:first-child::after{ background: '.esc_attr( $nav_color ) .' }';
        }



        $output .= '.calypso-login-register ul li a,
        .calypso-search-wrap a.calypso-search:hover{ color: '.esc_attr( get_theme_mod( 'navbar_hover_text_color', '#23d0ec' ) ) .'; }';

        $output .= '.header-solid .common-menu-wrap .nav>li.active>a, .header-borderimage .common-menu-wrap .nav>li.active>a{ color: '.esc_attr( get_theme_mod( 'navbar_active_text_color', '#23d0ec' ) ) .'; }';

        //submenu color
        $output .= '.common-menu-wrap .nav>li ul{ background-color: '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>ul li a,.common-menu-wrap .nav > li > ul li.mega-child > a{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color', '#191919' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'sub_menu_border', '#eef0f2' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>ul li a:hover,.common-menu-wrap .sub-menu > li.active > a,
        .common-menu-wrap .nav>li>ul li a:hover, .common-menu-wrap .sub-menu li.active.mega-child a:hover{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color_hover', '#23d0ec' ) ) .';}';
        $output .= '.common-menu-wrap .nav>li > ul::after{ border-color: transparent transparent '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .' transparent; }';



        //bottom
        $output .= '#bottom-wrap{ background-color: '.esc_attr( get_theme_mod( 'bottom_color', '#484848' ) ) .'; }';
        $output .= '#bottom-wrap,.bottom-widget .widget h3.widget-title{ color: '.esc_attr( get_theme_mod( 'bottom_text_color', '#7d91aa' ) ) .'; }';
        $output .= '.bottom-widget .widget h3.widget-title{ color: '.esc_attr( get_theme_mod( 'bottom_title_color', '#ffffff' ) ) .'; }';
        $output .= '#bottom-wrap a{ color: '.esc_attr( get_theme_mod( 'bottom_link_color', '#7d91aa' ) ) .'; }';
        $output .= '#bottom-wrap a:hover{ color: '.esc_attr( get_theme_mod( 'bottom_hover_color', '#23d0ec' ) ) .'; }';
        $output .= '#bottom-wrap{ padding-top: '. (int) esc_attr( get_theme_mod( 'bottom_padding_top', '80' ) ) .'px; }';
        $output .= '#bottom-wrap{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'bottom_padding_bottom', '45' ) ) .'px; }';


        //footer
        
        if(get_theme_mod('copyright_transparent', false)){
            $output .= '#footer-wrap{
                background-color: transparent;
            }';
        }else{
            $output .= '#footer-wrap{
                background-color: '.esc_attr( get_theme_mod( 'copyright_bg_color', '#484848' ) ) .'; 
            }';
        }
        $output .= '.footer-copyright, .template-credit { color: '.esc_attr( get_theme_mod( 'copyright_text_color', '#96989d' ) ) .'; }';
        $output .= '#footer-wrap a{ color: '.esc_attr( get_theme_mod( 'copyright_link_color', '#7d91aa' ) ) .'; }';
        $output .= '#footer-wrap a:hover{ color: '.esc_attr( get_theme_mod( 'copyright_hover_color', '#23d0ec' ) ) .'; }';
        $output .= '#footer-wrap .container{ padding-top: '. (int) esc_attr( get_theme_mod( 'copyright_padding_top', '25' ) ) .'px; }';
        $output .= '#footer-wrap .container{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'copyright_padding_bottom', '25' ) ) .'px; }';

        $copyright_divider = get_theme_mod('copyright_en_divider', true);
        $c_divider_color = get_theme_mod('copyright_divider_color', '#DADDDE');

        if($copyright_divider){
            $output .= '#footer-wrap .container{
                border-top: 1px solid '.$c_divider_color.';
            }';
        }


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

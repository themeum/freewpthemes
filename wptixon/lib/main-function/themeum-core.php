<?php

if(!function_exists('wptixon_setup')):

    function wptixon_setup()
    {
        //Textdomain
        load_theme_textdomain( 'wptixon', get_template_directory() . '/languages' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'wptixon-large', 1140, 570, true ); // Used Top Celebrities
        add_image_size( 'wptixon-medium', 370, 250, true ); // Used Top Celebrities
        add_image_size( 'wptixon-portfo', 600, 500, true ); // Used Top Celebrities
        add_image_size( 'wptixon-marso-portfo', 600, 800, false ); // Used Top Celebrities
        add_theme_support( 'post-formats', array( 'audio','gallery','image','link','quote','video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );

        if ( ! isset( $content_width ) ){
            $content_width = 660;
        }
        add_theme_support( 'woocommerce' );
    }

    add_action('after_setup_theme','wptixon_setup');

endif;

if(!function_exists('wptixon_pagination')):

    function wptixon_pagination( $page_numb , $max_page )
    {
        $big = 999999999; // need an unlikely integer
        echo '<div class="themeum-pagination">';
        echo paginate_links( array(
            'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'        => '?paged=%#%',
            'current'       => $page_numb,
            'prev_text'     => '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>',
            'next_text'     => '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>',
            'total'         => $max_page,
            'type'          => 'list',
        ) );
        echo '</div>';
    }
endif;


/*-------------------------------------------------------
 *              Themeum Comment
 *-------------------------------------------------------*/

if(!function_exists('wptixon_comment')):

    function wptixon_comment($comment, $args, $depth)
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

                            <?php edit_comment_link( esc_html__( 'Edit', 'wptixon' ), '<span class="edit-link">', '</span>' ); ?>

                        </div>

                        <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'wptixon' ); ?></p>
                        <?php endif; ?>

                        <div class="comment-content">
                            <?php comment_text(); ?>
                        </div>

                        <span class="comment-reply">
                            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'wptixon' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
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
if(!function_exists('wptixon_breadcrumbs')):
function wptixon_breadcrumbs(){ ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo esc_url(site_url()); ?>" class="breadcrumb_home"><?php esc_html_e('Home', 'wptixon') ?></a></li>
        <?php
            if(function_exists('is_product')){
                $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
                if(is_product()){
                    echo "<li><a href='".$shop_page_url."'>shop</a></li>";
                }
            }
        ?>
        <li class="active">

                    <?php if(function_exists('is_shop')){ if(is_shop()){ esc_html_e('shop','wptixon'); } } ?>

                    <?php if( is_tag() ) { ?>
                    <?php esc_html_e('Posts Tagged ', 'wptixon') ?><span class="raquo">/</span><?php single_tag_title(); echo('/'); ?>
                    <?php } elseif (is_day()) { ?>
                    <?php esc_html_e('Posts made in', 'wptixon') ?> <?php the_time('F jS, Y'); ?>
                    <?php } elseif (is_month()) { ?>
                    <?php esc_html_e('Posts made in', 'wptixon') ?> <?php the_time('F, Y'); ?>
                    <?php } elseif (is_year()) { ?>
                    <?php esc_html_e('Posts made in', 'wptixon') ?> <?php the_time('Y'); ?>
                    <?php } elseif (is_search()) { ?>
                    <?php esc_html_e('Search results for', 'wptixon') ?> <?php the_search_query() ?>
                    <?php } elseif (is_single()) { ?>
                    <?php $category = get_the_category();
                        if ( $category ) {
                            $catlink = get_category_link( $category[0]->cat_ID );
                            echo ('<a href="'.esc_url($catlink).'">'.esc_html($category[0]->cat_name).'</a> '.'<span class="raquo"></span> ');
                        } elseif (get_post_type() == 'product'){
                            echo get_the_title();
                        }
                    //echo get_the_title(); ?>
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

                    esc_html_e('Posts by ', 'wptixon'); echo ' ',$curauth->nickname;
                } elseif (is_page()) {
                    echo get_the_title();
                } elseif (is_home()) {
                    esc_html_e('Blog', 'wptixon');
                } ?>
            </li>
    </ol>

<?php
}
endif;


// Make sure that you've registered your theme to valid this license
define('KC_LICENSE', 'l483kg4m-jxbv-ju7k-or7h-yhgd-q3jl1ec3fqyi');

/*-----------------------------------------------------
 *              starterpro_hex2rgb
 *----------------------------------------------------*/
if(!function_exists('wptixon_hex2rgb')):
    function wptixon_hex2rgb($hex) {
       $hex = str_replace("#", "", $hex);

       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
       }
       $rgb = array($r, $g, $b);

       return $rgb[0].','.$rgb[1].','.$rgb[2];
    }
endif;
/*-----------------------------------------------------
 *              Coming Soon Page Settings
 *----------------------------------------------------*/
if ( get_theme_mod( 'comingsoon_en', false ) ) {
    if(!function_exists('wptixon_my_page_template_redirect')):
        function wptixon_my_page_template_redirect()
        {
            if( is_page() || is_home() || is_category() || is_single() )
            {
                if( !is_super_admin( get_current_user_id() ) ){
                    get_template_part( 'coming','soon');
                    exit();
                }
            }
        }
        add_action( 'template_redirect', 'wptixon_my_page_template_redirect' );
    endif;

    if(!function_exists('wptixon_cooming_soon_wp_title')):
        function wptixon_cooming_soon_wp_title(){
            return 'Coming Soon';
        }
        add_filter( 'wp_title', 'wptixon_cooming_soon_wp_title' );
    endif;
}



if(!function_exists('wptixon_css_generator')){
    function wptixon_css_generator(){

        $output = '';

        /* *******************************
        **********      Theme Options   **********
        ********************************** */
        $preset = get_theme_mod( 'preset', '1' );
        if( $preset ){

            if( get_theme_mod( 'custom_preset_en', true ) ) {
                $major_color = get_theme_mod( 'major_color', '#0072bc' );
                if($major_color){
                    $output .= 'a,.footer-wrap .social-share li a:hover,.bottom-widget .contact-info i,.bottom-widget .widget ul li a:hover, .latest-blog-content .latest-post-button:hover,.widget ul li a:hover,.widget-blog-posts-section .entry-title  a:hover,.entry-header h2.entry-title.blog-entry-title a:hover,.entry-summary .wrap-btn-style a.btn-style:hover,.main-menu-wrap .navbar-toggle,.topbar .social-share ul >li a:hover,.mc4wp-form-fields .send-arrow button,.woocommerce .star-rating span:before,.wptixon-post .blog-post-meta li a:hover,.wptixon-post .content-item-title a:hover,.woocommerce ul.products li.product .button.add_to_cart_button,.woocommerce ul.products li.product .added_to_cart,
                    .woocommerce ul.products li.product:hover .button.add_to_cart_button,.woocommerce ul.products li.product:hover .added_to_cart,#mobile-menu ul li.active>a,#mobile-menu ul li a:hover { color: '. esc_attr($major_color) .'; }';
                }

                if($major_color){
                    $output .= 'input:focus, textarea:focus, keygen:focus, select:focus,.classic-slider.layout2 .classic-slider-btn:hover,
                    .classic-slider.layout3 .classic-slider-btn:hover,.classic-slider.layout4 .classic-slider-btn:hover,.portfolio-slider .portfolio-slider-btn:hover,.info-wrapper a.white{ border-color: '. esc_attr($major_color) .'; }';
                    $output .= '.wpcf7-submit,.project-navigator a.prev,.project-navigator a.next,.woocommerce #respond input#submit,.woocommerce #respond input#submit:hover,.themeum-pagination .page-numbers li a:hover,.themeum-pagination .page-numbers li span.current,
                        .woocommerce nav.woocommerce-pagination ul li a:hover,.woocommerce nav.woocommerce-pagination ul li span.current,.portfolio-slider .portfolio-slider-btn { border: 2px solid '. esc_attr($major_color) .'; } .wpcf7-submit:hover,
                    .classic-slider.layout2 .classic-slider-btn:hover,.classic-slider.layout3 .classic-slider-btn:hover,.classic-slider.layout4 .classic-slider-btn:hover,.classic-slider.layout4 .container >div,.portfolio-slider .portfolio-slider-btn:hover,
                    .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt{   background-color: '. esc_attr($major_color) .'; border-color: '. esc_attr($major_color) .'; }';
                }

                if($major_color){
                    $output .= '.carousel-woocommerce .owl-nav .owl-next:hover,.carousel-woocommerce .owl-nav .owl-prev:hover,.themeum-latest-post-content .entry-title a:hover,.common-menu-wrap .nav>li.current>a,
                    .header-solid .common-menu-wrap .nav>li.current>a,.portfolio-filter a:hover,.portfolio-filter a.active,.latest-review-single-layout2 .latest-post-title a:hover, .blog-arrows a:hover{ border-color: '. esc_attr($major_color) .';  }';
                }

                if($major_color){
                    $output .= '.woocommerce-tabs .wc-tabs>li.active:before, .team-content4, .classic-slider .owl-dots .active>span,
                    .project-navigator a.prev:hover,.project-navigator a.next:hover,.woocommerce #respond input#submit:hover,
                    .themeum-pagination .page-numbers li a:hover,.themeum-pagination .page-numbers li span.current,
                    .woocommerce nav.woocommerce-pagination ul li a:hover,.woocommerce nav.woocommerce-pagination ul li span.current,
                    .form-submit input[type=submit]{ background: '. esc_attr($major_color) .'; }';
                }

                if($major_color){
                    $output .= '.woocommerce-MyAccount-navigation ul li.is-active, .woocommerce-MyAccount-navigation ul li:hover,.carousel-woocommerce .owl-nav .owl-next:hover,.carousel-woocommerce .owl-nav .owl-prev:hover,.woocommerce ul.products li.product:hover .button,.portfolio-thumb-wrapper-layout4 .portfolio-thumb:before, .btn.btn-slider:hover, .btn.btn-slider:focus,.products .tixon-product-image .woocommerce-LoopProduct-link::after{ background-color: '. esc_attr($major_color) .'; border-color: '. esc_attr($major_color) .'; }';
                }
            }

            


            // .select2-container .select2-dropdown .select2-results ul li

            if( get_theme_mod( 'custom_preset_en', true ) ) {
                $hover_color = get_theme_mod( 'hover_color', '#005fb2' );
                if( $hover_color ){
                    $output .= 'a:hover, .widget.widget_rss ul li a,.main-menu-wrap .navbar-toggle:hover,.footer-copyright a:hover{ color: '.esc_attr( $hover_color ) .'; }';
                    $output .= '.error-page-inner a.btn.btn-primary.btn-lg:hover,.btn.btn-primary:hover,input[type=button]:hover,
                    .widget.widget_search #searchform .btn-search:hover,.team-content2,
                    .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover{ background-color: '.esc_attr( $hover_color ) .'; }';
                    $output .= '.woocommerce a.button:hover{ border-color: '.esc_attr( $hover_color ) .'; }';
                }
            }

        } else {
        $output ='a,a:focus,.sub-title .breadcrumb>.active,.modal-content .lost-pass:hover,#mobile-menu ul li:hover > a,#mobile-menu ul li.active > a,
        #sidebar .widget ul li a:hover,
        .themeum-pagination ul li .current,.themeum-pagination ul li a:hover,.sub-title-inner h2.leading,.header-transparent .topbar a:hover,
        .topbar-contact strong,.menu-social .social-share ul li a:hover,.video-section .video-caption i:hover,
        .addon-classic-content >div:hover h4, .addon-classic-content >div:hover .menu-price,
        .btn.btn-style:hover,.widget .themeum-social-share li a:hover,.header-solid .common-menu-wrap .nav>li>a:hover{ color: #e7272d; }
        .error-page-inner a.btn.btn-primary.btn-lg,.btn.btn-primary,
        .widget .tagcloud a,.carousel-left:hover, .carousel-right:hover,input[type=button],.navbar-toggle:hover .icon-bar,
         article.post .entry-blog .blog-date {background-color: #e7272d; }
        .common-menu-wrap .nav>li ul{ background-color: rgba(231,39,45,.8); }
        input:focus, textarea:focus, keygen:focus, select:focus{ border-color: #e7272d; }
        a:hover, .widget.widget_rss ul li a{ color: #e8141b; }
        .error-page-inner a.btn.btn-primary.btn-lg:hover,.btn.btn-primary:hover,input[type=button]:hover,
        .widget.widget_search #searchform .btn-search:hover{ background-color: #e8141b; }
        .btn.btn-primary,.woocommerce a.button:hover{ border-color: #e8141b; }';
        }



        /* *******************************
        **********  Quick Style **********
        ********************************** */

        $bstyle = $mstyle = $h1style = $h2style = $h3style = $h4style = $h5style = '';
        //body
        if ( get_theme_mod( 'body_font_size', '14' ) ) {
            $bstyle .= 'font-size:'.get_theme_mod( 'body_font_size', '14' ).'px;';
        }
        if ( get_theme_mod( 'body_google_font', 'Raleway' ) ) {
            $bstyle .= 'font-family:'.get_theme_mod( 'body_google_font', 'Raleway' ).';';
        }
        if ( get_theme_mod( 'body_font_weight', '400' ) ) {
            $bstyle .= 'font-weight: '.get_theme_mod( 'body_font_weight', '400' ).';';
        }
        if ( get_theme_mod('body_font_height', '24') ) {
            $bstyle .= 'line-height: '.get_theme_mod('body_font_height', '24').'px;';
        }
        if ( get_theme_mod('body_font_color', '#38434a') ) {
            $bstyle .= 'color: '.get_theme_mod('body_font_color', '#38434a').';';
        }

        //menu
        $mstyle = '';
        if ( get_theme_mod( 'menu_font_size', '14' ) ) {
            $mstyle .= 'font-size:'.get_theme_mod( 'menu_font_size', '14' ).'px;';
        }
        if ( get_theme_mod( 'menu_google_font', 'Raleway' ) ) {
            $mstyle .= 'font-family:'.get_theme_mod( 'menu_google_font', 'Raleway' ).';';
        }
        if ( get_theme_mod( 'menu_font_weight', '600' ) ) {
            $mstyle .= 'font-weight: '.get_theme_mod( 'menu_font_weight', '400' ).';';
        }
        if ( get_theme_mod('menu_font_height', '24') ) {
            $mstyle .= 'line-height: '.get_theme_mod('menu_font_height', '24').'px;';
        }
        if ( get_theme_mod('menu_font_color', '#38434a') ) {
            $mstyle .= 'color: '.get_theme_mod('menu_font_color', '#38434a').';';
        }

        //heading1
        $h1style = '';
        if ( get_theme_mod( 'h1_font_size', '42' ) ) {
            $h1style .= 'font-size:'.get_theme_mod( 'h1_font_size', '42' ).'px;';
        }
        if ( get_theme_mod( 'h1_google_font', 'Raleway' ) ) {
            $h1style .= 'font-family:'.get_theme_mod( 'h1_google_font', 'Raleway' ).';';
        }
        if ( get_theme_mod( 'h1_font_weight', '700' ) ) {
            $h1style .= 'font-weight: '.get_theme_mod( 'h1_font_weight', '700' ).';';
        }
        if ( get_theme_mod('h1_font_height', '42') ) {
            $h1style .= 'line-height: '.get_theme_mod('h1_font_height', '42').'px;';
        }
        if ( get_theme_mod('h1_font_color', '#38434a') ) {
            $h1style .= 'color: '.get_theme_mod('h1_font_color', '#38434a').';';
        }

        # heading2
        $h2style = '';
        if ( get_theme_mod( 'h2_font_size', '36' ) ) {
            $h2style .= 'font-size:'.get_theme_mod( 'h2_font_size', '36' ).'px;';
        }
        if ( get_theme_mod( 'h2_google_font', 'Raleway' ) ) {
            $h2style .= 'font-family:'.get_theme_mod( 'h2_google_font', 'Raleway' ).';';
        }
        if ( get_theme_mod( 'h2_font_weight', '700' ) ) {
            $h2style .= 'font-weight: '.get_theme_mod( 'h2_font_weight', '700' ).';';
        }
        if ( get_theme_mod('h2_font_height', '42') ) {
            $h2style .= 'line-height: '.get_theme_mod('h2_font_height', '42').'px;';
        }
        if ( get_theme_mod('h2_font_color', '#38434a') ) {
            $h2style .= 'color: '.get_theme_mod('h2_font_color', '#38434a').';';
        }

        //heading3
        $h3style = '';
        if ( get_theme_mod( 'h3_font_size', '26' ) ) {
            $h3style .= 'font-size:'.get_theme_mod( 'h3_font_size', '26' ).'px;';
        }
        if ( get_theme_mod( 'h3_google_font', 'Raleway' ) ) {
            $h3style .= 'font-family:'.get_theme_mod( 'h3_google_font', 'Raleway' ).';';
        }
        if ( get_theme_mod( 'h3_font_weight', '700' ) ) {
            $h3style .= 'font-weight: '.get_theme_mod( 'h3_font_weight', '700' ).';';
        }
        if ( get_theme_mod('h3_font_height', '28') ) {
            $h3style .= 'line-height: '.get_theme_mod('h3_font_height', '28').'px;';
        }
        if ( get_theme_mod('h3_font_color', '#38434a') ) {
            $h3style .= 'color: '.get_theme_mod('h3_font_color', '#38434a').';';
        }

        //heading4
        $h4style = '';
        if ( get_theme_mod( 'h4_font_size', '18' ) ) {
            $h4style .= 'font-size:'.get_theme_mod( 'h4_font_size', '18' ).'px;';
        }
        if ( get_theme_mod( 'h4_google_font', 'Raleway' ) ) {
            $h4style .= 'font-family:'.get_theme_mod( 'h4_google_font', 'Raleway' ).';';
        }
        if ( get_theme_mod( 'h4_font_weight', '700' ) ) {
            $h4style .= 'font-weight: '.get_theme_mod( 'h4_font_weight', '700' ).';';
        }
        if ( get_theme_mod('h4_font_height', '26') ) {
            $h4style .= 'line-height: '.get_theme_mod('h4_font_height', '26').'px;';
        }
        if ( get_theme_mod('h4_font_color', '#38434a') ) {
            $h4style .= 'color: '.get_theme_mod('h4_font_color', '#38434a').';';
        }

        //heading5
        $h5style = '';
        if ( get_theme_mod( 'h5_font_size', '16' ) ) {
            $h5style .= 'font-size:'.get_theme_mod( 'h5_font_size', '16' ).'px;';
        }
        if ( get_theme_mod( 'h5_google_font', 'Raleway' ) ) {
            $h5style .= 'font-family:'.get_theme_mod( 'h5_google_font', 'Raleway' ).';';
        }
        if ( get_theme_mod( 'h5_font_weight', '700' ) ) {
            $h5style .= 'font-weight: '.get_theme_mod( 'h5_font_weight', '700' ).';';
        }
        if ( get_theme_mod('h5_font_height', '24') ) {
            $h5style .= 'line-height: '.get_theme_mod('h5_font_height', '24').'px;';
        }
        if ( get_theme_mod('h5_font_color', '#38434a') ) {
            $h5style .= 'color: '.get_theme_mod('h5_font_color', '#38434a').';';
        }

        $output .= 'body{'.$bstyle.'}';
        $output .= '.common-menu-wrap .nav>li>a{'.$mstyle.'}';
        $output .= 'h1{'.$h1style.'}';
        $output .= 'h2{'.$h2style.'}';
        $output .= 'h3{'.$h3style.'}';
        $output .= 'h4{'.$h4style.'}';
        $output .= 'h5{'.$h5style.'}';

        if ( get_theme_mod( 'header_fixed', false ) ){
            $output .= '.site-header.sticky{ position:fixed;top:0;left:auto; z-index:99999;margin:0 auto; width:100%;}';
            $output .= '.site-header.sticky.header-transparent .main-menu-wrap{ margin-top: 0;}';
            // $output .= '.site-header.sticky.header-solid .common-menu-wrap .nav>li>a{ color: #9d9d9d;}';
            if ( get_theme_mod( 'sticky_header_color', '#fff' ) ){
                $sticybg = get_theme_mod( 'sticky_header_color', '#fff');
                $output .= '.site-header.sticky{ background-color: '.$sticybg.';}';
            }
        }

        //topbar
        if (get_theme_mod( 'topbar_color' ) ) {
            $output .= '.topbar{ background-color: '.esc_attr( get_theme_mod( 'topbar_color' ) ) .'; }';
        }
        if (get_theme_mod( 'topbar_text_color' ) ) {
            $output .= '.topbar,.topbar a{ color: '.esc_attr( get_theme_mod( 'topbar_text_color' ) ) .'; }';
        }
        $output .= '.topbar{ padding-top: '. (int) esc_attr( get_theme_mod( 'topbar_padding_top', '20' ) ) .'px; }';
        $output .= '.topbar{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'topbar_padding_bottom', '20' ) ) .'px; }';

        //header
        $output .= '.site-header{ padding-top: '. (int) esc_attr( get_theme_mod( 'header_padding_top', '0' ) ) .'px; }';
        $output .= '.site-header{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'header_padding_bottom', '0' ) ) .'px; }';

        if (get_theme_mod( 'body_bg_img')) {
            $output .= 'body{ background-image: url("'.esc_attr( get_theme_mod( 'body_bg_img' ) ) .'");background-size: '.esc_attr( get_theme_mod( 'body_bg_size', 'cover' ) ) .';    background-position: '.esc_attr( get_theme_mod( 'body_bg_position', 'left top' ) ) .';background-repeat: '.esc_attr( get_theme_mod( 'body_bg_repeat', 'no-repeat' ) ) .';background-attachment: '.esc_attr( get_theme_mod( 'body_bg_attachment', 'fixed' ) ) .'; }';
        }
        $output .= 'body{ background-color: '.esc_attr( get_theme_mod( 'body_bg_color', '#e9eaed' ) ) .'; }';

        if ( get_theme_mod( 'header_color', '#fff' ) ) {
            $output .= '.site-header{ background-color: '.esc_attr( get_theme_mod( 'header_color', '#fff' ) ) .'; }';
        }
        if ( get_theme_mod( 'header_border_color' ) ) {
            $output .= '.site-header{ border-bottom: 1px solid '.esc_attr( get_theme_mod( 'header_border_color' ) ) .'; }';
        }

        // Button color setting...

        $output .= '.common-menu-wrap .nav>li.online-booking-button a, .error-page-inner a.btn.btn-primary.btn-lg,.btn.btn-primary, .package-list-button, .contact-submit input[type=submit]{ background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#0072bc' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#0072bc' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_text_color', '#000' ) ) .' !important; border-radius: '.get_theme_mod( 'button_radius', 4 ).'px; }';


        if ( get_theme_mod( 'button_hover_bg_color', '#005fb2' ) ) {
            $output .= '.error-page-inner a.btn.btn-primary.btn-lg:hover,.btn.btn-primary:hover, .package-list-button:hover, .contact-submit input[type=submit]:hover{ background-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#005fb2' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#005fb2' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_hover_text_color', '#fff' ) ) .' !important; }';
        }

        if ( get_theme_mod( 'navbar_text_color', '#000' ) ) {
            $output .= '.header-solid .common-menu-wrap .nav>li.menu-item-has-children:after, .header-borderimage .common-menu-wrap .nav>li.menu-item-has-children:after, .header-solid .common-menu-wrap .nav>li>a, .header-borderimage .common-menu-wrap .nav>li>a{ color: '.esc_attr( get_theme_mod( 'navbar_text_color', '#000' ) ) .'; }';
        }

        $output .= '.header-solid .common-menu-wrap .nav>li>a:hover, .header-borderimage .common-menu-wrap .nav>li>a:hover{ color: '.esc_attr( get_theme_mod( 'navbar_hover_text_color', '#0072bc' ) ) .'; }';
        $output .= '.header-solid .common-menu-wrap .nav>li>a:hover:after, .header-borderimage .common-menu-wrap .nav>li>a:hover:after{ color: '.esc_attr( get_theme_mod( 'navbar_hover_bracket_color', '#0072bc' ) ) .'; }';

        $output .= '.header-solid .common-menu-wrap .nav>li.active>a, .header-borderimage .common-menu-wrap .nav>li.active>a{ color: '.esc_attr( get_theme_mod( 'navbar_active_text_color', '#0072bc' ) ) .'; }';
        $output .= '.header-solid .common-menu-wrap .nav>li.active>a:after, .header-borderimage .common-menu-wrap .nav>li.active>a:after{ color: '.esc_attr( get_theme_mod( 'navbar_active_bracket_color', '#0072bc' ) ) .'; }';

        if ( get_theme_mod( 'navbar_bracket_color', '#000' ) ) {
            $output .= 'header.header-transparent .common-menu-wrap .nav>li>a:after,header.header-transparent .common-menu-wrap .nav>li>a:before,header.header-solid .common-menu-wrap .nav>li>a:before, header.header-solid .common-menu-wrap .nav>li>a:after, header.header-borderimage .common-menu-wrap .nav>li>a:before, header.header-borderimage .common-menu-wrap .nav>li>a:after{ color: '.esc_attr( get_theme_mod( 'navbar_bracket_color', '#000' ) ) .'; }';
        }

        $output .= '.common-menu-wrap .nav>li ul{ background-color: '.esc_attr( get_theme_mod( 'sub_menu_bg', '#262626' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>ul li a{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color', '#9d9d9d' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'sub_menu_border', '#eef0f2' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>ul li a:hover{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color_hover', '#fff' ) ) .'; background-color: '.esc_attr( get_theme_mod( 'sub_menu_bg_hover', 'rgba(0,0,0,0)' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li > ul::after{ border-color: transparent transparent '.esc_attr( get_theme_mod( 'sub_menu_bg', '#262626' ) ) .' transparent; }';

        $output .= '.themeum-navbar-header .themeum-navbar-brand img{width:'.get_theme_mod( 'logo_width', 77 ).'px; max-width:none;}';

        if (get_theme_mod( 'logo_height' )) {
            $output .= '.themeum-navbar-header .themeum-navbar-brand img{height:'.get_theme_mod( 'logo_height' ).'px;}';
        }

        $output .= '.subtitle-cover:before{background:'.get_theme_mod( 'sub_header_overlayer_color', 'rgba(0, 0, 0, 0.5)' ).';}';
        $output .= '.subtitle-cover h2{font-size:'.get_theme_mod( 'sub_header_title_size', '18' ).'px;color:'.get_theme_mod( 'sub_header_title_color', '#404a51' ).';}';

        $output .= '.breadcrumb>li+li:before, .subtitle-cover .breadcrumb, .subtitle-cover .breadcrumb>.active{color:'.get_theme_mod( 'breadcrumb_text_color', '#000' ).';}';
        $output .= '.subtitle-cover .breadcrumb a{color:'.get_theme_mod( 'breadcrumb_link_color', '#000' ).';}';
        $output .= '.subtitle-cover .breadcrumb a:hover{color:'.get_theme_mod( 'breadcrumb_link_color_hvr', '#000' ).';}';

        $output .= '.subtitle-cover{padding:'.get_theme_mod( 'sub_header_padding_top', '30' ).'px 0 '.get_theme_mod( 'sub_header_padding_bottom', '30' ).'px; margin-bottom: '.get_theme_mod( 'sub_header_margin_bottom', '100' ).'px;}';

        //bottom
        $output .= '.bottom{ background-color: '.esc_attr( get_theme_mod( 'bottom_color', '#0072bc' ) ) .'; }';
        $output .= '.bottom{ color: '.esc_attr( get_theme_mod( 'bottom_text_color', '#ffffff' ) ) .'; }';
        $output .= '.bottom{ padding-top: '. (int) esc_attr( get_theme_mod( 'bottom_padding_top', '90' ) ) .'px; }';
        $output .= '.bottom{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'bottom_padding_bottom', '90' ) ) .'px; }';

        //footer
        $output .= '.footer-wrap{ background-color: '.esc_attr( get_theme_mod( 'footer_color', '#1f1f1f' ) ) .'; }';
        $output .= '.footer-wrap,.footer-wrap  .widget ul li a { color: '.esc_attr( get_theme_mod( 'footer_text_color', '#ffffff' ) ) .'; }';
        $output .= '.footer-wrapper{ padding-top: '. (int) esc_attr( get_theme_mod( 'footer_padding_top', '100' ) ) .'px; }';
        $output .= '.footer-wrapper{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'footer_padding_bottom', '80' ) ) .'px; }';
        $output .= '.footer-copyright{ padding-top: '. (int) esc_attr( get_theme_mod( 'copyright_padding_top', '40' ) ) .'px; }';
        $output .= '.footer-copyright{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'copyright_padding_bottom', '40' ) ) .'px; }';
        $output .= '.footer-copyright,.footer-copyright a{ color: '.esc_attr( get_theme_mod( 'copyright_text_color', '#ffffff' ) ) .'; }';


        $output .= '.common-menu-wrap .nav > li > ul li.mega-child > a{ color: '.esc_attr( get_theme_mod( 'mega_menu_title', '#ffffff' ) ) .'; }';
        $output .= '.common-menu-wrap .nav>li>ul li.mega-child{ border-right-color: '.esc_attr( get_theme_mod( 'mega_menu_border', '#3d3d3d' ) ) .'; }';


        $output .= "body.error404,body.page-template-404{
            width: 100%;
            height: 100%;
            min-height: 100%;
        }";

        return $output;
    }
}

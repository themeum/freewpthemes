<?php

if(!function_exists('eventco_setup')):
    function eventco_setup(){
        load_theme_textdomain( 'eventco', get_parent_theme_file_path() . '/languages' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'eventco-large', 1140, 570, true );
        add_image_size( 'eventco-medium', 660, 400, true );
        add_image_size( 'eventco-portfo', 600, 500, true );
        add_image_size( 'eventco-blog', 467, 330, true );
        add_theme_support( 'post-formats', array( 'audio','gallery','image','link','quote','video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );

        if ( ! isset( $content_width ) ){
            $content_width = 660;
        }
        add_theme_support( 'woocommerce' );
    }
    add_action('after_setup_theme','eventco_setup');
endif;


if(!function_exists('eventco_pagination')):
    function eventco_pagination( $page_numb , $max_page ){
        $big = 999999999;
        echo '<div class="themeum-pagination" data-preview="'.__( "PREV","eventco" ).'" data-nextview="'.__( "NEXT","eventco" ).'">';
        echo paginate_links( array(
            'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'        => '?paged=%#%',
            'current'       => $page_numb,
            'prev_text'     => ('<i class="fa fa-angle-left"></i>'),
            'next_text'     => ('<i class="fa fa-angle-right"></i>'),
            'total'         => $max_page,
            'type'          => 'list',
        ) );
        echo '</div>';
    }
endif;

/*-------------------------------------------------------
 *              Themeum Comment
 *-------------------------------------------------------*/
if(!function_exists('eventco_comment')):
    function eventco_comment($comment, $args, $depth){
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
                <div class="comment-top clearfix">
                    <div class="comment-avartar pull-left">
                        <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
                    </div>
                    <div class="comment-context">
                        <div class="comment-head">
                            <?php printf( '<span class="comment-author">%1$s</span>', get_comment_author_link() ); ?>
                            <span class="comment-date"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_comment_date() ?></span>
                            <?php edit_comment_link( esc_html__( 'Edit', 'eventco' ), '<span class="edit-link">', '</span>' ); ?>
                        </div>
                        <?php if ( '0' == $comment->comment_approved ) : ?>
                            <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'eventco' ); ?></p>
                        <?php endif; ?>
                        <span class="comment-reply">
                            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="fa fa-reply" aria-hidden="true"></i> '.esc_html__( 'Reply', 'eventco' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                        </span>
                    </div>
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
*           EventCo Breadcrumb
*-------------------------------------------------------*/
if(!function_exists('eventco_breadcrumbs')):
    function eventco_breadcrumbs(){ ?>
        <li><a href="<?php echo esc_url(site_url()); ?>" class="breadcrumb_home"><?php esc_html_e('Home', 'eventco') ?><span class="raquo">/</span></a></li>
        <?php
            if(function_exists('is_product')){
                $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
                if(is_product()){
                    echo "<li><a href='".$shop_page_url."'>Shop <span class='raquo'>/</span></a></li>";
                }
            }
        ?>
        <li class="active">
            <span>
                <?php if(function_exists('is_shop')){ if(is_shop()){ esc_html_e('Shop','eventco'); } } ?>
                <?php if( is_tag() ) { ?>
                <?php esc_attr_e('Posts Tagged ', 'eventco') ?><span class="raquo">/</span><?php single_tag_title(); echo('/ '); ?>
                <?php } elseif (is_day()) { ?>
                <?php esc_html_e('Posts made in', 'eventco') ?> <?php the_time('F jS, Y'); ?>
                <?php } elseif (is_month()) { ?>
                <?php esc_html_e('Posts made in', 'eventco') ?> <?php the_time('F, Y'); ?>
                <?php } elseif (is_year()) { ?>
                <?php esc_html_e('Posts made in', 'eventco') ?> <?php the_time('Y'); ?>
                <?php } elseif (is_search()) { ?>
                <?php esc_html_e('Search results for', 'eventco') ?> <?php the_search_query() ?>
                <?php } elseif (is_single()) { ?>
                <?php $category = get_the_category();
                    if ( $category ) {
                        $catlink = get_category_link( $category[0]->cat_ID );
                        echo ('<span class="raquo">Blog Details</span> ');
                    } elseif (get_post_type() == 'product'){
                        echo get_the_title();
                    } elseif (get_post_type() == 'speaker'){
                        echo get_the_title();
                    } elseif (get_post_type() == 'event'){
                        echo __('Event Details', 'eventco');
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
                    esc_html_e('Posts by ', 'eventco'); echo ' ',$curauth->nickname;
                } elseif (is_page()) {
                    echo get_the_title();
                } elseif (is_home()) {
                    esc_html_e('Blog', 'eventco');
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
    if(!function_exists('eventco_my_page_template_redirect')):
        function eventco_my_page_template_redirect()
        {
            if( is_page() || is_home() || is_category() || is_single() )
            {
                if( !is_super_admin( get_current_user_id() ) ){
                    get_template_part( 'coming','soon');
                    exit();
                }
            }
        }
        add_action( 'template_redirect', 'eventco_my_page_template_redirect' );
    endif;

    if(!function_exists('eventco_cooming_soon_wp_title')):
        function eventco_cooming_soon_wp_title(){
            return 'Coming Soon';
        }
        add_filter( 'wp_title', 'eventco_cooming_soon_wp_title' );
    endif;
}

if(!function_exists('eventco_css_generator')){
    function eventco_css_generator(){
        $output = '';

        /* -----------------------------------------------
        -------------      Theme Options   ---------------
        -------------------------------------------------- */
        $major_color = get_theme_mod( 'major_color', '#ff025a' );
        $hover_color = get_theme_mod( 'hover_color', '#ec0354' );

        if($major_color){
            $output .= 'a{ color: '. esc_attr($major_color) .'; }';
        }

        if($major_color){
            $output .= '.btn{ background: '. esc_attr($major_color) .'; }';
        }

        if($major_color){
            # Background Color(background)
            $output .= '#wpneo-tab-reviews .submit, .event-schedule-tab-view ul li.active a, .event-schedule-tab-view ul li a.active, .upcoming-events .head-area .btn:hover, .eventco-search button.event-search-btn, .product-thumbnail-outer:hover .product-content-wrapper, .woocommerce ul.products li.product .onsale{ background: '. esc_attr($major_color) .'; }';
            # Background Color(background-color)
            $output .= '.mc4wp-form-fields button, .eventco-upcoming-event .content-wrap-section a.event-btn, .comments-area .comment-form input[type="submit"], .themeum-pagination span.page-numbers.current, .widget .tagcloud a:hover, .woocommerce div.product span.onsale, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .info-wrapper .btn.btn-eventco{ background-color: '. esc_attr($major_color) .'; }';

            # Text Color
            $output .= '#wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-item>a,#wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li:hover>a, 
            #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-ancestor>a, 
            #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.active>a, #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li:hover>a, #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li.current-menu-ancestor>a, #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li.active>a, #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu li.wpmm-type-widget .wpmm-item-title:hover, .speaker-content .speaker-name-wrap a, .speaker-content .intro-text i.fa.fa-map-marker, .thm-post-meta ul li a:hover, .wrap-btn-style a.thm-btn:hover, .eventco-post .entry-headder h2 a:hover, .eventco-upcoming-event .date i.fa, #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li.current-menu-item>a, ul.wp-megamenu li ul.wp-megamenu-sub-menu .wpmm-vertical-tabs-nav ul li.active>a, ul.wp-megamenu li ul.wp-megamenu-sub-menu .wpmm-vertical-tabs-nav ul li.active, .schedule-style-four .event-schedule-tab-view ul li.active a span, .schedule-style-four .event-schedule-tab-view ul li.active a p, .schedule-style-four .event-schedule-tab-view ul li a.active span, .schedule-style-four .event-schedule-tab-view ul li a.active p, .upcoming_event_style2 .eventco-blog-wrap .date i.fa, .eventco-grid-post .entry-headder h2 a:hover, .widget-blog-posts-section .entry-title a:hover, .widget ul li a:hover, .thm-post-meta ul li i, .date i.fa.fa-clock-o, .woocommerce .product-thumbnail-outer-inner .addtocart-btn a.button:hover, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce a.remove:hover, .woocommerce form .form-row .required, .woocommerce-MyAccount-navigation ul li.is-active a, nav.woocommerce-MyAccount-navigation ul li:hover a{ color: '. esc_attr($major_color) .'!important; }';

            # Border Color
            $output .= 'input:focus, #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.wpmm_mega_menu>ul.wp-megamenu-sub-menu, .wp-megamenu-wrap .wpmm-nav-wrap > ul.wp-megamenu > li.wpmm_dropdown_menu ul.wp-megamenu-sub-menu{ border-color: '. esc_attr($major_color) .'; }';
            $output .= 'li.wpneo-current { border-bottom: 2px solid '. esc_attr($major_color) .'; }';
            $output .= '.btn.btn-border-white:hover{ border: 2px solid '. esc_attr($major_color) .'; } .modal .modal-content .modal-body input[type="submit"]{   background-color: '. esc_attr($major_color) .'; border-color: '. esc_attr($major_color) .'; }';

            # Tab arrow
            $output .= '.event-schedule-tab-view ul li.active a:before, .event-schedule-tab-view ul li a.active:before, .schedule-style-one .event-schedule-tab-view ul li.active a:after, .schedule-style-one .event-schedule-tab-view ul li a.active:after, .schedule-style-three .event-schedule-tab-view ul li.active a:after, .schedule-style-three .event-schedule-tab-view ul li a.active:after, .event-schedule-tab-view ul li.active a:before, .event-schedule-tab-view ul li a.active:before{
                border-top: solid 30px '. esc_attr($major_color) .';
            }';

            $output .= '.schedule-style-two .event-schedule-tab-view ul li.active a:after, .schedule-style-two .event-schedule-tab-view ul li a.active:after{
                border-left: solid 30px '. esc_attr($major_color) .';
            }';

            $output .= '.woocommerce-tabs .nav-tabs>li>a:before {
                border-color: '. esc_attr($major_color) .' rgba(0, 0, 0, 0) rgba(0, 128, 0, 0) rgba(255, 255, 0, 0);
            }';
        }

        if($major_color){
            $output .= '.widget ul li a:hover, .info-wrapper .btn.btn-eventco{ border-color: '. esc_attr($major_color) .';  }';
        }

        if($major_color){
            $output .= '{ background: '. esc_attr($major_color) .'; border-color: '. esc_attr($major_color) .'; }';
        }
        if($hover_color){
            $output .= '.eventco-login-register a.eventco-dashboard:hover, .mc4wp-form-fields button:hover{
                background: '.esc_attr($hover_color).';
            }';
        }

        $scolor = get_post_meta(get_the_ID(), 'themeum_subtitle_color', true);
        $output .= '.subtitle-cover::before { background: '. $scolor .' }';

        if( get_theme_mod( 'custom_preset_en', true ) ) {
            $hover_color = get_theme_mod( 'hover_color', '#D5014A' );
            if( $hover_color ){
                $output .= 'a:hover, .widget.widget_rss ul li a,.main-menu-wrap .navbar-toggle:hover,.footer-copyright a:hover,.entry-summary .wrap-btn-style a.btn-style:hover{ color: '.esc_attr( $hover_color ) .'; }';
                $output .= '.error-page-inner a.btn.btn-primary.btn-lg:hover,.btn.btn-primary:hover,input[type=button]:hover,
                .widget.widget_search #searchform .btn-search:hover,.team-content2,
                .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.order-view .label-info:hover, .eventco-upcoming-event .content-wrap-section a.event-btn:hover, .info-wrapper .btn.btn-eventco:hover{ background-color: '.esc_attr( $hover_color ) .'; }';
                $output .= '.woocommerce a.button:hover, .info-wrapper .btn.btn-eventco:hover{ border-color: '.esc_attr( $hover_color ) .'; }';
            }
        }

        /* -----------------------------------------------
        ------------------  Quick Style ------------------
        -------------------------------------------------- */

        $bstyle = $mstyle = $h1style = $h2style = $h3style = $h4style = $h5style = '';
        # Header body
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
            $bstyle .= 'line-height: '.get_theme_mod('body_font_height', '16').'px;';
        }
        if ( get_theme_mod('body_font_color', '#000') ) {
            $bstyle .= 'color: '.get_theme_mod('body_font_color', '#000').';';
        }

        # Main Menu
        $mstyle = '';
        if ( get_theme_mod( 'menu_font_size', '14' ) ) {
            $mstyle .= 'font-size:'.get_theme_mod( 'menu_font_size', '14' ).'px;';
        }
        if ( get_theme_mod( 'menu_google_font', 'Montserrat' ) ) {
            $mstyle .= 'font-family:'.get_theme_mod( 'menu_google_font', 'Montserrat' ).';';
        }
        if ( get_theme_mod( 'menu_font_weight', '400' ) ) {
            $mstyle .= 'font-weight: '.get_theme_mod( 'menu_font_weight', '500' ).';';
        }
        if ( get_theme_mod('menu_font_height', '30') ) {
            $mstyle .= 'line-height: '.get_theme_mod('menu_font_height', '30').'px;';
        }
        if ( get_theme_mod('menu_font_color', '#000') ) {
            $mstyle .= 'color: '.get_theme_mod('menu_font_color', '#000').';';
        }


        # Header Ticket Button
        $ticket_bg_color            = get_theme_mod( 'ticket_bg_color', '#8dc63f' );
        $ticket_bg_hover_color      = get_theme_mod( 'ticket_bg_hover_color', '#83bb36' );
        $ticket_text_color          = get_theme_mod( 'ticket_text_color', '#fff' );
        $ticket_text_hover_color    = get_theme_mod( 'ticket_text_hover_color', '#fff' );
        if($ticket_bg_color){
            $output .= '.common-menu-wrap li.get_ticket{
                background-color: '.esc_attr($ticket_bg_color).';
            }';
        }
        if($ticket_bg_hover_color){
            $output .= '.common-menu-wrap li.get_ticket:hover{
                background-color: '.esc_attr($ticket_bg_hover_color).';
            }';
        }
        if($ticket_text_color){
            $output .= '.get_ticket a{
                color: '.esc_attr($ticket_text_color).'!important;
            }';
        }
        if($ticket_text_hover_color){
            $output .= '.common-menu-wrap .get_ticket:hover a, #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.get_ticket:hover>a{
                color: '.esc_attr($ticket_text_hover_color).'!important;
            }';
        }
        # Ticket End.


        # Heading1
        $h1style = '';
        if ( get_theme_mod( 'h1_font_size', '42' ) ) {
            $h1style .= 'font-size:'.get_theme_mod( 'h1_font_size', '42' ).'px;';
        }
        if ( get_theme_mod( 'h1_google_font', 'Montserrat' ) ) {
            $h1style .= 'font-family:'.get_theme_mod( 'h1_google_font', 'Montserrat' ).';';
        }
        if ( get_theme_mod( 'h1_font_weight', '600' ) ) {
            $h1style .= 'font-weight: '.get_theme_mod( 'h1_font_weight', '700' ).';';
        }
        if ( get_theme_mod('h1_font_height', '42') ) {
            $h1style .= 'line-height: '.get_theme_mod('h1_font_height', '42').'px;';
        }
        if ( get_theme_mod('h1_font_color', '#333') ) {
            $h1style .= 'color: '.get_theme_mod('h1_font_color', '#333').';';
        }

        # heading2
        $h2style = '';
        if ( get_theme_mod( 'h2_font_size', '36' ) ) {
            $h2style .= 'font-size:'.get_theme_mod( 'h2_font_size', '36' ).'px;';
        }
        if ( get_theme_mod( 'h2_google_font', 'Montserrat' ) ) {
            $h2style .= 'font-family:'.get_theme_mod( 'h2_google_font', 'Montserrat' ).';';
        }
        if ( get_theme_mod( 'h2_font_weight', '700' ) ) {
            $h2style .= 'font-weight: '.get_theme_mod( 'h2_font_weight', '600' ).';';
        }
        if ( get_theme_mod('h2_font_height', '42') ) {
            $h2style .= 'line-height: '.get_theme_mod('h2_font_height', '42').'px;';
        }
        if ( get_theme_mod('h2_font_color', '#333') ) {
            $h2style .= 'color: '.get_theme_mod('h2_font_color', '#333').';';
        }

        # heading3
        $h3style = '';
        if ( get_theme_mod( 'h3_font_size', '26' ) ) {
            $h3style .= 'font-size:'.get_theme_mod( 'h3_font_size', '26' ).'px;';
        }
        if ( get_theme_mod( 'h3_google_font', 'Montserrat' ) ) {
            $h3style .= 'font-family:'.get_theme_mod( 'h3_google_font', 'Montserrat' ).';';
        }
        if ( get_theme_mod( 'h3_font_weight', '700' ) ) {
            $h3style .= 'font-weight: '.get_theme_mod( 'h3_font_weight', '600' ).';';
        }
        if ( get_theme_mod('h3_font_height', '28') ) {
            $h3style .= 'line-height: '.get_theme_mod('h3_font_height', '28').'px;';
        }
        if ( get_theme_mod('h3_font_color', '#333') ) {
            $h3style .= 'color: '.get_theme_mod('h3_font_color', '#333').';';
        }

        # heading4
        $h4style = '';
        if ( get_theme_mod( 'h4_font_size', '18' ) ) {
            $h4style .= 'font-size:'.get_theme_mod( 'h4_font_size', '18' ).'px;';
        }
        if ( get_theme_mod( 'h4_google_font', 'Montserrat' ) ) {
            $h4style .= 'font-family:'.get_theme_mod( 'h4_google_font', 'Montserrat' ).';';
        }
        if ( get_theme_mod( 'h4_font_weight', '700' ) ) {
            $h4style .= 'font-weight: '.get_theme_mod( 'h4_font_weight', '600' ).';';
        }
        if ( get_theme_mod('h4_font_height', '26') ) {
            $h4style .= 'line-height: '.get_theme_mod('h4_font_height', '26').'px;';
        }
        if ( get_theme_mod('h4_font_color', '#333') ) {
            $h4style .= 'color: '.get_theme_mod('h4_font_color', '#333').';';
        }

        # Heading5
        $h5style = '';
        if ( get_theme_mod( 'h5_font_size', '16' ) ) {
            $h5style .= 'font-size:'.get_theme_mod( 'h5_font_size', '16' ).'px;';
        }
        if ( get_theme_mod( 'h5_google_font', 'Montserrat' ) ) {
            $h5style .= 'font-family:'.get_theme_mod( 'h5_google_font', 'Montserrat' ).';';
        }
        if ( get_theme_mod( 'h5_font_weight', '700' ) ) {
            $h5style .= 'font-weight: '.get_theme_mod( 'h5_font_weight', '600' ).';';
        }
        if ( get_theme_mod('h5_font_height', '24') ) {
            $h5style .= 'line-height: '.get_theme_mod('h5_font_height', '24').'px;';
        }
        if ( get_theme_mod('h5_font_color', '#333') ) {
            $h5style .= 'color: '.get_theme_mod('h5_font_color', '#333').';';
        }

        $output .= 'body{'.$bstyle.'}';
        $output .= '.common-menu-wrap .nav>li>a, .thm-explore ul li a, .thm-explore a, .common-menu-wrap .nav> li > ul li a, .common-menu-wrap .nav > li > ul li.mega-child > a{'.$mstyle.'}';
        $output .= 'h1{'.$h1style.'}';
        $output .= 'h2{'.$h2style.'}';
        $output .= 'h3{'.$h3style.'}';
        $output .= 'h4{'.$h4style.'}';
        $output .= 'h5{'.$h5style.'}';


        #Header
        if ( get_theme_mod( 'header_color', '#fff' ) ) {
            $output .= '.site-header{ background: '.esc_attr( get_theme_mod( 'header_color', '#fff' ) ) .'; }';
        }

        # Shop Sub Header OverLay Color
        $themeum_subtitle_color = get_post_meta( get_the_ID(), 'themeum_subtitle_color', true );
        if ( $themeum_subtitle_color )  {
            $output .= '.eventco-overlay-cont .subtitle-cover::before{ background: '. $themeum_subtitle_color .'; }';
        }

        $output .= '.site-header{ padding-top: '. (int) esc_attr( get_theme_mod( 'header_padding_top', '20' ) ) .'px; }';
        $output .= '.site-header{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'header_padding_bottom', '10' ) ) .'px; }';

        //sticky Header
        if ( get_theme_mod( 'header_fixed', false ) ){
            $output .= '.site-header.sticky{ position:fixed;top:0;left:auto; z-index:99999;margin:0 auto; width:100%;-webkit-animation: fadeInDown 300ms;animation: fadeInDown 300ms;}';
            $output .= '.site-header.sticky.header-transparent .main-menu-wrap{ margin-top: 0;}';
            if ( get_theme_mod( 'sticky_header_color', '#fff' ) ){
                $sticybg = get_theme_mod( 'sticky_header_color', '#fff');
                $output .= '.site-header.sticky{ background-color: '.$sticybg.';}';
            }
            $output .= '@keyframes fadeInDown {
              from {
                opacity: 0;
                transform: translate3d(0, -50%, 0);
              }

              to {
                opacity: 1;
                transform: none;
              }
            }';
        }
        
        # Logo
        if (get_theme_mod( 'logo_width' )) {
            $output .= '.themeum-navbar-header .themeum-navbar-brand img{width:'.get_theme_mod( 'logo_width', 150 ).'px; max-width:none;}';
        }
        if (get_theme_mod( 'logo_height' )) {
            $output .= '.themeum-navbar-header .themeum-navbar-brand img{height:'.get_theme_mod( 'logo_height' ).'px;}';
        }

        # sub header
        $output .= '.subtitle-cover h2{font-size:'.get_theme_mod( 'sub_header_title_size', '88' ).'px;color:'.get_theme_mod( 'sub_header_title_color', '#000' ).';}';
        $output .= '.breadcrumb>li+li:before, .subtitle-cover .breadcrumb, .subtitle-cover .breadcrumb>.active{color:'.get_theme_mod( 'breadcrumb_text_color', '#fff' ).';}';
        $output .= '.subtitle-cover .breadcrumb a{color:'.get_theme_mod( 'breadcrumb_link_color', '#fff' ).';}';
        $output .= '.subtitle-cover .breadcrumb a:hover{color:'.get_theme_mod( 'breadcrumb_link_color_hvr', '#fff' ).';}';

        $output .= '.subtitle-cover{background:'.get_theme_mod( 'sub_header_bg_color', '#333' ).'; padding:'.get_theme_mod( 'sub_header_padding_top', '150' ).'px 0 '.get_theme_mod( 'sub_header_padding_bottom', '150' ).'px; margin-bottom: '.get_theme_mod( 'sub_header_margin_bottom', '100' ).'px;}';

        # body
        if (get_theme_mod( 'body_bg_img')) {
            $output .= 'body{ background-image: url("'.esc_attr( get_theme_mod( 'body_bg_img' ) ) .'");background-size: '.esc_attr( get_theme_mod( 'body_bg_size', 'cover' ) ) .';    background-position: '.esc_attr( get_theme_mod( 'body_bg_position', 'left top' ) ) .';background-repeat: '.esc_attr( get_theme_mod( 'body_bg_repeat', 'no-repeat' ) ) .';background-attachment: '.esc_attr( get_theme_mod( 'body_bg_attachment', 'fixed' ) ) .'; }';
        }
        $output .= 'body{ background-color: '.esc_attr( get_theme_mod( 'body_bg_color', '#fff' ) ) .'; }';


        # Button color setting...
        $output .= '.btn.btn-eventco{ background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#ff025a' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#ff025a' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_text_color', '#fff' ) ) .' !important; }';
        $output .= '.eventco-login-register a.eventco-dashboard{ background-color: '.esc_attr( get_theme_mod( 'button_bg_color', '#ff025a' ) ) .'; }';


        if ( get_theme_mod( 'button_hover_bg_color', '#D5014A' ) ) {
            $output .= '.btn.btn-eventco:hover{ background-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#e20451' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'button_hover_bg_color', '#e20451' ) ) .'; color: '.esc_attr( get_theme_mod( 'button_hover_text_color', '#fff' ) ) .' !important; }';
        }

        # menu color
        if ( get_theme_mod( 'navbar_text_color', '#000' ) ) {
            $output .= '.header-solid .common-menu-wrap .nav>li.menu-item-has-children:after, .header-borderimage .common-menu-wrap .nav>li.menu-item-has-children:after, .header-solid .common-menu-wrap .nav>li>a, .header-borderimage .common-menu-wrap .nav>li>a,
            .header-solid .common-menu-wrap .nav>li>a:after, .header-borderimage .common-menu-wrap .nav>li>a:after,.eventco-search{ color: '.esc_attr( get_theme_mod( 'navbar_text_color', '#000' ) ) .'; }';
        }

        $output .= '.header-solid .common-menu-wrap .nav>li>a:hover, .header-borderimage .common-menu-wrap .nav>li>a:hover,.header-solid .common-menu-wrap .nav>li>a:hover:after, .header-borderimage .common-menu-wrap .nav>li>a:hover:after,
        .eventco-search-wrap a.eventco-search:hover{ color: '.esc_attr( get_theme_mod( 'navbar_hover_text_color', '#ff025a' ) ) .'; }';

        $output .= '.header-solid .common-menu-wrap .nav>li.active>a, .header-borderimage .common-menu-wrap .nav>li.active>a{ color: '.esc_attr( get_theme_mod( 'navbar_active_text_color', '#ff025a' ) ) .'; }';

        # submenu color
        $output .= '.common-menu-wrap .nav>li ul{ background-color: '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .'; }';

        $output .= '.common-menu-wrap .nav>li>ul li a,.common-menu-wrap .nav > li > ul li.mega-child > a{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color', '#000' ) ) .'; border-color: '.esc_attr( get_theme_mod( 'sub_menu_border', '#eef0f2' ) ) .'; }';

        $output .= '.common-menu-wrap .nav>li>ul li a:hover,
        .common-menu-wrap .sub-menu li.active a,.common-menu-wrap .sub-menu li.active.mega-child .active a,
        .common-menu-wrap .sub-menu.megamenu > li.active.mega-child > a,.common-menu-wrap .nav > li > ul li.mega-child > a:hover,.common-menu-wrap .nav>li.current-menu-parent.menu-item-has-children > a:after,.common-menu-wrap .nav>li.current-menu-item.menu-item-has-children > a:after { color: '.esc_attr( get_theme_mod( 'sub_menu_text_color_hover', '#ff025a' ) ) .';}';
        $output .= '.common-menu-wrap .nav>li > ul::after{ border-color: transparent transparent '.esc_attr( get_theme_mod( 'sub_menu_bg', '#262626' ) ) .' transparent; }';

        //bottom
        $output .= '.bottom .widget ul li a{ color: '.esc_attr( get_theme_mod( 'bottom_text_color', '#dedede' ) ) .'; }';

        $output .= '.bottom-wrap{ padding-top: '. (int) esc_attr( get_theme_mod( 'bottom_padding_top', '100' ) ) .'px; }';

        $output .= '.bottom-wrap{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'bottom_padding_bottom', '124' ) ) .'px; }';

        //footer
        $output .= '#footer{ padding-top: '. (int) esc_attr( get_theme_mod( 'copyright_padding_top', '30' ) ) .'px; }';
        $output .= '#footer{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'copyright_padding_bottom', '30' ) ) .'px; }';
        $output .= '.footer-copyright, .footer-copyright a{ color: '.esc_attr( get_theme_mod( 'copyright_text_color', '#fff' ) ) .'; font-weight: 600; }';



        $output .= "body.error404,body.page-template-404{
            width: 100%;
            height: 100%;
            min-height: 100%;}";

        return $output;
    }
}

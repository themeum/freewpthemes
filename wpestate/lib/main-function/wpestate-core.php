<?php

/*-------------------------------------------------------
 *              wpestate Supports and Image Cut
 *-------------------------------------------------------*/
if(!function_exists('wpestate_setup')):

    function wpestate_setup(){
        load_theme_textdomain( 'wpestate', get_template_directory() . '/languages' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'wpestate-large', 1200, 750, true );
        add_image_size( 'wpestate-map-info', 250, 180, true );
        add_image_size( 'wpestate-property', 600, 350, true );
        add_image_size( 'wpestate-blog-medium', 352, 260, true );
        add_image_size( 'wpestate-area', 650, 450, true );
        add_image_size( 'wpestate-gallery', 550, 590, true );
        add_theme_support( 'post-formats', array( 'audio','gallery','image','link','quote','video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );
        if ( ! isset( $content_width ) ){
            $content_width = 660;
        }
    }
    add_action('after_setup_theme','wpestate_setup');

endif;

/*-------------------------------------------------------
 *              wpestate Pagination
 *-------------------------------------------------------*/
if(!function_exists('wpestate_pagination')):

    function wpestate_pagination( $page_numb , $max_page ){
        $big = 999999999;
        echo '<div class="wpestate-pagination">';
        echo paginate_links( array(
            'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'        => '?paged=%#%',
            'current'       => $page_numb,
            'prev_text'     => __('<i class="fa fa-angle-left" aria-hidden="true"></i>','wpestate'),
            'next_text'     => __('<i class="fa fa-angle-right" aria-hidden="true"></i>','wpestate'),
            'total'         => $max_page,
            'type'          => 'list',
        ) );
        echo '</div>';
    }

endif;




/*-------------------------------------------------------
 *              wpestate Comment
 *-------------------------------------------------------*/
if(!function_exists('wpestate_comment')):

    function wpestate_comment($comment, $args, $depth){
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            ?>		
              <div class="pingback-list">		
                <span class="pinglist-title"><?php esc_html_e( 'Pingback:', 'wpestate' ); ?></span>		
               <?php 		
                 printf( '<span class="comment-author">%1$s</span>',		
                     get_comment_author_link());		
                       edit_comment_link( esc_html__( 'Edit', 'wpestate' ), '<span class="edit-link">', '</span>' );		
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
            <div id="comment-<?php comment_ID(); ?>" class="comment-body">
                <div class="comment-avartar pull-left">
                    <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
                </div>
                <div class="comment-context">
                    <div class="comment-head">
                        <?php echo '<span class="comment-author">' . get_comment_author() . '</span>'; ?>
                        <span class="comment-date"><?php echo get_comment_date() ?></span>
                        <?php edit_comment_link( esc_html__( 'Edit', 'wpestate' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'wpestate' ); ?></p>
                    <?php endif; ?>
                    
                    <div class="comment-content">
                        <?php comment_text(); ?>
                    </div>
                    <span class="comment-reply">
                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => ''.esc_html__( 'Reply', 'wpestate' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </span>
                </div>
                
            </div>
        <?php
            break;
        endswitch;
    }

endif;


/*-------------------------------------------------------
*           wpestate Breadcrumb
*-------------------------------------------------------*/
if(!function_exists('wpestate_breadcrumbs')):
function wpestate_breadcrumbs(){ ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo esc_url(site_url()); ?>" class="breadcrumb_home"><?php esc_html_e('Home', 'wpestate') ?></a></li>
        <?php
            if(function_exists('is_product')){
                $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
                if(is_product()){
                    echo "<li><a href='".$shop_page_url."'>shop</a></li>";
                }
            }
        ?>
        <li class="active">

                    <?php if(function_exists('is_shop')){ if(is_shop()){ esc_html_e('shop','wpestate'); } } ?>

                    <?php if( is_tag() ) { ?>
                    <?php esc_html_e('Posts Tagged ', 'wpestate') ?><span class="raquo">/</span><?php single_tag_title(); echo('/'); ?>
                    <?php } elseif (is_day()) { ?>
                    <?php esc_html_e('Posts made in', 'wpestate') ?> <?php the_time('F jS, Y'); ?>
                    <?php } elseif (is_month()) { ?>
                    <?php esc_html_e('Posts made in', 'wpestate') ?> <?php the_time('F, Y'); ?>
                    <?php } elseif (is_year()) { ?>
                    <?php esc_html_e('Posts made in', 'wpestate') ?> <?php the_time('Y'); ?>
                    <?php } elseif (is_search()) { ?>
                    <?php esc_html_e('Search results for', 'wpestate') ?> <?php the_search_query() ?>
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
                    $wpestate_taxonomy_links = array();
                    $wpestate_term = get_queried_object();
                    $wpestate_term_parent_id = $wpestate_term->parent;
                    $wpestate_term_taxonomy = $wpestate_term->taxonomy;

                    while ( $wpestate_term_parent_id ) {
                        $wpestate_current_term = get_term( $wpestate_term_parent_id, $wpestate_term_taxonomy );
                        $wpestate_taxonomy_links[] = '<a href="' . esc_url( get_term_link( $wpestate_current_term, $wpestate_term_taxonomy ) ) . '" title="' . esc_attr( $wpestate_current_term->name ) . '">' . esc_html( $wpestate_current_term->name ) . '</a>';
                        $wpestate_term_parent_id = $wpestate_current_term->parent;
                    }

                    if ( !empty( $wpestate_taxonomy_links ) ) echo implode( ' <span class="raquo">/</span> ', array_reverse( $wpestate_taxonomy_links ) ) . ' <span class="raquo">/</span> ';

                    echo esc_html( $wpestate_term->name );
                } elseif (is_author()) {
                    global $wp_query;
                    $curauth = $wp_query->get_queried_object();

                    esc_html_e('Posts by ', 'wpestate'); echo ' ',$curauth->nickname;
                } elseif (is_page()) {
                    echo get_the_title();
                } elseif (is_home()) {
                    esc_html_e('Blog', 'wpestate');
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
    if(!function_exists('wpestate_my_page_template_redirect')):
        function wpestate_my_page_template_redirect()
        {
            if( is_page() || is_home() || is_category() || is_single() )
            {
                if( !is_super_admin( get_current_user_id() ) ){
                    get_template_part( 'coming','soon');
                    exit();
                }
            }
        }
        add_action( 'template_redirect', 'wpestate_my_page_template_redirect' );
    endif;

    if(!function_exists('wpestate_cooming_soon_wp_title')):
        function wpestate_cooming_soon_wp_title(){
            return 'Coming Soon';
        }
        add_filter( 'wp_title', 'wpestate_cooming_soon_wp_title' );
    endif;
}




/*-----------------------------------------------------
 *              CSS Generator
 *----------------------------------------------------*/
if(!function_exists('wpestate_css_generator')){
    function wpestate_css_generator(){

        $output = '';

        $preset = get_theme_mod( 'preset', '1' );
        if( $preset ){

            if( get_theme_mod( 'custom_preset_en', true ) ) {

                // CSS Color
                $major_color = get_theme_mod( 'major_color', '#007b76' );
                if($major_color){
                    $output .= '
                    a,
                    .view-all-link:hover,
                    .menu-footer-menu a:hover,
                    .property-grid-content:hover .property-grid-name a,
                    a.forgot-pass-link:hover,
                    .btn-property-search,
                    .thm-love-btn.active,
                    .subtitle-cover h2,
                    .wpestate-navbar-brand h1:hover,
                    #comingsoon-countdown .countdown-amount,
                    .header-search form button:hover,
                    .upload-video-btn,
                    .login-link a:hover,
                    .login-link a:hover:after,
                    .wpneo-listings-dashboard .wpneo-listing-content h4 a:hover,
                    .agent-info-contact .agent-name a:hover,
                    .agent-single-col a h4:hover,
                    .wpestate-index-post.sticky::after,
                    .property-feature-list ul li i,
                    .property-grid-name a:hover,
                    .agent-social-link a:hover,
                    .user-info-left p.designation,
                    .property-content-tab ul li a.nav-link.active,
                    .comment-body .comment-context .comment-reply a,
                    .wpestate-post-meta ul li a:hover,
                    .price-single-right .property-price-tag,
                    .property-single-top .property-price-right .property-price-tag,
                    .comingsoon .mc4wp-form-fields input[type=submit],
                    header.header-solid #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-ancestor>a,
                    .bottom-widget .widget ul li a:hover,
                    #bottom-wrap .widget_wpestate_social_share_widget .wpestate-social-share li a:hover,
                    .single-next span.next-post:hover a,
                    .single-pre span.previous-post:hover a,
                    .wpestate-post .content-item-title a:hover,
                    .wpestate-default-postbox .blog-date-wrapper,
                    .social-share ul li:hover a,
                    .search-wrap .search-tag a:hover,
                    #sidebar #searchform:hover::after,
                    .wpestate-pagination .page-numbers li a.next.page-numbers:hover, 
                    .wpestate-pagination .page-numbers li a.prev:hover,
                    span.portfolio-count:hover, .portfolio-count a.all_portfolio_link:hover,
                    strong.theme-color,
                    .portfolioFilter span.portfolio-count p,
                    .wpestate-post-meta ul li i,
                    .wpestate-widgets.media .widget-post-cat a,
                    #sidebar .widget.widget_categories ul li a:hover,
                    #sidebar .widget ul li a:hover,
                    .subtitle-cover .breadcrumb li a:hover,
                    #wp-megamenu-primary>.wpmm-nav-wrap .wp-megamenu>li>ul.wp-megamenu-sub-menu li.wpmm-type-widget:hover>a,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li.current-menu-item>a,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-ancestor>a,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li.active>a,
                    .widget ul li a:hover,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li:hover>a,
                    .widget-blog-posts-section .entry-title  a:hover,
                    .entry-header h2.entry-title.blog-entry-title a:hover,
                    .entry-summary .wrap-btn-style a.btn-style:hover,
                    .main-menu-wrap .navbar-toggle:hover,
                    .woocommerce .star-rating span:before,
                    .wpestate-post .blog-post-meta li a:hover,
                    .wpestate-post .blog-post-meta li i,
                    #mobile-menu ul li.active>a,
                    #mobile-menu ul li a:hover,
                    .btn.btn-border-wpestate,
                    .entry-summary .wrap-btn-style a.btn-style:hover,
                    .social-share-wrap ul li a:hover,
                    .overlay-btn,
                    .wpestate-post .blog-post-meta li a,
                    .wpestate-post .blog-post-meta li,
                    .wpestate-widgets a:hover,.elementor-accordion-title.active .elementor-accordion-icon i,
                    .header-solid .common-menu-wrap .nav>li.active>a:after
                    { color: '. esc_attr($major_color) .'; }';
                }

                //Css Color Important
                if($major_color){
                    $output .= '.filterable-portfolio .portfolioFilter a:hover
                    {color: '.$major_color.' !important}';
                } 

                // CSS Background Color
                if($major_color){
                    $output .= '
                    .widget .tagcloud a:hover,
                    .btn-search-city,
                    .wp-crowd-btn-primary,
                    .btn-property-search:hover,
                    .property-status span.p_featured,
                    .modal-inner-content input.submit_button,
                    #sidebar .widget.widget_categories ul.children li a::before,
                    .navigation.pagination .page-numbers.current,
                    .navigation.pagination a.page-numbers:hover,
                    .next-step-btn,
                    a.fav-view-link,
                    .btn-img-upload,
                    .cancel-btn:hover,
                    .get_map,
                    .entry-summary input[type=submit],
                    .grid-list-view span.grid-view.active,
                    .grid-list-view span.list-view.active,
                    .view-all-link:hover:after,
                    .search-cta-btn,
                    .agent-contact-form input.form-control.btn-submit,
                    .modal-header .close,
                    .property-pdf-download a,
                    .property-content-tab ul li a.nav-link.active::after,
                    a.btn-submit-property:hover,
                    #sidebar #searchform::after,
                    .wpestate-pagination .page-numbers li a:hover, 
                    .wpestate-pagination .page-numbers li span:hover,
                    .wpestate-pagination .page-numbers li span.current,
                    .style-chooser .toggler:hover,
                    .comingsoon .mc4wp-form-fields input[type=submit]:hover,
                    #main-menu .wp-megamenu-wrap .wpmm-nav-wrap > ul > li.wpmm-social-link-search:hover a,
                    .blog-no-img .wpestate-post:hover,
                    .wpestate-default-postbox:hover,
                    .wpmm-gridcontrol-left:hover, 
                    .wpmm-gridcontrol-right:hover,
                    .form-submit input[type=submit],
                    .widget .tagcloud a:hover,
                    .single_related:hover .overlay-content
                    { background: '. esc_attr($major_color) .'; }';

                } 
                //Css Background Important
                if($major_color){
                    $output .= '.filterable-portfolio .portfolioFilter a:hover,
                    .btn-primary,
                    .property-testimonial-wrap.layout-two .slick-dots li.slick-active button
                    {background: '.$major_color.' !important}';
                }

                // CSS Border
                if($major_color){
                    $output .= '
                    input:focus,
                    .frontend-submit-wrap .nav-tabs .nav-link.active span.tab-bullet-top,
                    .frontend-submit-wrap .nav-tabs .nav-link.active,
                    .btn-property-search,
                    .entry-summary input[type=submit],
                    .grid-list-view span.grid-view.active,
                    .grid-list-view span.list-view.active,
                    .comments-area .comment-form input[type=text]:focus,
                    .frontend-box-inner .form-control:focus,
                    .widget .tagcloud a:hover,
                    textarea:focus,
                    .wpmm-gridcontrol-left:hover, 
                    .wpmm-gridcontrol-right:hover,
                    keygen:focus,
                    select:focus,
                    .wpestate-latest-post-content .entry-title a:hover,
                    .common-menu-wrap .nav>li.current>a,
                    .header-solid .common-menu-wrap .nav>li.current>a,
                    .latest-review-single-layout2 .latest-post-title a:hover,
                    .blog-arrows a:hover,
                    .wpcf7-submit,
                    .wpestate-pagination .page-numbers li a:hover,
                    .wpestate-pagination .page-numbers li span.current,
                    .wpcf7-form input:focus,
                    .btn.btn-border-wpestate,
                    .btn.btn-border-white:hover
                    { border-color: '. esc_attr($major_color) .'; }';
                }

                // CSS Background Color & Border
                if($major_color){
                    $output .= '    
                    .wpcf7-submit:hover,
                    .mc4wp-form-fields .send-arrow button,
                    .post-meta-info-list-in a:hover
                    {   background-color: '. esc_attr($major_color) .'; border-color: '. esc_attr($major_color) .'; }';
                }

            }

            // Custom Color
            if( get_theme_mod( 'custom_preset_en', true ) ) {
                $hover_color = get_theme_mod( 'hover_color', '#330f33' );
                if( $hover_color ){
                    $output .= 'a:hover,
                    .widget.widget_rss ul li a,
                    .footer-copyright a:hover,
                    .entry-summary .wrap-btn-style a.btn-style:hover{ color: '.esc_attr( $hover_color ) .'; }';
                    
                    $output .= '.error-page-inner a.btn.btn-primary.btn-lg:hover,
                    .btn.btn-primary:hover,
                    input[type=button]:hover,
                    .widget.widget_search #searchform .btn-search:hover{ background-color: '.esc_attr( $hover_color ) .'; }';
                }
            }
        }

        $bstyle = $mstyle = $h1style = $h2style = $h3style = $h4style = $h5style = '';
        //body
        if ( get_theme_mod( 'body_font_size', '14' ) ) { $bstyle .= 'font-size:'.get_theme_mod( 'body_font_size', '14' ).'px;'; }
        if ( get_theme_mod( 'body_google_font', 'Muli' ) ) { $bstyle .= 'font-family:'.get_theme_mod( 'body_google_font', 'Muli' ).';'; }
        if ( get_theme_mod( 'body_font_weight', '400' ) ) { $bstyle .= 'font-weight: '.get_theme_mod( 'body_font_weight', '400' ).';'; }
        if ( get_theme_mod('body_font_height', '24') ) { $bstyle .= 'line-height: '.get_theme_mod('body_font_height', '24').'px;'; }
        if ( get_theme_mod('body_font_color', '#4F5052') ) { $bstyle .= 'color: '.get_theme_mod('', '#4F5052').';'; }

        //menu
        $mstyle = '';
        if ( get_theme_mod( 'menu_font_size', '14' ) ) { $mstyle .= 'font-size:'.get_theme_mod( 'menu_font_size', '16' ).'px;'; }
        if ( get_theme_mod( 'menu_google_font', 'Muli' ) ) { $mstyle .= 'font-family:'.get_theme_mod( 'menu_google_font', 'Muli' ).';'; }
        if ( get_theme_mod( 'menu_font_weight', '500' ) ) { $mstyle .= 'font-weight: '.get_theme_mod( 'menu_font_weight', '500' ).';'; }
        if ( get_theme_mod('menu_font_height', '40') ) { $mstyle .= 'line-height: '.get_theme_mod('menu_font_height', '54').'px;'; }
        if ( get_theme_mod('menu_font_color', '#330f33') ) { $mstyle .= 'color: '.get_theme_mod('menu_font_color', '#330f33').';'; }

        //heading1
        $h1style = '';
        if ( get_theme_mod( 'h1_font_size', '42' ) ) { $h1style .= 'font-size:'.get_theme_mod( 'h1_font_size', '42' ).'px;'; }
        if ( get_theme_mod( 'h1_google_font', 'Muli' ) ) { $h1style .= 'font-family:'.get_theme_mod( 'h1_google_font', 'Muli' ).';'; }
        if ( get_theme_mod( 'h1_font_weight', '600' ) ) { $h1style .= 'font-weight: '.get_theme_mod( 'h1_font_weight', '700' ).';'; }
        if ( get_theme_mod('h1_font_height', '42') ) { $h1style .= 'line-height: '.get_theme_mod('h1_font_height', '42').'px;'; }
        if ( get_theme_mod('h1_font_color', '#333') ) { $h1style .= 'color: '.get_theme_mod('h1_font_color', '#333').';'; }

        # heading2
        $h2style = '';
        if ( get_theme_mod( 'h2_font_size', '32' ) ) { $h2style .= 'font-size:'.get_theme_mod( 'h2_font_size', '32' ).'px;'; }
        if ( get_theme_mod( 'h2_google_font', 'Muli' ) ) { $h2style .= 'font-family:'.get_theme_mod( 'h2_google_font', 'Muli' ).';'; }
        if ( get_theme_mod( 'h2_font_weight', '600' ) ) { $h2style .= 'font-weight: '.get_theme_mod( 'h2_font_weight', '600' ).';'; }
        if ( get_theme_mod('h2_font_height', '48') ) { $h2style .= 'line-height: '.get_theme_mod('h2_font_height', '48').'px;'; }
        if ( get_theme_mod('h2_font_color', '#3b3d40') ) { $h2style .= 'color: '.get_theme_mod('h2_font_color', '#3b3d40').';'; }

        //heading3
        $h3style = '';
        if ( get_theme_mod( 'h3_font_size', '26' ) ) { $h3style .= 'font-size:'.get_theme_mod( 'h3_font_size', '26' ).'px;'; }
        if ( get_theme_mod( 'h3_google_font', 'Muli' ) ) { $h3style .= 'font-family:'.get_theme_mod( 'h3_google_font', 'Muli' ).';'; }
        if ( get_theme_mod( 'h3_font_weight', '600' ) ) { $h3style .= 'font-weight: '.get_theme_mod( 'h3_font_weight', '600' ).';'; }
        if ( get_theme_mod('h3_font_height', '28') ) { $h3style .= 'line-height: '.get_theme_mod('h3_font_height', '28').'px;'; }
        if ( get_theme_mod('h3_font_color', '#222538') ) { $h3style .= 'color: '.get_theme_mod('h3_font_color', '#222538').';'; }

        //heading4
        $h4style = '';
        if ( get_theme_mod( 'h4_font_size', '18' ) ) { $h4style .= 'font-size:'.get_theme_mod( 'h4_font_size', '18' ).'px;'; }
        if ( get_theme_mod( 'h4_google_font', 'Muli' ) ) { $h4style .= 'font-family:'.get_theme_mod( 'h4_google_font', 'Muli' ).';'; }
        if ( get_theme_mod( 'h4_font_weight', '600' ) ) { $h4style .= 'font-weight: '.get_theme_mod( 'h4_font_weight', '600' ).';'; }
        if ( get_theme_mod('h4_font_height', '26') ) { $h4style .= 'line-height: '.get_theme_mod('h4_font_height', '26').'px;'; }
        if ( get_theme_mod('h4_font_color', '#222538') ) { $h4style .= 'color: '.get_theme_mod('h4_font_color', '#222538').';'; }

        //heading5
        $h5style = '';
        if ( get_theme_mod( 'h5_font_size', '16' ) ) { $h5style .= 'font-size:'.get_theme_mod( 'h5_font_size', '14' ).'px;'; }
        if ( get_theme_mod( 'h5_google_font', 'Muli' ) ) { $h5style .= 'font-family:'.get_theme_mod( 'h5_google_font', 'Muli' ).';'; }
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
        
        //Header
        if(get_theme_mod( 'header_color', '#fff' )){
            $output .= '.site-header{ background-color: '.esc_attr( get_theme_mod( 'header_color', '#fff' ) ) .'; }';
        }

        $output .= '#bottom-wrap a{'.$bstyle.'}';
        //Footer
        if(get_theme_mod( 'bottom_color', '#000' )){
            $output .= '#bottom-wrap{ background-color: '.esc_attr( get_theme_mod( 'bottom_color', '#000' ) ) .'; }';
        }

        //Copyright
        if(get_theme_mod( 'copyright_bg_color', '#000' )){
            $output .= '#footer-wrap{ background-color: '.esc_attr( get_theme_mod( 'copyright_bg_color', '#000' ) ) .'; }';
        }

        //Sub-Header
        $sub_header_bg_img = get_theme_mod( 'sub_header_banner_img', false);
        $sub_bg_color = get_theme_mod( 'sub_header_banner_color', '#040509' );
        if ($sub_header_bg_img) {
            $output .= '.subtitle-cover{background-image:url('.esc_url( $sub_header_bg_img ).');background-size: cover;background-position: 50% 50%;}';
        }else{
            $output .= '.subtitle-cover{background-color:'.esc_attr( $sub_bg_color ).';}';
        }

        //Agent single sub head
        $agent_sub_bg_img = get_theme_mod( 'agent_search_bg_img', false);
        $agent_sub_bg_color = '#333333';
        if ($agent_sub_bg_img) {
            $output .= '.agent-signle-search-wrap{background-image:url('.esc_url( $agent_sub_bg_img ).');background-size: cover;background-position: 50% 50%;}';
        }else{
            $output .= '.agent-signle-search-wrap{background-color:'.esc_attr( $agent_sub_bg_color ).';}';
        }

        //Sub Header Title
        $sub_header_title_size = get_post_meta( get_the_ID() , 'wpestate_subtitle_font_size', true );
        if ($sub_header_title_size) {
            $output .= '.subtitle-cover h2{ font-size: '. $sub_header_title_size .'; }';
        }elseif(get_theme_mod( 'sub_header_title_size', '21' )){
            $output .= '.subtitle-cover h2{font-size:'.get_theme_mod( 'sub_header_title_size', '21' ).'px;}';
        }

        //404
        $error_bg_img = get_theme_mod( 'error_bg', get_template_directory_uri().'/images/subtitle-cover.jpg');
        $bg_color = get_theme_mod( 'error_bg_color', '#dd3540' );

        if ($error_bg_img) {
            $output .= '.error-wrap{background-image:url('.esc_url( $error_bg_img ).');background-size: cover;background-position: 50% 50%;}';
        }else{
            $output .= '.error-wrap{background-color:'.esc_attr( $bg_color ).';}';
        }

        //Agent Single Sub Header
        $agent_single_sub_bg = get_theme_mod( 'sub_header_banner_img', get_template_directory_uri().'/images/subtitle-cover.jpg');
        $bg_color = '#333';
        if ($agent_single_sub_bg) {
            $output .= '.agent-single-sub-head{background-image:url('.esc_url( $agent_single_sub_bg ).');background-size: cover;background-position: 50% 50%;}';
        }else{
            $output .= '.agent-single-sub-head{background-color:'.esc_attr( $bg_color ).';}';
        }

        //Coming Soon
        $coming_bg_img = get_theme_mod( 'comingsoon_bg', get_template_directory_uri().'/images/subtitle-cover.jpg');
        $coming_bg_color = get_theme_mod( 'comingsoon_bg_color', '#d6d6d6' );
        if( $coming_bg_img ){
            $output .= '.comingsoon-warper{background-image:url('.esc_url( $coming_bg_img ).');background-size: cover;background-position: 50% 50%;}';
        }else{
            $output .= '.comingsoon-warper{background-color:'.esc_attr( $coming_bg_color ).';}';
        }

        $headerlayout = get_theme_mod( 'head_style', 'transparent' );
        $header_style = get_post_meta( get_the_ID(), "wpestate_header_style", true );
        if($header_style){
            if($header_style == 'transparent_header'){
                $headerlayout =  'transparent';
            }else{
                $headerlayout =  'solid';
            }
        }

        if($headerlayout == 'solid'){
            // $output .= '#main{ padding-top: 75px;}';
            $output .= '#main{ padding-top: '. (int) esc_attr( get_theme_mod( 'content_padding_top', '0' ) ) .'px; }';
        }

        $output .= '.site-header{ padding-top: '. (int) esc_attr( get_theme_mod( 'header_padding_top', '0' ) ) .'px; }';
        $output .= '.site-header{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'header_padding_bottom', '0' ) ) .'px; }';
        $output .= '.site-header{ margin-bottom: '. (int) esc_attr( get_theme_mod( 'header_margin_bottom', '0' ) ) .'px; }';

        //sticky Header
        if ( get_theme_mod( 'header_fixed', false ) ){
            $output .= '.site-header.sticky{ position:fixed;top:0;left:auto; z-index:999999;margin:0 auto; width:100%;}';
            $output .= '.site-header.sticky.header-transparent .main-menu-wrap{ margin-top: 0;}';
            if ( get_theme_mod( 'sticky_header_color', '#222538' ) ){
                $sticybg = get_theme_mod( 'sticky_header_color', '#222538');
                $output .= '.site-header.sticky{ background-color: '.$sticybg.';}';
            }
        }

        //logo
        if(get_theme_mod('logo_width')){
            $output .= '.wpestate-navbar-header .wpestate-navbar-brand img{width:'.get_theme_mod( 'logo_width').'px;}';
        }
        if (get_theme_mod( 'logo_height' )) {
            $output .= '.wpestate-navbar-header .wpestate-navbar-brand img{height:'.get_theme_mod( 'logo_height' ).'160px;}';
        }

        // sub header
        $output .= '.subtitle-cover h2{color:'.get_theme_mod( 'sub_header_title_color', '#fff' ).';}';
        $output .= '.breadcrumb>li+li:before, .subtitle-cover .breadcrumb, .subtitle-cover .breadcrumb>.active{color:'.get_theme_mod( 'breadcrumb_text_color', '#000' ).';}';
        $output .= '.subtitle-cover .breadcrumb a{color:'.get_theme_mod( 'breadcrumb_link_color', '#000' ).';}';
        $output .= '.subtitle-cover .breadcrumb a:hover{color:'.get_theme_mod( 'breadcrumb_link_color_hvr', '#000' ).';}';
        $output .= '.subtitle-cover{padding:'.get_theme_mod( 'sub_header_padding_top', '90' ).'px 0 '.get_theme_mod( 'sub_header_padding_bottom', '90' ).'px; margin-bottom: '.get_theme_mod( 'sub_header_margin_bottom', '50' ).'px;}';

        //body
        if (get_theme_mod( 'body_bg_img')) {
            $output .= 'body{ background-image: url("'.esc_attr( get_theme_mod( 'body_bg_img' ) ) .'");background-size: '.esc_attr( get_theme_mod( 'body_bg_size', 'cover' ) ) .';    background-position: '.esc_attr( get_theme_mod( 'body_bg_position', 'left top' ) ) .';background-repeat: '.esc_attr( get_theme_mod( 'body_bg_repeat', 'no-repeat' ) ) .';background-attachment: '.esc_attr( get_theme_mod( 'body_bg_attachment', 'fixed' ) ) .'; }';
        }
        $output .= 'body{ background-color: '.esc_attr( get_theme_mod( 'body_bg_color', '#fff' ) ) .'; }';


        //menu color
        if ( get_theme_mod( 'navbar_text_color', '#a3d3f1' ) ) {
            $output .= '.common-menu-wrap .nav>li.menu-item-has-children:after, 
            .common-menu-wrap .nav>li>a,
            .common-menu-wrap .nav>li.menu-item-has-children > a:after,
            .social-share ul li a,
            .common-menu-wrap .nav>li>a:after{ color: '.esc_attr( get_theme_mod( 'navbar_text_color', 'rgba(4,5,9,.7)' ) ) .'; }';
        }

        $output .= '.common-menu-wrap .nav>li>a:hover,
        .common-menu-wrap .nav>li>a:hover:after, 
        .common-menu-wrap .nav>li.menu-item-has-children:hover > a:after,
        .common-menu-wrap .nav>li:hover a{ color: '.esc_attr( get_theme_mod( 'navbar_hover_text_color', '#007b76' ) ) .'; }';

        $output .= '.common-menu-wrap .nav>li.active>a, 
        .common-menu-wrap .nav>li.current-menu-item>a,
        .common-menu-wrap .nav>li.current-menu-ancestor>a,
        .common-menu-wrap .nav>li.current-menu-ancestor>a::after,
        .main-menu-wrap .common-menu-wrap .nav>li>ul li.current-menu-item a,
        .common-menu-wrap .nav>li.current-menu-parent>a,
        .common-menu-wrap .nav>li.current-menu-parent.menu-item-has-children > a:after, 
        .common-menu-wrap .nav>li.active>a{ color: '.esc_attr( get_theme_mod( 'navbar_active_text_color', '#007b76' ) ) .'; }';

        //submenu BG color
        $output .= '.common-menu-wrap .nav>li ul{ background-color: '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .'; }';

        //submenu Text color
        $output .= '.main-menu-wrap .common-menu-wrap .nav>li>ul li a, .main-menu-wrap .common-menu-wrap .nav > li > ul li.mega-child > a{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color', '#141414' ) ) .'; }';

        //Sub Menu Hover Color
        $output .= '.main-menu-wrap .common-menu-wrap .nav>li>ul li a:hover, 
        .common-menu-wrap .sub-menu > li.active > a,
        .common-menu-wrap .sub-menu li.active.mega-child a:hover{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color_hover', '#007b76' ) ) .';}';


        //bottom
        //$output .= '#bottom-wrap{ background-color: '.esc_attr( get_theme_mod( 'bottom_color', '#330f33' ) ) .'; }';
        $output .= '#bottom-wrap .bottom-widget .widget h3.widget-title{ color: '.esc_attr( get_theme_mod( 'bottom_title_color', '#fff' ) ) .'; }';
        $output .= '#bottom-wrap a{ color: '.esc_attr( get_theme_mod( 'bottom_link_color', '#d8d8d8' ) ) .'; }';
        $output .= '#bottom-wrap .wpestate-widgets .latest-widget-date, #bottom-wrap .bottom-widget ul li, div.about-desc{ color: '.esc_attr( get_theme_mod( 'bottom_text_color', '#909090' ) ) .'; }';
        $output .= '#bottom-wrap a:hover{ color: '.esc_attr( get_theme_mod( 'bottom_hover_color', '#007b76' ) ) .'; }';
        $output .= '#bottom-wrap{ padding-top: '. (int) esc_attr( get_theme_mod( 'bottom_padding_top', '60' ) ) .'px; }';
        $output .= '#bottom-wrap{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'bottom_padding_bottom', '40' ) ) .'px; }';


        //footer
        //$output .= '#footer-wrap{ background-color: '.esc_attr( get_theme_mod( 'copyright_bg_color', '#330f33' ) ) .'; }';
        $output .= '.footer-copyright { color: '.esc_attr( get_theme_mod( 'copyright_text_color', '#909090' ) ) .'; }';
        $output .= '.menu-footer-menu a{ color: '.esc_attr( get_theme_mod( 'copyright_link_color', '#909090' ) ) .'; }';
        $output .= '#footer-wrap{ padding-top: '. (int) esc_attr( get_theme_mod( 'copyright_padding_top', '20' ) ) .'px; }';
        $output .= '#footer-wrap{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'copyright_padding_bottom', '20' ) ) .'px; }';

        // 404 Page
        $output .= "body.error404,body.page-template-404{ width: 100%; height: 100%; min-height: 100%; }";

        return $output;
    }
}

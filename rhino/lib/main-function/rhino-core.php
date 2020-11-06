<?php

/*-------------------------------------------------------
 *              Rhino Supports and Image Cut
 *-------------------------------------------------------*/
if(!function_exists('rhino_setup')):

    function rhino_setup(){
        load_theme_textdomain( 'rhino', get_template_directory() . '/languages' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'rhino-large', 1140, 570, true );
        add_image_size( 'rhino-medium', 362, 190, true );
        add_image_size( 'rhino-portfolio', 600, 500, true );
        add_image_size( 'rhino-blog-medium', 352, 197, true );
        add_image_size( 'portfo-small', 82, 64, true );
        add_theme_support( 'post-formats', array( 'audio','gallery','image','link','quote','video' ) );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
        add_theme_support( 'automatic-feed-links' );
        if ( ! isset( $content_width ) ){
            $content_width = 660;
        }
    }
    add_action('after_setup_theme','rhino_setup');

endif;



/*-------------------------------------------------------
 *              Rhino Pagination
 *-------------------------------------------------------*/
if(!function_exists('rhino_pagination')):

    function rhino_pagination( $page_numb , $max_page ){
        $big = 999999999;
        echo '<div class="rhino-pagination">';
        echo paginate_links( array(
            'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'        => '?paged=%#%',
            'current'       => $page_numb,
            'prev_text'     => __('<i class="fa fa-long-arrow-left" aria-hidden="true"></i>','rhino'),
            'next_text'     => __('<i class="fa fa-long-arrow-right" aria-hidden="true"></i>','rhino'),
            'total'         => $max_page,
            'type'          => 'list',
        ) );
        echo '</div>';
    }

endif;


/*-------------------------------------------------------
 *              Rhino Comment
 *-------------------------------------------------------*/
if(!function_exists('rhino_comment')):

    function rhino_comment($comment, $args, $depth){
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
                        <?php echo '<span class="comment-author">' . get_comment_author() . '</span>'; ?>
                        <span class="comment-date"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_comment_date() ?></span>
                        <?php edit_comment_link( esc_html__( 'Edit', 'rhino' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'rhino' ); ?></p>
                    <?php endif; ?>
                    <span class="comment-reply">
                        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="fa fa-reply" aria-hidden="true"></i> '.esc_html__( 'Reply', 'rhino' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
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
*           Rhino Breadcrumb
*-------------------------------------------------------*/
if(!function_exists('rhino_breadcrumbs')):
function rhino_breadcrumbs(){ ?>
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
                    $rhino_taxonomy_links = array();
                    $rhino_term = get_queried_object();
                    $rhino_term_parent_id = $rhino_term->parent;
                    $rhino_term_taxonomy = $rhino_term->taxonomy;

                    while ( $rhino_term_parent_id ) {
                        $rhino_current_term = get_term( $rhino_term_parent_id, $rhino_term_taxonomy );
                        $rhino_taxonomy_links[] = '<a href="' . esc_url( get_term_link( $rhino_current_term, $rhino_term_taxonomy ) ) . '" title="' . esc_attr( $rhino_current_term->name ) . '">' . esc_html( $rhino_current_term->name ) . '</a>';
                        $rhino_term_parent_id = $rhino_current_term->parent;
                    }

                    if ( !empty( $rhino_taxonomy_links ) ) echo implode( ' <span class="raquo">/</span> ', array_reverse( $rhino_taxonomy_links ) ) . ' <span class="raquo">/</span> ';

                    echo esc_html( $rhino_term->name );
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



/*-----------------------------------------------------
 *              Coming Soon Page Settings
 *----------------------------------------------------*/
if ( get_theme_mod( 'comingsoon_en', false ) ) {
    if(!function_exists('rhino_my_page_template_redirect')):
        function rhino_my_page_template_redirect()
        {
            if( is_page() || is_home() || is_category() || is_single() )
            {
                if( !is_super_admin( get_current_user_id() ) ){
                    get_template_part( 'coming','soon');
                    exit();
                }
            }
        }
        add_action( 'template_redirect', 'rhino_my_page_template_redirect' );
    endif;

    if(!function_exists('rhino_cooming_soon_wp_title')):
        function rhino_cooming_soon_wp_title(){
            return 'Coming Soon';
        }
        add_filter( 'wp_title', 'rhino_cooming_soon_wp_title' );
    endif;
}




/*-----------------------------------------------------
 *              CSS Generator
 *----------------------------------------------------*/
if(!function_exists('rhino_css_generator')){
    function rhino_css_generator(){

        $output = '';

        $preset = get_theme_mod( 'preset', '1' );
        if( $preset ){

            if( get_theme_mod( 'custom_preset_en', true ) ) {

                // CSS Color
                $major_color = get_theme_mod( 'major_color', '#fd5238' );
                if($major_color){
                    $output .= '
                    a,
                    .info-wrapper a.white:hover,
                    .comingsoon .mc4wp-form-fields input[type=submit],
                    header.header-solid #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-ancestor>a,
                    .bottom-widget .widget ul li a:hover,
                    #bottom-wrap .widget_rhino_social_share_widget .rhino-social-share li a:hover,
                    .single-next span.next-post:hover a,
                    .single-pre span.previous-post:hover a,
                    .blog-top-img .rhino-post .content-item-title a:hover,
                    .rhino-default-postbox .blog-date-wrapper,
                    .social-share ul li:hover a,
                    .search-wrap .search-tag a:hover,
                    #sidebar #searchform:hover::after,
                    .rhino-pagination .page-numbers li a.next.page-numbers:hover, 
                    .rhino-pagination .page-numbers li a.prev:hover,
                    span.portfolio-count:hover, .portfolio-count a.all_portfolio_link:hover,
                    strong.theme-color,
                    .portfolioFilter span.portfolio-count p,
                    .rhino-post-meta ul li i,
                    .rhino-widgets.media .widget-post-cat a,
                    #sidebar .widget.widget_categories ul li:hover a,
                    #sidebar .widget ul li:hover a,
                    .subtitle-cover .breadcrumb li a:hover,
                    #wp-megamenu-primary>.wpmm-nav-wrap .wp-megamenu>li>ul.wp-megamenu-sub-menu li.wpmm-type-widget:hover>a,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li.current-menu-item>a,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li.current-menu-ancestor>a,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li.active>a,
                    .widget ul li a:hover,
                    #wp-megamenu-primary>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li:hover>a,
                    .rhino-pagination .page-numbers li a,
                    .widget-blog-posts-section .entry-title  a:hover,
                    .entry-header h2.entry-title.blog-entry-title a:hover,
                    .entry-summary .wrap-btn-style a.btn-style:hover,
                    .main-menu-wrap .navbar-toggle:hover,
                    .woocommerce .star-rating span:before,
                    .rhino-post .blog-post-meta li a:hover,
                    .rhino-post .blog-post-meta li i,
                    #mobile-menu ul li.active>a,
                    #mobile-menu ul li a:hover,
                    .btn.btn-border-rhino,
                    .entry-summary .wrap-btn-style a.btn-style:hover,
                    .social-share-wrap ul li a:hover,
                    .overlay-btn,
                    .rhino-post .blog-post-meta li a,
                    .rhino-post .blog-post-meta li,
                    .rhino-widgets a:hover,.elementor-accordion-title.active .elementor-accordion-icon i,
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
                    .style-chooser .toggler:hover,
                    .thm-fullscreen-search::after,
                    .comingsoon .mc4wp-form-fields input[type=submit]:hover,
                    #main-menu .wp-megamenu-wrap .wpmm-nav-wrap > ul > li.wpmm-social-link-search:hover a,
                    .portfolio-single-items.layout-two:hover .portfolio-item-content span.fa-camera,
                    .blog-no-img .rhino-post:hover,
                    .rhino-default-postbox:hover,
                    .portfolioContainer .portfolio-single-items::before,
                    .wpmm_mobile_menu_btn,
                    .wpmm_mobile_menu_btn:hover,
                    .wpmm-gridcontrol-left:hover, 
                    .wpmm-gridcontrol-right:hover,
                    .portfolio-items .caption-full-width2 .overlay-cont a i,
                    .mc4wp-form-fields button,
                    .rhino-pagination .page-numbers li span.current,
                    .form-submit input[type=submit],
                    .widget .tagcloud a:hover,
                    .single_related:hover .overlay-content
                    { background: '. esc_attr($major_color) .'; }';

                } 

                // CSS Border
                if($major_color){
                    $output .= '
                    input:focus,
                    .comments-area .comment-form input[type=text]:focus,
                    .widget .tagcloud a:hover,
                    textarea:focus,
                    .wpmm-gridcontrol-left:hover, 
                    .wpmm-gridcontrol-right:hover,
                    keygen:focus,
                    select:focus,
                    .rhino-latest-post-content .entry-title a:hover,
                    .common-menu-wrap .nav>li.current>a,
                    .header-solid .common-menu-wrap .nav>li.current>a,
                    .latest-review-single-layout2 .latest-post-title a:hover,
                    .blog-arrows a:hover,
                    .wpcf7-submit,
                    .rhino-pagination .page-numbers li a:hover,
                    .rhino-pagination .page-numbers li span.current,
                    .wpcf7-form input:focus,
                    .btn.btn-border-rhino,
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
                    #main-menu .wp-megamenu-wrap .wpmm-nav-wrap > ul > li.wpmm-social-link-search a,
                    input[type=button]:hover,
                    .widget.widget_search #searchform .btn-search:hover{ background-color: '.esc_attr( $hover_color ) .'; }';
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
        if ( get_theme_mod( 'menu_font_size', '14' ) ) { $mstyle .= 'font-size:'.get_theme_mod( 'menu_font_size', '16' ).'px;'; }
        if ( get_theme_mod( 'menu_google_font', 'Poppins' ) ) { $mstyle .= 'font-family:'.get_theme_mod( 'menu_google_font', 'Poppins' ).';'; }
        if ( get_theme_mod( 'menu_font_weight', '500' ) ) { $mstyle .= 'font-weight: '.get_theme_mod( 'menu_font_weight', '500' ).';'; }
        if ( get_theme_mod('menu_font_height', '54') ) { $mstyle .= 'line-height: '.get_theme_mod('menu_font_height', '54').'px;'; }
        if ( get_theme_mod('menu_font_color', '#330f33') ) { $mstyle .= 'color: '.get_theme_mod('menu_font_color', '#330f33').';'; }

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
        $output .= '.common-menu-wrap .nav>li>a{'.$mstyle.'}';
        $output .= 'h1{'.$h1style.'}';
        $output .= 'h2{'.$h2style.'}';
        $output .= 'h3{'.$h3style.'}';
        $output .= 'h4{'.$h4style.'}';
        $output .= 'h5{'.$h5style.'}';
        
        //Header
        $header_bgc = get_post_meta( get_the_ID() , 'rhino_header_bgc', true );
        if($header_bgc){
            $output .= '.site-header{ background-color: '. $header_bgc .'; }';
        }elseif(get_theme_mod( 'header_color', '#015df3' )){
            $output .= '.site-header{ background-color: '.esc_attr( get_theme_mod( 'header_color', '#015df3' ) ) .'; }';
        }

        //Footer
        if(get_theme_mod( 'bottom_color', '#330f33' )){
            $output .= '#bottom-wrap{ background-color: '.esc_attr( get_theme_mod( 'bottom_color', '#330f33' ) ) .'; }';
        }

        //Copyright
        if(get_theme_mod( 'copyright_bg_color', '#330f33' )){
            $output .= '#footer-wrap{ background-color: '.esc_attr( get_theme_mod( 'copyright_bg_color', '#330f33' ) ) .'; }';
        }

        //Sub Header Title
        $sub_header_title_size = get_post_meta( get_the_ID() , 'rhino_subtitle_font_size', true );
        if ($sub_header_title_size) {
            $output .= '.subtitle-cover h2{ font-size: '. $sub_header_title_size .'; }';
        }elseif(get_theme_mod( 'sub_header_title_size', '180' )){
            $output .= '.subtitle-cover h2{font-size:'.get_theme_mod( 'sub_header_title_size', '180' ).'px;}';
        }

        //404
        $error_bg_img = get_theme_mod( 'error_bg', get_template_directory_uri().'/images/subtitle-cover.jpg');
        $bg_color = get_theme_mod( 'error_bg_color', '#dd3540' );

        if ($error_bg_img) {
            $output .= '.error-wrap{background-image:url('.esc_url( $error_bg_img ).');background-size: cover;background-position: 50% 50%;}';
        }else{
            $output .= '.error-wrap{background-color:'.esc_attr( $bg_color ).';}';
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
        $header_style = get_post_meta( get_the_ID(), "rhino_header_style", true );
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
            if ( get_theme_mod( 'sticky_header_color', '#222538' ) ){
                $sticybg = get_theme_mod( 'sticky_header_color', '#222538');
                $output .= '.site-header.sticky{ background-color: '.$sticybg.';}';
            }
        }

        //logo
        $output .= '.rhino-navbar-header .rhino-navbar-brand img{width:'.get_theme_mod( 'logo_width').'px; max-width:none;}';
        if (get_theme_mod( 'logo_height' )) {
            $output .= '.rhino-navbar-header .rhino-navbar-brand img{height:'.get_theme_mod( 'logo_height' ).'px;}';
        }

        // sub header
        $output .= '.subtitle-cover h2{color:'.get_theme_mod( 'sub_header_title_color', '#fff' ).';}';
        $output .= '.breadcrumb>li+li:before, .subtitle-cover .breadcrumb, .subtitle-cover .breadcrumb>.active{color:'.get_theme_mod( 'breadcrumb_text_color', '#000' ).';}';
        $output .= '.subtitle-cover .breadcrumb a{color:'.get_theme_mod( 'breadcrumb_link_color', '#000' ).';}';
        $output .= '.subtitle-cover .breadcrumb a:hover{color:'.get_theme_mod( 'breadcrumb_link_color_hvr', '#000' ).';}';
        $output .= '.subtitle-cover{padding:'.get_theme_mod( 'sub_header_padding_top', '230' ).'px 0 '.get_theme_mod( 'sub_header_padding_bottom', '290' ).'px; margin-bottom: '.get_theme_mod( 'sub_header_margin_bottom', '0' ).'px;}';

        //Sub Header Overlay Image
        if (get_theme_mod( 'sub_header_overlay_img')) {
            $output .= '.subtitle-cover .sub-head-overlay-img{ background: url("'.esc_attr( get_theme_mod( 'sub_header_overlay_img' ) ) .'");background-size:cover;background-repeat:no-repeat;background-position:center center;}';
        }

        //body
        if (get_theme_mod( 'body_bg_img')) {
            $output .= 'body{ background-image: url("'.esc_attr( get_theme_mod( 'body_bg_img' ) ) .'");background-size: '.esc_attr( get_theme_mod( 'body_bg_size', 'cover' ) ) .';    background-position: '.esc_attr( get_theme_mod( 'body_bg_position', 'left top' ) ) .';background-repeat: '.esc_attr( get_theme_mod( 'body_bg_repeat', 'no-repeat' ) ) .';background-attachment: '.esc_attr( get_theme_mod( 'body_bg_attachment', 'fixed' ) ) .'; }';
        }
        $output .= 'body{ background-color: '.esc_attr( get_theme_mod( 'body_bg_color', '#f7f9fb' ) ) .'; }';


        //menu color
        if ( get_theme_mod( 'navbar_text_color', '#a3d3f1' ) ) {
            $output .= '.common-menu-wrap .nav>li.menu-item-has-children:after, 
            .common-menu-wrap .nav>li>a,
            .common-menu-wrap .nav>li.menu-item-has-children > a:after,
            .social-share ul li a,
            .common-menu-wrap .nav>li>a:after{ color: '.esc_attr( get_theme_mod( 'navbar_text_color', '#330f33' ) ) .'; }';
        }

        $output .= '.common-menu-wrap .nav>li>a:hover,
        .common-menu-wrap .nav>li>a:hover:after, 
        .common-menu-wrap .nav>li.menu-item-has-children:hover > a:after,
        .common-menu-wrap .nav>li:hover a{ color: '.esc_attr( get_theme_mod( 'navbar_hover_text_color', '#fd5238' ) ) .'; }';

        $output .= '.common-menu-wrap .nav>li.active>a, 
        .common-menu-wrap .nav>li.current-menu-item>a,
        .common-menu-wrap .nav>li.current-menu-ancestor>a,
        .common-menu-wrap .nav>li.current-menu-ancestor>a::after,
        .main-menu-wrap .common-menu-wrap .nav>li>ul li.current-menu-item a,
        .common-menu-wrap .nav>li.current-menu-parent>a,
        .common-menu-wrap .nav>li.current-menu-parent.menu-item-has-children > a:after, 
        .common-menu-wrap .nav>li.active>a{ color: '.esc_attr( get_theme_mod( 'navbar_active_text_color', '#fd5238' ) ) .'; }';

        //submenu BG color
        $output .= '.common-menu-wrap .nav>li ul{ background-color: '.esc_attr( get_theme_mod( 'sub_menu_bg', '#fff' ) ) .'; }';

        //submenu Text color
        $output .= '.main-menu-wrap .common-menu-wrap .nav>li>ul li a, .main-menu-wrap .common-menu-wrap .nav > li > ul li.mega-child > a{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color', '#141414' ) ) .'; }';

        //Sub Menu Hover Color
        $output .= '.main-menu-wrap .common-menu-wrap .nav>li>ul li a:hover, 
        .common-menu-wrap .sub-menu > li.active > a,
        .common-menu-wrap .sub-menu li.active.mega-child a:hover{ color: '.esc_attr( get_theme_mod( 'sub_menu_text_color_hover', '#fd5238' ) ) .';}';


        //bottom
        //$output .= '#bottom-wrap{ background-color: '.esc_attr( get_theme_mod( 'bottom_color', '#330f33' ) ) .'; }';
        $output .= '#bottom-wrap .bottom-widget .widget h3.widget-title{ color: '.esc_attr( get_theme_mod( 'bottom_title_color', '#fff' ) ) .'; }';
        $output .= '#bottom-wrap a{ color: '.esc_attr( get_theme_mod( 'bottom_link_color', 'rgba(255,255,255,0.7)' ) ) .'; }';
        $output .= '#bottom-wrap .rhino-widgets .latest-widget-date, #bottom-wrap .bottom-widget ul li, div.about-desc{ color: '.esc_attr( get_theme_mod( 'bottom_text_color', '#fff' ) ) .'; }';
        $output .= '#bottom-wrap a:hover{ color: '.esc_attr( get_theme_mod( 'bottom_hover_color', '#fff' ) ) .'; }';
        $output .= '#bottom-wrap .bottom-inner{ padding-top: '. (int) esc_attr( get_theme_mod( 'bottom_padding_top', '50' ) ) .'px; }';
        $output .= '#bottom-wrap .bottom-inner{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'bottom_padding_bottom', '40' ) ) .'px; }';


        //footer
        //$output .= '#footer-wrap{ background-color: '.esc_attr( get_theme_mod( 'copyright_bg_color', '#330f33' ) ) .'; }';
        $output .= '.footer-copyright { color: '.esc_attr( get_theme_mod( 'copyright_text_color', 'rgba(255,255,255,0.5)' ) ) .'; }';
        $output .= '.menu-footer-menu a{ color: '.esc_attr( get_theme_mod( 'copyright_link_color', 'rgba(255,255,255,0.5)' ) ) .'; }';
        $output .= '.menu-footer-menu a:hover{ color: '.esc_attr( get_theme_mod( 'copyright_hover_color', '#fff' ) ) .'; }';
        $output .= '#footer-wrap{ padding-top: '. (int) esc_attr( get_theme_mod( 'copyright_padding_top', '25' ) ) .'px; }';
        $output .= '#footer-wrap{ padding-bottom: '. (int) esc_attr( get_theme_mod( 'copyright_padding_bottom', '25' ) ) .'px; }';

        // 404 Page
        $output .= "body.error404,body.page-template-404{ width: 100%; height: 100%; min-height: 100%; }";

        return $output;
    }
}

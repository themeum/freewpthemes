<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php
        global $woocommerce;
        $layout = get_theme_mod( 'boxfull_en', 'fullwidth' );
        $header_style = get_post_meta( get_the_ID(), "themeum_header_style", true );
        $headerlayout = get_theme_mod( 'head_style', 'solid' ); 
        $page_logo = get_post_meta(get_the_ID(), 'themeum_page_logo', true);
        $page_logo = wp_get_attachment_image_src($page_logo)[0];
        $logoimg   = get_theme_mod( 'logo', get_template_directory_uri().'/images/logo.png' );
        $logotype  = get_theme_mod( 'logo_style', 'logoimg' );
        $logotext  = get_theme_mod( 'logo_text', 'calypso' );


        // check & replace if has page logo 
        if($page_logo){
            $logoimg = $page_logo;
        }

        $header_class = '';
        if( get_theme_mod( 'header_fixed', false )){
            $header_class .= ' enable-sticky ';
        }

        $hst = false;
        // header layout
        if($header_style){
            if($header_style == 'solid_header'){
                $hst = true;
            }
        }elseif($headerlayout){
            if($headerlayout == 'solid'){
                $hst = true;
            }
        }
        if($hst){
            $header_class .= ' header-solid ';
        }else{
            $header_class .= ' header-transparent ';
        }

        
    ?>


<div id="page" class="hfeed site <?php echo esc_attr($layout); ?>">
    <header id="masthead" class="site-header  header <?php echo esc_attr($header_class); ?>">
  	     <div class="container">
  			<div class="main-menu-wrap row no-gutters align-items-center clearfix">
                <div class="col-12 col-md-auto thm-logo-col text-center text-md-left">
                    <div class="logo-wrapper">
                        <a class="themeum-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
                            <?php
                            if($logoimg && $logotype == 'logoimg'){ ?>
                                <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php  esc_html_e( 'Logo', 'calypso' ); ?>" title="<?php  esc_html_e( 'Logo', 'calypso' ); ?>">
                            <?php }else{
                                    if($logotext) {
                                    echo esc_html($logotext);
                                }else{
                                    echo esc_html(get_bloginfo('name'));
                                }
                            } ?>
                        </a>
                    </div> <!-- logo-wrapper -->
                </div><!--/.thm-logo-col-->

                <?php $products_cats = get_terms( 'product_cat', array( 'order'      => 'ASC' )); ?>
                <?php if(get_theme_mod('en_cat_menu', false) && function_exists('get_woocommerce_term_meta') && $products_cats): ?>
                    <div class="col-auto thm-cat-col">
                        <div class="header-cat-menu">
                            <a href="#" class="cat-menu-btn">
                                <i class="fa fa-navicon"></i>
                                <span><?php echo esc_html__('Category', 'calypso') ?></span>
                            </a>
                            <!-- Product Category List -->
                            <ul class="thm-cat-menu heading-font">
                                <?php 
                                    if( function_exists('get_woocommerce_term_meta') ){
                                    foreach( $products_cats as $prod_cat ) {
                                        $term_link = get_term_link( $prod_cat, 'product_cat' ); ?>
                                        <li><a href="<?php echo esc_url($term_link); ?>"><?php echo esc_attr($prod_cat->name); ?></a></li>  
                                    <?php } ?>
                                <?php }
                                wp_reset_query(); ?>
                            </ul>
                            <!-- End Category -->
                        </div>
                    </div><!--/.thm-cat-col-->
                <?php endif; ?>
            <?php if( ! class_exists('wp_megamenu_initial_setup') ) { ?>
    		    <div class="col common-menu d-none d-lg-flex jusitify-content-center">
            <?php } else { ?>
                <div class="col common-menu d-flex jusitify-content-center">
            <?php } ?>
            <?php if ( has_nav_menu( 'primary' ) ) { ?>
                <div id="main-menu" class="common-menu-wrap">
                    <?php
                        wp_nav_menu(
                            array(
                                'theme_location'    => 'primary',
                                'container'	        => '',
                                'menu_class'        => 'navigation',
                                'fallback_cb'       => 'wp_page_menu',
                                'depth'             => 4,
                                'walker'            => new Megamenu_Walker()
                            )
                        );
                    ?>
                </div><!--/.common-menu-wrap-->
            <?php  } ?>
            </div><!--/.common-menu-->




            <div class="col text-right col-lg-auto thm-icon-col">
                <div class="thm-header-icons">
                    <?php if(get_theme_mod('en_user_icon', false)): ?>
                        <?php if(is_user_logged_in()) :?>
                            <a href="#" class="thm-logout-icon single-icon" data-toggle="modal" data-target="#confirmModal">
                                <i class="calypso-icon calypso-sign-in"></i>
                        <?php else:  ?>
                        <a 
                            href="#login" 
                            data-toggle="modal" 
                            data-target="#login" 
                            href="#" data-dismiss="modal" 
                            class="thm-user-icon single-icon">
                                <i class="calypso-icon calypso-avatar"></i>
                        <?php endif; ?>
                        </a>
                    <?php endif; ?>
                    <?php if(get_theme_mod('header_search', false)) : ?>
                        <span class="thm-search-icon single-icon">
                            <i class="calypso-icon calypso-search"></i>
                        </span>
                    <?php endif; ?>
                    <?php if(get_theme_mod('en_cart_icon', false) && class_exists( 'WooCommerce' )): ?>
                        <?php 
                            global $woocommerce;
                            if($woocommerce) { ?>
                            <div class="thm-cart-icon single-icon">
                                <?php
                                    $has_products = '';
                                    if($woocommerce->cart->cart_contents_count) {
                                        $has_products = 'cart-has-products';
                                    }
                                ?>
                                <a class="thm-cart-icon-inner" href="<?php echo  wc_get_cart_url(); ?>">
                                    <i class="calypso-icon calypso-shopping-cart"></i>
                                    <span class="woo-cart-items">
                                        <span class="<?php echo $has_products; ?>"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
                                    </span>
                                </a>
                                <?php the_widget( 'WC_Widget_Cart', 'title= ' ); ?>
                            </div>
                        <?php } ?>
                    <?php endif; ?>
                </div><!--/.thm-header-icons-->
            </div><!--/.thm-icon-col-->
            <?php if(! class_exists('wp_megamenu_initial_setup')) : ?>
                <div class="col-auto text-right d-lg-none">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            <?php  endif; ?>
            <?php get_template_part('lib/mobile-nav'); ?>


            
  		</div>
  	</div>

    <?php 
        get_template_part('lib/popup-content-header');
    ?>

  </header><!--/.header-->
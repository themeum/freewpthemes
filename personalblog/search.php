<?php get_header(); ?>
<div class="container">
    <div class="row">
        <?php if (isset( $_REQUEST['blog-layout'])) {
          $bloglayout = esc_attr($_REQUEST['blog-layout']);
        }else {
            $bloglayout = get_theme_mod( 'blog_layout', 'blogleft' ); 
        } ?>

            <?php if ( $bloglayout != 'blogfullwidth' ) { ?>  
                <?php if ( $bloglayout == 'blogleft' ) { ?>
                    <div class="col-sm-8  pull-right">
                <?php } else{ ?>
                    <div class="col-sm-8">
                <?php } ?>
                    <?php if ( $bloglayout == 'blogright' ) { ?>
                        <div class="content-grid right-side">
                        <?php } else { ?>
                        <div class="content-grid">
                    <?php }?>
            <?php } ?>

            <?php if ( $bloglayout == 'blogfullwidth' ) { ?>
                <div class="col-sm-12 col-md-8 col-md-offset-2"> 
                <?php } ?>

                    <?php get_template_part('lib/header-content'); ?>
                    <div id="content" class="site-content" role="main">
                        <?php
                            if ( have_posts() ) :
                                while ( have_posts() ) : the_post(); 
                                    get_template_part( 'post-format/content', get_post_format() );
                                endwhile;
                            else:
                                get_template_part( 'post-format/content', 'none' );
                            endif;                              
                        ?>
                    </div> <!-- .site-content -->

                    <!-- start pagination -->   
                    <?php if (isset( $_REQUEST['pagi-layout'])) {
                      $pagilayout = esc_attr($_REQUEST['pagi-layout']);
                    }else {
                        $pagilayout = get_theme_mod( 'pagination_layout', 'pagiloadmore' ); 
                    } ?> 

                    <?php if ( $pagilayout == 'paginumber' ) { ?>
                        <?php
                            $page_numb = max( 1, get_query_var('paged') );
                            $max_page = $wp_query->max_num_pages;
                            echo personalblog_pagination( $page_numb, $max_page ); 
                        ?>
                    <?php } else { 
                            $page_numb = max( 1, get_query_var('paged') );
                            $max_page = $wp_query->max_num_pages;
                            echo personalblog_pagination( $page_numb, $max_page ); 
                            ?>
                    <?php }  ?>
                <?php if ( $bloglayout != 'blogfullwidth' ) { ?>    
                    </div> <!-- .content-grid -->
                <?php }  ?>
            </div> <!-- .col-sm-8 -->

            <?php if ( $bloglayout != 'blogfullwidth' ) { ?>  
                <div id="sidebar" class="col-sm-4" role="complementary">
                    <?php if ( $bloglayout == 'blogleft' ) { ?>
                    <aside class="widget-area">
                    <?php } else { ?>
                    <aside class="widget-area right-side">
                        <?php } ?>
                        <?php get_sidebar( );?> 
                    </aside>
                </div> <!-- #sidebar -->
            <?php }  ?>
      
    </div> <!-- .row -->
</div> <!-- .container -->
<?php get_footer();
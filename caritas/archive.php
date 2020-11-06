<?php get_header();

$sidebarstyle = get_theme_mod('blog_sidebar_style', 'right');
if(get_theme_mod('blog_sidebar', true)){
    $col = '8';
}else{
    $col = '12';
}
?>

    <section id="main" class="generic-padding">
        <?php get_template_part('lib/sub-header')?>
        <div class="main-body-inner">
            <div class="container">
                <div class="row">
                    <?php if($sidebarstyle == 'left' && get_theme_mod('blog_sidebar', true)){
                        get_sidebar();
                    } ?>
                    <div id="content" class="site-content col-md-<?php echo $col; ?>" role="main">
                        <div class="row">
                            <?php
                            $paged      = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $args       = array(
                                'post_type' => 'post',
                                'paged'     => $paged
                            );
                            $thequery   = new WP_Query($args);
                            $post_col        = get_theme_mod( 'blog_column', 6 );

                            $post_idx = 0;

                            if ( $thequery->have_posts()) {
                                while ( $thequery->have_posts() ) {
                                    $post_idx++;
                                    $thequery->the_post();
                                    $mod_col = $post_idx === 1 ? 12 : $post_col;

                                    ?>
                                    <div class="col-md-<?php echo $mod_col; ?>">
                                        <div class="caritas-postbox">
                                            <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                get_template_part( 'post-format/content', 'none' );
                            }
                            wp_reset_postdata();
                            ?>
                        </div> <!-- row -->
                        <?php
                        $page_numb = max( 1, get_query_var('paged') );
                        $max_page = $thequery->max_num_pages;
                        caritas_pagination( $page_numb, $max_page );
                        ?>
                    </div><!-- content -->
                    <?php if($sidebarstyle == 'right' && get_theme_mod('blog_sidebar', true)){
                        get_sidebar();
                    } ?>
                </div>
            </div>
        </div>
    </section> <!-- #main -->

<?php get_footer();
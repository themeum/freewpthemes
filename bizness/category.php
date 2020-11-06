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
    <div class="container"> 
        <div class="row">
        <?php if($sidebarstyle == 'left' && get_theme_mod('blog_sidebar', true)){
                get_sidebar();
            } ?>
        <div id="content" class="site-content col-md-<?php echo $col; ?>" role="main">
            <div class="row">
                <?php
                    $col = get_theme_mod( 'blog_column', 6 );
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post(); ?>
                                <div class="separator-wrapper col-md-<?php echo esc_attr($col);?>">
                                    <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                                </div>
                            <?php
                        endwhile;
                    else:
                        get_template_part( 'post-format/content', 'none' );
                    endif;                              
                $page_numb = max( 1, get_query_var('paged') );
                $max_page = $wp_query->max_num_pages;
                echo bizness_pagination( $page_numb, $max_page ); 
                ?>
            </div><!-- .row -->
        </div><!-- .container -->
        <?php if($sidebarstyle == 'right' && get_theme_mod('blog_sidebar', true)){
            get_sidebar();
        } ?>
        </div>
    </div> <!-- #content -->
</section> 

<?php get_footer();
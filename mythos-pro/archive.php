<?php get_header(); ?>
<?php get_template_part('lib/sub-header'); ?>

<section id="main">
    <div class="container blog-full-container">

        <div class="row">
            <div id="content" class="site-content col-sm-8" role="main">
                <?php
                $index = 1;
                $col = get_theme_mod( 'blog_column', 12 );
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        if ( $index == '1' ) { ?>
                            <div class="row">
                        <?php }?>
                            <div class="col-md-<?php echo esc_attr($col);?>">
                                <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                            </div>
                        <?php if ( $index == (12/esc_attr($col) )) { ?>
                            </div><!--/row-->
                        <?php $index = 1;
                        }else{
                            $index++;   
                        }  
                    endwhile;
                else:
                    get_template_part( 'post-format/content', 'none' );
                endif;
                if($index !=  1 ){ ?>
                   </div><!--/row-->
                <?php } ?>
                <?php
                $page_numb = max( 1, get_query_var('paged') );
                $max_page = $wp_query->max_num_pages;
                echo wp_kses_post(mythos_pagination( $page_numb, $max_page )); 
                ?>
            </div>

            <?php 
                get_sidebar(); 
                $action_title = get_theme_mod('blog_calltoaction_title');
                $action_subtitle = get_theme_mod('blog_calltoaction_subtitle');
                $button_one = get_theme_mod('blog_button_one');
                $button_two = get_theme_mod('blog_button_two');
                $btn_url1 = get_theme_mod('blog_button_url');
                $btn_url2 = get_theme_mod('blog_button_url2');
            ?>

            <?php if (get_theme_mod('enable_call_to_action', true) == 'true'): ?>     
                <div class="col-md-12 call-to-action">
                    <div class="row">
                        <div class="col-md-6 col-lg-7"> 
                            <h3 class="support-title"><?php echo esc_html($action_title); ?></h3>
                            <h2 class="title-self"><?php echo esc_html($action_subtitle); ?></h2>
                        </div>
                        <div class="col-md-6 col-lg-5 text-right">
                            <?php if ($btn_url1): ?>
                                <a href="<?php echo esc_url($btn_url1); ?>" class="btn"><?php echo esc_html($button_one); ?></a> 
                            <?php endif ?>
                            <?php if ($btn_url2): ?>
                                <a href="<?php echo esc_url($btn_url2); ?>" class="btn btn2"><?php echo esc_html($button_two); ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            <?php endif ?>

        </div> <!-- .row -->
    </div><!-- .container -->
</section> 

<?php get_footer();
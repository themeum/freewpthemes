<?php get_header(); ?>

<section id="main">
    <div class="container">
        <div class="row">
            <?php get_template_part('lib/sub-header')?>

            <div id="content" class="taxonomy-players site-content col-sm-12" role="main">
                <div class="style2 themeum-player-listing">
                        <?php
                            $index = 1;
                            $col = get_theme_mod( 'blog_column', 12 );
                            if ( have_posts() ) : ?>
                            <div class="player-wrap"> 
                            <?php
                                while ( have_posts() ) : the_post();
                                    ?>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="club-player-list">
                                            <div class="player-image">
                                                <div class="overlay"></div>
                                                <div class="player-image-wrapper">
                                                    <?php  
                                                    if (has_post_thumbnail( $post->ID ) ): 
                                                      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                                                      <img class="img-responsive" src="<?php echo esc_url( $image[0] ); ?>" alt="<?php  esc_attr_e( 'Player Image', 'calcio' ); ?>">
                                                    <?php endif;  
                                                    ?>  
                                                </div>
                                            </div>
                                            
                                            <div class="player-intro">
                                                <p class="player-club"><?php echo get_the_term_list(get_the_id(), 'player-list'); ?></p>
                                                <h4 class="player-title"><a href="<?php echo get_permalink(); ?>" style=""><?php echo the_title(); ?></a></h4>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endwhile;
                            ?>
                            </div>
                            <?php
                            else:
                                get_template_part( 'post-format/content', 'none' );
                            endif;
                            if($index !=  1 ){ ?>
                        </div><!--/row-->
                            <?php }
                        ?>
                    <?php                                 
                        $page_numb = max( 1, get_query_var('paged') );
                        $max_page = $wp_query->max_num_pages;
                        echo calcio_pagination( $page_numb, $max_page ); 
                    ?>
                </div> <!-- .themeum-player-listing -->
            </div> <!-- .site-content -->
        </div>
    </div> <!-- .container --> 
</section> <!-- #main -->

<?php get_footer();
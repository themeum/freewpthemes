<?php get_header();?>

<section id="main">
    <?php
    get_template_part('lib/sub-header'); 

    while( have_posts() ): the_post(); ?>

        <div class="container">
            <div class="row"> 
                <div class="col-md-12 portfolio-title-content-wrapper">
                   <?php the_content(); ?>
                </div>  <!-- col-md-8 portfolio-title-content-wrapper -->
            </div> <!-- row -->
        </div> <!-- #container -->



        <!-- Related portfolio -->
        
        <div class="portfolio-single-related-post">
            <div class="container">
                <h3 class="related-post-title"><?php echo esc_attr('More Product Photography'); ?></h3>
                <?php

                $terms = get_the_terms( $post->ID , 'portfolio-tag', 'flatpro');
                $term_ids = wp_list_pluck($terms,'term_id');

                $second_query = new WP_Query( array(
                    'post_type' => 'portfolio',
                    'tax_query' => array(
                                array(
                                    'taxonomy'  => 'portfolio-tag',
                                    'field'     => 'id',
                                    'terms'     => $term_ids,
                                    'operator'  => 'IN'
                                 )),
                    'posts_per_page'            => 3,
                    'ignore_sticky_posts'       => 1,
                    'post__not_in'              =>array($post->ID)
                ) );


                if($second_query->have_posts()) { ?>

                <div class="row">
                    <?php while ($second_query->have_posts() ) : $second_query->the_post(); ?>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="single_related">

                                <div class="related-post-img">
                                   <?php if (has_post_thumbnail()) { ?>
                                        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"> <?php the_post_thumbnail( 'flatpro-portfo', array('alt' => get_the_title()) ); ?></a>
                                    <?php } ?> 
                                    <div class="overlay-content">
                                        <a class="overlay-btn" href="<?php the_permalink(  get_the_ID() ); ?>"><?php _e( 'Details','flatpro'); ?></a>    
                                    </div>
                                </div>
                                

                                <h3 class="portfolio-cat"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                <?php echo get_the_term_list( $post->ID, 'portfolio-tag', '<ul class="portfolio-tag-cont"><li>', '</li>,<li>', '</li></ul>' ); ?>    
                            </div>
                       </div>
                    <?php endwhile; wp_reset_query(); ?>
                </div> <!-- row -->
                <?php } ?>

            </div><!-- portfolio-single-related-post -->
        </div><!-- portfolio-single-related-post --> 

</section>


<?php endwhile;

get_footer();
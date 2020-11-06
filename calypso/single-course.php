<?php get_header(); ?>

<section id="main">
    <div class="container">
        <div id="content" class="site-content inner-padding" role="main">
            <?php 
                if(have_posts()){
                    while (have_posts()) {
                        the_post();

                    ?>
                    
                    <div class="thm-single-course text-center">
                        <h2 class="mb-4"><?php the_title(); ?></h2>
                        <div class="course-thumb text-center mb-4">
							<?php if(has_post_thumbnail( get_the_ID())) {
								$thumb  = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'calypso-large'); ?>
								<img class="img-responsive" src="<?php echo esc_url($thumb[0]); ?>"  alt="">
							<?php } ?>
                        </div>
                        <div class="course-content">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <?php
                        
                    }
                    wp_reset_postdata();
                }
            ?>
        </div>
    </div>



</section>



<?php





get_footer();

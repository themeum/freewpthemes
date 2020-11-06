<?php get_header();?>

<section id="main">
    <?php

get_template_part('lib/sub-header');

while( have_posts() ): the_post(); ?>
        <div class="container inner-padding">
                <div class="class-single-page">
                        <div class="class-inner-top">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="left-content">
                                        <h2><?php echo strip_tags(get_the_title()); ?></h2>
                                        <p><?php the_excerpt(); ?></p>

                                        <h5>
                                            <?php
                                                _e('Course Fee: ', 'fitgym');
                                                echo get_post_meta( get_the_ID(), 'themeum_class_price',true );
                                            ?>
                                            &nbsp;
                                            &nbsp;

	                                        <?php
	                                        _e('Course Instractor : ', 'fitgym');
	                                        echo get_the_author_meta('display_name');
	                                        ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="class-innner-content">
                            <?php the_content(); ?>
                        </div>
                </div>  <!-- col-md-8 class-title-content-wrapper -->
        </div> <!-- #container -->

</section>


<?php endwhile;

get_footer();
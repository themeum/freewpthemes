<?php get_header(); ?>

<section id="main">
    <div class="container">
        <div id="content" class="site-content inner-padding" role="main">
            <?php 
                if(have_posts()){
                    while (have_posts()) {
                        the_post();

                    ?>
                        <div class="thm-single-notice clearfix">
                            <div class="thm-notice-left">
                                <div class="thm-notice-date-box">
                                    <span class="thm-day">
                                        <?php echo get_the_date('j'); ?>
                                    </span>
                                    <span>
                                        <?php echo get_the_date('F Y'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="thm-notice-right">
                                <?php
                                    $terms = get_terms( 'notice-cat' );
                                    echo '<ul class="notice-cat-list">';
                                    foreach ( $terms as $term ) {
                                        $term_link = get_term_link( $term );
                                        if ( is_wp_error( $term_link ) ) {
                                            continue;
                                        }
                                        echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
                                    }
                                    echo '</ul>';
                                ?>
                                </a>
                                <h2><?php the_title(); ?></h2>
                                <div class="thm-single-notice-content">
                                    <?php the_content(); ?>
                                </div>
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

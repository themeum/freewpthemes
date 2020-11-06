<?php get_header();
global $themeum_options; ?>
<?php while( have_posts() ): the_post(); ?>
<?php
    $portfolio_client       = get_post_meta($post->ID,'thm_portfolio_client',true);
    $portfolio_url          = get_post_meta($post->ID,'thm_portfolio_url',true);
    $portfolio_date         = get_post_meta($post->ID,'thm_portfolio_date',true);
    $folio_video            = get_post_meta($post->ID,'thm_portfolio_video',true);

    $terms = get_the_terms( $post->ID, 'project-tag' );

    $term_name = '';

    if ($terms)
    {
        foreach ( $terms as $term )
        {
            $term_name .= $term->slug.', ';
        }
    }
    $term_name = substr($term_name, 0, -2);
?>


<section id="single-portfolio">


   <?php get_template_part('lib/sub-header')?>


    <div class="container">
        <div id="portfolio-details" >
            <div class="row">
                
                <?php
                if (isset($folio_video) && $folio_video ) {
                ?>
                    <div class="col-sm-12">
                        <?php $embed_url = themeum_get_video_id($folio_video);?>
                        <iframe src="<?php echo esc_url($embed_url); ?>" width="100%" height="620" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                    </div>
                <?php
                }
                else if (has_post_thumbnail($post->ID))
                {
                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'starterpro-medium');
                ?>
                <div class="col-sm-12">
                    <img class="img-responsive" src="<?php echo $thumb[0]; ?>" title="" alt="">
                </div>
                <?php
                }
                ?>
                
                <div class="col-sm-8">
                    <div class="portfolio-info">
                        <h3 class="style-title2"><span class="span-title2"><?php esc_html_e('Description', 'starterpro')?></span></h3>
                        <div class="entry-content">
                            <p><?php the_content(); ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="portfolio-details">
                        <h3 class="style-title2"><span class="span-title2"><?php esc_html_e('Project Details', 'starterpro')?></span></h3>

                        <div class="list list-star">
                            <ul>
                                <?php if($portfolio_client != ''){?>
                                <li><strong><?php esc_html_e('Project Name : ','starterpro'); ?></strong><?php echo esc_html($portfolio_client); ?></li>
                                <?php } ?>                          

                                <?php if($portfolio_date != ''){?>
                                <li><strong><?php esc_html_e('Date : ','starterpro'); ?></strong><?php echo esc_html($portfolio_date); ?></li>
                                <?php } ?>                        

                                <?php if($portfolio_url != ''){?>
                                <li><strong><?php esc_html_e('Category : ' ,'starterpro'); ?></strong><?php echo esc_html($term_name); ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                             
                        <?php if($portfolio_url != ''){?>
                         <a href="<?php echo esc_url($portfolio_url); ?>" target="_blank" class="btn btn-common btn-previw"><?php esc_html_e('Preview','starterpro'); ?> <i class="fa fa-long-arrow-right"></i></a>
                         <?php } ?>  
                    </div>  
                </div>
            </div>
        </div>
    

    <div class="clearfix post-navigation">
        <?php previous_post_link('<span class="previous-post pull-left">%link</span>','<i class="fa fa-angle-left"></i>'); ?>
         <?php next_post_link('<span class="next-post pull-right">%link</span>',' <i class="fa fa-angle-right"></i>'); ?>
    </div> <!-- .post-navigation -->

    </div>
                        

</section>

<?php endwhile; ?>

<?php get_footer();
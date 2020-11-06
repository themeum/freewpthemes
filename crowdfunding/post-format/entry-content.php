<?php global $themeum_options; ?>

<figure>
    <div class="entry-meta clearfix">
        <?php get_template_part( 'post-format/template/single-meta-data' ); ?>

        <div class="entry-headder">
            <div class="entry-title-wrap">
                <h2 class="entry-title blog-entry-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                    <?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
                    <sup class="featured-post"><i class="fa fa-star"></i></sup>
                    <?php } ?>
                </h2> <!-- //.entry-title --> 
            </div>
        </div>
         
        <?php if (isset($themeum_options['blog-author']) && $themeum_options['blog-author'] ) { ?>
            <p><?php  _e('By ', 'crowdfunding'); ?> <strong><?php the_author_posts_link() ?></strong></p>
        <?php }?> 

    </div>
    <?php  if (isset($themeum_options['blog-social']) && $themeum_options['blog-social'] ){
        if(is_single()) {
            get_template_part( 'post-format/social-buttons' );
        }
    } ?>
</figure>







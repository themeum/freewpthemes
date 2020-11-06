<article class="starter-border" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>   
    <?php if ( has_post_thumbnail() ){ ?>
        <div class="blog-details-img">
            <?php if( is_single() ){ ?>
                <?php the_post_thumbnail('starterpro-large', array('class' => 'img-responsive')); ?>
            <?php } else { ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('starterpro-large', array('class' => 'img-responsive')); ?>
                </a>            
            <?php }?>
        </div>
    <?php }  ?>

    <?php if( is_single() ){ ?>
        <?php get_template_part( 'post-format/entry-content' ); ?> 
    <?php }  ?>
    
    <div class="entry-blog">
     <?php if( !is_single() ){ ?>
     <?php get_template_part( 'post-format/entry-content' ); ?> 
     <?php }  ?>
     <?php get_template_part( 'post-format/entry-content-blog' ); ?> 
     </div> <!--/.entry-meta -->
</article><!--/#post-->

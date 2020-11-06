<article id="post-<?php the_ID(); ?>" <?php post_class('blog-list'); ?>> 

    <div class="entry-header text-center">
        <span class="post-icon"><i class="fa fa-file-photo-o" aria-hidden="true"></i></span>
        <ul class="blog-post-meta">     
            <?php if ( get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "" ) { ?>
                <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('first_name');?> <?php echo get_the_author_meta('last_name');?></a></li>
            <?php } else { ?>
                <li><?php the_author_posts_link() ?> </li>
            <?php }?>
            <li><a href="<?php the_permalink(); ?>"><time datetime="<?php echo get_the_date('j F Y') ?>"><?php echo get_the_date('j F Y'); ?></time></a></li>
            <li><?php echo get_the_category_list(' '); ?></li>
        </ul>     
    </div>

    <?php if ( has_post_thumbnail() ){ ?>
        <div class="blog-details-img">
            <?php if (isset( $_REQUEST['blog-layout'])) {
              $bloglayout = esc_attr($_REQUEST['blog-layout']);
            }else {
                $bloglayout = get_theme_mod( 'blog_layout', 'blogleft' ); 
            }
            if ( $bloglayout == 'blogfullwidth') {
                if( is_single() ){
                        the_post_thumbnail('large', array('class' => 'img-responsive'));
                    } else { ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('large', array('class' => 'img-responsive')); ?>
                    </a>            
                <?php } ?>
            <?php } else { ?>
                <?php if( is_single() ){ ?>
                    <?php the_post_thumbnail('large', array('class' => 'img-responsive')); ?>
                <?php } else { ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('personalblog-blog', array('class' => 'img-responsive')); ?>
                    </a>            
                <?php }?>
            <?php } ?>
        </div>
    <?php }  ?> 
     
    <?php get_template_part( 'post-format/entry-content-blog' ); ?> 

</article><!--/#post-->
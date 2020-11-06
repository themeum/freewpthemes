<?php if( is_single() ): ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-item'); ?>>
<?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-item blog-index-post'); ?>>
<?php endif; ?>
        
    
    <header class="entry-header clearfix">
        <?php if ( get_theme_mod( 'blog_category', true ) ): ?>
            <div class="category-name">
                <?php echo get_the_category_list(', '); ?>
            </div>
        <?php endif; ?>
        <?php
            if (is_single()) {
                the_title( '<h2 class="content-item-title">', '</h2>' );
            } else {
                the_title( '<h2 class="content-item-title"><a href="'.get_the_permalink().'">', '</a></h2>' );
            }
        ?>

        <?php if ( get_theme_mod( 'blog_author', true ) || get_theme_mod( 'blog_category', true ) || get_theme_mod( 'blog_comment', true ) ): ?>
            <ul class="blog-post-meta">
                <?php if ( get_theme_mod( 'blog_date', true ) ) { ?>
                    <li class="blog-date-wrapper">
                        <time datetime="<?php echo get_the_date() ?>"><?php echo get_the_date(); ?></time>
                    </li>
                <?php } ?>
                <?php if ( get_theme_mod( 'blog_author', true ) ): ?>
                    <li class="meta-author">
                        <?php esc_html_e('BY', 'aresmurphy') ?>
                        <strong><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"> <?php echo get_the_author_meta('display_name');?></a></strong>
                    </li>
                <?php endif; ?>
                
            </ul>
        <?php endif; ?>
    </header>

    <?php if ( has_post_thumbnail() ){ ?>
        <div class="blog-details-img">
            <?php if( is_single() ){ ?>
                <?php the_post_thumbnail('aresmurphy-large', array('class' => 'img-responsive')); ?>
            <?php } else { ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('aresmurphy-large', array('class' => 'img-responsive')); ?>
                </a>            
            <?php }?>
        </div>
    <?php }  ?>
    
    <div class="entry-blog">
        <?php
            get_template_part( 'post-format/entry-content-blog' );
        ?> 
    </div> <!--/.entry-meta -->
</article><!--/#post-->



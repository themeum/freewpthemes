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

    <?php if(function_exists('rwmb_meta')){ ?>
        <?php  if ( get_post_meta( get_the_ID(), 'themeum_video',true ) ) { ?>
            <div class="entry-video embed-responsive embed-responsive-16by9">
                <?php $video_source = esc_attr(get_post_meta( get_the_ID(), 'themeum_video_source',true )); ?>
                <?php $video = get_post_meta( get_the_ID(), 'themeum_video',true ); ?>
                <?php if($video_source == 1): ?>
                    <?php echo get_post_meta( get_the_ID(), 'themeum_video',true ); ?>
                <?php elseif ($video_source == 2): ?>
                    <?php echo '<iframe width="100%" height="350" src="http://www.youtube.com/embed/'.esc_attr($video).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white"  allowfullscreen></iframe>'; ?>
                <?php elseif ($video_source == 3): ?>
                    <?php echo '<div class="embed-responsive embed-responsive-16by9"><iframe src="http://player.vimeo.com/video/'.esc_attr($video).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>'; ?>
                <?php endif; ?>
            </div>
        <?php } ?>
    <?php } ?>
    
    <div class="entry-blog">
        <?php
            get_template_part( 'post-format/entry-content-blog' );
        ?> 
    </div> <!--/.entry-meta -->
</article><!--/#post-->



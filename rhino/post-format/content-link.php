<?php if( is_single() ): ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('rhino-post rhino-single-post single-content-flat'); ?>>
<?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('rhino-post rhino-single-post rhino-index-post'); ?>>
<?php endif; ?>

    <div class="featured-wrap-link">
        <?php if(function_exists('rwmb_meta')){ ?>
            <?php  if ( get_post_meta( get_the_ID(), 'rhino_link',true ) ) { ?>
            <div class="entry-link-post-format">
                <h4><?php echo esc_url( get_post_meta( get_the_ID(), 'rhino_link',true ) ); ?></h4>
            </div>
            <?php } ?>
        <?php } ?>
    </div>
    
    <div class="content-link-content rhino-blog-title clearfix">

        <?php
            if (is_single()) { ?>
                <?php the_title( '<h2 class="content-item-title"><a href="'.get_the_permalink().'">', '</a></h2>' ); ?>
            <?php if ( get_theme_mod( 'blog_author', false ) || get_theme_mod( 'blog_category', true ) || get_theme_mod( 'blog_comment', false ) ): ?>
            <ul class="blog-post-meta clearfix"> 

                <?php if ( get_theme_mod( 'blog_author_single', true ) ): ?>
                    <li class="meta-author">
                        <span class="img-author"><?php echo get_avatar( get_the_author_meta( 'ID' ) , 32 ); ?></span>
                        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('display_name'); ?></a>
                    </li>
                <?php endif; ?>

                <?php if ( get_theme_mod( 'blog_date_single', true ) ) { ?>
                    <li>
                        <div class="blog-date-wrapper">
                            <a href="<?php the_permalink(); ?>"><time datetime="<?php echo get_the_date('Y-m-d') ?>"><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></time></a>
                        </div>
                    </li>
                <?php } ?> 

                <?php if ( get_theme_mod( 'blog_category_single', true ) ): ?>
                    <li class="meta-category">
                        <i class="fa fa-folder"></i></i> <?php printf(esc_html__('%s', 'rhino'), get_the_category_list(', ')); ?>
                    </li>
                <?php endif; ?>

                <?php if ( get_theme_mod( 'blog_hit_single', true ) ) { ?>
                    <li>      
                        <?php
                            # blog Count Down   
                            $visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
                            if( $visitor_count == '' ){ $visitor_count = 0; }
                            if( $visitor_count >= 1000 ){
                                $visitor_count = round( ($visitor_count/1000), 2 );
                                $visitor_count = $visitor_count.'k';
                            }
                            echo '<i class="fa fa-eye" aria-hidden="true"></i>'; ?>
                            <?php echo esc_attr( $visitor_count );     
                        ?>
                    </li>
                <?php } ?> 

                <?php if ( get_theme_mod( 'blog_tags_single', true ) ) { ?>
                    <li><?php echo get_the_tag_list('<i class="fa fa-tags"></i> ',', ',''); ?></li> 
                <?php } ?>

                <?php if ( get_theme_mod( 'blog_comment_single', true ) ) { ?>
                        <li><i class="fa fa-comments-o"></i> <?php comments_number( '0', '1', '%' ); ?><?php esc_html_e(' Comments', 'rhino') ?></li>
                <?php } ?>  

            </ul>

        <?php endif; ?>
        <?php }
        ?>
        
         <?php
            if (! is_single()) { ?>

            <?php the_title( '<h2 class="content-item-title"><a href="'.get_the_permalink().'">', '</a></h2>' ); ?>
            <?php if ( get_theme_mod( 'blog_author', false ) || get_theme_mod( 'blog_category', true ) || get_theme_mod( 'blog_comment', false ) ): ?>
            <ul class="blog-post-meta clearfix">
                
                <?php if ( get_theme_mod( 'blog_date', false ) ) { ?>
                    <li>
                        <div class="blog-date-wrapper">
                            <a href="<?php the_permalink(); ?>"><time datetime="<?php echo get_the_date('Y-m-d') ?>"><?php echo get_the_date(); ?></time></a>
                        </div>
                    </li>
                <?php } ?>
                
                <?php if ( get_theme_mod( 'blog_author', false ) ): ?>
                    <li class="meta-author">
                        <?php esc_html_e('by', 'rhino') ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('display_name'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if ( get_theme_mod( 'blog_hit', false ) ) { ?>
                    <li>      
                        <?php
                            # blog Count Down   
                            $visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
                            if( $visitor_count == '' ){ $visitor_count = 0; }
                            if( $visitor_count >= 1000 ){
                                $visitor_count = round( ($visitor_count/1000), 2 );
                                $visitor_count = $visitor_count.'k';
                            }
                            echo '<i class="fa fa-eye" aria-hidden="true"></i>'; ?>
                            <?php echo esc_attr( $visitor_count );     
                        ?>
                    </li>
                <?php } ?>
                <?php if ( get_theme_mod( 'blog_tags', false ) ) { ?>
                    <li><?php echo get_the_tag_list('<i class="fa fa-tags"></i> ',', ',''); ?></li> 
                <?php } ?> 
                <?php if ( get_theme_mod( 'blog_comment', false ) ) { ?>
                        <li><i class="fa fa-comments-o"></i> <?php comments_number( '0', '1', '%' ); ?></li>
                <?php } ?>  
                                
            </ul>
        <?php endif; ?>
        <?php } ?>
        
        <div class="entry-blog">
            <?php
                if (is_single()) {
                    get_template_part( 'post-format/entry-content-blog' );
                } else {
                    get_template_part( 'post-format/entry-content' );
                }
            ?> 
        </div> <!--/.entry-meta -->
    </div>
    
    
</article><!--/#post-->
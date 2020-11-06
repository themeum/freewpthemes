<?php if( is_single() ): ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('wptixon-post wptixon-single-post'); ?>>
<?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('wptixon-post wptixon-single-post wptixon-index-post'); ?>>
<?php endif; ?>
        

    <?php if ( has_post_thumbnail() ){ ?>
        <div class="blog-details-img">
            <?php if( is_single() ){ ?>
                <?php the_post_thumbnail('wptixon-large', array('class' => 'img-responsive')); ?>
            <?php } else { ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('wptixon-large', array('class' => 'img-responsive')); ?>
                </a>            
            <?php }?>
        </div>
    <?php }  ?>
    
    <div class="tixon-blog-title clearfix">
        <?php if ( get_theme_mod( 'blog_date', true ) ) { ?>
            <div class="blog-date-wrapper">
                <time datetime="<?php echo get_the_date() ?>"><?php echo get_the_date(); ?></time>
            </div>
        <?php } ?>
        <?php
            if (is_single()) {
                the_title( '<h2 class="content-item-title">', '</h2>' );
            } else {
                the_title( '<h2 class="content-item-title"><a href="'.get_the_permalink().'">', '</a></h2>' );
            }
        ?>

        <?php if ( get_theme_mod( 'blog_author', true ) || get_theme_mod( 'blog_category', true ) || get_theme_mod( 'blog_comment', true ) ): ?>
            <ul class="blog-post-meta">
                <?php if ( get_theme_mod( 'blog_author', true ) ): ?>
                    <li class="meta-author">
                        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><i class="fa fa-user"></i> <?php echo get_the_author_meta('display_name');?></a>
                    </li>
                <?php endif; ?>
                <?php if ( get_theme_mod( 'blog_category', true ) ): ?>
                <li class="meta-category">
                    <i class="fa fa-folder-open-o"></i>
                    <?php echo get_the_category_list(', '); ?>
                </li>
                <?php endif; ?>
                <li>
                    <?php
                        if ( get_theme_mod( 'blog_comment', true ) ) {
                            if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ){
                                echo '<p class="meta-comment">';
                                echo '<i class="fa fa-comment-o" aria-hidden="true"></i>'; ?>
                                <?php comments_popup_link( '<span class="leave-reply">' . esc_html__( '0 Comment', 'wptixon' ) . '</span>', esc_html__( '1 Comment', 'wptixon' ), esc_html__( '% Comments', 'wptixon' ) );
                                echo '</p>';
                            }
                        }
                    ?>
                </li>
                
                <?php the_tags('<li class="meta-tags"><i class="fa fa-tags"></i> ', ', ', '</li>'); ?>
                
            </ul>
        <?php endif; ?>
    </div>
    
    <div class="entry-blog">
        <?php
            if (is_single()) {
                get_template_part( 'post-format/entry-content-blog' );
            } else {
                get_template_part( 'post-format/entry-content' );
            }
        ?> 
    </div> <!--/.entry-meta -->
</article><!--/#post-->



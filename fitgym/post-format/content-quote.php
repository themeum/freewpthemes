
<?php if( is_single() ): ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('fitgym-post fitgym-single-post'); ?>>
    <?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('fitgym-post fitgym-index-post'); ?>>
        <?php endif; ?>
        <?php
        $blog_author = get_theme_mod( 'blog_author', true );
        $blog_category = get_theme_mod( 'blog_category', false );
        $blog_comment = get_theme_mod( 'blog_comment', true );
        $blog_date = get_theme_mod( 'blog_date', true );
        $blog_tags = get_theme_mod( 'blog_tags', false );
        $blog_author_single = get_theme_mod( 'blog_author_single', true );
        $blog_date_single = get_theme_mod( 'blog_date_single', true );
        $blog_category_single = get_theme_mod( 'blog_category_single', true );
        $blog_hit_single = get_theme_mod( 'blog_hit_single', true );
        $blog_hit = get_theme_mod( 'blog_hit', false );
        $blog_tags_single = get_theme_mod( 'blog_tags_single', true );
        $blog_comment_single = get_theme_mod( 'blog_comment_single', true );
        $post_img_class = is_single() || !$blog_date ? 'post-featured-image' : 'post-top-1';
        ?>



        <?php if(is_single()) : ?>


            <?php if ( $blog_category_single ): ?>
                <div class="single-blog-category">
                    <?php printf(esc_html__('%s', 'fitgym'), get_the_category_list(', ')); ?>
                </div>
            <?php endif; ?>

            <h1 class="blog-single-title"><?php the_title(); ?></h1>

            <div class="post-meta-1 blog-single-meta">
                <?php if($blog_date)  { ?>
                    <div class="single-meta-1">
                        <i class="fa fa-clock-o"></i>
                        <?php the_date(); ?>
                    </div>
                <?php } ?>
                <?php if($blog_author_single ) { ?>
                    <div class="single-meta-1">
                        <i class="fa fa-user"></i>
                        by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('display_name'); ?></a>
                    </div>
                <?php } ?>
                <?php if($blog_comment_single ) { ?>
                    <div class="single-meta-1">
                        <i class="fa fa-comments"></i>
                        <a href="<?php echo get_comments_link( get_the_ID() ); ?>"></i> <?php comments_number( '0', '1', '%' ); ?><?php esc_html_e(' Comments', 'fitgym') ?></a>
                    </div>
                <?php } ?>
                <?php
                # blog Count Down
                $visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
                if( $visitor_count == '' ) $visitor_count = 0;

                if( $visitor_count >= 1000 ){
                    $visitor_count = round( ($visitor_count/1000), 2 );
                    $visitor_count = $visitor_count.'k';
                }
                ?>
                <?php if($blog_hit_single ) { ?>
                    <div class="single-meta-1">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        <span><?php esc_attr_e($visitor_count); ?></span>
                    </div>
                <?php } ?>
                <?php if ( $blog_tags_single ) { ?>
                    <div class="single-meta-1"><?php echo get_the_tag_list('<i class="fa fa-tags"></i> ',', ',''); ?></div>
                <?php } ?>
            </div>
        <?php endif; ?>


        <div class="featured-wrap-quite">
            <?php if(function_exists('rwmb_meta')){ ?>
                <?php  if ( get_post_meta( get_the_ID(), 'themeum_qoute',true ) ) { ?>
                    <div class="entry-quote-post-format">
                        <span class="blog-content-quote"><i class="fa fa-quote-left" aria-hidden="true"></i></span>
                        <blockquote>
                            <h2><?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute',true )); ?></h2>
                            <span>&nbsp; <i class="fa fa-minus" aria-hidden="true"></i> &nbsp;<?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute_author',true )); ?></span>
                        </blockquote>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>

        <div class="post-content-1">
            <?php if(!is_single()) : ?>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <div class="post-meta-1">
                    <?php if($blog_author ) { ?>
                        <div class="single-meta-1">
                            <i class="fa fa-user"></i>
                            by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('display_name'); ?></a>
                        </div>
                    <?php } ?>
                    <?php if($blog_comment ) { ?>
                        <div class="single-meta-1">
                            <i class="fa fa-comments"></i>
                            <a href="<?php echo get_comments_link( get_the_ID() ); ?>"></i> <?php comments_number( '0', '1', '%' ); ?><?php esc_html_e(' Comments', 'fitgym') ?></a>
                        </div>
                    <?php } ?>
                    <?php
                    # blog Count Down
                    $visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
                    if( $visitor_count == '' ) $visitor_count = 0;

                    if( $visitor_count >= 1000 ){
                        $visitor_count = round( ($visitor_count/1000), 2 );
                        $visitor_count = $visitor_count.'k';
                    }
                    ?>
                    <?php if($blog_hit ) { ?>
                        <div class="single-meta-1">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            <span><?php esc_attr_e($visitor_count); ?></span>
                        </div>
                    <?php } ?>
                    <?php if ( $blog_category ): ?>
                        <div class="single-meta-1">
                            <i class="fa fa-folder"></i></i> <?php printf(esc_html__('%s', 'fitgym'), get_the_category_list(', ')); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $blog_tags ) { ?>
                        <div class="single-meta-1"><?php echo get_the_tag_list('<i class="fa fa-tags"></i> ',', ',''); ?></div>
                    <?php } ?>
                </div>
            <?php endif; ?>

            <div class="entry-blog">
                <?php
                get_template_part( 'post-format/entry-content' );
                ?>
            </div> <!--/.entry-meta -->
        </div>



    </article><!--/#post-->



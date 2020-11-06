<article id="post-<?php the_ID(); ?>" <?php post_class('bridegroom-post themeum-grid-post'); ?>>
    <?php if (!is_single()) { ?>
        <div class="row">
            <div class="content-wrap-section col-sm-10">
                <?php if ( has_post_thumbnail() ) { ?>
                    <div class="bridegroom-thumb">
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('bridegroom-large', array('class' => 'img-responsive')); ?></a>
                    </div>
                <?php } ?>

                <div class="entry-headder">
                    <?php if (get_theme_mod('blog_date', true)): ?>
                        <div class="date">
                            <?php $the_date = get_the_date(); ?>
                            <?php echo date_i18n( get_option( 'date_format' ), strtotime($the_date)); ?>
                        </div>   
                    <?php endif ?>

                    <div class="thm-post-meta">
                        <ul>
                            <?php if (get_theme_mod('blog_author', false)): ?>
                                <li class="author-by">
                                    <i class="fa fa-user"></i>
                                    <span class="author"> <?php the_author_posts_link() ?></span> 
                                </li>
                            <?php endif ?>
                            
                            <?php if(get_theme_mod('blog_comments', false)) : ?>
                                <li class="comments">
                                    <i class="fa fa-comments"></i>
                                    <?php comments_number( '0', '1', '%' ); ?>
                                </li>
                            <?php endif; ?>
                            <?php if(get_theme_mod('blog_category', false)) : ?>
                                <li class="cat-list">
                                    <?php if(get_the_category_list()) : ?>
                                        <i class="fa fa-folder-open-o"></i>
                                    <?php endif; ?>
                                    <?php printf(esc_html__('%s', 'bridegroom'), get_the_category_list(', ')); ?>
                                </li> 
                            <?php endif; ?>      
                            <?php if(get_theme_mod('blog_tag', false)) : ?>
                                <li class="tag-list">
                                    <?php if(get_the_tag_list()) : ?>
                                        <i class="fa fa-tags"></i>
                                    <?php endif; ?>
                                    <?php echo get_the_tag_list('',', ',''); ?>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    
                    <!-- BLog Title -->
                    <h2 class="entry-title blog-entry-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                    </h2>
                </div>
                
                <!-- Post Content -->
                <?php get_template_part( 'post-format/entry-content' ); ?> 

                <?php 
                    if ( get_theme_mod( 'blog_continue_en', true ) ) { 
                        if ( get_theme_mod( 'blog_continue', 'Read More' ) ) {
                            $continue = esc_html( get_theme_mod( 'blog_continue', 'Read More' ) );
                            echo '<p class="wrap-btn-style"><a class="thm-btn" href="'.get_permalink().'">'. $continue .' <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>';

                        } 
                    }
                ?>
            </div>
        </div>
    <?php } else { ?>
        <?php get_template_part( 'post-format/entry-content' ); ?> 
    <?php }  ?>
</article> <!--/#post-->









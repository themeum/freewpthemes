<?php global $themeum_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('eventco-post themeum-grid-post'); ?>>
    <?php if (!is_single()) { ?>
        <div class="row">
            <?php 
                $custom_link = get_post_meta( get_the_ID(), 'themeum_link',true );
                if ( $custom_link ){
                    $col = 'col-sm-7';
                }else {
                    $col = 'col-sm-12';
                } 
            ?>
           
            <div class="eventco-blog-wrap col-sm-5">
                <div class="eventco-thumb">
                    <div class="eventco-blog-wrap-link">
                        <?php if(function_exists('rwmb_meta') && get_post_meta( get_the_ID(), 'themeum_link',true )){ ?>
                        <?php if ( has_post_thumbnail() ) : ?>
                        <div class="blog-details-img">
                            <?php the_post_thumbnail('eventco-large', array('class' => 'img-fluid')); ?>
                            <div class="thm-format-link d-flex align-items-center justify-content-center">
                                <span><?php echo esc_url( get_post_meta( get_the_ID(), 'themeum_link',true ) ); ?></span>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="entry-link-post-format d-flex align-items-center justify-content-center">
                            <h4>
                                <?php echo esc_url( get_post_meta( get_the_ID(), 'themeum_link',true ) ); ?>
                            </h4>
                        </div>
                        <?php endif; ?>

                        <?php } ?>
                    </div>
                </div>
            </div>
            
            <div class="content-wrap-section <?php echo $col;?>">
                <div class="entry-headder">
                    <?php if (get_theme_mod('blog_date', true)): ?>
                        <!-- Date Time -->
                        <div class="date">
                            <i class="fa fa-clock-o"></i>
                            <?php $the_date = get_the_date(); ?>
                            <?php echo date_i18n( get_option( 'date_format' ), strtotime($the_date)); ?>
                        </div>   
                    <?php endif ?>
                    
                    <!-- BLog Title -->
                    <h2 class="entry-title blog-entry-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                    </h2>
                </div>
                
                <!-- Post Content -->
                <?php get_template_part( 'post-format/entry-content' ); ?> 

                <div class="thm-post-meta">
                    <ul>

                        <?php if (get_theme_mod('blog_author', true)): ?>
                            <li class="author-by">
                                <i class="fa fa-user"></i>
                                <span class="author"> <?php the_author_posts_link() ?></span> 
                            </li>
                        <?php endif ?>
                        
                        <?php if(get_theme_mod('blog_comments', true)) : ?>
                            <li class="comments">
                                <i class="fa fa-comments"></i>
                                <?php comments_number( '0', '1', '%' ); ?>
                            </li>
                        <?php endif; ?>
                        <?php if(get_theme_mod('blog_category', true)) : ?>
                            <li class="cat-list">
                                <?php if(get_the_category_list()) : ?>
                                    <i class="fa fa-folder-open-o"></i>
                                <?php endif; ?>
                                <?php printf(esc_html__('%s', 'eventco'), get_the_category_list(', ')); ?>
                            </li> 
                        <?php endif; ?>      
                        <?php if(get_theme_mod('blog_tag', true)) : ?>
                            <li class="tag-list">
                                <?php if(get_the_tag_list()) : ?>
                                    <i class="fa fa-tags"></i>
                                <?php endif; ?>
                                <?php echo get_the_tag_list('',', ',''); ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>


                <?php 
                    if ( get_theme_mod( 'blog_continue_en', true ) ) { 
                        if ( get_theme_mod( 'blog_continue', 'Read More' ) ) {
                            $continue = esc_html( get_theme_mod( 'blog_continue', 'Read More' ) );
                            echo '<p class="wrap-btn-style"><a class="thm-btn" href="'.get_permalink().'">'. $continue .'<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></p>';

                        } 
                    }
                ?>

            </div>
        </div>
    <?php } else { ?>
        <?php get_template_part( 'post-format/entry-content' ); ?> 
    <?php }  ?>
</article> <!--/#post-->


<?php if( is_single() ): ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('zephyr-post zephyr-single-post single-content-flat'); ?>>
<?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('zephyr-post zephyr-single-post zephyr-index-post'); ?>>
<?php endif; ?>


    <?php if (is_single()) { ?>
        <?php if ( get_theme_mod( 'blog_author', false ) || get_theme_mod( 'blog_category', true ) || get_theme_mod( 'blog_comment', false ) ): ?>
            <div class="single-blog-info">
                    <?php if ( get_theme_mod( 'blog_category_single', true ) ): ?>
                        <span class="post-category">
                            <?php printf(esc_html__('%s', 'zephyr'), get_the_category_list(', ')); ?>
                        </span>
                    <?php endif; ?>

                    <?php the_title( '<h2 class="content-item-title">', '</h2>' ); ?>

                    <ul class="blog-post-meta clearfix"> 
                        <?php if ( get_theme_mod( 'blog_author_single', true ) ): ?>
                            <li class="meta-author">
                                <span class="img-author"><i class="fa fa-user-o" aria-hidden="true"></i>
                                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"> <?php esc_html_e('By ', 'zephyr'); ?><?php echo get_the_author_meta('display_name'); ?></a>
                                </span>
                            </li>
                        <?php endif; ?>

                        <?php if ( get_theme_mod( 'blog_date_single', true ) ) { ?>
                            <li>
                                <div class="blog-date-wrapper">
                                    <a href="<?php the_permalink(); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <?php 
                                            $currentdate    = date('m/d/Y g:i:s A');
                                            $postdate       = get_the_date( 'm/d/Y g:i:s A' );
                                            $currentdate    = strtotime($currentdate);
                                            $postdate       = strtotime($postdate);

                                            $diff       = $currentdate - $postdate;
                                            $daysleft   = floor($diff/(60*60*24)) ;
                                            $days       = 'Days ago' ;

                                         ?>
                                         <span><?php echo $daysleft.' '.$days; ?></span>
                                     </a>
                                     
                                </div>
                            </li>
                        <?php } ?> 

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
                                    <span><?php echo esc_attr( $visitor_count ); ?></span>
                            </li>
                        <?php } ?> 

                        <?php if ( get_theme_mod( 'blog_tags_single', true ) ) { ?>
                            <li><?php echo get_the_tag_list('<i class="fa fa-tags"></i> ',', ',''); ?></li> 
                        <?php } ?>

                        <?php if ( get_theme_mod( 'blog_comment_single', true ) ) { ?>
                                <li><i class="fa fa-comments-o"></i> 
                                    <span><?php comments_number( '0', '1', '%' ); ?><?php esc_html_e(' Comments', 'zephyr') ?></span>
                                </li>
                        <?php } ?>  
                    </ul>

                    <span class="blog-intro-text">
                        <?php echo get_post_meta(get_the_ID(), 'themeum_blog_intro', true); ?>
                    </span>
            </div>
            
        <?php endif; ?>
    <?php } ?> 




    <?php if ( has_post_thumbnail() ){ ?>
        <div class="blog-details-img">
            <?php if( is_single() ){ ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('zephyr-large', array('class' => 'img-fluid')); ?>
                </a> 
            <?php } else { ?>     
                <?php 
                    $col = get_theme_mod( 'blog_column', 12 );
                    if ($col == 3) { ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('zephyr-blog-medium', array('class' => 'img-fluid')); ?>
                        </a> 
                    <?php }elseif ($col == 4) { ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('zephyr-blog-medium', array('class' => 'img-fluid')); ?>
                        </a> 
                    <?php }else{ ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('zephyr-large', array('class' => 'img-fluid')); ?>
                        </a> 
                    <?php }
                ?>              
            <?php } ?>
        </div>
    <?php }  ?>
        
    <div class="zephyr-blog-title clearfix"> 

        <?php
            if (! is_single()) { ?>

            <?php if ( get_theme_mod( 'blog_author', false ) || get_theme_mod( 'blog_category', true ) || get_theme_mod( 'blog_comment', false ) ): ?>
            <ul class="blog-post-meta clearfix"> 

                <?php if ( get_theme_mod( 'blog_date', false ) ) { ?>
                    <li>
                        <div class="blog-date-wrapper">
                            <a href="<?php the_permalink(); ?>"><time datetime="<?php echo get_the_date('Y-m-d') ?>"><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></time></a>
                        </div>
                    </li>
                <?php } ?> 

                <?php if ( get_theme_mod( 'blog_category', true ) ): ?>
                    <li class="meta-category">
                        <i class="fa fa-folder"></i></i> <?php printf(esc_html__('%s', 'zephyr'), get_the_category_list(', ')); ?>
                    </li>
                <?php endif; ?>

                <?php if ( get_theme_mod( 'blog_author', false ) ): ?>
                    <li class="meta-author">
                        <i class="fa fa-user"></i> <?php esc_html_e('By', 'zephyr') ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('display_name'); ?></a>
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
        <?php the_title( '<h2 class="content-item-title"><a href="'.get_the_permalink().'">', '</a></h2>' ); ?>
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
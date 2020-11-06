<?php if( is_single() ): ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('winkel-post winkel-single-post single-content-flat'); ?>>
<?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('winkel-post winkel-single-post winkel-index-post'); ?>>
<?php endif; ?>

    <?php if ( has_post_thumbnail() ){ ?>
        <div class="post-img">
            <?php if( is_single() ){ ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('winkel-large', array('class' => 'img-fluid')); ?>
                </a> 
            <?php } else { ?>     
                <?php 
                    $col = get_theme_mod( 'blog_column', 4 );
                    if ($col == 3) { ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('winkel-blog-medium', array('class' => 'img-fluid')); ?>
                        </a> 
                    <?php }elseif ($col == 4) { ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('winkel-blog-medium', array('class' => 'img-fluid')); ?>
                        </a> 
                    <?php }else{ ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('winkel-large', array('class' => 'img-fluid')); ?>
                        </a> 
                    <?php }
                ?>              
            <?php } ?>
        </div>
    <?php } ?>
        
    <div class="inner winkel-blog-title clearfix"> 
        <?php
            if (is_single()) { ?>

                <?php if ( get_theme_mod( 'blog_dates_single', true ) ) { ?>
                    <?php $the_date = get_the_date(); ?>
                    <div class="post-meta">
                        <a href="<?php echo esc_url($permalink); ?>" class="date"><span><?php echo date_i18n("d", strtotime($the_date)); ?></span> <?php echo date_i18n("F", strtotime($the_date)) ?></a>     
                    </div>
                <?php } ?> 

                <?php the_title( '<h6>', '</h6>' ); ?>

                <?php if ( get_theme_mod( 'blog_author_single', false ) || get_theme_mod( 'blog_category_single', true ) || get_theme_mod( 'blog_comment_single', false ) ): ?>

                <ul class="blog-post-meta clearfix"> 

                    <?php if ( get_theme_mod( 'blog_authors_single', true ) ): ?>
                    <li class="meta-author">
                        <span class="img-author"><?php echo get_avatar( get_the_author_meta( 'ID' ) , 32 ); ?></span>
                        <?php esc_html_e('By', 'winkel') ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('display_name'); ?></a>
                    </li>
                    <?php endif; ?>


                    <?php if ( get_theme_mod( 'blog_comments_single', true ) ): ?>
                    <li><i class="fa fa-comments-o"></i> <?php comments_number( '0', '1', '%' ); ?><?php esc_html_e(' Comments', 'winkel') ?></li>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'blogs_tags_single', true ) ): ?>
                    <li><?php echo get_the_tag_list('<i class="fa fa-tags"></i> ',', ',''); ?></li>  
                    <?php endif; ?>


                    <?php if ( get_theme_mod( 'blog_categorys_single', true ) ): ?>
                    <li class="meta-category"><i class="fa fa-folder"></i></i> <?php printf(esc_html__('%s', 'winkel'), get_the_category_list(', ')); ?></li>  
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'blog_hits_single', true ) ): ?>
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
                    <?php endif; ?>
                    
                    <?php if ( get_theme_mod( 'blog_social_shares', true ) ): ?>
                        <li class="winket-social-share-wraper">           
                            <a href="#" data-type="facebook" data-url="<?php echo esc_url($permalink); ?>" data-title="<?php echo $titleget ?>" data-description="<?php echo $titleget ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial fa fa-facebook"></a>
                            <a href="#" data-type="twitter" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $titleget ?>" class="prettySocial fa fa-twitter"></a>
                            <a href="#" data-type="googleplus" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $titleget ?>" class="prettySocial fa fa-google-plus"></a>
                            <a href="#" data-type="pinterest" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $titleget ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial fa fa-pinterest"></a>      
                            <a href="#" data-type="linkedin" data-url="<?php echo esc_url($permalink); ?>" data-title="<?php echo $titleget; ?>" data-description="<?php echo $titleget ?>" data-via="<?php echo get_theme_mod( 'wp_linkedin_user' ); ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial fa fa-linkedin"></a>            
                        </li>
                    <?php endif; ?>
                    
                </ul>

                <?php endif; ?>

        <?php } ?>

        <?php
            if (! is_single()) { ?>

                <?php if ( get_theme_mod( 'blog_date', true ) ) { ?>
                    <?php $the_date = get_the_date(); ?>
                    <div class="post-meta">
                        <a href="<?php echo esc_url($permalink); ?>" class="date"><span><?php echo date_i18n("d", strtotime($the_date)); ?></span> <?php echo date_i18n("F", strtotime($the_date)) ?></a>     
                    </div>
                <?php } ?> 
                <?php the_title( '<a href="'.get_the_permalink().'"><h6>', '</h6></a>' ); ?>


                <?php if ( get_theme_mod( 'blog_author', false ) || get_theme_mod( 'blog_category', true ) || get_theme_mod( 'blog_comment', false ) ): ?>
                <ul class="blog-post-meta clearfix"> 
                    <?php if ( get_theme_mod( 'blog_category', true ) ): ?>
                        <li class="meta-category">
                            <i class="fa fa-folder"></i></i> <?php printf(esc_html__('%s', 'winkel'), get_the_category_list(', ')); ?>
                        </li>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'blog_author', false ) ): ?>
                        <li class="meta-author">
                            <i class="fa fa-user"></i> <?php esc_html_e('By', 'winkel') ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('display_name'); ?></a>
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
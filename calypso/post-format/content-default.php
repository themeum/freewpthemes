<?php 

    $post_date_meta = get_theme_mod( 'blog_date', true );
    $post_tag_meta = get_theme_mod( 'blog_tags', true );
    $post_cat_meta = get_theme_mod( 'blog_category', true );
    $post_comment_meta = get_theme_mod( 'blog_comment', false);
    $textlimit = get_theme_mod( 'blog_post_text_limit', 170 );
    $readmore = get_theme_mod( 'blog_continue_en', true );
    $visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
    $post_hit_meta = get_theme_mod( 'blog_hit', false );
    if( $visitor_count == '' || !$visitor_count ){ 
        $visitor_count = 0; 
    }
    if( $visitor_count >= 1000 ){
        $visitor_count = round( ($visitor_count/1000), 2 );
        $visitor_count = $visitor_count.'k';
    }

?>

<!-- <div class="col-sm-6 col-md-<?php //echo esc_attr($post_column);?> default-postbox-col"> -->
        <div class="thm-default-postbox">
            <div class="thm-post-bg" style="background-image: url(<?php the_post_thumbnail_url('calypso-large'); ?>); "></div>
            <?php if( $post_date_meta) : ?>
            <div class="classic-post-date secondary-font">
                <a href="<?php the_permalink(); ?>">
                    <time datetime="<?php echo get_the_date('Y-m-d') ?>">
                        <?php echo get_the_date(); ?>
                    </time>
                </a>
            </div>
            <?php endif; ?>

            <?php if ( $post_tag_meta || $post_cat_meta ): ?>
                <ul class="blog-post-meta-2 clearfix secondary-font">
                    <?php if ( $post_cat_meta ) { ?>
                        <li>
                            <i class="fa fa-folder-o"></i>
                            <?php printf(esc_html__('%s', 'calypso'), get_the_category_list(', ')); ?>
                        </li>
                    <?php 
                    } 
                    if ( $post_tag_meta && get_the_tag_list() ) { ?>
                        <li>
                            <span>
                                <i class="fa fa-tags"></i>
                            </span>
                            <?php echo get_the_tag_list(' ',', ',''); ?>
                        </li>
                    <?php 
                    } 
                    if($post_comment_meta) { ?>
                        <li>
                            <span>
                                <i class="fa fa-comments-o"></i> 
                                <?php comments_number( '0', '1', '%' ); ?>
                                <?php esc_html_e(' Comments', 'calypso') ?>
                            </span>
                        </li>
                    <?php 
                    }
                    if($post_hit_meta) { ?>
                        <li>
                            <span>  
                                <i class="fa fa-eye"></i> 
                                <?php echo esc_attr( $visitor_count ); ?>
                            </span>
                        </li>
                    <?php 
                    }
                    
                    ?>
                    

                    
                </ul>
            <?php endif; ?>

            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="calypso-blog-content">
                    <?php
                        if ( $textlimit ) {
                            if (get_theme_mod( 'blog_intro_text_en', true )) {
                                echo calypso_excerpt_max_charlength($textlimit);
                            }
                        } else {
                            the_content();
                        }
                    ?>
                </div>
                
            <?php if($readmore) : ?>
                <a href="<?php the_permalink(); ?>" class="thm-readmore secondary-font">Read Now</a>
            <?php endif; ?>
        </div>

<!-- </div> default-post-col -->
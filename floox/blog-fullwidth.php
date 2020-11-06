<?php
/**
* Template Name: Blog Fullwidth
*/
get_header();?>

<section id="main" class="generic-padding">
    <?php get_template_part('lib/sub-header'); ?>
    <div class="container">
        <div id="content" class="site-content" role="main">
            <div class="row no-gutters">
            <?php
                $paged  = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args   = array(
                                'post_type' => 'post',
                                'paged'     => $paged
                            );

                $thequery   = new WP_Query($args);

                $index = 1;

                $col = 4;

                if ( $thequery->have_posts() ) :
                while ( $thequery->have_posts() ) : $thequery->the_post();
                    if ( $index == '1' ) { ?>
                        <?php } ?>
                        <div class="col-xs-12 col-sm-4 default-postbox-col">
                            <div class="thm-default-postbox">
                                <div class="thm-post-bg" style="background-image: url(<?php the_post_thumbnail_url('floox-large'); ?>); "></div>
                                <?php if ( get_theme_mod( 'blog_category', true ) ): ?>
                                    <ul class="blog-post-meta clearfix secondary-font">
                                        <?php if ( get_theme_mod( 'blog_category', true ) ): ?>
                                            <li class="meta-category"><?php printf(esc_html__('%s', 'floox'), get_the_category_list(' ')); ?></li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <?php
                                    if ( get_theme_mod( 'blog_post_text_limit', 170 ) ) {
                                        $textlimit = get_theme_mod( 'blog_post_text_limit', 170 );
                                        if (get_theme_mod( 'blog_intro_text_en', true )) {
                                            echo floox_excerpt_max_charlength($textlimit);
                                        }
                                    } else {
                                        the_content();
                                    }
                                ?>
                                <?php if ( get_theme_mod( 'blog_comment', true ) || get_theme_mod( 'blog_hit', true ) || get_theme_mod( 'blog_tags', true )): ?>
                                    <ul class="blog-post-meta-bottom clearfix secondary-font">
                                        <?php if ( get_theme_mod( 'blog_date', true ) ) { ?>
                                            <li>
                                                <div class="blog-date-wrapper">
                                                    <a href="<?php the_permalink(); ?>"><time datetime="<?php echo get_the_date('Y-m-d') ?>"><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></time></a>
                                                </div>
                                            </li>
                                        <?php } ?>
                                        <?php if ( get_theme_mod( 'blog_hit', true ) ) { ?>
                                            <li>   <span>
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
                                                ?></span>
                                            </li>
                                        <?php } ?>
                                        <?php if ( get_theme_mod( 'blog_tags', true ) && get_the_tag_list() ) { ?>
                                            <li><span><i class="fa fa-tags"></i></span><?php echo get_the_tag_list(' ',', ',''); ?></li>
                                        <?php } ?>
                                        <?php if ( get_theme_mod( 'blog_comment', true ) ) { ?>
                                                <li><span>  <i class="fa fa-comments-o"></i> <?php comments_number( '0', '1', '%' ); ?><?php esc_html_e(' Comments', 'floox') ?></span></li>
                                        <?php } ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php  if ( $index == (12/esc_attr($col) )) { ?>
                    <?php $index = 1;
                    }else{
                        $index++;
                    }
                endwhile;
                else:
                get_template_part( 'post-format/content', 'none' );
                endif;
                wp_reset_postdata();

                if($index !=  1 ){ ?>
                </div>
                <?php }
                    $page_numb = max( 1, get_query_var('paged') );
                    $max_page = $thequery->max_num_pages;
                    echo floox_pagination( $page_numb, $max_page );
                ?>
            </div>
        </div> <!-- .site-content -->
    </div><!-- .container -->
</section>

<?php get_footer();

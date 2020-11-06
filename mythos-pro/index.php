<?php get_header(); ?>

<section id="main">
    <?php get_template_part('lib/sub-header'); ?>
    <div class="container blog-full-container">

        <?php
            $args = array( 
                'post_type'         => 'post',
                'meta_key'          => 'themeum__featured',
                'order'             => 'DESC',
                'posts_per_page'    => 4,
            );
            $feature_post = get_posts($args);
        ?>

        <div class="row feature-blog">
            <?php $counts = 0; $post_number = '4';
            foreach($feature_post as $post){ setup_postdata( $post );  ?>
                <!-- First Post -->
                <?php if ($counts==0){ ?>
                    <div class="col-sm-6 mythos-image-wrap">
                        <div class="mythos-blog addon-article leading-item">
                            <div class="article-image-wrap">
                                <?php  if ( has_post_thumbnail()) { ?>
                                    <a class="item-image"  href="<?php get_permalink(); ?>">
                                        <?php echo get_the_post_thumbnail(get_the_ID(), 'mythos-large', array('class' => 'img-responsive')); ?>     
                                    </a>
                                <?php } ?>
                            </div>

                            <div class="article-details full-wrap">
                                <div class="article-meta">
                                    <span class="meta-date"><?php echo get_the_date(); ?></span>
                                </div>
                                <h3 class="article-title">
                                    <a href="<?php the_permalink( ); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="rticle-introtext">
                                    <p><?php echo mythos_excerpt_max_charlength(120); ?>...</p>
                                    <a href="<?php the_permalink(); ?>" class="blog-btn-wrap"><?php esc_html_e('Learn More', 'mythos-pro'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col-8 -->
                <?php }else { ?>

                    <?php if ($counts == 1): ?> 
                    <div class="col-sm-6 section-content-second">
                    <?php endif ?>
                        <div class="article-details">
                            <?php  if ( has_post_thumbnail()) { ?>
                                <a class="item-image"  href="<?php get_permalink(); ?>">
                                    <?php echo get_the_post_thumbnail(get_the_ID(), 'blog-small', array('class' => 'img-responsive')); ?>     
                                </a>
                            <?php } ?>
                            <h3 class="article-title">
                                <span class="meta-date"><?php echo get_the_date(); ?></span>
                                <a href="<?php the_permalink( ); ?>"><?php the_title(); ?></a>
                            </h3>
                        </div>
                    <?php 
                    $cunt_nbr = $counts+1; 
                    if ($cunt_nbr == $post_number): ?>
                    </div>
                    <?php endif ?>
                <?php } #End Else loop ?>
            <?php  
            $counts++; } 
            wp_reset_postdata(); ?>

            <div class="col-sm-12">
                <div class="border-bottom"></div>
            </div>
        </div> <!-- row end -->

        <div class="row">
            <div id="content" class="site-content col-sm-8" role="main">
                <?php
                $index = 1;
                $col = get_theme_mod( 'blog_column', 12 );
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        if ( $index == '1' ) { ?>
                            <div class="row">
                        <?php }?>
                            <div class="col-md-<?php echo esc_attr($col);?>">
                                <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                            </div>
                        <?php if( $index == (12/esc_attr($col) )) { ?>
                            </div><!--/row-->
                        <?php $index = 1;
                        }else{
                            $index++;   
                        }  
                    endwhile;
                else:
                    get_template_part( 'post-format/content', 'none' );
                endif;
                if($index !=  1 ){ ?>
                   </div><!--/row-->
                <?php } ?>
                <?php 
                $page_numb = max( 1, get_query_var('paged') );
                $max_page = $wp_query->max_num_pages;
                echo wp_kses_post(mythos_pagination( $page_numb, $max_page )); 
                ?>
            </div>
            <?php get_sidebar(); 

            $action_title = get_theme_mod('blog_calltoaction_title');
            $action_subtitle = get_theme_mod('blog_calltoaction_subtitle');

            $button_one = get_theme_mod('blog_button_one');
            $button_two = get_theme_mod('blog_button_two');

            $btn_url1 = get_theme_mod('blog_button_url');
            $btn_url2 = get_theme_mod('blog_button_url2');

            ?>

            <?php if (get_theme_mod('enable_call_to_action', true) == 'true'): ?>     
                <div class="col-md-12 call-to-action">
                    <div class="row">
                        <div class="col-md-6 col-lg-7"> 
                            <h3 class="support-title"><?php echo esc_html($action_title); ?></h3>
                            <h2 class="title-self"><?php echo esc_html($action_subtitle); ?></h2>
                        </div>
                        <div class="col-md-6 col-lg-5 text-right">
                            <?php if ($btn_url1): ?>
                                <a href="<?php echo esc_url($btn_url1); ?>" class="btn"><?php echo esc_html($button_one); ?></a> 
                            <?php endif ?>
                            <?php if ($btn_url2): ?>
                                <a href="<?php echo esc_url($btn_url2); ?>" class="btn btn2"><?php echo esc_html($button_two); ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            <?php endif ?>

        </div> <!-- .row -->
    </div><!-- .container -->
</section> 

<?php get_footer();
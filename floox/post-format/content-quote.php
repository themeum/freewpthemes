



    <?php if( is_single() ): ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('floox-post floox-single-post single-content-flat'); ?>>
        <?php else: ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('floox-post floox-single-post floox-index-post'); ?>>
        <?php endif; ?>

        <div class="blog-details-img">
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
        </div>
            <div class="floox-blog-title clearfix">
                <?php
                    if (is_single()) { ?>

                        <?php
                            $user_socials = array(
                                'facebook' => get_the_author_meta('facebook'),
                                'twitter' => get_the_author_meta('twitter'),
                                'google-plus' => get_the_author_meta('gplus'),
                                'linkedin' => get_the_author_meta('linkedin'),
                                'tumblr' => get_the_author_meta('tumblr'),
                                'pinterest' => get_the_author_meta('pinterest'),
                                'instagram' => get_the_author_meta('instagram')
                            );
                        ?>
                        <div class="thm-post-top">
                            <?php if ( get_theme_mod( 'blog_category_single', true ) ): ?>
                                <?php if(get_theme_mod( 'blog_category', true )) { ?>
                                    <div class="meta-category secondary-font">
                                        <?php printf(esc_html__('%s', 'floox'), get_the_category_list(', ')); ?>
                                    </div>
                                <?php } ?>
                            <?php endif; ?>
                            <?php the_title( '<h2 class="content-item-title"><a href="'.get_the_permalink().'">', '</a></h2>' ); ?>
                            <?php if ( get_theme_mod( 'blog_comment', true ) || get_theme_mod( 'blog_hit_single', true ) || get_theme_mod( 'blog_tags_single', true )): ?>
                                <ul class="blog-post-meta clearfix secondary-font">
                                    <?php if ( get_theme_mod( 'blog_date_single', true ) ) { ?>
                                        <li>
                                            <div class="blog-date-wrapper">
                                                <a href="<?php the_permalink(); ?>"><time datetime="<?php echo get_the_date('Y-m-d') ?>"><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></time></a>
                                            </div>
                                        </li>
                                    <?php } ?>
                                    <?php if ( get_theme_mod( 'blog_hit_single', true ) ) { ?>
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
                                    <?php if ( get_theme_mod( 'blog_tags_single', true ) && get_the_tag_list() ) { ?>
                                        <li><span><i class="fa fa-tags"></i></span><?php echo get_the_tag_list(' ',', ',''); ?></li>
                                    <?php } ?>
                                    <?php if ( get_theme_mod( 'blog_comment_single', true ) ) { ?>
                                            <li><span>  <i class="fa fa-comments-o"></i> <?php comments_number( '0', '1', '%' ); ?><?php esc_html_e(' Comments', 'floox') ?></span></li>
                                    <?php } ?>
                                </ul>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php if(get_theme_mod( 'blog_author_single', true )){ ?>
                                <div class="col col-auto thm-author-box">
                                    <div class="thm-author-box-single text-center">
                                        <div class="thm-author-top">
                                            <div class="thm-author-img" title="Written by <?php echo get_the_author_meta('display_name'); ?>" data-toggle="tooltip">
                                                <?php echo get_avatar( get_the_author_meta( 'ID' ) , 100 ); ?>
                                            </div>
                                            <a class="author-name text-uc" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                                                <?php echo get_the_author_meta('display_name'); ?>
                                            </a>
                                            <a class="author-name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                                                <?php echo get_the_author_meta('nickname'); ?>
                                            </a>
                                        </div>

                                        <?php if($user_socials) : ?>
                                        <ul class="thm-author-social row no-gutters">
                                        <?php
                                            $author_social_markup = '';
                                            $count = 0;
                                            foreach($user_socials as $u_social => $us_value){
                                                $count++;
                                                if($us_value && $count <= 4){
                                                    $author_social_markup .= '<li class="col"><a href="'.$us_value.'" class="fa fa-'.$u_social.'"></a></li>';
                                                }
                                            }
                                            echo $author_social_markup;
                                        ?>
                                        </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col">
                                <div class="entry-blog">
                                    <?php
                                        get_template_part( 'post-format/entry-content-blog' );
                                    ?>
                                </div> <!--/.entry-meta -->
                            </div>
                        </div>





                <?php } ?>
                <?php
                    if (! is_single()) { ?>
                    <?php if ( get_theme_mod( 'blog_category', true ) ): ?>
                        <ul class="blog-post-meta clearfix secondary-font">
                            <?php if ( get_theme_mod( 'blog_category', true ) ): ?>
                                <li class="meta-category"><?php printf(esc_html__('%s', 'floox'), get_the_category_list(' ')); ?></li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                    <?php the_title( '<h2 class="content-item-title"><a href="'.get_the_permalink().'">', '</a></h2>' ); ?>
                    <?php if(get_theme_mod('blog_content', true)): ?>
                        <div class="floox-blog-content">
                            <?php
                                $textlimit = get_theme_mod( 'blog_post_text_limit', 170 );
                                if ( $textlimit ) {
                                    if (get_theme_mod( 'blog_intro_text_en', true )) {
                                        echo floox_excerpt_max_charlength($textlimit);
                                    }
                                } else {
                                    the_content();
                                }
                            ?>
                        </div>
                    <?php endif; ?>
                <?php } ?>
            </div>

        </article><!--/#post-->

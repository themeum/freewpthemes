<?php 
/**
* Template Name: Blog Fullwidth 
*/
get_header();
get_template_part('lib/sub-header'); ?>

<section id="main" class="generic-padding">
    <div class="container">
        <div id="content" class="site-content" role="main">
            <div class="blog-content-wrapper">
                <div class="row">
                    
                    <?php 
                        $blogcat = get_terms( array(
                            'taxonomy'      => 'category',
                            'orderby'       => 'id',
                            'order'         => 'DESC',
                        ) );
                            
                        $output = '';

                        $i = 0;
                        $i2 = 0; 
                    ?>
                    <div class="blog-navigation">

                        <div class="blog-search-full">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Nav tabs -->
                                    <?php if(!empty($blogcat) && !is_wp_error( $blogcat )): ?>
                                        <ul class="nav nav-tabs category-navigation" role="tablist">
                                            <?php foreach($blogcat as $blogpost): ?>
                                                <?php if(!$i): ?>
                                                    <li role="presentation" class="active"><a href="#<?php echo esc_attr( $blogpost->slug ); ?>" aria-controls="<?php echo esc_attr( $blogpost->slug ); ?>" role="tab" data-toggle="tab"><?php echo esc_html( $blogpost->name ); ?></a></li>
                                                <?php else: ?>
                                                    <li role="presentation"><a href="#<?php echo esc_attr( $blogpost->slug ); ?>" aria-controls="<?php echo esc_attr( $blogpost->slug ); ?>" role="tab" data-toggle="tab"><?php echo esc_html( $blogpost->name ); ?></a></li>
                                                <?php endif; ?>
                                            <?php $i++; endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <div class="thm-tk-search">
                                        <form role="search" method="get" id="searchform" action="<?php echo get_permalink(); ?>">
                                            <div class="event-filter flex">
                                                <div class="single-filter ft-330">
                                                    <div class="select-ct">
                                                        <?php
                                                            $options = array(
                                                                'comments'  => 'Most Commented',
                                                                'popular'   => 'Popular',
                                                                'latest'    => 'Latest', 
                                                            );
                                                        ?>
                                                        <select id="post_status" name="post_status">
                                                            <?php 
                                                                $op = '<option value="%s"%s>%s</option>';
                                                                foreach ($options as $key=>$value ) {
                                                                    printf($op, $key, ' selected="selected"', $value);
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="single-filter ft-300">
                                                    <input type="text" placeholder="Enter Post title" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'" value="<?php echo esc_attr( get_search_query() ); ?>" name="search" id="search" title="<?php echo esc_attr_x( 'Search for:', 'label', 'learnhub' ); ?>" />

                                                    <button class="btn btn-primary search-icon" id="blogpost_search" type="submit">
                                                        <span><i class="fa fa-search"></i></span>
                                                    </button>
                            
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php get_template_part('lib/blog-search'); ?>

                        <?php if(!empty($blogcat) && !is_wp_error( $blogcat )): ?>
                            <div class="tab-content">
                                <?php foreach($blogcat as $blogpost): ?>
                                    <?php if(!$i2): ?>
                                        <div role="tabpanel" class="tab-pane active" id="<?php echo esc_attr( $blogpost->slug ); ?>">
                                            <div class="row">
                                                <?php zephyr_blog_callback_function($blogpost->slug); ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div role="tabpanel" class="tab-pane" id="<?php echo esc_attr( $blogpost->slug ); ?>">
                                            <div class="row">
                                                <?php zephyr_blog_callback_function($blogpost->slug); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php $i2++; endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div> <!-- blog-navigation -->

                    <?php function zephyr_blog_callback_function( $slug ){
                        $args = array(
                            'post_type'         => 'post',
                            'posts_per_page'    => -1,
                            'order'             => 'DESC',
                            'tax_query'         => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field'    => 'slug',
                                    'terms'    => $slug,
                                ),
                            ),
                        );
                        $query = new WP_Query($args);
                        $count = 1; ?>
                        
                            <?php if ( $query->have_posts() ) :
                                while ( $query->have_posts() ) : $query->the_post(); ?>

                                    <?php 

                                    $img = '';
                                    if ($count == 1) { 

                                        if (has_post_thumbnail( get_the_id() )) {
                                            $src_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'zephyr-portfo' );
                                            if (isset($src_image[0])) {
                                                $img = $src_image[0];
                                            }
                                        } 

                                        ?>
                                        <div class="col-md-12">
                                                <div class="blog-12-column">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="thm-profile-img">
                                                                <?php if( !empty($img) ): ?>
                                                                    <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="img-responsive">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="thm-profile-content">
                                                                <?php if ( get_theme_mod( 'blog_category', true ) ){ ?>
                                                                    <span class="post-category">
                                                                        <?php printf(esc_html__('%s', 'zephyr'), get_the_category_list(', ')); ?>
                                                                    </span>
                                                                <?php } ?>

                                                                <h3 class="thm-profile-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>

                                                                <ul>
                                                                    <?php if ( get_theme_mod( 'blog_author', true ) ){ ?>
                                                                    <li class="meta-author">
                                                                        <span class="img-author"><i class="fa fa-user-o" aria-hidden="true"></i>
                                                                            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"> <?php esc_html_e('By ', 'zephyr'); ?><?php echo get_the_author_meta('display_name'); ?></a>
                                                                        </span>
                                                                    </li>
                                                                    <?php } ?>

                                                                    <?php if ( get_theme_mod( 'blog_date', true ) ){ ?>
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
                                                                                    $days       = __('Days ago', 'zephyr');

                                                                                 ?>
                                                                                 <span><?php echo $daysleft.' '.$days; ?></span>
                                                                             </a>
                                                                             
                                                                        </div>
                                                                    </li>
                                                                    <?php } ?>

                                                                    <?php if ( get_theme_mod( 'blog_comment', true ) ){ ?>
                                                                    <li>
                                                                        <a href="#">
                                                                            <i class="fa fa-comments-o"></i> <?php comments_number( '0', '1', '%' ); ?><?php esc_html_e(' Comments', 'zephyr') ?>
                                                                        </a>
                                                                    </li>
                                                                    <?php } ?>
                                                                </ul>


                                                                <p>
                                                                <?php echo zephyr_excerpt_max_charlength(220); ?>
                                                                </p>

                                                                <a class="blog-button btn btn-success" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'zephyr'); ?></a>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }else {
                                            if (has_post_thumbnail( get_the_id() )) {
                                                $src_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'zephyr-blog-medium' );
                                                if (isset($src_image[0])) {
                                                    $img = $src_image[0];
                                                }
                                            } 

                                            $col = get_theme_mod( 'blog_column', 4 );
                                        ?>

                                        <div class="col-md-<?php echo $col; ?>">
                                            <div class="thm-profile">
                                                <div class="thm-profile-img">
                                                    <?php if( !empty($img) ): ?>
                                                        <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="img-responsive">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="thm-profile-content single-post-content">

                                                    <?php if ( get_theme_mod( 'blog_category', true ) ): ?>
                                                        <span class="post-category">
                                                            <?php printf(esc_html__('%s', 'zephyr'), get_the_category_list(', ')); ?>
                                                        </span>
                                                    <?php endif; ?>

                                                    <h3 class="thm-profile-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>

                                                    <ul> 
                                                        <?php if ( get_theme_mod( 'blog_date', true ) ) { ?>
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
                                                                        $days       = __('Days ago', 'zephyr');

                                                                     ?>
                                                                     <span><?php echo $daysleft.' '.$days; ?></span>
                                                                 </a>
                                                                 
                                                            </div>
                                                        </li>
                                                        <?php } ?> 

                                                        <?php if ( get_theme_mod( 'blog_comment', true ) ) { ?>
                                                        <li>
                                                            <a href="#">
                                                                <i class="fa fa-comments-o"></i> <?php comments_number( '0', '1', '%' ); ?><?php esc_html_e(' Comments', 'zephyr') ?>
                                                            </a>
                                                        </li>
                                                        <?php } ?> 

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }

                                    $count ++;
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                    <?php } ?>
                </div>
            </div>
        </div> <!-- .site-content -->
    </div><!-- .container -->
</section> 

<?php get_footer();
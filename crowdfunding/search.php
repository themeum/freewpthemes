<?php get_header(); ?>
<?php get_template_part('lib/sub-header')?>

<section id="main" class="container">
    <div class="row">
        <?php if ( !isset($_GET['searchtype']) ) : ?>
            <div id="content" class="site-content col-md-12">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                    <?php endwhile; ?>
                    <?php
                        global $wp_query;
                        $page_numb = max( 1, get_query_var('paged') );
                        $total_page = $wp_query->max_num_pages;
                    ?>
                    <?php echo themeum_pagination( $page_numb,$total_page ); ?>
                <?php else: ?>
                    <?php get_template_part( 'post-format/content', 'none' ); ?>
                <?php endif; ?>
            </div> <!-- #content -->
        <?php else: ?>
            <div id="content" class="search-content site-content col-md-offset-3 col-md-6" role="main">
                <?php
                    $data_view = '';
                    $args = array();
                    $page_numb = max( 1, get_query_var('paged') );
                    if(isset($_GET['s'])){
                        $args = array(
                                    's'                 => $_GET['s'],
                                    'post_type'         => 'product',
                                    'paged'             => $page_numb
                            );
                        if(isset($_GET['searchtype'])){
                            if($_GET['searchtype']!='' && $_GET['searchtype']!='all'){
                                $args['tax_query'] = array(
                                                            array(
                                                                'taxonomy' => 'product_cat',
                                                                'field'    => 'slug',
                                                                'terms'    =>  $_POST['searchtype'],
                                                            ),
                                                        );
                            }
                        }
                        $data_view = $_GET['s'];
                    }

                    $search_data = new WP_Query($args);
                    if($search_data->have_posts()):
                        while ($search_data->have_posts()): $search_data->the_post();
                            $the_title = $the_content = '';
                            if( $data_view != '' ){ 
                                $the_title = str_ireplace( $data_view ,"<span>".$data_view."</span>", get_the_title() ); 
                            }else{
                                $the_title = get_the_title();
                            }
                            if( $data_view != '' ){
                                $the_content = str_ireplace( $data_view ,"<span>".$data_view."</span>", crowdfunding_excerpt_max_charlength( get_the_excerpt(),200 ) );
                            }else{
                                $the_content = crowdfunding_excerpt_max_charlength( get_the_excerpt(), 200 );
                            }
                            echo '<div class="search-content-list">';
                                echo '<h3><a href="'.get_permalink().'">'.$the_title.'</a></h3>';
                                echo '<p>'.$the_content.'</p>';
                            echo '</div>';
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    
                    $max_page = $search_data->max_num_pages;
                   // echo moview_pagination($page_numb,$max_page);
                    $big = 999999999; // need an unlikely integer
                    echo '<div class="themeum-pagination">';
                    echo paginate_links( array(
                        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format'    => '?paged=%#%',
                        'current'   => $page_numb,
                        'total'     => $max_page,
                        'type'      => 'list',
                        'prev_text'          => __('«'),
                        'next_text'          => __('»'),
                    ) );
                    echo '</div>';
                ?>
            </div> <!-- #content -->
        <?php endif; ?>
    </div>
</section>



















<?php get_footer();
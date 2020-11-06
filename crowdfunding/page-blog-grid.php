<?php
/*
 * Template Name: Blog Listing Grid
 */
get_header(); ?>

    <section id="main">
    <?php get_template_part('lib/sub-header')?>

        <div id="content" class="site-content" role="main">
            <div class="container">
                <div class="row">
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array('post_type' => 'post','paged' => $paged);
                    $thequery = new WP_Query($args);

                    if ( $thequery->have_posts() ) :
                        while ( $thequery->have_posts() ) : $thequery->the_post();

                            echo '<div class="ideas-item col-md-4">';
                                if ( has_post_thumbnail() && ! post_password_required() ){
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'project-thumb' );
                                    echo '<div class="image">';
                                        echo '<a href="'.get_permalink().'">';
                                            echo '<figure>';
                                                echo '<img src="'.$image[0].'" class="img-responsive">';
                                                echo '<i class="fa fa-location-arrow"></i>';
                                            echo '</figure>';
                                        echo '</a>';
                                    echo '</div>';
                                }

                                echo '<div class="details">';
                                    echo '<div class="grid-post-date">'.get_the_date("d F Y").'</div>';
                                    echo '<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
                                    echo '<div class="grid-post-meta">';
                                        echo '<div class="grid-author">';
                                            echo '<span>#</span>'.get_the_author();
                                        echo '</div>';
                                        echo '<div class="grid-comments-number">';
                                            echo '<i class="fa fa-twitch"></i> '.get_comments_number();
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';

                        endwhile;
                    else:
                        get_template_part( 'post-format/content', 'none' );
                    endif;
                    wp_reset_postdata();
                    ?>
                    <?php
                    $page_numb = max( 1, get_query_var('paged') );
                    $max_page = $thequery->max_num_pages;
                    echo themeum_pagination( $page_numb, $max_page );
                    ?>
                </div>
            </div>
        </div> <!-- #content -->
    </section>
<?php get_footer();
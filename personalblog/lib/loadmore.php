<?php

global $post;
$args = array(  
    'post_type'         =>'post',
    'post_status'       =>'publish',
    'posts_per_page'    => $_POST['perpage'],
    'paged'             => $_POST['paged'],
);

$loadposts = new WP_Query($args);

while($loadposts->have_posts()){ $loadposts->the_post(); 
    get_template_part( 'post-format/content', get_post_format() );
}
wp_reset_postdata();
die();

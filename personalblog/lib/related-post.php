<!-- Related Posts -->
<?php 
  $orig_post = $post; 
  global $post; 
  $tags = wp_get_post_tags($post->ID); 
  
  if ($tags):
    $tag_ids = array(); 
    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
    $number_of_posts = 4; // number of posts to display
    $query = "
      SELECT ".$wpdb->posts.".*, COUNT(".$wpdb->posts.".ID) as q
      FROM ".$wpdb->posts." INNER JOIN ".$wpdb->term_relationships."
      ON (".$wpdb->posts.".ID = ".$wpdb->term_relationships.".object_id)
      WHERE ".$wpdb->posts.".ID NOT IN (".$post->ID.")
      AND ".$wpdb->term_relationships.".term_taxonomy_id IN (".implode(",",$tag_ids).")
      AND ".$wpdb->posts.".post_type = 'post'
      AND ".$wpdb->posts.".post_status = 'publish'
      GROUP BY ".$wpdb->posts.".ID
      ORDER BY q
      DESC LIMIT ".$number_of_posts."";
    $related_posts = $wpdb->get_results($query, OBJECT);

    if($related_posts): ?>
      <div class="related-posts"> 
        <h3 class="style-title"><?php esc_html_e('Related Posts','personalblog');?></h3>
        <div class="row">
            <?php foreach($related_posts as $post): ?>
            <?php setup_postdata($post);?>
            <div class="col-xs-6 col-sm-3 single-related-posts">            
                <?php 
                if ( has_post_thumbnail() ) {
                  $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'personalblog-thumb' );
                  $image ='style="height:140px;background: url('.esc_url($img[0]).') no-repeat;background-size: cover;"'; 
                }else {
                  $image ='style="height:140px;background: #333;"';
                } ?>
                <div class="related-post-item">
                    <div class="common-post-item-in" <?php echo $image; ?>></div>
                    <div class="common-post-item-intro">
                      <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4> 
                    </div>
                </div>
            </div> 
            <?php endforeach; ?>
        </div>
      </div>
    <?php endif;
  endif;
  $post = $orig_post; 
?>
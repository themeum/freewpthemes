<article class="project-padding" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-header">
        <h2 class="entry-title blog-entry-title">
            <?php the_title(); ?>
        </h2> <!-- //.entry-title -->
        <ul class="entry-portfolio-meta">
            <li><?php esc_html_e( 'CLIENTS:', 'aresmurphy' ); ?> <?php echo get_post_meta( get_the_id() , 'themeum_portfolio_client', true ) ?></li>
            <li><?php esc_html_e( 'Category:', 'aresmurphy' ); ?> <?php echo get_the_term_list( get_the_id(), 'portfolio-cat', '', ' ' ); ?></li>
            <li><?php esc_html_e( 'DATE:', 'aresmurphy' ); ?> <?php echo get_post_meta( get_the_id() , 'themeum_portfolio_date', true ) ?></li>
        </ul>
    </div>
    <?php if ( has_post_thumbnail() ){ ?>
        <div class="blog-details-img">
            <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
        </div>
    <?php }  ?>
    <?php
      $project_info = get_post_meta( get_the_id() , 'project_meta', true );
      $col = 'col-md-12';
      if(is_array($project_info)){
          if(!empty( $project_info )){
              $col = 'col-md-8';
          }
      }
    ?>
    <div class="row">
        <div class="<?php echo $col; ?>">
            <?php the_content(); ?>
        </div>

        <?php
            if(is_array($project_info)){
                if(!empty( $project_info )){
                    echo '<div class="col-md-4">';
                    $i = 0;
                    $last = '';
                    $count = count( $project_info );
                    foreach ( $project_info as $value ) { $i++;
                        if( $count == $i ){ $last = 'last'; }
                        $title = explode('|', $value);
                        echo '<div class="simpleportfolio-data '.$last.'"><h4>'.$title[0].'</h4>';
                            if( isset($title[1]) ){  echo $title[1]; }
                        echo '</div>';
                    }
                    echo '</div>';
                }
            }
        ?>

        <div class="col-md-12 project-navigator">
            <?php
                $prev_post = get_previous_post();
                if($prev_post) {
                   $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
                   echo '<a class="prev" href="' . get_permalink($prev_post->ID) . '">&laquo; '.__( "Previous","aresmurphy" ).'</a>';
                }
                $next_post = get_next_post();
                if($next_post) {
                   $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
                   echo '<a class="next" href="' . get_permalink($next_post->ID) . '">'.__( "Next","aresmurphy" ).' &raquo;</a>';
                }
            ?>
        </div>
    </div>
</article><!--/#post-->

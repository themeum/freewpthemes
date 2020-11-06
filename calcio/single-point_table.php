<?php
/**
 * Display Single Point_table
 *
 * @author    Themeum
 * @category  Template
 * @package   Soccer
 * @version     1.0
 *-------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) )
  exit; 

get_header();

function sort_by_goal_difference($a, $b){
    return $b['themeum_goals_difference'] - $a['themeum_goals_difference'];
} ?>

<?php if ( have_posts() ) : the_post(); ?>

<div class="club-profile">      
    <div class="container match-result-wrapper" style="margin-top: 30px">  
        <?php get_template_part('lib/sub-header'); ?>  
    </div>
</div>

<section id="main" class="clearfix">
    
    <div class="point-table-single">
        <div class="container">
            <div class="point-table table-responsive">
                <table class="table table-striped">
                  <?php
                      foreach ($posts as $post){
                      setup_postdata( $post );

                      $point_table    = get_post_meta(get_the_ID(),'point_table_group',true);
                      usort($point_table, 'sort_by_goal_difference');  

                      $frequent = array();
                      foreach ( $point_table as $value ){
                          if( !empty($frequent) ){
                              if( array_key_exists( $value['themeum_points'],$frequent ) ){
                                  $frequent[$value['themeum_points']] = $frequent[$value['themeum_points']] + 1;    
                              }else{
                                  $frequent[$value['themeum_points']] = 1;  
                              }
                          }else{
                              $frequent[$value['themeum_points']] = 1;
                          }
                      }

                      $serial_data = array();
                      $value_count = 0;
                      foreach ($frequent as $value) {
                          $serial_data[] = array_slice($point_table, $value_count, $value);   
                          $value_count = $value_count + $value; 
                      }

                      $marge_inline = array();
                      foreach ($serial_data as $value) {
                        usort($value, 'sort_by_goal_difference');
                        $marge_inline[] = $value;
                      }

                      $all_point = array();
                      foreach ($marge_inline as $value1) {
                          foreach ($value1 as $value) {
                              $all_point[] = $value;
                          }
                      }
                      $i=1;
                      ?>


                      <thead class="point-table-head"><tr><th class="text-left"><?php esc_html_e('No','calcio'); ?></th><th class="text-left"><?php esc_html_e('TEAM','calcio'); ?></th><th>P</th><th>W</th><th>D</th><th>L</th><th>GS</th><th>GA</th><th>+/-</th><th>PTS</th></tr></thead>
                      <tbody>
                      <?php
                      foreach ($all_point as  $value) {
                        if ( $value['themeum_club_name'] ) { ?>
                          <tr>
                          <td class="text-left"><?php print $i; ?></td>

                          <td class="text-left">
                              <a href="<?php echo get_the_permalink($value['themeum_club_name']); ?>">
                                  <img class="point-table-image" src="<?php echo esc_url( themeum_logo_url_by_id($value['themeum_club_name']) ); ?>" alt="<?php echo get_the_title($value['themeum_club_name']); ?>">
                                  <span><?php echo get_the_title($value['themeum_club_name']); ?></span>
                              </a>
                          </td>

                          <td><?php print $value['themeum_games_played']; ?></td>
                          <td><?php print $value['themeum_games_won']; ?></td>
                          <td><?php print $value['themeum_games_drown']; ?></td>
                          <td><?php print $value['themeum_games_lost']; ?></td>
                          <td><?php print $value['themeum_goals_scored']; ?></td>
                          <td><?php print $value['themeum_goals_against']; ?></td>
                          <td><?php print $value['themeum_goals_difference']; ?></td>
                          <td><?php print $value['themeum_points']; ?></td>
                          </tr>
                        <?php
                        $i++; 
                        }
                      }
                      ?>
                      </tbody>
                      <?php }
                      wp_reset_postdata();
                  ?>
                </table>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>

<?php get_footer();
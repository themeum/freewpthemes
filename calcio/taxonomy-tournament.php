<?php
if ( ! defined( 'ABSPATH' ) ){ exit; }
    get_header(); 

    function themeum_tournament_cat_list( $id, $cat ){
        $output = array();
        $term_list = get_the_terms($id,$cat);
        if(is_array($term_list)){
            foreach ($term_list as $value) {
                $output[] = $value->name;
            }
            $output = implode(",", $output);
        }
        return $output;
    }

    # Date With GMT Value
    $datetime    = get_post_meta(get_the_ID(),'themeum_datetime',true);
    $gmt         = get_post_meta(get_the_ID(),'themeum_gmt',true);
    $sports_date = '';
    if($datetime != ''){
        $sports_date = date_format(date_create($datetime), 'd M Y h:i A').' '.$gmt;
    }

    # Club Name
    $team_1_group               = get_post_meta(get_the_ID(),'team_1_group',true);
    $team_2_group               = get_post_meta(get_the_ID(),'team_2_group',true);
    $match_result_group         = get_post_meta(get_the_ID(),'match_result_group',true);

    # Goal and Timing 
    $goal_timing_group          = get_post_meta(get_the_ID(),'goal_timing_group',true);
    $goal_timing_group_extra    = get_post_meta(get_the_ID(),'goal_extra_timing',true);

    $match_timeline             = get_post_meta(get_the_ID(),'match_timeline',true);  # Match timeline

    # Match Substitutes
    $substitutes    = get_post_meta(get_the_ID(),'match_substitutes',true);

    function sort_by_points($a, $b){
        return $b['themeum_points'] - $a['themeum_points'];
    }

?>



<section id="main">
    <div class="container match-result-wrapper" style="margin-top: 30px">  
        <?php get_template_part('lib/sub-header'); ?>  
        <div class="row">
            <div class="col-sm-12 club-profile-wrap">  
                <?php 
                $attach_id = get_post_thumbnail_id();
                if( $attach_id ){
                echo '<div class="match-banner-result-wrap" style="background-image:url('.wp_get_attachment_url(get_post_thumbnail_id()).');background-size: cover; background-position: 50% 50%;padding:40px 0 40px">';
                }else{ ?>
                <div class="match-banner-result-wrap" style="background: #333;background-image:url(<?php echo get_parent_theme_file_uri( 'images/match-banner.jpg' );?>);background-size: cover;background-position: 50% 50%;padding:40px 0 40px">
                <?php } ?>
                    <div class="match-league-title text-center">
                        <p><?php echo themeum_tournament_cat_list( get_the_ID(), 'tournament' ); ?> - <?php echo date_i18n("d M Y", strtotime($sports_date)); ?></p>
                        <p><?php echo date_i18n("h:i A", strtotime($sports_date)).' '.$gmt; ?></p>
                    </div> <!-- match-league-title -->
                    
                    <div class="goal-timeline hidden-xs">
                        <?php
                            $timing = get_post_meta(get_the_ID(),'goal_timing_group',true);
                            $li_builder_1 = $li_builder_2 = $li_builder_3 = '';
                            
                                foreach ($timing as $value) {
                                    if (isset($value['themeum_time_of_goal'])) {
                                    $goal_time = $value['themeum_time_of_goal'];
                                        if( $goal_time <= 45 ){
                                            $li_builder_1 .= '<li style="left:'.floor((100/45)*$goal_time).'%" class="team1 goal">';
                                            if (isset($value['themeum_goal_player'])) {
                                                $li_builder_1 .= '<span class="time">'.themeum_get_title_by_id($value['themeum_goal_player']).' '.$goal_time.'"</span>';
                                            }
                                            $li_builder_1 .= '</li>'; 
                                        }
                                        if( $goal_time > 45 ){
                                            if( $goal_time > 90 ){
                                                $li_builder_2 .= '<li style="left:100%" class="team1 goal">';
                                                if (isset($value['themeum_goal_player'])) {
                                                    $li_builder_2 .= '<span class="time">'.themeum_get_title_by_id($value['themeum_goal_player']).' '.$goal_time.'"</span>';
                                                }
                                                $li_builder_2 .= '</li>'; 
                                            }else{
                                                $li_builder_2 .= '<li style="left:'.floor((100/90)*$goal_time).'%" class="team1 goal">';
                                                if (isset($value['themeum_goal_player'])) {
                                                    $li_builder_2 .= '<span class="time">'.themeum_get_title_by_id($value['themeum_goal_player']).' '.$goal_time.'"</span>';
                                                }
                                                $li_builder_2 .= '</li>'; 
                                            } 
                                        }
                                    }
                                }

                                $extra_timing = get_post_meta( get_the_ID(),'goal_extra_timing',true );
                                $total_timing = get_post_meta( get_the_ID(),'themeum_extra_time',true );

                                if(is_array( $extra_timing )){
                                    if(!empty( $extra_timing )){
                                        if( $total_timing != "" && $total_timing != 0 ){
                                            foreach ($extra_timing as $value) {

                                                if( $value['themeum_extra_time_of_goal'] != '' ){
                                                    $li_builder_3 .= '<li style="left:'.floor((100/$total_timing)*$value['themeum_extra_time_of_goal']).'%" class="team1 goal">';
                                                        $li_builder_3 .= '<span class="time">'.themeum_get_title_by_id($value['themeum_extra_goal_player']).' '.( 90+$value['themeum_extra_time_of_goal'] ).'"</span>';
                                                    $li_builder_3 .= '</li>';
                                                }

                                            }
                                        }
                                    }
                                }


                                echo '<span class="timeline-time">00"</span>';
                                echo '<ul class="goal-timeline1">';
                                    print $li_builder_1;
                                echo '</ul>';



                                echo '<span class="timeline-time">45"</span>';
                                echo '<ul class="goal-timeline2">';
                                    print $li_builder_2;
                                echo '</ul>';
                                echo '<span class="timeline-time">90"</span>';

                                if(isset($total_timing)){
                                    if( $total_timing != '' ){
                                        echo '<div class="extra-time-goal">';
                                            echo '<span class="timeline-titme">+</span>';
                                            echo '<ul class="goal-timeline2">';
                                                print $li_builder_3;
                                            echo '</ul>';
                                            echo '<span class="timeline-titme">'.$total_timing.'"</span>';
                                        echo '</div>';        
                                    }
                                }
                                
                        ?>
                    </div> <!-- Goal Time Line -->  
                </div><!-- match-banner-result-wrap -->

                <div class="leagure-result-cont">
                    <!-- Team One Result -->
                    <div class="col-xs-12 col-sm-3 match-team-left">
                        <div class="goal-count media">
                            <div class="team-one-img">
                                <img src="<?php echo esc_url(get_parent_theme_file_uri( 'images/football-icon.png' )); ?>" alt="<?php echo themeum_get_title_by_id($team_1_group['themeum_club_name1']); ?>">
                            </div>
                            <div class="media-body text-left">
                                <ul>
                                <?php
                                $goal1 = $goal2 = 0;
                                if(is_array($goal_timing_group)){
                                    
                                    foreach ($goal_timing_group as $value){
                                        if (isset($value['themeum_select_team'])) {
                                            if($value['themeum_select_team'] == 'value1'){
                                                $goal1++;
                                                if (isset($value['themeum_goal_player'])) {
                                                    $player_name = themeum_get_title_by_id($value['themeum_goal_player']);
                                                    if( $value['themeum_goal_player'] != '' ){
                                                        echo "<li>".$player_name." ".$value['themeum_time_of_goal']."'</li>";
                                                    }
                                                }

                                            }

                                            if($value['themeum_select_team'] == 'value2'){ 
                                                $goal2++; 
                                            }
                                        }
                                    }


                                    if(is_array( $goal_timing_group_extra )){
                                        if(!empty($goal_timing_group_extra)){
                                            foreach ($goal_timing_group_extra as $value) {
                                                if(isset($value['themeum_extra_select_team'])){
                                                    if(isset($value['themeum_extra_time_of_goal'])){        
                                                        if($value['themeum_extra_goal_player'] != ''){
                                                            
                                                            $player_name = themeum_get_title_by_id($value['themeum_extra_goal_player']);
                                                            if( $value['themeum_extra_select_team'] == 'value1' ){
                                                                echo "<li>".$player_name." ".$value['themeum_extra_time_of_goal']."'</li>";
                                                                $goal1++;
                                                            }
                                                        }
                                                    }
                                                    if($value['themeum_extra_select_team'] == 'value2'){ $goal2++; }
                                                }
                                            }
                                        }
                                    }


                                }
                                ?>
                                </ul>        
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-2 match-team-left">
                        <div class="match-team text-center">
                            <div class="team-img-one icon-lefti">
                                <?php if( isset($team_1_group['themeum_club_name1']) ): ?>
                                    <img width="61" src="<?php echo themeum_logo_url_by_id($team_1_group['themeum_club_name1']); ?>" alt="<?php echo themeum_get_title_by_id($team_1_group['themeum_club_name1']); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="title">
                                <?php if( isset($team_1_group['themeum_club_name1']) ): ?>
                                    <h4><?php echo themeum_get_title_by_id($team_1_group['themeum_club_name1']); ?></h4>
                                <?php endif; ?>
                            </div>
                        </div> 
                    </div>
                    <!-- Team One Result End -->

                    <div class="col-xs-12 col-sm-2 score">
                        <span><?php $total_goal = get_post_meta( get_the_ID(), 'themeum_goal_count', true); print $total_goal; ?></span>
                    </div>

                    <!-- Team Two Result -->
                    <div class="col-xs-12 col-sm-2 match-team-right">
                        <div class="match-team text-center">
                            <div class="team-img-one icon-right">
                                <?php if( isset($team_2_group['themeum_club_name2']) ): ?>
                                    <img width="61" src="<?php echo themeum_logo_url_by_id($team_2_group['themeum_club_name2']); ?>" alt="<?php echo themeum_get_title_by_id($team_2_group['themeum_club_name2']); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="title">
                                <?php if( isset($team_2_group['themeum_club_name2']) ): ?>
                                    <h4><?php echo themeum_get_title_by_id($team_2_group['themeum_club_name2']); ?></h4>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                    </div>
                    <!-- Team Two Result End -->


                    <div class="col-xs-12 col-sm-3 match-team-right">
                        <div class="goal-count2 media">
                            <div class="team-img-wrap pull-right">
                                <div class="team-two-img">
                                    <img src="<?php echo esc_url(get_parent_theme_file_uri('images/football2.png')); ?>" alt="<?php echo themeum_get_title_by_id($team_2_group['themeum_club_name2']); ?>">
                                </div> 
                            </div>
                            <div class="team-two-player pull-right">
                                <ul>
                                    <?php
                                    if(is_array($goal_timing_group)){
                                        
                                        foreach ($goal_timing_group as $value){
                                            if (isset($value['themeum_select_team'])) {
                                                if($value['themeum_select_team'] == 'value2'){
                                                    if (isset($value['themeum_goal_player'])) {
                                                        $player_name = themeum_get_title_by_id($value['themeum_goal_player']);
                                                        if( $value['themeum_goal_player'] != '' ){
                                                            echo "<li>".$player_name." ".$value['themeum_time_of_goal']."'</li>";
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                        if(is_array( $goal_timing_group_extra )){
                                            if(!empty($goal_timing_group_extra)){
                                                foreach ($goal_timing_group_extra as $value) {
                                                    if(isset($value['themeum_extra_select_team'])){
                                                        if($value['themeum_extra_select_team'] == 'value2'){
                                                            $player_name = themeum_get_title_by_id($value['themeum_extra_goal_player']);
                                                            if( $value['themeum_extra_select_team'] == 'value2' ){
                                                                echo "<li>".$player_name." ".$value['themeum_extra_time_of_goal']."'</li>";
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ?>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div> <!-- blog-top-slide-wrap -->  
        </div> <!-- match-banner-result-wrap -->  
    </div> <!--container-->

    <?php
        $queried_object = get_queried_object();
        $league_id[] = $queried_object;

        if(is_array($league_id)):
            if(isset($league_id[0]->slug)): #slug
            # ********* Banner Start *************            
              $d    = date("Y-m-d h:i");
              $args = array(
                'post_type'       => 'fixture-result',
                'posts_per_page'  => 1,
                'tax_query'       => array(
                          array(
                            'taxonomy' => 'tournament',
                            'field'    => 'slug', # slug
                            'terms'    => $league_id[0]->slug,
                           )
                        ),
                'meta_query' => array(
                        array(
                            'key'       => 'themeum_datetime',
                            'value'     => $d,
                            'type'      => 'date',
                            'compare'   => '>'
                        )
                ),
                'meta_key'          => 'themeum_datetime',
                'orderby'           => 'meta_value',
                'order'             => 'ASC'
            );
              $posts = get_posts($args);

              $club1 = $club2 = $date1 = $date2 = $date3 = $venue = '';
              foreach ($posts as $post){
                  setup_postdata( $post );
                  $team1  = get_post_meta( get_the_ID(), 'team_1_group', true );
                  $team2  = get_post_meta( get_the_ID(), 'team_2_group', true );
                  $venue  = get_post_meta( get_the_ID(), 'match_venue', true );

                  $club1  = $team1['themeum_club_name1'];
                  $club2  = $team2['themeum_club_name2'];
              }
              wp_reset_postdata(); ?>

            <!-- Matadata -->
            <?php  
                $league_banner  = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
                $upcoming_match = get_post_meta( get_the_ID(), 'themeum_datetime', true );
            ?>

            <?php 
            endif;
        endif;
    ?>

    <?php
        if( isset( $wp_query->queried_object->term_id ) ){
            $args = array(
                'post_type' => 'fixture-result',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'tournament',
                        'terms' =>$wp_query->queried_object->term_id
                    ), 
                ),
                'posts_per_page' => -1,
                'post_status' => 'publish',
            );
            $posts  = get_posts($args);
            $group_list = array();
            foreach ($posts as $post){
                $group_id = get_the_terms( $post->ID, 'team_group' );
                if( is_array( $group_id ) ){
                    if( !empty($group_id) ){

                        foreach( $group_id as $value ){
                            $club1 = get_post_meta( $post->ID , 'team_1_group', true );
                            if( isset( $club1['themeum_club_name1'] ) ){
                                if( isset($group_list[ $value->slug ]) ){
                                   $group_list[ $value->slug ] = array_merge( $group_list[ $value->slug ], array($club1['themeum_club_name1']) );
                                }else{
                                    $group_list[ $value->slug ] = array( $club1['themeum_club_name1' ] );
                                }
                            }
                            $club2 = get_post_meta( $post->ID , 'team_2_group', true );
                            if( isset( $club2['themeum_club_name2'] ) ){
                                if( isset($group_list[ $value->slug ]) ){
                                    $group_list[ $value->slug ] = array_merge( $group_list[ $value->slug ], array($club2['themeum_club_name2']) );
                                 }else{
                                     $group_list[ $value->slug ] = array( $club2['themeum_club_name2' ] );
                                 }
                            }
                        }
                    }
                }
            }
        }
    ?>

    <div class="match-details">
        <div class="container">
            <div class="match-details-inner">
                <div class="match-details-tab" role="tabpanel">
                    <!-- Nav tabs -->
                    
                    <ul class="nav nav-tabs match-details-tab-nav" role="tablist">
                        <li role="presentation" class="active"><a href="#groups" aria-controls="groups" role="tab" data-toggle="tab"><?php esc_html_e('Groups','calcio');?></a></li>
                        <li role="presentation"><a href="#fixtures" aria-controls="fixtures" role="tab" data-toggle="tab"><?php esc_html_e('Fixtures','calcio');?></a></li>
                        <li role="presentation"><a href="#results" aria-controls="results" role="tab" data-toggle="tab"><?php esc_html_e('Results','calcio');?></a></li>
                        <li role="presentation"><a href="#standings" aria-controls="standings" role="tab" data-toggle="tab"><?php esc_html_e('Standings','calcio');?></a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content match-details-tab-content">

                        <!-- ****************** groups ***************** -->
                        <div role="tabpanel" class="group-fixture tab-pane fade in active" id="groups">
                            <?php 
                                if( isset( $wp_query->queried_object->term_id ) ){
                                    $args = array(
                                        'post_type' => 'fixture-result',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy'  => 'tournament',
                                                'terms'     => $wp_query->queried_object->term_id
                                            ), 
                                        ),
                                        'posts_per_page'    => -1,
                                        'post_status'       => 'publish',
                                    );
                                    $posts  = get_posts($args);
                                    $group_list = array();
                                    foreach ($posts as $post){
                                        $group_id = get_the_terms( $post->ID, 'team_group' );


                                        if( is_array( $group_id ) ){
                                            if( !empty($group_id) ){
                                                foreach( $group_id as $value ){
                                                    $club1 = get_post_meta( $post->ID , 'team_1_group', true );
                                                    if( isset( $club1['themeum_club_name1'] ) ){
                                                        if( isset($group_list[ $value->slug ]) ){
                                                           $group_list[ $value->slug ] = array_merge( $group_list[ $value->slug ], array($club1['themeum_club_name1']) );
                                                        }else{
                                                            $group_list[ $value->slug ] = array( $club1['themeum_club_name1' ] );
                                                        }
                                                    }
                                                    $club2 = get_post_meta( $post->ID , 'team_2_group', true );
                                                    if( isset( $club2['themeum_club_name2'] ) ){
                                                        if( isset($group_list[ $value->slug ]) ){
                                                            $group_list[ $value->slug ] = array_merge( $group_list[ $value->slug ], array($club2['themeum_club_name2']) );
                                                         }else{
                                                             $group_list[ $value->slug ] = array( $club2['themeum_club_name2' ] );
                                                         }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                
                                    $output = '';

                                    $output .= '<div class="group-fixture-teams-lists">'; 
                                        if( !empty( $group_list ) ){
                                            foreach( $group_list as $group_slug => $clubs  ){

                                                $output .= '<div class="group-total-wrap">';
                                                    $output .= '<div class="group-name-wrap col-md-12"><span class="group-name">'.get_term_by('slug', $group_slug , 'team_group')->name.'</span></div>'; 
                                                    foreach( $clubs as $club ){
                                                        $output .= '<div class="team-name1 col-xs-3 col-sm-3">';
                                                            $output .= '<a href="'.get_the_permalink($club).'">';
                                                            if($team_2_group['themeum_club_name2'] != ''){
                                                                $output .= '<img width="40" src="'.esc_url(themeum_logo_url_by_id($club)).'" alt="'.esc_attr(themeum_get_title_by_id($club)).'"> ';
                                                            }
                                                            if($team_2_group['themeum_club_name2'] != ''){
                                                                $output .= '<h4>'.esc_html(themeum_get_title_by_id($club)).'</h4>';
                                                            }
                                                            $output .= '</a>'; 
                                                        $output .= '</div>';
                                                    }
                                                $output .= '</div>';
                                            }
                                        }   
                                    $output .= '</div>'; # fixture-team-inner 
                                    print $output;
                                }
                            ?>
                        </div>
                        <!-- ****************** groups ***************** -->

                        <!-- ****************** Fixture **************** -->
                        <div role="tabpanel" class="tab-pane fade" id="fixtures">
                            <?php 
                            if(is_array($league_id)){

                                if(isset($league_id[0]->slug)){
                                      $args = array(
                                              'post_type'       => 'fixture-result',
                                              'posts_per_page'  => -1,
                                              'tax_query'       => array(
                                                        array(
                                                          'taxonomy' => 'tournament',
                                                          'field'    => 'slug',
                                                          'terms'    => $league_id[0]->slug,
                                                        ),
                                                        
                                                    ),
                                              'meta_key'          => 'themeum_datetime',
                                              'orderby'           => 'meta_value',
                                              'order'             => 'DESC'
                                            );
                                        $posts  = get_posts($args);
                                        $output = '';

                                        
                                        
                                        $output = '<div class="fixture-teams">';
                                          $output .= '<div class="fixture-teams-lists">';
                                              foreach ($posts as $post){
                                                setup_postdata( $post );
                                                $team_1_group    = get_post_meta( get_the_ID(),'team_1_group',true );
                                                $team_2_group    = get_post_meta( get_the_ID(),'team_2_group',true );
                                                $home_ground     = get_post_meta( get_the_ID(),'themeum_home_ground',true );
                                                $datetime         = get_post_meta( get_the_ID(),'themeum_datetime',true );
                                                $gmt              = get_post_meta( get_the_ID(),'themeum_gmt',true );

                                                $output .= '<div class="fixture-team-inner clearfix">';

                                                  $output .= '<div class="col-xs-4 col-sm-4 paddingleft">';
                                                    $output .= '<a href="'.get_the_permalink($team_1_group['themeum_club_name1']).'">';
                                                      if($team_1_group['themeum_club_name1'] != ''){
                                                          $output .= '<img width="40" class="pull-left" src="'.esc_url(themeum_logo_url_by_id($team_1_group['themeum_club_name1'])).'" alt="'.esc_attr(themeum_get_title_by_id($team_1_group['themeum_club_name1'])).'">';
                                                        }
                                                        if($team_1_group['themeum_club_name1'] != ''){
                                                          $output .= '<h4>'.esc_html(themeum_get_title_by_id($team_1_group['themeum_club_name1'])).'</h4>';
                                                        } 
                                                    $output .= '</a>';  
                                                  $output .= '</div>';

                                                  $output .= '<div class="col-xs-4 col-sm-4 status text-center"> '.date_format(date_create($datetime), 'd M Y, h:i A');
                                                    if($home_ground != '' ){
                                                      $output .= '<span>'.esc_html(themeum_get_title_by_id($home_ground)).'</span>';
                                                    }


                                                  $output .= '</div>';
                                                  $output .= '<div class="col-xs-4 col-sm-4 text-right">';
                                                  $output .= '<a href="'.get_the_permalink($team_2_group['themeum_club_name2']).'">';
                                                      if($team_2_group['themeum_club_name2'] != ''){
                                                        $output .= '<img width="40" class="pull-right" src="'.esc_url(themeum_logo_url_by_id($team_2_group['themeum_club_name2'])).'" alt="'.esc_attr(themeum_get_title_by_id($team_2_group['themeum_club_name2'])).'"> ';
                                                      }
                                                      if($team_2_group['themeum_club_name2'] != ''){
                                                        $output .= '<h4>'.esc_html(themeum_get_title_by_id($team_2_group['themeum_club_name2'])).'</h4>';
                                                      }
                                                  $output .= '</a>'; 
                                                  $output .= '</div>';
                                                $output .= '</div>';
                                            }
                                            wp_reset_postdata();


                                            $output .= '</div>';
                                        $output .= '</div>';

                                        print $output;

                                }
                            }

                            ?>
                        </div>
                        <!-- ********************************** Fixture ************************************ -->

                        <!-- ********************************** Results ************************************ -->
                        <div role="tabpanel" class="tab-pane fade in" id="results">
                            <?php
                                if(is_array($league_id)){

                                if(isset($league_id[0]->slug)){

                                  $args = array(
                                                  'post_type'     => 'fixture-result',
                                                  'posts_per_page'  => -1,
                                                  'tax_query' => array(
                                                            array(
                                                              'taxonomy' => 'tournament',
                                                              'field'    => 'slug',
                                                              'terms'    => $league_id[0]->slug,
                                                            )
                                                          ),
                                                  'meta_key'          => 'themeum_datetime',
                                                  'orderby'           => 'meta_value',
                                                  'order'             => 'DESC'
                                                );
                                $posts = get_posts($args);
                                $output = '';



                                $output .= '<div class="fixture-teams">';
                                  $output .= '<div class="fixture-teams-lists result-list">';

                                      foreach ($posts as $post){
                                            setup_postdata( $post );
                                            
                                            $match_result    = get_post_meta( get_the_ID(),'themeum_goal_count',true);

                                            $team_1    = get_post_meta( get_the_ID(),'team_1_group',true);
                                            $team_2    = get_post_meta( get_the_ID(),'team_2_group',true);

                                            
                                            if( $match_result != '' ){
                                                $output .= '<div class="row fixture-team-inner clearfix">';

                                                    $output .= '<div class="col-xs-4 col-sm-4 paddingleft">';
                                                    $output .= '<a href="'.get_the_permalink($team_1['themeum_club_name1']).'">';
                                                        $output .= '<img width="40" class="pull-left" src="'.esc_url(themeum_logo_url_by_id($team_1["themeum_club_name1"])).'" alt="'.esc_attr(themeum_get_title_by_id($team_1["themeum_club_name1"])).'"> ';
                                                        $output .= '<h4>'.esc_html(themeum_get_title_by_id($team_1["themeum_club_name1"])).'</h4>';
                                                    $output .= '</a>';
                                                    $output .= '</div>';

                                                 
                                                    $gmt = get_post_meta( get_the_ID(),'themeum_gmt',true);
                                                    $sports_date = date_format(date_create(get_post_meta( get_the_ID(),"themeum_datetime",true )), 'd M Y, h:i A');
                                                  
                                                    $output .= '<div class="col-xs-4 col-sm-4 calcio-result status text-center"> '.esc_html($match_result).' <span class="match-date">'.$sports_date.'</span></div> ';
                                                    $output .= '<div class="col-xs-4 col-sm-4 text-right">';
                                                      $output .= '<a href="'.get_the_permalink($team_2['themeum_club_name2']).'">';
                                                          $output .= '<img width="40" class="pull-right" src="'.esc_url(themeum_logo_url_by_id($team_2["themeum_club_name2"])).'" alt="'.esc_attr(themeum_get_title_by_id($team_2["themeum_club_name2"])).'">';
                                                          $output .= '<h4>'.esc_html(themeum_get_title_by_id($team_2["themeum_club_name2"])).'</h4>';
                                                      $output .= '</a>';
                                                    $output .= '</div>';
                                                $output .= '</div>';
                                            } 
                                        }
                                      wp_reset_postdata();

                                  $output .= '</div>';
                                $output .= '</div>';

                                print $output;
                              }
                            }
                            ?>
                        </div>
                        <!-- ********************************** Results ************************************ -->

                        <!-- ********************************** Standing ************************************ -->
                        <div role="tabpanel" class="tab-pane fade in" id="standings">
                            <?php
                              if(is_array($league_id)){
                                  if(isset($league_id[0]->slug)){

                                        $args = array(
                                                  'post_type'     => 'point_table',
                                                  'posts_per_page'  => -1,
                                                  'tax_query' => array(
                                                            array(
                                                              'taxonomy' => 'tournament',
                                                              'field'    => 'slug',
                                                              'terms'    => $league_id[0]->slug,
                                                            )
                                                          )
                                                );
                                        $posts = get_posts($args);
                                        $output = '';


                                        $output = '<div class="fixture-teams"><div class="point-table border-none table-responsive">';
                                        $output .= '<table class="table table-striped">';
                                        
                                        foreach ($posts as $post){
                                          setup_postdata( $post );

                                          $point_table    = get_post_meta( get_the_ID(),'point_table_group',true );
                                          usort($point_table, 'sort_by_points');

                                          $i=1;
                                          $output .= '<thead class="point-table-head"><tr><th class="text-left">No</th><th class="text-left">TEAM</th><th>P</th><th>W</th><th>D</th><th>L</th><th>GS</th><th>GA</th><th>+/-</th><th>PTS</th></tr></thead>';
                                          $output .= '<tbody>';
                                          foreach ($point_table as  $value) {
                                            if ( $value['themeum_club_name'] ) {
                                              $output .= '<tr>';
                                              $output .= '<td class="text-left">'.$i.'</td>';
                                              $output .= '<td class="text-left"><img class="point-table-image" src="'.esc_url(themeum_logo_url_by_id($value['themeum_club_name'])).'" alt="'.get_the_title($value['themeum_club_name']).'"><span>'.get_the_title($value['themeum_club_name']).'</span></td>';
                                              $output .= '<td>'.$value['themeum_games_played'].'</td>';
                                              $output .= '<td>'.$value['themeum_games_won'].'</td>';
                                              $output .= '<td>'.$value['themeum_games_drown'].'</td>';
                                              $output .= '<td>'.$value['themeum_games_lost'].'</td>';
                                              $output .= '<td>'.$value['themeum_goals_scored'].'</td>';
                                              $output .= '<td>'.$value['themeum_goals_against'].'</td>';
                                              $output .= '<td>'.$value['themeum_goals_difference'].'</td>';
                                              $output .= '<td>'.$value['themeum_points'].'</td>';
                                              $output .= '</tr>';

                                            $i++; 
                                            }
                                          }
                                          $output .= '</tbody>';
                                        }
                                        wp_reset_postdata();
                                        $output .= '</table>';
                                        $output .= '</div></div>';

                                        print $output;
                                  }
                              }
                            ?>
                        </div>
                        <!-- ********************************** Standing ************************************ -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> <!--/#main-->
<?php get_footer();


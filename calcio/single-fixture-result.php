<?php get_header(); ?>

<?php 
$blogtime = current_time( 'mysql' ); 
$match_date = get_post_meta(get_the_ID(),'themeum_datetime',true); 

$datetime1  = new DateTime($blogtime);
$datetime2  = new DateTime($match_date);
$interval   = $datetime1->diff($datetime2);

if($interval->invert == '0'){ ?>
    <div class="club-profile">
        <div class="container match-result-wrapper" style="margin-top: 30px">
            <div class="row">
                <?php get_template_part('lib/sub-header'); 
                $image_banner  = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));  ?>
                <div class="col-sm-12 club-profile-wrap">
                    <div class="themeum-match-banner league-banner" style="background-image:url(<?php print $image_banner; ?>); background-size: cover; background-position: 50% 50%;padding:40px 0 50px">
                        <!-- Next Match Title -->
                        <div class="next-match-title text-center">
                            <?php if(count($posts) >= 1): ?>
                                <span class="league-title"><?php esc_html_e('Next Match','calcio'); ?></span>
                            <?php else: ?>
                                <span class="league-title"><?php single_term_title(); ?></span>
                            <?php endif; ?>
                        </div>
                        <!-- End Title -->
                        <?php $match_date = get_post_meta(get_the_ID(),'themeum_datetime',true); ?>

                        <!-- Upcoming Match Countdown -->
                        <div class="match-counter-class text-center" data-date="'<?php echo esc_attr($match_date);?>">
                          <div id="upcoming-match-countdown">
                              <div class="countdown-section">
                                  <span class="first-item counter-days"></span> 
                                  <span class="countdown-text"><?php esc_html_e('Days', 'calcio') ?></span>
                              </div> <!-- Day End -->
                              <div class="countdown-section">
                                  <span class="counter-hours"></span> 
                                  <span class="countdown-text"><?php esc_html_e('Hours', 'calcio') ?></span>
                              </div> <!-- Hour End -->
                              <div class="countdown-section">
                                  <span class="counter-minutes"></span> 
                                  <span class="countdown-text"><?php esc_html_e('Minutes', 'calcio') ?></span>
                              </div> <!-- Minutes End -->
                              <div class="countdown-section">
                                  <span class="counter-seconds"></span> 
                                  <span class="countdown-text"><?php esc_html_e('Seconds', 'calcio') ?></span>
                              </div> <!-- Second End -->
                          </div>
                        </div>
                        <!-- End match Countdown -->
                    </div>
                </div>

                <?php if ( have_posts() ) : the_post(); ?>
                    <?php 
                        # Club Name
                        $team_1_group    = get_post_meta(get_the_ID(),'team_1_group',true);
                        $team_2_group    = get_post_meta(get_the_ID(),'team_2_group',true);
                        $match_result_group    = get_post_meta(get_the_ID(),'match_result_group',true);
                        $venue  = get_post_meta( get_the_ID(), 'match_venue', true );
                    ?>
                    <div class="club-name-list">
                        <div class="club-one-wrap col-xs-12 col-sm-5 col-md-5">
                            <div class="matech-team pull-right">
                                <div class="team-one">
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
                        <?php if(count($posts) >= 1): ?>
                            <div class="col-xs-12 col-sm-2 col-md-2 score match-time">
                                <p class="time"><?php echo date_i18n("d M Y h:i A", strtotime($match_date)); ?></p>
                                <p class="venue"><?php print $venue; ?></p>
                            </div>
                        <?php endif; ?>
                        <!-- Team Two Result -->
                        <div class="club-one-wrap col-xs-12 col-sm-5 col-md-5">
                            <div class="matech-team pull-left">
                                <div class="icon-right">
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
                    </div> <!--match-banner-->

                    <div class="match-details">
                        <div class="container">
                            <div class="row"> 
                                <div class="match-details-inner">      
                                    <?php 
                                    $queried_object = get_queried_object();
                                    $league_id[] = $queried_object;
                                    $tournament_name =get_terms('tournament'); ?>

                                    <div class="fixture-teams-list">
                                        <?php foreach ($tournament_name as $value) {
                                            $args = array(
                                                'post_type'       => 'fixture-result',
                                                'order'           => 'DESC',
                                                'posts_per_page'  => '5',
                                                'tax_query'       => array(
                                                    array(
                                                        'taxonomy' => 'tournament',
                                                        'terms'    =>$value->term_id
                                                    ),     
                                                ),
                                            );

                                            $posts  = get_posts($args);

                                            foreach ($posts as $post){
                                                setup_postdata( $post );

                                                $team_1_group     = get_post_meta( get_the_ID(),'team_1_group',true );
                                                $team_2_group     = get_post_meta( get_the_ID(),'team_2_group',true );
                                                $home_ground      = get_post_meta( get_the_ID(),'themeum_home_ground',true );
                                                $datetime         = get_post_meta( get_the_ID(),'themeum_datetime',true );
                                                $gmt              = get_post_meta( get_the_ID(),'themeum_gmt',true ); ?>

                                                <div class="fixture-team-inner clearfix">
                                                    <div class="col-xs-4 col-sm-4 team-one padding-wrap">
                                                        <a href="<?php echo get_the_permalink($team_1_group['themeum_club_name1']); ?>">
                                                          <?php if($team_1_group['themeum_club_name1'] != ''){ ?>
                                                              <img width="40" class="pull-left" src="<?php echo esc_url(themeum_logo_url_by_id($team_1_group['themeum_club_name1'])); ?>" alt="<?php echo esc_attr(themeum_get_title_by_id($team_1_group['themeum_club_name1'])); ?>">
                                                            <?php } 
                                                            if($team_1_group['themeum_club_name1'] != ''){ ?>
                                                              <h4 class="team-name"><?php echo esc_attr(themeum_get_title_by_id($team_1_group['themeum_club_name1'])); ?></h4>
                                                            <?php } ?>
                                                        </a>  
                                                    </div>

                                                    <div class="col-xs-4 col-sm-4 status text-center">
                                                        <?php if ($datetime) { ?>
                                                              <span><?php echo date_i18n("d M, Y, h:i a", strtotime($datetime)); ?></span>
                                                        <?php } ?>

                                                        <?php if($home_ground != '' ){ ?>
                                                              <span><?php echo esc_attr(themeum_get_title_by_id($home_ground)); ?></span>
                                                        <?php } ?>
                                                    </div>

                                                    <div class="col-xs-4 col-sm-4 team-two text-right padding-wrap">
                                                        <a href="<?php echo get_the_permalink($team_2_group['themeum_club_name2']); ?>">
                                                            <?php if($team_2_group['themeum_club_name2'] != ''){ ?>
                                                            <img width="40" class="pull-right" src="<?php echo esc_url(themeum_logo_url_by_id($team_2_group['themeum_club_name2'])); ?>" alt="<?php echo esc_attr(themeum_get_title_by_id($team_2_group['themeum_club_name2'])); ?>"> 
                                                            <?php }
                                                            if($team_2_group['themeum_club_name2'] != ''){ ?>
                                                                <h4 class="team-name"><?php echo esc_attr(themeum_get_title_by_id($team_2_group['themeum_club_name2'])); ?></h4>
                                                            <?php } ?>
                                                        </a> 
                                                    </div>
                                                </div>
                                                <?php 
                                            } } ?>
                                            <?php wp_reset_postdata(); 
                                        ?>   
                                    </div>    
                                </div>    
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php } else { ?>
    <?php if ( have_posts() ) : the_post(); ?>
        <?php
            function themeum_league_cat_list( $id, $cat ){
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
            $team_1_group    = get_post_meta(get_the_ID(),'team_1_group',true);
            $team_2_group    = get_post_meta(get_the_ID(),'team_2_group',true);
            $match_result_group    = get_post_meta(get_the_ID(),'match_result_group',true);

            # Goal and Timing 
            $goal_timing_group          = get_post_meta(get_the_ID(),'goal_timing_group',true);
            $goal_timing_group_extra    = get_post_meta(get_the_ID(),'goal_extra_timing',true);

            # Match timeline
            $match_timeline    = get_post_meta(get_the_ID(),'match_timeline',true);

            # Match Substitutes
            $substitutes    = get_post_meta(get_the_ID(),'match_substitutes',true);
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
                        <div class="match-banner-result-wrap" style="background-image:url(<?php echo get_parent_theme_file_uri( 'images/match-banner.jpg' );?>);background-size: cover;background-position: 50% 50%;padding:40px 0 40px">
                        <?php } ?>
                            <div class="match-league-title text-center">
                                <p><?php echo themeum_league_cat_list( get_the_ID(), 'tournament' ); ?> - <?php echo date_i18n("d M Y", strtotime($sports_date)); ?></p>
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
                                        <img src="<?php echo esc_url(get_parent_theme_file_uri('images/football-icon.png')); ?>" alt="<?php echo themeum_get_title_by_id($team_1_group['themeum_club_name1']); ?>">
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
                                    <div class="team-img-one">
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

            <div class="match-details">
                <div class="container">
                    <div class="match-details-inner">
                        <div class="match-details-tab" role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs match-details-tab-nav" role="tablist">
                                <li role="presentation" class="active"><a href="#match-stats" aria-controls="match-stats" role="tab" data-toggle="tab"><?php esc_html_e('Match Stats','calcio');?></a></li>
                                <li role="presentation"><a href="#timeline" aria-controls="timeline" role="tab" data-toggle="tab"><?php esc_html_e('Timeline','calcio');?></a></li>
                                <li role="presentation"><a href="#team" aria-controls="team" role="tab" data-toggle="tab"><?php esc_html_e('Team','calcio');?></a></li>
                                <li role="presentation"><a href="#substitutes" aria-controls="substitutes" role="tab" data-toggle="tab"><?php esc_html_e('Substitutes','calcio');?></a></li>
                                <li role="presentation"><a href="#match_comments" aria-controls="match_comments" role="tab" data-toggle="tab"><?php esc_html_e('Comments','calcio');?></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="container tab-content match-details-tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="match-stats">
                                    <div class="match-status">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-5">
                                                <div class="match-details-team media">
                                                    <div class="pull-left">
                                                    <?php if( isset($team_1_group['themeum_club_name1']) ): ?>
                                                        <?php if( $team_1_group['themeum_club_name1'] != '' ): ?>
                                                            <img width="61" src="<?php echo themeum_logo_url_by_id($team_1_group['themeum_club_name1']); ?>" alt="<?php echo themeum_get_title_by_id($team_1_group['themeum_club_name1']); ?>">
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    </div>
                                                    <div class="media-body">
                                                    <?php if( isset($team_1_group['themeum_club_name1']) ): ?>
                                                        <?php if( $team_1_group['themeum_club_name1'] != '' ): ?>
                                                            <h4><?php echo themeum_get_title_by_id($team_1_group['themeum_club_name1']); ?></h4>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                        <span>
                                                        <?php if( isset($team_1_group['themeum_formation1']) ): ?>
                                                            <?php if( $team_1_group['themeum_formation1'] != '' ): ?>
                                                                <?php print $team_1_group['themeum_formation1']; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-2 vs">
                                                <span> VS </span>
                                            </div>

                                            <div class="col-xs-12 col-sm-5">
                                                <div class="match-details-team media text-right">
                                                    <div class="pull-right">
                                                    <?php if( isset($team_2_group['themeum_club_name2']) ): ?>
                                                        <?php if( $team_2_group['themeum_club_name2'] != '' ): ?>
                                                            <img width="61" src="<?php echo themeum_logo_url_by_id($team_2_group['themeum_club_name2']); ?>" alt="<?php echo themeum_get_title_by_id($team_2_group['themeum_club_name2']); ?>">
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    </div>
                                                    <div class="media-body">
                                                    <?php if( isset($team_2_group['themeum_club_name2']) ): ?>
                                                        <?php if( $team_2_group['themeum_club_name2'] != '' ): ?>
                                                            <h4><?php echo themeum_get_title_by_id($team_2_group['themeum_club_name2']); ?></h4>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                        <span>
                                                        <?php if( isset($team_2_group['themeum_formation2']) ): ?>
                                                            <?php if( $team_2_group['themeum_formation2'] != '' ): ?>
                                                                <?php print $team_2_group['themeum_formation2']; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  <!--row-->     

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="match-status-info clearfix">
                                                    
                                                    <div class="match-status-list clearfix">
                                                        <ul>
                                                            <?php 
                                                            if(is_array($match_result_group)){
                                                                foreach ($match_result_group as $value) {
                                                                    if(isset($value['themeum_team1_data'])){
                                                                        $thmselect = '';
                                                                        if (isset($value['themeum_select'])) {
                                                                            $thmselect = $value['themeum_select'];
                                                                        }
                                                                    echo '<li class="clearfix text-center"><span class="count pull-left">'.$value['themeum_team1_data'].'</span><span class="status">'.$thmselect.'</span> <span class="count pull-right">'.$value['themeum_team2_data'].'</span></li>';
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div> <!--match-status-info-->  
                                            </div> <!--col-xs-12-->   
                                        </div> <!--row-->

                                    </div>  <!--match-status-->                       
                                </div> <!--match-status-->   


                                <div role="tabpanel" class="tab-pane fade" id="timeline">
                                    <div class="match-timeline">
                                        <?php 
                                        if(is_array($match_timeline)){
                                            foreach ($match_timeline as $value){
                                                if(isset($value['themeum_timeline_time'])){
                                                    if(isset($value['themeum_player'])){
                                                        $player_name = '';
                                                        if($value['themeum_player'] != ''){ 
                                                            $player_name = themeum_get_title_by_id($value['themeum_player']); 
                                                        }
                                                    }
                                                    echo '<div class="row">';
                                                        echo '<div class="match-timeline-inner clearfix">';
                                                            echo '<div class="col-xs-3 col-sm-2 time">'.$value['themeum_timeline_time'].'<sub>'.__('min','calcio').'</sub></div>';
                                                            if(isset($value['themeum_select'])){
                                                                echo '<div class="col-xs-6 col-sm-9 status">'.$value['themeum_select'].' <span>'.$player_name.'</span></div>';
                                                            }
                                                            echo '<div class="col-xs-3 col-sm-1 match-status-icon '.themeum_class_name($value["themeum_select"]).'"></div>';
                                                        echo '</div>';
                                                    echo '</div>';
                                                }
                                            }
                                        }
                                        ?>                                                               
                                    </div>
                                </div> <!--timeline-->   


                                <div role="tabpanel" class="tab-pane fade" id="team">
                                    <div class="match-team">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="match-details-team media">
                                                    <div class="pull-left">
                                                        <?php if( $team_1_group['themeum_club_name1'] != '' ): ?>
                                                            <img width="61" src="<?php echo themeum_logo_url_by_id($team_1_group['themeum_club_name1']); ?>" alt="<?php echo themeum_get_title_by_id($team_1_group['themeum_club_name1']); ?>">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="media-body">
                                                        <?php if( $team_1_group['themeum_club_name1'] != '' ): ?>
                                                            <h4><?php echo themeum_get_title_by_id($team_1_group['themeum_club_name1']); ?></h4>
                                                        <?php endif; ?>
                                                        <span>
                                                            <?php if( $team_1_group['themeum_formation1'] != '' ): ?>
                                                                <?php print $team_1_group['themeum_formation1']; ?>
                                                            <?php endif; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                                <div class="match-details-team media text-right">
                                                    <div class="pull-right">
                                                        <?php if( $team_2_group['themeum_club_name2'] != '' ): ?>
                                                            <img width="61" src="<?php echo themeum_logo_url_by_id($team_2_group['themeum_club_name2']); ?>" alt="<?php echo themeum_get_title_by_id($team_2_group['themeum_club_name2']); ?>">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="media-body">
                                                        <?php if( $team_2_group['themeum_club_name2'] != '' ): ?>
                                                            <h4><?php echo themeum_get_title_by_id($team_2_group['themeum_club_name2']); ?></h4>
                                                        <?php endif; ?>
                                                        <span>
                                                            <?php if( $team_2_group['themeum_formation2'] != '' ): ?>
                                                                <?php print $team_2_group['themeum_formation2']; ?>
                                                            <?php endif; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!--row-->      

                                        <div class="match-teams clearfix">
                                            
                                        <?php  
                                        $total_count = 0;
                                        $playlist1 = $playlist2 = $team1data = $team2data = array();

                                        if(isset($team_1_group['themeum_player_list1'])){
                                            $playlist1      = $team_1_group['themeum_player_list1'];
                                            $team1data      = themeum_player_info($playlist1);
                                            $total_count    = count($playlist1);
                                        }

                                        if(isset($team_2_group['themeum_player_list2'])){
                                            $playlist2 = $team_2_group['themeum_player_list2'];
                                            $team2data = themeum_player_info($playlist2);
                                            if( count($playlist2)> $total_count ){
                                                $total_count = count($playlist2);
                                            }
                                        }
                                        
                                        for ($i=0; $i<$total_count; $i++){ 
                                            echo '<div class="row match-team-inner">';
                                                echo '<div class="col-xs-12 col-sm-6">';
                                                    echo '<div class="team-overlay clearfix">';
                                                        if(isset($team1data[$i]['image'])){  
                                                            if( $team1data[$i]['image'] != '' ){
                                                                echo '<img width="40" class="left" src="'.$team1data[$i]['image'].'" alt="'.__('image','calcio').'">';
                                                            }else{
                                                                echo '<img class="left" src="'.get_parent_theme_file_uri('images/football2.png').'" alt="'.__('image','calcio').'">';
                                                            }
                                                        }
                                                        if(isset($team1data[$i]['name'])){ 
                                                            echo '<h4>';
                                                                print $team1data[$i]['name']; 
                                                            echo '</h4>';
                                                        }

                                                        if(isset($team1data[$i])){
                                                            echo '<div class="player-overlay">';
                                                               echo '<div class="team-overlay-inner">';
                                                                    echo '<div class="player-image-wrap">';
                                                                        if(isset($team1data[$i]['fullimage'])){ 
                                                                            if( $team1data[$i]['fullimage'] != '' ){
                                                                                echo '<img src="'.$team1data[$i]['fullimage'].'" alt="'.__('image','calcio').'">';
                                                                            }else{
                                                                                echo '<img class="left" src="'.get_parent_theme_file_uri( 'images/football2.png' ).'" alt="'.__('image','calcio').'">';
                                                                            }
                                                                        }else{
                                                                            echo '<img class="left" src="'.get_parent_theme_file_uri( 'images/football2.png' ).'" alt="'.__('image','calcio').'">';
                                                                        }
                                                                    echo '</div>    ';
                                                                    echo '<div class="player-name-inner">';
                                                                        echo '<h4>';
                                                                            if(isset($team1data[$i]['name'])){ print $team1data[$i]['name']; }
                                                                        echo '</h4>';
                                                                       echo '<span>';
                                                                            if(isset($team1data[$i]['position'])){ print $team1data[$i]['position']; }
                                                                       echo '</span>';
                                                                        if(isset($team1data[$i]['url'])){ echo '<div class="more"><a href="'.$team1data[$i]["url"].'"><i class="fa fa-long-arrow-right"></i></a></div>'; }
                                                                        else{ echo '<div class="more"><a href="#"><i class="fa fa-long-arrow-right"></i></a></div>'; }
                                                                       
                                                                    echo '</div>';
                                                                    echo '<ul>';
                                                                            if(isset($team1data[$i]['other'])){
                                                                                if(is_array($team1data[$i]['other'])){
                                                                                    foreach ( $team1data[$i]['other'] as $value) {
                                                                                        echo '<li><span class="payer-info">'.$value["themeum_information_level"].':</span><span>'.$value["themeum_information_data"].'</span></li>';
                                                                                    }
                                                                                }
                                                                            }
                                                                   echo '</ul>';
                                                               echo '</div>';
                                                           echo '</div>';
                                                        }

                                                    echo '</div>';
                                                echo '</div>';



                                                echo '<div class="col-xs-12 col-sm-6 text-right">';
                                                    echo '<div class="team-overlay clearfix">';
                                                        echo '<h4>';
                                                            if(isset($team2data[$i]['name'])){ print $team2data[$i]['name']; }
                                                        echo '</h4>';
                                                        if(isset($team2data[$i]['image'])){ 
                                                            if( $team2data[$i]['image'] != '' ){
                                                                echo '<img width="40" class="right" src="'.$team2data[$i]['image'].'" alt="'.__('image','calcio').'">';
                                                            }else{
                                                                echo '<img class="right" src="'.get_parent_theme_file_uri( 'images/football2.png' ).'" alt="'.__('image','calcio').'">';
                                                            }
                                                        }
                                                       echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        }
                                        ?>
                                                                       
                                        </div>
                                    </div>
                                </div> <!--match team--> 

                                <div role="tabpanel" class="tab-pane fade" id="substitutes">
                                    <div class="match-team-substitues">
                                        

                                        <?php 
                                            foreach ($substitutes as $value) {
                                                echo '<div class="match-substitues-inner clearfix">';
                                                    echo '<div class="row">';
                                                    if (isset($value['themeum_timeline_time'])) {
                                                        echo '<div class="col-xs-2 col-sm-2 time">'.$value["themeum_timeline_time"].' <sub>min</sub></div>';
                                                    }
                                                        echo '<div class="col-xs-8 col-sm-8 subs-players">';
                                                            echo '<h4 class="subs-payer-out">'.themeum_get_title_by_id($value["themeum_player_in"]).' in<i class="fa fa-mail-forward"></i></h4>';
                                                            echo '<h4 class="subs-payer-in">'.themeum_get_title_by_id($value["themeum_player_out"]).' out<i class="fa fa-mail-reply"></i></h4>';
                                                        echo '</div>';
                                                        echo '<div class="col-xs-2 col-sm-2 text-right">';
                                                        if (isset($value['themeum_select_team'])) {
                                                            if($value["themeum_select_team"]=="value1"){
                                                                echo '<img width="61" src="'.themeum_logo_url_by_id($team_1_group['themeum_club_name1']).'" alt="'.__('image','calcio').'">';
                                                            }else{
                                                                echo '<img width="61" src="'.themeum_logo_url_by_id($team_2_group['themeum_club_name2']).'" alt="'.__('image','calcio').'">';
                                                            }
                                                        }
                                                        echo '</div>';
                                                    echo '</div>';
                                                echo '</div>';
                                            }
                                        ?>

                                    </div>
                                </div> <!--match-team-substitues-->

                                <div role="tabpanel" class="tab-pane fade" id="match_comments">
                                
                                    <div class="match-comments">
                                        <div class="row">
                                            <div class="col-xs-12 match-comment-inner">
        
                                            <?php
                                            if ( comments_open() || get_comments_number() ) {
                                                comments_template();
                                                }
                                            ?>     
                                             </div>                                     

                                        </div>                           
                                    </div>

                                </div> <!--match-comments-->
                            </div>
                        </div>
                    </div> <!--match-details-inner-->
                </div> <!--container-->
            </div> <!--match-details-->
        </section> <!--/#main-->
    <?php endif; ?>
<?php } ?>

<?php get_footer();
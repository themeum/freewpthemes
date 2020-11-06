<?php
/**
 * Display Single Player
 *
 * @author      Themeum
 * @category    Template
 * @package     Calcio
 * @version   1.0
 *-------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) )
    exit; # Exit if accessed directly

get_header();
?>

<?php if ( have_posts() ) : the_post(); ?>
    <?php
      $full_name        = get_post_meta($post->ID,'themeum_full_name', true);
      $position         = get_post_meta($post->ID,'themeum_position', true);
      $match_played     = get_post_meta($post->ID,'themeum_match_played', true);

      $player_intro_text    = get_post_meta($post->ID,'player_intro_text', true);
      $player_awrad_list    = get_post_meta($post->ID,'player_awrad_list', true);
      $personal_info        = get_post_meta($post->ID,'personal_info_group',true);
      $personal_statistics  = get_post_meta($post->ID,'personal_statistics_group',true);
      $playerimg            = get_post_meta($post->ID,'themeum_player_image', true);
      $src_playerimg        = wp_get_attachment_image_src($playerimg, 'full');

      # social share
      $facebook     = get_post_meta($post->ID,'themeum_facebook', true);
      $twitter      = get_post_meta($post->ID,'themeum_twitter', true);
      $googleplus   = get_post_meta($post->ID,'themeum_google_plus', true);
      $instagram    = get_post_meta($post->ID,'themeum_instagram', true);
      $youtube      = get_post_meta($post->ID,'themeum_youtube', true);
      $vimeo        = get_post_meta($post->ID,'themeum_vimeo', true);

      $img          = get_post_meta($post->ID,'themeum_club_logo', true);
      $src_image    = wp_get_attachment_image_src($img, 'full');

    ?>



<div class="club-profile"> 
  <div class="container match-result-wrapper" style="margin-top: 30px">      
      <?php get_template_part('lib/sub-header'); ?>   
      <div class="row"> 
          <div class="col-sm-12 club-profile-wrap">    
              
              <?php 
                  $banner_src_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
                  if ( has_post_thumbnail() && ! post_password_required() ) { ?>
                  <div class="player-profile-banner" style="background-image:url(<?php echo esc_url($banner_src_image[0]);?>);background-size: cover;background-position: 50% 50%;padding:150px 0 90px"> 
                  </div><!--player-profile-banner-->
                  <?php } else { ?>
                    <div class="player-profile-banner" style="background-color:#444;padding:150px 0 90px">
                      <div class="container">
                          <h2 class="player-profile-title"><?php the_title(); ?></h2>
                      </div> <!--container-->   
                  </div><!--player-profile-banner-->
              <?php } ?>

              <div class="row club-section-wrap">
                  <div class="col-sm-3"> 
                      <div class="club-profile-leftside"> 
                        <div class="player-img">
                            <?php if(isset($src_playerimg) && !empty($src_playerimg)){ ?>
                                <img class="img-responsive" src="<?php echo esc_url($src_playerimg[0]); ?>" alt="<?php the_title();?>">
                            <?php }?>
                        </div>
                        <?php if ($full_name) {?><h3 class="player-name"><?php echo esc_html($full_name); ?></h3><?php } ?>
                            <?php if ($position){?><span><?php echo esc_html($position); ?></span><?php } ?>

                        <?php 
                        if ( $facebook || $twitter || $googleplus || $instagram || $youtube || $vimeo ) { ?>
                          <div class="player-share">
                              <ul>
                                <?php if ($facebook) { ?>
                                  <li><a class="facebook" href="<?php echo esc_url($facebook);?>"><i class="fa fa-facebook"></i></a></li>
                                 <?php  } ?>
                                  <?php if ($twitter) { ?>
                                  <li><a class="twitter" href="<?php echo esc_url($twitter);?>"><i class="fa fa-twitter"></i></a></li>
                                  <?php  } ?>
                                  <?php if ($googleplus) { ?>
                                  <li><a class="google-plus" href="<?php echo esc_url($googleplus);?>"><i class="fa fa-google-plus"></i></a></li>
                                  <?php  } ?>
                                  <?php if ($instagram) { ?>
                                  <li><a class="instagram" href="<?php echo esc_url($instagram);?>"><i class="fa fa-instagram"></i></a></li>
                                  <?php  } ?>
                                  <?php if ($youtube) { ?>
                                  <li><a class="youtube" href="<?php echo esc_url($youtube);?>"><i class="fa fa-youtube"></i></a></li>
                                  <?php  } ?>
                                  <?php if ($vimeo) { ?>
                                  <li><a class="vimeo" href="<?php echo esc_url($vimeo);?>"><i class="fa fa-vimeo-square"></i></a></li>
                                  <?php  } ?>
                              </ul>
                          </div>
                        <?php } ?>
                      </div> <!--player-profile-leftside-->
                  </div> <!--col-sm-4-->

                  <div class="col-sm-9">
                      <div class="club-info">
                          <ul class="info-list">
                          <?php 
                              if ( is_array($personal_info) && !empty($personal_info) ) {
                                foreach ($personal_info as $value) {
                                  if ( $value['themeum_information_level'] ) { ?>
                                  <li>
                                    <span><?php echo esc_html($value['themeum_information_level']); ?></span>
                                    <span class="level"><?php echo esc_html($value['themeum_information_data']); ?></span>
                                  </li>
                                <?php }
                              }
                          } ?>
                          </ul>
                          <p class="intro-text"><?php print $player_intro_text ?></p>
                      </div>
                  </div> <!-- col-sm-9 -->
              </div> <!-- club-section-wrap -->
          </div> <!-- col-sm-12 -->
      </div> <!-- row -->
  </div> <!-- container -->
</div> <!--player-profile-->


<!-- Player Information -->
<div class="club-profile">      
<div class="container match-result-wrapper" style="margin-top: 30px">      
<div class="row">
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="col-sm-12">
        <div class="club-profile-total-wrap">
              <div class="club-details-tab" role="tabpanel">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs club-details-tab-nav" role="tablist">
                      <li role="presentation" class="active">
                          <a href="#player_overview" aria-controls="player_overview" role="tab" data-toggle="tab"><?php esc_html_e('Overview','calcio');?></a>
                      </li>
                      <li role="presentation"><a href="#career" aria-controls="career" role="tab" data-toggle="tab"><?php esc_html_e('Career','calcio');?></a></li>
                      <li role="presentation"><a href="#award" aria-controls="award" role="tab" data-toggle="tab"><?php esc_html_e('Award','calcio');?></a></li>
                      <li role="presentation"><a href="#photos" aria-controls="photos" role="tab" data-toggle="tab"><?php esc_html_e('Photos','calcio');?></a></li>
                  </ul>
                  <!-- End Tab Section -->

                  <!-- Tab panes -->
                  <div class="tab-content club-details-tab-content">
                      <div role="tabpanel" class="tab-pane fade in active" id="player_overview">
                          <div class="club-content">
                              <?php the_content(); ?>
                          </div>
                      </div>
                      <div role="tabpanel" class="tab-pane fade" id="career">
                          <div class="player-career">
                            <?php  
                              if ( is_array($personal_statistics) && !empty($personal_statistics) ) { ?>
                              <ul>
                                  <?php 
                                  foreach ($personal_statistics as $key => $value) {
                                  if ( $personal_statistics[$key]['themeum_statistics_level'] && $personal_statistics[$key]['themeum_statistics_data'] ) { ?>
                                      <li>
                                        <span class="level"><?php echo esc_html($personal_statistics[$key]['themeum_statistics_level']); ?></span>
                                        <span class="level pull-right"><?php echo esc_html($personal_statistics[$key]['themeum_statistics_data']); ?></span>
                                      </li>
                                  <?php }
                                  } ?>
                              </ul> 
                            <?php } ?>
                          </div><!-- player-squed --> 
                      </div> <!-- career -->

                      <!-- Award List -->
                      <div role="tabpanel" class="tab-pane fade" id="award">
                          <div class="player-award">
                              <?php  
                                  if ( is_array($player_awrad_list) && !empty($player_awrad_list) ) { ?>
                                    <ul>
                                        <?php 
                                        foreach ($player_awrad_list as $key => $value) {
                                        if ( $player_awrad_list[$key]['award_title'] && $player_awrad_list[$key]['award_name'] ) { ?>
                                            <li>
                                                <span class="award-img pull-left">
                                                    <?php  if( isset($player_awrad_list[$key]["award_logo"]) && !empty($player_awrad_list[$key]["award_logo"]) ){ ?>
                                                        
                                                        <?php $image = $player_awrad_list[$key]["award_logo"];
                                                          $img   = wp_get_attachment_image_src($image[0], 'calcio-small');
                                                        ?>
                                                        <img class="img-responsive" src="<?php echo esc_url($img[0]);?>" alt="<?php esc_attr_e('photo', 'calcio');?>">
                                                    
                                                    <?php } ?>
                                                </span>

                                                <h2 class="award-title"><?php echo esc_html($player_awrad_list[$key]['award_title']); ?></h2>
                                                <span class="level2"><?php echo esc_html($player_awrad_list[$key]['award_name']).', '; ?></span>
                                                <span class="level2"><?php echo esc_html($player_awrad_list[$key]['award_date']); ?></span>
                                            </li>
                                        <?php }
                                        } ?>
                                  </ul> 
                              <?php } ?>
                          </div>
                      </div>
                      <!-- End Awrad -->


                      <!-- Players Photo Gallery -->
                      <div role="tabpanel" class="tab-pane fade" id="photos">
                          <div class="club-phots">
                            <?php
                                $player_img    = get_post_meta( get_the_ID(), 'player_photo_gallery');

                                $count = count($player_img); 
                                $i=0;
                                foreach($player_img as $value) {
                                if($i%3==0){
                                    echo '<div class="row">';
                                } ?>
                                <!-- Players Image Gallery Popup -->
                                <div class="col-sm-4">
                                      <a class="club-gallery" href="<?php echo themeum_attachment_url_full($value,'full'); ?>">
                                        <img class="img-responsive" src="<?php echo themeum_attachment_url_full($value,'heighlights'); ?>" alt="<?php esc_attr_e('Image','calcio'); ?>">
                                      </a>
                                </div> <!--col-sm-4-->  
                                <?php
                                    $i++;
                                    if( $i%3==0 || $count == $i ){
                                        echo '</div>'; 
                                    }
                                }
                            ?> 
                          </div>
                      </div> <!--photos--> 

                  </div> <!-- tab-content -->
              </div> <!-- club-details-tab -->
               
        </div> <!--player-profile-rightside-->
    </div><!-- col-sm-12 -->

</div>  <!-- #post -->
</div>  <!-- row -->
</div>  <!-- container -->
</div>  <!-- club-profile -->







































<?php endif; ?>

<?php get_footer();


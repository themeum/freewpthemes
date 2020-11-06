<?php get_header();
global $post;
$author_id=$post->post_author;

?>

<section id="property-main" class="property-single-page">
    <?php
    while( have_posts() ): the_post();
    $price_symbol              = get_post_meta($post->ID, 'wpestate_price_symbol', true);
    $property_price            = get_post_meta($post->ID, 'wpestate_property_price', true);
    $property_status           = get_all_property_taxonomy();
    $view_all_link             = get_theme_mod( 'view_all_link', '' );

    //Property Location
    $property_street_view      = get_post_meta($post->ID, 'wpestate_property_virtual_view', true);
    $property_lati             = get_post_meta($post->ID, 'wpestate_property_lati', true);
    $property_long             = get_post_meta($post->ID, 'wpestate_property_long', true);
    $property_address          = get_post_meta($post->ID, 'wpestate_property_address', true);

    //Property Media
    $property_floor_plan       = esc_attr(get_post_meta( $post->ID , 'wpestate_property_floor_plan', true ));
    $property_slide_img        = get_post_meta($post->ID,'wpestate_property_slide_img');
    $floor_plan                = wp_get_attachment_image_src( $property_floor_plan , 'blog-full'); 
    $property_pdf_link         = rwmb_meta('wpestate_property_pdf_link');
    $pdf_file                  = reset( $property_pdf_link );
    $property_video_url        = esc_url( get_post_meta( $post->ID, 'wpestate_feature_video', 1 ) );
    $layout                    = get_theme_mod('property_single_layout', 'layout_one');

    $post_thumb_id = get_post_thumbnail_id();
		array_push($property_slide_img, $post_thumb_id);

    ?>

    <div class="property-single-slide-top">
      <?php 
          if (is_array($property_slide_img)) {
              if(!empty($property_slide_img)) {
                  $limitw  = 20;
                  $photo_slices = (count($property_slide_img) > $limitw) ? array_slice($property_slide_img, 0, $limitw , true ) : $property_slide_img;
                  foreach ($photo_slices as $key=>$photos) {
                      $gallery_photo  = wp_get_attachment_image_src( $photos, 'wpestate-large' ); ?>

                      <div class="photo-gallery-items">
                          <div class="gallery-items-img">
                              <img src="<?php echo esc_url($gallery_photo[0]); ?>" class="img-responsive" alt="<?php esc_html_e('gallery_photo : ','wpestate');?>" />
                          </div> <!--/.gallery-items-img-->
                      </div> 
                  <?php }
              } 
          } 
      ?>
    </div>
      <!-- Property Nav Slider -->
    <div class="container mb-md-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="property-slider-nav">
            <?php 
                if (is_array($property_slide_img)) {
                    if(!empty($property_slide_img)) {
                        $limitw  = 20;
                        $photo_slices = (count($property_slide_img) > $limitw) ? array_slice($property_slide_img, 0, $limitw , true ) : $property_slide_img;
                        foreach ($photo_slices as $key=>$photos) {
                            $gallery_photo  = wp_get_attachment_image_src( $photos, 'wpestate-large' ); ?>

                            <div class="photo-nav-items">
                                <div class="gallery-nav-img">
                                    <img src="<?php echo esc_url($gallery_photo[0]); ?>" class="img-responsive" alt="<?php esc_html_e('gallery_photo : ','wpestate');?>" />
                                </div> <!--/.gallery-items-img-->
                            </div> 
                        <?php }
                    } 
                } 
            ?>
          </div>
        </div>
      </div>
    </div>
    <!-- Property nav slider -->

    <div class="container property-single-content">
        <div class="row"> 
            <!-- Property Single Content Left Start-->
            <div class="col-md-12 col-lg-7 property-single-left property-content-wrapper">
                <?php
                //Property Details
                $property_bath             = get_post_meta($post->ID, 'wpestate_property_bath', true);
                $property_sqft             = get_post_meta($post->ID, 'wpestate_property_sqft', true);
                $property_garage           = get_post_meta($post->ID, 'wpestate_property_garage', true);
                $property_bed              = get_post_meta($post->ID, 'wpestate_property_bed', true);
                $property_garage_size      = get_post_meta($post->ID, 'wpestate_property_garage_size', true);
                $property_basement         = get_post_meta($post->ID, 'wpestate_property_basement', true);
                $property_year             = get_post_meta($post->ID, 'wpestate_property_year', true);
                $property_available        = get_post_meta($post->ID, 'wpestate_property_available', true);
                $property_total_room       = get_post_meta($post->ID, 'wpestate_property_total_room', true);
                $property_lot_size         = get_post_meta($post->ID, 'wpestate_property_lot_size', true);
                $property_featured     = get_post_meta(get_the_ID(), 'wpestate_featured_property', true);

                $property_category = get_post_meta(get_the_ID(), 'wpestate_property_status', true);
                $property_cat_text = '';

                if($property_category == 'flat_house'){
                  $property_cat_text = 'Falt/House';
                }else if($property_category == 'duplexe'){
                  $property_cat_text = 'Duplexe';
                }else if($property_category == 'condminum'){
                  $property_cat_text = 'Condminum';
                }else if($property_category == 'apartment'){
                  $property_cat_text = 'apartment';
                }
                ?>

                <!-- Property Title & Price -->
                <div class="property-single-top">
                    <div class="property-title-type row">
                        <div class="d-inline-block col-md-12">
                            <div class="property-status">
                              <?php if ($property_status == 'buy') { ?>
                                <span class="buy"><?php echo $property_status; ?></span>
                              <?php } else{?>
                                <span><?php echo $property_status; ?></span>
                              <?php }?>
                              <?php if($property_featured) {?>
                                <span class="p_featured"><?php echo esc_html__('Featured', 'wpestate'); ?></span>
                              <?php }?>
                              <?php if($property_cat_text) { ?>
                                <span class="p_category"><?php echo esc_attr($property_cat_text); ?></span>
                              <?php }?>
                            </div>

                            <h2 class="property-name"><?php the_title(); ?></h2>
                            <div class="property-address"><i class="fa fa-map-marker"></i><?php echo esc_attr($property_address); ?></div>
                        </div>
                    </div>
                    <div class="property-main-feature">
                      <?php if (!empty($property_bed) && $property_bed <= 1) { ?>
                        <span class="main-feature-top"><i class="fa fa-bed"></i><?php echo esc_attr($property_bed).' '.esc_html__( 'Bed', 'wpestate' ); ?></span>
                      <?php } else{?>
                        <span class="main-feature-top"><i class="fa fa-bed"></i><?php echo esc_attr($property_bed).' '.esc_html__( 'Beds', 'wpestate' ); ?></span>
                      <?php }?>

                      <?php if (!empty($property_bath) && $property_bath <= 1) { ?>
                        <span class="main-feature-top"><i class="fa fa-bath"></i><?php echo esc_attr($property_bath).' '.esc_html__( 'Bath', 'wpestate' );  ?></span>
                      <?php } else{?>
                        <span class="main-feature-top"><i class="fa fa-bath"></i><?php echo esc_attr($property_bath).' '.esc_html__( 'Baths', 'wpestate' );  ?></span>
                      <?php }?>

                      <?php if (!empty($property_sqft)) { ?>
                        <span class="main-feature-top"><i class="fa fa-home"></i><?php echo esc_attr($property_sqft).' '.esc_html__( 'sqft', 'wpestate' );  ?></span>
                      <?php } ?>

                      <?php if (!empty($property_garage) && $property_garage <= 1) { ?>
                        <span class="main-feature-top"><i class="fa fa-car"></i><?php echo esc_attr($property_garage).' '.esc_html__( 'Garage', 'wpestate' );  ?></span>
                      <?php } else{?>
                        <span class="main-feature-top"><i class="fa fa-car"></i><?php echo esc_attr($property_garage).' '.esc_html__( 'Garages', 'wpestate' );  ?></span>
                      <?php }?>
                    </div>
                </div>
                <!-- Property Title & Price -->
                        

                <div class="property-desc">
                    <?php the_content(); ?>
                </div>

                <div class="property-single-content-block row">
                    <div class="col-md-2">
                      <h4 class="property-content-title">
                        <?php echo esc_html__( 'Features', 'wpestate' ); ?>
                      </h4>
                    </div>
                    <div class="col-md-10">
                    <div class="feature-table-list">
                      <?php if(!empty($property_sqft)) {?>
                      <div class="single-feature-list">
                        <div class="row">
                          <div class="col-6">
                            <p class="feature-label"><?php echo esc_html__('Property Size', 'wpestate') ?></p>
                          </div>
                          <div class="col-6">
                            <p class="feature-name"><?php echo esc_attr($property_sqft); ?> ft<sup>2</sup></p>
                          </div>
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($property_total_room)) {?>
                      <div class="single-feature-list">
                        <div class="row">
                          <div class="col-6">
                            <p class="feature-label"><?php echo esc_html__('Total Rooms', 'wpestate') ?></p>
                          </div>
                          <div class="col-6">
                            <p class="feature-name"><?php echo esc_attr($property_total_room);?></p>
                          </div>
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($property_bed)) {?>
                      <div class="single-feature-list">
                        <div class="row">
                          <div class="col-6">
                            <p class="feature-label"><?php echo esc_html__('Bedrooms', 'wpestate') ?></p>
                          </div>
                          <div class="col-6">
                            <p class="feature-name"><?php echo esc_attr($property_bed);?></p>
                          </div>
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($property_bath)) {?>
                      <div class="single-feature-list">
                        <div class="row">
                          <div class="col-6">
                            <p class="feature-label"><?php echo esc_html__('Bathrooms', 'wpestate') ?></p>
                          </div>
                          <div class="col-6">
                            <p class="feature-name"><?php echo esc_attr($property_bath);?></p>
                          </div>
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($property_garage)) {?>
                      <div class="single-feature-list">
                        <div class="row">
                          <div class="col-6">
                            <p class="feature-label"><?php echo esc_html__('Garage', 'wpestate') ?></p>
                          </div>
                          <div class="col-6">
                            <p class="feature-name"><?php echo esc_attr($property_garage);?></p>
                          </div>
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($property_lot_size)) {?>
                      <div class="single-feature-list">
                        <div class="row">
                          <div class="col-6">
                            <p class="feature-label"><?php echo esc_html__('Property Lot Size', 'wpestate') ?></p>
                          </div>
                          <div class="col-6">
                            <p class="feature-name"><?php echo esc_attr($property_lot_size);?></p>
                          </div>
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($property_garage)) {?>
                      <div class="single-feature-list">
                        <div class="row">
                          <div class="col-6">
                            <p class="feature-label"><?php echo esc_html__('Garage', 'wpestate') ?></p>
                          </div>
                          <div class="col-6">
                            <p class="feature-name"><?php echo esc_attr($property_garage);?></p>
                          </div>
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($property_garage_size)) {?>
                      <div class="single-feature-list">
                        <div class="row">
                          <div class="col-6">
                            <p class="feature-label"><?php echo esc_html__('Garage Size', 'wpestate') ?></p>
                          </div>
                          <div class="col-6">
                            <p class="feature-name"><?php echo esc_attr($property_garage_size);?></p>
                          </div>
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($property_year)) {?>
                      <div class="single-feature-list">
                        <div class="row">
                          <div class="col-6">
                            <p class="feature-label"><?php echo esc_html__('Year Built', 'wpestate') ?></p>
                          </div>
                          <div class="col-6">
                            <p class="feature-name"><?php echo esc_attr($property_year);?></p>
                          </div>
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($property_available)) {?>
                      <div class="single-feature-list">
                        <div class="row">
                          <div class="col-6">
                            <p class="feature-label"><?php echo esc_html__('Available From', 'wpestate') ?></p>
                          </div>
                          <div class="col-6">
                            <p class="feature-name"><?php echo esc_attr($property_available);?></p>
                          </div>
                        </div>
                      </div>
                      <?php } ?>

                      <?php if(!empty($property_basement)) {?>
                      <div class="single-feature-list">
                        <div class="row">
                          <div class="col-6">
                            <p class="feature-label"><?php echo esc_html__('Basement', 'wpestate') ?></p>
                          </div>
                          <div class="col-6">
                            <p class="feature-name"><?php echo esc_attr($property_basement);?></p>
                          </div>
                        </div>
                      </div>
                      <?php } ?>

                      </div>
                    </div>
                </div>
                
                <?php 
                  //Property Features
                  $property_attic            = get_post_meta($post->ID, 'wpestate_feature_attic', true);
                  $property_poll             = get_post_meta($post->ID, 'wpestate_feature_pool', true);
                  $property_concierge        = get_post_meta($post->ID, 'wpestate_feature_concierge', true);
                  $property_basketball       = get_post_meta($post->ID, 'wpestate_feature_basketball_court', true);
                  $property_sprinklers       = get_post_meta($post->ID, 'wpestate_feature_sprinklers', true);
                  $property_recreation       = get_post_meta($post->ID, 'wpestate_feature_recreation', true);
                  $property_front_yard       = get_post_meta($post->ID, 'wpestate_feature_front_yard', true);
                  $property_wine_cellar      = get_post_meta($post->ID, 'wpestate_feature_wine_cellar', true);
                  $property_feature_storage  = get_post_meta($post->ID, 'wpestate_feature_storage', true);
                  $property_fireplace        = get_post_meta($post->ID, 'wpestate_feature_fireplace', true);
                  $property_feature_balcony  = get_post_meta($post->ID, 'wpestate_feature_balcony', true);
                  $property_feature_gym      = get_post_meta($post->ID, 'wpestate_feature_gym', true);
                  $property_feature_laundry  = get_post_meta($post->ID, 'wpestate_feature_laundry', true);
                  $property_feature_pound    = get_post_meta($post->ID, 'wpestate_feature_pound', true);
                  $property_feature_deck     = get_post_meta($post->ID, 'wpestate_feature_deck', true);
                  $property_feature_gas      = get_post_meta($post->ID, 'wpestate_feature_gas_heat', true);
                  $property_back_yard        = get_post_meta($post->ID, 'wpestate_feature_back_yard', true);
                  $property_feature_doorman  = get_post_meta($post->ID, 'wpestate_feature_doorman', true);
                  $property_lake_view        = get_post_meta($post->ID, 'wpestate_feature_lake_view', true);
                  $property_private_space    = get_post_meta($post->ID, 'wpestate_feature_private_space', true);
                   
                  if($property_attic == !'' || $property_poll == !'' || $property_concierge == !'' || $property_basketball == !'' || $property_recreation == !'' || $property_front_yard == !'' || $property_wine_cellar == !'' || $property_feature_storage == !'' || $property_fireplace == !'' || $property_feature_balcony == !'' || $property_feature_gym == !'' || $property_feature_laundry == !'' || $property_feature_pound == !'' || $property_feature_deck == !'' || $property_feature_gas == !'' || $property_back_yard == !'' || $property_feature_doorman == !'' || $property_lake_view == !'' || $property_private_space == !'' ) :
                  
                  ?>
                <div class="property-feature-list row property-single-content-block">
                    <div class="col-md-2">
                      <h4 class="property-content-title">
                        <?php echo esc_html__( 'Amenities', 'wpestate' ); ?>
                      </h4>
                    </div>
                    <div class="col-md-10">
                    
                    <ul class="amenities-list-wrap">
                      <?php if($property_attic) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('attic', 'wpestate') ?></li>
                      <?php }?>

                      <?php if($property_poll) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('poll', 'wpestate') ?></li>
                      <?php }?>
                      
                      <?php if($property_concierge) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('concierge', 'wpestate') ?></li>
                      <?php }?>

                      <?php if($property_basketball) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('basketball cout', 'wpestate') ?></li>
                      <?php }?>
                      
                      <?php if($property_sprinklers) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('sprinklers', 'wpestate') ?></li>
                      <?php }?>
                      
                      <?php if($property_recreation) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('recreation', 'wpestate') ?></li>
                      <?php }?>

                      <?php if($property_front_yard) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('front yard', 'wpestate') ?></li>
                      <?php }?>

                      <?php if($property_wine_cellar) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('wine cellar', 'wpestate') ?></li>
                      <?php }?>

                      <?php if($property_feature_storage) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('storage', 'wpestate') ?></li>
                      <?php }?>

                      <?php if($property_fireplace) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('fireplace', 'wpestate') ?></li>
                      <?php }?>

                      <?php if($property_feature_balcony) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('balcony', 'wpestate') ?></li>
                      <?php }?>

                      <?php if($property_feature_pound) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('pound', 'wpestate') ?></li>
                      <?php }?>

                      <?php if($property_feature_deck) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('deck', 'wpestate') ?></li>
                      <?php }?>

                      <?php if($property_feature_gas) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('gas', 'wpestate') ?></li>
                      <?php }?>

                      <?php if($property_back_yard) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('back yard', 'wpestate') ?></li>
                      <?php }?>

                      <?php if($property_feature_doorman) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('doorman', 'wpestate') ?></li>
                      <?php }?>

                      <?php if($property_lake_view) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('lake view', 'wpestate') ?></li>
                      <?php }?>

                      <?php if($property_private_space) {?>
                      <li><i class="fa fa-check"></i><?php echo esc_html__('private space', 'wpestate') ?></li>
                      <?php }?>

                    </ul>
                  </div>
                </div>
                <?php endif; ?>
                <!-- Property Feature List -->


                <div class="property-single-content-block">
                  <div class="row">
                    <div class="col-md-2">
                      <h4 class="property-content-title">
                        <?php echo esc_html__( 'Map', 'wpestate' ); ?>
                      </h4>
                    </div>
                    <div class="col-md-10">
                      <p class="map-top-address">
                        <?php echo $property_address; ?>
                      </p>
                      <div data-lat="<?php echo esc_attr($property_lati); ?>" data-lan="<?php echo esc_attr($property_long); ?>" class="single-page-google-map" id="property-single-map"></div>
                    </div>
                  </div>
                </div>
          
                <div class="property-single-content-block">
                  <div class="row">
                    <div class="col-md-2">
                      <h4 class="property-content-title">
                        <?php echo esc_html__( 'Video', 'wpestate' ); ?>
                      </h4>
                    </div>
                    <div class="col-md-10">
                      <div class="property-video">
                        <?php if(!wp_oembed_get($property_video_url)){ ?>
                        <video width="100%" controls>
                          <source src="<?php echo esc_attr($property_video_url); ?>" type="video/mp4">
                          <source src="<?php echo esc_attr($property_video_url); ?>" type="video/ogg">
                          <?php echo esc_html__('Your browser does not support HTML5 video.', 'wpestate') ?>
                        </video>
                        <?php }?>
                        <?php 
                        if(wp_oembed_get( $property_video_url )){
                            echo wp_oembed_get( $property_video_url );
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>

                

                <!-- Property Floor Plan -->
                <?php if($property_floor_plan) : ?>
                  <div class="property-single-content-block">
                    <div class="row">
                      <div class="col-md-2">
                        <h4 class="property-content-title">
                          <?php echo esc_html__( 'Floor Plan', 'wpestate' ); ?>
                        </h4>
                      </div>
                      <div class="col-md-10">
                        <div class="floor-plan">
                            <div class="floor-plan-inner">
                                <img src="<?php echo esc_attr($floor_plan[0]); ?>" alt="<?php echo esc_html__('floor-plan-img', 'wpestate') ?>">
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endif;?>
                <!-- Property Floor Plan -->

                <!-- Emi calculator start-->
                  <div class="property-single-content-block">
                    <div class="row">
                      <div class="col-md-2">
                        <h4 class="property-content-title">
                          <?php echo esc_html__( 'EMI Calculator', 'wpestate' ); ?>
                        </h4>
                      </div>
                      <div class="col-md-10">
                        <div id="mod-sp-property-emi-calculator123" class="sp-property-emi-calculator">
                          <div id="emi-calc123">
                              <form action="#" id="spec-form123">
                                  <div class="spec-container">
                                      <div class="spec-graph" >
                                          <div class="spec-display-graph">
                                              <canvas id="spec-chart123"></canvas>
                                          </div>
                                          <div class="spec-display-info">
                                              <div class="interest-payable"><?php echo esc_html__('Total Interest', 'wpestate'); ?><p class="interest-payable-value"></strong></div>
                                              <div class="principal-and-interest"><?php echo esc_html__('Principle + Interest Payable', 'wpestate'); ?><p class="principal-and-interest-value"></p></div>
                                          </div>
                                      </div>
                                      <div class="spec-input-container">
                                          <div class="row">
                                              <div class="form-group col-sm-6">
                                                  <label for="" class="control-label">
                                                    <?php echo esc_html_e('Principal loan amount', 'wpestate'); ?>
                                                  </label>
                                                  <input type="number" step='.01' class="form-control spec-loan-amount" placeholder="$500000" name="spec-loan-amount" id="spec-load-amount" required='required' value="5000000" >
                                              </div>
                                              <div class="form-group col-sm-6">
                                                  <label for="" class="control-label">
                                                  <?php echo esc_html__('Interest Rate', 'wpestate'); ?>
                                                    </label>
                                                  <input type="number" step=".01" class="form-control spec-interest" placeholder="10%" name="spec-interest" id="spec-interest" required='required' value="10" >
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label for="" class="control-label"><?php echo esc_html__('Loan Tenure(Year + Month)', 'wpestate'); ?></label>
                                              <div class="row">
                                                  <div class="col-sm-6">
                                                      <input type="number" class="form-control spec-tenure-period-year" name="spec-tenure-period-year" id="spec-tenure-period-year" placeholder="Year" required='required' value="5">
                                                  </div>
                                                  <div class="col-sm-6">
                                                      <input type="number" class="form-control spec-tenure-period-month" name="spec-tenure-period-month" id="spec-tenure-period-month" placeholder="Month">
                                                  </div>
                                              </div>
                                          </div>
                                          <div>
                                              <input type="submit" class="col-12 btn-primary" value="Calculate">
                                          </div>
                                      </div>
                                  </div>
                              </form>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                <!-- Emi calculator end -->
                
                <!-- social share -->
                <div class="property-single-content-block">
                  <div class="row">
                    <div class="col-md-2">
                      <h4 class="property-content-title">
                        <?php echo esc_html__( 'Share Now', 'wpestate' ); ?>
                      </h4>
                    </div>
                    <div class="col-md-10">
                      <?php if(function_exists('wpestate_social_share') && get_theme_mod('blog_social_share', false)) : ?>
                      <div class="single-social-share">
                          <?php echo wpestate_social_share(); ?>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                
                <!-- social share -->
          
            </div> 
            <!-- Property Single Content Left End-->

            <!-- Property Single Content Right Start-->
            <div class="col-md-12 col-lg-5">
              <div class="property-single-right-sidebar">
                <?php
                  $data = get_user_meta($author_id);
                  $user = get_user_by('ID', $author_id);
                  $user_img = get_avatar( $author_id , '90');
                  
                  $img_src = '';
                  $image_id = get_user_meta( $author_id, 'profile_image_id', true );
                  if( $image_id && $image_id > 0 ){
                      $img_src = wp_get_attachment_image_src( $image_id, 'full' )[0];
                  }
                  $phone = $email = ''; 
                  ?>

                  <div class="price-single-right text-center">
                    <p class="single-right-title"><?php echo esc_html__('Property Price', 'wpestate'); ?></p>
                    <h2 class="property-price-tag"><?php if(!empty($property_price)){echo get_theme_mod('site_price_currency', '$').esc_attr($property_price);} ?> 
                    <?php if($property_status == 'rent') {?>
                        <span>/mo</span>
                    <?php } ?>
                    </h2>
                    <span class="call_us"><?php echo esc_html__('Call Us For', 'wpestate'); ?> 
                    <?php if($property_status == 'rent'){?>
                      <?php echo esc_html__('Booking', 'wpestate'); ?>
                    <?php } else if($property_status == 'buy') {?>
                      <?php echo esc_html__('Details', 'wpestate'); ?>
                    <?php }?>
                    </span>
                    <a class="call_agent_btn" href="tel:<?php if(isset($data['profile_mobile1'][0])){ $phone = esc_attr($data['profile_mobile1'][0]);
                              echo esc_attr($phone); }
                            ?>">
                      <?php if(isset($data['profile_mobile1'][0])){ $phone = esc_attr($data['profile_mobile1'][0]); echo esc_attr($phone); } ?>
                      </a>
                  </div>


                  <div class="agent-info-contact">
                    <p class="single-right-title"><?php echo esc_html__('Property Agent', 'wpestate'); ?></p>
                      <div class="d-block mb-3 mt-4">
                        <a href="<?php echo get_author_posts_url($author_id);?>">
                          <?php if($img_src) {?>
                          <img width="90" src="<?php echo esc_url($img_src); ?>" alt="author_photo">
                          <?php } else{ echo html_entity_decode($user_img);}?>
                        </a>
                      </div>
                        
                      <div class="media-body">
                        <h5 class="agent-name">
                        <a href="<?php echo get_author_posts_url($author_id);?>">
                          <?php echo esc_attr($user->first_name.' '.$user->last_name); ?>
                        </a>
                        </h5>
                        <p class="agent-contact border-top">
                          <i class="fa fa-phone-square"></i>
                          <a href="tel:<?php echo get_theme_mod( 'header_top_phone', '(800)-398-7586' ); ?>">
                          <?php 
                          if(isset($data['profile_mobile1'][0])){ $phone = esc_attr($data['profile_mobile1'][0]);
                            echo esc_attr($phone); }
                          ?>
                          </a>
                        </p>
                    </div>
                    
                  </div>
                
                  <div class="agent-contact-form">
                    <p class="single-right-title mb-4"><?php echo esc_html__('Contact for Enquiry', 'wpestate'); ?></p>
                      <form id="agent-submit" method="post">
                          <input type="hidden" value="<?php echo esc_attr($email); ?>" name="agent_email" id="agent-email">
                          <input type="hidden" value="_agent_noance" name="_agent_noance"/>
                          <div class="single-field">
                              <input type="text" name="name" id="name" placeholder="Full Name" class="form-control form-check" required>
                              <input type="email" name="email" id="user-email" placeholder="Your Email" class="form-control form-check" required>
                              <input type="number" name="phone" id="phone" placeholder="Phone" class="form-control form-check">
                              <textarea name="message" id="message" class="form-control form-check" placeholder="Message" required></textarea>
                              <input type="submit" name="agent_form" class="form-control btn-submit" value="Submit">
                          </div>
                      </form>
                      <div class="msg-status alert alert-success"></div>
                  </div>
                </div>
            </div>
            <!-- Property Single Content Right End-->
        </div> <!-- row -->
    </div> <!-- #container -->
</section>
<?php endwhile; wp_reset_postdata();?>

<?php get_footer();
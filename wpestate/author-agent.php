<?php get_header(); 
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$author_id = $curauth->ID;
$data = get_user_meta($author_id);
$user = get_user_by('ID', $author_id);
$user_img = get_avatar( $author_id , '265');

$img_src = '';
$image_id = get_user_meta( $author_id, 'profile_image_id', true );
if( $image_id && $image_id > 0 ){
    $img_src = wp_get_attachment_image_src( $image_id, 'full' )[0];
}

if(function_exists('get_property_min_max_value')){
    $productQuantityProperty = get_property_min_max_value();
    $minPrice = $maxPrice = $minArea = $maxArea = $maxBed = $maxBath = $maxParking = 0;
    if(count($productQuantityProperty)){
            $minPrice       = $productQuantityProperty['minprice'];
            $maxPrice       = $productQuantityProperty['maxprice'];
            $minArea        = $productQuantityProperty['minarea'];
            $maxArea        = $productQuantityProperty['maxarea'];
            $maxBed         = $productQuantityProperty['maxbed'];
            $maxBath        = $productQuantityProperty['maxbath'];
            $maxParking     = $productQuantityProperty['maxparking'];
    }
}

?>
<section id="main">
    <!-- Search start -->
    <div class="agent-signle-search-wrap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h2 class="agent-search-title text-center">
                        <?php echo get_theme_mod('agent_search_title_text', 'Search and Find the Best Home for you'); ?>
                    </h2>
                    <div class="wpestate-search-wrap city-search-wrap search-data-global" data-pricemin="<?php $minPrice; ?>" data-pricemax="<?php $maxPrice; ?>" data-areamin="<?php $minArea; ?>" data-areamax="<?php $maxArea; ?>" id="wpestate-advanced-search">
                        <form method="get">
                            <div class="row">
                                <div class="col-md-4 single-col border-right">
                                    <div class="single-search-field">
                                        <div class="search-select-box">
                                            <select class="form-control" name="location" id="location">
                                                <option value="" hidden>
                                                    <i class="fa fa-map-marker"></i>
                                                    <?php esc_html_e('City/State', 'wpestate'); ?>
                                                </option>
                                                <?php 
                                                    $location = '';
                                                    $parent_location = get_terms('property-location', array('hide_empty' => 0, 'parent' =>0)); 
                                                    foreach($parent_location as $parent){
                                                        $selected4 = ($location == $parent->slug) ? 'selected':''; ?>
                                                        <option <?php echo esc_attr($selected4); ?> value="<?php echo esc_attr($parent->slug);?>"><?php echo esc_attr($parent->name);?></option>
                                                        <?php
                                                        $child_location = get_terms('property-location', array('hide_empty' => 0, 'parent' =>$parent->term_id));
                                                        foreach($child_location as $child){
                                                            $selected4 = ($location == $child->slug) ? 'selected':''; ?>
                                                            <option <?php echo esc_attr($selected4); ?> value="<?php echo esc_attr($child->slug);?>">&nbsp;&nbsp;&nbsp;<?php echo esc_attr($child->name);?></option>
                                                    <?php } }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 single-col">
                                    <div class="single-search-field">
                                        <div class="search-select-box city-search-type">
                                            <select class="form-control" id="type">
                                                <option value="" hidden>
                                                    <i class="fa fa-map-marker"></i>
                                                    <?php esc_html_e('Property Type', 'wpestate'); ?>
                                                </option>
                                                <?php 
                                                $args = ['type' =>'property','taxonomy'=>'property-type'];
                                                $categories = get_categories($args);
                                                if(count($categories)>0){
                                                    foreach($categories as $category){
                                                        $selected6 = ($type == $category->slug) ? 'selected':''; ?>
                                                        <option <?php echo esc_attr($selected6); ?> value="<?php echo esc_attr($category->slug);?>"><?php echo esc_attr($category->name);?></option>
                                                <?php } }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 single-col">
                                    <button type="submit" id="submit" name="submit" class="btn-property-search btn-search-city"><i class="fa fa-search"></i><?php echo esc_attr__('Search Now', 'wpestate')?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search End -->
    <div class="container">
        <div id="content" class="site-content mb-5 single-agent-page" role="main">
        	<div class="row">
                <div class="col-sm-6 col-md-6 col-lg-8">
                    <div class="row user-info-wrap">
                        <div class="col-md-auto col-lg-auto">
                            <div class="author-photo">
                                <?php if($img_src) {?>
                                    <img src="<?php echo esc_url($img_src); ?>" alt="author_photo">
                                <?php } else{ echo esc_html($user_img);}?>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-7">
                            <div class="user-info-left">
                                <h3 class="agent-name"><?php echo esc_html($user->first_name.' '.$user->last_name); ?></h3>
                                <p class="designation"><?php echo esc_html($curauth->occupation); ?></p>
                                <p class="user-info-single"><i class="fa fa-map-marker"></i>
                                    <?php
                                        if(isset($data['profile_address'][0])){
                                           echo esc_html($data['profile_address'][0]);
                                        };
                                    ?>
                                </p>
                                <p class="user-info-single"><i class="fa fa-phone"></i>
                                <?php
                                    if(isset($data['profile_mobile1'][0])){
                                        echo esc_html($data['profile_mobile1'][0]);
                                    };
                                ?>
                                </p>
                                <p class="user-info-single"><i class="fa fa-envelope"></i>
                                <?php
                                    if(isset($data['profile_email1'][0])){
                                        echo esc_html($data['profile_email1'][0]);
                                    };
                                ?>
                                </p>
                                <p class="user-info-single"><i class="fa fa-link"></i><a target="_blank" href="<?php
                                    if(isset($data['profile_website'][0])){
                                        echo esc_html($data['profile_website'][0]);
                                    };
                                ?>">
                                <?php
                                    if(isset($data['profile_website'][0])){
                                        echo esc_html($data['profile_website'][0]);
                                    };
                                ?></a></p>
                            </div>
                        </div>
                    </div>
                    <div class="author-single-bio pt-4">
                        <h4><?php echo esc_html__( 'About The Agent', 'wpestate' ); ?></h4>
                        <p class="user-single-bio"><?php
                                    if(isset($data['profile_bio'][0])){
                                        echo esc_html($data['profile_bio'][0]);
                                    };
                                ?></p>
                        <div class="author-single-social">
                            <a target="_blank" class="facebook" href="<?php
                                    if(isset($data['profile_facebook'][0])){
                                        echo esc_url($data['profile_facebook'][0]);
                                    };
                                ?>"><i class="fa fa-facebook-square"></i></a>
                            <a target="_blank" class="twitter" href="<?php
                                    if(isset($data['profile_twitter'][0])){
                                        echo esc_url($data['profile_twitter'][0]);
                                    };
                                ?>"><i class="fa fa-twitter"></i></a>
                            <a target="_blank" class="linkedin" href="<?php
                                    if(isset($data['profile_linkedin'][0])){
                                        echo esc_url($data['profile_linkedin'][0]);
                                    };
                                ?>"><i class="fa fa-linkedin"></i></a>
                            <a target="_blank" class="pinterest" href="<?php
                                    if(isset($data['profile_pinterest'][0])){
                                        echo esc_url($data['profile_pinterest'][0]);
                                    };
                                ?>"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="agent-contact-form">
                        <p class="single-right-title mb-4"><?php echo esc_html__( 'Contact Agent', 'wpestate' );; ?></p>
                        <form id="agent-submit" method="post">
                            <input type="hidden" value="<?php
                                    if(isset($data['profile_email1'][0])){
                                        echo esc_url($data['profile_email1'][0]);
                                    };
                                ?>" name="agent_email" id="agent-email">
                            <input type="hidden" value="_agent_noance" name="_agent_noance"/>
                            <div class="single-field">
                                <input type="text" name="name" id="name" placeholder="Full Name" class="form-control form-check" required>
                                <input type="email" name="email" id="user-email" placeholder="Your Email" class="form-control form-check" required>
                                <input type="number" name="phone" id="phone" placeholder="Phone" class="form-control form-check">
                                <textarea name="message" id="message" class="form-control form-check" placeholder="Message" required></textarea>
                                <input type="submit" name="agent_form" class="form-control btn-submit" value="Submit">
                            </div>
                        </form>
                        <div class="msg-status"></div>
                    </div>
                </div>
                
        	</div>
            <div class="agent-own-post ">
                <h3 class="agent-name">
                    <?php echo esc_attr($curauth->first_name.' '.$curauth->last_name).' '.esc_html__( 'Projects', 'wpestate' ); ?> 
                </h3>
           
                <div class="row">
                    <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $arg = array(
                        'author'            =>  $curauth->ID,
                        'orderby'           =>  'post_date',
                        'post_type'         =>  'property',
                        'order'             =>  'ASC',
                        'posts_per_page'    => 6,
                        'paged'             => $paged
                        );
                        $data = new WP_Query($arg);
                     ?>
                    <?php 
                    if ( $data->have_posts() ) :
                    while ( $data->have_posts() ) : $data->the_post(); 
                    $property_price     = get_post_meta($post->ID, 'wpestate_property_price', true);
                    $property_address   = get_post_meta($post->ID, 'wpestate_property_address', true);
                    $property_bed       = get_post_meta($post->ID, 'wpestate_property_bed', true);
                    $property_bath      = get_post_meta($post->ID, 'wpestate_property_bath', true);
                    $property_sqft      = get_post_meta($post->ID, 'wpestate_property_sqft', true);
                    $property_featured     = get_post_meta(get_the_ID(), 'wpestate_featured_property', true);
                    $property_status    = get_all_property_taxonomy();
                    $property_slide_img        = get_post_meta(get_the_ID(),'wpestate_property_slide_img');
                    $post_thumb_id = get_post_thumbnail_id();
                    array_unshift($property_slide_img, $post_thumb_id);

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

                    <div class="col-md-4">
                        <div class="property-single-items">
                            <div class="property-thumb">
                                <?php
                                    $active = '';
                                    if ( is_user_logged_in() ) {
                                        $campaign_id = get_user_meta( get_current_user_id() , 'loved_campaign_ids', true);
                                        if( $campaign_id ){
                                            $campaign_id = json_decode( $campaign_id, true );
                                            if (in_array( get_the_ID() , $campaign_id )){
                                                $active = 'active';
                                            }
                                        }
                                    }
                                ?>
                                <a href="#" class="thm-love-btn <?php echo esc_attr($active); ?>" data-campaign="<?php echo get_the_ID(); ?>" data-user="<?php echo get_current_user_id(); ?>">
                                    <i class="fa fa-heart"></i>
                                </a>
                                
                                <div class="property-grid-slide">
                                    <?php 
                                        if (is_array($property_slide_img)) {
                                            if(!empty($property_slide_img)) {
                                                $limitw  = 20;
                                                $photo_slices = (count($property_slide_img) > $limitw) ? array_slice($property_slide_img, 0, $limitw , true ) : $property_slide_img;
                                                foreach ($photo_slices as $key=>$photos) {
                                                    $gallery_photo  = wp_get_attachment_image_src( $photos, 'wpestate-property' ); ?>

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
                            </div>
                            <div class="property-grid-content">
                                <div class="property-price">
                                    <h2 class="price-tag"><?php echo get_theme_mod('site_price_currency', '$').$property_price; ?></h2>
                                    <?php if ($property_status == 'buy') { ?>
                                        <span class="period">/sqft</span>
                                    <?php } elseif($property_status == 'rent'){?>
                                        <span class="period">/mo</span>
                                    <?php }?>
                                </div>
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
                                <h3 class="property-grid-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p class="property-grid-address"><?php echo $property_address; ?></p>
                            </div>
                            <div class="property-grid-inner text-center">
                                <?php if (!empty($property_bed) && $property_bed <= 1) { ?>
                                    <span>
                                        <i class="fa fa-bed"></i><?php echo $property_bed.' '.esc_html__( 'Bed', 'wpestate' ); ?>
                                    </span>
                                <?php } else{?>
                                    <span><i class="fa fa-bed"></i><?php echo $property_bed.' '.esc_html__( 'Beds', 'wpestate' ); ?></span>
                                <?php }?>
                                
                                <?php if (!empty($property_bath) && $property_bath <= 1) { ?>
                                    <span><i class="fa fa-bath"></i><?php echo $property_bath.' '.esc_html__( 'Bath', 'wpestate' );  ?></span>
                                <?php } else{?>
                                    <span><i class="fa fa-bath"></i><?php echo $property_bath.' '.esc_html__( 'Baths', 'wpestate' );  ?></span>
                                <?php }?>
                                <?php if (!empty($property_sqft)) { ?>
                                    <span class="grid-inner-size">
                                    <img width="14" class="mr-2" src="<?php echo get_template_directory_uri(); ?>/images/sqft-icon.png" alt="Sqft">	
                                    <?php echo $property_sqft.' '.esc_html__( 'sqft', 'wpestate' );  ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <?php endwhile; 
                    endif;
                    wp_reset_postdata();
                    // Previous/next page navigation.
                    // $page_numb = max( 1, get_query_var('paged') );
                    // $max_page = $data->max_num_pages;
                    // echo wpestate_pagination( $page_numb, $max_page ); 
                    ?>
                </div>
            </div>
        </div> <!--/#content-->
    </div>
</section> <!--/#main-->
<?php get_footer();

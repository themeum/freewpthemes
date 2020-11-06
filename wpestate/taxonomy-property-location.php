<?php 
	get_header(); 
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
<?php get_template_part('lib/sub-header')?>

<?php
function get_All_Location(){
    $html = '';
    $html .= '<select class="form-control" name="location" id="location">';
        $parent_location = get_terms('property-location', array('hide_empty' => 0, 'parent' =>0)); 
        foreach($parent_location as $parent){
            $html .= '<option value="'.$parent->slug.'">'.$parent->name.'</option>';
            $child_location = get_terms('property-location', array('hide_empty' => 0, 'parent' =>$parent->term_id));
            foreach($child_location as $child){
                //$selected = ($p_location == $child->name) ? 'selected':'';
                $html .= '<option value="'.$child->slug.'">&nbsp;&nbsp;&nbsp;'.$child->name.'</option>';
            }
        }
    $html .= '</select>';
    return $html;
}

?>

<div class="search-page-form-wrap search-data-global container" data-pricemin="<?php echo esc_attr($minPrice); ?>" data-pricemax="<?php echo esc_attr($maxPrice); ?>" data-areamin="<?php echo esc_attr($minArea); ?>" data-areamax="<?php echo esc_attr($maxArea); ?>" id="wpestate-advanced-search">
    <form method="get"> 
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-4 single-col">
                        <div class="single-search-field">
                            <div class="search-select-box bg-dark">
                                <select class="form-control" name="status" id="status">
                                    <option value="" selected>
                                        <?php echo esc_html__('Status', 'wpestate') ?></option>
                                    <?php 
                                        $args = ['type' =>'property','taxonomy'=>'property-cat'];
                                        $categories = get_categories($args);
                                        if(count($categories)>0){
                                                foreach($categories as $category){ ?>
                                                        <option value="<?php echo esc_attr($category->slug);?>">
                                                        <?php echo esc_attr($category->name);?></option>
                                                <?php } }
                                        ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 single-col mt-3">
                        <div class="single-search-field">
                            <p class="search-label"><?php echo esc_attr__('City / State', 'wpestate')?></p>
                            <div class="search-select-box">
                                <select class="form-control" name="location" id="location">
                                <?php 
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
                    <div class="col-md-4 single-col mt-3">
                        <div class="single-search-field">
                            <p class="search-label"><?php echo esc_attr__('Property Type', 'wpestate')?></p>
                            <div class="search-select-box">
                                <select class="form-control" id="type">
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
                </div>
            </div>
            <div class="col-lg-4 text-right mt-3">
                <div class="d-inline-block single-col">
                    <div class="single-search-field">
                        <div class="btn-toggle-advance"><i class="fa fa-cog"></i> <?php echo esc_attr__('Advance', 'wpestate')?></div>
                    </div>
                </div>
                <div class="d-inline-block single-col">
                    <div class="single-search-field">
                        <button type="submit" id="submit" name="submit" class="btn-property-search"><i class="fa fa-search"></i><?php echo esc_attr__('Search Property', 'wpestate')?></button>
                    </div>
                </div>
            </div>
        </div><!-- row (inner) -->
        <div class="advance-row <?php echo $show_class; ?>">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="range-slide-label">
                                <p class="search-label"><?php echo esc_attr__('Price Range', 'wpestate')?></p>
                                <input type="text" id="amount" readonly>
                            </div>
                            <div id="price-range"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="range-slide-label">
                                <p class="search-label d-inline-block"><?php echo esc_attr__('Size Range', 'wpestate')?></p>
                                <input type="text" id="area" readonly>
                            </div>
                            <div id="area-range"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="single-col">
                                <div class="single-search-field">
                                    <p class="search-label"><?php echo esc_attr__('Beds', 'wpestate') ?></p>
                                    <div class="search-select-box select-small">
                                        <select class="form-control" id="bed">
                                            <?php 
                                            echo '<option value="" selected>'.esc_attr__('Bed', 'wpestate').'</option>';
                                            for ($x = 1; $x <= $maxBed; $x++) {
                                                    echo "<option value='$x'>".$x."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="single-col">
                                <div class="single-search-field">
                                    <p class="search-label"><?php echo esc_attr__('Baths', 'wpestate') ?></p>
                                    <div class="search-select-box select-small">
                                        <select class="form-control" id="bath">
                                            <?php 
                                            echo '<option value="" selected>'.esc_attr__('Bath', 'wpestate').'</option>';
                                            for ($i = 1; $i <= $maxBath; $i++) {
                                                    echo "<option value='$i'>".$i."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                                <div class="single-col">
                                    <div class="single-search-field">
                                        <p class="search-label"><?php echo esc_attr__('Parking', 'wpestate') ?></p>
                                        <div class="search-select-box select-small">
                                            <select class="form-control" id="parking">
                                                <?php 
                                                echo '<option value="" selected>'.esc_attr__('Parking', 'wpestate').'</option>';
                                                for ($i = 1; $i <= $maxParking; $i++) {
                                                        echo "<option value='$i'>".$i."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                </div>

            </div>
        </div>
    </form>
</div>

<section id="main" class="generic-padding">
    <div class="container">
        <div class="row">
        	<?php
            if ( have_posts() ) :
            while ( have_posts() ) : the_post();
            $property_price            = get_post_meta($post->ID, 'wpestate_property_price', true);
	        $property_address          = get_post_meta($post->ID, 'wpestate_property_address', true);
	        $property_bed              = get_post_meta($post->ID, 'wpestate_property_bed', true);
	        $property_bath             = get_post_meta($post->ID, 'wpestate_property_bath', true);
	        $property_sqft             = get_post_meta($post->ID, 'wpestate_property_sqft', true);
            $property_featured     = get_post_meta(get_the_ID(), 'wpestate_featured_property', true);
			$property_status           = get_all_property_taxonomy();
			$property_slide_img        = get_post_meta(get_the_ID(),'wpestate_property_slide_img');
			$post_thumb_id = get_post_thumbnail_id();
			array_unshift($property_slide_img, $post_thumb_id);
			?>
	        <div class="property-items col-sm-6 col-md-4">
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
       <?php
       		endwhile;
        else:
            echo "No Post Found";
        endif;                                  
        $page_numb = max( 1, get_query_var('paged') );
        $max_page = $wp_query->max_num_pages;
        echo wpestate_pagination( $page_numb, $max_page ); 
        ?>
        </div>
    </div> <!-- .container -->
</section> 
<?php get_footer();
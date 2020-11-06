<?php
global $themeum_options;
$permalink = get_permalink(get_the_ID());
$titleget = get_the_title();
$media_url ='';
if( has_post_thumbnail( get_the_ID() ) ){
    $thumb_src =  wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
    $media_url = $thumb_src[0];
}
?>

<div class="social-share-wrap">
	<ul>
		<li>
			<a href="#" data-type="facebook" data-url="<?php echo esc_url($permalink); ?>" data-title="<?php echo $titleget ?>" data-description="<?php echo $titleget ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial icon-facebook"></a>
		</li>

		<li>
			<a href="#" data-type="twitter" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $titleget ?>" data-via="<?php echo $themeum_options['twitter-username']; ?>" class="prettySocial icon-twitter"></a>
		</li>

		<li>
			<a href="#" data-type="googleplus" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $titleget ?>" class="prettySocial icon-google-plus"></a>		
		</li>

		<li>
			<a href="#" data-type="pinterest" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $titleget ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial icon-pinterest"></a>		
		</li>

		<li>
			<a href="#" data-type="linkedin" data-url="<?php echo esc_url($permalink); ?>" data-title="<?php echo $titleget; ?>" data-description="<?php echo $titleget ?>" data-via="<?php echo $themeum_options['linkedin-username']; ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial icon-linkdin"></a>
		</li>

	</ul>
</div>

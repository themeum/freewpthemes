<?php
$permalink 	= get_permalink(get_the_ID());
$titleget 	= get_the_title();
$media_url 	= '';
if( has_post_thumbnail( get_the_ID() ) ){
    $thumb_src =  wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
    $media_url = $thumb_src[0];
}
?>

<div class="themeum-social-share-wrap">
	<ul class="themeum-social-share">
		<li><span class="share-title"><?php esc_html_e('Share','winkel');?></span></li>
		<li>
			<a href="#" data-type="facebook" data-url="<?php echo esc_url($permalink); ?>" data-title="<?php echo $titleget ?>" data-description="<?php echo $titleget ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial facebook fa fa-facebook"></a>
		</li>
		<li>
			<a href="#" data-type="twitter" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $titleget ?>" class="prettySocial twitter fa fa-twitter"></a>
		</li>
		<li>
			<a href="#" data-type="googleplus" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $titleget ?>" class="prettySocial googleplus fa fa-google-plus"></a>
		</li>
		<li>
			<a href="#" data-type="pinterest" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $titleget ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial pinterest fa fa-pinterest"></a>		
		</li>
	</ul>
</div>

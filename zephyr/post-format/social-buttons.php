<?php
$permalink 	= get_permalink(get_the_ID());
$titleget 	= get_the_title();
$media_url 	= '';
if( has_post_thumbnail( get_the_ID() ) ){
    $thumb_src =  wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
    $media_url = $thumb_src[0];
}
?>
<?php if ( get_theme_mod( 'blog_social_share', false ) ) { ?>
	<div class="social-share-wrap">
		<ul>
			<li>
				<a href="#" data-type="facebook" data-url="<?php echo esc_url($permalink); ?>" data-title="<?php echo $titleget ?>" data-description="<?php echo $titleget ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial facebook"><i class="fa fa-facebook"></i><?php echo esc_attr__( 'Facebook', 'zephyr' ); ?></a>
			</li>
			<li>
				<a href="#" data-type="twitter" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $titleget ?>" class="prettySocial twitter"><i class="fa fa-twitter"></i></a>
			</li>
			<li>
				<a href="#" data-type="googleplus" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $titleget ?>" class="prettySocial google-plus"><i class="fa fa-google-plus"></i></a>
			</li>
			<li>
				<a href="#" data-type="pinterest" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $titleget ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial pinterest"><i class="fa fa-pinterest"></i></a>		
			</li>
			<li>
				<a href="#" data-type="linkedin" data-url="<?php echo esc_url($permalink); ?>" data-title="<?php echo $titleget; ?>" data-description="<?php echo $titleget ?>" data-via="<?php echo get_theme_mod( 'wp_linkedin_user' ); ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial linkedin"><i class="fa fa-linkedin"></i></a>
			</li>
		</ul>
	</div>
<?php } ?>  
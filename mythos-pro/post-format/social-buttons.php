<?php
$permalink 	= get_permalink(get_the_ID());
$titleget 	= get_the_title();
$media_url 	= '';
if( has_post_thumbnail( get_the_ID() ) ){
    $thumb_src =  wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
    $media_url = $thumb_src[0];
}
?>
<?php if(get_theme_mod('social-share-wrap', true)) { ?>
	<div class="social-share-wrap">
        <div class="share-text"><?php echo esc_attr__( 'Share: ', 'mythos-pro' ); ?></div>
		<ul>
			<li>
				<a href="#" data-type="facebook" data-url="<?php echo esc_url($permalink); ?>" data-title="<?php echo esc_html($titleget); ?>" data-description="<?php echo esc_html($titleget); ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial facebook"><i class="fab fa-facebook-f"></i></a>
			</li>
			<li>
				<a href="#" data-type="twitter" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo esc_html($titleget); ?>" class="prettySocial twitter"><i class="fab fa-twitter"></i></a>
			</li>
			<li>
				<a href="#" data-type="googleplus" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo esc_html($titleget); ?>" class="prettySocial google-plus"><i class="fab fa-google"></i></a>
			</li>
			<li>
				<a href="#" data-type="pinterest" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo esc_html($titleget); ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial pinterest"><i class="fab fa-pinterest"></i></a>		
			</li>
			<li>
				<a href="#" data-type="linkedin" data-url="<?php echo esc_url($permalink); ?>" data-title="<?php echo esc_html($titleget); ?>" data-description="<?php echo esc_html($titleget); ?>" data-via="<?php echo esc_attr(get_theme_mod( 'wp_linkedin_user' )); ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial linkedin"><i class="fab fa-linkedin-in"></i></a>
			</li>
		</ul>
	</div>
<?php } ?>
<?php
$permalink 	= get_permalink(get_the_ID());
$titleget 	= get_the_title();
$media_url 	= '';
if( has_post_thumbnail( get_the_ID() ) ){
    $thumb_src =  wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
    $media_url = $thumb_src[0];
}
?>
<?php if ( get_theme_mod( 'blog_social_share', true ) ) { ?>
	<div class="social-share-wrap melody-post-share-social">
		<div class="share-icon">
			<span class="icon-big"><i class="fa fa-share-square-o"></i></span>
			<?php if(get_theme_mod( 'blog_share_fb', true )) {?>
			<a href="#" data-type="facebook" data-url="<?php echo esc_url($permalink); ?>" data-title="<?php echo $titleget ?>" data-description="<?php echo $titleget ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial fa fa-facebook"></a>
			<?php } ?>
			
			<?php if(get_theme_mod( 'blog_share_tw', true )) {?>
			<a href="#" data-type="twitter" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $titleget ?>" class="prettySocial fa fa-twitter"></a>
			<?php }?>

			<?php if(get_theme_mod( 'blog_share_gp', true )) {?>
			<a href="#" data-type="googleplus" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $titleget ?>" class="prettySocial fa fa-google-plus"></a>
			<?php }?>

			<?php if(get_theme_mod( 'blog_share_pn', false )) {?>
			<a href="#" data-type="pinterest" data-url="<?php echo esc_url($permalink); ?>" data-description="<?php echo $titleget ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial fa fa-pinterest"></a>		
			<?php }?>

			<?php if(get_theme_mod( 'blog_share_ln', false )) {?>
			<a href="#" data-type="linkedin" data-url="<?php echo esc_url($permalink); ?>" data-title="<?php echo $titleget; ?>" data-description="<?php echo $titleget ?>" data-via="<?php echo get_theme_mod( 'wp_linkedin_user' ); ?>" data-media="<?php echo esc_url( $media_url ); ?>" class="prettySocial fa fa-linkedin"></a>
			<?php }?>
		</div>
	</div>
<?php } ?>  
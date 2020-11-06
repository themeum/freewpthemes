<!-- <h3 class="social-share-title"><?php _e( 'Follow Us','melody' ); ?></h3> -->
<div class="social-link col-melody d-inline-block">
    <div class="social-share">
        <?php if ( get_theme_mod( 'wp_facebook' ) ) { ?>
        <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'wp_facebook' ) ); ?>"><i class="fa fa-facebook"></i></a>
        <?php } ?>   
        <?php if ( get_theme_mod( 'wp_twitter' ) ) { ?>
        <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'wp_twitter' ) ); ?>"><i class="fa fa-twitter"></i></a>
        <?php } ?>    
        <?php if ( get_theme_mod( 'wp_google_plus' ) ) { ?>
        <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'wp_google_plus' ) ); ?>"><i class="fa fa-google-plus"></i></a>
        <?php } ?>
        <?php if ( get_theme_mod( 'wp_pinterest' ) ) { ?>  
        <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'wp_pinterest' ) ); ?>"><i class="fa fa-pinterest"></i></a>
        <?php } ?>
        <?php if ( get_theme_mod( 'wp_instagram' ) ) { ?>  
        <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'wp_instagram' ) ); ?>"><i class="fa fa-instagram"></i></a>
        <?php } ?>        
        <?php if ( get_theme_mod( 'wp_youtube' ) ) { ?>  
        <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'wp_youtube' ) ); ?>"><i class="fa fa-youtube"></i></a>
        <?php } ?>
        <?php if ( get_theme_mod( 'wp_linkedin' ) ) { ?>  
        <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'wp_linkedin' ) ); ?>"><i class="fa fa-linkedin"></i></a>
        <?php } ?>
        <?php if ( get_theme_mod( 'wp_dribbble' ) ) { ?>  
        <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'wp_dribbble' ) ); ?>"><i class="fa fa-dribbble"></i></a>
        <?php } ?>
        <?php if ( get_theme_mod( 'wp_behance' ) ) { ?>  
        <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'wp_behance' ) ); ?>"><i class="fa fa-behance"></i></a>
        <?php } ?>
        <?php if ( get_theme_mod( 'wp_flickr' ) ) { ?>  
        <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'wp_flickr' ) ); ?>"><i class="fa fa-flickr"></i></a>
        <?php } ?>
        <?php if ( get_theme_mod( 'wp_vk' ) ) { ?>  
        <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'wp_vk' ) ); ?>"><i class="fa fa-vk"></i></a>
        <?php } ?>
        <?php if ( get_theme_mod( 'wp_skype' ) ) { ?>  
        <a target="_blank" href="skype:#<?php echo esc_url( get_theme_mod( 'wp_skype' ) ); ?>?chat"><i class="fa fa-skype"></i></a>
        <?php } ?>
    </div>
</div>
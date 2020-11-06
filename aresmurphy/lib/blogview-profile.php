<?php $headerstyle = get_theme_mod( 'header_layout', 'portfolio' ); ?>
<div class="layout-view-<?php echo $headerstyle; ?>">
    <?php 
    $profileimg = get_theme_mod( 'image_profile', get_template_directory_uri().'/images/profile-img.jpg' );
    $profiletext = get_theme_mod( 'profile_text', 'Hello, I am Ares Murphy' );
    $profileshortnote = get_theme_mod( 'profile_short_note', 'Thank you for hanging around my online Portfolio for awhile.' );
    if ( $profileimg || $profiletext || $profileshortnote ) { ?>
        <div class="blog-profile-view-wrap">
            <div class="container">  
                <div class="row">  
                    <div class="col-sm-12">  
                        <div class="blog-profile-view">  
                            <div class="blog-profile-view-in">
                                <?php if( !empty($profileimg) ) { ?>
                                   <img class="profile-image img-responsive" src="<?php echo esc_url( $profileimg ); ?>" alt="<?php  esc_html_e( 'Profile', 'aresmurphy' ); ?>" title="<?php  esc_html_e( 'Profile', 'aresmurphy' ); ?>">
                                <?php }?>
                                <?php if ($profiletext) { ?>
                                    <h3 class="profile-title"><?php echo wp_kses_post($profiletext); ?></h3>
                                <?php } ?>                    
                                <?php if ($profileshortnote) { ?>
                                    <div class="profile-short-note"><?php echo wp_kses_post($profileshortnote); ?></div>
                                <?php } ?>
                            </div><!--/.blog-profile-view-in-->
                        </div><!--/.blog-profile-view-->
                    </div><!--/.row-->
                </div><!--/.row-->
            </div><!--/.container-->
        </div><!--/.blog-profile-view-wrap-->
    <?php }?>     
</div><!--/.header-wrap-->


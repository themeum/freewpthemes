<div class="topbar">
    <div class="container">
        <div class="row">
            <?php  
            $topbaremail = get_theme_mod( 'topbar_email', 'support@themeum.com' );
            $topbarphone = get_theme_mod( 'topbar_phone', '+00 44 123 456 78910' );
            $topbarsocial = get_theme_mod( 'topbar_social', false );
            $topbarlogin = get_theme_mod( 'topbar_login', true );

            $topbarvari = get_theme_mod( 'topbar_variations', 'topbar_v1' );

            if ( $topbarvari == 'topbar_v1' ) { ?>
                <?php if ( $topbaremail || $topbarphone ) {  ?>
                    <div class="col-sm-9">
                        <div class="topbar-contact">
                            <span><a href="tel:<?php echo esc_attr($topbarphone); ?>"><i class="fa fa-phone"></i> <?php echo esc_html($topbarphone);?></a></span>
                            <span><a href="mailto:<?php print $topbaremail;?>"><i class="fa fa-envelope-o"></i> <?php print $topbaremail;?></a></span>
                        </div>
                    </div>
                <?php } ?>    
                <?php  if ( $topbarlogin ) {  ?>
                    <div class="col-sm-3 text-right">
                        <?php if ( is_user_logged_in() ) { ?>
                            <a class="topbar-login" href="<?php echo wp_logout_url( esc_url( home_url('/') ) ); ?>"><i class="fa fa-sign-out"></i><?php esc_html_e('Logout','calcio'); ?></a>
                        <?php } else { ?>
                            <span class="topbar-login">
                                <a href="#sign-in" data-toggle="modal" data-target="#sign-in" class="educon-login-url"><i class="fa fa-sign-in"></i> <?php esc_html_e('Login','calcio'); ?></a>
                                <a href="<?php echo esc_url(get_permalink(get_option('register_page_id'))); ?>"><i class="fa fa-user-o"></i> <?php esc_html_e('Sign Up','calcio'); ?></a>    
                            </span>                             
                        <?php } ?>
                    </div>
                <?php } ?>

            <?php } elseif ( $topbarvari == 'topbar_v2' ) { ?>

                <?php if ( $topbaremail || $topbarphone ) {  ?>
                    <div class="col-sm-5">
                        <div class="topbar-contact">
                            <span><a href="tel:<?php echo esc_attr($topbarphone); ?>"><i class="fa fa-phone"></i> <?php echo esc_attr($topbarphone);?></a></span>
                            <span><a href="mailto:<?php print $topbaremail;?>"><i class="fa fa-envelope-o"></i> <?php print $topbaremail;?></a></span>
                        </div>
                    </div>
                <?php } ?>    
                
                <div class="col-sm-7 text-right">
                    <div class="topbar-menu">
                        <?php 
                            wp_nav_menu(  array(
                                'theme_location' => 'topmenu',
                                'container'      => '', 
                                'menu_class'     => 'topnav',
                                'fallback_cb'    => 'wp_page_menu',
                                'depth'          => 4,
                            )); 
                        ?>
                    </div>
                    <?php  if ( $topbarlogin ) {  ?>
                        <?php if ( is_user_logged_in() ) { ?>
                            <a class="topbar-login" href="<?php echo wp_logout_url( esc_url( home_url('/') ) ); ?>"><i class="fa fa-sign-out"></i><?php esc_html_e('Logout','calcio'); ?></a>
                        <?php } else { ?>
                            <span class="topbar-login">
                                <a href="#sign-in" data-toggle="modal" data-target="#sign-in" class="educon-login-url"><i class="fa fa-sign-in"></i> <?php esc_html_e('Login','calcio'); ?></a>
                                <a href="<?php echo esc_url(get_permalink(get_option('register_page_id'))); ?>"><i class="fa fa-user-o"></i> <?php esc_html_e('Sign Up','calcio'); ?></a>    
                            </span>                                  
                        <?php } ?>
                    <?php } ?>
                </div>

            <?php } elseif ( $topbarvari == 'topbar_v3' ) { ?>
                
                <div class="col-sm-5">
                <?php
                    if ( $topbarsocial ) {
                        get_template_part('lib/social-link');
                    }
                ?>   
                </div>
                
                <div class="col-sm-7 text-right">
                    <div class="topbar-menu">
                        <?php 
                            wp_nav_menu(  array(
                                'theme_location' => 'topmenu',
                                'container'      => '', 
                                'menu_class'     => 'topnav',
                                'fallback_cb'    => 'wp_page_menu',
                                'depth'          => 4,
                            )); 
                        ?>
                    </div>
                </div>

             <?php } ?>
             
        </div>
    </div>
</div>
<!-- sign in form -->
<div id="sign-form">
     <div id="sign-in" class="modal fade">
        <div class="modal-dialog modal-md">
             <div class="modal-content">
                 <div class="modal-header">
                     <i class="fa fa-close close" data-dismiss="modal"></i>
                 </div>
                 <div class="modal-body text-center">
                     <h3 class="login-form-title"><?php esc_html_e('Welcome','calcio'); ?></h3>
                     <form id="login" action="login" method="post">
                        <div class="login-error alert alert-info" role="alert"></div>
                        <input type="text"  id="username" name="username" class="form-control" placeholder="<?php esc_attr_e('User Name','calcio'); ?>">
                        <input type="password" id="password" name="password" class="form-control" placeholder="<?php esc_attr_e('Password','calcio'); ?>">
                        <input type="submit" class="btn btn-primary btn-block submit_button"  value="Login" name="submit">
                        <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><strong><?php esc_html_e('Forgot password?','calcio'); ?></strong></a>
                        <p><?php esc_html_e('Not a member?','calcio'); ?> <a href="<?php echo esc_url(get_permalink(get_option('register_page_id'))); ?>"><strong><?php esc_html_e('Join today','calcio'); ?></strong></a></p>
                        <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                     </form>
                 </div>
             </div>
         </div> 
     </div>
</div> <!-- end sign-in form -->
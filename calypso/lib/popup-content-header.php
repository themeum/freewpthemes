<?php if ( !is_user_logged_in() ) : ?>
<!-- Login -->
<div class="modal fade" id="login" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php _e( 'Sign In', 'calypso' ); ?></h4>
                <p class="modal-text"><?php _e( 'Don\'t worry, we won\'t spam you <br> or sell your information.', 'calypso' ); ?></p>
            </div>
            <div class="modal-body">
                <form id="login" action="login" method="post">
                    <div class="login-error alert alert-danger" role="alert"></div>
                    <input type="text"  id="usernamelogin" name="username" class="form-control" placeholder="Username">
                    <input type="password" id="passwordlogin" name="password" class="form-control" placeholder="Password">
                    <input type="checkbox" id="rememberlogin" name="remember" ><label><?php _e( 'Remember me', 'calypso' ); ?></label>
                    <input type="submit" class="btn btn-primary submit_button"  value="Log In" name="submit">

                    <?php wp_nonce_field( 'ajax-login-nonce', 'securitylogin' ); ?>
                </form>
            </div>
            <div class="modal-footer clearfix d-block text-left">
                <div class="d-inline-block">
                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php echo esc_html__( 'Forgot password?', 'calypso' ); ?></a>
                </div>
                <div class="d-inline-block float-right">
                    <a data-toggle="modal" data-target="#registerlog" href="#" data-dismiss="modal" ><?php echo esc_html__( 'Sign Up', 'calypso' ); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Register -->
<div class="modal fade" id="registerlog" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php _e( 'Sign Up', 'calypso' ); ?></h4>
                <p class="modal-text"><?php _e( 'By signing up you agree to all the Terms and conditions.', 'calypso' ); ?></p>
            </div>
            <div class="modal-body">
                <form id="register" action="login" method="post">
                    <div class="login-error alert alert-danger" role="alert"></div>
                    <input type="text" id="username" name="username" class="form-control" placeholder="<?php _e( 'Username', 'calypso' ); ?>">
                    <input type="text" id="email" name="email" class="form-control" placeholder="<?php _e( 'Email', 'calypso' ); ?>">
                    <input type="password" id="password" name="password" class="form-control" placeholder="<?php _e( 'Password', 'calypso' ); ?>">
                    <input type="submit" class="btn btn-primary submit_button"  value="Register" name="submit">
                    <?php wp_nonce_field( 'ajax-register-nonce', 'security' ); ?>
                </form>
            </div>
            <div class="modal-footer clearfix d-block text-left">
                <div class="d-inline-block">
                    <a data-toggle="modal" data-target="#login" href="#" data-dismiss="modal" ><?php _e( 'Sign In', 'calypso' ); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<!-- Full Screen Search -->
<div class="thm-fullscreen-search d-flex flex-wrap justify-content-center align-items-center">
    <div class="search-overlay"></div>
    <form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
        <input class="main-font" type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_html_e('Search here...', 'calypso'); ?>" autocomplete="off" />
        <input type="submit" value="submit" class="d-none" id="thm-search-submit">
        <label for="thm-search-submit"><i class="fa fa-search"></i></label>
    </form>
</div> <!--/ .full-screen-search -->

<!-- Modal -->
<div class="modal fade confirm-modal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Log Out!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure want to logout?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a  href="<?php  echo wp_logout_url(); ?>" class="btn btn-danger thm-logout-button">Log Out</a>
      </div>
    </div>
  </div>
</div>
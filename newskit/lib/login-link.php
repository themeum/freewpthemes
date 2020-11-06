   <div class="login-link col-newskit  d-inline-block">
    <?php if ( !is_user_logged_in() ): ?>
      <a data-toggle="modal" data-target="#myModal" href="#"><i class="newskit newskit-user"></i>Sign In</a>
      <!-- <a  data-toggle="modal" data-target="#registerlog" href="#">Sign Up</a> -->
    <?php else: ?>
        <!-- <a href=" <?php echo wp_logout_url(); ?> "><i class="fa fa-sign-out"></i>Logout</a> -->
        <a class="my-account" href=" <?php echo admin_url(); ?> "><i class="fa fa-user-circle"></i>MY ACCOUNT</a>
        <span class="log-out-btn">
          <a class="my-profile" href=" <?php echo admin_url(); ?> ">Your Profile</a>
        	<a href=" <?php echo wp_logout_url(); ?> ">Logout</a>
        </span>
    <?php endif; ?>
</div>
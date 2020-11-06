   <div class="login-link col-floox">
    <?php if ( !is_user_logged_in() ): ?>
      <a data-toggle="modal" data-target="#myModal" href="#"><i class="fa fa-user-circle-o"></i>Login</a>
      <a  data-toggle="modal" data-target="#registerlog" href="#">Sign Up</a>
    <?php else: ?>
        <a href=" <?php echo wp_logout_url(); ?> "><i class="fa fa-sign-out"></i>Logout</a>
        <a href=" <?php echo admin_url(); ?> ">Dashboard</a>
    <?php endif; ?>
</div>
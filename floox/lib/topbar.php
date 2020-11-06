<?php
  $topbarsocial = get_theme_mod( 'topbar_social', false );
  $topbar_login = get_theme_mod( 'topbar_login', false );
?>
<div class="header-top">
  <div class="row">
    <div class="col-12 col-sm-6 text-center text-sm-left d-sm-flex align-items-center">
      <div class="header-top-contact">

        <?php if ( get_theme_mod( 'header_email', true )) { ?>
            <span>Email: <?php echo wp_kses_post(balanceTags( get_theme_mod( 'header_email', 'Info@floox.com') )); ?></span>
        <?php }?>
        <?php if ( get_theme_mod( 'header_phone', true )) { ?>
            <span>Mobile: <?php echo wp_kses_post(balanceTags( get_theme_mod( 'header_phone', '+123 456 789') )); ?></span>
        <?php }?>
        <!-- <span>Email Info@floox.com</span> -->
       <!--  <span>Mobile +123 456 789</span> -->
      </div>
    </div>
    <div class="col-12 col-sm-6">
      <div class="header-top-right text-center text-sm-right">
        <?php
            if ( $topbarsocial ) {
                get_template_part('lib/social-link');
            }
        ?>
        <?php
          if($topbar_login ){
            get_template_part('lib/login-link');
          }
         ?>

      </div>
    </div>
  </div>
</div>

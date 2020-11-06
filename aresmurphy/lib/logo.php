<div class="themeum-navbar-header">
    <a class="themeum-navbar-brand" href="<?php echo esc_url(site_url()); ?>">
        <?php
            $logoimg = get_theme_mod( 'logo', get_template_directory_uri().'/images/logo.png' );
            $logotext = get_theme_mod( 'logo_text', 'aresmurphy' );
            $logotype = get_theme_mod( 'logo_style', 'logoimg' );
            switch ($logotype) {
              case 'logoimg':
                  if( !empty($logoimg) ) {?>
                      <img class="enter-logo img-responsive" src="<?php echo esc_url( $logoimg ); ?>" alt="<?php  esc_html_e( 'Logo', 'aresmurphy' ); ?>" title="<?php  esc_html_e( 'Logo', 'aresmurphy' ); ?>">
                  <?php }else{?>
                      <h1> <?php  echo esc_html(get_bloginfo('name'));?> </h1>
                  <?php }
                break;                       

                case 'logotext':
                  if( $logotext ) { ?>
                      <h1> <?php echo esc_html( $logotext ); ?> </h1>
                  <?php }
                  else
                  {?>
                    <h1><?php  echo esc_html(get_bloginfo('name'));?> </h1>
                  <?php }
                break;
              
              default:
                if( $logotext ) { ?>
                    <h1> <?php echo esc_html( $logotext ); ?> </h1>
                <?php }
                else
                {?>
                  <h1><?php  echo esc_html(get_bloginfo('name'));?> </h1>
                <?php }
                break;
            } ?>
    </a>
</div> 

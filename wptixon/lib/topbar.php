<div class="topbar">
    <div class="container">
        <div class="row">
            <?php  
            $topbaremail = get_theme_mod( 'topbar_email', 'support@themeum.com' );
            $topbarphone = get_theme_mod( 'topbar_phone', '+00 44 123 456 78910' );
            $topbarsocial = get_theme_mod( 'topbar_social', false );
            if ( $topbaremail || $topbarphone ) {  ?>
                <div class="col-sm-9">
                    <div class="topbar-contact">
                        <span><strong><?php  esc_html_e( 'Call Us: ', 'wptixon' ); ?></strong><?php echo esc_attr($topbarphone);?></span>
                        <span><strong><?php  esc_html_e( 'Email: ', 'wptixon' ); ?></strong><?php print $topbaremail;?></span>
                    </div>
                </div>
            <?php } ?>    
            <?php  if ( $topbarsocial ) {  ?>
                <div class="col-sm-3 text-right">
                    <?php get_template_part('lib/social-link')?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
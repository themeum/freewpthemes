<?php  

$headerstyle = get_theme_mod( 'header_layout', 'portfolio' );

if ($headerstyle == 'portfolio') {
    ?>
    <div class="header-wrap layout-view-<?php echo $headerstyle; ?>">
        <header id="masthead" class="site-header header sticky-header">
            <div class="main-menu-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-3">
                            <?php get_template_part('lib/logo');?>
                        </div><!--/.col-sm-3--> 
                        <div class="col-xs-12 col-sm-12 col-md-9">
                            <?php get_template_part('lib/navbar');?>
                        </div><!--/.col-sm-9--> 
                        <div class="text-right clearfix">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                              <i class="fa fa-bars"></i>
                            </button>  
                        </div>
                    </div><!--/.row--> 
                </div><!--/.container-->
            </div><!--/.main-menu-wrap-->  
        </header><!--/.header-->  
    </div>
    <?php

} elseif ($headerstyle == 'photography') { ?>
    <div class="header-wrap layout-view-<?php echo $headerstyle; ?>">
        <header id="masthead" class="site-header header sticky-header">
            <div class="main-menu-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-3">
                            <?php get_template_part('lib/logo');?>
                        </div><!--/.col-sm-3--> 
                        <div class="col-xs-12 col-sm-12 col-md-9">
                            <?php get_template_part('lib/navbar');?>
                        </div><!--/.col-sm-9--> 
                        <div class="text-right clearfix">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                              <i class="fa fa-bars"></i>
                            </button>  
                        </div> 
                    </div><!--/.row--> 
                </div><!--/.container-->
            </div><!--/.main-menu-wrap-->  
        </header><!--/.header-->  
    </div><!--/.header-wrap-->    

<?php } elseif ($headerstyle == 'individual') {?>

    <div class="header-wrap layout-view-<?php echo $headerstyle; ?>">
        <header id="masthead" class="site-header header sticky-header">
            <div class="main-menu-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-sm-5 col-md-3">
                            <?php get_template_part('lib/logo');?>
                        </div><!--/.col-sm-3--> 
                        <div class="col-xs-12 col-sm-12 col-md-9">
                            <?php get_template_part('lib/navbar');?>
                        </div><!--/.col-sm-9--> 
                        <div class="text-right clearfix">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                              <i class="fa fa-bars"></i>
                            </button>  
                        </div>  
                    </div><!--/.row--> 
                </div><!--/.container-->
            </div><!--/.main-menu-wrap-->  
        </header><!--/.header-->  
    </div><!--/.header-wrap-->    

<?php } elseif ($headerstyle == 'resume') {?>
    <div id="home-wrapper" class="header-wrap layout-view-<?php echo $headerstyle; ?>">
        <?php 
        $output = ''; 
        $profileimg = get_theme_mod( 'resume_banner', get_template_directory_uri().'/images/resume-slider-bg.jpg' );
        $resumetitle = get_theme_mod( 'resume_title', 'Hello, I am Ares Murphy' );
        $resumedesc = get_theme_mod( 'resume_desc', 'UI & UX DESIGNER @ JOOMSHAPER LLC' );
        $resumedesign = get_theme_mod( 'resume_design', '' );
        $resumemobile = get_theme_mod( 'resume_mobile', '' );
        $resumeemail = get_theme_mod( 'resume_email', '' );
        $resumeaddress = get_theme_mod( 'resume_address', '' );
        $resumeshare = get_theme_mod( 'resume_share', true );

        if( $profileimg ){
            $output = 'style="background-image:url('.esc_url( $profileimg ).');background-size: cover;background-position: 50% 50%;"';
        }else{
            $output = 'style="background-color:#333;"';
        }
        ?>
        <div class="resume-banner" <?php print $output;?>>
            <div class="container">
                <?php if ($resumeshare) { ?>
                    <div class="text-right resume-social-link">
                        <?php get_template_part('lib/social-link');?>
                    </div><!--/.resume-social-link-->
                <?php } ?>
                <?php if( $resumetitle || $resumedesc ) { ?>
                    <div class="text-center resume-middle">
                        <?php if( $resumetitle ) { ?>
                            <h2 class="resume-profile-title"><?php echo wp_kses_post($resumetitle); ?></h2>
                        <?php } ?>  
                        <?php if( $resumedesc ) { ?>  
                            <div class="resume-profile-desc"><?php echo wp_kses_post($resumedesc); ?></div>
                        <?php } ?> 
                    </div><!--/.resume-middle-->
                <?php } ?>  
                <?php if ( $resumedesign || $resumemobile || $resumeemail || $resumeaddress ) { ?>
                    <div class="resume-footer">
                        <div class="row">
                            <?php if ( $resumedesign ) { ?>
                                <div class="col-xs-6 col-sm-6 col-md-3">
                                    <div class="resume-design">
                                        <?php echo wp_kses_post($resumedesign); ?>
                                    </div>
                                </div>
                            <?php } ?>                       

                            <?php if ( $resumemobile ) { ?>
                                <div class="col-xs-6 col-sm-6 col-md-3">
                                    <div class="resume-mobile">
                                        <?php echo wp_kses_post($resumemobile); ?>
                                    </div>
                                </div>
                            <?php } ?>                        

                            <?php if ( $resumeemail ) { ?>
                                <div class="col-xs-6 col-sm-6 col-md-3">
                                    <div class="resume-email">
                                        <?php echo wp_kses_post($resumeemail); ?>
                                    </div>
                                </div>
                            <?php } ?>                        

                            <?php if ( $resumeaddress ) { ?>
                                <div class="col-xs-6 col-sm-6 col-md-3">
                                    <div class="resume-address">
                                        <?php echo wp_kses_post($resumeaddress); ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>    
                    </div><!--/.resume-footer--> 
                <?php } ?>    
            </div><!--/.container-->
        </div><!--/.resume-banner-->
        <header id="masthead" class="site-header header sticky-header">
            <div class="resume-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="main-menu-wrap">
                                <?php get_template_part('lib/navbar');?>
                                <div class="text-center clearfix">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                      <i class="fa fa-bars"></i>
                                    </button>  
                                </div> 
                            </div>
                        </div><!--/.col-sm-12--> 
                    </div><!--/.row--> 
                </div><!--/.container--> 
            </div><!--/.resume-menu--> 
        </header> 
    </div>
<?php } elseif ($headerstyle == 'blog') { ?>

    <div class="header-wrap layout-view-<?php echo $headerstyle; ?>">
        <header id="masthead" class="site-header header">
            <div class="container">
                <div class="logo-wrap">
                    <div class="row">
                        <div class="col-xs-4 col-sm-3 col-md-2">
                            <?php get_template_part('lib/social-link');?>
                        </div>
                        <div class="col-xs-4 col-sm-6 col-md-8 text-center">
                            <?php get_template_part('lib/logo');?>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-2 text-right">
                            <?php get_template_part('lib/home-search');?>
                        </div>
                    </div><!--/.row--> 
                </div><!--/.logo-wrap--> 
            </div><!--/.container-->     
        </header><!--/.header-->         
        <div class="main-menu-wrap sticky-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <?php get_template_part('lib/navbar');?>
                        <div class="text-center clearfix">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                              <i class="fa fa-bars"></i>
                            </button>  
                        </div> 
                    </div><!--/.col-sm-12--> 
                </div><!--/.row--> 
            </div><!--/.container-->
        </div><!--/.main-menu-wrap-->     
    </div><!--/.header-wrap-->

<?php } else {


}
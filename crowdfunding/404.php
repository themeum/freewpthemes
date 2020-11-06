<?php get_header('alternative'); 
/*
*Template Name: 404
*/
global $themeum_options;
?>
<section id="error-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center wow fadeIn">
                <p><img src="<?php echo esc_url($themeum_options['errorpage']['url']); ?>" class="wow pulse" data-wow-delay=".25s"></p>
                <h4><?php  _e( 'Were sorry, but the page you were looking for doesnt exist.', 'crowdfunding' ); ?></h4>
                <div class="errorpage-search">
                    <form method="GET" action="<?php echo esc_url(site_url()); ?>">
                        <input type="text" name="s" placeholder="<?php _e('Search','crowdfunding'); ?>">
                        <button type="submit"><i class="fa fa-arrow-circle-right"></i></button>
                    </form>
                </div>
                <div class="clearfix"></div>
                <p class="home-icon">
                    <a href="<?php echo esc_url(site_url()); ?>" class="btn btn-primary"><?php echo __('Back to Home','crowdfunding'); ?></a>
                </p>
                <p class="copy-right"><?php if (isset($themeum_options['comingsoon-copyright'])) echo $themeum_options['comingsoon-copyright']; ?></p>
            </div>
        </div>
    </div>
</section>

<?php get_footer('alternative'); ?>

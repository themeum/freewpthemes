<?php global $themeum_options; ?>

<header class="page-header">
    <h1 class="page-title"><?php _e( 'Nothing Found', 'crowdfunding' ); ?></h1>
</header>

<div class="page-content">
    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>

    <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'crowdfunding' ), esc_url(admin_url( 'post-new.php' )) ); ?></p>

    <?php } elseif ( is_search() ) { ?>

    <p class="text-center"><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'crowdfunding' ); ?></p>
    <?php 
       if(isset($_GET['post_type'])){
            ?>
            <div class="course-search col-md-offset-2 col-sm-12 col-md-8">
                <form role="search" action="<?php echo esc_url(site_url('/')); ?>" method="get">
                    <input class="custom-input" type="search" name="s" placeholder="Find Project"/>
                    <input type="hidden" name="post_type" value="product" />
                    <input type="submit" alt="Search" value="" class="transparent-button" />
                </form>
            </div>
            <?php
        }else{
            get_search_form();
        }  
    ?>

    <?php } else { ?>

    <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'crowdfunding' ); ?></p>
    <?php get_search_form(); ?>

    <?php } ?>
</div><!-- .page-content -->
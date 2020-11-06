<?php get_header(); ?>

<section id="main">
    <div class="container">
        <div class="row">
            <?php get_template_part('lib/sub-header')?>

            <div id="content" class="taxonomy-team-group  site-content col-sm-12" role="main">
                <div class="style2 themeum-player-listing">
                    <?php    
                        if ( have_posts() ) : ?>
                            <div class="player-wrap"> 
	                            <?php
	                                while ( have_posts() ) : the_post();
	                                    ?>
	                                    <div class="col-xs-12 col-sm-6 col-md-4">
	                                        <div class="team-group-taxonomy">
	                                            <div class="team-intro">
	                                                <p class="team-club"><?php echo get_the_term_list(get_the_id(''), 'team_group'); ?></p>
	                                                <h4 class="team-title"><a href="<?php echo get_permalink(); ?>" style=""><?php echo the_title(); ?></a></h4>
	                                            </div>
	                                        </div>
	                                    </div>
	                            <?php endwhile; ?>
                            </div>
                        <?php
                        else:
                            get_template_part( 'post-format/content', 'none' );
                        endif; ?>
                   
                </div> <!-- .themeum-player-listing -->
            </div> <!-- .site-content -->
        </div>
    </div> <!-- .container --> 
</section> <!-- #main -->

<?php get_footer();
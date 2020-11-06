<?php get_header();

$sidebarstyle = get_theme_mod('blog_sidebar_style', 'right');
if(get_theme_mod('blog_sidebar', true)){
	$col = '8';
}else{
	$col = '12';
}
?>

    <section id="main" class="generic-padding">
		<?php get_template_part('lib/sub-header')?>
        <div class="container inner-padding">
            <div class="row">
				<?php if($sidebarstyle == 'left' && get_theme_mod('blog_sidebar', true)){
					get_sidebar();
				} ?>
                <div id="content" class="site-content col-md-<?php echo $col; ?>" role="main">
					<?php
					$paged      = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args       = array(
						'post_type' => 'post',
						'paged'     => $paged
					);
					$thequery   = new WP_Query($args);
					$index      = 1;
					$col        = get_theme_mod( 'blog_column', 12 );

					if ( $thequery->have_posts() ) :
						echo '<div class="row">';
						while ( $thequery->have_posts() ) : $thequery->the_post(); ?>
                            <div class="col-md-6">
                                <div class="fitgym-postbox">
									<?php get_template_part( 'post-format/content', get_post_format() ); ?>
                                </div>
                            </div>
						<?php
						endwhile;
						echo '</div>';
					else:
						get_template_part( 'post-format/content', 'none' );
					endif;
					wp_reset_postdata();

					if($index !=  1 ){ ?>
                </div>
			<?php }
			$page_numb = max( 1, get_query_var('paged') );
			$max_page = $thequery->max_num_pages;
			fitgym_pagination( $page_numb, $max_page );
			?>
            </div><!-- content -->
			<?php if($sidebarstyle == 'right' && get_theme_mod('blog_sidebar', true)){
				get_sidebar();
			} ?>
        </div>

    </section> <!-- #main -->

<?php get_footer();
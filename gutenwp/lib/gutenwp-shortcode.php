<?php 
	$shortcode_style = get_theme_mod('shortcode_style', 'style1');
    if ($shortcode_style == 'style1') { ?>
	    <?php if( get_theme_mod('instragram_post')): ?>
		    <div class="instragram-entries">
		    	<div class="container">
		    		<?php if (get_theme_mod('instragram_title')): ?>
			    	<div class="row">
			    		<div class="addon-article intro-item-wrapper col-md-12">
			        		<h3><?php echo get_theme_mod('instragram_title'); ?></h3>
			    		</div>
				    </div>
		    		<?php endif ?>
				    <div class="instragram-post-section">
				        <?php echo do_shortcode(get_theme_mod( 'instragram_post' )); ?>
				    </div>
			    </div>
			</div>
	    <?php endif; ?>
    <?php }elseif ($shortcode_style == 'style3') { ?>
    	<?php if( get_theme_mod('instragram_post')): ?>
		    <div class="instragram-entries" style="margin-top: 130px; margin-bottom: 30px;">
	    		<?php if (get_theme_mod('instragram_title')): ?>
		    	<div class="row">
		    		<div class="addon-article intro-item-wrapper col-md-12">
		        		<h3><?php echo get_theme_mod('instragram_title'); ?></h3>
		    		</div>
			    </div>
	    		<?php endif ?>
			    <div class="instragram-post-section">
			        <?php echo do_shortcode(get_theme_mod( 'instragram_post' )); ?>
			    </div>
			</div>
	    <?php endif;
    } else { ?>
    	<?php if( get_theme_mod('instragram_post')): ?>
		    <div class="instragram-entries full-width">
		    	<div class="container">
				    <div class="row">
		    			<?php if (get_theme_mod('instragram_title')): ?>
				    	
				    	<div class="addon-article intro-item-wrapper col-md-6">
				        	<h3 class="intro"><?php echo get_theme_mod('instragram_title'); ?></h3>
				    	</div>
					    
		    			<?php endif ?>

					    <div class="instragram-post-section col-md-6">
					        <?php echo do_shortcode(get_theme_mod( 'instragram_post' )); ?>
					    </div>
				    </div>
			    </div>
			</div>
	    <?php endif; ?>
    <?php } ?>
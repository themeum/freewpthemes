<?php global $themeum_options; ?>

<?php if ( isset($themeum_options['sidebar-share']) && $themeum_options['sidebar-share'] ) {?>
	<div class="social-share">
		<ul>
			<?php if ( isset($themeum_options['sidebar-facebook']) && $themeum_options['sidebar-facebook'] ){?>	
				<li><a class="facebook" href="<?php echo esc_url($themeum_options['sidebar-facebook']); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
			<?php }?>
			<?php if ( isset($themeum_options['sidebar-twitter']) && $themeum_options['sidebar-twitter']){?>	
				<li><a class="twitter" href="<?php echo esc_url($themeum_options['sidebar-twitter']); ?>" target="_blank" ><i class="fa fa-twitter"></i></a></li>
			<?php }?>
			<?php if ( isset($themeum_options['sidebar-gplus']) && $themeum_options['sidebar-gplus'] ){?>		
				<li><a class="g-plus" href="<?php echo esc_url($themeum_options['sidebar-gplus']); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			<?php }?>
			<?php if ( isset($themeum_options['sidebar-linkedin']) && $themeum_options['sidebar-linkedin'] ){?>
				<li><a class="linkedin" href="<?php echo esc_url($themeum_options['sidebar-linkedin']); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
			<?php }?>
			<?php if ( isset($themeum_options['sidebar-pinterest']) && $themeum_options['sidebar-pinterest'] ){?>
				<li><a class="pinterest" href="<?php echo esc_url($themeum_options['sidebar-pinterest']); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
			<?php }?>
			<?php if ( isset($themeum_options['sidebar-delicious']) && $themeum_options['sidebar-delicious'] ){?>	
				<li><a class="delicious" href="<?php echo esc_url($themeum_options['sidebar-delicious']); ?>" target="_blank"><i class="fa fa-delicious"></i></a></li>
			<?php }?>
			<?php if ( isset($themeum_options['sidebar-tumblr']) && $themeum_options['sidebar-tumblr'] ){?>	
				<li><a class="tumblr" href="<?php echo esc_url($themeum_options['sidebar-tumblr']); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
			<?php }?>
			<?php if ( isset($themeum_options['sidebar-stumbleupon']) && $themeum_options['sidebar-stumbleupon'] ){?>	
				<li><a class="stumbleupon" href="<?php echo esc_url($themeum_options['sidebar-stumbleupon']); ?>" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>
			<?php }?>	 
		</ul>
	</div>
<?php }?>




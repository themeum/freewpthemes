<?php
$permalink = get_permalink(get_the_ID());
$titleget = get_the_title();
?>

<div class="social-button">
	<ul>
		<li>
			<a class="facebook" onClick="window.open('https://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink);?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="https://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink);?>"><i class="fa fa-facebook"></i></a>
		</li>
		<li>
			<a class="twitter" onClick="window.open('https://twitter.com/share?url=<?php echo esc_url($permalink); ?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?>','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="https://twitter.com/share?url=<?php echo esc_url($permalink); ?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?>"><i class="fa fa-twitter"></i></a>
		</li>
		<li>
			<a class="linkedin" onClick="window.open('https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($permalink); ?>','Linkedin','width=863,height=500,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($permalink); ?>"><i class="fa fa-linkedin"></i></a>
		</li>
		
	</ul>
</div>

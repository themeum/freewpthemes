<?php
$permalink = get_permalink(get_the_ID());
$titleget = get_the_title();
?>

<div class="social-button">

	<ul>
		<li>
			<a class="facebook" onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink);?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink);?>"><i class="fa fa-facebook"></i></a>
		</li>
		<li>
			<a class="twitter" onClick="window.open('http://twitter.com/share?url=<?php echo esc_url($permalink); ?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?>','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://twitter.com/share?url=<?php echo esc_url($permalink); ?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?>"><i class="fa fa-twitter"></i></a>
		</li>
		<li>
			<a class="g-puls" onClick="window.open('https://plus.google.com/share?url=<?php echo esc_url($permalink); ?>','Google plus','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;" href="https://plus.google.com/share?url=<?php echo esc_url($permalink); ?>"><i class="fa fa-google-plus"></i></a>
		</li>
		<li>
			<a class="linkedin" onClick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($permalink); ?>','Linkedin','width=863,height=500,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($permalink); ?>"><i class="fa fa-linkedin"></i></a>
		</li>
		<li>
			<a class="pinterest" href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'><i class="fa fa-pinterest"></i></a>
		</li>
	</ul>
</div>

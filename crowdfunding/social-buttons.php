<?php
$permalink = get_permalink(get_the_ID());
$titleget = get_the_title();
?>

<div class="social-button">
	<ul>
		<li>
			<a class="facebook" onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink); ?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink);?>"><i class="fa fa-facebook"></i></a>
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
		<li>
			<a class="envelope" href="mailto:?Subject=<?php echo str_replace(" ", "%20", $titleget); ?>&amp;Body=<?php echo esc_url($permalink); ?>"><i class="fa fa-envelope-o"></i></a>
		</li>
		<li>
			<a class="stumbleupon" onClick="window.open('http://www.stumbleupon.com/submit?url=<?php echo esc_url($permalink); ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>','Stumbleupon','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.stumbleupon.com/submit?url=<?php echo esc_url($permalink); ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>"><i class="fa fa-stumbleupon"></i></a>
		</li>
		<li>
			<a class="digg" onClick="window.open('http://www.digg.com/submit?url=<?php echo esc_url($permalink); ?>','Digg','width=715,height=330,left='+(screen.availWidth/2-357)+',top='+(screen.availHeight/2-165)+''); return false;" href="http://www.digg.com/submit?url=<?php echo esc_url($permalink); ?>"><i class="fa fa-digg"></i></a>
		</li>
		<li>
			<a class="reddit" onClick="window.open('http://reddit.com/submit?url=<?php echo esc_url($permalink); ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>','Reddit','width=617,height=514,left='+(screen.availWidth/2-308)+',top='+(screen.availHeight/2-257)+''); return false;" href="http://reddit.com/submit?url=<?php echo esc_url($permalink); ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>"><i class="fa fa-reddit"></i></a>
		</li>
	</ul>
</div>

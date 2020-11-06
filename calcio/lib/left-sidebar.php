
<div id="sidebar-left" class="col-sm-3 row-order-2" role="complementary">
    <aside class="widget-area">
        <?php 
	        if ( is_active_sidebar( 'left_sidebar' ) ) {
	        	dynamic_sidebar('left_sidebar');
	        }
         ?>
    </aside>
</div> <!-- #sidebar -->
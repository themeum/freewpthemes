
<div id="sidebar-right" class="col-sm-3 row-order-3" role="complementary">
    <aside class="widget-area right-sidebar">
        <?php 
	        if ( is_active_sidebar( 'right_sidebar' ) ) {
	        	dynamic_sidebar('right_sidebar');
	        }
         ?>
    </aside>
</div> <!-- #sidebar -->
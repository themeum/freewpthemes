
    <?php if( is_active_sidebar('bottom') ){ ?>
        <div class="bottom">
            <div class="container">
                <div class="row clearfix">
                    <?php if (is_active_sidebar('bottom')) {?>
                        <?php dynamic_sidebar('bottom'); ?>
                    <?php } ?>
                </div>
            </div>
        </div><!--/#footer-->
    <?php } ?>
    </div> <!-- #page -->
<?php wp_footer(); ?>
</body>
</html>

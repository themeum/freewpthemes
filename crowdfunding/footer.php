<!-- start footer -->
<?php global $themeum_options; ?>
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <?php dynamic_sidebar('bottom-left'); ?>
            </div>
            <div class="col-sm-2">
                <?php dynamic_sidebar('bottom-category-1'); ?>
            </div>
            <div class="col-sm-2 mtt50">
                <?php dynamic_sidebar('bottom-category-2'); ?>
            </div>
            <div class="col-sm-2 mtt50">
                <?php dynamic_sidebar('bottom-category-3'); ?>
            </div>
            <div class="col-sm-3">
                <?php dynamic_sidebar('bottom-right'); ?>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->

    <?php if (isset($themeum_options['copyright-en']) && $themeum_options['copyright-en']){?>
        <div class="copyright">
            <div class="container">
                <div class="row text-center">
                    <div class="col-sm-12">
                        <?php if(isset($themeum_options['copyright-text'])) echo balanceTags($themeum_options['copyright-text']); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</footer>
</div> <!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
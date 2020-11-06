<!-- Single Page content -->
<div class="entry-summary clearfix">
    <?php 
        if ( is_single() ) {
            the_content();
        }
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'eventco' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
        ) );
    ?>
</div> <!-- //.entry-summary -->
<div class="post-meta-info-list-in tags-in">
    <?php the_tags('', '', '<br />'); ?>       
</div>



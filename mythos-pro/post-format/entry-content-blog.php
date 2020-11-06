<!-- Single Page content -->
<div class="entry-summary clearfix">
    <?php 
        if ( is_single() ) {
            the_content();
        }
        wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'mythos-pro' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
        ) ); 
    ?>

</div> <!-- .entry-summary -->

<?php 
    if (is_single()){              
        echo wp_kses_post(get_the_tag_list('<div class="post-tags-list">Tags: ',', ','</div>')); 
    }
?>


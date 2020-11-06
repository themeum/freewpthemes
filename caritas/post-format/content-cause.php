
<?php

$post_class = is_single() ? 'caritas-single-post' : 'caritas-post-listing';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>

    <div class="post-featured-image">
        <?php
        if(has_post_thumbnail()) {
            if(is_single()){
                the_post_thumbnail('caritas-large', array('class' => 'img-fluid'));
            }else{
                $col = get_theme_mod( 'blog_column', 12 );
                ?>
                <a href="<?php the_permalink(); ?>">
                    <?php
                    if($col == 3 || $col == 4){
                        the_post_thumbnail('caritas-blog-medium', array('class' => 'img-fluid'));
                    }
                    else{
                        the_post_thumbnail('caritas-large', array('class' => 'img-fluid'));
                    }
                    ?>
                </a>
                <?php
            }
        }
        ?>
    </div>


    <?php $post_content_class = is_single() ? 'post-single-content' : 'post-listing-content' ?>

    <div class="<?php echo $post_content_class; ?>">

        <!--  post title start-->
        <?php if(!is_single()) { ?>
            <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php } else{ ?>
            <h1 class="post-title"><?php the_title(); ?></h1>
        <?php } ?>
        <!--  post title end -->


        <div class="entry-blog">
            <?php
            get_template_part( 'post-format/entry-content-cause' );
            if ( get_theme_mod( 'blog_continue_en', true ) && !is_single() ) {
                if ( get_theme_mod( 'blog_continue', 'Read More' ) ) {
                    $continue = esc_html( get_theme_mod( 'blog_continue', 'Continue Reading' ) );
                    echo '<a class="blog-continue-btn" href="'.get_permalink().'">'. $continue .'</a>';
                }
            }
            ?>
        </div> <!--/.entry-meta -->
    </div>



</article><!--/#post-->
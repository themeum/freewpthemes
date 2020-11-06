
<?php

$post_class = is_single() ? 'caritas-single-post' : 'caritas-post-listing';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
    <?php
    $blog_author = get_theme_mod( 'blog_author', true );
    $blog_category = get_theme_mod( 'blog_category', false );
    $blog_comment = get_theme_mod( 'blog_comment', false );
    $blog_date = get_theme_mod( 'blog_date', false );
    $blog_tags = get_theme_mod( 'blog_tags', false );
    $blog_hit = get_theme_mod( 'blog_hit', false );

    $blog_author_single = get_theme_mod( 'blog_author_single', true );
    $blog_date_single = get_theme_mod( 'blog_date_single', true );
    $blog_category_single = get_theme_mod( 'blog_category_single', true );
    $blog_hit_single = get_theme_mod( 'blog_hit_single', true );
    $blog_tags_single = get_theme_mod( 'blog_tags_single', true );
    $blog_comment_single = get_theme_mod( 'blog_comment_single', true );

    ?>



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

        <?php
        $meta_show = $blog_category || $blog_tags || $blog_date || $blog_author || $blog_comment || $blog_hit;
        ?>

        <!-- post meta start -->
        <?php if(!is_single() && $meta_show) { ?>
            <div class="caritas-post-meta meta-top">
                <?php if ( $blog_category ): ?>
                    <div class="single-meta-item">
                        <i class="fa fa-folder"></i></i> <?php printf(esc_html__('%s', 'caritas'), get_the_category_list(', ')); ?>
                    </div>
                <?php endif; ?>
                <?php if ( $blog_tags ) { ?>
                    <div class="single-meta-item"><?php echo get_the_tag_list('<i class="fa fa-tags"></i> ',', ',''); ?></div>
                <?php } ?>
                <?php if($blog_date ) { ?>
                    <div class="single-meta-item">
                        <i class="fa fa-clock-o"></i>
                        <a href="<?php echo get_day_link( get_the_date('Y'), get_the_date('m'), get_the_date('d')); ?>"><?php echo get_the_date(); ?></a>
                    </div>
                <?php } ?>
                <?php if($blog_author ) { ?>
                    <div class="single-meta-item">
                        <i class="fa fa-user"></i>
                        by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('display_name'); ?></a>
                    </div>
                <?php } ?>
                <?php if($blog_comment ) { ?>
                    <div class="single-meta-item">
                        <i class="fa fa-comments"></i>
                        <a href="<?php echo get_comments_link( get_the_ID() ); ?>"></i> <?php comments_number( '0', '1', '%' ); ?><?php esc_html_e(' Comments', 'caritas') ?></a>
                    </div>
                <?php } ?>
                <?php
                # blog Count Down
                $visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
                if( $visitor_count == '' ) $visitor_count = 0;

                if( $visitor_count >= 1000 ){
                    $visitor_count = round( ($visitor_count/1000), 2 );
                    $visitor_count = $visitor_count.'k';
                }
                ?>
                <?php if($blog_hit ) { ?>
                    <div class="single-meta-item">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        <span><?php esc_attr_e($visitor_count, 'caritas'); ?></span>
                    </div>
                <?php } ?>
            </div>
        <?php }else{ ?>
            <?php if ( $blog_category_single ): ?>
                <div class="caritas-post-meta">
                    <div class="single-meta-item">
                        <i class="fa fa-folder"></i></i> <?php printf(esc_html__('%s', 'caritas'), get_the_category_list(', ')); ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php } ?>
        <!-- post meta end-->

        <!--  post title start-->
        <?php if(!is_single()) { ?>
            <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php } else{ ?>
            <h1 class="post-title"><?php the_title(); ?></h1>
        <?php } ?>
        <!--  post title end -->

        <?php

        if(is_single()){
            $single_meta_show = $blog_author_single || $blog_date_single || $blog_hit_single || $blog_tags_single || $blog_comment_single;
            ?>
            <div class="caritas-post-meta meta-bottom">
                <?php if ( $blog_tags_single ) { ?>
                    <div class="single-meta-item"><?php echo get_the_tag_list('<i class="fa fa-tags"></i> ',', ',''); ?></div>
                <?php } ?>
                <?php if($blog_date_single ) { ?>
                    <div class="single-meta-item">
                        <i class="fa fa-clock-o"></i>
                        <a href="<?php echo get_day_link( get_the_date('Y'), get_the_date('m'), get_the_date('d')); ?>"><?php echo get_the_date(); ?></a>
                    </div>
                <?php } ?>
                <?php if($blog_author_single ) { ?>
                    <div class="single-meta-item">
                        <i class="fa fa-user"></i>
                        by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('display_name'); ?></a>
                    </div>
                <?php } ?>
                <?php if($blog_comment_single ) { ?>
                    <div class="single-meta-item">
                        <i class="fa fa-comments"></i>
                        <a href="<?php echo get_comments_link( get_the_ID() ); ?>"></i> <?php comments_number( '0', '1', '%' ); ?><?php esc_html_e(' Comments', 'caritas') ?></a>
                    </div>
                <?php } ?>
                <?php
                # blog Count Down
                $visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
                if( $visitor_count == '' ) $visitor_count = 0;

                if( $visitor_count >= 1000 ){
                    $visitor_count = round( ($visitor_count/1000), 2 );
                    $visitor_count = $visitor_count.'k';
                }
                ?>
                <?php if($blog_hit_single ) { ?>
                    <div class="single-meta-item">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        <span><?php esc_attr_e($visitor_count, 'caritas'); ?></span>
                    </div>
                <?php } ?>
            </div>

            <?php
        }

        ?>

        <div class="entry-blog">
            <?php
            get_template_part( 'post-format/entry-content' );
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
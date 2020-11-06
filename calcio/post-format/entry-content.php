
<!-- Blog Title -->
<div class="entry-header">
    <h2 class="entry-title blog-entry-title">
        <?php if(!is_single()) { ?>
        <p class="cat-list"><a href="<?php the_permalink(); ?>"><?php echo get_the_category_list(', '); ?></a></p>
        <?php } ?>
        <?php if ( is_single() ) { ?>
            <?php the_title(); ?>
        <?php } else { ?>
        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
        <?php } ?>
        <?php if ( is_sticky() && is_home() && ! is_paged()) { ?>
        <span class="featured-post"><i class="fa fa-star"></i></span>
        <?php } ?>
    </h2> <!-- .entry-title --> 
</div>
<!-- Blog title End --> 

<!-- Blog author & comments -->
<?php if(is_single()) : ?>
<?php if ( get_theme_mod( 'blog_author', true ) || get_theme_mod( 'blog_comment', true ) ) { ?>
    <ul class="blog-post-meta"> 
        <?php if ( get_theme_mod( 'blog_author', true ) ) { ?>
            <li class="meta-date">
            
                <span class="img-author"><i class="fa fa-user" aria-hidden="true"></i></span>
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"> <?php echo get_the_author_meta('display_name');?></a>
            </li>
        <?php }?>

        <!-- Blog date -->
        <?php if ( get_theme_mod( 'blog_date', true ) ) { ?>
            <li class="calcio-blog-date">
                <i class="fa fa-clock-o" aria-hidden="true"></i> 
                <?php $the_date = get_the_date(); ?>
                <span><?php echo date_i18n( get_option( 'date_format' ) , strtotime($the_date)) ?></span>
            </li>
        <?php } ?> 
        <!-- end date -->
        
        <?php if ( get_theme_mod( 'blog_category', true ) ) { ?>
            <li><i class="fa fa-eraser" aria-hidden="true"></i> <?php echo get_the_category_list(', '); ?></li>
        <?php }?>

        <!-- Comments section -->
        <?php if ( get_theme_mod( 'blog_comment', true ) ) { ?>
            <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
                <li class="meta-comment">
                    <i class="fa fa-commenting-o"></i>
                    <?php comments_popup_link( '<span class="leave-reply">' . esc_html__( '0', 'calcio' ) . '</span>', esc_html__( '1 comment', 'calcio' ), esc_html__( '% comments', 'calcio' ) ); ?>
                </li>
            <?php endif; ?>
        <?php }?> 
        <!-- comments section end -->
    </ul>

<?php } ?>

<?php endif;?>


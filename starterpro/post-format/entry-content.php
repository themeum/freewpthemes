<!-- Blog date -->
<?php if ( get_theme_mod( 'blog_date', true ) || get_theme_mod( 'blog_author', true ) ) { ?>
    <ul class="blog-post-meta">  
        <li class="meta-date">
            <?php if ( get_theme_mod( 'blog_author', true ) ) { ?>
                <span class="img-author"><?php echo get_avatar( get_the_author_meta( 'ID' ) , 32 ); ?></span>
                <?php if ( get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "" ) { ?>
                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('first_name');?> <?php echo get_the_author_meta('last_name');?></a>
                <?php } else { ?>
                    <?php the_author_posts_link() ?>  
                <?php }?>
            <?php }?>
            <?php if ( get_theme_mod( 'blog_date', true ) ) { ?>
                <time datetime="<?php echo get_the_date() ?>">/ <?php echo get_the_date(); ?></time>
            <?php } ?> 
        </li>
    </ul>
<?php } ?>    

<div class="entry-header">
    <h2 class="entry-title blog-entry-title">
        <?php if ( is_single() ) {?>
            <?php the_title(); ?>
        <?php } else { ?>
        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
        <?php }?>
        <?php if ( is_sticky() && is_home() && ! is_paged()) { ?>
        <span class="featured-post"><i class="fa fa-star"></i></span>
        <?php } ?>
    </h2> <!-- //.entry-title --> 
</div> 

<!-- Blog date -->
<?php if ( get_theme_mod( 'blog_category', false ) ) { ?>
    <div class="meta-category">
        <i class="fa fa-folder-open-o"></i>
        <?php echo get_the_category_list(' '); ?>
    </div>
<?php } ?>

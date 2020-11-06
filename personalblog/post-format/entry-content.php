<div class="entry-header">
    <?php if ( is_single() ) {?>
        <h1 class="entry-title blog-entry-title">
            <?php the_title(); ?>
            <?php if ( is_sticky() && is_home() && ! is_paged()) { ?>
            <span class="featured-post"><i class="fa fa-star"></i></span>
            <?php } ?>                
        </h1> <!-- //.entry-title --> 
    <?php } else { ?>
        <h2 class="entry-title blog-entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
            <?php if ( is_sticky() && is_home() && ! is_paged()) { ?>
            <span class="featured-post"><i class="fa fa-star"></i></span>
            <?php } ?>
        </h2>
    <?php }?>
    <ul class="blog-post-meta">     
        <?php if ( get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "" ) { ?>
            <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('first_name');?> <?php echo get_the_author_meta('last_name');?></a></li>
        <?php } else { ?>
            <li><?php the_author_posts_link() ?> </li>
        <?php }?>
        <li><a href="<?php the_permalink(); ?>"><time datetime="<?php echo get_the_date('j F Y') ?>"><?php echo get_the_date('j F Y'); ?></time></a></li>
        <li><?php echo get_the_category_list(' '); ?></li>
    </ul>     
</div>



<?php get_header();?>

<section id="main">
    <?php 

    while( have_posts() ): the_post(); 

        $terms    = get_the_terms(  get_the_ID(), 'portfolio-cat' );
                $term_name  = '';
                if (is_array( $terms )) {
                    foreach ( $terms as $term ) {
                        $term_name .= ' '.$term->slug;
                    }
                }
                # category list
                $terms2 = get_the_terms(  get_the_ID(), 'portfolio-cat' );
                $term_name2 = '';
                if (is_array( $terms2 )){
                    foreach ( $terms2 as $term2 )
                    {
                        $term_name2 .= $term2->slug.', ';
                    }
                }
                $term_name2 = substr($term_name2, 0, -2);
        ?>
        <div class="inner-padding">
            <div class="container">
                <div class="row justify-content-center"> 
                    <div class="col-md-8 portfolio-title-content-wrapper portfolio-single-page">
                        <div class="text-center">
                            <?php 
                                $port_img = get_the_post_thumbnail_url(get_the_ID(), 'full'); 
                            ?>
                            <img src="<?php echo esc_url($port_img); ?>" alt="">
                            <div class="portfolio-single-top">
                                <h1><?php the_title(); ?></h1>
                                <?php if($term_name != '') { ?>
                                    <span class="portfolio-category"><?php echo esc_html($term_name2); ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    <?php the_content(); ?>
                    </div>  <!-- col-md-8 portfolio-title-content-wrapper -->
                </div> <!-- row -->
            </div> <!-- #container -->
        </div>

</section>


<?php endwhile;

get_footer();
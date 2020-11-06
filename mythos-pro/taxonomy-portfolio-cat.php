<?php 
get_header(); 

get_template_part('lib/sub-header');
$portfolio_style = get_theme_mod('portfolio_style', 'layout1');
?>
<section id="main" class="clearfix">
	<div class="container">
		<div class="row">
            <div class="col-sm-12">
    			<div id="content" class="mythos-portfolio-wrapper row mythos-portfolio-items mythos-portfolio-<?php echo esc_attr($portfolio_style); ?> mythos-portfolio" role="main">
    				<?php if ( have_posts() ) : 
    					while ( have_posts() ) : the_post(); 
                            $image_id = get_post_thumbnail_id();
                            $src = wp_get_attachment_image_src($image_id, 'mythos-portfo');
                            $the_date = get_the_date(); ?>
                            <div class="col-md-<?php echo esc_attr(get_theme_mod('portfolio_column', 'true')); ?>">  
                                <div class="mythos-portfolio-item">  
                                    <div class="portfolio-grid-img"> 
                                        <a href="<?php echo esc_url(get_the_permalink()); ?>"> 
                                            <img src="<?php echo esc_url($src[0]); ?>" class="img-responsive" /> 
                                        </a>
                                        <?php if ($portfolio_style == 'layout1'){ ?> 
                                        <div class="portfolio-grid-overlay">  
                                            <div class="portfolio-grid-overlay-in">  
                                                <div class="portfolio-cat">  
                                                    <?php echo get_the_term_list( get_the_ID(), 'portfolio-cat', ' ', ', ', ' ' ); ?>
                                                </div> <!-- portfolio-cat -->
                                                <div class="portfolio-date">  
                                                    <span><?php echo esc_attr(date_i18n("d M", strtotime($the_date))); ?></span>  
                                                    <span class="portfolio-date-year"><?php echo esc_attr(date_i18n("Y", strtotime($the_date))); ?></span>  
                                                </div>
                                            </div> 
                                        </div> <!-- portfolio-grid-overlay -->  
                                        <?php } ?>   
                                    </div> <!-- portfolio-grid-img -->
                                    
                                    <?php if ($portfolio_style == 'layout1'){ ?>
                                        <div class="portfolio-grid-content">  
                                            <span><?php esc_html_e('Client', 'mythos-pro') ?></span> 
                                            <h3 class="portfolio-grid-title">
                                                <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_attr(get_the_title()); ?></a>
                                                <a class="portfolio-plus-btn" href="<?php echo esc_url(get_the_permalink()); ?>"><i class="fas fa-plus"></i></a>
                                            </h3> 
                                        </div><!-- portfolio-grid-content -->
                                    <?php }else { ?>
                                        <div class="portfolio-grid-content2"> 
                                            <div class="portfolio-cat2"> 
                                                <?php echo get_the_term_list( get_the_ID(), 'portfolio-cat', ' ', ', ', ' ' ); ?>
                                            </div>
                                            <h3 class="portfolio-grid-title">
                                            <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_attr(get_the_title()); ?></a></h3>
                                        </div>
                                    <?php } ?>
                                </div><!-- mythos-portfolio-item --> 
                            </div><!-- col-md --> 
    					<?php endwhile; ?>

                        <!-- mythos Pagination -->
                        <div class="col-sm-12"> 
                            <?php
                                global $wp_query;
                                $page_numb = max( 1, get_query_var('paged') );
                                $max_page = $wp_query->max_num_pages;
                                echo wp_kses_post(mythos_pagination( $page_numb, $max_page )); 
                            ?>
                        </div>
                        <!-- End -->

    				<?php endif; ?>
    			</div>
            </div>
		</div>
	</div>
</section>
<?php get_footer(); ?>

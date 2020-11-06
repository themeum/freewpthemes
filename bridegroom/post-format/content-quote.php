<?php global $themeum_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('bridegroom-post themeum-grid-post'); ?>>
    <?php if (!is_single()) { ?>
        <div class="row">
            <?php $quote = get_post_meta( get_the_ID(), 'themeum_qoute',true ); ?>
            <div class="content-wrap-section col-sm-10">
                <div class="bridegroom-thumb" style="background-image: url(<?php echo esc_url(the_post_thumbnail_url( 'bridegroom-large' )); ?>)">
                    <div class="bridegroom-blog-wrap-quite">
                        <?php if(function_exists('rwmb_meta')){ ?>
                            <blockquote>
                                <!-- Date Time -->
                                <div class="date">
                                    <?php $the_date = get_the_date(); ?>
                                    <?php echo date_i18n( get_option( 'date_format' ), strtotime($the_date)); ?>
                                </div>  
                                "
                                <?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute',true )); ?> "
                                <span class="author">--<?php echo esc_html(get_post_meta( get_the_ID(), 'themeum_qoute_author',true )); ?></span>
                            </blockquote>
                        <?php } ?>
                    </div>
                </div>

            </div>

        </div>
    <?php } else { ?>
        <?php get_template_part( 'post-format/entry-content' ); ?> 
    <?php }  ?>
</article> <!--/#post-->

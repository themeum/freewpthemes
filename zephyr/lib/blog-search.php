<?php 
    if( isset( $_GET['search'] ) || isset( $_GET['post_status'] ) || isset( $_GET['category'] ) ){ ?>

    	<div class="goback">
	    	<a href="<?php echo get_permalink(); ?>" class=""><i class="fa fa-reply"></i> <?php esc_html_e(' Go Back', 'zephyr') ?></a>
	    </div>

        <?php 
        $paged 	= (get_query_var('paged')) ? get_query_var('paged') : 1;

        if ( !empty($_GET['search']) ) {
        	$args = array(
	            'paged'           => $paged,
	            'posts_per_page'  => 5,
	            'post_type'       => 'post', 
	            'post_status' 	  => 'publish',
	            's'               => $_GET[ 'search' ],
	        );
        }elseif (isset($_GET['post_status'])) {
        	if ( $_GET['post_status'] == 'latest' ) {
				$args = array( 
					'posts_per_page' 	=> 5,
					'order' 			=> 'DESC',
					'post_status' 		=> 'publish'
				);
			} else if ( $_GET['post_status'] == 'popular' ) {
				$args = array( 
					'orderby' 			=> 'meta_value_num',
					'meta_key' 			=> 'post_views_count',
					'posts_per_page' 	=> 5,
					'order' 			=> 'DESC',
					'post_status' 		=> 'publish'
					);
			} else {
				$args = array( 
					'orderby' 			=> 'comment_count',
					'order' 			=> 'DESC',
					'posts_per_page' 	=> 5,
					'post_status' 	=> 'publish'
				);
			}
        } else {
        	$args = array(
	            'paged'           => $paged,
	            'posts_per_page'  => 5,
	            'post_type'       => 'post', 
	            'post_status' 	=> 'publish'
	        ); 
        }
        
	    $query = new WP_Query($args);
	    if ( $query->have_posts() ) { ?>

	    	<div class="row">

	    		<div class="col-md-12">
	    			<h1 class="search-title"><?php printf( __( 'Search Results: %s', 'zephyr' ), get_search_query() ); ?></h1>
	    		</div>

		    	<?php while ( $query->have_posts() ) : $query->the_post(); 

		    	if (has_post_thumbnail( get_the_id() )) {
                    $src_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'zephyr-blog-medium' );
                    if (isset($src_image[0])) {
                        $img = $src_image[0];
                    }
                } ?>

		        <div class="col-md-4">
	                <div class="thm-profile">
	                    <div class="thm-profile-img">
	                        <?php if( !empty($img) ): ?>
	                            <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="img-responsive">
	                        <?php endif; ?>
	                    </div>
	                    <div class="thm-profile-content single-post-content">
	                        <span class="post-category">
	                            <?php printf(esc_html__('%s', 'zephyr'), get_the_category_list(', ')); ?>
	                        </span>
	                        <h3 class="thm-profile-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>

	                        <ul> 
	                            <li>
	                                <div class="blog-date-wrapper">

	                                    <a href="<?php the_permalink(); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>
	                                        <?php 
	                                            $currentdate    = date('m/d/Y g:i:s A');
	                                            $postdate       = get_the_date( 'm/d/Y g:i:s A' );
	                                            $currentdate    = strtotime($currentdate);
	                                            $postdate       = strtotime($postdate);

	                                            $diff       = $currentdate - $postdate;
	                                            $daysleft   = floor($diff/(60*60*24)) ;
	                                            $days       = 'Days ago' ;
	                                        ?>
	                                        <span><?php echo $daysleft.' '.$days; ?></span>
	                                     </a>
	                                     
	                                </div>
	                            </li>
	                            <li>
	                                <a href="#">
	                                    <i class="fa fa-comments-o"></i> <?php comments_number( '0', '1', '%' ); ?><?php esc_html_e(' Comments', 'zephyr') ?>
	                                </a>
	                            </li>
	                        </ul>
	                    </div>
	                </div>
	            </div>
		    <?php endwhile; ?>
		    </div>


	    <?php }else { ?>
	    	<div class="error-div">
			    <h2 class="search-error-title"><?php esc_html_e( 'Nothing Found', 'zephyr' ); ?></h2>
			    <p class="search-error-text"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'zephyr' ); ?></p>
		    </div>
		<?php 
		}

	}
?>
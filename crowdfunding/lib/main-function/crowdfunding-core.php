<?php 


if(!function_exists('themeum_pagination')):

    function themeum_pagination( $page_numb , $max_page )
    {
        $big = 999999999; // need an unlikely integer
        echo '<div class="themeum-pagination">';
        echo paginate_links( array(
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => $page_numb,
            'total'     => $max_page,
            'type'      => 'list',
            'prev_text' => __('<i class="fa fa-angle-left"></i>'),
            'next_text' => __('<i class="fa fa-angle-right"></i>'),
        ) );
        echo '</div>';
    }

endif;


/*-------------------------------------------------------
 *              Themeum Comment
 *-------------------------------------------------------*/

if(!function_exists('themeum_comment')):

    function themeum_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
            // Display trackbacks differently than normal comments.
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'crowdfunding' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
                break;
            default :
            
            global $post;
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-body media">
                
                    <div class="comment-avartar pull-left">
                        <?php
                            echo get_avatar( $comment, $args['avatar_size'] );
                        ?>
                    </div>
                    <div class="comment-context media-body">
                        <div class="comment-head">
                            <?php
                                printf( '<span class="comment-author">%1$s</span>',
                                    get_comment_author_link());
                            ?>
                            <span class="comment-date"><?php echo get_comment_date('d / m / Y') ?></span>

                            <?php edit_comment_link( __( 'Edit', 'crowdfunding' ), '<span class="edit-link">', '</span>' ); ?>
                            <span class="comment-reply">
                                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'crowdfunding' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                            </span>
                        </div>

                        <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'crowdfunding' ); ?></p>
                        <?php endif; ?>

                        <div class="comment-content">
                            <?php comment_text(); ?>
                        </div>
                    </div>
                
            </div>
        <?php
            break;
        endswitch; 
    }

endif;


/*-------------------------------------------------------
*           Themeum Breadcrumb
*-------------------------------------------------------*/
function themeum_breadcrumbs(){ ?>

    <div class="themeum-breadcrumbs">

        <ul class="breadcrumb">
            <li>
                <a href="<?php echo esc_url(site_url()); ?>" class="breadcrumb_home"><?php esc_html_e('Home', 'crowdfunding') ?></a>
            </li>
            <li class="active">
                <?php if( is_tag() ) { ?>
                <?php esc_html_e('Posts Tagged ', 'crowdfunding') ?><span class="raquo">/</span><?php single_tag_title(); echo('/'); ?>
                <?php } elseif (is_day()) { ?>
                <?php esc_html_e('Posts made in', 'crowdfunding') ?> <?php the_time('F jS, Y'); ?>
                <?php } elseif (is_month()) { ?>
                <?php esc_html_e('Posts made in', 'crowdfunding') ?> <?php the_time('F, Y'); ?>
                <?php } elseif (is_year()) { ?>
                <?php esc_html_e('Posts made in', 'crowdfunding') ?> <?php the_time('Y'); ?>
                <?php } elseif (is_search()) { ?>
                <?php esc_html_e('Search results for', 'crowdfunding') ?> <?php the_search_query() ?>
                <?php } elseif (is_single()) { ?>
                <?php $category = get_the_category();
                if ( $category ) { 
                    $catlink = get_category_link( $category[0]->cat_ID );
                    echo ('<a href="'.esc_url($catlink).'">'.esc_html($category[0]->cat_name).'</a> '.'<span class="raquo"> /</span> ');
                }
                echo get_the_title(); ?>
                <?php } elseif (is_category()) { ?>
                <?php single_cat_title(); ?>
                <?php } elseif (is_tax()) { ?>
                <?php 
                $themeum_taxonomy_links = array();
                $themeum_term = get_queried_object();
                $themeum_term_parent_id = $themeum_term->parent;
                $themeum_term_taxonomy = $themeum_term->taxonomy;

                while ( $themeum_term_parent_id ) {
                    $themeum_current_term = get_term( $themeum_term_parent_id, $themeum_term_taxonomy );
                    $themeum_taxonomy_links[] = '<a href="' . esc_url( get_term_link( $themeum_current_term, $themeum_term_taxonomy ) ) . '" title="' . esc_attr( $themeum_current_term->name ) . '">' . esc_html( $themeum_current_term->name ) . '</a>';
                    $themeum_term_parent_id = $themeum_current_term->parent;
                }

                if ( !empty( $themeum_taxonomy_links ) ) echo implode( ' <span class="raquo">/</span> ', array_reverse( $themeum_taxonomy_links ) ) . ' <span class="raquo">/</span> ';

                echo esc_html( $themeum_term->name ); 
            } elseif (is_author()) { 
                global $wp_query;
                $curauth = $wp_query->get_queried_object();

                esc_html_e('Posts by ', 'crowdfunding'); echo ' ',$curauth->nickname; 
            } elseif (is_page()) { 
                echo get_the_title(); 
            } elseif (is_home()) { 
                esc_html_e('Blog', 'crowdfunding');
            } ?>  
        </li>
    </ul>
    </div>
<?php
}



/*-----------------------------------------------------
 *              Coming Soon Page Settings
 *----------------------------------------------------*/
if (isset($themeum_options['comingsoon-en']) && $themeum_options['comingsoon-en']) {
    function themeum_my_page_template_redirect()
    {
        if( is_page( ) || is_home() || is_category() || is_single() )
        {
            if( !is_super_admin( get_current_user_id() ) ){
                get_template_part( 'coming','soon');
                exit();
            } 
        }
    }
    add_action( 'template_redirect', 'themeum_my_page_template_redirect' );

    function themeum_cooming_soon_wp_title(){
        return 'Coming Soon';
    }

    add_filter( 'wp_title', 'themeum_cooming_soon_wp_title' );
}



/*-----------------------------------------------------
 *              Custom Excerpt Length
 *----------------------------------------------------*/
if(!function_exists('themeum_the_excerpt_max_charlength')):

    function themeum_the_excerpt_max_charlength($charlength) {
        $excerpt = get_the_excerpt();
        $charlength++;

        if ( mb_strlen( $excerpt ) > $charlength ) {
            $subex = mb_substr( $excerpt, 0, $charlength - 5 );
            $exwords = explode( ' ', $subex );
            $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
            if ( $excut < 0 ) {
                return mb_substr( $subex, 0, $excut );
            } else {
                return $subex;
            }

        } else {
            return $excerpt;
        }
    }

endif;



/*-----------------------------------------------------
 *              Custom Excerpt Length
 *----------------------------------------------------*/

if(!function_exists('themeum_get_video_id')){
    function themeum_get_video_id($url){
        $video = parse_url($url);

        switch($video['host']) {
            case 'youtu.be':
            $id = trim($video['path'],'/');
            $src = 'https://www.youtube.com/embed/' . $id;
            break;

            case 'www.youtube.com':
            case 'youtube.com':
            parse_str($video['query'], $query);
            $id = $query['v'];
            $src = 'https://www.youtube.com/embed/' . $id;
            break;

            case 'vimeo.com':
            case 'www.vimeo.com':
            $id = trim($video['path'],'/');
            $src = "http://player.vimeo.com/video/{$id}";
        }

        return $src;
    }
}


function themeum_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);

   return $rgb[0].','.$rgb[1].','.$rgb[2];
}

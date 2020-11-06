<?php
/* This comments template */

if ( post_password_required() )
    return;
?>
<div id="comments" class="comments-area comments">
    <?php if ( have_comments() ) : ?>
        <h3 class="comments-title">
            <?php comments_number( __('No Comment', 'crowdfunding' ), __('One Comments', 'crowdfunding' ), __('Comment List', 'crowdfunding' ) ); ?>
        </h3>

        <ul class="comment-list">

            <?php
                wp_list_comments( array(
                    'style'       => 'ul',
                    'short_ping'  => true,
                    'callback' => 'themeum_comment',
                    'avatar_size' => 80
                ) );
            ?>
        </ul><!-- .comment-list -->

        <?php
            // Are there comments to navigate through?
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'crowdfunding' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'crowdfunding' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'crowdfunding' ) ); ?></div>
        </nav><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation ?>

        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.' , 'crowdfunding' ); ?></p>
        <?php endif; ?>

    <?php endif; // have_comments() ?>

    <?php
        $commenter = wp_get_current_commenter();
        $req = sanitize_email(get_option( 'require_name_email' ));
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $fields =  array(
            'author' => '<div class="col-md-12 col6-input"><input id="author" name="author" type="text" placeholder="'. __( 'Name', 'crowdfunding' ) .'" value="" size="30"' . esc_attr($aria_req) . '/>',
            'email'  => '<input id="email" name="email" type="text" placeholder="'. __( 'Email', 'crowdfunding' ) .'" value="" size="30"' . esc_attr($aria_req) . '/>',
            'url'  => '<input id="url" name="url" type="text" placeholder="'. __( 'Website url', 'crowdfunding' ) .'" value="" size="30"/></div>',
        );

        
         
        $comments_args = array(
            'comment_field'             => '<div class="col-md-12 col6-input"><textarea id="comment" placeholder="'. __( 'Comment', 'crowdfunding' ) .'" name="comment" aria-required="true"></textarea></div>',
            'fields' =>  $fields,
            'comment_notes_before'      => '',
            'comment_notes_after'       => '',
            
            'label_submit'              => 'Send Comment'
        );
        ob_start();
        comment_form($comments_args);
        $search = array('class="comment-form"','class="form-submit"');
        $replace = array('class="comment-form"','class="form-submit"');
        echo str_replace($search,$replace,ob_get_clean());
    ?>
</div>
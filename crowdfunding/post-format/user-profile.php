<div class="user-profile media">
    <h2><?php _e('Author', 'themeum'); ?></h2>
    <div class="pull-left author-avater">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?>
    </div>
    <div class="media-body">
        <div class="profile-heading">
            <h3><?php echo the_author_meta('display_name'); ?></h3>
            <span class="website-link"><?php echo esc_url(the_author_meta('user_url')); ?></span>
        </div>
        
        <?php echo esc_html(the_author_meta('description')); ?>
        
    </div>
</div><!-- .user-profile -->
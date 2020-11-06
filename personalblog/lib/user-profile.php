<div class="author-user-profile media">
    <div class="pull-left author-user-avater">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 90 ); ?>
    </div>
    <div class="media-body">
    <div class="author-user-heading">

        <?php if ( get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "" ) { ?>
            <h3><span><?php esc_html_e('Written By','personalblog');?></span> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_meta('first_name');?> <?php echo get_the_author_meta('last_name');?></a></h3>
        <?php } else { ?>
            <h3> <span><?php esc_html_e('Written By','personalblog');?></span> <?php the_author_posts_link() ?></h3>
        <?php }?>

        <div class="description">
        <?php if (the_author_meta('description')) { ?>
          <p><?php echo the_author_meta('description'); ?></p>
        <?php } ?>
        </div>

    </div>
    
    <?php
        $facebookLink   = get_the_author_meta('facebook');
        $twitterLink    = get_the_author_meta('twitter');
        $gplusLink      = get_the_author_meta('gplus');
        $linkedinLink   = get_the_author_meta('linkedin');
        $tumblrLink     = get_the_author_meta('tumblr');
        $pinterestLink  = get_the_author_meta('pinterest');
        $instagramLink  = get_the_author_meta('instagram');
    ?>
    <?php if ( $facebookLink || $twitterLink || $gplusLink || $linkedinLink || $tumblrLink || $pinterestLink || $instagramLink ){ ?>
        <ul class="author-social-profile">
            <?php
                if ($facebookLink) {
                    echo "<li class='wrap-facebook'><a href='".esc_url($facebookLink)."'><i class='fa fa-facebook'></i></a></li>";
                }
                if ($twitterLink){
                    echo "<li class='wrap-twitter'><a href='".esc_url($twitterLink)."'><i class='fa fa-twitter'></i></a></li>";
                } 
                if ($gplusLink){
                    echo "<li class='wrap-google-plus'><a href='".esc_url($gplusLink)."'><i class='fa fa-google-plus'></i></a></li>";
                }
                if ( $linkedinLink ){
                    echo "<li class='wrap-linkedin'><a href='".esc_url($linkedinLink)."'><i class='fa fa-linkedin'></i></a></li>";
                }
                if ( $tumblrLink ){
                    echo "<li class='wrap-tumblr'><a href='".esc_url($tumblrLink)."'><i class='fa fa-tumblr'></i></a></li>";
                } 
                if ( $pinterestLink ){
                    echo "<li class='wrap-pinterest'><a href='".esc_url($pinterestLink)."'><i class='fa fa-pinterest'></i></a></li>";
                }   
                if ( $instagramLink ){
                    echo "<li class='wrap-instagram'><a href='".esc_url($instagramLink)."'><i class='fa fa-instagram'></i></a></li>";
                } 
            ?>
        </ul>                           
    <?php } ?>

    </div>
</div><!-- .user-profile -->
<?php 
    if(is_single()){
        get_template_part( 'post-format/content-single');
    }elseif(get_theme_mod('blog_classic', false)){
        get_template_part( 'post-format/content-classic');
    }else{
        get_template_part( 'post-format/content-default' );
    }
?>
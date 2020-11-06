<?php

if(!is_front_page()){

?>

<div class="subtitle-cover sub-title">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php calypso_breadcrumbs(); ?>
            </div>
            <div class="col-12">
                    <?php
                    global $wp_query;
                    if(isset($wp_query->queried_object->name)){
                        if (get_theme_mod( 'header_title_enable', true )) {
                            if($wp_query->queried_object->name != ''){
                                if($wp_query->queried_object->name == 'product' ){
                                    echo '<h2 class="subtitle">'.esc_html__('Shop', 'calypso').'</h2>';
                                }else{
                                    echo '<h3 class="subtitle">'. esc_html__('Category: ', 'calypso' ).$wp_query->queried_object->name.'</h3>';
                                }
                            }else{
                                echo '<h3 class="subtitle">'.get_the_title().'</h3>';
                            }
                        }
                    }else{

                        if( is_search() ){
                            if (get_theme_mod( 'header_title_enable', true )) {
                                $text = '';
                                $first_char = esc_html__('Search', 'calypso');
                                if( isset($_GET['s'])){ $text = $_GET['s']; }
                                echo '<h3 class="subtitle">'.$first_char.':'.$text.'</h3>';
                            }
                        }
                        else if( is_archive() ){
                            the_archive_title('<h3 class="subtitle">', '</h3>');
                        }
                        else if( is_single()){
                            if(get_post_type() == 'product'){
                                echo '<h3 class="subtitle">'.esc_html__('Product Details','calypso').'</h3>';
                            } else {
                                if (get_theme_mod( 'header_title_text', 'Latest Blog' )){
                                    echo '<h2 class="page-leading">'. get_theme_mod( 'header_title_text', 'Latest Blog' ).'</h2>';
                                }
                            }
                        } 
                        else{
                            if (get_theme_mod( 'header_title_enable', true )) {
                                echo '<h3 class="subtitle">'. get_the_title() .'</h3>';
                            }
                        }
                    }
                    ?>
            </div>
        </div>
    </div>
</div><!--/.sub-title-->

<?php }
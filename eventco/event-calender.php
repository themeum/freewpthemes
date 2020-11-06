<?php
/*
*   Template Name: Events Calendar
*/

get_header(); ?>

<?php get_template_part('lib/sub-header'); ?>

<section id="main" class="section-event">
    <div class="container" id="calendar_area">
        <?php 
            get_template_part('lib/calendar');
            $calendar = new Calendar();
            echo $calendar->show();      
        ?>             
    </div>
</section> <!--/#main-->

<?php get_footer();

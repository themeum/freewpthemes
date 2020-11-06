<?php

error_reporting(0);
class Calendar { 

    /**
    * Constructor
    */
    public function __construct(){     
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);     
    }
     
    /********************* PROPERTY ********************/  
    private $dayLabels      = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
    private $currentYear    = 0; 
    private $currentMonth   = 0;
    private $currentDay     = 0;
    private $currentDate    = null;
    private $daysInMonth    =   0;
    private $naviHref       = null;
    private $navImg         = null;
     
    /********************* PUBLIC **********************/  
        
    /**
    * print out the calendar
    */
    public function show() {

        $year  == null;
        $month == null;
         
        if(null==$year&&isset($_GET['year'])){
            $year = $_GET['year'];
        }else if(null==$year){
            $year = date("Y",time());  
        }           
        if(null==$month&&isset($_GET['month'])){
            $month = $_GET['month'];
        }else if(null==$month){
            $month = date("m",time());
        }                  
         
        $this->currentYear=$year;
        $this->currentMonth=$month;
        $this->daysInMonth=$this->_daysInMonth($month,$year);  
         
        $content .= '<div class="upcoming-events">'.
                        $this->_createNavi().
                        '<div class="row">
                            <div class="col-md-12">                   
                                <div class="calendar">';
                                $content .=
                                    '<ul class="flex day">'.$this->_createLabels().'</ul>';       
                                    $content.='<ul class="flex date">'; 

                                        $weeksInMonth = $this->_weeksInMonth($month,$year);
                                        // Create weeks in a month
                                        $week_inc = 1;
                                        for( $i=0; $i<$weeksInMonth; $i++ ):
                                            # Create days in a week
                                            for( $j=1; $j<=7; $j++ ):
                                            if($this->currentDay==0){
                                                $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));  
                                                if(intval($i*7+$j) == intval($firstDayOfTheWeek)){ 
                                                    $this->currentDay=1; 
                                                }
                                            }
                                             
                                            if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){
                                                $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
                                                $cellContent = $this->currentDay;
                                                $this->currentDay++;   
                                            }else{
                                                $this->currentDate =null;
                                                $cellContent=null;
                                            }


                                        $ev_array           = array();
                                        $img_arr            = array();
                                        $ev_title_array     = array();
                                        $ev_permalink_array = array();
                                        $ev_summary_array   = array();
                                        $eventco_events_args = 
                                            array(
                                                'post_type'     => 'event',
                                                'post_status'   => 'publish'
                                            );
                                        $eventco_events_query  = new WP_Query( $eventco_events_args );
                                        if ( $eventco_events_query->have_posts() ) :  
                                            while ( $eventco_events_query->have_posts() ) : $eventco_events_query->the_post(); 
                                                $events_date                        = get_post_meta(get_the_ID(), 'themeum_event_start_datetime', true);
                                                $events_title                       = get_the_title();
                                                $highlighted_text                   = eventco_excerpt_max_charlength(200);
                                                $get_image                          = esc_url( wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ) );
                                                $events_date                        = substr($events_date, 0, strrpos($events_date, ' '));

                                                array_push( $ev_array, date("d F Y", strtotime($events_date)) );
                                                array_push( $ev_title_array, $events_title );
                                                array_push( $ev_permalink_array, esc_url(get_the_permalink()) );
                                                array_push( $img_arr, $get_image );
                                                array_push( $ev_summary_array, $highlighted_text );

                                                if($eventco_events_query->post_count == ($eventco_events_query->current_post + 1)){
                                                    $newevarray = $ev_array;
                                                }
                                                $get_newevarray  = implode(" ",$newevarray);
                                                $get_final_array = explode(" ", $get_newevarray);
                                            
                                            endwhile; 
                                        endif;


                                        $month_number1  = date("n",strtotime($get_final_array[1]));
                                        $month_number2  = date("n",strtotime($get_final_array[4]));
                                        $month_number3  = date("n",strtotime($get_final_array[7]));
                                        $month_number4  = date("n",strtotime($get_final_array[10]));
                                        $month_number5  = date("n",strtotime($get_final_array[13]));
                                        $month_number6  = date("n",strtotime($get_final_array[16]));
                                        $month_number7  = date("n",strtotime($get_final_array[19]));
                                        $month_number8  = date("n",strtotime($get_final_array[22]));
                                        $month_number9  = date("n",strtotime($get_final_array[25]));
                                        $month_number10 = date("n",strtotime($get_final_array[28]));
                                        $month_number11 = date("n",strtotime($get_final_array[31]));
                                        $month_number12 = date("n",strtotime($get_final_array[34]));
                                        $month_number13 = date("n",strtotime($get_final_array[37]));
                                        $month_number14 = date("n",strtotime($get_final_array[40]));
                                        $month_number15 = date("n",strtotime($get_final_array[44]));
                                        $month_number16 = date("n",strtotime($get_final_array[47]));
                                        $month_number17 = date("n",strtotime($get_final_array[51]));
                                        $month_number18 = date("n",strtotime($get_final_array[54]));
                                        $month_number19 = date("n",strtotime($get_final_array[57]));
                                        $month_number20 = date("n",strtotime($get_final_array[61]));
                                        $month_number21 = date("n",strtotime($get_final_array[64]));
                                        $month_number22 = date("n",strtotime($get_final_array[67]));
                                        $month_number23 = date("n",strtotime($get_final_array[70]));
                                        $month_number24 = date("n",strtotime($get_final_array[73]));
                                        $month_number25 = date("n",strtotime($get_final_array[76]));


                                        if( $get_final_array[0] == $cellContent && $month_number1 == $this->currentMonth && $get_final_array[2] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[0].'">'.$ev_title_array[0].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[0].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[0].'">'.$ev_title_array[0].'</a></h2>
                                                        <p>'.$ev_summary_array[0].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[0].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        }elseif ( $get_final_array[3] == $cellContent && $month_number2 == $this->currentMonth && $get_final_array[5] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[1].'">'.$ev_title_array[1].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[1].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[1].'">'.$ev_title_array[1].'</a></h2>
                                                        <p>'.$ev_summary_array[1].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[1].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        }elseif ( $get_final_array[6] == $cellContent && $month_number3 == $this->currentMonth && $get_final_array[8] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[2].'">'.$ev_title_array[2].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[2].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[2].'">'.$ev_title_array[2].'</a></h2>
                                                        <p>'.$ev_summary_array[2].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[2].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[9] == $cellContent && $month_number4 == $this->currentMonth && $get_final_array[11] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[3].'">'.$ev_title_array[3].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[3].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[3].'">'.$ev_title_array[3].'</a></h2>
                                                        <p>'.$ev_summary_array[3].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[3].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[12] == $cellContent && $month_number5 == $this->currentMonth && $get_final_array[14] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[4].'">'.$ev_title_array[4].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[4].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[4].'">'.$ev_title_array[4].'</a></h2>
                                                        <p>'.$ev_summary_array[4].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[4].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[15] == $cellContent && $month_number6 == $this->currentMonth && $get_final_array[17] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[5].'">'.$ev_title_array[5].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[5].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[5].'">'.$ev_title_array[5].'</a></h2>
                                                        <p>'.$ev_summary_array[5].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[5].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[18] == $cellContent && $month_number7 == $this->currentMonth && $get_final_array[20] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[6].'">'.$ev_title_array[6].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[6].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[6].'">'.$ev_title_array[6].'</a></h2>
                                                        <p>'.$ev_summary_array[6].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[6].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[21] == $cellContent && $month_number8 == $this->currentMonth && $get_final_array[23] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[7].'">'.$ev_title_array[7].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[7].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[7].'">'.$ev_title_array[7].'</a></h2>
                                                        <p>'.$ev_summary_array[7].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[7].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[24] == $cellContent && $month_number9 == $this->currentMonth && $get_final_array[26] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[8].'">'.$ev_title_array[8].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[8].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[8].'">'.$ev_title_array[8].'</a></h2>
                                                        <p>'.$ev_summary_array[8].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[8].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[27] == $cellContent && $month_number10 == $this->currentMonth && $get_final_array[29] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[9].'">'.$ev_title_array[9].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[9].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[9].'">'.$ev_title_array[9].'</a></h2>
                                                        <p>'.$ev_summary_array[9].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[9].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[30] == $cellContent && $month_number11 == $this->currentMonth && $get_final_array[32] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[10].'">'.$ev_title_array[10].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[10].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[10].'">'.$ev_title_array[10].'</a></h2>
                                                        <p>'.$ev_summary_array[10].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[10].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[33] == $cellContent && $month_number12 == $this->currentMonth && $get_final_array[35] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[11].'">'.$ev_title_array[11].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[11].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[11].'">'.$ev_title_array[11].'</a></h2>
                                                        <p>'.$ev_summary_array[11].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[11].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>'; 
                                        } elseif ( $get_final_array[36] == $cellContent && $month_number13 == $this->currentMonth && $get_final_array[38] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[12].'">'.$ev_title_array[12].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[12].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[12].'">'.$ev_title_array[12].'</a></h2>
                                                        <p>'.$ev_summary_array[12].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[12].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>'; 
                                        } elseif ( $get_final_array[39] == $cellContent && $month_number14 == $this->currentMonth && $get_final_array[41] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[13].'">'.$ev_title_array[13].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[13].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[13].'">'.$ev_title_array[13].'</a></h2>
                                                        <p>'.$ev_summary_array[13].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[13].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[42] == $cellContent && $month_number15 == $this->currentMonth && $get_final_array[44] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[14].'">'.$ev_title_array[14].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[14].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[14].'">'.$ev_title_array[14].'</a></h2>
                                                        <p>'.$ev_summary_array[14].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[14].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[45] == $cellContent && $month_number16 == $this->currentMonth && $get_final_array[47] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[15].'">'.$ev_title_array[15].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[15].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[15].'">'.$ev_title_array[15].'</a></h2>
                                                        <p>'.$ev_summary_array[15].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[15].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[48] == $cellContent && $month_number17 == $this->currentMonth && $get_final_array[50] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[16].'">'.$ev_title_array[16].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[16].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[16].'">'.$ev_title_array[16].'</a></h2>
                                                        <p>'.$ev_summary_array[16].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[16].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[51] == $cellContent && $month_number18 == $this->currentMonth && $get_final_array[53] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[17].'">'.$ev_title_array[17].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[17].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[17].'">'.$ev_title_array[17].'</a></h2>
                                                        <p>'.$ev_summary_array[17].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[17].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>'; 
                                        } elseif ( $get_final_array[54] == $cellContent && $month_number19 == $this->currentMonth && $get_final_array[56] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[18].'">'.$ev_title_array[18].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[18].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[18].'">'.$ev_title_array[18].'</a></h2>
                                                        <p>'.$ev_summary_array[18].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[18].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[57] == $cellContent && $month_number20 == $this->currentMonth && $get_final_array[59] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[19].'">'.$ev_title_array[19].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[19].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[19].'">'.$ev_title_array[19].'</a></h2>
                                                        <p>'.$ev_summary_array[19].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[19].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[61] == $cellContent && $month_number21 == $this->currentMonth && $get_final_array[62] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[20].'">'.$ev_title_array[20].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[20].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[20].'">'.$ev_title_array[20].'</a></h2>
                                                        <p>'.$ev_summary_array[20].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[20].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[63] == $cellContent && $month_number22 == $this->currentMonth && $get_final_array[65] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[21].'">'.$ev_title_array[21].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[21].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[21].'">'.$ev_title_array[21].'</a></h2>
                                                        <p>'.$ev_summary_array[21].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[21].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[66] == $cellContent && $month_number23 == $this->currentMonth && $get_final_array[68] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[22].'">'.$ev_title_array[22].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[22].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[22].'">'.$ev_title_array[22].'</a></h2>
                                                        <p>'.$ev_summary_array[22].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[22].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>'; 
                                        } elseif ( $get_final_array[69] == $cellContent && $month_number24 == $this->currentMonth && $get_final_array[71] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[23].'">'.$ev_title_array[23].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[23].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[23].'">'.$ev_title_array[23].'</a></h2>
                                                        <p>'.$ev_summary_array[23].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[23].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';
                                        } elseif ( $get_final_array[72] == $cellContent && $month_number25 == $this->currentMonth && $get_final_array[74] == $this->currentYear){
                                            $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                            $content .= '<span class="info"><a href="'.$ev_permalink_array[24].'">'.$ev_title_array[24].'</a></span>';
                                            $content .= '<div class="event-intro">
                                                    <img src="'.$img_arr[24].'">
                                                    <div class="event-content">
                                                        <h2><a href="'.$ev_permalink_array[24].'">'.$ev_title_array[24].'</a></h2>
                                                        <p>'.$ev_summary_array[24].'</p>
                                                        <a class="btn" href="'.$ev_permalink_array[24].'">'.__('Event Details', 'eventco').'</a>
                                                    </div>
                                                </div></li>';                                                                                                                         
                                        }else {
                                            $dateTime = new DateTime();
                                            $compare_date = $dateTime->format('d');
                                            if ($compare_date <= $cellContent) {
                                                $content .= '<li><span class="recent-date">'.$cellContent.'</span></li>';
                                            }else {
                                                $content .= '<li><span class="past-date">'.$cellContent.'</span></li>';
                                            }
                                        }                                        

                                            if( $j == 7 ):
                                                $content.='</ul>';
                                                if( $week_inc !=6 ):
                                                    $content.='<ul class="flex date">';     
                                                endif;
                                            endif;

                                        endfor;

                                        $week_inc++;
                                    endfor;
             
                                $content.='</div>';
                            $content.='</div>';
                        $content.='</div>';
                    $content.='</div>';
                 
            return $content;   
    }
     
    /* ==================== PRIVATE ====================== */ 
    /**
    * create the li element for ul
    */
    private function _showDay($cellNumber, $single_date){
         
        if($this->currentDay==0){
             
            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));  
            if(intval($cellNumber) == intval($firstDayOfTheWeek)){ 
                $this->currentDay=1; 
            }

        }
         
        if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){
             
            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
            $cellContent = $this->currentDay;
            $this->currentDay++;   
             
        }else{
             
            $this->currentDate =null;
            $cellContent=null;
        }

        if(!empty($single_date)){

            $get_ac = explode(" ", $single_date);
            $month_number = date("n",strtotime($get_ac[1]));
            if( $get_ac[0] == $cellContent && $month_number == $this->currentMonth && $get_ac[2] == $this->currentYear){
             $out = '<li class="event-date">'.$cellContent.'</li>'; 
            } else {
             $out = '<li>'.$cellContent.'</li>';
            }  
        } else {
            $out = '<li>'.$cellContent.'</li>'; 
            $out = '<li>'.$cellContent.'</li>'; 
        }
      
        return $out;
    }
     
    /**
    * Create Navigation
    */
    private function _createNavi(){         
        $nextMonth = $this->currentMonth == 12?1:intval($this->currentMonth)+1;         
        $nextYear = $this->currentMonth  == 12?intval($this->currentYear)+1:$this->currentYear;
        $preMonth = $this->currentMonth  == 1?12:intval($this->currentMonth)-1;
        $preYear = $this->currentMonth   == 1?intval($this->currentYear)-1:$this->currentYear;
         
        return '<div class="row">
                <div class="col-sm-12">
                    <div class="head-area">
                        <p class="sub-title-content">'.__('Select A Day', 'eventco').'</p>
                        <h2 class="main-head-event"> '.date('F Y',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</h2>
                        <div class="btn-area flex">
                            <a class="btn event-btn" id="premonth" month='.sprintf("%02d", $preMonth).' year='.$preYear.' onclick="getPrevMonth();">
                                <i class="fa fa-angle-left"></i></a>
                            <a class="btn" id="nextmonth" month='.sprintf("%02d", $nextMonth).' year='.$nextYear.' onclick="getNextMonth();"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>';
    }
         
    /**
    * create calendar week labels
    */
    private function _createLabels(){  
                 
        $content='';
         
        foreach( $this->dayLabels as $index=>$label ){
             
            $content.='<li>'.$label.'</li>';
 
        }
         
        return $content;
    }
     
     
     
    /**
    * calculate number of weeks in a particular month
    */
    private function _weeksInMonth($month=null,$year=null){
         
        if( null==($year) ) {
            $year =  date("Y",time()); 
        }
         
        if(null==($month)) {
            $month = date("m",time());
        }
         
        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month,$year);
        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7); 
        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));
        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));
         
        if($monthEndingDay<$monthStartDay){
             
            $numOfweeks++;
         
        }
         
        return $numOfweeks;
    }
 
    /**
    * calculate number of days in a particular month
    */
    private function _daysInMonth($month=null,$year=null){
         
        if(null==($year))
            $year =  date("Y",time()); 
 
        if(null==($month))
            $month = date("m",time());
             
        return date('t',strtotime($year.'-'.$month.'-01'));
    }


    /*=================================
    *   Ajax requested method
    ==================================*/ 
    
    public function eventco_nextprevious_month( $nextmonth, $nextyear ) {

        $year  == null;
        $month == null;
         
        if(null==$year&& $nextyear !=null){
 
            $year = $nextyear;
         
        }else if(null==$year){
 
            $year = date("Y",time());  
         
        }          
         
        if(null==$month&& $nextmonth !=null){
 
            $month = $nextmonth;
         
        }else if(null==$month){
 
            $month = date("m",time());
         
        }                  
         
        $this->currentYear=$year;
        $this->currentMonth=$month;
        $this->daysInMonth=$this->_daysInMonth($month,$year);  


        $content .='<div class="upcoming-events">'.
                        $this->_createNavi().
                        '<div class="row">
                            <div class="col-md-12">                   
                                <div class="calendar">';
                                $content .='<ul class="flex day">'.$this->_createLabels().'</ul>';       
                                    $content.='<ul class="flex date">'; 

                                        $weeksInMonth = $this->_weeksInMonth($month,$year);
                                        // Create weeks in a month
                                        $week_inc = 1;
                                        for( $i=0; $i<$weeksInMonth; $i++ ):

                                            //Create days in a week
                                            for($j=1;$j<=7;$j++):
                                            if($this->currentDay==0){
                                                $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));  
                                                if(intval($i*7+$j) == intval($firstDayOfTheWeek)){ 
                                                    $this->currentDay=1; 
                                                }
                                            }
                                             
                                            if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){
                                                $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
                                                $cellContent = $this->currentDay;
                                                $cellContentMonth = $this->currentMonth;

                                                $this->currentDay++;   
                                            }else{
                                                $this->currentDate =null;
                                                $cellContent=null;
                                            }

                                            $ev_array           = array();
                                            $img_arr            = array();
                                            $ev_title_array     = array();
                                            $ev_permalink_array = array();
                                            $ev_summary_array   = array();
                                            $eventco_events_args = 
                                                array(
                                                    'post_type'     => 'event',
                                                    'post_status'   => 'publish'
                                                );
                                            $eventco_events_query  = new WP_Query( $eventco_events_args );
                                            if ( $eventco_events_query->have_posts() ) :  
                                                while ( $eventco_events_query->have_posts() ) : $eventco_events_query->the_post(); 
                                                    $events_date                        = get_post_meta(get_the_ID(), 'themeum_event_start_datetime', true);
                                                    $events_title                       = get_the_title();
                                                    $highlighted_text                   = eventco_excerpt_max_charlength(180);

                                                    $get_image   = esc_url( wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())));
                                                    $events_date = substr($events_date, 0, strrpos($events_date, ' '));

                                                    array_push( $ev_array, date("d F Y", strtotime($events_date)) );
                                                    array_push( $ev_title_array, $events_title );
                                                    array_push( $ev_permalink_array, esc_url(get_the_permalink()) );
                                                    array_push( $img_arr, $get_image );
                                                    array_push( $ev_summary_array, $highlighted_text );

                                                    if($eventco_events_query->post_count == ($eventco_events_query->current_post + 1)){
                                                        $newevarray = $ev_array;
                                                    }
                                                    $get_newevarray  = implode(" ",$newevarray);
                                                    $get_final_array = explode(" ", $get_newevarray);
                                                
                                                endwhile; 
                                            endif;

                                            $month_number1  = date("n",strtotime($get_final_array[1]));
                                            $month_number2  = date("n",strtotime($get_final_array[4]));
                                            $month_number3  = date("n",strtotime($get_final_array[7]));
                                            $month_number4  = date("n",strtotime($get_final_array[10]));
                                            $month_number5  = date("n",strtotime($get_final_array[13]));
                                            $month_number6  = date("n",strtotime($get_final_array[16]));
                                            $month_number7  = date("n",strtotime($get_final_array[19]));
                                            $month_number8  = date("n",strtotime($get_final_array[22]));
                                            $month_number9  = date("n",strtotime($get_final_array[25]));
                                            $month_number10 = date("n",strtotime($get_final_array[28]));
                                            $month_number11 = date("n",strtotime($get_final_array[31]));
                                            $month_number12 = date("n",strtotime($get_final_array[34]));
                                            $month_number13 = date("n",strtotime($get_final_array[37]));
                                            $month_number14 = date("n",strtotime($get_final_array[40]));
                                            $month_number15 = date("n",strtotime($get_final_array[44]));
                                            $month_number16 = date("n",strtotime($get_final_array[47]));
                                            $month_number17 = date("n",strtotime($get_final_array[51]));
                                            $month_number18 = date("n",strtotime($get_final_array[54]));
                                            $month_number19 = date("n",strtotime($get_final_array[57]));
                                            $month_number20 = date("n",strtotime($get_final_array[61]));
                                            $month_number21 = date("n",strtotime($get_final_array[64]));
                                            $month_number22 = date("n",strtotime($get_final_array[67]));
                                            $month_number23 = date("n",strtotime($get_final_array[70]));
                                            $month_number24 = date("n",strtotime($get_final_array[73]));
                                            $month_number25 = date("n",strtotime($get_final_array[76]));

                                            if( $get_final_array[0] == $cellContent && $month_number1 == $this->currentMonth && $get_final_array[2] == $this->currentYear){


                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[0].'">'.$ev_title_array[0].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[0].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[0].'">'.$ev_title_array[0].'</a></h2>
                                                            <p>'.$ev_summary_array[0].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[0].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';



                                            }elseif ( $get_final_array[3] == $cellContent && $month_number2 == $this->currentMonth && $get_final_array[5] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[1].'">'.$ev_title_array[1].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[1].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[1].'">'.$ev_title_array[1].'</a></h2>
                                                            <p>'.$ev_summary_array[1].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[1].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>'; 
                                            } elseif ( $get_final_array[6] == $cellContent && $month_number3 == $this->currentMonth && $get_final_array[8] == $this->currentYear){

                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[2].'">'.$ev_title_array[2].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[2].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[2].'">'.$ev_title_array[2].'</a></h2>
                                                            <p>'.$ev_summary_array[2].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[2].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';

                                            } elseif ( $get_final_array[9] == $cellContent && $month_number4 == $this->currentMonth && $get_final_array[11] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[3].'">'.$ev_title_array[3].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[3].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[3].'">'.$ev_title_array[3].'</a></h2>
                                                            <p>'.$ev_summary_array[3].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[3].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';

                                            } elseif ( $get_final_array[12] == $cellContent && $month_number5 == $this->currentMonth && $get_final_array[14] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[4].'">'.$ev_title_array[4].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[4].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[4].'">'.$ev_title_array[4].'</a></h2>
                                                            <p>'.$ev_summary_array[4].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[4].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';  

                                            } elseif ( $get_final_array[15] == $cellContent && $month_number6 == $this->currentMonth && $get_final_array[17] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[5].'">'.$ev_title_array[5].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[5].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[5].'">'.$ev_title_array[5].'</a></h2>
                                                            <p>'.$ev_summary_array[5].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[5].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';

                                            } elseif ( $get_final_array[18] == $cellContent && $month_number7 == $this->currentMonth && $get_final_array[20] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[6].'">'.$ev_title_array[6].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[6].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[6].'">'.$ev_title_array[6].'</a></h2>
                                                            <p>'.$ev_summary_array[6].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[6].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';

                                            } elseif ( $get_final_array[21] == $cellContent && $month_number8 == $this->currentMonth && $get_final_array[23] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[7].'">'.$ev_title_array[7].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[7].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[7].'">'.$ev_title_array[7].'</a></h2>
                                                            <p>'.$ev_summary_array[7].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[7].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';

                                            } elseif ( $get_final_array[24] == $cellContent && $month_number9 == $this->currentMonth && $get_final_array[26] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[8].'">'.$ev_title_array[8].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[8].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[8].'">'.$ev_title_array[8].'</a></h2>
                                                            <p>'.$ev_summary_array[8].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[8].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';

                                            } elseif ( $get_final_array[27] == $cellContent && $month_number10 == $this->currentMonth && $get_final_array[29] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[9].'">'.$ev_title_array[9].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[9].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[9].'">'.$ev_title_array[9].'</a></h2>
                                                            <p>'.$ev_summary_array[9].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[9].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';                      

                                            } elseif ( $get_final_array[30] == $cellContent && $month_number11 == $this->currentMonth && $get_final_array[32] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[10].'">'.$ev_title_array[10].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[10].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[10].'">'.$ev_title_array[10].'</a></h2>
                                                            <p>'.$ev_summary_array[10].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[10].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';             

                                            } elseif ( $get_final_array[33] == $cellContent && $month_number12 == $this->currentMonth && $get_final_array[35] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[11].'">'.$ev_title_array[11].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[11].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[11].'">'.$ev_title_array[11].'</a></h2>
                                                            <p>'.$ev_summary_array[11].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[11].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';            

                                            } elseif ( $get_final_array[36] == $cellContent && $month_number13 == $this->currentMonth && $get_final_array[38] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[12].'">'.$ev_title_array[12].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[12].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[12].'">'.$ev_title_array[12].'</a></h2>
                                                            <p>'.$ev_summary_array[12].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[12].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';
                                            } elseif ( $get_final_array[39] == $cellContent && $month_number14 == $this->currentMonth && $get_final_array[41] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[13].'">'.$ev_title_array[13].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[13].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[13].'">'.$ev_title_array[13].'</a></h2>
                                                            <p>'.$ev_summary_array[13].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[13].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';
                                            } elseif ( $get_final_array[42] == $cellContent && $month_number15 == $this->currentMonth && $get_final_array[44] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[14].'">'.$ev_title_array[14].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[14].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[14].'">'.$ev_title_array[14].'</a></h2>
                                                            <p>'.$ev_summary_array[14].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[14].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';
                                            } elseif ( $get_final_array[45] == $cellContent && $month_number16 == $this->currentMonth && $get_final_array[47] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[15].'">'.$ev_title_array[15].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[15].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[15].'">'.$ev_title_array[15].'</a></h2>
                                                            <p>'.$ev_summary_array[15].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[15].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';

                                            } elseif ( $get_final_array[48] == $cellContent && $month_number17 == $this->currentMonth && $get_final_array[50] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[16].'">'.$ev_title_array[16].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[16].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[16].'">'.$ev_title_array[16].'</a></h2>
                                                            <p>'.$ev_summary_array[16].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[16].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';
                                            } elseif ( $get_final_array[51] == $cellContent && $month_number18 == $this->currentMonth && $get_final_array[53] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[17].'">'.$ev_title_array[17].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[17].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[17].'">'.$ev_title_array[17].'</a></h2>
                                                            <p>'.$ev_summary_array[17].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[17].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>'; 
                                            } elseif ( $get_final_array[54] == $cellContent && $month_number19 == $this->currentMonth && $get_final_array[56] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[18].'">'.$ev_title_array[18].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[18].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[18].'">'.$ev_title_array[18].'</a></h2>
                                                            <p>'.$ev_summary_array[18].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[18].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';
                                            } elseif ( $get_final_array[57] == $cellContent && $month_number20 == $this->currentMonth && $get_final_array[59] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[19].'">'.$ev_title_array[19].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[19].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[19].'">'.$ev_title_array[19].'</a></h2>
                                                            <p>'.$ev_summary_array[19].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[19].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';
                                            } elseif ( $get_final_array[61] == $cellContent && $month_number21 == $this->currentMonth && $get_final_array[62] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[20].'">'.$ev_title_array[20].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[20].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[20].'">'.$ev_title_array[20].'</a></h2>
                                                            <p>'.$ev_summary_array[20].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[20].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';
                                            } elseif ( $get_final_array[63] == $cellContent && $month_number22 == $this->currentMonth && $get_final_array[65] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[21].'">'.$ev_title_array[21].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[21].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[21].'">'.$ev_title_array[21].'</a></h2>
                                                            <p>'.$ev_summary_array[21].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[21].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';
                                            } elseif ( $get_final_array[66] == $cellContent && $month_number23 == $this->currentMonth && $get_final_array[68] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[22].'">'.$ev_title_array[22].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[22].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[22].'">'.$ev_title_array[22].'</a></h2>
                                                            <p>'.$ev_summary_array[22].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[22].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';
                                            } elseif ( $get_final_array[69] == $cellContent && $month_number24 == $this->currentMonth && $get_final_array[71] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[23].'">'.$ev_title_array[23].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[23].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[23].'">'.$ev_title_array[23].'</a></h2>
                                                            <p>'.$ev_summary_array[23].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[23].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';
                                            } elseif ( $get_final_array[72] == $cellContent && $month_number25 == $this->currentMonth && $get_final_array[74] == $this->currentYear){
                                                $content .= '<li class="event-date"><span class="date-pos">'.$cellContent.'</span>';
                                                $content .= '<span class="info"><a href="'.$ev_permalink_array[24].'">'.$ev_title_array[24].'</a></span>';
                                                $content .= '<div class="event-intro">
                                                        <img src="'.$img_arr[24].'">
                                                        <div class="event-content">
                                                            <h2><a href="'.$ev_permalink_array[24].'">'.$ev_title_array[24].'</a></h2>
                                                            <p>'.$ev_summary_array[24].'</p>
                                                            <a class="btn" href="'.$ev_permalink_array[24].'">'.__('Event Details', 'eventco').'</a>
                                                        </div>
                                                    </div></li>';                                                                                                                           
                                            }else {
                                                
                                                $dateTime = new DateTime();
                                                $today_date = $dateTime->format('Y-m-d');
                                                if ($this->currentDate >= $today_date) {
                                                    $content .= '<li><span class="recent-date">'.$cellContent.'</span></li>';
                                                }elseif ($this->currentDate <= $today_date) {
                                                    $content .= '<li><span>'.$cellContent.'</span></li>';
                                                } 

                                            }

                                            if( $j == 7 ):
                                                $content.='</ul>';
                                                if( $week_inc !=6 ):
                                                    $content.='<ul class="flex date">';     
                                                endif;
                                            endif;

                                        endfor;

                                        $week_inc++;
                                    endfor;    

                        $content.='</div>';
                    $content.='</div>';
                $content.='</div>';
            $content.='</div>';
                 
        return $content;   
    } # Next Month Event


}
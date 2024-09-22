<?php 

if( ! function_exists('_layout'))
{
    function _layout()
    {
        $CI =& get_instance();
       $html = $CI->load->view('Layouts/LoginLayout',[],true);  

        return $html;
    }
}



if( ! function_exists('_headerLayout')){

    function _headerLayout($custom_css = [],$title = 'TSU'){
        $CI =& get_instance();
        $data['custom_css'] = $custom_css;
        $data['title'] = $title;
       $html = $CI->load->view('Layouts/HeaderLayout',$data,true);

        return $html;
    }
}

if( ! function_exists('_FooterLayout')){

    function _FooterLayout($custom_js = []){
        $CI =& get_instance();
        $data['custom_js'] = $custom_js;
       $html = $CI->load->view('Layouts/FooterLayout',$data,true);

        return $html;
    }
}

if( ! function_exists('_getUserFullName')){

    function _getUserFullName($username){
        $CI =& get_instance();
        
       $CI->load->model('MainModel','main_m');
       
       $fullname = $CI->main_m->getUserFullName($username)->name;

        return $fullname;
    }
}

if( ! function_exists('_getUserProfile')){

    function _getUserProfile($username){
        $CI =& get_instance();
        
       $CI->load->model('MainModel','main_m');
       
       $fullname = $CI->main_m->getUserFullName($username)->ProfilePhoto;

        return $fullname;
    }
}
if( ! function_exists('_getUserRole')){

    function _getUserRole($username){
        $CI =& get_instance();
        
       $CI->load->model('MainModel','main_m');
       
       $fullname = $CI->main_m->getUserFullName($username)->Role;

        return $fullname;
    }
}
if (! function_exists('_getHrAgo')) {
   function _getHrAgo($date)
   {
       $now = new DateTime();
       $then = new DateTime($date);
       $diff = $now->diff($then);
       $hours = $diff->h + ($diff->days * 24);
       $minutes = $diff->i;
       $days = $diff->days;
       $weeks = floor($days / 7);
       $months = floor($days / 30);
       $years = floor($days / 365);
     
    
       if ($minutes < 1) {
           $return = "few seconds ago";
    //    } elseif ($minutes < 60) {
    //        $return = $minutes . " minutes ago";
       } elseif ($hours < 2) {
           $return = "1 hour ago";
       } elseif ($hours < 24) {
           $return = $hours . " hours ago";
       } elseif ($days < 2) {
           $return = "1 day ago";
       } elseif ($days < 7) {
           $return = $days . " days ago";
       } elseif ($weeks < 2) {
           $return = "1 week ago";
       } elseif ($weeks < 4) {
           $return = $weeks . " weeks ago";
       } elseif ($months < 2) {
           $return = "1 month ago";
       } elseif ($months < 12) {
           $return = $months . " months ago";
       } else {
           $return = $years . " years ago";
       }

       return $return;
   }
}

if( ! function_exists('_getDateStatus')){

    function _getDateStatus($date){
       $dateToCheck = new DateTime($date);
       $currentDate = new DateTime();
       
       $diff = $currentDate->diff($dateToCheck);
       
       if ($diff->invert === 1) {
           return 1;
       } else {
           return 0;
       }

    }
}

if( ! function_exists('_getStatusBadge')){

    function _getStatusBadge($value){
      
        $badge= '<span class="badge rounded-pill badge-primary">Upcoming</span>';
        if(_getDateStatus($value->EventStart) == 1){
            $badge= '<span class="badge rounded-pill badge-success">Ongoing</span>';
        }
        if(_getDateStatus($value->EventEnd) == 1){
            $badge= '<span class="badge rounded-pill badge-light">Ended</span>';

        }
        if($value->DeletedTag == 1){
            $badge= '<span class="badge rounded-pill badge-danger">Cancelled</span>';
        }

        return $badge;
        
    }
}


?>
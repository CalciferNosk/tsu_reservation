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

if( ! function_exists('_getAllUsers')){

    function _getAllUsers(){
        $CI =& get_instance();
       $CI->load->model('MainModel','main_m');
       $alluser = $CI->main_m->getAllUsers();
        return $alluser;
    }
}

if( ! function_exists('_cacheClean')){

    function _cacheClean(){
        $CI =& get_instance();
       $CI->load->model('MainModel','main_m');
       $alluser = $CI->main_m->clearCache();
        return $alluser;
    }
}

if( ! function_exists('_getUserProfile')){

    function _getUserProfile($username){

       
        $CI =& get_instance();
       $CI->load->model('MainModel','main_m');
       
       $fullname = $CI->main_m->getUserFullName($username);

        return !empty($fullname) ? $fullname->ProfilePhoto : 'default_user.jpg';
    }
}
if( ! function_exists('_getUserRole')){

    function _getUserRole($username){
        $CI =& get_instance();
        
       $CI->load->model('MainModel','main_m');
       if(empty($username)) return '--';
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

if (! function_exists('_getDateStatus')) {

    function _getDateStatus($date)
    {
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


if(! function_exists('_getDateBetween')){

    function _getDateBetween($start,$end){
        $startDate = $start;
        $endDate = $end;
        $checkDate = date('Y-m-d');
        // var_dump('<pre>',$checkDate, $startDate, $endDate);
        
        if ($startDate <= $checkDate && $checkDate <= $endDate) {
           return true;
        } else {
            return false;
        }
    }

}

if(! function_exists('_roundRobin')){

   function _roundRobin($teams) {
       $n = count($teams);
       $matches = [];
   
       // Shuffle the teams array to randomize the order
       shuffle($teams);
   
       for ($i = 0; $i < $n - 1; $i++) {
           for ($j = 0; $j < $n / 2; $j++) {
               $matches[] = [
                   'team1' => $teams[$j],
                   'team2' => $teams[$n - 1 - $j]
               ];
   
               if ($j > 0) {
                   $matches[] = [
                       'team1' => $teams[$n - $j],
                       'team2' => $teams[$n - 1 - $j]
                   ];
               }
           }
   
           // Rotate the teams array to create the next round
           $teams = array_merge([$teams[count($teams) - 1]], array_slice($teams, 0, count($teams) - 1));
       }
   
       return $matches;
   }
    
   
}

if(! function_exists('_generateSchedule')){
function _generateSchedule($bracket, $startDate) {
    $schedule = [];
    $matches = $bracket['matches'];
    $day = 1;
    $currentDate = strtotime($startDate);

    while ($matches) {
        $dayMatches = array_slice($matches, 0, 2);
        $matches = array_slice($matches, 2);

        $date = date('Y-m-d', $currentDate);
        $dayOfWeek = date('w', $currentDate); // 0 = Sunday, 1 = Monday, ..., 6 = Saturday

        // Skip Sundays and Saturdays
        if ($dayOfWeek == 0 || $dayOfWeek == 6) {
            $currentDate += 86400; // add 1 day
            continue;
        }

        $schedule[] = [
            'date' => $date,
            'matches' => $dayMatches
        ];

        $currentDate += 86400; // add 1 day
        $day++;
    }

    return $schedule;
}
}


if(! function_exists('_generateBracket')){
    function _generateBracket($teams) {
        $matches = _singleElimination($teams);
        $winners = [];
    
        foreach ($matches as $match) {
            $winners[] = 'Winner of ' . $match['team1'] . ' vs ' . $match['team2'];
        }
    
        return [
            'matches' => $matches,
            'winners' => $winners
        ];
    }
}

if(! function_exists('_singleElimination')){
    function _singleElimination($teams) {
        $n = count($teams);
        shuffle($teams);
        $matches = [];
    
        for ($i = 0; $i < $n / 2; $i++) {
            $matches[] = [
                'team1' => $teams[$i],
                'team2' => $teams[$n - 1 - $i]
            ];
        }
    
        return $matches;
    }
}

if (! function_exists('_getStatusBadge')) {

    function _getStatusBadge($value)
    {

        $badge = '<span class="badge rounded-pill badge-primary">Upcoming</span>';
        if (_getDateStatus($value->EventStart) == 1) {
            $badge = '<span class="badge rounded-pill badge-success">Ongoing</span>';
        }
        if (_getDateStatus($value->EventEnd) == 1) {
            $badge = '<span class="badge rounded-pill badge-light">Ended</span>';

        }
        if($value->DeletedTag == 1){
            $badge= '<span class="badge rounded-pill badge-danger">Cancelled</span>';
        }

        return $badge;
        
    }
}

if( ! function_exists('_getWorkgroupAccess')){

    function _getWorkgroupAccess($access_name){
      
        $CI =& get_instance();
       $CI->load->model('MainModel','main_m');
        $role_id = $_SESSION['role'];
       $check_access = $CI->main_m->getWorkgroupAccess($role_id)[0]->$access_name;

      
       return  (int)$check_access;
    }
}



if( ! function_exists('_getAllLocation')){

    function _getAllLocation(){
      
        $CI =& get_instance();
       $CI->load->model('MainModel','main_m');
       $location = $CI->main_m->getAllLocation();

       return $location;
    }
}
if( ! function_exists('_checkUserEvent')){

    function _checkUserEvent($username,$event_id){
      
        $CI =& get_instance();
       $CI->load->model('EventModel','event_m');
       $check = $CI->event_m->checkUserEvent($username,$event_id);

       return $check;
    }
}

if( ! function_exists('_checkUserDatByUsername')){

    function _checkUserDatByUsername($username,$column){
      
        $CI =& get_instance();
       $CI->load->model('EventModel','event_m');
       $check = $CI->event_m->checkUserDatByUsername($username,$column);

       return $check;
    }
}


if( ! function_exists('_getStaffEvent')){
    function _getStaffEvent($username,$event_id){
      
        $CI =& get_instance();
       $CI->load->model('EventModel','event_m');
       $check = $CI->event_m->getEventStaff($username,$event_id);

       return $check;
    }
}

if( ! function_exists('_getEventPhoto')){
    function _getEventPhoto($event_id){
      
        $CI =& get_instance();
       $CI->load->model('EventModel','event_m');
       $check = $CI->event_m->getEventPhoto($event_id);

       return $check;
    }
}

if( ! function_exists('_checkBookmarkByEventId')){

    function _checkBookmarkByEventId($event_id,$isDeleted = 0){
      
        $CI =& get_instance();
       $CI->load->model('MainModel','main_m');
        $role_id = $_SESSION['role'];
       $bool = $CI->main_m->checkBookmarkByEventId($event_id,$_SESSION['username'],$isDeleted);

       return  (int)$bool;
    }
}
if( ! function_exists('_getWorkgroupAccessbyRole')){

    function _getWorkgroupAccessbyRole($role_id){
      
        $CI =& get_instance();
       $CI->load->model('MainModel','main_m');
       $check_access = $CI->main_m->getWorkgroupAccessbyRole($role_id);
        $name = [];
        if($check_access->CreateEvent == 1){
           array_push($name,'CreateEvent') ;
        }
        if($check_access->Comment == 1){
            array_push($name,'Comment') ;
        }
        if($check_access->ViewEvent == 1){
            array_push($name,'ViewEvent') ;
        }
        if($check_access->ScanQR == 1){
            array_push($name,'ScanQR') ;
        }
        if($check_access->GenerateQR == 1){
            array_push($name,'GenerateQR') ;
        }

       return  implode(" | ", $name);
    }
}

if( ! function_exists('_getGenderNameById')){

    function _getGenderNameById($gender_id)
    {

      switch ($gender_id) {
        case 1:
            $gender = "Male";
            break;
        case 2:
            $gender = "Female";
            break;
        case 3:
            $gender = "Nonbinary and/or Intersex.";
            break;
        default:
            $gender = "Unknown";
            break;
    }

        return  $gender;
    }
}

if( ! function_exists('_getConcernCategory')){

    function _getConcernCategory()
    {

     $CI =& get_instance();
       $CI->load->model('MainModel','main_m');
       $concern = $CI->main_m->getConcernCategory();

       return  $concern;
    }


}

if( ! function_exists('_getConcernCategoryById')){

    function _getConcernCategoryById($cat_id)
    {

        $CI =& get_instance();
        $CI->load->model('MainModel','main_m');
        $concern = $CI->main_m->getConcernCategoryById($cat_id);
 
        return  $concern;
    }
}

if(!function_exists('_getAllCourses')){

    function _getAllCourses()
    {

        $CI =& get_instance();
        $CI->load->model('MainModel','main_m');
        $courses = $CI->main_m->getAllCourses();
 
        return  $courses;
     
    }


}

if( ! function_exists('_getEventDataById')){

    function _getEventDataById($event_id)
    {

     $CI =& get_instance();
       $CI->load->model('MainModel','main_m');
       $concern = $CI->main_m->getEventDataById($event_id);

       return  $concern;
    }


}

?>
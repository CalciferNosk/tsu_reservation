<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainModel extends CI_Model
{
    protected $tbl_courses = "tbl_courses";
    protected $tbl_user = "tbl_user";
    protected $tbl_content = "tbl_content_home";
    protected $tbl_content_comment = "tbl_content_comment";
    protected $tbl_event_list = "tbl_event_list";
    protected $tbl_event_type = "tbl_event_type";
    protected $tbl_event_location = "tbl_event_location";
    protected $tbl_event_attendees = "tbl_event_attendees";
    protected $tbl_workgroup = "tbl_workgroup";
    protected $tbl_workgruop_access = "tbl_workgruop_access";
    protected $tbl_event_bookmark = "tbl_event_bookmark";
    public function __construct()
    {   
        $this->max_concat = $this->db->query("SET SESSION group_concat_max_len = 18446744073709551615;");
        parent::__construct();
        date_default_timezone_set('Asia/Singapore');
    }

    public function getDataBySubject($subject){


        var_dump($subject);die;
    }
    public function getCourses(){
        
        $sql = "SELECT * FROM tbl_courses";
        return $this->db->query($sql)->result_object();
    }
    public function getFolder(){

        $sql = "SELECT * FROM tbl_folders";
        return $this->db->query($sql)->result_array();
    }
    public function insertUser($data_store,$user_id){
        $this->db->where('Email', $user_id); 
        return   $this->db->update($this->tbl_user, $data_store);
   

    }
    public function getContent($ids){
        $WHERE = "";
        if(!empty($ids)){
            $WHERE = " AND ContentId NOT IN ({$ids})";
        }
        $sql = "SELECT * FROM {$this->tbl_content} WHERE DeletedTag = 0 {$WHERE} ORDER BY ContentId DESC LIMIT 3";
        return $this->db->query($sql)->result_object();
    }

    public function getComments($ContentId){

        $sql = "SELECT * FROM {$this->tbl_content_comment} WHERE ContentId = {$ContentId}";
        return $this->db->query($sql)->result_object();
    }

    public function getUserFullName($username){

        $sql = "SELECT concat(u.Fname, ' ',u.Lname) as `name`,u.ProfilePhoto,wg.WorkgroupName as Role
                FROM {$this->tbl_user}  u
                LEFT JOIN  $this->tbl_workgroup wg on wg.wid = u.Role

                WHERE u.Username = '{$username}'";

                // var_dump($sql);
        
        return $this->db->query($sql)->row();
    }




    public function getAllUsers()
    {
        $this->load->driver('cache');
        $sql = "SELECT * FROM {$this->tbl_user} WHERE DeletedTag = 0";
        $cache_id = 'getAllUsers';

        if (!$this->cache->get($cache_id)) {
            $result = $this->db->query($sql)->result_object();
            $this->cache->save($cache_id, $result, 3600); // cache for 1 hour
        } else {
            $result = $this->cache->get($cache_id);
        }

        return $result;
    }

    public function clearCache()
    {
        $this->load->driver('cache');
        return $this->cache->clean();
    }
    public function getEventList($event_control){
        $control= '';
        if(!empty($event_control)){
            $control = " AND EventTypeId IN (1,2)";#replace with your EventTypeId
        }
        

       $get_event = "SELECT 
                         ev.*, ty.EventTypeName, ty.EventDescription,loc.LocationName
                    FROM
                        {$this->tbl_event_list} ev
                    LEFT JOIN 
                        {$this->tbl_event_type} ty on ty.id = ev.EventTypeId
                    LEFT JOIN 
                        {$this->tbl_event_location} loc on loc.id = ev.EventLocationId
                    WHERE ev.DeletedTag = 0 {$control} ORDER BY ev.EventId DESC";
    // var_dump($get_event);die;
     
        return $this->db->query($get_event)->result_object();
    }

    public function getAttendees($eventId){

        $sql = "SELECT * FROM {$this->tbl_event_attendees} WHERE EventId = {$eventId} AND DeletedTag = 0";
   
        $result = $this->db->query($sql)->result_object();
        foreach ($result as $key => $value) {
            $value->FullName = _getUserFullName($value->Username);
        }

        return $result;
    }

   public function reserveEventSlot($event_id,$user_id){
    $data = [

        'Username' => $user_id,
        'EventId'  => $event_id,
        'EventReserveDate' => date('Y-m-d H:i:s')
    ];

    return $this->db->insert($this->tbl_event_attendees,$data);
   }

   public function getWorkgroupAccess($workgroup_id){

    $sql = "SELECT * FROM {$this->tbl_workgruop_access} WHERE WorkgroupId = {$workgroup_id}"; 
 
    return $this->db->query($sql)->result_object();
   }
   public function getMyEvent($Username){
    $get_attendees = "
                SELECT 
                    *
                FROM
                    {$this->tbl_event_bookmark} as a
                LEFT JOIN 
                    {$this->tbl_event_list} el  on a.EventId = el.EventId
                    
                WHERE
                    a.Username = '{$Username}' AND a.DeletedTag = 0
                    
                ORDER BY el.EventStart ";
        return $this->db->query($get_attendees)->result_object();
   }

   public function deleteEvent($event_id){

    $sql = "UPDATE {$this->tbl_event_list} SET DeletedTag = 1 WHERE EventId = {$event_id}";
    return $this->db->query($sql);
   }
   public function getAllLocation(){

    $sql = "SELECT * FROM {$this->tbl_event_location}";
    return $this->db->query($sql)->result_object();
   }
   

   public function checkBookmarkByEventId($event_id,$user_id,$isDeleted){
    $isDeleted = $isDeleted == 1 ? '' : 'AND DeletedTag = 0';
    $sql = "SELECT * FROM {$this->tbl_event_bookmark} WHERE EventId = {$event_id} AND Username = '{$user_id}' {$isDeleted }";
    return $this->db->query($sql)->num_rows() > 0 ? true : false;
   }

  public function getUsersDataById($username){
    $sql = "SELECT * FROM {$this->tbl_user} WHERE Username = '{$username}'";
    return $this->db->query($sql)->row();
  }
  public function getWorkgroupAccessbyRole($role_id){

    $sql = "SELECT * FROM {$this->tbl_workgruop_access} WHERE WorkgroupId = {$role_id}";
    return $this->db->query($sql)->row();
  }

  public function getGenderNameById($id){

    $sql = "SELECT * FROM {$this->tbl_gender} WHERE id = {$id}";
    return $this->db->query($sql)->row();
  }
  public function updateProfile($file_name){

    $sql = "UPDATE {$this->tbl_user} SET ProfilePhoto = '{$file_name}' WHERE Username = '{$_SESSION['username']}'";
    return $this->db->query($sql);
  }

  public function updatePassword($new_password){
    $new_password = password_hash($new_password, PASSWORD_DEFAULT);
    $sql = "UPDATE {$this->tbl_user} SET Password = '{$new_password}' WHERE Username = '{$_SESSION['username']}'";
    return $this->db->query($sql);
  }
  public function updateDetails($data){

    $sql = "UPDATE {$this->tbl_user} SET Lname = '{$data['Lname']}',  Mname = '{$data['Mname']}', Fname = '{$data['Fname']}' WHERE Username = '{$_SESSION['username']}'";
    return $this->db->query($sql);
  }
}

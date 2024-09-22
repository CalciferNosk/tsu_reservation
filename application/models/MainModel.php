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
        $sql = "SELECT * FROM {$this->tbl_content} WHERE DeletedTag = 0 {$WHERE} ORDER BY ContentId DESC LIMIT 5";
        return $this->db->query($sql)->result_object();
    }

    public function getComments($ContentId){

        $sql = "SELECT * FROM {$this->tbl_content_comment} WHERE ContentId = {$ContentId}";
        return $this->db->query($sql)->result_object();
    }

    public function getUserFullName($username){

        $sql = "SELECT concat(Fname, ' ',Lname) as `name`,ProfilePhoto,Role FROM {$this->tbl_user} WHERE Username = '{$username}'";
        return $this->db->query($sql)->row();
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

        $sql = "SELECT * FROM {$this->tbl_event_attendees} WHERE EventId = {$eventId}";
        return $this->db->query($sql)->result_object();
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EventModel extends CI_Model
{
    protected $tbl_user = 'tbl_user';
    protected $tbl_event_list = 'tbl_event_list';
    protected $tbl_content_home = 'tbl_content_home';
    protected $tbl_event_attendees = 'tbl_event_attendees';
    protected $tbl_event_attendees_log = 'tbl_event_attendees_log';
    protected $tbl_event_staff = 'tbl_event_staff';
    protected $tbl_event_bookmark = "tbl_event_bookmark";
    protected $tbl_event_log = 'tbl_event_log';

    public function __construct()
    {
        $this->max_concat = $this->db->query("SET SESSION group_concat_max_len = 18446744073709551615;");
        parent::__construct();
    }

  public function insertEvent($store_data){

    $store = $this->db->insert($this->tbl_event_list, $store_data);

    return $store == TRUE ? $this->db->insert_id() : 0;
  }
  public function insertFeedContent($feed_content){

    $store = $this->db->insert($this->tbl_content_home, $feed_content);
    return $store;
  }
  public function getEvent($event_id){
    $sql = "SELECT * FROM {$this->tbl_event_list} WHERE EventId = {$event_id} AND DeletedTag = 0";


    return $this->db->query($sql)->row();
  }
  public function checkUserEvent($username,$event_id){

    $sql = "SELECT * FROM {$this->tbl_event_attendees} WHERE EventId = {$event_id} AND Username = '{$username}' AND DeletedTag = 0";
    $query = $this->db->query($sql);
    return $query->num_rows() > 0;
  }
  public function validateStudentEvent($event_id,$username){

    $sql = "SELECT * FROM {$this->tbl_event_log} WHERE EventId = {$event_id} AND Username = '{$username}' AND DeletedTag = 0 
    ";
    $query = $this->db->query($sql);
    return $query->row();
  }
  public function timeInStudentEvent($event_id,$username){
    $data = [
      "Username" => $username,
      // "GeneratedId" => date('YmdHis'),
      "EventId" => $event_id,
      'TimeInLog' => date('Y-m-d H:i:s')
    ];

    $store = $this->db->insert($this->tbl_event_log, $data);


    return $store ;
  }

  public function checkUserDatByUsername($username,$column){

    $sql = "SELECT $column FROM {$this->tbl_user} WHERE Username = '{$username}' AND DeletedTag = 0";
    $query = $this->db->query($sql);
    return $query->row()->$column;
  }

  public function getEventStaff($username,$event_id){
    $sql = "SELECT count(1) as staff_count FROM {$this->tbl_event_staff} WHERE Username = '{$username}' AND EventId = {$event_id} AND DeletedTag = 0";
    return $this->db->query($sql)->row()->staff_count;
  }
  

  public function checkUserLog($event_id,$username,$time_event){
    $sql = "SELECT count(1) as login_count FROM {$this->tbl_event_attendees_log} WHERE EventId = {$event_id} AND Username = '{$username}' AND TimeEvent = '{$time_event}' AND DeletedTag = 0";
    return $this->db->query($sql)->row()->login_count;
  }
  public function timeLog($data){

    $store = $this->db->insert($this->tbl_event_log, $data);
    return $store ;
  }
  public function update_log($event_id,$username){
    $today = date('Y-m-d H:i:s');
    $update = "UPDATE `tsu_reservation`.`tbl_event_log` SET `TimeOutLog` = '{$today}' WHERE `EventId` = '{$event_id}'AND Username = '{$username}'";
    return $this->db->query($update);
  }

  public function getEventPhoto($event_id){

    $sql = "SELECT * FROM {$this->tbl_content_home} WHERE EventId = {$event_id} AND DeletedTag = 0";
    $result = $this->db->query($sql);
    return  empty($result->row()) ? null : $result->row()->ContentImage;
  }
  public function insertBookmark($event_id,$user_id){
    $data = [
        'Username' => $user_id,
        'EventId'  => $event_id
    ];
    return $this->db->insert($this->tbl_event_bookmark,$data);
   }

   public function updatedBookmark($event_id,$user_id,$bookmark){
    $bookmark = $bookmark == 1 ? 0 : 1;
    $sql = "UPDATE {$this->tbl_event_bookmark} SET DeletedTag = {$bookmark} WHERE EventId = {$event_id} AND Username = '{$user_id}' ";
    return $this->db->query($sql);
   }

   public function updateEvent($data,$event_id){
    $this->db->where('EventId', $event_id);
    return $this->db->update($this->tbl_event_list, $data);
   }
}

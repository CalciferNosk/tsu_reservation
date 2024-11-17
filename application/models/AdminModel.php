<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
    protected $tbl_user = 'tbl_user';
    protected $tbl_event_list = 'tbl_event_list';
    protected $tbl_content_home = 'tbl_content_home';
    protected $tbl_event_attendees = 'tbl_event_attendees';
    protected $tbl_event_attendees_log = 'tbl_event_attendees_log';
    protected $tbl_event_staff = 'tbl_event_staff';
    protected $tbl_workgroup = 'tbl_workgroup';

    public function __construct()
    {
        $this->max_concat = $this->db->query("SET SESSION group_concat_max_len = 18446744073709551615;");
        parent::__construct();
    }

  public function getAllEvents(){

    $sql = "SELECT * FROM {$this->tbl_event_list} WHERE DeletedTag = 0";
    $query = $this->db->query($sql);
    return $query->result_object();
  }
  public function getAllUsers($role){
    $sql = "SELECT * FROM {$this->tbl_user} WHERE DeletedTag = 0 AND Role = {$role}"; ;
    $query = $this->db->query($sql);
    return $query->result_object();
  }
  public function getAllWorkgroup(){

    $sql = "SELECT * FROM {$this->tbl_workgroup} WHERE DeletedTag = 0";
    $query = $this->db->query($sql);
    return $query->result_object();
  }
    public function updateUser($data){
      
      $this->db->where('id', $data['id']);
      return $this->db->update($this->tbl_user, $data);
    }
}

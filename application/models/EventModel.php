<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EventModel extends CI_Model
{
    protected $tbl_event_list = 'tbl_event_list';
    protected $tbl_content_home = 'tbl_content_home';
    protected $tbl_event_attendees = 'tbl_event_attendees';
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
}

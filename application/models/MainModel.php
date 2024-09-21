<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainModel extends CI_Model
{
    protected $tbl_courses = "tbl_courses";
    protected $tbl_user = "tbl_user";
    protected $tbl_content = "tbl_content";
    protected $tbl_content_comment = "tbl_content_comment";

    public function __construct()
    {   
        $this->max_concat = $this->db->query("SET SESSION group_concat_max_len = 18446744073709551615;");
        parent::__construct();
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
    public function getContent(){

        $sql = "SELECT * FROM {$this->tbl_content}";
        return $this->db->query($sql)->result_object();
    }

    public function getComments($ContentId){

        $sql = "SELECT * FROM {$this->tbl_content_comment} WHERE ContentId = {$ContentId}";
        return $this->db->query($sql)->result_object();
    }
    public function checkRecord($username){
        
    }
  
}

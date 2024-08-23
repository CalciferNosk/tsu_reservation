<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainModel extends CI_Model
{

    public function __construct()
    {   
        $this->max_concat = $this->db->query("SET SESSION group_concat_max_len = 18446744073709551615;");
        parent::__construct();
    }

    public function getDataBySubject($subject){


        var_dump($subject);die;
    }
    public function getFolder(){

        $sql = "SELECT * FROM tbl_folders";
        return $this->db->query($sql)->result_array();
    }

    public function checkRecord($username){
        
    }
  
}

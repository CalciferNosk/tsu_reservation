<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReportModel extends CI_Model
{
    protected $tbl_user = 'tbl_user';
    protected $tbl_event_log = 'tbl_event_log';
    public function __construct()
    {
        $this->max_concat = $this->db->query("SET SESSION group_concat_max_len = 18446744073709551615;");
        parent::__construct();
    }

    public function getAttandanceByUser($user,$from,$to){
        $wher_user = $user = 'All' ? '' : "AND Username = '{$user}'";
        $select = "SELECT * FROM  {$this->tbl_event_log} WHERE CreatedDate BETWEEN '{$from}' AND '{$to}' {$wher_user} ";

        return  $this->db->query($select)->result_object();

    }
}

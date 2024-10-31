<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{
    protected $tbl_user = 'tbl_user';
    public function __construct()
    {
        $this->max_concat = $this->db->query("SET SESSION group_concat_max_len = 18446744073709551615;");
        parent::__construct();
    }

    public function checkUserExist($email)
    {

        $this->db->where('Email', $email);
        $query = $this->db->get($this->tbl_user);
        // var_dump($this->db->last_query());die;   
        return $query->row();
    }

    public function addUser($email, $pass){

        $data = array(
            'Email' => $email,
            'Password' =>password_hash($pass, PASSWORD_DEFAULT),
            'salt'  => '$2y$10$4K5jV4Q4K5jV4Q4K5jV4Q4K5jV4Q4K5jV4Q4K5jV4Q4K5j',
            
        );

       return $this->db->insert($this->tbl_user,$data);

    }
}

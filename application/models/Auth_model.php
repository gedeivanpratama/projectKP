<?php

class Auth_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function register($table,$data)
    {
        $result = $this->db->insert($table, $data);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function login($data){

        $sql = "SELECT email,password FROM tb_user WHERE email = ?";
        $query = $this->db->query($sql, array($data['email']));
        $row = $query->row();

        if($query->num_rows() == 1){
            $password = password_verify($data['password'],$row->password);
            if($password){
                return true;
            }
        }
        return false;
    }
    
}
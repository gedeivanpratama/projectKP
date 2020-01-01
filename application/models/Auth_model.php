<?php

class Auth_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function register($table,$data){
        $result = $this->db->insert($table, $data);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function hashVal($table,$email){
        $this->db->select('password');
        $this->db->from($table);
        $this->db->where('email_seller',$email);
        $query = $this->db->get();
        foreach($query->row_array() as $val ){
            return $val;
        }
    }

    public function login($email,$pass, $data){
        $this->db->select('*');
        $this->db->from('tb_seller');
        $this->db->where('email_seller', $email);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            $hash = $this->hashVal('tb_seller',$email);
            $password = password_verify($pass,$hash);
            if($password){
                return true;
            }
        }else{
            return false;
        }
    }





    public function hashVal2($table,$email){
        $this->db->select('customer_password');
        $this->db->from($table);
        $this->db->where('email_customer',$email);
        $query = $this->db->get();
        foreach($query->row_array() as $val ){
            return $val;
        }
    }

    public function login2($email,$pass, $data){
        $this->db->select('*');
        $this->db->from('tb_customer');
        $this->db->where('email_customer', $email);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            $hash = $this->hashVal2('tb_customer',$email);
            $password = password_verify($pass,$hash);
            if($password){
                return true;
            }
        }else{
            return false;
        }
    }
}
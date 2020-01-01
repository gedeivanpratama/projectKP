<?php

class Api_Model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getColumn($column,$table,$where,$data)
    {
        $query = $this->db->query("SELECT ".$column." FROM ".$table." WHERE ".$where." = ".$data);
        return $query->row_array();
    }

    public function deleteBooking()
    {
        $query = $this->db->query("");

    }

    public function insertdata($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function deleteData($table,$where,$id)
    {
        $this->db->where($where,$id);
        $result = $this->db->delete($table);
        return $result;
    }

    public function getCustomerInfo($id_customer)
    {
        $sql = "SELECT nama_customer, telp_customer, email_customer FROM tb_customer WHERE id_customer = ?";
        $result = $this->db->query($sql, [$id_customer]);
        return $result->row_array();
    }

    public function getHotelPayment($idHotel)
    {
        $sql = 'SELECT id_payment, payment_owner, bank_name, no_rek FROM tb_payment WHERE id_hotel = ?';
        $result = $this->db->query($sql,[$idHotel]);
        return $result->result_array();
    }
}
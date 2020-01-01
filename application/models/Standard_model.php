<?php

class Standard_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getHotelRoomByDate($check_in){
        $sql = "SELECT tb_kamar.id_kamar, tb_kamar.no_kamar, tb_kamar.id_type, tb_kamar.id_status from tb_kamar
        LEFT JOIN tb_reservasi on tb_kamar.id_kamar = tb_reservasi.id_kamar
        WHERE tb_reservasi.check_out < ? OR tb_reservasi.check_out is null";
    
        $query = $this->db->query($sql,[$check_in]);
        return $query->result_array();
    }

    public function getDenah($id)
    {
        $sql = "SELECT id_denah, tb_denah.id_type, tb_denah.description, tb_denah.denah, tb_type.nama_type FROM tb_denah JOIN tb_type ON tb_denah.id_type = tb_type.id_type JOIN tb_hotel ON tb_hotel.id_hotel = tb_type.id_hotel WHERE tb_hotel.id_hotel = ?";
        $result = $this->db->query($sql,[$id]);
        return $result->result_array();
    }

    public function getSingle($table,$where,$id){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where,$id);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function getAllType($id)
    {
        $sql = "SELECT tbT.id_type, tbT.nama_type, tbT.image_kamar, tbD.denah, tbT.harga, tbT.id_hotel, tbD.id_denah, tbD.description FROM tb_type AS tbT LEFT JOIN tb_denah AS tbD ON tbT.id_type = tbD.id_type WHERE tbT.id_hotel = ?";
        $result = $this->db->query($sql, [$id]);
        return $result->result_array();
    }

    public function getAllType1($id)
    {
        $sql = "SELECT tbD.id_denah, tbD.denah, tbT.harga, tbT.id_hotel, tbD.id_denah, tbD.description FROM tb_type AS tbT LEFT JOIN tb_denah AS tbD ON tbT.id_type = tbD.id_type WHERE tbT.id_hotel = ?";
        $result = $this->db->query($sql, [$id]);
        return $result->result_array();
    }

    public function getAll($table,$where,$id){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where,$id);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getAllData($table){
        $this->db->select('*');
        $this->db->from($table);
        $result= $this->db->get();
        return $result->result_array();
    }

    public function insertData($table,$data){
        return $this->db->insert($table,$data);
    }

    public function updateData($table, $data, $where, $id){
        $this->db->where($where, $id);
        $this->db->update($table, $data);
        $result = $this->db->affected_rows();
        if($result > 0){
            return true;
        }else{
            return false;
        }
    }

    public function updateData2($table, $data, $where, $id){

        $result = $this->db->update($table, $data, array($where => $id));
        
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function deleteData($tb, $where,$id){
        $this->db->where($where, $id);
        $result = $this->db->delete($tb);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function countData($table,$where="",$id=""){
        if(empty($where) || empty($id)){
            $this->db->select('*');
            $this->db->from($table);
            $result= $this->db->get();
            return $result->num_rows();    
        }else{
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($where,$id);
            $result= $this->db->get();
            return $result->num_rows();    
        }
    }

    public function getId($table,$select,$where,$data)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where,$data);
        $result= $this->db->get();
        return $result->row_array();  
    }

}
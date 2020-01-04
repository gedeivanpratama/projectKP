<?php

class Web_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function search($addr){
        $this->db->select('nama_hotel,alamat_hotel,email_hotel,telp_hotel,image_hotel,id_seller,tb_hotel.id_hotel, MAX(harga) as harga');
        $this->db->from('tb_hotel');
        $this->db->join('tb_type','tb_hotel.id_hotel = tb_type.id_hotel');
        // $this->db->where('alamat_hotel',$addr);
        $this->db->like('alamat_hotel',$addr);
        $this->db->group_by('tb_hotel.id_hotel');

        $result = $this->db->get();
        return $result->result_array();
    }

    public function getHotelDetails($id){
        $this->db->select('tb_hotel.id_hotel,nama_hotel,alamat_hotel,email_hotel,telp_hotel,image_hotel, MIN(harga) as harga');
        $this->db->from('tb_hotel');
        $this->db->join('tb_type','tb_type.id_hotel = tb_hotel.id_hotel');
        $this->db->where('tb_hotel.id_hotel',$id);
        $this->db->group_by('tb_hotel.id_hotel');
        $result = $this->db->get();
        return $result->row_array();
    }

    public function getRoom()
    {
        $sql = "SELECT id_reservasi,check_out, tb_kamar.id_kamar, no_kamar, tb_kamar.id_type FROM tb_reservasi
        RIGHT JOIN tb_kamar ON tb_reservasi.id_kamar = tb_kamar.id_kamar";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
<?php

class Customer_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getCustomerReservation($idC){
        $this->db->select('tb_reservasi.id_reservasi, telp_hotel,email_hotel,alamat_hotel,tb_type.id_type,tb_kamar.id_kamar,tb_hotel.id_hotel,check_in, check_out, total_price, nama_hotel,nama_type, nama_status, no_kamar, tb_reservasi.id_status_reservasi');
        $this->db->from('tb_reservasi');
        $this->db->join('tb_hotel','tb_reservasi.id_hotel = tb_hotel.id_hotel');
        $this->db->join('tb_status_reservasi','tb_reservasi.id_status_reservasi = tb_status_reservasi.id_status_reservasi');
        $this->db->join('tb_type','tb_reservasi.id_type = tb_type.id_type');
        $this->db->join('tb_kamar','tb_reservasi.id_kamar = tb_kamar.id_kamar');
        $this->db->join('tb_user','tb_reservasi.id_user = tb_user.id');
        $data = array(
            'tb_user.id' => $idC,
            'tb_reservasi.id_status_reservasi !=' => 4,
            'tb_reservasi.id_status_reservasi !=' => 5
        );
        $this->db->where($data);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getCustomerCancel($idC){
        $this->db->select('tb_reservasi.id_reservasi, telp_hotel,email_hotel,alamat_hotel,tb_type.id_type,tb_kamar.id_kamar,tb_hotel.id_hotel,check_in, check_out, total_price, nama_hotel,nama_type, nama_status,  no_kamar, tb_reservasi.id_status_reservasi');
        $this->db->from('tb_reservasi');
        $this->db->join('tb_hotel','tb_reservasi.id_hotel = tb_hotel.id_hotel');
        $this->db->join('tb_status_reservasi','tb_reservasi.id_status_reservasi = tb_status_reservasi.id_status_reservasi');
        $this->db->join('tb_type','tb_reservasi.id_type = tb_type.id_type');
        $this->db->join('tb_kamar','tb_reservasi.id_kamar = tb_kamar.id_kamar');
        $this->db->join('tb_user','tb_reservasi.id_user = tb_user.id');
        $data = array(
            'tb_user.id' => $idC,
            'tb_reservasi.id_status_reservasi' => 4
        );
        $this->db->where($data);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getDataPDF($id){

        $sql = "SELECT tb_hotel.id_hotel, tb_reservasi.id_reservasi, check_in,check_out, total_price, nama_hotel, alamat_hotel, 
        email_hotel, telp_hotel, image_hotel,customer.name as nama_customer, customer.id as id_customer,
        customer.telp as telp_customer, cus.email as email_customer, customer.address as alamat_customer, 
        seller.name, nama_type, no_kamar,harga, tb_hotel.id_hotel, tb_status_reservasi.id_status_reservasi,
        sender_name, bank_sender,no_rek_sender
        FROM tb_reservasi
        JOIN tb_confirm ON tb_reservasi.id_reservasi = tb_confirm.id_reservasi
        JOIN tb_hotel ON tb_reservasi.id_hotel = tb_hotel.id_hotel 
        JOIN tb_user AS cus ON cus.id = tb_reservasi.id_user 
        JOIN tb_profile AS customer ON customer.id_user = cus.id 
        JOIN tb_status_reservasi ON tb_status_reservasi.id_status_reservasi = tb_reservasi.id_status_reservasi JOIN tb_type ON tb_type.id_type = tb_reservasi.id_type 
        JOIN tb_kamar ON tb_kamar.id_kamar = tb_reservasi.id_kamar 
        JOIN tb_user AS sel ON tb_hotel.id_user = sel.id 
        JOIN tb_profile AS seller ON seller.id_user = sel.id 
        WHERE tb_reservasi.id_reservasi = ?";
        $result = $this->db->query($sql, array($id));
        return $result->row_array();
        
    }

    public function getdataConfirm($idR){
        $this->db->select('*');
        $this->db->from('tb_confirm');
        $this->db->join('tb_payment','tb_payment.id_payment = tb_confirm.id_payment');
        $this->db->where('tb_confirm.id_reservasi',$idR);
        $result = $this->db->get();
        return $result->row_array();
    }
}
<?php

class Customer_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getCustomerReservation($idC){
        $this->db->select('tb_reservasi.id_reservasi, telp_hotel,email_hotel,alamat_hotel,tb_type.id_type,tb_kamar.id_kamar,tb_hotel.id_hotel,check_in, check_out, total_price, nama_hotel,nama_type, nama_status,  no_kamar, tb_reservasi.id_status_reservasi, data_api');
        $this->db->from('tb_reservasi');
        $this->db->join('tb_hotel','tb_reservasi.id_hotel = tb_hotel.id_hotel');
        $this->db->join('tb_status_reservasi','tb_reservasi.id_status_reservasi = tb_status_reservasi.id_status_reservasi');
        $this->db->join('tb_type','tb_reservasi.id_type = tb_type.id_type');
        $this->db->join('tb_kamar','tb_reservasi.id_kamar = tb_kamar.id_kamar');
        $this->db->join('tb_customer','tb_reservasi.id_customer = tb_customer.id_customer');
        $data = array(
            'tb_customer.id_customer' => $idC,
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
        $this->db->join('tb_customer','tb_reservasi.id_customer = tb_customer.id_customer');
        $data = array(
            'tb_customer.id_customer' => $idC,
            'tb_reservasi.id_status_reservasi' => 4
        );
        $this->db->where($data);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getDataPDF($id){
        $this->db->select('*');
        $this->db->from('tb_reservasi');
        $this->db->join('tb_customer','tb_reservasi.id_customer = tb_customer.id_customer');
        $this->db->join('tb_hotel','tb_hotel.id_hotel = tb_reservasi.id_hotel');
        $this->db->join('tb_seller','tb_hotel.id_seller = tb_seller.id_seller');
        $this->db->join('tb_status_reservasi','tb_status_reservasi.id_status_reservasi = tb_reservasi.id_status_reservasi');
        $this->db->join('tb_type','tb_type.id_type = tb_reservasi.id_type');
        $this->db->join('tb_kamar','tb_kamar.id_kamar = tb_reservasi.id_kamar');
        // $this->db->join('tb_event','tb_event.id_event = tb_reservasi.id_event');
        $this->db->where('tb_reservasi.id_reservasi',$id);
        $result = $this->db->get();
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
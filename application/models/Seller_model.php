<?php

class Seller_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getHotelLists($where,$id){
        $this->db->select('*,tb_hotel.id_hotel');
        $this->db->from('tb_hotel');
        //$this->db->join('tb_fasilitas_hotel','tb_hotel.id_hotel = tb_fasilitas_hotel.id_hotel','left');
        $this->db->where($where,$id);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getRoomTypeLists($idH){
        $this->db->select('*,tb_type.id_type');
        $this->db->from('tb_type');
        $this->db->join('tb_event',' tb_type.id_type = tb_event.id_type','left');
        $this->db->where('id_hotel',$idH);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getRoomLists($idT){
        $this->db->select('*');
        $this->db->from('tb_kamar');
        $this->db->where('id_type',$idT);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getHotelFacility($idS){
        $this->db->select('*');
        $this->db->from('tb_hotel');
        $this->db->join('tb_fasilitas_hotel','tb_fasilitas_hotel.id_hotel = tb_hotel.id_hotel');
        $this->db->join('tb_user','tb_hotel.id_user = tb_user.id');
        $this->db->where('tb_user.id',$idS);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getTypeFacility($idS,$idH){
        $this->db->select('id_fasilitas_kamar,nama_fasilitas,jumlah_fasilitas,tb_fasilitas_kamar.id_type,nama_hotel,nama_type, tb_hotel.id_hotel');
        $this->db->from('tb_fasilitas_kamar');
        $this->db->join('tb_type','tb_fasilitas_kamar.id_type = tb_type.id_type');
        $this->db->join('tb_hotel','tb_type.id_hotel = tb_hotel.id_hotel');
        $this->db->join('tb_user','tb_hotel.id_user = tb_user.id');
        $where = array(
            'tb_user.id' => $idS,
            'tb_hotel.id_hotel' => $idH
        );
        $this->db->where($where);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getEvent($idH){
        $this->db->select('id_event, nama_event, start_event, end_event,discount,nama_type, tb_type.id_type');
        $this->db->from('tb_event');
        $this->db->join('tb_type','tb_event.id_type = tb_type.id_type');
        $this->db->join('tb_hotel','tb_hotel.id_hotel = tb_type.id_hotel');
        $this->db->where('tb_hotel.id_hotel',$idH);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getPayment($id){
        $this->db->select('id_payment,payment_owner,bank_name,no_rek,tb_hotel.id_hotel, nama_hotel');
        $this->db->from('tb_payment');
        $this->db->join('tb_hotel','tb_hotel.id_hotel = tb_payment.id_hotel');
        $this->db->join('tb_user','tb_hotel.id_user = tb_user.id');
        $this->db->where('tb_user.id',$id);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getSellerReservation($id, $idhotel){
        $this->db->select('id_reservasi, check_in, check_out, total_price, tb_reservasi.id_user, tb_profile.name, tb_reservasi.id_hotel, nama_hotel, tb_reservasi.id_type, nama_type, tb_reservasi.id_kamar, no_kamar, tb_reservasi.id_status_reservasi, nama_status, tb_profile.name');
        $this->db->from('tb_reservasi');
        $this->db->join('tb_hotel','tb_reservasi.id_hotel = tb_hotel.id_hotel');
        $this->db->join('tb_status_reservasi','tb_status_reservasi.id_status_reservasi = tb_reservasi.id_status_reservasi');
        $this->db->join('tb_type','tb_type.id_type = tb_reservasi.id_type');
        $this->db->join('tb_kamar','tb_kamar.id_kamar = tb_reservasi.id_kamar');
        $this->db->join('tb_user','tb_hotel.id_user = tb_user.id');
        $this->db->join('tb_profile','tb_profile.id_user = tb_reservasi.id_user');
        $this->db->where('tb_user.id',$id);
        $this->db->where('tb_hotel.id_hotel',$idhotel);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getSellerInfoBooking($id){
        $this->db->select('tb_confirm.id_confirm,tb_reservasi.id_reservasi, check_in, check_out, total_price, tb_reservasi.id_customer, nama_customer, tb_reservasi.id_hotel, nama_hotel, tb_reservasi.id_type, nama_type, tb_reservasi.id_kamar, no_kamar, tb_reservasi.id_status_reservasi, nama_status');
        $this->db->from('tb_reservasi');
        $this->db->join('tb_confirm','tb_confirm.id_reservasi = tb_reservasi.id_reservasi');
        $this->db->join('tb_hotel','tb_reservasi.id_hotel = tb_hotel.id_hotel');
        $this->db->join('tb_customer','tb_customer.id_customer = tb_reservasi.id_customer');
        $this->db->join('tb_status_reservasi','tb_status_reservasi.id_status_reservasi = tb_reservasi.id_status_reservasi');
        $this->db->join('tb_type','tb_type.id_type = tb_reservasi.id_type');
        $this->db->join('tb_kamar','tb_kamar.id_kamar = tb_reservasi.id_kamar');
        $this->db->join('tb_seller','tb_hotel.id_seller = tb_seller.id_seller');
        
        $data = array(
            'tb_seller.id_seller' => $id,
            'tb_status_reservasi.id_status_reservasi' => 2
        );
        
        $this->db->where($data);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getVerifyReservation($id){
        $this->db->select('id_reservasi, check_in, check_out, total_price, nama_customer, telp_customer, email_customer,nama_hotel, alamat_hotel, nama_type, no_kamar');
        $this->db->from('tb_reservasi');
        $this->db->join('tb_hotel','tb_hotel.id_hotel = tb_reservasi.id_hotel');
        $this->db->join('tb_customer','tb_customer.id_customer = tb_reservasi.id_customer');
        $this->db->join('tb_type','tb_type.id_type = tb_reservasi.id_type');
        $this->db->join('tb_kamar','tb_kamar.id_kamar = tb_reservasi.id_kamar');
        $this->db->where('tb_reservasi.id_reservasi',$id);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function getVerifyPayment($id){
        $this->db->select('id_confirm, sender_name, bank_sender, no_rek_sender, total_transfer, transfer_time, payment_owner, bank_name, no_rek');
        $this->db->from('tb_confirm');
        $this->db->join('tb_payment','tb_confirm.id_payment = tb_payment.id_payment');
        $this->db->where('tb_confirm.id_confirm',$id);
        $result = $this->db->get();
        return $result->row_array();
    }



    public function getSReservationDetail($id){
        $sql = "SELECT tb_hotel.id_hotel, id_reservasi, check_in,check_out, total_price, nama_hotel, alamat_hotel, 
                email_hotel, telp_hotel, image_hotel,customer.name as nama_customer, customer.id as id_customer,
                customer.telp as telp_customer, cus.email as email_customer, customer.address as alamat_customer, 
                seller.name, nama_type, no_kamar, tb_hotel.id_hotel, tb_status_reservasi.id_status_reservasi
                FROM tb_reservasi
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

    public function getCountReservation($id){   
        $this->db->select('*');
        $this->db->from('tb_reservasi');
        $this->db->join('tb_hotel','tb_reservasi.id_hotel = tb_hotel.id_hotel');
        $this->db->join('tb_user','tb_user.id = tb_hotel.id_user');
        $this->db->where('tb_user.id', $id);
        $result= $this->db->get();
        return $result->num_rows();    
    }

    public function getCountPayment($id){
        $this->db->select('tb_confirm.id_confirm,tb_reservasi.id_reservasi, check_in, check_out, total_price, tb_reservasi.id_user, tb_profile.name, tb_reservasi.id_hotel, nama_hotel, tb_reservasi.id_type, nama_type, tb_reservasi.id_kamar, no_kamar, tb_reservasi.id_status_reservasi, nama_status');
        $this->db->from('tb_reservasi');
        $this->db->join('tb_confirm','tb_confirm.id_reservasi = tb_reservasi.id_reservasi');
        $this->db->join('tb_hotel','tb_reservasi.id_hotel = tb_hotel.id_hotel');
        $this->db->join('tb_user','tb_user.id = tb_reservasi.id_user');
        $this->db->join('tb_profile','tb_profile.id_user = tb_user.id');
        $this->db->join('tb_status_reservasi','tb_status_reservasi.id_status_reservasi = tb_reservasi.id_status_reservasi');
        $this->db->join('tb_type','tb_type.id_type = tb_reservasi.id_type');
        $this->db->join('tb_kamar','tb_kamar.id_kamar = tb_reservasi.id_kamar');
        $data = array(
            'tb_user.id' => $id,
            'tb_status_reservasi.id_status_reservasi' => 2
        );
        $this->db->where($data);
        $result = $this->db->get();
        return $result->num_rows();
    }
}
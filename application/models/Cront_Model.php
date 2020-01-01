<?php

class Cront_Model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getReservationStatus($date)
    {
        $sql = 'SELECT TK.id_kamar, TK.no_kamar, TK.id_type, TR.id_reservasi, TR.check_in, TR.check_out, TR.total_price, TR.id_customer, TR.id_hotel, TR.id_status_reservasi, TR.id_type, TR.id_kamar, TR.id_event
        FROM tb_kamar as TK
        LEFT JOIN tb_reservasi as TR ON TK.id_kamar = TR.id_kamar
        WHERE TR.check_out < ? ';
        $query = $this->db->query($sql,[$date]);
        return $query->result_array();
    }

    public function getReservationIdStatus($id)
    {
        $sql = 'SELECT id_kamar, check_out, id_status_reservasi, id_reservasi FROM tb_reservasi WHERE id_status_reservasi NOT IN (?)';
        $query = $this->db->query($sql,[$id]);
        return $query->result_array();
    }

    public function getBooking()
    {
        $sql = 'SELECT book_at FROM `tb_reservasi` where id_status_reservasi =1 or 2';
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
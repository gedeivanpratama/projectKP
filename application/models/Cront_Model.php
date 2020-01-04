<?php

class Cront_Model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getReservationStatus()
    {
        $sql = "SELECT id_reservasi, id_status_reservasi, id_kamar, book_at FROM tb_reservasi WHERE book_at BETWEEN DATE_SUB(NOW(), INTERVAL 1 HOUR) AND DATE_ADD(NOW(), INTERVAL 1 HOUR) AND id_status_reservasi = 1";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getReservationIdStatus($id)
    {
        $sql = 'SELECT id_kamar, check_out, id_status_reservasi, id_reservasi FROM tb_reservasi WHERE id_status_reservasi NOT IN (?)';
        $query = $this->db->query($sql,[$id]);
        return $query->result_array();
    }

}
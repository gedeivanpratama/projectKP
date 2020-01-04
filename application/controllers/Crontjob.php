<?php

class Crontjob extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library(array('session'));
        $this->load->model(array('Cront_Model','Standard_model'));
    }
    
    public function checkStatusReservation()
    {
        $reservasi = $this->Cront_Model->getReservationStatus();
        foreach ($reservasi as $value) {
            // jika booking time lewat dari lima menit
            if(time() - strtotime($value['book_at']) > 5 * 60){
                $this->Standard_model->deleteData('tb_reservasi','id_reservasi',$value['id_reservasi']);
            }
        }
    }
}

<?php

class Crontjob extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library(array('session'));
        $this->load->model(array('Api_model','Cront_Model'));
    }
    
    public function checkStatusBooking()
    {
        $reservasi = $this->Cront_Model->getbooking();

        foreach($reservasi as $key => $value) {
            $date = new DateTime($value['book_at']);
            $date->modify('+2 hour');
            $start = $date->format('H');
            $end = date('H');
            if($start === $end){
                $this->Api_model->deleteBooking();
            }
        }
    }

    public function checkStatusReservation()
    {
        $today = date("Y-m-d h:i:s");

        $reservasi = $this->Cront_Model->getReservationStatus($today);
        
        for ($i=0; $i < count($reservasi); $i++) { 
            
            $data = [
                'id_reservasi' => $reservasi[$i]['id_reservasi'],
                'check_in' => $reservasi[$i]['check_in'],
                'check_out' => $reservasi[$i]['check_out'],
                'total_price' => $reservasi[$i]['total_price'],
                'id_customer' => $reservasi[$i]['id_customer'],
                'id_hotel' => $reservasi[$i]['id_hotel'],
                'id_status_reservasi' => $reservasi[$i]['id_status_reservasi'],
                'id_type' => $reservasi[$i]['id_type'],
                'id_kamar' => $reservasi[$i]['id_kamar'],
                'id_event' => $reservasi[$i]['id_event'],
            ];

            $insert = $this->Api_Model->insertData('tb_archive',$data);
            if($insert){
                $this->Api_Model->deleteData('tb_reservasi','id_reservasi',$reservasi[$i]['id_reservasi']);
            }

        }
    }
}
<?php

class Web extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation','session','Bridge','Token'));
        $this->load->model(array('Standard_model','Seller_model','Web_model','Api_Model', 'Cront_Model'));
    }
    
    public function index()
    {
        $this->form_validation->set_rules('search','Search','required');
        $this->form_validation->set_rules('check_in','Check In','required');
        $this->form_validation->set_rules('check_out','Check Out','required');
        $today = date("Y-m-d");
        $address = $this->input->post('search');
        $data['keyword'] = $address;
        $data['search'] = $this->Web_model->search($address);
        
        
        if($this->form_validation->run() === FALSE){
            $this->load->view('web/front_page',$data);
            
        }else{
            $check_in = $this->input->post('check_in');
            $check_out = $this->input->post('check_out');
            
            
            if(strtotime($check_in) < strtotime($today) || strtotime($check_out) <= strtotime($today) ){
                $this->session->set_flashdata('title','Search Hotel');
                $this->session->set_flashdata('info','Invalid');
                $this->session->set_flashdata('status','Warning');
                redirect(base_url());
            }else{
                $this->session->set_flashdata('title','Search Hotel');
                $this->session->set_flashdata('info','Search Hotel');
                $this->session->set_userdata('check_in', $check_in);
                $this->session->set_userdata('check_out', $check_out);
                $this->load->view('web/front_page', $data);
                
            } 
            
        }
    }

    public function hotelDetails($idH)
    {
        //get data hotel include the price
        $data['hotel'] = $this->Web_model->getHotelDetails($idH);

        //get data hitel facility
        $data['hotelFacility'] = $this->Standard_model->getAll('tb_fasilitas_hotel','id_hotel',$idH);

        //get room type
        $data['type'] = $this->Standard_model->getAllType($idH);

        // denah
        $data['denah'] = $this->Standard_model->getAllType1($idH);
        
        //get no room
        $data['room'] = $this->Web_model->getRoom();

        // //get room facility
        $data['roomFacility'] = $this->Standard_model->getAllData('tb_fasilitas_kamar');

        $this->load->view('web/templates/header');
        $this->load->view('web/hotelDetails',$data);
        $this->load->view('web/templates/footer');

    }


    /**
     * method verify booking
     */
    public function verify()
    {
        //get id customer
        $id_customer = $this->session->userdata('id_customer');

        //get id room
        if(!empty($_GET['room'])){
            $id_room = $_GET['room'];
        }else{
            $id_room = $this->input->post('room');
        }

        //get id hotel
        $id_hotel = $this->uri->segment(2);
        
        //get id type
        $id_type = $this->uri->segment(3);
        
        //data check in
        $check_in = $this->session->userdata('check_in');
        
        //data check_out
        $check_out = $this->session->userdata('check_out');

        $data['room'] = $this->Standard_model->getSingle('tb_kamar','id_kamar',$id_room);

        //data hotel
        $data['hotel'] = $this->Standard_model->getSingle('tb_hotel','id_hotel',$id_hotel);

        //data hotel facility
        $data['hotelFacility'] = $this->Standard_model->getAll('tb_fasilitas_hotel','id_hotel',$id_hotel);

        //data room type
        $data['type'] = $this->Standard_model->getSingle('tb_type','id_type',$id_type);
        
        //data event
        $data['event'] = $this->Standard_model->getAllData('tb_event');

        //data room
        $room = $this->Standard_model->getSingle('tb_kamar','id_kamar',$id_room);

        if($this->session->userdata('id_kamar',$id_room) === null){
            $this->session->set_userdata('id_kamar',$id_room);
            $this->session->set_userdata('no_kamar',$room['no_kamar']);
        }

        $data['check_in'] = $check_in;
        $data['check_out'] = $check_out;

        //find date range
        $begin = new DateTime( $check_in );
        $end = new DateTime( $check_out );
        $end = $end->modify( '+1 day' ); 
        $interval = new DateInterval('P1D');
        $data['dateRange'] = new DatePeriod($begin, $interval ,$end);

        //total day
        $out = strtotime($check_out);
        $in = strtotime($check_in);
        $totalDay = ($out - $in) / (24*60*60);
        $data['totalDay'] = $totalDay;

        //total price
        $data['totalPrice'] = $data['type']['harga'] * $totalDay;

        $this->form_validation->set_rules('check_in','Check In','required');
        $this->form_validation->set_rules('check_out','Check In','required');
        $this->form_validation->set_rules('total_price','Check In','required');
        $this->form_validation->set_rules('id_hotel','Check In','required');
        $this->form_validation->set_rules('id_type','Check In','required');
        
        if($this->form_validation->run() === FALSE){
            $this->load->view('web/templates/header');
            $this->load->view('web/verify',$data);
            $this->load->view('web/templates/footer');
        }else{
            $data = array(
                'check_in' => $this->input->post('check_in'),
                'check_out' => $this->input->post('check_out'),
                'total_price' => $this->input->post('total_price'),
                'id_customer' => $id_customer,
                'id_hotel' => $this->input->post('id_hotel'),
                'id_status_reservasi' => 1,
                'id_type' => $this->input->post('id_type'),
                'id_kamar' => $this->input->post('id_kamar'),
                'id_event' => $this->input->post('id_event')
            );
            
            $this->Api_Model->insertData('tb_reservasi',$data);
            
            redirect('myReservation');
            
        }
    }
}
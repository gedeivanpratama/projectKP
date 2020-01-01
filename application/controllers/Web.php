<?php

class Web extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation','session','Bridge','Token'));
        $this->load->model(array('Standard_model','Seller_model','Web_model','Api_Model', 'Cront_Model'));
        $this->checkStatusReservation();
    }
    
    public function checkStatusReservation()
    {
        $today = date("Y-m-d");
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
        /**
         * request data api
         */
        $dataHotel = $this->Standard_model->getSingle('tb_hotel','id_hotel',$idH);
        $dataHotel['urlapi'];
        $url = $dataHotel['urlapi'];

        $check_in = $this->session->userdata('check_in');

        $key = base64_encode(bin2hex(openssl_random_pseudo_bytes(24).time()));
        $token = $this->token->generateCsrfToken($key);
        
        //membuat random key token
        $data = [
            'request_data' => 'GET_DATA_RESERVATION',
            'token_id' => $token->getId(),
            'token' => $token->getValue(),
            'check_in' => $check_in,
            'id_hotel' => $idH
        ];

        // CURL
        if(empty($url)){
            $verifyToken = false;
            $dataApi['response'] = 404;
        }

        if(!empty($url)){
            // send raw data to another web app
            $rawData = Bridge::post($url,$data);
            if($rawData !== ""){
                $dataApi = json_decode($rawData, true);
                $verifyToken = $this->token->verifiedCSRF($dataApi['token_id'], $dataApi['token']);
            }else{
                $verifyToken = false;
                $dataApi['response'] = 404;
            }
        }

        /**
         * jika data dari api ada maka jalankan 
         * kode di bawah
         */
        
        if($dataApi['response'] === 200 && $verifyToken === true){
            $data['roomAPI'] = $dataApi['data_kamar'];
        }else{
            $check_in = $this->session->userdata('check_in');
            $data['room'] = $this->Standard_model->getHotelRoomByDate($check_in);
            
        }

        //get data hotel include the price
        $data['hotel'] = $this->Web_model->getHotelDetails($idH);

        //get data hitel facility
        $data['hotelFacility'] = $this->Standard_model->getAll('tb_fasilitas_hotel','id_hotel',$idH);

        //get room type
        // $data['type'] = $this->Standard_model->getAll('tb_type','id_hotel',$idH);
        $data['type'] = $this->Standard_model->getAllType($idH);
        $data['denah'] = $this->Standard_model->getAllType1($idH);
        // var_dump($data['type']);
        // die();
        //get no room
        $data['room'] = $this->Standard_model->getAll('tb_kamar','id_status',1);

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
            
            function generateRandomString($length = 50) {
                return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
            }
            
            $data_api = generateRandomString();
            
            if(empty($data['hotel']['urlapi'])){
                
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
                    'id_event' => $this->input->post('id_event'),
                    'data_api' => $data_api 
                );
            }
            
            /**
             * post data curl ke manajement
             */

            $this->Api_Model->insertData('tb_reservasi',$data);
            
            $getCustomerinfo = $this->Api_Model->getCustomerInfo($id_customer);
            $hotelPayment = $this->Api_Model->getHotelPayment($id_hotel);
            

            $keyApi = base64_encode(bin2hex(openssl_random_pseudo_bytes(24).time()));
            $tokenKey = $this->token->generateCsrfToken($keyApi);
            $dataToAPi = array(
                'request_data' => 'CREATE_DATA_RESERVATION',
                'token_id' => $tokenKey->getId(),
                'token' => $tokenKey->getValue(),
                'check_in' => $this->input->post('check_in'),
                'check_out' => $this->input->post('check_out'),
                'total_price' => $this->input->post('total_price'),
                'id_customer' => $id_customer,
                'nama_customer' => $getCustomerinfo['nama_customer'],
                'telp_customer' => $getCustomerinfo['telp_customer'],
                'email_customer' => $getCustomerinfo['email_customer'],
                'id_hotel' => $this->input->post('id_hotel'),
                'id_status_reservasi' => 1,
                'id_type' => $this->input->post('id_type'),
                'id_kamar' => $this->input->post('id_kamar'),
                'id_event' => $this->input->post('id_event'),
                'payment' => $hotelPayment,
                'data_api' => $data_api
            );
            
            $url = $this->Api_Model->getColumn('urlapi','tb_hotel','id_hotel',$id_hotel);
            $url = $url['urlapi'];
            $verifyToken = true;
            // post data to management
            $result = Bridge::post($url,$dataToAPi);
            if($result !== ""){
                $result = json_decode($result);
                $verifyToken = $this->token->verifiedCSRF($result->token_id, $result->token);
            }

            if( $verifyToken === true){
                $this->session->unset_userdata('check_in');
                $this->session->unset_userdata('check_out');
                redirect('myReservation');
            }
            
        }
    }
}
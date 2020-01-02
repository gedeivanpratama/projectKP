<?php

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation','session','Pdf','Bridge','Token'));
        $this->load->model(array('Standard_model','Customer_model','Cront_Model','Api_Model'));
        $this->checkSesion();
        $this->checkStatusReservation();
    }

    public function checkSesion()
    {
        if(empty($this->session->userdata('id_customer'))){
            redirect(base_url());
        }
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

    public function dasboardCustomer()
    {
        //check session
        //$this->checkSesion();

        //get data customer
        $id_customer = $this->session->userdata('id_customer');
        $data['customer'] = $this->Standard_model->getSingle('tb_customer','id_customer',$id_customer);

        //get data customer reservation
        $data['reservation'] = $this->Customer_model->getCustomerReservation($id_customer);

        $this->load->view('customer/templates/header',$data);
        $this->load->view('customer/dasboard');
        $this->load->view('customer/templates/footer');

    }

    public function myReservation()
    {
        //get data customer
        $id_customer = $this->session->userdata('id_customer');
        $data['customer'] = $this->Standard_model->getSingle('tb_customer','id_customer',$id_customer);

        //get data customer reservation
        $data['reservation'] = $this->Customer_model->getCustomerReservation($id_customer);

        $this->load->view('customer/templates/header',$data);
        $this->load->view('customer/dasboard',$data);
        $this->load->view('customer/templates/footer');
    }

    public function myReservDetail($idR)
    {
        //get id customer
        $id_customer = $this->session->userdata('id_customer');

        $id_type = $this->uri->segment(4);

        //get id reservasi
        $id_reservasi = $this->uri->segment(2);

        //get id type
        $id_hotel = $this->uri->segment(3);

        //get id room
        $id_room = $this->uri->segment(5);

        //$data customer
        $data['customer'] = $this->Standard_model->getSingle('tb_customer','id_customer',$id_customer);

        //data hotel
        $data['hotel'] = $this->Standard_model->getSingle('tb_hotel','id_hotel',$id_hotel);

        //data hotel facility
        $data['hotelFacility'] = $this->Standard_model->getAll('tb_fasilitas_hotel','id_hotel',$id_hotel);

        //data room type
        $data['type'] = $this->Standard_model->getSingle('tb_type','id_type',$id_type);

        //data event
        $data['event'] = $this->Standard_model->getAllData('tb_event');

        //data room
        $data['room'] = $this->Standard_model->getSingle('tb_kamar','id_kamar',$id_room);

        //data reservation
        $data['reservation'] = $this->Standard_model->getSingle('tb_reservasi','id_reservasi',$id_reservasi);

        //data event
        $data['event'] = $this->Standard_model->getAllData('tb_event');

        //data payment
        $data['payment'] = $this->Standard_model->getAll('tb_payment','id_hotel',$id_hotel);
        
        $this->load->view('customer/templates/header',$data);
        $this->load->view('customer/reservDetail',$data);
        $this->load->view('customer/templates/footer');
        
    }

    public function myBookingCancel()
    {
        //get id customer
        $id_customer = $this->session->userdata('id_customer');

        //$data customer
        $data['customer'] = $this->Standard_model->getSingle('tb_customer','id_customer',$id_customer);

        //get data customer reservation
        $data['reservation'] = $this->Customer_model->getCustomerCancel($id_customer);

        $this->load->view('customer/templates/header',$data);
        $this->load->view('customer/myBookingCancel',$data);
        $this->load->view('customer/templates/footer');
    }


    /**
     * cancel reservation 
     */
    public function cancelMyReserv()
    {
        $idAPI = $this->uri->segment(2);
        if($idAPI === 'NO'){
            $idData = $this->uri->segment(3);
            $reservation = $this->Standard_model->getSingle('tb_reservasi','id_reservasi',$idData);
            
        }else{
            $reservation = $this->Standard_model->getSingle('tb_reservasi','data_api',$idAPI);
        }
        
        /**
         * request api to cancel the reservation
         * 
         */
        $url = $this->Api_Model->getColumn('urlapi','tb_hotel','id_hotel',$reservation['id_hotel']);
        $url = $url['urlapi'];

        if(empty($url)){
            $data = [
                'id_reservasi' => $reservation['id_reservasi'],
                'check_in' => $reservation['check_in'],
                'check_out' => $reservation['check_out'],
                'total_price' => $reservation['total_price'],
                'id_customer' => $reservation['id_customer'],
                'id_hotel' => $reservation['id_hotel'],
                'id_status_reservasi' => 4,
                'id_type' => $reservation['id_type'],
                'id_kamar' => $reservation['id_kamar'],
                'id_event' => $reservation['id_event'],
            ];
            
            $dataK = [
                'id_status' => 1
            ];

            $result = $this->Standard_model->insertData('tb_archive',$data);
            $result = $this->Standard_model->deleteData('tb_reservasi','id_reservasi',$id);
            $update = $this->Standard_model->updateData2('tb_kamar',$dataK,'id_kamar',$reservation['id_kamar']);
    
            if($result === true && $update === true){
                $this->session->set_flashdata('title','Cancel Reservation');
                $this->session->set_flashdata('info','Canceled');
                redirect('myReservation');
                
            }

        }
        
        if(!empty($url)){
            $key = base64_encode(bin2hex(openssl_random_pseudo_bytes(24).time()));
            $tokenKey = $this->token->generateCsrfToken($key);
            $dataRequest = [
                'request_data' => 'CANCEL_RESERVATION',
                'token_id' => $tokenKey->getId(),
                'token' => $tokenKey->getValue(),
                'check_in' => $reservation['check_in'],
                'check_out' => $reservation['check_out'],
                'total_price' => $reservation['total_price'],
                'id_customer' => $reservation['id_customer'],
                'id_hotel' => $reservation['id_hotel'],
                'id_status_reservasi' => 4,
                'id_type' => $reservation['id_type'],
                'id_kamar' => $reservation['id_kamar'],
                'id_event' => $reservation['id_event'],
                'data_api' => $reservation['data_api']
            ];
            
            $dataK = [
                'id_status' => 1
            ];
            
            // post cancel request to another web app
            $result = Bridge::post($url,$dataRequest);
            $verifyToken = "";
            // if no response
            if($result === 200){
                $result = json_decode($result, true);
                $verifyToken = $this->token->verifiedCSRF($result['token_id'], $result['token']);
            }
            
            if($verifyToken === false){
                echo json_encode(['msg' => 'token data not match']);
                exit;
            }

            $data = [
                'id_reservasi' => $reservation['id_reservasi'],
                'check_in' => $reservation['check_in'],
                'check_out' => $reservation['check_out'],
                'total_price' => $reservation['total_price'],
                'id_customer' => $reservation['id_customer'],
                'id_hotel' => $reservation['id_hotel'],
                'id_status_reservasi' => 4,
                'id_type' => $reservation['id_type'],
                'id_kamar' => $reservation['id_kamar'],
                'id_event' => $reservation['id_event'],
            ];
            
            $result = $this->Standard_model->insertData('tb_archive',$data);
            $result = $this->Standard_model->deleteData('tb_reservasi','data_api',$idAPI);
            $update = $this->Standard_model->updateData2('tb_kamar',$dataK,'id_kamar',$reservation['id_kamar']);
    
            if($result === true && $update === true){
                $this->session->set_flashdata('title','Cancel Reservation');
                $this->session->set_flashdata('info','Canceled');
                redirect('myReservation');
                
            }
        }
        
    }

    /**
     * method di bawah tidak digunakan
     */
    public function deleteMyReserv($id)
    {
        /**
         * post request untuk menghapis data reservasi
         */
        $reservation = $this->Standard_model->getSingle('tb_reservasi','id_reservasi',$id);

        $url = $this->Api_Model->getcolumn('urlapi','tb_hotel','id_hotel',$reservation['id_hotel']);
        $url = $url['urlapi'];
        
        $key = base64_encode(bin2hex(openssl_random_pseudo_bytes(24).time()));
        $token = $this->token->generateCsrfToken($key);
        $dataAPI = array(
            'request_data' => 'DELETE_RESERVATION',
            'id_reservasi' => $id,
            'token_id' => $token->getId(),
            'token' => $token->getValue(),
            'check_in' => $reservation['check_in'],
            'check_out' => $reservation['check_out'],
            'total_price' => $reservation['total_price'],
            'id_customer' => $reservation['id_customer'],
            'id_hotel' => $reservation['id_hotel'],
            'id_status_reservasi' => 4,
            'id_type' => $reservation['id_type'],
            'id_kamar' => $reservation['id_kamar'],
            'id_event' => $reservation['id_event'],
        );

        $result = Bridge::post($url,$dataAPI);
        $result = json_decode($result);
        $verifyToken = $this->token->verifiedCSRF($result['token_id'], $result['token']);
        if($verifyToken === false){
            json_decode(['msg' => 'token data not match']);
            die();
        }
        $data = array(
            'id_reservasi'      => $id,
            'check_in' => $reservation['check_in'],
            'check_out' => $reservation['check_out'],
            'total_price' => $reservation['total_price'],
            'id_customer' => $reservation['id_customer'],
            'id_hotel' => $reservation['id_hotel'],
            'id_status_reservasi' => 5,
            'id_type' => $reservation['id_type'],
            'id_kamar' => $reservation['id_kamar'],
            'id_event' => $reservation['id_event'],
        );
        
        $insert = $this->Api_Model->insertData('tb_archive',$data);
        $result = $this->Standard_model->deleteData('tb_reservasi','id_reservasi',$id);

        if($result){
            $this->session->set_flashdata('title','Delete Reservation');
            $this->session->set_flashdata('info','Deleted');
            redirect('myReservation');
        }
    }

    public function myConfirmation($id_reservasi)
    {
        //get id customer
        $id_customer = $this->session->userdata('id_customer');

        //$data customer
        $data['customer'] = $this->Standard_model->getSingle('tb_customer','id_customer',$id_customer);

        //get id Hotel
        $idH = $this->uri->segment(3);

        //data payment
        $data['payment'] = $this->Standard_model->getAll('tb_payment','id_hotel',$idH);

        $this->form_validation->set_rules('sender_name','Sender Name','required');
        $this->form_validation->set_rules('bank_sender','Bank Sender','required');
        $this->form_validation->set_rules('no_rek_sender','No Rek','required');
        $this->form_validation->set_rules('total_transfer','Total Transfer','required');
        $this->form_validation->set_rules('transfer_time','Transfer Time','required');
        $this->form_validation->set_rules('id_payment','Id Payment','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('customer/templates/header',$data);
            $this->load->view('customer/myConfirmation',$data);
            $this->load->view('customer/templates/footer');
        }else{
            $data = array(
                'sender_name'       => $this->input->post('sender_name'),
                'bank_sender'       => $this->input->post('bank_sender'),
                'no_rek_sender'     => $this->input->post('no_rek_sender'),
                'total_transfer'    => $this->input->post('total_transfer'),
                'transfer_time'     => $this->input->post('transfer_time'),
                'id_payment'        => $this->input->post('id_payment'),
                'id_reservasi'      => $id_reservasi
            );
            
            $id_confirm = $this->Api_Model->insertData('tb_confirm',$data);

            $dataU = array(
                'id_status_reservasi' => 2
            );

            $update = $this->Standard_model->updateData('tb_reservasi',$dataU,'id_reservasi',$id_reservasi);
            if($update){
                $this->session->set_flashdata('title','Confirmation');
                $this->session->set_flashdata('info','Confirm');
                redirect(base_url().'dasboardCustomer');
            }
        }

    }

    public function getPDF()
    {
        //get id reservasi
        $idR = $this->uri->segment(2);

        //get id hotel
        $idH = $this->uri->segment(3);

        //get data reservation
        $data['reservation'] = $this->Customer_model->getDataPDF($idR);
        $check_in = $data['reservation']['check_in'];
        $check_out = $data['reservation']['check_out'];
        $out = strtotime($check_out);
        $in = strtotime($check_in);
        $totalDay = ($out - $in) / (24*60*60);
        $data['totalDay'] = $totalDay;

        //get data confirm
        $data['confirm'] = $this->Customer_model->getdataConfirm($idR);

        //get data event
        if($data['reservation']['id_event'] !== "0"){
            $data['event'] = $this->Standard_model->getSingle('tb_event','id_event',$data['reservation']['id_event']);
        }else{
            $data['event'] = [
                "discount" => 0
            ];
        }
        
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = 'booking.pdf';
        $this->pdf->load_view('customer/PDF', $data);

    }

    public function manageAccountCus()
    {
        //get id customer
        $id_customer = $this->session->userdata('id_customer');

        //data profile
        
        //$data customer
        $data['customer'] = $this->Standard_model->getSingle('tb_customer','id_customer',$id_customer);
        $this->load->view('customer/templates/header',$data);
        $this->load->view('customer/myAccount',$data);
        $this->load->view('customer/templates/footer');
    }   

    public function addPhoto()
    {
        //get id customer
        $id_customer = $this->session->userdata('id_customer');

        //get customer name
        $name_customer = str_replace(' ','', $this->session->userdata('nama_customer'));
    
        #upload setting
        $config['upload_path']          = './uploads/customer/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2000;
        $config['max_width']            = 3024;
        $config['max_height']           = 3068;
        $getName = $_FILES['photo_profile']['name'];
        if(empty($getName)){
            $fileName = 'no_img.jpg';
        }else{
            $fileName = $name_customer . '_' . $getName;
        }
        $config['file_name'] = $fileName;
    
        $this->load->library('upload', $config);
        //enable overwirte
        $this->upload->overwrite = true;

        if (!$this->upload->do_upload('photo_profile')){
            $error = array('error' => $this->upload->display_errors());
            // var_dump($error);
            // die();
            redirect('manageAccountCus');
    
        }else{
            $data1 = array('upload_data' => $this->upload->data());
            $data= array(
                'img_customer' => $fileName
            );
        }
        $result = $this->Standard_model->updateData('tb_customer',$data,'id_customer',$id_customer);
        if($result){
            $this->session->set_flashdata('title','Photo Profile');
            $this->session->set_flashdata('info','Added');
            redirect('manageAccountCus');
        }
    }

    public function editAccountCus()
    {
        //get id customer
        $id_customer = $this->session->userdata('id_customer');

        $this->form_validation->set_rules('nama_customer','Nama','required');
        $this->form_validation->set_rules('telp_customer','Telp','required');
        $this->form_validation->set_rules('email_customer','Email','required');
        $this->form_validation->set_rules('alamat_customer','Alamat','required');


        if($this->form_validation->run() === FALSE){
        //$data customer
        $data['customer'] = $this->Standard_model->getSingle('tb_customer','id_customer',$id_customer);
        $this->load->view('customer/templates/header',$data);
        $this->load->view('customer/editAccountCus',$data);
        $this->load->view('customer/templates/footer');
        }else{
            $data = array(
            'nama_customer' => $this->input->post('nama_customer'),
            'telp_customer' => $this->input->post('telp_customer'),
            'email_customer' => $this->input->post('email_customer'),
            'alamat_customer' => $this->input->post('alamat_customer'),
            );

        $result = $this->Standard_model->updateData('tb_customer',$data,'id_customer',$id_customer);
        if($result){
            $this->session->set_flashdata('title','Account');
            $this->session->set_flashdata('info','Update');
            redirect('manageAccountCus');
        }
        }
    }

}

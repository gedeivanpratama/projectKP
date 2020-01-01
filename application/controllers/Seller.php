<?php

class Seller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation','session','Bridge','Token'));
        $this->load->model(array('Standard_model','Seller_model','Cront_Model','Api_Model'));
        $this->checkSesion();
        $this->checkStatusReservation();
    }

    public function checkSesion()
    {
        if(empty($this->session->userdata('id_seller'))){
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

    public function dasboardSeller()
    {
        //get id hotel

        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //get count Hotel
        $data['hotel'] = $this->Standard_model->countData('tb_hotel','id_seller',$id['id_seller']);

        //get count reservation
        $data['reservation'] = $this->Seller_model->getCountReservation($id['id_seller']);

        //get count payment
        $data['payment'] = $this->Seller_model->getCountPayment($id['id_seller']);
        
        $this->load->view('seller/templates/header',$data);
        $this->load->view('seller/dasboard');
        $this->load->view('seller/templates/footer');
    }

    public function hotelLists()
    {
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        $idH = $this->Standard_model->getAll('tb_hotel','id_seller',$id['id_seller']);
        
        // get data hotel facility
        $data['facility'] = $this->Standard_model->getAllData('tb_fasilitas_hotel');

        $data['hotelLists'] = $this->Seller_model->getHotelLists($id['id_seller']);
        $this->load->view('seller/templates/header',$data);
        $this->load->view('seller/hotelList',$data);
        $this->load->view('seller/templates/footer');
    }

    public function addHotel()
    {
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //get nama_user
        $nama = $this->session->get_userdata('nama_seller');
        $name = str_replace(' ','',$nama['nama_seller']);

        //form validation
        $this->form_validation->set_rules('nama_hotel','Nama Hotel','required');
        $this->form_validation->set_rules('alamat_hotel','Alamat Hotel','required');
        $this->form_validation->set_rules('email_hotel','Email Hotel','required');
        $this->form_validation->set_rules('telp_hotel','Telp Hotel','required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header',$data);
            $this->load->view('seller/addHotel');
            $this->load->view('seller/templates/footer');
        }else{

            #upload setting
            $config['upload_path']          = './uploads/hotelImages/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2000;
            $config['max_width']            = 3024;
            $config['max_height']           = 3068;
            $getName = $_FILES['image_hotel']['name'];
            if(empty($getName)){
            $fileName = 'noimage.jpg';
            }else{
            $fileName = $name . '_' . $getName;
            }
            $config['file_name'] = $fileName;

            $this->load->library('upload', $config);
            //enable overwirHotel Eventte
            $this->upload->overwrite = true;

            if (!$this->upload->do_upload('image_hotel')){
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                die();
                $this->load->view('seller/templates/header',$data);
                $this->load->view('seller/addHotel', $error);
                $this->load->view('seller/templates/footer');
            
                //get error messages
                // var_dump($error);
            }else{
                $data1 = array('upload_data' => $this->upload->data());
                $data= array(
                    'nama_hotel' => $this->input->post('nama_hotel'),
                    'alamat_hotel' => $this->input->post('alamat_hotel'),
                    'email_hotel' => $this->input->post('email_hotel'),
                    'urlapi' => $this->input->post('url'),
                    'telp_hotel' => $this->input->post('telp_hotel'),
                    'id_seller' => $id['id_seller'],
                    'image_hotel' => $fileName
                );
            }
            $result = $this->Standard_model->insertData('tb_hotel',$data);
            if($result){
                $this->session->set_flashdata('title','Add Hotel');
                $this->session->set_flashdata('info','added');
                redirect('hotelLists');
            }
        }
    }

    public function editHotel($idH){

        $nama = $this->session->get_userdata('nama_seller');
        $nameC = str_replace(' ','',$nama['nama_seller']);

        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);
        
        //get data hotel
        $data['hotel'] = $this->Standard_model->getSingle('tb_hotel','id_hotel',$idH);
        
        //create validation
        $this->form_validation->set_rules('nama_hotel','Nama Hotel', 'required');
        $this->form_validation->set_rules('alamat_hotel','Alamat Hotel', 'required');
        $this->form_validation->set_rules('email_hotel','Email Hotel', 'required');
        $this->form_validation->set_rules('telp_hotel','Telp Hotel', 'required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header',$data);
            $this->load->view('seller/editHotel',$data);
            $this->load->view('seller/templates/footer');
        }else{

            #upload setting
            $config['upload_path']          = './uploads/hotelImages/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2000;
            $config['max_width']            = 3024;
            $config['max_height']           = 3068;

            //get image from database
            $getImage = $_FILES['imageHotel']['name'];

            if(empty($getImage)){
                $imageN = $this->Standard_model->getSingle('tb_hotel','id_hotel',$idH);
                $name = $imageN['image_hotel'];
            //    var_dump($imageN);
            //    die(); 
            }else{
                $name = $nameC . '_' . $getImage;
            }
            $config['file_name'] = $name;
            
            $this->load->library('upload', $config);
            //enable overwirte
            $this->upload->overwrite = true;

            //upload file
            $this->upload->do_upload('imageHotel');
            $data = array('upload_data' => $this->upload->data());
            $data = array(
                'nama_hotel'    => $this->input->post('nama_hotel'),
                'alamat_hotel'  => $this->input->post('alamat_hotel'),
                'telp_hotel'    => $this->input->post('telp_hotel'),
                'nama_hotel'    => $this->input->post('nama_hotel'),
                'email_hotel'   => $this->input->post('email_hotel'),
                'image_hotel'    => $name
            );
                $result = $this->Standard_model->updateData('tb_hotel',$data, 'id_hotel',$idH);
                if($result){
                    $this->session->set_flashdata('title','Update Hotel');
                $this->session->set_flashdata('info','Update');
                    redirect('hotelLists');
                }
            
            // }   
        }
    }

    public function deleteHotel($idH){
        $name = $this->Standard_model->getSingle('tb_hotel','id_hotel',$idH);

        //get path
        $url = PUBPATH . 'uploads/hotelImages/'. $name['image_hotel'];

        if(file_exists($url)){
            unlink($url);
        }
        
        $result = $this->Standard_model->deleteData('tb_hotel','id_hotel',$idH);
        if($result){
            $this->session->set_flashdata('title','Deleted Hotel');
            $this->session->set_flashdata('info','Deleted');
            redirect('hotelLists');
        }
    }

    public function addHotelFacility(){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //get data hotel
        $data['hotel'] = $this->Standard_model->getAll('tb_hotel','id_seller',$id['id_seller']);

        $this->form_validation->set_rules('nama_fasilitas','Nama Fasilitas','required');
        $this->form_validation->set_rules('jumlah_fasilitas','Jumlah Fasilitas','required');
        $this->form_validation->set_rules('id_hotel','Hotel','required');
        
        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header',$data);
            $this->load->view('seller/addHotelFacility',$data);
            $this->load->view('seller/templates/footer');
        }else{
            $data = array(
                'nama_fasilitas' => $this->input->post('nama_fasilitas'),
                'jumlah_fasilitas' => $this->input->post('jumlah_fasilitas'),
                'id_hotel' => $this->input->post('id_hotel')
            );
            
            $result = $this->Standard_model->insertData('tb_fasilitas_hotel',$data);
            if($result){
                $this->session->set_flashdata('title','Hotel Facility');
                $this->session->set_flashdata('info','added');
                redirect('hotelLists');
            }
            
        }

    }

    public function manageHotelFacility(){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //data hotel facility
        $data['facility'] = $this->Seller_model->getHotelFacility($id['id_seller']);
        //var_dump($data['facility']);
        $this->load->view('seller/templates/header',$data);
        $this->load->view('seller/manageHotelFacility',$data);
        $this->load->view('seller/templates/footer');
    }

    public function manageHotelPayment(){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //get data payment
        $data['payment'] = $this->Seller_model->getPayment($id['id_seller']);
        
        $this->load->view('seller/templates/header',$data);
        $this->load->view('seller/manageHotelPayment',$data);
        $this->load->view('seller/templates/footer');
    }

    public function addHotelPayment(){
        
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //get hotel
        $data['hotel'] = $this->Standard_model->getAll('tb_hotel','id_seller',$id['id_seller']);

        $this->form_validation->set_rules('payment_owner','Payment Owner','required');
        $this->form_validation->set_rules('bank_name','Bank Name','required');
        $this->form_validation->set_rules('no_rek','Rekening Number','required');
        $this->form_validation->set_rules('id_hotel','Id Hotel','required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header',$data);
            $this->load->view('seller/addPayment',$data);
            $this->load->view('seller/templates/footer');
        }else{
            $data = array(
                'payment_owner' => $this->input->post('payment_owner'),
                'bank_name' => $this->input->post('bank_name'),
                'no_rek' => $this->input->post('no_rek'),
                'id_hotel' => $this->input->post('id_hotel')
            );

            $result = $this->Standard_model->insertData('tb_payment',$data);
            if($result){
                $this->session->set_flashdata('title','Hotel Payment');
                $this->session->set_flashdata('info','Added');
                redirect('manageHotelPayment');
            }
        }
    }

    public function editPayment($idP){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //get hotel
        $data['hotel'] = $this->Standard_model->getAll('tb_hotel','id_seller',$id['id_seller']);

        //get data payment
        $data['payment'] = $this->Standard_model->getSingle('tb_payment','id_payment',$idP);

        $this->form_validation->set_rules('payment_owner','Payment Owner','required');
        $this->form_validation->set_rules('bank_name','Bank Name','required');
        $this->form_validation->set_rules('no_rek','Rekening Number','required');
        $this->form_validation->set_rules('id_hotel','Id Hotel','required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header',$data);
            $this->load->view('seller/editPayment',$data);
            $this->load->view('seller/templates/footer');
        }else{
            $data = array(
                'payment_owner' => $this->input->post('payment_owner'),
                'bank_name' => $this->input->post('bank_name'),
                'no_rek' => $this->input->post('no_rek'),
                'id_hotel' => $this->input->post('id_hotel')
            );

            $result = $this->Standard_model->updateData('tb_payment',$data,'id_payment',$idP);
            if($result){
                $this->session->set_flashdata('title','Hotel Payment');
                $this->session->set_flashdata('info','Update');
                redirect('manageHotelPayment');
            }
        }
    }

    public function deletePayment($idP){
        $result = $this->Standard_model->deleteData('tb_payment','id_payment',$idP);
        if($result){
            $this->session->set_flashdata('title','Hotel Payment');
            $this->session->set_flashdata('info','Deleted');
            redirect('manageHotelPayment');
        }

    }

    public function editHotelFacility($idF){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //get hotel facility
        $data['facility'] = $this->Standard_model->getSingle('tb_fasilitas_hotel','id_fasilitas_hotel',$idF);
        //get data hotel
        $data['hotel'] = $this->Standard_model->getAll('tb_hotel','id_seller',$id['id_seller']);
        $this->form_validation->set_rules('nama_fasilitas','Nama Fasilitas','required');
        $this->form_validation->set_rules('jumlah_fasilitas','Jumlah Fasilitas','required');
        $this->form_validation->set_rules('id_hotel','Hotel','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header',$data);
            $this->load->view('seller/editHotelFacility',$data);
            $this->load->view('seller/templates/footer');
        }else{
            $data = array(
                'nama_fasilitas' => $this->input->post('nama_fasilitas'),
                'jumlah_fasilitas' => $this->input->post('jumlah_fasilitas'),
                'id_hotel' => $this->input->post('id_hotel')
            );
            $result = $this->Standard_model->updateData('tb_fasilitas_hotel',$data,'id_fasilitas_hotel',$idF);
            if($result){
                $this->session->set_flashdata('title','Hotel Facility');
                $this->session->set_flashdata('info','Update');
                redirect('manageHotelFacility');
            }
        }
    }

    public function deleteHotelFacility($idF){
        $result = $this->Standard_model->deleteData('tb_fasilitas_hotel','id_fasilitas_hotel',$idF);
        if($result){
            $this->session->set_flashdata('title','Hotel Facility');
            $this->session->set_flashdata('info','Deleted');
            redirect('manageHotelFacility');        
        }
    }

    public function roomTypeLists($idH){
        //get hotel data by id
        $data['hotel'] = $this->Standard_model->getSingle('tb_hotel','id_hotel',$idH);
        
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //get id type room
        $idT = $this->Standard_model->getAll('tb_type','id_hotel',$idH);

        //get data room type lists
        $data['roomtype'] =  $this->Seller_model->getRoomTypeLists($idH);

        //get data fasilitas kamar drom databases
        $data['roomfacility'] = $this->Standard_model->getAllData('tb_fasilitas_kamar');

        
        $this->load->view('seller/templates/header', $data);
        $this->load->view('seller/roomTypeLists',$data);
        $this->load->view('seller/templates/footer');
    }

    public function denah($idH)
    {
        $data['hotel'] = $this->Standard_model->getSingle('tb_hotel','id_hotel',$idH);
        
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);
        $data['denah'] = $this->Standard_model->getdenah($idH);
        $this->load->view('seller/templates/header', $data);
        $this->load->view('seller/denah',$data);
        $this->load->view('seller/templates/footer');
    }

    public function tambahDenah($idH)
    {
        $data['hotel'] = $this->Standard_model->getSingle('tb_hotel','id_hotel',$idH);
        $data['room'] = $this->Standard_model->getAll('tb_type','id_hotel',$idH);
        
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);
        $this->form_validation->set_rules('id_type','Type Name','required');
        $this->form_validation->set_rules('description','description','required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header', $data);
            $this->load->view('seller/addDenah',$data);
            $this->load->view('seller/templates/footer');
        }else{

            $name = 'ivan';
            #upload setting
            $config['upload_path']          = './uploads/denah/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2000;
            $config['max_width']            = 3024;
            $config['max_height']           = 3068;
            $getName = $_FILES['denah']['name'];

            if(empty($getName)){
            $fileName = 'noimage.jpg';
            }else{
            $fileName = $name . '_' . $getName;
            }
            $config['file_name'] = $fileName;

            $this->load->library('upload', $config);
            //enable overwirte
            $this->upload->overwrite = true;

            if (!$this->upload->do_upload('denah')){
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                die();
                
            }

            // $data1 = array('upload_data' => $this->upload->data());
            $data= array(
                'id_type' => $this->input->post('id_type'),
                'denah' => $fileName,
                'description' => $this->input->post('description')
            );
            
            $result = $this->Standard_model->insertData('tb_denah',$data);
            if($result){
                redirect(base_url().'denah/'.$idH);
            }
        }
    }

    public function editDenah()
    {
        $idD = $this->uri->segment(3);
        $idH = $this->uri->segment(4);
        
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);
        $data['room'] = $this->Standard_model->getsingle('tb_denah','id_denah',$idD);
        $data['type'] = $this->Standard_model->getAll('tb_type','id_hotel',$idH);
        // var_dump($data['type']);
        // die();
        $this->form_validation->set_rules('id_type','Type Name','required');
        $this->form_validation->set_rules('description','description','required');
        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('seller/templates/header', $data);
            $this->load->view('seller/editDenah',$data);
            $this->load->view('seller/templates/footer');
        
        }else{

            $name = 'ivan';
            #upload setting
            $config['upload_path']          = './uploads/denah/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2000;
            $config['max_width']            = 3024;
            $config['max_height']           = 3068;
            $getName = $_FILES['denah']['name'];

            if(!empty($getName)){
                $fileName = $name . '_' . $getName;
                $config['file_name'] = $fileName;
                $this->load->library('upload', $config);
                $this->upload->overwrite = true;
                
                if (!$this->upload->do_upload('denah')){
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);
                    die();
                    
                }

                $data = array(
                    'id_type' => $this->input->post('id_type'),
                    'denah' => $fileName,
                    'description' => $this->input->post('description')
                );

            }else{

                $data = array(
                    'id_type' => $this->input->post('id_type'),
                    'description' => $this->input->post('description')
                );
            }

            
            
            $result = $this->Standard_model->updateData('tb_denah',$data,'id_denah', $idD);
            var_dump($idD);
            if($result){
                redirect(base_url().'denah/'.$idH);
            }
        }
    }

    public function deleteDenah()
    {
        $idD = $this->uri->segment(3);
        $idH = $this->uri->segment(4);

        $name = $this->Standard_model->getSingle('tb_denah','id_denah',$idD);
        
        define('EXT', '.'.pathinfo(__FILE__, PATHINFO_EXTENSION));
        define('PUBPATH',str_replace(SELF,'',FCPATH)); // added

        //get path
        $url = PUBPATH . 'uploads/denah/'. $name['denah'];

        if(file_exists($url)){
            unlink($url);
        }

        $result = $this->Standard_model->deleteData('tb_denah','id_denah',$idD);
        if($result){
            redirect(base_url().'denah/'.$idH);
        }
    }

    public function addType($idH){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //get nama_user
        $nama = $this->session->get_userdata('nama_seller');
        $name = str_replace(' ','',$nama['nama_seller']);

        //form validation
        $this->form_validation->set_rules('nama_type','Type Name','required');
        $this->form_validation->set_rules('price','Price','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header',$data);
            $this->load->view('seller/addType');
            $this->load->view('seller/templates/footer');
        }else{

            #upload setting
            $config['upload_path']          = './uploads/roomImages/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2000;
            $config['max_width']            = 3024;
            $config['max_height']           = 3068;
            $getName = $_FILES['image_room']['name'];

            if(empty($getName)){
            $fileName = 'noimage.jpg';
            }else{
            $fileName = $name . '_' . $getName;
            }
            $config['file_name'] = $fileName;

            $this->load->library('upload', $config);
            //enable overwirte
            $this->upload->overwrite = true;

            if (!$this->upload->do_upload('image_room')){
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                die();
                
            }

            // $data1 = array('upload_data' => $this->upload->data());
            $data= array(
                'nama_type' => $this->input->post('nama_type'),
                'harga' => $this->input->post('price'),
                'id_hotel' => $idH,
                'image_kamar' => $fileName
            );
                
            
            $result = $this->Standard_model->insertData('tb_type',$data);
            if($result){
                $this->session->set_flashdata('title','Hotel Room Type');
                $this->session->set_flashdata('info','added');
                redirect(base_url().'roomTypeLists/'.$idH);
            }
        }
    }

    public function editType($idT,$idH){

        //get id hotel url
        $idH = $this->uri->segment(3);

        $nama = $this->session->get_userdata('nama_seller');
        $nameC = str_replace(' ','',$nama['nama_seller']);

        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);
        
        //get data hotel
        $data['type'] = $this->Standard_model->getSingle('tb_type','id_type',$idT);
        
        //create validation
        $this->form_validation->set_rules('nama_type','Type Name','required');
        $this->form_validation->set_rules('price','Price','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header',$data);
            $this->load->view('seller/editType',$data);
            $this->load->view('seller/templates/footer');
        }else{

            #upload setting
            $config['upload_path']          = './uploads/roomImages/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2000;
            $config['max_width']            = 3024;
            $config['max_height']           = 3068;

            //get image from database
            $getImage = $_FILES['image_type']['name'];

            if(empty($getImage)){
                $imageN = $this->Standard_model->getSingle('tb_type','id_type',$idT);
                $name = $imageN['image_kamar']; 
            }else{
                $name = $nameC . '_' . $getImage;
            }
            // var_dump($name);
            // die();

            $config['file_name'] = $name;
            
            $this->load->library('upload', $config);
            //enable overwirte
            $this->upload->overwrite = true;


            if (!$this->upload->do_upload('image_type')){
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                die();
                $this->load->view('seller/templates/header', $data);
                $this->load->view('seller/editType', $error);
                $this->load->view('seller/templates/footer');
            }else{
                $data = array('upload_data' => $this->upload->data());
                $data = array(
                    'nama_type'      => $this->input->post('nama_type'),
                    'harga'          => $this->input->post('price'),
                    'image_kamar'    => $name
                );

                // var_dump($data);
                // die();

                $result = $this->Standard_model->updateData('tb_type',$data, 'id_type',$idT);
                if($result){
                $this->session->set_flashdata('title','Hotel Room Type');
                $this->session->set_flashdata('info','updated');
                redirect(base_url().'roomTypeLists/'.$idH);
                }   
            }   
        }   
    }

    public function deleteType($idT,$idH){
        //get id hotel url
        $idH = $this->uri->segment(3);
        $name = $this->Standard_model->getSingle('tb_type','id_type',$idT);
        
        define('EXT', '.'.pathinfo(__FILE__, PATHINFO_EXTENSION));
        define('PUBPATH',str_replace(SELF,'',FCPATH)); // added

        //get path
        $url = PUBPATH . 'uploads/roomImages/'. $name['image_kamar'];

        if(file_exists($url)){
            unlink($url);
        }
        
        $result = $this->Standard_model->deleteData('tb_type','id_type',$idT);
        if($result){
            $this->session->set_flashdata('title','Hotel Room Type');
            $this->session->set_flashdata('info','Deleted');
            redirect(base_url().'roomTypeLists/'.$idH);
        }
    }

    public function editRoomTypeFacility($idT){
        $idH = $this->uri->segment(3);

        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //get type facility data from databases
        $data['facility'] = $this->Standard_model->getSingle('tb_fasilitas_kamar','id_fasilitas_kamar',$idT);

        //get room type
        $data['type'] = $this->Standard_model->getAll('tb_type','id_hotel',$idH);

        $this->form_validation->set_rules('nama_fasilitas','Nama Fasilitas','required');
        $this->form_validation->set_rules('jumlah_fasilitas','Jumlah Fasilitas','required');
        $this->form_validation->set_rules('id_type','type','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header', $data);
            $this->load->view('seller/editRoomTypeFacility',$data);
            $this->load->view('seller/templates/footer');
        }else{
            $data = array(
                'nama_fasilitas' => $this->input->post('nama_fasilitas'),
                'jumlah_fasilitas' => $this->input->post('jumlah_fasilitas'),
                'id_type' => $this->input->post('id_type')
            );
            $result = $this->Standard_model->updateData('tb_fasilitas_kamar',$data,'id_fasilitas_kamar',$idT);
            if($result){
                $this->session->set_flashdata('title','Hotel Room Facility');
                $this->session->set_flashdata('info','Updated');
                redirect(base_url() .'manageRoomFacilityType/'. $idH);
            }
        }
    }

    public function deleteRoomTypeFacility($idF){
        $idH = $this->uri->segment(3);
        $result = $this->Standard_model->deleteData('tb_fasilitas_kamar','id_fasilitas_kamar',$idF);
        if($result){
            $this->session->set_flashdata('title','Hotel Room Facility');
            $this->session->set_flashdata('info','Deleted');
            redirect(base_url() .'manageRoomFacilityType/'. $idH);
        }
    }

    public function manageEvents($idH){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get id hotel
        $data['id_hotel'] = $idH;

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        $data['event'] = $this->Seller_model->getEvent($idH);

        $this->load->view('seller/templates/header',$data);
        $this->load->view('seller/manageEvent',$data);
        $this->load->view('seller/templates/footer');
    }

    public function addEvent($idH){

        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        $data['type'] = $this->Standard_model->getAll('tb_type','id_hotel',$idH);

        $this->form_validation->set_rules('nama_event','Nama Event','required');
        $this->form_validation->set_rules('start_event','Start Event','required');
        $this->form_validation->set_rules('stop_event','Stop Event','required');
        $this->form_validation->set_rules('id_type','Id Type','required');
        $this->form_validation->set_rules('discount','Discount','required');
        
        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header',$data);
            $this->load->view('seller/addEvent',$data);
            $this->load->view('seller/templates/footer');
        }else{
            $data = array(
                'nama_event' => $this->input->post('nama_event'),
                'start_event' => $this->input->post('start_event'),
    
                'end_event' => $this->input->post('stop_event'),
                'discount' => $this->input->post('discount'),
                'id_type' => $this->input->post('id_type')
            );
            $result = $this->Standard_model->insertData('tb_event',$data);
            if($result){
                $this->session->set_flashdata('title','Hotel Event');
                $this->session->set_flashdata('info','added');
                redirect(base_url(). 'manageEvents/'. $idH);
            }
        }
    }

    public function editEvent($idE){

        //get id hotel
        $idH = $this->uri->segment(3);

        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //data type
        // $data['type'] = $this->Standard_model->getAll('tb_type','');
        $data['type'] = $this->Seller_model->getEvent($idH);

        //get data even from database
        $data['event'] = $this->Standard_model->getSingle('tb_event','id_event',$idE);

        $this->form_validation->set_rules('nama_event','Event Name','required');
        $this->form_validation->set_rules('start_event','Event Start','required');
        $this->form_validation->set_rules('stop_event','Event Stop','required');
        $this->form_validation->set_rules('discount','Event Discount','required');
        $this->form_validation->set_rules('id_type','Room Type','required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header',$data);
            $this->load->view('seller/editEvent',$data);
            $this->load->view('seller/templates/footer');
        }else{
            $data =[
                'nama_event' => $this->input->post('nama_event'),
                'start_event' => $this->input->post('start_event'),
                'end_event' => $this->input->post('stop_event'),
                'discount' => $this->input->post('discount'),
                'id_type' => $this->input->post('id_type'),
            ];
            $result = $this->Standard_model->updateData('tb_event',$data,'id_event',$idE);
            if($result){
                $this->session->set_flashdata('title','Hotel Event');
                $this->session->set_flashdata('info','Update');
                redirect(base_url().'manageEvents/'.$idH);
            }
        }

    }
    
    public function deleteEvent($idE){
        //get id hotel
        $idH = $this->uri->segment(3);

        //get id hotel
        $idE = $this->uri->segment(2);

        $result = $this->Standard_model->deleteData('tb_event','id_event',$idE);
        if($result){
            $this->session->set_flashdata('title','Hotel Event');
            $this->session->set_flashdata('info','Update');
            redirect(base_url().'manageEvents/'.$idH);
        }
    }

    public function manageRoomFacilityType($idH){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //get data from table hotel
        $data['hotel'] = $this->Standard_model->getSingle('tb_hotel','id_hotel',$idH);

        //data hotel facility
        $data['typeF'] = $this->Seller_model->getTypeFacility($id['id_seller'],$idH);
    
        $this->load->view('seller/templates/header',$data);
        $this->load->view('seller/manageRoomFacilityType',$data);
        $this->load->view('seller/templates/footer');
    }

    public function addRoomFacilityType($idH)
    {
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);
 
        //get data hotel
        $data['type'] = $this->Standard_model->getAll('tb_type','id_hotel',$idH);
        
 
        $this->form_validation->set_rules('nama_fasilitas','Nama Fasilitas','required');
        $this->form_validation->set_rules('jumlah_fasilitas','Jumlah Fasilitas','required');
        $this->form_validation->set_rules('id_type','Type','required');
        
        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header',$data);
            $this->load->view('seller/addRoomFacilityType',$data);
            $this->load->view('seller/templates/footer');
        }else{
            $data = array(
                'nama_fasilitas' => $this->input->post('nama_fasilitas'),
                'jumlah_fasilitas' => $this->input->post('jumlah_fasilitas'),
                'id_type' => $this->input->post('id_type')
            );
            
            $result = $this->Standard_model->insertData('tb_fasilitas_kamar',$data);
            if($result){
                $this->session->set_flashdata('title','Room Facility');
                $this->session->set_flashdata('info','Added');
                redirect('hotelLists');
            }
            
        }
    }   

    public function viewRoom($idT)
    {
        $idT = $this->uri->segment(2);
        $idH = $this->uri->segment(3);

        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //get data from table type 
        $data['type'] = $this->Standard_model->getSingle('tb_type','id_type',$idT);

        $data['room'] = $this->Seller_model->getRoomLists($idT);

        //set id Hotel into view
        $data['id_hotel'] = $idH;

        $this->load->view('seller/templates/header', $data);
        $this->load->view('seller/viewRoom',$data);
        $this->load->view('seller/templates/footer');
    }

    public function addRoom($idT)
    {
        $idT = $this->uri->segment(2);
        $idH = $this->uri->segment(3);
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //get data from tb status
        $data['status'] = $this->Standard_model->getAllData('tb_status');
        
        $this->form_validation->set_rules('room_number','Room Number','required');
        $this->form_validation->set_rules('id_status','Status','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header', $data);
            $this->load->view('seller/addRoom',$data);
            $this->load->view('seller/templates/footer');
        }else{
            $data = array(
                'no_kamar' => $this->input->post('room_number'),
                'id_type' => $idT,
                'id_status'=> $this->input->post('id_status')
            );
            $result = $this->Standard_model->insertData('tb_kamar',$data);
            if($result){
                $this->session->set_flashdata('title','Hotel Room');
                $this->session->set_flashdata('info','Added');
                redirect(base_url().'viewRoom/'. $idT . '/' . $idH);
            }
        }
        
    }

    public function editRoom($idR)
    {
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get id type
        $idT = $this->uri->segment(4);
        $idH = $this->uri->segment(2);

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //get data room by id room
        $data['room'] = $this->Standard_model->getSingle('tb_kamar','id_kamar',$idR);

        //get data from tb status
        $data['status'] = $this->Standard_model->getAllData('tb_status');
        $this->form_validation->set_rules('room_number','Room Number','required');
        $this->form_validation->set_rules('id_status','Status','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header', $data);
            $this->load->view('seller/editRoom',$data);
            $this->load->view('seller/templates/footer');
        }else{
            $data = array(
                'no_kamar' => $this->input->post('room_number'),
                'id_type' => $idT,
                'id_status' => $this->input->post('id_status')
            );
            $result = $this->Standard_model->updateData('tb_kamar',$data,'id_kamar',$idR);
            if($result){
                $this->session->set_flashdata('title','Hotel Room');
                $this->session->set_flashdata('info','Added');
                redirect(base_url().'viewRoom/'. $idT . '/' . $idH);
            }
        }
    }

    public function deleteRoom()
    {
        $idR = $this->uri->segment(2);
        $idT = $this->uri->segment(3);
        $idH = $this->uri->segment(4);

        $result = $this->Standard_model->deleteData('tb_kamar','id_kamar',$idR);
        if($result){
            $this->session->set_flashdata('title','Hotel Room');
            $this->session->set_flashdata('info','Added');
            redirect(base_url().'viewRoom/'.$idT.'/'.$idH);
        }
    }

    public function myCustomerReservation()
    {
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);
        
        $data['reservation'] = $this->Seller_model->getSellerReservation($id['id_seller']);


        $this->load->view('seller/templates/header', $data);
        $this->load->view('seller/myCustomerReservation', $data);
        $this->load->view('seller/templates/footer');
    }

    public function reservation()
    {
        //get id user seller
        $id = $this->session->get_userdata('id_seller');
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        //get data user seller
        $data['hotel'] = $this->Standard_model->getAll('tb_hotel','id_seller',$id['id_seller']);
        
        $this->load->view('seller/templates/header', $data);
        $this->load->view('seller/reservationlist', $data);
        $this->load->view('seller/templates/footer');

    }

    public function checkReservationDetail()
    {
        $id = $this->session->get_userdata('id_seller');
        $idHotel = $this->uri->segment(3);
        
        //get data user seller
        $data['hotel'] = $this->Standard_model->getSingle('tb_hotel','id_hotel',$idHotel);
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);
        $data['reservation'] = $this->Seller_model->getSellerReservation($id['id_seller'], $idHotel);

        $this->load->view('seller/templates/header', $data);
        $this->load->view('seller/checkReservationDetail', $data);
        $this->load->view('seller/templates/footer');

    }

    public function checkReservationDetailApi()
    {
        $id = $this->session->get_userdata('id_seller');
        
        $idHotel = $this->uri->segment(4);

        $hotel = $this->Standard_model->getSingle('tb_hotel','id_hotel',$idHotel);
        $data = [
            "request_data" => "REQUEST_DATA_RESERVATION",
            "id_hotel" => $idHotel,
        ];
        
        $result = Bridge::post($hotel['urlapi'], $data);
        $dataArray = json_decode($result, true);
        $data['hotel'] = $this->Standard_model->getSingle('tb_hotel','id_hotel',$idHotel);
        $data['reservation'] = $dataArray['data'];

        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);
        
        //get data user seller

        $this->load->view('seller/templates/header', $data);
        $this->load->view('seller/checkReservationDetailApi', $data);
        $this->load->view('seller/templates/footer');

    }

    public function aprovePayment($id)
    {
        $id = $this->uri->segment(4);
        $data = array(
            'id_status_reservasi' => 3
        );

        $idH = $this->Api_Model->getColumn('id_hotel','tb_reservasi','id_reservasi',$id);
        $url = $this->Api_Model->getColumn('urlapi','tb_hotel','id_hotel',$idH['id_hotel']);
        $url = $url['urlapi'];

        // $key = base64_encode(bin2hex(openssl_random_pseudo_bytes(24).time()));
        // $token = $this->token->generateCsrfToken($key);
        // $dataApi = [
        //     'request_data'    => 'APROVE_PAYMENT',
        //     'token_id' => $token->getId(),
        //     'token' => $token->getValue(),
        //     'id_reservasi' => $id
        // ];

        // $result = Bridge::post($url, $dataApi);
        // $result = json_decode($result, true);
        // $verifyToken = $this->token->verifiedCSRF($result['token_id'], $result['token']);
        // if($verifyToken === false){
        //     echo json_encode(['msg' => 'token data are not match']);
        //     exit;
        // }

        $result = $this->Standard_model->updateData('tb_reservasi',$data,'id_reservasi',$id);
        if($result){
            $this->session->set_flashdata('title','Payment Aproved');
            $this->session->set_flashdata('info','Aproved');
            redirect(base_url(). 'check/reservation/'. $idH['id_hotel']);
        }
    }

    public function requestDetail($idR){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);
        $data['reservation'] = $this->Seller_model->getSReservationDetail($idR);
        $data['confirm'] = $this->Standard_model->getSingle('tb_confirm','id_reservasi',$idR);

        $this->load->view('seller/templates/header',$data);
        $this->load->view('seller/requestDetail', $data);
        $this->load->view('seller/templates/footer');

    }

    /**
     * fungsi cancel request seller
     */
    public function deleteRequest($idR){
        var_dump("lalal");
        $idR = $this->uri->segment(4);
        $idH = $this->Api_Model->getColumn('id_hotel','tb_reservasi','id_reservasi',$idR);
        $idH = $idH['id_hotel'];
        $data_api = $this->Api_Model->getColumn('data_api','tb_reservasi','id_reservasi',$idR);
        $data_api = $data_api['data_api'];
        $url = $this->Api_Model->getColumn('urlapi','tb_hotel','id_hotel',$idH);
        $url = $url['urlapi'];
    
        $reservation = $this->Standard_model->getSingle('tb_reservasi','id_reservasi',$idR);

        if(empty($url)){
            $delete = $this->Standard_model->deleteData('tb_reservasi','id_reservasi',$idR);
        }
        
        if(!empty($url)){            
            $key = base64_encode(bin2hex(openssl_random_pseudo_bytes(24).time()));
            $tokenKey = $this->token->generateCsrfToken($key);
            $dataAPI = [
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
                'data_api' => $data_api
            ];
            
            $result = Bridge::post($url, $dataAPI);
            if($result !== ""){
                $result = json_decode($result, true);
                $verifyToken = $this->token->verifiedCSRF($result['token_id'], $result['token']);
                if($verifyToken === false){
                    echo json_encode(['msg' => 'token data are not match']);
                    exit;
                }
            }
            
            $delete = $this->Standard_model->deleteData('tb_reservasi','data_api',$data_api);
        }
        
        if($delete){
            $this->session->set_flashdata('title','Deleted Request');
            $this->session->set_flashdata('info','Deleted');
            redirect(base_url().'check/reservation/'.$idH);
        }
    }

    public function manageAccount(){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);

        $this->load->view('seller/templates/header', $data);
        $this->load->view('seller/manageAccount', $data);
        $this->load->view('seller/templates/footer');
    }

    public function editAccount(){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');
        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);
        
        $this->form_validation->set_rules('nama_seller','Nama','required');
        $this->form_validation->set_rules('telp_seller','Telp','required');
        $this->form_validation->set_rules('email_seller','Email','required');
        $this->form_validation->set_rules('alamat_seller','Alamat','required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header', $data);
            $this->load->view('seller/editAccount', $data);
            $this->load->view('seller/templates/footer');
        }else{
            $data = array(
                'nama_seller' => $this->input->post('nama_seller'),
                'telp_seller' => $this->input->post('telp_seller'),
                'email_seller' => $this->input->post('email_seller'),
                'alamat_seller' => $this->input->post('alamat_seller'),
            );

            $result = $this->Standard_model->updateData('tb_seller',$data,'id_seller',$id['id_seller']);
            if($result){
                $this->session->set_flashdata('title','Account');
                $this->session->set_flashdata('info','Updated');
                redirect('manageAccount');
            }
        }
    }

    public function addPhotoSeller(){
        //get id customer
        $id_seller = $this->session->userdata('id_seller');

        //get customer name
        $name_seller = str_replace(' ','', $this->session->userdata('nama_seller'));
    
        #upload setting
        $config['upload_path']          = './uploads/seller/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2000;
        $config['max_width']            = 3024;
        $config['max_height']           = 3068;
        $getName = $_FILES['photo_profile']['name'];
        if(empty($getName)){
            $fileName = 'no_img.jpg';
        }else{
            $fileName = $name_seller . '_' . $getName;
        }
        $config['file_name'] = $fileName;
    
        $this->load->library('upload', $config);
        //enable overwirte
        $this->upload->overwrite = true;

        if (!$this->upload->do_upload('photo_profile')){
            $error = array('error' => $this->upload->display_errors());
            var_dump($error);
            die();
            redirect('manageAccount');
    
        }else{
            $data1 = array('upload_data' => $this->upload->data());
            $data= array(
                'img_seller' => $fileName
            );
        }
        $result = $this->Standard_model->updateData('tb_seller',$data,'id_seller',$id_seller);
        if($result){
        $this->session->set_flashdata('title','Photo Profile');
        $this->session->set_flashdata('info','Added');
            redirect('manageAccount');
        }
    }

}
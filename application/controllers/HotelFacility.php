<?php

class HotelFacility extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation','session'));
        $this->load->model(array('Standard_model','Seller_model','Cront_Model','Api_Model'));
        $this->checkSesion();
    }

    public function checkSesion()
    {
        if(empty($this->session->userdata('id_seller'))){
            redirect(base_url());
        }
    }

    public function dataUser()
    {
        $id = $this->session->get_userdata('id_seller');
        $data['profile'] = $this->Standard_model->getSingle('tb_profile','id_user', $id['id_seller']);
        // var_dump($data['profile']);
        // die();
        if(is_null($data['profile'])){
            $profile = $this->Standard_model->one('tb_user',$id['id_seller']);
            $username = explode('@',$profile->email);
            $username = $username[0];

            $data['profile'] = [
                'id'        => 'no',
                'name'      => $username,
                'image'     => 'no_img.jpg',
                'address'   => '',
                'telp'      => '',
                'email'     => $profile->email
            ];

        }
        return $data['profile'];
    }

    public function addHotelFacility(){
        //get id user seller
       
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['profile'] = $this->dataUser();

        //get data hotel
        $data['hotel'] = $this->Standard_model->getAll('tb_hotel','id_user',$id['id_seller']);

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
        $data['profile'] = $this->dataUser();

        //data hotel facility
        $data['facility'] = $this->Seller_model->getHotelFacility($id['id_seller']);
        //var_dump($data['facility']);
        $this->load->view('seller/templates/header',$data);
        $this->load->view('seller/manageHotelFacility',$data);
        $this->load->view('seller/templates/footer');
    }

    public function editHotelFacility($idF){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['profile'] = $this->dataUser();

        //get hotel facility
        $data['facility'] = $this->Standard_model->getSingle('tb_fasilitas_hotel','id_fasilitas_hotel',$idF);
        //get data hotel
        $data['hotel'] = $this->Standard_model->getAll('tb_hotel','id_user',$id['id_seller']);
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

}
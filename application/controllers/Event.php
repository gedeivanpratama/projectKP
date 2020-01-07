<?php

class Event extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation','session','Bridge','Token'));
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
    
    public function manageEvents($idH){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get id hotel
        $data['id_hotel'] = $idH;

        //get data user seller
        $data['profile'] = $this->dataUser();
        

        $data['event'] = $this->Seller_model->getEvent($idH);

        $this->load->view('seller/templates/header',$data);
        $this->load->view('seller/manageEvent',$data);
        $this->load->view('seller/templates/footer');
    }

    public function addEvent($idH){

        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['profile'] = $this->dataUser();

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
        $data['profile'] = $this->dataUser();

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
}
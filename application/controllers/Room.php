<?php

class Room extends CI_Controller
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

    public function viewRoom($idT)
    {
        $idT = $this->uri->segment(2);
        $idH = $this->uri->segment(3);

        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['profile'] = $this->dataUser();

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
        $data['profile'] = $this->dataUser();

        //get data from tb status
        
        $this->form_validation->set_rules('room_number','Room Number','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header', $data);
            $this->load->view('seller/addRoom',$data);
            $this->load->view('seller/templates/footer');
        }else{
            $data = array(
                'no_kamar' => $this->input->post('room_number'),
                'id_type' => $idT
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
        $data['profile'] = $this->dataUser();

        //get data room by id room
        $data['room'] = $this->Standard_model->getSingle('tb_kamar','id_kamar',$idR);

        //get data from tb status
        $this->form_validation->set_rules('room_number','Room Number','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header', $data);
            $this->load->view('seller/editRoom',$data);
            $this->load->view('seller/templates/footer');
        }else{
            $data = array(
                'no_kamar' => $this->input->post('room_number'),
                'id_type' => $idT
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
}
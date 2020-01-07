<?php

class RoomTypeFacility extends CI_Controller
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

    public function editRoomTypeFacility($idT){
        $idH = $this->uri->segment(3);

        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['profile'] = $this->dataUser();

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

    public function manageRoomFacilityType($idH){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['profile'] = $this->dataUser();

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
        $data['profile'] = $this->dataUser();
 
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
}
<?php

class Account extends CI_Controller
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
        if(empty($this->session->userdata('id_seller')) && empty($this->session->userdata('id_customer'))){
            redirect(base_url());
        }
    }

    public function userid()
    {
        if($this->session->userdata('id_customer') !== null){
            return $this->session->userdata('id_customer');
        }

        return $this->session->userdata('id_seller');
    }

    public function dataUser()
    {
        if($this->session->get_userdata('id_customer') !== null){
            $data['profile'] = $this->Standard_model->getSingle('tb_profile','id_user', $this->userid());
            if(is_null($data['profile'])){
                $profile = $this->Standard_model->one('tb_user', $this->userid());
                $username = explode('@',$profile['email']);
                $username = $username[0];

                $data['profile'] = [
                    'id'        => 'no',
                    'name'      => $username,
                    'image'     => 'no_img.jpg',
                    'address'   => '',
                    'telp'      => '',
                    'email'     => $profile['email']
                ];
            }
            return $data['profile'];
            exit;
        }

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
        exit;

        
    }

    public function manageAccount(){

        //get data user seller
        $data['profile'] = $this->dataUser();

        $this->load->view('seller/templates/header', $data);
        $this->load->view('seller/manageAccount', $data);
        $this->load->view('seller/templates/footer');
    }

    public function addProfile()
    {
        $data['profile'] = $this->dataUser();
        $name = $this->Standard_model->one('tb_user',$this->userid());
        $name = explode('@',$name->email);

        //form validation
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('address','Address','required');
        $this->form_validation->set_rules('telp','Telp','required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header',$data);
            $this->load->view('seller/addProfile');
            $this->load->view('seller/templates/footer');
        }else{
            #upload setting
            $config['upload_path']          = './uploads/seller/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2000;
            $config['max_width']            = 3024;
            $config['max_height']           = 3068;

            $getName = $_FILES['image']['name'];
            if(empty($getName)){
                $fileName = 'no_img.jpg';
            }else{
                $fileName = $name[0] . '_' . $getName;
            }
            
            $config['file_name'] = $fileName;

            $this->load->library('upload', $config);
            //enable overwirHotel Eventte
            $this->upload->overwrite = true;

            if (!$this->upload->do_upload('image')){
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                die();
                
            }else{

                $data = array(
                    'name' => $this->input->post('name'),
                    'address' => $this->input->post('address'),
                    'telp' => $this->input->post('telp'),
                    'image' => $fileName,
                    'id_user' => $this->userid()
                );

                $data = $this->Standard_model->insertData('tb_profile',$data);
                if($data){
                    redirect('manageAccount');
                }
            }

        }
    }

    public function editAccount(){
        //get data user seller
        $data['profile'] = $this->dataUser();
        
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('telp','Telp','required');
        $this->form_validation->set_rules('address','Address','required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header', $data);
            $this->load->view('seller/editAccount', $data);
            $this->load->view('seller/templates/footer');
        }else{

            //get customer name
            $profile = $this->Standard_model->one('tb_user',$this->userid());
            $username = explode('@',$profile->email);
            $username = $username[0];

            #upload setting
            $config['upload_path']          = './uploads/seller/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2000;
            $config['max_width']            = 3024;
            $config['max_height']           = 3068;
            $getName = $_FILES['image']['name'];

            if(empty($getName)){
                $fileName = $data['profile']['image'];
            }else{
                $fileName = $username . '_' . $getName;
                $config['file_name'] = $fileName;
                $this->load->library('upload', $config);
                $this->upload->overwrite = true;
                $this->upload->do_upload('image');
                
            }

            $data = array(
                'name'      => $this->input->post('name'),
                'image'     => $fileName,
                'address'   => $this->input->post('address'),
                'telp'      => $this->input->post('telp'),
            );

            $result = $this->Standard_model->updateData('tb_profile', $data, 'id_user', $this->userid());

            if($result){
                $this->session->set_flashdata('title','Account');
                $this->session->set_flashdata('info','Updated');
                redirect('manageAccount');
            }
        }
    }
}
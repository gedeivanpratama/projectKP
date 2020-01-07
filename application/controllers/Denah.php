<?php

class Denah extends CI_Controller
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

    public function denah($idH)
    {
        $data['hotel'] = $this->Standard_model->getSingle('tb_hotel','id_hotel',$idH);
        
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['profile'] = $this->dataUser();
        
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
        $data['profile'] = $this->dataUser();
        
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
        $data['profile'] = $this->dataUser();
        
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
        
        $result = $this->Standard_model->deleteData('tb_denah','id_denah',$idD);
        if($result){
            redirect(base_url().'denah/'.$idH);
        }
    }
}
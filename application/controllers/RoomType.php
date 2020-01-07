<?php

class RoomType extends CI_Controller
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

    public function roomTypeLists($idH){
        //get hotel data by id
        $data['hotel'] = $this->Standard_model->getSingle('tb_hotel','id_hotel',$idH);
        
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['profile'] = $this->dataUser();

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
    
    public function addType($idH){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['profile'] = $this->dataUser();

        //get nama_user
        $name = str_replace(' ','',$data['profile']['name']);

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
        $data['profile'] = $this->dataUser();
        
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

}
<?php

class Hotel extends CI_Controller
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

    public function hotelLists()
    {
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['profile'] = $this->dataUser();

        $idH = $this->Standard_model->getAll('tb_hotel','id_user',$id['id_seller']);
        
        // get data hotel facility
        $data['facility'] = $this->Standard_model->getAllData('tb_fasilitas_hotel');

        $data['hotelLists'] = $this->Seller_model->getHotelLists('id_user',$id['id_seller']);
        $this->load->view('seller/templates/header',$data);
        $this->load->view('seller/hotelList',$data);
        $this->load->view('seller/templates/footer');
    }

    public function addHotel()
    {
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['profile'] = $this->dataUser();
        
        $name = str_replace(' ','',$data['profile']['name']);

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
                $fileName = 'no_image.png';
            }else{
                $fileName = $name . '_' . $getName;
            }
            $config['file_name'] = $fileName;

            $this->load->library('upload', $config);
            $this->upload->overwrite = true;
            $this->upload->do_upload('image_hotel');
            $data= array(
                'nama_hotel' => $this->input->post('nama_hotel'),
                'alamat_hotel' => $this->input->post('alamat_hotel'),
                'email_hotel' => $this->input->post('email_hotel'),
                'telp_hotel' => $this->input->post('telp_hotel'),
                'id_user' => $id['id_seller'],
                'image_hotel' => $fileName
            );
            $result = $this->Standard_model->insertData('tb_hotel',$data);
            if($result){
                $this->session->set_flashdata('title','Add Hotel');
                $this->session->set_flashdata('info','added');
                redirect('hotelLists');
            }
        }
        
    }

    public function editHotel($idH){

        $data['profile'] = $this->dataUser();
        $name = str_replace(' ','',$data['profile']['name']);

        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['profile'] = $this->dataUser();

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
           
            }else{
                $name = $name . '_' . $getImage;
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

}
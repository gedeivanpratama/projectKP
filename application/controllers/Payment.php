<?php

class Payment extends CI_Controller
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

    public function manageHotelPayment(){
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['profile'] = $this->dataUser();
        
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
        $data['profile'] = $this->dataUser();

        //get hotel
        $data['hotel'] = $this->Standard_model->getAll('tb_hotel','id_user',$id['id_seller']);

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
        $data['profile'] = $this->dataUser();

        //get hotel
        $data['hotel'] = $this->Standard_model->getAll('tb_hotel','id_user',$id['id_seller']);

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
}
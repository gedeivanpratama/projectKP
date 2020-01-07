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

    public function dasboardSeller()
    {
        //get id hotel

        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['profile'] = $this->dataUser();

        //get count Hotel
        $data['hotel'] = $this->Standard_model->countData('tb_hotel','id_user',$id['id_seller']);

        //get count reservation
        $data['reservation'] = $this->Seller_model->getCountReservation($id['id_seller']);

        //get count payment
        $data['payment'] = $this->Seller_model->getCountPayment($id['id_seller']);
        
        $this->load->view('seller/templates/header',$data);
        $this->load->view('seller/dasboard');
        $this->load->view('seller/templates/footer');
    }

    public function myCustomerReservation()
    {
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        //get data user seller
        $data['profile'] = $this->dataUser();
        
        $data['reservation'] = $this->Seller_model->getSellerReservation($id['id_seller']);


        $this->load->view('seller/templates/header', $data);
        $this->load->view('seller/myCustomerReservation', $data);
        $this->load->view('seller/templates/footer');
    }

    public function reservation()
    {
        //get id user seller
        $id = $this->session->get_userdata('id_seller');

        $data['profile'] = $this->dataUser();

        //get data user seller
        $data['hotel'] = $this->Standard_model->getAll('tb_hotel','id_user',$id['id_seller']);
        
        $this->load->view('seller/templates/header', $data);
        $this->load->view('seller/reservationlist', $data);
        $this->load->view('seller/templates/footer');

    }

    public function checkReservationDetail()
    {
        $id = $this->session->get_userdata('id_seller');
        $idHotel = $this->uri->segment(3);
        
        //get data user seller
        $data['profile'] = $this->dataUser();
        
        $data['hotel'] = $this->Standard_model->getSingle('tb_hotel','id_hotel',$idHotel);
        
        $data['reservation'] = $this->Seller_model->getSellerReservation($id['id_seller'], $idHotel);

        $this->load->view('seller/templates/header', $data);
        $this->load->view('seller/checkReservationDetail', $data);
        $this->load->view('seller/templates/footer');

    }

    public function aprovePayment($id)
    {
        $id = $this->uri->segment(4);
        $data = array(
            'id_status_reservasi' => 3
        );

        $idH = $this->Api_Model->getColumn('id_hotel','tb_reservasi','id_reservasi',$id);

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
        $data['profile'] = $this->dataUser();

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
        $idR = $this->uri->segment(4);
        $idH = $this->Api_Model->getColumn('id_hotel','tb_reservasi','id_reservasi',$idR);
        $idH = $idH['id_hotel'];
        $delete = $this->Standard_model->deleteData('tb_reservasi','id_reservasi',$idR);
        
        if($delete){
            $this->session->set_flashdata('title','Deleted Request');
            $this->session->set_flashdata('info','Deleted');
            redirect(base_url().'check/reservation/'.$idH);
        }
    }

}
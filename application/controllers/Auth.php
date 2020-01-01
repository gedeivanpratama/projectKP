<?php

class Auth extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->model(array('Auth_model','Standard_model'));
    }

    public function loginSeller(){
        $this->form_validation->set_rules('email_seller','Email','required');
        $this->form_validation->set_rules('seller_password','Password','required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/login');
        }else{
            $email = $this->input->post('email_seller');
            $pass = $this->input->post('seller_password');
            
            $data = array(
                'email_seller' => $email,
                'password' => $pass
            );

            $result = $this->Auth_model->login($email,$pass, $data);
            if($result){
                $user = $this->Standard_model->getSingle('tb_seller','email_seller', $email);
                $this->session->set_userdata('id_seller',$user['id_seller']);
                $this->session->set_userdata('nama_seller',$user['nama_seller']);
                $this->session->set_flashdata('title','Seler Login');
                $this->session->set_flashdata('info','Login');
                redirect('dasboardSeller');
            }else{
                $this->session->set_flashdata('title','Seller Login');
                $this->session->set_flashdata('info','Input');
                $this->session->set_flashdata('status','error');
                redirect(base_url().'loginSeller');
            }
        }
    }


    public function registerSeller(){
        $this->form_validation->set_rules('nama_user','Nama','required');
        $this->form_validation->set_rules('email_user','Email','required|valid_email|is_unique[tb_seller.email_seller]');
        $this->form_validation->set_rules('telp_user','Telp','required');
        $this->form_validation->set_rules('alamat_user','Alamat','required');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/register');
        }else{
            $data = array(
                'nama_seller' => $this->input->post('nama_user'),
                'email_seller' => $this->input->post('email_user'),
                'telp_seller' => $this->input->post('telp_user'),
                'alamat_seller' => $this->input->post('alamat_user'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );

            $result = $this->Auth_model->register('tb_seller',$data);
            if($result){
                redirect('loginSeller');
            }
        }
    }

    public function logoutSeller(){
        $this->session->unset_userdata('id_seller');
        $this->session->unset_userdata('nama_seller');
        $this->session->set_flashdata('title','Logout Account');
        $this->session->set_flashdata('info','Logout');
        //$this->session->sess_destroy();
        redirect('web');
    }
    public function logoutCustomer(){
        $this->session->unset_userdata('id_customer');
        $this->session->unset_userdata('nama_customer');
        //$this->session->sess_destroy();
        $this->session->set_flashdata('title','Logout Account');
        $this->session->set_flashdata('info','Logout');
        redirect('web');
    }

    public function loginCustomer(){
        $hotel = $this->uri->segment(2);
        $type = $this->uri->segment(3);
        $room = $this->uri->segment(4);
        // var_dump($room);
        // die();
        $this->form_validation->set_rules('email_customer','Email','required');
        $this->form_validation->set_rules('customer_password','Password','required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('customer/login');
        }else{
            $email = $this->input->post('email_customer');
            $pass = $this->input->post('customer_password');
            
            $data = array(
                'email_customer' => $email,
                'customer_password' => $pass
            );

            $result = $this->Auth_model->login2($email,$pass, $data);
            if($result){
                $user = $this->Standard_model->getSingle('tb_customer','email_customer', $email);
                $this->session->set_userdata('id_customer',$user['id_customer']);
                $this->session->set_userdata('nama_customer',$user['nama_customer']);
                if(isset($hotel) && isset($type)){
                    $this->session->set_flashdata('title','Customer Login');
                    $this->session->set_flashdata('info','Login');
                    redirect(base_url().'verify/'.$hotel.'/'.$type.'/?room=' . $room);  
                }else{
                    $this->session->set_flashdata('title','Customer Login');
                    $this->session->set_flashdata('info','Login');
                    redirect('dasboardCustomer');    
                }
                
            }else{
                $this->session->set_flashdata('title','Customer Login');
                $this->session->set_flashdata('info','Input');
                $this->session->set_flashdata('status','error');
                redirect('loginCustomer');
            }
        }
    }

    public function registerCustomer(){
        $this->form_validation->set_rules('nama_customer','Nama','required');
        $this->form_validation->set_rules('email_customer','Email','required|valid_email|is_unique[tb_customer.email_customer]');
        $this->form_validation->set_rules('telp_customer','Telp','required');
        $this->form_validation->set_rules('alamat_customer','Alamat','required');
        $this->form_validation->set_rules('customer_password','Password','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('customer/register');
        }else{
            $data = array(
                'nama_customer'   => $this->input->post('nama_customer'),
                'email_customer'  => $this->input->post('email_customer'),
                'telp_customer'   => $this->input->post('nama_customer'),
                'alamat_customer' => $this->input->post('alamat_customer'),
                'customer_password'      => password_hash($this->input->post('customer_password'), PASSWORD_DEFAULT)
            );

            $result = $this->Auth_model->register('tb_customer',$data);
            if($result){
                redirect('loginCustomer');
            }
        }
    }
}
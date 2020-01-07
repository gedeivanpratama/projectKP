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
                'email' => $email,
                'password' => $pass
            );

            $result = $this->Auth_model->login($data);
            
            if($result){
                $user = $this->Standard_model->getSingle('tb_user','email', $email);
                $this->session->set_userdata('id_seller',$user['id']);
                $this->session->set_userdata('id_rolle','1');
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
        $this->form_validation->set_rules('email_user','Email','required|valid_email|is_unique[tb_user.email]');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/register');
        }else{
            $data = [
                'email' => $this->input->post('email_user'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'id_rolle' => 1
            ];

            $result = $this->Auth_model->register('tb_user',$data);
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
        $this->session->set_flashdata('title','Logout Account');
        $this->session->set_flashdata('info','Logout');
        redirect('web');
    }

    public function loginCustomer(){
        $hotel = $this->uri->segment(2);
        $type = $this->uri->segment(3);
        $room = $this->uri->segment(4);
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('customer/login');
        }else{
            $email = $this->input->post('email');
            $pass = $this->input->post('password');
            
            $data = array(
                'email' => $email,
                'password' => $pass
            );

            $result = $this->Auth_model->login($data);
            if($result){
                $user = $this->Standard_model->getSingle('tb_user','email', $email);
                $this->session->set_userdata('id_customer',$user['id']);
                $this->session->set_userdata('id_rolle','2');
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

    public function registerCustomer()
    {
        $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[tb_user.email]');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('customer/register');
        }else{
            $data = array(
                'email'    => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'id_rolle' => 2
            );
            $result = $this->Auth_model->register('tb_user',$data);
            if($result){
                redirect('loginCustomer');
            }
        }
    }
}
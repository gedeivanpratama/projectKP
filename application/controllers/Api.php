<?php

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model(array('Api_Model','Standard_model'));
        $this->load->library(array('session','form_validation','Bridge'));
    }

    // list hotel reservation with empty room or available room
    public function hotelListByDate()
    {
        // http://hotel-reservation.com/API/List/?date=2019-04-25&id_hotel=14&key=10201as
        if(isset($_GET['checkin'])){
            $check_in = $_GET['checkin'];
        }else{
            $check_in = $this->session->userdata('check_in');
        }
        var_dump($check_in);

        if(isset($_GET['id_hotel'])){
            $id_hotel = $_GET['id_hotel'];
        }else{
            $id_hotel = null;
        }

        if(empty($check_in)){
            $result = ['no data input'];
        }else{
            $result = $this->Api_Model->getRoomByDate($check_in, $id_hotel);
        }
        var_dump($result);
    }


    public function index()
    {
        Bridge::try();
    }

    public function getData()
    {
        $url = $this->uri->segment(3);
        $data = array(
            id_request => "",
            id_partner => "",
            kamar => "",
            tanggal => "2019-04-02",
        );
        if(empty($url) || !isset($url)){
            $data = $this->Api_Model->getData();
            echo json_encode($data);
        }else{

            $data = $this->Api_Model->getData($url);
            if(empty($data)){
                
                $data = [
                    'error' => 'data not found'
                ];
                echo json_encode($data);

            }else{
                //var_dump($data['csrf']);
                
                // hash_equals($_SESSION['token'], $_POST['token'])
                // generate token
                $name = $data[0]['id_hotel'] . '_' . str_replace(' ','',$data[0]['nama_hotel']);
                if(!isset($set_token)){
                    
                }
                $set_token = $this->session->set_userdata($name, bin2hex(random_bytes(32)));
                $token = $this->session->userdata($name);

                // add token into frame data
                for ($i=0; $i < count($data); $i++) { 
                    $data[$i][$name] = $token;
                }
                // frame data to json
                $data['csrf'] = $_GET['csrf'];
                echo json_encode($data);
            }

        }
    }

    public function CreateApi()
    {
        //get id user seller
        $id = $this->session->get_userdata('id_seller');
        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);
        $data['hotel'] = $this->Standard_model->getAll('tb_hotel','id_seller',$id['id_seller']);
        
        $this->form_validation->set_rules('api_name','Api Name', 'required');
        $this->form_validation->set_rules('hotel_id','Hotel', 'required');
        $this->form_validation->set_rules('id_request','id_request', 'required');
        $this->form_validation->set_rules('id_partner','id partner', 'required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header',$data);
            $this->load->view('seller/connect',$data);
            $this->load->view('seller/templates/footer');

        }else{
            // data base action
            $data = [
                'id_seller'     => $id['id_seller'],
                'id_hotel'      => $this->input->post('hotel_id'),
                'id_partner'    => $this->input->post('id_partner'),
                'id_request'    => $this->input->post('id_request'),
                'nama_api'      => $this->input->post('api_name'),
            ];

            $result = $this->Standard_model->insertData('tb_api',$data);
            if($result){
                redirect(base_url().'API/List');
            }
        }
    }

    public function list()
    {
        //get id user seller
        $id = $this->session->get_userdata('id_seller');
        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);
        $data['api'] = $this->Api_Model->apiList($id['id_seller']);
        
        $this->load->view('seller/templates/header',$data);
        $this->load->view('seller/apiList',$data);
        $this->load->view('seller/templates/footer');
    }

    public function deleteApi()
    {
        $idApi = $this->uri->segment(4);

        $result = $this->Standard_model->deleteData('tb_api','id_api',$idApi);
        if($result){
            redirect(base_url().'APIKey/List');
        }
        
    }

    public function requestConnect()
    {
        $id = $this->uri->segment(4);
        if(!empty($id)){
            $data = ['status' => 1];
            $result = $this->Standard_model->updateData('tb_api',$data,'id_api',$id);
            if($result){
                redirect(base_url().'APIKey/List');
            }
        }
    }

    public function requestDetail()
    {
        $id = $this->uri->segment(4);
        //get id user seller
        $idS = $this->session->get_userdata('id_seller');
        //get data user seller
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$idS['id_seller']);
        $data['api'] = $this->Standard_model->getSingle('tb_api','id_api',$id);
        $data['api'] = $this->Api_Model->apiDetail($id);
        // var_dump($data['api']);
        // die();
        $this->load->view('seller/templates/header',$data);
        $this->load->view('seller/apiDetail',$data);
        $this->load->view('seller/templates/footer');
    }

    public function request()
    {
        // $idApi = $this->uri->segment(3);
        // $idHotel = $this->uri->segment(4);
        // $idRequest = $this->uri->segment(5);
        // $idPartner = $this->uri->segment(6);

        // $id_partner = filter_input(INPUT_GET, 'id_partner', FILTER_SANITIZE_SPECIAL_CHARS);
        $id_partner = $_GET['id_partner'];
        $id_request = $_GET['id_request'];
        $nama_api = $_GET['nama_api'];
        $id_hotel = $this->Standard_model->getId('tb_api','id_hotel','id_request',$id_request);

        $dataHotel = $this->Api_Model->getHotelRoomStatus($id_hotel['id_hotel']);
        // var_dump($dataHotel);
        // die();

        $head = [
            'id_partner' => $id_partner,
            'id_request' => $id_request,
            'nama_api' => $nama_api
        ];
        if(isset($id_partner, $id_request, $nama_api)){

            $data = [
                'head' => $head,
                'body' => $dataHotel
            ];
            
            if(empty($dataHotel)){
                echo json_encode(['data' => 'data not found !']);
            }else{
                echo json_encode($data);
            }
        }else{
            echo json_encode(['data' =>  'invalid data input !']);
        }

    }

    public function response()
    {
        echo "OK";
        // $data = file_get_contents('php://input');
        // var_dump($data);
    }

    public function connect()
    {
        //get id user seller
        $id = $this->session->get_userdata('id_seller');
        //get data user seller
        $idAPI = $this->uri->segment(4);
        $idHotel = $this->uri->segment(5);
        $data['seller'] = $this->Standard_model->getSingle('tb_seller','id_seller',$id['id_seller']);
        $data['hotel'] = $this->Standard_model->getSingle('tb_hotel','id_hotel',$idHotel);

        
        $this->form_validation->set_rules('url','End Point', 'required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('seller/templates/header',$data);
            $this->load->view('seller/createConnection',$data);
            $this->load->view('seller/templates/footer');

        }else{
            // data base action
            $data = [
                'url'      => $this->input->post('url'),
                'status'    => 1
            ];

            $result = $this->Standard_model->updateData('tb_api',$data, 'id_api',$idAPI);
            if($result){
                redirect(base_url().'API/List');
            }
        }
    }

    public function getEndpoint()
    {
        $id = $this->uri->segment(4);
        $this->Api_Model->selectIdpartner($id);
        
        
        $url = 'http://management.com/api/room';
        $data = json_decode(Bridge::get($url));
        $id_partner = $data->security->id_partner;
        $api = $this->Standard_model->getSingle('tb_api','id_partner',$id_partner);
        var_dump($api);
        die();

    }
}
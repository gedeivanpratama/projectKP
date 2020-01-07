<?php

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation','session','Pdf'));
        $this->load->model(array('Standard_model','Customer_model','Cront_Model','Api_Model'));
        $this->checkSesion();
    }

    public function checkSesion()
    {
        if(empty($this->session->userdata('id_customer'))){
            redirect(base_url());
        }
    }

    public function userid()
    {
        if($this->session->get_userdata('id_customer') !== null){
            return $this->session->userdata('id_customer');
        }

        return $this->session->userdata('id_seller');
    }

    public function dataUser()
    {
        $id = $this->session->get_userdata('id_customer');
        $data['profile'] = $this->Standard_model->getSingle('tb_profile','id_user', $id['id_customer']);
        if(is_null($data['profile'])){
            $profile = $this->Standard_model->one('tb_user',$id['id_customer']);
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

    public function dasboardCustomer()
    {

        //get data customer
        $id_customer = $this->session->userdata('id_customer');
        // $data['customer'] = $this->Standard_model->getSingle('tb_user','id',$id_customer);
        $data['profile']  = $this->dataUser();
        
        //get data customer reservation
        $data['reservation'] = $this->Customer_model->getCustomerReservation($id_customer);

        $this->load->view('customer/templates/header',$data);
        $this->load->view('customer/dasboard');
        $this->load->view('customer/templates/footer');

    }

    public function myReservation()
    {
        //get data customer
        $id_customer = $this->session->userdata('id_customer');
        $data['profile'] = $this->dataUser();

        //get data customer reservation
        $data['reservation'] = $this->Customer_model->getCustomerReservation($id_customer);

        $this->load->view('customer/templates/header',$data);
        $this->load->view('customer/dasboard',$data);
        $this->load->view('customer/templates/footer');
    }

    public function myReservDetail($idR)
    {
        //get id customer
        $id_customer = $this->session->userdata('id_customer');

        $id_type = $this->uri->segment(4);

        //get id reservasi
        $id_reservasi = $this->uri->segment(2);

        //get id type
        $id_hotel = $this->uri->segment(3);

        //get id room
        $id_room = $this->uri->segment(5);

        
        //$data customer
        $data['profile'] = $this->dataUser();

        //data hotel
        $data['hotel'] = $this->Standard_model->getSingle('tb_hotel','id_hotel',$id_hotel);

        //data hotel facility
        $data['hotelFacility'] = $this->Standard_model->getAll('tb_fasilitas_hotel','id_hotel',$id_hotel);

        //data room type
        $data['type'] = $this->Standard_model->getSingle('tb_type','id_type',$id_type);

        //data event
        $data['event'] = $this->Standard_model->getAllData('tb_event');

        //data room
        $data['room'] = $this->Standard_model->getSingle('tb_kamar','id_kamar',$id_room);

        //data reservation
        $data['reservation'] = $this->Standard_model->getSingle('tb_reservasi','id_reservasi',$id_reservasi);

        //data event
        $data['event'] = $this->Standard_model->getAllData('tb_event');

        //data payment
        $data['payment'] = $this->Standard_model->getAll('tb_payment','id_hotel',$id_hotel);
        
        $this->load->view('customer/templates/header',$data);
        $this->load->view('customer/reservDetail',$data);
        $this->load->view('customer/templates/footer');
        
    }

    public function myBookingCancel()
    {
        //get id customer
        $id_customer = $this->session->userdata('id_customer');

        //$data customer
        $data['profile'] = $this->dataUser();

        //get data customer reservation
        $data['reservation'] = $this->Customer_model->getCustomerCancel($id_customer);

        $this->load->view('customer/templates/header',$data);
        $this->load->view('customer/myBookingCancel',$data);
        $this->load->view('customer/templates/footer');
    }

    /**
     * cancel reservation 
     */
    public function cancelMyReserv()
    {
        $id = $this->uri->segment(2);
        $result = $this->Standard_model->deleteData('tb_reservasi','id_reservasi',$id);

        if($result){
            $this->session->set_flashdata('title','Cancel Reservation');
            $this->session->set_flashdata('info','Canceled');
            redirect('myReservation');
            
        }
        
    }

    public function myConfirmation($id_reservasi)
    {
        //get id customer
        $id_customer = $this->session->userdata('id_customer');

        //$data customer
        $data['profile'] = $this->dataUser();

        //get id Hotel
        $idH = $this->uri->segment(3);

        //data payment
        $data['payment'] = $this->Standard_model->getAll('tb_payment','id_hotel',$idH);

        $this->form_validation->set_rules('sender_name','Sender Name','required');
        $this->form_validation->set_rules('bank_sender','Bank Sender','required');
        $this->form_validation->set_rules('no_rek_sender','No Rek','required');
        $this->form_validation->set_rules('total_transfer','Total Transfer','required');
        $this->form_validation->set_rules('transfer_time','Transfer Time','required');
        $this->form_validation->set_rules('id_payment','Id Payment','required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('customer/templates/header',$data);
            $this->load->view('customer/myConfirmation',$data);
            $this->load->view('customer/templates/footer');
        }else{
            $data = array(
                'sender_name'       => $this->input->post('sender_name'),
                'bank_sender'       => $this->input->post('bank_sender'),
                'no_rek_sender'     => $this->input->post('no_rek_sender'),
                'total_transfer'    => $this->input->post('total_transfer'),
                'transfer_time'     => $this->input->post('transfer_time'),
                'id_payment'        => $this->input->post('id_payment'),
                'id_reservasi'      => $id_reservasi
            );
            
            $id_confirm = $this->Api_Model->insertData('tb_confirm',$data);

            $dataU = array(
                'id_status_reservasi' => 2
            );

            $update = $this->Standard_model->updateData('tb_reservasi',$dataU,'id_reservasi',$id_reservasi);
            if($update){
                $this->session->set_flashdata('title','Confirmation');
                $this->session->set_flashdata('info','Confirm');
                redirect(base_url().'dasboardCustomer');
            }
        }

    }

    public function getPDF()
    {
        $mpdf = new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf',
                                'margin_left' => 10,
                                'margin_right' => 10,
                                'margin_top' => 5,
                                'margin_bottom' => 0,
                                'margin_header' => 0,
                                'margin_footer' => 0,
                                'format' => 'A5-P',
                                ]);
        $data = "ivan";
        // get id reservasi
        $idR = $this->uri->segment(2);

        //get id hotel
        $idH = $this->uri->segment(3);

        //get data reservation
        $reservation = $this->Customer_model->getDataPDF($idR);
        $confirm = $this->Customer_model->getdataConfirm($idR);

        $check_in = $reservation['check_in'];
        $check_out = $reservation['check_out'];
        $out = strtotime($check_out);
        $in = strtotime($check_in);
        $totalDay = ($out - $in) / (24*60*60);
        
        $html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Document</title>
            <style>
                header{
                    margin :0;
                    text-align:center;
                }

                header p{
                    margin:0;
                }

                .box-customer,
                .box-information{
                    width:40%;
                }

                .box-customer{
                    float:left;
                }

                .box-information{
                    float:right;
                }

                .box-booking{
                    clear:both;
                }

                table {
                    border-collapse: collapse;
                }
                
                table, th, td {
                    border: 1px solid black;
                }

                td{
                    padding:2px;
                }

                .box-customer-pay{
                    width:40%;
                    float:left;
                }
                .box-confirm{
                    width:40%;
                    float:right;
                }

            </style>
        </head>
        <body>
            <header>
                <div><span>Telp :081928192891</span> | <span>Email:manajementHotel@gmail.com</span></div>
                <p class="header-title">Booking Information</p>
                <p class="header-title">Reservasi Hotel</p>
            </header>
            <hr>
                <div class="box-customer">
                    <p>Customer Information</p>
                    <table>
                        <tr>
                            <td>Name </td>
                            <td> '. $reservation['nama_customer']. '</td>
                        </tr>
                        <tr>
                            <td>Alamat </td>
                            <td> '.$reservation['alamat_customer'].'</td>
                        </tr>
                        <tr>
                            <td>Email </td>
                            <td> '.$reservation['email_customer'].'</td>
                        </tr>
                        <tr>
                            <td>Telp </td>
                            <td> '.$reservation["telp_customer"].'</td>
                        </tr>
                    </table>
                </div>
        
                <div class="box-information">
                    <p>Room Information</p>
                    <table class="table">
                        <tr>
                            <td>Name </td>
                            <td> '.$reservation['nama_type'].'</td>
                        </tr>
                        <tr>
                            <td>No </td>
                            <td> '.$reservation['no_kamar'].'</td>
                        </tr>
                        <tr>
                            <td>Price /Night </td>
                            <td> '.$reservation['harga'] .'</td>
                        </tr>
                    </table>
                </div>
        
                <div class="box-booking">
                    <p>Booking Information</p>
                    <table class="table">
                        <tr>
                            <td>Name </td>
                            <td>Check In</td>
                            <td>Check Out</td>
                            <td>Total Night</td>
                            <td>Total Price</td>
                        </tr>
                        <tr>
                            <td>'.$reservation['nama_customer'].'</td>
                            <td>'.$reservation['check_in'].'</td>
                            <td>'.$reservation['check_out'].'</td>
                            <td>'.$totalDay.'</td>
                            <td>Rp. '.$reservation['total_price'].'</td>
                        </tr>
                       
                    </table>
                </div>
                <br>
                <div class="box-customer-pay">
                    <p>Payment Information</p>
                    <table class="customer-pay-info">
                        <tr>
                            <td>Name </td>
                            <td> '. $confirm['payment_owner'].'</td>
                        </tr>
                        <tr>
                            <td>Bank Name </td>
                            <td> '. $confirm['bank_name'].'</td>
                        </tr>
                        <tr>
                            <td>Debit Number </td>
                            <td> '. $confirm['no_rek'].'</td>
                        </tr>
                    </table>
                </div>
        
                <div class="box-confirm">
                    <p>Payment Confirm</p>
                    <table>
                        <tr>
                            <td>Name </td>
                            <td> '. $confirm['sender_name'].'</td>
                        </tr>
                        <tr>
                            <td>Bank Name </td>
                            <td> '. $confirm['bank_sender'].'</td>
                        </tr>
                        <tr>
                            <td>Debit Number </td>
                            <td> '. $confirm['no_rek_sender'].'</td>
                        </tr>
                    </table>
                </div>
            <footer style="clear:both;margin-top:10px;text-align:center">
                <hr>
                <p>Thank you for choosing Us &copy; 2019</h5>
            </footer>
        </body>
        </html>';
        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("Acme Trading Co. - Invoice");
        $mpdf->SetAuthor("Acme Trading Co.");
        $mpdf->SetWatermarkText("Paid");
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

}

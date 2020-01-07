<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>
    
    <!-- create navbar for seller -->
    <div class="container-fluid bg-warning py-1">
        <div class="row align-items-center justify-content-end">
        <span class="mr-3">Register your hotel in our site</span>
            <a href="<?=base_url()?>loginSeller" class="btn-sm btn-dark">Login | Register as <b>Seller</b></a>
        </div>
    </div>

    <!-- main navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-4">
        <a class="navbar-brand" href="<?= base_url() ?>">
        <i class="fas fa-hotel" style="font-size:30px"></i>
        <b>Hotel<span class="text-warning">Booking</span></b>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <?php if(!empty($this->session->userdata('id_customer')) && $this->session->userdata('id_rolle') === '2'): ?>
            <ul class="navbar-nav mt-2">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>manageAccountCus">My Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>myReservation">My Reservation</a>
                </li>
            </ul>
            <?php endif; ?>
            <?php if(!empty($this->session->userdata('id_customer')) && $this->session->userdata('nama_customer') === '2'): ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url() ?>logoutCustomer">Logout</a>
                </li>
            </ul>
            <?php else: ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link btn btn-info" href="<?=base_url() ?>registerCustomer">Register</a>
                </li>
                <li class="nav-item ml-3">
                    <a class="nav-link btn btn-success" href="<?=base_url() ?>loginCustomer">Login</a>
                </li>
            </ul>
            <?php endif; ?>
        </div>
    </nav>


    <header class="d-block" style="background-image: url('<?= base_url() ?>assets/myFile/images/banner.jpeg');">
        <div class="p-5 text-center">
          <div class="py-5" style="background-color:rgba(0,0,0, 0.4) !important" >
            <h1 class="display-4 text-center text-light" style="font-family: 'Playfair Display', serif;"><b class="text-warning">Hotel Booking</b>,<br> your hotel booking choice..</h1>
          </div>
        </div>
    </header>

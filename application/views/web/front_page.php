<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">
    <link rel="stylesheet" href="assets/myFile/css/style.css">
    <title>Hotel Reservation</title>
</head>
<body>
    <div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>
    <!-- login as seller -->
    <div class="container-fluid bg-warning py-1">
        <div class="row align-items-center justify-content-end">
        <span class="mr-3">Register your hotel in our site</span>
            <a href="<?=base_url()?>loginSeller" class="btn-sm btn-dark">Login | Register as <b>Seller</b></a>
        </div>
    </div><!-- end login as seller -->

    <!-- main nav bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-4">
        <a class="navbar-brand" href="<?= base_url() ?>">
        <i class="fas fa-hotel" style="font-size:30px"></i>
        <b>Hotel<span class="text-warning">Booking</span></b>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <!-- if user login show this line below -->
        <?php if(!empty($this->session->userdata('id_customer')) && $this->session->userdata('id_rolle') === '2'): ?>
            <ul class="navbar-nav mt-2">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>manageAccount">My Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>myReservation">My Reservation</a>
                </li>
            </ul>
            <?php endif; ?>
            <?php if(!empty($this->session->userdata('id_customer')) && $this->session->userdata('id_rolle') === '2'): ?>
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
        </div><!-- end user login -->
    </nav><!-- end main navbar -->


    <!-- banner code -->
    <header class="banner" style="background-image: url('<?= base_url() ?>assets/myFile/images/banner.jpeg');">
        <div class="banner-box-text">
            <h1 class="display-4 text-center" style="font-family: 'Playfair Display', serif;"><b class="text-warning">Hotel Booking</b>,<br> your hotel booking choice..</h1>
        </div>
    </header><!-- end banner code -->


    <!-- create form search hotel -->
    <?php $attr = ['class' => 'justify-content-center mx-auto p-4 bg-light rounded border shadow',
                'style' => 'width:700px;margin-top:-50px']; ?>
    <?= form_open('',$attr); ?>
        <h2 class="mb-4 text-center"><b>Search Hotel :</b></h2>
        <div class="form-row">
            <span style="color:red;display:block;"><?= form_error('search'); ?></span>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-search-location"></i></div>
                </div>
                <input type="text" name="search" class="form-control form-control-lg" placeholder="Search Hotel ...">
            </div>
        </div>
        <div class="form-row mt-3">
            <div class="form-group col">
                <label for="inputAddress">Check In</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                </div>
                <input type="date" name="check_in" class="form-control form-control-lg">
            </div>
            </div>
            <div class="form-group col">
                <label for="inputAddress">Check Out</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                </div>
                <input type="date" name="check_out" class="form-control form-control-lg">
            </div>
            </div>
        </div>
            <div class="form-row">
                <button type="submit" class="btn btn-info ml-auto"><i class="fas fa-search-plus"></i> Search</button>
            </div>
    <?= form_close() ?>
    <!-- end form search hotel -->

    
    <?php if(!isset($keyword)):?>
        <div class="container mt-5">
            <hr>
            <h2 class="text-center mt-5"><b>Why Choose Us ?</b></h2>
            <br>
            <div class="row justify-content-center mb-5">
                <div class="card col-3 mx-3 px-0 shadow">
                    <img src="<?= base_url() ?>assets/img/a.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title text-warning">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
                <div class="card col-3 mx-3 px-0 shadow">
                    <img src="<?= base_url() ?>assets/img/b.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title text-warning">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
                <div class="card col-3 mx-3 px-0 shadow">
                    <img src="<?= base_url() ?>assets/img/c.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title text-warning">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row justify-content-center">
            <div class="col-8 shadow py-5">
            <h2 class="text-center text-warning">About Us</h2>
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <h3 class="text-warning">the Title</h3>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Distinctio molestias cumque quidem maiores architecto asperiores incidunt ipsum ut. Distinctio quos minima omnis fugit ex consequatur illo. Nemo reiciendis nisi provident?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam dolorum, sapiente facilis nobis dolorem similique error! Quidem deleniti fuga nostrum atque a! Praesentium molestias eveniet fuga ea ducimus voluptatibus recusandaeLorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam dolorum, sapiente facilis nobis dolorem similique error! Quidem deleniti fuga nostrum atque a! Praesentium molestias eveniet fuga ea ducimus voluptatibus recusandae</p>    
                        </div>
                        <div class="col-10">
                            <h3 class="text-right text-warning">the Title</h3>
                            <p class="text-right">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Distinctio molestias cumque quidem maiores architecto asperiores incidunt ipsum ut. Distinctio quos minima omnis fugit ex consequatur illo. Nemo reiciendis nisi provident?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam dolorum, sapiente facilis nobis dolorem similique error! Quidem deleniti fuga nostrum atque a! Praesentium molestias eveniet fuga ea ducimus voluptatibus recusandaeLorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam dolorum, sapiente facilis nobis dolorem similique error! Quidem deleniti fuga nostrum atque a! Praesentium molestias eveniet fuga ea ducimus voluptatibus recusandae</p>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(!empty($keyword)):?>
    <?php if(!empty($search)): ?>
    <div class="container mt-5">
        <hr>
        <h2 class="text-center mb-5">You search for keyword : "<b><?= $keyword;?></b>"</h2>
        <?php
        foreach($search as $key => $val): ?>
        <div class="row mb-3 shadow">
            <div class="col-4 p-0">
                <img class="img-thumbnail float-left" src="<?= base_url(); ?>uploads/hotelImages/<?= $val['image_hotel'] ?>" alt="hotel image">
            </div>
            <div class="col-8">
                <div class="row p-4">
                    <div class="col">
                        <h4><b>Hotel Description</b><i class="fas fa-info-circle"></i>:</h4>
                        <p><i class="fas fa-building"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nama Hotel : <?= $val['nama_hotel']; ?></p>
                        <p><i class="fas fa-map-marked-alt mr-3"></i> Alamat : <?= $val['alamat_hotel']; ?></p>
                        <p><i class="fas fa-phone-square mr-3"></i> Telp : <?= $val['telp_hotel'] ?></p>
                        <p><i class="fas fa-envelope mr-3"></i> Email: <?= $val['email_hotel']?></p>
                    </div>
                    <div class="col">
                        <a class="btn-lg btn-success" href="<?= base_url(); ?>hotelDetails/<?= $val['id_hotel'];?>" ><i class="far fa-eye"></i> View Hotel</a>
                        <p class="mt-3">Room price start from :</p>
                    <h3 class="bg-warning border border-dark d-inline-block p-2 rounded">Rp. <b><?= number_format($val['harga']); ?></b></h3>
                    
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
        <?php else: ?>
        <hr>
        <h2 class="text-center mb-5">You search for keyword : "<b><?= $keyword;?></b>"</h2>
        <h1 class="text-center text-warning mt-5">Hotel not Found <i class="fas fa-exclamation-triangle"></i></h1>
        <?php endif; ?>
    <?php endif; ?>


    </div>
    <footer>
        <p class="text-center">All Right Resereved</p>
    </footer>
    <script src="assets/myFile/js/jquery.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>assets/myFile/js/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>assets/myFile/js/myscript.js"></script>

</body>
</html>
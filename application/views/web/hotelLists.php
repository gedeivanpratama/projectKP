<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/myFile/css/style.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-inverse" style='margin-bottom:0;border-radius:0px;'>
  <div class="container-fluid" style="padding:1rem 0;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= base_url() ?>">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <?php if(!empty($this->session->userdata('id_customer')) && !empty($this->session->userdata('nama_customer'))): ?>
      <ul class="nav navbar-nav">
        <li><a href="<?= base_url(); ?>">my Profile <span class="sr-only">(current)</span></a></li>
        <li><a href="<?= base_url(); ?>myReservation">my Reservation</a></li>
      </ul>
    <?php endif; ?>

      <ul class="nav navbar-nav navbar-right">
        <?php if(!empty($this->session->userdata('id_customer')) && !empty($this->session->userdata('nama_customer'))): ?>
            <li><a href="<?=base_url() ?>logoutCustomer">Log Out</a></li>
        <?php endif; ?>

        <?php if(empty($this->session->userdata('id_customer')) && empty($this->session->userdata('nama_customer'))): ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?= base_url(); ?>loginSeller">Login as Seller</a></li>
            <li><a href="<?= base_url(); ?>loginCustomer">Login as Customer</a></li>
          </ul>
        </li>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    <header class="banner" style="background-image: url('<?= base_url() ?>assets/myFile/images/banner.jpeg');">
        <div class="banner-box-text">
          <h1 class="display-4 text-center"><b>Travel Booking Hotel</b>,<br> your hotel booking choice..</h1>
        </div>
    </header>

    <?php $attr = array('class'=>'form-search'); ?>
    <?= form_open('',$attr); ?>
        <h4>Search Hotel</h4>
        <div class="search-group">
            <span class="glyphicon glyphicon-map-marker"></span><input type="search" name="search" id="" placeholder=" Search..."><input type="submit" value="search">
        </div>
       
        <div class="grup-date">
        <label class="check-in"for="">Check In :</label><label class="check-out" for="">Check Out :</label>
            <div class="date-box">
                <span class="glyphicon glyphicon-calendar calendar1"></span><input type="date">
            </div>
            
            <div class="date-box">
                <span class="glyphicon glyphicon-calendar calendar2"></span><input type="date">
            </div>
        </div>
    <?= form_close(); ?>

    <div class="container my-push">
        <h2 class="text-center">You search for keyword : "<b><?= $keyword;?></b>"</h2>
        <hr>
        <?php foreach($search as $key => $val): ?>
        <div class="hotel-list-container">
            <img class="img-hotel-list" src="<?= base_url(); ?>uploads/hotelImages/<?= $val['image_hotel'] ?>" alt="hotel image">
            <div class="hotel-list-content">
                <h4><?= $val['nama_hotel']; ?> Hotel</h4>
                <p><span class="glyphicon glyphicon-map-marker"></span> alamat : <?= $val['alamat_hotel']; ?></p>
                <div class="hotel-list-info">
                    <p><span class="glyphicon glyphicon-phone-alt"></span> telp : <?= $val['telp_hotel'] ?></p> |
                    <p><span class="glyphicon glyphicon-envelope"></span> email: <?= $val['email_hotel']?></p>
                </div>
                <a class="btn btn-info btn-list-view-hotel" href="<?= base_url(); ?>hotelDetails/<?= $val['id_hotel'];?>" target='blank'>View Hotel</a>
                <div class="my-label-container">
                    <p>Room price start from :</p>
                    <h3 class="label label-success my-label">Rp. <?= number_format($val['harga']); ?></h3>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <footer>
        <p class="text-center">All Right Resereved</p>
    </footer>
    <script src="<?= base_url(); ?>assets/myFile/js/jquery.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>assets/myFile/js/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>assets/myFile/js/myscript.js"></script>
</body>
</html>
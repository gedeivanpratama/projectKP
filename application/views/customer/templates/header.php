<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Starter</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/myFile/css/style.css">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?= base_url(); ?>myReservation" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>C</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">My Dasboard</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?= base_url(); ?>uploads/customer/<?= $customer['img_customer'] ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?= $customer['nama_customer'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?= base_url(); ?>uploads/customer/<?= $customer['img_customer'] ?>" class="img-circle" alt="User Image">
                <p>
                  <?= $customer['telp_customer'] ?> - <?= $customer['email_customer']; ?>
                  <small><?= $customer['alamat_customer'];?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= base_url(); ?>manageAccountCus" class="btn btn-default btn-flat"><span class="fa fa-user"> Profile</span></a>
                </div>
                <div class="pull-right">
                  <a href="<?= base_url(); ?>logoutCustomer" class="btn btn-default btn-flat"><span class="fa fa-unlock"> Sign out</span></a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url(); ?>uploads/customer/<?= $customer['img_customer'] ?>" class="img-circle my-image-round" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $customer['nama_customer']; ?></p>
          <span><?= $customer['alamat_customer'];?></span>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="<?= base_url()?>Web"><i class="fa fa-paper-plane"></i> <span>Visit Web</span></a></li>
        
        <li><a href="<?= base_url(); ?>myReservation"><i class="fa fa-phone"></i> <span>My Reservation</span></a></li>
        <li><a href="<?= base_url(); ?>myBookingCancel"><i class="fa fa-minus-circle"></i> <span>BooKing Cancel</span></a></li>
        <li><a href="<?= base_url(); ?>manageAccountCus"><i class="fa fa-gear"></i><span>Manage Account</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
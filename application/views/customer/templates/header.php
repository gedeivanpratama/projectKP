<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/skins/skin-purple.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/myFile/css/style.css">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">
  <!-- Main Header -->
  <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url(); ?>dasboardSeller" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>K</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Seller</b></span>
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
              <img src="<?= base_url(); ?>uploads/seller/<?= $profile['image'] ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?= $profile['name'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?= base_url(); ?>uploads/seller/<?= $profile['image'] ?>" class="img-circle" alt="User Image">
                <p>
                  <?= $profile['telp'] ?> - <?= $profile['name']; ?>
                  <small><?= $profile['address'];?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat"><span class="fa fa-user"> Profile</span></a>
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
          <img src="<?= base_url(); ?>uploads/seller/<?= $profile['image'] ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $profile['name']; ?></p>
          <span><?= $profile['address'];?></span>
        </div>
      </div>

      <?php if($this->session->userdata('id_rolle') === '1'): ?>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">HEADER</li>
          <!-- Optionally, you can add icons to the links -->
          <li class="active"><a href="<?= base_url()?>Web"><i class="fa fa-paper-plane"></i> <span>Visit Web</span></a></li>
          <li class=" treeview">
            <a href="#">
              <i class="fa fa-edit"></i> <span>Hotel Setting</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="<?= base_url(); ?>hotelLists"><i class="fa fa-circle-o"></i> Data Hotel Lists</a></li>
              <li><a href="<?= base_url() ?>manageHotelFacility"><i class="fa fa-circle-o"></i> Hotel Facility Lists</a></li>
            </ul>
          </li>
          <li><a href="<?= base_url(); ?>reservation"><i class="fa fa-phone"></i> <span>Reservation</span></a></li>
          <li><a href="<?= base_url(); ?>manageAccount"><i class="fa fa-gear"></i><span>Manage Account</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>
      <?php else: ?>
        <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="<?= base_url()?>Web"><i class="fa fa-paper-plane"></i> <span>Visit Web</span></a></li>
        <li><a href="<?= base_url(); ?>myReservation"><i class="fa fa-phone"></i> <span>My Reservation</span></a></li>
        <li><a href="<?= base_url(); ?>myBookingCancel"><i class="fa fa-minus-circle"></i> <span>BooKing Cancel</span></a></li>
        <li><a href="<?= base_url(); ?>manageAccount"><i class="fa fa-gear"></i><span>Manage Account</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
    <?php endif; ?>
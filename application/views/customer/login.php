<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/myFile/css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>
<body class="hold-transition login-page my-login-bg" style="background-image: url('<?= base_url() ?>assets/myFile/images/banner.jpeg');">
<div class="login-box">
  <div class="login-logo">
    <a href="<?= base_url() ?>web"><b>Reservasi</b>Hotel</a>
    <span></span>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <h3 class="text-center">Login As Customer</h3>
    <?php echo form_open(); ?>
      <div class="form-group has-feedback">
        <span class="text-danger"><?php echo form_error('email_customer'); ?></span>
        <input type="text" class="form-control" placeholder="Email" name="email_customer">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <span class="text-danger"><?php echo form_error('customer_password'); ?></span>
        <input type="password" class="form-control" placeholder="Password" name="customer_password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-success btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    <?php form_close(); ?>
    <!-- /.social-auth-links -->
    <br>
    <a href="registerCustomer" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?= base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?= base_url();?>assets/myFile/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url();?>assets/myFile/js/myscript.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
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
  <link rel="stylesheet" href="<?= base_url(); ?>assets/myFile/css/style.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page my-login-bg" style="background-image: url('<?= base_url() ?>assets/myFile/images/banner.jpeg');">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Reservasi</b>Hotel</a>
    <span></span>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body my-registerBox">
    <p class="login-box-msg">Register Customer</p>
    <?php echo form_open(); ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <span class="text-danger"><?php echo form_error('nama_customer'); ?></span>
            <input type="text" class="form-control" name="nama_customer" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <span class="text-danger"><?php echo form_error('email_customer'); ?></span>
            <input type="email" class="form-control" name="email_customer" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">telp</label>
            <span class="text-danger"><?php echo form_error('telp_customer'); ?></span>
            <input type="number" class="form-control" name="telp_customer" placeholder="Telp">
        </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <span class="text-danger"><?php echo form_error('alamat_customer'); ?></span>
                <input type="text" class="form-control" name="alamat_customer" placeholder="Alamat">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <span class="text-danger"><?php echo form_error('customer_password'); ?></span>
                <input type="password" class="form-control" name="customer_password" placeholder="Password">
            </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-success btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    <?php form_close(); ?>
    <!-- /.social-auth-links -->
    <br>
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
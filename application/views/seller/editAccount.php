<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content container-fluid">
    <div class="box box-primary my-box">
            <div class="box-header with-border">
              <h4 class="my-center">Edit Account</h4>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open(); ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama :</label>
                  <span style="color:red;"><?= form_error('nama_seller'); ?></span>
                  <input type="text" class="form-control" name="nama_seller" value="<?= $seller['nama_seller'] ?>" id="exampleInputEmail1" placeholder="Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Telp :</label>
                  <span style="color:red;"><?= form_error('telp_seller'); ?></span>
                  <input type="text" class="form-control" name="telp_seller" value="<?= $seller['telp_seller'] ?>" id="exampleInputPassword1" placeholder="Telp">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Email :</label>
                  <span style="color:red;"><?= form_error('email_seller'); ?></span>                  
                  <input type="email" class="form-control" name="email_seller" value="<?= $seller['email_seller'] ?>" id="exampleInputPassword1" placeholder="Email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Alamat :</label>
                  <span style="color:red;"><?= form_error('alamat_seller'); ?></span>
                  <input type="text" class="form-control" name="alamat_seller" value="<?= $seller['alamat_seller'] ?>" id="exampleInputPassword1" placeholder="Alamat">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a class="btn btn-primary" href="<?= base_url() ?>manageAccountCus">Back</a>
                <button type="submit" class="btn btn-warning">Submit</button>
              </div>
            <?php echo form_close(); ?>
          </div>
    </section>
</div>
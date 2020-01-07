<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content container-fluid">
    <div class="box box-primary my-box">
            <div class="box-header with-border">
              <h4 class="my-center">Edit Account</h4>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open_multipart(); ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama :</label>
                  <span style="color:red;"><?= form_error('nama'); ?></span>
                  <input type="text" class="form-control" name="name" value="<?= $profile['name'] ?>" id="exampleInputEmail1" placeholder="Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Telp :</label>
                  <span style="color:red;"><?= form_error('telp'); ?></span>
                  <input type="text" class="form-control" name="telp" value="<?= $profile['telp'] ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Image :</label>
                  <span style="color:red;"><?= form_error('image'); ?></span>                  
                  <input type="file" name="image">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Address :</label>
                  <span style="color:red;"><?= form_error('address'); ?></span>
                  <input type="text" class="form-control" name="address" value="<?= $profile['address'] ?>">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-warning">Submit</button>
              </div>
            <?php echo form_close(); ?>
          </div>
    </section>
</div>
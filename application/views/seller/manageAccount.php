<!-- Content Wrapper. Contains page content -->
<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        

<div class="content-wrapper">
	<section class="content container-fluid">
        <div class="box my-box">
            <div class="box-header">
              <h4 class=" my-center">Account Information :</h4>
              <img class="profile-user-img img-responsive img-circle my-profile" src="<?= base_url() ?>uploads/seller/<?= $seller['img_seller'];?>" alt="User profile picture">
              <div class="form-photo">
                <?php echo form_open_multipart('addPhotoSeller') ?>
                <label class="file-upload">
                    <input type="file" name="photo_profile"/>
                    Upload
                </label><br>
                <span><?= form_error('photo_profile')?></span>
                <button type="submit" class="btn btn-warning">Edit</button>
                <?php echo form_close(); ?>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed my-account">
                <tbody>
                <tr>
                  <th>Name :</th>
                  <td><?= $seller['nama_seller'] ?></td>
                </tr>
                <tr>
                  <th>Telp :</th>
                  <td><?= $seller['telp_seller'] ?></td>
                </tr>
                <tr>
                  <th>Email :</th>
                  <td><?= $seller['email_seller'] ?></td>
                </tr>
                <tr>
                  <th>Alamat :</th>
                  <td><?= $seller['alamat_seller'] ?></td>
                </tr>
                <tr>
                <td><a class="btn btn-warning" href="<?= base_url(); ?>editAccount">Edit</a></td>
                </tr>
               
              </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
</div>
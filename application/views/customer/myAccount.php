<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>">
</div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content container-fluid">
        <div class="box my-box">
            <div class="box-header">
              <h4 class=" my-center">Account Information :</h4>
              <img class="profile-user-img img-responsive img-circle my-profile" src="<?= base_url() ?>uploads/customer/<?= $customer['img_customer'];?>" alt="User profile picture">
              <div class="form-photo">
                <?php echo form_open_multipart('addPhoto') ?>
                <label class="file-upload">
                    <input type="file" name="photo_profile"/>
                    Upload
                </label><br>
                <span><?= form_error('photo_profile')?></span>
                <button type="submit" class="btn btn-warning"><span class="fa fa-edit"> Edit</span></button>
                <?php echo form_close(); ?>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed my-account">
                <tbody>
                <tr>
                  <th>Name :</th>
                  <td><?= $customer['nama_customer'] ?></td>
                </tr>
                <tr>
                  <th>Telp :</th>
                  <td><?= $customer['telp_customer'] ?></td>
                </tr>
                <tr>
                  <th>Email :</th>
                  <td><?= $customer['email_customer'] ?></td>
                </tr>
                <tr>
                  <th>Alamat :</th>
                  <td><?= $customer['alamat_customer'] ?></td>
                </tr>
                <tr>
                <td><a class="btn btn-warning" href="<?= base_url(); ?>editAccountCus/<?= $customer['id_customer'] ?>"><span class="fa fa-edit"> Edit</span></a></td>
                </tr>
               
              </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
</div>
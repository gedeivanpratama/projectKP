<!-- Content Wrapper. Contains page content -->
<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        
<div class="content-wrapper">
	<section class="content container-fluid">
    <?php if($profile['id'] !== 'no' ): ?>
        <div class="box my-box">
            <div class="box-header">
              <h4 class=" my-center">Account Information :</h4>
              <img class="profile-user-img img-responsive img-circle my-profile" src="<?= base_url() ?>uploads/seller/<?= $profile['image'];?>" alt="User profile picture">
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed my-account">
                <tbody>
                <tr>
                  <th>Name :</th>
                  <td><?= $profile['name'] ?></td>
                </tr>
                <tr>
                  <th>Telp :</th>
                  <td><?= $profile['telp'] ?></td>
                </tr>
                <tr>
                  <th>Alamat :</th>
                  <td><?= $profile['address'] ?></td>
                </tr>
                <tr>
                <td><a class="btn btn-warning" href="<?= base_url(); ?>editAccount">Edit</a></td>
                </tr>
               
              </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    <?php endif; ?>
    <?php if($profile['id'] === 'no'): ?>
      <div class="box my-box text-center">
      <h1>you have no profile !</h1>
      <a class="btn btn-primary" href="<?= base_url() ?>addProfile">Create Profile</a>
      <br><br><br>
      </div>
    <?php endif; ?>
    </section>
</div>
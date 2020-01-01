<div class="content-wrapper">
    <section class="content container-fluid">
        <a class="btn btn-primary" href="<?= base_url();?>hotelLists"><span class="fa fa-chevron-left"> My Hotel</span></a>
        <a class="btn btn-primary" href="<?= base_url();?>addHotelPayment"><span class="fa fa-plus"> Add Hotel Payment</span></a>
        <div class="box my-top">
            <div class="box-header">
              <h3 class="box-title">My Hotel Facility List :</h3>
            </div>
            <div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        

            <div class="box-body no-padding">
              <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <th>Id Payment</th>
                            <th>Atas Nama</th>
                            <th>Bank Name</th>
                            <th>No Rek</th>
                            <th>Nama Hotel</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach($payment as $key => $value) : ?>
                        <tr>
                            <td><?= $value['id_payment']; ?></td>
                            <td><?= $value['payment_owner']; ?></td>
                            <td><?= $value['bank_name']; ?></td>
                            <td><?= $value['no_rek']; ?></td>
                            <td><?= $value['nama_hotel'] ?></td>
                            <td>
                                <a class="btn btn-warning" href="<?= base_url(); ?>editPayment/<?= $value['id_payment'] ?>"><span class="fa fa-edit"> Edit</span></a>
                                <a class="btn btn-danger" href="<?= base_url(); ?>deletePayment/<?= $value['id_payment'] ?>"><span class="fa fa-times"> Delete</span></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
</div>
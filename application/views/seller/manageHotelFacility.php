<div class="content-wrapper">
    <section class="content container-fluid">
        <a class="btn btn-primary" href="<?= base_url();?>hotelLists"><span class="fa fa-chevron-left"> My Hotel</span></a>
        <a class="btn btn-primary" href="<?= base_url();?>addHotelFacility"><span class="fa fa-plus"> Add Hotel Facility</span></a>
        <div class="box my-top">
            <div class="box-header">
              <h3 class="box-title">My Hotel Facility List :</h3>
            </div>
            <div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        

            <div class="box-body no-padding">
              <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <th>Id Facility</th>
                            <th>Facility Name</th>
                            <th>Total Facility</th>
                            <th>Hotel Name</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach($facility as $key => $val): ?>
                        <tr>
                            <td><?= $val['id_fasilitas_hotel']; ?></td>
                            <td><?= $val['nama_fasilitas']; ?></td>
                            <td><?= $val['jumlah_fasilitas']; ?></td>
                            <td><?= $val['nama_hotel']; ?></td>
                            <td>
                                <a href="editHotelFacility/<?php echo $val['id_fasilitas_hotel'] ?>" class="btn btn-warning"><span class="fa fa-edit"> Edit</span></a>
                                <a href="deleteHotelFacility/<?php echo $val['id_fasilitas_hotel'] ?>"  class="btn btn-danger" ><span class="fa fa-times"> Delete</span></a>
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
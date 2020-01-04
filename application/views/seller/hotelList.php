<div class="content-wrapper">
    <section class="content container-fluid">
        <a class="btn btn-primary" href="<?= base_url();?>addHotel"><span class="fa fa-plus"> Add Hotel</span></a>
        <a class="btn btn-primary" href="<?= base_url();?>addHotelFacility"><span class="fa fa-plus"> Add Hotel Facility</span></a>
        <a class="btn btn-primary" href="<?= base_url();?>manageHotelFacility"><span class=" fa fa-gear"> Manage Facility</span></a>
        <a class="btn btn-primary" href="<?= base_url();?>manageHotelPayment"><span class="fa fa-gear"> Manage Payment</span></a>

        <div class="box my-top">
            <div class="box-header">
              <h3 class="box-title">My Hotel List :</h3>
            </div>
            <div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        
            <div class="box-body no-padding">
              <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Hotel Name</th>
                            <th>Telp</th>
                            <th>Email</th>
                            <th>Fasilitas</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach($hotelLists as $key => $val): ?>
                        <tr>
                            <td><?= $val['id_hotel']; ?></td>
                            <td>
                                <img src="<?php echo base_url()?>uploads/hotelImages/<?= $val['image_hotel'] ?>" alt="hotel image view" style="width: 100px; height: 70px;">

                            </td>
                            <td><?= $val['nama_hotel']; ?></td>
                            <td><?= $val['telp_hotel']; ?></td>
                            <td><?= $val['email_hotel'];?></td>
                            <td>
                                <?php foreach($facility as $key => $valF): ?>
                                    <?php if($val['id_hotel'] === $valF['id_hotel']): ?>
                                    <span class="badge bg-blue"><?= $valF['nama_fasilitas'];?> : <?= $valF['jumlah_fasilitas'] ?> Item</span><br>
                                    <?php endif ?>
                                <?php endforeach; ?>
                            </td>
                            </td>
                            <td>
                                <a href="roomTypeLists/<?php echo $val['id_hotel'] ?>" class=" btn btn-success"> <span class="fa fa-eye"> Show Room Type</span></a>                    
                                <a href="editHotel/<?php echo $val['id_hotel'] ?>" class="btn btn-warning"><span class="fa fa-edit"> Edit</span></a>
                                <a href="deleteHotel/<?php echo $val['id_hotel'] ?>"  class="btn btn-danger" ><span class="fa fa-times"> Delete</span></a>
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
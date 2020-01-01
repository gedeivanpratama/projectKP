<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>
<div class="content-wrapper">
    <section class="content container-fluid">
        <a class="btn btn-primary" href="<?= base_url();?>addHotel">Add Hotel</a>
        <a class="btn btn-primary" href="<?= base_url();?>addHotelFacility">Add Hotel Facility</a>
        <div class="box my-top">
            <div class="box-header">
              <h3 class="box-title">My Hotel List :</h3>
            </div>
            <div class="box-body no-padding">
              <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Hotel Name</th>
                            <th>Telp</th>
                            <th>Email</th>
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
                                <a href="roomTypeLists/<?php echo $val['id_hotel'] ?>" class=" btn btn-success">Show Room Type</a>                    
                                <a href="editHotel/<?php echo $val['id_hotel'] ?>" class="btn btn-warning">Edit</a>
                                <a href="deleteHotel/<?php echo $val['id_hotel'] ?>"  class="btn btn-danger" >Delete</a>
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
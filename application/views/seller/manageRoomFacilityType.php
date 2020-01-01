<div class="content-wrapper">
    <section class="content container-fluid">
        <a class="btn btn-primary" href="<?= base_url();?>roomTypeLists/<?= $hotel['id_hotel'] ?>">My Room Type</a>
        <a class="btn btn-primary" href="<?= base_url();?>addRoomFacilityType/<?= $hotel['id_hotel'] ?>">Add Room Type Fasility</a>
        <a class="btn btn-primary" href="<?= base_url();?>manageRoomFacilityType/<?= $hotel['id_hotel'] ?>">Manage Room Type</a>
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
                            <th>Room Type Name</th>
                            <th>Hotel Name</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach($typeF as $key => $val): ?>
                        <tr>
                            <td><?= $val['id_fasilitas_kamar']; ?></td>
                            <td><?= $val['nama_fasilitas']; ?></td>
                            <td><?= $val['jumlah_fasilitas']; ?></td>
                            <td><?= $val['nama_type'] ?></td>
                            <td><?= $val['nama_hotel']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>editRoomTypeFacility/<?= $val['id_fasilitas_kamar'] ?>/<?= $val['id_hotel'] ?>" class="btn btn-warning">Edit</a>
                                <a href="<?= base_url(); ?>deleteRoomTypeFacility/<?= $val['id_fasilitas_kamar']?>/<?= $val['id_hotel'] ?>"  class="btn btn-danger" >Delete</a>
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
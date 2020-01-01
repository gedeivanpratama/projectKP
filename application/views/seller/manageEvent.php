<div class="content-wrapper">
    <section class="content container-fluid">
        <a class="btn btn-primary" href="<?= base_url();?>roomTypeLists/<?= $id_hotel; ?>">Back</a>        
        <a class="btn btn-primary" href="<?= base_url();?>addEvent/<?= $id_hotel; ?>">Add Event</a>
        <div class="box my-top">
            <div class="box-header">
              <h3 class="box-title">Event Lists :</h3>
            </div>
            <div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        
            <div class="box-body no-padding">
              <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <th>Id</th>
                            <th>Nama Event</th>
                            <th>Start Event</th>
                            <th>End Event</th>
                            <th>Discount</th>
                            <th>Room Type</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach($event as $key => $val): ?>
                            <tr>
                                <td><?= $val['id_event']?></td>    
                                <td><?= $val['nama_event'];?></td>
                                <td><?= $val['start_event'];?></td>
                                <td><?= $val['end_event'];?></td>
                                <td><?= $val['discount'];?></td>
                                <td><?= $val['nama_type'];?></td>
                                <td>
                                    <a class="btn btn-warning" href="<?= base_url(); ?>editEvent/<?= $val['id_event'] ?>/<?= $id_hotel ?>">Edit</a>
                                    <a class="btn btn-danger" href="<?= base_url(); ?>deleteEvent/<?= $val['id_event'] ?>/<?= $id_hotel ?>">Delete</a>
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
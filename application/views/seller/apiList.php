<div class="content-wrapper">

	<section class="content container-fluid">
        <a class="btn btn-primary" href="<?= base_url();?>API/List">Back</a>
        <a class="btn btn-primary" href="<?= base_url();?>API/create">Create API</a><br><br>
		<div class="box my-top">
			<div class="box-header">
				<h3 class="box-title"> API List :</h3>
			</div>
			<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        
			<div class="box-body no-padding">
				<table class="table table-condensed">
					<tbody>
                        <tr>
                            <th>Id Api</th>
                            <th>id Hotel</th>
                            <th>Hotel Name</th>
                            <th>Id Partner</th>
                            <th>Id Request</th>
                            <th>Nama API</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
						<?php foreach($api as $key => $val): ?>
                            <tr>
                                <td><?= $val['id_api']; ?></td>
                                <td><?= $val['id_hotel']; ?></td>
                                <td><?= $val['nama_hotel']; ?></td>
                                <td><?= $val['id_partner'];?></td>
                                <td><?= $val['id_request'];?></td>
                                <td><?= $val['nama_api'];?></td>
                                <td><?= ($val['status'] === '0')?'not Connected':'Connected';?></td>
                                <td>
                                    <?php if($val['status'] === '0' ): ?>
                                        <a href="<?= base_url() ?>API/List/connect/<?= $val['id_api'] ?>/<?= $val['id_hotel']?>"  class="btn btn-success" ><span class="fa fa-plus"> Connect</span></a>
                                    <?php endif;?>
                                    <a href="<?= base_url() ?>API/List/Detail/<?= $val['id_api'] ?>"  class="btn btn-primary" ><span class="fa fa-plus"> Request Detail</span></a>
                                    <a href="<?= base_url() ?>API/List/delete/<?= $val['id_api'] ?>"  class="btn btn-danger" ><span class="fa fa-times"> Delete</span></a>
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
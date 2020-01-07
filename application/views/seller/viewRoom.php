<div class="content-wrapper">
	<section class="content container-fluid">
		<a class="btn btn-primary" href="<?= base_url();?>roomTypeLists/<?= $id_hotel ?>"><span class="fa fa-chevron-left"> My Hotel</span></a>
		<a class="btn btn-primary" href="<?= base_url();?>addRoom/<?= $type['id_type'] ?>/<?= $id_hotel ?>"><span class="fa fa-plus"> Add Room</span></a>
		<div class="box my-top">
			<div class="box-header">
				<h3 class="box-title"><?= $type['nama_type']; ?> Room List :</h3>
			</div>
			<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        

			<div class="box-body no-padding">
				<table class="table table-condensed">
					<tbody>
						<tr>
							<th>Id</th>
							<th>room No</th>
							<th>Action</th>
						</tr>
						<?php foreach($room as $key => $val): ?>
						<tr>
							<td>
								<?= $val['id_kamar']; ?>
							</td>
							<td>
								<?= $val['no_kamar']; ?>
							</td>
							<td>
								<a href="<?= base_url(); ?>editRoom/<?php echo $val['id_kamar'] ?>/<?= $val['id_status']; ?>/<?= $type['id_type'] ?>"
								 class="btn btn-warning"><span class="fa fa-edit"> Edit</span></a>
								<a href="<?= base_url(); ?>deleteRoom/<?php echo $val['id_kamar'] ?>/<?= $type['id_type'];?>/<?= $id_hotel ?>" class="btn btn-danger"><span class="fa fa-times"> Delete</span></a>
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
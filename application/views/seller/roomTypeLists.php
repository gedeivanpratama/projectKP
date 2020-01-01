<div class="content-wrapper">
	<section class="content container-fluid">
		<a class="btn btn-primary" href="<?= base_url();?>hotelLists"><span class="fa fa-chevron-left"> My Hotel</span></a>	
		<a class="btn btn-primary" href="<?= base_url();?>addType/<?= $hotel['id_hotel'] ?>"><span class="fa fa-plus"> Add Room Type</span></a>
		<a class="btn btn-primary" href="<?= base_url();?>addRoomFacilityType/<?= $hotel['id_hotel'] ?>"><span class="fa fa-plus"> Add Room Type</span>
			Fasility</a>
		<a class="btn btn-primary" href="<?= base_url();?>manageRoomFacilityType/<?= $hotel['id_hotel'] ?>"><span class="fa fa-gear"> Manage Room </span>
			Facility Type</a>
		<a class="btn btn-primary" href="<?= base_url();?>manageEvents/<?= $hotel['id_hotel']; ?>"><span class="fa fa-gear"> Manage Event</span></a>
		<a class="btn btn-primary" href="<?= base_url();?>denah/<?= $hotel['id_hotel']; ?>"><span class="fa fa-gear"> denah</span></a>
		<div class="box my-top">
			<div class="box-header">
				<h3 class="box-title"><?= $hotel['nama_hotel']; ?> Hotel Room Type :</h3>
			</div>

			<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        

			<div class="box-body no-padding">
				<table class="table table-condensed">
					<tbody>
						<tr>
							<th>Id</th>
							<th>Image</th>
							<th>room Type</th>
							<th>Price</th>
							<th>Room Fasility</th>
							<th>Action</th>
						</tr>
						<?php foreach($roomtype as $key => $val): ?>
						<tr>
							<td>
								<?= $val['id_type']; ?>
							</td>
							<td>
								<img src="<?php echo base_url()?>uploads/roomImages/<?= $val['image_kamar']; ?>" alt="hotel image view" style="width: 100px; height: 70px;">
							</td>
							<td>
								<?= $val['nama_type']; ?>
							</td>
							<td>
								<?= $val['harga']; ?>
							</td>
							<td>
								<?php foreach($roomfacility as $key => $valr): ?>
								<?php if($valr['id_type'] === $val['id_type']): ?>
								<span class="badge bg-blue">
									<?= $valr['nama_fasilitas'];?> :
									<?= $valr['jumlah_fasilitas'] ?> Item</span><br>
								<?php endif;?>
								<?php endforeach;?>
							</td>
							<td>
								<a href="<?= base_url(); ?>viewRoom/<?php echo $val['id_type'] ?>/<?= $hotel['id_hotel'] ?>" class=" btn btn-success"><span class="fa fa-eye"> View Room</span></a>
								<a href="<?= base_url(); ?>editType/<?php echo $val['id_type'] ?>/<?= $hotel['id_hotel']; ?>" class="btn btn-warning"><span class="fa fa-edit"> Edit</span></a>
								<a href="<?= base_url(); ?>deleteType/<?php echo $val['id_type'] ?>/<?= $hotel['id_hotel']; ?>" class="btn btn-danger"><span class="fa fa-times"> Delete</span></a>
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
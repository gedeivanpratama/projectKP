<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>">
</div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content container-fluid">
    <div class="box">
			<div class="box-header">
				<h3 class="box-title">My Booking</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body no-padding">
				<table class="table table-condensed">
					<tbody>
						<tr>
							<th style="width: 10px">Id</th>
							<th>Hotel</th>
							<th>Telp</th>
							<th>Email</th>
							<th>Room Type</th>
							<th>Room Number</th>
							<th>Price</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						<?php if (!empty($reservation)) : ?>
						<?php foreach ($reservation as $key => $value) : ?>
						<tr>
							<td>
								<?= $value['id_reservasi']; ?>
							</td>
							<td>
								<?= $value['nama_hotel']; ?>
							</td>
							<td>
								<?= $value['telp_hotel']; ?>
							</td>
							<td>
								<?= $value['email_hotel']; ?>
							</td>
							<td>
								<?= $value['nama_type']; ?>
							</td>
							<td>
								<?= $value['no_kamar']; ?>
							</td>
							<td>
								Rp. <?= number_format($value['total_price']); ?>
							</td>
							<td>
								<?= $value['nama_status']; ?>
							</td>
							<td>
								<a class="btn btn-primary" href="<?= base_url(); ?>myReservDetail/<?= $value['id_reservasi'] ?>/<?= $value['id_hotel'] ?>/<?= $value['id_type'] ?>/<?= $value['id_kamar'] ?>"><span class="fa fa-eye"> Detail</span></a>
								<a class="btn btn-danger" href="<?= base_url(); ?>deleteMyReserv/<?= $value['id_reservasi'] ?>"><span class="fa fa-times"> Delete</span></a>
							</td>
						</tr>
						<?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="9" class="text-center">No reservation Found !</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
		</div>
    </section>
</div>
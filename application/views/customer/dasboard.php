<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content container-fluid">
	<div class="alert alert-warning" role="alert">data booking akan dihapus dalam waktu 1 jam jika belum di konfirmasi !</div>
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">My Booking</h3>
			</div>
			<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>">
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
								<?php if($value['id_status_reservasi'] == 1): ?>
									<a class="btn btn-success" href="<?= base_url(); ?>myConfirmation/<?= $value['id_reservasi'] ?>/<?= $value['id_hotel'] ?>">Confirm</a>
								<?php endif; ?>
								<?php if($value['id_status_reservasi'] == 3): ?>
									<a class="btn btn-success" href="<?= base_url(); ?>getPDF/<?= $value['id_reservasi'] ?>/<?= $value['id_hotel'] ?>"><span class="fa fa-download"> Get PDF</span></a>
								<?php endif; ?>
								<a class="btn btn-primary" href="<?= base_url(); ?>myReservDetail/<?= $value['id_reservasi'] ?>/<?= $value['id_hotel'] ?>/<?= $value['id_type'] ?>/<?= $value['id_kamar'] ?>"><span class="fa fa-eye"> Detail</span></a>
								<?php if($value['id_status_reservasi'] != 4): ?>
								<a class="btn btn-danger" href="<?= base_url(); ?>cancelMyReserv/<?= $value['data_api'] ?>/<?= $value['id_reservasi'] ?>"><span class="fa fa-minus-square"> Cancel</span></a>
								<?php endif; ?>
								<?php if($value['id_status_reservasi'] == 4): ?>
								<a class="btn btn-danger" href="<?= base_url(); ?>deleteMyReserv/<?= $value['id_reservasi'] ?>"><span class="fa fa-times"> Delete</span></a>
								<?php endif; ?>
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
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->



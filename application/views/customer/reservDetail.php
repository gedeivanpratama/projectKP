<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>">
</div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content container-fluid">
		<div class="container">
			<h1 class="text-center">Verify Information Reservation</h1>
			<div class="table-container">
				<?php if($reservation['id_status_reservasi'] == 3): ?>
					<h1 class="my-center">Status : <label class="label label-success">Aproved</label></h1>
				<?php else: ?>
					<h1 class="my-center">Status : <label class="label label-danger">Not Verify</label></h1>
				<?php endif; ?>
				<hr>
				<div class="event-info">
					<h3>Event or Discount</h3>

					<table class="table">
						<?php $discount = 0; ?>
						<?php if(empty($event)): ?>
						<tr>
							<td>Event Not Available</td>
						</tr>
						<?php else: ?>
						<?php foreach($event as $key => $val): ?>
						<?php if($reservation['id_event'] === $val['id_event']): ?>
						<?php $discount += $val['discount'] ?>
						<tr>
							<td>Event Name</td>
							<td>Discount</td>
						</tr>
						<tr>
							<td>
								<?= $val['nama_event']; ?>
							</td>
							<td>
								<?= $val['discount']; ?>%
							</td>
						</tr>
						<?php endif;?>
						<?php  endforeach; ?>
						<?php endif;?>
					</table>
				</div>
				<div class="hotel-info">
					<h3>Hotel Information :</h3>
					<table class="table">
						<tr>
							<th>Name :</th>
							<td>
								<?= $hotel['nama_hotel']; ?>
							</td>
						</tr>
						<tr>
							<th>Address :</th>
							<td>
								<?= $hotel['alamat_hotel']; ?>
							</td>
						</tr>
						<tr>
							<th>Email :</th>
							<td>
								<?= $hotel['email_hotel']; ?>
							</td>
						</tr>
						<tr>
							<th>Telp :</th>
							<td>
								<?= $hotel['telp_hotel']; ?>
							</td>
						</tr>
						<tr>
							<th>Facility :</th>
							<td>
								<?php foreach ($hotelFacility as $key => $val) : ?>
								<span class="label label-success">
									<?= $val['nama_fasilitas'] ?> :
									<?= $val['jumlah_fasilitas'] ?></span>
								<?php endforeach; ?>
							</td>
						</tr>
					</table>
				</div>
				<div class="reservation-info">
					<table class="table">
						<h3>Reservation Information :</h3>
						<tr>
							<th>Room Type</th>
							<th>Room No</th>
							<th>Check In</th>
							<th>Check Out</th>
							<th>Price / Day</th>
							<th>After Discount</th>
						</tr>
						<tr>
							<td>
								<?= $type['nama_type'] ?>
							</td>
							<td>
								<?= $room['no_kamar'] ?>
							</td>
							<td>
								<?= $reservation['check_in'] ?>
							</td>
							<td>
								<?= $reservation['check_out'] ?>
							</td>
							<td>
								<?= number_format($type['harga']) ?>
							</td>
							<td>
								<?php if($discount !== 0): 
									$disc = ($type['harga']	* $discount) / 100;
									$totalP = $type['harga'] - $disc; ?>
								Rp.
								<?= number_format($totalP); ?>

								<?php endif; ?>
							</td>
						</tr>
					</table>
				</div>

				<div class="reservation-info">
					<table class="table">
						<h3>Payment Available :</h3>
						<tr>
							<th>No</th>
							<th>Name </th>
							<th>Bank Name</th>
							<th>Rekenging Number</th>
						</tr>
							
							<?php 
							$x = 1;
							foreach($payment as $key => $val):?>
							<tr>
								<td><?= $x; ?></td>	
								<td><?= $val['payment_owner']; ?></td>	
								<td><?= $val['bank_name']; ?></td>	
								<td><?= $val['no_rek']; ?></td>									
							</tr>
							<?php 
							$x++;
							endforeach; ?>
					</table>
				</div>

				<div class="total-price">
					<h3>Total Price :</h3>
					<table class="table">
						<tr>
							<th>Total Price</th>
						</tr>
						<tr>
							<th class="total-price">
								<span class="label label-primary">
									Rp.
									<?= number_format($reservation['total_price']) ?>
								</span>
							</th>
						</tr>
					</table>
				</div>
				<a class="btn btn-primary" href="<?= base_url(); ?>myReservation">Go Back</a>
			</div>
		</div>
	</section>
</div>
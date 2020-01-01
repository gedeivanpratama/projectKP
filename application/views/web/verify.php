<div class="container">
	<div class="row justify-content-center shadow mt-5 py-3">
		<div class="col-10">
		<h1 class="text-center mt-5" style="font-family: 'Playfair Display', serif;">Verify Information Reservation</h1>
		<hr>
		<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>">
		<?php
			$now = date('Y-m-d');
			$range = [];
			foreach($dateRange as $ranges){
				$range[] = $ranges->format('Y-m-d');
			} 
		?>

		<!-- outputing even & discount data from database -->
		<div class="mt-5">
			<h3 style="font-family: 'Playfair Display', serif;">Event or Discount</h3>
			<?php $count = 0;
				foreach($event as $key => $val){
					if($val['id_type'] == $type['id_type'] ){
					$count++;
					}
				} ?>
			<table class="table">
				<?php  $discount = 0; ?>
				<?php  $id_event = ''; ?>
				<?php if($count <= 0): ?>
				<thead class="thead-dark">
					<tr>
						<th scope="col">Event Name</th>
						<th scope="col">Discount</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="2" class="text-center text-warning">Event Not Available</td>
					</tr>
				</tbody>
				<?php elseif($count > 0): ?>
				<?php if(in_array($now,$range)):
				foreach($event as $key => $val): 
				if($val['id_type'] == $type['id_type'] ):
				$discount += $val['discount'];
				$id_event = $val['id_event']; ?>
				<tr>
					<th>
						<?= $val['nama_event'] ?>
					</th>
					<th>
						<?= $val['discount'] ?> %
					</th>
				</tr>

				<?php endif;
				endforeach; ?>
				<?php endif; ?>
				<?php endif; ?>
			</table>
		</div>
		<!-- end event dan discount -->
		
		<!-- data hotel information -->
		<div class="mt-5">
			<h3 style="font-family: 'Playfair Display', serif;">Hotel Information :</h3>
			<table class="table table-striped">
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
						<?php foreach($hotelFacility as $key => $val): ?>
						<span class="bg-success text-light p-1 rounded">
							<?= $val['nama_fasilitas'] ?> :
							<?= $val['jumlah_fasilitas'] ?></span>
						<?php endforeach; ?>
					</td>
				</tr>
			</table>
		</div>
		<!-- end data hotel information -->
		
		<!-- data reservation -->
		<div class="mt-5">
			<table class="table">
				<h3 class="mb-3" style="font-family: 'Playfair Display', serif;">Reservation Information :</h3>
				<thead class="thead-dark">
					<tr>
						<th>Room Type</th>
						<th>Room No</th>
						<th>Check In</th>
						<th>Check Out</th>
						<th>Price / Day</th>
						<th>After Discount</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<?= $type['nama_type'] ?>
						</td>
						<td>
							<?= $room['no_kamar']?>
						</td>
						<td>
							<?= $check_in; ?>
						</td>
						<td>
							<?= $check_out; ?>
						</td>
						<td>
							<?= number_format($type['harga']) ?>
						</td>
						<td>Rp.
							<?php
							$priceperday = 0;
							if($discount === 0){
								$priceperday = number_format($type['harga']);
								$price = $type['harga'];
								echo $priceperday;
							}else{
								$dis = $discount * $type['harga'] / 100;
								$price = $type['harga'] - $dis;
								$priceperday = number_format($price);
								echo $priceperday;
							}
							
						?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- end data reservation -->

		<div class="mt-5">
			<h3 class="mb-3" style="font-family: 'Playfair Display', serif;">Total Price :</h3>
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th class="night">Total Night</th>
						<th>Total Price</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th class="night">
						<?= $totalDay ?> Day</th>
						<?php $priceTotal = $price * $totalDay; ?>
						<th class="total-price"><span class="label label-primary">
						<?= number_format($priceTotal); ?></span></th>
					</tr>
				</tbody>
				
			</table>
		</div>
		<?php $attr = array('class'=>'form-verify'); ?>
		<?php echo form_open('',$attr); ?>
		<input type="hidden" name="check_in" value="<?= $check_in?>">
		<input type="hidden" name="check_out" value="<?= $check_out?>">
		<input type="hidden" name="total_price" value="<?= $priceTotal?>">
		<input type="hidden" name="id_hotel" value="<?= $hotel['id_hotel']?>">
		<input type="hidden" name="id_type" value="<?= $type['id_type']?>">
		<input type="hidden" name="id_kamar" value="<?= $_GET['room'] ?>">
		<input type="hidden" name="id_event" value="<?= $id_event?>">


		<?php if(empty($this->session->userdata('nama_customer'))):?>
		<label class="label label-warning my-verify-label">Need <a href="<?= base_url() ?>loginCustomer/<?= $hotel['id_hotel'] ?>/<?= $type['id_type']; ?>/<?= $_GET['room'] ?>">login</a>
			to Booking</label>
		<button type="submit" class="btn btn-success my-center" disabled>Continue To Payment</button>
		<?php else: ?>
		<button type="submit" class="btn btn-success my-center">Continue To Payment</button>
		<?php endif; ?>
		<?php echo form_close(); ?>
	</div>
		</div>
	</div>
	
</div>
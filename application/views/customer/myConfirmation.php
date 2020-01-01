<div class="content-wrapper">
	<section class="content container-fluid">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Confirm Payment</h3>
			</div>
			<?php echo form_open(); ?>
			<div class="box-body">
			<div class="from-confirmation">
			<label class="my-center">Bank Payment Information</label>
				<div class="form-group">
					<label>bank info</label>
					<span style="color:red;">
						<?= form_error('id_payment'); ?></span>
					<select name="id_payment" class="form-control">
						<option value="">Choose Payment :</option>
						<?php foreach($payment as $key => $value) : ?>
						<option value="<?= $value['id_payment'] ?>">
							<?= $value['payment_owner'] ?> |
							<?= $value['bank_name'] ?> |
							<?= $value['no_rek']  ?>
						</option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
				<div class="from-confirmation">
				<label class="my-center">My Payment information</label>
				<div class="form-group">
					<label for="exampleInputEmail1">Sender Name</label>
					<span style="color:red;">
						<?= form_error('sender_name'); ?></span>
					<input type="text" name="sender_name" class="form-control" id="exampleInputEmail1" placeholder="Sender Name :">
				</div>

				<div class="form-group">
					<label for="exampleInputPassword1">Bank Sender</label>
					<span style="color:red;">
						<?= form_error('bank_sender'); ?></span>
					<input type="text" name="bank_sender" class="form-control" id="exampleInputPassword1" placeholder="Bank Sender">
				</div>

				<div class="form-group">
					<label for="exampleInputPassword1">No Rek</label>
					<span style="color:red;">
						<?= form_error('no_rek_sender'); ?></span>
					<input type="number" name="no_rek_sender" class="form-control" id="exampleInputPassword1" placeholder="No Rek Sender">
				</div>

				<div class="form-group">
					<label for="exampleInputPassword1">Total Transfer</label>
					<span style="color:red;">
						<?= form_error('total_transfer'); ?></span>
					<input type="number" name="total_transfer" class="form-control" id="exampleInputPassword1" placeholder="Total Transfer">
				</div>
				
				<div class="form-group">
					<label for="exampleInputPassword1">Transfer Time</label>
					<span style="color:red;">
						<?= form_error('transfer_time'); ?></span>
					<input type="date" name="transfer_time" class="form-control" id="exampleInputPassword1" placeholder="Total Transfer">
				</div>

			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</section>
</div>
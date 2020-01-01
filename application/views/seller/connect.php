<div class="content-wrapper">
	<section class="content container-fluid">
		<a href="<?= base_url() ?>API/List" class="btn btn-primary">Back</a><br><br>
		<div class="box box-primary my-form-ad">
			<div class="box-header with-border">
				<h3 class="box-title">Register my site </h3>
			</div>
			<?php echo form_open(); ?>
			<div class="box-body">
				<div class="form-group">
					<label for="inputAddress">Api Name :</label>
					<span style="color:red;">
						<?= form_error('api_name'); ?>
                    </span>
					<input type="text" class="form-control" name="api_name" placeholder="Api Name:">
				</div>
					<input type="hidden" class="form-control" name="id_partner" value="<?=  bin2hex(openssl_random_pseudo_bytes(5)) ?>">
					<input type="hidden" class="form-control" name="id_request" value="<?=  bin2hex(openssl_random_pseudo_bytes(5)) ?>">
				<div class="form-group">
					<label>choose Hotel</label>
					<span style="color:red;">
						<?= form_error('hotel_id'); ?>
                    </span>
					<select name ="hotel_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
					<option selected="selected" value="">Choose Hotel</option>
					<?php foreach($hotel as $key => $value): ?>
						<option value="<?= $value['id_hotel'] ?>"><?= $value['nama_hotel'] ?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Create API</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</section>
</div>
<div class="content-wrapper">
	<section class="content container-fluid">
		<div class="box box-primary my-form-ad">
			<div class="box-header with-border">
				<h3 class="box-title">Add Event</h3>
			</div>

			<?php echo form_open_multipart(); ?>
			<div class="box-body">
				<div class="form-group">
					<label for="inputAddress">Nama Event :</label>
					<span style="color:red;">
						<?= form_error('nama_event'); ?></span>
					<input type="text" class="form-control" name="nama_event" placeholder="Event Name:">
				</div>

				<div class="form-group">
					<label for="inputAddress">Start Event :</label>
					<span style="color:red;">
						<?= form_error('start_event'); ?></span>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="date" name="start_event" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
					</div>
					<br>
					<div class="form-group">
						<label for="inputAddress">Stop Event :</label>
						<span style="color:red;">
							<?= form_error('stop_event'); ?></span>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="date" name="stop_event" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
						</div>

						<div class="form-group">
							<label for="inputAddress">Discount :</label>
							<span style="color:red;">
								<?= form_error('discount'); ?></span>
							<input type="number" class="form-control" name="discount" placeholder="Discount :">
						</div>

					</div>

					<div class="form-group">
						<label>Room Type :</label>
						<span style="color:red;">
							<?= form_error('id_type'); ?></span>
						<select name="id_type" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
						 aria-hidden="true">
							<option value="" selected="selected">Choose :</option>
							<?php foreach($type as $key => $val): ?>
							<option value="<?= $val['id_type'] ?>">
								<?= $val['nama_type'] ?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Add Hotel</button>

				</div>
				<?php echo form_close(); ?>
			</div>
	</section>
</div>
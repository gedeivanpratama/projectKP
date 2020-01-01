<div class="content-wrapper">
	<section class="content container-fluid">
		<div class="box box-primary my-form-ad">
			<div class="box-header with-border">
				<h3 class="box-title">Add Hotel</h3>
			</div>

			<?php echo form_open_multipart(); ?>
			<div class="box-body">
				<div class="form-group">
					<label for="inputAddress">Nama Hotel :</label>
					<span style="color:red;">
						<?= form_error('nama_hotel'); ?>
                    </span>
					<input type="text" class="form-control" name="nama_hotel" placeholder="Hotel Name:">
				</div>
				<div class="form-group">
					<label for="inputAddress">Alamat</label>
					<span style="color:red;">
						<?= form_error('alamat_hotel'); ?>
                    </span>
					<input type="text" class="form-control" name="alamat_hotel" placeholder="Alamat Hotel">
				</div>
				<div class="form-group">
					<label for="inputAddress">Url</label>
					<input type="text" class="form-control" name="url" placeholder="Url">
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputEmail4">Email</label>
						<span style="color:red;">
							<?= form_error('email_hotel'); ?>
                        </span>
						<input type="email" class="form-control" name="email_hotel" placeholder="Email">
					</div>
					<div class="form-group col-md-6">
						<label for="inputPassword4">Telp</label>
						<span style="color:red;">
							<?= form_error('telp_hotel'); ?>
                        </span>
						<input type="number" class="form-control" name="telp_hotel" placeholder="Telp">
					</div>
				</div>
				<div class="form-group">
					<label for="exampleInputFile">Upload Hotel Image</label>

					<span style="color:red;">
					<?php
                    if(isset($error)){
                        print_r($error);
                    } ?>
					</span>
					<input type="file" name="image_hotel">
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Add Hotel</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</section>
</div>
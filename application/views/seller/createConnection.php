<div class="content-wrapper">
	<section class="content container-fluid">
		<a href="<?= base_url() ?>API/List" class="btn btn-primary">Back</a><br><br>
		<div class="box box-primary my-form-ad">
			<div class="box-header with-border">
                <h3 class="box-title">Hotel Information : </h3>
                <p>Hotel Name : <?= $hotel['nama_hotel'] ?></p>
            </div>
            
			<?php echo form_open(); ?>
			<div class="box-body">
				<div class="form-group">
					<label for="inputAddress">Url/endpoint :</label>
					<span style="color:red;">
						<?= form_error('url'); ?>
                    </span>
					<input type="text" class="form-control" name="url" placeholder="website url">
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Connect</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</section>
</div>
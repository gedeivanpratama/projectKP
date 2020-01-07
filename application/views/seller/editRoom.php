<div class="content-wrapper">
    <section class="content container-fluid">
    <div class="box box-primary my-form-ad">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Room</h3>
        </div>
        <?php $id = $this->uri->segment(3); ?>
        <?php echo form_open_multipart(); ?>
          <div class="box-body">
                <div class="form-group">
                    <label for="inputAddress">Room No :</label>
                    <span style="color:red;"><?= form_error('room_number'); ?></span>
                    <input type="text" class="form-control" name="room_number" value="<?= $room['no_kamar'] ?>" placeholder="Room Number :">
                </div>
          </div>
        <div class="box-footer">
        <button type="submit" class="btn btn-primary">Edit Room</button>

        </div>
        <?php echo form_close(); ?>
    </div>
    </section>
</div>
<div class="content-wrapper">
    <section class="content container-fluid">
    <div class="box box-primary my-form-ad">
        <div class="box-header with-border">
            <h3 class="box-title">Add Room</h3>
        </div>

        <?php echo form_open_multipart(); ?>
          <div class="box-body">
                <div class="form-group">
                    <label for="inputAddress">Room No :</label>
                    <span style="color:red;"><?= form_error('room_number'); ?></span>
                    <input type="text" class="form-control" name="room_number" placeholder="Room Number :">
                </div>
          </div>
        <div class="box-footer">
        <button type="submit" class="btn btn-primary">Add Room</button>

        </div>
        <?php echo form_close(); ?>
    </div>
    </section>
</div>
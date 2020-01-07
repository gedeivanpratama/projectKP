<div class="content-wrapper">
    <section class="content container-fluid">
    <div class="box box-primary my-form-ad">
        <div class="box-header with-border">
            <h3 class="box-title">Add Profile</h3>
        </div>
        <?php echo form_open_multipart(); ?>
            <div class="box-body">
                <div class="form-group">
                    <label for="inputAddress">Name :</label>
                    <span style="color:red;"><?= form_error('name'); ?></span>
                    <input type="text" class="form-control" name="name" placeholder="Name :">
                </div>
                
                <label for="inputAddress">Image :</label>
                <input type="file" name="image" placeholder="Image :">

                <div class="form-group">
                    <label for="inputAddress">Address :</label>
                    <span style="color:red;"><?= form_error('address'); ?></span>
                    <input type="text" class="form-control" name="address">
                </div>
                <div class="form-group">
                    <label for="inputAddress">Telp :</label>
                    <span style="color:red;"><?= form_error('telp'); ?></span>
                    <input type="text" class="form-control" name="telp">
                </div>
            
          </div>
        <div class="box-footer">
        <button type="submit" class="btn btn-primary">Add Profile</button>

        </div>
        <?php echo form_close(); ?>
    </div>
    </section>
</div>
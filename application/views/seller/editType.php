<div class="content-wrapper">
    <section class="content container-fluid">
        <div class="box box-primary my-form-ad">
            <div class="box-header with-border">
                <h3 class="box-title">Update Room Type</h3>
            </div>
        <?php echo form_open_multipart(); ?>
        <div class="box-body">
            <div class="form-group">
                <label for="inputAddress">Nama Type :</label>
                <span style="color:red;"><?= form_error('nama_type'); ?></span>
                <input type="text" class="form-control" name="nama_type" value="<?= $type['nama_type']?>" placeholder="Type Name :">
            </div>
            <div class="form-group">
                <label for="inputAddress">Alamat</label>
                <span style="color:red;"><?= form_error('price'); ?></span>
                <input type="text" class="form-control" name="price" value="<?= $type['harga']?>" placeholder="Price :">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Upload Hotel Image</label>
                <span style="color:red;">
                   <?php
                    if(isset($error)){
                        echo $error;
                    }
                   ?>
                   </span>
                  <input type="file" name="image_type">
                </div>
        </div>
            <div class="box-footer">
            <button type="submit" class="btn btn-primary">Edit Hotel</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </section>
</div>
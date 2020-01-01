<div class="content-wrapper">
    <section class="content container-fluid">
    <div class="box box-primary my-form-ad">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Hotel Facility</h3>
        </div>
        <?php echo form_open_multipart(); ?>
          <div class="box-body">
                <div class="form-group">
                    <label for="inputAddress">Nama Fasilitas Hotel :</label>
                    <span style="color:red;"><?= form_error('nama_fasilitas'); ?></span>
                    <input type="text" class="form-control" value="<?= $facility['nama_fasilitas'] ?>" name="nama_fasilitas" placeholder="Name Fasilitas:">
                </div>
                <div class="form-group">
                    <label for="inputAddress">Jumlah Fasilitas Hotel :</label>
                    <span style="color:red;"><?= form_error('jumlah_fasilitas'); ?></span>
                    <input type="text" class="form-control" value="<?= $facility['jumlah_fasilitas'] ?>" name="jumlah_fasilitas" placeholder="Jumlah Fasilitas:">
                </div>
                <div class="form-group">
                    <label>Hotel :</label>
                    <span style="color:red;"><?= form_error('id_hotel'); ?></span>
                    <select name ="id_hotel" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="" selected="selected">Choose :</option>
                        <?php foreach($hotel as $key => $val): ?>
                        <option value="<?= $val['id_hotel'] ?>" <?= ($facility['id_hotel'] === $val['id_hotel'])? 'selected':''; ?>><?= $val['nama_hotel'] ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
          </div>
        <div class="box-footer">
        <button type="submit" class="btn btn-primary">Add Fasilitas Hotel</button>

        </div>
        <?php echo form_close(); ?>
    </div>
    </section>
</div>
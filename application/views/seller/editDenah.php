<div class="content-wrapper">
    <section class="content container-fluid">
    <div class="box box-primary my-form-ad">
        <div class="box-header with-border">
            <h3 class="box-title">edit Denah</h3>
        </div>

        <?php echo form_open_multipart(); ?>
            <div class="box-body">
                <div class="form-group">
                    <label>Tipe Kamar :</label>
                    <span style="color:red;"><?= form_error('id_type'); ?></span>
                    <select name ="id_type" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="" selected="selected">Choose :</option>
                        <?php foreach($type as $key => $val): ?>
                        <option value="<?= $val['id_type'] ?>" <?= ($val['id_type'] == $room['id_type'])? 'selected':''; ?>><?= $val['nama_type'] ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Denah :</label>
                    <span style="color:red;"><?= form_error('denah'); ?></span>
                    <input type="file" class="form-control" name="denah">
                </div>
                <div class="form-group">
                    <label for="inputAddress">Description :</label>
                    <span style="color:red;"><?= form_error('description'); ?></span>
                    <textarea class="form-control" name="description" cols="20" rows="5"><?= $room['description'] ?></textarea>
                </div>
            </div>
        <div class="box-footer">
        <button type="submit" class="btn btn-primary">update Denah</button>

        </div>
        <?php echo form_close(); ?>
    </div>
    </section>
</div>
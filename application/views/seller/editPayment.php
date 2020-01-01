<div class="content-wrapper">
    <section class="content container-fluid">
    <div class="box box-primary my-form-ad">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Hotel Payment</h3>
        </div>
        <?php echo form_open_multipart(); ?>
          <div class="box-body">
                <div class="form-group">
                    <label for="inputAddress">Owner Name :</label>
                    <span style="color:red;"><?= form_error('payment_owner'); ?></span>
                    <input type="text" class="form-control" name="payment_owner" value ="<?= $payment['payment_owner'] ?>" placeholder="Owner Name :">
                </div>
                <div class="form-group">
                    <label for="inputAddress">Bank Name :</label>
                    <span style="color:red;"><?= form_error('bank_name'); ?></span>
                    <input type="text" class="form-control" name="bank_name" value ="<?= $payment['bank_name'] ?>" placeholder="Bank Name :">
                </div>
                <div class="form-group">
                    <label for="inputAddress">No Rek :</label>
                    <span style="color:red;"><?= form_error('no_rek'); ?></span>
                    <input type="text" class="form-control" name="no_rek" value ="<?= $payment['no_rek'] ?>" placeholder="Rekening Number :">
                </div>
                <div class="form-group">
                    <label>Hotel :</label>
                    <span style="color:red;"><?= form_error('id_hotel'); ?></span>
                    <select name ="id_hotel" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="" selected="selected">Choose :</option>
                        <?php foreach($hotel as $key => $val): ?>
                        <option value="<?= $val['id_hotel'] ?>" <?= ($val['id_hotel'] == $payment['id_hotel'])? 'selected':''; ?>><?= $val['nama_hotel'] ?></option>
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
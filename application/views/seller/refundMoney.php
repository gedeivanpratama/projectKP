<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        
<div class="content-wrapper">
	<section class="content container-fluid">
    <div class="box box-primary my-box">
        <div class="box-header with-border">
            <h3 class="box-title">Refund Confirm</h3>
        </div>
        <?php echo form_open_multipart(); ?>
          <div class="box-body">
                <div class="form-group">
                    <label for="inputAddress">Title :</label>
                    <span style="color:red;"><?= form_error('room_number'); ?></span>
                    <input type="text" class="form-control" name="room_number" placeholder="Subject :">
                </div>

                <div class="form-group">
                  <label>Textarea</label>
                  <textarea class="form-control" rows="3" placeholder="Description..."></textarea>
                </div>
            
          </div>
        <div class="box-footer">
        <button type="submit" class="btn btn-primary">Send</button>

        </div>
        <?php echo form_close(); ?>
    </div>
    
    </section>
</div>
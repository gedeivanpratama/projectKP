  <div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        
  <div class="content-wrapper">
    <section class="content container-fluid">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $hotel ?> <sup style="font-size:1rem">Hotels</sup></h3>
                <p>My Hotel Details</p>
            </div>
            <div class="icon">
                <i class="fa fa-bank"></i>
            </div>
                <a href="<?= base_url();?>hotelLists" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $reservation ?><sup style="font-size: 20px"> Reservation</sup></h3>
              <p>Reservation status</p>
            </div>
            <div class="icon">
              <i class="fa fa-phone"></i>
            </div>
            <a href="<?= base_url();?>reservation" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

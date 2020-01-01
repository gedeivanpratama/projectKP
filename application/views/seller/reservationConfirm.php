<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        
<div class="content-wrapper">
	<section class="content container-fluid">
		<div class="box my-top">
			<div class="box-header">
				<h3 class="box-title">Reservation Request :</h3>
			</div>
			<div class="box-body no-padding">
				<table class="table table-condensed">
					<tbody>
						<tr>
							<th>Id</th>
							<th>Check In</th>
							<th>Check Out</th>
                            <th>Hotel</th>
                            <th>Room Type</th>
                            <th>Room No</th>
							<th>Customer Name</th>
							<th>Action</th>
						</tr>
                        <?php foreach($reservation as $key => $value) : ?>
						<tr>
                        	<th><?= $value['id_reservasi'] ?></th>
							<td><?= $value['check_in'] ?></td>
							<td><?= $value['check_out'] ?></td>
                            <td><?= $value['nama_hotel'] ?></td>
                            <td><?= $value['nama_type'] ?></td>
                            <td><?= $value['no_kamar'] ?></td>
							<td><?= $value['nama_customer'] ?></td>
							<th>
                                <a class="btn btn-primary" href="<?= base_url() ?>verifyPayment/<?= $value['id_reservasi'] ?>/<?= $value['id_confirm'] ?>">Verify Payment</a>
                            </th>
						</tr>
                        <?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
		</div>

	</section>
</div>
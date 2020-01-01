<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        
<div class="content-wrapper">
	<section class="content container-fluid">
        <a href="<?= base_url() ?>check/reservation/<?= $hotel['id_hotel']; ?>" class="btn btn-primary">reservation</a>
		<a href="<?= base_url() ?>check/reservation/api/<?= $hotel['id_hotel'] ?>" class="btn btn-primary">reservation from API</a>
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
                            <th>customer Name</th>
                            <th>Telp Customer</th>
                            <th>Room Type</th>
                            <th>Room Name</th>
                            <th>total Price</th>
						</tr>
                        <?php foreach($reservation as $key => $value) : ?>
						<tr>
                        	<th><?= $value['id_reservasi'] ?></th>
							<td><?= $value['check_in'] ?></td>
							<td><?= $value['check_out'] ?></td>
                            <td><?= $value['nama_user'] ?></td>
                            <td><?= $value['telp_user'] ?></td>
                            <td><?= $value['room_type_name'] ?></td>
                            <td><?= $value['room_name'] ?></td>
                            <td><?= $value['total_price'] ?></td>
						</tr>
                        <?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
		</div>

	</section>
</div>
<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        
<div class="content-wrapper">
	<section class="content container-fluid">

		<div class="box my-box">
			<div class="box-header">
				<h3 class="my-center">Request Reservation Details</h3>
			</div>
			<div class="box-body no-padding">
				<table class="table table-condensed request">
					<tbody>
						<tr>
                            <th>Id :</th>
							<td><?= $reservation['id_reservasi']; ?></td>
						</tr>
                        <tr>
                            <th>Check In :</th>
                            <td><?= $reservation['check_in']; ?></td>
                        </tr>
                        <tr>
                            <th>Check Out :</th>
                            <td><?= $reservation['check_out']; ?></td>
                        </tr>
                        <tr>
                            <th>Hotel :</th>
                            <td><?= $reservation['nama_hotel']; ?></td>
                        </tr>
                        <tr>
                            <th>Room Type :</th>
                            <td><?= $reservation['nama_type']; ?></td>
                        </tr>
                        <tr>
                            <th>Room No :</th>
                            <td><?= $reservation['no_kamar'] ?></td>
                        </tr>
					</tbody>
				</table>
			</div>
		</div>

        <div class="box my-box">
			<div class="box-header">
			</div>
			<div class="box-body no-padding">
				<table class="table table-condensed request">
					<tbody>
						<tr>
                            <th>Id Customer :</th>
							<td><?= $reservation['id_customer'] ?></td>
						</tr>
                        <tr>
                            <th>Customer Name :</th>
                            <td><?= $reservation['nama_customer'] ?></td>
                        </tr>
                        <tr>
                            <th>Telp</th>
                            <td><?= $reservation['telp_customer'] ?></td>
                        </tr>
                        <tr>
                            <th>Email :</th>
                            <td><?= $reservation['email_customer'] ?></td>
                        </tr>
                        <tr>
                            <th>Address :</th>
                            <td><?= $reservation['alamat_customer'] ?></td>
                        </tr>
					</tbody>
				</table>
			</div>
        </div>
        <div class="box my-box">
			<div class="box-header">
                <h3 class="my-center">Payment info</h3>
			</div>
			<div class="box-body no-padding">
				<table class="table table-condensed request">
                    <?php if(!is_null($confirm)): ?>
					<tbody>
                        <tr>
                            <th>Customer Name :</th>
                            <td><?= $confirm['sender_name'] ?></td>
                        </tr>
                        <tr>
                            <th>Bank Name</th>
                            <td><?= $confirm['bank_sender'] ?></td>
                        </tr>
                        <tr>
                            <th>Debit Number :</th>
                            <td><?= $confirm['no_rek_sender'] ?></td>
                        </tr>
                        <tr>
                            <th>Transfer time :</th>
                            <td><?= $confirm['transfer_time'] ?></td>
                        </tr>
                    </tbody>
                    <?php else: ?>
                    <tbody>
                        <tr></tr>
                        <td>not confirm</td>
                    </tbody>
                    <?php endif; ?>
				</table>
			</div>
		</div>
        <a class="btn btn-primary " href="<?= base_url() ?>check/reservation/<?= $reservation['id_hotel']?>">Back</a>
	</section>
</div>
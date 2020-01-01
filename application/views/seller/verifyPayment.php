<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        
<div class="content-wrapper">
	<section class="content container-fluid">

		<div class="box my-box">
			<div class="box-header">
				<h3 class="my-center">Reservation Info</h3>
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
                            <th>Alamat Hotel :</th>
                            <td><?= $reservation['alamat_hotel']; ?></td>
                        </tr>
                        <tr>
                            <th>Room Type :</th>
                            <td><?= $reservation['nama_type']; ?></td>
                        </tr>
                        <tr>
                            <th>Room No :</th>
                            <td><?= $reservation['no_kamar'] ?></td>
                        </tr>
                        <tr>
                            <th>Total Price :</th>
                            <td><?= $reservation['total_price'] ?></td>
                        </tr>
                        <tr>
                            <th>Nama Customer :</th>
                            <td><?= $reservation['nama_customer'] ?></td>
                        </tr>
                        <tr>
                            <th>Telp Customer :</th>
                            <td><?= $reservation['telp_customer'] ?></td>
                        </tr>
                        <tr>
                            <th>Email Customer :</th>
                            <td><?= $reservation['email_customer'] ?></td>
                        </tr>
					</tbody>
				</table>
			</div>
		</div>

        <div class="box my-box">
			<div class="box-header">
				<h3 class="my-center">Payment Info</h3>
			</div>
			<div class="box-body no-padding">
				<table class="table table-condensed request">
					<tbody>
						<tr>
                            <th>Id Confirm :</th>
							<td><?= $payment['id_confirm'] ?></td>
						</tr>
                        <tr>
                            <th>Nama Rekening Pengirim :</th>
                            <td><?= $payment['sender_name'] ?></td>
                        </tr>
                        <tr>
                            <th>Bank Pengirim</th>
                            <td><?= $payment['bank_sender'] ?></td>
                        </tr>
                        <tr>
                            <th>No Rekening Pengirim</th>
                            <td><?= $payment['no_rek_sender'] ?></td>
                        </tr>
                        <tr>
                            <th>Total Transfer</th>
                            <td><?= $payment['total_transfer'] ?></td>
                        </tr>
                        <tr>
                            <th>Transfer Time</th>
                            <td><?= $payment['transfer_time'] ?></td>
                        </tr>
                        <tr>
                            <th>Nama Rekening Bank</th>
                            <td><?= $payment['payment_owner'] ?></td>
                        </tr>
                        <tr>
                            <th>Nama Bank</th>
                            <td><?= $payment['bank_name'] ?></td>
                        </tr>
                        <tr>
                            <th>No Rek</th>
                            <td><?= $payment['no_rek'] ?></td>
                        </tr>
					</tbody>
				</table>
			</div>
		</div>
        <a class="btn btn-primary " href="<?= base_url(); ?>myCustomerReservation">Back</a>
        <a class="btn btn-success" href="<?= base_url(); ?>aprovePayment/<?= $reservation['id_reservasi'] ?>">Confirm Payment</a>
	</section>
</div>
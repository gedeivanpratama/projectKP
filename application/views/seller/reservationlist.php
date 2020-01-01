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
                            <th>Image</th>
                            <th>Hotel</th>
                            <th>address</th>
							<th>Action</th>
						</tr>
                        <?php foreach($hotel as $key => $value) : ?>
						<tr>
                        	<th><?= $value['id_hotel'] ?></th>
							<td> <img src="<?= base_url() ?>uploads/hotelImages/<?= $value['image_hotel'] ?>" alt="" width="200"></td>
							<td><?= $value['nama_hotel'] ?></td>
                            <td><?= $value['alamat_hotel'] ?></td>
							<th>
                                <a class="btn btn-primary" href="<?= base_url() ?>check/reservation/<?= $value['id_hotel'] ?>">Check Reservation</a>
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
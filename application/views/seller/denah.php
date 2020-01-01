<div class="content-wrapper">
	<section class="content container-fluid">
		<div class="box my-top">
			<div class="box-header">
				<h3 class="box-title"> Denah Kamar hotel</h3>
			</div>
            <a href="<?= base_url() ?>denah/tambah/<?= $hotel['id_hotel'] ?>" class="btn btn-primary">Tambah Denah</a>
			<div class="box-body no-padding">
				<table class="table table-condensed">
					<tbody>
						<tr>
                            <th>Id</th>
                            <th>tipe ruangan</th>
							<th>denah</th>
							<th>deskripsi</th>
							<th>Action</th>
						</tr>
						<?php foreach($denah as $key => $val): ?>
						<tr>
							<td>
								<?= $val['id_denah']; ?>
							</td>
                            <td>
                                <?= $val['nama_type']; ?>
                            </td>
							<td>
								<img src="<?php echo base_url()?>uploads/denah/<?= $val['denah']; ?>" alt="hotel image view" style="width: 100px; height: 70px;">
							</td>
							<td>
								<?= $val['description']; ?>
							</td>
							<td>
								<a href="<?= base_url(); ?>denah/edit/<?php echo $val['id_denah'] ?>/<?= $hotel['id_hotel'] ?>" class="btn btn-warning"><span class="fa fa-edit"> Edit</span></a>
								<a href="<?= base_url(); ?>denah/delete/<?php echo $val['id_denah'] ?>/<?= $hotel['id_hotel'] ?>" class="btn btn-danger"><span class="fa fa-times"> Delete</span></a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
		</div>
	</section>
</div>
<div class="content-wrapper">
	<section class="content container-fluid">
        <a class="btn btn-primary" href="<?= base_url();?>API/List">Back</a><br><br>
		<div class="box my-top">
			<div class="box-header">
				<h3 class="box-title"> API Details :</h3>
			</div>
			<div class="msg-flash" data-flashTitle="<?= $this->session->flashdata('title');?>" data-flashInfo="<?= $this->session->flashdata('info');?>" data-status="<?= $this->session->flashdata('status');?>"></div>        
			<div class="box-body no-padding">
				<table class="table table-condensed">
					<tbody>
                        <tr>
                            <th>End Point Request :</th>
                            <th>
                            <p><?= base_url() ?>Api/Request/?id_partner=[...]&id_request=[...]&nama_api=[...]</p>
                            <?= base_url() . 'Api/Request/?id_partner=' . $api['id_partner'].'&id_request='. $api['id_request'] .'&nama_api=' . $api['nama_api']?>
                            </th>
                        </tr>
                        <tr>
                            <th>End Point Response :</th>
                            <th>
                            <?= (is_null($api['url']))? 'not avalilable' : $api['url']; ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Id Api</th>
                            <th><?= $api['id_api'] ?></th>
                        </tr>
                        <tr>
                            <th>id Hotel</th>
                            <th><?= $api['id_hotel'] ?></th>
                        </tr>
                        <tr>
                            <th>Hotel Name</th>
                            <th><?= $api['nama_hotel'] ?></th>
                        </tr>
                        <tr>
                            <th>Id Partner</th>
                            <th><?= $api['id_partner'] ?></th>
                        </tr>
                        <tr>
                            <th>Id Request</th>
                            <th><?= $api['id_request'] ?></th>
                        </tr>
                        <tr>
                            <th>Nama API</th>
                            <th><?= $api['nama_api'] ?></th>
                        </tr>
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
		</div>
	</section>
</div>
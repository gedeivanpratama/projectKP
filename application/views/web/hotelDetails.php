    <!-- modal info -->
    <?php foreach($denah as $key => $val): ?>
    <div class="modal fade" id="denah<?= $val['id_denah'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Denah Kamar Hotel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url(); ?>uploads/denah/<?= $val['denah']; ?>" alt="">
                </div>
                <h4>keterangan :</h4>
                <p><?= $val['description']?></p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    
    <div class="container mt-5">
        <h1 style="font-family: 'Playfair Display', serif;">Hotel name : <b><?= $hotel['nama_hotel']; ?></b></h1>
        <div class="row mb-5 shadow pb-3">
            <div class="col-8">
                <label class="border border-success px-2 mx-1 rounded"><i class="fas fa-map-marked-alt"></i> alamat : <?= $hotel['alamat_hotel']; ?>,</label>
                <label class="border border-success px-2 mx-1 rounded"><i class="fas fa-phone-square"></i> telp : <?= $hotel['telp_hotel']; ?>,</label>
                <label class="border border-success px-2 mx-1 rounded"><i class="fas fa-envelope"></i> email: <?= $hotel['email_hotel']; ?></label>
                <img class="img-fluid" src="<?= base_url(); ?>uploads/hotelImages/<?= $hotel['image_hotel']; ?>" alt="hotel image">
            </div>          
            <div class="col-4">
                
                <h4><b>Start from :</b></h4>
                <h3 class="bg-success d-inline-block p-2 rounded">Rp. <b><?= number_format($hotel['harga']); ?></b></h3>
                <h5>Hotel Facility :</h5>
                <div class="col">
                    <ul>
                    <?php foreach($hotelFacility as $key => $val): ?>
                        <li class="border border-dark p-1 rounded d-inline-block mb-1"><i class="fas fa-plus"></i> <?= $val['nama_fasilitas']; ?> : <?= $val['jumlah_fasilitas']; ?> Item</li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <?php foreach($type as $key => $val): ?>
        <div class="row shadow p-3 my-4">
                <h2 style="font-family: 'Playfair Display', serif;">Room Name : <b><?= $val['nama_type']; ?></b></h2>
        <div class='row'>
            <div class="col-6">
                <img class="img-fluid" src="<?= base_url(); ?>uploads/roomImages/<?= $val['image_kamar']; ?>" alt="">
            </div>
            <div class="col-3">
                <div class="room-content">
                    <h4>Room Facility :</h4>
                    <ul>
                        <?php $T = "";  ?>
                        <?php foreach($roomFacility as $key => $valF): ?>    
                        <?php if($val['id_type']  ===  $valF['id_type']){
                                $T .= "<li class='bg-success p-1 my-1 text-light rounded d-inline-block'> <i class='fas fa-plus'></i> ". $valF['nama_fasilitas'] . "</li> ";
                            } ?>    
                        <?php endforeach;?>
                        <?php if(empty($T)): ?>
                                <p class="bg-danger p-1 my-1 text-light rounded d-inline-block">not Available</p>
                        <?php else: ?>
                                <?= $T; ?>
                        <?php endif; ?>      
                    </ul>
                </div>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#denah<?=$val['id_denah']?>"><i class="fas fa-info-circle"></i></button> <span class="text-info">info posisi kamar</span>
                <?php   $R = "";
                        $id_kamar = "";
                        $count = 0;
                        if(isset($roomAPI)){
                            foreach($roomAPI as $key => $valR){
                                if($val['id_type'] === $valR['id_type']){
                                    $R .= "<option value=" . $valR['id_room'] . ">Room Number : " .$valR['room_name']."</option>";
                                    $id_kamar = $valR['id_room'];
                                    $count++;
                                }
                            }  
                        }else{
                            foreach($room as $key => $valR){
                                if($val['id_type'] === $valR['id_type']){
                                    $R .= "<option value=" . $valR['id_kamar'] . ">Room Number : " .$valR['no_kamar']."</option>";
                                    $id_kamar = $valR['id_kamar'];
                                    $count++;
                                }
                            }  
                        }
                        ?>
                <!-- // echo form_open(base_url("verify/". $hotel['id_hotel'] ."/". $val['id_type'].'/'. $_GET['name']));  -->
                    <form action="<?= base_url("verify/". $hotel['id_hotel'] ."/". $val['id_type'].'/')?>" method="get">
                    <label>Choose Room</label><br>                   
                        <?php if(empty($R)): ?>
                            <select class="form-control" disabled>
                                <option value="">Not Available</option>
                            </select>
                        <?php else: ?>
                            <select name="room" class="form-control">
                            <?= $R; ?>
                            </select>
                        <?php endif; ?>
                            
                    <div class="form-right-element">
                        <label class="price-label">Price per-Day :</label>
                        <h3 class="label label-success my-label">Rp. <b><?= number_format($val['harga']); ?></b></h3><br>
                        <?php if($count !== 0): ?>
                            <label class="text-success"><?= $count ?> (room) available</label>
                            <button class="btn btn-warning" type='submit'>Book</button>
                        <?php else: ?>
                            <label class="text-danger">not available</label>
                        <?php endif; ?>                        
                    </div>
                    </form>
            </div>
        </div>
        </div>
        <?php endforeach; ?>
    </div>
    
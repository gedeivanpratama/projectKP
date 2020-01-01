<div class="container">
        <div class='hotel-dec-box'>
            <h1><?= $hotel['nama_hotel']; ?></h1>
            <div class="hotel-dec-content">
                <p><span class="glyphicon glyphicon-map-marker"></span> alamat : <?= $hotel['alamat_hotel']; ?></p>
                <div class="hotel-list-info">
                    <p> <span class="glyphicon glyphicon-phone-alt"></span> telp : <?= $hotel['telp_hotel']; ?></p> |
                    <p> <span class="glyphicon glyphicon-envelope"></span> email: <?= $hotel['email_hotel']; ?></p>
                </div>
            </div>
            <img class="img-hotel" src="<?= base_url(); ?>uploads/hotelImages/<?= $hotel['image_hotel']; ?>" alt="hotel image">
            <div class="my-label-hotel-price">
                <p>Room price start from :</p>
                <h3 class="label label-success my-label">Rp. <?= number_format($hotel['harga']); ?></h3>
            </div>
            <div class="hotel-facility">
                <h2>Hotel Facility :</h2>
                <ul>
                <?php foreach($hotelFacility as $key => $val): ?>
                    <li class="label label-success"><?= $val['nama_fasilitas']; ?> : <?= $val['jumlah_fasilitas']; ?> Item</li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <?php foreach($type as $key => $val): ?>
        <div class='room-dec-box'>
            <img class="img-room" src="<?= base_url(); ?>uploads/roomImages/<?= $val['image_kamar']; ?>" alt="">
            <div class="room-booking">
                <?php $R = "";
                        $id_kamar = "";
                        $count = 0;
                        foreach($room as $key => $valR){
                            if($val['id_type'] === $valR['id_type']){
                                $R .= "<option value=" . $valR['id_kamar'] . ">Room Number : " .$valR['no_kamar']."</option>";
                                $id_kamar = $valR['id_kamar'];
                                $count++;
                            }
                        } ?>
                <?php echo form_open(base_url("verify/". $hotel['id_hotel'] ."/". $val['id_type'])); ?>
                    <label for="">Choose Room</label><br>                   
                        <?php if(empty($R)): ?>
                            <select class="select-room" name="" id="" disabled>
                                <option value="">Not Available</option>
                            </select>
                        <?php else: ?>
                            <select class="select-room" name="room" id="">
                            <?= $R; ?>
                            </select>
                        <?php endif; ?>
                            
                    <div class="form-right-element">
                        <label class="price-label">Price per-Day :</label>
                        <h3 class="label label-success my-label">Rp. <?= number_format($val['harga']); ?></h3><br>
                        <?php if($count !== 0): ?>
                            <label class="room-available"><?= $count ?> (room) available</label>
                            <button class="btn btn-warning" type='submit'>Book</button>
                        <?php else: ?>
                            <label class="room-available">not available</label>
                        <?php endif; ?>                        
                    </div>
                <?php echo form_close(); ?>
            </div>
            <div class="room-content">
                <h2><?= $val['nama_type']; ?></h2>
                <h3>Room Facility :</h3>
                <ul>
                    <?php $T = "";  ?>
                    <?php foreach($roomFacility as $key => $valF): ?>    
                    <?php if($val['id_type']  ===  $valF['id_type']){
                            $T .= "<li class='label label-primary'> ". $valF['nama_fasilitas'] . "</li> ";
                        } ?>    
                    <?php endforeach;?>

                    <?php if(empty($T)): ?>
                            <p class="label label-danger">not Available</p>
                    <?php else: ?>
                            <?= $T; ?>
                    <?php endif; ?>      
                </ul>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
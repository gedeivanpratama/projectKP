<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/pdf.css">
</head>
<body>
    <header>
        <img class="header-logo" src="<?= $_SERVER['DOCUMENT_ROOT'] ?>/Framework/MHotel/assets/img/stikombali.jpg" alt="">
        <h1 class="header-title">Reservasi Hotel</h1>
        <h2 class="header-title">Booking Information</h2>
        <div class="header-description"><span>Telp :081928192891</span> | <span>Email:manajementHotel@gmail.com</span></div>
    </header>
    
    <div class="container">
        <div class="box-customer">
            <h2>Customer Information</h2>
            <table class="customer-info">
                <tr>
                    <th>Name </th>
                    <th>: <?= $reservation['nama_customer'] ?></th>
                </tr>
                <tr>
                    <th>Alamat </th>
                    <th>: <?= $reservation['alamat_customer'] ?></th>
                </tr>
                <tr>
                    <th>Email </th>
                    <th>: <?= $reservation['email_customer']?></th>
                </tr>
                <tr>
                    <th>Telp </th>
                    <th>: <?= $reservation['telp_customer'] ?></th>
                </tr>
            </table>
        </div>

        <div class="box-room">
            <h2>Room Information</h2>
            <table class="room-info">
                <tr>
                    <th>Name </th>
                    <th>: <?= $reservation['nama_type'] ?></th>
                </tr>
                <tr>
                    <th>No </th>
                    <th>: <?= $reservation['no_kamar'] ?></th>
                </tr>
                <tr>
                    <th>Price /Night </th>
                    <th>: <?= $reservation['harga'] ?></th>
                </tr>
            </table>
        </div>

        <div class="box-booking">
            <h2>Booking Information</h2>
            <table class="book-info" >
                <tr>
                    <th>Name </th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Total Night</th>
                    <th>Discount</th>
                    <th>Total Price</th>
                </tr>
                <tr>
                    <th><?= $reservation['nama_customer'] ?></th>
                    <th><?= $reservation['check_in'] ?></th>
                    <th><?= $reservation['check_out'] ?></th>
                    <th><?= $totalDay?></th>
                    <th><?= $event['discount'] ?> %</th>                    
                    <th>Rp. <?= $reservation['total_price'] ?></th>
                </tr>
               
            </table>
        </div>
        <br>
        <div class="box-customer-pay">
            <h2>Payment Information</h2>
            <table class="customer-pay-info">
                <tr>
                    <th>Name </th>
                    <th>: <?= $confirm['payment_owner'] ?></th>
                </tr>
                <tr>
                    <th>Bank Name </th>
                    <th>: <?= $confirm['bank_name'] ?></th>
                </tr>
                <tr>
                    <th>Debit Number </th>
                    <th>: <?= $confirm['no_rek'] ?></th>
                </tr>
            </table>
        </div>

        <div class="box-confirm">
            <h2>Payment Confirm</h2>
            <table class="confirm-info">
                <tr>
                    <th>Name </th>
                    <th>: <?= $confirm['sender_name'] ?></th>
                </tr>
                <tr>
                    <th>Bank Name </th>
                    <th>: <?= $confirm['bank_sender'] ?></th>
                </tr>
                <tr>
                    <th>Debit Number </th>
                    <th>: <?= $confirm['no_rek_sender'] ?></th>
                </tr>
            </table>
        </div>
    </div>
    <footer>
        <h4>Thank you for choosing Us &copy; 2019</h5>
    </footer>
</body>
</html>
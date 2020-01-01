-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 31, 2019 at 06:29 PM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_api`
--

CREATE TABLE `tb_api` (
  `id_api` int(11) NOT NULL,
  `id_seller` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `id_partner` varchar(200) NOT NULL,
  `id_request` varchar(200) NOT NULL,
  `nama_api` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `url` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_api`
--

INSERT INTO `tb_api` (`id_api`, `id_seller`, `id_hotel`, `id_partner`, `id_request`, `nama_api`, `status`, `url`) VALUES
(6, 11, 14, '69aaf0fba4', '51954807c1', 'HotelComo', 1, 'http://management.com/api/room'),
(7, 11, 15, 'ecc2b118c9', 'ddb8921a54', 'coba', 0, NULL),
(8, 11, 14, '3ec1c60440', '86a55b68db', 'coba', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_archive`
--

CREATE TABLE `tb_archive` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_reservasi` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `id_status_reservasi` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_archive`
--

INSERT INTO `tb_archive` (`id`, `time`, `id_reservasi`, `check_in`, `check_out`, `total_price`, `id_customer`, `id_hotel`, `id_status_reservasi`, `id_type`, `id_kamar`, `id_event`) VALUES
(1, '2019-07-17 01:56:03', 2, '2019-07-17', '2019-07-19', '1400000', 7, 14, 4, 16, 17, 0),
(2, '2019-07-19 10:17:01', 1, '2019-07-17', '2019-07-19', '1400000', 7, 14, 4, 16, 15, 0),
(3, '2019-07-19 10:17:05', 3, '2019-07-17', '2019-07-19', '1400000', 7, 14, 4, 16, 17, 0),
(4, '2019-07-19 10:17:07', 4, '2019-07-19', '2019-07-22', '2100000', 7, 14, 4, 16, 18, 0),
(5, '2019-07-19 10:27:25', 5, '2019-07-19', '2019-07-22', '2100000', 7, 14, 4, 16, 15, 0),
(6, '2019-07-31 09:06:17', 8, '2019-07-19', '2019-07-22', '2100000', 7, 14, 1, 16, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_confirm`
--

CREATE TABLE `tb_confirm` (
  `id_confirm` int(11) NOT NULL,
  `sender_name` varchar(200) NOT NULL,
  `bank_sender` varchar(200) NOT NULL,
  `no_rek_sender` varchar(200) NOT NULL,
  `total_transfer` varchar(200) NOT NULL,
  `transfer_time` date NOT NULL,
  `id_payment` int(11) NOT NULL,
  `id_reservasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_confirm`
--

INSERT INTO `tb_confirm` (`id_confirm`, `sender_name`, `bank_sender`, `no_rek_sender`, `total_transfer`, `transfer_time`, `id_payment`, `id_reservasi`) VALUES
(1, 'steff ', 'mandiri', '10009301920192001', '2000000', '2019-05-28', 5, 1),
(2, 'aaawqqq', 'laksla', '10921092010', '2000000', '2019-06-10', 6, 1),
(3, 'ivan pratama', 'BCA', '19289182918291', '1000000', '2019-07-18', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(200) NOT NULL,
  `img_customer` varchar(255) NOT NULL DEFAULT 'no_img.jpg',
  `telp_customer` varchar(255) NOT NULL,
  `email_customer` varchar(255) NOT NULL,
  `alamat_customer` varchar(200) NOT NULL,
  `customer_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id_customer`, `nama_customer`, `img_customer`, `telp_customer`, `email_customer`, `alamat_customer`, `customer_password`) VALUES
(7, 'Stefani Joanne', 'StefaniJoanne_beautiful-cute-girl-1164245.jpg', '01819102910', 'customer@gmail.com', 'new york united states', '$2y$10$/5/r7t.zq3LHVPZPeOUM/uAHmy9GAK.6tw9M8AJXnwhHm2W/acc..'),
(8, 'bradley cooper', 'no_img.jpg', 'bradley cooper', 'customer2@gmail.com', 'new york', '$2y$10$2V3du5HctiJ0ZUT0EPcQeOvrW6lKwiO2GkXk/k6C4N3DaV2yFYSt2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_denah`
--

CREATE TABLE `tb_denah` (
  `id_denah` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `denah` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_denah`
--

INSERT INTO `tb_denah` (`id_denah`, `id_type`, `denah`, `description`) VALUES
(4, 16, 'ivan_drawing-1.png', 'T : merupakan tangga, L: merupakan lift');

-- --------------------------------------------------------

--
-- Table structure for table `tb_event`
--

CREATE TABLE `tb_event` (
  `id_event` int(11) NOT NULL,
  `nama_event` varchar(200) NOT NULL,
  `start_event` date NOT NULL,
  `end_event` date NOT NULL,
  `discount` int(11) NOT NULL,
  `id_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_fasilitas_hotel`
--

CREATE TABLE `tb_fasilitas_hotel` (
  `id_fasilitas_hotel` int(11) NOT NULL,
  `nama_fasilitas` varchar(200) NOT NULL,
  `jumlah_fasilitas` varchar(200) NOT NULL,
  `id_hotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_fasilitas_hotel`
--

INSERT INTO `tb_fasilitas_hotel` (`id_fasilitas_hotel`, `nama_fasilitas`, `jumlah_fasilitas`, `id_hotel`) VALUES
(10, 'Parking', '2', 14),
(11, 'Pool', '2', 14),
(12, 'Bar', '3', 14),
(13, 'Parking', '2', 15);

-- --------------------------------------------------------

--
-- Table structure for table `tb_fasilitas_kamar`
--

CREATE TABLE `tb_fasilitas_kamar` (
  `id_fasilitas_kamar` int(11) NOT NULL,
  `nama_fasilitas` varchar(200) NOT NULL,
  `jumlah_fasilitas` int(11) NOT NULL,
  `id_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_fasilitas_kamar`
--

INSERT INTO `tb_fasilitas_kamar` (`id_fasilitas_kamar`, `nama_fasilitas`, `jumlah_fasilitas`, `id_type`) VALUES
(9, 'Bed', 1, 16),
(10, 'AC', 1, 16),
(11, 'Bed', 2, 17),
(12, 'AC', 2, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tb_hotel`
--

CREATE TABLE `tb_hotel` (
  `id_hotel` int(11) NOT NULL,
  `urlapi` text NOT NULL,
  `nama_hotel` varchar(200) NOT NULL,
  `alamat_hotel` varchar(200) NOT NULL,
  `email_hotel` varchar(200) NOT NULL,
  `telp_hotel` varchar(200) NOT NULL,
  `id_seller` int(11) NOT NULL,
  `image_hotel` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hotel`
--

INSERT INTO `tb_hotel` (`id_hotel`, `urlapi`, `nama_hotel`, `alamat_hotel`, `email_hotel`, `telp_hotel`, `id_seller`, `image_hotel`) VALUES
(14, 'http://management.com/api/room', 'Como Shambala', 'payangan gianyar', 'como@reservation.com', '036192199291', 11, 'ivanpratama_pexels-photo-258154.jpeg'),
(15, '', 'Alila Ubud', 'payangan, Gianyar', 'alila@ubud.com', '03612932919', 11, 'ivanpratama_pexels-photo-1134176.jpeg'),
(16, '', 'uma', 'ubud', 'umahotel@uma.com', '0182918191991', 12, 'seller_apartment-bed-bedroom-271624.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kamar`
--

CREATE TABLE `tb_kamar` (
  `id_kamar` int(11) NOT NULL,
  `no_kamar` varchar(10) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kamar`
--

INSERT INTO `tb_kamar` (`id_kamar`, `no_kamar`, `id_type`, `id_status`) VALUES
(15, 'I', 16, 1),
(16, 'II', 16, 1),
(17, 'III', 16, 1),
(18, 'IV', 16, 1),
(19, '1', 17, 1),
(20, '2', 17, 1),
(21, '3', 17, 1),
(22, '4', 17, 1),
(23, '1', 18, 1),
(24, '2', 18, 1),
(25, '3', 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_payment`
--

CREATE TABLE `tb_payment` (
  `id_payment` int(11) NOT NULL,
  `payment_owner` varchar(200) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `no_rek` varchar(255) NOT NULL,
  `id_hotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_payment`
--

INSERT INTO `tb_payment` (`id_payment`, `payment_owner`, `bank_name`, `no_rek`, `id_hotel`) VALUES
(5, 'PT Como shambala', 'Mandiri', '0192910920119', 14),
(6, 'allia ubud', 'BCA', '09293929229291', 15);

-- --------------------------------------------------------

--
-- Table structure for table `tb_reservasi`
--

CREATE TABLE `tb_reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `id_status_reservasi` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `data_api` varchar(200) NOT NULL DEFAULT 'NO',
  `book_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_reservasi`
--

INSERT INTO `tb_reservasi` (`id_reservasi`, `check_in`, `check_out`, `total_price`, `id_customer`, `id_hotel`, `id_status_reservasi`, `id_type`, `id_kamar`, `id_event`, `data_api`, `book_at`) VALUES
(9, '2019-07-31', '2019-08-02', '1400000', 7, 14, 1, 16, 15, 0, 'h2NdgEqQaFTObisetIfwSCWnKVxoMUvL9pj3PJ68yA751kX4cl', '2019-07-31 09:17:25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_seller`
--

CREATE TABLE `tb_seller` (
  `id_seller` int(11) NOT NULL,
  `nama_seller` varchar(200) NOT NULL,
  `img_seller` varchar(200) NOT NULL DEFAULT 'no_img.jpg',
  `email_seller` varchar(255) NOT NULL,
  `telp_seller` varchar(255) NOT NULL,
  `alamat_seller` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_seller`
--

INSERT INTO `tb_seller` (`id_seller`, `nama_seller`, `img_seller`, `email_seller`, `telp_seller`, `alamat_seller`, `password`) VALUES
(11, 'ivan pratama', 'ivanpratama_adult-beard-boy-220453.jpg', 'igedeivanpratama@gmail.com', '081283828281', 'payangan', '$2y$10$4KOeNFG/1T1qrj.aEbTDh.dLbwdWrYYAM4dcsv46uGloiVlLuuVn2'),
(12, 'seller', 'no_img.jpg', 'seller@gmail.com', '085126172718', 'singaraja', '$2y$10$nky9qLjXOXZ.U0CzESsrTuouGVqKzFYSav4kAGe2kzgOYleplIUte');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `id_status` int(11) NOT NULL,
  `nama_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`id_status`, `nama_status`) VALUES
(1, 'Available'),
(2, 'Not Available');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status_reservasi`
--

CREATE TABLE `tb_status_reservasi` (
  `id_status_reservasi` int(11) NOT NULL,
  `nama_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_status_reservasi`
--

INSERT INTO `tb_status_reservasi` (`id_status_reservasi`, `nama_status`) VALUES
(1, 'not Confirm'),
(2, 'Progress'),
(3, 'Confirm'),
(4, 'cancel'),
(5, 'delete'),
(6, 'archive');

-- --------------------------------------------------------

--
-- Table structure for table `tb_type`
--

CREATE TABLE `tb_type` (
  `id_type` int(11) NOT NULL,
  `nama_type` varchar(200) NOT NULL,
  `image_kamar` varchar(200) NOT NULL,
  `denah` varchar(200) NOT NULL DEFAULT 'no_images.jpg',
  `harga` varchar(100) NOT NULL,
  `id_hotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_type`
--

INSERT INTO `tb_type` (`id_type`, `nama_type`, `image_kamar`, `denah`, `harga`, `id_hotel`) VALUES
(16, 'Standard', 'ivanpratama_pexels-photo-97083.jpeg', 'no_images.jpg', '700000', 14),
(17, 'medium', 'ivanpratama_bed-bedroom-carpet-90317.jpg', 'no_images.jpg', '900000', 14),
(18, 'Medium', 'ivanpratama_architecture-bed-bedroom-1454806.jpg', 'no_images.jpg', '800000', 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_api`
--
ALTER TABLE `tb_api`
  ADD PRIMARY KEY (`id_api`);

--
-- Indexes for table `tb_archive`
--
ALTER TABLE `tb_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_confirm`
--
ALTER TABLE `tb_confirm`
  ADD PRIMARY KEY (`id_confirm`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `tb_denah`
--
ALTER TABLE `tb_denah`
  ADD PRIMARY KEY (`id_denah`);

--
-- Indexes for table `tb_event`
--
ALTER TABLE `tb_event`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `id_type` (`id_type`);

--
-- Indexes for table `tb_fasilitas_hotel`
--
ALTER TABLE `tb_fasilitas_hotel`
  ADD PRIMARY KEY (`id_fasilitas_hotel`),
  ADD KEY `id_hotel` (`id_hotel`);

--
-- Indexes for table `tb_fasilitas_kamar`
--
ALTER TABLE `tb_fasilitas_kamar`
  ADD PRIMARY KEY (`id_fasilitas_kamar`),
  ADD KEY `id_type` (`id_type`);

--
-- Indexes for table `tb_hotel`
--
ALTER TABLE `tb_hotel`
  ADD PRIMARY KEY (`id_hotel`),
  ADD KEY `tb_hotel_ibfk_1` (`id_seller`);

--
-- Indexes for table `tb_kamar`
--
ALTER TABLE `tb_kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_status` (`id_status`);

--
-- Indexes for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `id_hotel` (`id_hotel`);

--
-- Indexes for table `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  ADD PRIMARY KEY (`id_reservasi`),
  ADD KEY `id_hotel` (`id_hotel`),
  ADD KEY `id_status_reservasi` (`id_status_reservasi`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `tb_seller`
--
ALTER TABLE `tb_seller`
  ADD PRIMARY KEY (`id_seller`),
  ADD UNIQUE KEY `email_seller` (`email_seller`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tb_status_reservasi`
--
ALTER TABLE `tb_status_reservasi`
  ADD PRIMARY KEY (`id_status_reservasi`);

--
-- Indexes for table `tb_type`
--
ALTER TABLE `tb_type`
  ADD PRIMARY KEY (`id_type`),
  ADD KEY `id_hotel` (`id_hotel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_api`
--
ALTER TABLE `tb_api`
  MODIFY `id_api` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_archive`
--
ALTER TABLE `tb_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_confirm`
--
ALTER TABLE `tb_confirm`
  MODIFY `id_confirm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_denah`
--
ALTER TABLE `tb_denah`
  MODIFY `id_denah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_event`
--
ALTER TABLE `tb_event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_fasilitas_hotel`
--
ALTER TABLE `tb_fasilitas_hotel`
  MODIFY `id_fasilitas_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tb_fasilitas_kamar`
--
ALTER TABLE `tb_fasilitas_kamar`
  MODIFY `id_fasilitas_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tb_hotel`
--
ALTER TABLE `tb_hotel`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tb_kamar`
--
ALTER TABLE `tb_kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tb_payment`
--
ALTER TABLE `tb_payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tb_seller`
--
ALTER TABLE `tb_seller`
  MODIFY `id_seller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tb_status_reservasi`
--
ALTER TABLE `tb_status_reservasi`
  MODIFY `id_status_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_type`
--
ALTER TABLE `tb_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_event`
--
ALTER TABLE `tb_event`
  ADD CONSTRAINT `tb_event_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `tb_type` (`id_type`);

--
-- Constraints for table `tb_fasilitas_hotel`
--
ALTER TABLE `tb_fasilitas_hotel`
  ADD CONSTRAINT `tb_fasilitas_hotel_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `tb_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_fasilitas_kamar`
--
ALTER TABLE `tb_fasilitas_kamar`
  ADD CONSTRAINT `tb_fasilitas_kamar_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `tb_type` (`id_type`);

--
-- Constraints for table `tb_hotel`
--
ALTER TABLE `tb_hotel`
  ADD CONSTRAINT `tb_hotel_ibfk_1` FOREIGN KEY (`id_seller`) REFERENCES `tb_seller` (`id_seller`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_kamar`
--
ALTER TABLE `tb_kamar`
  ADD CONSTRAINT `tb_kamar_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `tb_type` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kamar_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `tb_status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD CONSTRAINT `tb_payment_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `tb_hotel` (`id_hotel`);

--
-- Constraints for table `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  ADD CONSTRAINT `tb_reservasi_ibfk_2` FOREIGN KEY (`id_hotel`) REFERENCES `tb_hotel` (`id_hotel`),
  ADD CONSTRAINT `tb_reservasi_ibfk_3` FOREIGN KEY (`id_status_reservasi`) REFERENCES `tb_status_reservasi` (`id_status_reservasi`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_reservasi_ibfk_4` FOREIGN KEY (`id_customer`) REFERENCES `tb_customer` (`id_customer`);

--
-- Constraints for table `tb_type`
--
ALTER TABLE `tb_type`
  ADD CONSTRAINT `tb_type_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `tb_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

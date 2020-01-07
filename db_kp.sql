-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 07, 2020 at 11:00 PM
-- Server version: 5.7.28-0ubuntu0.18.04.4
-- PHP Version: 7.2.24-0ubuntu0.18.04.1

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
(1, 'cobacoba', 'mandiri', '019201092', '300000', '2020-01-06', 2, 1),
(2, 'ivan', 'mandiri', '10920192901', '300000', '2020-01-06', 2, 2),
(3, 'lalal', 'allalal', '102010', '300000', '2020-01-06', 2, 3);

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
(2, 1, 'ivan_adult-casual-denim-jacket-1040881.jpg', 'aaaaqqw');

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
(2, 'parking', '34', 2);

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
(1, 'AC', 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_hotel`
--

CREATE TABLE `tb_hotel` (
  `id_hotel` int(11) NOT NULL,
  `nama_hotel` varchar(200) NOT NULL,
  `alamat_hotel` varchar(200) NOT NULL,
  `email_hotel` varchar(200) NOT NULL,
  `telp_hotel` varchar(200) NOT NULL,
  `id_user` int(11) NOT NULL,
  `image_hotel` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hotel`
--

INSERT INTO `tb_hotel` (`id_hotel`, `nama_hotel`, `alamat_hotel`, `email_hotel`, `telp_hotel`, `id_user`, `image_hotel`) VALUES
(2, 'Alila', 'Payangan', 'alila@alial.com', '10290192010', 2, 'ivanpratama_adult-black.jpg'),
(4, 'lalal', 'allaalaaaaaaa', 'aaa@alakal.cll', '0192010', 2, 'no_image.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kamar`
--

CREATE TABLE `tb_kamar` (
  `id_kamar` int(11) NOT NULL,
  `no_kamar` varchar(10) NOT NULL,
  `id_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kamar`
--

INSERT INTO `tb_kamar` (`id_kamar`, `no_kamar`, `id_type`) VALUES
(2, '1', 1),
(3, '2', 1);

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
(2, 'Anak Bagus Ivan Pratama', 'mandiri', '0192012901', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_profile`
--

CREATE TABLE `tb_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_profile`
--

INSERT INTO `tb_profile` (`id`, `name`, `image`, `address`, `telp`, `id_user`) VALUES
(1, 'ivan pratama', 'gedeivanpratama_adult-casual-denim-jacket-1040881.jpg', 'payangan gianyar', '0812939238771', 2),
(2, 'customer satu', 'customer_adult-blue-sky-eyewear-343717.jpg', 'denpasar', '098817263566', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_reservasi`
--

CREATE TABLE `tb_reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `id_status_reservasi` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `book_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_reservasi`
--

INSERT INTO `tb_reservasi` (`id_reservasi`, `check_in`, `check_out`, `total_price`, `id_user`, `id_hotel`, `id_status_reservasi`, `id_type`, `id_kamar`, `id_event`, `book_at`) VALUES
(3, '2020-01-06', '2020-01-10', '4000000', 4, 2, 3, 1, 2, 0, '2020-01-06 13:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rolle`
--

CREATE TABLE `tb_rolle` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rolle`
--

INSERT INTO `tb_rolle` (`id`, `nama`, `description`) VALUES
(1, 'seller', ''),
(2, 'customer', '');

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
(1, 'Standard', 'ivanpratama_facial-expression-fashion-hairstyle-1674752.jpg', 'no_images.jpg', '1000000', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_rolle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `email`, `password`, `id_rolle`) VALUES
(2, 'gedeivanpratama@gmail.com', '$2y$10$Akuxx3KO5mqcv3xQOn2oDOR3k7d0ikWu9Y6cP1GqwsKn3CDfJzpaq', 1),
(4, 'customer@gmail.com', '$2y$10$tX4i1MIMelIsDXG5QH5KGu5ZkZgS5eouUcRNHCrnLRboHbAp1vlbS', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_confirm`
--
ALTER TABLE `tb_confirm`
  ADD PRIMARY KEY (`id_confirm`);

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
  ADD KEY `tb_hotel_ibfk_1` (`id_user`);

--
-- Indexes for table `tb_kamar`
--
ALTER TABLE `tb_kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `id_type` (`id_type`);

--
-- Indexes for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `id_hotel` (`id_hotel`);

--
-- Indexes for table `tb_profile`
--
ALTER TABLE `tb_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  ADD PRIMARY KEY (`id_reservasi`),
  ADD KEY `id_hotel` (`id_hotel`),
  ADD KEY `id_status_reservasi` (`id_status_reservasi`),
  ADD KEY `id_customer` (`id_user`);

--
-- Indexes for table `tb_rolle`
--
ALTER TABLE `tb_rolle`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_confirm`
--
ALTER TABLE `tb_confirm`
  MODIFY `id_confirm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_denah`
--
ALTER TABLE `tb_denah`
  MODIFY `id_denah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_event`
--
ALTER TABLE `tb_event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_fasilitas_hotel`
--
ALTER TABLE `tb_fasilitas_hotel`
  MODIFY `id_fasilitas_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_fasilitas_kamar`
--
ALTER TABLE `tb_fasilitas_kamar`
  MODIFY `id_fasilitas_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_hotel`
--
ALTER TABLE `tb_hotel`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_kamar`
--
ALTER TABLE `tb_kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_payment`
--
ALTER TABLE `tb_payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_profile`
--
ALTER TABLE `tb_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_reservasi`
--
ALTER TABLE `tb_reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_rolle`
--
ALTER TABLE `tb_rolle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_status_reservasi`
--
ALTER TABLE `tb_status_reservasi`
  MODIFY `id_status_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_type`
--
ALTER TABLE `tb_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

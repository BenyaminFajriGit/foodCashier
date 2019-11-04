-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2019 at 11:18 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_perak`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('paid','unpaid','canceled','expired','waiting confirmation','rejected') NOT NULL DEFAULT 'unpaid',
  `fullname` varchar(255) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `courier` varchar(30) NOT NULL,
  `service` varchar(50) NOT NULL,
  `shipping_charge` int(11) NOT NULL,
  `proof` varchar(30) NOT NULL DEFAULT '''default.jpg'''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id_invoice`, `username`, `date`, `due_date`, `status`, `fullname`, `street_address`, `province`, `city`, `phone_number`, `courier`, `service`, `shipping_charge`, `proof`) VALUES
(9, 'member', '2019-09-18', '2019-09-17', 'expired', 'benyamin', 'jalan ratu zaleha no.09', 'Kalimantan Selatan', 'Kotabaru', '0978989362478', 'jne', 'CTC', 14000, 'default.jpg'),
(10, 'member', '2019-09-18', '2019-09-17', 'expired', 'benyamin fajri', 'jalan ratu zaleha no.09', 'Kalimantan Selatan', 'Banjarmasin', '', 'jne', 'CTC', 0, 'default.jpg'),
(12, 'member', '2019-09-19', '2019-09-20', 'expired', 'benyamin fajri', 'jalan ratu zaleha no.09', 'Kalimantan Selatan', 'Banjarmasin', '0978989362478', 'jne', 'CTC', 8000, '12.jpg'),
(14, 'member2', '2019-09-21', '2019-09-22', 'paid', 'member2', 'jalan ratu zaleha no.09', 'Kalimantan Selatan', 'Banjarmasin', '0978989362478', 'jne', 'CTC', 8000, '14.jpg'),
(15, 'member2', '2019-09-21', '2019-09-22', 'paid', 'fajri', 'jalan', 'Kalimantan Selatan', 'Banjarmasin', '492859425', 'jne', 'CTC', 8000, '15.jpg'),
(17, 'member', '2019-09-21', '2019-09-22', 'paid', 'fajri', 'jalan ratu zaleha no.09', 'Kalimantan Timur', 'Samarinda', '0974543', 'jne', 'CTC', 25000, '17.png'),
(18, 'member', '2019-10-12', '2019-10-13', 'expired', 'benyamin fajri', 'jalan ratu zaleha no.09', 'Kalimantan Selatan', 'Banjarmasin', '0974543', 'jne', 'CTC', 10000, 'default.jpg'),
(20, 'member', '2019-10-12', '2019-10-13', 'paid', 'benyamin fajri', 'jalan ratu zaleha no.09', 'Kalimantan Selatan', 'Banjarmasin', '0974543', 'jne', 'CTC', 10000, '20.jpg'),
(21, 'member', '2019-10-12', '2019-10-13', 'expired', 'benz', 'jalan ratu zaleha no.09', 'Kalimantan Selatan', 'Banjarmasin', '927891728971', 'jne', 'CTC', 7000, 'default.jpg'),
(22, 'member', '2019-10-12', '2019-10-13', 'paid', 'member', 'jalan baru', 'DKI Jakarta', 'Jakarta Selatan', '09018818283', 'jne', 'CTC', 28000, '22.png'),
(23, 'member', '2019-10-12', '2019-10-13', 'paid', 'member', 'jalan ratu zaleha no.09', 'Kalimantan Selatan', 'Hulu Sungai Selatan', '09018818283', 'jne', 'CTC', 14000, '23.png'),
(24, 'member', '2019-10-13', '2019-10-14', 'paid', 'member', 'jalan baru', 'Jawa Timur', 'Malang', '09018818283', 'jne', 'CTC', 30000, '24.png'),
(25, 'member', '2019-10-13', '2019-10-14', 'paid', 'member', 'jalan baru', 'Kalimantan Selatan', 'Banjarmasin', '09018818283', 'jne', 'CTC', 10000, '25.jpg'),
(26, 'coba3', '2019-10-24', '2019-10-25', 'paid', 'coba3', 'jalan ratu zaleha no.09', 'DKI Jakarta', 'Jakarta Pusat', '08982456', 'jne', 'CTC', 78000, '26.jpg'),
(27, 'coba3', '2019-10-24', '2019-10-25', 'paid', 'coba3', 'jalan ratu zaleha no.09', 'Jawa Timur', 'Malang', '08982654345', 'jne', 'CTC', 54000, '27.jpg'),
(28, 'member', '2019-10-30', '2019-10-31', 'expired', 'member', 'jalan ratu zaleha no.09', 'Kalimantan Selatan', 'Banjarmasin', '09018818282', 'jne', 'CTC', 30000, 'default.jpg'),
(29, 'coba2', '2019-11-03', '2019-11-04', 'rejected', 'coba2', 'jalan ratu zaleha no.09', 'Kalimantan Selatan', 'Banjarmasin', '234829789', 'jne', 'CTC', 24000, '29.jpg'),
(30, 'coba2', '2019-11-03', '2019-11-04', 'paid', 'coba2', 'jalan ratu zaleha no.09', 'Kalimantan Selatan', 'Banjarmasin', '234829789', 'jne', 'CTC', 7000, '30.jpg'),
(31, 'coba2', '2019-11-03', '2019-11-04', 'waiting confirmation', 'coba2', 'jalan ratu zaleha no.09', 'Kalimantan Selatan', 'Banjarmasin', '234829789', 'jne', 'CTC', 7000, '31.jpg'),
(32, 'coba2', '2019-11-03', '2019-11-04', 'unpaid', 'coba2', 'jalan ratu zaleha no.09', 'Kalimantan Selatan', 'Banjarmasin', '234829789', 'jne', 'CTC', 7000, 'default.jpg'),
(33, 'coba2', '2019-11-03', '2019-11-04', 'unpaid', 'coba2', 'jalan ratu zaleha no.09', 'Kalimantan Selatan', 'Banjarmasin', '234829789', 'tiki', 'REG', 7000, 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_product` varchar(20) NOT NULL,
  `note` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_invoice`, `id_product`, `note`, `qty`) VALUES
(1, 9, '5d822aadb12eb', 'belum diisi', 2),
(2, 10, '5d8228d417112', 'belum diisi', 1),
(3, 10, '5d82298c41392', 'belum diisi', 1),
(4, 10, '5d822aadb12eb', 'belum diisi', 4),
(6, 12, '5d822aadb12eb', 'belum diisi', 1),
(8, 14, '5d822b2a7f1c8', 'belum diisi', 2),
(9, 15, '5d822aadb12eb', 'belum diisi', 2),
(11, 17, '5d822b2a7f1c8', 'belum diisi', 2),
(12, 18, '5d8228d417112', 'belum diisi', 1),
(13, 20, '5d8228d417112', 'belum diisi', 1),
(14, 21, '5d9de36f9e6bc', 'belum diisi', 3),
(15, 21, '5d822aadb12eb', 'belum diisi', 2),
(16, 22, '5d9de36f9e6bc', 'biru muda', 2),
(17, 22, '5d822aadb12eb', 'biru tua', 2),
(18, 22, '5d9de36f9e6bc', 'merah', 1),
(19, 23, '5d82298c41392', 'A', 2),
(20, 24, '5d9de36f9e6bc', 'a', 1),
(21, 24, '5d822a2a1fada', 'a', 1),
(22, 25, '5d8228d417112', 'a', 1),
(23, 26, '5d8228d417112', 'merah\r\n', 3),
(24, 27, '5d8228d417112', 'b', 1),
(25, 27, '5d822a2a1fada', 'c', 1),
(26, 28, '5d822aadb12eb', 'putih', 3),
(27, 28, '5d82298c41392', 'best', 2),
(28, 29, '5d82298c41392', 'kuning panjang 44 cm', 3),
(29, 29, '5d8228d417112', 'panjang 17 cm', 1),
(30, 30, '5d8228d417112', 'panjang 13 cm', 1),
(31, 31, '5d822a2a1fada', '-', 1),
(32, 32, '5d822b2a7f1c8', 'putih', 1),
(33, 33, '5d822aadb12eb', '-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `category` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '1000',
  `photo` varchar(20) NOT NULL DEFAULT 'default.jpg',
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `name`, `category`, `price`, `stock`, `weight`, `photo`, `description`) VALUES
('5d8228d417112', 'Kingston DDR 2GB', 'RAM', 90000, 129, 1000, '5d8228d417112.jpg', 'Ready stock - siap kirim\r\n\r\nMemory Komputer DDR3 2 Gb\r\nMerek Kingstone pc 10600 dan 12800\r\nGaransi 1 tahun'),
('5d82298c41392', 'Silver necklace  alphabet B', 'Pendant', 120000, 176, 1000, '5d82298c41392.jpg', 'Kalung dan liontin\r\nBahan : 925 silver\r\nDetail :\r\nKalung sekaligus liontin: +- 3.7gr.\r\n\r\n#silver #silver925 #silverbanjarmasin #jawahir #kadounik #perak #perak925 #perakkalimantan #tokoperhiasan #perhiasanperak #perhiasan #925silver #perhiasankalimantan #perhiasanbanjarmasin #perakbanjarmasin #gift #silvergift #kalungperak #liontinperak #kalung #liontin #jawahirsilver #jawahirsilver #tokoperakjawahir #tokoperakbanjarmasin #tokoperakkalimantan #kalunghuruf #kalunghurufperak'),
('5d822a2a1fada', 'JBL GO - Kuning', 'speaker', 200000, 87, 1000, '5d822a2a1fada.jpg', 'Device Compatibility\r\nBluetoothYes\r\nGeneral Specifications\r\nWeight (kg)130 g\r\nBluetooth version4.1\r\nSupport:A2DP V1.2, AVRCP V1.4, HFP V1.6, HSP V1.2Yes\r\nAudio Specifications\r\nTransducer1 x 40mm\r\nOutput power3.0W\r\nFrequency response180Hz – 20kHz\r\nSignal-to-noise ratio?80dB\r\nDimensions\r\nDimensions (H x W x D)68.3 x 82.7 x 30.8 (mm)\r\nWeight130g\r\nBattery\r\nBattery typeLithium-ion polymer (3.7V, 600mAh)\r\nBattery charge time1.5 hours\r\nMusic playing timeup to 5 hours (varies by volume level and audio content)'),
('5d822aadb12eb', 'Bracelets red marjan', 'Bracelets', 500000, 170, 500, '5d822aadb12eb.jpg', 'lorem insum\r\n\r\nLogitech G304 Lightspeed Wireless Gaming Mouse\r\n\r\nFitur :\r\n\r\n1. Lightspeed Wireless untuk semua\r\nLightspeed Wireless Generasi Terbaru Kini Hadir untuk Semua Gamer\r\n2. Sensor Hero\r\nKinerja 12.000 DPI, Efisiensi 10x\r\n3. Lightspeed Wireless\r\nTanpa Kabel. Tanpa Batas.\r\n4. Daya tahan Baterai yang lebih lama\r\n250 Jam dengan 1 Baterai AA\r\n5. Ultra Ringan\r\nKebebasan Kecepatan Dalam Berat 99 Gram\r\n6. 6 Tombol yang dapat diprogram\r\nFleksibel dan Sederhana\r\n7. Advance Butoon Tensioning\r\nRespons Klik Superior\r\n8. Bermain dimana saja\r\nTempat Penyimpanan Receiver Nano USB Internal'),
('5d822b2a7f1c8', 'Logitech  K120', 'Keyboard', 350000, 65, 1000, '5d822b2a7f1c8.jpg', 'edited\r\naa'),
('5d9de36f9e6bc', 'silvernecklace pendant edited', 'ring', 100000, 105, 1000, '5d9de36f9e6bc.jpg', 'Salah satu koleksi dari jawahirsilver\r\nKalung dan liontin\r\nBahan : 925 silver\r\nDetail :\r\nKalung : +- 6,7 gr\r\nLiontin: +- 3,33 gr\r\n\r\n#silver #silver925 #silverbanjarmasin #jawahir #kadounik #perak #perak925 #perakkalimantan #tokoperhiasan #perhiasanperak #perhiasan #925silver #perhiasankalimantan #perhiasanbanjarmasin #perakbanjarmasin #gift #silvergift #kalungperak #liontinperak #kalung #liontin #jawahirsilver #jawahirsilver #tokoperakjawahir #tokoperakbanjarmasin #tokoperakkalimantan #kalunghuruf #kalunghurufperak'),
('5db1cb71395a6', 'adf', 'sadf', 23423, 2342, 234, '5db1cb71395a6.jpg', 'sdfdsafda');

-- --------------------------------------------------------

--
-- Table structure for table `toko_session`
--

CREATE TABLE `toko_session` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko_session`
--

INSERT INTO `toko_session` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('1ajhpvdv2tbjju03jua1nipktc0nukum', '::1', 1572862641, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323836323539373b757365726e616d657c733a353a2261646d696e223b747970657c733a353a2261646d696e223b66756c6c6e616d657c733a353a2261646d696e223b70686f6e657c733a31313a223038313731333133323332223b),
('1j3nbube76kgq9u6co8p8pc8rjk904h8', '::1', 1572746830, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323734363832333b6572726f727c733a31393a22506c65617365204c6f67696e20466972737421223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226e6577223b7d),
('31vkg9gumft2rs16qlp9pj1e618sbdpt', '::1', 1572746801, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323734363830313b757365726e616d657c733a353a22636f626132223b747970657c733a363a226d656d626572223b66756c6c6e616d657c733a353a22636f626132223b70686f6e657c733a393a22323334383239373839223b737563636573737c733a36323a22436865636b6f7574207375636365737321506c656173652070617920666972737421207468656e2075706c6f61642070726f6f6620696e2070686f746f21223b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d),
('3jdgjlav49sc4q5mr83uuo83tt3bumi3', '127.0.0.1', 1572748745, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323734383437323b757365726e616d657c733a353a22636f626132223b747970657c733a363a226d656d626572223b66756c6c6e616d657c733a353a22636f626132223b70686f6e657c733a393a22323334383239373839223b),
('5tlfibck4qr80me517cvcb190h4n8mnd', '127.0.0.1', 1572747380, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323734373338303b757365726e616d657c733a353a22636f626132223b747970657c733a363a226d656d626572223b66756c6c6e616d657c733a353a22636f626132223b70686f6e657c733a393a22323334383239373839223b737563636573737c733a36323a22436865636b6f7574207375636365737321506c656173652070617920666972737421207468656e2075706c6f61642070726f6f6620696e2070686f746f21223b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d),
('873h1fnsm9k67oukfpgo2es8hgngle3s', '127.0.0.1', 1572746792, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323734363739313b),
('cmjhkkaju02i5nc46l5cnbgj6rkd21fd', '::1', 1572761372, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323736313337323b757365726e616d657c733a353a2261646d696e223b747970657c733a353a2261646d696e223b66756c6c6e616d657c733a353a2261646d696e223b70686f6e657c733a31313a223038313731333133323332223b6572726f727c733a32363a22496e7075742053686f756c6420466f6c6c6f772052756c657321223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d),
('egvpqpt8rr4dqsiuihr4ldui82jru1k4', '::1', 1572746806, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323734363830313b757365726e616d657c733a353a22636f626132223b747970657c733a363a226d656d626572223b66756c6c6e616d657c733a353a22636f626132223b70686f6e657c733a393a22323334383239373839223b),
('feqesmgoskgb08osumr21lk4s3sr37jr', '::1', 1572761985, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323736313938353b757365726e616d657c733a353a2261646d696e223b747970657c733a353a2261646d696e223b66756c6c6e616d657c733a353a2261646d696e223b70686f6e657c733a31313a223038313731333133323332223b),
('kguodc7nuufr4coku09uesn29apjega4', '::1', 1572761036, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323736313033363b757365726e616d657c733a353a2261646d696e223b747970657c733a353a2261646d696e223b66756c6c6e616d657c733a353a2261646d696e223b70686f6e657c733a31313a223038313731333133323332223b),
('kmcs6f79vpgibo0o90u10e7f1p8c5euj', '127.0.0.1', 1572748472, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323734383437323b757365726e616d657c733a353a22636f626132223b747970657c733a363a226d656d626572223b66756c6c6e616d657c733a353a22636f626132223b70686f6e657c733a393a22323334383239373839223b636172745f636f6e74656e74737c613a333a7b733a31303a22636172745f746f74616c223b643a3439393030303b733a31313a22746f74616c5f6974656d73223b643a313b733a33323a223632393538323732616332633032353834666363623831666432613435386234223b613a383a7b733a323a226964223b733a31333a2235643832326161646231326562223b733a333a22717479223b643a313b733a353a227072696365223b643a3439393030303b733a343a226e616d65223b733a31393a2242726163656c657420726564206d61726a616e223b733a363a22776569676874223b693a313030303b733a373a226f7074696f6e73223b613a313a7b733a343a226e6f7465223b733a313a222d223b7d733a353a22726f776964223b733a33323a223632393538323732616332633032353834666363623831666432613435386234223b733a383a22737562746f74616c223b643a3439393030303b7d7d),
('lb8k7rfickl2bs8q27d18pco8sih5fff', '127.0.0.1', 1572747818, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323734373831383b757365726e616d657c733a353a22636f626132223b747970657c733a363a226d656d626572223b66756c6c6e616d657c733a353a22636f626132223b70686f6e657c733a393a22323334383239373839223b737563636573737c733a36323a22436865636b6f7574207375636365737321506c656173652070617920666972737421207468656e2075706c6f61642070726f6f6620696e2070686f746f21223b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d),
('mlbbf3t7ujcc5onvlhvpjkidoujqsuph', '::1', 1572762658, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323736323432363b757365726e616d657c733a353a2261646d696e223b747970657c733a353a2261646d696e223b66756c6c6e616d657c733a353a2261646d696e223b70686f6e657c733a31313a223038313731333133323332223b),
('ogt15fs6cf9s0s8o10risgglnpcqvtiu', '127.0.0.1', 1572747163, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323734373136333b757365726e616d657c733a353a2261646d696e223b747970657c733a353a2261646d696e223b66756c6c6e616d657c733a353a2261646d696e223b70686f6e657c733a31313a223038313731333133323332223b),
('q736f9j6hbda5st3i1qu1c634suq2tjl', '127.0.0.1', 1572745687, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323734353638373b757365726e616d657c733a353a22636f626132223b747970657c733a363a226d656d626572223b66756c6c6e616d657c733a353a22636f626132223b70686f6e657c733a393a22323334383239373839223b636172745f636f6e74656e74737c613a333a7b733a31303a22636172745f746f74616c223b643a39303030303b733a31313a22746f74616c5f6974656d73223b643a313b733a33323a223636656239353930393934346637623630383237653562363962303131353531223b613a383a7b733a323a226964223b733a31333a2235643832323864343137313132223b733a333a22717479223b643a313b733a353a227072696365223b643a39303030303b733a343a226e616d65223b733a31363a224b696e6773746f6e2044445220324742223b733a363a22776569676874223b693a313030303b733a373a226f7074696f6e73223b613a313a7b733a343a226e6f7465223b733a31333a2270616e6a616e6720313320636d223b7d733a353a22726f776964223b733a33323a223636656239353930393934346637623630383237653562363962303131353531223b733a383a22737562746f74616c223b643a39303030303b7d7d),
('te5u0gjfki9i2dmvo0t6tu4f80uubuk6', '127.0.0.1', 1572747173, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323734373136333b757365726e616d657c733a353a2261646d696e223b747970657c733a353a2261646d696e223b66756c6c6e616d657c733a353a2261646d696e223b70686f6e657c733a31313a223038313731333133323332223b),
('ub10h35ghm58sj7p9l9a08l4t29tmf9v', '127.0.0.1', 1572746777, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323734363737373b757365726e616d657c733a353a22636f626132223b747970657c733a363a226d656d626572223b66756c6c6e616d657c733a353a22636f626132223b70686f6e657c733a393a22323334383239373839223b),
('v14bu8hrnuudraru2mter1tdttl12c63', '::1', 1572761675, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537323736313637353b757365726e616d657c733a353a2261646d696e223b747970657c733a353a2261646d696e223b66756c6c6e616d657c733a353a2261646d696e223b70686f6e657c733a31313a223038313731333133323332223b);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `type` varchar(10) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `type`, `fullname`, `phone`) VALUES
('admin', 'admin', 'admin', 'admin', '08171313232'),
('benyaminfajri', 'ben', 'member', 'benyamin fajri', '023847234782'),
('benz', 'benz', 'member', 'benz', '0989032789327'),
('benz1', 'benz1', 'member', 'benyamin', '02934832748932'),
('coba', 'coba', 'member', 'coba', '1342'),
('coba2', 'coba2', 'member', 'coba2', '234829789'),
('coba3', 'coba3', 'member', 'coba3', '08982'),
('coba4', 'coba4', 'member', 'coba4', '08984'),
('member', 'member', 'member', 'member', '09018818283'),
('member2', 'member2', 'member', 'member2', '02834923784'),
('mike', 'mike', 'member', 'mike', '092389489323'),
('root', 'pemweb', 'member', 'root', '90284923');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`),
  ADD KEY `fk_invoice_user` (`username`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `fk_order_invoice` (`id_invoice`),
  ADD KEY `fk_order_product` (`id_product`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `toko_session`
--
ALTER TABLE `toko_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `fk_user_grup` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_invoice_user` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_invoice` FOREIGN KEY (`id_invoice`) REFERENCES `invoice` (`id_invoice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

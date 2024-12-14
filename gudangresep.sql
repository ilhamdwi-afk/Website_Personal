-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 05:14 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudangresep`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_acc`
--

CREATE TABLE `admin_acc` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `privilage` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_acc`
--

INSERT INTO `admin_acc` (`id`, `username`, `password`, `name`, `privilage`) VALUES
(1, 'gil123', '$2y$10$8oHZyJZyP.T4YbCiCAbf2.VyWQttnvsi4CO6adUssHLZkZKntJeJy', 'gilbert', 0),
(2, 'ipen123', '$2y$10$ZBG4GTX4ajo2DrnQzdu3IecLBKpWfX2rXitQEiyGPxsnQHYuFwLZO', 'Alloysius', 0),
(4, 'superadmin', '$2y$10$47KlOfq3kXOUN507kZvJoes.1Z8CV98bs/LW3bOX3ftl5yC91UbfG', 'Alloysius', 1),
(5, 'kar123', '123\r\n', 'karen', 0),
(6, 'admin2', 'admin2', 'admin2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `advanced_search`
--

CREATE TABLE `advanced_search` (
  `nama_resep` varchar(255) NOT NULL,
  `bahan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `id_resep` int(11) NOT NULL,
  `takaran` varchar(30) NOT NULL,
  `jenis` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`id_resep`, `takaran`, `jenis`) VALUES
(1, '1 piring', 'nasi'),
(1, '2 butir', 'telur'),
(1, '1 sdm', 'bawang merah goreng'),
(1, 'secukupnya', 'minyak goreng'),
(1, '2 siung ', 'bawang putih'),
(1, '1/2 sdt', 'garam'),
(1, '1/4 sdt', 'penyedap masakan'),
(1, '1 buah', 'tomat'),
(1, '7 buah', 'cabai rawit'),
(1, '3 buah', 'cabai keriting'),
(1, 'sejumput', 'lada bubuk'),
(2, '1/4 kg ', 'tepung tapioka cap tani, saya '),
(2, '1 batang ', 'daun bawang, potong tipis'),
(2, '2 bh ', 'daun sop, potong tipis kecil-k'),
(2, '1/2 sdm ', 'garam halus'),
(2, '1/2 sdm ', 'royko rasa ayam'),
(2, '1/2 sdt ', 'merica bubuk'),
(2, 'secukupnya', 'Cuka pempek, resep cuka bisa l'),
(2, '150 ml', 'air, hanya pake setengah saja'),
(2, 'secukupnya', 'minyak sayut'),
(3, '1 kg', 'ketan'),
(3, '250 gr', 'gula jawa'),
(8, '1 buah', 'teh'),
(8, '150 ml', 'air panas'),
(8, '1 sdm', 'gula'),
(9, 'asfoianfna', 'sfKJBFG'),
(9, 'aflbjfajk af', 'ALSBFK;sg'),
(5, '15 sdm', 'tepung terigu'),
(5, '15 sdm', 'tepung tapioka'),
(5, '20 buah', 'tahu pong'),
(5, '2 siung', 'bawang putih'),
(5, '1 batang', 'saung bawang'),
(5, 'secukupnya', 'garam, lada bubuk, dan micin'),
(5, '150 ml', 'air panas'),
(12, '60 mL ', 'susu cair'),
(12, '300 gram ', 'fillet ayam'),
(12, '3 sdm ', 'bawang merah goreng'),
(12, '60 mL ', 'susu cair'),
(12, '1 butir ', 'telur'),
(12, '½ sdt ', 'merica bubuk'),
(12, '½ sdt ', 'garam'),
(12, '½ sdt', ' kaldu ayam bubuk'),
(12, '2 sdm ', 'maizena'),
(12, ' secukupnya', 'Minyak'),
(13, '2 gelas', 'beras'),
(13, '1 ½ gelas ', 'santan'),
(13, '1 batang', 'serai'),
(13, '2 lembar', 'daun salam'),
(13, '2 lembar', 'daun jeruk'),
(13, '1 ruas', 'kunyit '),
(13, '1 sdt', 'garam'),
(13, '1 sdm', 'minyak'),
(14, '500 g', 'daging ayam'),
(14, '2 liter', 'air'),
(14, '1 ruas', 'kunyit'),
(14, '3 lembar', 'daun jeruk'),
(14, '2 batang', 'serai'),
(14, '2 lembar', 'daun salam'),
(14, '4 siung', 'bawang merah'),
(14, '3 siung', 'bawang putih'),
(14, '1 sdt', 'garam'),
(14, '1 sdt', 'merica'),
(14, '1 sdm', 'minyak goreng'),
(14, '2 buah', 'kentang (goreng dan potong dad'),
(15, '500 g', 'daging ayam'),
(15, '1 ½ sdm', 'kari bubuk'),
(15, '2 gelas', 'santan'),
(15, '3 siung', 'bawang putih'),
(15, '4 siung', 'bawang merah'),
(15, '1 sdt', 'garam'),
(15, '1 sdt', 'gula'),
(15, '2 sdm', 'minyak goreng'),
(15, '2 batang', 'serai'),
(15, '2 lembar', 'daun salam'),
(16, '500 g', 'daging sapi'),
(16, '1 liter', 'air'),
(16, '1 ruas', 'jahe'),
(16, '2 batang', 'serai'),
(16, '3 lembar', 'daun salam'),
(16, '4 siung', 'bawang merah'),
(16, '3 siung', 'bawang putih'),
(16, '2 sdm', 'minyak goreng'),
(16, '1 ½ gelas', 'santan'),
(16, '1 sdt', 'garam'),
(16, '1 sdt', 'merica'),
(16, '100 g', 'tomat'),
(16, '2 batang', 'daun bawang'),
(16, '1 sdm', 'bawang goreng'),
(17, '250 g', 'tepung terigu'),
(17, '100 g', 'mentega'),
(17, '100 g', 'mentega'),
(17, '100 g', 'gula merah'),
(17, '2 sdt', 'jahe '),
(17, '1 sdt', 'baking powder'),
(17, '1 butir', 'telur'),
(17, '2 sdm', 'madu'),
(18, '500 g', 'daging ayam'),
(18, '1 liter ', 'air'),
(18, '1 ruas', 'jahe'),
(18, '2 batang', 'serai'),
(18, '3 siung', 'bawang  putih'),
(18, '4 siung', 'bawang merah'),
(18, '1 sdt', 'garam'),
(18, '1 sdt', ' merica'),
(18, '100 g', 'wortel'),
(18, '100 g', 'kentang'),
(19, '500 g', 'daging sapi'),
(19, '1 ½ gelas', 'santan'),
(19, '1 ruas', 'jahe'),
(19, '4 siung', 'bawang merah'),
(19, '3 siung', 'bawang putih'),
(19, '2 batang', 'serai'),
(19, '2 lembar', 'daun salam'),
(19, '1 sdt', 'garam'),
(19, '1 sdm', 'gula merah'),
(19, '1 sdt ', 'merica'),
(20, '500 g', 'kentang'),
(20, '1 ruas', 'jahe'),
(20, '2 siung', 'bawang merah'),
(20, '2 siung', 'bawang putih'),
(20, '1 butir', 'telur'),
(20, '1 sdt', 'garam'),
(20, '1 sdt', 'merica'),
(20, 'secukupnya', 'minyak goreng'),
(21, '500 g', 'ayam'),
(21, '6 siung', 'bawang putih'),
(21, '2 sdm', 'minyak zaitun'),
(21, '1 sdt', 'garam'),
(21, '1 sdt', ' merica'),
(21, '1 sdm', 'kecap manis'),
(22, '200 g', 'kangkung'),
(22, '5 siung', 'bawang putih'),
(22, '2 sdm', 'minyak goreng'),
(22, '1 sdt', 'garam'),
(22, '1 sdt', 'merica'),
(23, '500 g', 'ikan'),
(23, '6 siung', 'bawang putih'),
(23, '2 sdm', 'minyak zaitun'),
(23, '1 sdt ', 'garam'),
(23, '1 sdt', 'merica'),
(23, '1 sdm', 'jeruk nipis'),
(24, '4 lembar', 'roti tawar'),
(24, '4 siung', 'bawang putih'),
(24, '50g', 'mentega'),
(24, '1 sdt', 'parsley kering'),
(25, '200 g', 'bayam'),
(25, '5 siung', 'bawang putih'),
(25, '2 sdm', 'minyak goreng'),
(25, '1 sdt', 'garam'),
(25, '1 sdt', 'merica'),
(26, '200 g', 'brokoli'),
(26, '5 siung', 'bawang putih'),
(26, '2 sdm', 'minyak goreng'),
(26, '1 sdt', 'garam'),
(26, '1 sdt', 'merica'),
(27, '200 g', 'jamur'),
(27, '5 siung', ' bawang putih'),
(27, '2 sdm', 'minyak goreng'),
(27, '1 sdt', 'garam'),
(27, '1 sdt', 'merica'),
(28, '200 g', 'terong'),
(28, '5 siung', 'bawang putih'),
(28, '2 sdm', 'minyak goreng'),
(28, '1 sdt', 'garam'),
(28, '1 sdt', 'merica'),
(29, '200 g', 'sawi putih'),
(29, '5 siung', 'bawang putih'),
(29, '2 sdm', 'minyak goreng'),
(29, '1 sdt', 'garam'),
(29, '1 sdt', 'merica');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `id_resep` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `reply` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `author`, `id_resep`, `comment`, `date_created`, `reply`) VALUES
(1, 'Anonymous', 8, 'trimakasih sangat membantu saja jadi bisa buat teh', '2022-12-21 01:55:04', NULL),
(2, 'admin', 1, 'asdfghjk', '2022-12-21 09:55:47', NULL),
(3, 'admin', 1, 'hgtyyff', '2022-12-21 09:55:55', 2),
(4, 'tipen123', 1, 'jskdjfasjd', '2022-12-21 09:57:34', NULL),
(5, 'adauhabda', 2, 'mantap', '2022-12-21 10:16:31', NULL),
(6, 'adauhabda', 2, 'bfabafbaf', '2022-12-21 10:16:37', 5),
(7, 'adauhabda', 2, 'yfsufbsub', '2022-12-21 10:16:44', NULL),
(8, 'Anonymous', 2, 'uhnuhnngdng', '2022-12-21 10:17:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`) VALUES
(1, 'makanan'),
(2, 'minuman');

-- --------------------------------------------------------

--
-- Table structure for table `langkah`
--

CREATE TABLE `langkah` (
  `id_resep` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `langkah` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `langkah`
--

INSERT INTO `langkah` (`id_resep`, `urutan`, `langkah`) VALUES
(1, 0, 'Siapkan semua bahan, kemudian panaskan minyak. '),
(1, 1, 'Masak telur orak-arik hingga matang. Sisihkan di tepi wajan. '),
(1, 2, 'Panaskan lagi sedikit minyak, tumis bumbu yang telah dihaluskan hingga harum dan matang.'),
(1, 3, 'Masukkan nasi ke dalam tumisan bumbu, aduk rata. Aduk rata juga bersama telur yang telah dimasak orak-arik.'),
(1, 4, 'Tambahkan taburan bawang merah goreng, koreksi rasa. '),
(1, 5, 'Angkat nasi goreng yang telah matang, sajikan selagi masih hangat bersama irisan buah mentimun, wortel dan daun bawang.'),
(2, 0, 'Buat dulu bahan biang, campurkan tepung tapioka+air larutkan terlebih dahulu, tambahkan merica, royco, garam, daun bawang dan daun sop. Campur rata'),
(2, 1, 'Didihkan di atas kompor aduk terus jangan smpe gosong, hingga adonan biang mengental dan air mengering'),
(2, 2, 'Masukan bahan biang di adonan tepung tapioka sisanya, aduk hingga semua tercampur rata, ulenin sampai kalis (jangan terlalu kalis biar ngak keras, cukup setengah kalis saja)'),
(2, 3, 'Lalu bentuk, berbentuk lempengan pempek, dan goreng pada minyak panas, lakukan sampai adonan habis'),
(2, 4, 'Tiriskan dan siap di santap. Selamat mencoba'),
(3, 0, 'di olah'),
(3, 1, 'di kukus'),
(3, 2, 'di makan'),
(8, 0, 'masukan teh ke air panas'),
(8, 1, 'masukan gula'),
(8, 2, 'tunggu hingga berubah menjadi kecoklatan dan aduk-aduk  '),
(9, 0, 'asoubbaigbaibg'),
(9, 1, 'asggkjabsgjb'),
(9, 2, 'as;jdbhsbg'),
(5, 0, 'Campurkan tepung terigu, garam, lada bubuk, penyedap, dan bawang putih yang sudah dihaluskan. Aduk rata.'),
(5, 1, 'Tambahkan sedikit demi sedikit air panas. Aduk pakai sendok.'),
(5, 2, 'Jika sudah tidak terlalu panas, boleh aduk dengan tangan sambil masukkan sedikit demi sedikit tepung tapioka. Uleni hingga kalis.'),
(5, 3, 'Belah tahu pong, masukkan adonan tepung ke dalam tahu. Ulangi hingga adonan habis.'),
(5, 4, 'Kukus cilok tahu hingga matang, sekitar 30 menit. Angkat dan sajikan.'),
(12, 0, 'Siapkan ayam fillet segar, potong-potong.'),
(12, 1, 'Campurkan ayam fillet, roti tawar yang sudah disobek-sobek, bawang goreng, telur, dan sisa bumbu lainnya ke dalam food processor.'),
(12, 2, 'Haluskan semua bahan menjadi adonan.'),
(12, 3, 'Buat bahan kulit dengan mencampurkan semua bahan, buat telur dadar. Sisihkan.'),
(12, 4, 'Ambil selembar telur dadar, simpan di alas aluminium foil, kemudian oleskan adonan merata, gulung.'),
(12, 5, 'Kukus adonan hingga matang. Setelah itu potong-potong dan siap diolah menjadi aneka menu atau dimakan langsung.'),
(13, 0, 'Cuci beras hingga bersih.'),
(13, 1, 'Tumis kunyit parut, daun salam, daun jeruk, dan serai dengan sedikit minyak hingga harum'),
(13, 2, 'Masukkan santan dan garam, aduk rata.'),
(13, 3, 'Tambahkan beras, aduk hingga santan meresap'),
(13, 4, 'Masak nasi dengan rice cooker atau di atas kompor hingga matang'),
(14, 0, 'Rebus ayam dengan air hingga empuk, tiriskan dan suwir-suwir'),
(14, 1, 'Tumis bawang merah, bawang putih, dan kunyit hingga harum.'),
(14, 2, 'Masukkan tumisan ke dalam kaldu ayam'),
(14, 3, 'Tambahkan daun jeruk, serai, daun salam, garam, dan merica. Masak hingga mendidih'),
(14, 4, 'Sajikan dengan tauge, kentang goreng, dan irisan daun bawang.'),
(15, 0, 'Tumis bawang putih, bawang merah, dan kunyit hingga harum'),
(15, 1, 'Masukkan kari bubuk, aduk rata.'),
(15, 2, 'Tambahkan ayam dan aduk hingga berubah warna.'),
(15, 3, 'Tuangkan santan, daun salam, dan serai. Masak hingga ayam empuk dan kuah mengental.'),
(15, 4, '. Bumbui dengan garam dan gula, aduk rata.'),
(16, 0, 'Rebus daging sapi dengan air hingga empuk. Tiriskan daging dan saring kaldu.'),
(16, 1, 'Tumis bawang merah, bawang putih, dan jahe hingga harum.'),
(16, 2, 'Masukkan tumisan ke dalam kaldu, tambahkan serai, daun salam, garam, dan merica.'),
(16, 3, 'Tambahkan daging sapi dan santan, masak hingga mendidih.'),
(16, 4, 'Sajikan dengan tomat, daun bawang, dan bawang goreng.'),
(17, 0, 'Kocok mentega dan gula merah hingga lembut.'),
(17, 1, 'Tambahkan telur dan madu, aduk rata.'),
(17, 2, 'Campurkan tepung terigu, jahe bubuk, dan baking powder. Aduk hingga rata.'),
(17, 3, 'Bentuk adonan menjadi bola-bola kecil dan pipihkan.'),
(17, 4, 'Panggang dalam oven pada suhu 180°C selama 15-20 menit.'),
(18, 0, 'Rebus ayam dengan air hingga empuk. Tiriskan ayam dan saring kaldu.'),
(18, 1, 'Tumis bawang putih, bawang merah, dan jahe hingga harum'),
(18, 2, 'Masukkan tumisan ke dalam kaldu ayam.'),
(18, 3, 'Tambahkan wortel, kentang, garam, dan merica. Masak hingga sayuran empuk.'),
(18, 4, 'Sajikan hangat.'),
(19, 0, 'Tumis bawang merah, bawang putih, dan jahe hingga harum'),
(19, 1, 'Masukkan daging sapi, aduk hingga berubah warna.'),
(19, 2, 'Tuangkan santan, serai, daun salam, garam, gula merah, dan merica. Masak hingga daging empuk dan bumbu meresap.'),
(19, 3, 'Sajikan dengan nasi putih.'),
(20, 0, 'Rebus kentang hingga empuk, tiriskan dan haluskan'),
(20, 1, 'Campurkan kentang halus dengan jahe parut, bawang merah, bawang putih, telur, garam, dan merica.'),
(20, 2, 'Bentuk adonan menjadi bulatan pipih.'),
(20, 3, ' Goreng dalam minyak panas hingga kecoklatan'),
(21, 0, 'Campurkan bawang putih, minyak zaitun, garam, merica, dan kecap manis. Lumuri ayam dengan campuran ini.'),
(21, 1, 'Diamkan selama 1 jam dalam kulkas.'),
(21, 2, 'Panggang ayam di oven pada suhu 180°C selama 40-50 menit hingga matang.'),
(22, 0, 'Panaskan minyak, tumis bawang putih hingga harum.'),
(22, 1, ' Masukkan kangkung, aduk cepat hingga layu.'),
(22, 2, 'Bumbui dengan garam dan merica, aduk rata.'),
(23, 0, 'Campurkan bawang putih, minyak zaitun, garam, merica, dan air jeruk nipis. Lumuri ikan dengan campuran ini.'),
(23, 1, 'Diamkan selama 30 menit.'),
(23, 2, ' Bakar ikan di atas bara api atau grill hingga matang.'),
(24, 0, 'Campurkan bawang putih dengan mentega.'),
(24, 1, 'Oleskan campuran mentega ke roti tawar.'),
(24, 2, 'Panggang roti dalam oven pada suhu 180°C selama 10-15 menit hingga kecoklatan.'),
(25, 0, 'Panaskan minyak, tumis bawang putih hingga harum.'),
(25, 1, 'Masukkan bayam, aduk hingga layu.'),
(25, 2, 'Bumbui dengan garam dan merica.'),
(26, 0, 'Panaskan minyak, tumis bawang putih hingga harum.'),
(26, 1, 'Masukkan brokoli, aduk hingga brokoli matang tetapi tetap renyah.'),
(26, 2, 'Bumbui dengan garam dan merica.'),
(27, 0, 'Panaskan minyak, tumis bawang putih hingga harum.'),
(27, 1, 'Masukkan jamur, aduk hingga matang.'),
(27, 2, 'Bumbui dengan garam dan merica.'),
(28, 0, 'Panaskan minyak, tumis bawang putih hingga harum.'),
(28, 1, 'Masukkan terong, aduk hingga terong matang.'),
(28, 2, 'Bumbui dengan garam dan merica.'),
(29, 0, 'Panaskan minyak, tumis bawang putih hingga harum.'),
(29, 1, 'Masukkan sawi putih, aduk hingga layu.'),
(29, 2, 'Bumbui dengan garam dan merica.');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `id_resep` int(11) NOT NULL,
  `nama_resep` varchar(30) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(255) NOT NULL,
  `author` varchar(30) NOT NULL,
  `likes` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `is_private` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`id_resep`, `nama_resep`, `deskripsi`, `id_kategori`, `tanggal`, `gambar`, `author`, `likes`, `views`, `is_approved`, `is_private`) VALUES
(1, 'nasi goreng ', 'Nasi goreng menjadi salah satu makanan enak yang disukai oleh sebagian besar masyarakat Indonesia. Seiring dengan perkembangan zaman, nasi goreng pun terus mengalami perkembangan. Nasi goreng juga mulai dikenal oleh masyarakat dunia. ', 1, '2022-12-21', 'lbwjouor3a5rl5o87.png', 'gil123', 1, 10, 1, 0),
(2, 'cireng', 'Cemilan paling mudah untuk di buat, kebetulan stok cuka masih banyak karena Kemarin sempat buat pempek, lalu pempeknya habis, buat cireng deh.\r\nSimpel tapi ngenyangin.', 1, '2022-12-21', 'lbwjwgrz39uk3k097.png', 'gil123', 0, 3, 1, 0),
(3, 'putu', 'putu merupakan makanan tradisional', 1, '2022-12-21', 'lbwk0hg73638qgbqu.png', 'gil123', 0, 1, 1, 0),
(5, 'cilok goreng', 'cilok alot', 1, '2022-12-21', 'lbwkfi5e2cigppamx.png', 'tipen123', 0, 2, 1, 0),
(8, 'teh', 'es teh merupakan minuman terlezat', 2, '2022-12-21', 'lbwl25ri1teluxwpe.png', 'tipen123', 0, 3, 1, 0),
(9, 'pecel ', 'afkshgsigbaibgashnabgs', 1, '2022-12-21', 'lbx214sp23jjp7avn.png', 'admin', 0, 0, 1, 0),
(12, 'Rolade Ayam', 'Menu ini bisa dijadikan frozen food yang dapat disimpan dan digunakan saat diperlukan, sangat praktis dan menghemat waktu.', 1, '2024-11-13', 'm3g375jh252lm3y1v.png', 'zara', 0, 2, 1, 0),
(13, 'Nasi Kuning', 'Informasi Gizi (per porsi):\r\nKalori: 250 kkal\r\nKarbohidrat: 20 g\r\nProtein: 25 g\r\nLemak: 10 g\r\n', 1, '2024-11-20', 'm3pxpng11di1uelj8.png', 'zara', 0, 1, 1, 0),
(14, 'Soto Ayam', 'Informasi Gizi (per porsi):\r\nKalori: 250 kkal\r\nKarbohidrat: 20 g\r\nProtein: 25 g\r\nLemak: 10 g\r\n', 1, '2024-11-20', 'm3pxzoaz1a1oqtije.png', 'zara', 0, 1, 1, 0),
(15, 'Kari Ayam', 'Informasi Gizi (per porsi):\r\n- Kalori: 300 kkal\r\n- Karbohidrat: 10 g\r\n- Protein: 30 g\r\n- Lemak: 20 g\r\n', 1, '2024-11-20', 'm3pyib1pmpv7pa7m.png', 'zara', 0, 0, 1, 0),
(16, 'Soto Betawi', 'Informasi Gizi (per porsi):\r\n- Kalori: 300 kkal\r\n- Karbohidrat: 10 g\r\n- Protein: 25 g\r\n- Lemak: 20 g\r\n', 1, '2024-11-20', 'm3pyufhe12kx6ovjd.png', 'zara', 0, 0, 1, 0),
(17, 'Kue Jahe', 'Informasi Gizi (per kue):\r\n- Kalori: 150 kkal\r\n- Karbohidrat: 20 g\r\n- Protein: 2 g\r\n- Lemak: 7 g\r\n', 1, '2024-11-20', 'm3pzk4jc36za2x4w0.png', 'zara', 0, 0, 1, 0),
(18, 'Sup Ayam', 'Informasi Gizi (per porsi):\r\n- Kalori: 200 kkal\r\n- Karbohidrat: 15 g\r\n- Protein: 20 g\r\n- Lemak: 8 g\r\n', 1, '2024-11-20', 'm3pzykc3wffxch7w.png', 'zara', 0, 0, 1, 0),
(19, 'Rendang', 'Informasi Gizi (per porsi):\r\n- Kalori: 350 kkal\r\n- Karbohidrat: 10 g\r\n- Protein: 30 g\r\n- Lemak: 25 g\r\n', 1, '2024-11-20', 'm3q076tb13wp3dqiy.png', 'zara', 0, 0, 1, 0),
(20, 'Perkedel', 'Informasi Gizi (per perkedel):\r\n- Kalori: 150 kkal\r\n- Karbohidrat: 20 g\r\n- Protein: 3 g\r\n- Lemak: 8 g\r\n', 1, '2024-11-20', 'm3q0pm9flowbxd61.png', 'zara', 0, 0, 1, 0),
(21, 'Ayam Panggang', 'Informasi Gizi (per porsi):\r\n- Kalori: 300 kkal\r\n- Karbohidrat: 10 g\r\n- Protein: 30 g\r\n- Lemak: 15 g\r\n', 1, '2024-11-20', 'm3q0vgop1rcxgnymp.png', 'zara', 0, 0, 1, 0),
(22, 'tumis kangkung', 'Informasi Gizi (per porsi):\r\n- Kalori: 80 kkal\r\n- Karbohidrat: 5 g\r\n- Protein: 3 g\r\n- Lemak: 6 g\r\n', 1, '2024-11-20', 'm3q1cq44mlptv36n.png', 'zara', 0, 0, 1, 0),
(23, 'Ikan Bakar', 'Informasi Gizi (per porsi):\r\n- Kalori: 250 kkal\r\n- Karbohidrat: 5 g\r\n- Protein: 30 g\r\n- Lemak: 12 g\r\n', 1, '2024-11-20', 'm3q1ipfywlr38x8a.png', 'zara', 0, 0, 1, 0),
(24, 'Roti Bawang Putih', 'Informasi Gizi (per lembar):\r\n- Kalori: 150 kkal\r\n- Karbohidrat: 20 g\r\n- Protein: 3 g\r\n- Lemak: 7 g\r\n', 1, '2024-11-20', 'm3q1rn8v1oivoj0a8.png', 'zara', 0, 0, 1, 0),
(25, 'Tumis Bayam', 'Informasi Gizi (per porsi):\r\n- Kalori: 70 kkal\r\n- Karbohidrat: 5 g\r\n- Protein: 3 g\r\n- Lemak: 5 g\r\n', 1, '2024-11-20', 'm3q1xc0d1k77dt0z7.png', 'zara', 0, 0, 1, 0),
(26, 'Tumis Brokoli', 'Informasi Gizi (per porsi):\r\n- Kalori: 80 kkal\r\n- Karbohidrat: 8 g\r\n- Protein: 4 g\r\n- Lemak: 5 g\r\n', 1, '2024-11-20', 'm3q272z31zxqoy3lf.png', 'zara', 0, 0, 1, 0),
(27, 'Tumis Jamur', 'Informasi Gizi (per porsi):\r\n- Kalori: 60 kkal\r\n- Karbohidrat: 8 g\r\n- Protein: 3 g\r\n- Lemak: 3 g\r\n', 1, '2024-11-20', 'm3q2f64j364klhpxr.png', 'zara', 0, 0, 1, 0),
(28, 'Tumis Terong', 'Informasi Gizi (per porsi):\r\n- Kalori: 80 kkal\r\n- Karbohidrat: 10 g\r\n- Protein: 2 g\r\n- Lemak: 5 g\r\n', 1, '2024-11-20', 'm3q2jkvegyun6jbw.png', 'zara', 0, 0, 1, 0),
(29, 'Tumis Sawi Putih', 'Informasi Gizi (per porsi):\r\n- Kalori: 70 kkal\r\n- Karbohidrat: 6 g\r\n- Protein: 2 g\r\n- Lemak: 5 g\r\n', 1, '2024-11-20', 'm3q35zz02hpgv5nkt.png', 'zara', 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `email`) VALUES
('adauhabda', '$2y$10$87OuXPnmhDJoIcl48AtrxuPFwJJUyBdpRFsDcFijYeFJpl9zBis56', 'karen', 'wkwk@email.com'),
('admin', '$2y$10$XnTpXHQuFABWxuuE1EaWX.H5kPBqEC/OEO7AZZAm71lA2nMhAT4j6', 'admin', 'admin@wkwk.com'),
('gil123', '$2y$10$5duuUsoJSkvIKPYO4ywX4uEhLFgwQ2AGF2.fYHFAjZWmRmK7sJpa6', 'gilbert', 'gil123@gmail.com'),
('tipen123', '$2y$10$QfthRAu/cP17azvhmyjAvuCoToh/nVcnbvexnR1DnikK5B4gcrz2W', 'karen', 'tipeen995@gmail.com'),
('zara', '$2y$10$xf4Dv5HoghEJ.RNL45fPSO5787C3.IMTWZY/zrVUT/UuIVuwcJjBe', 'zara', 'zaraa@outlook.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_acc`
--
ALTER TABLE `admin_acc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD KEY `id_resep` (`id_resep`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `reply` (`reply`),
  ADD KEY `comments_ibfk_1` (`id_resep`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `langkah`
--
ALTER TABLE `langkah`
  ADD KEY `id_resep` (`id_resep`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_acc`
--
ALTER TABLE `admin_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahan`
--
ALTER TABLE `bahan`
  ADD CONSTRAINT `bahan_ibfk_1` FOREIGN KEY (`id_resep`) REFERENCES `resep` (`id_resep`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_resep`) REFERENCES `resep` (`id_resep`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `reply` FOREIGN KEY (`reply`) REFERENCES `comments` (`comment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `langkah`
--
ALTER TABLE `langkah`
  ADD CONSTRAINT `langkah_ibfk_1` FOREIGN KEY (`id_resep`) REFERENCES `resep` (`id_resep`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `author` FOREIGN KEY (`author`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2019 at 02:06 AM
-- Server version: 8.0.13
-- PHP Version: 7.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paser_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `psr_agendas`
--

CREATE TABLE `psr_agendas` (
  `agenda_ID` bigint(20) NOT NULL,
  `agenda_slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `agenda_title` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `agenda_content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `agenda_start` date NOT NULL,
  `agenda_end` date NOT NULL,
  `agenda_author` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `agenda_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `psr_agendas`
--

INSERT INTO `psr_agendas` (`agenda_ID`, `agenda_slug`, `agenda_title`, `agenda_content`, `agenda_start`, `agenda_end`, `agenda_author`, `agenda_date`) VALUES
(1, 'hut-ke-59-kab-paser-tahun-2018', 'HUT Ke-59 Kab. Paser Tahun 2018', '<p>Memperingati HUT Ke 59 Kabupaten Paser menggelar acara EXPO 2018 untuk menghibur masyarakat kabupaten paser khususnya didaerah tanah grogot. Yang akan diselenggarakan pada:</p><p>Hari        : Minggu, 26 Desember 2018 s/d Senin, 31 Desember 2018</p><p>Lokasi    : Lapangan Gentung Temiang</p><p>Alamat    : Jl. Kesuma Bangsa Tanah Grogot Kab. Paser</p>', '2019-01-26', '2019-01-31', '0b51b370-f18a-11e8-bc79-86c342fc2ce6', '2019-01-01 05:15:27');

-- --------------------------------------------------------

--
-- Table structure for table `psr_categories`
--

CREATE TABLE `psr_categories` (
  `cat_ID` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_description` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_slug` varchar(105) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_role` int(11) NOT NULL,
  `cat_parent` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `psr_categories`
--

INSERT INTO `psr_categories` (`cat_ID`, `cat_name`, `cat_description`, `cat_slug`, `cat_role`, `cat_parent`, `cat_order`) VALUES
('1623ceac-2e5f-11e9-b36f-f127ee353d94', 'Berita', 'Berita-berita', 'berita', 0, '0', 0),
('68853a44-2e70-11e9-b36f-f127ee353d94', 'Pengumuman', 'Pengumuman', 'pengumuman', 0, '0', 0),
('b4385688-2e70-11e9-b36f-f127ee353d94', 'Artikel', '', 'artikel', 0, '0', 0),
('cd6f0034-2e70-11e9-b36f-f127ee353d94', 'Lainnya', '', 'lainnya', 0, '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `psr_comments`
--

CREATE TABLE `psr_comments` (
  `com_ID` bigint(20) NOT NULL,
  `com_post_ID` bigint(20) NOT NULL,
  `com_author` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `com_author_email` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `com_author_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `com_author_IP` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `com_date` datetime NOT NULL,
  `com_content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `com_approve` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `com_parent` int(11) NOT NULL,
  `user_ID` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `psr_documents`
--

CREATE TABLE `psr_documents` (
  `doc_ID` int(11) NOT NULL,
  `doc_slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `doc_title` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `doc_description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `doc_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `doc_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `doc_endorsement` date NOT NULL,
  `doc_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `doc_date` datetime NOT NULL,
  `doc_modified` datetime NOT NULL,
  `doc_author` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `doc_parent` int(11) NOT NULL,
  `doc_role` int(11) NOT NULL,
  `doc_view_count` int(11) NOT NULL,
  `doc_download_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `psr_documents`
--

INSERT INTO `psr_documents` (`doc_ID`, `doc_slug`, `doc_title`, `doc_description`, `doc_file`, `doc_url`, `doc_endorsement`, `doc_type`, `doc_date`, `doc_modified`, `doc_author`, `doc_parent`, `doc_role`, `doc_view_count`, `doc_download_count`) VALUES
(48, 'laporan-kinerja', 'Laporan Kinerja', '', '', '', '0000-00-00', 'folder', '2019-03-01 07:55:51', '0000-00-00 00:00:00', '0b51b370-f18a-11e8-bc79-86c342fc2ce6', 0, 0, 0, 0),
(49, 'tes-aja', 'Ini judul dokumennya', 'Ini keterangan singkat dari dokumennya', 'tes-aja.PDF', 'http://localhost/pasercms/assets/library/document/tes-aja.PDF', '2019-03-01', 'file', '2019-03-01 07:56:15', '2019-03-01 10:27:27', '0b51b370-f18a-11e8-bc79-86c342fc2ce6', 48, 1, 0, 3),
(50, 'ini-judul-yang-ke-2', 'Ini judul yang ke 2', 'Isinya judul yang kedua tester', 'ini-judul-yang-ke-2.pdf', 'http://localhost/pasercms/assets/library/document/ini-judul-yang-ke-2.pdf', '2019-03-01', 'file', '2019-03-01 10:20:25', '2019-03-01 10:27:07', '0b51b370-f18a-11e8-bc79-86c342fc2ce6', 48, 1, 0, 4),
(51, 'sakip-2018', 'SAKIP 2018', '', '', '', '0000-00-00', 'folder', '2019-03-13 08:23:56', '0000-00-00 00:00:00', '3ab298c1-1f76-11e9-a1c8-0e0f217a029b', 0, 0, 0, 0),
(52, 'sakip-2019', 'SAKIP 2019', '', '', '', '0000-00-00', 'folder', '2019-03-13 08:24:02', '0000-00-00 00:00:00', '3ab298c1-1f76-11e9-a1c8-0e0f217a029b', 0, 0, 0, 0),
(53, 'sakip-2017', 'SAKIP 2017', '', '', '', '0000-00-00', 'folder', '2019-03-13 08:24:08', '0000-00-00 00:00:00', '3ab298c1-1f76-11e9-a1c8-0e0f217a029b', 0, 0, 0, 0),
(54, 'judul-folder', 'Judul Folder', '', '', '', '0000-00-00', 'folder', '2019-03-13 09:08:36', '0000-00-00 00:00:00', '3ab298c1-1f76-11e9-a1c8-0e0f217a029b', 0, 1, 0, 0),
(55, 'tes-doc', 'Tes Doc', '', 'tes-doc.doc', 'http://localhost/disdukcapil.paserkab.go.id/assets/library/document/tes-doc.doc', '2019-03-13', 'file', '2019-03-13 09:22:55', '0000-00-00 00:00:00', '3ab298c1-1f76-11e9-a1c8-0e0f217a029b', 54, 2, 0, 1),
(56, 'tes-docx', 'Tes Docx', '', 'tes-docx.docx', 'http://localhost/disdukcapil.paserkab.go.id/assets/library/document/tes-docx.docx', '2019-03-13', 'file', '2019-03-13 09:33:59', '0000-00-00 00:00:00', '3ab298c1-1f76-11e9-a1c8-0e0f217a029b', 54, 2, 0, 0),
(57, 'tes-xls', 'Tes xls', '', 'tes-xls.xlsx', 'http://localhost/disdukcapil.paserkab.go.id/assets/library/document/tes-xls.xlsx', '2019-03-13', 'file', '2019-03-13 09:35:37', '0000-00-00 00:00:00', '3ab298c1-1f76-11e9-a1c8-0e0f217a029b', 54, 2, 0, 0),
(58, 'tes-zip', 'Tes ZIP', '', 'tes-zip.zip', 'http://localhost/disdukcapil.paserkab.go.id/assets/library/document/tes-zip.zip', '2019-03-13', 'file', '2019-03-13 09:36:59', '0000-00-00 00:00:00', '3ab298c1-1f76-11e9-a1c8-0e0f217a029b', 54, 2, 0, 0),
(59, 'tes-pdf', 'Tes PDF', '', 'tes-pdf.pdf', 'http://localhost/disdukcapil.paserkab.go.id/assets/library/document/tes-pdf.pdf', '2019-03-13', 'file', '2019-03-13 09:37:15', '0000-00-00 00:00:00', '3ab298c1-1f76-11e9-a1c8-0e0f217a029b', 54, 2, 0, 0),
(60, 'tes-pdf-beasr', 'Tes PDF besar', '', 'tes-pdf-beasr.PDF', 'http://localhost/disdukcapil.paserkab.go.id/assets/library/document/tes-pdf-beasr.PDF', '2019-03-13', 'file', '2019-03-13 09:40:40', '2019-03-13 09:56:51', '3ab298c1-1f76-11e9-a1c8-0e0f217a029b', 54, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `psr_galleries`
--

CREATE TABLE `psr_galleries` (
  `gal_ID` int(11) NOT NULL,
  `gal_slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gal_title` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gal_description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gal_file` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gal_date` datetime NOT NULL,
  `gal_modified` datetime NOT NULL,
  `gal_author` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gal_view_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `psr_libraries`
--

CREATE TABLE `psr_libraries` (
  `lib_ID` bigint(20) NOT NULL,
  `lib_date` datetime NOT NULL,
  `lib_modified` datetime DEFAULT NULL,
  `lib_author` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lib_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lib_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lib_content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lib_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lib_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `psr_libraries`
--

INSERT INTO `psr_libraries` (`lib_ID`, `lib_date`, `lib_modified`, `lib_author`, `lib_type`, `lib_name`, `lib_content`, `lib_file`, `lib_path`) VALUES
(18, '2019-02-05 08:29:25', '2019-02-05 08:53:51', '0b51b370-f18a-11e8-bc79-86c342fc2ce6', 'gambar', 'Logo Pemerintah Kab. Paser', 'Logo Resmi Pemerintah Kab. Paser', 'logopemerintahkabpaser.png', 'http://localhost/pasercms/assets/library/logopemerintahkabpaser.png'),
(19, '2019-02-06 11:01:03', NULL, '0b51b370-f18a-11e8-bc79-86c342fc2ce6', 'gambar', 'Logo Korpri', '', 'logokorpri.png', 'http://localhost/pasercms/assets/library/logokorpri.png'),
(22, '2019-02-09 10:48:20', NULL, '0b51b370-f18a-11e8-bc79-86c342fc2ce6', 'gambar', 'Pak Sahar', '', 'paksahar.jpg', 'http://localhost/pasercms/assets/library/paksahar.jpg'),
(24, '2019-02-18 02:04:30', NULL, '0b51b370-f18a-11e8-bc79-86c342fc2ce6', 'gambar', 'Disnakertrans', '', 'disnakertrans.jpg', 'http://localhost/pasercms/assets/library/disnakertrans.jpg'),
(25, '2019-02-18 02:05:28', NULL, '0b51b370-f18a-11e8-bc79-86c342fc2ce6', 'gambar', 'Disnakertrans', '', 'disnakertrans1.jpg', 'http://localhost/pasercms/assets/library/disnakertrans1.jpg'),
(26, '2019-02-24 08:53:18', NULL, '3ab298c1-1f76-11e9-a1c8-0e0f217a029b', 'gambar', 'Korpri', '', 'korpri.png', 'http://localhost/pasercms/assets/library/korpri.png'),
(27, '2019-02-24 08:53:49', NULL, '3ab298c1-1f76-11e9-a1c8-0e0f217a029b', 'gambar', 'Dayataka BW', '', 'dayatakabw.png', 'http://localhost/pasercms/assets/library/dayatakabw.png');

-- --------------------------------------------------------

--
-- Table structure for table `psr_links`
--

CREATE TABLE `psr_links` (
  `link_ID` int(11) NOT NULL,
  `link_title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link_date` datetime NOT NULL,
  `link_img_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `psr_menus`
--

CREATE TABLE `psr_menus` (
  `menu_ID` int(11) NOT NULL,
  `menu_role` int(11) NOT NULL,
  `menu_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_url` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `menu_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `psr_menus`
--

INSERT INTO `psr_menus` (`menu_ID`, `menu_role`, `menu_title`, `menu_url`, `menu_parent`, `menu_order`) VALUES
(17, 0, 'Profil', '#', 0, 1),
(18, 0, 'Hubungi Kami', 'http://localhost/pasercms/page/hubungi-kami', 0, 5),
(22, 0, 'Berita', 'http://localhost/pasercms/post', 0, 2),
(23, 1, 'Visi dan Misi', '', 17, 1),
(24, 0, 'Galeri', 'http://localhost/pasercms/gallery', 0, 3),
(25, 0, 'Dokumen', 'http://localhost/disdukcapil.paserkab.go.id/document', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `psr_options`
--

CREATE TABLE `psr_options` (
  `ID` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `opt_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `opt_slogan` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `opt_description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `opt_address` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `opt_telp` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `opt_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `opt_logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `opt_favicon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `opt_read` int(11) NOT NULL,
  `opt_facebook` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `opt_twitter` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `psr_options`
--

INSERT INTO `psr_options` (`ID`, `opt_name`, `opt_slogan`, `opt_description`, `opt_address`, `opt_telp`, `opt_email`, `opt_logo`, `opt_favicon`, `opt_read`, `opt_facebook`, `opt_twitter`) VALUES
('5b90126e-f559-11e8-8839-260fd810c6af', 'Disdukcapil Kab. Paser', 'Website Resmi Dinas Kependudukan dan Pencatatan Sipil Kabupaten Paser', 'Sebuah Website CMS yang dibangun oleh Tim Pengembangan TIK pada Dinas Komunikasi, Informatika, Statistik dan Persandian Kab. Paser', 'Jalan Kusuma Bangsa Komplek Perkantoran Gedung D Lantai 1 Kavling 2 Tanah Grogot, Kab. Paser', '(0543) 21826', 'no-reply@paserkab.go.id', '5b90126e-f559-11e8-8839-260fd810c6af.png', '5b90126e-f559-11e8-8839-260fd810c6af.png', 6, 'http://facebook.com/DiskominfostaperPaser', 'http://twitter.com/diskominfopaser');

-- --------------------------------------------------------

--
-- Table structure for table `psr_posts`
--

CREATE TABLE `psr_posts` (
  `post_ID` bigint(20) NOT NULL,
  `post_author` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_date` datetime NOT NULL,
  `post_content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_slug` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_modified` datetime NOT NULL,
  `post_parent` bigint(20) NOT NULL,
  `post_order` int(11) NOT NULL,
  `post_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_feature_image` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_category` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `post_headline` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_view_count` int(11) NOT NULL,
  `comment_status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comment_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `psr_posts`
--

INSERT INTO `psr_posts` (`post_ID`, `post_author`, `post_date`, `post_content`, `post_title`, `post_status`, `post_slug`, `post_modified`, `post_parent`, `post_order`, `post_type`, `post_feature_image`, `post_category`, `post_headline`, `post_view_count`, `comment_status`, `comment_count`) VALUES
(14, '0b51b370-f18a-11e8-bc79-86c342fc2ce6', '2019-02-18 03:08:00', '                                                                                                                                                                                                <div class=\"row\">\r\n	<div class=\"col-lg-6\">\r\n		<div>\r\n			<h4 class=\"mt-2 mb-1\"><strong>Kantor</strong></h4>\r\n			<ul class=\"list list-icons list-icons-style-2 mt-2\">\r\n				<li><i class=\"fas fa-map-marker-alt top-6\"></i> <strong class=\"text-dark\">Alamat:</strong> Jl. Noto Sunardi No.68 Tanah Grogot Kab. Paser kalimantan Timur</li>\r\n				<li><i class=\"fas fa-phone top-6\"></i> <strong class=\"text-dark\">Telepon:</strong> (0543) 21826</li>\r\n				<li><i class=\"fas fa-envelope top-6\"></i> <strong class=\"text-dark\">Email:</strong> <a href=\"mailto:no-reply@paserkab.go.id\">no-reply@paserkab.go.id</a></li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n	<div class=\"col-lg-6\">\r\n		<div>\r\n			<h4 class=\"mt-2 mb-1\">Jam <strong>Kerja</strong></h4>\r\n			<ul class=\"list list-icons list-dark mt-2\">\r\n				<li><i class=\"far fa-clock top-6\"></i> Senin - Kamis : <b>08.00wita s/d 16.00wita</b></li>\r\n				<li><i class=\"far fa-clock top-6\"></i> Jum\'at : <b>08.00wita s/d 11.30wita</b></li>\r\n				<li><i class=\"far fa-clock top-6\"></i> Sabtu - Minggu : <b>Tutup</b></li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n</div>                                                                                                                                                                        ', 'Hubungi Kami', 'telah_terbit', 'hubungi-kami', '2019-01-25 07:44:24', 0, 0, 'laman', 'http://localhost/pasercms/assets/library/disnakertrans.jpg', NULL, '0', 12, 'tertutup', 0),
(17, '0b51b370-f18a-11e8-bc79-86c342fc2ce6', '2019-02-12 02:16:00', '<p>asa dsfsd s dfsdfhjghj ghj</p>', 'Tes lagi 2', 'telah_terbit', 'tes-lagi', '2019-02-12 02:20:59', 0, 0, 'pos', 'http://localhost/pasercms/assets/library/logokorpri.png', 'cd6f0034-2e70-11e9-b36f-f127ee353d94', '0', 7, '0', 0),
(20, '0b51b370-f18a-11e8-bc79-86c342fc2ce6', '2019-02-12 11:03:00', '<p>Tes aja dulu</p>', 'Struktur Organisasi', 'telah_terbit', 'struktur-organisasi', '0000-00-00 00:00:00', 0, 0, 'laman', 'http://localhost/pasercms/assets/library/logopemerintahkabpaser.png', NULL, '', 0, 'tertutup', 0),
(21, '0b51b370-f18a-11e8-bc79-86c342fc2ce6', '2019-02-12 11:08:00', '<p>coba coba berita</p>', 'Berita Coba', 'telah_terbit', 'berita-coba', '2019-02-18 02:49:58', 0, 0, 'pos', 'http://localhost/pasercms/assets/library/disnakertrans1.jpg', 'b4385688-2e70-11e9-b36f-f127ee353d94,cd6f0034-2e70-11e9-b36f-f127ee353d94', 'on', 5, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `psr_slides`
--

CREATE TABLE `psr_slides` (
  `slide_ID` int(11) NOT NULL,
  `slide_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slide_title` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slide_description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slide_status` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slide_author` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slide_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `psr_slides`
--

INSERT INTO `psr_slides` (`slide_ID`, `slide_url`, `slide_title`, `slide_description`, `slide_status`, `slide_author`, `slide_date`) VALUES
(14, 'http://localhost/pasercms/assets/library/dayatakabw.png', 'Dayataka BW', '', 'aktif', '3ab298c1-1f76-11e9-a1c8-0e0f217a029b', '2019-03-10 07:07:11'),
(15, 'http://localhost/pasercms/assets/library/korpri.png', 'Korpri', '', 'aktif', '3ab298c1-1f76-11e9-a1c8-0e0f217a029b', '2019-03-10 07:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `psr_userrole`
--

CREATE TABLE `psr_userrole` (
  `usrole_ID` int(11) NOT NULL,
  `usrole_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usrole_slug` varchar(105) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `psr_userrole`
--

INSERT INTO `psr_userrole` (`usrole_ID`, `usrole_name`, `usrole_slug`) VALUES
(1, 'Administrator', 'administrator'),
(2, 'Penyunting', 'penyunting'),
(3, 'Penulis', 'penulis');

-- --------------------------------------------------------

--
-- Table structure for table `psr_users`
--

CREATE TABLE `psr_users` (
  `ID` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_login` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_cookie` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_fullname` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_zipcode` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_url` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_bio` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_registered` datetime NOT NULL,
  `user_super` int(11) NOT NULL DEFAULT '1',
  `user_role` int(11) NOT NULL,
  `user_status` int(11) NOT NULL,
  `user_avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime NOT NULL,
  `last_ip_address` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `psr_users`
--

INSERT INTO `psr_users` (`ID`, `user_login`, `user_password`, `user_cookie`, `user_fullname`, `user_address`, `user_zipcode`, `user_email`, `user_url`, `user_phone`, `user_bio`, `user_registered`, `user_super`, `user_role`, `user_status`, `user_avatar`, `display_name`, `last_login`, `last_ip_address`) VALUES
('0b51b370-f18a-11e8-bc79-86c342fc2ce6', 'yudhistry', '$2y$10$P7rx.9GOqxBeEOucSLDQAOHdaf1UO0o0PD4Muh5oWA7KtxcEcj4Ru', 'Y7eCLTndE3ihF02f7SbAulgXCk1KNE8MomkRMYDcawJlprh5T9UVxP6WQBfsHLSJFIIy2ctDZOaG1OBorKi6Xwjtx4dZ0nqN8Hvm', 'Yudhistira Ramadhany', 'Jl. DI. Panjaitan Perum Korpri Tapis Tanah Grogot Kab. Paser', '76211', 'yudhistry@gmail.com', 'http://yudhistry.blogspot.com', '0811537316', 'Tentang saya...', '2018-11-27 00:00:00', 0, 1, 0, '0b51b370-f18a-11e8-bc79-86c342fc2ce6.png', 'Yudhistira Ramadhany', '2018-11-27 00:00:00', ''),
('3ab298c1-1f76-11e9-a1c8-0e0f217a029b', 'admin', '$2y$10$6uQ3dadlbKJx.DO48JOm1ulhxMQ4TjiA72CZsOLvFY5vTjJxraPpK', '9ziRPvrxmp0VwIDzJK9QMYL3omduqZDGACcEI5VfW5PE88L1T0Kb2eFtAfbkxyMBnsWirBj4Cl6cjnpohSQSJueN6GyaXU4ZdTYX', 'Administrator', '', '', 'kominfo@paserkab.go.id', 'webnya', '098123', '', '2019-01-24 09:20:26', 1, 1, 0, '', 'Administrator', '0000-00-00 00:00:00', ''),
('73193aa8-0276-11e9-8ebd-081b72ea407f', 'operator', '$2y$10$mwOgLrcQzPoj.KkiASpNae5ZC4rPBgOTPrcrWIZx39UOfPvmIARRW', '', 'Operator Perangkat Daerah', '', '', 'kominfo@paserkab.go.id', '', '', '', '2018-12-18 03:38:57', 1, 3, 0, '', 'operator', '2019-01-24 00:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `psr_agendas`
--
ALTER TABLE `psr_agendas`
  ADD PRIMARY KEY (`agenda_ID`);

--
-- Indexes for table `psr_categories`
--
ALTER TABLE `psr_categories`
  ADD PRIMARY KEY (`cat_ID`);

--
-- Indexes for table `psr_comments`
--
ALTER TABLE `psr_comments`
  ADD PRIMARY KEY (`com_ID`);

--
-- Indexes for table `psr_documents`
--
ALTER TABLE `psr_documents`
  ADD PRIMARY KEY (`doc_ID`);

--
-- Indexes for table `psr_galleries`
--
ALTER TABLE `psr_galleries`
  ADD PRIMARY KEY (`gal_ID`);

--
-- Indexes for table `psr_libraries`
--
ALTER TABLE `psr_libraries`
  ADD PRIMARY KEY (`lib_ID`);

--
-- Indexes for table `psr_links`
--
ALTER TABLE `psr_links`
  ADD PRIMARY KEY (`link_ID`);

--
-- Indexes for table `psr_menus`
--
ALTER TABLE `psr_menus`
  ADD PRIMARY KEY (`menu_ID`);

--
-- Indexes for table `psr_options`
--
ALTER TABLE `psr_options`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `psr_posts`
--
ALTER TABLE `psr_posts`
  ADD PRIMARY KEY (`post_ID`),
  ADD UNIQUE KEY `post_slug` (`post_slug`);

--
-- Indexes for table `psr_slides`
--
ALTER TABLE `psr_slides`
  ADD PRIMARY KEY (`slide_ID`);

--
-- Indexes for table `psr_userrole`
--
ALTER TABLE `psr_userrole`
  ADD PRIMARY KEY (`usrole_ID`);

--
-- Indexes for table `psr_users`
--
ALTER TABLE `psr_users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `psr_agendas`
--
ALTER TABLE `psr_agendas`
  MODIFY `agenda_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `psr_comments`
--
ALTER TABLE `psr_comments`
  MODIFY `com_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `psr_documents`
--
ALTER TABLE `psr_documents`
  MODIFY `doc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `psr_galleries`
--
ALTER TABLE `psr_galleries`
  MODIFY `gal_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `psr_libraries`
--
ALTER TABLE `psr_libraries`
  MODIFY `lib_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `psr_links`
--
ALTER TABLE `psr_links`
  MODIFY `link_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `psr_menus`
--
ALTER TABLE `psr_menus`
  MODIFY `menu_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `psr_posts`
--
ALTER TABLE `psr_posts`
  MODIFY `post_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `psr_slides`
--
ALTER TABLE `psr_slides`
  MODIFY `slide_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `psr_userrole`
--
ALTER TABLE `psr_userrole`
  MODIFY `usrole_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

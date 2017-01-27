-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 27, 2017 at 08:31 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `renovatest`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabin`
--

CREATE TABLE `cabin` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Created` date NOT NULL,
  `Modified` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cabin`
--

INSERT INTO `cabin` (`id`, `Name`, `Created`, `Modified`, `is_deleted`) VALUES
('b0c7c658-c7ea-11e6-915d-39adba9ad86b', 'Single', '2016-12-21', '2016-12-21', 0),
('b6eb160c-c7ea-11e6-915d-39adba9ad86b', 'Double', '2016-12-21', '2016-12-21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
('04580784-cdc6-11e6-8e2f-269ea561f5ac', 'BODY TREATMENTS'),
('0dcaf61e-cdc6-11e6-8e2f-269ea561f5ac', 'SPA EXPERIENCES'),
('1072aa4c-c65a-11e6-915d-39adba9ad86b', 'FACIALS'),
('1b958688-c65a-11e6-915d-39adba9ad86b', 'MASSAGES'),
('1d33f6b4-cdc6-11e6-8e2f-269ea561f5ac', 'BODY SALON SERVICES'),
('2921548a-cdc6-11e6-8e2f-269ea561f5ac', 'SPECIAL FOR COUPLES'),
('34c3474e-cdc6-11e6-8e2f-269ea561f5ac', 'GAZEBO SERVICES'),
('dd528ccc-cdc5-11e6-8e2f-269ea561f5ac', 'HANDS & FEET TREATMENTS'),
('e7ac8484-cdc5-11e6-8e2f-269ea561f5ac', 'WAXING');

-- --------------------------------------------------------

--
-- Table structure for table `category_country`
--

CREATE TABLE `category_country` (
  `id` varchar(128) NOT NULL,
  `country_id` varchar(128) NOT NULL,
  `category_id` varchar(128) NOT NULL,
  `ordinal` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_country`
--

INSERT INTO `category_country` (`id`, `country_id`, `category_id`, `ordinal`) VALUES
('203b7aec-cdd7-11e6-8e2f-269ea561f5ac', '4e6b7b5e-c663-11e6-915d-39adba9ad86b', '04580784-cdc6-11e6-8e2f-269ea561f5ac', 3),
('3dbe23ae-c6ce-11e6-915d-39adba9ad86b', '4e6b7b5e-c663-11e6-915d-39adba9ad86b', '1b958688-c65a-11e6-915d-39adba9ad86b', 4),
('dabdf6d8-c6c0-11e6-915d-39adba9ad86b', '9dcd9ef6-c664-11e6-915d-39adba9ad86b', '1072aa4c-c65a-11e6-915d-39adba9ad86b', 0),
('dif96826-c6be-11e6-085d-39adba9ad86b', '4e6b7b5e-c663-11e6-915d-39adba9ad86b', '0dcaf61e-cdc6-11e6-8e2f-269ea561f5ac', 2),
('f0f96826-c6be-11e6-915d-39adba9ad86b', '4e6b7b5e-c663-11e6-915d-39adba9ad86b', '1072aa4c-c65a-11e6-915d-39adba9ad86b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `certificate_detail_service`
--

CREATE TABLE `certificate_detail_service` (
  `id` varchar(128) NOT NULL,
  `certificate_detail_id` varchar(128) NOT NULL,
  `service_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `certificate_detail_service`
--

INSERT INTO `certificate_detail_service` (`id`, `certificate_detail_id`, `service_id`) VALUES
('d8280972-e416-11e6-950e-4cfe156feb4d', 'd82771c4-e416-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b'),
('d8281444-e416-11e6-950e-4cfe156feb4d', 'd82771c4-e416-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b'),
('d8281bf6-e416-11e6-950e-4cfe156feb4d', 'd82771c4-e416-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b'),
('d82831fe-e416-11e6-950e-4cfe156feb4d', 'd8282470-e416-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b');

-- --------------------------------------------------------

--
-- Table structure for table `certificate_item`
--

CREATE TABLE `certificate_item` (
  `id` varchar(128) NOT NULL,
  `reservation_id` varchar(128) NOT NULL,
  `type` int(11) NOT NULL,
  `service_id` varchar(128) DEFAULT NULL,
  `value` double NOT NULL,
  `from_customer_name` varchar(100) NOT NULL,
  `to_customer_name` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `send_type` int(11) NOT NULL,
  `arrival` date NOT NULL,
  `departure` date NOT NULL,
  `other_fields` text NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `certificate_item`
--

INSERT INTO `certificate_item` (`id`, `reservation_id`, `type`, `service_id`, `value`, `from_customer_name`, `to_customer_name`, `message`, `send_type`, `arrival`, `departure`, `other_fields`, `enabled`, `created`, `modified`, `is_deleted`) VALUES
('0e2953c4-e416-11e6-950e-4cfe156feb4d', '0e226b68-e416-11e6-950e-4cfe156feb4d', 1, NULL, 52.5, 'Franklyn Perez', 'Dulce Perez', 'Esto es un regalo especial', 1, '2017-01-26', '2017-01-26', '', 1, '2017-01-26 22:23:25', '2017-01-26 22:23:25', 0),
('0e29e24e-e416-11e6-950e-4cfe156feb4d', '0e226b68-e416-11e6-950e-4cfe156feb4d', 1, NULL, 51, 'Gibran', 'Melissa', 'Felicidades', 1, '2017-01-26', '2017-01-26', '', 1, '2017-01-26 22:23:25', '2017-01-26 22:23:25', 0),
('1425b5d2-e417-11e6-950e-4cfe156feb4d', '14201820-e417-11e6-950e-4cfe156feb4d', 2, NULL, 50, 'Franklyn Perez', 'Dulce Perez', 'Un regalo', 1, '2017-01-26', '2017-01-26', '', 1, '2017-01-26 22:30:45', '2017-01-26 22:30:45', 0),
('14261ae0-e417-11e6-950e-4cfe156feb4d', '14201820-e417-11e6-950e-4cfe156feb4d', 2, NULL, 100, 'Gibran Turbi', 'Melissa Torres', 'Felicidades', 1, '2017-01-26', '2017-01-26', '', 1, '2017-01-26 22:30:45', '2017-01-26 22:30:45', 0),
('2e311e82-e4a6-11e6-950e-4cfe156feb4d', '2e2a9648-e4a6-11e6-950e-4cfe156feb4d', 2, NULL, 50, 'Franklyn Perez', 'Dulce Perez', 'Esto es un regalo', 1, '2017-01-27', '2017-01-27', '', 1, '2017-01-27 15:35:07', '2017-01-27 15:35:07', 0),
('2e31bf54-e4a6-11e6-950e-4cfe156feb4d', '2e2a9648-e4a6-11e6-950e-4cfe156feb4d', 2, NULL, 100, 'Gibran', 'Melissa ', 'Felicidade', 2, '2017-01-27', '2017-01-27', '', 1, '2017-01-27 15:35:07', '2017-01-27 15:35:07', 0),
('6f85b5fc-e404-11e6-950e-4cfe156feb4d', '6f7e9e52-e404-11e6-950e-4cfe156feb4d', 1, NULL, 79.5, 'Franklyn', 'Dulce', 'Hola', 1, '2017-01-26', '2017-01-26', '', 1, '2017-01-26 20:17:18', '2017-01-26 20:17:18', 0),
('9293c32e-e416-11e6-950e-4cfe156feb4d', '928ccc7c-e416-11e6-950e-4cfe156feb4d', 1, NULL, 79.5, 'Franklyn Perez', 'Dulce Perez', 'Un regalito', 1, '2017-01-26', '2017-01-26', '', 1, '2017-01-26 22:27:08', '2017-01-26 22:27:08', 0),
('92942616-e416-11e6-950e-4cfe156feb4d', '928ccc7c-e416-11e6-950e-4cfe156feb4d', 1, NULL, 52.5, 'Gibran Turbi', 'Melissa Torres', 'Felicidades', 1, '2017-01-26', '2017-01-26', '', 1, '2017-01-26 22:27:08', '2017-01-26 22:27:08', 0),
('9eca1dce-e415-11e6-950e-4cfe156feb4d', '9ec2756a-e415-11e6-950e-4cfe156feb4d', 1, NULL, 79.5, 'Perez', 'Dulce', 'Esto es un regalo especial', 1, '2017-01-26', '2017-01-26', '', 1, '2017-01-26 22:20:19', '2017-01-26 22:20:19', 0),
('9ecab1c6-e415-11e6-950e-4cfe156feb4d', '9ec2756a-e415-11e6-950e-4cfe156feb4d', 1, NULL, 25.5, 'Gibran', 'Meissa', 'Mensaje', 1, '2017-01-26', '2017-01-26', '', 1, '2017-01-26 22:20:19', '2017-01-26 22:20:19', 0),
('bff69f10-e404-11e6-950e-4cfe156feb4d', 'bff18eda-e404-11e6-950e-4cfe156feb4d', 2, NULL, 50, 'Franklyn', 'Dulce', 'Hola', 1, '2017-01-26', '2017-01-26', '', 1, '2017-01-26 20:19:33', '2017-01-26 20:19:33', 0),
('d82771c4-e416-11e6-950e-4cfe156feb4d', 'd8207662-e416-11e6-950e-4cfe156feb4d', 1, NULL, 79.5, 'Franklyn Perez', 'Dulce Perez', 'Un regalito', 1, '2017-01-26', '2017-01-26', '', 1, '2017-01-26 22:29:04', '2017-01-26 22:29:04', 0),
('d8282470-e416-11e6-950e-4cfe156feb4d', 'd8207662-e416-11e6-950e-4cfe156feb4d', 1, NULL, 25.5, 'Gibran Turbi', 'Melissa Torres', 'Felicidades', 1, '2017-01-26', '2017-01-26', '', 1, '2017-01-26 22:29:04', '2017-01-26 22:29:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` varchar(128) NOT NULL,
  `name` varchar(200) NOT NULL,
  `currency_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `currency_id`) VALUES
('4e6b7b5e-c663-11e6-915d-39adba9ad86b', 'ARUBA', '82ae10ae-c927-11e6-b56e-bd2377eb3445'),
('9dcd9ef6-c664-11e6-915d-39adba9ad86b', 'BAHAMAS', '82ae10ae-c927-11e6-b56e-bd2377eb3445'),
('a137dad4-c664-11e6-915d-39adba9ad86b', 'CAPE VERDE', '82ae10ae-c927-11e6-b56e-bd2377eb3445'),
('a74115e4-c664-11e6-915d-39adba9ad86b', 'COSTA RICA', '82ae10ae-c927-11e6-b56e-bd2377eb3445');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` varchar(128) NOT NULL,
  `name` varchar(100) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `symbol`, `created`) VALUES
('82ae10ae-c927-11e6-b56e-bd2377eb3445', 'USD', '$', '2016-12-23 00:00:00'),
('85a34aae-c927-11e6-b56e-bd2377eb3445', 'EUR', '€', '2016-12-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `address` varchar(200) NOT NULL,
  `notify_email` varchar(100) NOT NULL,
  `customer_service_name` varchar(100) NOT NULL,
  `open_at` time NOT NULL,
  `closed_At` time NOT NULL,
  `description` text NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `discount` double DEFAULT NULL,
  `active_discount` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `name`, `address`, `notify_email`, `customer_service_name`, `open_at`, `closed_At`, `description`, `enabled`, `created`, `is_deleted`, `discount`, `active_discount`) VALUES
('50c5f852-c667-11e6-915d-39adba9ad86b', 'RIU PALACE ARUBA', 'J.E. Irasquin Blvd 77 Palm Beach, Aruba.', 'info.aruba@renovaspa.com', 'Paula Casas', '09:00:00', '07:00:00', '', 1, '2016-12-23 00:00:00', 0, NULL, 0),
('f1c5f852-c667-11e6-915d-39adba9ad86b', 'RIU PALACE ANTILLAS', 'J.E. Irasquin Blvd 77 Palm Beach, Aruba.', 'info.aruba@renovaspa.com', 'Paula Casas', '09:00:00', '07:00:00', '<p>We&rsquo;re located inside the Riu Palace Antillas.</p> 		<p><br /> The spa will not be able to make reservations for you by phone.</p> 		<p>The Fitness Centre is open from 7:00 am to 8:00 pm.</p> 		<p>We do not close at any holidays.</p> 		<p>&nbsp; 		<p> 		<h3>SPA FACILITIES<br /><br /></h3> 		<p style="text-align: justify;">This elegant and modern Spa features different locations for you to enjoy all type of massages, body treatments and facials.<br /><br /></p> 		<p style="text-align: justify;">Two single treatment rooms and four double rooms for couple treatments are located inside the spa surrounded by a tranquil atmosphere.<br /><br /></p> 		<p style="text-align: justify;">Check out our Spa programs for singles or couples and have a spa experience as part of an unforgettable vacation!</p> 		<p style="text-align: justify;">One beautiful beach pavilion offers massages with an incredible ocean view during daytime or at night. <br /><br />Let the breeze be the background music during your relaxation massages!<br /><br /></p> 		<p style="text-align: justify;">We also offer manicure and pedicure services and a full beauty salon, <br />whereour expert stylists will make you look perfect and pamper you.<br /><br /></p> 		<p style="text-align: justify;">To wrap up your spa experience, before or after any spa treatment, Renova Spa features a steam room located inside the changing rooms for ladies and gentlemen respectively. <br /><br />These facilities in conjunction with the gym are available free of charge for guests of the all-inclusive program.<br /><br /></p> 		<p>&nbsp;The salon equipment includes:</p> 		<ul> 			<li>3 dressing tables</li> 			<li>1 hair washbasin</li> 			<li>2 manicure tables</li> 		<li>2 pedicure stations</li> 		</ul> 		<div>&nbsp;</div> 		<div>&nbsp;</div> 		<div>&nbsp;</div> 		<div>&nbsp;</div> 		<h3>FITNESS CENTER</h3> 		<p><span>The gym includes the following</span>&nbsp;exercise equipment:&nbsp;</p> 		<ul type="disc"> 			<li>mats&nbsp;</li> 			<li>pilates balls</li> 			<li>free weights</li> 			<li>2 abdominal crunches</li> 			<li>2 cross-trainers</li> 			<li>1 squat</li> 			<li>1 seated leg curl</li> 			<li>1 chest press</li> 			<li>1 pull down</li> 			<li>1 leg extension</li> 			<li>2&nbsp;95 R Lifecycle Bikes</li> 			<li>4&nbsp;x 95 X&nbsp;Eliptics</li> 			<li>5 Treadmills 5 x 95T</li> 		</ul>', 1, '2016-12-23 00:00:00', 0, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_region`
--

CREATE TABLE `hotel_region` (
  `id` varchar(128) NOT NULL,
  `hotel_id` varchar(128) NOT NULL,
  `region_id` varchar(128) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `active_discount` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel_region`
--

INSERT INTO `hotel_region` (`id`, `hotel_id`, `region_id`, `discount`, `active_discount`) VALUES
('06826546-c668-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 15, 1),
('10826546-c668-11e6-915d-39adba9ad86b', '50c5f852-c667-11e6-915d-39adba9ad86b', '8fc7e7b8-c659-11e6-915d-39adba9ad86b', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`, `created`) VALUES
('0a862dc6-c85c-11e6-915d-39adba9ad86b', 'Paypal', '2016-12-22 00:00:00'),
('ff97fa8e-c85b-11e6-915d-39adba9ad86b', 'Credit card', '2016-12-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` varchar(128) NOT NULL,
  `category_id` varchar(128) DEFAULT NULL,
  `hotel_id` varchar(128) DEFAULT NULL,
  `country_id` varchar(128) DEFAULT NULL,
  `region_id` varchar(128) DEFAULT NULL,
  `service_id` varchar(128) DEFAULT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `category_id`, `hotel_id`, `country_id`, `region_id`, `service_id`, `path`) VALUES
('5faa97b4-cb91-11e6-b56e-bd2377eb3445', NULL, 'f1c5f852-c667-11e6-915d-39adba9ad86b', NULL, NULL, NULL, 'antillas.jpg'),
('5faa97b4-cb91-11e6-b56e-bd3377eb4445', NULL, 'f1c5f852-c667-11e6-915d-39adba9ad86b', NULL, NULL, NULL, 'antillas3.jpg'),
('636b0b9a-cb91-11e6-b56e-bd2377eb3445', NULL, 'f1c5f852-c667-11e6-915d-39adba9ad86b', NULL, NULL, NULL, 'antillas2.jpg'),
('6faa97b4-cb98-11e6-b56e-bd2377eb3445', NULL, 'f1c5f852-c667-11e6-915d-39adba9ad86b', NULL, NULL, NULL, 'antillas4.jpg'),
('736b0b9a-cb91-11e6-b56e-bd2377eb3480', NULL, 'f1c5f852-c667-11e6-915d-39adba9ad86b', NULL, NULL, NULL, 'antillas-profile.jpg'),
('8480d8f0-c6e6-11e6-915d-39adba9ad86b', NULL, NULL, '4e6b7b5e-c663-11e6-915d-39adba9ad86b', NULL, NULL, 'aruba.jpg'),
('b4a87bac-c793-11e6-915d-39adba9ad84r', '1b958688-c65a-11e6-915d-39adba9ad86b', NULL, NULL, NULL, NULL, 'massages.jpg'),
('b4a87bac-c793-11e6-915d-39adba9ad86b', '1072aa4c-c65a-11e6-915d-39adba9ad86b', NULL, NULL, NULL, NULL, 'facial.jpg'),
('b4a87bac-c793-11e6-915d-39adba9ed867', '04580784-cdc6-11e6-8e2f-269ea561f5ac', NULL, NULL, NULL, NULL, 'body-treatment.jpg'),
('i7a87bac-c793-1126-915d-39adba9ed889', NULL, NULL, NULL, NULL, 'd877950a-c6ca-11e6-915d-39adba9ad86b', 'collagen-puls-facial.jpg'),
('u7a87bac-c793-11e6-915d-39adba9ed867', '0dcaf61e-cdc6-11e6-8e2f-269ea561f5ac', NULL, NULL, NULL, NULL, 'spa-experiences.jpg'),
('u7q87bac-c793-11e6-915d-39adba9ed810', '', NULL, NULL, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', NULL, 'palm-beach.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` varchar(128) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `name`, `country_id`) VALUES
('3d22c3ce-c65a-11e6-915d-39adba9ad86b', 'PARADISE ISLAND', '9dcd9ef6-c664-11e6-915d-39adba9ad86b'),
('8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'PALM BEACH', '4e6b7b5e-c663-11e6-915d-39adba9ad86b'),
('d912a97a-c664-11e6-915d-39adba9ad86b', 'ISLAND OF SAL', 'a137dad4-c664-11e6-915d-39adba9ad86b'),
('e47c5c2a-c664-11e6-915d-39adba9ad86b', 'ISLAND OF BOA VISTA', 'a137dad4-c664-11e6-915d-39adba9ad86b'),
('f42e9ce6-c664-11e6-915d-39adba9ad86b', 'GUANACASTE', 'a74115e4-c664-11e6-915d-39adba9ad86b');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` varchar(128) NOT NULL,
  `type` int(11) NOT NULL,
  `region_id` varchar(128) NOT NULL,
  `hotel_id` varchar(128) NOT NULL,
  `confirmation_number` varchar(200) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `arrival` date NOT NULL,
  `departure` date NOT NULL,
  `payment_method_id` varchar(128) DEFAULT NULL,
  `subtotal` double NOT NULL,
  `discount` double DEFAULT NULL,
  `total` double NOT NULL,
  `last_four_card_numbers` int(11) DEFAULT NULL,
  `status_id` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `type`, `region_id`, `hotel_id`, `confirmation_number`, `customer_name`, `customer_email`, `arrival`, `departure`, `payment_method_id`, `subtotal`, `discount`, `total`, `last_four_card_numbers`, `status_id`, `created`, `modified`, `is_deleted`) VALUES
('0e226b68-e416-11e6-950e-4cfe156feb4d', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'bd2dCA9e', NULL, NULL, '2017-01-26', '2017-01-26', NULL, 103.5, NULL, 103.5, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-01-26 22:23:25', '2017-01-26 22:23:25', 0),
('14201820-e417-11e6-950e-4cfe156feb4d', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'f7fa96A7', NULL, NULL, '2017-01-26', '2017-01-26', NULL, 150, NULL, 150, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-01-26 22:30:45', '2017-01-26 22:30:45', 0),
('2d5ff4b8-e403-11e6-950e-4cfe156feb4d', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'a4f2aa3a', NULL, NULL, '2017-01-26', '2017-01-26', NULL, 52.5, NULL, 52.5, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-01-26 20:08:17', '2017-01-26 20:08:17', 0),
('2e2a9648-e4a6-11e6-950e-4cfe156feb4d', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '9f8B39FG', NULL, NULL, '2017-01-27', '2017-01-27', NULL, 150, NULL, 150, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-01-27 15:35:07', '2017-01-27 15:35:07', 0),
('6a1e53ba-e415-11e6-950e-4cfe156feb4d', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '7ecA6F4d', NULL, NULL, '2017-01-26', '2017-01-26', NULL, 60, NULL, 52.5, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-01-26 22:18:50', '2017-01-26 22:18:50', 0),
('6f7e9e52-e404-11e6-950e-4cfe156feb4d', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'F3D53a5c', NULL, NULL, '2017-01-26', '2017-01-26', NULL, 79.5, NULL, 79.5, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-01-26 20:17:18', '2017-01-26 20:17:18', 0),
('928ccc7c-e416-11e6-950e-4cfe156feb4d', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'FAa22548', NULL, NULL, '2017-01-26', '2017-01-26', NULL, 132, NULL, 132, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-01-26 22:27:08', '2017-01-26 22:27:08', 0),
('9ec2756a-e415-11e6-950e-4cfe156feb4d', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'D32d6bG3', NULL, NULL, '2017-01-26', '2017-01-26', NULL, 105, NULL, 105, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-01-26 22:20:19', '2017-01-26 22:20:19', 0),
('bff18eda-e404-11e6-950e-4cfe156feb4d', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '7AaC595d', NULL, NULL, '2017-01-26', '2017-01-26', NULL, 50, NULL, 50, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-01-26 20:19:33', '2017-01-26 20:19:33', 0),
('d8207662-e416-11e6-950e-4cfe156feb4d', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'A1egADff', NULL, NULL, '2017-01-26', '2017-01-26', NULL, 105, NULL, 105, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-01-26 22:29:04', '2017-01-26 22:29:04', 0),
('ef2ae1aa-e405-11e6-950e-4cfe156feb4d', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'f6FgDCF7', NULL, NULL, '2017-01-26', '2017-01-26', NULL, 60, NULL, 52.5, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-01-26 20:28:01', '2017-01-26 20:28:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_item`
--

CREATE TABLE `reservation_item` (
  `id` varchar(128) NOT NULL,
  `reservation_id` varchar(128) NOT NULL,
  `cart_item_id` varchar(128) NOT NULL,
  `service_id` varchar(128) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `prefered_date` date NOT NULL,
  `prefered_time` time NOT NULL,
  `price` double NOT NULL,
  `cabin_id` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation_item`
--

INSERT INTO `reservation_item` (`id`, `reservation_id`, `cart_item_id`, `service_id`, `customer_name`, `prefered_date`, `prefered_time`, `price`, `cabin_id`, `created`, `modified`, `is_deleted`) VALUES
('6a244522-e415-11e6-950e-4cfe156feb4d', '6a1e53ba-e415-11e6-950e-4cfe156feb4d', '5987b924-e415-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', 'Julio Perez', '2017-01-26', '12:00:00', 27, 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', '2017-01-26 22:18:50', '2017-01-26 22:18:50', 0),
('6a245148-e415-11e6-950e-4cfe156feb4d', '6a1e53ba-e415-11e6-950e-4cfe156feb4d', '5987fe70-e415-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Jon Doe', '2017-01-28', '13:30:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-01-26 22:18:50', '2017-01-26 22:18:50', 0),
('ef310a9e-e405-11e6-950e-4cfe156feb4d', 'ef2ae1aa-e405-11e6-950e-4cfe156feb4d', 'ee62a92a-e404-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', 'Jose', '2017-01-26', '12:00:00', 27, 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', '2017-01-26 20:28:02', '2017-01-26 20:28:02', 0),
('ef311818-e405-11e6-950e-4cfe156feb4d', 'ef2ae1aa-e405-11e6-950e-4cfe156feb4d', 'ee6310c2-e404-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Salcedo', '2017-01-26', '12:00:00', 25.5, 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', '2017-01-26 20:28:02', '2017-01-26 20:28:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` varchar(128) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`) VALUES
('1a298596-c659-11e6-915d-39adba9ad86b', 'Flash Facial'),
('9a263a3e-c659-11e6-915d-39adba9ad86b', 'Vita Cura - Anti Aging Facial'),
('9e298596-c659-11e6-915d-39adba9ad86b', 'MASSAGES'),
('d877950a-c6ca-11e6-915d-39adba9ad86b', 'Collagen Puls Facial');

-- --------------------------------------------------------

--
-- Table structure for table `service_category_hotel`
--

CREATE TABLE `service_category_hotel` (
  `id` varchar(128) NOT NULL,
  `service_id` varchar(128) NOT NULL,
  `category_id` varchar(128) NOT NULL,
  `hotel_id` varchar(128) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_category_hotel`
--

INSERT INTO `service_category_hotel` (`id`, `service_id`, `category_id`, `hotel_id`, `order`) VALUES
('24799bba-c6cb-11e6-915d-39adba9ad86b', 'd877950a-c6ca-11e6-915d-39adba9ad86b', '1072aa4c-c65a-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 0),
('a79eb382-c65b-11e6-915d-39adba9ad86b', '9a263a3e-c659-11e6-915d-39adba9ad86b', '1072aa4c-c65a-11e6-915d-39adba9ad86b', '50c5f852-c667-11e6-915d-39adba9ad86b', 0),
('d09eb382-c65b-11e6-915d-39adba9ad86b', '9a263a3e-c659-11e6-915d-39adba9ad86b', '1072aa4c-c65a-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 0),
('e0947c0e-c65b-11e6-915d-39adba9ad86b', '1a298596-c659-11e6-915d-39adba9ad86b', '1072aa4c-c65a-11e6-915d-39adba9ad86b', '50c5f852-c667-11e6-915d-39adba9ad86b', 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_price`
--

CREATE TABLE `service_price` (
  `id` varchar(128) NOT NULL,
  `service_id` varchar(128) NOT NULL,
  `hotel_region_id` varchar(128) NOT NULL,
  `price` double NOT NULL,
  `discount` double DEFAULT NULL,
  `active_discount` tinyint(1) DEFAULT '0',
  `ignore_hotel_discount` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_price`
--

INSERT INTO `service_price` (`id`, `service_id`, `hotel_region_id`, `price`, `discount`, `active_discount`, `ignore_hotel_discount`) VALUES
('eb27b35c-de84-11e6-afcd-b6836d99b5c1', 'd877950a-c6ca-11e6-915d-39adba9ad86b', '06826546-c668-11e6-915d-39adba9ad86b', 30, 10, 1, 1),
('fdff274e-de84-11e6-afcd-b6836d99b5c1', '9a263a3e-c659-11e6-915d-39adba9ad86b', '06826546-c668-11e6-915d-39adba9ad86b', 30, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_region`
--

CREATE TABLE `service_region` (
  `id` varchar(128) NOT NULL,
  `service_id` varchar(128) NOT NULL,
  `region_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_region`
--

INSERT INTO `service_region` (`id`, `service_id`, `region_id`) VALUES
('c36bbb94-c659-11e6-915d-39adba9ad86b', '9a263a3e-c659-11e6-915d-39adba9ad86b', '8fc7e7b8-c659-11e6-915d-39adba9ad86b');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` varchar(128) NOT NULL,
  `session` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`id`, `session`, `created`, `is_deleted`) VALUES
('057ad2ce-e417-11e6-950e-4cfe156feb4d', 'BKWHh7CjHWGKfqiuiEzGVLmeYGUoakpgBNk30Ne0', '2017-01-26 22:30:20', 0),
('0c68201a-e402-11e6-950e-4cfe156feb4d', 'My0FSdOGbRjOvfLg7o7BCw0or3F5dwhIOW42ymT1', '2017-01-26 20:00:13', 0),
('132e7e9e-e3f8-11e6-950e-4cfe156feb4d', 'A6cGMjlS4weuYhxw4KYLtSOpd3lBH5J3EbN6WXFz', '2017-01-26 18:48:49', 0),
('20131164-e403-11e6-950e-4cfe156feb4d', 'knOoFd79UevIhssAQ8XO7Y4oTTs3yeDSh0k9nDaU', '2017-01-26 20:07:55', 0),
('25aa3eb2-e404-11e6-950e-4cfe156feb4d', '3c2yHR5SC2jfjf5Fz2gyeFWYQlw9raHITtxPnLlF', '2017-01-26 20:15:14', 0),
('43a4bf2e-e40d-11e6-950e-4cfe156feb4d', '1jgPahb48Uxw08vXy83CI3X12fkB1jhbCwxRu1zT', '2017-01-26 21:20:30', 0),
('4c36ae82-e407-11e6-950e-4cfe156feb4d', 'BL5gyaYjij5QrseVXqf8QLsAY5L3aQkaGTzqXxm5', '2017-01-26 20:37:47', 0),
('5987c158-e415-11e6-950e-4cfe156feb4d', 'zEfFoUAOP8UW0Xn9E5ucATPcXZwTQPM3LM8jfzm3', '2017-01-26 22:18:22', 0),
('68b32f48-e4a4-11e6-950e-4cfe156feb4d', 'Vk5r7Ls6YJNs4UukEjozoaosUHl98b989FdpBlaC', '2017-01-27 15:22:26', 0),
('75990e50-e416-11e6-950e-4cfe156feb4d', 'RHa9QqMDwjYeu8n9TdgFZepgYhZmcSZktlaHIFOU', '2017-01-26 22:26:19', 0),
('7e52b5b0-e401-11e6-950e-4cfe156feb4d', 'ZOvv9wJv5qvMXNTx9wN2n5ZeuGEWIhsWTK22iYxZ', '2017-01-26 19:56:14', 0),
('8373d3d0-e415-11e6-950e-4cfe156feb4d', 'lgKljkXnXtGBdhiefmFYf6YVAHe9zYp9JQ74dLKF', '2017-01-26 22:19:33', 0),
('85eeb4e6-e3ec-11e6-950e-4cfe156feb4d', 'FFLcoB6AtxSljC4JovgVJfoayacRGzhEDwskl9ww', '2017-01-26 17:26:07', 0),
('afbb1f88-e3fd-11e6-950e-4cfe156feb4d', '7bvh8qE8HTjp4I8Cy8MHzjIy4pFTfyyqUyb40VZU', '2017-01-26 19:28:59', 0),
('b95348f2-e404-11e6-950e-4cfe156feb4d', 'INRYpdywa2TeZ1HlPCw0EMDjGQjK7PwRu1TUAfJU', '2017-01-26 20:19:22', 0),
('bbd5c6c6-e4a5-11e6-950e-4cfe156feb4d', 'p7B31MozTBfinsx67ysPtakPwxarc23S8dD7UX31', '2017-01-27 15:31:55', 0),
('bed2ee42-e416-11e6-950e-4cfe156feb4d', 'WBhwdiLMEjWBCZmfik8zPO8pIbQcLTIbPVPSjLns', '2017-01-26 22:28:22', 0),
('d4dc79a4-e404-11e6-950e-4cfe156feb4d', 'oqMUXREyHwr3TKB2jbvzzj96aqS7mT5xTVFCOjPu', '2017-01-26 20:20:08', 0),
('dc70a4d0-e3fd-11e6-950e-4cfe156feb4d', 'ikliiEfTshXcGzBllGNy4ErnkEt8ecYWmqkTqfmm', '2017-01-26 19:30:14', 0),
('ee12032e-e415-11e6-950e-4cfe156feb4d', '9UXGiTTsD8SQJ325BqsTmjRMSlQQP73R1nnkcavD', '2017-01-26 22:22:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart_item`
--

CREATE TABLE `shopping_cart_item` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cart_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cabin_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `PreferedDate` date DEFAULT NULL,
  `PreferedTime` time DEFAULT NULL,
  `Type` int(11) NOT NULL,
  `certificate_number` int(11) DEFAULT NULL,
  `value` decimal(10,0) DEFAULT NULL,
  `Created` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shopping_cart_item`
--

INSERT INTO `shopping_cart_item` (`id`, `cart_id`, `service_id`, `customer_name`, `cabin_id`, `Quantity`, `PreferedDate`, `PreferedTime`, `Type`, `certificate_number`, `value`, `Created`, `is_deleted`) VALUES
('057cac70-e417-11e6-950e-4cfe156feb4d', '057ad2ce-e417-11e6-950e-4cfe156feb4d', NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '50', '2017-01-26', 0),
('057cb77e-e417-11e6-950e-4cfe156feb4d', '057ad2ce-e417-11e6-950e-4cfe156feb4d', NULL, NULL, NULL, 1, NULL, NULL, 2, 2, '100', '2017-01-26', 0),
('43a4b312-e40d-11e6-950e-4cfe156feb4d', '43a4bf2e-e40d-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-01-26', 0),
('4c38d0ea-e407-11e6-950e-4cfe156feb4d', '4c36ae82-e407-11e6-950e-4cfe156feb4d', NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '50', '2017-01-26', 0),
('4c38dd74-e407-11e6-950e-4cfe156feb4d', '4c36ae82-e407-11e6-950e-4cfe156feb4d', NULL, NULL, NULL, 1, NULL, NULL, 2, 2, '100', '2017-01-26', 0),
('5987b924-e415-11e6-950e-4cfe156feb4d', '5987c158-e415-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', 'Julio Perez', 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', 1, '2017-01-26', '12:00:00', 1, NULL, NULL, '2017-01-26', 0),
('5987fe70-e415-11e6-950e-4cfe156feb4d', '5987c158-e415-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Jon Doe', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-01-28', '13:30:00', 1, NULL, NULL, '2017-01-26', 0),
('68b75f64-e4a4-11e6-950e-4cfe156feb4d', '68b32f48-e4a4-11e6-950e-4cfe156feb4d', NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '50', '2017-01-27', 0),
('68b77030-e4a4-11e6-950e-4cfe156feb4d', '68b32f48-e4a4-11e6-950e-4cfe156feb4d', NULL, NULL, NULL, 1, NULL, NULL, 2, 2, '100', '2017-01-27', 0),
('75990540-e416-11e6-950e-4cfe156feb4d', '75990e50-e416-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-01-26', 0),
('7599197c-e416-11e6-950e-4cfe156feb4d', '75990e50-e416-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-01-26', 0),
('759958e2-e416-11e6-950e-4cfe156feb4d', '75990e50-e416-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-01-26', 0),
('7c0f361a-e416-11e6-950e-4cfe156feb4d', '75990e50-e416-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 2, NULL, '2017-01-26', 0),
('7c0f7968-e416-11e6-950e-4cfe156feb4d', '75990e50-e416-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 2, NULL, '2017-01-26', 0),
('8373cc1e-e415-11e6-950e-4cfe156feb4d', '8373d3d0-e415-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-01-26', 0),
('8373dcea-e415-11e6-950e-4cfe156feb4d', '8373d3d0-e415-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-01-26', 0),
('83742bb4-e415-11e6-950e-4cfe156feb4d', '8373d3d0-e415-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-01-26', 0),
('8674c0e4-e415-11e6-950e-4cfe156feb4d', '8373d3d0-e415-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 2, NULL, '2017-01-26', 0),
('bbd797c6-e4a5-11e6-950e-4cfe156feb4d', 'bbd5c6c6-e4a5-11e6-950e-4cfe156feb4d', NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '50', '2017-01-27', 0),
('bbd7a4d2-e4a5-11e6-950e-4cfe156feb4d', 'bbd5c6c6-e4a5-11e6-950e-4cfe156feb4d', NULL, NULL, NULL, 1, NULL, NULL, 2, 2, '100', '2017-01-27', 0),
('bed2e1e0-e416-11e6-950e-4cfe156feb4d', 'bed2ee42-e416-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-01-26', 0),
('bed30080-e416-11e6-950e-4cfe156feb4d', 'bed2ee42-e416-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-01-26', 0),
('bed3554e-e416-11e6-950e-4cfe156feb4d', 'bed2ee42-e416-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-01-26', 0),
('c2b51dc8-e416-11e6-950e-4cfe156feb4d', 'bed2ee42-e416-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 2, NULL, '2017-01-26', 0),
('ee11f80c-e415-11e6-950e-4cfe156feb4d', 'ee12032e-e415-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-01-26', 0),
('ee1257ac-e415-11e6-950e-4cfe156feb4d', 'ee12032e-e415-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-01-26', 0),
('ee62a92a-e404-11e6-950e-4cfe156feb4d', 'd4dc79a4-e404-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', 'Jose', 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', 1, '2017-01-26', '12:00:00', 1, NULL, NULL, '2017-01-26', 0),
('ee6310c2-e404-11e6-950e-4cfe156feb4d', 'd4dc79a4-e404-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Salcedo', 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', 1, '2017-01-26', '12:00:00', 1, NULL, NULL, '2017-01-26', 0),
('f12c9484-e415-11e6-950e-4cfe156feb4d', 'ee12032e-e415-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 2, NULL, '2017-01-26', 0),
('f12ca97e-e415-11e6-950e-4cfe156feb4d', 'ee12032e-e415-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 2, NULL, '2017-01-26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
('5ed5c774-c7bc-11e6-915d-39adba9ad86b', 'Pending'),
('6790297c-c7bc-11e6-915d-39adba9ad86b', 'Approved'),
('6b5263c2-c7bc-11e6-915d-39adba9ad86b', 'Completed'),
('6f646118-c7bc-11e6-915d-39adba9ad86b', 'Incompleted'),
('73b45b4c-c7bc-11e6-915d-39adba9ad86b', 'Canceled'),
('80becb88-c7bc-11e6-915d-39adba9ad86b', 'Declined');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabin`
--
ALTER TABLE `cabin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_country`
--
ALTER TABLE `category_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate_detail_service`
--
ALTER TABLE `certificate_detail_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate_item`
--
ALTER TABLE `certificate_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_region`
--
ALTER TABLE `hotel_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation_item`
--
ALTER TABLE `reservation_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_category_hotel`
--
ALTER TABLE `service_category_hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_price`
--
ALTER TABLE `service_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_region`
--
ALTER TABLE `service_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_cart_item`
--
ALTER TABLE `shopping_cart_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

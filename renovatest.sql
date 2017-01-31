-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 30, 2017 at 09:09 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `newrenova`
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
('846ff8a0-e725-11e6-950e-4cfe156feb4d', '846f6052-e725-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b'),
('8470039a-e725-11e6-950e-4cfe156feb4d', '846f6052-e725-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b');

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
('846f6052-e725-11e6-950e-4cfe156feb4d', '8467e782-e725-11e6-950e-4cfe156feb4d', 1, NULL, 52.5, 'Franklyn Perez', 'Dulce Perez', 'Felicidades', 1, '2017-01-30', '2017-01-30', '', 1, '2017-01-30 19:51:40', '2017-01-30 19:51:40', 0),
('972ba034-e70c-11e6-950e-4cfe156feb4d', '9725da32-e70c-11e6-950e-4cfe156feb4d', 2, NULL, 100, 'franklyn Perez', 'Dulce Perez', 'Felicidades', 1, '2017-01-30', '2017-01-30', '', 1, '2017-01-30 16:53:14', '2017-01-30 16:53:14', 0);

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
('f1c5f852-c667-11e6-915d-39adba9ad86b', 'RIU PALACE ANTILLAS', 'J.E. Irasquin Blvd 77 Palm Beach, Aruba.', 'info.aruba@renovaspa.com', 'Paula Casas', '09:00:00', '07:00:00', '<p>We&rsquo;re located inside the Riu Palace Antillas.</p>    <p><br /> The spa will not be able to make reservations for you by phone.</p>     <p>The Fitness Centre is open from 7:00 am to 8:00 pm.</p>    <p>We do not close at any holidays.</p>     <p>&nbsp;     <p>     <h3>SPA FACILITIES<br /><br /></h3>     <p style="text-align: justify;">This elegant and modern Spa features different locations for you to enjoy all type of massages, body treatments and facials.<br /><br /></p>    <p style="text-align: justify;">Two single treatment rooms and four double rooms for couple treatments are located inside the spa surrounded by a tranquil atmosphere.<br /><br /></p>    <p style="text-align: justify;">Check out our Spa programs for singles or couples and have a spa experience as part of an unforgettable vacation!</p>     <p style="text-align: justify;">One beautiful beach pavilion offers massages with an incredible ocean view during daytime or at night. <br /><br />Let the breeze be the background music during your relaxation massages!<br /><br /></p>    <p style="text-align: justify;">We also offer manicure and pedicure services and a full beauty salon, <br />whereour expert stylists will make you look perfect and pamper you.<br /><br /></p>     <p style="text-align: justify;">To wrap up your spa experience, before or after any spa treatment, Renova Spa features a steam room located inside the changing rooms for ladies and gentlemen respectively. <br /><br />These facilities in conjunction with the gym are available free of charge for guests of the all-inclusive program.<br /><br /></p>     <p>&nbsp;The salon equipment includes:</p>    <ul>      <li>3 dressing tables</li>      <li>1 hair washbasin</li>       <li>2 manicure tables</li>    <li>2 pedicure stations</li>    </ul>     <div>&nbsp;</div>     <div>&nbsp;</div>     <div>&nbsp;</div>     <div>&nbsp;</div>     <h3>FITNESS CENTER</h3>     <p><span>The gym includes the following</span>&nbsp;exercise equipment:&nbsp;</p>     <ul type="disc">      <li>mats&nbsp;</li>       <li>pilates balls</li>      <li>free weights</li>       <li>2 abdominal crunches</li>       <li>2 cross-trainers</li>       <li>1 squat</li>      <li>1 seated leg curl</li>      <li>1 chest press</li>      <li>1 pull down</li>      <li>1 leg extension</li>      <li>2&nbsp;95 R Lifecycle Bikes</li>      <li>4&nbsp;x 95 X&nbsp;Eliptics</li>      <li>5 Treadmills 5 x 95T</li>     </ul>', 1, '2016-12-23 00:00:00', 0, 10, 1);

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
-- Table structure for table `payment_information`
--

CREATE TABLE `payment_information` (
  `id` varchar(128) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `town_city` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `street_address` varchar(200) DEFAULT NULL,
  `apartment_unit` varchar(200) DEFAULT NULL,
  `post_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_information`
--

INSERT INTO `payment_information` (`id`, `first_name`, `last_name`, `email`, `country`, `town_city`, `phone_number`, `company_name`, `street_address`, `apartment_unit`, `post_code`) VALUES
('8468b766-e725-11e6-950e-4cfe156feb4d', 'Franklyn', 'Perez', 'fkop@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('97268798-e70c-11e6-950e-4cfe156feb4d', 'Franklyn', 'Salcedo', 'fkop04@gmail.com', 'Republica Dominicana', 'Distrito Nacional', '8298353260', 'Cydeck', 'Calle #18', 'Apartamento Buenos Aires', '10010'),
('de0c80f6-e71e-11e6-950e-4cfe156feb4d', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('f727124e-e70b-11e6-950e-4cfe156feb4d', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', 'Distrito Nacional', '8298353260', 'Cydeck', 'Calle #18, sector Naco', 'Apartamento Los Prados', '10010');

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
  `payment_information_id` varchar(128) NOT NULL,
  `confirmation_number` varchar(200) NOT NULL,
  `certificate_first_name` varchar(100) DEFAULT NULL,
  `certificate_last_name` varchar(100) DEFAULT NULL,
  `certificate_MI` varchar(100) DEFAULT NULL,
  `certificate_email` varchar(100) DEFAULT NULL,
  `certificate_not_my_info` tinyint(1) DEFAULT '0',
  `arrival` date NOT NULL,
  `departure` date NOT NULL,
  `subtotal` double NOT NULL,
  `discount` double DEFAULT NULL,
  `total` double NOT NULL,
  `payment_method_id` varchar(128) DEFAULT NULL,
  `last_four_card_numbers` int(11) DEFAULT NULL,
  `status_id` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `type`, `region_id`, `hotel_id`, `payment_information_id`, `confirmation_number`, `certificate_first_name`, `certificate_last_name`, `certificate_MI`, `certificate_email`, `certificate_not_my_info`, `arrival`, `departure`, `subtotal`, `discount`, `total`, `payment_method_id`, `last_four_card_numbers`, `status_id`, `created`, `modified`, `is_deleted`) VALUES
('8467e782-e725-11e6-950e-4cfe156feb4d', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '8468b766-e725-11e6-950e-4cfe156feb4d', 'DeFdCgaA', 'David', 'Salcedo', '', 'hiobairo1993@gmail.com', NULL, '2017-01-30', '2017-01-30', 52.5, NULL, 52.5, 'ff97fa8e-c85b-11e6-915d-39adba9ad86b', NULL, '6b5263c2-c7bc-11e6-915d-39adba9ad86b', '2017-01-30 19:51:40', '2017-01-30 19:51:40', 0),
('9725da32-e70c-11e6-950e-4cfe156feb4d', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '97268798-e70c-11e6-950e-4cfe156feb4d', 'aBbeg7cD', 'David', 'Salcedo', 'DS', 'hiobairo1993@gmail.com', NULL, '2017-01-30', '2017-01-30', 100, NULL, 100, 'ff97fa8e-c85b-11e6-915d-39adba9ad86b', NULL, '6b5263c2-c7bc-11e6-915d-39adba9ad86b', '2017-01-30 16:53:14', '2017-01-30 16:53:14', 0),
('d8259d30-e70a-11e6-950e-4cfe156feb4d', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '', '159Fc6GA', NULL, NULL, NULL, NULL, NULL, '2017-01-30', '2017-01-30', 60, NULL, 52.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-01-30 16:40:44', '2017-01-30 16:40:44', 0),
('de0bafbe-e71e-11e6-950e-4cfe156feb4d', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'de0c80f6-e71e-11e6-950e-4cfe156feb4d', 'ag4DbeGa', NULL, NULL, NULL, NULL, NULL, '2017-01-30', '2017-01-30', 60, NULL, 52.5, 'ff97fa8e-c85b-11e6-915d-39adba9ad86b', NULL, '6b5263c2-c7bc-11e6-915d-39adba9ad86b', '2017-01-30 19:04:04', '2017-01-30 19:04:04', 0),
('f7260250-e70b-11e6-950e-4cfe156feb4d', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'f727124e-e70b-11e6-950e-4cfe156feb4d', '38Aa7284', NULL, NULL, NULL, NULL, NULL, '2017-01-30', '2017-01-30', 30, NULL, 27, 'ff97fa8e-c85b-11e6-915d-39adba9ad86b', NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-01-30 16:48:45', '2017-01-30 16:48:45', 0);

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
('d82b6ad0-e70a-11e6-950e-4cfe156feb4d', 'd8259d30-e70a-11e6-950e-4cfe156feb4d', 'cf1df48a-e70a-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', 'David Salcedo', '2017-02-01', '12:00:00', 27, 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', '2017-01-30 16:40:44', '2017-01-30 16:40:44', 0),
('d82b7908-e70a-11e6-950e-4cfe156feb4d', 'd8259d30-e70a-11e6-950e-4cfe156feb4d', 'cf1e449e-e70a-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Franklyn Perez', '2017-02-01', '12:00:00', 25.5, 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', '2017-01-30 16:40:44', '2017-01-30 16:40:44', 0),
('de137c62-e71e-11e6-950e-4cfe156feb4d', 'de0bafbe-e71e-11e6-950e-4cfe156feb4d', 'c89a5fe0-e71e-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', 'David Salcedo', '2017-02-01', '12:00:00', 27, 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', '2017-01-30 19:04:04', '2017-01-30 19:04:04', 0),
('de138ed2-e71e-11e6-950e-4cfe156feb4d', 'de0bafbe-e71e-11e6-950e-4cfe156feb4d', 'c89adb28-e71e-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Carlos Burgos', '2017-02-11', '13:00:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-01-30 19:04:04', '2017-01-30 19:04:04', 0),
('f72c7e1e-e70b-11e6-950e-4cfe156feb4d', 'f7260250-e70b-11e6-950e-4cfe156feb4d', 'f247adf6-e70b-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', 'David Salcedo', '2017-02-01', '12:00:00', 27, 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', '2017-01-30 16:48:45', '2017-01-30 16:48:45', 0);

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
('6fa0eb96-e725-11e6-950e-4cfe156feb4d', 'emtpYTP1NDlGbZsScnNJoU29EQALaxai0o20RQ5d', '2017-01-30 19:51:05', 0),
('8b2fad2a-e70c-11e6-950e-4cfe156feb4d', '60iQijD8EwCh8WhVV3mpsk44SYU5Vb34jGJqOGdV', '2017-01-30 16:52:54', 0),
('c89a6d64-e71e-11e6-950e-4cfe156feb4d', '6uE2jEXtOhYPj7zAjarOEq1uMslBilQqP9vYD1Lx', '2017-01-30 19:03:28', 0),
('cf1dfd5e-e70a-11e6-950e-4cfe156feb4d', 'Tl8kCvtSH1nSVMTq24HrMzJXOYXz2f6PVIx7H7G5', '2017-01-30 16:40:29', 0),
('f247b58a-e70b-11e6-950e-4cfe156feb4d', 'MC56icFjQcXld7thgVQJPQk2aiB1NiF05wrpnywR', '2017-01-30 16:48:37', 0);

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
('6fa0e1b4-e725-11e6-950e-4cfe156feb4d', '6fa0eb96-e725-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-01-30', 0),
('6fa14a3c-e725-11e6-950e-4cfe156feb4d', '6fa0eb96-e725-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-01-30', 0),
('8b313c3a-e70c-11e6-950e-4cfe156feb4d', '8b2fad2a-e70c-11e6-950e-4cfe156feb4d', NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '100', '2017-01-30', 0),
('c89a5fe0-e71e-11e6-950e-4cfe156feb4d', 'c89a6d64-e71e-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', 'David Salcedo', 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-01', '12:00:00', 1, NULL, NULL, '2017-01-30', 0),
('c89adb28-e71e-11e6-950e-4cfe156feb4d', 'c89a6d64-e71e-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Carlos Burgos', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-11', '13:00:00', 1, NULL, NULL, '2017-01-30', 0),
('cf1df48a-e70a-11e6-950e-4cfe156feb4d', 'cf1dfd5e-e70a-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', 'David Salcedo', 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-01', '12:00:00', 1, NULL, NULL, '2017-01-30', 0),
('cf1e449e-e70a-11e6-950e-4cfe156feb4d', 'cf1dfd5e-e70a-11e6-950e-4cfe156feb4d', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Franklyn Perez', 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-01', '12:00:00', 1, NULL, NULL, '2017-01-30', 0),
('f247adf6-e70b-11e6-950e-4cfe156feb4d', 'f247b58a-e70b-11e6-950e-4cfe156feb4d', 'd877950a-c6ca-11e6-915d-39adba9ad86b', 'David Salcedo', 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-01', '12:00:00', 1, NULL, NULL, '2017-01-30', 0);

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
-- Indexes for table `payment_information`
--
ALTER TABLE `payment_information`
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

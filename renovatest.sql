-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 10, 2017 at 03:58 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.8

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
  `max_cant_persons` int(11) DEFAULT NULL,
  `Created` date NOT NULL,
  `Modified` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cabin`
--

INSERT INTO `cabin` (`id`, `Name`, `max_cant_persons`, `Created`, `Modified`, `is_deleted`) VALUES
('a1b4c658-c9ea-11e6-915d-39adba9ad86x', 'Package', 4, '2016-12-21', '2016-12-21', 0),
('b0c7c658-c7ea-11e6-915d-39adba9ad86b', 'Single', 1, '2016-12-21', '2016-12-21', 0),
('b6eb160c-c7ea-11e6-915d-39adba9ad86b', 'Double', 2, '2016-12-21', '2016-12-21', 0);

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
('e546c52a-ed9f-11e6-ab30-97c0fcae753e', 'e5465586-ed9f-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b');

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
('079cfd60-ee09-11e6-ab30-97c0fcae753e', '07969f06-ee09-11e6-ab30-97c0fcae753e', 2, NULL, 100, 'Franklyn Perez', 'Dulce Perez', 'felicidades', 1, '2017-02-08', '2017-02-08', '', 1, '2017-02-08 14:15:23', '2017-02-08 14:15:23', 0),
('2f06d9a2-ee09-11e6-ab30-97c0fcae753e', '2f00998e-ee09-11e6-ab30-97c0fcae753e', 2, NULL, 100, 'Franklyn Perez', 'Dulce Perez', 'felicidades', 1, '2017-02-08', '2017-02-08', '', 1, '2017-02-08 14:16:29', '2017-02-08 14:16:29', 0),
('3b80d89e-ee2d-11e6-ab30-97c0fcae753e', '3b78bbaa-ee2d-11e6-ab30-97c0fcae753e', 2, NULL, 100, 'Dulce Perez', 'Franklyn Perez', 'Felicidades', 1, '2017-02-08', '2017-02-08', '', 1, '2017-02-08 18:34:32', '2017-02-08 18:34:32', 0),
('3b818816-ee2d-11e6-ab30-97c0fcae753e', '3b78bbaa-ee2d-11e6-ab30-97c0fcae753e', 2, NULL, 50, 'Franklyn Perez', 'Dulce Perez', 'Un mensaje', 1, '2017-02-08', '2017-02-08', '', 1, '2017-02-08 18:34:32', '2017-02-08 18:34:32', 0),
('6c9e632e-ee0a-11e6-ab30-97c0fcae753e', '6c97c3a2-ee0a-11e6-ab30-97c0fcae753e', 2, NULL, 100, 'Franklyn Perez', 'Dulce Perez', 'Felicidades', 1, '2017-02-08', '2017-02-08', '', 1, '2017-02-08 14:25:22', '2017-02-08 14:25:22', 0),
('9d1b1af0-ee0b-11e6-ab30-97c0fcae753e', '9d14d2bc-ee0b-11e6-ab30-97c0fcae753e', 2, NULL, 100, 'Franklyn Perez', 'Dulce Perez', 'Felicidades', 1, '2017-02-08', '2017-02-08', '', 1, '2017-02-08 14:33:52', '2017-02-08 14:33:52', 0),
('c2f18a82-ee08-11e6-ab30-97c0fcae753e', 'c2eaad2a-ee08-11e6-ab30-97c0fcae753e', 2, NULL, 100, 'Franklyn Perez', 'Dulce Perez', 'felicidades', 1, '2017-02-08', '2017-02-08', '', 1, '2017-02-08 14:13:27', '2017-02-08 14:13:27', 0),
('c6dd02e2-ee09-11e6-ab30-97c0fcae753e', 'c6d66fea-ee09-11e6-ab30-97c0fcae753e', 2, NULL, 100, 'Franklyn Perez', 'Dulce Perez', 'Felicidades', 1, '2017-02-08', '2017-02-08', '', 1, '2017-02-08 14:20:43', '2017-02-08 14:20:43', 0),
('e5465586-ed9f-11e6-ab30-97c0fcae753e', 'e53ead40-ed9f-11e6-ab30-97c0fcae753e', 1, NULL, 25.5, 'Franklyn Perez', 'Dulce Perez', 'Felicidades', 1, '2017-02-08', '2017-02-08', '', 1, '2017-02-08 01:42:48', '2017-02-08 01:42:48', 0),
('ee5dab72-ee0a-11e6-ab30-97c0fcae753e', 'ee57160e-ee0a-11e6-ab30-97c0fcae753e', 2, NULL, 100, 'Franklyn Perez', 'Dulce Perez', 'Felicidades', 1, '2017-02-08', '2017-02-08', '', 1, '2017-02-08 14:28:59', '2017-02-08 14:28:59', 0),
('f3e8ebf2-ee09-11e6-ab30-97c0fcae753e', 'f3e24540-ee09-11e6-ab30-97c0fcae753e', 2, NULL, 100, 'Franklyn Perez', 'Dulce Perez', 'Felicidades', 1, '2017-02-08', '2017-02-08', '', 1, '2017-02-08 14:21:59', '2017-02-08 14:21:59', 0);

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
('02a0141e-ea53-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('07977476-ee09-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('0dfbba2a-ea53-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('1328e852-ee2b-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('24eb02fc-ee10-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2d7b4064-ed73-11e6-ab30-97c0fcae753e', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('2f01520c-ee09-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('30daa896-ee7a-11e6-ab30-97c0fcae753e', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominiana', '', '', '', '', '', ''),
('32d0c4a6-ee10-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('36441f8e-eed8-11e6-ab30-97c0fcae753e', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('3a23b6be-eda2-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('3b79da30-ee2d-11e6-ab30-97c0fcae753e', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('3f1139ae-ed65-11e6-ab30-97c0fcae753e', 'david', 'salcedo', 'hiobairo1993@gmail.com', 'republica', '', '', '', '', '', ''),
('40b33f14-ebda-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('42d31274-ea4f-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('4538e540-ea52-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('5062d248-ee10-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('5204037e-e898-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('52c2202c-ece7-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('592dfff0-ea51-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('59de35bc-ea53-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('5db94ab6-ea51-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('66874796-ee12-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('67ba6844-ebda-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('6c989714-ee0a-11e6-ab30-97c0fcae753e', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('6d9511b8-ed99-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('72d7f214-ebc1-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('7a8c4c6e-ea52-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('7e586d98-ea50-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('831c9652-ebda-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('8468b766-e725-11e6-950e-4cfe156feb4d', 'Franklyn', 'Perez', 'fkop@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('84f72a08-ed99-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('8a98adf2-ea50-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('97268798-e70c-11e6-950e-4cfe156feb4d', 'Franklyn', 'Salcedo', 'fkop04@gmail.com', 'Republica Dominicana', 'Distrito Nacional', '8298353260', 'Cydeck', 'Calle #18', 'Apartamento Buenos Aires', '10010'),
('9af2efae-ed99-11e6-ab30-97c0fcae753e', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', 'Distrito Nacional', '8298353260', 'Cydeck', 'Roberto Pastoriza #12', '', '10010'),
('9c9b4828-ee0d-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('9d157a32-ee0b-11e6-ab30-97c0fcae753e', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('b27e6a62-ed45-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('b3e73982-ee0e-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('b43a6ba0-ef3c-11e6-b416-b502e98c0160', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('b50193a2-ebda-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('c2eb9410-ee08-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('c398cabc-ecce-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('c5ef8ec2-ed9b-11e6-ab30-97c0fcae753e', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('c6d746ea-ee09-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('c9354e4e-ea50-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('cd73e8f2-ea51-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('d5f24946-ea52-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('db690fe6-e7e0-11e6-b6d5-cce00160de3c', 'Franklyn', 'Perez', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('de0c80f6-e71e-11e6-950e-4cfe156feb4d', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('e382f3c2-ebd2-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('e3e1e0f2-ea52-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('e53f8f4e-ed9f-11e6-ab30-97c0fcae753e', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('e5fa7eba-ee28-11e6-ab30-97c0fcae753e', 'David', 'Salcedo', 'fkop04@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('ebc90a9c-ea4e-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('ee57e9e4-ee0a-11e6-ab30-97c0fcae753e', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('f02263f0-ea52-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('f3e317d6-ee09-11e6-ab30-97c0fcae753e', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('f727124e-e70b-11e6-950e-4cfe156feb4d', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', 'Distrito Nacional', '8298353260', 'Cydeck', 'Calle #18, sector Naco', 'Apartamento Los Prados', '10010'),
('f871d7de-ea52-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('fb99e380-ee11-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `bride_name` varchar(100) DEFAULT NULL,
  `groom_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `wedding_bill_delivery` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `wedding_date` date DEFAULT NULL,
  `wedding_time` time DEFAULT NULL,
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

INSERT INTO `reservation` (`id`, `type`, `region_id`, `hotel_id`, `payment_information_id`, `confirmation_number`, `bride_name`, `groom_name`, `email`, `wedding_bill_delivery`, `remarks`, `wedding_date`, `wedding_time`, `certificate_first_name`, `certificate_last_name`, `certificate_MI`, `certificate_email`, `certificate_not_my_info`, `arrival`, `departure`, `subtotal`, `discount`, `total`, `payment_method_id`, `last_four_card_numbers`, `status_id`, `created`, `modified`, `is_deleted`) VALUES
('07969f06-ee09-11e6-ab30-97c0fcae753e', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '07977476-ee09-11e6-ab30-97c0fcae753e', 'c9GADAfb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-08', '2017-02-08', 100, NULL, 100, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 14:15:23', '2017-02-08 14:15:23', 0),
('1327d822-ee2b-11e6-ab30-97c0fcae753e', 3, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '1328e852-ee2b-11e6-ab30-97c0fcae753e', 'c9F293Ff', 'Franklyn Perez', 'Margarita Rodriguez', 'fkop04@gmail.com', 2, 'No se que pondrai en el remarks xD', '2017-02-11', '01:00:00', 'David ', 'Salcedo', NULL, NULL, NULL, '2017-02-08', '2017-02-08', 30, NULL, 25.5, NULL, NULL, '6b5263c2-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 18:19:05', '2017-02-08 18:19:05', 0),
('24ea4cc2-ee10-11e6-ab30-97c0fcae753e', 3, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '24eb02fc-ee10-11e6-ab30-97c0fcae753e', '1Addg5a9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-08', '2017-02-08', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 15:06:18', '2017-02-08 15:06:18', 0),
('2f00998e-ee09-11e6-ab30-97c0fcae753e', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '2f01520c-ee09-11e6-ab30-97c0fcae753e', 'Fa33gBa4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-08', '2017-02-08', 100, NULL, 100, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 14:16:29', '2017-02-08 14:16:29', 0),
('30d9ec94-ee7a-11e6-ab30-97c0fcae753e', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '30daa896-ee7a-11e6-ab30-97c0fcae753e', '847FF221', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-09', '2017-02-09', 30, NULL, 25.5, '0a862dc6-c85c-11e6-915d-39adba9ad86b', NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-09 03:45:25', '2017-02-09 03:45:25', 0),
('32d0140c-ee10-11e6-ab30-97c0fcae753e', 3, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '32d0c4a6-ee10-11e6-ab30-97c0fcae753e', 'af13C23C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-08', '2017-02-08', 0, NULL, 0, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 15:06:42', '2017-02-08 15:06:42', 0),
('3643b72e-eed8-11e6-ab30-97c0fcae753e', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '36441f8e-eed8-11e6-ab30-97c0fcae753e', 'deba2g7D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-09', '2017-02-09', 30, NULL, 25.5, '0a862dc6-c85c-11e6-915d-39adba9ad86b', NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-09 14:58:27', '2017-02-09 14:58:27', 0),
('3a22c86c-eda2-11e6-ab30-97c0fcae753e', 3, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '3a23b6be-eda2-11e6-ab30-97c0fcae753e', 'a8a8eA9e', 'David Salcedo', 'Dulce Perez', 'hiobairo1993@gmail.com', 2, 'Espero todo quede bien\r\n', '2017-02-11', '01:00:00', NULL, 'Salcedo', NULL, NULL, NULL, '2017-02-08', '2017-02-08', 30, NULL, 25.5, NULL, NULL, '6b5263c2-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 01:59:29', '2017-02-08 01:59:29', 0),
('3b78bbaa-ee2d-11e6-ab30-97c0fcae753e', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '3b79da30-ee2d-11e6-ab30-97c0fcae753e', '1G3749g1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Franklyn ', 'Perez', '', 'fkop04@gmail.com', NULL, '2017-02-08', '2017-02-08', 150, NULL, 150, 'ff97fa8e-c85b-11e6-915d-39adba9ad86b', NULL, '6b5263c2-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 18:34:31', '2017-02-08 18:34:31', 0),
('5061f936-ee10-11e6-ab30-97c0fcae753e', 3, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '5062d248-ee10-11e6-ab30-97c0fcae753e', 'B7c12bb3', 'David Salcedo', 'David Salcedo', 'hiobairo1993@gmail.com', 2, 'Felicidades', '2017-02-10', '13:00:00', 'David', 'salcedo', NULL, NULL, NULL, '2017-02-08', '2017-02-08', 30, NULL, 25.5, NULL, NULL, '6b5263c2-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 15:07:31', '2017-02-08 15:07:31', 0),
('6686a066-ee12-11e6-ab30-97c0fcae753e', 3, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '66874796-ee12-11e6-ab30-97c0fcae753e', 'G2GaC5e2', 'David Salcedo', 'Dulce Perez', 'hiobairo1993@gmail.com', 2, '', '2017-02-10', '01:00:00', 'David', 'salcedo', NULL, NULL, NULL, '2017-02-08', '2017-02-08', 30, NULL, 25.5, NULL, NULL, '6b5263c2-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 15:22:27', '2017-02-08 15:22:27', 0),
('6c97c3a2-ee0a-11e6-ab30-97c0fcae753e', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '6c989714-ee0a-11e6-ab30-97c0fcae753e', 'AdDfceCe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'David', 'salcedo', '', 'hiobairo1993@gmail.com', NULL, '2017-02-08', '2017-02-08', 100, NULL, 100, 'ff97fa8e-c85b-11e6-915d-39adba9ad86b', NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 14:25:22', '2017-02-08 14:25:22', 0),
('9c9a621e-ee0d-11e6-ab30-97c0fcae753e', 3, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '9c9b4828-ee0d-11e6-ab30-97c0fcae753e', 'D2DAAc6d', 'David Salcedo', 'Dulce Perez', 'hiobairo1993@gmail.com', 2, 'Felicidades', '2017-02-10', '01:00:00', NULL, 'Salcedo', NULL, NULL, NULL, '2017-02-08', '2017-02-08', 30, NULL, 25.5, NULL, NULL, '6b5263c2-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 14:48:11', '2017-02-08 14:48:11', 0),
('9d14d2bc-ee0b-11e6-ab30-97c0fcae753e', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '9d157a32-ee0b-11e6-ab30-97c0fcae753e', 'ACbf8AAf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'David', 'Salcedo', 'DS', 'hiobairo1993@gmail.com', NULL, '2017-02-08', '2017-02-08', 100, NULL, 100, 'ff97fa8e-c85b-11e6-915d-39adba9ad86b', NULL, '6b5263c2-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 14:33:52', '2017-02-08 14:33:52', 0),
('b3e6709c-ee0e-11e6-ab30-97c0fcae753e', 3, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'b3e73982-ee0e-11e6-ab30-97c0fcae753e', '337BgF31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-08', '2017-02-08', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 14:55:59', '2017-02-08 14:55:59', 0),
('b439ff3a-ef3c-11e6-b416-b502e98c0160', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'b43a6ba0-ef3c-11e6-b416-b502e98c0160', '3e6FaG75', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-10', '2017-02-10', 30, NULL, 25.5, '0a862dc6-c85c-11e6-915d-39adba9ad86b', NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-10 02:57:48', '2017-02-10 02:57:48', 0),
('c2eaad2a-ee08-11e6-ab30-97c0fcae753e', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'c2eb9410-ee08-11e6-ab30-97c0fcae753e', '31A1548e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-08', '2017-02-08', 100, NULL, 100, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 14:13:27', '2017-02-08 14:13:27', 0),
('c5eeb466-ed9b-11e6-ab30-97c0fcae753e', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'c5ef8ec2-ed9b-11e6-ab30-97c0fcae753e', 'F88c9AFc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-08', '2017-02-08', 30, NULL, 25.5, 'ff97fa8e-c85b-11e6-915d-39adba9ad86b', NULL, '6b5263c2-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 01:13:17', '2017-02-08 01:13:17', 0),
('c6d66fea-ee09-11e6-ab30-97c0fcae753e', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'c6d746ea-ee09-11e6-ab30-97c0fcae753e', '37fe5D1c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-08', '2017-02-08', 100, NULL, 100, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 14:20:43', '2017-02-08 14:20:43', 0),
('e53ead40-ed9f-11e6-ab30-97c0fcae753e', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'e53f8f4e-ed9f-11e6-ab30-97c0fcae753e', '7cA2Ff11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'David', 'Salcedo', '', 'hiobairo1993@gmail.com', NULL, '2017-02-08', '2017-02-08', 25.5, NULL, 25.5, 'ff97fa8e-c85b-11e6-915d-39adba9ad86b', NULL, '6b5263c2-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 01:42:48', '2017-02-08 01:42:48', 0),
('e5f9a17a-ee28-11e6-ab30-97c0fcae753e', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'e5fa7eba-ee28-11e6-ab30-97c0fcae753e', 'ebAG21Cf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-08', '2017-02-08', 60, NULL, 52.5, 'ff97fa8e-c85b-11e6-915d-39adba9ad86b', NULL, '6b5263c2-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 18:03:30', '2017-02-08 18:03:30', 0),
('ee57160e-ee0a-11e6-ab30-97c0fcae753e', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'ee57e9e4-ee0a-11e6-ab30-97c0fcae753e', '3BA9gC5b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'David', 'salcedo', '', 'hiobairo1993@gmail.com', NULL, '2017-02-08', '2017-02-08', 100, NULL, 100, 'ff97fa8e-c85b-11e6-915d-39adba9ad86b', NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 14:28:59', '2017-02-08 14:28:59', 0),
('f3e24540-ee09-11e6-ab30-97c0fcae753e', 2, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'f3e317d6-ee09-11e6-ab30-97c0fcae753e', '41gGFG58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'David', 'salcedo', '', 'hiobairo1993@gmail.com', NULL, '2017-02-08', '2017-02-08', 100, NULL, 100, 'ff97fa8e-c85b-11e6-915d-39adba9ad86b', NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 14:21:59', '2017-02-08 14:21:59', 0),
('fb99014a-ee11-11e6-ab30-97c0fcae753e', 3, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'fb99e380-ee11-11e6-ab30-97c0fcae753e', '4ag5668f', 'David Salcedo', 'David Salcedo', 'hiobairo1993@gmail.com', 2, '', '2017-02-10', '01:00:00', 'David', 'salcedo', NULL, NULL, NULL, '2017-02-08', '2017-02-08', 30, NULL, 25.5, NULL, NULL, '6b5263c2-c7bc-11e6-915d-39adba9ad86b', '2017-02-08 15:19:28', '2017-02-08 15:19:28', 0);

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
('133186c4-ee2b-11e6-ab30-97c0fcae753e', '1327d822-ee2b-11e6-ab30-97c0fcae753e', '04d9bc9a-ee2b-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'David Salcedo, Franklyn Perez', '2017-02-10', '12:00:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-08 18:19:05', '2017-02-08 18:19:05', 0),
('13319452-ee2b-11e6-ab30-97c0fcae753e', '1327d822-ee2b-11e6-ab30-97c0fcae753e', '04d9ccd0-ee2b-11e6-ab30-97c0fcae753e', '1a298596-c659-11e6-915d-39adba9ad86b', 'Dulce Perez', '2017-02-10', '12:00:00', 0, 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', '2017-02-08 18:19:05', '2017-02-08 18:19:05', 0),
('24f1e69e-ee10-11e6-ab30-97c0fcae753e', '5061f936-ee10-11e6-ab30-97c0fcae753e', '13b87ec4-ee10-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Franklyn Perez, Dulce Perez', '2017-02-10', '12:01:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-08 15:07:31', '2017-02-08 15:07:31', 0),
('24f1fd64-ee10-11e6-ab30-97c0fcae753e', '5061f936-ee10-11e6-ab30-97c0fcae753e', '13b88b26-ee10-11e6-ab30-97c0fcae753e', '1a298596-c659-11e6-915d-39adba9ad86b', 'David Salcedo', '2017-02-10', '12:01:00', 0, 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', '2017-02-08 15:07:31', '2017-02-08 15:07:31', 0),
('30e15394-ee7a-11e6-ab30-97c0fcae753e', '30d9ec94-ee7a-11e6-ab30-97c0fcae753e', '2a0f5ba6-ee7a-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'David Salcedo, Dulce Perez', '2017-02-10', '12:00:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-09 03:45:25', '2017-02-09 03:45:25', 0),
('36477382-eed8-11e6-ab30-97c0fcae753e', '3643b72e-eed8-11e6-ab30-97c0fcae753e', '30560f92-eed8-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Franklyn Perez, Dulce Perez', '2017-02-11', '12:00:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-09 14:58:27', '2017-02-09 14:58:27', 0),
('3a2c16a6-eda2-11e6-ab30-97c0fcae753e', '3a22c86c-eda2-11e6-ab30-97c0fcae753e', '1e9a2568-eda2-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'David Salcedo, Dulce Perez', '2017-02-09', '12:00:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-08 01:59:29', '2017-02-08 01:59:29', 0),
('3a2c23d0-eda2-11e6-ab30-97c0fcae753e', '3a22c86c-eda2-11e6-ab30-97c0fcae753e', '1e9a3206-eda2-11e6-ab30-97c0fcae753e', '1a298596-c659-11e6-915d-39adba9ad86b', 'Franklyn Perez', '2017-02-09', '12:00:00', 0, 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', '2017-02-08 01:59:29', '2017-02-08 01:59:29', 0),
('668d2c56-ee12-11e6-ab30-97c0fcae753e', '6686a066-ee12-11e6-ab30-97c0fcae753e', '60a927c2-ee12-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Franklyn Perez, Dulce Perez', '2017-02-10', '12:00:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-08 15:22:27', '2017-02-08 15:22:27', 0),
('9ca28f20-ee0d-11e6-ab30-97c0fcae753e', '9c9a621e-ee0d-11e6-ab30-97c0fcae753e', '90fb0e72-ee0d-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Dulce Perez, Franklyn Perez', '2017-02-10', '12:00:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-08 14:48:11', '2017-02-08 14:48:11', 0),
('9ca29b32-ee0d-11e6-ab30-97c0fcae753e', '9c9a621e-ee0d-11e6-ab30-97c0fcae753e', '90fb1e62-ee0d-11e6-ab30-97c0fcae753e', '1a298596-c659-11e6-915d-39adba9ad86b', 'David Salcedo', '2017-02-10', '12:00:00', 0, 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', '2017-02-08 14:48:11', '2017-02-08 14:48:11', 0),
('b3ee7832-ee0e-11e6-ab30-97c0fcae753e', 'b3e6709c-ee0e-11e6-ab30-97c0fcae753e', 'a8c25b86-ee0e-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Dulce Perez, Franklyn Perez', '2017-02-10', '12:00:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-08 14:55:59', '2017-02-08 14:55:59', 0),
('b3ee8cb4-ee0e-11e6-ab30-97c0fcae753e', 'b3e6709c-ee0e-11e6-ab30-97c0fcae753e', 'a8c26644-ee0e-11e6-ab30-97c0fcae753e', '1a298596-c659-11e6-915d-39adba9ad86b', 'David Salcedo', '2017-02-10', '12:00:00', 0, 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', '2017-02-08 14:55:59', '2017-02-08 14:55:59', 0),
('b43e0ecc-ef3c-11e6-b416-b502e98c0160', 'b439ff3a-ef3c-11e6-b416-b502e98c0160', 'acb24c86-ef3c-11e6-b416-b502e98c0160', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'David Salcedo, Jose Contreras', '2017-02-11', '12:00:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-10 02:57:48', '2017-02-10 02:57:48', 0),
('c5f54236-ed9b-11e6-ab30-97c0fcae753e', 'c5eeb466-ed9b-11e6-ab30-97c0fcae753e', 'bb92cf16-ed9b-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Franklyn Perez, Dulce Perez', '2017-02-11', '12:00:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-08 01:13:17', '2017-02-08 01:13:17', 0),
('e6035990-ee28-11e6-ab30-97c0fcae753e', 'e5f9a17a-ee28-11e6-ab30-97c0fcae753e', 'cf75c5fa-ee28-11e6-ab30-97c0fcae753e', 'd877950a-c6ca-11e6-915d-39adba9ad86b', 'David Salcedo, Franklyn Perez, Dulce Perez, Oswald Akira', '2017-02-10', '12:00:00', 27, 'a1b4c658-c9ea-11e6-915d-39adba9ad86x', '2017-02-08 18:03:30', '2017-02-08 18:03:30', 0),
('e60370b0-ee28-11e6-ab30-97c0fcae753e', 'e5f9a17a-ee28-11e6-ab30-97c0fcae753e', 'cf75d9e6-ee28-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Gibran Turbi, Rigel Acevedo', '2017-02-12', '13:30:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-08 18:03:30', '2017-02-08 18:03:30', 0),
('fba1e1fc-ee11-11e6-ab30-97c0fcae753e', 'fb99014a-ee11-11e6-ab30-97c0fcae753e', 'ee765ab2-ee11-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'Dulce Perez, Franklyn Perez', '2017-02-10', '12:00:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-08 15:19:28', '2017-02-08 15:19:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` varchar(128) NOT NULL,
  `name` varchar(200) NOT NULL,
  `cabin_id` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `cabin_id`) VALUES
('1a298596-c659-11e6-915d-39adba9ad86b', 'Flash Facial', 'b0c7c658-c7ea-11e6-915d-39adba9ad86b'),
('9a263a3e-c659-11e6-915d-39adba9ad86b', 'Vita Cura - Anti Aging Facial', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b'),
('9e298596-c659-11e6-915d-39adba9ad86b', 'MASSAGES', 'b0c7c658-c7ea-11e6-915d-39adba9ad86b'),
('d877950a-c6ca-11e6-915d-39adba9ad86b', 'Collagen Puls Facial', 'a1b4c658-c9ea-11e6-915d-39adba9ad86x');

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
('04d85850-ee2b-11e6-ab30-97c0fcae753e', 'UHKCdH2z0efid3j67STpEjvbtmIeU4GFjD5W6OT4', '2017-02-08 18:18:41', 0),
('13b764f8-ee10-11e6-ab30-97c0fcae753e', 'S3ZcVgGDHmoUSDUvS70fflGh25EwxKN5Dw26FWNP', '2017-02-08 15:05:49', 0),
('1d0aed5a-ee2d-11e6-ab30-97c0fcae753e', 'V3Qy0BHKwqpfSEAYB5zeJatAPUCZVTU4lz48Bzle', '2017-02-08 18:33:40', 0),
('1e98bdae-eda2-11e6-ab30-97c0fcae753e', '46s1SYRztnVFzmUA27GWlL1mVoVass0CO66DtRP5', '2017-02-08 01:58:43', 0),
('2a0df888-ee7a-11e6-ab30-97c0fcae753e', 'KzBkCeP5fLJChvrc4kvkqrUJaEll0jqWOtNu5gEo', '2017-02-09 03:45:13', 0),
('30555ca0-eed8-11e6-ab30-97c0fcae753e', 'JZ9Zzch5Qd7a0NQYGZvH4VBh0iZJ998RD7XVvhUT', '2017-02-09 14:58:17', 0),
('60a8032e-ee12-11e6-ab30-97c0fcae753e', 'LaVzFSeFZf4Cm11OEz70ZlEaYDWPIKsYpDKMZy8P', '2017-02-08 15:22:17', 0),
('61e66d78-ee0a-11e6-ab30-97c0fcae753e', 'hdlqLx9XOqE4OZdekFnF725RkZnRXEAFJtuPFiFJ', '2017-02-08 14:25:04', 0),
('6faf8f5e-ee08-11e6-ab30-97c0fcae753e', 'MTRJMFX92rDo6JALQLFbcypTRZ5Tk9ruJj4XYTHx', '2017-02-08 14:11:08', 0),
('75d1df54-ee08-11e6-ab30-97c0fcae753e', 'MTRJMFX92rDo6JALQLFbcypTRZ5Tk9ruJj4XYTHx', '2017-02-08 14:11:18', 0),
('90fa0d74-ee0d-11e6-ab30-97c0fcae753e', 'uG0d3LzCZ2Y7xWuGOae5dxdrR8JcMjy7lII8i5mo', '2017-02-08 14:47:51', 0),
('93c682b4-ee0b-11e6-ab30-97c0fcae753e', 'lfiq9X4ZlFADrMoW6mvz2fPSVgf3eCIeaa6rHa6E', '2017-02-08 14:33:37', 0),
('a8c10736-ee0e-11e6-ab30-97c0fcae753e', 'uui6pC3SYf73zJ9CKGnkTOr0E79sPQcXw3S3b5s2', '2017-02-08 14:55:40', 0),
('acb19764-ef3c-11e6-b416-b502e98c0160', 'fQCd7PoSqelhq99bEgnjbbEKsJfenRt2oFmUMFGK', '2017-02-10 02:57:35', 0),
('bb91a3ac-ed9b-11e6-ab30-97c0fcae753e', 'W9q2hgJBxO1iUedbnqMKhmoDiEPbrBwNMmsrPobH', '2017-02-08 01:13:00', 0),
('bde01c24-ee09-11e6-ab30-97c0fcae753e', 'tiv6FmVSNjX0gMIO4tDgseOl4Fp8WJzUGyV2XPY7', '2017-02-08 14:20:28', 0),
('bf863b50-ee11-11e6-ab30-97c0fcae753e', '9YLfGbmRZ1HT2J4c6Fv7iJrdo9khBqTdmUmweo6d', '2017-02-08 15:17:47', 0),
('cf748dfc-ee28-11e6-ab30-97c0fcae753e', 'WN4tjSWBLl1hyjuaWDyV9SzHlwSxdsY9zM0oWLiM', '2017-02-08 18:02:52', 0),
('d2f21348-ed9f-11e6-ab30-97c0fcae753e', 'SyBr4TqV5zCBcizFs1HQLYeC6mJUqM0esqCA7Z8V', '2017-02-08 01:42:17', 0),
('ee75428a-ee11-11e6-ab30-97c0fcae753e', 'q3rzYAtk17rn0mELCxmBjt0nGCuxkkqbEZs2d1kR', '2017-02-08 15:19:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart_item`
--

CREATE TABLE `shopping_cart_item` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cart_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `package_id` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
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

INSERT INTO `shopping_cart_item` (`id`, `cart_id`, `service_id`, `package_id`, `customer_name`, `cabin_id`, `Quantity`, `PreferedDate`, `PreferedTime`, `Type`, `certificate_number`, `value`, `Created`, `is_deleted`) VALUES
('04d9bc9a-ee2b-11e6-ab30-97c0fcae753e', '04d85850-ee2b-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'e652673e-eada-11e6-8e07-23d1aff8cd12', 'David Salcedo, Franklyn Perez', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-10', '12:00:00', 3, NULL, NULL, '2017-02-08', 0),
('04d9ccd0-ee2b-11e6-ab30-97c0fcae753e', '04d85850-ee2b-11e6-ab30-97c0fcae753e', '1a298596-c659-11e6-915d-39adba9ad86b', 'e652673e-eada-11e6-8e07-23d1aff8cd12', 'Dulce Perez', 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-10', '12:00:00', 3, NULL, NULL, '2017-02-08', 0),
('13b87ec4-ee10-11e6-ab30-97c0fcae753e', '13b764f8-ee10-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'e652673e-eada-11e6-8e07-23d1aff8cd12', 'Franklyn Perez, Dulce Perez', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-10', '12:01:00', 3, NULL, NULL, '2017-02-08', 0),
('13b88b26-ee10-11e6-ab30-97c0fcae753e', '13b764f8-ee10-11e6-ab30-97c0fcae753e', '1a298596-c659-11e6-915d-39adba9ad86b', 'e652673e-eada-11e6-8e07-23d1aff8cd12', 'David Salcedo', 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-10', '12:01:00', 3, NULL, NULL, '2017-02-08', 0),
('1d0cf85c-ee2d-11e6-ab30-97c0fcae753e', '1d0aed5a-ee2d-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '100', '2017-02-08', 0),
('1d0d0554-ee2d-11e6-ab30-97c0fcae753e', '1d0aed5a-ee2d-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 2, '50', '2017-02-08', 0),
('1e9a2568-eda2-11e6-ab30-97c0fcae753e', '1e98bdae-eda2-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'e652673e-eada-11e6-8e07-23d1aff8cd12', 'David Salcedo, Dulce Perez', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-09', '12:00:00', 3, NULL, NULL, '2017-02-08', 0),
('1e9a3206-eda2-11e6-ab30-97c0fcae753e', '1e98bdae-eda2-11e6-ab30-97c0fcae753e', '1a298596-c659-11e6-915d-39adba9ad86b', 'e652673e-eada-11e6-8e07-23d1aff8cd12', 'Franklyn Perez', 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-09', '12:00:00', 3, NULL, NULL, '2017-02-08', 0),
('2a0f5ba6-ee7a-11e6-ab30-97c0fcae753e', '2a0df888-ee7a-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, 'David Salcedo, Dulce Perez', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-10', '12:00:00', 1, NULL, NULL, '2017-02-09', 0),
('30560f92-eed8-11e6-ab30-97c0fcae753e', '30555ca0-eed8-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, 'Franklyn Perez, Dulce Perez', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-11', '12:00:00', 1, NULL, NULL, '2017-02-09', 0),
('60a927c2-ee12-11e6-ab30-97c0fcae753e', '60a8032e-ee12-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, 'Franklyn Perez, Dulce Perez', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-10', '12:00:00', 3, NULL, NULL, '2017-02-08', 0),
('61e7c786-ee0a-11e6-ab30-97c0fcae753e', '61e66d78-ee0a-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '100', '2017-02-08', 0),
('6fb14506-ee08-11e6-ab30-97c0fcae753e', '6faf8f5e-ee08-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '100', '2017-02-08', 0),
('75d379a4-ee08-11e6-ab30-97c0fcae753e', '75d1df54-ee08-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '100', '2017-02-08', 0),
('90fb0e72-ee0d-11e6-ab30-97c0fcae753e', '90fa0d74-ee0d-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'e652673e-eada-11e6-8e07-23d1aff8cd12', 'Dulce Perez, Franklyn Perez', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-10', '12:00:00', 3, NULL, NULL, '2017-02-08', 0),
('90fb1e62-ee0d-11e6-ab30-97c0fcae753e', '90fa0d74-ee0d-11e6-ab30-97c0fcae753e', '1a298596-c659-11e6-915d-39adba9ad86b', 'e652673e-eada-11e6-8e07-23d1aff8cd12', 'David Salcedo', 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-10', '12:00:00', 3, NULL, NULL, '2017-02-08', 0),
('93c87b3c-ee0b-11e6-ab30-97c0fcae753e', '93c682b4-ee0b-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '100', '2017-02-08', 0),
('a8c25b86-ee0e-11e6-ab30-97c0fcae753e', 'a8c10736-ee0e-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'e652673e-eada-11e6-8e07-23d1aff8cd12', 'Dulce Perez, Franklyn Perez', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-10', '12:00:00', 3, NULL, NULL, '2017-02-08', 0),
('a8c26644-ee0e-11e6-ab30-97c0fcae753e', 'a8c10736-ee0e-11e6-ab30-97c0fcae753e', '1a298596-c659-11e6-915d-39adba9ad86b', 'e652673e-eada-11e6-8e07-23d1aff8cd12', 'David Salcedo', 'b0c7c658-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-10', '12:00:00', 3, NULL, NULL, '2017-02-08', 0),
('acb24c86-ef3c-11e6-b416-b502e98c0160', 'acb19764-ef3c-11e6-b416-b502e98c0160', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, 'David Salcedo, Jose Contreras', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-11', '12:00:00', 1, NULL, NULL, '2017-02-10', 0),
('bb92cf16-ed9b-11e6-ab30-97c0fcae753e', 'bb91a3ac-ed9b-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, 'Franklyn Perez, Dulce Perez', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-11', '12:00:00', 1, NULL, NULL, '2017-02-08', 0),
('bde1c1dc-ee09-11e6-ab30-97c0fcae753e', 'bde01c24-ee09-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '100', '2017-02-08', 0),
('bf877dbc-ee11-11e6-ab30-97c0fcae753e', 'bf863b50-ee11-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, NULL, '2017-02-08', 0),
('cf75c5fa-ee28-11e6-ab30-97c0fcae753e', 'cf748dfc-ee28-11e6-ab30-97c0fcae753e', 'd877950a-c6ca-11e6-915d-39adba9ad86b', NULL, 'David Salcedo, Franklyn Perez, Dulce Perez, Oswald Akira', 'a1b4c658-c9ea-11e6-915d-39adba9ad86x', 1, '2017-02-10', '12:00:00', 1, NULL, NULL, '2017-02-08', 0),
('cf75d9e6-ee28-11e6-ab30-97c0fcae753e', 'cf748dfc-ee28-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, 'Gibran Turbi, Rigel Acevedo', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-12', '13:30:00', 1, NULL, NULL, '2017-02-08', 0),
('d2f36a2c-ed9f-11e6-ab30-97c0fcae753e', 'd2f21348-ed9f-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-02-08', 0),
('ee765ab2-ee11-11e6-ab30-97c0fcae753e', 'ee75428a-ee11-11e6-ab30-97c0fcae753e', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, 'Dulce Perez, Franklyn Perez', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-10', '12:00:00', 3, NULL, NULL, '2017-02-08', 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `wedding_package`
--

CREATE TABLE `wedding_package` (
  `id` varchar(128) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wedding_package`
--

INSERT INTO `wedding_package` (`id`, `name`, `description`, `is_active`, `created`, `is_deleted`) VALUES
('e652673e-eada-11e6-8e07-23d1aff8cd12', 'Glamorous Package', 'For the ones that prefer to apply their own make up. Obtain soft hands and feet, show beautiful nails and get the perfect hairstyle to be gorgeous on the big day', 1, '2017-02-04 00:00:00', 0),
('f052673e-eada-11e6-8e07-23d1aff8cd1a', 'Pretty Style Package', 'The basic grooming for a special occasion. Select the style that will make you shine', 1, '2017-02-04 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wedding_package_category`
--

CREATE TABLE `wedding_package_category` (
  `id` varchar(128) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `ordinal` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wedding_package_category`
--

INSERT INTO `wedding_package_category` (`id`, `name`, `description`, `ordinal`, `is_active`, `created`, `is_deleted`) VALUES
('0ded836c-ead8-11e6-8e07-23d1aff8cd1a', 'PACKAGES FOR THE GUYS', 'The gentlemen in the party need to look perfect as well! This is the time to pamper them. These packages are for the groom and any other men in the party. They have to be used by one person only ( cannot be shared) and the services can be split up in different days.', 1, 1, '2017-02-04 00:00:00', 0),
('1915c4b6-ead8-11e6-8e07-23d1aff8cd1a', 'PACKAGES FOR THE COUPLE', 'The wedding trip is all about the couple! Enjoy a romantic and indulgent experience with your loved one.', 1, 1, '2017-02-04 00:00:00', 0),
('2531cbd2-ead8-11e6-8e07-23d1aff8cd1a', 'PACKAGES FOR EVERYONE', 'Celebrate with your guests and have a delicious relaxing treat!', 1, 1, '2017-02-04 00:00:00', 0),
('fc4d39cc-ead7-11e6-8e07-23d1aff8cd1a', 'PACKAGES FOR THE GIRLS', 'This is the time to enjoy with the most important ladies in your life! Renova Spa wishes to make you look beautiful and to pamper you all. These packages are for the bride and any other lady in the party. They have to be used by one person only ( cannot be shared) and the services can be split up in different days.', 1, 1, '2017-02-04 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wedding_package_category_hotel`
--

CREATE TABLE `wedding_package_category_hotel` (
  `id` varchar(128) NOT NULL,
  `hotel_id` varchar(128) NOT NULL,
  `wedding_package_category_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wedding_package_category_hotel`
--

INSERT INTO `wedding_package_category_hotel` (`id`, `hotel_id`, `wedding_package_category_id`) VALUES
('18926a58-eafe-11e6-8e07-23d1aff8acu7', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '0ded836c-ead8-11e6-8e07-23d1aff8cd1a'),
('29467a58-eafe-11e6-8e07-23d1aff8cd1a', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'fc4d39cc-ead7-11e6-8e07-23d1aff8cd1a'),
('g1267a58-eafe-11e6-8e07-23d1aff8ca13', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '1915c4b6-ead8-11e6-8e07-23d1aff8cd1a'),
('jio98a58-eafe-11e6-8e07-23d1aff8ca13', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '2531cbd2-ead8-11e6-8e07-23d1aff8cd1a');

-- --------------------------------------------------------

--
-- Table structure for table `wedding_package_category_relation`
--

CREATE TABLE `wedding_package_category_relation` (
  `id` varchar(128) NOT NULL,
  `wedding_package_id` varchar(128) NOT NULL,
  `wedding_package_category_id` varchar(128) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `active_discount` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wedding_package_category_relation`
--

INSERT INTO `wedding_package_category_relation` (`id`, `wedding_package_id`, `wedding_package_category_id`, `price`, `discount`, `active_discount`) VALUES
('368dbea0-eadc-11e6-8e07-23d1aff8cd1a', 'f052673e-eada-11e6-8e07-23d1aff8cd1a', 'fc4d39cc-ead7-11e6-8e07-23d1aff8cd1a', '166', '0', 0),
('js98bea0-eadc-11e6-8e07-23d1aff8cd1d', 'e652673e-eada-11e6-8e07-23d1aff8cd12', 'fc4d39cc-ead7-11e6-8e07-23d1aff8cd1a', '231', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wedding_package_service`
--

CREATE TABLE `wedding_package_service` (
  `id` varchar(128) NOT NULL,
  `wedding_package_id` varchar(128) NOT NULL,
  `service_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wedding_package_service`
--

INSERT INTO `wedding_package_service` (`id`, `wedding_package_id`, `service_id`) VALUES
('1966d550-eaf4-11e6-8e07-23d1aff8cd13', 'e652673e-eada-11e6-8e07-23d1aff8cd12', '9a263a3e-c659-11e6-915d-39adba9ad86b'),
('5866d550-eaf7-11e6-8e07-23d1aff8cd1a', 'e652673e-eada-11e6-8e07-23d1aff8cd12', '1a298596-c659-11e6-915d-39adba9ad86b');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `country_id` (`country_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `currency_id` (`currency_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_region_region_index` (`region_id`),
  ADD KEY `hotel_region_hotel_index` (`hotel_id`) USING BTREE;

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `region_id` (`region_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_id` (`reservation_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_category_hotel`
--
ALTER TABLE `service_category_hotel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `service_price`
--
ALTER TABLE `service_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `hotel_region_id` (`hotel_region_id`);

--
-- Indexes for table `service_region`
--
ALTER TABLE `service_region`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `region_id` (`region_id`);

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

--
-- Indexes for table `wedding_package`
--
ALTER TABLE `wedding_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wedding_package_category`
--
ALTER TABLE `wedding_package_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wedding_package_category_hotel`
--
ALTER TABLE `wedding_package_category_hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wedding_package_category_relation`
--
ALTER TABLE `wedding_package_category_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wedding_package_service`
--
ALTER TABLE `wedding_package_service`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_country`
--
ALTER TABLE `category_country`
  ADD CONSTRAINT `category_country_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `category_country_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Constraints for table `country`
--
ALTER TABLE `country`
  ADD CONSTRAINT `country_ibfk_1` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`);

--
-- Constraints for table `hotel_region`
--
ALTER TABLE `hotel_region`
  ADD CONSTRAINT `hotel_region_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`),
  ADD CONSTRAINT `hotel_region_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`),
  ADD CONSTRAINT `hotel_region_ibfk_3` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`),
  ADD CONSTRAINT `hotel_region_ibfk_4` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`);

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`),
  ADD CONSTRAINT `photo_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`);

--
-- Constraints for table `reservation_item`
--
ALTER TABLE `reservation_item`
  ADD CONSTRAINT `reservation_item_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`),
  ADD CONSTRAINT `reservation_item_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Constraints for table `service_category_hotel`
--
ALTER TABLE `service_category_hotel`
  ADD CONSTRAINT `service_category_hotel_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`),
  ADD CONSTRAINT `service_category_hotel_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `service_category_hotel_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`),
  ADD CONSTRAINT `service_category_hotel_ibfk_4` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Constraints for table `service_price`
--
ALTER TABLE `service_price`
  ADD CONSTRAINT `service_price_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`),
  ADD CONSTRAINT `service_price_ibfk_2` FOREIGN KEY (`hotel_region_id`) REFERENCES `hotel_region` (`id`);

--
-- Constraints for table `service_region`
--
ALTER TABLE `service_region`
  ADD CONSTRAINT `service_region_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`),
  ADD CONSTRAINT `service_region_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`);

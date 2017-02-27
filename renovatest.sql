-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 27, 2017 at 05:26 PM
-- Server version: 5.6.35
-- PHP Version: 7.0.15

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
  `name` varchar(128) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `is_active`, `is_deleted`) VALUES
('04580784-cdc6-11e6-8e2f-269ea561f5ac', 'BODY TREATMENTS', 1, 0),
('0dcaf61e-cdc6-11e6-8e2f-269ea561f5ac', 'SPA EXPERIENCES', 1, 0),
('1072aa4c-c65a-11e6-915d-39adba9ad86b', 'FACIALS', 1, 0),
('1b958688-c65a-11e6-915d-39adba9ad86b', 'MASSAGES', 1, 0),
('1d33f6b4-cdc6-11e6-8e2f-269ea561f5ac', 'BEAUTY SALON SERVICES', 1, 0),
('2921548a-cdc6-11e6-8e2f-269ea561f5ac', 'SPECIAL FOR COUPLES', 1, 0),
('34c3474e-cdc6-11e6-8e2f-269ea561f5ac', 'GAZEBO SERVICES', 1, 0),
('c8fcf7a2-fcfb-11e6-a12a-f46e471cb539', 'FEBRUARY SPECIAL', 1, 0),
('dd528ccc-cdc5-11e6-8e2f-269ea561f5ac', 'HANDS & FEET TREATMENTS', 1, 0),
('e7ac8484-cdc5-11e6-8e2f-269ea561f5ac', 'WAXING', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_country`
--

CREATE TABLE `category_country` (
  `id` varchar(128) NOT NULL,
  `country_id` varchar(128) NOT NULL,
  `category_id` varchar(128) NOT NULL,
  `is_special` tinyint(1) NOT NULL DEFAULT '0',
  `special_begin_date` datetime DEFAULT NULL,
  `special_end_date` datetime DEFAULT NULL,
  `ordinal` int(11) DEFAULT '0',
  `reference_name` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_country`
--

INSERT INTO `category_country` (`id`, `country_id`, `category_id`, `is_special`, `special_begin_date`, `special_end_date`, `ordinal`, `reference_name`, `is_active`, `is_deleted`) VALUES
('203b7aec-cdd7-11e6-8e2f-269ea561f5ac', '4e6b7b5e-c663-11e6-915d-39adba9ad86b', '04580784-cdc6-11e6-8e2f-269ea561f5ac', 0, NULL, NULL, 5, 'aruba/palm beach/body treatment', 1, 0),
('3dbe23ae-c6ce-11e6-915d-39adba9ad86b', '4e6b7b5e-c663-11e6-915d-39adba9ad86b', '1b958688-c65a-11e6-915d-39adba9ad86b', 0, NULL, NULL, 4, 'aruba/palm beach/massages', 1, 0),
('481c64f4-fcfd-11e6-a12a-f46e471cb539', '4e6b7b5e-c663-11e6-915d-39adba9ad86b', 'c8fcf7a2-fcfb-11e6-a12a-f46e471cb539', 1, '2017-02-01 00:00:00', '2017-02-27 00:00:00', 0, 'aruba/palm beach/february special', 1, 0),
('822cb02c-fa3c-11e6-a12a-f46e471cb539', '4e6b7b5e-c663-11e6-915d-39adba9ad86b', 'e7ac8484-cdc5-11e6-8e2f-269ea561f5ac', 0, NULL, NULL, 2, 'aruba/palm beach/waxins', 1, 0),
('910d65be-fa3c-11e6-a12a-f46e471cb539', '4e6b7b5e-c663-11e6-915d-39adba9ad86b', 'dd528ccc-cdc5-11e6-8e2f-269ea561f5ac', 0, NULL, NULL, 1, 'aruba/palm beach/hands and feet treatments', 1, 0),
('980197a0-fa3c-11e6-a12a-f46e471cb539', '4e6b7b5e-c663-11e6-915d-39adba9ad86b', '34c3474e-cdc6-11e6-8e2f-269ea561f5ac', 0, NULL, NULL, 9, 'aruba/palm beach/gazebo ', 1, 0),
('c4b2af5a-fa3c-11e6-a12a-f46e471cb539', '4e6b7b5e-c663-11e6-915d-39adba9ad86b', '2921548a-cdc6-11e6-8e2f-269ea561f5ac', 0, NULL, NULL, 7, 'aruba/palm beach/special for couples', 1, 0),
('cd632378-fa3c-11e6-a12a-f46e471cb539', '4e6b7b5e-c663-11e6-915d-39adba9ad86b', '1d33f6b4-cdc6-11e6-8e2f-269ea561f5ac', 0, NULL, NULL, 8, 'aruba/palm beach/beauty salon services', 1, 0),
('dif96826-c6be-11e6-085d-39adba9ad86b', '4e6b7b5e-c663-11e6-915d-39adba9ad86b', '0dcaf61e-cdc6-11e6-8e2f-269ea561f5ac', 0, NULL, NULL, 6, 'aruba/palm beach/spa experiences', 1, 0),
('f0f96826-c6be-11e6-915d-39adba9ad86b', '4e6b7b5e-c663-11e6-915d-39adba9ad86b', '1072aa4c-c65a-11e6-915d-39adba9ad86b', 0, NULL, NULL, 0, 'aruba/palm beach/facials', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `certificate_detail_service`
--

CREATE TABLE `certificate_detail_service` (
  `id` varchar(128) NOT NULL,
  `certificate_detail_id` varchar(128) NOT NULL,
  `service_id` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `delivery_email` varchar(200) DEFAULT NULL,
  `delivery_number_or_agency` varchar(200) DEFAULT NULL,
  `delivery_company_name` varchar(200) DEFAULT NULL,
  `delivery_departure_date` date DEFAULT NULL,
  `delivery_other_info` varchar(255) DEFAULT NULL,
  `other_fields` text NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
('8acc1d66-f849-11e6-a12a-f46e471cb539', 'DOMINICAN REPUBLIC', '82ae10ae-c927-11e6-b56e-bd2377eb3445'),
('8acce200-f849-11e6-a12a-f46e471cb539', 'JAMAICA', '82ae10ae-c927-11e6-b56e-bd2377eb3445'),
('8acce5b6-f849-11e6-a12a-f46e471cb539', 'MAURITIUS', '82ae10ae-c927-11e6-b56e-bd2377eb3445'),
('8acce71e-f849-11e6-a12a-f46e471cb539', 'MEXICO', '82ae10ae-c927-11e6-b56e-bd2377eb3445'),
('8acce8ae-f849-11e6-a12a-f46e471cb539', 'PANAMA', '82ae10ae-c927-11e6-b56e-bd2377eb3445'),
('8acce9bc-f849-11e6-a12a-f46e471cb539', 'SAINT MARTIN', '85a34aae-c927-11e6-b56e-bd2377eb3445'),
('8acceab6-f849-11e6-a12a-f46e471cb539', 'SPAIN', '85a34aae-c927-11e6-b56e-bd2377eb3445'),
('8acceba6-f849-11e6-a12a-f46e471cb539', 'SRI LANKA', '82ae10ae-c927-11e6-b56e-bd2377eb3445'),
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
('16b3221a-f869-11e6-a12a-f46e471cb539', 'Riu Palace Paradise Island', 'Riu Palace Paradise Island', 'info@renovaspa.com', 'Paula Casas', '08:00:00', '20:00:00', '\nWe are located inside the Riu Palace Paradise Island.\nThe spa will not be able to make reservations for you by phone.\n\nThe Fitness Centre is open from 7:00 am to 8:00 pm.\n\nWe do not close at any holidays.\n\n\n\n\n\n \n\n \n\n\nSPA FACILITIES\n\n \n\nA broad range of indulgent treatments such as massages, facials and body wraps can be offered to the hotel guests in 4 treatment room.\n\nBeauty Salon services are also available, from nail treatments to body waxing and all kinds of hair services.\n\nTo complete the experience the spa facilities include an open air lounging area with two Jacuzzis to relax before or after your treatment. In addition to this; male and female sauna and Fitness Center are part of the \"all inclusive\" services.\n\n \n \n \nFITNESS CENTER\n\n \n\nIncludes the following exercise equipment:\n\nThree cycles\nThree running mills\nOne stepper\nOne 4 module weight gym (chest press, shoulder press, lat pull down and leg extension)\nDumbbell rack with 2,3,5,10,15,20,25,30,35,40,45,50 lbs weights.\nWeight bench and bent leg abdominal board.', 1, '2017-02-21 00:00:00', 0, 0, 0),
('42eba048-f871-11e6-a12a-f46e471cb539', 'Riu Palace Cabo Verde', '', 'info.capeverde@renovaspa.com', 'Paula Casas', '08:00:00', '20:00:00', '', 1, '2017-02-21 00:00:00', 0, 0, 0),
('44fda1ce-f452-11e6-935c-349b705c7f66', 'Riu Palace Paradise Island', '6307 Casino Drive Paradise Island, Paradise Island, Bahamas', 'info@renovaspa.com', 'Paula Casas', '08:00:00', '20:00:00', '6307 Casino Drive Paradise Island, Paradise Island, Bahamas', 1, '2017-02-16 00:00:00', 0, 0, 0),
('50c5f852-c667-11e6-915d-39adba9ad86b', 'RIU PALACE ARUBA', 'J.E. Irasquin Blvd 77 Palm Beach, Aruba.', 'info.aruba@renovaspa.com', 'Paula Casas', '09:00:00', '07:00:00', '', 1, '2016-12-23 00:00:00', 0, NULL, 0),
('9870cfa4-f86a-11e6-a12a-f46e471cb539', 'Riu Palace Paradise Island', '6307 Casino Drive Paradise Island, Paradise Island, Bahamas', 'info@renovaspa.com', 'Paula Casas', '08:00:00', '20:00:00', '\nWe are located inside the Riu Palace Paradise Island.\nThe spa will not be able to make reservations for you by phone.\n\nThe Fitness Centre is open from 7:00 am to 8:00 pm.\n\nWe do not close at any holidays.\n\n\n\n\n\n \n\n \n\n\nSPA FACILITIES\n\n \n\nA broad range of indulgent treatments such as massages, facials and body wraps can be offered to the hotel guests in 4 treatment room.\n\nBeauty Salon services are also available, from nail treatments to body waxing and all kinds of hair services.\n\nTo complete the experience the spa facilities include an open air lounging area with two Jacuzzis to relax before or after your treatment. In addition to this; male and female sauna and Fitness Center are part of the \"all inclusive\" services.\n\n \n \n \nFITNESS CENTER\n\n \n\nIncludes the following exercise equipment:\n\nThree cycles\nThree running mills\nOne stepper\nOne 4 module weight gym (chest press, shoulder press, lat pull down and leg extension)\nDumbbell rack with 2,3,5,10,15,20,25,30,35,40,45,50 lbs weights.\nWeight bench and bent leg abdominal board.', 1, '2017-02-21 00:00:00', 0, 0, 0),
('f1c5f852-c667-11e6-915d-39adba9ad86b', 'RIU PALACE ANTILLAS', 'J.E. Irasquin Blvd 77 Palm Beach, Aruba.', 'info.aruba@renovaspa.com', 'Paula Casas', '09:00:00', '07:00:00', '<p>We&rsquo;re located inside the Riu Palace Antillas.</p>    <p><br /> The spa will not be able to make reservations for you by phone.</p>     <p>The Fitness Centre is open from 7:00 am to 8:00 pm.</p>    <p>We do not close at any holidays.</p>     <p>&nbsp;     <p>     <h3>SPA FACILITIES<br /><br /></h3>     <p style=\"text-align: justify;\">This elegant and modern Spa features different locations for you to enjoy all type of massages, body treatments and facials.<br /><br /></p>    <p style=\"text-align: justify;\">Two single treatment rooms and four double rooms for couple treatments are located inside the spa surrounded by a tranquil atmosphere.<br /><br /></p>    <p style=\"text-align: justify;\">Check out our Spa programs for singles or couples and have a spa experience as part of an unforgettable vacation!</p>     <p style=\"text-align: justify;\">One beautiful beach pavilion offers massages with an incredible ocean view during daytime or at night. <br /><br />Let the breeze be the background music during your relaxation massages!<br /><br /></p>    <p style=\"text-align: justify;\">We also offer manicure and pedicure services and a full beauty salon, <br />whereour expert stylists will make you look perfect and pamper you.<br /><br /></p>     <p style=\"text-align: justify;\">To wrap up your spa experience, before or after any spa treatment, Renova Spa features a steam room located inside the changing rooms for ladies and gentlemen respectively. <br /><br />These facilities in conjunction with the gym are available free of charge for guests of the all-inclusive program.<br /><br /></p>     <p>&nbsp;The salon equipment includes:</p>    <ul>      <li>3 dressing tables</li>      <li>1 hair washbasin</li>       <li>2 manicure tables</li>    <li>2 pedicure stations</li>    </ul>     <div>&nbsp;</div>     <div>&nbsp;</div>     <div>&nbsp;</div>     <div>&nbsp;</div>     <h3>FITNESS CENTER</h3>     <p><span>The gym includes the following</span>&nbsp;exercise equipment:&nbsp;</p>     <ul type=\"disc\">      <li>mats&nbsp;</li>       <li>pilates balls</li>      <li>free weights</li>       <li>2 abdominal crunches</li>       <li>2 cross-trainers</li>       <li>1 squat</li>      <li>1 seated leg curl</li>      <li>1 chest press</li>      <li>1 pull down</li>      <li>1 leg extension</li>      <li>2&nbsp;95 R Lifecycle Bikes</li>      <li>4&nbsp;x 95 X&nbsp;Eliptics</li>      <li>5 Treadmills 5 x 95T</li>     </ul>', 1, '2016-12-23 00:00:00', 0, 10, 1),
('f9a4f178-f870-11e6-a12a-f46e471cb539', 'Riu Funana Club Hotel', 'Hotel Riu Touareg - Urbanizacao Lacacao. Lote 13 Praia Lacacao. Santa Monica.Boavista.Cabo Verde', 'info.capeverde@renovaspa.com', 'Paula Casas', '08:00:00', '20:00:00', '\nWe are located inside the Riu Funana Club Hotel. \nThe spa will not be able to make reservations for you by phone.\n\nThe Fitness Centre is open from 7:00 am to 8:00 pm.\n\nWe do not close at any holidays.\n\n\n\n\n\n\n\n\nSPA FACILITIES\n\n \n\nThis Renova SPA services the Riu Funana and Riu Palace Cabo Verde guests and has been designed exclusively for your relaxation and totally well-being.\n\nWith an extensive menu of services that makes it simple to get yourself renewed and radiant, from the moment you enter you are swept into a sanctuary, where your spirit is restored and your energy is revitalized.\n\n\nThe Renova SPA at Sal Island features 8 treatment rooms to offer Body Treatments, Facials, Massages and a wide range of packages and special combos for a delightful vacation.\n\n3 of these are double sized to offer services for couples.\n\nBefore or after any spa treatment, Renova Spa features a lounge area, where you will be able to enjoy a jacuzzi and beautiful terrace.\n\nThere are steam rooms at the changing rooms for ladies and gentlemen respectively.\n\n\nWe also offer a special pedicure cabin and a full beauty salon with 3 hair stations and 3 manicure stations where our expert stylists will pamper you.\n\n\nLook radiant during your holidays!\n\nThe salon equipment includes:\n\n3 dressing tables\n1 hair washbasin\n3 manicure tables\n2 pedicure stations\n \n\n \n\n \n \n \nFITNESS CENTER\n\n \n\nIncludes the following exercise equipment:\n\n3 Treadmills\n3 Elipticals\n3 Stationary bikes\n3 Upper body trainers\n2 lower body trainers\n1 Stretching trainer', 1, '2017-02-21 00:00:00', 0, 0, 0);

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
('10826546-c668-11e6-915d-39adba9ad86b', '50c5f852-c667-11e6-915d-39adba9ad86b', '8fc7e7b8-c659-11e6-915d-39adba9ad86b', NULL, 0),
('42ec128a-f871-11e6-a12a-f46e471cb539', '42eba048-f871-11e6-a12a-f46e471cb539', 'd912a97a-c664-11e6-915d-39adba9ad86b', 0, 0),
('450191da-f452-11e6-935c-349b705c7f66', '44fda1ce-f452-11e6-935c-349b705c7f66', '3d22c3ce-c65a-11e6-915d-39adba9ad86b', 0, 0),
('f9ab302e-f870-11e6-a12a-f46e471cb539', 'f9a4f178-f870-11e6-a12a-f46e471cb539', 'd912a97a-c664-11e6-915d-39adba9ad86b', 0, 0);

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
('3ef1998c-faa3-11e6-a12a-f46e471cb539', 'e7ac8484-cdc5-11e6-8e2f-269ea561f5ac', NULL, NULL, NULL, NULL, 'waxing.jpg'),
('4eb50e30-fad5-11e6-a12a-f46e471cb539', '2921548a-cdc6-11e6-8e2f-269ea561f5ac', NULL, NULL, NULL, NULL, 'special-for-couple.jpg'),
('5faa97b4-cb91-11e6-b56e-bd2377eb3445', NULL, 'f1c5f852-c667-11e6-915d-39adba9ad86b', NULL, NULL, NULL, 'antillas.jpg'),
('5faa97b4-cb91-11e6-b56e-bd3377eb4445', NULL, 'f1c5f852-c667-11e6-915d-39adba9ad86b', NULL, NULL, NULL, 'antillas3.jpg'),
('636b0b9a-cb91-11e6-b56e-bd2377eb3445', NULL, 'f1c5f852-c667-11e6-915d-39adba9ad86b', NULL, NULL, NULL, 'antillas2.jpg'),
('6faa97b4-cb98-11e6-b56e-bd2377eb3445', NULL, 'f1c5f852-c667-11e6-915d-39adba9ad86b', NULL, NULL, NULL, 'antillas4.jpg'),
('736b0b9a-cb91-11e6-b56e-bd2377eb3480', NULL, 'f1c5f852-c667-11e6-915d-39adba9ad86b', NULL, NULL, NULL, 'antillas-profile.jpg'),
('8480d8f0-c6e6-11e6-915d-39adba9ad86b', NULL, NULL, '4e6b7b5e-c663-11e6-915d-39adba9ad86b', NULL, NULL, 'aruba.jpg'),
('a1ba7830-fad6-11e6-a12a-f46e471cb539', '34c3474e-cdc6-11e6-8e2f-269ea561f5ac', NULL, NULL, NULL, NULL, 'gazebo-services.jpg'),
('b4a87bac-c793-11e6-915d-39adba9ad84r', '1b958688-c65a-11e6-915d-39adba9ad86b', NULL, NULL, NULL, NULL, 'massages.jpg'),
('b4a87bac-c793-11e6-915d-39adba9ad86b', '1072aa4c-c65a-11e6-915d-39adba9ad86b', NULL, NULL, NULL, NULL, 'facial.jpg'),
('b4a87bac-c793-11e6-915d-39adba9ed867', '04580784-cdc6-11e6-8e2f-269ea561f5ac', NULL, NULL, NULL, NULL, 'body-treatment.jpg'),
('c91bbc8c-fad5-11e6-a12a-f46e471cb539', '1d33f6b4-cdc6-11e6-8e2f-269ea561f5ac', NULL, NULL, NULL, NULL, 'beauty-salon-services.jpg'),
('f5ea9798-faa2-11e6-a12a-f46e471cb539', 'dd528ccc-cdc5-11e6-8e2f-269ea561f5ac', NULL, NULL, NULL, NULL, 'hands-and-feet-treatment.jpg'),
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
('04e45dec-f84b-11e6-a12a-f46e471cb539', 'MAINT MARTIN', '8acce9bc-f849-11e6-a12a-f46e471cb539'),
('232c233a-f84a-11e6-a12a-f46e471cb539', 'MONTEGO BAY', '8acce200-f849-11e6-a12a-f46e471cb539'),
('232c2704-f84a-11e6-a12a-f46e471cb539', 'NEGRIL', '8acce200-f849-11e6-a12a-f46e471cb539'),
('232c27ea-f84a-11e6-a12a-f46e471cb539', 'OCHO RIOS', '8acce200-f849-11e6-a12a-f46e471cb539'),
('3d22c3ce-c65a-11e6-915d-39adba9ad86b', 'PARADISE ISLAND', '9dcd9ef6-c664-11e6-915d-39adba9ad86b'),
('3e9aa6c8-f84a-11e6-a12a-f46e471cb539', 'LE MORNE', '8acce5b6-f849-11e6-a12a-f46e471cb539'),
('4c4c1b8e-f84b-11e6-a12a-f46e471cb539', 'CANARY ISLAND-FUERTEVENTURA', '8acceab6-f849-11e6-a12a-f46e471cb539'),
('6351114a-f84b-11e6-a12a-f46e471cb539', 'AHUNGALLA', '8acceba6-f849-11e6-a12a-f46e471cb539'),
('8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'PALM BEACH', '4e6b7b5e-c663-11e6-915d-39adba9ad86b'),
('b3066f60-f84a-11e6-a12a-f46e471cb539', 'PLAYA DEL CARMEN', '8acce71e-f849-11e6-a12a-f46e471cb539'),
('b306733e-f84a-11e6-a12a-f46e471cb539', 'CANCUN', '8acce71e-f849-11e6-a12a-f46e471cb539'),
('b30674c4-f84a-11e6-a12a-f46e471cb539', 'NUEVO VALLARTA-RIVIERA NAYARIT', '8acce71e-f849-11e6-a12a-f46e471cb539'),
('b306756e-f84a-11e6-a12a-f46e471cb539', 'LOS CABOS', '8acce71e-f849-11e6-a12a-f46e471cb539'),
('b30675f0-f84a-11e6-a12a-f46e471cb539', 'GUADALAJARA', '8acce71e-f849-11e6-a12a-f46e471cb539'),
('b3067672-f84a-11e6-a12a-f46e471cb539', 'MAZATLAN', '8acce71e-f849-11e6-a12a-f46e471cb539'),
('d912a97a-c664-11e6-915d-39adba9ad86b', 'ISLAND OF SAL', 'a137dad4-c664-11e6-915d-39adba9ad86b'),
('de9d9bda-f84a-11e6-a12a-f46e471cb539', 'PLAYA BLANCA', '8acce8ae-f849-11e6-a12a-f46e471cb539'),
('de9d9fa4-f84a-11e6-a12a-f46e471cb539', 'PANAMA CITY', '8acce8ae-f849-11e6-a12a-f46e471cb539'),
('e47c5c2a-c664-11e6-915d-39adba9ad86b', 'ISLAND OF BOA VISTA', 'a137dad4-c664-11e6-915d-39adba9ad86b'),
('ee33a5fe-f849-11e6-a12a-f46e471cb539', 'PUNTA CANA', '8acc1d66-f849-11e6-a12a-f46e471cb539'),
('ee33aa68-f849-11e6-a12a-f46e471cb539', 'PUERTO PLATA', '8acc1d66-f849-11e6-a12a-f46e471cb539'),
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
  `only_for_wedding` tinyint(1) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_category_hotel`
--

INSERT INTO `service_category_hotel` (`id`, `service_id`, `category_id`, `hotel_id`, `only_for_wedding`, `order`, `is_active`, `is_deleted`) VALUES
('a79eb382-c65b-11e6-915d-39adba9ad86b', '9a263a3e-c659-11e6-915d-39adba9ad86b', '1072aa4c-c65a-11e6-915d-39adba9ad86b', '50c5f852-c667-11e6-915d-39adba9ad86b', 0, 0, 1, 0),
('d09eb382-c65b-11e6-915d-39adba9ad86b', '9a263a3e-c659-11e6-915d-39adba9ad86b', '1072aa4c-c65a-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 0, 0, 1, 0),
('e0947c0e-c65b-11e6-915d-39adba9ad86b', '1a298596-c659-11e6-915d-39adba9ad86b', '1072aa4c-c65a-11e6-915d-39adba9ad86b', '50c5f852-c667-11e6-915d-39adba9ad86b', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_information`
--

CREATE TABLE `service_information` (
  `id` varchar(128) NOT NULL,
  `service_category_hotel_id` varchar(128) NOT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `description` text,
  `pregnant_restriction` tinyint(1) DEFAULT '0',
  `age_restriction` tinyint(1) DEFAULT '0',
  `only_for_wedding` tinyint(1) DEFAULT '0',
  `opening_time` time DEFAULT NULL,
  `ending_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_information`
--

INSERT INTO `service_information` (`id`, `service_category_hotel_id`, `duration`, `description`, `pregnant_restriction`, `age_restriction`, `only_for_wedding`, `opening_time`, `ending_time`) VALUES
('dcd62a8e-f25e-11e6-96d7-a9350c9deed4', 'd09eb382-c65b-11e6-915d-39adba9ad86b', '120 min', 'Enjoy the immediate sensational effects that this facial offers. It is a real alternative to surgery by eliminating aging signs like deep expression lines, hyper pigmentation and damage caused by sun exposure.  ', 0, 1, 0, '08:00:00', '20:00:00');

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
('145a91c6-fae2-11e6-a12a-f46e471cb539', 'mo1596mvFgTavt2HDFaToc8QW0S2QEBw6Y8ai4rS', '2017-02-24 22:39:19', 0),
('2700b076-fb96-11e6-a12a-f46e471cb539', 'O2E7b6t09yBTIJfKrMeXFq1YZ1PcVnbrEK3P0KX6', '2017-02-25 20:08:19', 0),
('64185cbc-fadc-11e6-a12a-f46e471cb539', 'PvHczjEyRcjBTjPeGwpIyud9jBGQ7JzmlZqs9TEp', '2017-02-24 21:58:36', 0),
('72fca428-fadb-11e6-a12a-f46e471cb539', 'fJ0EAVGMJ5jmuu0be27AIiDzmlCUqsgxo5P5h6ub', '2017-02-24 21:51:51', 0),
('85a9bb10-fae0-11e6-a12a-f46e471cb539', 'c66g8erApGaYpbevDGgiSSJVfHTYRNtAwf3h78IT', '2017-02-24 22:28:10', 0),
('b36247b0-fae1-11e6-a12a-f46e471cb539', '2dlEFWJdabAu455sqIhiEvvkle5HuB3hBo3tp5zM', '2017-02-24 22:36:36', 0),
('b57ca256-fad8-11e6-a12a-f46e471cb539', 'KQvQ23yeKTiO7MIQEenHXk23Y1VJWmwNKRszO4Dk', '2017-02-24 21:32:14', 0),
('c6937592-fae2-11e6-a12a-f46e471cb539', '0hxBiu96usYvqHp5CinPwRkofA99KKCUPQvIMNq0', '2017-02-24 22:44:18', 0),
('f05dc17a-fadd-11e6-a12a-f46e471cb539', 'Gtg8OFkce7PMSdQJWG3AdPQ8LtwBCgrNkhxbOuNh', '2017-02-24 22:09:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart_item`
--

CREATE TABLE `shopping_cart_item` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cart_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `package_category_relation_id` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
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

INSERT INTO `shopping_cart_item` (`id`, `cart_id`, `service_id`, `package_category_relation_id`, `customer_name`, `cabin_id`, `Quantity`, `PreferedDate`, `PreferedTime`, `Type`, `certificate_number`, `value`, `Created`, `is_deleted`) VALUES
('145bc64a-fae2-11e6-a12a-f46e471cb539', '145a91c6-fae2-11e6-a12a-f46e471cb539', NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '50', '2017-02-24', 0),
('270186a4-fb96-11e6-a12a-f46e471cb539', '2700b076-fb96-11e6-a12a-f46e471cb539', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, '2017-02-25', 0),
('85aab8b2-fae0-11e6-a12a-f46e471cb539', '85a9bb10-fae0-11e6-a12a-f46e471cb539', NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '50', '2017-02-24', 0),
('b3635de4-fae1-11e6-a12a-f46e471cb539', 'b36247b0-fae1-11e6-a12a-f46e471cb539', NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '200', '2017-02-24', 0),
('c575e006-fae1-11e6-a12a-f46e471cb539', 'b36247b0-fae1-11e6-a12a-f46e471cb539', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, NULL, NULL, 1, NULL, NULL, 2, 1, NULL, '2017-02-24', 0),
('c694606a-fae2-11e6-a12a-f46e471cb539', 'c6937592-fae2-11e6-a12a-f46e471cb539', NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '50', '2017-02-24', 0);

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
  `type` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wedding_package`
--

INSERT INTO `wedding_package` (`id`, `name`, `description`, `type`, `is_active`, `created`, `is_deleted`) VALUES
('35c847c2-f853-11e6-a12a-f46e471cb539', 'Riu Free Wedding Package and Riu Classic Wedding Package', '', 1, 1, '2017-02-21 00:00:00', 0),
('35c85988-f853-11e6-a12a-f46e471cb539', 'Riu Royal Wedding Package', '', 1, 1, '2017-02-21 00:00:00', 0),
('35c85ae6-f853-11e6-a12a-f46e471cb539', 'Riu Caprice Wedding Package', '', 1, 1, '2017-02-21 00:00:00', 0),
('35c85ba4-f853-11e6-a12a-f46e471cb539', 'Riu Indulgence Wedding Package', '', 1, 1, '2017-02-21 00:00:00', 0),
('e7988100-f912-11e6-a12a-f46e471cb539', 'Pretty Style Package', 'The basic grooming for a special occasion. Select the style that will make you shine', 2, 1, '2017-02-22 00:00:00', 0);

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
('0ded836c-ead8-11e6-8e07-23d1aff8cd1a', 'PACKAGES FOR THE GUYS', 'The gentlemen in the party need to look perfect as well! This is the time to pamper them. These packages are for the groom and any other men in the party. They have to be used by one person only ( cannot be shared) and the services can be split up in different days.', 2, 1, '2017-02-04 00:00:00', 0),
('1915c4b6-ead8-11e6-8e07-23d1aff8cd1a', 'PACKAGES FOR THE COUPLE', 'The wedding trip is all about the couple! Enjoy a romantic and indulgent experience with your loved one.', 3, 1, '2017-02-04 00:00:00', 0),
('2531cbd2-ead8-11e6-8e07-23d1aff8cd1a', 'PACKAGES FOR EVERYONE', 'Celebrate with your guests and have a delicious relaxing treat!', 4, 1, '2017-02-04 00:00:00', 0),
('3ebd836c-r0o2-11e6-8e07-23d1aff8cd1a', 'RIU WEDDING PACKAGES', 'Riu wedding packages', 1, 1, '2017-02-04 00:00:00', 0),
('fc4d39cc-ead7-11e6-8e07-23d1aff8cd1a', 'PACKAGES FOR THE GIRLS', 'This is the time to enjoy with the most important ladies in your life! Renova Spa wishes to make you look beautiful and to pamper you all. These packages are for the bride and any other lady in the party. They have to be used by one person only ( cannot be shared) and the services can be split up in different days.', 1, 1, '2017-02-04 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wedding_package_category_hotel`
--

CREATE TABLE `wedding_package_category_hotel` (
  `id` varchar(128) NOT NULL,
  `hotel_id` varchar(128) NOT NULL,
  `wedding_package_category_id` varchar(128) NOT NULL,
  `reference_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wedding_package_category_hotel`
--

INSERT INTO `wedding_package_category_hotel` (`id`, `hotel_id`, `wedding_package_category_id`, `reference_name`) VALUES
('2d6a2746-f856-11e6-a12a-f46e471cb539', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '3ebd836c-r0o2-11e6-8e07-23d1aff8cd1a', 'Riu Free Wedding Package aruba/riu palace antillas'),
('2rf2746-f856-11e6-a12a-f46e471cb253', '50c5f852-c667-11e6-915d-39adba9ad86b', '3ebd836c-r0o2-11e6-8e07-23d1aff8cd1a', 'Riu Free Wedding Package aruba/riu place aruba'),
('956e6f52-f912-11e6-a12a-f46e471cb539', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'fc4d39cc-ead7-11e6-8e07-23d1aff8cd1a', 'aruba/riu palace antillas/for girls');

-- --------------------------------------------------------

--
-- Table structure for table `wedding_package_category_relation`
--

CREATE TABLE `wedding_package_category_relation` (
  `id` varchar(128) NOT NULL,
  `wedding_package_id` varchar(128) NOT NULL,
  `wedding_package_category_hotel_id` varchar(128) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `active_discount` tinyint(1) NOT NULL DEFAULT '0',
  `reference_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wedding_package_category_relation`
--

INSERT INTO `wedding_package_category_relation` (`id`, `wedding_package_id`, `wedding_package_category_hotel_id`, `price`, `discount`, `active_discount`, `reference_name`) VALUES
('97698a62-f859-11e6-a12a-f46e471cb539', '35c847c2-f853-11e6-a12a-f46e471cb539', '2rf2746-f856-11e6-a12a-f46e471cb253', '0', '0', 0, 'aruba/riu palace aruba'),
('eeda8850-f912-11e6-a12a-f46e471cb539', 'e7988100-f912-11e6-a12a-f46e471cb539', '956e6f52-f912-11e6-a12a-f46e471cb539', '155', '10', 1, 'aruba/riu palace antillas/pretty style'),
('f6c16fd6-f857-11e6-a12a-f46e471cb539', '35c847c2-f853-11e6-a12a-f46e471cb539', '2d6a2746-f856-11e6-a12a-f46e471cb539', '0', '0', 0, 'aruba/riu palace antillas');

-- --------------------------------------------------------

--
-- Table structure for table `wedding_package_feature`
--

CREATE TABLE `wedding_package_feature` (
  `id` varchar(128) NOT NULL,
  `wedding_package_id` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wedding_package_feature`
--

INSERT INTO `wedding_package_feature` (`id`, `wedding_package_id`, `description`, `created`) VALUES
('f319dda0-f915-11e6-a12a-f46e471cb539', '35c847c2-f853-11e6-a12a-f46e471cb539', '10% discount on any Renova Spa service for the wedding couple', '2017-02-22 00:00:00');

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
('eac54216-f92e-11e6-a12a-f46e471cb539', 'e7988100-f912-11e6-a12a-f46e471cb539', '9a263a3e-c659-11e6-915d-39adba9ad86b');

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
-- Indexes for table `service_information`
--
ALTER TABLE `service_information`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `wedding_package_feature`
--
ALTER TABLE `wedding_package_feature`
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

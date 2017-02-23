-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 22, 2017 at 02:42 PM
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

--
-- Dumping data for table `payment_information`
--

INSERT INTO `payment_information` (`id`, `first_name`, `last_name`, `email`, `country`, `town_city`, `phone_number`, `company_name`, `street_address`, `apartment_unit`, `post_code`) VALUES
('02a0141e-ea53-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('07977476-ee09-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('095e8d86-f3e4-11e6-935c-349b705c7f66', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('0c4bd930-ef49-11e6-aaea-026c172da098', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('0ce2657e-f54f-11e6-aeef-4c960d7c4b01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('0dfbba2a-ea53-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('1328e852-ee2b-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('1b6b4d96-f256-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('1bd6164a-f6ce-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('1ce9f042-f322-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('214e7e48-f6cc-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('24eb02fc-ee10-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2616e23c-f6cf-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('28820df8-f6cf-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('29d54784-f552-11e6-aeef-4c960d7c4b01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2a2cf4d8-f6cf-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2a99ea2e-f315-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2d7b4064-ed73-11e6-ab30-97c0fcae753e', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('2f01520c-ee09-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('30daa896-ee7a-11e6-ab30-97c0fcae753e', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominiana', '', '', '', '', '', ''),
('32d0c4a6-ee10-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('36441f8e-eed8-11e6-ab30-97c0fcae753e', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('38c904ce-efad-11e6-a3e4-a42cf0312219', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('3a23b6be-eda2-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('3b79da30-ee2d-11e6-ab30-97c0fcae753e', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('3f1139ae-ed65-11e6-ab30-97c0fcae753e', 'david', 'salcedo', 'hiobairo1993@gmail.com', 'republica', '', '', '', '', '', ''),
('40b33f14-ebda-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('42d31274-ea4f-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('4538e540-ea52-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('46d4adfa-f252-11e6-96d7-a9350c9deed4', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('4fd46ee6-f256-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('5062d248-ee10-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('5204037e-e898-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('52429a48-ef47-11e6-aaea-026c172da098', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', 'Santo Dominco', '', '', 'Roberto Pastoriza #12', 'K3D Unit', '10010'),
('52c2202c-ece7-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('58eba07c-f214-11e6-a4ef-b2a62addd79e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('592dfff0-ea51-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('59de35bc-ea53-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('5a2f7d90-f256-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('5db94ab6-ea51-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('64b495ee-f327-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('64c2cd58-f327-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('66874796-ee12-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('67ba6844-ebda-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('6c989714-ee0a-11e6-ab30-97c0fcae753e', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('6d9511b8-ed99-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('6f039244-f6cd-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('72d7f214-ebc1-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('77f7f454-f8ac-11e6-a12a-f46e471cb539', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('78ca730a-ef49-11e6-aaea-026c172da098', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('78e3af70-f6d1-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('79617eec-f6cb-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('7a85c84c-f256-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('7a8c4c6e-ea52-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('7e586d98-ea50-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('815dc83a-f6cb-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('828c68ce-f6d0-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('831c9652-ebda-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('8468b766-e725-11e6-950e-4cfe156feb4d', 'Franklyn', 'Perez', 'fkop@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('84f72a08-ed99-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('8a98adf2-ea50-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('9059d42a-f6c9-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('90eb7df8-f327-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('937971d0-f8ac-11e6-a12a-f46e471cb539', 'david', 'salcedo', 'hiobairo1993@gmail.com', 'republica dominicana', '', '', '', '', '', ''),
('9567028a-f214-11e6-a4ef-b2a62addd79e', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('97268798-e70c-11e6-950e-4cfe156feb4d', 'Franklyn', 'Salcedo', 'fkop04@gmail.com', 'Republica Dominicana', 'Distrito Nacional', '8298353260', 'Cydeck', 'Calle #18', 'Apartamento Buenos Aires', '10010'),
('97d75aee-f6d1-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('98be3a84-f327-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('9af2efae-ed99-11e6-ab30-97c0fcae753e', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', 'Distrito Nacional', '8298353260', 'Cydeck', 'Roberto Pastoriza #12', '', '10010'),
('9c9b4828-ee0d-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('9cb74982-f327-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('9cd5a700-f6cf-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('9d157a32-ee0b-11e6-ab30-97c0fcae753e', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('a3c16428-f6cf-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('a507f1e8-f329-11e6-96d7-a9350c9deed4', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('ab2187d0-f327-11e6-96d7-a9350c9deed4', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('aed294b2-f6d0-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('b27e6a62-ed45-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('b2d2ddb6-f6cf-11e6-a31c-dd14c8af1764', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('b3e73982-ee0e-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('b41d5d76-f257-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('b420b47c-f256-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('b43a6ba0-ef3c-11e6-b416-b502e98c0160', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('b4ae62ba-f254-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('b50193a2-ebda-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('b953d1a6-f551-11e6-aeef-4c960d7c4b01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('bce45972-f073-11e6-b261-d1f041727803', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('bfa1e6ba-ef3e-11e6-aaea-026c172da098', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('bfde1c2a-f326-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('c2eb9410-ee08-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('c398cabc-ecce-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('c5ef8ec2-ed9b-11e6-ab30-97c0fcae753e', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('c6190544-f256-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('c6d746ea-ee09-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('c9354e4e-ea50-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('cc282618-ef45-11e6-aaea-026c172da098', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('ccd43cfa-f256-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('cd73e8f2-ea51-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('d1b6ea50-f257-11e6-96d7-a9350c9deed4', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('d5f24946-ea52-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('db690fe6-e7e0-11e6-b6d5-cce00160de3c', 'Franklyn', 'Perez', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('dc2326c4-f6cc-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('de0c80f6-e71e-11e6-950e-4cfe156feb4d', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('e25087ec-f6c9-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('e382f3c2-ebd2-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('e3e1e0f2-ea52-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('e4c2ce48-f6d0-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('e53f8f4e-ed9f-11e6-ab30-97c0fcae753e', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('e5fa7eba-ee28-11e6-ab30-97c0fcae753e', 'David', 'Salcedo', 'fkop04@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('ebc90a9c-ea4e-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('ee2b82d4-f32b-11e6-9695-7c008cbf183a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('ee57e9e4-ee0a-11e6-ab30-97c0fcae753e', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('ef123a36-f6ea-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('f02263f0-ea52-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('f3e317d6-ee09-11e6-ab30-97c0fcae753e', 'David', 'salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', '', '', '', '', '', ''),
('f41a1690-f54e-11e6-aeef-4c960d7c4b01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('f727124e-e70b-11e6-950e-4cfe156feb4d', 'David', 'Salcedo', 'hiobairo1993@gmail.com', 'Republica Dominicana', 'Distrito Nacional', '8298353260', 'Cydeck', 'Calle #18, sector Naco', 'Apartamento Los Prados', '10010'),
('f871d7de-ea52-11e6-8e07-23d1aff8cd1a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('f9025348-f3eb-11e6-935c-349b705c7f66', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('fa108c88-f6ce-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('fb02ad9c-f255-11e6-96d7-a9350c9deed4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('fb99e380-ee11-11e6-ab30-97c0fcae753e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('fc720240-f6ce-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('fd74216c-f54a-11e6-aeef-4c960d7c4b01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('ff8c4a44-f6ce-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `type`, `region_id`, `hotel_id`, `payment_information_id`, `confirmation_number`, `bride_name`, `groom_name`, `email`, `wedding_bill_delivery`, `remarks`, `wedding_date`, `wedding_time`, `certificate_first_name`, `certificate_last_name`, `certificate_MI`, `certificate_email`, `certificate_not_my_info`, `arrival`, `departure`, `subtotal`, `discount`, `total`, `payment_method_id`, `last_four_card_numbers`, `status_id`, `created`, `modified`, `is_deleted`) VALUES
('1bd5b65a-f6ce-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '1bd6164a-f6ce-11e6-a31c-dd14c8af1764', 'FBG785b1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:06:17', '2017-02-19 18:06:17', 0),
('214e0292-f6cc-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '214e7e48-f6cc-11e6-a31c-dd14c8af1764', 'aad32G94', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 17:52:07', '2017-02-19 17:52:07', 0),
('26166a6e-f6cf-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '2616e23c-f6cf-11e6-a31c-dd14c8af1764', 'FAD7gc1F', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:13:43', '2017-02-19 18:13:43', 0),
('2881ab06-f6cf-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '28820df8-f6cf-11e6-a31c-dd14c8af1764', 'a2BB4gA9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:13:47', '2017-02-19 18:13:47', 0),
('2a2c88f4-f6cf-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '2a2cf4d8-f6cf-11e6-a31c-dd14c8af1764', 'bGCGBF3A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:13:50', '2017-02-19 18:13:50', 0),
('6f0308d8-f6cd-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '6f039244-f6cd-11e6-a31c-dd14c8af1764', 'BgA533A7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:01:27', '2017-02-19 18:01:27', 0),
('77f78f96-f8ac-11e6-a12a-f46e471cb539', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '77f7f454-f8ac-11e6-a12a-f46e471cb539', '72A9742e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-22', '2017-02-22', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-22 03:10:31', '2017-02-22 03:10:31', 0),
('78e3409e-f6d1-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '78e3af70-f6d1-11e6-a31c-dd14c8af1764', '94Dc6A2F', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:30:21', '2017-02-19 18:30:21', 0),
('79610df4-f6cb-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '79617eec-f6cb-11e6-a31c-dd14c8af1764', 'eGAFAb4D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 17:47:25', '2017-02-19 17:47:25', 0),
('815d3992-f6cb-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '815dc83a-f6cb-11e6-a31c-dd14c8af1764', 'g8AdCaF7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 17:47:39', '2017-02-19 17:47:39', 0),
('828c00a0-f6d0-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '828c68ce-f6d0-11e6-a31c-dd14c8af1764', 'efabd35c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:23:28', '2017-02-19 18:23:28', 0),
('90596b20-f6c9-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '9059d42a-f6c9-11e6-a31c-dd14c8af1764', 'G3b4a618', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 17:33:45', '2017-02-19 17:33:45', 0),
('93790f06-f8ac-11e6-a12a-f46e471cb539', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '937971d0-f8ac-11e6-a12a-f46e471cb539', 'f5d5G7Ag', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-22', '2017-02-22', 30, NULL, 25.5, 'ff97fa8e-c85b-11e6-915d-39adba9ad86b', 5920, '6b5263c2-c7bc-11e6-915d-39adba9ad86b', '2017-02-22 03:11:17', '2017-02-22 03:11:17', 0),
('97d6eece-f6d1-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '97d75aee-f6d1-11e6-a31c-dd14c8af1764', '975286d6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:31:13', '2017-02-19 18:31:13', 0),
('9cd53504-f6cf-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', '9cd5a700-f6cf-11e6-a31c-dd14c8af1764', 'Ccc51D53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:17:03', '2017-02-19 18:17:03', 0),
('a3c0dc56-f6cf-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'a3c16428-f6cf-11e6-a31c-dd14c8af1764', '512c829A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:17:14', '2017-02-19 18:17:14', 0),
('aed233d2-f6d0-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'aed294b2-f6d0-11e6-a31c-dd14c8af1764', 'Cc43CD49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:24:42', '2017-02-19 18:24:42', 0),
('b2d26a84-f6cf-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'b2d2ddb6-f6cf-11e6-a31c-dd14c8af1764', 'af6g4GBf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, 'ff97fa8e-c85b-11e6-915d-39adba9ad86b', NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:17:40', '2017-02-19 18:17:40', 0),
('dc22b2e8-f6cc-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'dc2326c4-f6cc-11e6-a31c-dd14c8af1764', 'bc5daDG2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 17:57:20', '2017-02-19 17:57:20', 0),
('e2500164-f6c9-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'e25087ec-f6c9-11e6-a31c-dd14c8af1764', '7FA45G8d', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 17:36:02', '2017-02-19 17:36:02', 0),
('e4c25efe-f6d0-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'e4c2ce48-f6d0-11e6-a31c-dd14c8af1764', '395g4A8c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:26:13', '2017-02-19 18:26:13', 0),
('ef11d24e-f6ea-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'ef123a36-f6ea-11e6-a31c-dd14c8af1764', 'e9ed5CB2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 21:32:37', '2017-02-19 21:32:37', 0),
('fa101d98-f6ce-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'fa108c88-f6ce-11e6-a31c-dd14c8af1764', '41g4a7G3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:12:30', '2017-02-19 18:12:30', 0),
('fc719ecc-f6ce-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'fc720240-f6ce-11e6-a31c-dd14c8af1764', '13Bb1Aac', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:12:34', '2017-02-19 18:12:34', 0),
('ff8be95a-f6ce-11e6-a31c-dd14c8af1764', 1, '8fc7e7b8-c659-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 'ff8c4a44-f6ce-11e6-a31c-dd14c8af1764', 'agGaaA5G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-19', '2017-02-19', 30, NULL, 25.5, NULL, NULL, '5ed5c774-c7bc-11e6-915d-39adba9ad86b', '2017-02-19 18:12:39', '2017-02-19 18:12:39', 0);

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
('77fe7b80-f8ac-11e6-a12a-f46e471cb539', '93790f06-f8ac-11e6-a12a-f46e471cb539', '6fa6564c-f8ac-11e6-a12a-f46e471cb539', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'david, franklyn', '2017-02-23', '12:00:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-22 03:11:17', '2017-02-22 03:11:17', 0),
('82902662-f6d0-11e6-a31c-dd14c8af1764', 'aed233d2-f6d0-11e6-a31c-dd14c8af1764', '78af9e48-f6d0-11e6-a31c-dd14c8af1764', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, '2017-02-21', '12:01:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-19 18:24:42', '2017-02-19 18:24:42', 0),
('905dcb52-f6c9-11e6-a31c-dd14c8af1764', 'b2d26a84-f6cf-11e6-a31c-dd14c8af1764', '14f88288-f6c7-11e6-a31c-dd14c8af1764', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, '2017-02-21', '12:01:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-19 18:17:40', '2017-02-19 18:17:40', 0),
('97dcab48-f6d1-11e6-a31c-dd14c8af1764', '97d6eece-f6d1-11e6-a31c-dd14c8af1764', '8b022e3e-f6d1-11e6-a31c-dd14c8af1764', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'David Salcedo, Franklyn Perez', '2017-02-25', '13:00:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-19 18:31:13', '2017-02-19 18:31:13', 0),
('e4c86524-f6d0-11e6-a31c-dd14c8af1764', '78e3409e-f6d1-11e6-a31c-dd14c8af1764', 'dd5860fa-f6d0-11e6-a31c-dd14c8af1764', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'David, Salcedo', '2017-02-21', '12:01:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-19 18:30:21', '2017-02-19 18:30:21', 0),
('ef190fe6-f6ea-11e6-a31c-dd14c8af1764', 'ef11d24e-f6ea-11e6-a31c-dd14c8af1764', 'e0adff02-f6ea-11e6-a31c-dd14c8af1764', '9a263a3e-c659-11e6-915d-39adba9ad86b', 'David Salcedo, Franklyn Perez', '2017-02-21', '12:00:00', 25.5, 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', '2017-02-19 21:32:37', '2017-02-19 21:32:37', 0);

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
('a79eb382-c65b-11e6-915d-39adba9ad86b', '9a263a3e-c659-11e6-915d-39adba9ad86b', '1072aa4c-c65a-11e6-915d-39adba9ad86b', '50c5f852-c667-11e6-915d-39adba9ad86b', 0),
('d09eb382-c65b-11e6-915d-39adba9ad86b', '9a263a3e-c659-11e6-915d-39adba9ad86b', '1072aa4c-c65a-11e6-915d-39adba9ad86b', 'f1c5f852-c667-11e6-915d-39adba9ad86b', 0),
('e0947c0e-c65b-11e6-915d-39adba9ad86b', '1a298596-c659-11e6-915d-39adba9ad86b', '1072aa4c-c65a-11e6-915d-39adba9ad86b', '50c5f852-c667-11e6-915d-39adba9ad86b', 0);

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
('5e967a70-f7ae-11e6-9867-1e874eefc305', 'hd4QWuhDLoRh1iMlD0gBF4LJ0v1zdW2jKkMRRs3G', '2017-02-20 20:51:36', 0),
('6fa5b764-f8ac-11e6-a12a-f46e471cb539', 'AZsvVKXHDYCyYazRzMOZw7OAikXZmo95tpxUf6OH', '2017-02-22 03:10:17', 0),
('7ac23b02-f6d3-11e6-a31c-dd14c8af1764', 'VZkRSS1mMIIJTBvwogCkJk3rdDgGdYgMBOy1jM2H', '2017-02-19 18:44:43', 0),
('8b01994c-f6d1-11e6-a31c-dd14c8af1764', 'H9XY5d0asHlcj91fW2AzHXB5zji7aJ9mvcisL1fg', '2017-02-19 18:30:52', 0),
('9865f4d0-f892-11e6-a12a-f46e471cb539', 'ujpttzfzvhxVSp2XvmwSEIpNqCBjuZ85Ijks4kLL', '2017-02-22 00:05:18', 0),
('dbaae3b6-f6d2-11e6-a31c-dd14c8af1764', 'E0WAkkXNg6OC8GPj1oVCDRjXSk2MUDG72JHZXi5W', '2017-02-19 18:40:17', 0),
('dd57b8c6-f6d0-11e6-a31c-dd14c8af1764', 'H5UFBcPqBzIiU1VbrvCyvkbp2APCmQ9THqxLZv6p', '2017-02-19 18:26:00', 0),
('e0ad764a-f6ea-11e6-a31c-dd14c8af1764', 'n88btXSkSlg2acOOEGnyMBlElcdLQFHluzaaG0Ec', '2017-02-19 21:32:13', 0);

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
('5e9774e8-f7ae-11e6-9867-1e874eefc305', '5e967a70-f7ae-11e6-9867-1e874eefc305', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, '2017-02-20', 0),
('6fa6564c-f8ac-11e6-a12a-f46e471cb539', '6fa5b764-f8ac-11e6-a12a-f46e471cb539', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, 'david, franklyn', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-23', '12:00:00', 1, NULL, NULL, '2017-02-22', 0),
('7ac32382-f6d3-11e6-a31c-dd14c8af1764', '7ac23b02-f6d3-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '100', '2017-02-19', 0),
('8b022e3e-f6d1-11e6-a31c-dd14c8af1764', '8b01994c-f6d1-11e6-a31c-dd14c8af1764', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, 'David Salcedo, Franklyn Perez', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-25', '13:00:00', 1, NULL, NULL, '2017-02-19', 0),
('9866cd56-f892-11e6-a12a-f46e471cb539', '9865f4d0-f892-11e6-a12a-f46e471cb539', NULL, '97698a62-f859-11e6-a12a-f46e471cb539', NULL, NULL, 1, NULL, NULL, 3, NULL, NULL, '2017-02-22', 0),
('dbac2a82-f6d2-11e6-a31c-dd14c8af1764', 'dbaae3b6-f6d2-11e6-a31c-dd14c8af1764', NULL, NULL, NULL, NULL, 1, NULL, NULL, 2, 1, '150', '2017-02-19', 0),
('dd5860fa-f6d0-11e6-a31c-dd14c8af1764', 'dd57b8c6-f6d0-11e6-a31c-dd14c8af1764', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, 'David, Salcedo', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-21', '12:01:00', 1, NULL, NULL, '2017-02-19', 0),
('e0adff02-f6ea-11e6-a31c-dd14c8af1764', 'e0ad764a-f6ea-11e6-a31c-dd14c8af1764', '9a263a3e-c659-11e6-915d-39adba9ad86b', NULL, 'David Salcedo, Franklyn Perez', 'b6eb160c-c7ea-11e6-915d-39adba9ad86b', 1, '2017-02-21', '12:00:00', 1, NULL, NULL, '2017-02-19', 0);

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
('35c85ba4-f853-11e6-a12a-f46e471cb539', 'Riu Indulgence Wedding Package', '', 1, 1, '2017-02-21 00:00:00', 0);

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
('2rf2746-f856-11e6-a12a-f46e471cb253', '50c5f852-c667-11e6-915d-39adba9ad86b', '3ebd836c-r0o2-11e6-8e07-23d1aff8cd1a', 'Riu Free Wedding Package aruba/riu place aruba');

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
  `active_discount` tinyint(1) NOT NULL DEFAULT '0',
  `reference_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wedding_package_category_relation`
--

INSERT INTO `wedding_package_category_relation` (`id`, `wedding_package_id`, `wedding_package_category_id`, `price`, `discount`, `active_discount`, `reference_name`) VALUES
('97698a62-f859-11e6-a12a-f46e471cb539', '35c847c2-f853-11e6-a12a-f46e471cb539', '3ebd836c-r0o2-11e6-8e07-23d1aff8cd1a', '0', '0', 0, 'aruba/riu palace aruba'),
('f6c16fd6-f857-11e6-a12a-f46e471cb539', '35c847c2-f853-11e6-a12a-f46e471cb539', '3ebd836c-r0o2-11e6-8e07-23d1aff8cd1a', '0', '0', 0, 'aruba/riu palace antillas');

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

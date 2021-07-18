-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 13, 2021 at 05:35 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--
CREATE DATABASE IF NOT EXISTS `phpmotors` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `phpmotors`;

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used'),
(16, 'Lemon');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(4, 'Cat', 'Manmax', 'cats@example.com', '$2y$10$xmiIY0c4mmXzLDSLcM/ABeEZeM3UjEzRESi0oR/NvplFlAx9ACtEu', '1', NULL),
(5, 'Matthew', 'Hummer', 'matt@example.com', '$2y$10$5CIdHn3a6z7RcMqPQBgUYeCOoVs36yfgGSlUs24OzHAE51756RJpu', '3', NULL),
(6, 'Butt', 'Butts', 'butt@example.com', '$2y$10$Ljbv0VkaX4Va5IOaeuFHuuvRMOfUu31CWLRLv8kD93aDiquRYolMO', '1', NULL),
(7, 'Admin', 'User', 'admin@cse340.net', '$2y$10$KUP4BopdrUgDM34sRTnNBOfgyb93FNQJWMDKoExuiajztjGfvIN7u', '3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `imgPath` varchar(150) NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(29, 12, 'dda6cc52cf3c2bb22598e1c39497daee.jpg', '/phpmotors/assets/images/vehicles/12/dda6cc52cf3c2bb22598e1c39497daee.jpg', '2021-06-29 03:54:42', 0),
(30, 12, 'dda6cc52cf3c2bb22598e1c39497daee-tn.jpg', '/phpmotors/assets/images/vehicles/12/dda6cc52cf3c2bb22598e1c39497daee-tn.jpg', '2021-06-29 03:54:42', 0),
(31, 12, 'Hummer_H2_.jpg', '/phpmotors/assets/images/vehicles/12/Hummer_H2_.jpg', '2021-06-29 03:54:54', 1),
(32, 12, 'Hummer_H2_-tn.jpg', '/phpmotors/assets/images/vehicles/12/Hummer_H2_-tn.jpg', '2021-06-29 03:54:54', 1),
(33, 12, '20-h2-23-1603227207.jpg', '/phpmotors/assets/images/vehicles/12/20-h2-23-1603227207.jpg', '2021-06-29 03:55:31', 0),
(34, 12, '20-h2-23-1603227207-tn.jpg', '/phpmotors/assets/images/vehicles/12/20-h2-23-1603227207-tn.jpg', '2021-06-29 03:55:31', 0),
(35, 9, '1md4y8j44yu11.jpg', '/phpmotors/assets/images/vehicles/9/1md4y8j44yu11.jpg', '2021-06-29 04:00:14', 0),
(36, 9, '1md4y8j44yu11-tn.jpg', '/phpmotors/assets/images/vehicles/9/1md4y8j44yu11-tn.jpg', '2021-06-29 04:00:14', 0),
(37, 9, 'images.jpg', '/phpmotors/assets/images/vehicles/9/images.jpg', '2021-06-29 04:00:26', 0),
(38, 9, 'images-tn.jpg', '/phpmotors/assets/images/vehicles/9/images-tn.jpg', '2021-06-29 04:00:26', 0),
(39, 9, 'index.jpg', '/phpmotors/assets/images/vehicles/9/index.jpg', '2021-06-29 04:00:37', 1),
(40, 9, 'index-tn.jpg', '/phpmotors/assets/images/vehicles/9/index-tn.jpg', '2021-06-29 04:00:37', 1),
(41, 5, '43_FACE_ACOGGIN_DamselsOfDestruction_LO.jpg', '/phpmotors/assets/images/vehicles/5/43_FACE_ACOGGIN_DamselsOfDestruction_LO.jpg', '2021-06-29 04:05:38', 0),
(42, 5, '43_FACE_ACOGGIN_DamselsOfDestruction_LO-tn.jpg', '/phpmotors/assets/images/vehicles/5/43_FACE_ACOGGIN_DamselsOfDestruction_LO-tn.jpg', '2021-06-29 04:05:38', 0),
(43, 5, '214f07e6ce6abb801cc2d13697d8ea66.jpg', '/phpmotors/assets/images/vehicles/5/214f07e6ce6abb801cc2d13697d8ea66.jpg', '2021-06-29 04:05:58', 0),
(44, 5, '214f07e6ce6abb801cc2d13697d8ea66-tn.jpg', '/phpmotors/assets/images/vehicles/5/214f07e6ce6abb801cc2d13697d8ea66-tn.jpg', '2021-06-29 04:05:58', 0),
(45, 5, 'ph-cc-4hfair-demo-derby-20160806.jpg', '/phpmotors/assets/images/vehicles/5/ph-cc-4hfair-demo-derby-20160806.jpg', '2021-06-29 04:06:23', 1),
(46, 5, 'ph-cc-4hfair-demo-derby-20160806-tn.jpg', '/phpmotors/assets/images/vehicles/5/ph-cc-4hfair-demo-derby-20160806-tn.jpg', '2021-06-29 04:06:23', 1),
(47, 6, 'batmobile.jpg', '/phpmotors/assets/images/vehicles/6/batmobile.jpg', '2021-06-30 12:57:45', 1),
(48, 6, 'batmobile-tn.jpg', '/phpmotors/assets/images/vehicles/6/batmobile-tn.jpg', '2021-06-30 12:57:45', 1),
(49, 44, 'delorean.png', '/phpmotors/assets/images/vehicles/44/delorean.png', '2021-06-30 13:14:19', 1),
(50, 44, 'delorean-tn.png', '/phpmotors/assets/images/vehicles/44/delorean-tn.png', '2021-06-30 13:14:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(11) NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep!', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. Its great for everyday driving as well as offroading weather that be on the the rocks or in the mud!', '/images/jeep-wrangler.jpg', '/images/jeep-wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want as long as it\'s black.', '/images/ford-modelt.jpg', '/images/ford-modelt-tn.jpg', '30000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws. ', '/images/lambo-Adve.jpg', '/images/lambo-Adve-tn.jpg', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. this beast comes with 60in tires giving you tracktions needed to jump and roll in the mud. It is cool.', '/phpmotors/assets/images/vehicles/4/img.jpg', '/phpmotors/assets/images/vehicles/4/img.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. however with a little tlc it will run as good a new. It&#39;s not junk, we swear!', 'ph-cc-4hfair-demo-derby-20160806.jpg', 'ph-cc-4hfair-demo-derby-20160806-tn.jpg', '100', 200, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a super hero? now you can with the batmobile. This car allows you to switch to bike mode allowing you to easily maneuver through trafic during rush hour.', 'batmobile.jpg', 'batmobile-tn.jpg', '65000', 2, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of there 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/images/mm.jpg', '/images/mm-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000 gallon tank.', '/images/fire-truck.jpg', '/images/fire-truck-tn.jpg', '50000', 2, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equiped with the siren which is convenient for college students running late to class.', 'index.jpg', 'index-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the ar you need! This car has great performance at an affordable price. Own it today!', '/images/camaro.jpg', '/images/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadilac', 'Escalade', 'This stylin car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/images/escalade.jpg', '/images/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go offroading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', 'Hummer_H2_.jpg', 'Hummer_H2_-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rushhour trafic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get them while they last!', '/images/aerocar.jpg', '/images/aerocar-tn.jpg', '1000000', 6, 'Red', 2),
(14, 'FBI', 'Survalence Van', 'do you like police shows? You\'ll feel right at home driving this van, come complete with survalence equipments for and extra fee of $2,000 a month. ', '/images/fbi.jpg', '/images/fbi-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well this car is for you straight from the 90s from Aspen, Colorado we have the orginal Dog Car complete with fluffy ears.  ', '/images/dog.jpg', '/images/dog-tn.jpg', '35000', 1, 'Brown', 2),
(43, 'Make', 'Model', 'description', 'Domestic-feline-tabby-cat.jpg', 'Domestic-feline-tabby-cat-tn.jpg', '1', 1, 'black', 2),
(44, 'DMC', 'Delorean', 'Back to the future, baby!', 'delorean.png', 'delorean-tn.png', '100', 1, 'silver', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(1, 'Hello, World!', '2021-07-10 13:50:12', 44, 7),
(2, 'This car was amazing for smuggling drugs in the 70s and 80s. Unfortunately, the full-steel body made the car very heavy. Between these two things I would give this car a 7/10.', '2021-07-10 15:04:04', 44, 5),
(3, 'You know, I did not mind this car. It was a little sportier than I am used to, but it was surprisingly roomy inside!', '2021-07-10 15:59:41', 44, 4),
(9, 'I feel like giving a review of this machine would give away some of the mystery. Figure it out!', '2021-07-12 01:15:09', 7, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

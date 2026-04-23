-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2026 at 11:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `passion1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `traveler_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `adults` int(11) DEFAULT NULL,
  `children` int(11) DEFAULT NULL,
  `travel_date` date DEFAULT NULL,
  `dateid` date NOT NULL,
  `payment_mode` varchar(50) DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `amountpaid` int(11) NOT NULL,
  `paymentstage` int(11) NOT NULL,
  `status` text NOT NULL,
  `Packageid` int(11) NOT NULL,
  `bookingtime` datetime DEFAULT current_timestamp(),
  `refund` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `traveler_name`, `email`, `contact_no`, `city`, `area`, `pincode`, `adults`, `children`, `travel_date`, `dateid`, `payment_mode`, `total_price`, `amountpaid`, `paymentstage`, `status`, `Packageid`, `bookingtime`, `refund`) VALUES
(30, 'mahi patel', 'mahi@gmail.com', '(+91)9043850169', 'surat', 'mota varachha', '305001', 1, 0, '2026-04-04', '0000-00-00', 'Cash', 20500, 8200, 1, 'confirmed', 111, '2026-04-18 20:52:33', 0),
(31, 'mahi patel', 'mahi@gmail.com', '8153913581', 'surat', 'katargam', '395004', 12, 2, '2026-03-26', '0000-00-00', 'Online', 240500, 96200, 1, 'confirmed', 101, '2026-04-19 14:01:13', 0),
(32, 'shiksha patel', 'shiksha@gmail.com', '8165748394', 'mumbai', 'navi mumbai', '524000', 15, 4, '2026-04-11', '0000-00-00', 'Cash', 348500, 139400, 1, 'cancelled', 111, '2026-04-19 14:07:37', 139400),
(33, 'riya patel', 'riya@gmail.com', '9968745821', 'surat', 'katargam', '395003', 2, -1, '2026-04-19', '0000-00-00', 'Online', 52500, 21000, 1, 'active', 119, '2026-04-19 14:14:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `Hotelid` int(11) NOT NULL,
  `Packageid` int(11) NOT NULL,
  `Night` int(11) NOT NULL,
  `Hotelname` text NOT NULL,
  `Location` text NOT NULL,
  `Service` text NOT NULL,
  `Hotelimg` text NOT NULL,
  `Hotelinlcude` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`Hotelid`, `Packageid`, `Night`, `Hotelname`, `Location`, `Service`, `Hotelimg`, `Hotelinlcude`) VALUES
(1, 101, 1, 'Hotel Auli D', 'Near GMVN Ski Resort Area, Auli Road, Joshimath, Chamoli District, Uttarakhand 246443, India', 'Mountain view rooms, room service, heater facility', 'assets/image/imageswinter/Hotel/Auli1.jpg', 'Breakfast'),
(2, 101, 2, 'The Snow City Resort', 'Near Auli Ropeway Station, Joshimath-Auli Road, Chamoli District, Uttarakhand 246443, India', 'Deluxe rooms, hot water, WiFi', 'assets/image/imageswinter/Hotel/Auli2.jpg', 'Breakfast + Dinner'),
(3, 102, 1, 'Pine Spring Gulmarg', 'Near Gondola Phase 1 Parking Area, Gulmarg Road, Baramulla District, Jammu & Kashmir 193403, India', 'Heated rooms, WiFi, restaurant', 'assets/image/imageswinter/Hotel/Gulmarg1.jpg', 'Breakfast'),
(4, 102, 2, 'Hilltop Hotel Gulmarg', 'Near Gulmarg Golf Course Road, Upper Gulmarg, Baramulla District, Jammu & Kashmir 193403, India', 'Mountain view rooms, restaurant', 'assets/image/imageswinter/Hotel/Gulmarg2.webp', 'Breakfast'),
(5, 102, 3, 'Khaleel Palace Hotel', 'Near Gulmarg Market Road, Tangmarg-Gulmarg Highway, Baramulla District, Jammu & Kashmir 193403, India', 'Deluxe rooms, room heater', 'assets/image/imageswinter/Hotel/Gulmarg3.jpg', 'Breakfast + Dinner'),
(6, 103, 1, 'Hotel Dwarka Residency', 'Near Dwarkadhish Temple, Dwarka, Devbhoomi Dwarka District, Gujarat 361335, India', 'AC rooms, room service', 'assets/image/imageswinter/Hotel/Dwarka1.png', 'Breakfast'),
(7, 104, 1, 'Goa Beach Resort', 'Baga Beach Road, Near Tito’s Lane, Calangute, North Goa District, Goa 403516, India', 'Pool, WiFi, beach access', 'assets/image/imageswinter/Hotel/Goa1.webp', 'Breakfast'),
(8, 104, 2, 'Sea View Hotel', 'Near Calangute Beach Circle, Bardez, North Goa District, Goa 403516, India', 'Beach view rooms, AC, restaurant', 'assets/image/imageswinter/Hotel/Goa2.jpg', 'Breakfast + Dinner'),
(9, 104, 3, 'Palm Grove Stay', 'Anjuna Beach Road, Near Curlies Shack, North Goa District, Goa 403509, India', 'Luxury stay, WiFi, pool', 'assets/image/imageswinter/Hotel/Goa3.jpg', 'Breakfast + Dinner'),
(10, 105, 1, 'Leh Palace Hotel', 'Upper Tukcha Road, Near Leh Palace, Leh, Ladakh 194101, India', 'Heater, WiFi, room service', 'assets/image/imageswinter/Hotel/Ladakh1.jpg', 'Breakfast'),
(11, 105, 2, 'Mountain View Stay', 'Changspa Village Road, Near Shanti Stupa, Leh, Ladakh 194101, India', 'Deluxe rooms, hot water', 'assets/image/imageswinter/Hotel/Ladakh2.webp', 'Breakfast + Dinner'),
(12, 105, 3, 'Snow Land Resort', 'Fort Road, Opposite Leh Main Market, Leh, Ladakh 194101, India', 'WiFi, heater, parking', 'assets/image/imageswinter/Hotel/Ladakh3.jpg', 'Breakfast + Dinner'),
(13, 106, 1, 'Majuli Eco Resort', 'Kamalabari Road, Near Brahmaputra River Bank, Majuli Island, Assam 785106, India', 'Eco stay, nature view', 'assets/image/imageswinter/Hotel/Majuli1.webp', 'Breakfast'),
(14, 106, 2, 'River View Camp', 'Near Garmur Area, Majuli Island, Assam 785106, India', 'Camp stay, cultural experience', 'assets/image/imageswinter/Hotel/Majuli2.jpg', 'Breakfast + Dinner'),
(15, 107, 1, 'Jaipur Heritage Inn', 'MI Road, Near Panch Batti Circle, Jaipur, Jaipur District, Rajasthan 302001, India', 'AC rooms, room service, WiFi', 'assets/image/imageswinter/Hotel/Raj1.webp', 'Breakfast'),
(16, 107, 2, 'Royal Palace Stay', 'Near Hawa Mahal, Badi Chopar, Jaipur, Rajasthan 302002, India', 'Deluxe rooms, parking, restaurant', 'assets/image/imageswinter/Hotel/Raj2.webp', 'Breakfast + Dinner'),
(17, 108, 1, 'Yercaud Hill Resort', 'Lake Road, Near Yercaud Lake, Salem District, Tamil Nadu 636601, India', 'Hill view rooms, room service', 'assets/image/imageswinter/Hotel/Yercaud1.webp', 'Breakfast'),
(18, 108, 2, 'Lake View Stay', 'Near Anna Park, Yercaud, Salem District, Tamil Nadu 636601, India', 'WiFi, hot water, garden area', 'assets/image/imageswinter/Hotel/Yercaud2.webp', 'Breakfast + Dinner'),
(19, 109, 1, 'Patan Heritage Hotel', 'Near Rani Ki Vav, Patan, Patan District, Gujarat 384265, India', 'Traditional rooms, AC, parking', 'assets/image/imageswinter/Hotel/Patan1.webp', 'Breakfast'),
(20, 110, 1, 'Cherai Beach Resort', 'Cherai Beach Road, Near Munambam Junction, Vypin Island, Ernakulam District, Kerala 683514, India', 'Beach view rooms, AC, WiFi', 'assets/image/imagesummer/Hotel/Cherai1.webp', 'Breakfast'),
(21, 110, 2, 'Sea Breeze Hotel', 'Near Cherai Beach Main Road, Vypin Island, Kochi, Kerala 683514, India', 'Deluxe rooms, restaurant, parking', 'assets/image/imagesummer/Hotel/Cherai2.webp', 'Breakfast + Dinner'),
(22, 110, 3, 'Backwater Stay', 'Near Backwater Area, Pallipuram, Vypin Island, Kochi, Kerala 683514, India', 'Backwater view, WiFi, room service', 'assets/image/imagesummer/Hotel/Cherai3.webp', 'Breakfast + Dinner'),
(23, 111, 1, 'Shillong View Hotel', 'Police Bazar Road, Near Central Market, Shillong, East Khasi Hills District, Meghalaya 793001, India', 'Hill view rooms, WiFi', 'assets/image/imagesummer/Hotel/Shillong1.webp', 'Breakfast'),
(24, 111, 2, 'Cloud Stay Resort', 'Laitumkhrah Main Road, Near Cathedral Church, Shillong, Meghalaya 793003, India', 'Deluxe rooms, restaurant, parking', 'assets/image/imagesummer/Hotel/Shillong2.jpg', 'Breakfast + Dinner'),
(25, 111, 3, 'Pine Hill Lodge', 'Upper Shillong Road, Near Elephant Falls, Shillong, Meghalaya 793005, India', 'Nature stay, WiFi, room service', 'assets/image/imagesummer/Hotel/Shillong3.webp', 'Breakfast + Dinner'),
(26, 112, 1, 'Gangtok Hills Hotel', 'MG Marg Road, Near MG Market, Gangtok, East Sikkim District, Sikkim 737101, India', 'Mountain view, WiFi, room service', 'assets/image/imagesummer/Hotel/Gangtok1.webp', 'Breakfast'),
(27, 112, 2, 'Snow View Hotel', 'Upper Sichey Road, Near Secretariat, Gangtok, Sikkim 737101, India', 'Heater, deluxe rooms, parking', 'assets/image/imagesummer/Hotel/Gangtok2.jpg', 'Breakfast + Dinner'),
(28, 112, 3, 'Hilltop Stay', 'Tadong Road, Near Tashi View Point, Gangtok, Sikkim 737102, India', 'WiFi, scenic view, room service', 'assets/image/imagesummer/Hotel/Gangtok3.webp', 'Breakfast + Dinner'),
(29, 113, 1, 'Manali Inn', 'Log Huts Area, Old Manali Road, Kullu District, Himachal Pradesh 175131, India', 'Heater, WiFi, room service', 'assets/image/imagesummer/Hotel/Manali1.webp', 'Breakfast'),
(30, 113, 2, 'Snow Valley Resort', 'Hadimba Temple Road, Near Club House, Manali, Himachal Pradesh 175131, India', 'Deluxe rooms, parking, restaurant', 'assets/image/imagesummer/Hotel/Manali2.webp', 'Breakfast + Dinner'),
(31, 114, 1, 'Mahabaleshwar Resort', 'Near Venna Lake, Panchgani Road, Mahabaleshwar, Satara District, Maharashtra 412806, India', 'Hill view, WiFi, garden', 'assets/image/imagesummer/Hotel/Mahabaleshwar1.webp', 'Breakfast'),
(32, 114, 2, 'Green Valley Stay', 'Old Mahabaleshwar Road, Near Wilson Point, Satara District, Maharashtra 412806, India', 'Nature stay, room service', 'assets/image/imagesummer/Hotel/Mahabaleshwar2.webp', 'Breakfast + Dinner'),
(33, 115, 1, 'Shimla View Hotel', 'The Mall Road, Near Scandal Point, Shimla, Himachal Pradesh 171001, India', 'Hill view rooms, WiFi', 'assets/image/imagesummer/Hotel/Shimla1.webp', 'Breakfast'),
(34, 115, 2, 'Kufri Resort', 'Kufri Road, Near Kufri Fun World, Shimla District, Himachal Pradesh 171012, India', 'Luxury rooms, parking, restaurant', 'assets/image/imagesummer/Hotel/Shimla2.webp', 'Breakfast + Dinner'),
(35, 115, 3, 'Mall Road Stay', 'Near Ridge Ground, Mall Road, Shimla, Himachal Pradesh 171001, India', 'City center stay, WiFi, room service', 'assets/image/imagesummer/Hotel/Shimla3.webp', 'Breakfast + Dinner'),
(36, 116, 1, 'Darjeeling Inn', 'Hill Cart Road, Near Chowrasta Mall, Darjeeling, West Bengal 734101, India', 'Tea garden view, WiFi, room service', 'assets/image/imagesummer/Hotel/Darjeeling1.webp', 'Breakfast'),
(37, 116, 2, 'Hilltop Resort', 'Ghoom Monastery Road, Near Batasia Loop, Darjeeling, West Bengal 734102, India', 'Deluxe rooms, parking, restaurant', 'assets/image/imagesummer/Hotel/Darjeeling2.webp', 'Breakfast + Dinner'),
(38, 116, 3, 'Sunrise Hotel', 'Tiger Hill Road, Near Sunrise Point, Darjeeling, West Bengal 734101, India', 'Mountain view, heater, WiFi', 'assets/image/imagesummer/Hotel/Darjeeling3.webp', 'Breakfast + Dinner'),
(39, 117, 1, 'Rishikesh Camp', 'Shivpuri Road, Near Ganga River Rafting Point, Rishikesh, Dehradun District, Uttarakhand 249192, India', 'Camp stay, adventure activities, meals', 'assets/image/imagesummer/Hotel/Rishikesh1.webp', 'Breakfast'),
(40, 117, 2, 'River Side Camp', 'Marine Drive Road, Near Byasi Bridge, Rishikesh, Uttarakhand 249192, India', 'River view camp, bonfire, music', 'assets/image/imagesummer/Hotel/Rishikesh2.webp', 'Breakfast + Dinner'),
(41, 118, 1, 'Agumbe Nature Stay', 'Sunset View Point Road, Near Agumbe Rainforest Research Station, Shimoga District, Karnataka 577411, India', 'Forest view, eco stay, meals', 'assets/image/monsoon/Hotel/Agumbe1.webp', 'Breakfast'),
(42, 118, 2, 'Rainforest Resort', 'Thirthahalli Road, Near Barkana Falls, Agumbe, Karnataka 577411, India', 'Nature stay, guided tours, WiFi', 'assets/image/monsoon/Hotel/Agumbe2.webp', 'Breakfast + Dinner'),
(43, 119, 1, 'Port Blair Hotel', 'Phoenix Bay Road, Near Cellular Jail, Port Blair, South Andaman District, Andaman & Nicobar Islands 744101, India', 'Sea view rooms, AC, WiFi', 'assets/image/monsoon/Hotel/Andaman1.webp', 'Breakfast'),
(44, 119, 2, 'Havelock Resort', 'Govind Nagar Beach Road, Swaraj Dweep (Havelock Island), Andaman & Nicobar Islands 744211, India', 'Beach resort, pool, restaurant', 'assets/image/monsoon/Hotel/Andaman2.webp', 'Breakfast + Dinner'),
(45, 119, 3, 'Island Resort Stay', 'Beach No. 5 Road, Havelock Island, Andaman & Nicobar Islands 744211, India', 'Luxury stay, beach access, WiFi', 'assets/image/monsoon/Hotel/Andaman3.webp', 'Breakfast + Dinner'),
(46, 119, 4, 'Sea Breeze Stay', 'Neil Island Beach Road, Shaheed Dweep, Andaman & Nicobar Islands 744104, India', 'Ocean view, peaceful stay, AC rooms', 'assets/image/monsoon/Hotel/Andaman4.webp', 'Breakfast + Dinner'),
(47, 120, 1, 'Meghalaya Hills Hotel', 'GS Road, Near Police Bazar, Shillong, East Khasi Hills District, Meghalaya 793001, India', 'Hill view, WiFi, room service', 'assets/image/monsoon/Hotel/Meghalay1.webp', 'Breakfast'),
(48, 120, 2, 'Cherrapunji Resort', 'Sohra Road, Near Nohkalikai Falls, East Khasi Hills District, Meghalaya 793108, India', 'Waterfall view, luxury stay', 'assets/image/monsoon/Hotel/Meghalay2.webp', 'Breakfast + Dinner'),
(49, 120, 3, 'Nature Stay Meghalaya', 'Mawlynnong Village Road, Near Living Root Bridge, East Khasi Hills District, Meghalaya 793109, India', 'Eco stay, village experience', 'assets/image/monsoon/Hotel/Meghalay3.webp', 'Breakfast + Dinner'),
(50, 121, 1, 'Base Camp Stay', 'Govindghat Road, Near Alaknanda River, Chamoli District, Uttarakhand 246443, India', 'Camp stay, basic facilities', 'assets/image/monsoon/Hotel/VallyOfFlower1.webp', 'Breakfast'),
(51, 121, 2, 'Mountain Camp', 'Ghangaria Trek Route, Near Valley Entry Gate, Chamoli District, Uttarakhand 246443, India', 'Tent stay, trekking support', 'assets/image/monsoon/Hotel/VallyOfFlower2.webp', 'Breakfast + Dinner'),
(52, 121, 3, 'Hill Lodge', 'Near Hemkund Sahib Trail, Ghangaria, Chamoli District, Uttarakhand 246443, India', 'Basic lodge, meals, rest area', 'assets/image/monsoon/Hotel/VallyOfFlower3.webp', 'Breakfast + Dinner'),
(53, 122, 1, 'Pondicherry Beach Hotel', 'Beach Road, Near Rock Beach Promenade, White Town, Puducherry 605001, India', 'Beach view rooms, AC, WiFi', 'assets/image/monsoon/Hotel/Pondicherry1.jpg', 'Breakfast'),
(54, 122, 2, 'French Colony Stay', 'Rue Suffren Street, Near Aurobindo Ashram, White Town, Puducherry 605001, India', 'Heritage stay, WiFi, café', 'assets/image/monsoon/Hotel/Pondicherry2.webp', 'Breakfast + Dinner'),
(55, 123, 1, 'Spiti Base Camp', 'Kaza Road, Near Bus Stand, Kaza, Lahaul and Spiti District, Himachal Pradesh 172114, India', 'Mountain stay, basic rooms, meals', 'assets/image/monsoon/Hotel/SpitiVally1.webp', 'Breakfast'),
(56, 123, 2, 'Monastery Stay', 'Tabo Monastery Road, Near Tabo Village, Lahaul and Spiti District, Himachal Pradesh 172113, India', 'Cultural stay, local food', 'assets/image/monsoon/Hotel/SpitiVally2.webp', 'Breakfast + Dinner'),
(57, 123, 3, 'Village Homestay', 'Langza Village Road, Near Buddha Statue, Spiti Valley, Himachal Pradesh 172114, India', 'Local homestay, mountain view', 'assets/image/monsoon/Hotel/SpitiVally3.webp', 'Breakfast + Dinner'),
(58, 123, 4, 'Hilltop Camp', 'Chandratal Lake Road, Near Camping Site, Spiti Valley, Himachal Pradesh 172114, India', 'Camp stay, bonfire, scenic view', 'assets/image/monsoon/Hotel/SpitiVally4.webp', 'Breakfast + Dinner'),
(59, 124, 1, 'Saputara Hill Stay', 'Saputara Lake Road, Near Sunset Point, Dang District, Gujarat 394720, India', 'Hill view rooms, AC, parking', 'assets/image/monsoon/Hotel/Saputara1.webp', 'Breakfast'),
(60, 125, 1, 'Maldives Luxury Resort', 'North Male Atoll, Near Velana International Airport, Kaafu Atoll 20026, Maldives', 'Private villa, infinity pool, beach access', 'assets/image/monsoon/Hotel/Maldive1.webp', 'All Meals'),
(61, 125, 2, 'Ocean Villa Maldives', 'North Male Atoll, Overwater Villa Area, Kaafu Atoll 20026, Maldives', 'Water villa, sea view, luxury stay', 'assets/image/monsoon/Hotel/Maldive2.webp', 'All Meals'),
(62, 125, 3, 'Beach Villa Resort', 'Beachfront Area, Kaafu Atoll, Maldives', 'Private beach, AC villa, WiFi', 'assets/image/monsoon/Hotel/Maldive3.webp', 'All Meals'),
(63, 125, 4, 'Water Villa Stay', 'Lagoon Area, Overwater Villas Section, Kaafu Atoll, Maldives', 'Luxury water villa, ocean access', 'assets/image/monsoon/Hotel/Maldive4.webp', 'All Meals');

-- --------------------------------------------------------

--
-- Table structure for table `itinerary`
--

CREATE TABLE `itinerary` (
  `Packageid` int(11) NOT NULL,
  `Day` text NOT NULL,
  `Text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itinerary`
--

INSERT INTO `itinerary` (`Packageid`, `Day`, `Text`) VALUES
(101, '1', 'Travel from Surat to Joshimath and hotel check-in'),
(101, '2', 'Visit Auli ropeway, skiing point and local sightseeing'),
(101, '3', 'Morning mountain view and return journey'),
(102, '1', 'Arrival in Srinagar and transfer to Gulmarg'),
(102, '2', 'Gondola ride and snow activities'),
(102, '3', 'Gulmarg sightseeing and local market visit'),
(102, '4', 'Return journey'),
(103, '1', 'Arrival in Dwarka and Dwarkadhish Temple visit'),
(103, '2', 'Bet Dwarka and return journey'),
(104, '1', 'Arrival in Goa and hotel check-in'),
(104, '2', 'Visit beaches and enjoy water activities'),
(104, '3', 'Visit churches and local markets'),
(104, '4', 'Return journey'),
(105, '1', 'Arrival in Leh and rest'),
(105, '2', 'Local sightseeing and monasteries'),
(105, '3', 'Visit Pangong Lake'),
(105, '4', 'Return journey'),
(106, '1', 'Arrival and transfer to Majuli Island'),
(106, '2', 'Visit satras and local villages'),
(106, '3', 'Return journey'),
(107, '1', 'Arrival in Jaipur and hotel check-in'),
(107, '2', 'Visit Amer Fort, City Palace'),
(107, '3', 'Local market and return journey'),
(108, '1', 'Arrival and hotel check-in'),
(108, '2', 'Visit lake and viewpoints'),
(108, '3', 'Return journey'),
(109, '1', 'Arrival and visit Rani Ki Vav'),
(109, '2', 'Return journey'),
(110, '1', 'Arrival and hotel check-in'),
(110, '2', 'Beach and backwater visit'),
(110, '3', 'Local sightseeing'),
(110, '4', 'Return journey'),
(111, '1', 'Arrival and transfer to Shillong'),
(111, '2', 'Visit waterfalls and hills'),
(111, '3', 'Local sightseeing'),
(111, '4', 'Return journey'),
(112, '1', 'Arrival and hotel check-in'),
(112, '2', 'Visit Tsomgo Lake'),
(112, '3', 'Local sightseeing'),
(112, '4', 'Return journey'),
(113, '1', 'Arrival and hotel check-in'),
(113, '2', 'Visit temples and local market'),
(113, '3', 'Solang Valley visit'),
(113, '4', 'Return journey'),
(114, '1', 'Arrival and hotel check-in'),
(114, '2', 'Visit viewpoints and farms'),
(114, '3', 'Return journey'),
(115, '1', 'Arrival and hotel check-in'),
(115, '2', 'Visit Kufri and Mall Road'),
(115, '3', 'Local sightseeing'),
(115, '4', 'Return journey'),
(116, '1', 'Arrival and hotel check-in'),
(116, '2', 'Tiger Hill and tea garden visit'),
(116, '3', 'Local sightseeing'),
(116, '4', 'Return journey'),
(117, '1', 'Arrival and camp check-in'),
(117, '2', 'River rafting'),
(117, '3', 'Ganga Aarti and return'),
(118, '1', 'Arrival and rainforest visit'),
(118, '2', 'Waterfalls sightseeing'),
(118, '3', 'Return journey'),
(119, '1', 'Arrival and hotel check-in'),
(119, '2', 'Beach and water activities'),
(119, '3', 'Island sightseeing'),
(119, '4', 'Leisure day'),
(119, '5', 'Return journey'),
(120, '1', 'Arrival and transfer'),
(120, '2', 'Visit Cherrapunji'),
(120, '3', 'Waterfalls and bridges'),
(120, '4', 'Return journey'),
(121, '1', 'Arrival and base camp stay'),
(121, '2', 'Trek and explore valley'),
(121, '3', 'Return trek'),
(121, '4', 'Return journey'),
(122, '1', 'Arrival and hotel check-in'),
(122, '2', 'Beach and French colony visit'),
(122, '3', 'Return journey'),
(123, '1', 'Arrival and hotel check-in'),
(123, '2', 'Monastery visit'),
(123, '3', 'Village exploration'),
(123, '4', 'Local sightseeing'),
(123, '5', 'Return journey'),
(124, '1', 'Arrival and sightseeing'),
(124, '2', 'Return journey'),
(125, '1', 'Arrival and resort check-in'),
(125, '2', 'Beach and water sports'),
(125, '3', 'Leisure day'),
(125, '4', 'Sunset View Port'),
(125, '5', 'Return journey');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `Pid` int(11) NOT NULL,
  `Packageid` int(11) NOT NULL,
  `Packagename` text NOT NULL,
  `Duration` text NOT NULL,
  `Packageprice` int(11) NOT NULL,
  `Transportation` text NOT NULL,
  `Pickuplocation` text NOT NULL,
  `Departuretime` text NOT NULL,
  `Overview` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`Pid`, `Packageid`, `Packagename`, `Duration`, `Packageprice`, `Transportation`, `Pickuplocation`, `Departuretime`, `Overview`) VALUES
(1, 101, 'Auli Snow Adventure Package', '3 Days / 2 Nights', 18500, 'Volvo Bus', 'Sahara Darwaja, Ring Road', '8 : 30 PM', 'Auli is a beautiful ski destination in Uttarakhand known for its snow-covered mountains and scenic Himalayan views. This package includes sightseeing of Auli’s famous attractions like Auli Ropeway, Gurso Bugyal, and nearby hill landscapes. Travelers can enjoy snow activities, peaceful nature walks, and stunning sunrise views of Nanda Devi peak. It is a perfect destination for adventure lovers and nature enthusiasts looking for a relaxing winter holiday.'),
(2, 102, 'Gulmarg Winter Wonderland Package', '4 Days / 3 Nights', 18500, 'Volvo Sleeper Bus', 'Adajan Bus Stand, Surat', '04 : 30 PM', 'Gulmarg is known for its beautiful snowfields and skiing adventures. The tour includes visits to the Gulmarg Gondola, snow activities, and breathtaking views of the Himalayan mountains.'),
(3, 103, 'Dwarka Divine Pilgrimage Package', '2 Days / 1 Night', 12500, 'AC Seater Bus', 'Varachha Flyover Surat', '06 : 00 PM', 'Dwarka is one of the most sacred pilgrimage destinations dedicated to Lord Krishna. Visitors can explore temples, coastal views, and peaceful spiritual surroundings.'),
(4, 104, 'Goa Beach Fun Package', '4 Days / 3 Nights', 17500, 'Volvo Bus', 'Surat Central', '07 : 00 PM', 'Enjoy beaches, nightlife and water sports in Goa. Visit Baga and Calangute beaches, churches and markets. Package includes Volvo bus travel and 3 nights stay in a deluxe beach resort.'),
(7, 105, 'Leh Ladakh Short Adventure', '4 Days / 3 Nights', 28500, 'Volvo Ac Semi-Sleeper Bus', 'Ring Road, Surat', '09 : 00 PM', 'Visit Jaipur and nearby attractions including forts and palaces. Experience royal heritage and culture.'),
(8, 106, 'Majuli Island Nature Package', '3 Days / 2 Nights', 16500, 'Volvo Sleeper Bus', 'Adajan, Surat', '06 : 30 AM', 'Discover Majuli Island’s culture and nature. Visit satras, villages, and enjoy eco-friendly stays.'),
(10, 107, 'Rajasthan Heritage Tour', '3 Days / 2 Nights', 15000, 'Volvo AC Semi-Sleeper Bus + Cab', 'Ring Road, Surat', '09 : 00 PM', 'Visit Jaipur and nearby attractions including forts and palaces. Experience royal heritage and culture.'),
(11, 108, 'Yercaud Hill Station Package', '3 Days / 2 Nights', 15000, 'AC Sleeper Bus', 'Varachha , Surat', '05 : 30 PM', 'Relax in Yercaud with lakes, gardens, and scenic viewpoints. Perfect for a peaceful hill getaway.'),
(12, 109, 'Patan Heritage Tour', '2 Days / 1 Night', 10000, 'Non-Ac Seater Bus', 'Adajan, Surat', '06 : 30 AM', 'Explore Rani Ki Vav and heritage sites of Patan. Enjoy historical architecture and cultural beauty.'),
(14, 110, 'Cherai Beach Kerala Package', '4 Days / 3 Nights', 19500, 'Cab', 'Surat Airport', '07:00 AM', 'Enjoy Cherai Beach with backwaters and coastal beauty. Relax in sea-view resorts and explore nature.'),
(15, 111, 'Shillong Scenic Tour', '4 Days / 3 Nights', 20500, 'Cab', 'Surat Airport', '06:00 AM', 'Explore Shillong waterfalls, hills, and nearby attractions. Enjoy scenic beauty and peaceful surroundings.'),
(16, 112, 'Gangtok Hill Tour', '4 Days / 3 Nights', 20000, 'Private Cab', 'Bagdogra Pickup', '07:00 AM', 'Visit MG Road, Tsomgo Lake and enjoy mountain views in Gangtok.'),
(17, 113, 'Manali Summer Trip', '3 Days / 2 Nights', 15500, 'Volvo AC Sleeper Bus', 'Surat', '08:00 PM', 'Enjoy cool weather, valleys and adventure activities in Manali.'),
(18, 114, 'Mahabaleshwar Retreat', '3 Days / 2 Nights', 12000, 'Mini AC Bus', 'Surat', '07:30 AM', 'Visit viewpoints, strawberry farms and lush greenery.'),
(19, 115, 'Shimla Hill Tour', '4 Days / 3 Nights', 17000, 'Volvo Bus', 'Surat', '09:00 PM', 'Explore Mall Road, Kufri and scenic hill beauty of Shimla.'),
(20, 116, 'Darjeeling Tea Garden Tour', '4 Days / 3 Nights', 18000, 'AC Cab', 'Bagdogra Pickup', '06:30 AM', 'Visit tea gardens, Tiger Hill and enjoy Himalayan sunrise.'),
(24, 117, 'Rishikesh Adventure Camp', '3 Days / 2 Nights', 14000, 'Volvo Bus', 'Surat', '08:30 PM', 'Enjoy river rafting, camping and Ganga Aarti experience.'),
(25, 118, 'Agumbe Rainforest Tour', '3 Days / 2 Nights', 15000, 'Cab', 'Mangalore Pickup', '07:00 AM', 'Explore rainforest, waterfalls and scenic monsoon beauty.'),
(26, 119, 'Andaman Island Package', '5 Days / 4 Nights', 35000, 'Private Cab', 'Port Blair Pickup', '08:00 AM', 'Enjoy beaches, water sports and island sightseeing.'),
(27, 120, 'Meghalaya Monsoon Tour', '4 Days / 3 Nights', 20000, 'SUV Cab', 'Guwahati Pickup', '06:00 AM', 'Visit Cherrapunji, waterfalls and living root bridges.'),
(28, 121, 'Valley of Flowers Trek', '4 Days / 3 Nights', 18000, 'Bus + Cab', 'Haridwar', '05:00 AM', 'Witness colorful flowers and scenic Himalayan trekking experience.'),
(29, 122, 'Pondicherry Beach Tour', '3 Days / 2 Nights', 16000, 'AC Bus', 'Surat', '06:00 PM', 'Enjoy French culture, beaches and peaceful vibes.'),
(30, 123, 'Spiti Valley Adventure', '5 Days / 4 Nights', 28000, 'SUV Cab', 'Manali Pickup', '07:00 AM', 'Explore cold desert, monasteries and remote villages.'),
(32, 124, 'Saputara Monsoon Trip', '2 Days / 1 Night', 8500, 'Cab', 'Surat', '06:30 AM', 'Enjoy greenery, waterfalls and peaceful hill environment.'),
(33, 125, 'Maldives Luxury Escape', '5 Days / 4 Nights', 50000, 'Private Cab', 'Male Pickup', '09:00 AM', 'Relax in luxury resorts with beaches and crystal-clear water.');

-- --------------------------------------------------------

--
-- Table structure for table `package_date`
--

CREATE TABLE `package_date` (
  `dateid` int(11) NOT NULL,
  `Packageid` int(11) NOT NULL,
  `TravelDate` date NOT NULL,
  `Bus` int(11) NOT NULL,
  `Capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_date`
--

INSERT INTO `package_date` (`dateid`, `Packageid`, `TravelDate`, `Bus`, `Capacity`) VALUES
(1, 101, '2026-03-26', 1, 40),
(2, 101, '2026-04-02', 2, 45),
(3, 102, '2026-03-29', 3, 35),
(4, 102, '2026-04-03', 1, 40),
(5, 102, '2026-04-09', 2, 40),
(6, 103, '2026-04-03', 4, 37),
(7, 103, '2026-04-12', 5, 35),
(8, 104, '2026-03-28', 4, 45),
(9, 104, '2026-04-04', 5, 45),
(10, 104, '2026-04-13', 6, 40),
(11, 105, '2026-03-29', 5, 37),
(12, 105, '2026-04-05', 6, 44),
(13, 105, '2026-04-14', 7, 40),
(14, 106, '2026-04-06', 7, 45),
(15, 106, '2026-04-15', 1, 40),
(16, 107, '2026-03-31', 7, 50),
(17, 107, '2026-04-07', 1, 50),
(18, 107, '2026-04-16', 2, 50),
(19, 108, '2026-04-01', 1, 40),
(20, 108, '2026-04-17', 3, 45),
(21, 109, '2026-04-02', 2, 37),
(22, 109, '2026-04-09', 3, 35),
(23, 109, '2026-04-18', 4, 40),
(24, 110, '2026-04-03', 3, 45),
(25, 110, '2026-04-10', 4, 40),
(26, 111, '2026-04-04', 4, 50),
(27, 111, '2026-04-11', 5, 40),
(28, 111, '2026-04-20', 6, 41),
(29, 112, '2026-04-05', 5, 37),
(30, 112, '2026-04-12', 6, 40),
(31, 112, '2026-04-21', 7, 37),
(32, 113, '2026-04-06', 6, 40),
(33, 113, '2026-04-13', 7, 44),
(34, 114, '2026-04-07', 7, 45),
(35, 114, '2026-04-14', 1, 50),
(36, 114, '2026-04-23', 2, 47),
(37, 115, '2026-04-08', 1, 50),
(38, 115, '2026-04-15', 2, 50),
(39, 115, '2026-04-24', 3, 45),
(40, 116, '2026-04-16', 3, 45),
(41, 116, '2026-04-25', 4, 37),
(42, 117, '2026-04-10', 3, 37),
(43, 117, '2026-04-17', 4, 40),
(44, 117, '2026-04-26', 5, 37),
(45, 118, '2026-04-11', 4, 44),
(46, 118, '2026-04-27', 6, 47),
(47, 119, '2026-04-12', 5, 50),
(48, 119, '2026-04-19', 6, 40),
(49, 119, '2026-04-28', 7, 40),
(50, 120, '2026-04-13', 6, 41),
(51, 120, '2026-04-20', 7, 37),
(52, 120, '2026-04-29', 1, 39),
(53, 121, '2026-04-14', 7, 40),
(54, 121, '2026-04-30', 2, 50),
(55, 122, '2026-04-15', 1, 55),
(56, 122, '2026-04-22', 2, 47),
(57, 122, '2026-05-01', 3, 37),
(58, 123, '2026-04-16', 2, 40),
(59, 123, '2026-04-23', 3, 40),
(60, 123, '2026-05-02', 4, 45),
(61, 124, '2026-04-17', 3, 45),
(62, 124, '2026-05-03', 5, 50),
(63, 125, '2026-04-18', 4, 55),
(64, 125, '2026-04-25', 5, 50),
(65, 125, '2026-05-04', 6, 55);

-- --------------------------------------------------------

--
-- Table structure for table `package_includes`
--

CREATE TABLE `package_includes` (
  `Iid` int(11) NOT NULL,
  `Packageid` int(11) NOT NULL,
  `Include` text NOT NULL,
  `Exclude` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_includes`
--

INSERT INTO `package_includes` (`Iid`, `Packageid`, `Include`, `Exclude`) VALUES
(1, 101, 'Pickup and drop from nearest bus stand, comfortable transfers and basic assistance during travel', 'Travel from your city to pickup point, skiing and ropeway charges, personal expenses like shopping'),
(2, 101, 'Local sightseeing of Auli and nearby areas with cab, including driver allowance, toll tax and parking', 'Entry tickets, adventure activities and any additional services not mentioned'),
(3, 101, 'Visit to major attractions with proper time management and support', 'Food outside package, tips and travel insurance'),
(4, 102, 'Pickup and drop service from bus stand with comfortable transport arrangements', 'Gondola ride charges, skiing and snow activity costs'),
(5, 102, 'Local sightseeing of Gulmarg valley with driver, fuel and parking included', 'Personal expenses, entry tickets and guide charges'),
(6, 103, 'Pickup and drop with bus transport and assistance for temple visits', 'VIP darshan charges and personal offerings'),
(7, 103, 'Visit to Dwarkadhish temple and nearby attractions with proper guidance', 'Food expenses, shopping and extra services'),
(8, 104, 'Volvo bus travel with pickup and drop, along with beach sightseeing in Goa', 'Water sports, nightlife expenses and personal shopping'),
(9, 104, 'Visit to famous beaches, churches and local markets with transport included', 'Entry tickets, guide charges and extra meals'),
(10, 104, 'All transfers, fuel, toll tax and driver charges included', 'Travel insurance and any additional activities'),
(11, 105, 'Private cab transport with driver, fuel, toll tax and parking for full trip', 'Adventure activities and personal expenses'),
(12, 105, 'Local sightseeing of Leh and nearby attractions with comfortable travel', 'Entry tickets, guide charges and extra meals'),
(13, 105, 'Visit to monasteries and scenic locations with proper itinerary support', 'Travel insurance and additional services'),
(14, 106, 'Pickup and drop with bus transport and local sightseeing of Majuli Island', 'Boat ride charges and personal expenses'),
(15, 106, 'Visit to cultural villages and satras with transportation included', 'Entry fees, guide charges and extra activities'),
(16, 106, 'Driver allowance, fuel and parking included for smooth travel', 'Shopping and insurance costs'),
(17, 107, 'Volvo bus travel with pickup and drop and sightseeing of forts and palaces', 'Entry tickets and personal shopping expenses'),
(18, 107, 'Visit to Jaipur attractions with local transport and driver support', 'Guide charges and extra meals'),
(19, 108, 'Bus transport with pickup and drop and sightseeing of Yercaud hills', 'Boating charges and personal expenses'),
(20, 108, 'Visit to lakes, gardens and viewpoints with comfortable travel', 'Entry fees and guide charges'),
(21, 108, 'Driver allowance, fuel and parking included', 'Extra meals and insurance'),
(22, 109, 'Bus transport and visit to heritage sites like Rani Ki Vav', 'Entry tickets and personal expenses'),
(23, 109, 'Local sightseeing with proper travel arrangements', 'Guide charges and shopping expenses'),
(24, 110, 'Cab transport with pickup and drop and beach sightseeing in Kerala', 'Water activities and personal expenses'),
(25, 110, 'All transfers including fuel, toll and driver charges included', 'Extra meals and insurance'),
(26, 111, 'Pickup and drop from nearest airport or bus stand with comfortable cab transfers and basic travel assistance', 'Entry tickets, personal expenses like shopping and extra meals'),
(27, 111, 'Local sightseeing of Shillong including waterfalls, hills and markets with driver, fuel and parking included', 'Adventure activities, guide charges and travel insurance'),
(28, 111, 'Visit to major attractions with proper itinerary and support during travel', 'Any additional services not mentioned'),
(29, 112, 'Volvo bus transport with pickup and drop along with hotel stay and local sightseeing in Manali', 'Skiing, paragliding and snow activity charges'),
(30, 112, 'Visit to Solang Valley, temples and local markets with driver support and fuel included', 'Entry tickets, personal expenses and extra meals'),
(31, 112, 'All transfers including toll tax, parking and driver allowance covered', 'Travel insurance and additional activities'),
(32, 113, 'Bus transport with pickup and drop and sightseeing of Mahabaleshwar viewpoints and lakes', 'Boating charges, entry fees and personal expenses'),
(33, 113, 'Visit to strawberry farms and local attractions with proper travel arrangements', 'Guide charges and shopping expenses'),
(34, 114, 'Hotel stay with meals and sightseeing of Udaipur lakes and palaces with bus transport', 'Entry tickets, boating charges and personal expenses'),
(35, 114, 'All transfers including pickup, drop, fuel and toll charges included', 'Travel insurance and additional services'),
(36, 115, 'Cab transport with pickup and drop and sightseeing of Mount Abu including lakes and temples', 'Boating charges, entry fees and personal expenses'),
(37, 115, 'Visit to Sunset Point and local attractions with comfortable travel arrangements', 'Guide charges and shopping expenses'),
(38, 115, 'Driver allowance, fuel and parking included', 'Extra meals and insurance'),
(39, 116, 'Bus transport with pickup and drop along with adventure activities like rafting and camp stay in Rishikesh', 'Rafting upgrades, bungee jumping and personal expenses'),
(40, 116, 'Visit to temples and Ganga Aarti with proper travel support and arrangements', 'Entry tickets and guide charges'),
(41, 116, 'All transfers including fuel, toll tax and driver allowance covered', 'Travel insurance and additional services'),
(42, 117, 'Cab transport with pickup and drop and sightseeing of Saputara hills and lake', 'Entry tickets and personal expenses'),
(43, 117, 'Visit to viewpoints and gardens with comfortable travel arrangements', 'Boating charges and guide fees'),
(44, 118, 'Bus transport with pickup and drop and sightseeing of forts and palaces in Rajasthan', 'Entry tickets and personal shopping expenses'),
(45, 118, 'Visit to local markets and attractions with driver support and proper itinerary', 'Guide charges and extra meals'),
(46, 118, 'All transfers including fuel, toll tax and parking included', 'Travel insurance and additional services'),
(47, 119, 'Bus transport with pickup and drop and desert sightseeing with cultural activities', 'Camel ride charges and personal expenses'),
(48, 119, 'Visit to local attractions with proper travel arrangements and driver support', 'Entry tickets and guide charges'),
(49, 119, 'All transfers including fuel, toll tax and parking included', 'Extra meals and insurance'),
(50, 120, 'Cab transport with pickup and drop and sightseeing of hill station and viewpoints', 'Boating charges and personal expenses'),
(51, 120, 'Visit to local attractions with comfortable travel arrangements', 'Entry tickets and guide charges'),
(52, 121, 'Bus transport with pickup and drop and sightseeing of Coorg plantations and waterfalls', 'Entry fees and personal expenses'),
(53, 121, 'Visit to local attractions with driver support and proper itinerary', 'Guide charges and extra activities'),
(54, 121, 'All transfers including fuel, toll tax and parking included', 'Travel insurance and additional services'),
(55, 122, 'Bus transport with pickup and drop and sightseeing of Ooty lakes and gardens', 'Boating charges and personal expenses'),
(56, 122, 'Visit to viewpoints and tea gardens with comfortable travel arrangements', 'Entry tickets and guide charges'),
(57, 123, 'Cab transport with pickup and drop and wildlife safari visit in Gir National Park', 'Safari charges and personal expenses'),
(58, 123, 'Visit to forest areas with proper travel arrangements and driver support', 'Entry tickets and guide charges'),
(59, 123, 'All transfers including fuel, toll tax and parking included', 'Travel insurance and additional services'),
(60, 124, 'Cab transport with pickup and drop and sightseeing of local attractions', 'Entry tickets and personal expenses'),
(61, 124, 'Visit to markets and nearby places with proper travel arrangements', 'Guide charges and shopping expenses'),
(62, 124, 'All transfers including fuel, toll tax and parking included', 'Extra meals and insurance'),
(63, 125, 'Cab transport with pickup and drop and sightseeing of rainforest and waterfalls', 'Entry tickets and personal expenses'),
(64, 125, 'Visit to nature spots with proper travel arrangements and driver support', 'Guide charges and extra activities'),
(65, 126, 'Cab transport with pickup and drop and sightseeing of monasteries and hills in Tawang', 'Entry tickets and personal expenses'),
(66, 126, 'Visit to local attractions with proper travel arrangements and driver support', 'Guide charges and extra activities'),
(67, 126, 'All transfers including fuel, toll tax and parking included', 'Travel insurance and additional services');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `Pid` int(11) NOT NULL,
  `Pname` text NOT NULL,
  `Season` text NOT NULL,
  `Pimg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`Pid`, `Pname`, `Season`, `Pimg`) VALUES
(1, 'Auli,Uttarakhand', 'winter', 'assets\\image\\imageswinter\\Auli,Uttarakhand.jpg'),
(2, 'Gulmarg,Jammu & Kashmir', 'winter', 'assets\\image\\imageswinter\\gulmarg-jummu-kashmir.jpg'),
(3, 'Dwarka', 'winter', 'assets\\image\\imageswinter\\Dwarka.jpg'),
(4, 'Goa', 'winter', 'assets\\image\\imageswinter\\goa.jpg'),
(7, 'Leh-Ladakh, Jammu and Kashmir\r\n', 'winter', 'assets\\image\\imageswinter\\leh-ladakh.jpg'),
(8, 'Majuli Island, Assam', 'winter', 'assets\\image\\imageswinter\\Majuli-Island.jpg'),
(10, 'Rajasthan (Jaipur, Udaipur, Jaisalmer)', 'winter', 'assets\\image\\imageswinter\\Rajasthan(Jaipur,Udaipur,Jaisalmer).jpg'),
(11, 'Yercaud,TamilNadu', 'winter', 'assets\\image\\imageswinter\\Yercaud,TamilNadu.jpg'),
(12, 'Patan, Gujarat', 'winter', 'assets\\image\\imageswinter\\Rani_ki_Vav_Patan.jpg'),
(14, 'Cherai Beach', 'summer', 'assets\\image\\imagesummer\\CheraiBeach.jpg'),
(15, 'Shillong', 'summer', 'assets\\image\\imagesummer\\Shillong.jpg'),
(16, 'Gangtok', 'summer', 'assets\\image\\imagesummer\\Gangtok.jpg'),
(17, 'Manali', 'summer', 'assets\\image\\imagesummer\\Manali.jpg'),
(18, 'Mahabaleshwar', 'summer', 'assets\\image\\imagesummer\\Mahabaleshwar.jpg'),
(19, 'Shimla', 'summer', 'assets\\image\\imagesummer\\Shimla.jpg'),
(20, 'Darjeeling\r\n', 'summer', 'assets\\image\\imagesummer\\Darjeeling.jpg'),
(24, 'Rishikesh', 'summer', 'assets\\image\\imagesummer\\Rishikesh.jpg'),
(25, 'Agumbe', 'monsoon', 'assets\\image\\monsoon\\Agumbe.jpeg'),
(26, 'Andaman Nicobar', 'monsoon', 'assets\\image\\monsoon\\Andaman_Nicobar.jpeg'),
(27, 'Meghalata\r\n', 'monsoon', 'assets\\image\\monsoon\\meghalata.jpeg'),
(28, 'Valley of Flowers', 'monsoon', 'assets\\image\\monsoon\\ValleyofFlowers.jpeg'),
(29, 'Pondicherry', 'monsoon', 'assets\\image\\monsoon\\Pondicherry.jpeg'),
(30, 'Spitivalley', 'monsoon', 'assets\\image\\monsoon\\Spitivalley.jpeg'),
(32, 'Saputara', 'monsoon', 'assets\\image\\monsoon\\Saputara.jpeg'),
(33, 'Maldives', 'monsoon', 'assets\\image\\maldives1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tblgallery`
--

CREATE TABLE `tblgallery` (
  `gid` int(11) NOT NULL,
  `gname` varchar(100) NOT NULL,
  `gimg` varchar(300) NOT NULL,
  `greview` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblgallery`
--

INSERT INTO `tblgallery` (`gid`, `gname`, `gimg`, `greview`) VALUES
(1, 'Leh-Ladakh,Jammu and Kashmir', 'assets\\image\\Gallery\\Leh-Ladakh,JammuandKashmir1.jpg', 'Our trip to Leh-Ladakh with trip time was great. '),
(2, 'Leh-Ladakh,Jammu and Kashmir', 'assets\\image\\Gallery\\Leh-Ladakh,JammuandKashmir2.jpg', 'trip times tour of Kashmir was breathtaking.'),
(3, 'Leh-Ladakh,Jammu and Kashmir', 'assets\\image\\Gallery\\Leh-Ladakh,JammuandKashmir3.jpg', 'Trip times Leh-Ladakh tour was epic! '),
(4, 'Agumbe', 'assets\\image\\Gallery\\Agumbe1.jpeg', ''),
(5, 'Agumbe', 'assets\\image\\Gallery\\Agumbe2.jpeg', ''),
(6, 'Agumbe', 'assets\\image\\Gallery\\Agumbe3.jpeg', ''),
(7, 'Goa', 'assets\\image\\Gallery\\goa1.jpg', 'trip time made our trip to Goa very comfortable. We enjoyed the beaches, nightlife, and water sports without any hassle thanks to their expert guidance'),
(8, 'Goa', 'assets\\image\\Gallery\\goa2.jpg', 'We had a blast in Goa with trip time. Beaches, parties, and water sports were all perfectly planned.'),
(9, 'Goa', 'assets\\image\\Gallery\\goa3.jpg', ''),
(10, 'Rishikesh', 'assets\\image\\Gallery\\rishikesh1.jpeg', 'The spiritual and adventurous vibes in Rishikesh were well-balanced with trip times tour package'),
(11, 'Rishikesh', 'assets\\image\\Gallery\\rishikesh2.jpeg', ''),
(12, 'Rishikesh', 'assets\\image\\Gallery\\rishikesh3.jpeg', ''),
(13, 'Ooty', 'assets\\image\\Gallery\\ooty1.jpeg', 'The trip to Ooty was a delight.'),
(14, 'Ooty', 'assets\\image\\Gallery\\ooty3.jpeg', 'Trip time made our Ooty trip so cozy.'),
(15, 'Ooty', 'assets\\image\\Gallery\\ooty4.jpeg', ''),
(16, 'Pondicherry', 'assets\\image\\Gallery\\pondicherry1.jpg', ''),
(17, 'Pondicherry', 'assets\\image\\Gallery\\Pondicherry2.jpg', 'Exploring Pondicherrys French heritage and beaches with trip time was a unique and simple experience'),
(18, 'Pondicherry', 'assets\\image\\Gallery\\pondicherry3.jpg', 'Trip time showed us Pondicherrys charm. '),
(19, 'Shimla', 'assets\\image\\Gallery\\shimla4.jpeg', 'Thank You Triptime to make Our trip Comfortable.'),
(20, 'Shimla', 'assets\\image\\Gallery\\shimla2.jpeg', ''),
(21, 'Shimla', 'assets\\image\\Gallery\\shimla1.jpeg', 'Trip time made our vacation in Shimla memorable with visits to Mall Road, Kufri, and scenic hikes.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contactus`
--

CREATE TABLE `tbl_contactus` (
  `username` text NOT NULL,
  `email` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contactus`
--

INSERT INTO `tbl_contactus` (`username`, `email`, `subject`, `message`) VALUES
('admin', 'admin@gmail.com', 'feedback', 'this is good website for travelling'),
('test', 'test@gmail.com', 'Feedback', 'this website is helps us for safe travelling.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `uid` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` text NOT NULL,
  `contactno` varchar(10) NOT NULL,
  `role` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`uid`, `email`, `password`, `username`, `contactno`, `role`) VALUES
(1, 'admin@gmail.com', '$2y$10$rNRxO2QiMhAt0fXe1bMguO37HMNef3gwtCsfeKSFip3/oZcGoFyGa', 'admin', '9983046792', 'admin'),
(2, 'test@gmail.com', '$2y$10$jSGy/VzpY6pKuGwkSqfEU.Wp7HMOMqg6n146oBjpFEeaBfip9V4US', 'test', '9904578294', 'user'),
(4, 'mahi@gmail.com', '$2y$10$BBPIr.bfQo93jm1oYPWpLumiOpO6T43Lsz3RWWKuvuV5n/DIvFT8u', 'mahi', '8174037940', 'user'),
(5, 'sejal@gmail.com', '$2y$10$2dOiEZeqqloO59VqNz7J3O..WbHm4gM4n7f/Zp6QH5QJkMIqH0nci', 'sejal', '9034672940', 'user'),
(6, 'riya@gmail.com', '$2y$10$7MevH9j9hy46bxZWQNBceuvEByEtgrx4sN77Dt5ngz5PKGJPb.SdG', 'riya', '8704593023', 'user'),
(7, 'sejal@gmail.com', '$2y$10$2dOiEZeqqloO59VqNz7J3O..WbHm4gM4n7f/Zp6QH5QJkMIqH0nci', 'sejal', '8647952153', 'user'),
(8, 'shiksha@gmail.com', '$2y$10$4Xd40nJhCQP3ObgtQ0SBTuVG31H6ZYLZd9zTfS8V3UQiik7HxN4ki', 'shiksha', '8457796532', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD UNIQUE KEY `Hotelid` (`Hotelid`),
  ADD KEY `Packageid` (`Packageid`);

--
-- Indexes for table `itinerary`
--
ALTER TABLE `itinerary`
  ADD KEY `Packageid` (`Packageid`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD UNIQUE KEY `Packageid` (`Packageid`),
  ADD KEY `Placeid` (`Pid`);

--
-- Indexes for table `package_date`
--
ALTER TABLE `package_date`
  ADD UNIQUE KEY `dateid` (`dateid`),
  ADD KEY `Packageid` (`Packageid`);

--
-- Indexes for table `package_includes`
--
ALTER TABLE `package_includes`
  ADD UNIQUE KEY `Iid` (`Iid`),
  ADD KEY `Packageid` (`Packageid`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD UNIQUE KEY `Pid` (`Pid`);

--
-- Indexes for table `tblgallery`
--
ALTER TABLE `tblgallery`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tblgallery`
--
ALTER TABLE `tblgallery`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `itinerary`
--
ALTER TABLE `itinerary`
  ADD CONSTRAINT `itinerary_ibfk_1` FOREIGN KEY (`Packageid`) REFERENCES `packages` (`Packageid`);

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`Pid`) REFERENCES `places` (`Pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

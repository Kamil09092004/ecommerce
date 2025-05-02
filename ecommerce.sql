-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2025 at 05:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `association`
--

CREATE TABLE `association` (
  `b_p_id` int(11) NOT NULL,
  `message` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `association`
--

INSERT INTO `association` (`b_p_id`, `message`, `link`) VALUES
(2, 'Your laptop deserves the best typing experience.', 'search_result.php?search=keyboard&button_search='),
(11, 'Power meets precision – choose the right ball for ', 'search_result.php?search=cricket+ball&button_search='),
(3, 'Seamless sound, seamless charge – because every se', 'search_result.php?search=wireless+charge&button_search='),
(10, 'Never run out of power, never miss a moment!', 'search_result.php?search=power+bank&button_search='),
(12, 'Limitless sound, effortless power – charge fast, g', 'search_result.php?search=type+c&button_search='),
(4, 'Charge fast, groove nonstop – because music should', 'search_result.php?search=type+c&button_search='),
(2, 'Other Electronics products are waiting for your pu', 'Electronics_1.php'),
(3, 'Other Electronics products are waiting for your pu', 'Electronics_1.php'),
(4, 'Other Electronics products are waiting for your pu', 'Electronics_1.php'),
(5, 'Other Fitness products are waiting for your purcha', 'Fitness_3.php'),
(6, 'Other Fitness products are waiting for your purcha', 'Fitness_3.php'),
(7, 'Other sports products are waiting for your purchas', 'sports_2.php'),
(8, 'Other sports products are waiting for your purchas', 'sports_2.php'),
(9, 'Other Fitness products are waiting for your purcha', 'Fitness_3.php'),
(10, 'Other Electronics products are waiting for your pu', 'Electronics_1.php'),
(11, 'Other sports products are waiting for your purchas', 'sports_2.php'),
(12, 'Other Electronics products are waiting for your pu', 'Electronics_1.php'),
(13, 'Other sports products are waiting for your purchas', 'sports_2.php'),
(14, 'Other sports products are waiting for your purchas', 'sports_2.php'),
(15, 'Other sports products are waiting for your purchas', 'sports_2.php'),
(16, 'Other sports products are waiting for your purchas', 'sports_2.php'),
(17, 'Other Electronics products are waiting for your pu', 'Electronics_1.php'),
(18, 'Other Electronics products are waiting for your pu', 'Electronics_1.php'),
(19, 'Other Electronics products are waiting for your pu', 'Electronics_1.php'),
(5, 'Power in your hands – build muscle, boost confiden', 'search_result.php?search=dumb+bell&button_search='),
(5, 'Roll your way to a stronger core – power, control,', 'search_result.php?search=roller&button_search='),
(5, 'Squeeze the stress away – calm mind, strong grip!', 'search_result.php?search=stress+ball&button_search='),
(6, 'Power in your hands – build strength, boost confid', 'search_result.php?search=hand+gripper&button_search='),
(6, 'Roll your way to a stronger core – power, control,', 'search_result.php?search=roller&button_search='),
(6, 'Squeeze the stress away – calm mind, strong grip!', 'search_result.php?search=stress+ball&button_search='),
(9, 'Power in your hands – build strength, boost confid', 'search_result.php?search=hand+gripper&button_search='),
(9, 'Power in your hands – build muscle, boost confiden', 'search_result.php?search=dumb+bell&button_search='),
(9, 'Squeeze the stress away – calm mind, strong grip!', 'search_result.php?search=stress+ball&button_search='),
(13, 'Power in your hands – build strength, boost confid', 'search_result.php?search=hand+gripper&button_search='),
(13, 'Power in your hands – build muscle, boost confiden', 'search_result.php?search=dumb+bell&button_search='),
(13, 'Roll your way to a stronger core – power, control,', 'search_result.php?search=roller&button_search='),
(7, 'Keep the game going – perfect bounce, every time!', 'search_result.php?search=air+pump&button_search='),
(8, 'Every smash, every rally – play with power and pre', 'search_result.php?search=shuttle+cocks&button_search=');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cus_id` varchar(50) NOT NULL,
  `p_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `time_hour` datetime NOT NULL,
  `add_time_hour` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `file` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `file`) VALUES
(1, 'Electronics', 'Electronics_1.php'),
(2, 'sports', 'sports_2.php'),
(3, 'Fitness', 'Fitness_3.php');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `p_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `ip` varchar(40) NOT NULL,
  `order_id` int(11) NOT NULL,
  `place` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `from_email` varchar(50) NOT NULL,
  `to_email` varchar(50) NOT NULL,
  `from_name` varchar(40) NOT NULL,
  `to_name` varchar(40) NOT NULL,
  `image` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL,
  `header` varchar(50) NOT NULL,
  `message` varchar(50) NOT NULL,
  `time_hour` datetime NOT NULL,
  `link_value` varchar(100) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_buffer`
--

CREATE TABLE `notification_buffer` (
  `to_email` varchar(50) NOT NULL,
  `header` varchar(50) NOT NULL,
  `message` varchar(150) NOT NULL,
  `link_value` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `cus_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL,
  `landmark` varchar(70) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `time_hour` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `exp_date` date NOT NULL,
  `discount` int(11) NOT NULL,
  `org_price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `del_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `main_file` varchar(60) NOT NULL,
  `category` varchar(60) NOT NULL,
  `org_price` mediumint(8) UNSIGNED NOT NULL,
  `discount` tinyint(3) UNSIGNED NOT NULL,
  `price` mediumint(8) UNSIGNED NOT NULL,
  `stock` smallint(5) UNSIGNED NOT NULL,
  `general_name` varchar(150) NOT NULL,
  `brand` varchar(60) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `name`, `main_file`, `category`, `org_price`, `discount`, `price`, `stock`, `general_name`, `brand`, `description`) VALUES
(2, 'HP 15,13th Gen Intel Core i5-1334U', '2.jpeg', 'Electronics_1', 71773, 23, 55265, 10, 'hp laptop electronics', 'HP', '16GB DDR4,512GB SSD, Anti Glare,15.6 inch(39.6 cm) FHD Laptop'),
(3, 'Noise Buds', '3.jpeg', 'Electronics_1', 3499, 71, 1014, 8, 'noise ear buds electronics', 'Noise', 'N1 in-Ear Truly Wireless Earbuds with Chrome Finish, 40H of Playtime, Quad Mic with ENC, Ultra Low Latency(up to 40 ms), Instacharge(10 min=120 min), BT v5.3(Ice Blue)'),
(4, ' ZEBRONICS Neckband Earphone', '4.jpeg', 'Electronics_1', 1499, 67, 494, 10, 'zebronics neckband earphone electronics', 'ZEBRONICS', 'ZEBRONICS Zeb Evolve Wireless Bluetooth in Ear Neckband Earphone, Rapid Charge, Dual Pairing, Magnetic earpiece,Voice Assistant with Mic (Blue)'),
(5, 'Bodyband Hand Gripper', '5.jpeg', 'Fitness_3', 499, 70, 149, 9, 'bodyband hand gripper fitness', 'Bodyband ', 'bodyband Hand Grip Workout Strengthener, Adjustable Hand Gripper for Men & Women for Gym Workout Hand Exercise Equipment to Use in Home for Forearm Exercise, Finger Power Gripper'),
(6, 'Lifelong PVC Hex Fixed Dumbbells Pack', '6.jpeg', 'Fitness_3', 200, 16, 168, 10, 'lifelongdumb bells fitness', 'Lifelong ', 'Lifelong PVC Hex Fixed Dumbbells Pack of 2 (1kg*2) Black Color for Home Gym Equipment Fitness Barbell|Gym Exercise|Home Workout Dumbbells Weights for Men & Women (6 Months Warranty)'),
(7, 'Wilson Volleyball', '7.jpeg', 'sports_2', 1599, 19, 1295, 10, 'wilson volley ball  sports equipment', 'Wilson', 'Wilson WILSO Orange, Blue Super Soft Play Volleyball,Wilson,Faux Leather, Rubber,2020-Version (Orange/Blue),Adult,227 g'),
(8, 'Yonex raphite Badminton Racquet ', '8.jpeg', 'sports_2', 3090, 40, 1854, 10, 'yonex shuttles,badminton bats,shuttle bats', 'YONEX', 'Yonex Nanoray Light 18i Graphite Badminton Racquet With Free Full Cover (77 Grams, 30 Lbs Tension, Black),G4 - 5U(75-79.9g )m,YONEX,G4'),
(9, 'PRO365 Abs Roller', '9.jpeg', 'Fitness_3', 599, 50, 299, 10, 'pro365 abs roller', 'PRO365', 'PRO365 Abs Roller, Ab Wheel Anti Rust Stainless Steel Rod, Ab Wheel, Home Gym Equipment Abs Workouts 100 Kgs, Core Workouts for Men and Women (6MM Safe Knee Mat, Yellow),ABS Plastic,430 Grams'),
(10, 'Samsung Galaxy S25 Ultra 5G AI Smartphone', '10.jpeg', 'Electronics_1', 149999, 12, 131999, 10, 'samsung galaxy s25 mobiles', 'Samsung', 'Samsung Galaxy S25 Ultra 5G AI Smartphone (Titanium Whitesilver, 12GB RAM, 512GB Storage), 200MP Camera, S Pen Included, Long Battery Life,Android 15.0,Snapdragon,12 GB,4.47 GHz'),
(11, 'SG Scorer Classic Cricket Bat ', '11.jpeg', 'sports_2', 2499, 11, 2224, 10, 'scorer cricket bat', 'SG', 'SG Scorer Classic Cricket Bat for Mens and Boys (Beige, Size -5) | Material: Kashmir Willow | Lightweight | Free Cover | Ready to Play | for Intermediate Player | Ideal for Leather Ball,Wood,5 Size,SG'),
(12, 'JBL Tune 770NC Wireless Over Ear ANC Headphones with Mic', '12.jpeg', 'Electronics_1', 9999, 40, 5999, 10, 'JBL head phones', 'JBL', 'JBL Tune 770NC Wireless Over Ear ANC Headphones with Mic, Upto 70 Hrs Playtime, Speedcharge, Google Fast Pair, Dual Pairing, BT 5.3 LE Audio, Customize on Headphones App (Blue),JBL,Over Ear,wireless,Blue'),
(13, 'Stress Balls', '13.jpeg', 'sports_2', 200, 40, 120, 9, 'stress balls|Niku smile soft stress balls for baby,girls,kid', 'Niku', 'Niku smile soft stress balls for baby,girls,kids,Adults|stress relief toy,Non-toxic Toy'),
(14, 'Shuttle cocks', '14.jpeg', 'sports_2', 450, 30, 315, 10, 'Konex Premium nylon shuttle cocks|stable flight&fast recover', 'Konex', 'Konex Premium nylon shuttle cocks|stable flight&fast recovery(yellow,pack of 6)'),
(15, 'Cricket ball', '15.jpeg', 'sports_2', 2000, 55, 900, 9, 'cricket ball|Jaspo incrediball soft T20 Cricket Training Bal', 'Jaspo', 'Jaspo incrediball soft T20 Cricket Training Ball-pack 6 indoor /outdoor and cricket practice(299cm circumference),PVC Material Color-Red'),
(16, 'Football air cycle pump', '16.jpeg', 'sports_2', 1300, 74, 338, 10, 'Amazon brand -symactive portable high pressure foot air cycle pump|air pump', 'Amazon', 'Amazon brand -symactive portable high pressure foot air cycle pump |easy-to-read dial|heavy compressor cylinder with pressure guage|floor pump for motorbike/cars/bicycle/football(black)'),
(17, 'HP USB Wireless keyboard and mouse', '17.jpeg', 'Electronics_1', 2200, 50, 1100, 10, 'HP USB Wireless spill resistance keyboard and mouse set with', 'HP', 'HP USB Wireless spill resistance keyboard and mouse set with 10m working range 2.4G wireless Technology/3 year warranty 4SC12LPA(Black)'),
(18, 'Litnibs wireless charging for type c', '18.jpeg', 'Electronics_1', 2000, 70, 600, 10, 'Litnibs wireless charging for type c|Litvibes Wireless Charger type c', 'Litvibes ', 'Litvibes Wireless Charging Receiver for Type C Mobiles,Phones,Devices Qi Standard Wireless Patch Magic Tags for Type C Cellular Devices Lightweight Portable Durable & Compact Chip'),
(19, 'Belkin Wireless power bank 10000 mAH (10K) w', '19.jpeg', 'Electronics_1', 8000, 50, 4000, 10, 'Belkin Wireless power bank 10000 mAH (10K) w,Belkin Wireless', 'Belkin', 'Belkin Wireless Power Bank 10000 mAH (10K) w/ Qi2, MagSafe Compatible + Built-in Pop-up Kickstand - Compatible w/iPhone 16, 16 Plus, 16 Pro, 16 Pro Max, iPhone 15, iPhone 14, and More - Black,USB Type C,Belkin,Special Feature,LED Indicator Lights, Magsafe Compatible, Qi2 Wireless Charging, Over Charging Protection, Wireless ChargingLED Indicator Lights, Magsafe Compatible, Qi2 Wireless Charging, Over Charging Protection, Wireless Charging');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `p_id` int(11) NOT NULL,
  `sub_file` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`p_id`, `sub_file`) VALUES
(2, '2_1.jpeg'),
(2, '2_2.jpeg'),
(2, '2_3.jpeg'),
(2, '2_4.jpeg'),
(2, '2_5.jpeg'),
(2, '2.jpeg'),
(3, '3.jpeg'),
(3, '3_1.jpeg'),
(3, '3_2.jpeg'),
(3, '3_3.jpeg'),
(3, '3_4.jpeg'),
(4, '4.jpeg'),
(4, '4_1.jpeg'),
(4, '4_2.jpeg'),
(4, '4_3.jpeg'),
(4, '4_4.jpeg'),
(4, '4_5.jpeg'),
(5, '5.jpeg'),
(5, '5_1.jpeg'),
(5, '5_2.jpeg'),
(5, '5_3.jpeg'),
(5, '5_4.jpeg'),
(5, '5_5.jpeg'),
(5, '5_6.jpeg'),
(6, '6.jpeg'),
(6, '6_1.jpeg'),
(6, '6_2.jpeg'),
(7, '7.jpeg'),
(7, '7_1.jpeg'),
(8, '8.jpeg'),
(8, '8_1.jpeg'),
(8, '8_2.jpeg'),
(8, '8_3.jpeg'),
(8, '8_4.jpeg'),
(8, '8_5.jpeg'),
(8, '8_6.jpeg'),
(8, '8_7.jpeg'),
(9, '9.jpeg'),
(9, '9_1.jpeg'),
(9, '9_2.jpeg'),
(9, '9_3.jpeg'),
(9, '9_4.jpeg'),
(10, '10.jpeg'),
(10, '10_1.jpeg'),
(10, '10_2.jpeg'),
(10, '10_3.jpeg'),
(10, '10_4.jpeg'),
(11, '11.jpeg'),
(11, '11_1.jpeg'),
(11, '11_2.jpeg'),
(11, '11_3.jpeg'),
(12, '12.jpeg'),
(12, '12_1.jpeg'),
(12, '12_2.jpeg'),
(12, '12_3.jpeg'),
(12, '12_4.jpeg'),
(12, '12_5.jpeg'),
(12, '12_6.jpeg'),
(12, '12_7.jpeg'),
(13, '13.jpeg'),
(13, '13_1.jpeg'),
(13, '13_2.jpeg'),
(13, '13_3.jpeg'),
(14, '14.jpeg'),
(14, '14_1.jpeg'),
(14, '14_2.jpeg'),
(14, '14_3.jpeg'),
(14, '14_4.jpeg'),
(14, '14_5.jpeg'),
(15, '15.jpeg'),
(15, '15_1.jpeg'),
(15, '15_2.jpeg'),
(15, '15_3.jpeg'),
(15, '15_4.jpeg'),
(15, '15_5.jpeg'),
(15, '15_6.jpeg'),
(16, '16.jpeg'),
(16, '16_1.jpeg'),
(16, '16_2.jpeg'),
(16, '16_3.jpeg'),
(16, '16_4.jpeg'),
(16, '16_5.jpeg'),
(16, '16_6.jpeg'),
(17, '17.jpeg'),
(17, '17_1.jpeg'),
(17, '17_2.jpeg'),
(17, '17_3.jpeg'),
(17, '17_4.jpeg'),
(17, '17_5.jpeg'),
(18, '18.jpeg'),
(18, '18_1.jpeg'),
(18, '18_2.jpeg'),
(18, '18_3.jpeg'),
(18, '18_4.jpeg'),
(18, '18_5.jpeg'),
(19, '19.jpeg'),
(19, '19_1.jpeg'),
(19, '19_2.jpeg'),
(19, '19_3.jpeg'),
(19, '19_4.jpeg'),
(19, '19_5.jpeg'),
(19, '19_6.jpeg'),
(19, '19_7.jpeg'),
(19, '19_8.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `product_modification`
--

CREATE TABLE `product_modification` (
  `p_id` int(11) NOT NULL,
  `dis` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_modification`
--

INSERT INTO `product_modification` (`p_id`, `dis`, `price`) VALUES
(2, 13, 62443),
(3, 61, 1365),
(4, 57, 645),
(5, 55, 225),
(6, 5, 190),
(7, 9, 1456),
(8, 25, 2317),
(9, 40, 360),
(10, 5, 142499),
(11, 3, 2424),
(12, 30, 6999),
(13, 30, 140),
(14, 20, 360),
(15, 45, 1100),
(16, 64, 468),
(17, 40, 1320),
(18, 60, 800),
(19, 40, 4800);

-- --------------------------------------------------------

--
-- Table structure for table `product_views`
--

CREATE TABLE `product_views` (
  `p_id` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `time_hour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recent_login`
--

CREATE TABLE `recent_login` (
  `email` varchar(50) NOT NULL,
  `curr_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seq_product`
--

CREATE TABLE `seq_product` (
  `p_id` int(11) NOT NULL,
  `category` varchar(40) NOT NULL,
  `riya_mehra21@gmail.com` int(11) DEFAULT 0,
  `aarav_sharma87@gmail.com` int(11) DEFAULT 0,
  `sneha_kapoor88@gmail.com` int(11) DEFAULT 0,
  `kabirdesai99@gmail.com` int(11) DEFAULT 0,
  `ananya_singh56@gmail.com` int(11) DEFAULT 0,
  `raj_patel33@gmail.com` int(11) DEFAULT 0,
  `priya_iyer72@gmail.com` int(11) DEFAULT 0,
  `arjunreddy07@gmail.com` int(11) DEFAULT 0,
  `meerajoshi45@gmail.com` int(11) DEFAULT 0,
  `dev_malhotra22@gmail.com` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seq_product`
--

INSERT INTO `seq_product` (`p_id`, `category`, `riya_mehra21@gmail.com`, `aarav_sharma87@gmail.com`, `sneha_kapoor88@gmail.com`, `kabirdesai99@gmail.com`, `ananya_singh56@gmail.com`, `raj_patel33@gmail.com`, `priya_iyer72@gmail.com`, `arjunreddy07@gmail.com`, `meerajoshi45@gmail.com`, `dev_malhotra22@gmail.com`) VALUES
(2, 'Electronics_1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'Electronics_1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'Electronics_1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'Fitness_3', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 'Fitness_3', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 'sports_2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 'sports_2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 'Fitness_3', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 'Electronics_1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 'sports_2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 'Electronics_1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 'sports_2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 'sports_2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 'sports_2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 'sports_2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 'Electronics_1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 'Electronics_1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(19, 'Electronics_1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE `track` (
  `order_id` int(11) NOT NULL,
  `place` varchar(50) NOT NULL,
  `time_hour` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `district` varchar(40) NOT NULL,
  `city` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL,
  `landmark` varchar(80) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `mobile`, `username`, `district`, `city`, `area`, `landmark`, `password`) VALUES
('Aarav Sharma', 'aarav_sharma87@gmail.com', '8765432198', 'aarav_s87', 'Anantapur', 'Bengaluru', 'Indiranagar', 'Opp. CMH Hospital', 'Aarav#321'),
('Ananya Singh', 'ananya_singh56@gmail.com', '9123456789', 'ananya_singh', 'West Godavari', 'Lucknow', 'Gomti Nagar', 'Behind City Mall', 'Ananya#556'),
('Arjun Reddy', 'arjunreddy07@gmail.com', '9556677880', 'arjun_r07', 'Prakasam', 'Hyderabad', 'Banjara Hills', 'Next to GVK Mall', 'Arjun@07'),
('Dev Malhotra', 'dev_malhotra22@gmail.com', '8899001122', 'dev_malhotra', 'Visakhapatnam', 'Delhi', 'Rohini', 'Near Unity Mall', 'Dev@Delhi1'),
('Kabir Desai', 'kabirdesai99@gmail.com', '7890123456', 'kabir_d99', 'East Godavari', 'Ahmedabad', 'Maninagar', 'Beside Lotus Hospital', 'Kabir@1122'),
('Meera Joshi', 'meerajoshi45@gmail.com', '9871209345', 'meera_j45', 'Vizianagaram', 'Nagpur', 'Dharampeth', 'Beside Yashoda Hospital', 'Meera!567'),
('Priya Iyer', 'priya_iyer72@gmail.com', '8444556677', 'priya_iyer', 'Guntur', 'Chennai', 'Adyar', 'Opp. Besant Nagar Beach', 'Priya@999'),
('Raj Patel', 'raj_patel33@gmail.com', '9001122334', 'raj_pat33', 'Krishna', 'Surat', 'Vesu', 'Near VR Mall', 'Raj123!'),
('Riya Mehra', 'riya_mehra21@gmail.com', '9876543210', 'riya_mehra', 'SPSR Nellore', 'Pimpri-Chinchwad', 'Wakad', 'Near Phoenix Mall', 'Riya@2025'),
('Sneha Kapoor', 'sneha_kapoor88@gmail.com', '9988776655', 'sneha_kap', 'Srikakulam', 'Mumbai', 'Thane', 'Ghodbunder Road', 'Sneha!2024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_buffer`
--
ALTER TABLE `notification_buffer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `product_modification`
--
ALTER TABLE `product_modification`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `product_views`
--
ALTER TABLE `product_views`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `seq_product`
--
ALTER TABLE `seq_product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification_buffer`
--
ALTER TABLE `notification_buffer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

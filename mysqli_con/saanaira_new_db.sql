-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2022 at 03:22 PM
-- Server version: 5.7.23-23
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelsrimanpalace_new_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(100) NOT NULL,
  `us_name` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `us_name`, `password`, `date`) VALUES
(1, 'hotelsrimanpalace', '!(&@$%KSZVC%#HDC3726FSAAW863', '2022-07-23 14:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(100) NOT NULL,
  `name` mediumtext NOT NULL,
  `para` mediumtext NOT NULL,
  `images` mediumtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `name`, `para`, `images`, `date`) VALUES
(9, 'Gopalpur Beach', 'Located on the east coast of the Bay of Bengal, the Gopalpur Beach is a luxurious beach located in Odisha. It is popular for being one of the few sites in India where Olive Ridley Turtles nest. Flanked with coconut and casuarina groves and is a perfect outing for a languorous weekend.', 'beach.jpg', '2022-07-27 19:16:39'),
(10, 'Lighthouse', 'Gopalpur beach has been made out of bounds for visitors by the district administration as people defied the Covid-19 protocols.', 'light.jpg', '2022-07-27 19:23:15');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(100) NOT NULL,
  `name` mediumtext NOT NULL,
  `para` mediumtext NOT NULL,
  `images` mediumtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `name`, `para`, `images`, `date`) VALUES
(8, 'Barth Party', 'The party initially consisted of a majority of Shia Muslims, as Rikabi recruited supporters mainly from his friends and family, but slowly became Sunni dominated.', 'barthparty.jpg', '2022-07-29 00:00:00'),
(9, 'Ring Sarmani', 'What is ring ceremony?\r\nA ring warming ceremony is a tradition that involves passing around the wedding bands to guests. Upon receiving the rings, guests “warm” them up with a prayer, good wishes, or positive vibes f', 'ma.jpg', '2022-07-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(100) NOT NULL,
  `number` mediumtext NOT NULL,
  `email` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `number`, `email`) VALUES
(1, '7077683888 ', 'reservations@hotelsrimanpalace.com ');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(100) NOT NULL,
  `name` mediumtext NOT NULL,
  `para` mediumtext NOT NULL,
  `images` mediumtext NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `para`, `images`, `date`) VALUES
(14, 'Destination Wedding', 'Marriage, also called matrimony or wedlock, is a culturally and often legally recognized union between people called spouses. It establishes rights and obligations between them, as well as between them and their children, and between them and their in-laws.', 'ma.jpg', '0000-00-00 00:00:00'),
(15, 'Ring Cermony', 'What is ring ceremony?\r\nA ring warming ceremony is a tradition that involves passing around the wedding bands to guests. Upon receiving the rings, guests “warm” them up with a prayer, good wishes, or positive vibes f', 'ma.jpg', '0000-00-00 00:00:00'),
(16, 'Corporate Parties/Get together/ Seminars/Conference', 'Be it a Party, Staff Birthday or Get-together, Seminars or Conference we are there with you for all.', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(100) NOT NULL,
  `name` mediumtext NOT NULL,
  `para` mediumtext NOT NULL,
  `images` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `para`, `images`, `date`) VALUES
(15, 'Beach', '', 'beach.png', '2022-07-27 19:04:09'),
(16, 'Breakfast', '', 'cereals.png', '2022-07-27 19:05:01'),
(17, 'AC', '', 'Ac_Non.png', '2022-07-27 19:05:25'),
(18, 'swimming pool', '', 'swimming-pool.png', '2022-07-27 19:06:10'),
(19, 'TV', '', 'tv.png', '2022-07-27 19:06:36'),
(20, 'Wifi', '', 'wifi.png', '2022-07-27 19:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(100) NOT NULL,
  `images` mediumtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `images`, `date`) VALUES
(17, '1638800107WhatsApp Image 2021-12-06 at 6.49.14 PM.jpeg', '2022-07-27 19:10:56'),
(18, '1638800138WhatsApp Image 2021-12-06 at 6.49.10 PM.jpeg', '2022-07-27 19:11:02'),
(19, 'WhatsApp Image 2022-06-13 at 9.44.48 PM.jpeg', '2022-07-27 19:11:09'),
(20, 'WhatsApp Image 2022-06-13 at 9.44.47 PM (1).jpeg', '2022-07-27 19:11:19'),
(21, 'WhatsApp Image 2022-07-19 at 12.33.44 PM (1).jpeg', '2022-07-27 19:11:48'),
(22, 'WhatsApp Image 2022-07-19 at 12.33.46 PM (2).jpeg', '2022-07-27 19:12:37'),
(23, 'WhatsApp Image 2022-07-19 at 12.33.46 PM (3).jpeg', '2022-07-27 19:12:50'),
(24, 'WhatsApp Image 2022-07-08 at 3.44.27 PM.jpeg', '2022-07-27 19:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(100) NOT NULL,
  `message` mediumtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `message`, `date`) VALUES
(12, ' SPECIAL PRICE FOR TABLE BOOKINGS. \r\nPLEASE DO CALL FOR ON GOING OFFERS', '2022-08-09 02:25:04');

-- --------------------------------------------------------

--
-- Table structure for table `our_story`
--

CREATE TABLE `our_story` (
  `id` int(100) NOT NULL,
  `message` mediumtext NOT NULL,
  `Image_1` mediumtext NOT NULL,
  `Image_2` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `our_story`
--

INSERT INTO `our_story` (`id`, `message`, `Image_1`, `Image_2`) VALUES
(1, 'hotelsrimanpalace Resort & Spa is one of the most spectacular beach resort in Gopalpur – On – Sea \nin Ganjam District of Odisha – Eastern India. This legendary resort was previously known \nas The Blue Haven Resort and was originally built in 1919 to render services to the traders \ndoing business through the old Gopalpur Port. It was also popularly known for its late night \nRock N Roll parties patronized by the wealthy dignitaries visiting Gopalpur. Though the \nresort has changed few hands in the past, it is now owned and operated as hotelsrimanpalace Resort \n& Spa.\nThis beach resort offers everything breathtaking that families, couples & groups look for \nin a boutique luxury resort. Having guest rooms & upcoming swimming pool with infinity \nview, state of the art convention centre, open to sky lush green lawns overlooking the \nbeach line that stretches till the visible horizon of the naked eye. It makes hotelsrimanpalace \nResort & Spa a perfect destination for all Leisure, Corporate & Wedding banquet \nrequirement. The ambience & its green landscaping depicts old British Colonial era \nmeticulously curated to provide leisure travellers with modern amenities and warm \nhospitality services. \nConveniently located just 30 minutes way from Brahmapur Railway Station and two & half \nhours drive from Bhubaneswar, this place is “A Beautiful World Within Its Own World.”\nSo, visit our resort and indulge yourself in a blissful affair with the pristine blue sea; \nwhere romance proliferate in the ambience and there is no shortage of fun. \nKindly contact us at Mob. 8595658584 / 7008537782 or visit our www.hotelsrimanpalaceresort.com\nfor attractive stay and sightseeing offers along with Tailor - made packages to make your \nstay here the most memorable & enjoyable one.', 'about_1.jpg', 'about_2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(100) NOT NULL,
  `name` mediumtext NOT NULL,
  `para` mediumtext NOT NULL,
  `price` mediumtext NOT NULL,
  `image` mediumtext NOT NULL,
  `facility` mediumtext NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`, `para`, `price`, `image`, `facility`, `date`) VALUES
(1, 'Executive Rooms', 'These category of rooms are our base category where you can’t find\r\nany views. Just because of it’s a Boutique Heritage Resort where we can’t construct to\r\ngive you view from this rooms. Most of the online bookings come for these rooms only.\r\nApart from the view you can find all the facility that we’re providing to other category of\r\nrooms. In the rooms only we’re providing room and wash room amenities as well, where\r\nyou can find our own branding products.\r\n The price of this beautiful room is Rs.3500/= & 12% GST. ', '3500', 'Executive_Rooms.jpg', 'Ac_Non|Pick_&_Drop|tv|wifi|bathroom|Water|2_size_bed', '0000-00-00 00:00:00'),
(2, 'Premium Rooms', 'In this category of rooms, you can find 2 views. 3 rooms have direct\r\nfront view and remaining 5 rooms have side views. You can feel that this is the mini\r\nRoyal room of our resort without a personal balcony. In the rooms only we’re providing\r\nroom and wash room amenities as well, where you can find our own branding products.\r\n The price of this beautiful room is Rs.4500/= & 12% GST.', '4500', 'Premium_Rooms.jpg', 'Ac_Non|Pick_&_Drop|tv|wifi|bathroom|Water|2_size_bed', '0000-00-00 00:00:00'),
(3, 'Imperial Rooms', '                               In this room you can find more space with beautiful sunset view and a side sea view i.e. why we have also called this room as Twilight room. Because the lights of the sunset makes this room quite different from the other rooms we have. In this room you’ll not find a balcony but you can feel the vibes of the sea directly from your window. In the rooms only we’re providing room and wash room amenities as well, where you can find our own branding products.\r\n		         The price of this Imperial Room is Rs.5500/= & 12% GST.                           \r\n', '5500', 'Imperial_Room.jpg', 'Ac_Non|wifi|bathroom|Water|Privet_balcony', '0000-00-00 00:00:00'),
(4, 'The Royal Rooms', 'These are the best rooms of our resort with huge space which provides you beautiful front view of the sea. And you can enjoy the sunrise from your bed and weâ€™re providing sitting area near the window where you can enjoy the beauty of the sea from the 1st floor. You can also have a personal balcony attached to your room from where you can enjoy or feel the vibes of the sea and in the balcony you can organize your small party as well. In the rooms only weâ€™re providing room and wash room amenities as well, where you can find our own branding products. \r\n		         The price of this beautiful room is Rs.6000/= & 12% GST. ', '6000', 'Royal_Room.jpg', 'Ac_Non|Pick_&_Drop|tv|wifi|bathroom|Water|2_size_bed|Privet_balcony', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `room_booking`
--

CREATE TABLE `room_booking` (
  `id` int(100) NOT NULL,
  `check_in_d` mediumtext NOT NULL,
  `room_name` mediumtext NOT NULL,
  `total_booking_today` mediumtext NOT NULL,
  `tuday_d` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(100) NOT NULL,
  `name` mediumtext NOT NULL,
  `para` mediumtext NOT NULL,
  `images` mediumtext NOT NULL,
  `logo` varchar(10000) NOT NULL,
  `price` mediumtext NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `para`, `images`, `logo`, `price`, `date`) VALUES
(13, 'Conference', 'a meeting of two or more persons for discussing matters of common concern The president is in conference with his advisers. b : a usually formal interchange of views : consultation a conference on climate change.', 'bp.jpg', 'conference.png', '', '0000-00-00 00:00:00'),
(14, 'spa', 'It is commonly claimed, in a commercial context, that the word is an acronym of various ', 'spa.jpg', 'sauna.png', '', '0000-00-00 00:00:00'),
(15, 'hotelsrimanpalace Tailor Made Tour', 'hotelsrimanpalace Resort promise you to provide the best experience of Odisha tour. Enjoy the most comfortable Tour Package with best itineraries to make your Gopalpur tour enjoyable, which allow you to know Odisha Better.All in all with your tour package you will experience the natural beauty of Odisha and number of religious spots along with the largest brackish lagoon with the famous temples and architectural marvels in Odisha.\r\n\r\nIt will be the pleasure of hotelsrimanpalace Resort to take pleasure for being your companion on your Odisha tour.\r\nGopalpur with Daringibadi /\r\nGopalpur with Chillika Rambha /\r\nGopalpur with Bhubneswar /\r\nGopalpur with Puri /\r\nhotelsrimanpalace Special Pacakage /\r\nTailor Made Pacakage Of Your Choice.\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(100) NOT NULL,
  `image` mediumtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `image`, `date`) VALUES
(32, 'WhatsApp Image 2022-06-13 at 9.51.29 PM.jpeg', '2022-07-23 22:36:15'),
(33, 'WhatsApp Image 2022-07-19 at 12.33.43 PM.jpeg', '2022-07-23 22:36:29'),
(34, 'WhatsApp Image 2022-06-13 at 9.44.48 PM.jpeg', '2022-07-23 22:36:37'),
(35, 'WhatsApp Image 2022-07-13 at 9.39.35 PM.jpeg', '2022-07-23 22:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `table`
--

CREATE TABLE `table` (
  `id` int(100) NOT NULL,
  `name` mediumtext NOT NULL,
  `para` mediumtext NOT NULL,
  `price` mediumtext NOT NULL,
  `facility` mediumtext NOT NULL,
  `images` mediumtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table`
--

INSERT INTO `table` (`id`, `name`, `para`, `price`, `facility`, `images`, `date`) VALUES
(14, 'OLD PORT multi cuisine Beach Restaurant', 'Table For 2 For Couple Or Family Table For Any Occasion In CAFE 1919 Or Beach Front.\r\n\r\n\r\n\r\n', '1000', '', 'table.jpg', '2022-07-24 16:03:37'),
(15, 'CAFE 1919', 'Family-style restaurants offer tableside service and nondisposable dishes, while still keeping the menu moderately priced.', '1000', '', 'CAFE.jpg', '2022-07-27 18:45:17'),
(16, 'Beach dining', 'Book a Table For the Special Occasion and Avail Special Discount For Individual & Famil Get-together. Use Special Discount Coupon SANAUG For The Month.', '1000', '', 'Pargolla_Dining.jpg', '2022-07-29 05:48:07'),
(17, 'Pargolla Dining', 'Book a Table For the Special Occasion and Avail Special Discount For Individual & Famil Get-together. Use Special Discount Coupon SANAUG For The Month.', '1000', '', 'Pargolla_Dining.jpg', '2022-08-05 06:15:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_story`
--
ALTER TABLE `our_story`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_booking`
--
ALTER TABLE `room_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table`
--
ALTER TABLE `table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `our_story`
--
ALTER TABLE `our_story`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room_booking`
--
ALTER TABLE `room_booking`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `table`
--
ALTER TABLE `table`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

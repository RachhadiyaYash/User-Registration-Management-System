-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2024 at 06:46 AM
-- Server version: 10.6.16-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `state_id`) VALUES
(1, 'Los Angeles', 1),
(2, 'San Francisco', 1),
(3, 'San Diego', 1),
(4, 'Sacramento', 1),
(5, 'Fresno', 1),
(6, 'Houston', 2),
(7, 'San Antonio', 2),
(8, 'Dallas', 2),
(9, 'Austin', 2),
(10, 'Fort Worth', 2),
(11, 'New York City', 3),
(12, 'Buffalo', 3),
(13, 'Rochester', 3),
(14, 'Yonkers', 3),
(15, 'Syracuse', 3),
(16, 'Miami', 4),
(17, 'Jacksonville', 4),
(18, 'Tampa', 4),
(19, 'Orlando', 4),
(20, 'St. Petersburg', 4),
(21, 'Chicago', 5),
(22, 'Aurora', 5),
(23, 'Rockford', 5),
(24, 'Joliet', 5),
(25, 'Naperville', 5),
(26, 'Toronto', 6),
(27, 'Ottawa', 6),
(28, 'Mississauga', 6),
(29, 'Hamilton', 6),
(30, 'London', 6),
(31, 'Montreal', 7),
(32, 'Quebec City', 7),
(33, 'Laval', 7),
(34, 'Gatineau', 7),
(35, 'Longueuil', 7),
(36, 'Calgary', 8),
(37, 'Edmonton', 8),
(38, 'Red Deer', 8),
(39, 'Lethbridge', 8),
(40, 'Medicine Hat', 8),
(41, 'Vancouver', 9),
(42, 'Victoria', 9),
(43, 'Surrey', 9),
(44, 'Burnaby', 9),
(45, 'Richmond', 9),
(46, 'Sydney', 11),
(47, 'Newcastle', 11),
(48, 'Wollongong', 11),
(49, 'Albury', 11),
(50, 'Coffs Harbour', 11),
(51, 'Melbourne', 12),
(52, 'Geelong', 12),
(53, 'Ballarat', 12),
(54, 'Bendigo', 12),
(55, 'Shepparton', 12),
(56, 'Brisbane', 13),
(57, 'Gold Coast', 13),
(58, 'Sunshine Coast', 13),
(59, 'Townsville', 13),
(60, 'Cairns', 13),
(61, 'Perth', 14),
(62, 'Mandurah', 14),
(63, 'Bunbury', 14),
(64, 'Geraldton', 14),
(65, 'Albany', 14),
(66, 'London', 16),
(67, 'Manchester', 16),
(68, 'Birmingham', 16),
(69, 'Liverpool', 16),
(70, 'Leeds', 16),
(71, 'Glasgow', 17),
(72, 'Edinburgh', 17),
(73, 'Aberdeen', 17),
(74, 'Dundee', 17),
(75, 'Inverness', 17),
(76, 'Cardiff', 18),
(77, 'Swansea', 18),
(78, 'Newport', 18),
(79, 'Wrexham', 18),
(80, 'Barry', 18),
(81, 'Belfast', 19),
(82, 'Londonderry', 19),
(83, 'Newry', 19),
(84, 'Armagh', 19),
(85, 'Lisburn', 19),
(86, 'Mumbai', 21),
(87, 'Pune', 21),
(88, 'Nagpur', 21),
(89, 'Nashik', 21),
(90, 'Aurangabad', 21),
(91, 'Lucknow', 22),
(92, 'Kanpur', 22),
(93, 'Ghaziabad', 22),
(94, 'Agra', 22),
(95, 'Varanasi', 22),
(96, 'Chennai', 23),
(97, 'Coimbatore', 23),
(98, 'Madurai', 23),
(99, 'Tiruchirappalli', 23),
(100, 'Salem', 23),
(101, 'Bangalore', 24),
(102, 'Mysore', 24),
(103, 'Hubli', 24),
(104, 'Mangalore', 24),
(105, 'Belgaum', 24),
(106, 'Ahmedabad', 25),
(107, 'Surat', 25),
(108, 'Vadodara', 25),
(109, 'Rajkot', 25),
(110, 'Gandhinagar', 25),
(111, 'City of London ', 20),
(112, 'Amreli', 25),
(113, 'Gandhinagar', 25),
(114, 'Dwarka', 25),
(115, 'Mahesana', 25),
(116, 'Junagadh', 25),
(117, 'Botad', 25),
(118, 'Banaskantha', 25),
(119, 'Akola', 21),
(120, 'Brihad Mumbai ', 21),
(122, 'Amravati', 21),
(123, 'Aurangabad', 21);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'United States'),
(2, 'Canada'),
(3, 'Australia'),
(4, 'United Kingdom'),
(5, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `name`, `country_id`) VALUES
(1, 'California', 1),
(2, 'Texas', 1),
(3, 'New York', 1),
(4, 'Florida', 1),
(5, 'Illinois', 1),
(6, 'Ontario', 2),
(7, 'Quebec', 2),
(8, 'Alberta', 2),
(9, 'British Columbia', 2),
(10, 'Manitoba', 2),
(11, 'New South Wales', 3),
(12, 'Victoria', 3),
(13, 'Queensland', 3),
(14, 'Western Australia', 3),
(15, 'South Australia', 3),
(16, 'England', 4),
(17, 'Scotland', 4),
(18, 'Wales', 4),
(19, 'Northern Ireland', 4),
(20, 'London', 4),
(21, 'Maharashtra', 5),
(22, 'Uttar Pradesh', 5),
(23, 'Tamil Nadu', 5),
(24, 'Karnataka', 5),
(25, 'Gujarat', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `technologies` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `gender`, `address1`, `address2`, `country`, `state`, `city`, `technologies`, `username`, `password`, `profile_pic`, `created_at`) VALUES
(148, 'John', 'Doe', 'john.doe@example.com', 'male', '123 Main St', 'Apt 101', 'US', 'CA', 'Los Angeles', 'JavaScript, HTML, CSS', 'john_doe', 'password123', 'uploads/profile_pic_1.jpeg', '2024-03-06 12:00:00'),
(149, 'Alice', 'Smith', 'alice.smith@example.com', 'female', '456 Oak Ave', 'Unit 202', 'US', 'NY', 'New York', 'Python, SQL', 'alice_smith', 'p@ssw0rd', 'uploads/profile_pic_2.jpeg', '2024-03-06 12:15:00'),
(150, 'Bob', 'Johnson', 'bob.johnson@example.com', 'male', '789 Elm St', 'Apt 303', 'US', 'TX', 'Houston', 'Java, C++, PHP', 'bob_johnson', 'qwerty', 'uploads/profile_pic_3.jpeg', '2024-03-06 12:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`);

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `state_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

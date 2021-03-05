-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2021 at 09:16 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `training_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `cid` int(11) NOT NULL,
  `clinic_name` varchar(20) NOT NULL,
  `clinic_address` varchar(40) NOT NULL,
  `clinic_town` varchar(20) NOT NULL,
  `clinic_city` varchar(20) NOT NULL,
  `clinic_contact` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`cid`, `clinic_name`, `clinic_address`, `clinic_town`, `clinic_city`, `clinic_contact`) VALUES
(1, 'gupta dental', 'netaji chowk', 'raipur', 'raipur', 7784525879),
(2, 'chhattisgarh clinic', 'sunder nagar', 'chhattisgarh', 'raipur', 8897456589),
(3, 'asbfkabsuknf', 'nkjfanlnojiqwn', 'shjsilrhj ', 'sndujgbq', 7894587956);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_account`
--

CREATE TABLE `doctor_account` (
  `did` int(11) NOT NULL,
  `account_created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `doctor_name` varchar(20) NOT NULL,
  `doctor_address` varchar(100) NOT NULL,
  `doctor_gender` varchar(10) NOT NULL,
  `doctor_dob` date NOT NULL,
  `doctor_experience` int(2) NOT NULL,
  `doctor_specialization` varchar(20) NOT NULL,
  `doctor_username` varchar(20) NOT NULL,
  `doctor_password` varchar(20) NOT NULL,
  `doctor_contact` bigint(10) NOT NULL,
  `doctor_region` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_account`
--

INSERT INTO `doctor_account` (`did`, `account_created_on`, `doctor_name`, `doctor_address`, `doctor_gender`, `doctor_dob`, `doctor_experience`, `doctor_specialization`, `doctor_username`, `doctor_password`, `doctor_contact`, `doctor_region`) VALUES
(1, '2021-03-03 19:42:21', 'user', 'useraddress', 'male', '1989-06-14', 7, 'user special', 'userName', '12345678', 12345678, 'user region'),
(2, '2021-03-03 19:48:50', 'user', 'useraddress', 'male', '2006-02-03', 2, 'user special', 'userName', '0987654321', 987654321, 'user region');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_avaliablity`
--

CREATE TABLE `doctor_avaliablity` (
  `cid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `start_time` time(6) NOT NULL,
  `end_time` time(6) NOT NULL,
  `row_created_at` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_avaliablity`
--

INSERT INTO `doctor_avaliablity` (`cid`, `did`, `day`, `start_time`, `end_time`, `row_created_at`) VALUES
(1, 1, 'friday', '16:39:00.000000', '19:39:00.000000', 2147483647),
(1, 1, 'monday', '16:39:00.000000', '19:39:00.000000', 2147483647),
(1, 1, 'thursday', '16:39:00.000000', '19:39:00.000000', 2147483647),
(1, 1, 'tuesday', '16:39:00.000000', '19:39:00.000000', 2147483647),
(1, 1, 'wednesday', '16:39:00.000000', '19:39:00.000000', 2147483647),
(1, 12, 'monday', '10:30:00.000000', '18:30:00.000000', 2147483647),
(1, 12, 'thursday', '10:30:00.000000', '18:30:00.000000', 2147483647),
(1, 12, 'tuesday', '10:30:00.000000', '18:30:00.000000', 2147483647),
(1, 12, 'wednesday', '10:30:00.000000', '18:30:00.000000', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `manager_account`
--

CREATE TABLE `manager_account` (
  `mid` int(11) NOT NULL,
  `manager_name` int(20) NOT NULL,
  `manager_username` int(20) NOT NULL,
  `manager_password` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `myguest`
--

CREATE TABLE `myguest` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `myguest`
--

INSERT INTO `myguest` (`id`, `firstname`, `lastname`, `email`) VALUES
(1, 'ayush', 'sonkar', 'ayush@mail.com'),
(2, 'ayush', 'sonkar', 'ayush@mail.com'),
(3, 'ayush', 'sonkar', 'ayush@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `patient_account`
--

CREATE TABLE `patient_account` (
  `patient_id` int(11) NOT NULL,
  `patient_fname` varchar(60) NOT NULL,
  `patient_username` varchar(30) NOT NULL,
  `patient_password` varchar(50) NOT NULL,
  `patient_address` varchar(100) NOT NULL,
  `patient_city` varchar(50) NOT NULL,
  `patient_dob` date NOT NULL,
  `patient_phone` bigint(10) NOT NULL,
  `patient_email` varchar(50) NOT NULL,
  `patient_dateandtime_registration` datetime NOT NULL DEFAULT current_timestamp(),
  `patient_gender` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='patients registered data';

--
-- Dumping data for table `patient_account`
--

INSERT INTO `patient_account` (`patient_id`, `patient_fname`, `patient_username`, `patient_password`, `patient_address`, `patient_city`, `patient_dob`, `patient_phone`, `patient_email`, `patient_dateandtime_registration`, `patient_gender`) VALUES
(8, 'ayush sonkar', 'tinu', '12345', 'puranibasti', 'raipur', '1997-09-29', 2147483647, 'ayush@gmail.com', '2021-02-23 18:56:33', 'male'),
(13, 'ayush', 'ayush', '', '', '', '0000-00-00', 0, '', '2021-02-25 12:38:41', NULL),
(14, 'tinu29', 'tinu29', '', '', '', '0000-00-00', 0, '', '2021-02-25 12:39:45', NULL),
(15, 'tinu2909', 'tinu2909', '', '', '', '0000-00-00', 0, '', '2021-02-25 13:12:40', NULL),
(16, 'ayush sonkar', 'tinu123', '12345', 'puranibasti', 'raipur', '1997-09-29', 2147483647, 'ayush@gmail.com', '2021-02-25 13:23:03', 'male'),
(17, 'ayush sonkar', 'qwerty', 'qwerty', 'purani basti lakhe nagar,sonkar para, near devbati sonkar school raipur C.G. ', 'raipur', '1997-09-29', 2147483647, 'ayush@gmail.com', '2021-02-25 13:41:23', 'male'),
(18, 'ayush sonkar', 'qqqqq', '111111', '3e3eq', 'raipur', '5633-12-12', 2147483647, 'ayush@gmail.com', '2021-02-25 18:44:58', 'male'),
(19, 'ayush sonkar', 'qweqwr', 'qwerty', 'weaq', 'raipur', '2021-02-02', 1234567891, 'ayush@gmail.com', '2021-02-25 18:56:59', 'male'),
(20, 'abcdefghijklmnop', 'abcdefg', 'abcdefg', 'abcdefghijklmnopqrstuvwxyz,ABCDEFGHIJKLMNOPQRSTUVWXYZ, 123 playground stret', 'gta', '2000-04-01', 1234567891, 'abcd@efghij.klmnop', '2021-02-25 19:02:53', 'male'),
(21, 'tinu sonkar', 'tinu291', '12357895', 'tinu nagar sonakar para', 'tinu', '1997-09-29', 8889456667, 'tinu@gmail.com', '2021-02-26 11:21:17', 'male'),
(22, 'new user', 'newuser', 'user1', 'ggatteggwhhjdhnd,ndhhs dnsh asdhhaw dsa,ajusdjjhahhfgga', 'newuser', '2010-06-16', 7784581479, 'newuser@mail.com', '2021-03-03 11:33:37', 'male'),
(23, 'akash panda', 'pandaakash', 'akash', 'sdsdsdf', 'raipur', '1990-02-16', 7784581479, 'panda.akash18@gmail.com', '2021-03-04 14:49:30', 'male'),
(24, 'new user2', 'user2', 'user2', 'raipur bhatagaon', 'raipur', '1992-05-26', 7845985975, 'newuser2@gmail.com', '2021-03-05 13:09:24', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `patient_bookings`
--

CREATE TABLE `patient_bookings` (
  `book_id` int(11) NOT NULL,
  `book_status` varchar(10) NOT NULL,
  `book_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `patient_fname` varchar(30) NOT NULL,
  `patient_username` varchar(20) NOT NULL,
  `patient_age` int(3) NOT NULL,
  `patient_gender` varchar(10) NOT NULL,
  `patient_problem` varchar(200) NOT NULL,
  `patient_dateofbook` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_bookings`
--

INSERT INTO `patient_bookings` (`book_id`, `book_status`, `book_datetime`, `patient_fname`, `patient_username`, `patient_age`, `patient_gender`, `patient_problem`, `patient_dateofbook`) VALUES
(1, 'confirm', '2021-03-05 08:07:22', 'user2', 'user2', 22, 'male', 'some problems', '2021-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'ayush', '$2y$10$zVYatYN/ya5CIVyAZlVKKuNBr1QmNbob0..eBSLon7zzL3vPNAPLy', '2021-02-22 13:00:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `doctor_account`
--
ALTER TABLE `doctor_account`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `doctor_avaliablity`
--
ALTER TABLE `doctor_avaliablity`
  ADD PRIMARY KEY (`cid`,`did`,`day`,`start_time`,`end_time`);

--
-- Indexes for table `manager_account`
--
ALTER TABLE `manager_account`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `myguest`
--
ALTER TABLE `myguest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_account`
--
ALTER TABLE `patient_account`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `patient_bookings`
--
ALTER TABLE `patient_bookings`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctor_account`
--
ALTER TABLE `doctor_account`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manager_account`
--
ALTER TABLE `manager_account`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `myguest`
--
ALTER TABLE `myguest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patient_account`
--
ALTER TABLE `patient_account`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `patient_bookings`
--
ALTER TABLE `patient_bookings`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 07:40 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php-crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

CREATE TABLE `crud` (
  `id` int(255) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `client` varchar(40) NOT NULL,
  `fault_description` varchar(255) NOT NULL,
  `action_taken` varchar(255) NOT NULL,
  `location` varchar(225) NOT NULL,
  `achiever` varchar(40) NOT NULL,
  `remarks` varchar(225) NOT NULL,
  `incident_type` varchar(255) NOT NULL,
  `status` varchar(40) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` longtext NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`id`, `date_created`, `client`, `fault_description`, `action_taken`, `location`, `achiever`, `remarks`, `incident_type`, `status`, `name`, `image`, `userId`) VALUES
(21, '2023-05-18 09:18:33', 'seun', 'bad power cable', 'replaced cable', 'old terminal', 'bana', 'stock is low...supervisor please add more to supply', 'Network', 'closed', '', '6465df599155d4.22261634.jpg', 15),
(22, '2023-05-18 09:19:21', 'seun', '2 bad power cable', 'replaced cable', 'old terminal', 'bimbo', 'stock is low...supervisor please add more to supply', 'Software', 'closed', '', '6465df89855386.30007671.jpg', 15);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `role` enum('Admin','User') NOT NULL,
  `username` varchar(100) NOT NULL,
  `d_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role`, `username`, `d_password`) VALUES
(2, 'User', 'kiki', '12345'),
(11, 'Admin', 'ucheobi', 'password'),
(12, 'Admin', 'vovida', 'vovida'),
(13, 'Admin', 'OkashA', 'OkashA'),
(14, 'Admin', 'chinyere', 'chinyere'),
(15, 'Admin', 'zayad', 'zayad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crud`
--
ALTER TABLE `crud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

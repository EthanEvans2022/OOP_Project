-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2017 at 07:15 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `note_manager_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `note_type` int(11) NOT NULL,
  `note_title` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `note_type`, `note_title`, `note`, `email`, `password`, `time_created`, `page_num`) VALUES
(46, 2, 'Weekend:', 'Pick Up Milk', 'eth@gmail.com', 'cooper', '2017-06-19 18:24:04', 0),
(57, 1, 'Mel''s Address', '182 North St, Harrison, NY', 'eth@gmail.com', 'cooper', '2017-06-19 18:53:29', 0),
(58, 3, 'Groceries', 'Pick up Eggs, chocolate, milk', 'eth@gmail.com', 'cooper', '2017-06-19 18:54:33', 0),
(60, 2, 'Dinner Friday', '@ Lombardo''s', 'eth@gmail.com', 'cooper', '2017-06-19 18:58:46', 0),
(61, 1, 'Eat food', 'Don''t forget this time', 'austin@gmail.com', 'brody', '2017-06-19 19:11:20', 0),
(62, 2, 'How to eat food', '1) get food\r\n2) open mouth\r\n3) out food in mouth\r\n4) chew', 'austin@gmail.com', 'brody', '2017-06-19 19:12:00', 0),
(63, 3, 'Pleasseeeee eat food. please', 'Seriously, don''t forget this time', 'austin@gmail.com', 'brody', '2017-06-19 19:12:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`) VALUES
('austin555', 'brody', 'austin@gmail.com'),
('eth1235', 'cooper', 'eth@gmail.com'),
('Zach', 'bball', 'zach@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `username` (`username`,`password`,`email`),
  ADD UNIQUE KEY `username_2` (`username`,`password`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

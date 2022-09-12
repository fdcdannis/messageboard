-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2022 at 01:23 AM
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
-- Database: `messageboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(20) NOT NULL,
  `message_id` int(10) NOT NULL,
  `message_details` varchar(955) NOT NULL,
  `message_to_userid` int(20) NOT NULL,
  `message_from_user_id` int(20) NOT NULL,
  `reply_flag` int(10) NOT NULL,
  `reply_id` int(10) NOT NULL,
  `reply_message` varchar(955) NOT NULL,
  `message_created` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message_id`, `message_details`, `message_to_userid`, `message_from_user_id`, `reply_flag`, `reply_id`, `reply_message`, `message_created`) VALUES
(1, 1, '111', 2, 1, 0, 0, '', '2022-09-08 19:29:58.000000'),
(2, 2, '22222222222222222', 1, 2, 0, 0, '', '2022-09-08 19:29:58.000000'),
(42, 2, '11111', 2, 1, 1, 2, '', '0000-00-00 00:00:00.000000'),
(43, 2, 'asdfsadf waer asfdsa dfsdf', 1, 2, 1, 2, '', '0000-00-00 00:00:00.000000'),
(44, 1, '1111111111122', 1, 2, 1, 1, '', '0000-00-00 00:00:00.000000'),
(46, 3, 'Bro ikaduha nani Email nimo.. hehe', 2, 1, 0, 0, '', '0000-00-00 00:00:00.000000'),
(47, 3, 'okay bro no probz ahhhahaha', 1, 2, 1, 3, '', '0000-00-00 00:00:00.000000'),
(48, 2, '23423423', 2, 1, 1, 2, '', '0000-00-00 00:00:00.000000'),
(49, 46, '46 saf reafsadf 2 ', 2, 1, 1, 46, '', '0000-00-00 00:00:00.000000'),
(50, 46, 'aerfsd 23 sadfsafd', 1, 2, 1, 46, '', '0000-00-00 00:00:00.000000'),
(51, 0, 'Bro ika 3 nani nga message naku nimo haha', 2, 1, 0, 0, '', '0000-00-00 00:00:00.000000'),
(52, 51, 'ahh lageh2.. padung nahh..', 1, 2, 1, 51, '', '0000-00-00 00:00:00.000000'),
(53, 0, 'Bro ikaupat nani nga message naku nimo..', 2, 1, 0, 0, '', '0000-00-00 00:00:00.000000'),
(54, 0, 'Bro pila plete padung uli ?', 1, 2, 0, 0, '', '0000-00-00 00:00:00.000000'),
(55, 54, '30 back and forth', 2, 1, 1, 54, '', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `age` int(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `hobby` varchar(955) DEFAULT NULL,
  `last_login` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `profile_pic`, `lastname`, `firstname`, `age`, `gender`, `birthday`, `hobby`, `last_login`, `created`, `modified`) VALUES
(1, '1FDCDannisse', '92429d82a41e930486c6de5ebda9602d55c39986', 'fdc.dannis@gmail.com', '20220913828796299-20210201_175638.jpg', 'Dan7', 'John4', 29, 'Male', '2014-12-19', '1111In other words, without a hobby, your life becomes an unhealthy cycle lacking any excitement or spark. Hobbies offer you a great opportunity to take a break and forget the worries of your life. They allow you to explore yourself and realize your potential in different areas.  Moreover, hobbies can also be a source of extra income. For instance, if you like painting, you can actually sell your art to make some extra money. Likewise, if you have a knack for dancing, you may teach dance classes to people on your holidays. This way your hobby a benefit you both spiritually and financially as well.', '2022-09-15', '2022-09-11 02:01:00', '2022-09-13 01:04:21'),
(2, '2FDCDannis', '92429d82a41e930486c6de5ebda9602d55c39986', 'fdc2.dannis@gmail.com', '2022091227635146-Ling_DP - Copy.jpg', 'Lesly', 'Ling', 28, 'Male', '2022-09-12', 'ling li ngain goaig aing a', NULL, '2022-09-12 13:57:35', '2022-09-12 13:58:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

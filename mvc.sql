-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2025 at 12:36 PM
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
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(400) NOT NULL,
  `project_name` varchar(400) NOT NULL,
  `content` text NOT NULL,
  `undertaking` varchar(300) NOT NULL,
  `preference` varchar(100) NOT NULL,
  `deadline` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `user_id`, `title`, `project_name`, `content`, `undertaking`, `preference`, `deadline`, `status`, `create_date`) VALUES
(1, 1, 'alpha', 'alpha', 'test', 'Lead', 'متوسط', '2025-04-25', 'برای انجام', '2025-04-11'),
(9, 1, 'beta project', 'beta', 'this test for show work', 'Lead', 'متوسط', '2025-04-03', 'برای انجام', '2025-04-11'),
(10, 1, 'test2', 'test2', 'asdasd', 'Lead', 'پایین', '2025-04-10', 'بازبینی', '2025-04-11'),
(11, 13, 'beta', 'test database', 'this content for test', 'Lead', 'متوسط', '2025-05-01', 'برای انجام', '2025-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'user',
  `unit` text NOT NULL,
  `name` varchar(200) NOT NULL,
  `nickname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `CreateDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `unit`, `name`, `nickname`, `email`, `password`, `CreateDate`) VALUES
(2, 'developer', 'فنی', 'ali', 'aliiii', 'ali@gmail.com', '$2y$10$yOomrzLr/WEgJjzjqVcOGONQEoG/g/jQV10vKsl4SG1rm2hMF/aem', '2025-04-06 20:16:16'),
(3, 'admin', 'مالی', 'ahmad', 'ahd', 'ahmad@gmail.com', '$2y$10$6NC9v8Edm0/vKUO2QIX/xeFB.UkjAD.uJzP/EzkOFAUXaK/nOJGoy', '2025-04-06 20:31:35'),
(13, 'admin', 'فنی', 'admin', 'system-admin', 'admin@gmail.com', '$2y$10$oXtjLpGgeq8vu4chqV65jusfqHDhWnS9aS8TMC66d2ZgZ53Bh3PFG', '2025-04-12 13:43:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `task`
--
ALTER TABLE `task`
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
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

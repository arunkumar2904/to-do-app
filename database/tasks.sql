-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2026 at 05:31 PM
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
-- Database: `to-do`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `date` date NOT NULL,
  `active` int(255) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `status`, `created_on`, `date`, `active`) VALUES
(1, 1, 'Learn C ', 'Learn C Basic & Fundamentals', 2, '2026-08-09 14:39:33', '2026-08-13', 1),
(2, 1, 'svd', 'dvd', 1, '0000-00-00 00:00:00', '2026-08-18', 1),
(3, 1, 'Learn C++', 'Learn C++ Basics & Fundamentals', 1, '0000-00-00 00:00:00', '2026-08-13', 1),
(4, 7, 'home', 'create  home', 1, '0000-00-00 00:00:00', '2026-08-20', 1),
(5, 7, 'office', 'weeklt', 1, '0000-00-00 00:00:00', '2026-08-24', 1),
(6, 7, 'dinner', 'dinner saptachu', 2, '0000-00-00 00:00:00', '2026-08-20', 1),
(7, 8, 'Cook Dinner', 'Dosa and 3 Chutneys', 2, '0000-00-00 00:00:00', '2026-08-24', 1),
(8, 8, 'Shopping for Birthday', 'Go to shopping with cousin for my birthday ', 1, '0000-00-00 00:00:00', '2026-08-27', 1),
(9, 8, 'Complete Project', 'Complete my office project within this month', 1, '0000-00-00 00:00:00', '2026-08-31', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

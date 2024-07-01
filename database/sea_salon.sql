-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2024 at 02:29 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sea_salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id_branch` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `opening_time` int(11) NOT NULL,
  `closing_time` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id_branch`, `branch_name`, `location`, `opening_time`, `closing_time`, `deleted_at`) VALUES
(1, 'Yuvela Surabaya', 'Surabaya', 9, 19, NULL),
(2, 'Yuvela Bandung', 'Bandung', 10, 20, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id_reservation` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `service_type` int(11) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id_reservation`, `users_id`, `branch_id`, `service_type`, `reservation_date`, `reservation_time`) VALUES
(3, 4, 1, 1, '2024-07-03', '11:00:00'),
(4, 2, 1, 1, '2024-07-02', '11:00:00'),
(6, 4, 1, 4, '2024-07-03', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `users_id` varchar(100) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `star_rating` int(1) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `users_id`, `reservation_id`, `star_rating`, `comment`) VALUES
(3, '4', 3, 4, 'baguys'),
(4, '4', 6, 3, 'bagus');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `service_name` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id_service`, `branch_id`, `service_name`, `duration`, `deleted_at`) VALUES
(1, 2, 'Haircuts and Styling', 60, '2024-07-01 18:26:29'),
(2, 2, 'Manicure and Pedicure', 60, NULL),
(3, 2, 'Facial Treatments', 60, NULL),
(4, 1, 'Haircuts and Styling', 50, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `nama`, `email`, `phone_number`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '081515801818', '$2y$10$b6sY5fY9fRZ0UoE51OZLNubGsDZEgb73tjQwuvz0I.GDFdmE0ZPE6', 'admin', '2024-06-30 16:00:31'),
(2, 'andi', 'andi@gmail.com', '085850319392', '$2y$10$eDiEyEY3mJwnmXzuJt7Y.un.ZIUf0W00XhctU40.sPgMIMVygA4Ie', 'customer', '2024-06-30 16:10:56'),
(3, 'riyan', 'riyan@gmail.com', '0858501921019', '$2y$10$eTd1EhI1tvzkZl2y//l96OuU36zjzmw5fhdr8TkaT50aY.Y.Ka/Ay', 'customer', '2024-06-30 17:25:47'),
(4, 'suro', 'sura@gmail.com', '085850131121', '$2y$10$b6sY5fY9fRZ0UoE51OZLNubGsDZEgb73tjQwuvz0I.GDFdmE0ZPE6', 'customer', '2024-07-01 04:59:26'),
(5, 'rian', 'rian@gmail.com', '0858502910019', '$2y$10$4OYd0LAp42C6q.IeUj1R0OhR.onGAwoSrNNj3SK/cYgyYhssfD6FW', 'customer', '2024-07-01 06:00:37'),
(6, 'adi', 'adi@gmail.com', '081518092019', '$2y$10$kA8LakgdDvAAHH0CNfkJ3OsbsP1wTs2BcCqtCWmszc/YbDlg6h0kK', 'customer', '2024-07-01 06:01:13'),
(7, 'Thomas N', 'thomas.n@compfest.id', '08123456789', '$2y$10$0ZmbQgcp1kLwadBqbEuy4eYxrYDmX/KyzizvVv3wWF254EhGDjS0a', 'admin', '2024-07-01 12:04:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id_branch`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id_reservation`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id_branch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

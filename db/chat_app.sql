-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 19, 2025 at 04:17 AM
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
-- Database: `chat_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`) VALUES
(3, 3, 3, 'test', '2025-02-19 02:55:29'),
(4, 3, 5, 'ase', '2025-02-19 02:55:36'),
(5, 3, 3, 'test', '2025-02-19 02:58:49'),
(6, 3, 3, 'aaa', '2025-02-19 02:58:51'),
(7, 3, 3, 'sadasd', '2025-02-19 02:58:52'),
(8, 3, 5, '123213', '2025-02-19 03:00:48'),
(9, 3, 5, '21312312', '2025-02-19 03:00:50'),
(10, 5, 3, '21312321', '2025-02-19 03:01:21'),
(11, 5, 3, '2131231', '2025-02-19 03:01:25'),
(12, 5, 5, '12312312', '2025-02-19 03:01:28'),
(13, 5, 5, '123123', '2025-02-19 03:01:31'),
(14, 5, 3, 'asdsadas', '2025-02-19 03:07:08'),
(15, 5, 3, 'asdasdas', '2025-02-19 03:07:12'),
(16, 3, 3, 'ewewqqwe', '2025-02-19 03:13:07'),
(17, 3, 3, 'sdasdas', '2025-02-19 03:13:08'),
(18, 5, 3, 'asdsadsa', '2025-02-19 03:13:43'),
(19, 5, 3, 'sadasdasda', '2025-02-19 03:13:44'),
(20, 5, 3, 'asdasdasda', '2025-02-19 03:13:49'),
(21, 3, 3, 'sadsadas', '2025-02-19 03:16:01'),
(22, 3, 3, 'sadasdas', '2025-02-19 03:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_active` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile_picture`, `created_at`, `last_active`) VALUES
(3, 'Test', 'test@mail.com', '$2y$10$Hn64rWDQ8rkSSrlz/p52UuSZHQmFjdpBv5sQ90MkyoknhaduUJUWK', '-mpx1ts.jpg', '2025-02-19 00:39:06', '2025-02-18 23:16:04'),
(5, 'Test2', 'test2@mail.com', '$2y$10$kCixPBTF8tMt83Cpzu99KevrvLCVYQEEJpTNsoFDZEOX9M0mvHvwq', 'HTNNBIFp_400x400.jpg', '2025-02-19 00:51:10', '2025-02-18 23:14:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

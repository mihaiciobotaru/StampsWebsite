-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2022 at 08:52 AM
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
-- Database: `stampworld`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalogue`
--

CREATE TABLE `catalogue` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_stamp` int(11) NOT NULL,
  `created_datetime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catalogue`
--

INSERT INTO `catalogue` (`id`, `name`, `id_user`, `id_stamp`, `created_datetime`) VALUES
(1, 'My Collection', 1, 2, '2015-06-02'),
(2, 'My Collection', 1, 3, '2022-06-15'),
(4, 'New Collection', 5, 1, '2022-06-13'),
(5, 'New Collection', 3, 6, '2022-04-11'),
(6, 'Another Collection', 4, 7, '2021-12-21'),
(7, 'HELLOtHERE', 7, 1, '2022-06-19'),
(8, 'ASDASD', 7, 1, '2022-06-19'),
(9, 'zechfrons Liked Stamps', 7, 1, '2022-06-19'),
(10, 'zechfron`s Liked stamps', 7, 1, '2022-06-19'),
(11, 'helloooooo', 7, 1, '2022-06-19'),
(12, 'abcd', 7, 1, '2022-06-20'),
(13, 'a;shd;asd;', 8, 0, '2022-06-20'),
(14, 'zechfron`s Liked stamps', 7, 30, '2022-06-19'),
(15, 'zechfron`s Liked stamps', 7, 30, '2022-06-19'),
(16, 'zechfron`s Liked stamps', 7, 14, '2022-06-19'),
(17, 'zechfron`s Liked stamps', 7, 30, '2022-06-19'),
(18, 'zechfron`s Liked stamps', 7, 30, '2022-06-19'),
(19, 'zechfron`s Liked stamps', 7, 30, '2022-06-19'),
(20, 'zechfron`s Liked stamps', 7, 30, '2022-06-19'),
(21, 'zechfron`s Liked stamps', 7, 30, '2022-06-19'),
(22, 'zechfron`s Liked stamps', 7, 30, '2022-06-19'),
(23, 'zechfron`s Liked stamps', 7, 14, '2022-06-19'),
(24, 'zechfron`s Liked stamps', 7, 15, '2022-06-19'),
(25, 'zechfron`s Liked stamps', 7, 16, '2022-06-19'),
(26, 'zechfron`s Liked stamps', 7, 30, '2022-06-19'),
(27, 'zechfron`s Liked stamps', 7, 20, '2022-06-19'),
(28, 'zechfron`s Liked stamps', 7, 21, '2022-06-19'),
(29, 'zechfron`s Liked stamps', 7, 23, '2022-06-19'),
(30, 'zechfron`s Liked stamps', 7, 24, '2022-06-19'),
(31, 'zechfron`s Liked stamps', 7, 25, '2022-06-19'),
(32, 'zechfron`s Liked stamps', 7, 26, '2022-06-19'),
(33, 'zechfron`s Liked stamps', 7, 27, '2022-06-19'),
(34, 'zechfron`s Liked stamps', 7, 28, '2022-06-19'),
(35, 'zechfron`s Liked stamps', 7, 29, '2022-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(11) NOT NULL,
  `migration` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `created_at`) VALUES
(1, 'm0001_initial.php', '2022-06-19 10:49:31'),
(2, 'm0002_add_password_column.php', '2022-06-19 10:49:31'),
(3, 'm0002_initial.php', '2022-06-19 10:49:31'),
(4, 'm0003_initial.php', '2022-06-19 10:49:31'),
(5, 'm0004_databasepopoulation.php', '2022-06-19 10:49:31');

-- --------------------------------------------------------

--
-- Table structure for table `stamps`
--

CREATE TABLE `stamps` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `posted_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `likes` int(11) NOT NULL,
  `width` decimal(5,2) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `price` decimal(5,2) NOT NULL,
  `perforations` int(11) DEFAULT NULL,
  `posted_datetime` date NOT NULL,
  `issued_datetime` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stamps`
--

INSERT INTO `stamps` (`id`, `name`, `country`, `owner_id`, `posted_id`, `category`, `color`, `likes`, `width`, `height`, `price`, `perforations`, `posted_datetime`, `issued_datetime`) VALUES
(1, 'Monaco - Prince Charles III', 'France', 1, 1, 'Family', 'Blue', 0, '10.00', '20.00', '50.00', 5, '2022-06-18', '2014-06-17'),
(2, 'French-South-and-Antarctic-Terr. - Penguins and Se', 'France', 1, 1, 'Agriculture', 'Green', 5, '15.00', '24.00', '35.00', 4, '2022-06-18', '2014-02-14'),
(3, 'Ungaria - King Franz Joseph - Lithographed', 'Hungary', 2, 2, 'Army', 'Yellow', 0, '23.00', '23.00', '45.00', 7, '2022-06-18', '2014-06-08'),
(4, 'United-States - Benjamin Franklin, 1706-1790 and G', 'USA', 2, 2, 'Army', 'Blue', 0, '12.00', '54.00', '546.00', 12, '2022-06-18', '2011-12-13'),
(5, 'Great-Britain - Queen Victoria, 1819-1901', 'UK', 3, 3, 'Aviation', 'Brown', 0, '45.00', '34.00', '23.00', 7, '2021-06-15', '2015-02-09'),
(6, 'Germania - New Daily Stamp', 'Germany', 2, 2, 'Architecture', 'Magenta', 0, '15.00', '34.00', '32.00', 10, '2022-06-08', '2021-07-20'),
(7, 'România - Cap de Bour - Emisiunea I', 'Romania', 4, 4, 'Agriculture', 'Red', 0, '23.00', '45.00', '100.00', 2, '2011-02-24', '2010-12-20'),
(12, 'Radu Chelaru', 'Radu Chelaru', 7, 0, 'Radu Chelaru', 'white', 0, '130.00', '123.00', '64.00', 0, '2022-06-19', '2022-06-14'),
(13, 'Chelaru Radu2', 'asdas', 7, 0, 'asdas', 'dasd', 0, '894.00', '350.00', '0.00', 0, '2022-06-19', '2022-06-14'),
(14, 'raduchelaru1@gmail.com', 'asdas', 7, 0, 'asda', 'dasd', 0, '894.00', '898.00', '0.00', 0, '2022-06-18', '2022-06-22'),
(15, 'Chelaru Radu3', 'asdas', 7, 0, 'asdas', 'dasd', 0, '894.00', '350.00', '0.00', 0, '2022-06-19', '2022-06-13'),
(17, 'Chelaru Radu4', 'asdas', 7, 0, 'asdas', 'dasd', 0, '894.00', '350.00', '0.00', 0, '2022-06-19', '2022-06-08'),
(19, 'Chelaru Radu5', 'asdas', 7, 0, 'asdas', 'dasd', 0, '894.00', '350.00', '0.00', 0, '2022-06-19', '2022-06-08'),
(20, 'Chelaru Radu10', 'asdas', 7, 0, 'asdas', 'dasd', 0, '894.00', '350.00', '0.00', 0, '2022-06-19', '2022-06-14'),
(22, 'Chelaru Radu102', 'asdas', 7, 0, 'asdas', 'dasd', 0, '894.00', '350.00', '0.00', 0, '2022-06-19', '2022-06-14'),
(24, 'Chelaru Radu103', 'asdas', 7, 0, 'asdas', 'dasd', 0, '894.00', '350.00', '0.00', 0, '2022-06-19', '2022-06-14'),
(26, 'Chelaru Radu104', 'asdas', 7, 0, 'asdas', 'dasd', 0, '894.00', '350.00', '0.00', 0, '2022-06-19', '2022-06-14'),
(28, 'Chelaru Radu100000005', 'asdas', 7, 0, 'asdas', 'dasd', 0, '894.00', '350.00', '0.00', 0, '2022-06-19', '2022-06-07'),
(29, 'Chelaru Radu110', 'asdas', 7, 0, 'asdas', 'dasd', 0, '894.00', '350.00', '0.00', 0, '2022-06-19', '2022-06-22'),
(30, 'Chelaru Radu200000', 'asdas', 7, 0, 'asdas', 'dasd', 0, '894.00', '350.00', '0.00', 0, '2022-06-19', '2022-06-21'),
(31, 'Chelaru Radu3000', '123123', 7, 0, 'asdas', 'dasd', 0, '894.00', '350.00', '0.00', 0, '2022-06-19', '2022-06-21'),
(32, 'Chelaru Radu', 'asdas', 7, 0, 'asdas', 'dasd', 0, '894.00', '350.00', '0.00', 0, '2022-06-20', '2022-06-15'),
(33, 'Chelaru Radu777', 'asdas', 7, 0, 'asdas', 'dasdas', 33, '894.00', '350.00', '0.00', 0, '2022-06-20', '2022-06-15'),
(36, 'Chelaru Radu123123', 'asdas', 7, 0, 'asdas', 'dasd', 6, '0.00', '350.00', '0.00', 0, '2022-06-20', '2022-06-15'),
(38, 'Chelaru Radu12345', 'asdas', 8, 0, 'asdas', 'dasd', 0, '894.00', '350.00', '0.00', 0, '2022-06-20', '2022-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `stamps_posted` int(11) NOT NULL,
  `stamps_owned` int(11) NOT NULL,
  `password` varchar(512) NOT NULL,
  `create_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `firstname`, `lastname`, `status`, `stamps_posted`, `stamps_owned`, `password`, `create_datetime`) VALUES
(1, 'vladgrigo', 'vladgrigorita@yahoo.com', 'Vlad', 'Grigorita', 0, 0, 0, '12345678', '2022-06-18 14:33:48'),
(2, 'johnsnow', 'johnsnow@gmail.com', 'John', 'Snow', 0, 0, 0, '$2y$10$t0dFlpEkD2baiLZqWf3/O.PTIJlC0SK1cYW5V7OvADACqM2uEKhhm', '2022-06-18 14:34:49'),
(3, 'vasileion', 'vasileion@gmail.com', 'Vasile', 'Ion', 0, 0, 0, '$2y$10$xIaEVDNrZmfpogGnu4qXne/TdwXNq4.Lmt6XEggnlppHBY1ovAfUm', '2022-06-18 14:35:16'),
(4, 'raduchelaru', 'raduchelaru@yahoo.com', 'Radu', 'Chelaru', 0, 0, 0, '$2y$10$n6L93GHhG5Wgn2g9p5rf5egXHqK95mLbiIw.RXLPBKEOZm7lchUha', '2022-06-18 14:35:43'),
(5, 'gigibecali', 'gigibecali@yahoo.com', 'Gigi', 'Becali', 0, 0, 0, '$2y$10$XSvk8tjYxnK.TlH8VS0CB.7Cza/2rfv8xc4xQ6lYANg9SzftACPO.', '2022-06-18 14:36:19'),
(6, 'mihaiciobo', 'mihaiciobo@yahoo.com', 'Mihai', 'Ciobotaru', 0, 0, 0, '$2y$10$Ro/i4Ds9xECiJ0wyoUU7yOwrd2PSCwff/Ups.hOmVrvbK.9NRcbfu', '2022-06-18 14:36:58'),
(7, 'zechfron12', 'raduchelaru1@gmail.com', 'Radu', 'Chelaru', 0, 0, 0, '$2y$10$3gNqyxiSFS4K2I/YB.pMIushEE57QUiToL.E2xM0ejRvSuOU9Pgvu', '2022-06-19 10:50:59'),
(8, 'zechfron124', 'raduchelaru3@gmail.com', 'Radu', 'Chelaru', 0, 0, 0, '$2y$10$cyeCpe7C4KWmjqBK/Cv7OuvsT5dJ.hsBDUg2iTygsHf3zmeMuWH2e', '2022-06-20 06:07:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalogue`
--
ALTER TABLE `catalogue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stamps`
--
ALTER TABLE `stamps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalogue`
--
ALTER TABLE `catalogue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stamps`
--
ALTER TABLE `stamps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

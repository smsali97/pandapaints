-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 31, 2019 at 06:21 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myshop_13005`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers_13005`
--

CREATE TABLE `customers_13005` (
  `cid` int(11) NOT NULL,
  `sname` varchar(20) DEFAULT NULL,
  `cname` varchar(20) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `area` varchar(20) DEFAULT NULL,
  `gc` varchar(30) DEFAULT NULL,
  `cdate` date DEFAULT NULL,
  `cno` varchar(30) DEFAULT NULL,
  `fk_spid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers_13005`
--

INSERT INTO `customers_13005` (`cid`, `sname`, `cname`, `address`, `area`, `gc`, `cdate`, `cno`, `fk_spid`) VALUES
(1, 'LIKEA', 'Syed Ahmed Ali', 'A-365 Block 13', 'Chicken', '(44334,35533)', '2018-09-13', '(44334,35533)', 8),
(6, 'Zamazon', 'Syed Faisal Ali', 'Karachi', 'Saddar', '(433673,363636636)', NULL, '0443636435', 8),
(10, 'MMT1997', 'Muhammed Maaz Tariq', 'ABCDZEW', 'JKLKOM', '32798273897982389', NULL, '03331234567', 8),
(13, 'Farget', 'Syed Bilal Ali', 'Numaish', 'Block 3', '(36466,323553)', NULL, '03331234567', 8),
(15, 'Bolivia Bakers', 'Micheal Madison', 'Park Lane', 'London', '(33566,363564)', NULL, '03331234567', 9),
(16, 'Daily Bugle', 'Peter Parker', 'The Bronx', 'New York', '(36466,323553)', NULL, '0321242455', 9),
(19, 'Awesome Paints', ' Zaid shariq', 'b-9 25th street oxford street monopoly london', '23600 cm', '35,56,', NULL, '03028743214', 8);

-- --------------------------------------------------------

--
-- Table structure for table `payment_13005`
--

CREATE TABLE `payment_13005` (
  `receiptno` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cid` int(11) DEFAULT NULL,
  `spid` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_13005`
--

INSERT INTO `payment_13005` (`receiptno`, `time`, `cid`, `spid`, `amount`) VALUES
(1, '2018-12-01 04:30:24', 1, 8, 1200),
(2, '2018-12-04 05:00:53', 6, 8, 700),
(3, '2018-12-14 14:10:07', 1, 8, 30000),
(4, '2019-05-23 16:00:52', 13, 8, 9000),
(5, '2019-07-06 10:19:53', 16, 8, 10000),
(6, '2019-07-06 10:20:10', 16, 8, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `products_13005`
--

CREATE TABLE `products_13005` (
  `pid` int(11) NOT NULL,
  `pcode` varchar(6) NOT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `shade` varchar(7) DEFAULT NULL,
  `size` varchar(3) DEFAULT NULL,
  `sales_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_13005`
--

INSERT INTO `products_13005` (`pid`, `pcode`, `brand`, `type`, `shade`, `size`, `sales_price`) VALUES
(12, '090', 'Hi-Duluxes', '2', '#ffffff', 'L', 3000),
(13, '091', 'Shield Plus', '2', '#ff0f0f', 'S', 1000),
(15, '093', 'FireBrick', '1', '#ff0000', 'S', 1000),
(16, '100', 'Diamond Paint', '2', '#ff4141', 'L', 1000),
(17, '086', 'Weather Guard', '3', '#7aff04', 'S', 5000),
(18, '103', 'Hi Delux', '1', '#bf3737', 'S', 1000),
(19, '056', 'jarmite', '1', '#ffe600', 'L', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `salesorderline_13005`
--

CREATE TABLE `salesorderline_13005` (
  `qty` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pid` int(11) NOT NULL,
  `order_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesorderline_13005`
--

INSERT INTO `salesorderline_13005` (`qty`, `rate`, `amount`, `timestamp`, `pid`, `order_no`) VALUES
(20, 12, 240, '2018-10-04 21:52:56', 12, 101),
(5, 58, 290, '2018-10-06 20:31:08', 12, 110),
(1, 20, 20, '2018-10-11 19:18:21', 12, 132),
(200, 245, 49000, '2018-10-28 15:59:54', 12, 139),
(20, 400, 8000, '2018-11-02 10:02:36', 12, 151),
(5, 500, 2500, '2018-11-02 18:14:39', 12, 164),
(311, 2, 622, '2018-11-05 19:29:42', 12, 173),
(2, 8, 16, '2018-11-12 20:41:43', 12, 181),
(23, 2, 46, '2018-11-25 11:52:54', 12, 185),
(100, 20, 2000, '2018-11-30 18:19:58', 12, 187),
(1000, 20, 20000, '2018-12-01 17:57:26', 12, 190),
(30, 500, 15000, '2019-08-29 17:25:17', 12, 194),
(12, 13, 156, '2018-10-04 21:53:09', 13, 101),
(2, 50, 100, '2018-10-04 22:16:04', 13, 102),
(23, 200, 4600, '2018-10-04 22:34:01', 13, 104),
(3, 2, 6, '2018-10-05 14:38:50', 13, 108),
(56, 2, 112, '2018-10-07 14:50:16', 13, 114),
(21, 34, 714, '2018-10-31 18:27:41', 13, 144),
(50, 2000, 100000, '2018-11-05 14:30:30', 13, 170),
(0, 3, 0, '2018-11-05 18:47:20', 13, 172),
(1000, 200, 200000, '2018-11-06 19:31:36', 13, 179),
(18, 9000, 162000, '2018-12-14 14:16:40', 13, 192),
(30, 15, 450, '2018-10-05 05:12:16', 15, 106),
(50, 266, 13300, '2018-10-05 18:10:53', 15, 109),
(148, 598, 88504, '2018-10-10 21:30:56', 15, 118),
(506, 600, 303600, '2018-10-11 11:06:33', 15, 123),
(20, 30, 600, '2018-10-22 09:06:42', 15, 137),
(90, -10, -900, '2018-10-28 16:00:38', 15, 139),
(6, 63, 378, '2018-11-02 18:07:25', 15, 162),
(5, 25, 125, '2018-11-05 21:08:01', 15, 174),
(1, 4, 4, '2018-11-28 01:18:04', 15, 186),
(20, 1000, 20000, '2018-12-01 05:39:08', 15, 189),
(15, 100, 1500, '2018-12-01 17:58:03', 15, 190),
(35, 600, 21000, '2019-07-06 10:18:21', 15, 193),
(50, 32, 1600, '2018-10-10 15:40:47', 16, 116),
(50, 500, 25000, '2018-10-11 11:04:46', 16, 123),
(60, 200, 12000, '2018-10-11 11:13:01', 16, 125),
(54, 2, 108, '2018-11-02 09:36:35', 16, 148),
(5, 185, 925, '2018-11-02 11:14:04', 16, 152),
(4, 200, 800, '2018-11-02 18:09:30', 16, 163),
(128, 1, 128, '2018-11-02 20:37:40', 16, 166),
(5, 4455, 22275, '2018-11-25 11:10:03', 16, 182),
(59, 7000400, 413024000, '2018-12-14 14:18:11', 16, 192),
(20, 1033.31, 20666.2, '2018-10-07 09:46:58', 17, 113),
(8899, 900, 8009100, '2018-10-28 16:00:15', 17, 139),
(1, 4, 4, '2018-11-28 01:18:13', 17, 186),
(23, 10000, 230000, '2018-12-14 14:16:18', 19, 192);

-- --------------------------------------------------------

--
-- Table structure for table `salesorders_13005`
--

CREATE TABLE `salesorders_13005` (
  `order_no` int(11) NOT NULL,
  `sdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `qty` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `spid` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesorders_13005`
--

INSERT INTO `salesorders_13005` (`order_no`, `sdate`, `qty`, `rate`, `amount`, `spid`, `cid`, `pid`) VALUES
(1, '2018-09-28 17:57:18', 200, 10.5, 2100, 8, 10, 12),
(3, '2018-09-28 18:34:01', 4, 0.5, 2, 8, 10, 15),
(4, '2018-09-29 05:45:46', 10, 20, 200, 8, 1, 16),
(5, '2018-09-29 05:51:52', 20, 5, 100, 8, 1, 16),
(6, '2018-09-29 19:21:04', 11, 25, 275, 8, 10, 15);

-- --------------------------------------------------------

--
-- Table structure for table `salesorder_13005`
--

CREATE TABLE `salesorder_13005` (
  `order_no` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `spid` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_return` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesorder_13005`
--

INSERT INTO `salesorder_13005` (`order_no`, `cid`, `spid`, `timestamp`, `is_return`) VALUES
(101, 10, 8, '2018-10-04 21:52:48', 0),
(102, 6, 8, '2018-10-04 22:15:45', 0),
(104, 10, 8, '2018-10-04 22:33:48', 0),
(106, 13, 8, '2018-10-05 05:11:56', 0),
(108, 10, 8, '2018-10-05 14:38:40', 0),
(109, 6, 8, '2018-10-05 18:10:41', 0),
(110, 10, 8, '2018-10-06 20:30:52', 0),
(111, 10, 8, '2018-10-07 09:45:47', 0),
(113, 10, 8, '2018-10-07 09:46:25', 0),
(114, 10, 8, '2018-10-07 14:50:03', 0),
(115, 16, 9, '2018-10-08 07:43:17', 0),
(116, 13, 8, '2018-10-10 15:39:33', 0),
(118, 10, 8, '2018-10-10 21:30:43', 0),
(120, 6, 8, '2018-10-11 10:27:29', 0),
(122, 10, 8, '2018-10-11 10:28:39', 0),
(123, 15, 9, '2018-10-11 11:03:14', 0),
(125, 10, 8, '2018-10-11 11:11:48', 0),
(126, 10, 8, '2018-10-11 11:51:41', 0),
(127, 15, 9, '2018-10-11 13:48:48', 0),
(128, 13, 8, '2018-10-11 13:49:18', 0),
(130, 13, 8, '2018-10-11 19:14:29', 0),
(132, 15, 9, '2018-10-11 19:18:06', 0),
(134, 1, 8, '2018-10-11 20:20:14', 0),
(135, 1, 8, '2018-10-12 11:33:49', 0),
(136, 16, 9, '2018-10-12 12:26:26', 0),
(137, 15, 9, '2018-10-22 09:06:20', 0),
(138, 10, 8, '2018-10-25 07:52:08', 0),
(139, 13, 8, '2018-10-28 15:59:30', 0),
(140, 15, 9, '2018-10-28 16:20:33', 0),
(141, 13, 8, '2018-10-30 14:00:12', 0),
(142, 13, 8, '2018-10-31 11:42:45', 0),
(143, 15, 9, '2018-10-31 11:43:04', 0),
(144, 16, 9, '2018-10-31 18:27:27', 0),
(147, 10, 8, '2018-11-01 15:37:17', 0),
(148, 6, 8, '2018-11-02 09:36:18', 0),
(151, 6, 8, '2018-11-02 10:02:18', 1),
(152, 6, 8, '2018-11-02 11:13:33', 0),
(156, 6, 8, '2018-11-02 13:13:53', 1),
(162, 10, 8, '2018-11-02 18:06:34', 0),
(163, 16, 9, '2018-11-02 18:09:04', 0),
(164, 10, 8, '2018-11-02 18:14:22', 1),
(165, 16, 9, '2018-11-02 18:19:51', 0),
(166, 19, 8, '2018-11-02 20:37:14', 1),
(167, 19, 8, '2018-11-02 20:38:12', 1),
(170, 13, 8, '2018-11-05 14:30:03', 1),
(171, 10, 8, '2018-11-05 18:46:36', 0),
(172, 1, 8, '2018-11-05 18:46:57', 1),
(173, 6, 8, '2018-11-05 19:29:30', 0),
(174, 6, 8, '2018-11-05 21:07:08', 0),
(175, 6, 8, '2018-11-05 21:25:55', 1),
(178, 10, 8, '2018-11-06 12:08:46', 0),
(179, 13, 8, '2018-11-06 19:31:19', 1),
(180, 13, 8, '2018-11-07 14:42:27', 1),
(181, 6, 8, '2018-11-12 20:41:19', 0),
(182, 15, 9, '2018-11-25 11:09:26', 1),
(183, 6, 8, '2018-11-25 11:10:34', 0),
(185, 6, 8, '2018-11-25 11:52:28', 0),
(186, 10, 8, '2018-11-28 01:17:47', 0),
(187, 13, 8, '2018-11-30 18:19:45', 0),
(188, 6, 8, '2018-11-30 18:44:21', 1),
(189, 10, 8, '2018-12-01 05:38:58', 0),
(190, 10, 8, '2018-12-01 17:57:15', 0),
(191, 10, 8, '2018-12-14 14:15:48', 0),
(192, 19, 8, '2018-12-14 14:15:57', 0),
(193, 6, 8, '2019-07-06 10:17:55', 0),
(194, 15, 9, '2019-08-29 17:25:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salespersons_13005`
--

CREATE TABLE `salespersons_13005` (
  `spid` int(11) NOT NULL,
  `spname` varchar(50) NOT NULL,
  `cno` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salespersons_13005`
--

INSERT INTO `salespersons_13005` (`spid`, `spname`, `cno`) VALUES
(5, 'Hasher Zaidi', '0321242454'),
(8, 'Syed Mohammad Sualeh Ali', '03242420996'),
(9, 'John Jaden', '0324566643'),
(10, 'Yasir', '030021223345'),
(13, 'Rashid', '0321456987');

-- --------------------------------------------------------

--
-- Table structure for table `users_13005`
--

CREATE TABLE `users_13005` (
  `uid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `fk_spid` int(11) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `isActive` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_13005`
--

INSERT INTO `users_13005` (`uid`, `username`, `password`, `created_at`, `fk_spid`, `user_type`, `isActive`) VALUES
(5, 'sysadmin', '48a365b4ce1e322a55ae9017f3daf0c0', '2018-09-21 07:43:22', NULL, 'admin', 1),
(6, 'sualeh', 'ae667cf885f963e298579ff282dc58ac', '2018-09-21 14:37:13', 8, NULL, 1),
(7, 'john', '527bd5b5d689e2c32ae974c6229ff785', '2018-09-21 17:22:23', 9, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers_13005`
--
ALTER TABLE `customers_13005`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `payment_13005`
--
ALTER TABLE `payment_13005`
  ADD PRIMARY KEY (`receiptno`),
  ADD KEY `fk_spid` (`spid`),
  ADD KEY `fk_cid` (`cid`);

--
-- Indexes for table `products_13005`
--
ALTER TABLE `products_13005`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `pcode` (`pcode`);

--
-- Indexes for table `salesorderline_13005`
--
ALTER TABLE `salesorderline_13005`
  ADD PRIMARY KEY (`pid`,`order_no`),
  ADD KEY `order_no` (`order_no`);

--
-- Indexes for table `salesorders_13005`
--
ALTER TABLE `salesorders_13005`
  ADD PRIMARY KEY (`order_no`),
  ADD KEY `fk_salesordercustomer` (`cid`),
  ADD KEY `fk_salesorderproduct` (`pid`),
  ADD KEY `fk_salesordersalesperson` (`spid`);

--
-- Indexes for table `salesorder_13005`
--
ALTER TABLE `salesorder_13005`
  ADD PRIMARY KEY (`order_no`),
  ADD KEY `cid` (`cid`),
  ADD KEY `spid` (`spid`);

--
-- Indexes for table `salespersons_13005`
--
ALTER TABLE `salespersons_13005`
  ADD PRIMARY KEY (`spid`);

--
-- Indexes for table `users_13005`
--
ALTER TABLE `users_13005`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `users_13005_ibfk_1` (`fk_spid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers_13005`
--
ALTER TABLE `customers_13005`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payment_13005`
--
ALTER TABLE `payment_13005`
  MODIFY `receiptno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products_13005`
--
ALTER TABLE `products_13005`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `salesorders_13005`
--
ALTER TABLE `salesorders_13005`
  MODIFY `order_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `salesorder_13005`
--
ALTER TABLE `salesorder_13005`
  MODIFY `order_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `salespersons_13005`
--
ALTER TABLE `salespersons_13005`
  MODIFY `spid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users_13005`
--
ALTER TABLE `users_13005`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_13005`
--
ALTER TABLE `payment_13005`
  ADD CONSTRAINT `fk_cid` FOREIGN KEY (`cid`) REFERENCES `customers_13005` (`cid`),
  ADD CONSTRAINT `fk_spid` FOREIGN KEY (`spid`) REFERENCES `salespersons_13005` (`spid`);

--
-- Constraints for table `salesorderline_13005`
--
ALTER TABLE `salesorderline_13005`
  ADD CONSTRAINT `salesorderline_13005_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products_13005` (`pid`),
  ADD CONSTRAINT `salesorderline_13005_ibfk_2` FOREIGN KEY (`order_no`) REFERENCES `salesorder_13005` (`order_no`);

--
-- Constraints for table `salesorders_13005`
--
ALTER TABLE `salesorders_13005`
  ADD CONSTRAINT `fk_salesordercustomer` FOREIGN KEY (`cid`) REFERENCES `customers_13005` (`cid`),
  ADD CONSTRAINT `fk_salesorderproduct` FOREIGN KEY (`pid`) REFERENCES `products_13005` (`pid`),
  ADD CONSTRAINT `fk_salesordersalesperson` FOREIGN KEY (`spid`) REFERENCES `salespersons_13005` (`spid`);

--
-- Constraints for table `salesorder_13005`
--
ALTER TABLE `salesorder_13005`
  ADD CONSTRAINT `salesorder_13005_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `customers_13005` (`cid`),
  ADD CONSTRAINT `salesorder_13005_ibfk_2` FOREIGN KEY (`spid`) REFERENCES `salespersons_13005` (`spid`);

--
-- Constraints for table `users_13005`
--
ALTER TABLE `users_13005`
  ADD CONSTRAINT `users_13005_ibfk_1` FOREIGN KEY (`fk_spid`) REFERENCES `salespersons_13005` (`spid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

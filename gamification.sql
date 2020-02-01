-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2020 at 06:14 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamification`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `customer_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `balance` int(11) NOT NULL,
  `reward_points` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`customer_id`, `username`, `password`, `email`, `phone`, `balance`, `reward_points`) VALUES
(1, 'kalyan', 'kalyan', 'kalyan@gmail.com', '9999999999', 30000, 500);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_goals`
--

CREATE TABLE `tbl_goals` (
  `goal_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `goal_name` varchar(100) NOT NULL,
  `goal_amount` int(11) NOT NULL,
  `saved_amount` int(11) NOT NULL,
  `goal_status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_goals`
--

INSERT INTO `tbl_goals` (`goal_id`, `username`, `goal_name`, `goal_amount`, `saved_amount`, `goal_status`) VALUES
(1, 'kalyan', 'car', 10000, 31800, 0),
(2, 'kalyan', 'vehicle', 10000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_goal_streak`
--

CREATE TABLE `tbl_goal_streak` (
  `username` varchar(100) NOT NULL,
  `last_date` date NOT NULL,
  `streak_count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_goal_streak`
--

INSERT INTO `tbl_goal_streak` (`username`, `last_date`, `streak_count`) VALUES
('kalyan', '2020-01-31', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_goal_transacfions`
--

CREATE TABLE `tbl_goal_transacfions` (
  `transaction_id` int(11) NOT NULL,
  `goal_id` int(11) NOT NULL,
  `ammount` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rewards`
--

CREATE TABLE `tbl_rewards` (
  `reward_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `reward_amount` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_goals`
--
ALTER TABLE `tbl_goals`
  ADD PRIMARY KEY (`goal_id`);

--
-- Indexes for table `tbl_goal_transacfions`
--
ALTER TABLE `tbl_goal_transacfions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `tbl_rewards`
--
ALTER TABLE `tbl_rewards`
  ADD PRIMARY KEY (`reward_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_goals`
--
ALTER TABLE `tbl_goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_goal_transacfions`
--
ALTER TABLE `tbl_goal_transacfions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rewards`
--
ALTER TABLE `tbl_rewards`
  MODIFY `reward_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

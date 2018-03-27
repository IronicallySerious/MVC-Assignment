-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2018 at 02:35 PM
-- Server version: 5.7.21-0ubuntu0.17.10.1
-- PHP Version: 7.1.15-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `id` int(11) NOT NULL,
  `linkid` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `posttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(100) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `upvotes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CommentUpvotes`
--

CREATE TABLE `CommentUpvotes` (
  `username` varchar(30) NOT NULL,
  `lid` int(11) NOT NULL,
  `upvotetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Links`
--

CREATE TABLE `Links` (
  `id` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `title` varchar(140) NOT NULL,
  `username` varchar(30) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `clicks` int(11) NOT NULL,
  `sharetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upvotes` int(11) NOT NULL DEFAULT '0',
  `traffic` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LinksANDTags`
--

CREATE TABLE `LinksANDTags` (
  `linkid` int(11) DEFAULT NULL,
  `tag` text,
  `record_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LinksJOINUpvotes`
--

CREATE TABLE `LinksJOINUpvotes` (
  `lid` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `count(*)` bigint(21) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LinkUpvoteTraffic`
--

CREATE TABLE `LinkUpvoteTraffic` (
  `id` int(11) NOT NULL DEFAULT '0',
  `url` varchar(100) NOT NULL,
  `title` varchar(140) NOT NULL,
  `username` varchar(30) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `clicks` int(11) NOT NULL,
  `sharetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upvotes` bigint(21) NOT NULL DEFAULT '0',
  `traffic` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tags`
--

CREATE TABLE `Tags` (
  `tag` varchar(50) DEFAULT NULL,
  `linkid` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Upvotes`
--

CREATE TABLE `Upvotes` (
  `upvoteid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `upvotetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Upvote_Frequency`
--

CREATE TABLE `Upvote_Frequency` (
  `lid` int(11) NOT NULL,
  `upvotes` bigint(21) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `uid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `followerids` text,
  `followers` int(11) NOT NULL,
  `followingids` text,
  `following` int(11) NOT NULL,
  `karma` int(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CommentUpvotes`
--
ALTER TABLE `CommentUpvotes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `Links`
--
ALTER TABLE `Links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `LinksANDTags`
--
ALTER TABLE `LinksANDTags`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `Upvotes`
--
ALTER TABLE `Upvotes`
  ADD PRIMARY KEY (`upvoteid`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `CommentUpvotes`
--
ALTER TABLE `CommentUpvotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Links`
--
ALTER TABLE `Links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `LinksANDTags`
--
ALTER TABLE `LinksANDTags`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Upvotes`
--
ALTER TABLE `Upvotes`
  MODIFY `upvoteid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

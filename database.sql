-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2014 at 01:44 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `mcnair`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(10) NOT NULL,
  `Hash` varchar(256) NOT NULL,
  `FName` varchar(10) NOT NULL,
  `MName` varchar(10) NOT NULL,
  `LName` varchar(10) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Year` year(4) NOT NULL,
  `Email` text NOT NULL,
  `Industry` text NOT NULL,
  `Company` text NOT NULL,
  `Occupation` text NOT NULL,
  `UndergradInst` text NOT NULL,
  `UndergradMajor` text NOT NULL,
  `GradInst` text NOT NULL,
  `GradMajor` text NOT NULL,
  PRIMARY KEY (`UID`),
  UNIQUE KEY `UID` (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`UID`, `Username`, `Hash`, `FName`, `MName`, `LName`, `Phone`, `Year`, `Email`, `Industry`, `Company`, `Occupation`, `UndergradInst`, `UndergradMajor`, `GradInst`, `GradMajor`) VALUES
(1, 'bzs208', '2563e3f54767cdadfbd7d08b24ca59f1aa0ee7e948ebda096e655f28785497f3', 'Bob', 'Z', 'Saludo', '', 2012, '', '', '', '', '', '', '', ''),
(2, 'zm123', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Zahra', '', 'Mahmood', '', 2012, '', '', '', '', '', '', '', '');
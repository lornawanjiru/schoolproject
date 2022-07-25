-- phpMyAdmin SQL Dump
-- version 5.0.4deb2ubuntu5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2022 at 11:48 AM
-- Server version: 8.0.29-0ubuntu0.21.10.2
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int NOT NULL,
  `upMail` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `upMail`, `password`, `firstName`, `middleName`, `lastName`, `contact`, `status`) VALUES
(2, 'admin@gmail.com', '$2y$10$Da9PEadcNA8f6pdl7ZrlmuSAs.elShtv7JmQDCoDgPk9ulcK4fFRO', 'Lorna', 'C', 'Wanjiru', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `applicationID` int NOT NULL,
  `studentID` int NOT NULL,
  `sigID` int DEFAULT NULL,
  `scholarshipID` int NOT NULL,
  `appDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `appstatus` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `verifiedBySignatory` varchar(20) NOT NULL DEFAULT 'Pending',
  `gpa` int DEFAULT NULL,
  `languageresults` int DEFAULT NULL,
  `financialsupport` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Not necessary',
  `ethnic` varchar(255) CHARACTER SET utf16 COLLATE utf16_general_ci DEFAULT NULL,
  `totalresults` int DEFAULT NULL,
  `previous_appstatus` varchar(255) NOT NULL DEFAULT 'active',
  `previous_verifiedBySignatory` varchar(255) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`applicationID`, `studentID`, `sigID`, `scholarshipID`, `appDate`, `appstatus`, `verifiedBySignatory`, `gpa`, `languageresults`, `financialsupport`, `ethnic`, `totalresults`, `previous_appstatus`, `previous_verifiedBySignatory`) VALUES
(45, 48, 7, 31, '2022-05-08 11:56:07', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'active', 'active'),
(46, 48, 10, 34, '2022-05-08 11:57:28', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'active', 'active'),
(47, 10, 7, 31, '2022-05-08 12:03:26', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'active', 'active'),
(48, 74, 17, 39, '2022-06-18 19:32:03', 'Processing', 'Approved', NULL, NULL, 'No', '', NULL, 'Processing', 'Approved'),
(49, 74, 16, 38, '2022-06-10 12:04:00', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'active', 'active'),
(50, 74, 17, 40, '2022-06-18 19:32:03', 'Processing', 'Approved', NULL, NULL, 'No', '', NULL, 'Processing', 'Approved'),
(51, 74, 16, 36, '2022-06-10 15:23:33', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'active', 'active'),
(52, 74, 16, 37, '2022-06-18 19:56:31', 'inactive', 'currently blocked', NULL, NULL, 'No', '', NULL, 'Pending', 'Pending'),
(53, 74, 20, 43, '2022-06-10 18:13:49', 'Processing', 'Approved', NULL, NULL, 'No', '', NULL, 'active', 'active'),
(54, 74, 21, 44, '2022-06-10 18:24:44', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'active', 'active'),
(55, 77, 21, 44, '2022-06-10 18:52:32', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'active', 'active'),
(56, 77, 17, 39, '2022-06-18 19:32:03', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'Pending', 'Pending'),
(57, 77, 17, 39, '2022-06-18 19:32:03', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'Pending', 'Pending'),
(58, 77, 16, 38, '2022-06-10 19:08:45', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'active', 'active'),
(59, 77, 16, 38, '2022-06-10 19:08:59', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'active', 'active'),
(60, 77, 21, 45, '2022-06-18 19:57:16', 'Processing', 'Approved', NULL, NULL, 'No', '', NULL, 'Processing', 'Approved'),
(61, 77, 20, 43, '2022-06-10 21:24:57', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'active', 'active'),
(62, 78, 20, 43, '2022-06-10 21:31:37', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'active', 'active'),
(63, 78, 17, 39, '2022-06-18 19:32:03', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'Pending', 'Pending'),
(64, 78, 17, 40, '2022-06-18 19:32:03', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'Pending', 'Pending'),
(65, 77, 16, 37, '2022-06-18 19:56:31', 'inactive', 'currently blocked', NULL, NULL, 'No', '', NULL, 'Pending', 'Pending'),
(66, 77, 16, 37, '2022-06-18 19:56:31', 'inactive', 'currently blocked', NULL, NULL, 'No', '', NULL, 'Pending', 'Pending'),
(67, 74, 21, 45, '2022-06-18 19:57:16', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'Pending', 'Pending'),
(68, 74, 20, 42, '2022-06-14 09:59:22', 'Pending', 'Pending', NULL, NULL, 'No', '', NULL, 'active', 'active'),
(69, 77, 17, 40, '2022-06-18 19:32:03', 'Pending', 'Pending', 4, 86, 'No', NULL, 90, 'Pending', 'Pending'),
(70, 77, 17, 40, '2022-06-18 19:32:03', 'Pending', 'Pending', 4, 86, 'No', NULL, 90, 'Pending', 'Pending'),
(71, 77, 17, 40, '2022-06-18 19:32:03', 'Pending', 'Pending', 4, 86, 'No', NULL, 90, 'Pending', 'Pending'),
(72, 77, 17, 40, '2022-06-18 19:32:03', 'Pending', 'Pending', 4, 86, 'No', NULL, 90, 'Pending', 'Pending'),
(73, 77, 17, 40, '2022-06-18 19:32:03', 'Pending', 'Pending', 4, 86, 'No', NULL, 90, 'Pending', 'Pending'),
(74, 77, 17, 40, '2022-06-18 19:32:03', 'Pending', 'Pending', 4, 86, 'No', NULL, 90, 'Pending', 'Pending'),
(75, 79, 16, 36, '2022-06-14 12:19:10', 'Pending', 'Pending', 4, 86, 'No', 'white', 90, 'active', 'active'),
(76, 79, 16, 37, '2022-06-18 19:56:31', 'inactive', 'currently blocked', 4, 86, 'No', 'black', 90, 'Processing', 'Pending'),
(77, 79, 16, 38, '2022-06-14 14:50:10', 'rejected', 'Pending', 3, 40, 'No', 'americanindian', 43, 'active', 'active'),
(78, 79, 20, 42, '2022-06-14 18:57:41', 'Accepted', 'Approved', 4, 86, 'No', 'asian', 90, 'active', 'active'),
(79, 79, 17, 40, '2022-06-18 19:32:03', 'Processing', 'Pending', 4, 86, 'No', 'hawaiian', 90, 'Processing', 'Pending'),
(80, 79, 20, 43, '2022-06-14 16:57:28', 'Processing', 'Pending', 4, 86, 'No', 'americanindian', 90, 'active', 'active'),
(81, 79, 17, 39, '2022-06-18 19:32:03', 'Processing', 'Pending', 4, 86, 'No', 'asian', 90, 'Processing', 'Pending'),
(82, 79, 21, 44, '2022-06-14 17:24:04', 'Processing', 'Pending', 4, 86, 'No', 'hawaiian', 90, 'active', 'active'),
(83, 79, 21, 45, '2022-06-18 19:57:16', 'Rejected', 'Pending', 4, 86, 'No', 'black', 90, 'Rejected', 'Pending'),
(84, 80, 16, 36, '2022-06-18 19:23:45', 'inactive', 'currently blocked', 4, 90, 'Yes', 'black', 94, 'Processing', 'Pending'),
(85, 80, 17, 39, '2022-06-18 19:31:55', 'inactive', 'currently blocked', 4, 87, 'Yes', 'black', 91, 'inactive', 'currently blocked'),
(86, 74, 20, 48, '2022-06-21 11:19:09', 'Result Rejected', 'Pending', 3, 40, 'No', 'black', 43, 'active', 'active'),
(87, 74, 20, 47, '2022-06-21 11:21:17', 'Gender Rejected', 'Pending', 5, 90, 'No', 'black', 95, 'active', 'active'),
(88, 74, 20, 47, '2022-06-21 11:21:46', 'Gender Rejected', 'Pending', 5, 90, 'No', 'black', 95, 'active', 'active'),
(89, 74, 20, 46, '2022-06-21 11:23:16', 'Gender Rejected', 'Pending', 3, 20, 'No', 'latino', 23, 'active', 'active'),
(90, 74, 20, 50, '2022-06-21 11:42:24', 'Gender Rejected', 'Pending', 5, 90, 'No', 'americanindian', 95, 'active', 'active'),
(91, 74, 20, 49, '2022-06-21 11:47:59', 'Gender Rejected', 'Pending', 4, 90, 'No', 'black', 94, 'active', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `upMail` varchar(255) NOT NULL,
  `num` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reset_password`
--

INSERT INTO `reset_password` (`upMail`, `num`) VALUES
('dishantd999@gmail.com', 744014),
('dishantd999@gmail.com', 287736),
('dishantd999@gmail.com', 851718),
('dishantd999@gmail.com', 517402),
('dishantd999@gmail.com', 979640),
('powermbui@gmail.com', 345486);

-- --------------------------------------------------------

--
-- Table structure for table `scholarship`
--

CREATE TABLE `scholarship` (
  `scholarshipID` int NOT NULL,
  `sigID` int NOT NULL,
  `schname` varchar(255) NOT NULL,
  `schlocation` varchar(255) NOT NULL,
  `educationlevel` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gender` varchar(20) NOT NULL,
  `ethnic` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sch` varchar(30) NOT NULL,
  `careerfield` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `appDeadline` date NOT NULL,
  `granteesNum` int NOT NULL,
  `funding` varchar(20) NOT NULL,
  `description` varchar(4095) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `eligibility` text CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `benefits` varchar(4095) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `apply` varchar(4095) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `links` varchar(1024) NOT NULL,
  `contact` varchar(1024) NOT NULL,
  `adminapproval` varchar(20) NOT NULL,
  `previous_adminapproval` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `schstatus` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scholarship`
--

INSERT INTO `scholarship` (`scholarshipID`, `sigID`, `schname`, `schlocation`, `educationlevel`, `gender`, `ethnic`, `sch`, `careerfield`, `appDeadline`, `granteesNum`, `funding`, `description`, `eligibility`, `benefits`, `apply`, `links`, `contact`, `adminapproval`, `previous_adminapproval`, `schstatus`) VALUES
(36, 16, 'Kenya Scholarship', 'Kenya', 'highschool', 'any', '', 'select', 'biologicalsciences', '2023-03-05', 30, '$5000', 'o極祴牥', 'i畹瑲敷', 'l歪桵祧摳', '㭫橨杦摳', 'ljgfds', ';lkjhgfd', 'currently blocked', 'Approved', 'inactive'),
(37, 16, 'Kenya Scholarship', 'Kenya', 'highschool', 'male', 'americanindian,black', 'needy', '', '2023-03-05', 30, '$5000', 'o楱', '歬灯楩番桵祴', 'p潵琶瑲', '潰潩祥', 'kloiutgtde', '', 'currently blocked', 'Approved', 'inactive'),
(38, 16, 'KINSASHA SCHOLARSHIP', 'Ethopia', 'bachelors', 'female', 'black', 'needy', 'administration', '2023-03-05', 27, '$4500', 'p潩桤獡歬浫獡', 'o慩橩摪睩歷獷', 'a煯橫摳桳楌䭁', '佁䩉䑈啗佐䭡汪慩', 'LKSOAJDSKAJKjsjijisj', '', 'Approved', NULL, 'active'),
(39, 17, 'Bengals', 'Ethopia', 'highschool', 'female', 'black,latino,hawaiian', 'needy', 'select', '2023-03-05', 90, '$5000', 'S散畲楴礠污灳敳⁣慮⁰污礠愠捲楴楣慬⁲潬攠楮⁥湡扬楮朠慴瑡捫猠汩步⁲慮獯海慲攠瑨慴⁣慮⁲敳畬琠楮⁢畳楮敳猠摩獲異瑩潮猬⁦楮慮捩慬⁬潳獥猬⁡湤⁬潮札瑥牭⁤慭慧攠瑯⁢牡湤⁡湤⁲数畴慴楯渮⁒敡搠瑨楳⁬慴敳琠灡灥爠瑯⁵湤敲獴慮携', '	周攠捯牥⁣桡汬敮来猠捲敡瑥搠批⁨祢物搠慮搠桹灥牳捡汥⁴牥湤猍કॗ桩捨⁰牯扬敭猠慲攠浯獴⁣物瑩捡氠瑯⁰慹⁡瑴敮瑩潮⁴漍કॗ桹⁳散畲楴礠慮搠灥牦潲浡湣攠捡溒琠扥⁡⁴牡摥ⵯ晦', 'Y潵⁡牥⁧整瑩湧⁴桩猠灲楣攠慬敲琠敭慩氠扥捡畳攠祯甠桡癥⁅瑨敲敵洠⡅呈⤠潮⁹潵爠坡瑣桬楳琮⁉映祯甠睡湴⁴漠慤搠潲⁣桡湧攠祯畲⁷慴捨汩獴Ⱐ橵獴⁳楧渠楮⁴漠祯畲⁃潩湢慳攠慣捯畮琮ഊഊ䥦⁹潵⁮漠汯湧敲⁷楳栠瑯⁲散敩癥⁴桥獥⁰物捥⁡汥牴⁥浡楬猬⁵湳畢獣物扥⁨敲攮ഊഊ', '', 'You will have the opportunity to:\r\n\r\nBuild a foundational understanding of Azure hybrid technologies.\r\nLearn about the core concepts of Azure Arc and the Azure Stack portfolio.\r\nGet the expertise to manage and maintain environments that span on-premises technology, multicloud services, and edge devices.', 'Kandie has invited you into her(his) contact network. After accepting the invitation, you will have the following opportunities:\r\nGive Collins Kandie a recommendation or ask Collins Kandie to give it to you to help each other find jobs in the future\r\nExchange direct messages with Collins Kandie\r\nGet notifications when Collins Kandie is seeking a job or posting job vacancies', 'Approved', 'Approved', 'active'),
(40, 17, 'World Wide Scholarship', 'USA', 'masters', 'any', 'asian,black,latino', 'needy', 'arts', '2023-10-09', 27, '$5000', '块匠晡捩汩瑡瑥猠楮瑥牮慴楯湡氠敤畣慴楯渠潰灯牴畮楴楥猠景爠獴畤敮瑳⁴桡琠睡湴⁴漠晵牴桥爠瑨敩爠慣慤敭楣Ⱐ獰潲瑳⁯爠慲瑳⁣慲敥牳⁡扲潡搮ഊ块匠楳⁧汯扡氠捯湳畬瑩湧⁡来湣礠瑨慴⁣潮湥捴猠獴畤敮瑳⁷楴栠楮瑥牮慴楯湡氠捯汬敧敳⁡湤⁵湩癥牳楴楥猠瑯⁦畲瑨敲⁴桥楲⁳灯牴猬⁡捡摥浩挠潲⁡牴⁣慲敥牳⸍੔桥⁡来湣礠潦晥牳⁡獳敳獭敮琠景爠獵楴慢汥⁰污捥浥湴⁯灰潲瑵湩瑩敳Ⱐ捯湮散瑳⁷楴栠楮瑥牮慴楯湡氠楮獴楴畴楯湳Ⱐ潮⁢敨慬映潦⁴桥⁣汩敮琬⁴漠湥杯瑩慴攠景爠扥獴⁳捨潬慲獨楰⁯灰潲瑵湩瑩敳⁡癡楬慢汥⁴漠瑨攠捬楥湴⸍੔桥⁡来湣礠潦晥牳⁡⁳瑥瀠批⁳瑥瀠扲敡欠摯睮⁯映捯汬敧攠慮搠畮楶敲獩瑹⁥湲潬浥湴⁰牯捥摵牥猬⁳異灯牴⁡湤⁴畴潲楮朠景爠畮楶敲獩瑩敳⁴桡琠牥煵楲攠獰散楦楣⁡獳敳獭敮琠獣潲敳⸍੉映祯甠睯畬搠汩步⁴漠晩湤⁯畴⁭潲攠慢潵琠瑨攠獥牶楣敳⁴桥⁡来湣礠潦晥牳Ⱐ灬敡獥⁡灰汹⁡湤⁢攠楮癩瑥搠景爠愠晲敥⁰牥獥湴慴楯渠潮⁴桥⁯灰潲瑵湩瑩敳⁴桡琠捯畬搠扥⁡癡楬慢汥⁴漠祯甡ഊ䄠獣桯污牳桩瀠楳⁡⁧牡湴⁩渠晩湡湣楡氠慩搠晲潭⁡⁕湩癥牳楴礮⁉琠楳⁧楶敮⁴漠愠獴畤敮琠慳⁭敲楴⁦潲⁡⁧楦瑩湧⁯爠瑡汥湴⁩渠慣慤敭楣猠潲⁥硴牡捵牲楣畬慲⁡捴楶楴楥献⁉琠楳⁧楶敮⁢礠啮楶敲獩瑩敳⁴漠浥物琠瑨攠獴畤敮琠景爠獴畤礠慴⁴桥楲⁵湩癥牳楴礮', '周楳⁩猠愠獣桯污牳桩瀠扡獥搠潮⁴桥⁣潭扩湡瑩潮⁯映獰潲瑳⁡湤⁡捡摥浩捳⁯爠捯浢楮慴楯渠潦⁨潢扩敳Ⱐ獰潲瑳⁡湤⁡捡摥浩捳', '䵯獴⁳捨潬慲獨楰猠潦晥爠灡牴楡氠晵湤楮朠景爠啮楶敲獩瑹⁷桩捨⁭敡湳⁷桡瑥癥爠瑨攠啮楶敲獩瑹⁤潥猠湯琠捯癥爠楳⁦畮摥搠批⁴桥⁳瑵摥湴⁡湤⁴桥楲⁦慭楬礮⁉映愠獴畤敮琠楳⁯晦敲敤⁡⁆畬氠卣桯污牳桩瀬⁷桩捨⁩猠癥特⁲慲攬⁡汬⁴桥楲⁥硰敮獥猠慲攠捯癥牥搠批⁴桥⁕湩癥牳楴礮', '偨潴潣潰礠潦⁹潵爠桩杨⁳捨潯氠牥獵汴猍ਲ⁤物癥牳⁬楣敮獥⁳楺敤⁰桯瑯鉳ഊ䱥瑴敲猠潦⁲散潭浥湤慴楯渠晲潭⁳捨潯氠捯畮獥汬潲⁡湤⁩湳瑲畣瑯爠潲⁴敡捨敲ഊ噩摥漠扩潧牡灨礠⡳桯牴⁩湴牯摵捴楯渠瑯⁹潵⁡湤⁹潵爠杯慬猬⁤牥慭猠慮搠汩步猩ഊ佦晩捩慬⁓䅔⁲敳畬瑳 啓䄠潲⁃慮慤愠扯畮搠獴畤敮瑳⁯湬礩ഊ佦晩捩慬⁁䍔⁲敳畬瑳 啓䄠潲⁃慮慤愠扯畮搠獴畤敮瑳⁯湬礩', 'https://www.facebook.com/WWScholarships/', 'https://www.facebook.com/WWScholarships/', 'Approved', 'Approved', 'active'),
(41, 20, 'Taila Scholarships', 'USA', 'highschool', 'any', 'americanindian,asian,hawaiian', 'needy', 'administration', '2022-03-25', 90, '$5000', 'WWS facilitates international education opportunities for students that want to further their academic, sports or arts careers abroad.\r\n\r\nWWS is global consulting agency that connects students with international colleges and universities to further their sports, academic or art careers.\r\n\r\n​\r\n\r\nThe agency offers assessment for suitable placement opportunities, connects with international institutions, on behalf of the client, to negotiate for best scholarship opportunities available to the client.\r\n\r\nThe agency offers a step by step break down of college and university enrolment procedures, support and tutoring for universities that require specific assessment scores.\r\n\r\n​\r\n\r\nIf you would like to find out more about the services the agency offers, please apply and be invited for a free presentation on the opportunities that could be available to you!\r\n\r\n \r\n\r\nA scholarship is a grant in financial aid from a University. It is given to a student as merit for a gifting or talent in arts or extracurricular activities. It is given by Universities to merit the student for study at their university.', '偨潴潣潰礠潦⁹潵爠桩杨⁳捨潯氠牥獵汴猍਍ਲ⁤物癥牳⁬楣敮獥⁳楺敤⁰桯瑯鉳ഊഊ䱥瑴敲猠潦⁲散潭浥湤慴楯渠晲潭⁳捨潯氠捯畮獥汬潲⁡湤⁩湳瑲畣瑯爠潲⁴敡捨敲ഊഊ噩摥漠扩潧牡灨礠⡳桯牴⁩湴牯摵捴楯渠瑯⁹潵⁡湤⁹潵爠杯慬猬⁤牥慭猠慮搠汩步猩ഊഊ䍯灹⁯映慲琠灯牴景汩漠⡧牡灨楣⁳瑵摥湴猩ഊഊ䅵摩漠剥捯牤楮杳 浵獩挠慰灬楣慮瑳⤍਍੐敲景牭慮捥⁶楤敯 摡湣攠潲⁰敲景牭楮朠慲瑳⁡灰汩捡湴猩ഊഊ佦晩捩慬⁓䅔⁲敳畬瑳 啓䄠潲⁃慮慤愠扯畮搠獴畤敮瑳⁯湬礩ഊഊ佦晩捩慬⁁䍔⁲敳畬瑳 啓䄠潲⁃慮慤愠扯畮搠獴畤敮瑳⁯湬礩', 'If you would like to find out more about the services the agency offers, please apply and be invited for a free presentation on the opportunities that could be available to you!\r\n\r\n \r\n\r\nA scholarship is a grant in financial aid from a University. It is given to a student as merit for a gifting or talent in arts or extracurricular activities. It is given by Universities to merit the student for study at their university.\r\n\r\n​​\r\n\r\nWe connect students with Combination Scholarships\r\n\r\nThis is a scholarship based on the combination of arts, academics and hobbies', '偨潴潣潰礠潦⁹潵爠桩杨⁳捨潯氠牥獵汴猍਍ਲ⁤物癥牳⁬楣敮獥⁳楺敤⁰桯瑯鉳ഊഊ䱥瑴敲猠潦⁲散潭浥湤慴楯渠晲潭⁳捨潯氠捯畮獥汬潲⁡湤⁩湳瑲畣瑯爠潲⁴敡捨敲ഊഊ噩摥漠扩潧牡灨礠⡳桯牴⁩湴牯摵捴楯渠瑯⁹潵⁡湤⁹潵爠杯慬猬⁤牥慭猠慮搠汩步猩ഊഊ䍯灹⁯映慲琠灯牴景汩漠⡧牡灨楣⁳瑵摥湴猩ഊഊ䅵摩漠剥捯牤楮杳 浵獩挠慰灬楣慮瑳⤍਍੐敲景牭慮捥⁶楤敯 摡湣攠潲⁰敲景牭楮朠慲瑳⁡灰汩捡湴猩ഊഊ佦晩捩慬⁓䅔⁲敳畬瑳 啓䄠潲⁃慮慤愠扯畮搠獴畤敮瑳⁯湬礩ഊഊ佦晩捩慬⁁䍔⁲敳畬瑳 啓䄠潲⁃慮慤愠扯畮搠獴畤敮瑳⁯湬礩', 'https://www.worldwidescholarships.com/arts-scholarships', 'https://www.worldwidescholarships.com/arts-scholarships', 'currently blocked', 'Rejected', 'inactive'),
(42, 20, 'Taila Scholarships', 'USA', 'highschool', 'female', 'americanindian,asian,latino', 'needy', 'education', '2023-10-09', 30, '$5000', 'The agency offers assessment for suitable placement opportunities, connects with international institutions, on behalf of the client, to negotiate for best scholarship opportunities available to the client.\r\n\r\nThe agency offers a step by step break down of college and university enrolment procedures, support and tutoring for universities that require specific assessment scores.\r\n\r\n​\r\n\r\nIf you would like to find out more about the services the agency offers, please apply and be invited for a free presentation on the opportunities that could be available to you!\r\n\r\n \r\n\r\nA scholarship is a grant in financial aid from a University. It is given to a student as merit for a gifting or talent in arts or extracurricular activities. It is given by Universities to merit the student for study at their university.\r\n\r\n​​\r\n\r\nWe connect students with Combination Scholarships\r\n\r\nThis is a scholarship based on the combination of arts, academics and hobbies', 'The agency offers assessment for suitable placement opportunities, connects with international institutions, on behalf of the client, to negotiate for best scholarship opportunities available to the client.\r\n\r\nThe agency offers a step by step break down of college and university enrolment procedures, support and tutoring for universities that require specific assessment scores.\r\n\r\n​\r\n\r\nIf you would like to find out more about the services the agency offers, please apply and be invited for a free presentation on the opportunities that could be available to you!\r\n\r\n \r\n\r\nA scholarship is a grant in financial aid from a University. It is given to a student as merit for a gifting or talent in arts or extracurricular activities. It is given by Universities to merit the student for study at their university.\r\n\r\n​​\r\n\r\nWe connect students with Combination Scholarships\r\n\r\nThis is a scholarship based on the combination of arts, academics and hobbies', 'The agency offers assessment for suitable placement opportunities, connects with international institutions, on behalf of the client, to negotiate for best scholarship opportunities available to the client.\r\n\r\nThe agency offers a step by step break down of college and university enrolment procedures, support and tutoring for universities that require specific assessment scores.\r\n\r\n​\r\n\r\nIf you would like to find out more about the services the agency offers, please apply and be invited for a free presentation on the opportunities that could be available to you!\r\n\r\n \r\n\r\nA scholarship is a grant in financial aid from a University. It is given to a student as merit for a gifting or talent in arts or extracurricular activities. It is given by Universities to merit the student for study at their university.\r\n\r\n​​\r\n\r\nWe connect students with Combination Scholarships\r\n\r\nThis is a scholarship based on the combination of arts, academics and hobbies', 'Photocopy of your high school results\r\n\r\n2 drivers license sized photo’s\r\n\r\nLetters of recommendation from school counsellor and instructor or teacher\r\n\r\nVideo biography (short introduction to you and your goals, dreams and likes)\r\n\r\nCopy of art portfolio (graphic students)\r\n\r\nAudio Recordings (music applicants)\r\n\r\nPerformance video (dance or performing arts applicants)\r\n\r\nOfficial SAT results (USA or Canada bound students only)\r\n\r\nOfficial ACT results (USA or Canada bound students only)', 'https://www.worldwidescholarships.com/arts-scholarships', 'https://www.worldwidescholarships.com/arts-scholarships', 'Approved', NULL, 'active'),
(43, 20, 'M Power finance', 'Kenya', 'diploma', 'female', 'americanindian,asian,latino', 'needy', 'environmentscience', '2023-03-05', 90, '$5000', 'Scholarships for International Students\r\n\r\nMPOWER offers various scholarships for international students seeking to gain an education in the U.S. or Canada. Many scholarships come with restrictions and entry fees that limit accessibility, but MPOWER created scholarships that are widely accessible to international students. Apply today and begin your future of studying abroad!', 'You’re eligible to apply to a MPOWER scholarship if you’re:\r\n\r\nAccepted at, or enrolled in, a full-time degree program at a U.S. or Canadian school that MPOWER supports.\r\n\r\nAn international student allowed to legally study in the U.S. or Canada.\r\n\r\nExcited to share your dream with the MPOWER team and the world.', 'MPOWER is proud to offer scholarships for international students to help fund your education and dreams. Our international student scholarships are designed to help support future leaders and help as many students as we can. We offer a global citizen scholarship specifically for international and DACA students. We also offer a Women in STEM scholarship which is for women enrolled in a STEM degree program. In addition to that, we offer monthly scholarship opportunities for international students.\r\nLet us help you fund your studies.', 'Be admitted to, or enrolled in, a full-time MBA degree program at a U.S. or Canadian school that MPOWER supports, and\r\nBe an international student permitted to legally study in the U.S. or Canada, as applicable:\r\nFor study in the U.S., this means that the applicant meets one of these criteria:\r\nHas a valid visa that permits study in the U.S., or\r\nIs protected under the Deferred Action for Childhood Arrivals (DACA)\r\nFor study in Canada, this means the applicant must meet the following criteria:\r\nHas a valid Canadian study permit', 'https://www.mpowerfinancing.com/scholarships/mba-scholarship/', 'https://www.mpowerfinancing.com/scholarships/mba-scholarship/', 'Approved', NULL, 'active'),
(44, 21, 'MBA Scholarship', 'Morrocco', 'bachelors', 'non-binary', 'asian,black,latino', 'needy', 'education', '2023-03-05', 90, '$5000', 'We’re thrilled to announce our new MBA scholarship! MPOWER will be awarding up to $10,000 USD to support international students. You must be pursuing an MBA at one of our supported schools to apply, but you don’t need to be an MPOWER borrower. ', 'Be admitted to, or enrolled in, a full-time MBA degree program at a U.S. or Canadian school that MPOWER supports, and\r\nBe an international student permitted to legally study in the U.S. or Canada, as applicable:\r\nFor study in the U.S., this means that the applicant meets one of these criteria:\r\nHas a valid visa that permits study in the U.S., or\r\nIs protected under the Deferred Action for Childhood Arrivals (DACA)\r\nFor study in Canada, this means the applicant must meet the following criteria:\r\nHas a valid Canadian study permit', 'ollowing MPOWER’s selection of winners, MPOWER will verify their eligibility. Following verification, all winners will be sent a Release Form. Following MPOWER’s receipt of a winner’s executed Release Form, MPOWER will disburse the funds directly to the winner’s college/university, subject to the requirements of any applicable U.S. or Canadian laws. In the event that a winner cannot be verified, or fails or refuses to execute the Release Form, such person becomes ineligible for the scholarship, and MPOWER will select a replacement winner.', 'U.S. citizens wishing to study in the U.S. and Canadian citizens wishing to study in Canada are not eligible for this scholarship.\r\nAll eligible students must complete the application form and submit the essay, whether or not you are an MPOWER borrower.', 'MPOWER Financing, Public Benefit Corporation, 1101 Connecticut Avenue NW, Suite 900, 20036 Washington, District of Columbia\r\n\r\nhttps://www.mpowerfinancing.com/scholarships/mba-scholarship/', 'https://www.twitter.com/mpowerfinancing', 'Approved', NULL, 'active'),
(45, 21, 'Monthly Scholarship Series', 'USA', 'phd', 'any', 'americanindian,black,latino', 'needy', 'socialscience', '2023-03-05', 90, '$5000', 'We’re thrilled to announce our Monthly Scholarship Series! MPOWER is awarding US $48,000 this year to help 36 international students fund their education dreams.\r\n\r\nHow this works:\r\n\r\nOn the first day of each month, check out this page to find out the scholarship theme for the month. \r\nYou can subscribe to our student newsletter to be alerted when the new scholarship is announced.\r\nBe sure to apply quickly! Applications will be open until the last Friday of the month.\r\nRead below to find out more about this month’s scholarship!', 'Be admitted to, or enrolled in, a full-time degree program at a U.S. or Canadian school that MPOWER supports, and\r\nBe an international student permitted to legally study in the U.S. or Canada, as applicable:\r\nFor study in the U.S., this means that the applicant meets one of these criteria:\r\nHas a valid visa that permits study in the U.S., or\r\nIs protected under the Deferred Action for Childhood Arrivals (DACA)\r\nFor study in Canada, this means the applicant must meet the following criteria:\r\nHas a valid Canadian study permit', 'Be a student related to the theme of the month (degree program or nationality).\r\nBe admitted to, or enrolled in, a full-time degree program at a U.S. or Canadian school that MPOWER supports, and\r\nBe an international student permitted to legally study in the U.S. or Canada, as applicable.\r\nFor study in the U.S., this means that the applicant is either a U.S. permanent resident (Green Card holder), protected under the Deferred Action for Childhood Arrivals (DACA) program, or has a valid visa that permits study in the U.S.\r\nFor study in Canada, this means the applicant is either a Canadian permanent resident or has a valid Canadian study permit.\r\nU.S. citizens wishing to study in the U.S. and Canadian citizens wishing to study in Canada are not eligible for this scholarship.\r\nYou do not need to be an MPOWER borrower or applicant to apply for any MPOWER scholarship as long as you meet the eligibility criteria set forth above.', 'The agency offers assessment for suitable placement opportunities, connects with international institutions, on behalf of the client, to negotiate for best scholarship opportunities available to the client.\r\n\r\nThe agency offers a step by step break down of college and university enrolment procedures, support and tutoring for universities that require specific assessment scores.\r\n\r\n​\r\n\r\nIf you would like to find out more about the services the agency offers, please apply and be invited for a free presentation on the opportunities that could be available to you!\r\n\r\n \r\n\r\nA scholarship is a grant in financial aid from a University. It is given to a student as merit for a gifting or talent in arts or extracurricular activities. It is given by Universities to merit the student for study at their university.\r\n\r\n​​\r\n\r\nWe connect students with Combination Scholarships\r\n\r\nThis is a scholarship based on the combination of arts, academics and hobbies', 'https://www.mpowerfinancing.com/scholarships/monthly-scholarships/', 'https://www.linkedin.com/company/mpower-financing\r\nhttps://www.youtube.com/channel/UCOb54nB9C8Ro8_ZbmyPJlng', 'Approved', 'Rejected', 'active'),
(46, 20, 'Scholarship Of Canada', 'Canada', 'phd', 'male', 'americanindian,asian,black', 'select', 'socialscience', '2023-10-22', 50, '100%', 'Have you ever wondered what a UK education can do for you? Alongside a world-class qualification, studying in the UK will give you the opportunity to experience a new culture, network with students and professionals from all over the world, and gain skills to help further your career development. \r\n\r\nThere are various financial support options available to help fund your studies in the UK. This includes scholarships, grants, bursaries, fellowships, financial awards and loans.', 'Have you ever wondered what a UK education can do for you? Alongside a world-class qualification, studying in the UK will give you the opportunity to experience a new culture, network with students and professionals from all over the world, and gain skills to help further your career development. \r\n\r\nThere are various financial support options available to help fund your studies in the UK. This includes scholarships, grants, bursaries, fellowships, financial awards and loans.', 'Have you ever wondered what a UK education can do for you? Alongside a world-class qualification, studying in the UK will give you the opportunity to experience a new culture, network with students and professionals from all over the world, and gain skills to help further your career development. \r\n\r\nThere are various financial support options available to help fund your studies in the UK. This includes scholarships, grants, bursaries, fellowships, financial awards and loans.', 'Have you ever wondered what a UK education can do for you? Alongside a world-class qualification, studying in the UK will give you the opportunity to experience a new culture, network with students and professionals from all over the world, and gain skills to help further your career development. \r\n\r\nThere are various financial support options available to help fund your studies in the UK. This includes scholarships, grants, bursaries, fellowships, financial awards and loans.', 'https://study-uk.britishcouncil.org/scholarships', 'https://study-uk.britishcouncil.org/scholarships', 'Approved', NULL, 'active'),
(47, 20, 'INTI Scholarship', 'Uganda', 'diploma', 'female', 'asian,latino', 'needy', 'socialscience', '2023-05-23', 10, '100%', 'INTI International University & Colleges is proud to offer the international education scholarship for International Students. Our educational scholarships for new international students is a testament to our commitment to providing individuals with the opportunity to pursue a world-class education.', 'INTI International University & Colleges is proud to offer the international education scholarship for International Students. Our educational scholarships for new international students is a testament to our commitment to providing individuals with the opportunity to pursue a world-class education.', 'INTI International University & Colleges is proud to offer the international education scholarship for International Students. Our educational scholarships for new international students is a testament to our commitment to providing individuals with the opportunity to pursue a world-class education.', 'INTI International University & Colleges is proud to offer the international education scholarship for International Students. Our educational scholarships for new international students is a testament to our commitment to providing individuals with the opportunity to pursue a world-class education.', 'INTI International University & Colleges is proud to offer the international education scholarship for International Students. Our educational scholarships for new international students is a testament to our commitment to providing individuals with the opportunity to pursue a world-class education.', 'INTI International University & Colleges is proud to offer the international education scholarship for International Students. Our educational scholarships for new international students is a testament to our commitment to providing individuals with the opportunity to pursue a world-class education.', 'Approved', NULL, 'active'),
(48, 20, 'World Bank Scholarships Program', 'Seychelles', 'phd', 'any', 'black,white', 'cultural', 'socialscience', '2022-12-23', 10, '100%', 'The World Bank’s Development Economics Vice Presidency (DEC) provides scholarships to students and young researchers, contributing to the World Bank’s mission of forging new dynamic approaches to capacity development and knowledge sharing in the developing world.\r\n\r\nIt is an important component of the World Bank’s efforts to promote economic development and shared prosperity through investing in education, capacity building, and developing human resources in the developing world. \r\n\r\nSince 1982, the DEC’s scholarship programs have helped to form a pool of over 6,000 well-trained and experienced development professionals and scholars, transforming their countries and positively impacting future generations.', 'The World Bank’s Development Economics Vice Presidency (DEC) provides scholarships to students and young researchers, contributing to the World Bank’s mission of forging new dynamic approaches to capacity development and knowledge sharing in the developing world.\r\n\r\nIt is an important component of the World Bank’s efforts to promote economic development and shared prosperity through investing in education, capacity building, and developing human resources in the developing world. \r\n\r\nSince 1982, the DEC’s scholarship programs have helped to form a pool of over 6,000 well-trained and experienced development professionals and scholars, transforming their countries and positively impacting future generations.', 'The World Bank’s Development Economics Vice Presidency (DEC) provides scholarships to students and young researchers, contributing to the World Bank’s mission of forging new dynamic approaches to capacity development and knowledge sharing in the developing world.\r\n\r\nIt is an important component of the World Bank’s efforts to promote economic development and shared prosperity through investing in education, capacity building, and developing human resources in the developing world. \r\n\r\nSince 1982, the DEC’s scholarship programs have helped to form a pool of over 6,000 well-trained and experienced development professionals and scholars, transforming their countries and positively impacting future generations.', 'The World Bank’s Development Economics Vice Presidency (DEC) provides scholarships to students and young researchers, contributing to the World Bank’s mission of forging new dynamic approaches to capacity development and knowledge sharing in the developing world.\r\n\r\nIt is an important component of the World Bank’s efforts to promote economic development and shared prosperity through investing in education, capacity building, and developing human resources in the developing world. \r\n\r\nSince 1982, the DEC’s scholarship programs have helped to form a pool of over 6,000 well-trained and experienced development professionals and scholars, transforming their countries and positively impacting future generations.', 'The World Bank’s Development Economics Vice Presidency (DEC) provides scholarships to students and young researchers, contributing to the World Bank’s mission of forging new dynamic approaches to capacity development and knowledge sharing in the developing world.\r\n\r\nIt is an important component of the World Bank’s efforts to promote economic development and shared prosperity through investing in education, capacity building, and developing human resources in the developing world. \r\n\r\nSince 1982, the DEC’s scholarship programs have helped to form a pool of over 6,000 well-trained and experienced development professionals and scholars, transforming their countries and positively impacting future generations.', 'The World Bank’s Development Economics Vice Presidency (DEC) provides scholarships to students and young researchers, contributing to the World Bank’s mission of forging new dynamic approaches to capacity development and knowledge sharing in the developing world.\r\n\r\nIt is an important component of the World Bank’s efforts to promote economic development and shared prosperity through investing in education, capacity building, and developing human resources in the developing world. \r\n\r\nSince 1982, the DEC’s scholarship programs have helped to form a pool of over 6,000 well-trained and experienced development professionals and scholars, transforming their countries and positively impacting future generations.', 'Approved', NULL, 'active'),
(49, 20, 'INTI Scholarship2', 'Seychelles', 'highschool', 'male', 'americanindian,asian,black', 'creative', 'socialscience', '2023-05-23', 10, '100%', 'iowjgdfgjlkwd', '[powidowoqkdpwq[pd', 'pwdopidowjqdlwq', 'wsokjkdhuhed', 'doewpqodiwjqiduiuq', 'wpqopdkwqikdowql', 'Approved', NULL, 'active'),
(50, 20, 'World Bank Scholarships Program2', 'Uganda', 'diploma', 'male', 'americanindian,latino,white', 'merit', 'socialscience', '2023-05-23', 10, '100%', 'It is an important component of the World Bank’s efforts to promote economic development and shared prosperity through investing in education, capacity building, and developing human resources in the developing world. \r\n\r\nSince 1982, the DEC’s scholarship programs have helped to form a pool of over 6,000 well-trained and experienced development professionals and scholars, transforming their countries and positively impacting future generations.', 'It is an important component of the World Bank’s efforts to promote economic development and shared prosperity through investing in education, capacity building, and developing human resources in the developing world. \r\n\r\nSince 1982, the DEC’s scholarship programs have helped to form a pool of over 6,000 well-trained and experienced development professionals and scholars, transforming their countries and positively impacting future generations.', 'It is an important component of the World Bank’s efforts to promote economic development and shared prosperity through investing in education, capacity building, and developing human resources in the developing world. \r\n\r\nSince 1982, the DEC’s scholarship programs have helped to form a pool of over 6,000 well-trained and experienced development professionals and scholars, transforming their countries and positively impacting future generations.', 'It is an important component of the World Bank’s efforts to promote economic development and shared prosperity through investing in education, capacity building, and developing human resources in the developing world. \r\n\r\nSince 1982, the DEC’s scholarship programs have helped to form a pool of over 6,000 well-trained and experienced development professionals and scholars, transforming their countries and positively impacting future generations.', 'It is an important component of the World Bank’s efforts to promote economic development and shared prosperity through investing in education, capacity building, and developing human resources in the developing world. \r\n\r\nSince 1982, the DEC’s scholarship programs have helped to form a pool of over 6,000 well-trained and experienced development professionals and scholars, transforming their countries and positively impacting future generations.', 'It is an important component of the World Bank’s efforts to promote economic development and shared prosperity through investing in education, capacity building, and developing human resources in the developing world.', 'Approved', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `signatory`
--

CREATE TABLE `signatory` (
  `sigID` int NOT NULL,
  `upMail` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `firstName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `middleName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `lastName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `organization` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `phonenumber` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signatory`
--

INSERT INTO `signatory` (`sigID`, `upMail`, `password`, `firstName`, `middleName`, `lastName`, `organization`, `position`, `phonenumber`, `status`) VALUES
(9, 'tyler@oxford.edu', '$2y$10$K2GPvZ90dLoz3qmMl8ZDleJqH6cxr1rfJZgOHFg0PNpvfRypmCXVy', NULL, NULL, NULL, NULL, NULL, NULL, 'active'),
(10, 'claire@havard.edu', '$2y$10$qd5ge1K9S/0NO1etuuD3TOnicxfDNgOjgEjXqEH7cXYuD.YuToxB6', 'Karanja', 'Wanjiru', 'Mitchelle', '', 'Secretary', '0717426148', 'active'),
(11, 'clairemonies@havard.edu', '$2y$10$X902FYQ9O5WcCUH.NrpD9.eemgJR1r/906YElI3HMBMtCq6sLLZQ6', '', '', '', '', '', '', 'active'),
(12, 'larry@yale.edu', '$2y$10$UGfxxAYlXTc3EvFwKkHBTej7NtsHrhXZrtuoZcdJSdFTatXc8yCqm', 'Lorna', 'Wanjiru', 'Muchangi', '', 'CEO', '0717426148', 'active'),
(13, 'tirren@gmail.com', '$2y$10$iKpIi3YphTMT48bSfU5KT.UF22Cqahm2hqdaqPLxjFcywSevMs2tS', 'Lorna', 'Wanjiru', 'Muchangi', 'Yale', 'Secretary', '0717426148', 'active'),
(14, 'taloi@', '$2y$10$CkuEFJzGyXzV7HNzt6WCDO8UxZcNrqw4Zl1/Ch8plPMbx3gGrcIgC', '', '', '', '', '', '', 'active'),
(15, 'claire@TUK.edu', '$2y$10$Cvjtrxt7GrQqfMFIjS4jy./hgri4PdwVAIkdMS.E.HsHfBGH0NWCi', 'Lorna', 'Wanjiru', 'Muchangi', 'Ilab Africa', 'CEO', '0717426148', 'active'),
(16, 'timo@utc.edu', '$2y$10$GUT3wqrTtccD6uMoNqwDAegjhigxQ1DU8dBOGiNd7caxdcngVnrn2', 'Timothy', 'Agevi', 'Matuta', 'Ilab Africa', 'Directory', '0717426148', 'active'),
(17, 'michael@nyc.edu', '$2y$10$fiLW/T7L8OMWXTokO568AuGYOOrUrI85RQWsTbZGOAXKilqpg7g/.', 'Michael', 'Kamau', 'Onyango', 'NYC', 'Admission Officer', '0717426148', 'active'),
(18, 'claire@yale.edu', '$2y$10$Ly9vKLzSOz00sdbsKFtlqOJshd4/x0tWiVyxWHgX70nCzk8WayVsS', 'Lorna', 'Wanjiru', 'Muchangi', 'Yale', 'CEO', '0717426148', 'active'),
(19, 'mike@yale.edu', '$2y$10$Otp7DGiS3Vrlyh8hridE9e4F26RLOi2DoPUGM/Zxv./Mmkw2s9tta', 'Lorna', 'Wanjiru', 'Muchangi', 'Yale', 'Directory', '0717426148', 'active'),
(20, 'chrisbrian@gmail.com', '$2y$10$k/FLNXEuKYGIiknQcN1ma.bOmek9qNEwaBMAy8QWDLYrT1IEmwnS6', 'Chris', 'Brian', 'Mbui', 'Yale', 'CEO', '0717426148', 'active'),
(21, 'mitchellekamau@gmail.com', '$2y$10$j.QQRLKsGc/Ew3VAQRjWLOHm5b2tQ16f1XzHRVKT.Cdb869GrrzRW', 'Mitchelle', 'Kamau', 'Mwangi', 'NYC', 'Secretary', '0717426148', 'active'),
(22, 'keziahkimwaki@gmail.com', '$2y$10$q3szkChCemmz0gueYk0klOID6G7GFgm0dSDVLcGaVl3eostVjZYc2', 'Keziah', 'Mutuku', 'Kimwaki', 'NYC', 'Admission Officer', '0717426148', 'active'),
(23, 'joylora@gmail.com', '$2y$10$O3b0cfMzUM8WvQ3NdbHma.Q1KoA3Xxtx9T05A5UJ2Xz5GWYSYu/S6', 'Joylora', 'Wanjiru', 'Muchangi', 'NYC', 'Admission Officer', '0717426148', 'active'),
(24, 'sharon@gmail.com', '$2y$10$tLZ4AJR891Zs/SeKeHllBeNXZbg3LM1MhSWfXoWGji95V7XlmTNuq', 'Sharon', 'Wanjiru', 'Muchangi', 'NYC', 'Admission Officer', '0717426148', 'active'),
(25, 'ccoko585@gmail.com', '$2y$10$AlpPNGpkhcbmBHaW1dInIugAQwb40nrGWSJnmzRCgbDt5X8GuJMdK', 'Collins', 'kiprono', 'koech', 'dsc', 'lead', '0728000107', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int NOT NULL,
  `upMail` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `firstName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `middleName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `lastName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `currentlocation` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `specialization` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `level` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `upMail`, `password`, `firstName`, `middleName`, `lastName`, `currentlocation`, `gender`, `phonenumber`, `specialization`, `level`, `status`) VALUES
(43, 'bindrani.rb7@gmail.com', '$2y$10$kaD0yN3fRZu9es6to1nVp.OK.dFE9Wp0peeHiEOVntlGH7EjKCi/i', 'Rahul', 'Chandraprakash', 'Bindrani', 'India', 'Male', '', '', '', 'inactive'),
(44, 'dishantd999@gmail.com', '$2y$10$fvzm.tlEs2VAqCph0Sr3TuQnp.2PjPW2LUYtxBdHdkhz4C7/FRuWu', 'Dishant', '', 'doshi', '', '', '', '', '', 'inactive'),
(45, 'rahulbindrani123@gmail.com', '$2y$10$RTrzzwxxBQU3LP5M4HmlHuYqSFWUhJpOiQNiwG3NNGabBQyxQ2cqm', '', '', '', NULL, NULL, NULL, '', '', 'active'),
(47, 'internwithicon@internshala.com', '$2y$10$RTJSf0Mzp8s5rsqNXWhZyuwRoGkoE3/2j3Gw5BRIexlxCQITwKmdq', '', '', '', NULL, NULL, NULL, '', '', 'active'),
(48, 'lornamuchangi@gmail.com', '$2y$10$LldKuh7MuSZfNM.WBFXVNOv6rEJ69iGyeQmP4Ip6q.NkWaFZeLDOu', 'Lorna', 'Wanjiru', 'Muchangi', 'Kenya', 'Female', '0717426148', 'Computer Science', 'Masters', 'inactive'),
(49, 'timothyagevi@gmail.com', '$2y$10$ARN65Y/0VcoMqrzqmROZl.8.WxenyHzlBUOOQ26p/L4xACVb38aZS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'active'),
(50, 'lorshi@gmail.com', '$2y$10$XKlyEwkJYA5Ba4esoeUYSeSt7EA7V6bMEu2zIO7oMm1sTY2V3V1Qa', 'Lorna', 'Wanjiru', 'Muchangi', 'Kenya', 'Female', '0717426148', 'Computer Science', 'Masters', 'inactive'),
(51, 'collo@gmail.com', '$2y$10$25uQikjnlMAC/LyOzB37LOSTQsiB4V3h/v4hP1b.G9ArEgj6e/79e', 'Collo', 'Mwendwa', 'Kaloki', 'Kenya', 'male', '25467895676', 'Computer Science', 'Bsc', 'active'),
(52, 'reyray@gmail.com', '$2y$10$xnFhwDX/RjlN.SKaMIx5luCJgYvG29YMEuge9a.fB7kmqpf031x9G', 'Lorna', 'Wanjiru', 'Muchangi', 'Kenya', 'male', '0724567267', 'Computer Science', 'Masters', 'active'),
(53, 'mike@gmail.com', '$2y$10$VCxeKR0u0QNcUfiF4zKjXe83ejFVfpVUOWxe9PiK6j/1CGf56HhyW', 'Mike', 'Karanja', 'Njoroge', 'Kenya', 'Male', '0717426148', 'Computer Science', 'Masters', 'active'),
(54, 'claire', '$2y$10$y5wsaPH7hYHyJ7tvcc6wku2go/YXtUjSk3BFVH00MUxodbBx5ywoq', 'claire', 'mike', '', '', '', '', '', '', 'active'),
(55, 'claire@kale.com', '$2y$10$agWqQ9CwOOm7atUVPI6tGOJBXh9bcTMyeyAhR7nGSBfpF.RbY6.7S', 'talia', 'talia', '', '', '', '', '', '', 'active'),
(56, 'claire@gmail.com', '$2y$10$ODgm7V5VGk.mhpIa1oJ.T.HsVOvlNkgZnxmC5Uaev6tEaJKFHW7E6', 'lorna', '', '', '', '', '', '', '', 'active'),
(57, 'claire@yahoo.com', '$2y$10$hdwJKa7znVFZeEpYL5KsT.70hI.MExFJv28kbBGJqi8hIL1hdeFma', '', '', '', '', '', '', '', '', 'active'),
(58, 'john@gmail.com', '$2y$10$lGemGUNMUXorYYag2OpQreDQA4f4iizdWy4gF3kpPe0m.iJ0qHa1a', '90--0=0-', '', '', '', '', '', '', '', 'active'),
(59, 'tim@havard.edu', '$2y$10$0k.JlM8sD0a3tLk4rtNFTubQPZJsCyUTLmfzhrEFGbWbLIAaacRXi', '-=-=-=', '', '', '', '', '', '', '', 'active'),
(60, 'meek@havard.edu', '$2y$10$TPjCR4NTFcTDZvDRL7vkAuoS1lloi9ILlC3B9RLy6YF3b2zSYKVLC', '', '', '', '', '', '', '', '', 'active'),
(61, 'like@gmail.com', '$2y$10$QYHRPP77brx241uxnTfpK.suoyqJqkX81VIz6Mufp0l5wALuY2HIS', '=-=-=', '', '', '', '', '', '', '', 'active'),
(62, '', '$2y$10$vtyfAX3MQQksocUmioQaxODq0GHpR0aqu5bQ3QX3WcE3RpL0xFL9m', '', '', '', '', '', '', '', '', 'active'),
(63, 'mine@havard.edu', '$2y$10$64CG0giMeoFUtxCzca83SuewlvddLNhlg9sde/gCwcs0qT.v5rb/O', '', '', '', '', '', '', '', '', 'active'),
(64, 'kite@havard.edu', '$2y$10$Cf47CfipM8e8Q4r1EUtiE.4OZy/5tmHGwvd3zYvv1zLuN0xjKaSK.', 'Lorna', 'Wanjiru', 'Muchangi', 'Kenya', 'Female', '0717426148', '', '', 'active'),
(65, 'lime@havard.edu', '$2y$10$vDwUaVcLcy6uoQlcZikt3OPhqU3xI4fo01TpTZecZP4upp/rhj/SO', 'Lorna', 'Wanjiru', 'Muchangi', 'Kenya', '', '0717426148', '', '', 'active'),
(66, 'liam@havard.edu', '$2y$10$AU7VHSkf5vlzl9XotIWsKOwBv.xzocIp7pPFtPzqvvXrkc4NHbxZC', '-=-=-', '', '', '', '', '', '', '', 'active'),
(67, 'miiud@havard.edu', '$2y$10$3k7xi9w15UetVodapvHHx.SW1kCnGO87PIKgGN.czTfESNNPAaU0K', 'Lorna', 'Wanjiru-=-=', 'Muchangi', 'Kenya', '', '0717426148', '', '', 'active'),
(68, 'ted@gmail.com', '$2y$10$Yx417LexNsrpB0UazFtQI.a7nIj75Kgs9xRtiT4gPqbG0Z..QY2ei', 'ted', 'mueni', 'lincon', 'Kenya', 'Male', '0717426148', 'Computer Science', 'Masters', 'active'),
(69, 'tilly@gmail.com', '$2y$10$FaVwEwLipv6DTMyRjG0jFuuY0r1NzzhhbfEz0n8PFPiVv.vVI8tmO', 'Tilly', 'Billy', 'Milly', 'Kenya', 'Female', '0717426148', 'Computer Science', 'Masters', 'active'),
(70, 'tali@gmail.com', '$2y$10$xZtz3vdGLIXbm3jcBhSZb.iqnXzuZvTXbVo3xFSB57bEMcLAPED5u', 'Tali', 'Kamau', 'Muchangi', 'Kenya', 'male', '0717426148', 'Computer Science', 'Masters', 'active'),
(71, 'Talia@havard.com', '$2y$10$P1klybH.NKcclgNrhADtvu09j8WTEnwnYaVzPPiYbc5m80W04zI1q', 'Talia', 'Wanjiru', 'Mwangi', 'Kenya', 'Female', '0717426148', 'Computer Science', 'Masters', 'active'),
(72, 'lornamike@gmail.com', '$2y$10$lzt6j2v0wb0BLbQrP5qopO.OqqXi.LZef/uI0N.hgXPEH17/eTW2G', 'Lorna', 'Wanjiru', 'Muchangi', 'Kenya', 'Female', '0717426148', 'Computer Science', 'Masters', 'active'),
(73, 'powermbui@gmail.com', '$2y$10$dBhkkDuNqstvhGZcDfyvH.J4C4R9mSPFbU7/TbdMy3yWmVTXeKHDW', 'Power', 'Mbui', 'Mutuku', 'Kenya', 'male', '0717426148', 'Business', 'PHD', 'active'),
(74, 'collins@gmail.com', '$2y$10$Da9PEadcNA8f6pdl7ZrlmuSAs.elShtv7JmQDCoDgPk9ulcK4fFRO', 'Collins', 'Mutuku', 'Kimwaki', 'USA', 'Male', '0717426148', 'Business Admin', 'PHD', 'active'),
(75, 'fiona@gmail.com', '$2y$10$1llYwKOWXjB6dvZIwJG2G.d9Siof7cNFL2gxSuxcCx/flEvoDqnBm', 'Fiona', 'mwende', 'Kinyua', 'Kenya', 'Male', '0717426148', 'Computer Science', 'PHD', 'active'),
(76, 'lornawanjirumuchangi@gmail.com', '$2y$10$B1vVskLfqfD/9oO/HF2nNOZKxfnKLKabBMaqUiuuNWFDqX4uEpkoO', 'Lorna', 'Wanjiru', 'Muchangi', 'Kenya', 'Female', '0717426148', 'Computer Science', 'PHD', 'active'),
(77, 'tashakamau@gmail.com', '$2y$10$.yEXH9odW9S8y2LBar0Mj..BpTdA1pB3TTsyzSXO/do5jIKBv/CcK', 'Mitchelle', 'Kamau', 'Wanjiru', 'USA', 'Female', '01125679823', 'Business', 'Masters', 'active'),
(78, 'maurine@gmail.com', '$2y$10$smOwojX3RGSO43e3kVmyv.0YcKkxYMcnm95nttWzbHQcOfLtODwKe', 'Maurine', 'Kamau', 'Maina', 'Mauritius', 'Female', '01125679823', 'Business', 'Masters', 'active'),
(79, 'khalii@gmail.com', '$2y$10$oQbPoDBi8MJwtbPcZ2PI7.83GPmoVwztf/JfYNbVnvc4WMINcC5Oa', 'Lorna', 'Wanjiru', 'Muchangi', 'Kenya', 'Female', '0717426148', 'Business Admin', 'PHD', 'active'),
(80, 'mugambi@gmail.com', '$2y$10$ElqcMRsVnnU.ZBcQhH5CvOaJcxqQygIpE800jb5Qcu72uUj54CBa.', 'Lorna', 'Wanjiru', 'Muchangi', 'Kenya', 'Male', '0717426148', 'Business Admin', 'Masters', 'inactive'),
(81, 'kevin@gmail.com', '$2y$10$M.oUlIchBsj0cqQ.hZ.Ej.Zi37JG.tEOULw8rtyL3h1bglI2JGqvC', 'Lorna', 'Wanjiru', 'Muchangi', 'Kenya', 'Male', '0717426148', 'Business Admin', 'Masters', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `verify_signup`
--

CREATE TABLE `verify_signup` (
  `upMail` varchar(255) NOT NULL,
  `action` int NOT NULL DEFAULT '0',
  `num` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verify_signup`
--

INSERT INTO `verify_signup` (`upMail`, `action`, `num`) VALUES
('bindrani.rb7@gmail.com', 1, 637939),
('dishantd999@gmail.com', 1, 501750),
('rahulbindrani123@gmail.com', 1, 327349),
('rahul.bindrani.poorna@gmail.com', 1, 421896),
('arjunbd7@gmail.com', 1, 868906),
('internwithicon@internshala.com', 0, 133692),
('lornamuchangi@gmail.com', 1, 894565),
('timothyagevi@gmail.com', 1, 972751),
('lorshi@gmail.com', 0, 377501),
('collo@gmail.com', 1, 434175),
('tyler@oxford.edu', 0, 963350),
('claire@havard.edu', 1, 491509),
('clairemonies@havard.edu', 1, 695921),
('reyray@gmail.com', 1, 660951),
('larry@yale.edu', 1, 215717),
('mike@gmail.com', 1, 214849),
('claire', 0, 444215),
('claire@kale.com', 0, 108053),
('claire@gmail.com', 0, 110532),
('claire@yahoo.com', 0, 139298),
('john@gmail.com', 0, 931735),
('tim@havard.edu', 0, 344594),
('meek@havard.edu', 0, 820913),
('', 0, 556788),
('', 0, 203221),
('mine@havard.edu', 0, 426414),
('kite@havard.edu', 0, 647799),
('lime@havard.edu', 0, 215373),
('liam@havard.edu', 0, 136770),
('miiud@havard.edu', 0, 686088),
('ted@gmail.com', 0, 469623),
('tirren@gmail.com', 0, 205222),
('tilly@gmail.com', 1, 554732),
('tali@gmail.com', 1, 268989),
('taloi@', 0, 581997),
('claire@TUK.edu', 1, 618699),
('Talia@havard.com', 1, 404406),
('timo@utc.edu', 1, 405285),
('lornamike@gmail.com', 1, 435607),
('powermbui@gmail.com', 1, 539187),
('michael@nyc.edu', 1, 828063),
('collins@gmail.com', 1, 185004),
('fiona@gmail.com', 0, 514430),
('lornawanjirumuchangi@gmail.com', 0, 111555),
('claire@yale.edu', 0, 933851),
('mike@yale.edu', 0, 471566),
('chrisbrian@gmail.com', 1, 603981),
('mitchellekamau@gmail.com', 1, 190270),
('keziahkimwaki@gmail.com', 0, 954781),
('joylora@gmail.com', 0, 316322),
('sharon@gmail.com', 0, 984849),
('tashakamau@gmail.com', 1, 438101),
('maurine@gmail.com', 1, 563294),
('khalii@gmail.com', 1, 757395),
('mugambi@gmail.com', 1, 809702),
('kevin@gmail.com', 0, 292977),
('ccoko585@gmail.com', 0, 327081);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`applicationID`);

--
-- Indexes for table `scholarship`
--
ALTER TABLE `scholarship`
  ADD PRIMARY KEY (`scholarshipID`);

--
-- Indexes for table `signatory`
--
ALTER TABLE `signatory`
  ADD PRIMARY KEY (`sigID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `applicationID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `scholarship`
--
ALTER TABLE `scholarship`
  MODIFY `scholarshipID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `signatory`
--
ALTER TABLE `signatory`
  MODIFY `sigID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

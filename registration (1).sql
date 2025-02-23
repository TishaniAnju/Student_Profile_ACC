-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2020 at 10:31 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `registration`
--
CREATE DATABASE IF NOT EXISTS `registration` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `registration`;

-- --------------------------------------------------------

--
-- Table structure for table `alsubjects`
--

CREATE TABLE IF NOT EXISTS `alsubjects` (
  `subjectCode` int(11) NOT NULL,
  `subnameE` varchar(20) DEFAULT NULL,
  `subnameS` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`subjectCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alsubjects`
--

INSERT INTO `alsubjects` (`subjectCode`, `subnameE`, `subnameS`) VALUES
(1, 'Buddhism', 'à¶¶à·”à¶¯à·Šà¶° à¶°à¶»à·Šà¶¸à¶º'),
(2, 'Bud. Civ.', 'à¶¶à·žà¶¯à·Šà¶° à·à·’à·‚à·Šà¶§à·à¶ à·à¶»à¶º'),
(3, 'Sinhala', 'à·ƒà·’à¶‚à·„à¶½'),
(4, 'Sanskrit', 'à·ƒà¶‚à·ƒà·Šà¶šà·˜à¶­'),
(5, 'Pol. Sci.', 'à¶¯à·šà·à¶´à·à¶½à¶± à·€à·’à¶¯à·Šâ€à¶ºà·à·€'),
(6, 'Economic', 'à¶†à¶»à·Šà¶®à·’à¶š à·€à·’à¶¯à·Šâ€à¶ºà·à·€'),
(7, 'Geography', 'à¶·à·–à¶œà·à¶½ à·€à·’à¶¯à·Šâ€à¶ºà·à·€'),
(8, 'Logic', 'à¶­à¶»à·Šà¶š à·à·à·ƒà·Šà¶­à·Šâ€à¶»à¶º'),
(9, 'History', 'à¶‰à¶­à·’à·„à·à·ƒà¶º'),
(12, 'Pali', 'à¶´à·à¶½à·’');

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE IF NOT EXISTS `applicant` (
  `appNo` int(11) NOT NULL,
  `entryYear` year(4) NOT NULL,
  `titleE` varchar(10) DEFAULT NULL,
  `nameEnglish` varchar(100) DEFAULT NULL,
  `addressEnglish1` text,
  `addressEnglish2` text,
  `addressEnglish3` text,
  `appType` varchar(20) DEFAULT NULL,
  `qualified` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`appNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `applicantpali`
--

CREATE TABLE IF NOT EXISTS `applicantpali` (
  `appNo` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `result` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`appNo`,`code`),
  KEY `FK_applicantpali_paliqualification` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `applicantsubjects`
--

CREATE TABLE IF NOT EXISTS `applicantsubjects` (
  `appNo` int(11) NOT NULL,
  `subjectCode` int(11) NOT NULL,
  `result` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`appNo`,`subjectCode`),
  KEY `FK_applicantsubjects_alsubjects` (`subjectCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `compullinktbl`
--

CREATE TABLE IF NOT EXISTS `compullinktbl` (
  `codeEnglish` varchar(20) NOT NULL,
  `link_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compullinktbl`
--

INSERT INTO `compullinktbl` (`codeEnglish`, `link_code`) VALUES
('COEN  - I', 2),
('ARCH 21514', 3),
('ARCH 21524 (C)', 4),
('ARCH 22554', 3),
('ARCH 22564 (C)', 4),
('ARCH 22574 (C)', 5),
('ARCH 22584 (C)', 6),
('BUCN 1120 (C)', 7),
('SINH 32203 (C)', 8),
('COEN II', 2),
('COEN - II', 0),
('BUCL  11011', 9),
('BUCL  12021', 10),
('COEN  11011 ', 11),
('COEN  12011 ', 12),
('BUCL  11011', 13),
('BUCL  12021', 14),
('PCEN  11323', 15),
('PCEN  12333 ', 16),
('COEN  - I', 2),
('ARCH 21514', 3),
('ARCH 21524 (C)', 4),
('ARCH 22554', 3),
('ARCH 22564 (C)', 4),
('ARCH 22574 (C)', 5),
('ARCH 22584 (C)', 6),
('BUCN 1120 (C)', 7),
('SINH 32203 (C)', 8),
('COEN II', 2),
('COEN - II', 0),
('BUCL  11011', 9),
('BUCL  12021', 10),
('COEN  11011 ', 11),
('COEN  12011 ', 12),
('BUCL  11011', 13),
('BUCL  12021', 14),
('PCEN  11323', 15),
('PCEN  12333 ', 16);

-- --------------------------------------------------------

--
-- Table structure for table `effortreason`
--

CREATE TABLE IF NOT EXISTS `effortreason` (
  `R_Code` int(10) NOT NULL AUTO_INCREMENT,
  `effort_Reason_E` varchar(250) NOT NULL,
  `effort_Reason_S` varchar(250) NOT NULL,
  PRIMARY KEY (`R_Code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `effortreason`
--

INSERT INTO `effortreason` (`R_Code`, `effort_Reason_E`, `effort_Reason_S`) VALUES
(1, 'Offence', 'à¶…à¶šà·Šâ€à¶»à¶¸à·’à¶šà¶­à·');

-- --------------------------------------------------------

--
-- Table structure for table `exameffort`
--

CREATE TABLE IF NOT EXISTS `exameffort` (
  `effortID` int(11) NOT NULL AUTO_INCREMENT,
  `indexNo` varchar(20) DEFAULT NULL,
  `regNo` varchar(20) NOT NULL,
  `subjectID` int(11) DEFAULT NULL,
  `acYear` year(4) DEFAULT NULL,
  `medium` varchar(10) NOT NULL,
  `mark1` float NOT NULL,
  `mark2` float NOT NULL,
  `marks` int(11) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `effort` varchar(10) DEFAULT NULL,
  `gradePoint` float NOT NULL,
  `R_Code` int(10) DEFAULT NULL,
  PRIMARY KEY (`effortID`),
  KEY `FK_exameffort_studentenrolment` (`indexNo`,`subjectID`),
  KEY `FK_exameffort_studenreg` (`regNo`,`subjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `exameffort`
--

INSERT INTO `exameffort` (`effortID`, `indexNo`, `regNo`, `subjectID`, `acYear`, `medium`, `mark1`, `mark2`, `marks`, `grade`, `effort`, `gradePoint`, `R_Code`) VALUES
(5, 'BS/2018/01', '', 267, 2019, 'English', 0, 0, 0, '', '1', 0, NULL),
(6, 'LS/2018/01', '', 267, 2019, 'English', 0, 0, 0, '', '1', 0, NULL),
(7, 'BS/2018/01', '', 265, 2019, 'English', 15, 15, 15, 'E', '1', 0, NULL),
(8, 'BS/2018/03', '', 265, 2019, 'English', 48, 78, 63, 'B+', '1', 3.3, NULL),
(9, 'LS/2018/01', '', 265, 2019, 'English', 18, 78, 48, 'C+', '1', 2.3, NULL),
(10, 'LS/2018/18', '', 265, 2019, 'English', 78, 92, 85, 'A+', '1', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `examschedule`
--

CREATE TABLE IF NOT EXISTS `examschedule` (
  `subjectID` int(11) NOT NULL,
  `acYear` year(4) NOT NULL,
  `medium` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(20) NOT NULL,
  PRIMARY KEY (`subjectID`,`acYear`,`medium`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `finalresults`
--

CREATE TABLE IF NOT EXISTS `finalresults` (
  `frID` int(11) NOT NULL AUTO_INCREMENT,
  `indexNo` varchar(200) DEFAULT NULL,
  `finalGPA` float DEFAULT NULL,
  `class` varchar(200) DEFAULT NULL,
  `classSinhala` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`frID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `finalresults`
--

INSERT INTO `finalresults` (`frID`, `indexNo`, `finalGPA`, `class`, `classSinhala`) VALUES
(27, '20113004 ', 2.2, 'Pass', 'à·ƒà·à¶¸à·à¶»à·Šà¶®à¶ºà¶šà·Š'),
(28, '20113008 ', 3, 'Pass', 'à·ƒà·à¶¸à·à¶»à·Šà¶®à¶ºà¶šà·Š'),
(30, '20113011 ', 3.2, 'Second Lower Class', 'à¶¯à·™à·€à¶± à¶´à¶±à·Šà¶­à·’à¶ºà·š à¶´à·„à·… à·ƒà·à¶¸à·à¶»à·Šà¶®à¶ºà¶šà·Š'),
(31, '20113004 ', 2.2, 'Pass', 'à·ƒà·à¶¸à·à¶»à·Šà¶®à¶ºà¶šà·Š'),
(32, '20113004 ', 2.2, 'Pass', 'à·ƒà·à¶¸à·à¶»à·Šà¶®à¶ºà¶šà·Š'),
(33, '20113004 ', 2.2, 'Pass', 'à·ƒà·à¶¸à·à¶»à·Šà¶®à¶ºà¶šà·Š'),
(34, '20113004 ', 2.2, 'Pass', 'à·ƒà·à¶¸à·à¶»à·Šà¶®à¶ºà¶šà·Š'),
(35, '20113008 ', 3, 'Pass', 'à·ƒà·à¶¸à·à¶»à·Šà¶®à¶ºà¶šà·Š'),
(36, '20113008 ', 3, 'Pass', 'à·ƒà·à¶¸à·à¶»à·Šà¶®à¶ºà¶šà·Š'),
(37, '20113016 ', 2.6, 'Pass', 'à·ƒà·à¶¸à·à¶»à·Šà¶®à¶ºà¶šà·Š'),
(38, '20113008 ', 3, 'Pass', 'à·ƒà·à¶¸à·à¶»à·Šà¶®à¶ºà¶šà·Š'),
(39, '20113015 ', 3, 'Pass', 'à·ƒà·à¶¸à·à¶»à·Šà¶®à¶ºà¶šà·Š'),
(40, '20113004 ', 2.2, 'Pass', 'à·ƒà·à¶¸à·à¶»à·Šà¶®à¶ºà¶šà·Š');

-- --------------------------------------------------------

--
-- Table structure for table `foreignapplicant`
--

CREATE TABLE IF NOT EXISTS `foreignapplicant` (
  `appNo` int(11) NOT NULL,
  `ppNo` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `exam` varchar(60) DEFAULT NULL,
  `indexNo` varchar(20) DEFAULT NULL,
  `year` int(10) DEFAULT NULL,
  `month` varchar(10) DEFAULT NULL,
  `paliQf` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`appNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `foreignsubjects`
--

CREATE TABLE IF NOT EXISTS `foreignsubjects` (
  `appNo` int(11) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `result` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`appNo`,`subject`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gradepoints`
--

CREATE TABLE IF NOT EXISTS `gradepoints` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `lower` int(11) NOT NULL,
  `upper` int(11) NOT NULL,
  `grade` varchar(15) NOT NULL,
  `points` float NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `gradepoints`
--

INSERT INTO `gradepoints` (`Id`, `lower`, `upper`, `grade`, `points`) VALUES
(1, 85, 100, 'A+', 4),
(2, 70, 84, 'A', 4),
(3, 65, 69, 'A-', 3.7),
(4, 60, 64, 'B+', 3.3),
(5, 55, 59, 'B', 3),
(6, 50, 54, 'B-', 2.7),
(7, 45, 49, 'C+', 2.3),
(8, 40, 44, 'C', 2),
(9, 35, 39, 'C-', 1.7),
(10, 30, 34, 'D+', 1.3),
(11, 25, 29, 'D', 1),
(12, 0, 24, 'E', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE IF NOT EXISTS `lecturer` (
  `epfNo` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`epfNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`epfNo`, `name`) VALUES
('153', 'à¶šà·š.à¶¢à·“.à¶‘à·ƒà·Š. à¶œà¶¸à¶œà·š à¶¸à·„à¶­à·'),
('154', 'à¶†à¶»à·Š.à¶šà·š.à¶’.à¶‘à¶±à·Š. à¶»à¶­à·Šà¶±à·ƒà·’'),
('155', 'à¶‘à¶¸à·Š.à¶‘à¶ à·Š.à¶´à·“.à¶šà·š. à¶œà·”à¶«à·ƒà·š'),
('168', 'à¶šà¶®à·’. à¶´à·–à¶¢à·Šâ€à¶º à¶¸à·œà¶»à¶œà·œà¶½à·'),
('169', 'à¶šà¶®à·’. à¶´à·–à¶¢à·Šâ€à¶º à¶¸à·à·€à¶­à¶œà¶¸ à'),
('171', 'à¶šà¶®à·’. à·ƒà¶¸à¶±à·Šà¶­ à¶‰à¶½à¶‚à¶œà¶šà·à¶±à·'),
('199', 'à¶´à·–à¶¢à·Šâ€à¶º à¶‰à¶½à·”à¶šà·šà·€à·™à¶½ à¶°à¶¸'),
('200', 'à¶´à·–à¶¢à·Šâ€à¶º à¶…à¶½à·”à¶­à·Šà¶œà¶¸ à·€à·’à¶¸'),
('202', 'à¶´à·–à¶¢à·Šâ€à¶º à¶œà·à¶±à¶¯à·™à¶«à·’à¶ºà·š à¶´'),
('204', 'à¶´à·–à¶¢à·Šâ€à¶º à·€à¶½à·€à·à·„à·à¶‚à¶œà·”à¶±à'),
('228', 'à¶´à·–à¶¢à·Šâ€à¶º à¶šà¶§à·Šà¶§à¶šà¶©à·”à·€à·š à¶ '),
('230', 'à¶©à·“.à¶´à·’. à¶±à·’à¶½à¶±à·Šà¶­ à¶¸à·„à¶­à·'),
('231', 'à¶´à·–à¶¢à·Šâ€à¶º à¶½à·™à¶±à¶œà¶½ à·ƒà·’à¶»à·’à¶±'),
('232', 'à¶©à¶¶à·Š.à¶´à·“.à¶‘à¶½à·Š.à¶‘à¶¸à·Š. à¶±à·’à¶½à·–'),
('233', 'à¶…à·ƒà¶‚à¶š à¶­à·’à¶½à¶šà·ƒà·’à¶»à·’ à¶¸à·„à¶­à·'),
('235', 'à¶‘à¶ à·Š.à¶©à¶¶à·Š.à¶¶à·“.à¶…à¶ºà·’. à·ƒà¶¸à·Šà¶´'),
('236', 'à¶§à·“.à¶‘à¶¸à·Š.à¶©à¶¶à·Š.à¶´à·“. à¶­à·™à¶±à·Šà¶±'),
('62', 'à¶¸à·„à·à¶ à·à¶»à·Šà¶º à¶´à·–à¶¢à·Šâ€à¶º à¶±à·™'),
('77', 'à¶´à·–à¶¢à·Šâ€à¶º à·€à·‘à¶œà¶¸ à¶´à·’à¶ºà¶»à¶­à¶±'),
('78', 'à¶¸à·„à·à¶ à·à¶»à·Šà¶º à¶´à·–à¶¢à·Šâ€à¶º à¶‡à¶š'),
('79', 'à¶¸à·„à·à¶ à·à¶»à·Šà¶º à¶´à·–à¶¢à·Šâ€à¶º à·€à·'),
('81', 'à¶¢à·Šâ€à¶ºà·™. à¶¸à·„à·à¶ à·à¶»à·Šà¶º à¶´à·–à¶'),
('82', 'à¶¸à·„à·à¶ à·à¶»à·Šà¶º à¶´à·–à¶¢à·Šâ€à¶º à¶œà¶½'),
('83', 'à¶¸à·„à·à¶ à·à¶»à·Šà¶º à¶´à·–à¶¢à·Šâ€à¶º à¶‰à¶­'),
('84', 'à¶¢à·Šâ€à¶ºà·™. à¶šà¶®à·’. à¶´à·–à¶¢à·Šâ€à¶º à¶´'),
('85', 'à¶šà·š.à¶’.à¶‘à·ƒà·Š.à¶‘à¶±à·Š. à¶…à¶¸à¶»à·ƒà·šà¶š'),
('86', 'à¶‘à¶¸à·Š.à¶’.à·ƒà·“. à¶¸à·”à¶«à·ƒà·’à¶‚à·„ à¶¸à·’'),
('87', 'à¶†à¶ à·à¶»à·Šà¶º à¶´à·”à¶¢à·Šâ€à¶º à¶¯à·”à¶±à·”'),
('88', 'à¶‘à¶ à·Š.à¶‘à¶¸à·Š.à·€à¶ºà·’.à·€à·“.à¶šà·š. à·„à·'),
('96', 'à¶¸à·„à·à¶ à·à¶»à·Šà¶º à¶Š.à¶’. à·€à·’à¶šà·Šâ€à');

-- --------------------------------------------------------

--
-- Table structure for table `localapplicant`
--

CREATE TABLE IF NOT EXISTS `localapplicant` (
  `appNo` int(11) NOT NULL,
  `nameSinhala` varchar(300) DEFAULT NULL,
  `addS1` varchar(200) DEFAULT NULL,
  `addS2` varchar(200) DEFAULT NULL,
  `addS3` varchar(200) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `nicNo` varchar(20) DEFAULT NULL,
  `entryType` varchar(10) DEFAULT NULL,
  `alYear` year(4) DEFAULT NULL,
  `alAdNo` varchar(10) DEFAULT NULL,
  `zScore` varchar(10) DEFAULT NULL,
  `gkScore` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`appNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `pageID` int(11) NOT NULL AUTO_INCREMENT,
  `pageName` varchar(100) NOT NULL,
  PRIMARY KEY (`pageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`pageID`, `pageName`) VALUES
(1, 'applicant.php'),
(2, 'localApplicants.php'),
(3, 'foreignApplicants.php'),
(4, 'alSub.php'),
(5, 'newAlSub.php'),
(6, 'reportSelectRelated.php'),
(7, 'reportApplicant.php'),
(8, 'reportEnvelope.php'),
(9, 'rptSelectedApplicants.php'),
(10, 'rptApplicants.php'),
(11, 'studentAdmin.php'),
(12, 'studentNew.php'),
(13, 'studentDetails.php'),
(14, 'studentEdit.php'),
(15, 'studentEnroll.php'),
(16, 'subjectAdmin.php'),
(17, 'subjectNew.php'),
(18, 'subjectDetails.php'),
(19, 'subjectEdit.php'),
(20, 'lectureSchedule.php'),
(21, 'lectureNew.php'),
(22, 'venue.php'),
(23, 'lecturer.php'),
(24, 'timeSlot.php'),
(25, 'reportTimeTable.php'),
(26, 'rptTTLecturer.php'),
(27, 'rptTTStudent.php'),
(28, 'newApplicant.php'),
(29, 'editApplicant.php'),
(30, 'newLocal.php'),
(31, 'newForeign.php'),
(32, 'examAdmin.php'),
(33, 'effortNew.php'),
(34, 'effortEdit.php'),
(35, 'examEnterResults.php'),
(36, 'examSchedule.php'),
(37, 'examNew.php'),
(38, 'rptExamSchedule.php'),
(39, 'examAdmission.php'),
(40, 'rptAdmissionE.php'),
(41, 'rptAdmissionS.php'),
(42, 'examAttendance.php'),
(43, 'rptExamAttendance.php'),
(44, 'examTranscript.php'),
(45, 'rptTranscriptE.php'),
(46, 'rptTranscriptS.php'),
(47, 'reportEnrollRelated.php'),
(48, 'reportStudentInfo.php'),
(49, 'rptStudentInfo.php'),
(50, 'rptEnvelope.php'),
(51, 'rptStudentsList.php'),
(52, 'rptStudentInfo.php'),
(53, 'reportStudentInfo.php'),
(54, 'reportRegInfo.php'),
(55, 'rptRegInfo.php'),
(56, 'studentAdminF.php'),
(57, 'reportSubject.php'),
(58, 'reportCountry.php'),
(59, 'rptSubject.php'),
(60, 'rptCountry.php'),
(61, 'rptApplicants_e.php'),
(62, 'reportStatistics.php'),
(63, 'rptStatistics.php'),
(64, 'Gradepoints.php'),
(65, 'newGrade.php'),
(66, 'TeststudentEnroll.php'),
(67, 'examComAdmin.php'),
(68, 'effortComNew.php'),
(69, 'effortComEdit.php'),
(70, 'calculateGPA.php'),
(71, 'scholarship.php'),
(72, 'effortReason.php'),
(73, 'examEnterResults1.php'),
(74, 'OrderSubject.php');

-- --------------------------------------------------------

--
-- Table structure for table `paliqualification`
--

CREATE TABLE IF NOT EXISTS `paliqualification` (
  `code` varchar(10) NOT NULL,
  `qualification` varchar(300) NOT NULL,
  `qualificationE` varchar(50) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paliqualification`
--

INSERT INTO `paliqualification` (`code`, `qualification`, `qualificationE`) VALUES
('p01', 'à¶‹.à¶´à·™à·…', 'A/L'),
('p02', 'à¶´à·à¶ à·“à¶± à¶´à·à¶»à¶¸à·Šà¶· à·€à·’à¶·à·à¶œà¶º', 'Prachina Praramba Exam'),
('p03', 'à¶¸à·–à¶½à·’à¶š à¶´à·’à¶»à·’à·€à·™à¶±à·Š à¶…à·€à·ƒà·à¶± à·€à·’à¶·à·à¶œà¶º', 'Mulika Piriven Final Exam'),
('p04', 'à·ƒà·.à¶´à·™à·…', 'O/L'),
('p05', 'à¶´à·à¶½à·’ à¶©à·’à¶´à·Šà¶½à·à¶¸à·', 'Diploma in Pali');

-- --------------------------------------------------------

--
-- Table structure for table `privillege`
--

CREATE TABLE IF NOT EXISTS `privillege` (
  `userID` varchar(30) NOT NULL,
  `pageID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`pageID`),
  KEY `pageID` (`pageID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privillege`
--

INSERT INTO `privillege` (`userID`, `pageID`) VALUES
('admin', 1),
('registration', 1),
('admin', 2),
('registration', 2),
('admin', 3),
('registration', 3),
('admin', 4),
('registration', 4),
('admin', 5),
('registration', 5),
('admin', 6),
('registration', 6),
('admin', 7),
('registration', 7),
('admin', 8),
('registration', 8),
('admin', 9),
('registration', 9),
('admin', 10),
('registration', 10),
('admin', 11),
('registration', 11),
('admin', 12),
('registration', 12),
('admin', 13),
('registration', 13),
('admin', 14),
('registration', 14),
('admin', 15),
('registration', 15),
('admin', 16),
('registration', 16),
('admin', 17),
('registration', 17),
('admin', 18),
('registration', 18),
('admin', 19),
('registration', 19),
('admin', 20),
('registration', 20),
('admin', 21),
('registration', 21),
('admin', 22),
('registration', 22),
('admin', 23),
('registration', 23),
('admin', 24),
('registration', 24),
('admin', 25),
('registration', 25),
('admin', 26),
('registration', 26),
('admin', 27),
('registration', 27),
('admin', 28),
('registration', 28),
('admin', 29),
('registration', 29),
('admin', 30),
('registration', 30),
('admin', 31),
('registration', 31),
('admin', 32),
('examination', 32),
('admin', 33),
('examination', 33),
('admin', 34),
('examination', 34),
('admin', 35),
('examination', 35),
('admin', 36),
('examination', 36),
('admin', 37),
('examination', 37),
('admin', 38),
('examination', 38),
('admin', 39),
('examination', 39),
('admin', 40),
('examination', 40),
('admin', 41),
('examination', 41),
('admin', 42),
('examination', 42),
('admin', 43),
('examination', 43),
('admin', 44),
('examination', 44),
('admin', 45),
('examination', 45),
('admin', 46),
('examination', 46),
('admin', 47),
('registration', 47),
('admin', 48),
('registration', 48),
('admin', 49),
('registration', 49),
('admin', 50),
('registration', 50),
('admin', 51),
('registration', 51),
('admin', 52),
('registration', 52),
('admin', 53),
('registration', 53),
('admin', 54),
('registration', 54),
('admin', 55),
('registration', 55),
('admin', 56),
('registration', 56),
('admin', 57),
('registration', 57),
('admin', 58),
('registration', 58),
('admin', 59),
('registration', 59),
('admin', 60),
('registration', 60),
('admin', 61),
('registration', 61),
('admin', 62),
('registration', 62),
('admin', 63),
('registration', 63),
('admin', 64),
('admin', 65),
('admin', 66),
('admin', 67),
('admin', 68),
('admin', 69),
('admin', 70),
('admin', 71),
('examination', 71),
('registration', 71),
('admin', 72),
('examination', 72),
('registration', 72),
('admin', 73),
('admin', 74);

-- --------------------------------------------------------

--
-- Table structure for table `scholarship`
--

CREATE TABLE IF NOT EXISTS `scholarship` (
  `schCode` int(11) NOT NULL AUTO_INCREMENT,
  `schDesE` varchar(30) NOT NULL,
  `schDesS` varchar(100) NOT NULL,
  PRIMARY KEY (`schCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `scholarship`
--

INSERT INTO `scholarship` (`schCode`, `schDesE`, `schDesS`) VALUES
(1, 'Mahopaddyaya Prize', '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `appNo` varchar(20) NOT NULL,
  `regNo` varchar(20) NOT NULL DEFAULT '',
  `indexNo` varchar(20) DEFAULT NULL,
  `title` varchar(10) DEFAULT NULL,
  `nameEnglish` varchar(100) DEFAULT NULL,
  `nameSinhala` varchar(400) DEFAULT NULL,
  `addressE1` varchar(50) DEFAULT NULL,
  `addressE2` varchar(50) DEFAULT NULL,
  `addressE3` varchar(50) DEFAULT NULL,
  `addressS1` varchar(200) DEFAULT NULL,
  `addressS2` varchar(200) DEFAULT NULL,
  `addressS3` varchar(200) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `entryType` varchar(20) DEFAULT NULL,
  `yearEntry` year(4) DEFAULT NULL,
  `faculty` varchar(20) DEFAULT NULL,
  `degreeType` varchar(20) DEFAULT 'Normal',
  `medium` varchar(8) NOT NULL,
  `id_pp_No` varchar(20) DEFAULT NULL,
  `contactNo` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `citizenship` varchar(20) DEFAULT NULL,
  `nationality` varchar(20) DEFAULT NULL,
  `religion` varchar(20) DEFAULT NULL,
  `civilStatus` varchar(20) DEFAULT NULL,
  `guardName` varchar(60) DEFAULT NULL,
  `guardAddress` varchar(300) DEFAULT NULL,
  `guardContactNo` varchar(20) DEFAULT NULL,
  `Scholarship` varchar(10) NOT NULL,
  PRIMARY KEY (`regNo`),
  UNIQUE KEY `regNo` (`regNo`),
  KEY `indexNo` (`indexNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`appNo`, `regNo`, `indexNo`, `title`, `nameEnglish`, `nameSinhala`, `addressE1`, `addressE2`, `addressE3`, `addressS1`, `addressS2`, `addressS3`, `district`, `entryType`, `yearEntry`, `faculty`, `degreeType`, `medium`, `id_pp_No`, `contactNo`, `email`, `birthday`, `citizenship`, `nationality`, `religion`, `civilStatus`, `guardName`, `guardAddress`, `guardContactNo`, `Scholarship`) VALUES
('B1', 'BS/2018/01', 'BS/2018/01', 'Mr.', 'Galbokka Hewage Ranga Madhushankha', '', '', '', '', '', '', '', '', 'Nomal', 2018, 'Buddhist', 'General', 'Sinhala', '', '', '', '1900-01-01', '', '', '', '', '', '', '', 'None'),
('B3', 'BS/2018/03', 'BS/2018/03', 'Ven.', 'Malalpola Dhamma Suneetha Thero', '', '', '', '', '', '', '', '', 'Nomal', 2018, 'Buddhist', 'Special-Sin', 'English', '', '', '', '1900-01-01', '', '', '', '', '', '', '', 'None'),
('L1', 'LS/2018/01', 'LS/2018/01', 'Mr.', 'Deerasinha kankanamge Dilan madhuranga', '', '', '', '', '', '', '', '', 'Nomal', 2018, 'Language', 'General', 'Sinhala', '', '', '', '1900-01-01', '', '', '', '', '', '', '', 'None'),
('L18', 'LS/2018/18', 'LS/2018/18', 'Ven.', 'Kande-ela Shanthasiri Thero', '', '', '', '', '', '', '', '', 'Nomal', 2018, 'Language', 'General', 'English', '', '', '', '1900-01-01', '', '', '', '', '', '', '', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `studentenrolment`
--

CREATE TABLE IF NOT EXISTS `studentenrolment` (
  `enrolId` int(11) NOT NULL,
  `indexNo` varchar(20) NOT NULL,
  `regNo` varchar(20) NOT NULL,
  `subjectID` int(11) NOT NULL DEFAULT '0',
  `SchSta` tinyint(1) DEFAULT NULL,
  `acYear` year(4) DEFAULT NULL,
  PRIMARY KEY (`subjectID`,`regNo`),
  KEY `indexNo` (`indexNo`,`subjectID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentenrolment`
--

INSERT INTO `studentenrolment` (`enrolId`, `indexNo`, `regNo`, `subjectID`, `SchSta`, `acYear`) VALUES
(1, 'BS/2018/03', 'BS/2018/03', 265, NULL, 2019),
(2, 'BS/2018/01', 'BS201801', 265, NULL, 2019),
(3, 'LS/2018/18', 'LS/2018/18', 265, NULL, 2019),
(4, 'LS/2018/01', 'LS201801', 265, NULL, 2019),
(8, 'BS/2018/01', 'BS/2018/01', 266, NULL, 2019),
(5, 'LS/2018/01', 'LS/2018/01', 266, NULL, 2019),
(6, 'BS/2018/01', 'BS/2018/01', 267, NULL, 2019),
(7, 'LS/2018/01', 'LS/2018/01', 267, NULL, 2019),
(9, 'BS/2018/01', 'BS/2018/01', 268, NULL, 2019),
(10, 'BS/2018/03', 'BS/2018/03', 269, NULL, 2019),
(11, 'BS/2018/03', 'BS/2018/03', 300, NULL, 2019),
(12, 'LS/2018/18', 'LS/2018/18', 300, NULL, 2019),
(13, 'BS/2018/01', 'BS/2018/01', 302, NULL, 2019),
(14, 'LS/2018/01', 'LS/2018/01', 302, NULL, 2019),
(19, 'BS/2018/03', 'BS/2018/03', 304, NULL, 2019),
(15, 'LS/2018/18', 'LS/2018/18', 304, NULL, 2019),
(20, 'LS/2018/18', 'LS/2018/18', 305, NULL, 2019),
(23, 'BS/2018/01', 'BS/2018/01', 338, NULL, 2019),
(16, 'LS/2018/01', 'LS/2018/01', 338, NULL, 2019),
(24, 'LS/2018/18', 'LS/2018/18', 338, NULL, 2019),
(17, 'BS/2018/03', 'BS/2018/03', 339, NULL, 2019),
(25, 'LS/2018/01', 'LS/2018/01', 339, NULL, 2019),
(28, 'BS/2018/03', 'BS/2018/03', 340, NULL, 2019),
(26, 'BS/2018/03', 'BS/2018/03', 341, NULL, 2019),
(27, 'LS/2018/18', 'LS/2018/18', 341, NULL, 2019),
(18, 'LS/2018/18', 'LS/2018/18', 342, NULL, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `studentgpa`
--

CREATE TABLE IF NOT EXISTS `studentgpa` (
  `indexNo` varchar(20) NOT NULL,
  `acYear` year(4) NOT NULL,
  `level` varchar(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `totcredithours` float NOT NULL,
  `totGPA` float NOT NULL,
  `GPAsemester` float NOT NULL,
  `Acount` int(3) NOT NULL,
  `Bcount` int(3) NOT NULL,
  `Ccount` int(3) NOT NULL,
  `TotalSub` int(3) NOT NULL,
  PRIMARY KEY (`semester`,`indexNo`,`level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentgpa`
--

INSERT INTO `studentgpa` (`indexNo`, `acYear`, `level`, `semester`, `totcredithours`, `totGPA`, `GPAsemester`, `Acount`, `Bcount`, `Ccount`, `TotalSub`) VALUES
('0', 2000, '0', '0', 0, 0, 0, 0, 0, 0, 0),
('20113001 ', 2012, '0', '0', 0, 0, 0, 0, 0, 0, 0),
('20113004 ', 2011, '0', '0', 0, 0, 0, 0, 0, 0, 0),
('0', 2011, 'I', 'First Semester', 0, 0, 0, 0, 0, 0, 0),
('0', 2012, 'II', 'First Semester', 0, 0, 0, 0, 0, 0, 0),
('0', 2013, 'III', 'First Semester', 0, 0, 0, 0, 0, 0, 0),
('20113001 ', 2011, 'I', 'First Semester', 15, 52.4, 3.49, 1, 6, 6, 7),
('20113002 ', 2011, 'I', 'First Semester', 15, 0, 0, 0, 0, 0, 7),
('20113004 ', 2011, 'I', 'First Semester', 15, 33.5, 2.23, 0, 1, 5, 7),
('20113004 ', 2011, 'II', 'First Semester', 15, 31.9, 2.13, 0, 0, 5, 6),
('20113004 ', 2012, 'III', 'First Semester', 15, 38.7, 2.58, 0, 2, 5, 6),
('20113008 ', 2011, 'I', 'First Semester', 15, 45.2, 3.01, 0, 3, 6, 7),
('20113008 ', 2012, 'II', 'First Semester', 15, 44, 2.93, 1, 3, 6, 6),
('20113008 ', 2013, 'III', 'First Semester', 15, 52.4, 3.49, 1, 5, 6, 6),
('20113009 ', 2011, 'I', 'First Semester', 15, 33.9, 2.26, 0, 1, 4, 7),
('20113009 ', 2012, 'II', 'First Semester', 15, 43, 2.87, 0, 3, 6, 6),
('20113009 ', 2013, 'III', 'First Semester', 15, 40.6, 2.71, 0, 3, 6, 6),
('20113011 ', 2011, 'I', 'First Semester', 15, 37.5, 2.5, 0, 1, 6, 7),
('20113011 ', 2012, 'II', 'First Semester', 15, 49.6, 3.31, 2, 4, 6, 6),
('20113011 ', 2013, 'III', 'First Semester', 15, 56.8, 3.79, 3, 6, 6, 6),
('20113012 ', 2011, 'I', 'First Semester', 15, 45, 3, 0, 5, 6, 7),
('20113012 ', 2012, 'II', 'First Semester', 15, 39.3, 2.62, 0, 2, 5, 6),
('20113012 ', 2013, 'III', 'First Semester', 15, 38.9, 2.59, 0, 3, 5, 6),
('20113015 ', 2011, 'I', 'First Semester', 15, 44.7, 2.98, 0, 4, 6, 7),
('20113015 ', 2012, 'II', 'First Semester', 15, 44.1, 2.94, 0, 4, 6, 6),
('20113015 ', 2013, 'III', 'First Semester', 15, 51.3, 3.42, 2, 5, 5, 6),
('20113016 ', 2011, 'I', 'First Semester', 15, 41.3, 2.75, 1, 4, 4, 7),
('20113016 ', 2012, 'II', 'First Semester', 15, 40.6, 2.71, 0, 2, 6, 6),
('20113016 ', 2013, 'III', 'First Semester', 15, 43.9, 2.93, 1, 4, 5, 6),
('20113025 ', 2011, 'I', 'First Semester', 15, 32.5, 2.17, 0, 1, 5, 7),
('20113025 ', 2011, 'II', 'First Semester', 15, 50.5, 3.37, 0, 5, 6, 6),
('20113025 ', 2013, 'III', 'First Semester', 15, 48, 3.2, 2, 4, 5, 6),
('20113034 ', 2011, 'I', 'First Semester', 15, 49.6, 3.31, 3, 4, 6, 7),
('20113034 ', 2012, 'II', 'First Semester', 15, 50.8, 3.39, 0, 6, 6, 6),
('20113034 ', 2013, 'III', 'First Semester', 15, 52.4, 3.49, 2, 5, 6, 6),
('20113037 ', 2011, 'I', 'First Semester', 15, 46.3, 3.09, 0, 4, 6, 7),
('20113037 ', 2012, 'II', 'First Semester', 15, 0, 0, 0, 0, 0, 6),
('20113037 ', 2013, 'III', 'First Semester', 15, 0, 0, 0, 0, 0, 6),
('20113044 ', 2011, 'I', 'First Semester', 15, 51.8, 3.45, 1, 6, 6, 7),
('20113044 ', 2012, 'II', 'First Semester', 15, 52.8, 3.52, 2, 5, 6, 6),
('20113044 ', 2013, 'III', 'First Semester', 15, 57.1, 3.81, 4, 6, 6, 6),
('20113045 ', 2011, 'I', 'First Semester', 15, 44.4, 2.96, 0, 4, 6, 7),
('20113045 ', 2012, 'II', 'First Semester', 15, 42.8, 2.85, 0, 4, 6, 6),
('20113045 ', 2013, 'III', 'First Semester', 15, 56.2, 3.75, 3, 6, 6, 6),
('20113055 ', 2011, 'I', 'First Semester', 15, 28.5, 1.9, 0, 0, 4, 7),
('20113055 ', 2012, 'II', 'First Semester', 15, 17.3, 1.15, 0, 0, 2, 6),
('20113055 ', 2013, 'III', 'First Semester', 15, 36.2, 2.41, 0, 0, 6, 6),
('20113056 ', 2011, 'I', 'First Semester', 15, 32, 2.13, 0, 1, 4, 7),
('20113056 ', 2012, 'II', 'First Semester', 15, 40.2, 2.68, 0, 3, 6, 6),
('20113056 ', 2013, 'III', 'First Semester', 15, 48, 3.2, 1, 5, 6, 6),
('20113058 ', 2011, 'I', 'First Semester', 15, 32, 2.13, 0, 1, 6, 7),
('20113058 ', 2012, 'II', 'First Semester', 15, 35.1, 2.34, 0, 1, 6, 6),
('20113058 ', 2013, 'III', 'First Semester', 15, 40.1, 2.67, 0, 2, 5, 6),
('20113060 ', 2011, 'I', 'First Semester', 15, 29.5, 1.97, 0, 0, 5, 7),
('20113060 ', 2012, 'II', 'First Semester', 15, 38.6, 2.57, 0, 2, 6, 6),
('20113060 ', 2013, 'III', 'First Semester', 15, 47.8, 3.19, 1, 4, 6, 6),
('20113062 ', 2011, 'I', 'First Semester', 15, 32.5, 2.17, 0, 1, 5, 8),
('20113062 ', 2012, 'II', 'First Semester', 15, 38, 2.53, 0, 2, 5, 6),
('20113062 ', 2013, 'III', 'First Semester', 15, 37.8, 2.52, 1, 1, 5, 6),
('20113063 ', 2011, 'I', 'First Semester', 15, 37.4, 2.49, 0, 2, 6, 8),
('20113063 ', 2012, 'II', 'First Semester', 15, 46.7, 3.11, 1, 4, 6, 6),
('20113063 ', 2013, 'III', 'First Semester', 15, 49.9, 3.33, 2, 5, 5, 6),
('20113064 ', 2011, 'I', 'First Semester', 15, 30.9, 2.06, 0, 0, 5, 8),
('20113064 ', 2012, 'II', 'First Semester', 15, 36, 2.4, 0, 1, 5, 6),
('20113064 ', 2013, 'III', 'First Semester', 15, 35.6, 2.37, 0, 1, 6, 6),
('20113066 ', 2011, 'I', 'First Semester', 15, 28.5, 1.9, 0, 0, 4, 7),
('20113066 ', 2012, 'II', 'First Semester', 15, 24.8, 1.65, 0, 0, 3, 6),
('20113066 ', 2013, 'III', 'First Semester', 15, 42, 2.8, 1, 3, 5, 6),
('20113068 ', 2011, 'I', 'First Semester', 15, 42.4, 2.83, 0, 3, 5, 7),
('20113068 ', 2012, 'II', 'First Semester', 15, 51.2, 3.41, 1, 5, 6, 6),
('20113068 ', 2013, 'III', 'First Semester', 15, 45.7, 3.05, 0, 3, 6, 6),
('20113101 ', 2011, 'I', 'First Semester', 15, 48.4, 3.23, 2, 4, 5, 7),
('20113101 ', 2012, 'II', 'First Semester', 15, 45.5, 3.03, 1, 3, 6, 6),
('20113101 ', 2013, 'III', 'First Semester', 15, 55.5, 3.7, 4, 5, 6, 6),
('20113102 ', 2011, 'I', 'First Semester', 5, 0, 0, 0, 0, 0, 2),
('20113103 ', 2011, 'I', 'First Semester', 15, 39.4, 2.63, 0, 3, 6, 7),
('20113103 ', 2012, 'II', 'First Semester', 15, 45, 3, 1, 3, 6, 6),
('20113103 ', 2013, 'III', 'First Semester', 15, 44, 2.93, 1, 3, 6, 6),
('20113107 ', 2011, 'I', 'First Semester', 14, 33.6, 2.4, 0, 0, 6, 7),
('20113107 ', 2012, 'II', 'First Semester', 15, 48.9, 3.26, 0, 4, 6, 6),
('20113107 ', 2013, 'III', 'First Semester', 15, 46, 3.07, 1, 3, 6, 6),
('20113112 ', 2011, 'I', 'First Semester', 15, 30, 2, 0, 0, 5, 7),
('20113112 ', 2012, 'II', 'First Semester', 15, 30.1, 2.01, 0, 1, 4, 6),
('20113112 ', 2013, 'III', 'First Semester', 15, 41, 2.73, 1, 2, 6, 6),
('20113115 ', 2011, 'I', 'First Semester', 15, 41.4, 2.76, 0, 4, 6, 7),
('20113115 ', 2012, 'II', 'First Semester', 15, 0, 0, 0, 0, 0, 6),
('20113119 ', 2011, 'I', 'First Semester', 15, 51.5, 3.43, 2, 5, 6, 7),
('20113119 ', 2012, 'II', 'First Semester', 15, 50.4, 3.36, 0, 5, 6, 6),
('20113119 ', 2013, 'III', 'First Semester', 15, 42.1, 2.81, 0, 2, 6, 6),
('20113120 ', 2011, 'I', 'First Semester', 15, 41.2, 2.75, 0, 3, 6, 7),
('20113120 ', 2013, 'III', 'First Semester', 15, 44.5, 2.97, 2, 4, 5, 6),
('20113126 ', 2011, 'I', 'First Semester', 20, 72.7, 3.64, 3, 8, 8, 8),
('20113126 ', 2012, 'II', 'First Semester', 15, 59.1, 3.94, 5, 6, 6, 6),
('20113126 ', 2013, 'III', 'First Semester', 15, 60, 4, 6, 6, 6, 6),
('20113128 ', 2011, 'I', 'First Semester', 15, 44.2, 2.95, 0, 4, 6, 7),
('20113128 ', 2012, 'II', 'First Semester', 15, 47.8, 3.19, 1, 5, 6, 6),
('20113128 ', 2013, 'III', 'First Semester', 15, 42.5, 2.83, 0, 3, 5, 6),
('20113129 ', 2011, 'I', 'First Semester', 15, 45.3, 3.02, 1, 3, 5, 7),
('20113129 ', 2012, 'II', 'First Semester', 15, 45.3, 3.02, 0, 5, 6, 6),
('20113129 ', 2013, 'III', 'First Semester', 15, 44.2, 2.95, 0, 3, 6, 6),
('20113132 ', 2011, 'I', 'First Semester', 15, 39.4, 2.63, 0, 1, 6, 7),
('20113132 ', 2012, 'II', 'First Semester', 15, 39, 2.6, 0, 2, 6, 6),
('20113132 ', 2013, 'III', 'First Semester', 15, 36.3, 2.42, 0, 2, 4, 6),
('20113135 ', 2011, 'I', 'First Semester', 15, 39.3, 2.62, 0, 1, 6, 7),
('20113135 ', 2012, 'II', 'First Semester', 15, 38.2, 2.55, 0, 2, 6, 6),
('20113135 ', 2013, 'III', 'First Semester', 15, 42.4, 2.83, 0, 3, 6, 6),
('20113147 ', 2011, 'I', 'First Semester', 15, 33.9, 2.26, 0, 1, 5, 7),
('20113147 ', 2012, 'II', 'First Semester', 15, 37.3, 2.49, 0, 1, 6, 6),
('20113147 ', 2013, 'III', 'First Semester', 15, 33.5, 2.23, 1, 2, 4, 6),
('SA 20113151 ', 2011, 'I', 'First Semester', 14, 34.1, 2.44, 0, 2, 6, 8),
('SA 20113151 ', 2012, 'II', 'First Semester', 15, 36.1, 2.41, 0, 2, 5, 6),
('SA 20113151 ', 2013, 'III', 'First Semester', 15, 32.9, 2.19, 0, 2, 4, 6),
('SA 20113154 ', 2011, 'I', 'First Semester', 14, 37, 2.64, 0, 3, 6, 7),
('SA 20113154 ', 2012, 'II', 'First Semester', 15, 46.7, 3.11, 0, 5, 6, 6),
('SA 20113154 ', 2013, 'III', 'First Semester', 15, 47.1, 3.14, 1, 4, 6, 6),
('SA 20113155 ', 2011, 'I', 'First Semester', 14, 39, 2.79, 0, 2, 6, 7),
('SA 20113155 ', 2012, 'II', 'First Semester', 15, 41.7, 2.78, 0, 2, 6, 6),
('SA 20113155 ', 2013, 'III', 'First Semester', 15, 46.4, 3.09, 1, 4, 5, 6),
('0', 2011, '0', 'Second Semester', 0, 0, 0, 0, 0, 0, 0),
('0', 2011, 'I', 'Second Semester', 0, 0, 0, 0, 0, 0, 0),
('0', 2012, 'II', 'Second Semester', 0, 0, 0, 0, 0, 0, 0),
('0', 2011, 'III', 'Second Semester', 0, 0, 0, 0, 0, 0, 0),
('20113004 ', 2011, 'I', 'Second Semester', 15, 37.3, 2.49, 0, 1, 6, 7),
('20113004 ', 2012, 'II', 'Second Semester', 15, 47.1, 3.14, 0, 5, 6, 6),
('20113004 ', 2012, 'III', 'Second Semester', 15, 41.8, 2.79, 0, 3, 6, 6),
('20113005 ', 2013, 'II', 'Second Semester', 14, 0, 0, 0, 0, 0, 4),
('20113008 ', 2011, 'I', 'Second Semester', 15, 41.3, 2.75, 1, 3, 5, 7),
('20113008 ', 2012, 'II', 'Second Semester', 15, 39.1, 2.61, 1, 2, 6, 6),
('20113008 ', 2014, 'III', 'Second Semester', 15, 51.2, 3.41, 1, 4, 6, 6),
('20113009 ', 2011, 'I', 'Second Semester', 15, 33.3, 2.22, 0, 0, 4, 7),
('20113009 ', 2012, 'II', 'Second Semester', 15, 38, 2.53, 0, 3, 5, 6),
('20113009 ', 2014, 'III', 'Second Semester', 15, 48.5, 3.23, 1, 5, 6, 6),
('20113011 ', 2011, 'I', 'Second Semester', 15, 42.6, 2.84, 0, 3, 6, 7),
('20113011 ', 2012, 'II', 'Second Semester', 15, 51.7, 3.45, 3, 5, 6, 6),
('20113011 ', 2014, 'III', 'Second Semester', 15, 52.7, 3.51, 2, 5, 6, 6),
('20113012 ', 2011, 'I', 'Second Semester', 15, 36.9, 2.46, 0, 2, 4, 7),
('20113012 ', 2012, 'II', 'Second Semester', 15, 45.4, 3.03, 2, 4, 6, 6),
('20113012 ', 2014, 'III', 'Second Semester', 15, 39.3, 2.62, 0, 3, 4, 6),
('20113015 ', 2011, 'I', 'Second Semester', 15, 46.8, 3.12, 1, 4, 6, 7),
('20113015 ', 2012, 'II', 'Second Semester', 15, 34.1, 2.27, 1, 1, 5, 6),
('20113015 ', 2014, 'III', 'Second Semester', 15, 49.3, 3.29, 0, 4, 6, 6),
('20113016 ', 2011, 'I', 'Second Semester', 15, 34.1, 2.27, 0, 1, 6, 6),
('20113016 ', 2012, 'II', 'Second Semester', 15, 40, 2.67, 0, 1, 6, 6),
('20113016 ', 2014, 'III', 'Second Semester', 15, 37.9, 2.53, 0, 2, 5, 6),
('20113025 ', 2011, 'I', 'Second Semester', 15, 37.3, 2.49, 0, 2, 6, 7),
('20113025 ', 2012, 'II', 'Second Semester', 15, 58.8, 3.92, 4, 6, 6, 6),
('20113025 ', 2014, 'III', 'Second Semester', 15, 55.3, 3.69, 3, 6, 6, 6),
('20113034 ', 2011, 'I', 'Second Semester', 15, 43.8, 2.92, 2, 3, 5, 7),
('20113034 ', 2012, 'II', 'Second Semester', 15, 31.7, 2.11, 1, 3, 4, 6),
('20113034 ', 2014, 'III', 'Second Semester', 15, 55.3, 3.69, 2, 5, 6, 6),
('20113037 ', 2011, 'I', 'Second Semester', 15, 44.8, 2.99, 0, 4, 6, 7),
('20113037 ', 2012, 'II', 'Second Semester', 15, 0, 0, 0, 0, 0, 6),
('20113037 ', 2014, 'III', 'Second Semester', 15, 0, 0, 0, 0, 0, 6),
('20113044 ', 2011, 'I', 'Second Semester', 15, 49.8, 3.32, 2, 4, 6, 7),
('20113044 ', 2012, 'II', 'Second Semester', 15, 56.4, 3.76, 3, 6, 6, 6),
('20113044 ', 2014, 'III', 'Second Semester', 15, 55.9, 3.73, 3, 6, 6, 6),
('20113045 ', 2011, 'I', 'Second Semester', 15, 42.6, 2.84, 0, 5, 6, 7),
('20113045 ', 2012, 'II', 'Second Semester', 15, 42.1, 2.81, 0, 3, 6, 6),
('20113045 ', 2014, 'III', 'Second Semester', 15, 53.8, 3.59, 1, 6, 6, 6),
('20113055 ', 2011, 'I', 'Second Semester', 15, 36, 2.4, 0, 2, 5, 6),
('20113055 ', 2012, 'II', 'Second Semester', 15, 32.9, 2.19, 0, 0, 5, 6),
('20113055 ', 2014, 'III', 'Second Semester', 15, 28.2, 1.88, 0, 0, 3, 6),
('20113056 ', 2011, 'I', 'Second Semester', 15, 39.2, 2.61, 1, 4, 4, 6),
('20113056 ', 2012, 'II', 'Second Semester', 15, 41.5, 2.77, 0, 1, 6, 6),
('20113056 ', 2014, 'III', 'Second Semester', 15, 41, 2.73, 0, 3, 5, 6),
('20113058 ', 2011, 'I', 'Second Semester', 15, 37.7, 2.51, 0, 3, 5, 7),
('20113058 ', 2012, 'II', 'Second Semester', 15, 38.5, 2.57, 0, 2, 6, 6),
('20113058 ', 2014, 'III', 'Second Semester', 15, 32.6, 2.17, 0, 1, 5, 6),
('20113060 ', 2011, 'I', 'Second Semester', 15, 42, 2.8, 0, 2, 6, 6),
('20113060 ', 2012, 'II', 'Second Semester', 15, 40.6, 2.71, 0, 2, 6, 6),
('20113060 ', 2014, 'III', 'Second Semester', 15, 42.1, 2.81, 0, 2, 6, 6),
('20113062 ', 2011, 'I', 'Second Semester', 15, 36.9, 2.46, 0, 2, 5, 6),
('20113062 ', 2012, 'II', 'Second Semester', 15, 34.1, 2.27, 0, 0, 5, 6),
('20113062 ', 2014, 'III', 'Second Semester', 15, 38.7, 2.58, 0, 3, 5, 6),
('20113063 ', 2011, 'I', 'Second Semester', 15, 43.9, 2.93, 2, 4, 5, 6),
('20113063 ', 2012, 'II', 'Second Semester', 15, 44.1, 2.94, 0, 4, 6, 6),
('20113063 ', 2014, 'III', 'Second Semester', 15, 46.7, 3.11, 1, 5, 5, 6),
('20113064 ', 2011, 'I', 'Second Semester', 15, 38, 2.53, 1, 3, 5, 6),
('20113064 ', 2012, 'II', 'Second Semester', 15, 33.8, 2.25, 0, 0, 6, 6),
('20113064 ', 2014, 'III', 'Second Semester', 15, 39.4, 2.63, 0, 3, 5, 6),
('20113066 ', 2011, 'I', 'Second Semester', 15, 33.4, 2.23, 0, 0, 6, 6),
('20113066 ', 2012, 'II', 'Second Semester', 15, 35.9, 2.39, 0, 0, 5, 6),
('20113066 ', 2014, 'III', 'Second Semester', 15, 40.1, 2.67, 0, 2, 6, 6),
('20113068 ', 2011, 'I', 'Second Semester', 15, 46.3, 3.09, 1, 4, 6, 6),
('20113068 ', 2012, 'II', 'Second Semester', 15, 44.8, 2.99, 0, 4, 6, 6),
('20113068 ', 2014, 'III', 'Second Semester', 15, 44.2, 2.95, 0, 4, 5, 6),
('20113101 ', 2011, 'I', 'Second Semester', 15, 47.6, 3.17, 3, 4, 5, 6),
('20113101 ', 2012, 'II', 'Second Semester', 15, 49.4, 3.29, 1, 5, 6, 6),
('20113101 ', 2013, 'III', 'Second Semester', 15, 52.1, 3.47, 2, 5, 6, 6),
('20113103 ', 2011, 'I', 'Second Semester', 15, 40.5, 2.7, 1, 3, 6, 7),
('20113103 ', 2012, 'II', 'Second Semester', 15, 47.3, 3.15, 1, 4, 6, 6),
('20113103 ', 2014, 'III', 'Second Semester', 15, 45.9, 3.06, 0, 6, 6, 6),
('20113107 ', 2011, 'I', 'Second Semester', 15, 36.2, 2.41, 0, 1, 6, 7),
('20113107 ', 2012, 'II', 'Second Semester', 15, 45.7, 3.05, 1, 4, 6, 6),
('20113107 ', 2014, 'III', 'Second Semester', 15, 46.3, 3.09, 1, 4, 6, 6),
('20113112 ', 2011, 'I', 'Second Semester', 15, 32.6, 2.17, 0, 0, 5, 7),
('20113112 ', 2012, 'II', 'Second Semester', 15, 35.9, 2.39, 0, 2, 6, 6),
('20113112 ', 2014, 'III', 'Second Semester', 15, 45.9, 3.06, 0, 3, 6, 6),
('20113115 ', 2011, 'I', 'Second Semester', 15, 33.2, 2.21, 0, 0, 5, 7),
('20113115 ', 2012, 'II', 'Second Semester', 15, 0, 0, 0, 0, 0, 6),
('20113119 ', 2011, 'I', 'Second Semester', 15, 44.8, 2.99, 0, 4, 6, 7),
('20113119 ', 2012, 'II', 'Second Semester', 15, 51.5, 3.43, 0, 5, 6, 6),
('20113119 ', 2014, 'III', 'Second Semester', 15, 50.7, 3.38, 1, 5, 6, 6),
('20113120 ', 2011, 'I', 'Second Semester', 15, 46.4, 3.09, 0, 4, 6, 7),
('20113120 ', 2012, 'II', 'Second Semester', 15, 35.6, 2.37, 0, 2, 4, 6),
('20113120 ', 2014, 'III', 'Second Semester', 15, 40.1, 2.67, 0, 2, 6, 6),
('20113126 ', 2011, 'I', 'Second Semester', 10, 35.2, 3.52, 2, 3, 4, 4),
('20113126 ', 2012, 'II', 'Second Semester', 15, 58, 3.87, 5, 6, 6, 6),
('20113126 ', 2014, 'III', 'Second Semester', 15, 58.6, 3.91, 5, 6, 6, 6),
('20113128 ', 2011, 'I', 'Second Semester', 15, 50.5, 3.37, 2, 5, 6, 7),
('20113128 ', 2012, 'II', 'Second Semester', 15, 49, 3.27, 0, 5, 6, 6),
('20113128 ', 2014, 'III', 'Second Semester', 15, 48.3, 3.22, 1, 4, 6, 6),
('20113129 ', 2011, 'I', 'Second Semester', 15, 41.7, 2.78, 1, 3, 5, 7),
('20113129 ', 2012, 'II', 'Second Semester', 15, 43.3, 2.89, 0, 4, 6, 6),
('20113129 ', 2014, 'III', 'Second Semester', 15, 46.6, 3.11, 0, 4, 6, 6),
('20113132 ', 2011, 'I', 'Second Semester', 15, 32.6, 2.17, 0, 1, 5, 7),
('20113132 ', 2012, 'II', 'Second Semester', 15, 28.4, 1.89, 0, 1, 3, 6),
('20113132 ', 2014, 'III', 'Second Semester', 15, 41.5, 2.77, 0, 3, 6, 6),
('20113135 ', 2011, 'I', 'Second Semester', 15, 39.6, 2.64, 0, 2, 6, 7),
('20113135 ', 2012, 'II', 'Second Semester', 15, 37.4, 2.49, 0, 1, 6, 6),
('20113135 ', 2014, 'III', 'Second Semester', 15, 43.2, 2.88, 0, 4, 6, 6),
('20113147 ', 2011, 'I', 'Second Semester', 15, 37.5, 2.5, 0, 2, 6, 7),
('20113147 ', 2012, 'II', 'Second Semester', 15, 38.1, 2.54, 0, 3, 5, 6),
('20113147 ', 2014, 'III', 'Second Semester', 15, 38.3, 2.55, 0, 2, 6, 6),
('SA 20113151 ', 2011, 'I', 'Second Semester', 15, 38.9, 2.59, 0, 2, 6, 6),
('SA 20113151 ', 2012, 'II', 'Second Semester', 15, 40.6, 2.71, 0, 3, 5, 6),
('SA 20113151 ', 2014, 'III', 'Second Semester', 15, 32.8, 2.19, 0, 0, 4, 6),
('SA 20113154 ', 2011, 'I', 'Second Semester', 15, 47, 3.13, 0, 5, 6, 7),
('SA 20113154 ', 2012, 'II', 'Second Semester', 15, 53.6, 3.57, 1, 5, 6, 6),
('SA 20113154 ', 2014, 'III', 'Second Semester', 15, 54.8, 3.65, 2, 6, 6, 6),
('SA 20113155 ', 2011, 'I', 'Second Semester', 15, 40, 2.67, 0, 3, 6, 7),
('SA 20113155 ', 2012, 'II', 'Second Semester', 15, 50.6, 3.37, 1, 6, 6, 6),
('SA 20113155 ', 2013, 'III', 'Second Semester', 15, 50.6, 3.37, 1, 4, 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subjectID` int(11) NOT NULL AUTO_INCREMENT,
  `codeEnglish` varchar(20) DEFAULT NULL,
  `nameEnglish` varchar(100) DEFAULT NULL,
  `codeSinhala` varchar(30) DEFAULT NULL,
  `nameSinhala` varchar(200) DEFAULT NULL,
  `faculty` varchar(30) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `semester` varchar(20) NOT NULL,
  `creditHours` int(11) NOT NULL,
  `schCode` int(11) DEFAULT NULL,
  `isCompulsary` tinyint(1) NOT NULL,
  `suborder` int(11) NOT NULL,
  PRIMARY KEY (`subjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=343 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectID`, `codeEnglish`, `nameEnglish`, `codeSinhala`, `nameSinhala`, `faculty`, `level`, `description`, `semester`, `creditHours`, `schCode`, `isCompulsary`, `suborder`) VALUES
(265, 'PALI 11013 (C)', 'Pali Writing and Communicative Traditon', '', '', 'Language', 'One', '', 'First Semester', 3, 0, 0, 1),
(266, 'SINH  11013  (C) ', 'Introduction to Grammar and Language ', '', '', 'Language', 'One', '', 'First Semester', 3, 0, 0, 6),
(267, 'BUCU 11013 (C)', 'Buddhist Culture: Historical Background', '', '', 'Buddhist', 'One', '', 'First Semester', 3, 0, 0, 3),
(268, 'ARCH 11013 (C)', 'Origin and Expansion of Archaeology', '', '', 'Buddhist', 'One', '', 'First Semester', 3, 0, 0, 5),
(269, 'REST  11013  (C)', 'Introduction to Religious Studies', '', '', 'Buddhist', 'One', '', 'First Semester', 3, 0, 0, 4),
(270, 'PALI   12023 (C)', 'Content of Pali Literature', '', '', 'Language', 'One', '', 'Second Semester', 3, 0, 0, 0),
(271, 'BUCU 12023 (C)', 'Buddhist Culture : Fundamental Studies', '', '', 'Buddhist', 'One', '', 'Second Semester', 3, 0, 0, 0),
(272, 'ARCH 12023 (C)', 'Theories, Methods and  Practice  in Archaeology', '', '', 'Buddhist', 'One', '', 'Second Semester', 3, 0, 0, 0),
(273, 'REST  12023 (C)', 'Theoretical Approaches to Religious Studies', '', '', 'Buddhist', 'One', '', 'Second Semester', 3, 0, 0, 0),
(274, 'SINH  12023 (C)', 'Introduction to Sinhalese Literature ', '', '', 'Language', 'One', '', 'Second Semester', 3, 0, 0, 0),
(276, 'PALI   21033 (C)', 'Study of Pali Sources I - Philosophical Concepts', '', '', 'Language', 'Two', '', 'First Semester', 3, 0, 0, 0),
(277, 'PALI   21063 (C)', 'Religions Usage of Pali Language', '', '', 'Language', 'Two', '', 'First Semester', 3, 0, 0, 0),
(278, 'BUCU 21033 (C)', 'Sri Lankan Buddhist Tradition - Early Period ', '', '', 'Buddhist', 'Two', '', 'First Semester', 3, 0, 0, 0),
(279, 'BUCU 21043 (C)', 'Sri Lankan Buddhist Tradition - Modern Period', '', '', 'Buddhist', 'Two', '', 'First Semester', 3, 0, 0, 0),
(280, 'SINH  21043 (C)', 'World Literature', '', '', 'Language', 'Two', '', 'First Semester', 3, 0, 0, 0),
(281, 'SINH  21053 (C)', 'Sinhalese Novel', '', '', 'Language', 'Two', '', 'First Semester', 3, 0, 0, 0),
(282, 'PALI   22073 (C)', 'Pali Exegesis & Critical Methods ', '', '', 'Language', 'Two', '', 'Second Semester', 3, 0, 0, 0),
(283, 'PALI   22083 (C)', 'Composition and Language Diction', '', '', 'Language', 'Two', '', 'Second Semester', 3, 0, 0, 0),
(284, 'BUCU 22073 (C)', 'Buddhist Social Institutions and Monastic Administration', '', '', 'Buddhist', 'Two', '', 'Second Semester', 3, 0, 0, 0),
(285, 'BUCU 22083 (C) ', 'Geographical Expansion of Buddhism in South and                              South East Asia', '', '', 'Buddhist', 'Two', '', 'Second Semester', 3, 0, 0, 0),
(286, 'SINH  22073 (C)', 'Study of Sinhalese Folk Literature', '', '', 'Language', 'Two', '', 'Second Semester', 3, 0, 0, 0),
(287, 'SINH  22083 (C)', 'Sinhalese Short Story', '', '', 'Language', 'Two', '', 'Second Semester', 3, 0, 0, 0),
(288, 'PALI   31103 (C)', 'Study of Pali Sources II -  Methods of Buddhist Meditation', '', '', 'Language', 'Three', '', 'First Semester', 3, 0, 0, 0),
(289, 'PALI   31123 (C)', 'History of  Pali Literature II (Commentaries and           Sub-Commentaries)', '', '', 'Language', 'Three', '', 'First Semester', 3, 0, 0, 0),
(290, 'BUCU 31103 (C)', 'Buddhism and Aesthetics', '', '', 'Buddhist', 'Three', '', 'First Semester', 3, 0, 0, 0),
(291, 'BUCU 31113 (C)', 'Buddhism and Modern Challenges', '', '', 'Buddhist', 'Three', '', 'First Semester', 3, 0, 0, 0),
(292, 'SINH  31113 (C)', 'Classical Sinhalese Poetic Literature I', '', '', 'Language', 'Three', '', 'First Semester', 3, 0, 0, 0),
(293, 'SINH  31123 (C) ', 'Traditional and Contemporary Sinhalese Grammar', '', '', 'Language', 'Three', '', 'First Semester', 3, 0, 0, 0),
(294, 'PALI   32133 (C)', 'Study of Pali Sources III â€“ Performance of Disciplinary Rules (Vinaya-Karma) and Practical Aspects', '', '', 'Language', 'Three', '', 'Second Semester', 3, 0, 0, 0),
(295, 'PALI   32163 (C)', 'The Study of Prakrit and Inscriptions', '', '', 'Language', 'Three', '', 'Second Semester', 3, 0, 0, 0),
(296, 'BUCU 32133 (C)', 'Mahayana Buddhism', '', '', 'Buddhist', 'Three', '', 'Second Semester', 3, 0, 0, 0),
(297, 'BUCU 32143 (C)', 'Buddhist Art in Asia', '', '', 'Buddhist', 'Three', '', 'Second Semester', 3, 0, 0, 0),
(298, 'SINH  32133 (C)', 'Classical Sinhalese Prose Literature II', '', '', 'Language', 'Three', '', 'Second Semester', 3, 0, 0, 0),
(299, 'SINH  32153 (C) ', 'Criticism of Western Literature', '', '', 'Language', 'Three', '', 'Second Semester', 3, 0, 0, 0),
(300, 'BUCL  11011', 'Principles of Buddhist Psychotherapy', '', '', 'Buddhist', 'One', '', 'First Semester', 1, 0, 1, 8),
(301, 'BUCL  12021', 'Counseling Techniques and Skills', '', '', 'Buddhist', 'One', '', 'Second Semester', 1, 0, 1, 0),
(302, 'COEN  11011 ', 'Compulsory Course in English', '', '', 'Language', 'One', '', 'First Semester', 1, 0, 1, 9),
(303, 'COEN  12011 ', 'Compulsory Course in English', '', '', 'Language', 'One', '', 'Second Semester', 1, 0, 1, 0),
(304, 'BUPH 11013 (C)', 'Buddhist Philosophy-Indian Background', '', '', 'Buddhist', 'One', '', 'First Semester', 3, 0, 0, 2),
(305, 'ENGL 11013 (C) ', 'Advanced Reading and Writing Skills ', '', '', 'Language', 'One', '', 'First Semester', 3, 0, 0, 7),
(306, 'ENGL 12023 (C) ', 'Introduction to Literary Criticism ', '', '', 'Language', 'One', '', 'Second Semester', 3, 0, 0, 0),
(307, 'BUPH 21033 (C)', 'Buddhist Moral Philosophy  ', '', '', 'Buddhist', 'Two', '', 'First Semester', 3, 0, 0, 0),
(308, 'BUPH 21043 (C)', 'Schools of Buddhist Philosophy I ', '', '', 'Buddhist', 'Two', '', 'First Semester', 3, 0, 0, 0),
(309, 'ENGL 21033 (C)', 'Poetry', '', '', 'Language', 'Two', '', 'First Semester', 3, 0, 0, 0),
(310, 'ENGL 21043 (C)', 'Making of English and its Structure ', '', '', 'Language', 'Two', '', 'First Semester', 3, 0, 0, 0),
(311, 'BUPH 22073 (C)', 'Schools of Buddhist Philosophy II', '', '', 'Buddhist', 'Two', '', 'Second Semester', 3, 0, 0, 0),
(312, 'BUPH 22083 (C)', 'Buddhist Social Philosophy', '', '', 'Buddhist', 'Two', '', 'Second Semester', 3, 0, 0, 0),
(313, 'ENGL 22073 (C)', 'Introduction to History of English Literature I', '', '', 'Language', 'Two', '', 'Second Semester', 3, 0, 0, 0),
(314, 'ENGL 22083 (C)', 'Fiction', '', '', 'Language', 'Two', '', 'Second Semester', 3, 0, 0, 0),
(315, 'BUPH 31103 (C)', 'Buddhist Psychology', '', '', 'Buddhist', 'Three', '', 'First Semester', 3, 0, 0, 0),
(316, 'BUPH 31113 (C) ', 'Buddhist Epistemology', '', '', 'Buddhist', 'Three', '', 'First Semester', 3, 0, 0, 0),
(317, 'ENGL 31103 (C)', 'Approaches & Methods in English Language Teaching ', '', '', 'Language', 'Three', '', 'First Semester', 3, 0, 0, 0),
(318, 'ENGL 31113 (C)', 'Introduction to History of English Literature II', '', '', 'Language', 'Three', '', 'First Semester', 3, 0, 0, 0),
(319, 'BUPH 32133 (C)', 'Abhidhamma Studies I (TheravÃ da)', '', '', 'Buddhist', 'Three', '', 'Second Semester', 3, 0, 0, 0),
(320, 'BUPH 32143 (C)', 'Contemporary Social Issues and Buddhism', '', '', 'Buddhist', 'Three', '', 'Second Semester', 3, 0, 0, 0),
(321, 'ENGL 32133 (C) ', 'Drama', '', '', 'Language', 'Three', '', 'Second Semester', 3, 0, 0, 0),
(322, 'ENGL 32143 (C) ', 'Internship & Electronic Portfolio in English Language Teaching', '', '', 'Language', 'Three', '', 'Second Semester', 3, 0, 0, 0),
(324, 'BUCL  12021', 'Counseling Techniques and Skills', '', '', 'Buddhist', 'One', '', 'Second Semester', 1, 0, 1, 0),
(325, 'PCEN  11323', 'Preliminary Course in English', '', '', 'Language', 'One', '', 'First Semester', 3, 0, 1, 11),
(326, 'PCEN  12333 ', 'Preliminary Course in English', '', '', 'Language', 'One', '', 'Second Semester', 3, 0, 1, 0),
(327, 'JPNL 31133 (A)', 'Japanese Grammar and Language III ', '', '', 'Language', 'Three', '', 'First Semester', 0, 0, 0, 0),
(328, 'JPNL 32163 (A)', 'Japanese Culture and Oral Expression III ', '', '', 'Language', 'Three', '', 'Second Semester', 0, 0, 0, 0),
(329, 'BUPH 12023 (C)', 'Study of Early Buddhist Doctrines-', '', '', 'Buddhist', 'One', '', 'Second Semester', 3, 0, 0, 0),
(330, 'ARCH 21033 (C)', 'Epigraphy and Palaeography ', '', '', 'Buddhist', 'Two', '', 'First Semester', 3, 0, 0, 0),
(331, 'ARCH 21043 (C) ', 'The Historical Chronology of Sri Lanka', '', '', 'Buddhist', 'Two', '', 'First Semester', 3, 0, 0, 0),
(332, 'ARCH 22073 (C)', 'The Buddhist Art in South Asia', '', '', 'Buddhist', 'Two', '', 'Second Semester', 3, 0, 0, 0),
(333, 'ARCH 22083 (C) ', 'Numismatics ', '', '', 'Buddhist', 'Two', '', 'Second Semester', 3, 0, 0, 0),
(334, 'ARCH 31103 (C)', 'Indian Architecture', '', '', 'Buddhist', 'Three', '', 'First Semester', 3, 0, 0, 0),
(335, 'ARCH 31113 (C)', 'Sri Lankan History', '', '', 'Buddhist', 'Three', '', 'First Semester', 3, 0, 0, 0),
(336, 'ARCH 32133 (C) ', 'Arts & Crafts of Sri Lanka', '', '', 'Buddhist', 'Three', '', 'Second Semester', 3, 0, 0, 0),
(337, 'ARCH 32143 (C)', 'Indian  History', '', '', 'Buddhist', 'Three', '', 'Second Semester', 3, 0, 0, 0),
(338, 'CMLS 11013 (C)', 'Life of the Buddha,Community Leadership and Community Service ', '', '', 'Buddhist', 'I', '', 'Frist Semester', 3, NULL, 0, 0),
(339, 'BPCL  11013', 'Buddhist Psychology', 'BPCL  11013', '', 'Buddhist', 'I', '', 'Frist Semester', 3, NULL, 0, 0),
(340, 'ENGL  11023', 'Basic of Literary Interpretation I', '', '', 'Language', 'I', '', 'Frist Semester', 3, NULL, 0, 0),
(341, 'PCEN  11033', 'Preliminary Course in English', '', '', 'Language', 'I', '', 'Frist Semester', 3, NULL, 0, 0),
(342, 'TAMI 11013', 'Tamil Grammar and Advanced Tamil Writing I', '', '', 'Language', 'I', '', 'Frist Semester', 3, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE IF NOT EXISTS `timeslot` (
  `slotID` int(11) NOT NULL,
  `dayOfWeekE` varchar(20) NOT NULL,
  `dayOfWeekS` varchar(40) NOT NULL,
  `timeSlot` varchar(20) NOT NULL,
  PRIMARY KEY (`slotID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`slotID`, `dayOfWeekE`, `dayOfWeekS`, `timeSlot`) VALUES
(1, 'Monday', 'à·ƒà¶¯à·”à¶¯à·', '8.30-9.30 a.m'),
(2, 'Monday', 'à·ƒà¶¯à·”à¶¯à·', '9.30-10.30 a.m'),
(3, 'Monday', 'à·ƒà¶¯à·”à¶¯à·', '10.30-11.30 a.m'),
(4, 'Monday', 'à·ƒà¶¯à·”à¶¯à·', '12.30-01.30 p.m'),
(5, 'Monday', 'à·ƒà¶¯à·”à¶¯à·', '01.30-02.30 p.m'),
(6, 'Monday', 'à·ƒà¶¯à·”à¶¯à·', '02.30-03.30 p.m'),
(7, 'Monday', 'à·ƒà¶¯à·”à¶¯à·', '03.30-04.30 p.m'),
(8, 'Tuesday', 'à¶…à¶œà·„à¶»à·à·€à·à¶¯à·', '8.30-9.30 a.m'),
(9, 'Tuesday', 'à¶…à¶œà·„à¶»à·à·€à·à¶¯à·', '9.30-10.30 a.m'),
(10, 'Tuesday', 'à¶…à¶œà·„à¶»à·à·€à·à¶¯à·', '10.30-11.30 a.m'),
(11, 'Tuesday', 'à¶…à¶œà·„à¶»à·à·€à·à¶¯à·', '12.30-01.30 p.m'),
(12, 'Tuesday', 'à¶…à¶œà·„à¶»à·à·€à·à¶¯à·', '01.30-02.30 p.m'),
(13, 'Tuesday', 'à¶…à¶œà·„à¶»à·à·€à·à¶¯à·', '02.30-03.30 p.m'),
(14, 'Tuesday', 'à¶…à¶œà·„à¶»à·à·€à·à¶¯à·', '03.30-04.30 p.m'),
(15, 'Wednesday', 'à¶¶à¶¯à·à¶¯à·', '8.30-9.30 a.m'),
(16, 'Wednesday', 'à¶¶à¶¯à·à¶¯à·', '9.30-10.30 a.m'),
(17, 'Wednesday', 'à¶¶à¶¯à·à¶¯à·', '10.30-11.30 a.m'),
(18, 'Wednesday', 'à¶¶à¶¯à·à¶¯à·', '12.30-01.30 p.m'),
(19, 'Wednesday', 'à¶¶à¶¯à·à¶¯à·', '02.30-03.30 p.m'),
(20, 'Wednesday', 'à¶¶à¶¯à·à¶¯à·', '03.30-04.30 p.m'),
(21, 'Thursday', 'à¶¶à·„à·ƒà·Šà¶´à¶­à·’à¶±à·Šà¶¯à·', '8.30-9.30 a.m'),
(22, 'Thursday', 'à¶¶à·„à·ƒà·Šà¶´à¶­à·’à¶±à·Šà¶¯à·', '9.30-10.30 a.m'),
(23, 'Thursday', 'à¶¶à·„à·ƒà·Šà¶´à¶­à·’à¶±à·Šà¶¯à·', '12.30-01.30 p.m'),
(24, 'Thursday', 'à¶¶à·„à·ƒà·Šà¶´à¶­à·’à¶±à·Šà¶¯à·', '01.30-02.30 p.m'),
(25, 'Thursday', 'à¶¶à·„à·ƒà·Šà¶´à¶­à·’à¶±à·Šà¶¯à·', '02.30-03.30 p.m'),
(26, 'Thursday', 'à¶¶à·„à·ƒà·Šà¶´à¶­à·’à¶±à·Šà¶¯à·', '03.30-04.30 p.m'),
(27, 'Friday', 'à·ƒà·’à¶šà·”à¶»à·à¶¯à·', '8.30-9.30 a.m'),
(28, 'Friday', 'à·ƒà·’à¶šà·”à¶»à·à¶¯à·', '9.30-10.30 a.m'),
(29, 'Friday', 'à·ƒà·’à¶šà·”à¶»à·à¶¯à·', '10.30-11.30 a.m'),
(30, 'Friday', 'à·ƒà·’à¶šà·”à¶»à·à¶¯à·', '12.30-01.30 p.m'),
(31, 'Friday', 'à·ƒà·’à¶šà·”à¶»à·à¶¯à·', '12.30-01.30 p.m'),
(32, 'Friday', 'à·ƒà·’à¶šà·”à¶»à·à¶¯à·', '02.30-03.30 p.m'),
(33, 'Friday', 'à·ƒà·’à¶šà·”à¶»à·à¶¯à·', '03.30-04.30 p.m');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
  `subjectID` int(11) NOT NULL,
  `venueNo` varchar(10) NOT NULL,
  `epfNo` varchar(20) NOT NULL,
  `slotID` int(11) NOT NULL,
  `medium` varchar(10) NOT NULL,
  PRIMARY KEY (`subjectID`,`venueNo`,`epfNo`,`slotID`),
  KEY `FK_timetable_lecturer` (`epfNo`),
  KEY `FK_timetable_venue` (`venueNo`),
  KEY `FK_timetable_timeslot` (`slotID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `password`) VALUES
('admin', '1234'),
('examination', '1234'),
('registration', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE IF NOT EXISTS `venue` (
  `venueNo` varchar(10) NOT NULL,
  `venue` varchar(20) NOT NULL,
  PRIMARY KEY (`venueNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicantpali`
--
ALTER TABLE `applicantpali`
  ADD CONSTRAINT `applicantpali_ibfk_1` FOREIGN KEY (`appNo`) REFERENCES `localapplicant` (`appNo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_applicantpali_paliqualification` FOREIGN KEY (`code`) REFERENCES `paliqualification` (`code`) ON UPDATE CASCADE;

--
-- Constraints for table `applicantsubjects`
--
ALTER TABLE `applicantsubjects`
  ADD CONSTRAINT `applicantsubjects_ibfk_1` FOREIGN KEY (`subjectCode`) REFERENCES `alsubjects` (`subjectCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `applicantsubjects_ibfk_2` FOREIGN KEY (`appNo`) REFERENCES `localapplicant` (`appNo`) ON UPDATE CASCADE;

--
-- Constraints for table `exameffort`
--
ALTER TABLE `exameffort`
  ADD CONSTRAINT `FK_exameffort_studentenrolment1` FOREIGN KEY (`indexNo`, `subjectID`) REFERENCES `studentenrolment` (`indexNo`, `subjectID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `examschedule`
--
ALTER TABLE `examschedule`
  ADD CONSTRAINT `examschedule_ibfk_1` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`subjectID`) ON UPDATE CASCADE;

--
-- Constraints for table `foreignapplicant`
--
ALTER TABLE `foreignapplicant`
  ADD CONSTRAINT `foreignapplicant_ibfk_1` FOREIGN KEY (`appNo`) REFERENCES `applicant` (`appNo`) ON UPDATE CASCADE;

--
-- Constraints for table `foreignsubjects`
--
ALTER TABLE `foreignsubjects`
  ADD CONSTRAINT `foreignsubjects_ibfk_1` FOREIGN KEY (`appNo`) REFERENCES `foreignapplicant` (`appNo`) ON UPDATE CASCADE;

--
-- Constraints for table `localapplicant`
--
ALTER TABLE `localapplicant`
  ADD CONSTRAINT `localapplicant_ibfk_1` FOREIGN KEY (`appNo`) REFERENCES `applicant` (`appNo`) ON UPDATE CASCADE;

--
-- Constraints for table `privillege`
--
ALTER TABLE `privillege`
  ADD CONSTRAINT `privillege_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `privillege_ibfk_2` FOREIGN KEY (`pageID`) REFERENCES `page` (`pageID`) ON UPDATE CASCADE;

--
-- Constraints for table `studentenrolment`
--
ALTER TABLE `studentenrolment`
  ADD CONSTRAINT `FK_studentenrolment_student` FOREIGN KEY (`indexNo`) REFERENCES `student` (`indexNo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_studentenrolment_subject` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`subjectID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `FK_timetable_lecturer` FOREIGN KEY (`epfNo`) REFERENCES `lecturer` (`epfNo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_timetable_subject` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`subjectID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_timetable_venue` FOREIGN KEY (`venueNo`) REFERENCES `venue` (`venueNo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`slotID`) REFERENCES `timeslot` (`slotID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

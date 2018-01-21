-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 28, 2017 at 08:30 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tpc`
--

-- --------------------------------------------------------

--
-- Table structure for table `temp_tpc_students`
--

CREATE TABLE IF NOT EXISTS `temp_tpc_students` (
  `stu_id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_email` varchar(30) NOT NULL,
  `stu_password` varchar(60) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `father_name` varchar(30) NOT NULL,
  `mother_name` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `gender` char(1) NOT NULL,
  `category` varchar(12) NOT NULL,
  `mobile` int(10) NOT NULL,
  `rollno` varchar(9) NOT NULL,
  `course` varchar(10) NOT NULL,
  `branch` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `dept` varchar(30) NOT NULL,
  `cgpa` decimal(5,2) NOT NULL,
  `be_pass_year` int(4) NOT NULL,
  `twelveth_marks` decimal(5,2) NOT NULL,
  `twelveth_year` int(4) NOT NULL,
  `tenth_marks` decimal(5,2) NOT NULL,
  `tenth_year` int(4) NOT NULL,
  `projects` varchar(150) NOT NULL,
  `certification` varchar(150) DEFAULT NULL,
  `tech_used` varchar(100) NOT NULL,
  `internship_1` varchar(100) DEFAULT NULL,
  `internship_2` varchar(100) NOT NULL,
  `internship_3` varchar(100) NOT NULL,
  `address` varchar(120) NOT NULL,
  `reappear` int(1) DEFAULT '0',
  `debarred` char(1) DEFAULT 'N',
  `email_verified` char(1) DEFAULT 'N',
  `student_verified` char(1) DEFAULT 'N',
  `hash` varchar(60) NOT NULL,
  `timestamp_email` varchar(30) NOT NULL,
  `proj_research` tinyint(1) NOT NULL DEFAULT '0',
  `proj_web_development` tinyint(1) NOT NULL DEFAULT '0',
  `proj_android_app` tinyint(1) NOT NULL DEFAULT '0',
  `proj_software_dev` tinyint(1) NOT NULL DEFAULT '0',
  `proj_others` tinyint(1) NOT NULL DEFAULT '0',
  `certi_linux` tinyint(1) NOT NULL DEFAULT '0',
  `certi_database` tinyint(1) NOT NULL DEFAULT '0',
  `certi_networking` tinyint(1) NOT NULL DEFAULT '0',
  `certi_soft_skills` tinyint(1) NOT NULL DEFAULT '0',
  `certi_others` tinyint(1) NOT NULL DEFAULT '0',
  `tech_c` tinyint(1) NOT NULL DEFAULT '0',
  `tech_cpp` tinyint(1) NOT NULL DEFAULT '0',
  `tech_java` tinyint(1) NOT NULL DEFAULT '0',
  `tech_android` tinyint(1) NOT NULL DEFAULT '0',
  `tech_python` tinyint(1) NOT NULL DEFAULT '0',
  `tech_front_end_dev` tinyint(1) NOT NULL DEFAULT '0',
  `tech_back_end_dev` tinyint(1) NOT NULL DEFAULT '0',
  `tech_sql` tinyint(1) NOT NULL DEFAULT '0',
  `tech_embedded_prog` tinyint(1) NOT NULL DEFAULT '0',
  `tech_matlab` tinyint(1) NOT NULL DEFAULT '0',
  `tech_r_prog` tinyint(1) NOT NULL DEFAULT '0',
  `tech_others` tinyint(1) NOT NULL DEFAULT '0',
  `summer_first_year` tinyint(1) DEFAULT NULL,
  `summer_second_year` tinyint(1) NOT NULL DEFAULT '0',
  `summer_third_year` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`stu_id`),
  UNIQUE KEY `rollno` (`rollno`),
  KEY `debarred` (`debarred`),
  KEY `debarred_2` (`debarred`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `temp_tpc_students`
--

INSERT INTO `temp_tpc_students` (`stu_id`, `stu_email`, `stu_password`, `first_name`, `last_name`, `father_name`, `mother_name`, `dob`, `gender`, `category`, `mobile`, `rollno`, `course`, `branch`, `semester`, `dept`, `cgpa`, `be_pass_year`, `twelveth_marks`, `twelveth_year`, `tenth_marks`, `tenth_year`, `projects`, `certification`, `tech_used`, `internship_1`, `internship_2`, `internship_3`, `address`, `reappear`, `debarred`, `email_verified`, `student_verified`, `hash`, `timestamp_email`, `proj_research`, `proj_web_development`, `proj_android_app`, `proj_software_dev`, `proj_others`, `certi_linux`, `certi_database`, `certi_networking`, `certi_soft_skills`, `certi_others`, `tech_c`, `tech_cpp`, `tech_java`, `tech_android`, `tech_python`, `tech_front_end_dev`, `tech_back_end_dev`, `tech_sql`, `tech_embedded_prog`, `tech_matlab`, `tech_r_prog`, `tech_others`, `summer_first_year`, `summer_second_year`, `summer_third_year`) VALUES
(3, 'rajat@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Rajat', 'Kalyan', 'ABC ', 'XYZ', '1995-12-30', 'M', 'Unreserved', 2147483647, 'rajat', 'be', 'cse', 'Sixth', 'uiet', '8.00', 2017, '89.00', 2013, '90.00', 2012, 'Automation            \r\n            ', 'Others', '            \r\n            ', ' \r\n            ', 'Infogain            \r\n            ', 'Infogain            \r\n            ', 'Karnal            ', 0, 'N', 'Y', 'Y', 'cfcd208495d565ef66e7dff9f98764da', '1509799368', 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tpc_company`
--

CREATE TABLE IF NOT EXISTS `tpc_company` (
  `comp_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_ntid` varchar(12) NOT NULL,
  `comp_name` varchar(30) NOT NULL,
  `comp_email` varchar(30) NOT NULL,
  `arrival_date` date NOT NULL,
  `branch_cse` char(1) DEFAULT 'Y',
  `branch_ece` char(1) DEFAULT 'Y',
  `branch_mech` char(1) DEFAULT 'Y',
  `branch_it` char(1) DEFAULT 'Y',
  `branch_eee` char(1) DEFAULT 'Y',
  `branch_bio` char(1) DEFAULT 'Y',
  `type` varchar(30) NOT NULL,
  `package` decimal(10,2) DEFAULT NULL,
  `stipend` decimal(10,0) DEFAULT NULL,
  `job_profile` varchar(50) NOT NULL,
  `location` varchar(10) NOT NULL,
  `min_qual` varchar(30) NOT NULL,
  `cgpa` decimal(4,2) NOT NULL,
  `twelveth_marks` decimal(5,2) DEFAULT NULL,
  `tenth_marks` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`comp_id`),
  UNIQUE KEY `c_ntid` (`c_ntid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `tpc_company`
--

INSERT INTO `tpc_company` (`comp_id`, `c_ntid`, `comp_name`, `comp_email`, `arrival_date`, `branch_cse`, `branch_ece`, `branch_mech`, `branch_it`, `branch_eee`, `branch_bio`, `type`, `package`, `stipend`, `job_profile`, `location`, `min_qual`, `cgpa`, `twelveth_marks`, `tenth_marks`) VALUES
(1, 'c_infosys', 'infosys', 'info@infosys.com', '2019-01-02', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'non-core', '3.25', '10000', 'System Engineer', 'Mysore', 'be', '7.00', '90.00', '90.00'),
(2, 'c_jugnoo', 'jugnoo', 'jug@jugnoo.in', '2018-01-02', 'Y', 'N', 'Y', 'Y', 'Y', 'N', 'core', '8.00', '8000', 'software developer', 'Chandigarh', 'be', '7.00', '80.00', '85.00'),
(3, 'c_optum', 'Optum Global Solutions', 'optum@unitedhealth.com', '2018-01-02', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'non-core', '7.50', NULL, 'Business Analyst', 'Banglore', 'be', '7.00', '90.00', '90.00'),
(4, 'c_clicklab', 'clicklab', 'click@clicklab.com', '2017-08-09', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'core', '4.00', '10000', 'software developer', 'Chandigarh', 'be', '7.00', '80.00', '85.00'),
(5, 'c_deloitte', 'deloitte', 'deloitte@gmail.com', '2017-06-02', 'Y', 'N', 'N', 'Y', 'Y', 'N', 'consultancy', '5.00', NULL, 'Business Analyst', 'Banglore', 'be', '7.00', '80.00', '90.00'),
(13, 'c_zassociate', 'Z Associate', 'zass@gmail.com', '2017-01-01', 'Y', 'N', 'N', 'Y', 'Y', 'Y', 'consultancy', '5.58', NULL, 'Business Analyst', 'delhi', 'be', '7.00', '80.00', '80.00'),
(14, 'c_sufi', 'sufi', 'sufi@gmail.com', '2019-01-02', 'Y', 'N', 'N', 'Y', 'Y', 'Y', 'core', '4.00', '15000', 'software developer', 'Kolkata', 'be', '7.00', '80.00', '80.00'),
(15, 'c_gemini', 'Gemini Solutions', 'gemini@gmail.com', '2017-12-31', 'Y', 'N', 'Y', 'N', 'Y', 'Y', 'core', '5.80', '10000', 'software developer , business analyst', 'Chandigarh', 'be', '7.00', '80.00', '85.00'),
(23, 'c_unisys', 'unisys', 'unisys@gmail.com', '2017-12-31', 'Y', 'N', 'N', 'N', 'N', 'N', 'core', '6.50', NULL, 'Sogtware Developer', 'Banglore', 'be', '7.00', '90.00', '90.00'),
(24, 'c_nagaro', 'Nagaro', 'nagaro@gmail.com', '2016-01-02', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'core', '4.00', '15000', 'Software Engineer', 'Gurgoan', 'be', '7.00', '75.00', '75.00'),
(25, 'c_ascentx', 'Ascentx', 'ascentx@gmail.com', '2016-01-02', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'core', '6.00', '15000', 'Software Engineer', 'Chandigarh', 'be', '7.00', '75.00', '75.00');

-- --------------------------------------------------------

--
-- Table structure for table `tpc_predict_placement`
--

CREATE TABLE IF NOT EXISTS `tpc_predict_placement` (
  `p_no` int(11) NOT NULL AUTO_INCREMENT,
  `p_stu_id` int(5) NOT NULL,
  `proj_research` tinyint(1) NOT NULL DEFAULT '0',
  `proj_web_development` tinyint(1) NOT NULL DEFAULT '0',
  `proj_android_app` tinyint(1) NOT NULL DEFAULT '0',
  `proj_software_dev` tinyint(1) NOT NULL DEFAULT '0',
  `proj_others` tinyint(1) NOT NULL DEFAULT '0',
  `certi_linux` tinyint(1) NOT NULL DEFAULT '0',
  `certi_database` tinyint(1) NOT NULL DEFAULT '0',
  `certi_networking` tinyint(1) NOT NULL DEFAULT '0',
  `certi_soft_skills` tinyint(1) NOT NULL DEFAULT '0',
  `certi_others` tinyint(1) NOT NULL DEFAULT '0',
  `tech_c` tinyint(1) NOT NULL DEFAULT '0',
  `tech_cpp` tinyint(1) NOT NULL DEFAULT '0',
  `tech_java` tinyint(1) NOT NULL DEFAULT '0',
  `tech_android` tinyint(1) NOT NULL DEFAULT '0',
  `tech_python` tinyint(1) NOT NULL DEFAULT '0',
  `tech_front_end_dev` tinyint(1) NOT NULL DEFAULT '0',
  `tech_back_end_dev` tinyint(1) NOT NULL DEFAULT '0',
  `tech_sql` tinyint(1) NOT NULL DEFAULT '0',
  `tech_embedded_prog` tinyint(1) NOT NULL DEFAULT '0',
  `tech_matlab` tinyint(1) NOT NULL DEFAULT '0',
  `tech_r_prog` tinyint(1) NOT NULL DEFAULT '0',
  `tech_others` tinyint(1) NOT NULL DEFAULT '0',
  `summer_first_year` tinyint(1) DEFAULT NULL,
  `summer_second_year` tinyint(1) NOT NULL DEFAULT '0',
  `summer_third_year` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`p_no`),
  KEY `p_stu_id` (`p_stu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tpc_predict_placement`
--

INSERT INTO `tpc_predict_placement` (`p_no`, `p_stu_id`, `proj_research`, `proj_web_development`, `proj_android_app`, `proj_software_dev`, `proj_others`, `certi_linux`, `certi_database`, `certi_networking`, `certi_soft_skills`, `certi_others`, `tech_c`, `tech_cpp`, `tech_java`, `tech_android`, `tech_python`, `tech_front_end_dev`, `tech_back_end_dev`, `tech_sql`, `tech_embedded_prog`, `tech_matlab`, `tech_r_prog`, `tech_others`, `summer_first_year`, `summer_second_year`, `summer_third_year`) VALUES
(1, 1, 0, 1, 0, 1, 0, 0, 0, 0, 1, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 0, NULL, 1, 1),
(2, 2, 1, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(3, 3, 0, 0, 1, 0, 1, 0, 0, 0, 1, 0, 1, 1, 0, 1, 1, 0, 0, 1, 0, 1, 0, 0, NULL, 0, 0),
(4, 4, 0, 0, 1, 1, 0, 0, 0, 0, 1, 0, 0, 1, 0, 1, 0, 0, 1, 0, 1, 0, 1, 0, NULL, 0, 1),
(5, 5, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, NULL, 1, 1),
(6, 6, 1, 1, 0, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, NULL, 1, 1),
(7, 7, 0, 0, 1, 1, 0, 0, 1, 0, 1, 0, 0, 0, 1, 1, 1, 1, 1, 0, 1, 0, 1, 0, NULL, 0, 0),
(8, 8, 1, 1, 0, 1, 1, 0, 1, 0, 1, 0, 0, 1, 0, 1, 1, 0, 1, 0, 1, 0, 1, 0, NULL, 0, 1),
(9, 9, 1, 0, 1, 1, 1, 1, 0, 0, 1, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 0, NULL, 0, 1),
(10, 10, 1, 1, 1, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1),
(11, 11, 1, 1, 0, 1, 1, 0, 0, 0, 1, 0, 1, 1, 0, 1, 0, 1, 0, 0, 0, 1, 1, 0, NULL, 1, 0),
(12, 12, 0, 1, 1, 1, 1, 0, 0, 0, 1, 0, 1, 0, 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, NULL, 0, 1),
(14, 13, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 1, 0, 0, 1, 1, 1, 0, 0, 0, 0, NULL, 0, 1),
(15, 14, 0, 0, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0),
(16, 15, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tpc_students`
--

CREATE TABLE IF NOT EXISTS `tpc_students` (
  `stu_id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_email` varchar(30) NOT NULL,
  `stu_password` varchar(60) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `father_name` varchar(30) NOT NULL,
  `mother_name` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `gender` char(1) NOT NULL,
  `category` varchar(12) NOT NULL,
  `mobile` int(10) NOT NULL,
  `rollno` varchar(9) NOT NULL,
  `course` varchar(10) NOT NULL,
  `branch` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `dept` varchar(30) NOT NULL,
  `cgpa` decimal(5,2) NOT NULL,
  `be_pass_year` int(4) NOT NULL,
  `twelveth_marks` decimal(5,2) NOT NULL,
  `twelveth_year` int(4) NOT NULL,
  `tenth_marks` decimal(5,2) NOT NULL,
  `tenth_year` int(4) NOT NULL,
  `projects` varchar(150) NOT NULL,
  `certification` varchar(150) DEFAULT NULL,
  `tech_used` varchar(100) NOT NULL,
  `internship_1` varchar(100) DEFAULT NULL,
  `internship_2` varchar(100) NOT NULL,
  `internship_3` varchar(100) NOT NULL,
  `address` varchar(120) NOT NULL,
  `reappear` int(1) DEFAULT '0',
  `debarred` char(1) DEFAULT 'N',
  `imagename` varchar(50) DEFAULT NULL,
  `imagepath` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`stu_id`),
  UNIQUE KEY `rollno` (`rollno`),
  UNIQUE KEY `stu_email` (`stu_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tpc_students`
--

INSERT INTO `tpc_students` (`stu_id`, `stu_email`, `stu_password`, `first_name`, `last_name`, `father_name`, `mother_name`, `dob`, `gender`, `category`, `mobile`, `rollno`, `course`, `branch`, `semester`, `dept`, `cgpa`, `be_pass_year`, `twelveth_marks`, `twelveth_year`, `tenth_marks`, `tenth_year`, `projects`, `certification`, `tech_used`, `internship_1`, `internship_2`, `internship_3`, `address`, `reappear`, `debarred`, `imagename`, `imagepath`) VALUES
(1, 'aashish@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Aashish', 'Verma', 'harry', 'Marry', '1995-12-31', 'M', 'Unreserved', 2147483647, 'ue133001', 'me', 'cse', 'Sixth', 'uiet', '7.00', 2017, '89.00', 2013, '86.00', 2011, 'Stastics            \r\n            ', NULL, 'C, C++, Python, Java, javaScipt', NULL, 'NIT', 'InfoGain', 'Chandigarh            ', 0, 'N', 'aish.jpg', '/opt/lampp/htdocs/tpc/uploads/'),
(2, 'abdul@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Abdul', 'Shakil Ahmed', 'C', 'C', '1996-08-05', 'M', 'Unreserved', 2147483647, 'ue133002', 'be', 'cse', 'Sixth', 'uiet', '3.77', 2017, '89.00', 2013, '86.00', 2011, 'Acoustics', NULL, 'C++,Java', 'PEC', 'NIT', 'INfoGain', 'Chadnigarh', 2, 'N', 'images.jpeg', '/opt/lampp/htdocs/tpc/uploads/'),
(3, 'abhinavn@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Abhinav', 'Nayyar', 'C3', 'C3', '1996-08-05', 'M', 'Unreserved', 2147483647, 'ue133003', 'be', 'cse', 'Sixth', 'uiet', '9.16', 2017, '89.00', 2013, '86.00', 2011, 'Acoustics', NULL, 'C++,Java', 'PEC', 'NIT', 'INfoGain', 'Chandigarh', 0, 'N', 'aish.jpeg', '/opt/lampp/htdocs/tpc/uploads/'),
(4, 'abhinavs@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Abhinav', 'Sombhansi', 'C4', 'C4', '1996-08-05', 'M', 'Unreserved', 2147483647, 'ue133004', 'be', 'cse', 'Sixth', 'uiet', '8.30', 2017, '89.00', 2013, '86.00', 2011, 'Acoustics', NULL, 'C++,Java', 'PEC', 'NIT', 'INfoGain', 'Chandigarh', 0, 'N', 'katrina2.jpg', '/opt/lampp/htdocs/tpc/uploads/'),
(5, 'abhishek@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Abhishek', 'Gupta', 'C5', 'C5', '1996-08-05', 'M', 'Unreserved', 2147483647, 'ue133005', 'be', 'cse', 'Sixth', 'uiet', '8.90', 2017, '89.00', 2013, '86.00', 2011, 'Acoustics', NULL, 'C++,Java', 'PEC', 'NIT', 'INfoGain', 'Chandigarh', 0, 'N', 'karishma2.jpeg', '/opt/lampp/htdocs/tpc/uploads/'),
(6, 'aditi@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Aditi', 'Garg', 'C6', 'C6', '1996-08-05', 'F', 'Unreserved', 2147483647, 'ue133006', 'be', 'cse', 'Sixth', 'uiet', '9.06', 2017, '89.00', 2013, '86.00', 2011, 'Acoustics', NULL, 'C++,Java', 'PEC', 'NIT', 'INfoGain', 'Chandigarh', 0, 'N', 'karishma3.jpeg', '/opt/lampp/htdocs/tpc/uploads/'),
(7, 'ajay@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Ajay', 'Sharma', 'C7', 'C7', '1996-08-05', 'M', 'Unreserved', 2147483647, 'ue133007', 'be', 'cse', 'Sixth', 'uiet', '8.50', 2017, '89.00', 2013, '86.00', 2011, 'Acoustics', NULL, 'C++,Java', 'PEC', 'NIT', 'INfoGain', 'Chandigarh', 0, 'N', 'karishma2.jpeg', '/opt/lampp/htdocs/tpc/uploads/'),
(8, 'akshat@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Akshat', 'Jain', 'C8', 'C8', '1996-08-05', 'M', 'Unreserved', 2147483647, 'ue133008', 'be', 'cse', 'Sixth', 'uiet', '9.04', 2017, '89.00', 2013, '86.00', 2011, 'Acoustics', NULL, 'C++,Java', 'PEC', 'NIT', 'INfoGain', 'Chandigarh', 0, 'N', 'shruti2.jpeg', '/opt/lampp/htdocs/tpc/uploads/'),
(9, 'akshay@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Akshay', 'Kuchchal', 'C9', 'C9', '1996-08-05', 'M', 'Unreserved', 2147483647, 'ue133010', 'be', 'cse', 'Sixth', 'uiet', '8.83', 2017, '89.00', 2013, '86.00', 2011, 'Acoustics', NULL, 'C++,Java', 'PEC', 'NIT', 'INfoGain', 'Chandigarh', 0, 'N', 'shruti3.jpeg', '/opt/lampp/htdocs/tpc/uploads/'),
(10, 'akshay1@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Akshay', 'Sharma', 'C10', 'C10', '1996-08-05', 'M', 'Unreserved', 2147483647, 'ue133011', 'be', 'cse', 'Sixth', 'uiet', '8.06', 2017, '89.00', 2013, '86.00', 2011, 'Acoustics', NULL, 'C++,Java', 'PEC', 'NIT', 'INfoGain', 'Chandigarh', 0, 'N', 'shruti.jpeg', '/opt/lampp/htdocs/tpc/uploads/'),
(11, 'aman@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Amandeep', 'Singh Saini', 'C11', 'C11', '1996-08-05', 'M', 'Unreserved', 2147483647, 'ue133012', 'be', 'cse', 'Sixth', 'uiet', '8.20', 2017, '89.00', 2013, '86.00', 2011, 'Acoustics', NULL, 'C++,Java', 'PEC', 'NIT', 'INfoGain', 'Chandigarh', 0, 'N', 'katrina.jpeg', '/opt/lampp/htdocs/tpc/uploads/'),
(12, 'amrita@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Amrita', 'Sawhney', 'C12', 'C12', '1996-08-05', 'F', 'Unreserved', 2147483647, 'ue133013', 'be', 'cse', 'Sixth', 'uiet', '8.22', 2017, '89.00', 2013, '86.00', 2011, 'Acoustics', NULL, 'C++,Java', 'PEC', 'NIT', 'INfoGain', 'Chandigarh', 0, 'N', NULL, NULL),
(13, 'ankit@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Ankit', 'Kumar', 'hari', 'Om', '1996-12-30', 'M', 'Unreserved', 2147483647, 'ue133014', 'be', 'cse', 'Sixth', 'uiet', '8.68', 2018, '90.00', 2014, '89.00', 2013, 'Website            \r\n            ', '            \r\n            ', 'PHP, Javascript', ' \r\n            ', 'Beons System\r\n            ', 'DIC            \r\n            ', 'Chandigarh            ', 0, 'N', 'aish3.jpeg', '/opt/lampp/htdocs/tpc/uploads/'),
(14, 'yashi@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Yashi', 'Gupta', 'ABC', 'XYZ', '1995-12-31', 'F', 'Unreserved', 2147483647, 'ue133104', 'be', 'cse', 'Sixth', 'uiet', '9.30', 2018, '90.00', 2014, '89.00', 2012, 'Application            \r\n            ', '            Gate AIR 2\r\n            ', 'C, C++ , Java, Android            \r\n            ', ' \r\n            ', 'Infotech            \r\n            ', 'Infotech            \r\n            ', 'Allahbad            ', 0, 'N', NULL, NULL),
(15, 'rajat@gmail.com', 'a2be57e304b28d61896695f5a508a971', 'Rajat', 'Kalyan', 'ABC ', 'XYZ', '1995-12-30', 'M', 'Unreserved', 2147483647, 'rajat', 'be', 'mech', 'Sixth', 'uiet', '8.00', 2017, '89.00', 2013, '90.00', 2012, 'Automation            \r\n            ', 'Others', '            \r\n            ', ' \r\n            ', 'Infogain            \r\n            ', 'Infogain            \r\n            ', 'Karnal            ', 0, 'N', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tpc_student_reg`
--

CREATE TABLE IF NOT EXISTS `tpc_student_reg` (
  `s_no` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(5) NOT NULL,
  `student_id` int(5) NOT NULL,
  `placed` char(1) DEFAULT 'N',
  PRIMARY KEY (`s_no`),
  KEY `student_id` (`student_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

--
-- Dumping data for table `tpc_student_reg`
--

INSERT INTO `tpc_student_reg` (`s_no`, `company_id`, `student_id`, `placed`) VALUES
(2, 1, 1, 'Y'),
(3, 2, 1, 'N'),
(4, 3, 1, 'N'),
(5, 1, 2, 'N'),
(6, 2, 2, 'N'),
(7, 3, 2, 'N'),
(8, 4, 2, 'N'),
(9, 1, 3, 'N'),
(10, 2, 3, 'N'),
(11, 3, 3, 'N'),
(12, 4, 3, 'N'),
(13, 5, 3, 'Y'),
(14, 13, 4, 'N'),
(37, 5, 5, 'Y'),
(38, 13, 6, 'N'),
(39, 14, 6, 'N'),
(40, 15, 6, 'N'),
(41, 23, 6, 'Y'),
(42, 1, 6, 'N'),
(43, 13, 10, 'N'),
(46, 14, 10, 'N'),
(47, 15, 10, 'N'),
(48, 23, 10, 'N'),
(56, 1, 11, 'N'),
(57, 23, 11, 'N'),
(58, 2, 11, 'N'),
(59, 3, 10, 'N'),
(64, 4, 10, 'N'),
(65, 5, 10, 'N'),
(66, 23, 1, 'N'),
(67, 1, 13, 'N'),
(68, 4, 13, 'N'),
(69, 14, 13, 'N'),
(70, 5, 13, 'N'),
(71, 15, 13, 'N'),
(72, 2, 13, 'N'),
(73, 23, 13, 'N'),
(80, 4, 1, 'N'),
(81, 5, 1, 'N'),
(82, 13, 1, 'N'),
(83, 14, 1, 'N'),
(84, 15, 1, 'N'),
(85, 23, 3, 'N'),
(86, 5, 7, 'N'),
(87, 13, 7, 'N'),
(88, 23, 7, 'Y'),
(89, 5, 8, 'Y'),
(90, 23, 8, 'N'),
(91, 13, 8, 'N'),
(92, 5, 9, 'Y'),
(93, 23, 9, 'Y'),
(94, 13, 9, 'N'),
(96, 4, 11, 'Y'),
(97, 5, 11, 'N'),
(98, 13, 11, 'N'),
(99, 14, 11, 'Y'),
(100, 15, 11, 'N'),
(101, 5, 12, 'Y'),
(102, 23, 12, 'N'),
(103, 13, 12, 'N'),
(104, 13, 13, 'N'),
(105, 3, 13, 'N'),
(106, 23, 14, 'Y'),
(107, 5, 14, 'N'),
(108, 13, 14, 'N');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tpc_predict_placement`
--
ALTER TABLE `tpc_predict_placement`
  ADD CONSTRAINT `tpc_predict_placement_ibfk_1` FOREIGN KEY (`p_stu_id`) REFERENCES `tpc_students` (`stu_id`);

--
-- Constraints for table `tpc_student_reg`
--
ALTER TABLE `tpc_student_reg`
  ADD CONSTRAINT `tpc_student_reg_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `tpc_students` (`stu_id`),
  ADD CONSTRAINT `tpc_student_reg_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `tpc_company` (`comp_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

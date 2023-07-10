-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 01:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appraisal`
--

-- --------------------------------------------------------

--
-- Table structure for table `apas_rating`
--

CREATE TABLE `apas_rating` (
  `apas_id` int(30) NOT NULL,
  `target_id` int(30) NOT NULL,
  `scores` int(10) NOT NULL,
  `overall_score` int(10) NOT NULL,
  `employee_id` int(30) NOT NULL,
  `supervisor_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apas_rating`
--

INSERT INTO `apas_rating` (`apas_id`, `target_id`, `scores`, `overall_score`, `employee_id`, `supervisor_id`, `date_created`) VALUES
(1, 0, 2, 2, 0, 0, '2023-07-01 10:56:29'),
(2, 0, 2, 0, 0, 0, '2023-07-01 10:56:29'),
(3, 0, 2, 2, 0, 0, '2023-07-01 10:57:31'),
(4, 0, 2, 0, 0, 0, '2023-07-01 10:57:31'),
(5, 0, 2, 2, 0, 0, '2023-07-01 10:58:25'),
(6, 0, 2, 0, 0, 0, '2023-07-01 10:58:25'),
(7, 0, 2, 2, 0, 0, '2023-07-01 10:58:33'),
(8, 0, 2, 0, 0, 0, '2023-07-01 10:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_comments`
--

CREATE TABLE `appraisal_comments` (
  `id` int(11) NOT NULL,
  `employee_id` int(30) NOT NULL,
  `supervisor_id` int(30) NOT NULL,
  `app_comment` text NOT NULL,
  `co_off_name` varchar(50) NOT NULL,
  `agree` varchar(20) NOT NULL,
  `disagree` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `ps_name` varchar(50) NOT NULL,
  `agree_1` varchar(20) NOT NULL,
  `disagree_1` varchar(20) NOT NULL,
  `comment_1` text NOT NULL,
  `date_1` datetime NOT NULL DEFAULT current_timestamp(),
  `date_2` datetime NOT NULL DEFAULT current_timestamp(),
  `date_3` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department_list`
--

CREATE TABLE `department_list` (
  `id` int(30) NOT NULL,
  `department` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_list`
--

INSERT INTO `department_list` (`id`, `department`, `description`) VALUES
(1, 'IT Department', 'Information Technology Department'),
(5, 'Planning & Information', 'Electronic system management'),
(6, 'ART ', 'HIV/TB management'),
(7, 'OPD', 'Out Patient Department'),
(8, 'MCH', 'Mother to Child Health management'),
(9, 'M&E', 'Monitoring and Evaluation of Health information'),
(10, 'Administration', 'facility management and Human resource'),
(11, 'Dentology', 'Dental technology management');

-- --------------------------------------------------------

--
-- Table structure for table `document_list`
--

CREATE TABLE `document_list` (
  `id` int(30) NOT NULL,
  `doc_title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `file_json` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_list`
--

INSERT INTO `document_list` (`id`, `doc_title`, `description`, `file_json`, `user_id`, `date_created`) VALUES
(1, 'Annual Performance Appraisal System', '&lt;p class=&quot;MsoNormal&quot; style=&quot;margin-left:21.25pt;text-indent:-21.25pt;mso-list:\r\nl0 level1 lfo1;tab-stops:list 21.25pt&quot;&gt;&lt;!--[if !supportLists]--&gt;&lt;span style=&quot;font-size:11.0pt;font-family:&amp;quot;Arial&amp;quot;,sans-serif;mso-fareast-font-family:\r\nArial&quot;&gt;1.&lt;span style=&quot;font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &amp;quot;Times New Roman&amp;quot;;&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;\r\n&lt;/span&gt;&lt;/span&gt;&lt;!--[endif]--&gt;&lt;span style=&quot;font-size:11.0pt;font-family:&amp;quot;Arial&amp;quot;,sans-serif&quot;&gt;The\r\nfollow up action to be taken is a recommendation made by the supervisor taking\r\ninto account the rating, on both the targets and performance competencies. This\r\nrecommendation could either relate to skills development, reward or sanction.&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;															', '[\"1687516260_1687516140_1687515660_APAS MAURICE MANZI - August 2022.doc\"]', 1, '2023-06-23 12:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `employee_list`
--

CREATE TABLE `employee_list` (
  `id` int(30) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `sex` varchar(25) NOT NULL,
  `dob` date DEFAULT NULL,
  `station` varchar(50) NOT NULL,
  `sup_lv_id` int(10) NOT NULL,
  `department_id` int(30) NOT NULL,
  `j_title_id` int(30) NOT NULL,
  `supervisor_id` int(30) NOT NULL,
  `ministry` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `staff_no` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_list`
--

INSERT INTO `employee_list` (`id`, `employee_id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `sex`, `dob`, `station`, `sup_lv_id`, `department_id`, `j_title_id`, `supervisor_id`, `ministry`, `section`, `staff_no`, `avatar`, `date_created`) VALUES
(3, '', 'Sandra', 'Kabuswe', 'Moyo', 'sandramoyo@gmail.com', '3fc5586bed4fb9f745500c0605197924', '', '0000-00-00', '', 0, 3, 3, 2, '', '', '', 'no-image-available.png', '2023-05-31 14:42:59'),
(7, '', 'Albertina', '', 'Mwale', 'albertinamwale@gmail.com', '94133c84e5bff4e882e0914f3665a6b0', '', '2023-04-22', 'Matero General Hospital', 1, 6, 9, 5, 'Health', 'ART', 'CDC-62', 'no-image-available.png', '2023-06-07 01:05:22'),
(10, '', 'Judith', '', 'Mutale', 'judithmutale@gmail.com', 'f481aa3206ba8cb86cd50fe9d005a9b6', 'FEMALE', '0000-00-00', 'Chawama General Hospital', 0, 2, 6, 5, '', '', '', 'no-image-available.png', '2023-06-20 17:54:35'),
(11, '', 'Margaret', 'Theresa', 'Njobvu', 'margaretnjobvu@gmail.com', '13dbe593780d21288a8c0b8a62386f65', 'FEMALE', '1998-12-07', 'Matero General Hospital', 1, 1, 5, 5, 'Health', 'ART', '', 'no-image-available.png', '2023-06-23 18:35:05'),
(12, '', 'Edmond', '', 'Matende', 'edmondmatende@gmail.com', 'ebc5b7e543f54dc2bbe800ada3dffa91', 'MALE', '1998-04-06', 'Chipata general Hospital', 1, 1, 5, 5, 'Health', 'ICT', '', 'no-image-available.png', '2023-06-26 09:24:07'),
(13, '', 'Mwiya', '', 'Mushahsu', 'mwiyamushashu@gmail.com', '98b54352aa199afd9296b00ee5c705f3', 'MALE', '1992-06-27', 'UTH', 1, 5, 5, 5, 'Health', 'M&E', 'CDC-45', 'no-image-available.png', '2023-06-29 13:11:03'),
(14, '', 'Joe', '', 'Nthambale', 'joenthambale@gmail.com', '50d1b87fb44094fe7485bdd2b292f83c', 'MALE', '1981-11-04', 'Kuku Health Post', 1, 9, 5, 2, 'Health', 'M&E', 'CDC-12', 'no-image-available.png', '2023-07-04 13:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `job_description`
--

CREATE TABLE `job_description` (
  `job_id` int(30) NOT NULL,
  `salary_scale` text NOT NULL,
  `j_title` varchar(200) NOT NULL,
  `j_purpose` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_description`
--

INSERT INTO `job_description` (`job_id`, `salary_scale`, `j_title`, `j_purpose`) VALUES
(5, '', 'Data Associate', 'Data Associate'),
(7, '', 'HIV/TB Clinical Mentor-District Health Office', 'To undertake the provision of onsite clinical care technical support to all health facilities in the Districts for\r\nHIV/TB programs in order to improve clinical care services, HIV epidemic control and TB elimination.'),
(8, '', 'Finance Office', 'To prepare monthly cash flow requests, documentation and\r\nfinancial reports in order to ensure adherence to financial regulations and guidelines.'),
(9, '', 'HIV/TB Clinical Mentor - Sub-District Level', 'To undertake the provision of onsite clinical care technical support to all health facilities in the Sub District\r\nfor HIV/TB programs in order to improve clinical care services, HIV epidemic control and TB\r\nelimination.'),
(11, '', 'Community Coordinator – Sub District', 'To coordinate the implementation of District community HIV/TB Programs in order to ensure that\r\nclients who are identified from the community are linked to health facilities in the treatment cascade.'),
(12, '', 'Registered Nurse', 'To provide quality HIV prevention, counselling, treatment, care and support services in order to\r\nfacilitate provision of quality HIV health services'),
(13, '', ' EHR Officer', 'To strengthen the implementation and use of SmartCare in order to contribute to improved patient care,\r\ndata management and reporting'),
(14, '', 'ICT Office', 'To supervise and undertake maintenance administration and support of deployed electronic systems\r\nincluding program development, installation and review of management information systems in order\r\nto facilitate accessibility, security and efficient flow of information'),
(15, '', 'Registered Midwife', 'To provide holistic HIV and reproductive health care services to clients in order to reduce\r\nmaternal and neonatal mortality and morbidity.'),
(16, '', 'Medical Laboratory Technologist', 'To supervise and undertake the provision of laboratory services\r\nin order to ensure effective diagnostic services'),
(17, '', 'Pharmacy Technologist', 'To assist in making, storing, compounding and dispensing medicaments of specialized\r\npharmaceutical services according to prescriptions or formulae under the direction of a\r\npharmacist unit'),
(18, '', 'Clinical Officer Genera', 'To screen and diagnose diseased in order to treat patients according\r\nto\r\nNational treatment protocols'),
(19, '', 'Community Liaison Officer', 'To coordinate community mobilization through community outreach programs\r\nand supervise the Community Health Workers in order to improve awareness and uptake of HIV\r\nprevention and treatment activities'),
(20, '', 'Driver', 'To drive government vehicles in order to facilitate mobility\r\nof officers, materials and equipment');

-- --------------------------------------------------------

--
-- Table structure for table `kra_tbl`
--

CREATE TABLE `kra_tbl` (
  `kra_id` int(50) NOT NULL,
  `kra_name` varchar(200) NOT NULL,
  `j_id` int(50) NOT NULL,
  `p_accountability` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `performance_competence`
--

CREATE TABLE `performance_competence` (
  `id` int(30) NOT NULL,
  `employee_id` int(30) NOT NULL,
  `supervisor_id` int(30) NOT NULL,
  `mgt_skills` int(10) NOT NULL,
  `j_knowledge` int(10) NOT NULL,
  `qow` int(10) NOT NULL,
  `promptness` int(10) NOT NULL,
  `dependability` int(10) NOT NULL,
  `accountability` int(10) NOT NULL,
  `creativity` int(10) NOT NULL,
  `com_skills` int(10) NOT NULL,
  `courtesy` int(10) NOT NULL,
  `attitude` int(10) NOT NULL,
  `adaptability` int(10) NOT NULL,
  `team_work` int(10) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `performance_competence`
--

INSERT INTO `performance_competence` (`id`, `employee_id`, `supervisor_id`, `mgt_skills`, `j_knowledge`, `qow`, `promptness`, `dependability`, `accountability`, `creativity`, `com_skills`, `courtesy`, `attitude`, `adaptability`, `team_work`, `date_created`) VALUES
(1, 0, 0, 4, 4, 4, 4, 4, 4, 4, 0, 4, 4, 4, 4, '2023-07-07 13:39:32'),
(2, 7, 0, 4, 4, 4, 4, 4, 4, 4, 0, 4, 4, 4, 4, '2023-07-07 13:39:32'),
(3, 10, 0, 3, 3, 3, 2, 4, 3, 3, 0, 2, 4, 3, 2, '2023-07-07 13:41:22'),
(4, 12, 0, 3, 3, 3, 2, 4, 3, 3, 0, 2, 4, 3, 2, '2023-07-07 13:59:36'),
(5, 12, 0, 4, 3, 3, 1, 3, 2, 3, 0, 2, 4, 2, 4, '2023-07-07 14:27:06'),
(6, 13, 0, 2, 2, 4, 1, 2, 3, 2, 4, 3, 2, 3, 2, '2023-07-07 17:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(30) NOT NULL,
  `employee_id` int(30) NOT NULL,
  `task_id` int(30) NOT NULL,
  `supervisor_id` int(30) NOT NULL,
  `efficiency` int(11) NOT NULL,
  `timeliness` int(11) NOT NULL,
  `quality` int(11) NOT NULL,
  `accuracy` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `employee_id`, `task_id`, `supervisor_id`, `efficiency`, `timeliness`, `quality`, `accuracy`, `remarks`, `date_created`) VALUES
(2, 1, 1, 1, 5, 4, 5, 5, 'Sample', '2020-12-05 15:18:40'),
(3, 3, 3, 2, 3, 3, 2, 3, 'poor time Management', '2023-06-06 08:14:49'),
(4, 6, 5, 3, 2, 3, 2, 3, 'all the best next time', '2023-06-06 08:49:09'),
(5, 7, 6, 5, 4, 4, 3, 4, 'keep up the good work', '2023-06-07 02:45:10'),
(6, 8, 7, 5, 3, 4, 3, 4, 'Thanks for the work done', '2023-06-08 07:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `score_comments`
--

CREATE TABLE `score_comments` (
  `id` int(11) NOT NULL,
  `employee_id` int(30) NOT NULL,
  `supervisor_id` int(30) NOT NULL,
  `app_achieved` text NOT NULL,
  `app_not_achieved` text NOT NULL,
  `sup_achieved` text NOT NULL,
  `sup_not_achieved` text NOT NULL,
  `ministrial_contribution` text NOT NULL,
  `sign_1` text NOT NULL,
  `sign_2` text NOT NULL,
  `sign_3` text NOT NULL,
  `date1` datetime NOT NULL DEFAULT current_timestamp(),
  `date2` datetime NOT NULL DEFAULT current_timestamp(),
  `date3` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `score_comments`
--

INSERT INTO `score_comments` (`id`, `employee_id`, `supervisor_id`, `app_achieved`, `app_not_achieved`, `sup_achieved`, `sup_not_achieved`, `ministrial_contribution`, `sign_1`, `sign_2`, `sign_3`, `date1`, `date2`, `date3`) VALUES
(0, 7, 0, 'gfuzfujgjbjk', 'dfzufuzfuvjilmjcghxg', '', '', '', 'jhkfk', '', '', '2023-07-04 00:00:00', '2023-07-04 00:00:00', '2023-07-04 00:00:00'),
(0, 7, 0, 'gfuzfujgjbjk', 'dfzufuzfuvjilmjcghxg', '', '', '', 'jhkfk', '', '', '2023-07-04 00:00:00', '2023-07-04 00:00:00', '2023-07-04 00:00:00'),
(0, 14, 0, '', '', 'tdzj s tysexctzvuur', 'guczdtrasertzujbhucdry', 'ugvft ews5ectzu', '', 'jhvutzxtrxc', 'jhvjvgc', '2023-07-04 00:00:00', '2023-07-04 00:00:00', '2023-07-04 00:00:00'),
(0, 13, 5, '', '', 'igtdtfxctzvubjn', ' buhvztdrxcvh', 'vjgchfgdysdxf ', '', 'hvfzxtdxg', 'v fgxdy', '2023-07-04 00:00:00', '2023-07-04 00:00:00', '2023-07-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_list`
--

CREATE TABLE `supervisor_list` (
  `id` int(30) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `sex` varchar(20) NOT NULL,
  `DOB` date DEFAULT NULL,
  `station` varchar(50) NOT NULL,
  `sup_lv_id` int(10) NOT NULL,
  `department_id` int(30) NOT NULL,
  `j_title_id` int(30) NOT NULL,
  `supervisor_id` int(30) NOT NULL,
  `ministry` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `staff_no` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supervisor_list`
--

INSERT INTO `supervisor_list` (`id`, `employee_id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `sex`, `DOB`, `station`, `sup_lv_id`, `department_id`, `j_title_id`, `supervisor_id`, `ministry`, `section`, `staff_no`, `avatar`, `date_created`) VALUES
(2, '', 'Maurice', '', 'Manzi', 'mauricemanzi@yahoo.com', '89c2aea4392de83c2694ff08b10fce05', '', NULL, '', 0, 0, 0, 0, '', '', '', '1685565660_1607134440_avatar.jpg', '2023-05-31 14:41:21'),
(5, '', 'David', '', 'Mwelwa', 'davidgarciajr955@gmail.com', '55fc5b709962876903785fd64a6961e5', '', '1996-08-05', 'Chawama General Hospital', 3, 1, 14, 2, 'Health', 'ICT', 'CDC-32', '1686121140_1607134320_avatar.jpg', '2023-06-07 00:59:32'),
(6, '', 'Catherine', '', 'Chitongo', 'catherinechitongo@gmail.com', '78c37baa5d6b1de1cccb1e356ac41034', 'FEMALE', '1972-06-14', 'Chawama General Hospital', 3, 5, 2, 0, 'Health', 'Administration', '', 'no-image-available.png', '2023-06-23 18:36:33'),
(7, '', 'Martin', '', 'Mwenda', 'martinmwenda@gmail.com', '34f74c049edea51851c6924f4a386762', 'MALE', '1995-02-02', 'Chawama', 1, 5, 2, 0, 'Health', 'M&E', '', '1687616640_logo3.jpg', '2023-06-24 16:24:18'),
(8, '', 'Roy', '', 'cheelo', 'roycheelo@gmail.com', '96cdf246ecd915fd69eb46d1f56b2789', 'MALE', '1996-03-04', 'Chawama General Hospital', 1, 9, 5, 7, 'Health', 'ART', 'CDC-41', 'no-image-available.png', '2023-07-04 14:36:20');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Echo Sound Arts Music Storage Gallery'),
(6, 'short_name', 'ESAMS'),
(11, 'logo', 'uploads/logo1.jpg?v=1674703192'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover3.jpg?v=1674699976'),
(17, 'phone', '456-987-1231'),
(18, 'mobile', '0972862797'),
(19, 'email', 'info@echosoundartsmusic.com'),
(20, 'address', 'Chilenje, Lusaka Zambia');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `short_form` varchar(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `about` text NOT NULL,
  `cover_img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `short_form`, `email`, `contact`, `address`, `about`, `cover_img`) VALUES
(1, 'HR Annual Performance Appraisal System', 'HR (APAS)', 'info@lpho.com', '+260 972862797', 'Lusaka Provincial Health Office, Zambia', '<h1 style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: DauphinPlain; line-height: 90px; color: rgb(255, 255, 255); font-size: 70px; padding: 0px; text-align: center;\">ABOUT ESAMS</h1><h4 style=\"margin: 10px 10px 5px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; line-height: 18px; color: rgb(255, 255, 255); font-size: 14px; padding: 0px; text-align: center; font-style: italic;\">\"For the Love of the Echo Sound\"</h4><h5 style=\"margin: 5px 10px 20px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; line-height: 14px; color: rgb(255, 255, 255); font-size: 12px; padding: 0px; text-align: center;\">\"\"</h5><div id=\"Content\" style=\"margin: 0px; padding: 0px; position: relative; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: center; background-color: rgb(255, 255, 255);\"><div class=\"boxed\" style=\"margin: 10px 28.7969px; padding: 0px; clear: both;\"><div id=\"lipsum\" style=\"margin: 0px; padding: 0px; text-align: justify;\"></div></div></div><hr style=\"height: 1px; margin: 0px; border-top: 0px; padding: 0px; clear: both; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0)); color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: center; background-color: rgb(255, 255, 255);\"><p style=\"text-align: center;\"><span style=\"text-align: justify;\">The HR Individual Work Plan & Appraisal system was developed by the Lusaka Provincial Health Office (LPHO) with the goal to digitize Human Resource Appraisal system. The HR(IWPAS) is an electronic system that electronically performs the evaluation of health staff performance taking into account the rating, on both the targets and performance competencies </span></p>', '1687538940_logo3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `task_list`
--

CREATE TABLE `task_list` (
  `id` int(30) NOT NULL,
  `task` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `employee_id` int(30) NOT NULL,
  `due_date` date NOT NULL,
  `completed` date NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=pending, 1=on-progress,3=Completed',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_list`
--

INSERT INTO `task_list` (`id`, `task`, `description`, `employee_id`, `due_date`, `completed`, `status`, `date_created`) VALUES
(6, 'give covax to 150 people every week for one', 'target to give covid19 vaccine to at least 150 clients/week', 7, '2023-06-07', '0000-00-00', 2, '2023-06-07 01:10:44'),
(7, 'Collect and Update HIV Patients Files', 'Patients HIV data Reports are needed urgently', 8, '2023-06-08', '0000-00-00', 2, '2023-06-08 07:54:39'),
(8, 'type and print all the documents', '							we need the documents by the end of the day						', 12, '2023-06-26', '0000-00-00', 0, '2023-06-26 09:25:55'),
(9, 'type and print all the documents', 'we need them', 12, '2023-06-26', '0000-00-00', 0, '2023-06-26 09:27:16'),
(10, 'ifiugifWSTIHJF', 'jdduzrutzfsread', 10, '2023-06-26', '0000-00-00', 0, '2023-06-26 09:39:44'),
(11, 'adsgfjkjtfsg', 'asgfdfjf', 12, '2023-06-26', '0000-00-00', 0, '2023-06-26 14:03:53'),
(12, 'prepare the reports', 'fusfgufguvjjjjgeff', 13, '2023-07-01', '0000-00-00', 0, '2023-06-30 11:59:06'),
(13, 'jhfuxsfxvkjkddytx', 'jhkguzdtaasrzu', 12, '2023-07-07', '0000-00-00', 2, '2023-07-06 22:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `task_progress`
--

CREATE TABLE `task_progress` (
  `id` int(11) NOT NULL,
  `task_id` int(30) NOT NULL,
  `progress` text NOT NULL,
  `is_complete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=no,1=Yes',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_progress`
--

INSERT INTO `task_progress` (`id`, `task_id`, `progress`, `is_complete`, `date_created`) VALUES
(1, 1, '&lt;p&gt;Sample Progress&lt;/p&gt;', 0, '2020-12-05 11:29:48'),
(2, 1, '&lt;p&gt;Sample Progress&lt;/p&gt;', 0, '2020-12-05 11:32:15'),
(3, 1, '&lt;p&gt;Sample 2&lt;/p&gt;', 0, '2020-12-05 11:34:18'),
(4, 1, 'asdasd', 0, '2020-12-05 11:34:31'),
(5, 1, '&lt;p&gt;complete&lt;/p&gt;', 1, '2020-12-05 11:54:13'),
(6, 3, '&lt;p&gt;I have done 50% of DSD pharmacy backlog&lt;/p&gt;', 0, '2023-06-06 07:59:37'),
(7, 3, '&lt;p&gt;I have Cleared both DSD and ART pharmacy Backlog successfully&lt;/p&gt;', 1, '2023-06-06 08:10:28'),
(8, 5, '&lt;p&gt;The report will be halfway done in 30 minutes time&lt;/p&gt;', 0, '2023-06-06 08:44:31'),
(9, 5, '&lt;p&gt;The task is successfully done&lt;/p&gt;', 1, '2023-06-06 08:47:13'),
(10, 6, '&lt;p&gt;&lt;span style=&quot;font-size: 12px; font-family: &amp;quot;Times New Roman&amp;quot;;&quot;&gt;as of today we have vaccinated 200 clients&lt;/span&gt;&lt;/p&gt;', 0, '2023-06-07 01:14:33'),
(11, 6, '&lt;p&gt;done&lt;span style=&quot;font-size: 12px;&quot;&gt;﻿&lt;/span&gt;&lt;/p&gt;', 1, '2023-06-07 02:39:10'),
(12, 7, '&lt;p&gt;Ill be done tomorrow morning&lt;/p&gt;', 0, '2023-06-08 07:55:51'),
(13, 7, '&lt;p&gt;i have successfully completed the task&lt;/p&gt;', 1, '2023-06-08 07:56:46'),
(14, 13, '&lt;p&gt;hjfdfyxhjj&lt;/p&gt;', 1, '2023-07-06 22:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `sex` varchar(20) NOT NULL,
  `DOB` date DEFAULT NULL,
  `station` varchar(50) NOT NULL,
  `sup_lv_id` int(10) NOT NULL,
  `department_id` int(30) NOT NULL,
  `j_title_id` int(30) NOT NULL,
  `supervisor_id` int(30) NOT NULL,
  `ministry` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `staff_no` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `sex`, `DOB`, `station`, `sup_lv_id`, `department_id`, `j_title_id`, `supervisor_id`, `ministry`, `section`, `staff_no`, `avatar`, `date_created`) VALUES
(1, 'David', '', 'Mwelwa', 'davidgarciajr955@gmail.com', '55fc5b709962876903785fd64a6961e5', '', NULL, '', 0, 0, 0, 0, '', '', '', '1607135820_avatar.jpg', '2020-11-26 10:57:04'),
(4, 'Maurice', '', 'Manzi', 'mauricemanzi@yahoo.com', '491a44a3455c2a21938691737c47e60d', '', NULL, '', 0, 0, 0, 0, '', '', '', 'no-image-available.png', '2023-06-24 14:46:36'),
(5, 'Jane', '', 'Mandawa', 'janemandawa@gmail.com', '5570c0cd80d575f9db152f9cc8bf1c6a', 'FEMALE', '1984-09-23', 'Chawama General Hospital', 2, 5, 5, 6, 'Health', 'ART', 'CDC-12', 'no-image-available.png', '2023-07-04 14:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `work_plan`
--

CREATE TABLE `work_plan` (
  `id` int(30) NOT NULL,
  `kra_name` text NOT NULL,
  `targets` text NOT NULL,
  `p_accountability` text NOT NULL,
  `activ_schedule` text NOT NULL,
  `target_score` int(10) NOT NULL,
  `overall_score` int(10) NOT NULL,
  `supervisor_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `employee_id` int(30) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date NOT NULL,
  `completed` date DEFAULT NULL,
  `status` int(1) NOT NULL COMMENT '0=pending, 1=on-progress, 3=completed',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_plan`
--

INSERT INTO `work_plan` (`id`, `kra_name`, `targets`, `p_accountability`, `activ_schedule`, `target_score`, `overall_score`, `supervisor_id`, `user_id`, `employee_id`, `start_date`, `end_date`, `completed`, `status`, `date_created`) VALUES
(1, '<b><span lang=\"EN-GB\" style=\"font-size:11.5pt;\r\nfont-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\nmso-ansi-language:EN-GB;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">System\r\nManagement</span></b>													    ', '&lt;span lang=&quot;EN-GB&quot; style=&quot;font-size:11.5pt;font-family:\r\n&amp;quot;Times New Roman&amp;quot;,serif;mso-fareast-font-family:&amp;quot;Times New Roman&amp;quot;;mso-ansi-language:\r\nEN-GB;mso-fareast-language:EN-US;mso-bidi-language:AR-SA&quot;&gt;facilities running\r\nSmartcare e-First in the subdistrict monitored weekly in order to check that\r\nSmart-care EHR System is functioning efficiently &lt;/span&gt;&lt;span lang=&quot;EN-GB&quot; style=&quot;font-size:12.0pt;font-family:&amp;quot;Times New Roman&amp;quot;,serif;mso-fareast-font-family:\r\n&amp;quot;Times New Roman&amp;quot;;mso-ansi-language:EN-GB;mso-fareast-language:EN-US;\r\nmso-bidi-language:AR-SA&quot;&gt;in order to effectively and efficiently implement HIV\r\ndata management and reporting&lt;/span&gt;													', '<span lang=\"EN-GB\" style=\"font-size:12.0pt;font-family:\r\n&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:\r\nEN-GB;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">Ensures\r\nfunctionality, maintenance and use of electronic health records systems in all\r\nsupported health facilities in the district and/or sub district in order to\r\neffectively and efficiently implement HIV data management and reporting</span>													', '<p class=\"MsoNormalCxSpFirst\" style=\"margin-left:6.75pt;mso-add-space:auto;\r\ntext-indent:-7.1pt;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:&quot;Bookman Old Style&quot;,serif;\r\nmso-fareast-font-family:&quot;Bookman Old Style&quot;;mso-bidi-font-family:&quot;Bookman Old Style&quot;\">-<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span lang=\"EN-GB\" style=\"font-size:11.5pt\">Weekly schedule to visit all 5 facilities\r\ncurrently implementing Smartcare e-First are developed<o:p></o:p></span></p>\r\n\r\n<span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:&quot;Times New Roman&quot;,serif;\r\nmso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:EN-GB;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\">Visitations done to each Electronic Health\r\nRecords Systems implementing facility weekly</span>													', 0, 0, 0, 0, 2, '2023-06-22', '2023-07-26', NULL, 0, '2023-06-22 17:17:20'),
(7, 'ihgzufz rsease5trzu', 'fzutrsw4strtzu', 'utgfzztdeyerxcf', 'gzcrsesxczjn', 1, 2, 0, 0, 7, '0000-00-00', '2023-10-23', '0000-00-00', 0, '0000-00-00 00:00:00'),
(8, '<b><span lang=\"EN-GB\" style=\"font-size:11.5pt;\r\nfont-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\nmso-ansi-language:EN-GB;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">System\r\nManagement</span></b>													    ', '<span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:\r\n&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:\r\nEN-GB;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">5 facilities running\r\nSmartcare e-First in the subdistrict monitored weekly in order to check that\r\nSmart-care EHR System is functioning efficiently </span><span lang=\"EN-GB\" style=\"font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:\r\n&quot;Times New Roman&quot;;mso-ansi-language:EN-GB;mso-fareast-language:EN-US;\r\nmso-bidi-language:AR-SA\">in order to effectively and efficiently implement HIV\r\ndata management and reporting</span>													', '<span lang=\"EN-GB\" style=\"font-size:12.0pt;font-family:\r\n&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:\r\nEN-GB;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">Ensures\r\nfunctionality, maintenance and use of electronic health records systems in all\r\nsupported health facilities in the district and/or sub district in order to\r\neffectively and efficiently implement HIV data management and reporting</span>													', '<p class=\"MsoNormalCxSpFirst\" style=\"margin-left:6.75pt;mso-add-space:auto;\r\ntext-indent:-7.1pt;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:&quot;Bookman Old Style&quot;,serif;\r\nmso-fareast-font-family:&quot;Bookman Old Style&quot;;mso-bidi-font-family:&quot;Bookman Old Style&quot;\">-<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span lang=\"EN-GB\" style=\"font-size:11.5pt\">Weekly schedule to visit all 5 facilities\r\ncurrently implementing Smartcare e-First are developed<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormalCxSpMiddle\" style=\"margin-left:6.75pt;mso-add-space:auto;\r\ntext-indent:-7.1pt;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:&quot;Bookman Old Style&quot;,serif;\r\nmso-fareast-font-family:&quot;Bookman Old Style&quot;;mso-bidi-font-family:&quot;Bookman Old Style&quot;\">-<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span lang=\"EN-GB\" style=\"font-size:11.5pt\">Visitations done to each Electronic Health\r\nRecords Systems implementing facility weekly<o:p></o:p></span></p>\r\n\r\n<span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:&quot;Times New Roman&quot;,serif;\r\nmso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:EN-GB;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\">Ensured functionality and use of Smartcare in\r\nall supported facilities in the subdistrict to enhance and improve HIV data\r\nmanagement and reporting during the weekly visits</span>													', 0, 0, 0, 0, 13, '2023-06-29', '2023-10-22', '0000-00-00', 0, '0000-00-00 00:00:00'),
(9, '<b><span lang=\"EN-GB\" style=\"font-size:11.5pt;\r\nfont-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\nmso-ansi-language:EN-GB;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">Electronic\r\nSystem Rollout&nbsp;</span></b>													    ', '<p class=\"MsoNormal\" style=\"margin-left:12.25pt;text-indent:-9.6pt;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:Symbol;mso-fareast-font-family:\r\nSymbol;mso-bidi-font-family:Symbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp; </span></span><!--[endif]--><span lang=\"EN-GB\" style=\"font-size:11.5pt\">100% Facility Smartcare needs assessments\r\nconducted in the Sub-District within the first 2 weeks of the 1<sup>st</sup>\r\nQuarter,<o:p></o:p></span></p>													', '<span lang=\"EN-GB\" style=\"font-size:12.0pt;font-family:\r\n&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:\r\nEN-GB;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">Ensures that a plan\r\nis in place and implemented to rollout electronic systems in the sub-district/district&nbsp; in order to enhance effective and efficient\r\nservice delivery&nbsp;</span>													', '<p class=\"MsoNormalCxSpFirst\" style=\"margin-left:6.75pt;mso-add-space:auto;\r\ntext-indent:-6.75pt;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:&quot;Bookman Old Style&quot;,serif;\r\nmso-fareast-font-family:&quot;Bookman Old Style&quot;;mso-bidi-font-family:&quot;Bookman Old Style&quot;\">-<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span lang=\"EN-GB\" style=\"font-size:11.5pt\">Electronic Health Record (EHR) systems\r\nassessment in all supported facilities in the sub district carried out within\r\nthe 1<sup>st</sup> 2 week of deployment,<o:p></o:p></span></p>													', 3, 2, 0, 0, 12, '2023-06-29', '2023-08-23', '0000-00-00', 0, '0000-00-00 00:00:00'),
(10, '<b><span lang=\"EN-GB\" style=\"font-size:11.5pt;\r\nfont-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\nmso-ansi-language:EN-GB;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">Electronic\r\nSystem Implementation&nbsp;</span></b>													    ', '<p class=\"MsoNormal\" style=\"margin-left:16.55pt;text-indent:-13.5pt;mso-list:\r\nl0 level1 lfo2\"><!--[if !supportLists]--><span lang=\"EN-GB\" style=\"font-size:11.5pt;\r\nfont-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span lang=\"EN-GB\" style=\"font-size:11.5pt\">In 13\r\nSmartcare facilities, supervised the clearance of backlog weekly;<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"margin-left:14.3pt\"><span lang=\"EN-GB\" style=\"font-size:11.5pt\">&nbsp;</span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"margin-left:14.3pt;text-indent:-13.5pt;mso-list:l1 level1 lfo1\"><!--[if !supportLists]--><span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:Symbol;mso-fareast-font-family:\r\nSymbol;mso-bidi-font-family:Symbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span lang=\"EN-GB\" style=\"font-size:11.5pt\">9 Transport Database (TDBs) Collected from\r\nSC Legacy Facilities monthly<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" style=\"margin-left:14.3pt\"><span lang=\"EN-GB\" style=\"font-size:11.5pt\">&nbsp;</span></p>\r\n\r\n<span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:&quot;Times New Roman&quot;,serif;\r\nmso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:EN-GB;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\">9 Transport Database (TDBs) submitted date to\r\nLusaka District Health Office and Lusaka Provincial Health Office by fifth day\r\nof each month </span><span lang=\"EN-GB\" style=\"font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;\r\nmso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:EN-GB;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\">in order to ensure smooth smartcare\r\nimplementation.</span><span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:\r\n&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:\r\nEN-GB;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">.</span>													', '<span lang=\"EN-GB\" style=\"font-size:12.0pt;font-family:\r\n&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:\r\nEN-GB;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">Ensures that they are\r\nno backlogs; and are providing Transport Databases (TDBs) on monthly basis to\r\ndistrict and the Provincial Health Office in order to ensure smooth smartcare\r\nimplementation.&nbsp;</span>													', '<p class=\"MsoNormalCxSpFirst\" style=\"margin-left:6.75pt;mso-add-space:auto;\r\ntext-indent:-6.75pt;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:&quot;Bookman Old Style&quot;,serif;\r\nmso-fareast-font-family:&quot;Bookman Old Style&quot;;mso-bidi-font-family:&quot;Bookman Old Style&quot;\">-<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span lang=\"EN-GB\" style=\"font-size:11.5pt\">Smartcare implementing facilities visited\r\non weekly basis<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormalCxSpMiddle\"><span lang=\"EN-GB\" style=\"font-size:11.5pt\">&nbsp;</span></p>\r\n\r\n<p class=\"MsoNormalCxSpMiddle\" style=\"margin-left:6.75pt;mso-add-space:auto;\r\ntext-indent:-6.75pt;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:&quot;Bookman Old Style&quot;,serif;\r\nmso-fareast-font-family:&quot;Bookman Old Style&quot;;mso-bidi-font-family:&quot;Bookman Old Style&quot;\">-<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span lang=\"EN-GB\" style=\"font-size:11.5pt\">Made sure all client files are entered in\r\nthe system and there is no backlog&nbsp; on\r\nweekly visits to facilities and<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormalCxSpMiddle\"><span lang=\"EN-GB\" style=\"font-size:11.5pt\">&nbsp;</span></p>\r\n\r\n<span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:&quot;Times New Roman&quot;,serif;\r\nmso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:EN-GB;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\">TDBs from all Smartcare implementing facilities\r\ncollected, backed up and submitted to the District and Provincial Health Office\r\nat the end of each month</span>													', 1, 2, 0, 0, 12, '2023-06-29', '2023-08-23', '0000-00-00', 0, '0000-00-00 00:00:00'),
(11, 'Capacity Building&nbsp;													    ', 'Train clinicians modern HIV prevention techniques and management', '<div>Undertakes effectively the development and implementation of</div><div>HIV/TB treatment capacity building programmes in clinical care</div><div>staff in order in order to improve the quality of HIV/TB</div><div>treatment/care services.</div>													', 'to meet clinicians to discuss and address the challenges faced in HIV prevention programs', 3, 2, 0, 0, 7, '2023-06-30', '2023-07-01', '0000-00-00', 0, '0000-00-00 00:00:00'),
(12, '<div>Availability, functionality</div><div>and use of ICTs.</div>													    ', '<div>Undertakes development, maintenance, and implementation of</div><div>software and databases in order to improve HIV data management, use,</div><div>and reporting to support sites and districts in the Province.</div>													', '<div>Undertakes relevant ICT equipment (computers, servers, printers,</div><div>internet, LAN, etc.) is available and functional at all levels of health</div><div>care (site, district, and provincial) at all times.</div>													', '<div>Supervises effectively, human, financial and other material resources</div><div>in order to facilitate achievement of set objectives.</div>													', 0, 0, 5, 0, 0, '2023-07-05', '2023-07-06', '0000-00-00', 0, '0000-00-00 00:00:00'),
(13, 'sdhtjzukkewasda', 'dftrhbdftr', 'asgfjghmuzkeqd', 'sfddfbdnkztz', 0, 0, 5, 0, 0, '2023-07-10', '2023-07-11', '0000-00-00', 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apas_rating`
--
ALTER TABLE `apas_rating`
  ADD PRIMARY KEY (`apas_id`);

--
-- Indexes for table `appraisal_comments`
--
ALTER TABLE `appraisal_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_list`
--
ALTER TABLE `department_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_list`
--
ALTER TABLE `document_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_list`
--
ALTER TABLE `employee_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_description`
--
ALTER TABLE `job_description`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `kra_tbl`
--
ALTER TABLE `kra_tbl`
  ADD PRIMARY KEY (`kra_id`);

--
-- Indexes for table `performance_competence`
--
ALTER TABLE `performance_competence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisor_list`
--
ALTER TABLE `supervisor_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_progress`
--
ALTER TABLE `task_progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_plan`
--
ALTER TABLE `work_plan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apas_rating`
--
ALTER TABLE `apas_rating`
  MODIFY `apas_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `appraisal_comments`
--
ALTER TABLE `appraisal_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `document_list`
--
ALTER TABLE `document_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_list`
--
ALTER TABLE `employee_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `job_description`
--
ALTER TABLE `job_description`
  MODIFY `job_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kra_tbl`
--
ALTER TABLE `kra_tbl`
  MODIFY `kra_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `performance_competence`
--
ALTER TABLE `performance_competence`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supervisor_list`
--
ALTER TABLE `supervisor_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task_list`
--
ALTER TABLE `task_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `task_progress`
--
ALTER TABLE `task_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `work_plan`
--
ALTER TABLE `work_plan`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

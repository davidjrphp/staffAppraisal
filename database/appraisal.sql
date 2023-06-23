-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2023 at 03:01 PM
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
-- Table structure for table `apas`
--

CREATE TABLE `apas` (
  `apas_id` int(30) NOT NULL,
  `cop` text NOT NULL,
  `emp_id` int(30) NOT NULL,
  `j_id` int(30) NOT NULL,
  `kra_name` varchar(200) NOT NULL,
  `score` int(30) NOT NULL
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
(5, 'Planning & Information', 'Electronic system management');

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
  `avatar` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_list`
--

INSERT INTO `employee_list` (`id`, `employee_id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `sex`, `dob`, `station`, `sup_lv_id`, `department_id`, `j_title_id`, `supervisor_id`, `ministry`, `section`, `avatar`, `date_created`) VALUES
(3, '', 'Sandra', 'Kabuswe', 'Moyo', 'sandramoyo@gmail.com', '3fc5586bed4fb9f745500c0605197924', '', '0000-00-00', '', 0, 3, 3, 2, '', '', 'no-image-available.png', '2023-05-31 14:42:59'),
(7, '', 'Albertina', '', 'Mwale', 'albertinamwale@gmail.com', '94133c84e5bff4e882e0914f3665a6b0', '', '0000-00-00', '', 0, 2, 6, 5, '', '', 'no-image-available.png', '2023-06-07 01:05:22'),
(10, '', 'Judith', '', 'Mutale', 'judithmutale@gmail.com', 'f481aa3206ba8cb86cd50fe9d005a9b6', 'FEMALE', '0000-00-00', 'Chawama General Hospital', 0, 2, 6, 5, '', '', 'no-image-available.png', '2023-06-20 17:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `job_description`
--

CREATE TABLE `job_description` (
  `id` int(30) NOT NULL,
  `j_title` varchar(200) NOT NULL,
  `j_purpose` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_description`
--

INSERT INTO `job_description` (`id`, `j_title`, `j_purpose`) VALUES
(2, 'EHRO', 'Electronic Health Records Officer'),
(5, 'Data Associate', 'Data Associate');

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
  `ministry` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `avatar` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supervisor_list`
--

INSERT INTO `supervisor_list` (`id`, `employee_id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `sex`, `DOB`, `station`, `sup_lv_id`, `department_id`, `j_title_id`, `ministry`, `section`, `avatar`, `date_created`) VALUES
(2, '', 'Maurice', '', 'Manzi', 'mauricemanzi@yahoo.com', '89c2aea4392de83c2694ff08b10fce05', '', NULL, '', 0, 0, 0, '', '', '1685565660_1607134440_avatar.jpg', '2023-05-31 14:41:21'),
(5, '', 'David', '', 'Mwelwa', 'davidgarciajr955@gmail.com', '55fc5b709962876903785fd64a6961e5', '', NULL, '', 0, 0, 0, '', '', '1686121140_1607134320_avatar.jpg', '2023-06-07 00:59:32');

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
(1, 'HR Individual Work Plan & Appraisal System', 'HR(IWPAS)', 'info@lpho.com', '+260 972862797', 'Lusaka Provincial Health Office, Zambia', '', '');

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
(7, 'Collect and Update HIV Patients Files', 'Patients HIV data Reports are needed urgently', 8, '2023-06-08', '0000-00-00', 2, '2023-06-08 07:54:39');

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
(13, 7, '&lt;p&gt;i have successfully completed the task&lt;/p&gt;', 1, '2023-06-08 07:56:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `avatar`, `date_created`) VALUES
(1, 'David', 'Mwelwa', 'davidgarciajr955@gmail.com', '55fc5b709962876903785fd64a6961e5', '1607135820_avatar.jpg', '2020-11-26 10:57:04');

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
  `employee_id` int(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_plan`
--

INSERT INTO `work_plan` (`id`, `kra_name`, `targets`, `p_accountability`, `activ_schedule`, `employee_id`, `start_date`, `end_date`, `date_created`) VALUES
(1, '<b><span lang=\"EN-GB\" style=\"font-size:11.5pt;\r\nfont-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\nmso-ansi-language:EN-GB;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">System\r\nManagement</span></b>													    ', '&lt;span lang=&quot;EN-GB&quot; style=&quot;font-size:11.5pt;font-family:\r\n&amp;quot;Times New Roman&amp;quot;,serif;mso-fareast-font-family:&amp;quot;Times New Roman&amp;quot;;mso-ansi-language:\r\nEN-GB;mso-fareast-language:EN-US;mso-bidi-language:AR-SA&quot;&gt;facilities running\r\nSmartcare e-First in the subdistrict monitored weekly in order to check that\r\nSmart-care EHR System is functioning efficiently &lt;/span&gt;&lt;span lang=&quot;EN-GB&quot; style=&quot;font-size:12.0pt;font-family:&amp;quot;Times New Roman&amp;quot;,serif;mso-fareast-font-family:\r\n&amp;quot;Times New Roman&amp;quot;;mso-ansi-language:EN-GB;mso-fareast-language:EN-US;\r\nmso-bidi-language:AR-SA&quot;&gt;in order to effectively and efficiently implement HIV\r\ndata management and reporting&lt;/span&gt;													', '<span lang=\"EN-GB\" style=\"font-size:12.0pt;font-family:\r\n&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:\r\nEN-GB;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">Ensures\r\nfunctionality, maintenance and use of electronic health records systems in all\r\nsupported health facilities in the district and/or sub district in order to\r\neffectively and efficiently implement HIV data management and reporting</span>													', '<p class=\"MsoNormalCxSpFirst\" style=\"margin-left:6.75pt;mso-add-space:auto;\r\ntext-indent:-7.1pt;mso-list:l0 level1 lfo1\"><!--[if !supportLists]--><span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:&quot;Bookman Old Style&quot;,serif;\r\nmso-fareast-font-family:&quot;Bookman Old Style&quot;;mso-bidi-font-family:&quot;Bookman Old Style&quot;\">-<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\"> </span></span><!--[endif]--><span lang=\"EN-GB\" style=\"font-size:11.5pt\">Weekly schedule to visit all 5 facilities\r\ncurrently implementing Smartcare e-First are developed<o:p></o:p></span></p>\r\n\r\n<span lang=\"EN-GB\" style=\"font-size:11.5pt;font-family:&quot;Times New Roman&quot;,serif;\r\nmso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:EN-GB;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\">Visitations done to each Electronic Health\r\nRecords Systems implementing facility weekly</span>													', 0, '2023-06-22', '2023-07-26', '2023-06-22 17:17:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apas`
--
ALTER TABLE `apas`
  ADD PRIMARY KEY (`apas_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kra_tbl`
--
ALTER TABLE `kra_tbl`
  ADD PRIMARY KEY (`kra_id`);

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
-- AUTO_INCREMENT for table `apas`
--
ALTER TABLE `apas`
  MODIFY `apas_id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `document_list`
--
ALTER TABLE `document_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_list`
--
ALTER TABLE `employee_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `job_description`
--
ALTER TABLE `job_description`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kra_tbl`
--
ALTER TABLE `kra_tbl`
  MODIFY `kra_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supervisor_list`
--
ALTER TABLE `supervisor_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `task_progress`
--
ALTER TABLE `task_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_plan`
--
ALTER TABLE `work_plan`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2017 at 05:10 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ca_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assignment_id` varchar(120) NOT NULL DEFAULT '',
  `registration_id` varchar(120) NOT NULL DEFAULT '',
  `subject` varchar(45) NOT NULL DEFAULT '',
  `score` double(10,1) NOT NULL,
  `week` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`assignment_id`, `registration_id`, `subject`, `score`, `week`) VALUES
('Reg00002biologyWeek1', 'Reg00002', 'biology', 0.0, 'Week1'),
('Reg00002chemistryWeek1', 'Reg00002', 'chemistry', 0.0, 'Week1'),
('Reg00002christian religious knowledgeWeek1', 'Reg00002', 'christian religious knowledge', 0.0, 'Week1'),
('Reg00002economicsWeek1', 'Reg00002', 'economics', 0.0, 'Week1'),
('Reg00002english languageWeek1', 'Reg00002', 'english language', 0.0, 'Week1'),
('Reg00002further mathematicsWeek1', 'Reg00002', 'further mathematics', 0.0, 'Week1'),
('Reg00002geographyWeek1', 'Reg00002', 'geography', 0.0, 'Week1'),
('Reg00002mathematicsWeek1', 'Reg00002', 'mathematics', 0.0, 'Week1'),
('Reg00002physicsWeek1', 'Reg00002', 'physics', 0.0, 'Week1'),
('Reg00002technical drawingWeek1', 'Reg00002', 'technical drawing', 0.0, 'Week1');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `registration_id` varchar(100) NOT NULL,
  `class` varchar(5) NOT NULL,
  `arm` varchar(32) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`registration_id`, `class`, `arm`, `status`) VALUES
('Reg00001', 'sss2', 'senior secondary school', 'Active'),
('Reg00002', 'Sss2', 'senior secondary school', 'Active'),
('Reg00003', 'Sss1', 'senior secondary school', 'Active'),
('Reg00004', 'Jss3', 'junior secondary school', 'Active'),
('Reg00005', 'Jss3', 'junior secondary school', 'Active'),
('Reg00006', 'Sss2', 'senior secondary school', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `classwork`
--

CREATE TABLE `classwork` (
  `classwork_id` varchar(120) NOT NULL DEFAULT '',
  `registration_id` varchar(120) NOT NULL DEFAULT '',
  `subject` varchar(40) NOT NULL DEFAULT '',
  `score` double(10,1) NOT NULL,
  `week` varchar(8) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classwork`
--

INSERT INTO `classwork` (`classwork_id`, `registration_id`, `subject`, `score`, `week`) VALUES
('Reg00002biologyWeek1', 'Reg00002', 'biology', 10.0, 'Week1'),
('Reg00002biologyWeek2', 'Reg00002', 'biology', 0.0, 'Week2'),
('Reg00002chemistryWeek1', 'Reg00002', 'chemistry', 10.0, 'Week1'),
('Reg00002chemistryWeek2', 'Reg00002', 'chemistry', 0.0, 'Week2'),
('Reg00002christian religious knowledgeWeek1', 'Reg00002', 'christian religious knowledge', 0.0, 'Week1'),
('Reg00002christian religious knowledgeWeek2', 'Reg00002', 'christian religious knowledge', 0.0, 'Week2'),
('Reg00002economicsWeek1', 'Reg00002', 'economics', 0.0, 'Week1'),
('Reg00002economicsWeek2', 'Reg00002', 'economics', 0.0, 'Week2'),
('Reg00002english languageWeek1', 'Reg00002', 'english language', 0.0, 'Week1'),
('Reg00002english languageWeek2', 'Reg00002', 'english language', 0.0, 'Week2'),
('Reg00002further mathematicsWeek1', 'Reg00002', 'further mathematics', 0.0, 'Week1'),
('Reg00002further mathematicsWeek2', 'Reg00002', 'further mathematics', 0.0, 'Week2'),
('Reg00002geographyWeek1', 'Reg00002', 'geography', 0.0, 'Week1'),
('Reg00002geographyWeek2', 'Reg00002', 'geography', 0.0, 'Week2'),
('Reg00002mathematicsWeek1', 'Reg00002', 'mathematics', 0.0, 'Week1'),
('Reg00002mathematicsWeek2', 'Reg00002', 'mathematics', 0.0, 'Week2'),
('Reg00002physicsWeek1', 'Reg00002', 'physics', 0.0, 'Week1'),
('Reg00002physicsWeek2', 'Reg00002', 'physics', 0.0, 'Week2'),
('Reg00002technical drawingWeek1', 'Reg00002', 'technical drawing', 0.0, 'Week1'),
('Reg00002technical drawingWeek2', 'Reg00002', 'technical drawing', 0.0, 'Week2');

-- --------------------------------------------------------

--
-- Table structure for table `deleted/passed_events`
--

CREATE TABLE `deleted/passed_events` (
  `registration_id` varchar(120) NOT NULL,
  `event_code` varchar(120) NOT NULL,
  `title` varchar(40) NOT NULL,
  `description` varchar(256) NOT NULL,
  `supposed_date_of_event` date NOT NULL,
  `message_viability` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deleted/passed_events`
--

INSERT INTO `deleted/passed_events` (`registration_id`, `event_code`, `title`, `description`, `supposed_date_of_event`, `message_viability`) VALUES
('Reg00002', 'Evnt00001', 'South African Trip', 'This is just a reminder to be set before saturday morning ', '2016-12-05', 'none'),
('Reg00002', 'Evnt00002', 'Visit to Amanda', 'I visited Amanda Yesterday, this is just a reminder to visit her again.', '2015-04-12', 'none'),
('Reg00002', 'Evnt00003', 'Visit to Amanda', 'YO shes coming today', '2015-04-12', 'none'),
('Reg00002', 'Evnt00004', 'Just A Test', 'This is just a test to make sure that this effect is working perfectly', '2015-04-04', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `main_account` varchar(120) NOT NULL,
  `buddy_id` varchar(120) NOT NULL,
  `budd_registration_id` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`main_account`, `buddy_id`, `budd_registration_id`) VALUES
('Reg00002', 'Budd00001', 'Reg00003'),
('Reg00002', 'Budd00002', 'Reg00004'),
('Reg00003', 'Budd00005', 'Reg00002'),
('Reg00001', 'Budd00006', 'Reg00002'),
('Reg00002', 'Budd00007', 'Reg00006'),
('Reg00006', 'Budd00008', 'Reg00002'),
('Reg00006', 'Budd00009', 'Reg00004'),
('Reg00004', 'Budd00010', 'Reg00006');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `sender_reg_id` varchar(120) NOT NULL,
  `sender_full_name` varchar(60) NOT NULL,
  `sender_email` varchar(80) NOT NULL,
  `sender_visible` varchar(10) NOT NULL,
  `message_id` varchar(120) NOT NULL,
  `subject` varchar(40) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `recepient_reg_id` varchar(120) NOT NULL,
  `recepient_full_name` varchar(60) NOT NULL,
  `recepient_email` varchar(80) NOT NULL,
  `recepient_visible` varchar(10) NOT NULL,
  `message_viability` varchar(10) NOT NULL,
  `date_of_message` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`sender_reg_id`, `sender_full_name`, `sender_email`, `sender_visible`, `message_id`, `subject`, `message`, `recepient_reg_id`, `recepient_full_name`, `recepient_email`, `recepient_visible`, `message_viability`, `date_of_message`) VALUES
('Reg00002', 'Darrell Idiagbor', 'admin@ca.com', 'yes', 'Msg00001', 'Test Message', 'This message is just to see if my new function is working perfectly', 'Reg00004', 'Tester Scheme', 'tester@ca.com', 'yes', 'new', '2015-05-10'),
('Reg00002', 'Darrell Idiagbor', 'admin@ca.com', 'yes', 'Msg00002', 'No Subject', 'This is to check if my no subject is working', 'Reg00004', 'Tester Scheme', 'tester@ca.com', 'yes', 'new', '2015-05-10'),
('Reg00002', 'Darrell Idiagbor', 'admin@ca.com', 'yes', 'Msg00003', 'Friend Request', 'Darrell Idiagbor is requesting to be your friend.', 'Reg00001', 'Darrell Idiagbor', 'darrellidiagbor@gmail.com', 'yes', 'new', '2015-05-10'),
('Reg00006', 'Issachar Ishaya', 'issachano@icloud.com', 'yes', 'Msg00004', 'Friend Request', 'Issachar Ishaya is requesting to be your friend.', 'Reg00002', 'Darrell Idiagbor', 'admin@ca.com', 'yes', 'none', '2015-05-24'),
('Reg00004', 'Tester Scheme', 'tester@ca.com', 'yes', 'Msg00006', 'Friend Request', 'Tester Scheme is requesting to be your friend.', 'Reg00006', 'Issachar Ishaya', 'issachano@icloud.com', 'yes', 'none', '2015-07-24'),
('Reg00006', 'Issachar Ishaya', 'issachano@icloud.com', 'yes', 'Msg00007', 'Test', 'This is a long message and i am using this to test if the other section of my inbox function looks great and works fine if not i have to make some good adjustment but im not bothered about the error ill encounter', 'Reg00002', 'Darrell Idiagbor', 'admin@ca.com', 'yes', 'none', '2015-07-24'),
('Reg00002', 'Darrell Idiagbor', 'admin@ca.com', 'yes', 'Msg00008', 'Test', 'I am sending this message to verify that my reply function is up and running properly and if it is not then no problem i can easily go and vet it again and make sure it is as proposed.', 'Reg00006', 'Issachar Ishaya', 'issachano@icloud.com', 'yes', 'new', '2015-07-25'),
('Reg00002', 'Darrell Idiagbor', 'admin@ca.com', 'yes', 'Msg00009', 'Friend Request', 'Darrell Idiagbor is requesting to be your friend.', 'Reg00005', 'Muriel Chioma Idiagbor', 'muffymuriel@gmail.com', 'yes', 'new', '2015-07-25'),
('Reg00004', 'Tester Scheme', 'tester@ca.com', 'yes', 'Msg00010', 'Friend Request', 'Tester Scheme is requesting to be your friend.', 'Reg00002', 'Darrell Idiagbor', 'admin@ca.com', 'yes', 'none', '2015-07-27');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `registration_id` varchar(120) NOT NULL,
  `note_code` varchar(120) NOT NULL,
  `title` varchar(40) NOT NULL,
  `note` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`registration_id`, `note_code`, `title`, `note`) VALUES
('Reg00002', 'Note00001', 'Test Note', 'This is the part where you store your most important notes or jottings like for say we where in a chemistry class and we did an explosive practical you can write here the materials used, the casualties , how it reacted, also you can also save important materials like lets say you are on the cowbell team and you got some materials like past questions to practice you can write them here as documentation just incase the original copy gets missing. so you see this part is very very important for advancement. This is just the beginning theres alot i would still bring'),
('Reg00002', 'Note00002', 'Test', 'Just a test woo to see if read more would still show'),
('Reg00002', 'Note00003', 'Test', 'I am doing this to understand what the problem with the more and less is because it is acting very wierd very very very very wierd i dont know why it should do in such a manner why should i click one link and get the other one showing the less sign while the one i click continuee to  show the more...'),
('Reg00002', 'Note00004', 'another test', 'I am doing this to understand what the problem with the more and less is because it is acting very wierd very very very very wierd i dont know why it should do in such a manner why should i click one link and get the other one showing the less sign while the one i click continuee to show the more...'),
('', 'Note00005', 'Test note', 'This note is going to be quite long because i want to test out something i did quite long ago and i want to see how my truncated function of recent. I want to actually see when the function would truncate the text and to check if the length is up to 150 in length. Thank you once again.');

-- --------------------------------------------------------

--
-- Table structure for table `page_visited`
--

CREATE TABLE `page_visited` (
  `registration_id` varchar(120) NOT NULL,
  `visited` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_visited`
--

INSERT INTO `page_visited` (`registration_id`, `visited`) VALUES
('Reg00002', 'yes'),
('Reg00004', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `registration_id` varchar(120) NOT NULL,
  `question_id` varchar(120) NOT NULL,
  `title` varchar(60) NOT NULL,
  `question` varchar(256) NOT NULL,
  `asked_by` varchar(40) NOT NULL,
  `answers` varchar(700) NOT NULL,
  `answered_by` varchar(150) NOT NULL,
  `date_of_question` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`registration_id`, `question_id`, `title`, `question`, `asked_by`, `answers`, `answered_by`, `date_of_question`) VALUES
('Reg00002', 'Ques00001', 'Test Question', 'What is the meaning of AJAX?', 'Muriel Idiagbor', 'Ajax is a process whereby the client page is in constant communication with the  backend, and implements changes almost instantaneously.', 'Darrell Idiagbor', '2015-04-11'),
('Reg00002', 'Ques00002', 'A long question', 'This is a very long question just to see if my more and less link work as they are supposed to. Apart from checking i also want to use the liberty to ask everyone in the world what the meaning of AJAX is, i would be so greatly happy if i could get a seriou', 'Tester Scheme', 'This is also a medium to check if my more and less links are working on both question and answer and if it is working i can then move on to the next step but enough about that lets discuss the answer of the meaning of AJAX which means asynchronous javascript and xml it is used to refresh a page without actually clicking refresh', 'Darrell Idiagbor', '2015-04-11'),
('Reg00003', 'Ques00003', 'I am just trying something out', 'This is absolutely not a serious question i am just checking for two things one whether the name of the person that ansked it would show and whether the text would be truncated ', 'mum', 'The answer is simple because this is just a text and check whether all is weell with the system because it is behaving somehow. ', 'Muriel Idiagbor', '2015-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `saved_events`
--

CREATE TABLE `saved_events` (
  `registration_id` varchar(120) NOT NULL,
  `event_code` varchar(120) NOT NULL,
  `title` varchar(40) NOT NULL,
  `description` varchar(256) NOT NULL,
  `supposed_date_of_event` date NOT NULL,
  `message_viability` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saved_events`
--

INSERT INTO `saved_events` (`registration_id`, `event_code`, `title`, `description`, `supposed_date_of_event`, `message_viability`) VALUES
('Reg00002', 'Evnt00005', 'Test', 'test oo', '2015-12-12', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `registration_id` varchar(100) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`registration_id`, `school_name`, `status`) VALUES
('Reg00001', 'Danbo International School', 'Active'),
('Reg00002', 'Danbo International School', 'Active'),
('Reg00003', 'forencial', 'Active'),
('Reg00004', 'foreign', 'Active'),
('Reg00005', 'Danbo International School', 'Active'),
('Reg00006', 'danbo international college', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `current_session` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`current_session`) VALUES
('2015/2016');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `email` varchar(45) NOT NULL,
  `registration_id` varchar(100) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `date_of_birth` date NOT NULL,
  `password` varchar(32) NOT NULL,
  `school_name` varchar(75) NOT NULL,
  `class` varchar(5) NOT NULL,
  `no_of_subjects_offered` varchar(25) NOT NULL,
  `user_category` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_of_account_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`email`, `registration_id`, `full_name`, `sex`, `date_of_birth`, `password`, `school_name`, `class`, `no_of_subjects_offered`, `user_category`, `status`, `date_of_account_creation`) VALUES
('admin@ca.com', 'Reg00002', 'Darrell Idiagbor', 'Male', '1998-12-05', 'darrellsco', 'Danbo International School', 'Sss2', '10', 'Student', 'Active', '2015-03-09 19:26:56'),
('darrellidiagbor@gmail.com', 'Reg00001', 'Darrell Idiagbor', 'Male', '1997-12-05', 'darrellsco', 'Danbo international school', 'SSS2', '10', 'Student', 'Active', '2014-11-29 08:39:54'),
('issachano@icloud.com', 'Reg00006', 'Issachar Ishaya', 'Male', '1998-03-07', 'issacharhadiza1', 'danbo international college', 'Sss2', '10', 'Student', 'Active', '2015-05-24 17:24:42'),
('muffymuriel@gmail.com', 'Reg00005', 'Muriel Chioma Idiagbor', 'Female', '2001-10-17', 'auntnina', 'Danbo International School', 'Jss3', '13', 'Student', 'Active', '2015-03-30 19:51:50'),
('tester@ca.com', 'Reg00004', 'Tester Scheme', 'Male', '1990-09-12', 'testertest', 'foreign', 'Jss3', '2', 'Student', 'Active', '2015-03-26 23:01:38'),
('testingact@gmail.com', 'Reg00003', 'Test Account', 'Male', '1995-12-12', 'testaccount', 'forencial', 'Sss1', '5', 'Student', 'Active', '2015-03-25 17:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `registration_id` varchar(100) NOT NULL,
  `no_of_subjects_offered` varchar(30) NOT NULL,
  `list_of_subjects_offered` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`registration_id`, `no_of_subjects_offered`, `list_of_subjects_offered`, `status`) VALUES
('Reg00001', '10', 'Mathematics,English,Biology,Chemistry,Physics,Crs,Economics,Geography,Technical-drawing,Further-mathematics', 'Active'),
('Reg00002', '10', 'biology,chemistry,christian religious knowledge,economics,english language,further mathematics,geography,mathematics,physics,technical drawing', 'Active'),
('Reg00003', '5', 'chemistry,further mathematics,geography,mathematics,technical drawing', 'Active'),
('Reg00004', '2', 'basic science,cultural and creative art', 'Active'),
('Reg00005', '13', 'agricultural science,business studies,mathematics,english language,civic education,information and communication technology,christian religious knowledge,basic science,basic technology,cultural and creative art,french,physical and health education,social ', 'Active'),
('Reg00006', '10', 'biology,chemistry,christian religious knowledge,economics,english language,food and nutrition,geography,mathematics,physical and health education,physics', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE `target` (
  `registration_id` varchar(100) NOT NULL,
  `target` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `target`
--

INSERT INTO `target` (`registration_id`, `target`) VALUES
('Reg00002', '89%'),
('Reg00003', '85%'),
('Reg00004', '67%'),
('Reg00005', '95%'),
('Reg00006', '80');

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `current_term` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `term`
--

INSERT INTO `term` (`current_term`) VALUES
('Third Term');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `test_id` varchar(120) NOT NULL DEFAULT '',
  `registration_id` varchar(120) NOT NULL DEFAULT '',
  `subject` varchar(45) NOT NULL DEFAULT '',
  `score` double(10,1) NOT NULL DEFAULT '0.0',
  `week` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`test_id`, `registration_id`, `subject`, `score`, `week`) VALUES
('Reg00002biologyWeek1', 'Reg00002', 'biology', 0.0, 'Week1'),
('Reg00002chemistryWeek1', 'Reg00002', 'chemistry', 0.0, 'Week1'),
('Reg00002christian religious knowledgeWeek1', 'Reg00002', 'christian religious knowledge', 0.0, 'Week1'),
('Reg00002economicsWeek1', 'Reg00002', 'economics', 0.0, 'Week1'),
('Reg00002english languageWeek1', 'Reg00002', 'english language', 0.0, 'Week1'),
('Reg00002further mathematicsWeek1', 'Reg00002', 'further mathematics', 0.0, 'Week1'),
('Reg00002geographyWeek1', 'Reg00002', 'geography', 0.0, 'Week1'),
('Reg00002mathematicsWeek1', 'Reg00002', 'mathematics', 0.0, 'Week1'),
('Reg00002physicsWeek1', 'Reg00002', 'physics', 0.0, 'Week1'),
('Reg00002technical drawingWeek1', 'Reg00002', 'technical drawing', 0.0, 'Week1');

-- --------------------------------------------------------

--
-- Table structure for table `upcoming_events`
--

CREATE TABLE `upcoming_events` (
  `registration_id` varchar(120) NOT NULL,
  `event_code` varchar(120) NOT NULL,
  `title` varchar(40) NOT NULL,
  `description` varchar(256) NOT NULL,
  `date_of_event` date NOT NULL,
  `message_viability` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(45) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `user_category` varchar(25) NOT NULL,
  `occupation` varchar(70) NOT NULL,
  `state` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `full_name`, `password`, `user_category`, `occupation`, `state`, `address`, `status`, `date_created`) VALUES
('idiagbordarrel@gmail.com', 'Darrell Idiagbor', 'darrellsco', 'Administrative', 'Computer Scientist', 'California', '3423 road karnau street sj california', 'Active', '2014-11-17 17:36:00'),
('muriel@gmail.com', 'Muriel idiagbor', 'families', 'User', 'pianoist', 'kaduna', 'tt6 takwo close', 'Active', '2014-11-28 15:41:10'),
('sfkalfals', 'Muriel idiagbor', 'families', 'User', 'pianoist', 'kaduna', 'tt6 takwo close', 'Inactive', '2014-11-22 18:35:31'),
('yvettella@yahoo.com', 'Yvette Ella', 'yvetteella', 'Administrative', 'Accountant', 'Imo', 'tt6 yakwo close', 'Active', '2015-01-22 17:33:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assignment_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`registration_id`);

--
-- Indexes for table `classwork`
--
ALTER TABLE `classwork`
  ADD PRIMARY KEY (`classwork_id`);

--
-- Indexes for table `deleted/passed_events`
--
ALTER TABLE `deleted/passed_events`
  ADD PRIMARY KEY (`event_code`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`buddy_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_code`);

--
-- Indexes for table `page_visited`
--
ALTER TABLE `page_visited`
  ADD PRIMARY KEY (`registration_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `saved_events`
--
ALTER TABLE `saved_events`
  ADD PRIMARY KEY (`event_code`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`registration_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`current_session`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`registration_id`);

--
-- Indexes for table `target`
--
ALTER TABLE `target`
  ADD PRIMARY KEY (`registration_id`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`current_term`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `upcoming_events`
--
ALTER TABLE `upcoming_events`
  ADD PRIMARY KEY (`event_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

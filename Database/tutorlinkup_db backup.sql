-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 09:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tutorlinkup_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_student` (IN `user_id` INT, IN `sphoto` VARCHAR(255), IN `sr_code` VARCHAR(50), IN `first_name` VARCHAR(50), IN `last_name` VARCHAR(50), IN `gender` ENUM('Male','Female','Prefer not to say'), IN `username` VARCHAR(50), IN `email_address` VARCHAR(255), IN `pass` VARCHAR(255))   BEGIN
    INSERT INTO students (
        user_id,
        sphoto,
        sr_code,
        first_name,
        last_name,
        gender,
        username,
        email_address,
        pass
    )
    VALUES (
        user_id,
        sphoto,
        sr_code,
        first_name,
        last_name,
        gender,
        username,
        email_address,
        pass
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_tutor` (IN `user_id` INT, IN `first_name` VARCHAR(50), IN `last_name` VARCHAR(50), IN `gender` ENUM('Male','Female','Prefer not to say'), IN `username` VARCHAR(50), IN `email_address` VARCHAR(255), IN `pass` VARCHAR(255), IN `tphoto` VARCHAR(255), IN `photo_credentials` VARCHAR(255))   BEGIN
    INSERT INTO tutors (
        user_id,
        first_name,
        last_name,
        gender,
        username,
        email_address,
        pass,
        tphoto,
        cphoto
    )
    VALUES (
        user_id,
        first_name,
        last_name,
        gender,
        username,
        email_address,
        pass,
        tphoto,
        cphoto
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_user` (IN `username` VARCHAR(50), IN `pass` VARCHAR(255))   BEGIN
    INSERT INTO users (username, pass)
    VALUES (username, pass);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sphoto` varchar(255) DEFAULT NULL,
  `sr_code` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Prefer not to say') NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `is_verified` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `user_id`, `sphoto`, `sr_code`, `first_name`, `last_name`, `gender`, `username`, `email_address`, `pass`, `is_verified`) VALUES
(28, 83, 'uploads/Sphoto/Medrazo_d7.png', '23-11111', 'Klyzza ', 'Medrazo', 'Male', 'Medrazo', 'Medrazo@gmail.com', '$2y$10$9IFJ0/8EPMx8cAKlbrEj9OuPiDZuoa8UMl1RWQE31jgfBEgg7c3N.', 'Pending'),
(29, 84, 'uploads/Sphoto/Rudio_d8.png', '23-22222', 'Khing Patrick', 'Rudio', 'Male', 'Rudio', 'Rudio@gmail.com', '$2y$10$p8drR1hhpIVjoknBSvYhlOQqdAnvS4XKR5zCjluh2KdceTBd4.Oey', 'Pending'),
(30, 85, 'uploads/Sphoto/Maranan_d5.png', '23-33333', 'Gizelle', 'Maranan', 'Female', 'Maranan', 'Maranan@gmail.com', '$2y$10$e2V6TcZ7mzRovW4Yp/P7Z.tvy3Fe86RHD.RXGueuUsbqZjfKyExuy', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `student_tutors`
--

CREATE TABLE `student_tutors` (
  `student_id` int(11) NOT NULL,
  `tutor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`) VALUES
(4, 'Advanced Computer Programming'),
(2, 'Computer Programming'),
(3, 'Data Structures and Algorithms'),
(5, 'Database Management System'),
(1, 'Introduction to Computing'),
(6, 'Object Oriented Programming');

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `tutor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tphoto` varchar(255) DEFAULT NULL,
  `cphoto` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Prefer not to say') NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `is_verified` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`tutor_id`, `user_id`, `tphoto`, `cphoto`, `first_name`, `last_name`, `gender`, `username`, `email_address`, `pass`, `is_verified`) VALUES
(18, 78, 'uploads/Tphoto/ttest2_d2.png', '', 'Jan Nole', 'Matres', 'Male', 'ttest2', 'jnkmatres@gmail.com', '$2y$10$Pc5iSTornnJBLdcrMYu9meb4W5wXUMPOQPjbWnHBQWOW4mU2d3cSm', 'Approved'),
(19, 79, 'uploads/Tphoto/Christine May_ttest_d1.png', '', 'Christine May', 'Padua', 'Female', 'Christine May', 'tin@gmail.com', '$2y$10$i3OpGQjIySKycpthkVanH.IjsAhAjUhxWNyguksiEs.CwBqMmgnU.', 'Approved'),
(20, 80, 'uploads/Tphoto/Austria_d3.png', '', 'Jimae Zabdiel', 'Austria', 'Female', 'Austria', 'austria@gmail.com', '$2y$10$Hc.swMe3zy56ZPo5MFSQI.dgiL5FxJ6m5ZzY0VUzeRdXwziuQ.lNy', 'Approved'),
(21, 81, 'uploads/Tphoto/De Silva_d6.png', '', 'Ace Russell', 'De Silva', 'Male', 'De Silva', 'Silva@gmail.com', '$2y$10$pv9aTwtDedO80vaWkH6uCO8KbiuROfbbVFr/sqAv/TmCu1bix6qsC', 'Approved'),
(22, 82, 'uploads/Tphoto/Bunsay_d4.png', '', 'Mark', 'Bunsay', 'Male', 'Bunsay', 'Bunsay@gmail.com', '$2y$10$q3JgDrFGbZ5BeAveELSLR.7YKP0MIa.QzuAyaSOy0WnnbfbIut1Em', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `tutor_profiles`
--

CREATE TABLE `tutor_profiles` (
  `profile_id` int(11) NOT NULL,
  `tutor_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutor_profiles`
--

INSERT INTO `tutor_profiles` (`profile_id`, `tutor_id`, `name`, `subject`, `language`, `description`, `image`) VALUES
(1, 18, 'Jan Nole Matres', 'Computer Programming', 'English ', 'I have knowledge within HTML, CSS, Java, Python and SQL. \r\nYou can contact me via.\r\nFacebook, Discord or Email.', 'uploads/tutor_images/tutor_18_ttest2_d2.png'),
(2, 19, 'Christine May Padua', 'Data Structures and Algorithms', 'English, Filipino', 'With 5+ experience in SQL. I am a very capable tutor with tons of job experiences i can tell you all about.', 'uploads/tutor_images/tutor_19_d1.png'),
(3, 20, 'Jimae Zabdiel Austria', 'Database Management Systems', 'English, Filipino', 'I can teach you all about SQL.\r\n\r\nYou can message me via Facebook, Email and Twitter.', 'uploads/tutor_images/tutor_20_d3.png'),
(4, 21, 'Introduction to Computing', 'Introduction to Computing', 'Filipino, Chinese, Japanese, Spanish, German, Latin, English', 'I can teach you the basics of HTML and CSS and how to apply PHP.\r\nI also have 3 years of work experience to teach you.\r\nYou can Message me via Facebook, Instagram and Twitter.', 'uploads/tutor_images/tutor_21_d6.png'),
(5, 22, 'Mark Bunsay', 'Object Oriented Programming', 'English, Filipino', 'I can teach you how to functionally apply your code using OOP and give you the basic industry standards.\r\n\r\nYou can message me via Messenger ,Twitter , Email and Instagram.', 'uploads/tutor_images/tutor_22_d4.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `pass`) VALUES
(73, 'test', '$2y$10$ufrpw86/m2EByRbyDlRnDeIm7ZRBTri0v2KEOEn5Xt3vfbXRsG9m.'),
(74, 'test2', '$2y$10$Qp8y9tZFKh0FdiKuHd2sGuiDPTQIAXbEtdDq1mvXBMkGs6ASx5QxW'),
(75, 'Matres', '$2y$10$4LtqJHVgIC1VQmnhZ1ocMOjg4Dtq.22jaP2HqoMKfkH4nESPyFFT2'),
(76, 'Padua', '$2y$10$NTGeJuvl52ZS6yDGLexgXO.PSOFKfebA1tSs5vGnuxvgBEHuJO3mS'),
(77, 'ttest', '$2y$10$JVlq/22z8Rlj0yE1RWHwW.Uurom8U24w3RRevKqZyp6RT4QlNDjc.'),
(78, 'ttest2', '$2y$10$Pc5iSTornnJBLdcrMYu9meb4W5wXUMPOQPjbWnHBQWOW4mU2d3cSm'),
(79, 'Christine May', '$2y$10$i3OpGQjIySKycpthkVanH.IjsAhAjUhxWNyguksiEs.CwBqMmgnU.'),
(80, 'Austria', '$2y$10$Hc.swMe3zy56ZPo5MFSQI.dgiL5FxJ6m5ZzY0VUzeRdXwziuQ.lNy'),
(81, 'De Silva', '$2y$10$pv9aTwtDedO80vaWkH6uCO8KbiuROfbbVFr/sqAv/TmCu1bix6qsC'),
(82, 'Bunsay', '$2y$10$q3JgDrFGbZ5BeAveELSLR.7YKP0MIa.QzuAyaSOy0WnnbfbIut1Em'),
(83, 'Medrazo', '$2y$10$9IFJ0/8EPMx8cAKlbrEj9OuPiDZuoa8UMl1RWQE31jgfBEgg7c3N.'),
(84, 'Rudio', '$2y$10$p8drR1hhpIVjoknBSvYhlOQqdAnvS4XKR5zCjluh2KdceTBd4.Oey'),
(85, 'Maranan', '$2y$10$e2V6TcZ7mzRovW4Yp/P7Z.tvy3Fe86RHD.RXGueuUsbqZjfKyExuy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `student_tutors`
--
ALTER TABLE `student_tutors`
  ADD PRIMARY KEY (`student_id`,`tutor_id`),
  ADD KEY `tutor_id` (`tutor_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `subject_name` (`subject_name`);

--
-- Indexes for table `tutors`
--
ALTER TABLE `tutors`
  ADD PRIMARY KEY (`tutor_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `tutor_profiles`
--
ALTER TABLE `tutor_profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `tutor_id` (`tutor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tutors`
--
ALTER TABLE `tutors`
  MODIFY `tutor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tutor_profiles`
--
ALTER TABLE `tutor_profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `student_tutors`
--
ALTER TABLE `student_tutors`
  ADD CONSTRAINT `student_tutors_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `student_tutors_ibfk_2` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`tutor_id`);

--
-- Constraints for table `tutors`
--
ALTER TABLE `tutors`
  ADD CONSTRAINT `tutors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `tutor_profiles`
--
ALTER TABLE `tutor_profiles`
  ADD CONSTRAINT `tutor_profiles_ibfk_1` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`tutor_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

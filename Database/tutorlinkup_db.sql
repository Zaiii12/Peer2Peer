-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2025 at 06:23 AM
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
(24, 68, 'uploads/Sphoto/test1_test.png', '23-39476', 'Jan Nole', 'Matres', 'Male', 'test1', 'test@gmail.com', '$2y$10$lisqiJObtpLHRIYOjk2ZY.EKFB5eWk2ARBl6xcocFZ/hPsLrCcAtm', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `student_subjects`
--
-- Error reading structure for table tutorlinkup_db.student_subjects: #1932 - Table &#039;tutorlinkup_db.student_subjects&#039; doesn&#039;t exist in engine
-- Error reading data for table tutorlinkup_db.student_subjects: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `tutorlinkup_db`.`student_subjects`&#039; at line 1

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

-- --------------------------------------------------------

--
-- Table structure for table `tutor_verification`
--

CREATE TABLE `tutor_verification` (
  `verification_id` int(11) NOT NULL,
  `tutor_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `verified_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(68, 'test1', '$2y$10$lisqiJObtpLHRIYOjk2ZY.EKFB5eWk2ARBl6xcocFZ/hPsLrCcAtm');

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
-- Indexes for table `tutor_verification`
--
ALTER TABLE `tutor_verification`
  ADD PRIMARY KEY (`verification_id`),
  ADD KEY `tutor_id` (`tutor_id`),
  ADD KEY `admin_id` (`admin_id`);

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
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutors`
--
ALTER TABLE `tutors`
  MODIFY `tutor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tutor_verification`
--
ALTER TABLE `tutor_verification`
  MODIFY `verification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

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
-- Constraints for table `tutor_verification`
--
ALTER TABLE `tutor_verification`
  ADD CONSTRAINT `tutor_verification_ibfk_1` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`tutor_id`),
  ADD CONSTRAINT `tutor_verification_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

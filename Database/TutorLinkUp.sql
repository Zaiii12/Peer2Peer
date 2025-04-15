-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 03:38 AM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_student` (IN `photo` VARCHAR(255), IN `sr_code` VARCHAR(255), IN `first_name` VARCHAR(255), IN `last_name` VARCHAR(255), IN `gender` VARCHAR(50), IN `username` VARCHAR(50), IN `email_address` VARCHAR(100), IN `pass` VARCHAR(255), IN `user_id` INT)   BEGIN
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_tutor` (IN `input_first_name` VARCHAR(255), IN `input_last_name` VARCHAR(255), IN `input_gender` VARCHAR(10), IN `input_username` VARCHAR(255), IN `input_email_address` VARCHAR(255), IN `input_pass` VARCHAR(255), IN `input_photo` VARCHAR(255), IN `input_photo_credentials` VARCHAR(255), OUT `result_message` VARCHAR(255))   BEGIN
    DECLARE username_exists INT DEFAULT 0;
    DECLARE user_id INT;
    
    SELECT COUNT(*) INTO username_exists FROM users WHERE username = input_username;
    
    IF username_exists > 0 THEN
        SET result_message = 'Username already exists. Please choose a different username.';
    ELSE
        SET @hashedPassword = PASSWORD(input_pass);

        INSERT INTO users (username, pass) VALUES (input_username, @hashedPassword);
        SET user_id = LAST_INSERT_ID();

        INSERT INTO tutors (photo, photo_credentials, first_name, last_name, gender, username, email_address, pass, user_id, is_verified)
        VALUES (input_photo, input_photo_credentials, input_first_name, input_last_name, input_gender, input_username, input_email_address, @hashedPassword, user_id, 0);

        SET result_message = 'Tutor has been signed up and is pending approval!';
    END IF;
    
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
  `photo` varchar(255) DEFAULT NULL,
  `sr_code` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Prefer not to say') NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `user_id`, `photo`, `sr_code`, `first_name`, `last_name`, `gender`, `username`, `email_address`, `pass`) VALUES
(4, 20, 'uploads/test.png', '23-39476', 'Jan Nole', 'Matres', 'Male', 'test1', 'test@gmail.com', '$2y$10$tOFYdfD22trU2UXvqJkmHe2CozxZM4rpYDV0ow6AaBH');

-- --------------------------------------------------------

--
-- Table structure for table `student_subjects`
--

CREATE TABLE `student_subjects` (
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `photo` varchar(255) DEFAULT NULL,
  `photo_credentials` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Prefer not to say') NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `is_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`tutor_id`, `user_id`, `photo`, `photo_credentials`, `first_name`, `last_name`, `gender`, `username`, `email_address`, `pass`, `is_verified`) VALUES
(4, 21, 'Tphoto/test.png', 'Credentials/test.png', 'Jan Nole', 'Matres', 'Male', 'test5', 'test@gmail.com', '*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29', 0),
(5, 22, 'Tphoto/test.png', 'Credentials/test.png', 'Jan Nole', 'Matres', 'Male', 'test78', 'test@gmail.com', '*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29', 0);

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
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `pass`) VALUES
(20, 'test1', '$2y$10$tOFYdfD22trU2UXvqJkmHe2CozxZM4rpYDV0ow6AaBHEDl9MigoO2'),
(21, 'test5', '*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29'),
(22, 'test78', '*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29'),
(23, '321', '$2y$10$xyOcJ5FNVbgU/hK.0y1eC.56K0lyIeLfa06GRJDOIzzBHVRRRuxsq'),
(24, '4321', '$2y$10$Ghwtfurap3Ebs9jyPA2ZkOSoKuwsTImNwS34yVmZ4srf2ZL2RvxCa');

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
-- Indexes for table `student_subjects`
--
ALTER TABLE `student_subjects`
  ADD PRIMARY KEY (`student_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`);

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
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutors`
--
ALTER TABLE `tutors`
  MODIFY `tutor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tutor_verification`
--
ALTER TABLE `tutor_verification`
  MODIFY `verification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `student_subjects`
--
ALTER TABLE `student_subjects`
  ADD CONSTRAINT `student_subjects_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `student_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

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

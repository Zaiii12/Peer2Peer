
CREATE DATABASE tutorLinkUp_db;
USE tutorLinkUp_db;

-- Users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    role ENUM('student', 'tutor') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Students table
CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    photo VARCHAR(255),
    sr_code VARCHAR(50) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    gender ENUM('Male', 'Female', 'Prefer not to say') NOT NULL,
    username VARCHAR(50) NOT NULL,
    email_address VARCHAR(255) NOT NULL,
    pass VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Tutors table
CREATE TABLE tutors (
    tutor_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    photo VARCHAR(255),
    photo_credentials VARCHAR(255) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    gender ENUM('Male', 'Female', 'Prefer not to say') NOT NULL,
    username VARCHAR(50) NOT NULL,
    email_address VARCHAR(255) NOT NULL,
    pass VARCHAR(50) NOT NULL,
    is_verified BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Admin table
CREATE TABLE admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL
);

-- Tutor Verification table
CREATE TABLE tutor_verification (
    verification_id INT AUTO_INCREMENT PRIMARY KEY,
    tutor_id INT NOT NULL,
    admin_id INT NOT NULL,
    verified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tutor_id) REFERENCES tutors(tutor_id),
    FOREIGN KEY (admin_id) REFERENCES admin(admin_id)
);

-- Subjects table
CREATE TABLE subjects (
    subject_id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(255) UNIQUE NOT NULL
);

-- Many-to-Many: Students <-> Subjects
CREATE TABLE student_subjects (
    student_id INT NOT NULL,
    subject_id INT NOT NULL,
    PRIMARY KEY (student_id, subject_id),
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (subject_id) REFERENCES subjects(subject_id)
);

-- Many-to-Many: Students <-> Tutors
CREATE TABLE student_tutors (
    student_id INT NOT NULL,
    tutor_id INT NOT NULL,
    PRIMARY KEY (student_id, tutor_id),
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (tutor_id) REFERENCES tutors(tutor_id)
);

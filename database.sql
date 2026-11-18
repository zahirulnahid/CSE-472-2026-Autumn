-- Student Management: database setup
-- Run with:  sudo mysql < database.sql

CREATE DATABASE IF NOT EXISTS student_db;
USE student_db;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id VARCHAR(20) NOT NULL UNIQUE,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  department VARCHAR(50) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Database account used by the PHP app (password must match config.php)
CREATE USER IF NOT EXISTS 'student_admin'@'localhost' IDENTIFIED BY 'Student@Pass123';
GRANT SELECT, INSERT, UPDATE, DELETE ON student_db.* TO 'student_admin'@'localhost';
FLUSH PRIVILEGES;

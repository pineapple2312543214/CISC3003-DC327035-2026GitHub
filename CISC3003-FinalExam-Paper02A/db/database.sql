CREATE DATABASE IF NOT EXISTS paper02a_db;
USE paper02a_db;

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    message TEXT NOT NULL,
    programme VARCHAR(100) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    interests TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

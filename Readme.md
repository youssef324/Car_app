bash
# 🚗 Car Dealership CRUD Application

A full-featured PHP CRUD (Create, Read, Update, Delete) application for managing a car dealership inventory, built with security demonstrations including SQL injection vulnerabilities.

![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Apache](https://img.shields.io/badge/Apache-D22128?style=for-the-badge&logo=apache&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

## 📋 Table of Contents
- [Features](#features)
- [Project Structure](#project-structure)
- [Installation](#installation)
- [Usage](#usage)
- [API Endpoints](#api-endpoints)


## ✨ Features

- **🔧 Full CRUD Operations** - Create, Read, Update, Delete cars
- **🛡️ Security Demonstrations** - Both secure and vulnerable code examples
- **📱 Responsive Design** - Works on all devices
- **🎯 User-Friendly Interface** - Clean and intuitive UI
- **🔍 Search Functionality** - Find cars by model
- **📊 Data Validation** - Input validation and error handling

## 📁 Project Structure
Car_app/<br>
├── config.php # Database configuration<br>
├── index.php # List all cars (Read)<br>
├── create.php # Add new car (Create)<br>
├── show.php # Show car details (Read)<br>
├── update.php # Edit car information (Update)<br>
├── delete.php # Remove car (Delete)<br>
├── vulnerable_search.php # SQL Injection demonstration<br>
└── README.md # Project documentation<br>

## 🚀 Installation

### Prerequisites
- XAMPP/WAMP/MAMP stack
- PHP 7.4+
- MySQL 5.7+
- Apache Web Server

### Step-by-Step Setup

1. **Clone the repository**
   
   git clone https://github.com/youssef324/Car_app.git
   cd Car_app
Setup XAMPP


# Download and install XAMPP from https://www.apachefriends.org/
# Start Apache and MySQL from XAMPP Control Panel
Move project to htdocs


# Windows
copy Car_app C:\xampp\htdocs\

# macOS/Linux
cp -r Car_app /Applications/XAMPP/htdocs/
# Create Database

sql
CREATE DATABASE car_dealership;

USE car_dealership;

CREATE TABLE cars (
    car_id INT AUTO_INCREMENT PRIMARY KEY,
    model VARCHAR(255) NOT NULL,
    used BOOLEAN NOT NULL,
    sale_date DATE,
    price DECIMAL(10,2) NOT NULL
);
Insert Sample Data

sql:
INSERT INTO cars (model, used, sale_date, price) VALUES
('Toyota Camry', 1, '2024-01-15', 15000.00),
('Honda Civic', 0, '2024-02-20', 22000.00),
('Ford Mustang', 1, '2024-03-10', 25000.00),
('BMW X5', 0, '2024-04-05', 45000.00);
Configure Database Connection

php
// Edit config.php with your database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "car_dealership";
💻 Usage
Start the application

bash
# Open your browser and navigate to:
http://localhost/Car_app/index.php
Access different features:

View All Cars: http://localhost/Car_app/index.php

Add New Car: http://localhost/Car_app/create.php

Search Cars: http://localhost/Car_app/vulnerable_search.php

##🔗 API Endpoints
Method	Endpoint	Description <br>
GET	/index.php	List all cars<br>
GET	/show.php?car_id=1	Show specific car<br>
GET/POST	/create.php	Create new car<br>
GET/POST	/update.php?car_id=1	Update car details<br>
GET	/delete.php?car_id=1	Delete car<br>
POST	/vulnerable_search.php	Search cars (vulnerable)<br>
## 🛡️ Security Features
Secure Implementation
 Prepared statements in CRUD operations
 Input validation and sanitization<br>
 Error handling without information leakage
 SQL injection prevention

Vulnerable Implementation
 Direct string concatenation in SQL queries<br>
 No input sanitization in search functionality
 Demonstrates real-world security risks

## 🎯 SQL Injection Demo
Vulnerable Endpoint
File: vulnerable_search.php

Example Attacks:<br>
Show All Cars

sql
Input:<br> ' OR '1'='1
Query: SELECT * FROM cars WHERE model = '' OR '1'='1'
Bypass Authentication

sql
Input:<br> ' OR 1=1 -- 
Query: SELECT * FROM cars WHERE model = '' OR 1=1 -- '
Database Information

sql
Input: <br>' UNION SELECT 1,database(),user(),version(),5 -- <br><br>
How to Test:
Navigate to http://localhost/Car_app/vulnerable_search.php

Enter the SQL injection payloads in the search box

Observe how the application behavior changes


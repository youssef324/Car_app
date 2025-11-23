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
- [Security Features](#security-features)
- [SQL Injection Demo](#sql-injection-demo)
- [Screenshots](#screenshots)
- [Technologies Used](#technologies-used)
- [Contributing](#contributing)
- [License](#license)

## ✨ Features

- **🔧 Full CRUD Operations** - Create, Read, Update, Delete cars
- **🛡️ Security Demonstrations** - Both secure and vulnerable code examples
- **📱 Responsive Design** - Works on all devices
- **🎯 User-Friendly Interface** - Clean and intuitive UI
- **🔍 Search Functionality** - Find cars by model
- **📊 Data Validation** - Input validation and error handling

## 📁 Project Structure
Car_app/
├── config.php # Database configuration
├── index.php # List all cars (Read)
├── create.php # Add new car (Create)
├── show.php # Show car details (Read)
├── update.php # Edit car information (Update)
├── delete.php # Remove car (Delete)
├── vulnerable_search.php # SQL Injection demonstration
└── README.md # Project documentation

text

## 🚀 Installation

### Prerequisites
- XAMPP/WAMP/MAMP stack
- PHP 7.4+
- MySQL 5.7+
- Apache Web Server

### Step-by-Step Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/youssef324/Car_app.git
   cd Car_app
Setup XAMPP

bash
# Download and install XAMPP from https://www.apachefriends.org/
# Start Apache and MySQL from XAMPP Control Panel
Move project to htdocs

bash
# Windows
copy Car_app C:\xampp\htdocs\

# macOS/Linux
cp -r Car_app /Applications/XAMPP/htdocs/
Create Database

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

sql
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

🔗 API Endpoints
Method	Endpoint	Description
GET	/index.php	List all cars
GET	/show.php?car_id=1	Show specific car
GET/POST	/create.php	Create new car
GET/POST	/update.php?car_id=1	Update car details
GET	/delete.php?car_id=1	Delete car
POST	/vulnerable_search.php	Search cars (vulnerable)
🛡️ Security Features
Secure Implementation
✅ Prepared statements in CRUD operations

✅ Input validation and sanitization

✅ Error handling without information leakage

✅ SQL injection prevention

Vulnerable Implementation
❌ Direct string concatenation in SQL queries

❌ No input sanitization in search functionality

❌ Demonstrates real-world security risks

🎯 SQL Injection Demo
Vulnerable Endpoint
File: vulnerable_search.php

Example Attacks:
Show All Cars

sql
Input: ' OR '1'='1
Query: SELECT * FROM cars WHERE model = '' OR '1'='1'
Bypass Authentication

sql
Input: ' OR 1=1 -- 
Query: SELECT * FROM cars WHERE model = '' OR 1=1 -- '
Database Information

sql
Input: ' UNION SELECT 1,database(),user(),version(),5 -- 
How to Test:
Navigate to http://localhost/Car_app/vulnerable_search.php

Enter the SQL injection payloads in the search box

Observe how the application behavior changes

📸 Screenshots
Main Dashboard
https://via.placeholder.com/800x400/4A90E2/FFFFFF?text=Car+Dealership+Dashboard

SQL Injection Demo
https://via.placeholder.com/800x400/E74C3C/FFFFFF?text=SQL+Injection+Demo

Add New Car
https://via.placeholder.com/800x400/27AE60/FFFFFF?text=Add+New+Car+Form

🛠️ Technologies Used
Backend: PHP 8.0+

Database: MySQL/MariaDB

Server: Apache HTTP Server

Frontend: HTML5, CSS3, JavaScript

Security: Prepared Statements, Input Validation

🤝 Contributing
We welcome contributions! Please feel free to submit pull requests or open issues for bugs and feature requests.

Contribution Steps:
Fork the repository

Create a feature branch (git checkout -b feature/AmazingFeature)

Commit your changes (git commit -m 'Add some AmazingFeature')

Push to the branch (git push origin feature/AmazingFeature)

Open a Pull Request
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
├── index.php  # List all cars (Read)
├── create.php  # Add new car (Create)
├── show.php # Show car details (Read)
├── update.php # Edit car information (Update)
├── delete.php # Remove car (Delete)
├── vulnerable_search.php # SQL Injection demonstration
└── README.md # Project documentation
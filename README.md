# Invigilation Scheduling Timetable Web Application

## Overview:
This project aims to create a web-based tool for scheduling invigilation timetables for the faculty of engineering. It is built using Laravel framework, MySQL as the database, JavaScript for front-end interactivity, and Bootstrap for responsive design.

## Features:
- **Scheduling:** Automated scheduling of invigilators for exams and assessments.
- **User Management:** A user-friendly interface for managing invigilator schedules and availability.
- **Database Integration:** Integration with MySQL for storing and retrieving scheduling data.

## Project Structure:
- **Laravel/:** Contains the Laravel project files, including the application logic, controllers, models, and views.
- **public/:** Includes the front-end assets, such as JavaScript, CSS, and images.
- **database/:** Contains the database migration and seeding files for setting up the MySQL database.
- **README.md:** This file, provides an overview and usage instructions for the project.

## Setup Instructions:
1. **Prerequisites:** Ensure that you have PHP, Composer, MySQL, and Node.js installed on your system.
2. **Clone the Repository:** `git clone https://github.com/Chrispel5/Invigilation_Scheduling_timetable`
3. **Install Dependencies:** Run `composer install` and `npm install` in the project root directory.
4. **Database Setup:** Create a MySQL database and configure the connection details in the `.env` file.
5. **Migration & Seeding:** Run `php artisan migrate --seed` to set up the database schema and populate initial data.
6. **Start the Application:** Run `php artisan serve` to start the Laravel development server and access the application in your web browser.

## Usage:
- Open the application in your web browser and use the interface to manage and schedule invigilators for the faculty of engineering.

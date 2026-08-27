To-Do App

A simple and user-friendly To-Do List Web Application built using PHP, MySQL, HTML, CSS, and JavaScript.

The application allows users to log in and manage their personal tasks by adding, viewing, editing, completing, and deleting tasks.

Features
--------
User login
Session-based authentication
Add new tasks
View tasks
Edit tasks
Update task details
Change task status
Mark tasks as Pending or Completed
Delete tasks
Delete confirmation popup
Logout confirmation popup
Responsive user interface
MySQL database integration

Technologies Used
-----------------
PHP
MySQL
HTML5
CSS3
JavaScript
XAMPP
phpMyAdmin
Google Fonts

Project Structure
-----------------
To-Do
│
├── index.php
├── dashboard.php
├── tasks.php
├── add_task.php
├── delete.php
├── logout.php
├── db_con.php
│
├── sidebar.php
├── navbar.php
│
├── images
│   └── logo.png
│
├── database
│   └── to-do.sql
│
└── README.md

Requirements
------------
To run this project, you need

XAMPP
PHP
MySQL
phpMyAdmin
Web browser
Installation
1. Install XAMPP

Download and install XAMPP.

Open the XAMPP Control Panel and start

Apache
MySQL

2. Copy the Project

Copy the To-Do folder into the XAMPP htdocs folder.

Example

CxampphtdocsTo-Do

3. Create the Database

Open phpMyAdmin in your browser

httplocalhostphpmyadmin


Create a new database

to-do

4. Import the Database

Select the to-do database in phpMyAdmin.

Click

Import


Select

databaseto-do.sql


Then click Import.

Your tables will be created automatically.

Database Configuration

Open

db_con.php


Example configuration

php

$host = localhost;
$username = root;
$password = ;
$database = to-do;

$conn = mysqli_connect(
    $host,
    $username,
    $password,
    $database
);

if (!$conn) {
    die(Database connection failed  . mysqli_connect_error());
}


For a default XAMPP installation

Host localhost
Username root
Password empty
Database to-do


If your MySQL configuration is different, update the values in db_con.php.

Run the Project

Start Apache and MySQL in XAMPP.

Then open

httplocalhostTo-Do


The login page will be displayed.

How to Use
Login

Enter your username and password to access the application.

After successful login, you will be redirected to the main application page.

Add Task

Click the

+ Add Task


button.

Enter

Task title
Description
Status
Date

Then click Add Task.

View Tasks

All active tasks belonging to the logged-in user are displayed in the task table.

Each task shows

ID
Task title
Description
Status
Date
Actions
Edit Task

Click the Edit button.

The task fields will become editable.

You can change

Task title
Description
Status
Date

Click Update to save the changes.

Delete Task

Click the Delete button.

A confirmation popup will appear.

Click Delete to confirm the deletion.

Logout

Click the logout option.

A confirmation popup will appear.

Click Logout to end the session.

Task Status

The application has two task statuses

Pending
Completed


Pending tasks are displayed with a yellow status indicator.

Completed tasks are displayed with a green status indicator.

Database

The project uses MySQL to store

User information
Task information
Task status
Task dates
Task descriptions

The database backup is provided as

databaseto-do.sql

Backup Database

To create a database backup

Open phpMyAdmin.
Select to-do.
Click Export.
Select Quick.
Select SQL format.
Click Export.

The downloaded .sql file can be used to restore the database later.

Future Improvements

Some features that can be added in the future

Task search
Task filtering
Task categories
Task priority
Due-date reminders
Dark mode
User profile
Pagination
Better form validation
Improved security
AJAX-based task management
Author

Your Name

PHP & MySQL To-Do App

License

This project was created for educational and project-development purposes.

# Simple-SQLite-database
A simple example of a website with a backend using SQLite and PHP, that you can host anywhere, without any additional setup.
The example PHP script using SQLite for a single-page website with a student attendance form. There are two pages: one for submitting attendance and one for viewing the attendance data based on the student's roll number.


## Getting started

Download this repository, and extract the zip file.

Upload all the files into your hosting server.


**Files summary**
<br/>
1. create_database.php: Run this script once to create the SQLite database and table.
2. index.html: HTML form for submitting attendance.
3. submit_attendance.php: PHP script to save attendance data to the SQLite database.
4. view_attendance.html: HTML form to input a roll number to view attendance data.
5.view_attendance.php: PHP script to retrieve and display attendance data based on the roll number.
<br/>

You can host these files on a web server that supports PHP. Ensure the server has write permissions to create and modify the `students.db` SQLite file. 

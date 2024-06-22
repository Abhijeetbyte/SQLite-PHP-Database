# PHP-SQLite-Database


A **simple** example of a website with a backend using SQLite and PHP that you can host **anywhere**, without any **additional setup**. <br/>
This example PHP script uses SQLite for a single-page website with a student attendance form. There are two pages: one for submitting attendance and one for viewing the attendance data based on the student's roll number.

## Getting started

**Download this repository and extract the zip file.** ⬇

**Upload all the files into your hosting server.** 🚀

## Files

1. **create_database.php**: Run this script once to create the SQLite database and table.
2. **index.html**: HTML form for submitting attendance.
3. **submit_attendance.php**: PHP script to save attendance data to the SQLite database.
4. **view_attendance.html**: HTML form to input a roll number to view attendance data.
5. **view_attendance.php**: PHP script to retrieve and display attendance data based on the roll number.

You can host these files on a web server that supports PHP. Ensure the server has write permissions to create and modify the `students.db` SQLite file.

## Usage

### Step 1: Create the Database

Run `create_database.php` once to create the SQLite database and table. You can do this by navigating to `create_database.php` in your browser: 
`http://yourdomain.com/create_database.php`

### Step 2: Submit Attendance

Navigate to `index.html` in your browser and use the form to submit attendance: `http://yourdomain.com/index.html`

### Step 3: View Attendance

Navigate to `view_attendance.html` in your browser and use the form to input a roll number and view the attendance data: `http://yourdomain.com/view_attendance.html`
<br/>

## Notes
- Ensure your web server has write permissions to create and modify the `students.db` SQLite file.
- The database file `students.db` will be created in the directory specified in the PHP scripts.
- Implement security measures like restricting access to the database file using `.htaccess` for Apache or appropriate configurations for other web servers.
- Set correct file permissions for the SQLite database file (e.g., `chmod 600` on Unix-based systems).

## Summary
* SQLite: A file-based database system.
* Database File: students.db stores the entire database.
* PHP Scripts: Use PHP Data Objects (PDO) to interact with the SQLite database.
  - create_database.php: Sets up the database and table.
  - submit_attendance.php: Inserts data into the database.
  - view_attendance.php: Retrieves data from the database.
    
This simple setup makes SQLite an excellent choice for small to medium-sized applications, especially where ease of setup and use is important.

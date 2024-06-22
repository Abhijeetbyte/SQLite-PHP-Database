<?php
// Create (connect to) SQLite database in file
$db = new PDO('sqlite:students.db');

// Set errormode to exceptions
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create table
$db->exec("CREATE TABLE IF NOT EXISTS Attendance (
    id INTEGER PRIMARY KEY, 
    roll_no TEXT, 
    student_name TEXT, 
    date TEXT
)");

echo "Database and table created successfully.";
?>

<?php
try {
    // Connect to SQLite database
    $db = new PDO('sqlite:students.db');
    
    // Set error mode to throw exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create table if it doesn't exist
    $db->exec("CREATE TABLE IF NOT EXISTS Attendance (
        id INTEGER PRIMARY KEY,
        roll_no TEXT,
        student_name TEXT,
        date TEXT
    )");

    // Success message
    echo "Database and table created successfully.";
} catch (PDOException $e) {
    // Log error to server logs
    error_log("Database error: " . $e->getMessage());

    // Error message for users
    echo "An error occurred. Please try again later.";
}
?>

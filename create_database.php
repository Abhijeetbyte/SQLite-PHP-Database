<?php
try {
    // Create (or open) the SQLite database
    $db = new PDO('sqlite:records.db');

    // Set error mode to exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the students table if it doesn't exist
    $query = "CREATE TABLE IF NOT EXISTS students (
        id INTEGER PRIMARY KEY,
        roll_number TEXT UNIQUE,
        name TEXT,
        date TEXT
    )";
    $db->exec($query);

    // Confirm table creation
    echo "Database and table created successfully.";
} catch (PDOException $e) {
    // Log the error message
    error_log($e->getMessage());
    echo "An error occurred while creating the database.";
}
?>

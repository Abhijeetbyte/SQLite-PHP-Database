<?php
try {
    // Check if required GET fields are set and not empty
    if (empty($_GET['roll_number'])) {
        throw new Exception('Roll number is required.');
    }

    // Connect to the SQLite database
    $db = new PDO('sqlite:students.db');

    // Set error mode to exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sanitize user input
    $roll_number = filter_input(INPUT_GET, 'roll_number', FILTER_SANITIZE_STRING);

    // Prepare an SQL statement for safe selection
    $stmt = $db->prepare("SELECT * FROM students WHERE roll_number = :roll_number");

    // Bind the roll_number parameter
    $stmt->bindParam(':roll_number', $roll_number);

    // Execute the statement
    $stmt->execute();

    // Fetch the result
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display the result if found
    if ($student) {
        echo "Roll Number: " . htmlspecialchars($student['roll_number']) . "<br>";
        echo "Name: " . htmlspecialchars($student['name']) . "<br>";
        echo "Date: " . htmlspecialchars($student['date']) . "<br>";
    } else {
        echo "No attendance record found for the provided roll number.";
    }
} catch (Exception $e) {
    // Log the error message
    error_log($e->getMessage());
    echo "An error occurred: " . htmlspecialchars($e->getMessage());
} catch (PDOException $e) {
    // Log the error message
    error_log($e->getMessage());
    echo "An error occurred while retrieving attendance data.";
}
?>

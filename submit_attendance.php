<?php
try {
    // Check if required POST fields are set and not empty
    if (empty($_POST['roll_number']) || empty($_POST['name']) || empty($_POST['date'])) {
        throw new Exception('All fields are required.');
    }

    // Connect to the SQLite database
    $db = new PDO('sqlite:students.db');

    // Set error mode to exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sanitize user input
    $roll_number = filter_input(INPUT_POST, 'roll_number', FILTER_SANITIZE_STRING);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);

    // Prepare an SQL statement for safe insertion
    $stmt = $db->prepare("INSERT INTO students (roll_number, name, date) VALUES (:roll_number, :name, :date)");

    // Bind values to the parameters
    $stmt->bindParam(':roll_number', $roll_number);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':date', $date);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Attendance submitted successfully.";
    } else {
        echo "Error submitting attendance.";
    }
} catch (Exception $e) {
    // Log the error message
    error_log($e->getMessage());
    echo "An error occurred: " . htmlspecialchars($e->getMessage());
} catch (PDOException $e) {
    // Log the error message
    error_log($e->getMessage());
    echo "An error occurred while submitting attendance.";
}
?>

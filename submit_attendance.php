<?php
// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

try {
    // Connect to SQLite database
    $db = new PDO('sqlite:students.db');
    
    // Set error mode to throw exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sanitize and validate inputs
    $roll_no = sanitize_input($_POST['roll_no']);
    $student_name = sanitize_input($_POST['student_name']);

    // Check if any field is empty
    if (empty($roll_no) || empty($student_name)) {
        throw new Exception("All fields are required.");
    }

    // Prepare SQL statement to insert data
    $stmt = $db->prepare("INSERT INTO Attendance (roll_no, student_name, date) VALUES (:roll_no, :student_name, :date)");
    $stmt->bindParam(':roll_no', $roll_no);
    $stmt->bindParam(':student_name', $student_name);
    $stmt->bindParam(':date', date('Y-m-d'));
    
    // Execute SQL statement
    $stmt->execute();

    // Success message
    echo "Attendance recorded successfully.";
} catch (Exception $e) {
    // Log error to server logs
    error_log("Error: " . $e->getMessage());

    // Error message for users
    echo "An error occurred. Please try again later.";
}
?>

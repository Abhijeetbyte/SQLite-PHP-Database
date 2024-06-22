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

    // Sanitize and validate input
    $roll_no = sanitize_input($_GET['roll_no']);

    // Check if roll number is provided
    if (empty($roll_no)) {
        throw new Exception("Roll number is required.");
    }

    // Prepare SQL statement to fetch attendance data
    $stmt = $db->prepare("SELECT * FROM Attendance WHERE roll_no = :roll_no");
    $stmt->bindParam(':roll_no', $roll_no);
    
    // Execute SQL statement
    $stmt->execute();

    // Fetch all rows as associative array
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display attendance data if found, otherwise show message
    if ($results) {
        echo "<table border='1' style='margin: 20px auto; border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Roll No</th><th>Student Name</th><th>Date</th></tr>";
        foreach ($results as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['roll_no']) . "</td>";
            echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No records found for roll number " . htmlspecialchars($roll_no);
    }
} catch (Exception $e) {
    // Log error to server logs
    error_log("Error: " . $e->getMessage());

    // Error message for users
    echo "An error occurred. Please try again later.";
}
?>

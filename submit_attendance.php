<?php
try {
    // Connect to SQLite database
    $db = new PDO('sqlite:students.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert data into Attendance table
    $stmt = $db->prepare("INSERT INTO Attendance (roll_no, student_name, date) VALUES (:roll_no, :student_name, :date)");
    $stmt->bindParam(':roll_no', $_POST['roll_no']);
    $stmt->bindParam(':student_name', $_POST['student_name']);
    $stmt->bindParam(':date', date('Y-m-d'));
    $stmt->execute();

    echo "Attendance recorded successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

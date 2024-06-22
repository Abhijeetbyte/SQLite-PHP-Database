<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $roll_number = filter_input(INPUT_POST, 'roll_number', FILTER_SANITIZE_STRING);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);

    try {
        // Connect to SQLite database
        $db = new PDO('sqlite:records.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the record already exists for the given roll_number and date
        $stmt_check = $db->prepare('SELECT * FROM students WHERE roll_number = :roll_number AND date = :date');
        $stmt_check->bindParam(':roll_number', $roll_number);
        $stmt_check->bindParam(':date', $date);
        $stmt_check->execute();
        $existing_record = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($existing_record) {
            echo '<p>Attendance already exists for roll number ' . htmlspecialchars($roll_number) . ' on ' . htmlspecialchars($date) . '.</p>';
        } else {
            // Record does not exist, insert a new record
            $stmt_insert = $db->prepare('INSERT INTO students (roll_number, name, date) VALUES (:roll_number, :name, :date)');
            $stmt_insert->bindParam(':roll_number', $roll_number);
            $stmt_insert->bindParam(':name', $name);
            $stmt_insert->bindParam(':date', $date);
            $stmt_insert->execute();
            echo '<p>Attendance recorded successfully for roll number ' . htmlspecialchars($roll_number) . ' on ' . htmlspecialchars($date) . '.</p>';
        }
    } catch (PDOException $e) {
        echo '<p>An error occurred: ' . $e->getMessage() . '</p>';
    }
}
?>

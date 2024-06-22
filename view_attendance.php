<?php
try {
    // Connect to SQLite database
    $db = new PDO('sqlite:students.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Select data from Attendance table
    $stmt = $db->prepare("SELECT * FROM Attendance WHERE roll_no = :roll_no");
    $stmt->bindParam(':roll_no', $_GET['roll_no']);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        echo "<table border='1' style='margin: 20px auto; border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Roll No</th><th>Student Name</th><th>Date</th></tr>";
        foreach ($results as $row) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td style='padding: 10px;'>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No records found for roll number " . htmlspecialchars($_GET['roll_no']);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

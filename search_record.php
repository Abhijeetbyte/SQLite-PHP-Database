<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        p {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Records Table</h1>

    <?php
    // Initialize variables for input data
    $roll_number = '';
    $error_message = '';

    // Check if POST data is received
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize user input
        $roll_number = filter_input(INPUT_POST, 'roll_number', FILTER_SANITIZE_STRING);

        // Validate roll_number
        if (!empty($roll_number)) {
            try {
                // Connect to SQLite database
                $db = new PDO('sqlite:records.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Prepare SQL query to fetch records
                $stmt = $db->prepare('SELECT * FROM students WHERE roll_number = :roll_number');
                $stmt->bindParam(':roll_number', $roll_number);
                $stmt->execute();
                $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Display records in a table
                if ($records) {
                    echo '<table>';
                    echo '<tr><th>Roll Number</th><th>Name</th><th>Date</th></tr>';
                    foreach ($records as $record) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($record['roll_number']) . '</td>';
                        echo '<td>' . htmlspecialchars($record['name']) . '</td>';
                        echo '<td>' . htmlspecialchars($record['date']) . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo '<p>No records found for roll number ' . htmlspecialchars($roll_number) . '</p>';
                }
            } catch (PDOException $e) {
                echo '<p>Database connection error: ' . $e->getMessage() . '</p>';
            }
        } else {
            $error_message = 'Please enter a roll number to view records.';
        }
    } else {
        $error_message = 'Access denied.';
    }

    // Display error message if any
    if (!empty($error_message)) {
        echo '<p>' . htmlspecialchars($error_message) . '</p>';
    }
    ?>

    <p><a href="search_record.html">Back to Search</a></p>
</body>
</html>

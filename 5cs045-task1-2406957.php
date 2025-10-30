<?php
// --- Connect to the MySQL database ---
$mysqli = new mysqli("localhost", "2406957", "Reason@12345", "db2406957");

// --- Check connection ---
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . htmlspecialchars($mysqli->connect_error));
}

// --- Query to get all books ---
$sql = "SELECT * FROM books";
$result = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
</head>
<body>
    <h2>Book List</h2>

    <?php
    if ($result && $result->num_rows > 0) {
        echo "<table border='1' cellpadding='8' cellspacing='0'>
                <tr>
                    <th>Book Name</th>
                    <th>Genre</th>
                    <th>Price (£)</th>
                    <th>Date of Release</th>
                </tr>";

        // --- Fetch and display each book ---
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['Book_name']) . "</td>
                    <td>" . htmlspecialchars($row['Genre']) . "</td>
                    <td>£" . number_format((float)$row['Price'], 2) . "</td>
                    <td>" . htmlspecialchars(date("d/m/Y", strtotime($row['Date_of_release']))) . "</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No books found in the database.</p>";
    }

    // --- Close connection ---
    $mysqli->close();
    ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Car</title>
</head>
<body>
    <form method="POST">
        <label for="model">Model:</label>
        <input type="text" id="model" name="model"><br>

        <input type="submit" value="Show Car">
    </form>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = isset($_POST['model']) ? trim($_POST['model']) : '';

    if ($model === '') {
        echo "<p>Car not found</p>";
        exit;
    }

    $conn = new mysqli("localhost", "root", "", "cars_app");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM cars WHERE model = ?");
    if ($stmt) {
        $stmt->bind_param("s", $model);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $car = $result->fetch_assoc();
            echo "<h2>Car details</h2>";
            echo "<ul>";
            foreach ($car as $key => $value) {
                echo "<li><strong>" . htmlspecialchars($key) . ":</strong> " . htmlspecialchars($value) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Car not found</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Query preparation failed</p>";
    }

    $conn->close();
}
?>
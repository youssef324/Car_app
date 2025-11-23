<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Vulnerable Search</title>
    <style>
        #output {
            margin-top: 12px;
            padding: 12px;
            border: 1px solid #ccc;
            background: #f9f9f9;
            min-height: 40px;
            white-space: pre-wrap;
        }
        label { display:inline-block; width:80px; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>

<form method="post" action="vulnerable_search.php">
    <label for="model">Car Model:</label>
    <input type="text" id="model" name="model">
    <input type="submit" value="Search">
</form>

<div id="output">
<?php
if (isset($_POST['model'])) {
    $model = $_POST['model'];

    if ($model === '') {
        echo "Please enter a car model to search.";
    } else {
        $conn = new mysqli("localhost", "root", "", "cars_app"); 
        if ($conn->connect_error) {
            echo "Connection failed: " . $conn->connect_error;
        } else {
    
            $sql = "SELECT * FROM cars WHERE model = '$model'";
            
            echo "<div class='success'>Executing query: " . htmlspecialchars($sql) . "</div><br>";
            
            try {
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    echo "<strong>Found " . $result->num_rows . " car(s):</strong><br><br>";
                    while ($row = $result->fetch_assoc()) {
                        foreach ($row as $k => $v) {
                            echo "<strong>" . htmlspecialchars($k) . ":</strong> " . htmlspecialchars($v) . "<br>";
                        }
                        echo "<br>";
                    }
                } else {
                    if ($conn->error) {
                        echo "<div class='error'>SQL Error: " . $conn->error . "</div>";
                    } else {
                        echo "No cars found matching your search.";
                    }
                }
            } catch (Exception $e) {
                echo "<div class='error'>Error: " . $e->getMessage() . "</div>";
            }

            $conn->close();
        }
    }
}
?>
</div>

<div style="margin-top: 20px; padding: 10px; background: #fff0f0; border: 1px solid red;">
    <strong>SQL Injection Test Examples:</strong><br>
    • Show all cars: <code>' OR '1'='1</code><br>
    • Show all cars (alternative): <code>' OR 1=1 -- </code><br>
    • Get database info: <code>' UNION SELECT 1,database(),user(),version(),5 -- </code>
</div>

</body>
</html>
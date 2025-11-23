<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model = $_POST['model'];
    $used = isset($_POST['used']) ? 1 : 0; //1=used, 0=new
    $sale_date = $_POST['sale_date'];
    $price = $_POST['price'];

    $conn = new mysqli('localhost', 'root', '', 'cars_app');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO cars (model, used, sale_date, price) VALUES ('$model', '$used', '$sale_date', '$price')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Car</title>
</head>
<body>
    <form method="POST">
        <label for="model">Model:</label>
        <input type="text" id="model" name="model" required><br>

        <label for="used">Used:</label>
        <input type="checkbox" id="used" name="used"><br>

        <label for="sale_date">Sale Date:</label>
        <input type="date" id="sale_date" name="sale_date" required><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
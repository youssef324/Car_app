<?php
$host = '127.0.0.1';
$db   = 'cars_app';
$user = 'root';
$pass = '';

header('Content-Type: text/html; charset=utf-8');


$car_id = filter_input(INPUT_GET, 'car_id', FILTER_VALIDATE_INT);
if ($car_id === null || $car_id === false) {
  
    echo "<!doctype html><html lang=\"en\"><head><meta charset=\"utf-8\"><title>Delete car</title>";
    echo "<style>body{font-family:Arial,Helvetica,sans-serif;margin:18px} ul{line-height:1.6} label{display:inline-block;width:80px}</style>";
    echo "</head><body>";
    echo "<h1>Delete CAR by car_id</h1>";
    echo "<p>Please select a car-id to delete from the list</p>";

    try {
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        $stmtList = $pdo->query('SELECT car_id, make, model, year FROM cars ORDER BY car_id DESC LIMIT 50');
        $carsList = $stmtList->fetchAll();
    } catch (Exception $e) {
        $carsList = [];
    }

    if (!empty($carsList)) {
        echo "<ul>";
        foreach ($carsList as $c) {
            $id = (int)$c['car_id'];
            $label = htmlspecialchars(($c['make'] ?? '') . ' ' . ($c['model'] ?? '') . ' ' . ($c['year'] ?? ''));
            echo "<li>#{$id} - {$label} - <a href=\"Delete.php?car_id={$id}\">Delete</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No cars found.</p>";
    }

    echo "<form method=\"get\" action=\"Delete.php\">";
    echo "<label for=\"car_id\">Enter car ID:</label>";
    echo "<input id=\"car_id\" name=\"car_id\" type=\"number\" min=\"1\"> ";
    echo "<button type=\"submit\">Delete</button>";
    echo "</form>";

    echo "<p><a href=\"index.php\">Back to list</a></p>";
    echo "</body></html>";
    exit;
}

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    $stmt = $pdo->prepare('DELETE FROM cars WHERE car_id = ?');
    $stmt->execute([$car_id]);

    if ($stmt->rowCount() > 0) {
        echo "Deleted car with id: {$car_id}";
    } else {
        http_response_code(404);
        echo "No car found with id: {$car_id}";
    }
} catch (PDOException $e) {

    http_response_code(500);
    echo "Database error.";
    exit;
}
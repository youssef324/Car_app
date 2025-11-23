<?php
// Delete.php - delete a car by GET parameter ?car_id=123
// Replace these with your actual DB credentials
$host = '127.0.0.1';
$db   = 'cars_app';
$user = 'root';
$pass = '';

header('Content-Type: text/plain; charset=utf-8');

// Validate car_id from GET as integer
$car_id = filter_input(INPUT_GET, 'car_id', FILTER_VALIDATE_INT);
if ($car_id === null || $car_id === false) {
    http_response_code(400);
    echo "Missing or invalid car_id parameter.";
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
    // In production don't expose $e->getMessage()
    http_response_code(500);
    echo "Database error.";
    exit;
}
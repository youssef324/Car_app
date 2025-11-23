<?php

$dsn = 'mysql:host=127.0.0.1;dbname=cars_app;charset=utf8mb4';
$dbUser = 'root';
$dbPass = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (Exception $e) {
    http_response_code(500);
    echo "Database connection failed: " . htmlspecialchars($e->getMessage());
    exit;
}


function e($v) {
    return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = isset($_POST['car_id']) ? (int)$_POST['car_id'] : 0;
    if (!$car_id) {
        echo "Missing car_id";
        exit;
    }
 
    $make  = trim($_POST['make'] ?? '');
    $model = trim($_POST['model'] ?? '');
    $year  = isset($_POST['year']) ? (int)$_POST['year'] : null;
    $color = trim($_POST['color'] ?? '');
    $price = isset($_POST['price']) ? (float)$_POST['price'] : null;

    $errors = [];
    if ($make === '') $errors[] = "Make is required.";
    if ($model === '') $errors[] = "Model is required.";
    if ($year !== null && ($year < 1886 || $year > (int)date('Y') + 1)) $errors[] = "Year looks invalid.";
    if ($price !== null && $price < 0) $errors[] = "Price must be non-negative.";

    if (count($errors) === 0) {
        $sql = "UPDATE cars
                SET make = :make,
                    model = :model,
                    year = :year,
                    color = :color,
                    price = :price
                WHERE car_id = :car_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':make'   => $make,
            ':model'  => $model,
            ':year'   => $year,
            ':color'  => $color,
            ':price'  => $price,
            ':car_id' => $car_id,
        ]);

        
        header('Location: update.php?car_id=' . $car_id . '&updated=1');
        exit;
    }
    // If errors, fall through to re-display form with $errors and previously submitted values.
}

$car_id = isset($_GET['car_id']) ? (int)$_GET['car_id'] : 0;
if (!$car_id) {
    echo "Missing car_id in query string.";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM cars WHERE car_id = :car_id");
$stmt->execute([':car_id' => $car_id]);
$car = $stmt->fetch();

if (!$car) {
    echo "Car not found.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($errors)) {
    $car['make']  = $_POST['make']  ?? $car['make'];
    $car['model'] = $_POST['model'] ?? $car['model'];
    $car['year']  = $_POST['year']  ?? $car['year'];
    $car['color'] = $_POST['color'] ?? $car['color'];
    $car['price'] = $_POST['price'] ?? $car['price'];
}

$updated = isset($_GET['updated']) && $_GET['updated'] == 1;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Update Car #<?php echo e($car_id); ?></title>
</head>
<body>
<h1>Update Car #<?php echo e($car_id); ?></h1>

<?php if (!empty($errors)): ?>
    <div style="color:darkred;">
        <strong>Errors:</strong>
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?php echo e($err); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if ($updated): ?>
    <div style="color:green;">Record updated successfully.</div>
<?php endif; ?>

<form method="post" action="update.php">
    <input type="hidden" name="car_id" value="<?php echo e($car_id); ?>">

    <label>
        Make<br>
        <input type="text" name="make" value="<?php echo e($car['make'] ?? ''); ?>">
    </label><br><br>

    <label>
        Model<br>
        <input type="text" name="model" value="<?php echo e($car['model'] ?? ''); ?>">
    </label><br><br>

    <label>
        Year<br>
        <input type="number" name="year" value="<?php echo e($car['year'] ?? ''); ?>" min="1886" max="<?php echo e(date('Y')+1); ?>">
    </label><br><br>

    <label>
        Color<br>
        <input type="text" name="color" value="<?php echo e($car['color'] ?? ''); ?>">
    </label><br><br>

    <label>
        Price<br>
        <input type="number" step="0.01" name="price" value="<?php echo e($car['price'] ?? ''); ?>">
    </label><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>
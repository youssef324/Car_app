<?php


$host = 'localhost';
$db   = 'cars_app';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);


    $stmt = $pdo->query('SELECT * FROM cars');
    $rows = $stmt->fetchAll(); 

    // Decide output format: ?format=json or Accept: application/json
    $wantJson = false;
    if (isset($_GET['format']) && strtolower($_GET['format']) === 'json') {
        $wantJson = true;
    } elseif (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
        $wantJson = true;
    }

    if ($wantJson) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($rows, JSON_UNESCAPED_UNICODE);
        exit;
    }

    header('Content-Type: text/html; charset=utf-8');
    ?>
    <!doctype html>
    <html lang="en">
    <head>
      <meta charset="utf-8">
      <title>Cars</title>
      <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f4f4f4; }
      </style>
    </head>
    <body>
      <h1>Cars</h1>
      <?php if (empty($rows)): ?>
        <p>No records found.</p>
      <?php else: ?>
        <table>
          <thead>
            <tr>
              <?php foreach (array_keys($rows[0]) as $col): ?>
                <th><?php echo htmlspecialchars($col, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $row): ?>
              <tr>
                <?php foreach ($row as $cell): ?>
                  <td><?php echo htmlspecialchars((string)$cell, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </body>
    </html>
    <?php

} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "Database error: " . $e->getMessage();
    exit;
}
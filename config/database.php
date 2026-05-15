<?php

declare(strict_types=1);

require_once __DIR__ . '/app.php';

$dbHost = '127.0.0.1';
$dbName = 'cecob';
$dbUser = 'root';
$dbPass = '';
$dbPort = 3306;

try {
    $dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $exception) {
    $GLOBALS['db_error'] = $exception->getMessage();
    $pdo = null;
}

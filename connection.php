<?php
try {
    $conn = new PDO(
        'mysql:host=' . $_SERVER['DB_HOST'] . ';dbname=' . $_SERVER['DB_NAME'],
        $_SERVER['DB_USERNAME'],
        $_SERVER['DB_PASSWORD']
    );
} catch(PDOException $e) {}

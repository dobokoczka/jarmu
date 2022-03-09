<?php
require './connection.php';
require './tools/islogged.php';
$today = date("Y-m-d H:i:s");
$statement_log = $conn->prepare(
    "INSERT INTO `logs` (`userID`, `date`, `logtypeID`) 
        VALUES (?,?,?)"
);
$statement_log->execute([$_SESSION['id'], $today, '2']);
session_destroy();
header('location: /');

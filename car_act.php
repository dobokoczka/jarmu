<?php
require './connection.php';
require './tools/islogged.php';

$carID = $_GET['carID'];
$status = $_GET['status'];
$today = date("Y-m-d H:i:s");

$statement = $conn->prepare("UPDATE cars SET activeCar='$status' WHERE carID = ?");
$statement->execute([$carID]);

if ($status == 1) {
    $statement_carlog = $conn->prepare(
        "INSERT INTO `carlog` (`carID`, `event_date`, `logtypeID`) 
        VALUES (?,?,?)"
    );

    $statement_carlog->execute([
        $carID,
        $today,
        "6"
    ]);
} else {
    $statement_carlog = $conn->prepare(
        "INSERT INTO `carlog` (`carID`, `event_date`, `logtypeID`) 
        VALUES (?,?,?)"
    );

    $statement_carlog->execute([
        $carID,
        $today,
        "7"
    ]);
}

header("location: carhand");

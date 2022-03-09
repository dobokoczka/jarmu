<?php
require './connection.php';
require './tools/islogged.php';
$serviceID = $_GET['serviceID'];
$userID = $_GET['userID'];
$today = date("Y-m-d H:i:s");

$statement = $conn->prepare("UPDATE service SET repair='1', date_rep = ? WHERE serviceID = ?");
$statement->execute([$today, $serviceID]);

$rep_message = "A " . $serviceID . ". számon bejelentett hibát javítottuk!";

$statement_m = $conn->prepare(
    "INSERT INTO `messages` (`messID`, `userID`, `senderID`, `sent_date`, `subject`, `message`, `viewed`) 
    VALUES (?,?,?,?,?,?,?);"
);

$statement_m->execute([
    NULL,
    $userID,
    $_SESSION['id'],
    $today,
    "Javítás értesítő",
    $rep_message,
    "0"
]);

$statement_mlog = $conn->prepare(
    "INSERT INTO `messagelog` (`senderID`, `userID`, `sent_date`, `subject`, `m_status`) 
    VALUES (?,?,?,?,?);"
);

$statement_mlog->execute([
    $_SESSION['id'],
    $userID,
    $today,
    "Javítás értesítő",
    "1"
]);

header("location: servicehand?rep=2");

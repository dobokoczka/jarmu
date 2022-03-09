<?php
require './connection.php';
require './views/header.phtml';
require './tools/islogged.php';

$userID = $_GET['userID'];
$status = $_GET['status'];
$today = date("Y-m-d H:i:s");

if ($userID == $_SESSION['id']) {
    echo '<h1><span>J</span>ármű<span>L</span>ogisztika</h1>';
    echo '<p class="errorMessage">Saját magad nem teheted inaktívvá!</p>';
    echo '<a href="userhand" class="regularButton">Vissza</a>';
    exit;
}

$statement = $conn->prepare("UPDATE users SET activeUser='$status' WHERE userID = ?");
$statement->execute([$userID]);

if ($status == 1) {
    $statement_userlog = $conn->prepare(
        "INSERT INTO `userlog` (`userID`, `event_date`, `logtypeID`) 
        VALUES (?,?,?)"
    );

    $statement_userlog->execute([
        $userID,
        $today,
        "6"
    ]);
} else {
    $statement_userlog = $conn->prepare(
        "INSERT INTO `userlog` (`userID`, `event_date`, `logtypeID`) 
        VALUES (?,?,?)"
    );

    $statement_userlog->execute([
        $userID,
        $today,
        "7"
    ]);
}

header("location: userhand");

require './views/footer.phtml';

<?php
require './connection.php';
require './tools/islogged.php';
require './views/header.phtml';

$resID = $_GET['resID'];
$userID = $_GET['userID'];
$carID = $_GET['carID'];
$resday = $_GET['res_day'];
$restypeID = $_GET['restypeID'];
$status = 1;
$today = date("Y-m-d H:i:s");
$acc_message = "Engedélyezem a " . $resID . ". számú járműfoglalást";

$statement_r1 = $conn->prepare("SELECT * FROM reservation WHERE carID=? AND res_day=? AND res_typeID=? AND res_status=?");
$statement_r1->execute([$carID, $resday, $restypeID, 1]);
$res1 = $statement_r1->fetchAll(PDO::FETCH_ASSOC);
$count_r1 = $statement_r1->rowCount();

$statement_r2 = $conn->prepare("SELECT * FROM reservation WHERE carID=? AND res_day=? AND res_typeID=? AND res_status=?");
$statement_r2->execute([$carID, $resday, 3, 1]);
$res2 = $statement_r2->fetchAll(PDO::FETCH_ASSOC);
$count_r2 = $statement_r2->rowCount();

if (($count_r1 + $count_r2) > 0) {
    echo '<p class="errorMessage">A megjelölt jármű az adott időpontra már foglalt!</p>';
    echo '<a href="reshand" class="linkMessage">Kérjük ellenőrizze a foglalásokat!</a>';
    exit;
}

if ($restypeID == "3") {
    $statement_r3 = $conn->prepare("SELECT * FROM reservation WHERE carID=? AND res_day=? AND (res_typeID='1' OR '2') AND res_status=?");
    $statement_r3->execute([$carID, $resday, 1]);
    $res3 = $statement_r3->fetchAll(PDO::FETCH_ASSOC);
    $count_r3 = $statement_r3->rowCount();
    if (($count_r3 + $count_r2) > 0) {
        echo '<p class="errorMessage">A megjelölt jármű az adott időpontra már foglalt!</p>';
        echo '<a href="reshand" class="linkMessage">Kérjük ellenőrizze a foglalásokat!</a>';
        exit;
    }
}

$statement_u1 = $conn->prepare("SELECT * FROM reservation WHERE userID=? AND res_day=? AND res_typeID=? AND res_status=?");
$statement_u1->execute([$userID, $resday, $restypeID, 1]);
$result1 = $statement_u1->fetchAll(PDO::FETCH_ASSOC);
$count_u1 = $statement_u1->rowCount();

$statement_u2 = $conn->prepare("SELECT * FROM reservation WHERE userID=? AND res_day=? AND res_typeID=? AND res_status=?");
$statement_u2->execute([$userID, $resday, 3, 1]);
$result2 = $statement_u2->fetchAll(PDO::FETCH_ASSOC);
$count_u2 = $statement_u2->rowCount();

if (($count_u1 + $count_u2) > 0) {
    echo '<p class="errorMessage">A felhasználónak már van erre a napra lefoglalt időpontja</p>';
    echo '<a href="reshand" class="linkMessage">Kérjük ellenőrizze a foglalásokat!</a>';
    exit;
}

if ($restypeID == "3") {
    $statement_u3 = $conn->prepare("SELECT * FROM reservation WHERE userID=? AND res_day=? AND (res_typeID='1' OR '2') AND res_status=?");
    $statement_u3->execute([$userID, $resday, 1]);
    $result3 = $statement_u3->fetchAll(PDO::FETCH_ASSOC);
    $count_u3 = $statement_u3->rowCount();
    if (($count_u3 + $count_u2) > 0) {
        echo '<p class="errorMessage">A felhasználónak már van erre a napra lefoglalt időpontja</p>';
        echo '<a href="reshand" class="linkMessage">Kérjük ellenőrizze a foglalásokat!</a>';
        exit;
    }
}

$statement = $conn->prepare("UPDATE reservation SET res_status='$status' WHERE resID = ?");
$statement->execute([$resID]);
$statement_m = $conn->prepare(
    "INSERT INTO `messages` (`messID`, `userID`, `senderID`, `sent_date`, `subject`, `message`, `viewed`) 
    VALUES (?,?,?,?,?,?,?);"
);

$statement_m->execute([
    NULL,
    $userID,
    $_SESSION['id'],
    $today,
    "Engedélyezés",
    $acc_message,
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
    "Engedélyezés",
    "1"
]);

header("location: reshand");

require './views/footer.phtml';

<?php
require './views/header.phtml';
require './tools/islogged.php';
require 'connection.php';

if (isset($_POST['submit'])) {
    $id = $_GET['userID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $telnumber = $_POST['telnumber'];
    $licence = $_POST['licence'];
    $today = date("Y-m-d H:i:s");

    $statement = $conn->prepare("SELECT * FROM users WHERE email=? AND userID !=?");
    $statement->execute([$_POST['email'], $id]);
    $emails = $statement->fetchAll(PDO::FETCH_ASSOC);
    $count = $statement->rowCount();

    if ($count > 0) {
        echo '<p class="errorMessage">Már létezik iylen e-mail címmel felhasználó</p>';
        echo '<a href="userhand" class="linkMessage">Vissza a listához</a>';
        exit;
    }

    $statement_e = $conn->prepare("UPDATE users 
    SET 
    name = '$name',
    email = '$email', 
    telnumber = '$telnumber',
    licence = '$licence'
    WHERE userID = ?");
    if ($statement_e->execute([$id])) {
        echo '<p class="okMessage">A felhasználó módosítása sikerült</p>';
        echo '<a href="userhand" class="linkMessage">Vissza a listához</a>';
        $statement_userlog = $conn->prepare(
            "INSERT INTO `userlog` (`userID`, `name`, `email`, `telnumber`, `licence`, `event_date`, `logtypeID`) 
            VALUES (?,?,?,?,?,?,?)"
        );

        $statement_userlog->execute([
            $id,
            $name,
            $email,
            $telnumber,
            $licence,
            $today,
            "8"
        ]);
    } else {
        echo '<p class="errorMessage">A felhasználó módosítása nem sikerült</p>';
    };
}


require './views/footer.phtml';

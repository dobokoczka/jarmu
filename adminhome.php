<?php
require './views/header.phtml';
require './tools/islogged.php';
require './connection.php';
require './views/adminmenu.phtml';

$statement = $conn->prepare("SELECT * FROM users WHERE userID=?");
$statement->execute([$_SESSION['id']]);
$users = $statement->fetch(PDO::FETCH_ASSOC);

$statement_r = $conn->prepare("SELECT * FROM reservation WHERE res_status = ? ORDER BY resID");
$statement_r->execute([0]);
$r_count = $statement_r->rowCount();

$statement_m = $conn->prepare("SELECT * FROM messages WHERE userID = ? ORDER BY sent_date DESC");
$statement_m->execute([$_SESSION['id']]);
$m_count = $statement_m->rowCount();

$statement_m = $conn->prepare("SELECT * FROM messages WHERE userID = ? AND viewed = ?");
$statement_m->execute([$_SESSION['id'], 0]);
$n_count = $statement_m->rowCount();

$statement_m = $conn->prepare("SELECT * FROM service WHERE repair = ?");
$statement_m->execute([0]);
$c_count = $statement_m->rowCount();
?>

<div class="workContainer">
    <p class="regularChar">Felhasználónév: <span><?php echo $users["username"]; ?></span></p>
    <p class="regularChar">Név: <span><?php echo $users["name"]; ?></span></p>
    <p class="regularChar">E-mail cím: <span><?php echo $users["email"]; ?></span></p>
    <p class="regularChar">Telefonszám: <span><?php echo $users["telnumber"]; ?></span></p>
    <p class="regularChar">Jogosultság: <span><?php echo $users["licence"]; ?></span></p>
    <hr>
    <p class="regularChar">Függőben lévő foglalások száma: <span><?php echo $r_count; ?></span></p>
    <p class="regularChar">Függőben lévő szervízbejelentések száma: <span><?php echo $c_count; ?></span></p>
    <p class="regularChar">Új üzenetek száma száma: <span><?php echo $n_count; ?></span></p>
    <hr>
    <a href="messages" class="regularButton">Üzenetek megtekintése</a>


</div>

<?php require './views/footer.phtml'; ?>
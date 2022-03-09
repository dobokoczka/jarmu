<?php
require './views/header.phtml';
require './tools/islogged.php';
require './connection.php';
if ($_SESSION['licence'] == "A") {
    require './views/adminmenu.phtml';
} else {
    require './views/menu.phtml';
}

$messID = $_GET['messID'];

$statement_v = $conn->prepare("UPDATE messages SET viewed= ? WHERE messID = ?");
$statement_v->execute([1, $messID]);

$statement_m = $conn->prepare("SELECT * FROM messages WHERE messID = ?");
$statement_m->execute([$messID]);
$message = $statement_m->fetch(PDO::FETCH_ASSOC);

$sender = $message["senderID"];
$statement_s = $conn->prepare("SELECT * FROM users WHERE userID = ?");
$statement_s->execute([$sender]);
$sendname = $statement_s->fetch(PDO::FETCH_ASSOC);

?>

<div class="workContainer">
    <h2 class="regularCharBold"><?= $message['subject'] ?></h2>
    <hr>
    <h2 class="regularChar">Feladó: <span><?= $sendname['name'] ?></span></h2>
    <h2 class="regularChar">Küldés időpontja: <span><?= $message['sent_date'] ?></span></h2>
    <h2>Az üzenet szövege:</h2>
    <h2 class="regularChar"><?= $message['message'] ?></h2>
    <a href="messages" class="regularButton">Vissza az üzetenekhez</a>
</div>

<?php require './views/footer.phtml'; ?>

<script>
    function messdelete() {
        return confirm('Valóban szeretnéd törölni az üzenetet?');
    }
</script>
<?php
require './views/header.phtml';
require './tools/islogged.php';
require './connection.php';
if ($_SESSION['licence'] == "A") {
    require './views/adminmenu.phtml';
} else {
    require './views/menu.phtml';
}

$statement_m = $conn->prepare("SELECT * FROM messages WHERE userID = ? ORDER BY sent_date DESC");
$statement_m->execute([$_SESSION['id']]);
$messages = $statement_m->fetchAll(PDO::FETCH_ASSOC);
$m_count = $statement_m->rowCount();
?>

<div class="workContainer">
    <h2>Üzenetek</h2>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Feladó</th>
                <th>Érkezés dátuma</th>
                <th>Üzenet tárgya</th>
                <th colspan="2">Műveletek</th>
            </tr>
        </thead>

        <?php foreach ($messages as $message) : ?>
            <?php
            $sender = $message["senderID"];
            $statement_s = $conn->prepare("SELECT * FROM users WHERE userID = ?");
            $statement_s->execute([$sender]);
            $sendname = $statement_s->fetch(PDO::FETCH_ASSOC);
            ?>
            <tr>
                <td style="text-align: center;" <?php echo $message['viewed'] ?  '' : 'class="charBold"' ?>><?php echo $sendname["name"]; ?></td>
                <td style="text-align: center;" <?php echo $message['viewed'] ?  '' : 'class="charBold"' ?>><?php echo $message["sent_date"]; ?></td>
                <td style="text-align: center;" <?php echo $message['viewed'] ?  '' : 'class="charBold"' ?>><?php echo $message["subject"]; ?></td>
                <td style="text-align: center;"><?php echo '<a href="messview?messID=' . $message['messID'] . '" class="tableButtonEdit">Megtekintés</a>'; ?></td>
                <td style="text-align: center;"><?php echo '<a href="messdel?messID=' . $message['messID'] . '"class="tableButtonActive" onclick="return messdelete()">Törlés</a>'; ?></td>

            </tr>
        <?php endforeach ?>
    </table>
</div>

<?php require './views/footer.phtml'; ?>

<script>
    function messdelete() {
        return confirm('Valóban szeretnéd törölni az üzenetet?');
    }
</script>
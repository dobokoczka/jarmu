<?php
require './views/header.phtml';
require './tools/islogged.php';
require './views/adminmenu.phtml';
require './connection.php';

$statement_mlog = $conn->prepare("SELECT * FROM messagelog ORDER BY messlogID DESC");
$statement_mlog->execute();
$mlogs = $statement_mlog->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="workContainer">
    <h2>Üzenetek naplózása</h2>
    <hr>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Feladó</th>
                <th>Címzett</th>
                <th>Érkezés dátuma</th>
                <th>Üzenet tárgya</th>
                <th>Üzenet státusza</th>
            </tr>
        </thead>

        <?php foreach ($mlogs as $mlog) : ?>
            <?php
            $sender = $mlog["senderID"];
            $statement_s = $conn->prepare("SELECT * FROM users WHERE userID = ?");
            $statement_s->execute([$sender]);
            $sendname = $statement_s->fetch(PDO::FETCH_ASSOC);

            $receiver = $mlog["userID"];
            $statement_r = $conn->prepare("SELECT * FROM users WHERE userID = ?");
            $statement_r->execute([$receiver]);
            $recname = $statement_r->fetch(PDO::FETCH_ASSOC);
            ?>
            <tr>
                <td style="text-align: center;"> <?php echo $mlog["messlogID"]; ?></td>
                <td style="text-align: center;"> <?php echo $sendname["name"]; ?></td>
                <td style="text-align: center;"> <?php echo $recname["name"]; ?></td>
                <td style="text-align: center;"> <?php echo $mlog["sent_date"]; ?></td>
                <td style="text-align: center;"> <?php echo $mlog["subject"]; ?></td>
                <td style="text-align: center;"> <?php echo $mlog["m_status"] ? 'Sikeres kézbesítés' : 'Sikertelen kézebsítés'; ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<?php require './views/footer.phtml'; ?>
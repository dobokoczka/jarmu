<?php
require './views/header.phtml';
require './tools/islogged.php';
require './views/adminmenu.phtml';
require './connection.php';

$statement_l = $conn->prepare("SELECT * FROM users");
$statement_l->execute();
$users = $statement_l->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="workContainer">
    <h2>Felhasználók kezelése</h2>
    <table>
        <thead>
            <tr>
                <th>Név</th>
                <th>Felhasználónév</th>
                <th>E-mail cím</th>
                <th>Telefonszám</th>
                <th>Licensz</th>
                <th>Aktív</th>
                <th colspan="3" style="text-align: center;">Műveletek</th>
            </tr>
        </thead>

        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user["name"]; ?></td>
                <td style="text-align: center;"><?php echo $user["username"]; ?></td>
                <td><?php echo $user["email"]; ?></td>
                <td><?php echo $user["telnumber"]; ?></td>
                <td style="text-align: center;"><?php echo $user["licence"]; ?></td>
                <td style="text-align: center;"><?php echo $user["activeUser"] ? 'igen' : 'nem'; ?></td>
                <?php
                if ($user["activeUser"] == 0) {
                    echo '<td><a class ="tableButtonInActive" href="useract?userID=' . $user['userID'] . '&status=1" onclick="return checkactive()">Aktiválás</a></td>';
                } else {
                    echo '<td><a class ="tableButtonActive" href="useract?userID=' . $user['userID'] . '&status=0" onclick="return checkinactive()">Inaktiválás</a></td>';
                }
                echo '<td><a class="tableButtonEdit" href="useredit?userID=' . $user['userID'] . '">Szerkesztés</a></td>';
                ?>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<?php require './views/footer.phtml'; ?>

<script>
    function checkactive() {
        return confirm('Valóban szeretnéd aktívvá tenni?');
    }

    function checkinactive() {
        return confirm('Valóban szeretnéd inaktívvá tenni?');
    }
</script>
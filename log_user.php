<?php
require './views/header.phtml';
require './tools/islogged.php';
require './views/adminmenu.phtml';
require './connection.php';

$statement_u = $conn->prepare("SELECT * FROM userlog 
INNER JOIN logtype ON logtype.logtypeID = userlog.logtypeID
WHERE userlog.userID=?
ORDER BY userlogID DESC");
$statement_u->execute([$_POST['user']]);
$userlogs = $statement_u->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="workContainer">
    <h2>Felhasználók naplózása</h2>
    <hr>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Név</th>
                <th>E-mail</th>
                <th>Telefonszám</th>
                <th>Jogosultság</th>
                <th>Esemény dátuma</th>
                <th>Bejegyzés</th>
            </tr>
        </thead>

        <?php foreach ($userlogs as $userlog) : ?>
            <tr>
                <td style="text-align: center;"> <?php echo $userlog["userlogID"]; ?></td>
                <td style="text-align: center;"> <?php echo $userlog["name"]; ?></td>
                <td style="text-align: center;"> <?php echo $userlog["email"]; ?></td>
                <td style="text-align: center;"> <?php echo $userlog["telnumber"]; ?></td>
                <td style="text-align: center;"> <?php echo $userlog["licence"]; ?></td>
                <td style="text-align: center;"> <?php echo $userlog["event_date"]; ?></td>
                <td style="text-align: center;"> <?php echo $userlog["logtypename"]; ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<?php require './views/footer.phtml'; ?>
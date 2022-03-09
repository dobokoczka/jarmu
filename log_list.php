<?php
require './views/header.phtml';
require './tools/islogged.php';
require './views/adminmenu.phtml';
require './connection.php';

$var = $_GET['var'];

switch ($var) {
    case "0":
        $statement_log = $conn->prepare("SELECT * FROM logs 
        INNER JOIN users ON users.userID = logs.userID 
        INNER JOIN logtype ON logtype.logtypeID = logs.logtypeID 
        ORDER BY date DESC");
        $statement_log->execute();
        $logs = $statement_log->fetchAll(PDO::FETCH_ASSOC);
?>
        <div class="workContainer">
            <h2>Teljes lista</h2>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Felhasználó</th>
                        <th>Dátum</th>
                        <th>Tevékenység</th>
                    </tr>
                </thead>

                <?php foreach ($logs as $log) : ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $log["logID"]; ?></td>
                        <td style="text-align: center;"><?php echo $log["name"]; ?></td>
                        <td style="text-align: center;"><?php echo $log["date"]; ?></td>
                        <td style="text-align: center;"><?php echo $log["logtypename"]; ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    <?php
        break;

    case "1":
        $user = $_POST['user'];
        $statement_log = $conn->prepare("SELECT * FROM logs INNER JOIN logtype ON logtype.logtypeID = logs.logtypeID WHERE userID=? ORDER BY date DESC");
        $statement_log->execute([$user]);
        $logs = $statement_log->fetchAll(PDO::FETCH_ASSOC);
    ?>
        <div class="workContainer">
            <h2>Felahsználóra szűrt lista</h2>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Felhasználó</th>
                        <th>Dátum</th>
                        <th>Tevékenység</th>
                    </tr>
                </thead>

                <?php foreach ($logs as $log) : ?>
                    <?php
                    $statement_s = $conn->prepare("SELECT * FROM users WHERE userID = ?");
                    $statement_s->execute([$user]);
                    $users = $statement_s->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $log["logID"]; ?></td>
                        <td style="text-align: center;"><?php echo $users["name"]; ?></td>
                        <td style="text-align: center;"><?php echo $log["date"]; ?></td>
                        <td style="text-align: center;"><?php echo $log["logtypename"]; ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    <?php
        break;

    case "2":
        $begindate = $_POST['begindate'];
        $enddate = $_POST['enddate'];

        $statement_log = $conn->prepare("SELECT * FROM logs 
        INNER JOIN users ON users.userID = logs.userID 
        INNER JOIN logtype ON logtype.logtypeID = logs.logtypeID 
        WHERE date <= ? AND date >= ? 
        ORDER BY date DESC");
        $statement_log->execute([$enddate, $begindate]);
        $logs = $statement_log->fetchAll(PDO::FETCH_ASSOC);

    ?>
        <div class="workContainer">
            <h2>Időpontra szűrt lista</h2>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Felhasználó</th>
                        <th>Dátum</th>
                        <th>Tevékenység</th>
                    </tr>
                </thead>

                <?php foreach ($logs as $log) : ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $log["logID"]; ?></td>
                        <td style="text-align: center;"><?php echo $log["name"]; ?></td>
                        <td style="text-align: center;"><?php echo $log["date"]; ?></td>
                        <td style="text-align: center;"><?php echo $log["logtypename"]; ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
<?php
        break;
}

require './views/footer.phtml'; ?>
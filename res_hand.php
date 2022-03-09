<?php
require './views/header.phtml';
require './tools/islogged.php';
require './views/adminmenu.phtml';
require './connection.php';


$statement_r = $conn->prepare(
    "SELECT * FROM reservation 
INNER JOIN users ON users.userID = reservation.userID 
INNER JOIN cars ON cars.carID = reservation.carID 
INNER JOIN restype ON restype.restypeID = reservation.res_typeID 
ORDER BY resID DESC"
);
$statement_r->execute();
$reservs = $statement_r->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="workContainer">
    <h2>Foglalások listája</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Felhasználó</th>
                <th colspan="3">Jármű</th>
                <th>Foglalás napja</th>
                <th>Foglalás tipusa</th>
                <th>Úticél</th>
                <th>Státusz</th>
                <th colspan="2">Műveletek</th>
            </tr>
        </thead>

        <?php foreach ($reservs as $res) : ?>
            <tr>
                <td style="text-align: center;"><?php echo $res["resID"]; ?></td>
                <td style="text-align: center;"><?php echo $res["name"]; ?></td>
                <td style="text-align: center;"><?php echo $res["brand"]; ?></td>
                <td style="text-align: center;"><?php echo $res["type"]; ?></td>
                <td style="text-align: center;"><?php echo $res["lpn"]; ?></td>
                <td style="text-align: center;"><?php echo $res["res_day"]; ?></td>
                <td style="text-align: center;"><?php echo $res["restypename"]; ?></td>
                <td style="text-align: center;"><?php echo $res["travel_dest"]; ?></td>
                <td style="text-align: center;"><?php
                                                switch ($res["res_status"]) {
                                                    case "0":
                                                        echo '<p class="tableMessageEdit">Várakozik</p>';
                                                        break;
                                                    case "1":
                                                        echo '<p class="tableMessageOK">Engedélyezett</p>';
                                                        break;
                                                    case "2":
                                                        echo '<p class="tableMessageNO">Elutasított</p>';
                                                        break;
                                                }
                                                ?></td>
                <?php
                if ($res["res_status"] == 0) {
                    echo '<td><a href="resacc?resID=' . $res["resID"] . '&userID=' . $res["userID"] . '&carID=' . $res["carID"] . '&res_day=' . $res["res_day"] . '&restypeID=' . $res["restypeID"] . '" class="tableButtonInActive">Engedélyezés</a></td>';
                    echo '<td><a href="resden?resID=' . $res["resID"] . '&userID=' . $res["userID"] . '" class="tableButtonActive">Elutasítás</a></td>';
                }
                ?>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<?php require './views/footer.phtml'; ?>
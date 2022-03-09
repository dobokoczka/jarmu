<?php
require './views/header.phtml';
require './tools/islogged.php';
require './views/adminmenu.phtml';
require './connection.php';

$statement_l = $conn->prepare("SELECT * FROM cars");
$statement_l->execute();
$cars = $statement_l->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="workContainer">
    <h2>Járművek kezelése</h2>
    <table>
        <thead>
            <tr>
                <th>Márka</th>
                <th>Tipus</th>
                <th>Rendszám</th>
                <th>Jogosítvny</th>
                <th>Szabadon foglalható</th>
                <th>Aktív</th>
                <th style="text-align: center;">Műveletek</th>
            </tr>
        </thead>

        <?php foreach ($cars as $car) : ?>
            <tr>
                <td><?php echo $car["brand"]; ?></td>
                <td style="text-align: center;"><?php echo $car["type"]; ?></td>
                <td style="text-align: center;"><?php echo $car["lpn"]; ?></td>
                <td style="text-align: center;"><?php echo $car["license"]; ?></td>
                <td style="text-align: center;"><?php echo $car["freecar"] ? 'igen' : 'nem'; ?></td>
                <td style="text-align: center;"><?php echo $car["activeCar"] ? 'igen' : 'nem'; ?></td>
                <?php
                if ($car["activeCar"] == 0) {
                    echo '<td><a class ="tableButtonInActive" href="caract?carID=' . $car['carID'] . '&status=1" onclick="return checkactive()">Aktiválás</a></td>';
                } else {
                    echo '<td><a class ="tableButtonActive" href="caract?carID=' . $car['carID'] . '&status=0" onclick="return checkinactive()">Inaktiválás</a></td>';
                }
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

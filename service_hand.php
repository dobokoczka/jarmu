<?php
require './views/header.phtml';
require './tools/islogged.php';
require './views/adminmenu.phtml';
require './connection.php';

$rep = $_GET['rep'];

if ($rep == 2) {
    $statement_s = $conn->prepare(
        "SELECT * FROM service 
        INNER JOIN users ON users.userID = service.userID 
        INNER JOIN cars ON cars.carID = service.carID 
        ORDER BY date_not DESC"
    );
    $statement_s->execute();
} else {
    $statement_s = $conn->prepare(
        "SELECT * FROM service 
        INNER JOIN users ON users.userID = service.userID 
        INNER JOIN cars ON cars.carID = service.carID 
        WHERE repair=? 
        ORDER BY date_not DESC"
    );
    $statement_s->execute([$rep]);
}

$services = $statement_s->fetchAll(PDO::FETCH_ASSOC);
$count = $statement_s->rowCount();
?>

<div class="workContainer">
    <h2>Szervíz</h2>
    <?php if ($count <= 0) {
        echo '<p class="errorMessage">Nincs jármű</p>';
    } else { ?>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th colspan="3">Gépjármű</th>
                    <th>Bejelentő</th>
                    <th>Bejelentés Dátuma</th>
                    <th>Probléma</th>
                    <th>Javítás dátuma</th>
                </tr>
            </thead>

            <?php
            foreach ($services as $service) : ?>
                <tr>
                    <td style="text-align: center;"><?php echo $service["serviceID"]; ?></td>
                    <td style="text-align: center;"><?php echo $service["brand"]; ?></td>
                    <td style="text-align: center;"><?php echo $service["type"]; ?></td>
                    <td style="text-align: center;"><?php echo $service["lpn"]; ?></td>
                    <td style="text-align: center;"><?php echo $service["name"]; ?></td>
                    <td style="text-align: center;"><?php echo $service["date_not"]; ?></td>
                    <td style="text-align: center;"><?php echo $service["problem"]; ?></td>
                    <?php

                    if ($service["repair"] == 0) {
                        echo '<td style="text-align: center;"><?php echo ""; ?></td>';
                        echo '<td><a class ="tableButtonEdit" href="servicerep?serviceID=' . $service['serviceID'] . '&userID=' . $service['userID'] . '" onclick="return repair()">Javítás</a></td>';
                    } else {
                        echo '<td style="text-align: center;">' . $service["date_rep"] . '</td>';
                        echo '<td><p class ="tableMessageOK">Javítva</p></td>';
                    }
                    ?>
                </tr>
        <?php endforeach;
        }
        ?>
        </table>
</div>

<?php require './views/footer.phtml'; ?>

<script>
    function repair() {
        return confirm('Valóban szeretnéd javítottá tenni?');
    }
</script>
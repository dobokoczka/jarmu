<?php
require './views/header.phtml';
require './tools/islogged.php';
require './views/adminmenu.phtml';
require './connection.php';

$statement_s = $conn->prepare("SELECT * FROM carlog 
INNER JOIN cars ON cars.carID = carlog.carID 
INNER JOIN logtype ON logtype.logtypeID = carlog.logtypeID
ORDER BY carlogID DESC");
$statement_s->execute();
$carlogs = $statement_s->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="workContainer">
    <h2>Járművek naplózása</h2>
    <hr>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th colspan="3">Jármű</th>
                <th>Esemény dátuma</th>
                <th>Esemény</th>
            </tr>
        </thead>

        <?php foreach ($carlogs as $carlog) : ?>
            <tr>
                <td style="text-align: center;"> <?php echo $carlog["carlogID"]; ?></td>
                <td style="text-align: center;"> <?php echo $carlog["brand"]; ?></td>
                <td style="text-align: center;"> <?php echo $carlog["type"]; ?></td>
                <td style="text-align: center;"> <?php echo $carlog["lpn"]; ?></td>
                <td style="text-align: center;"> <?php echo $carlog["event_date"]; ?></td>
                <td style="text-align: center;"> <?php echo $carlog["logtypename"]; ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<?php require './views/footer.phtml'; ?>
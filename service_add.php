<?php
require './views/header.phtml';
require './tools/islogged.php';
require './views/menu.phtml';
require './connection.php';
?>

<div class="regularContainer">
    <h1><span>J</span>ármű<span>L</span>ogisztika</h1>
    <h2>Új szervízbejelentés felvitele</h2>
    <form action="serviceadd" method="POST">
        <label for="car">Bejelentendő gépjármű</label>
        <select name="car">
            <option value="null" selected="selected">Válassz...</option>
            <?php
            $statement_c = $conn->prepare("SELECT * FROM cars WHERE activeCar=?");
            $statement_c->execute(["1"]);
            $cars = $statement_c->fetchAll(PDO::FETCH_ASSOC);

            foreach ($cars as $car) {
                echo "<option value=\"" . $car['carID'] . "\">" . $car['brand'] . " - " . $car['type'] . " - " . $car['lpn'] . "</option><br>";
            }
            ?>
        </select>
        <label for="problem">Probléma rövid leírása</label>
        <textarea name="problem" cols="30" rows="7" required></textarea>
        <input class="regularButton" type="submit" name="submit" value="Küldés">
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $today = date("Y-m-d H:i:s");

    $statement = $conn->prepare(
        "INSERT INTO `service` (`carID`, `userID`, `problem`, `date_not`, `date_rep`, `repair`) 
        VALUES (?,?,?,?,?,?);"
    );

    if ($statement->execute([
        $_POST['car'],
        $_SESSION['id'],
        $_POST['problem'],
        $today,
        "0",
        "0"
    ])) {
        echo '<p class="okMessage">A bejelentés felvitele sikeres</p>';
    } else {
        echo '<p class="errorMessage">A bejelentés felvitele sikertelen</p>';
        echo '<a href="serviceadd" class="linkMessage">Ide kattintva próbálja meg újra!</a>';
    }
}
?>

<?php require './views/footer.phtml'; ?>
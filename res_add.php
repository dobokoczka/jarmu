<?php
require './views/header.phtml';
require './tools/islogged.php';
require './views/menu.phtml';
require './connection.php';
?>

<div class="regularContainer">
    <h1><span>J</span>ármű<span>L</span>ogisztika</h1>
    <h2>Járműfoglalás felvitele</h2>
    <form action="resadd" method="POST">
        <label for="car">Jármű</label>
        <select name="car">
            <option value="null" selected="selected">Válassz...</option>
            <?php
            if ($_SESSION['licence'] == "B") {
                $statement_c = $conn->prepare("SELECT * FROM cars WHERE activeCar=? AND license=?");
                $statement_c->execute(["1", "B"]);
            } else {
                $statement_c = $conn->prepare("SELECT * FROM cars WHERE activeCar=?");
                $statement_c->execute(["1"]);
            }

            $cars = $statement_c->fetchAll(PDO::FETCH_ASSOC);

            foreach ($cars as $car) {
                echo "<option value=\"" . $car['carID'] . "\">" . $car['brand'] . " - " . $car['type'] . " - " . $car['lpn'] . "</option><br>";
            }
            ?>
        </select>
        <label for="date">Foglalás napja</label>
        <input type="date" name="res_day" required>
        <label for="res_type">Foglalás tipusa</label>
        <select name="res_type">
            <option value="null" selected="selected">Válassz...</option>
            <?php
            $statement_r = $conn->prepare("SELECT * FROM restype");
            $statement_r->execute();
            $restypes = $statement_r->fetchAll(PDO::FETCH_ASSOC);

            foreach ($restypes as $restype) {
                echo "<option value=\"" . $restype['restypeID'] . "\">" . $restype['restypename'] . "</option>";
            }
            ?>
        </select>
        <input type="text" name="travel_dest" placeholder="Úticél" required>
        <input class="regularButton" type="submit" name="submit" value="Küldés">
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $statement_c = $conn->prepare("SELECT * FROM cars WHERE carID=?");
    $statement_c->execute([$_POST['car']]);
    $cars = $statement_c->fetch(PDO::FETCH_ASSOC);

    $statement_r1 = $conn->prepare("SELECT * FROM reservation WHERE carID=? AND res_day=? AND res_typeID=? AND res_status=?");
    $statement_r1->execute([$_POST['car'], $_POST['res_day'], $_POST['res_type'], 1]);
    $res1 = $statement_r1->fetchAll(PDO::FETCH_ASSOC);
    $count_r1 = $statement_r1->rowCount();

    $statement_r2 = $conn->prepare("SELECT * FROM reservation WHERE carID=? AND res_day=? AND res_typeID=? AND res_status=?");
    $statement_r2->execute([$_POST['car'], $_POST['res_day'], 3, 1]);
    $res2 = $statement_r2->fetchAll(PDO::FETCH_ASSOC);
    $count_r2 = $statement_r2->rowCount();


    if (($count_r1 + $count_r2) > 0) {
        echo '<p class="errorMessage">A megjelölt jármű az adott időpontra már foglalt!</p>';
        echo '<a href="resadd" class="linkMessage">Kérjük kezdeményezz új foglalást!</a>';
        exit;
    }

    if ($_POST['res_type'] == "3") {
        $statement_r3 = $conn->prepare("SELECT * FROM reservation WHERE carID=? AND res_day=? AND (res_typeID='1' OR '2') AND res_status=?");
        $statement_r3->execute([$_POST['car'], $_POST['res_day'], 1]);
        $res3 = $statement_r3->fetchAll(PDO::FETCH_ASSOC);
        $count_r3 = $statement_r3->rowCount();
        if (($count_r3 + $count_r2) > 0) {
            echo '<p class="errorMessage">A megjelölt jármű az adott időpontra már foglalt!</p>';
            echo '<a href="resadd" class="linkMessage">Kérjük kezdeményezz új foglalást!</a>';
            exit;
        }
    }

    $statement_u1 = $conn->prepare("SELECT * FROM reservation WHERE userID=? AND res_day=? AND res_typeID=? AND res_status=?");
    $statement_u1->execute([$_SESSION['id'], $_POST['res_day'], $_POST['res_type'], 1]);
    $result1 = $statement_u1->fetchAll(PDO::FETCH_ASSOC);
    $count_u1 = $statement_u1->rowCount();

    $statement_u2 = $conn->prepare("SELECT * FROM reservation WHERE userID=? AND res_day=? AND res_typeID=? AND res_status=?");
    $statement_u2->execute([$_SESSION['id'], $_POST['res_day'], 3, 1]);
    $result2 = $statement_u2->fetchAll(PDO::FETCH_ASSOC);
    $count_u2 = $statement_u2->rowCount();

    if (($count_u1 + $count_u2) > 0) {
        echo '<p class="errorMessage">A felhasználónak már van erre a napra lefoglalt időpontja</p>';
        echo '<a href="resadd" class="linkMessage">Kérjük kezdeményezz új foglalást!</a>';
        exit;
    }

    if ($_POST['res_type'] == "3") {
        $statement_u3 = $conn->prepare("SELECT * FROM reservation WHERE userID=? AND res_day=? AND (res_typeID='1' OR '2') AND res_status=?");
        $statement_u3->execute([$_SESSION['id'], $_POST['res_day'], 1]);
        $result3 = $statement_u3->fetchAll(PDO::FETCH_ASSOC);
        $count_u3 = $statement_u3->rowCount();
        if (($count_u3 + $count_u2) > 0) {
            echo '<p class="errorMessage">A felhasználónak már van erre a napra lefoglalt időpontja</p>';
            echo '<a href="resadd" class="linkMessage">Kérjük kezdeményezz új foglalást!</a>';
            exit;
        }
    }

    if ($_POST['res_day'] < date("Y-m-d")) {
        echo '<p class="errorMessage">A dátum nem lehet a mai napnál korábbi</p>';
        echo '<a href="resadd" class="linkMessage">Ide kattintva próbálja meg újra!</a>';
        exit;
    }

    if ($cars['freecar'] == 1) {
        $statement = $conn->prepare(
            "INSERT INTO `reservation` (`carID`, `userID`, `res_day`, `res_typeID`, `travel_dest`, `res_status`) 
            VALUES (?,?,?,?,?,?);"
        );

        if ($statement->execute([
            $_POST['car'],
            $_SESSION['id'],
            $_POST['res_day'],
            $_POST['res_type'],
            $_POST['travel_dest'],
            "1"
        ])) {
            echo '<p class="okMessage">A járműfoglalás rögzítése sikeres</p>';
            echo '<p class="okMessage">A járműfoglalás automatikusan engedélyezésre került</p>';
        } else {
            echo '<p class="errorMessage">A járműfoglalás rögzítése sikertelen</p>';
            echo '<a href="resadd" class="linkMessage">Ide kattintva próbálja meg újra!</a>';
        }
    } else {
        $statement = $conn->prepare(
            "INSERT INTO `reservation` (`carID`, `userID`, `res_day`, `res_typeID`, `travel_dest`, `res_status`) 
            VALUES (?,?,?,?,?,?);"
        );

        if ($statement->execute([
            $_POST['car'],
            $_SESSION['id'],
            $_POST['res_day'],
            $_POST['res_type'],
            $_POST['travel_dest'],
            "0"
        ])) {
            echo '<p class="okMessage">A jűrműfoglalás rögzítése sikeres</p>';
        } else {
            echo '<p class="errorMessage">A járműfoglalás rögzítése sikertelen</p>';
            echo '<a href="resadd" class="linkMessage">Ide kattintva próbálja meg újra!</a>';
        }
    }
}
?>

<?php require './views/footer.phtml'; ?>
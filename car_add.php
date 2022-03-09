<?php
require './views/header.phtml';
require './tools/islogged.php';
require './views/adminmenu.phtml';
?>

<div class="regularContainer">
    <h1><span>J</span>ármű<span>L</span>ogisztika</h1>
    <h2>Új jármű felvitele</h2>
    <form action="caradd" method="POST">
        <input type="text" name="brand" placeholder="Márka" required>
        <input type="text" name="type" placeholder="Tipus" required>
        <input type="text" name="lpn" placeholder="Rendszám" required>
        <label for="license">Szükséges jogosítvány</label>
        <select name="license" required>
            <option value="B">B</option>
            <option value="C">C</option>
        </select>
        <label for="freecar">Szabadon foglalható</label>
        <select name="freecar" required>
            <option value="1">Igen</option>
            <option value="0">Nem</option>
        </select>
        <input class="regularButton" type="submit" name="submit" value="Küldés">
    </form>

</div>

<?php
if (isset($_POST['submit'])) {
    require 'connection.php';
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $lpn = $_POST['lpn'];
    $license = $_POST['license'];
    $freecar = $_POST['freecar'];
    $activeCar = 1;

    $statement_lpn = $conn->prepare("SELECT * FROM cars WHERE lpn=?");
    $statement_lpn->execute([$_POST['lpn']]);
    $car = $statement_lpn->fetchAll(PDO::FETCH_ASSOC);
    $count_lpn = $statement_lpn->rowCount();

    if ($count_lpn > 0) {
        echo '<p class="errorMessage">Már létezik ilyen rendszámú jármű!</p>';
        echo '<a href="caradd" class="linkMessage">Ide kattintva próbálja meg újra!</a>';
        exit;
    }

    $statement_n = $conn->prepare(
        "INSERT INTO `cars` (`brand`, `type`, `lpn`, `license`, `freecar`, `activeCar`) 
        VALUES (?,?,?,?,?,?);"
    );

    if ($statement_n->execute([
        $brand,
        $type,
        $lpn,
        $license,
        $freecar,
        $activeCar
    ])) {
        echo '<p class="okMessage">Jármű felvitele sikeres</p>';
    } else {
        echo '<p class="errorMessage">Jármű felvitele nem sikerült</p>';
        echo '<a href="caradd" class="linkMessage">Ide kattintva próbálja meg újra!</a>';
    }
}
?>

<?php require './views/footer.phtml'; ?>
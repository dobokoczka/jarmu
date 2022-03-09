<?php
require './views/header.phtml';
require './tools/islogged.php';
require './views/adminmenu.phtml';
require './connection.php';
?>

<div class="workContainer">
    <h1>Naplók</h1>
    <hr>
    <h2>Teljes lista</h2>
    <form action="loglist?var=0" method="POST">
        <input class="regularButton" type="submit" name="submit" value="Listázás">
    </form>
    <hr>
    <h2>Listázás felhasználó szerint</h2>
    <form action="loglist?var=1" method="POST">
        <label for="user">Válassza ki a felhasználót</label>
        <select name="user">
            <option value="null" selected="selected">Válassz...</option>
            <?php
            require './connection.php';
            $statement_u = $conn->prepare("SELECT * FROM users WHERE activeUser=?");
            $statement_u->execute(["1"]);
            $users = $statement_u->fetchAll(PDO::FETCH_ASSOC);

            foreach ($users as $user) {
                echo "<option value=\"" . $user['userID'] . "\">" . $user['name'] . "</option><br>";
            }
            ?>
        </select>
        <input class="regularButton" type="submit" name="submit" value="Listázás">
    </form>
    <hr>
    <h2>Listázás dátum szerint</h2>
    <form action="loglist?var=2" method="POST">
        <label for="begindate">Intervallum kezdete</label>
        <input type="datetime-local" name="begindate" required>
        <label for="enddate">Intervallum vége</label>
        <input type="datetime-local" name="enddate" required>
        <input class="regularButton" type="submit" name="submit" value="Listázás">
    </form>
    <hr>
    <h2>Felhasználó előzmények</h2>
    <form action="loguser" method="POST">
        <label for="user">Válassza ki a felhasználót</label>
        <select name="user">
            <option value="null" selected="selected">Válassz...</option>
            <?php
            require './connection.php';
            $statement_u = $conn->prepare("SELECT * FROM users WHERE activeUser=?");
            $statement_u->execute(["1"]);
            $users = $statement_u->fetchAll(PDO::FETCH_ASSOC);

            foreach ($users as $user) {
                echo "<option value=\"" . $user['userID'] . "\">" . $user['name'] . "</option><br>";
            }
            ?>
        </select>
        <input class="regularButton" type="submit" name="submit" value="Listázás">
    </form>
    <hr>
    <h2>Üzenetnapló</h2>
    <form action="logmessage" method="POST">
        <input class="regularButton" type="submit" name="submit" value="Listázás">
    </form>
    <hr>
    <h2>Járműnapló</h2>
    <form action="logcar" method="POST">
        <input class="regularButton" type="submit" name="submit" value="Listázás">
    </form>
    <hr>
</div>

<?php require './views/footer.phtml'; ?>
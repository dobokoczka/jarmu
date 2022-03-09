<?php
require './views/header.phtml';
require './tools/islogged.php';
require './views/adminmenu.phtml';
require 'connection.php';
?>

<div class="regularContainer">
    <h1><span>J</span>ármű<span>L</span>ogisztika</h1>
    <h2>Új felhasználó felvitele</h2>
    <form action="useradd" method="POST">
        <input type="text" name="username" placeholder="Felhasználónév" required>
        <input type="password" name="password" placeholder="Jelszó" required>
        <input type="password" name="passwordre" placeholder="Jelszó újra" required>
        <input type="text" name="name" placeholder="Név" required>
        <input type="email" name="email" placeholder="E-mail cím" required>
        <input type="text" name="telnumber" placeholder="Telefonszám" required>
        <label for="licence">Jogosultság</label>
        <select name="licence" required>
            <?php
            if ($_SESSION['username'] == "admin") {
                echo '  <option value="A">A</option>';
                echo '<option value="B">B</option>';
                echo '<option value="C">C</option>';
                echo '</select> ';
            } else {
                echo '<option value="B">B</option>';
                echo '<option value="C">C</option>';
                echo '</select> ';
            }
            ?>
            <input class="regularButton" type="submit" name="submit" value="Küldés">
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordre = $_POST['passwordre'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $telnumber = $_POST['telnumber'];
    $licence = $_POST['licence'];
    $active = 1;

    $statement_u = $conn->prepare("SELECT * FROM users WHERE username=?");
    $statement_u->execute([$_POST['username']]);
    $users = $statement_u->fetchAll(PDO::FETCH_ASSOC);
    $count_u = $statement_u->rowCount();

    $statement_e = $conn->prepare("SELECT * FROM users WHERE email=?");
    $statement_e->execute([$_POST['email']]);
    $emails = $statement_e->fetchAll(PDO::FETCH_ASSOC);
    $count_e = $statement_e->rowCount();

    if ($count_u > 0 || $count_e > 0) {
        echo '<p class="errorMessage">Már létezik ilyen felhasználó!</p>';
        echo '<a href="useradd" class="linkMessage">Ide kattintva próbálja meg újra!</a>';
        exit;
    }

    if ($password != $passwordre) {
        echo '<p class="errorMessage">Nem egyezik a két jelszó!</p>';
        echo '<a href="useradd" class="linkMessage">Ide kattintva próbálja meg újra!</a>';
        exit;
    }

    $statement_r = $conn->prepare(
        "INSERT INTO `users` (`username`, `password`, `name`, `email`, `telnumber`, `licence`, `activeUser`) 
        VALUES (?,?,?,?,?,?,?)"
    );

    if ($statement_r->execute([
        $username,
        password_hash($password, PASSWORD_DEFAULT),
        $name,
        $email,
        $telnumber,
        $licence,
        $active
    ])) {
        echo '<p class="okMessage">Regisztráció sikeres</p>';
    }
}
?>

<?php require './views/footer.phtml'; ?>
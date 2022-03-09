<?php
require './views/header.phtml';
require './tools/islogged.php';
if ($_SESSION['licence'] == "A") {
    require './views/adminmenu.phtml';
} else {
    require './views/menu.phtml';
}
?>

<div class="regularContainer">
    <h1><span>J</span>ármű<span>L</span>ogisztika</h1>
    <h2>Jelszómódosítás</h2>
    <form action="passw_mod" method="POST">
        <input type="password" name="passwordold" placeholder="Régi jelszó" required>
        <input type="password" name="password" placeholder="Új jelszó" required>
        <input type="password" name="passwordre" placeholder="Új jelszó újra" required>
        <input type="submit" class="regularButton" name="submit" value="Küldés">
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    include('connection.php');
    $statement_pm = $conn->prepare("SELECT * FROM users WHERE userID = ?");
    $statement_pm->execute([$_SESSION['id']]);
    $users = $statement_pm->fetch(PDO::FETCH_ASSOC);

    $passwordold = $users['password'];
    $newpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $isOkPass = password_verify($_POST['passwordold'], $users["password"]);

    if (!$isOkPass) {
        echo '<p class="errorMessage">Nem megfelelő a régi jelszó</p>';
    } else if ($_POST['password'] != $_POST['passwordre']) {
        echo '<p class="errorMessage">Nem egyezik az új jelszó</p>';
    } else {
        $statement_np = $conn->prepare("UPDATE users SET password='$newpassword' WHERE userID = ?");
        $statement_np->execute([$_SESSION['id']]);

        $today = date("Y-m-d H:i:s");
        $statement_log = $conn->prepare("INSERT INTO `logs` (`userID`, `date`, `logtypeID`) VALUES (?,?,?)");
        $statement_log->execute([$_SESSION['id'], $today, '3']);
        echo '<p class="okMessage">Jelszómódosítás sikeres</p>';
    }
}
?>

<?php require './views/footer.phtml';

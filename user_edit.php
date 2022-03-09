<?php
require './views/header.phtml';
require './tools/islogged.php';
require './views/adminmenu.phtml';
require './connection.php';

$id = $_GET['userID'];

$statement_u = $conn->prepare("SELECT * FROM users WHERE userID=?");
$statement_u->execute([$id]);
$users = $statement_u->fetch(PDO::FETCH_ASSOC);
?>

<div class="regularContainer">
    <h1><span>J</span>ármű<span>L</span>ogisztika</h1>
    <h2>Felhasználó szerkesztése</h2>
    <form action="userupd?userID=<?= $id ?>" method="POST">
        <input type="text" name="name" value="<?= $users['name'] ?>" required>
        <input type="email" name="email" value="<?= $users["email"] ?>" required>
        <input type="text" name="telnumber" value="<?= $users["telnumber"] ?>" required>
        <label for="licence">Jogosultság</label>
        <select name="licence" required>
            <option value="A" <?php if ($users['licence'] == "A") {
                                    echo 'selected';
                                } ?>>A</option>
            <option value="B" <?php if ($users['licence'] == "B") {
                                    echo 'selected';
                                } ?>>B</option>
            <option value="C" <?php if ($users['licence'] == "C") {
                                    echo 'selected';
                                } ?>>C</option>
        </select>
        <input class="regularButton" type="submit" name="submit" value="Küldés">
    </form>
</div>

<?php require './views/footer.phtml'; ?>
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
    <h2>Üzenet küldése</h2>
    <form action="messsend" method="POST">
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
        <label for="subject">Tárgy</label>
        <input type="text" name="subject" required>
        <label for="message">Üzenet</label>
        <textarea name="message" cols="30" rows="7"></textarea>
        <input class="regularButton" type="submit" name="submit" value="Küldés">
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $today = date("Y-m-d H:i:s");
    $sender = $_SESSION['id'];

    $statement = $conn->prepare(
        "INSERT INTO `messages` (`userID`, `senderID`,`sent_date`, `subject`, `message`, `viewed`) 
        VALUES (?,?,?,?,?,?);"
    );

    if ($statement->execute([
        $_POST['user'],
        $sender,
        $today,
        $_POST['subject'],
        $_POST['message'],
        "0"
    ])) {
        echo '<p class="okMessage">Az üzenet küldése sikeres</p>';
        $statement_mlog = $conn->prepare(
            "INSERT INTO `messagelog` (`senderID`, `userID`, `sent_date`, `subject`, `m_status`) 
            VALUES (?,?,?,?,?);"
        );

        $statement_mlog->execute([
            $sender,
            $_POST['user'],
            $today,
            $_POST['subject'],
            "1"
        ]);
    } else {
        echo '<p class="errorMessage">Az üzenet küldése sikertelen</p>';
        echo '<a href="messsend" class="linkMessage">Ide kattintva próbálja meg újra!</a>';
        $statement_mlog = $conn->prepare(
            "INSERT INTO `messagelog` (`senderID`, `userID`,`sent_date`, `subject`, `m_status`) 
            VALUES (?,?,?,?,?);"
        );

        $statement_mlog->execute([
            $sender,
            $_POST['user'],
            $today,
            $_POST['subject'],
            "0"
        ]);
    }
}
?>

<?php require './views/footer.phtml'; ?>
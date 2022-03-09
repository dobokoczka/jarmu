<?php require './views/header.phtml'; ?>

<div class="regularContainer">
    <h1><span>J</span>ármű<span>L</span>ogisztika</h1>
    <h2>Elfelejtett jelszó</h2>
    <form action="passwforg" method="POST">
        <p class="smallChar">Kérem adja meg az e-mail címét!</p>
        <input type="email" name="email" placeholder="E-mail cím" required>
        <input type="submit" class="regularButton" name="submit" value="Küldés">
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    include('connection.php');
    $statement_e = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $statement_e->execute([$_POST["email"]]);
    $email = $statement_e->fetch(PDO::FETCH_ASSOC);
    $count = $statement_e->rowCount();

    if ($count <= 0) {
        echo '<p class="errorMessage">Nincs ilyen felhasználó!</p>';
        exit;
    } else {
        $mailsubject = "Új belépési jelszó küldése";
        $name = $email['name'];
        $sendemail = $email['email'];
        $temppassw = rand(111111, 999999);
        $statement = $conn->prepare("UPDATE users SET password=?  WHERE userID = ?");
        $statement->execute([password_hash($temppassw, PASSWORD_DEFAULT), $email['userID']]);
        include('./tools/mailsender.php');
        mailsendPassw($temppassw, $sendemail, $mailsubject, $name);
        $today = date("Y-m-d H:i:s");
        $statement_log = $conn->prepare("INSERT INTO `logs` (`userID`, `date`, `logtypeID`) VALUES (?,?,?)");
        $statement_log->execute([$email['userID'], $today, '4']);
        echo '<p class="okMessage">Új jelszava e-mailben kiküldésre került</p>';
        echo '<a href="/" class="linkMessage">Belépés itt!</a>';
    }
}
?>

<?php require './views/footer.phtml';

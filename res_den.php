<?php
require './connection.php';
require './tools/islogged.php';
require './views/header.phtml';

$resID = $_GET['resID'];
$userID = $_GET['userID'];
$status = 2;
$today = date("Y-m-d H:i:s");
?>

<div class="regularContainer">
    <h1><span>J</span>ármű<span>L</span>ogisztika</h1>
    <form action="resden?resID=<?= $resID ?>&userID=<?= $userID ?>" method="POST">
        <p class="smallChar">Kérem adja meg az elutsítás okát!</p>
        <label for="denied">Elutasítás oka</label>
        <textarea name="denied" cols="30" rows="7" required></textarea>
        <input type="submit" class="regularButton" name="submit" value="Küldés">
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $acc_message = "Elutasítom a " . $resID . ". számú járműfoglalást.</br> Az elutasítás oka: " . $_POST['denied'] . "";
    $statement = $conn->prepare("UPDATE reservation SET res_status='$status' WHERE resID = ?");
    $statement->execute([$resID]);

    $statement_m = $conn->prepare(
        "INSERT INTO `messages` (`messID`, `userID`, `senderID`, `sent_date`, `subject`, `message`, `viewed`) 
        VALUES (?,?,?,?,?,?,?);"
    );

    $statement_m->execute([
        NULL,
        $userID,
        $_SESSION['id'],
        $today,
        "Elutasítás",
        $acc_message,
        "0"
    ]);

    $statement_mlog = $conn->prepare(
        "INSERT INTO `messagelog` (`senderID`, `userID`, `sent_date`, `subject`, `m_status`) 
        VALUES (?,?,?,?,?);"
    );

    $statement_mlog->execute([
        $_SESSION['id'],
        $userID,
        $today,
        "Elutasítás",
        "1"
    ]);

    header("location: reshand");
}
require './views/footer.phtml';

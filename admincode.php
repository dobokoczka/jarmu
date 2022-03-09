<?php
require './views/header.phtml';
require './tools/islogged.php';
?>

<div class="regularContainer">
    <h1><span>J</span>ármű<span>L</span>ogisztika</h1>
    <form action="admincode" method="POST">
        <p class="smallChar">Kérem adja meg az e-mailben kapott megerősítő kódot!</p>
        <input type="text" name="code" placeholder="Megerősítő kód" required>
        <input type="submit" class="regularButton" name="submit" value="Küldés">
    </form>
</div>

<?php

if (isset($_POST['submit'])) {
    include('connection.php');
    $statement_code = $conn->prepare("SELECT * FROM logincode");
    $statement_code->execute();
    $code = $statement_code->fetch(PDO::FETCH_ASSOC);
    $ecode = $code['ecode'];

    if ($ecode != $_POST['code']) {
        echo '<div class="errorMessage">
                    <p>Hibás megerősítő kód!</p><br>
                    </div>';
        exit;
    } else {
        header('location: adminhome');
    }
}
?>

<?php require './views/footer.phtml';

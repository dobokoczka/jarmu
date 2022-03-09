<?php require './views/header.phtml'; ?>

<div class="regularContainer">
  <h1><span>J</span>ármű<span>L</span>ogisztika</h1>
  <form action="/" method="post">
    <input type="text" name="username" placeholder="Felhasználónév">
    <input type="password" name="password" placeholder="Jelszó">
    <input class="regularButton" type="submit" name="submit" value="Belépés">
  </form>
  <a class="regularLink" href="/passwforg">Elfelejtett jelszó</a>
</div>

<?php
if (isset($_POST['submit'])) {
  require 'connection.php';
  $username = $_POST['username'];
  $password = $_POST['password'];
  $statement = $conn->prepare("SELECT * FROM users WHERE username=?");
  $statement->execute([$username]);
  $users = $statement->fetch(PDO::FETCH_ASSOC);
  $count = $statement->rowCount();
  if ($count == 0) {
    echo '<p class="errorMessage">Nincs ilyen felhasználó!</p>';
    exit;
  }

  if ($users['activeUser'] == 0) {
    echo '<p class="errorMessage">Nem aktív a felhasználó!</p>';
    exit;
  }

  $isOkPass = password_verify($_POST['password'], $users["password"]);
  if ($isOkPass) {
    session_start();
    $today = date("Y-m-d H:i:s");
    $_SESSION['id'] = $users["userID"];
    $_SESSION['username'] = $users["username"];
    $_SESSION['licence'] = $users["licence"];
    $_SESSION['name'] = $users["name"];
    $statement_log = $conn->prepare(
      "INSERT INTO `logs` (`userID`, `date`, `logtypeID`) 
      VALUES (?,?,?)"
    );
    $statement_log->execute([$users["userID"], $today, '1']);

    if ($users["licence"] == "A") {
      $mailsubject = "Megerősítő kód küldése";
      $name = $users['name'];
      $email = $users['email'];
      $word1 = "kód";
      $ecode = rand(111111, 999999);
      $statement = $conn->prepare("UPDATE logincode SET ecode='$ecode' WHERE id = ?");
      $statement->execute(["1"]);
      include('./tools/mailsender.php');
      mailsendEcode($ecode, $email, $mailsubject, $name);
      header('location: admincode');
    } else
      header('location: home');
  } else {
    echo '<p class="errorMessage">Hibás jelszó</p>';
    $today = date("Y-m-d H:i:s");
        $statement_log = $conn->prepare(
            "INSERT INTO `logs` (`userID`, `date`, `logtypeID`) 
        VALUES (?,?,?)"
        );
        $statement_log->execute([$users['userID'], $today, '5']);
  }
}
?>

<?php require './views/footer.phtml'; ?>
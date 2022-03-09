<?php
require './connection.php';
require './tools/islogged.php';
$messID = $_GET['messID'];

$statement = $conn->prepare("DELETE FROM messages WHERE messID = ?");
$statement->execute([$messID]);

header("location: messages");

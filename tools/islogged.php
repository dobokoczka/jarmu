<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo '<div class="loginContainer">
    <h2>Az oldalt csak bejelentkezett felahsználók használhatják!</h2>
    <h2 class="regularChar">Kérjük jelentkezzen be!</h2>
    <a class="regularButton" href="/">A belépéshez kattintson ide</a>
    </div>';
    die;
}
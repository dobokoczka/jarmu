<?php

$parsed = parse_url($_SERVER['REQUEST_URI']);
$path = $parsed["path"];

switch ($path) {

    case "/":
        require "./login.php";
        break;

    case "/home":
        require "./home.php";
        break;

    case "/adminhome":
        require "./adminhome.php";
        break;

    case "/useradd":
        require "./user_add.php";
        break;

    case "/caradd":
        require "./car_add.php";
        break;

    case "/admincode":
        require "./admincode.php";
        break;

    case "/userhand":
        require "./user_hand.php";
        break;

    case "/useredit":
        require "./user_edit.php";
        break;

    case "/userupd":
        require "./user_upd.php";
        break;

    case "/carhand":
        require "./car_hand.php";
        break;

    case "/log":
        require "./log.php";
        break;

    case "/loglist":
        require "./log_list.php";
        break;

    case "/logmessage":
        require "./log_message.php";
        break;

    case "/logcar":
        require "./log_car.php";
        break;

    case "/loguser":
        require "./log_user.php";
        break;

    case "/resadd":
        require "./res_add.php";
        break;

    case "/reslist":
        require "./res_list.php";
        break;

    case "/reshand":
        require "./res_hand.php";
        break;

    case "/resden":
        require "./res_den.php";
        break;

    case "/resacc":
        require "./res_acc.php";
        break;

    case "/serviceadd":
        require "./service_add.php";
        break;

    case "/servicehand":
        require "./service_hand.php";
        break;

    case "/servicerep":
        require "./service_rep.php";
        break;

    case "/caract":
        require "./car_act.php";
        break;

    case "/useract":
        require "./user_act.php";
        break;

    case "/passwforg":
        require "./passw_forg.php";
        break;

    case "/passw_mod":
        require "./passw_mod.php";
        break;

    case "/messages":
        require "./messages.php";
        break;

    case "/messdel":
        require "./mess_del.php";
        break;

    case "/messview":
        require "./mess_view.php";
        break;

    case "/messsend":
        require "./mess_send.php";
        break;

    case "/logout":
        require "./logout.php";
        break;

    default:
        require "./views/404.phtml";
        break;
}

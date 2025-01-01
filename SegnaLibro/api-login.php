<?php
require_once 'bootstrap.php';

$result["logged"] = false;

if(isset($_POST["email"]) && isset($_POST["password"])){

    $login_result = $dbh->checkLogin($_POST["email"]);
    if(count(value: $login_result)==0){
        $result["loginerror"] = "Email errata o non esistente.";
    } else if(password_verify($_POST["password"], $login_result[0]["Password"])) {
        registerLoggedUser($login_result[0]);
    } else {
        $result["loginerror"] = "Password errata.";
    }
}

if(isUserLoggedIn()){
    $result["logged"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);
?>
<?php
require_once 'bootstrap.php';

$result["logged"] = false;

if(isset($_POST["email"]) && isset($_POST["password"])) {
    $login_result = $dbh->checkLogin($_POST["email"]);
    if(count($login_result)==0) {
        $result["loginerror"] = "Username e/o password errati";
    } else {
        registerLoggedUser($login_result[0]);
    }
}

if(isUserLoggedIn()) {
    $result["logged"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);

?>
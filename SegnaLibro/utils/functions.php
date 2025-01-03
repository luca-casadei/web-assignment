<?php

function debug_to_console($data) {
    $output = $data;
    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

function registerLoggedUser($user) {
    $_SESSION["userid"] = $user["UniqueUserID"];
    $_SESSION["email"] = $user["Email"];
    $_SESSION["name"] = $user["Nome"];
    $_SESSION["lastname"] = $user["Cognome"];
    $_SESSION["password"] = $user["Password"];
    $_SESSION["venditore"] = $user["VenditoreID"];
}

function isUserLoggedIn(){
    return !empty($_SESSION['email']);
}

function isUserVendor(){
    return !is_null($_SESSION["venditore"]);
}

?>
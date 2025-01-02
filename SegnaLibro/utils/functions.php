<?php

//
// Debug functions
//
function debug_to_console($data) {
    $output = $data;

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

//
// User functions
//
function registerLoggedUser($user) {
    $_SESSION["userid"] = $user["UniqueUserID"];
    $_SESSION["email"] = $user["Email"];
    $_SESSION["name"] = $user["Nome"];
    $_SESSION["lastname"] = $user["Cognome"];
}

function isUserLoggedIn(){
    return !empty($_SESSION['email']);
}

?>
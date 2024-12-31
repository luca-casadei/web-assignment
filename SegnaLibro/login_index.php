<?php
    require './bootstrap.php';

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $login_result = $dbh->checkLogin($_POST['email']);

        if (!$login_result) {
            $tp["error"] = "Email o password errati";
        } else if (password_verify($_POST['password'], $login_result[0]["Password"])) {
            registerLoggedUser($login_result[0]);
        } else {
            $tp["error"] = "Email o password errati";
        }
    }

    if(isUserLoggedIn()){
        $tp["title"] = "SegnaLibro - Benvenuto";
        $tp["content"] = './pages/profile.php';
        $tp["identification"] = "profile";
    } else {
        $tp["title"] = "SegnaLibro - Accedi";
        $tp["content"] = './pages/login.php';
        $tp["identification"] = "access";
    }

    require './template/base.php';
?>
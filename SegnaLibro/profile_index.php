<?php
    require './bootstrap.php';

    $tp["title"] = "SegnaLibro - Profilo";
    $tp["identification"] = "profile";

    if (isUserLoggedIn()){
        $tp["content"] = './pages/profile.php';
    }
    else{
        header('Location: ./login_index.php');
    }

    require './template/base.php';
?>

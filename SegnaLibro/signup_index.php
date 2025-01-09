<?php
    require './bootstrap.php';

    $tp["title"] = "SegnaLibro - Registrazione";
    $tp["identification"] = "access";
    $tp["active"] = "signup";

    array_push($tp["js"], './js/signup.js');

    require './template/base.php';
?>
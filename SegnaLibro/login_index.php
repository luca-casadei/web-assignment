<?php
    require './bootstrap.php';

    $tp["title"] = "SegnaLibro - Accedi";
    $tp["identification"] = "access";
    array_push($tp["js"], "./js/login.js");

    require './template/base.php';
?>
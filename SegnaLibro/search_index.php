<?php
    require './bootstrap.php';

    $tp["title"] = "SegnaLibro - Ricerca";
    $tp["identification"] = "search";
    array_push($tp["js"], "./js/search.js");

    require './template/base.php';
?>
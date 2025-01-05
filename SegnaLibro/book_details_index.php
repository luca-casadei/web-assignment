<?php
    require './bootstrap.php';

    $tp["title"] = "SegnaLibro - Dettagli libro";
    $tp["identification"] = "book_details";
    array_push($tp["js"], "./js/book_details.js");

    require './template/base.php';
?>
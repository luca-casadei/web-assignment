<?php
require './bootstrap.php';

$tp["title"] = "SegnaLibro - Inserisci libro";
$tp["identification"] = "book_insert";

if (isUserLoggedIn()) {
    $tp["content"] = './pages/vendor/insertbook.php';
    define("DIRECT_ACCESS", false);
} else {
    header('Location: ./login_index.php');
}
array_push($tp["js"], "./js/vendor/insertbook.js", "./js/vendor/loadauthors.js", "./js/vendor/loadcategories.js");

require './template/base.php';

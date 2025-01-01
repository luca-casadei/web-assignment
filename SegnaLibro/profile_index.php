<?php
require './bootstrap.php';

$tp["title"] = "SegnaLibro - Profilo";
$tp["identification"] = "profile";

if (isUserLoggedIn()) {
    $tp["content"] = './pages/profile.php';
    define("DIRECT_ACCESS", false);
} else {
    header('Location: ./login_index.php');
}

require './template/base.php';

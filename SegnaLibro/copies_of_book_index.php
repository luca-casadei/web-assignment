<?php
require("./bootstrap.php");
if (isUserVendor()){
    $tp["title"] = "SegnaLibro - Annunci di un libro";
    $tp["identification"] = "copiesofbook";
    $tp["active"] = "copiesofbook";
    $tp["content"] = "./pages/vendor/copiesofbook.php";
    array_push($tp["js"], "./js/vendor/loadcopiesofbook.js");
    require("./template/base.php");
}
else{
    header("Location: ./index.php");
}
?>
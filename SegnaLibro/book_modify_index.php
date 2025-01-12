<?php
    require './bootstrap.php';
    if (!isset($_SESSION["expandedvendorbook"])){
        header("Location: ./index.php");
    }
    define('DIRECT_ACCESS',true);

    $tp["title"] = "SegnaLibro - Modifica libro";
    $tp["identification"] = "book_modify";
    $tp["content"] = './pages/vendor/modifybook.php';
    
    $data = json_decode($_SESSION["expandedvendorbook"],true);
    $data = $dbh->getBook($data["EAN"], $data["CodiceRegGroup"], $data["CodiceEditoriale"], $data["CodiceTitolo"]);
    
    $params = ["ean" => $data["EAN"], "codiceeditoriale" => $data["CodiceEditoriale"], "codicereggroup" => $data["CodiceRegGroup"], "codicetitolo" => $data["CodiceTitolo"]];
    $genres = $dbh->getBookGenres($params);

    array_push($tp["js"], "./js/vendor/modifybook.js", "./js/vendor/loadcategories.js", "./js/vendor/loadauthors.js");
    require './template/base.php';
?>
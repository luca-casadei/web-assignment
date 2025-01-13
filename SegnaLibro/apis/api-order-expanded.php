<?php
require '../bootstrap.php';
if (isset($_POST["orderexpanded"])){
    $_SESSION["orderexpanded"] = $_POST["orderexpanded"];
    echo 'SUCCESS';
}
else if (isset($_POST["getArticles"])) {
    $decode = json_decode($_SESSION["orderexpanded"],true);
    $articles= $dbh->getArticlesFromOrder($decode["codiceOrdine"]);
    $data["articles"] = $articles;
    echo json_encode($data);
}
else{
    echo http_response_code(400); 
}
?>
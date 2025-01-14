<?php
require '../../bootstrap.php';
if (isset($_POST["userorderexpanded"])){
    $_SESSION["orderexpanded"] = $_POST["userorderexpanded"];
    echo 'SUCCESS';
}
else if (isset($_POST["getArticles"])) {
    $decode = json_decode($_SESSION["orderexpanded"],true);
    $articles = $dbh->getArticlesFromOrder($decode["codiceOrdine"]);
    $data["articles"] = $articles;
    echo json_encode($data);
} else if (isset($_POST["markAsReady"])){ 
    $data = $dbh->markAsReady($_POST["markAsReady"]);
    echo $data;
}
else{
    echo http_response_code(400); 
}
?>
<?php
require '../bootstrap.php';
if (isset($_POST["orderexpanded"])){
    $_SESSION["orderexpanded"] = $_POST["orderexpanded"];
    echo 'SUCCESS';
}
else if (isset($_POST["getArticles"])) {
    $data = json_decode($_SESSION["orderexpanded"],true);
    $data = $dbh->getArticlesFromOrder($data["codiceOrdine"]);
    echo json_encode($data);
}
else{
    echo http_response_code(400); 
}
?>
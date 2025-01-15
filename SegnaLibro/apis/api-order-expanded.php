<?php
require '../bootstrap.php';
if (isset($_POST["orderexpanded"])){
    $_SESSION["orderexpanded"] = $_POST["orderexpanded"];
    echo 'SUCCESS';
}
else if (isset($_POST["getArticles"])) {
    $decode = json_decode($_SESSION["orderexpanded"],true);
    $articles= $dbh->getArticlesFromOrder($decode["codiceOrdine"]);
    $total_price = 0;
    for($j = 0; $j < count($articles); $j++){
        $total_price += $articles[$j]['Prezzo'];
    }
    $order = $dbh->getSingleOrder($decode["codiceOrdine"]);

    $data["articles"] = $articles;
    $data["DataOrdine"] = $order["DataOrdine"];
    $data["stato"] = $order["Stato"];
    $data["prezzoTotale"] = round($total_price,2);

    echo json_encode($data);
}
else{
    echo http_response_code(400); 
}
?>
<?php 
require('../bootstrap.php');

$orders = $dbh->getOrders();
for($i = 0; $i < count($orders); $i++){
        $total_price = 0;
        $articles = $dbh->getArticlesFromOrder($orders[$i]['Codice']);
        for($j = 0; $j < count($articles); $j++){
            $total_price += $articles[$j]['Prezzo']; 
        }
        $total_price = round($total_price, 2);
        $orders[$i]["Count"] = count($articles);
        $orders[$i]["PrezzoTotaleOrdine"] = $total_price;
    }
    $data = ["orders"=> $orders];

    header('Content-Type: application/json');
    echo json_encode($data);
?>
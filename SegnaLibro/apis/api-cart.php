<?php
require('../bootstrap.php');
$cart_articles = $dbh->getCart();
$total_price = 0;
for($i = 0; $i < count($cart_articles); $i++){
    $cart_articles[$i]["NomeImmagine"] = IMAGE_PATH.$cart_articles[$i]["NomeImmagine"];
    $total_price += $cart_articles[$i]["Prezzo"];
}
$data = [
    "articles"     => $cart_articles,
    "total_price"  => $total_price
];

header('Content-Type: application/json');
echo json_encode($data);
?>
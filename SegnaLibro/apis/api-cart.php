<?php
require('../bootstrap.php');

if(isset($_POST['numero_copia']) 
    && isset($_POST['ean']) 
    && isset($_POST['codice_editoriale']) 
    && isset($_POST['codice_reg_group']) 
    && isset($_POST['codice_titolo'])
    && isset($_POST['action'])) {
        if($_POST['action'] == 'remove') {
            $data = $dbh->removeArticleFromCart($_POST['numero_copia'],
            $_POST['ean'], 
            $_POST['codice_editoriale'], 
            $_POST['codice_reg_group'],
            $_POST['codice_titolo']);
        } else if ($_POST['action'] == 'add') {
            $data = $dbh->insertArticleInTheCart($_POST['numero_copia'],
            $_POST['ean'], 
            $_POST['codice_editoriale'], 
            $_POST['codice_reg_group'],
            $_POST['codice_titolo']);
        }

    header('Content-Type: application/json');
    if($data) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
} else {
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
}

?>
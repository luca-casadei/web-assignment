<?php
require('../bootstrap.php');

if(isset($_POST['action'])) {
    if(!isUserLoggedIn()){
        echo json_encode(["status" => "redirect"]);
    } else{
        header('Content-Type: application/json');
        if($_POST['action'] == 'remove') {
            $data = $dbh->removeArticleFromCart($_POST['numero_copia'],
            $_POST['ean'], 
            $_POST['codice_editoriale'], 
            $_POST['codice_reg_group'],
            $_POST['codice_titolo']);
        } else if ($_POST['action'] == 'add') {
            $article = json_decode($_SESSION["expandedarticledata"],true);
            if(!$dbh->isItemOrdered($article['NumeroCopia'], $article['EAN'], $article['CodiceEditoriale'], $article['CodiceRegGroup'],$article['CodiceTitolo'])){
                $data = $dbh->insertArticleInTheCart($article['NumeroCopia'],
                $article['EAN'], 
                $article['CodiceEditoriale'], 
                $article['CodiceRegGroup'],
                $article['CodiceTitolo']);
                if($data) {
                    echo json_encode(["status" => "success"]);
                } else {
                    echo json_encode(["status" => "error"]);
                }
            }
            else{
                echo json_encode(["status" => "ordered"]);
            }
        }
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
        "total_price"  => round($total_price,2)
    ];
    header('Content-Type: application/json');
    echo json_encode($data);
}

?>
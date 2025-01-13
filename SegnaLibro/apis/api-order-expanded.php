<?php
require '../bootstrap.php';
if (isset($_POST["orderexpanded"])){
    $_SESSION["orderexpanded"] = $_POST["orderexpanded"];
    echo 'SUCCESS';
}
else if (isset($_POST["getArticles"])) {
    $decode = json_decode($_SESSION["orderexpanded"],true);
    $articles= $dbh->getArticlesFromOrder($decode["codiceOrdine"]);
    for($i = 0; $i < count($articles); $i++){
        $images = $dbh->getBookImages($articles[$i]["Numero"], $articles[$i]["EAN"], $articles[$i]["CodiceRegGroup"], $articles[$i]["CodiceEditoriale"],$articles[$i]["CodiceTitolo"]);
        $articles[$i]["Immagine"] = IMAGE_PATH.$images[0]["Percorso"];
    }
    $data["articles"] = $articles;
    $data["prezzoTotale"] = $decode["prezzoTotale"];
    $data["dataOrdine"] = $decode["dataOrdine"];
    echo json_encode($data);
}
else{
    echo http_response_code(400); 
}
?>
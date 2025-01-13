<?php
require '../bootstrap.php';
if (isset($_POST["orderexpanded"])){
    $_SESSION["orderexpanded"] = $_POST["orderexpanded"];
    echo 'SUCCESS';
}
else if (isset($_POST["getArticles"])) {
    $decode = json_decode($_SESSION["orderexpanded"],true);
    $data = $dbh->getArticlesFromOrder($decode["codiceOrdine"]);
    for($i = 0; $i < count($data); $i++){
        $images = $dbh->getBookImages($data[$i]["Numero"], $data[$i]["EAN"], $data[$i]["CodiceRegGroup"], $data[$i]["CodiceEditoriale"],$data[$i]["CodiceTitolo"]);
        $data[$i]["Immagine"] = IMAGE_PATH.$images[0]["Percorso"];
    }

    echo json_encode($data);
}
else{
    echo http_response_code(400); 
}
?>
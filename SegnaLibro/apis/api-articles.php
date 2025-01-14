<?php
require('../bootstrap.php');
$articles = $dbh->getAnnounces();
for($i = 0; $i < count($articles); $i++){
    if (isUserLoggedIn() && !isUserVendor()){
        if($dbh->getIfCart($articles[$i]["EAN"], $articles[$i]["CodiceEditoriale"], $articles[$i]["CodiceTitolo"], $articles[$i]["CodiceRegGroup"], $articles[$i]["NumeroCopia"], $_SESSION["userid"])){
            $articles[$i]["InCarrello"] = "INCART";
        }
    }
    $articles[$i]["NomeImmagine"] = IMAGE_PATH.$articles[$i]["NomeImmagine"];
}
header('Content-Type: application/json');
echo json_encode($articles);
?>
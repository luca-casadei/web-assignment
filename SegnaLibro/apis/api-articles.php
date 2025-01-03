<?php
require('../bootstrap.php');
$articles = $dbh->getAnnounces();
for($i = 0; $i < count($articles); $i++){
    $articles[$i]["NomeImmagine"] = IMAGE_PATH.$articles[$i]["NomeImmagine"];
}
header('Content-Type: application/json');
echo json_encode($articles);
?>
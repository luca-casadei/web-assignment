<?php
require('../bootstrap.php');
if (isset($_POST["OrderMethod"])) {
    $articles = $dbh->getAnnouncesOrdered($_POST["OrderMethod"]);
    for ($i = 0; $i < count($articles); $i++) {
        $articles[$i]["NomeImmagine"] = IMAGE_PATH . $articles[$i]["NomeImmagine"];
    }
    header('Content-Type: application/json');
    echo json_encode($articles);
}
?>

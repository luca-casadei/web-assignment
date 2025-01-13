<?php
require("../../bootstrap.php");
if (isset($_SESSION["bofcopies"])){
    $data = json_decode($_SESSION["bofcopies"], true);
    $data = $dbh->getCopiesOfBook($data["EAN"], $data["CodiceRegGroup"], $data["CodiceEditoriale"], $data["CodiceTitolo"]);
    header('Content-Type: application/json');
    echo json_encode($data);
}
else{
    echo http_response_code(400);
}
?>


<?php
require("../../bootstrap.php");
if (isUserVendor()){
    if (isset($_POST["deletedetails"])){
        $data = json_decode($_POST["deletedetails"], true);
        $message = $dbh->deleteArticle($data["EAN"], $data["CodiceRegGroup"], $data["CodiceEditoriale"], $data["CodiceTitolo"], $data["NumeroCopia"]);
        echo $message;
    }
    else{
        echo http_response_code(400);
    }
}
else{
    echo http_response_code(403);
}
?>
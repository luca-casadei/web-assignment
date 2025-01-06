<?php
require ('../../bootstrap.php');
if(isset($_POST["book"])){
$genres = $dbh->getBookGenres(json_decode($_POST["book"],true));
header('Content-Type: application/json');
echo json_encode($genres);
}else{
    http_response_code(400);
}
?>
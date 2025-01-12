<?php 
require('../bootstrap.php');
$provinces = $dbh->getProvinces();
$userAddress = $dbh->getUserData();

$response = [
    "provinces" => $provinces,
    "user_info" => $userAddress
];

header('Content-Type: application/json');
echo json_encode($response);
?>
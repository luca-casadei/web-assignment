<?php 
require('../bootstrap.php');
if(isset($_POST['action'])){
    if ($_POST['action']== 'insert_order'){
        $status = $dbh->insertOrder();
        header('Content-Type: application/json');
        $response = [
            "status" => $status
        ];
        echo json_encode($response);
    }
} else {
    $provinces = $dbh->getProvinces();
    $userAddress = $dbh->getUserData();
    
    $response = [
        "provinces" => $provinces,
        "user_info" => $userAddress
    ];
    
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
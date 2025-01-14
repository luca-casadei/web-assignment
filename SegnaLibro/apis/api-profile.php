<?php
require('../bootstrap.php');
if(isset($_POST['old_password']) 
&& isset($_POST['new_password'])
&& isset($_POST['new_password_confirm'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $new_password_confirm = $_POST['new_password_confirm'];

    if($new_password != $new_password_confirm){
        $result["profile_alert"] = "Le password non corrispondono.";
    } else {
        if(!isUserLoggedIn()){
            $result["profile_alert"] = "Errore interno.";
        } else if(password_verify($old_password, $_SESSION['password'])) {
            $dbh->changePassword(password_hash($new_password, PASSWORD_DEFAULT, ['cost' => 13]));
            $result["profile_alert"] = "Password cambiata con successo.";
        } else {
            $result["profile_alert"] = "Password errata.";
        }
    }
    header('Content-Type: application/json');
    echo json_encode($result);

} else if (isset($_POST['name']) 
        || isset($_POST['lastname'])
        || isset($_POST['address_avenue'])
        || isset($_POST['address_civic'])
        || isset($_POST['address_city'])
        || isset($_POST['address_province'])
        || isset($_POST['address_cap'])) {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $avenue = $_POST['address_avenue'];
    $civic = $_POST['address_civic'];
    $city = $_POST['address_city'];
    $province = $_POST['address_province'];
    $cap = $_POST['address_cap'];

    if ($name != "" 
    && $lastname != "" 
    && $_SESSION["name"] != $name
    && $_SESSION["lastname"] != $lastname){
        $dbh->changePersonalDetails($name, $lastname);
        $_SESSION["name"] = $name;
        $_SESSION["lastname"] = $lastname;
        $result["profile_alert"] = "Informazioni personali cambiate con successo.";
    } else if ($avenue != ""
    || $civic != ""
    || $city != ""
    || $province != "" 
    || $cap != "") {
        $dbh->changeAddress($avenue, $civic, $city, $province, $cap);
        $result["profile_alert"] = "Indirizzo cambiato con successo.";
    } else {
        $result["profile_alert"] = "Informazioni non valide";
    }

    header('Content-Type: application/json');
    echo json_encode($result);
} else {
    $provinces = $dbh->getProvinces();
    $userInfo = $dbh->getUserData();

    $response = [
        "provinces" => $provinces,
        "user_info" => $userInfo
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
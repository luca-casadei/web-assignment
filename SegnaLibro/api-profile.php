<?php
require('bootstrap.php');
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
            $dbh->changePassword($_SESSION['email'], password_hash($new_password, PASSWORD_DEFAULT, ['cost' => 13]));
            $result["profile_alert"] = "Password cambiata con successo.";
        } else {
            $result["profile_alert"] = "Password errata.";
        }
    }
    header('Content-Type: application/json');
    echo json_encode($result);
} else {
    header('Location: ./pages/profile.php');
}
?>
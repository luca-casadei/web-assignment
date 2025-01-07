<?php
require "../bootstrap.php";
if(isset($_POST["nome"], $_POST["cognome"], $_POST["email"], $_POST["password"], $_POST["conferma-password"])){
    $opass = $_POST["password"];
    $cpass = $_POST["conferma-password"];
    header('Content-Type: application/json');
    $status["signuperror"] = "";
    if ($opass == $cpass){
        $hash = password_hash($cpass,PASSWORD_DEFAULT,['cost' => 13]);
        $status["signuperror"] = $dbh->signup($_POST["nome"], $_POST["cognome"], $_POST["email"], $hash);
        if (str_starts_with($status["signuperror"],"Duplicate")){
            $status["signuperror"] = "Email già registrata, effettuare l'accesso.";
        }
        echo json_encode($status);
    }
    else{
        $status["signuperror"] = "Le password non corrispondono.";
        echo json_encode($status);
    }
}
?>
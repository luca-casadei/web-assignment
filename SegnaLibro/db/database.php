<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function checkLogin($email){
        $query = "SELECT ACCOUNT.*, VENDITORE.UniqueUserID AS VenditoreID FROM ACCOUNT LEFT JOIN VENDITORE ON VENDITORE.UniqueUserID = ACCOUNT.UniqueUserID WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    public function getAnnounces(){
        $query = "SELECT * FROM ANNUNCI";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function changePassword($email, $password){
        $query = "UPDATE ACCOUNT SET Password = ? WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$password,$email);
        $stmt->execute();
    }

    public function getBooks(){
        $qr = "SELECT * FROM LIBRI_CATEGORIE_AUTORE";
        $stmt = $this->db->prepare($qr);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCart() {
        $qr = "SELECT * FROM CARRELLO JOIN ANNUNCI 
                ON CARRELLO.CodiceEditoriale = ANNUNCI.CodiceEditoriale 
                AND CARRELLO.CodiceRegGroup = ANNUNCI.CodiceRegGroup 
                AND CARRELLO.EAN = ANNUNCI.EAN
                AND CARRELLO.CodiceTitolo = ANNUNCI.CodiceTitolo
                WHERE CARRELLO.UniqueUserID = ?";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param('i',$_SESSION['userid']);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function removeArticleFromCart($numero_copia, $ean, $codice_editoriale, $codice_reg_group, $codice_titolo){
        $qr = "DELETE FROM CARRELLO WHERE NumeroCopia = ? AND EAN = ? AND CodiceEditoriale = ? AND CodiceRegGroup = ? AND CodiceTitolo = ? AND UniqueUserID = ?";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param('issssi', $numero_copia, $ean, $codice_editoriale, $codice_reg_group, $codice_titolo, $_SESSION['userid']);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>

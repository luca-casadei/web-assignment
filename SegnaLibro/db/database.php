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

    public function checkLogin($email)
    {
        $query = "SELECT ACCOUNT.*, VENDITORE.UniqueUserID AS VenditoreID FROM ACCOUNT LEFT JOIN VENDITORE ON VENDITORE.UniqueUserID = ACCOUNT.UniqueUserID WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAnnounces()
    {
        $query = "SELECT a.* FROM ANNUNCI a WHERE (a.NumeroCopia, a.EAN, a.CodiceRegGroup, a.CodiceEditoriale, a.CodiceTitolo) NOT IN (SELECT NumeroCopia, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo FROM COPIE_ORDINE)";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAnnouncesOrdered($orderMethod)
    {
        $query = "SELECT a.* FROM ANNUNCI a WHERE (a.NumeroCopia, a.EAN, a.CodiceRegGroup, a.CodiceEditoriale, a.CodiceTitolo) NOT IN (SELECT NumeroCopia, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo FROM COPIE_ORDINE)";
        switch ($orderMethod) {
            case "pdesc": {
                    $query = $query . " ORDER BY Prezzo DESC";
                    break;
                }
            case "pasc": {
                    $query = $query . " ORDER BY Prezzo ASC";
                    break;
                }
            case "tdesc": {
                    $query = $query . " ORDER BY Titolo DESC";
                    break;
                }
            case "tasc": {
                    $query = $query . " ORDER BY Titolo ASC";
                    break;
                }
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAnnounce($ean, $codice_reg_group, $codice_editoriale, $codice_titolo, $numero_copia)
    {
        $query = "SELECT * FROM ANNUNCI WHERE ANNUNCI.EAN = ? AND ANNUNCI.CodiceRegGroup = ? AND ANNUNCI.CodiceEditoriale = ? AND ANNUNCI.CodiceTitolo = ? AND ANNUNCI.NumeroCopia = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssi", $ean, $codice_reg_group, $codice_editoriale, $codice_titolo, $numero_copia);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function changePassword($password)
    {
        $query = "UPDATE ACCOUNT SET Password = ? WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $password, $_SESSION['email']);
        $stmt->execute();
    }

    public function changePersonalDetails($name, $lastname)
    {
        $query = "UPDATE ACCOUNT SET Nome = ?, Cognome = ? WHERE UniqueUserID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssi', $name, $lastname, $_SESSION["userid"]);
        $stmt->execute();
    }

    public function changeAddress($avenue, $civic, $city, $province, $cap)
    {
        $query = "INSERT INTO INDIRIZZO (UniqueUserID, Via, Civico, CAP, Citta, CodiceProvincia)
                    VALUES (?, ?, ?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE
                    Via = VALUES(Via),
                    Civico = VALUES(Civico),
                    CAP = VALUES(CAP),
                    Citta = VALUES(Citta),
                    CodiceProvincia = VALUES(CodiceProvincia);
                    ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('isssss', $_SESSION["userid"], $avenue, $civic, $cap, $city, $province);
        $stmt->execute();
    }

    public function getProvinces()
    {
        $query = "SELECT * FROM PROVINCIA";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getRegGroup()
    {
        $query = "SELECT * FROM REGGROUP";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBooks()
    {
        $qr = "SELECT * FROM LIBRI_CATEGORIE_AUTORE";
        $stmt = $this->db->prepare($qr);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOrders()
    {
        $qr = "SELECT * FROM ORDINE WHERE UniqueUserID = ?";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param('i', $_SESSION['userid']);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllOrders()
    {
        $qr = "SELECT * FROM ORDINE JOIN ACCOUNT ON ORDINE.UniqueUserID = ACCOUNT.UniqueUserID";
        $stmt = $this->db->prepare($qr);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getArticlesFromOrder($CodiceOrdine)
    {
        $qr = "SELECT * FROM COPIE_ORDINE JOIN ANNUNCI 
                ON COPIE_ORDINE.CodiceEditoriale = ANNUNCI.CodiceEditoriale 
                AND COPIE_ORDINE.CodiceRegGroup = ANNUNCI.CodiceRegGroup 
                AND COPIE_ORDINE.EAN = ANNUNCI.EAN
                AND COPIE_ORDINE.CodiceTitolo = ANNUNCI.CodiceTitolo
                AND COPIE_ORDINE.NumeroCopia = ANNUNCI.NumeroCopia
                WHERE COPIE_ORDINE.CodiceOrdine = ?";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param('i', $CodiceOrdine);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getCart()
    {
        $qr = "SELECT * FROM CARRELLO JOIN ANNUNCI 
                ON CARRELLO.CodiceEditoriale = ANNUNCI.CodiceEditoriale 
                AND CARRELLO.CodiceRegGroup = ANNUNCI.CodiceRegGroup 
                AND CARRELLO.EAN = ANNUNCI.EAN
                AND CARRELLO.CodiceTitolo = ANNUNCI.CodiceTitolo
                AND CARRELLO.NumeroCopia = ANNUNCI.NumeroCopia
                WHERE CARRELLO.UniqueUserID = ?";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param('i', $_SESSION['userid']);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertArticleInTheCart($numero_copia, $ean, $codice_editoriale, $codice_reg_group, $codice_titolo)
    {
        $qr = "INSERT INTO CARRELLO (NumeroCopia, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo, UniqueUserID) SELECT ?, ?, ?, ?, ?, ? WHERE NOT EXISTS (SELECT 1 FROM CARRELLO WHERE NumeroCopia = ? AND EAN = ? AND CodiceRegGroup = ? AND CodiceEditoriale = ? AND CodiceTitolo = ? AND UniqueUserID = ? LIMIT 1)";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param("issssiissssi", $numero_copia, $ean, $codice_reg_group, $codice_editoriale, $codice_titolo, $_SESSION['userid'], $numero_copia, $ean, $codice_reg_group, $codice_editoriale, $codice_titolo, $_SESSION['userid']);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function removeArticleFromCart($numero_copia, $ean, $codice_editoriale, $codice_reg_group, $codice_titolo)
    {
        $qr = "DELETE FROM CARRELLO WHERE NumeroCopia = ? AND EAN = ? AND CodiceEditoriale = ? AND CodiceRegGroup = ? AND CodiceTitolo = ? AND UniqueUserID = ?";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param('issssi', $numero_copia, $ean, $codice_editoriale, $codice_reg_group, $codice_titolo, $_SESSION['userid']);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function getUserData()
    {
        $qr = "SELECT 
                    ACCOUNT.UniqueUserID,
                    ACCOUNT.Nome,
                    ACCOUNT.Cognome,
                    ACCOUNT.Email,
                    INDIRIZZO.Via,
                    INDIRIZZO.Civico,
                    INDIRIZZO.CAP,
                    INDIRIZZO.Citta,
                    PROVINCIA.Codice AS CodiceProvincia,
                    PROVINCIA.Nome AS NomeProvincia
                FROM ACCOUNT 
                LEFT JOIN INDIRIZZO 
                    ON ACCOUNT.UniqueUserID = INDIRIZZO.UniqueUserID
                LEFT JOIN PROVINCIA 
                    ON INDIRIZZO.CodiceProvincia = PROVINCIA.Codice
                WHERE ACCOUNT.UniqueUserID = ?;
";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param('i', $_SESSION['userid']);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getBookImages($numero_copia, $ean, $codice_reg_group, $codice_editoriale, $codice_titolo)
    {
        $qr = 'SELECT Percorso FROM IMMAGINE WHERE NumeroCopia = ? AND EAN = ? AND CodiceRegGroup = ? AND CodiceEditoriale = ? AND CodiceTitolo = ?';
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param('issss', $numero_copia, $ean, $codice_reg_group, $codice_editoriale, $codice_titolo);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBookGenres($book)
    {
        $qr = "SELECT * FROM genere JOIN genere_libro ON genere_libro.CodiceGenere = genere.Codice WHERE genere_libro.EAN = ? AND genere_libro.CodiceEditoriale = ? AND genere_libro.CodiceRegGroup = ? AND genere_libro.CodiceTitolo = ?";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param('ssss', $book["ean"], $book["codiceeditoriale"], $book["codicereggroup"], $book["codicetitolo"]);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function signup($name, $surname, $email, $password)
    {
        try {
            $this->db->begin_transaction();
            $qr = "INSERT INTO ACCOUNT (Email, Password, Nome, Cognome) VALUES (?,?,?,?);";
            $stmt = $this->db->prepare($qr);
            $stmt->bind_param('ssss', $email, $password, $name, $surname);
            $stmt->execute();
            $qr = "INSERT INTO UTENTE (UniqueUserID) VALUES (LAST_INSERT_ID());";
            $stmt = $this->db->prepare($qr);
            $stmt->execute();
            $this->db->commit();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function fullyInsertBook($book, $author, $category, $genres)
    {
        try {
            $this->db->begin_transaction();
            $okBook = $this->insertBook($book);
            if (!$okBook) {
                throw new Exception("Book not inserted");
            }
            $okAuthor = $this->insertAuthor($author);
            $okBookAuthor = $this->insertBookAuthor($book, $author);
            $okBookGenres = $this->insertBookGenres($book, $category, $genres);

            $this->db->commit();
            return json_encode([
                "book" => $okBook,
                "author" => $okAuthor,
                "bookauthor" => $okBookAuthor,
                "bookgenres" => $okBookGenres
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAuthors()
    {
        $qr = "SELECT * FROM AUTORE";
        $stmt = $this->db->prepare($qr);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getConditions()
    {
        $qr = "SELECT * FROM CONDIZIONE";
        $stmt = $this->db->prepare($qr);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategories()
    {
        $qr = "SELECT * FROM CATEGORIA";
        $stmt = $this->db->prepare($qr);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategoryGenres($category)
    {
        $qr = "SELECT * FROM GENERE WHERE CodiceCategoria = ?";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param('i', $category);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertCopy($book, $title, $price, $description, $date, $condition, $images)
    {
        try {
            $this->db->begin_transaction();
                $qr = "INSERT INTO COPIA (EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo, Prezzo, Titolo, Descrizione, DataAnnuncio, CodiceCondizione) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->db->prepare($qr);
                $stmt->bind_param("ssssisssi", $book["EAN"], $book["CodiceRegGroup"], $book["CodiceEditoriale"], $book["CodiceTitolo"], $price, $title, $description, $date, $condition);
                $stmt->execute();

                $last_copy_id = $this->db->insert_id;
                for ($i = 1; $i <= count($images); $i++) {
                    $image = $images[$i-1];
                    $image += "-" . $last_copy_id . "-" . $i;
                    $qr = "INSERT INTO IMMAGINE (Numero, Percorso, NumeroCopia, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $this->db->prepare($qr);
                    $stmt->bind_param("isissss", $i, $image, $last_copy_id, $book["EAN"], $book["CodiceRegGroup"], $book["CodiceEditoriale"],$book["CodiceTitolo"]);
                    $stmt->execute();
                }
            $this->db->commit();
            return "PROVA db";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function insertBook($book)
    {
        $qr = "INSERT INTO LIBRO (EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo, CifraControllo, Titolo, Descrizione, DataPubblicazione, Edizione) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param("ssssisssi", $book["EAN"], $book["CodiceRegGroup"], $book["CodiceEditoriale"], $book["CodiceTitolo"], $book["CifraControllo"], $book["Titolo"], $book["Descrizione"], $book["DataPubblicazione"], $book["Edizione"]);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function insertAuthor($author)
    {
        $qr = "INSERT INTO AUTORE (Nome, Cognome) SELECT ?, ? WHERE NOT EXISTS (SELECT 1 FROM AUTORE WHERE Nome = ? AND Cognome = ? LIMIT 1)";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param("ssss", $author["Nome"], $author["Cognome"], $author["Nome"], $author["Cognome"]);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function getAuthorId($author)
    {
        $qr = "SELECT Codice FROM AUTORE WHERE Nome = ? AND Cognome = ?";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param("ss", $author["Nome"], $author["Cognome"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $author_data = $result->fetch_assoc();
        return $author_data ? $author_data["Codice"] : null;
    }

    public function insertBookAuthor($book, $author)
    {
        $author_id = $this->getAuthorId($author);
        if ($author_id) {
            $qr = "INSERT INTO AUTORI_LIBRO (EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo, CodiceAutore) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($qr);
            $stmt->bind_param("ssssi", $book["EAN"], $book["CodiceRegGroup"], $book["CodiceEditoriale"], $book["CodiceTitolo"], $author_id);
            $stmt->execute();
            return $stmt->affected_rows > 0;
        } else {
            throw new Exception("Author not found");
        }
    }

    public function getCategoryId($category)
    {
        $qr = "SELECT Codice FROM CATEGORIA WHERE Nome = ?";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param("s", $category["Nome"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $category_data = $result->fetch_assoc();
        return $category_data ? $category_data["Codice"] : null;
    }

    public function insertBookGenres($book, $category, $genres)
    {
        $category_id = $this->getCategoryId($category);
        $ok = true;
        foreach ($genres as $genre) {
            $qr = "INSERT INTO GENERE_LIBRO (EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo, CodiceGenere, CodiceCategoria) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($qr);
            $stmt->bind_param("ssssii", $book["EAN"], $book["CodiceRegGroup"], $book["CodiceEditoriale"], $book["CodiceTitolo"], $genre, $category_id);
            $stmt->execute();
            if ($stmt->affected_rows <= 0) {
                $ok = false;
            }
        }

        return $ok;
    }

    public function getBook($ean, $codice_reg_group, $codice_editoriale, $codice_titolo)
    {
        $query = "SELECT * FROM libri_categorie_autore WHERE EAN = ? AND CodiceRegGroup = ? AND CodiceEditoriale = ? AND CodiceTitolo = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssss", $ean, $codice_reg_group, $codice_editoriale, $codice_titolo);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getCopiesOfBook($ean, $codice_reg_group, $codice_editoriale, $codice_titolo)
    {
        $query = "SELECT A.* FROM ANNUNCI as A WHERE A.EAN = ? AND A.CodiceRegGroup = ? AND A.CodiceEditoriale = ? AND A.CodiceTitolo = ? AND NOT EXISTS ( SELECT * FROM COPIE_ORDINE AS CP WHERE CP.EAN = A.EAN AND CP.CodiceRegGroup = A.CodiceRegGroup AND CP.CodiceEditoriale = A.CodiceEditoriale AND CP.CodiceTitolo = A.CodiceTitolo AND A.NumeroCopia = CP.NumeroCopia )";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssss", $ean, $codice_reg_group, $codice_editoriale, $codice_titolo);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteArticle($ean, $codice_reg_group, $codice_editoriale, $codice_titolo, $numero_copia)
    {
        try {
            $query = "DELETE FROM COPIA WHERE EAN = ? AND CodiceRegGroup = ? AND CodiceEditoriale = ? AND CodiceTitolo = ? AND Numero = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ssssi", $ean, $codice_reg_group, $codice_editoriale, $codice_titolo, $numero_copia);
            $stmt->execute();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function insertOrder()
    {
        try {
            $this->db->begin_transaction();
            $qr = "INSERT INTO ordine (DataOrdine, Stato, UniqueUserID) VALUES (?, 'Aperto', ?);";
            $stmt = $this->db->prepare($qr);
            $orderDate = date("Y-m-d");
            $stmt->bind_param("si", $orderDate, $_SESSION['userid']);
            $stmt->execute();

            $oid = $this->db->insert_id;

            $qr = "INSERT INTO NOTIFICA (UniqueUserID, Titolo, Testo, CodiceOrdine) VALUES (?,'Nuovo ordine','È stato creato un nuovo ordine, seleziona questa notifica per visualizzarlo.',?)";
            $stmt = $this->db->prepare($qr);
            $stmt->bind_param("ii", $_SESSION['userid'], $oid);
            $stmt->execute();

            $cart_articles = $this->getCart();
            for ($i = 0; $i < count($cart_articles); $i++) {
                $qr = "INSERT INTO copie_ordine (NumeroCopia, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo, CodiceOrdine) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $this->db->prepare($qr);
                $stmt->bind_param("issssi", $cart_articles[$i]["NumeroCopia"], $cart_articles[$i]["EAN"], $cart_articles[$i]["CodiceRegGroup"], $cart_articles[$i]["CodiceEditoriale"], $cart_articles[$i]["CodiceTitolo"], $oid);
                $stmt->execute();
            }

            $qr = "DELETE FROM carrello WHERE UniqueUserID = ?";
            $stmt = $this->db->prepare($qr);
            $stmt->bind_param("i", $_SESSION['userid']);
            $stmt->execute();

            $this->db->commit();
            return $stmt->affected_rows > 0;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateBook($book)
    {
        $qr = "UPDATE LIBRO SET Titolo = ?, Descrizione = ?, DataPubblicazione = ?, Edizione = ? WHERE EAN = ? AND CodiceRegGroup = ? AND CodiceEditoriale = ? AND CodiceTitolo = ?;";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param(
            "sssissss",
            $book["Titolo"],
            $book["Descrizione"],
            $book["DataPubblicazione"],
            $book["Edizione"],
            $book["EAN"],
            $book["CodiceRegGroup"],
            $book["CodiceEditoriale"],
            $book["CodiceTitolo"]
        );
        return $stmt->execute();
    }

    public function updateAuthor($author)
    {
        $qr = "UPDATE AUTORE SET Nome = ?, Cognome = ? WHERE Codice = ?";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param(
            "ssi",
            $author["Nome"],
            $author["Cognome"],
            $author["Codice"]
        );
        $stmt->execute();
        return $stmt->affected_rows >= 0;
    }

    public function updateBookAuthor($book, $author)
    {
        $qrDelete = "DELETE FROM AUTORI_LIBRO WHERE EAN = ? AND CodiceRegGroup = ? AND CodiceEditoriale = ? AND CodiceTitolo = ?";
        $stmt = $this->db->prepare($qrDelete);
        $stmt->bind_param(
            "ssss",
            $book["EAN"],
            $book["CodiceRegGroup"],
            $book["CodiceEditoriale"],
            $book["CodiceTitolo"]
        );
        $stmt->execute();

        return $this->insertBookAuthor($book, $author);
    }

    public function updateBookGenres($book, $category, $genres)
    {
        $qrDelete = "DELETE FROM GENERE_LIBRO WHERE EAN = ? AND CodiceRegGroup = ? AND CodiceEditoriale = ? AND CodiceTitolo = ?";
        $stmt = $this->db->prepare($qrDelete);
        $stmt->bind_param(
            "ssss",
            $book["EAN"],
            $book["CodiceRegGroup"],
            $book["CodiceEditoriale"],
            $book["CodiceTitolo"]
        );
        $stmt->execute();

        return $this->insertBookGenres($book, $category, $genres);
    }

    public function fullyUpdateBook($book, $author, $category, $genres)
    {
        try {
            $this->db->begin_transaction();

            $okBook = $this->updateBook($book);
            if (!$okBook) {
                throw new Exception("Book not updated");
            }
            $okAuthor = $this->updateAuthor($author);
            $okBookAuthor = $this->updateBookAuthor($book, $author);
            $okBookGenres = $this->updateBookGenres($book, $category, $genres);

            $this->db->commit();
            return json_encode([
                "book" => $okBook,
                "author" => $okAuthor,
                "bookauthor" => $okBookAuthor,
                "bookgenres" => $okBookGenres
            ]);
        } catch (Exception $e) {
            $this->db->rollback();
            return $e->getMessage();
        }
    }

    public function getNotificationsOfUUID($userid)
    {
        $qr = "SELECT * FROM NOTIFICA WHERE UniqueUserID = ?";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function markAsReady($orderCode)
    {
        $qr = "UPDATE ORDINE SET ORDINE.Stato='Pronto' WHERE Codice = ?";
        $stmt = $this->db->prepare($qr);
        $stmt->bind_param("i", $orderCode);
        return $stmt->execute();
    }
}

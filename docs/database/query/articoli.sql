/* Ottenimento di tutto il necessario per rappresentare gli articoli */
CREATE VIEW LIBRI_CATEGORIE_AUTORE AS (
	SELECT LIBRO.*,
	AUTORE.Codice AS CodiceAUTORE,
	AUTORE.Nome AS NomeAUTORE,
	AUTORE.Cognome AS CognomeAUTORE,
	CATEGORIA.Codice AS CodiceCategoria,
	CATEGORIA.Nome AS NomeCategoria,
	EDITORE.Nome AS NomeEditore
	FROM LIBRO join AUTORI_LIBRO
	ON AUTORI_LIBRO.EAN = LIBRO.EAN
	AND AUTORI_LIBRO.CodiceRegGroup = LIBRO.CodiceRegGroup
	AND AUTORI_LIBRO.CodiceTitolo = LIBRO.CodiceTitolo
	AND AUTORI_LIBRO.CodiceEditoriale = LIBRO.CodiceEditoriale
	JOIN AUTORE ON AUTORE.Codice = AUTORI_LIBRO.CodiceAUTORE
	JOIN GENERE_LIBRO ON GENERE_LIBRO.EAN = LIBRO.EAN
	AND GENERE_LIBRO.CodiceRegGroup = LIBRO.CodiceRegGroup
	AND GENERE_LIBRO.CodiceEditoriale = LIBRO.CodiceEditoriale
	AND GENERE_LIBRO.CodiceTitolo = LIBRO.CodiceTitolo
	JOIN GENERE ON GENERE.Codice = GENERE_LIBRO.CodiceGENERE
	JOIN CATEGORIA ON CATEGORIA.Codice = GENERE.CodiceCategoria
	JOIN EDITORE ON EDITORE.CodiceEditoriale = LIBRO.CodiceEditoriale
	GROUP BY EAN, CodiceEditoriale, CodiceTitolo, CodiceRegGroup
);

CREATE VIEW ANNUNCI AS (	
    SELECT LIBRI_CATEGORIE_AUTORE.*, 
    COPIA.Titolo AS TitoloAnnuncio, 
    COPIA.Prezzo, 
    COPIA.Descrizione AS DescrizioneAnnuncio, 
    COPIA.DataAnnuncio,
    COPIA.Numero AS NumeroCopia,
    IMMAGINE.Percorso AS NomeImmagine,
    CONDIZIONE.Nome AS NomeCondizione
	FROM LIBRI_CATEGORIE_AUTORE
	JOIN COPIA ON COPIA.EAN = LIBRI_CATEGORIE_AUTORE.EAN
	AND COPIA.CodiceRegGroup = LIBRI_CATEGORIE_AUTORE.CodiceRegGroup
	AND COPIA.CodiceTitolo = LIBRI_CATEGORIE_AUTORE.CodiceTitolo
	AND COPIA.CodiceEditoriale = LIBRI_CATEGORIE_AUTORE.CodiceEditoriale
    JOIN CONDIZIONE ON COPIA.CodiceCondizione = CONDIZIONE.Codice
    LEFT JOIN IMMAGINE ON IMMAGINE.CodiceRegGroup = COPIA.CodiceRegGroup
    AND IMMAGINE.CodiceEditoriale = COPIA.CodiceEditoriale
    AND IMMAGINE.EAN = COPIA.EAN
	AND IMMAGINE.CodiceTitolo = COPIA.CodiceTitolo
    AND IMMAGINE.NumeroCopia = COPIA.Numero
    GROUP BY COPIA.EAN, COPIA.CodiceEditoriale, COPIA.CodiceRegGroup, COPIA.CodiceTitolo, COPIA.Numero
);

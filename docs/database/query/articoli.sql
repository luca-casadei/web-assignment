/* Ottenimento di tutto il necessario per rappresentare gli articoli */
CREATE VIEW LIBRI_CATEGORIE_AUTORE AS (
	SELECT libro.*,
	autore.Codice AS CodiceAutore,
	autore.Nome AS NomeAutore,
	autore.Cognome AS CognomeAutore,
	CATEGORIA.Codice AS CodiceCategoria,
	CATEGORIA.Nome AS NomeCategoria,
	editore.Nome AS NomeEditore
	FROM libro join autori_libro
	ON autori_libro.EAN = libro.EAN
	AND autori_libro.CodiceRegGroup = libro.CodiceRegGroup
	AND autori_libro.CodiceTitolo = libro.CodiceTitolo
	AND autori_libro.CodiceEditoriale = libro.CodiceEditoriale
	JOIN autore ON autore.Codice = autori_libro.CodiceAutore
	JOIN genere_libro ON genere_libro.EAN = libro.EAN
	AND genere_libro.CodiceRegGroup = libro.CodiceRegGroup
	AND genere_libro.CodiceEditoriale = libro.CodiceEditoriale
	AND genere_libro.CodiceTitolo = libro.CodiceTitolo
	JOIN genere ON genere.Codice = genere_libro.CodiceGenere
	JOIN CATEGORIA ON CATEGORIA.Codice = GENERE.CodiceCategoria
	JOIN editore ON editore.CodiceEditoriale = LIBRO.CodiceEditoriale
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
    GROUP BY COPIA.EAN, COPIA.CodiceEditoriale, COPIA.CodiceRegGroup, COPIA.CodiceTitolo
);
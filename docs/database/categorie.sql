INSERT INTO CATEGORIA (Nome) VALUES 
('Romanzo'), 
('Saggistica'), 
('Poesia');

INSERT INTO GENERE (CodiceCategoria, Nome, Descrizione) VALUES 
(1, 'Giallo', 'Libri di genere investigativo e thriller'), -- CodiceGenere 1
(1, 'Rosa', 'Libri romantici e sentimentali'),            -- CodiceGenere 2
(1, 'Fantasy', 'Libri di ambientazione fantastica'),      -- CodiceGenere 3
(1, 'Horror', 'Libri del genere horror'),                -- CodiceGenere 4
(1, 'Storico', 'Libri di ambientazione storica'),         -- CodiceGenere 5
(2, 'Politico', 'Saggi e trattati politici'),             -- CodiceGenere 6
(3, 'Haiku', 'Poesie giapponesi brevi'),                  -- CodiceGenere 7
(3, 'Moderna', 'Poesia contemporanea'),                   -- CodiceGenere 8
(1, 'Distopia', 'Romanzi che descrivono società oppresse'); -- CodiceGenere 9

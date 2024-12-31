INSERT INTO LIBRO (EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo, CifraControllo, Titolo, Descrizione, DataPubblicazione, Edizione) VALUES
('978', '12345', '001001', '000001', 8, 'Il Nome della Rosa', 'Un celebre romanzo giallo storico di Umberto Eco.', '1980-03-01', 1),
('978', '12345', '001001', '000002', 7, 'Io Uccido', 'Un thriller italiano di grande successo.', '2002-04-01', 1),
('978', '12345', '002002', '000003', 4, 'Harry Potter e la Pietra Filosofale', 'Un libro fantasy per tutte le età.', '1997-06-26', 1),
('978', '12345', '003003', '000004', 2, 'Dracula', 'Un classico romanzo horror di Bram Stoker.', '1897-05-26', 1),
('978', '12345', '004004', '000005', 9, 'La Cattedrale del Mare', 'Un romanzo storico ambientato nella Barcellona medievale.', '2006-02-01', 1),
('978', '12345', '001001', '000006', 6, 'Orgoglio e Pregiudizio', 'Un grande romanzo rosa della letteratura inglese.', '1813-01-28', 1),
('978', '12345', '002002', '000007', 3, 'Il Signore degli Anelli', 'Un capolavoro della letteratura fantasy.', '1954-07-29', 1),
('978', '12345', '003003', '000008', 1, 'IT', 'Un romanzo horror di Stephen King.', '1986-09-15', 1),
('978', '12345', '004004', '000009', 5, 'Sapiens', 'Un saggio storico sulla storia dell’umanità.', '2011-06-04', 1),
('978', '54321', '001001', '000010', 8, '1984', 'Un classico romanzo distopico.', '1949-06-08', 1),
('979', '54321', '002002', '000011', 7, 'Il Codice Da Vinci', 'Un thriller che combina storia, arte e mistero.', '2003-03-18', 1),
('978', '54321', '003003', '000012', 4, 'L\'Amica Geniale', 'Un romanzo di Elena Ferrante sulla vita e l\'amicizia.', '2011-10-19', 1),
('978', '54321', '004004', '000013', 2, 'Il Piccolo Principe', 'Un classico per bambini e adulti.', '1943-04-06', 1),
('978', '54321', '001001', '000014', 9, 'La Metamorfosi', 'Un breve romanzo di Kafka.', '1915-11-01', 1),
('978', '54321', '002002', '000015', 6, 'Don Chisciotte', 'Un capolavoro della letteratura spagnola.', '1605-01-16', 1),
('978', '54321', '003003', '000016', 3, 'Il Conte di Montecristo', 'Un romanzo di Alexandre Dumas.', '1844-08-28', 1),
('979', '12345', '004004', '000017', 1, 'La Divina Commedia', 'Il poema epico di Dante Alighieri.', '1320-01-01', 1),
('979', '12345', '001001', '000018', 5, 'Frankenstein', 'Un classico della letteratura gotica.', '1818-01-01', 1),
('979', '12345', '002002', '000019', 8, 'Guerra e Pace', 'Un epico romanzo storico di Tolstoj.', '1869-01-01', 1),
('979', '12345', '003003', '000020', 7, 'Il Ritratto di Dorian Gray', 'Un classico di Oscar Wilde.', '1890-06-20', 1);

INSERT INTO GENERE_LIBRO (EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo, CodiceGenere, CodiceCategoria) VALUES
('978', '12345', '001001', '000001', 1, 1), -- Giallo
('978', '12345', '001001', '000002', 1, 1), -- Giallo
('978', '12345', '002002', '000003', 3, 1), -- Fantasy
('978', '12345', '003003', '000004', 4, 1), -- Horror
('978', '12345', '004004', '000005', 5, 1), -- Storico
('978', '12345', '001001', '000006', 2, 1), -- Rosa
('978', '12345', '002002', '000007', 3, 1), -- Fantasy
('978', '12345', '003003', '000008', 4, 1), -- Horror
('978', '12345', '004004', '000009', 6, 2), -- Politico
('978', '54321', '001001', '000010', 6, 2), -- Distopia (Storico come genere simile)
('979', '54321', '002002', '000011', 1, 1), -- Giallo
('978', '54321', '003003', '000012', 2, 1), -- Rosa
('978', '54321', '004004', '000013', 3, 1), -- Fantasy
('978', '54321', '001001', '000014', 2, 1), -- Storico
('978', '54321', '002002', '000015', 5, 1), -- Storico
('978', '54321', '003003', '000016', 5, 1), -- Storico
('979', '12345', '004004', '000017', 5, 1), -- Storico
('979', '12345', '001001', '000018', 4, 1), -- Horror
('979', '12345', '002002', '000019', 5, 1), -- Storico
('979', '12345', '003003', '000020', 2, 1); -- Rosa

INSERT INTO AUTORE (Codice, Nome, Cognome) VALUES
(1, 'Umberto', 'Eco'),
(2, 'Giorgio', 'Faletti'),
(3, 'J.K.', 'Rowling'),
(4, 'Bram', 'Stoker'),
(5, 'Ildefonso', 'Falcones'),
(6, 'Jane', 'Austen'),
(7, 'J.R.R.', 'Tolkien'),
(8, 'Stephen', 'King'),
(9, 'Yuval', 'Harari'),
(10, 'George', 'Orwell'),
(11, 'Dan', 'Brown'),
(12, 'Elena', 'Ferrante'),
(13, 'Antoine', 'de Saint-Exupéry'),
(14, 'Franz', 'Kafka'),
(15, 'Miguel', 'de Cervantes'),
(16, 'Alexandre', 'Dumas'),
(17, 'Dante', 'Alighieri'),
(18, 'Mary', 'Shelley'),
(19, 'Lev', 'Tolstoj'),
(20, 'Oscar', 'Wilde');

INSERT INTO AUTORI_LIBRO (EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo, CodiceAutore) VALUES
('978', '12345', '001001', '000001', 1), -- Il Nome della Rosa
('978', '12345', '001001', '000002', 2), -- Io Uccido
('978', '12345', '002002', '000003', 3), -- Harry Potter e la Pietra Filosofale
('978', '12345', '003003', '000004', 4), -- Dracula
('978', '12345', '004004', '000005', 5), -- La Cattedrale del Mare
('978', '12345', '001001', '000006', 6), -- Orgoglio e Pregiudizio
('978', '12345', '002002', '000007', 7), -- Il Signore degli Anelli
('978', '12345', '003003', '000008', 8), -- IT
('978', '12345', '004004', '000009', 9), -- Sapiens
('978', '54321', '001001', '000010', 10), -- 1984
('979', '54321', '002002', '000011', 11), -- Il Codice Da Vinci
('978', '54321', '003003', '000012', 12), -- L'Amica Geniale
('978', '54321', '004004', '000013', 13), -- Il Piccolo Principe
('978', '54321', '001001', '000014', 14), -- La Metamorfosi
('978', '54321', '002002', '000015', 15), -- Don Chisciotte
('978', '54321', '003003', '000016', 16), -- Il Conte di Montecristo
('979', '12345', '004004', '000017', 17), -- La Divina Commedia
('979', '12345', '001001', '000018', 18), -- Frankenstein
('979', '12345', '002002', '000019', 19), -- Guerra e Pace
('979', '12345', '003003', '000020', 20); -- Il Ritratto di Dorian Gray

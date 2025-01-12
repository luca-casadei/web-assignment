INSERT INTO `segnalibro_logic`.`CONDIZIONE` (`Codice`, `Nome`) VALUES ('1', 'Nuovo');
INSERT INTO `segnalibro_logic`.`CONDIZIONE` (`Codice`, `Nome`) VALUES ('2', 'Buono');
INSERT INTO `segnalibro_logic`.`CONDIZIONE` (`Codice`, `Nome`) VALUES ('3', 'Mediocre');
INSERT INTO `segnalibro_logic`.`CONDIZIONE` (`Codice`, `Nome`) VALUES ('4', 'Rovinato');
INSERT INTO `segnalibro_logic`.`CONDIZIONE` (`Codice`, `Nome`) VALUES ('5', 'Illeggibile');

INSERT INTO `segnalibro_logic`.`COPIA` (`EAN`, `CodiceRegGroup`, `CodiceEditoriale`, `CodiceTitolo`, `Numero`, `Prezzo`, `Titolo`, `Descrizione`, `DataAnnuncio`, `CodiceCondizione`) VALUES 
('978', '12345', '001001', '000001', '1', '5.99', 'Il nome della Rosa, ottime condizioni!', 'Vendita de \"Il nome della Rosa\" in ottime condizioni, usato a basso prezzo!', '2024-12-31', '2'),
('978', '12345', '001001', '000002', '1', '10.99', 'Io Uccido messo così così', 'Vendita de \"Io Uccido\", non è messo troppo male dai, prendetelo vi prego.', '2025-01-09', '3');

INSERT INTO `segnalibro_logic`.`IMMAGINE` (`Numero`, `Percorso`, `NumeroCopia`, `EAN`, `CodiceRegGroup`, `CodiceEditoriale`, `CodiceTitolo`) VALUES 
('2','978-12345-001001-000001-1-2.jpg', '1', '978', '12345', '001001', '000001'),
('1','978-12345-001001-000001-1-1.jpg', '1', '978', '12345', '001001', '000001'),
('3','978-12345-001001-000002-1-1.jpg', '1', '978', '12345', '001001', '000002');
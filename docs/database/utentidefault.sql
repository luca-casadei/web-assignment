-- Password: brucomela, PASSWORD_HASH COST: 13 --
INSERT INTO ACCOUNT(Email, Password, Nome, Cognome) VALUES
('admin@segnalibro.it', '$2y$13$mFNzBTDpp7wIF2Z2eSTO8ecx0UlOe1.HlPIDxmTZ0ZmN3uU4XJ4nS', 'Venditore', 'Venditore'),
('casadeiluca30@gmail.com', '$2y$13$mFNzBTDpp7wIF2Z2eSTO8ecx0UlOe1.HlPIDxmTZ0ZmN3uU4XJ4nS', 'Luca', 'Casadei');

INSERT INTO VENDITORE(UniqueUserID) VALUES (1);
INSERT INTO UTENTE(UniqueUserID) VALUES(2);
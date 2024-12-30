-- Password: brucomela, PASSWORD_HASH COST: 13 --
INSERT INTO ACCOUNT(Email, Password, Nome, Cognome) VALUES
('admin@segnalibro.it', '$2y$13$VP9JesbUOwXXY1L6Ug6wk.DV.1EmY3JnqAPQmMSmulX11RBfdnIpK', 'Venditore', 'Venditore'),
('casadeiluca30@gmail.com', '$2y$13$VP9JesbUOwXXY1L6Ug6wk.DV.1EmY3JnqAPQmMSmulX11RBfdnIpK', 'Luca', 'Casadei');

INSERT INTO VENDITORE(UniqueUserID) VALUES (1);
INSERT INTO UTENTE(UniqueUserID) VALUES(2);
create database segnalibro_logic;
use segnalibro_logic;

create table ACCOUNT (
     UniqueUserID int not null auto_increment,
     Email varchar(100) not null UNIQUE,
     Password varchar(256) not null,
     Nome varchar(50) not null,
     Cognome varchar(50) not null,
     constraint IDACCOUNT primary key (UniqueUserID));

create table AUTORE (
     Codice int not null auto_increment,
     Nome VARCHAR(50) not null,
     Cognome VARCHAR(50) not null,
     constraint IDAUTORE primary key (Codice));

create table AUTORI_LIBRO (
     EAN char(3) not null,
     CodiceRegGroup char(5) not null,
     CodiceEditoriale char(6) not null,
     CodiceTitolo char(6) not null,
     CodiceAutore int not null,
     constraint IDAUTORI_LIBRO primary key (EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo, CodiceAutore));

create table CARRELLO (
     NumeroCopia int not null,
     EAN char(3) not null,
     CodiceRegGroup char(5) not null,
     CodiceEditoriale char(6) not null,
     CodiceTitolo char(6) not null,
     UniqueUserID int not null,
     constraint IDCARRELLO primary key (NumeroCopia, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo, UniqueUserID));

create table CATEGORIA (
     Codice int not null auto_increment,
     Nome varchar(20) not null,
     constraint IDCATEGORIA primary key (Codice));

create table CONDIZIONE (
     Codice int not null auto_increment,
     Nome varchar(20) not null,
     constraint IDCONDIZIONE primary key (Codice));

create table COPIA (
     EAN char(3) not null,
     CodiceRegGroup char(5) not null,
     CodiceEditoriale char(6) not null,
     CodiceTitolo char(6) not null,
     Numero int not null auto_increment,
     Prezzo decimal(10,2) not null,
     Titolo VARCHAR(100) not null,
     Descrizione varchar(1000) not null,
     DataAnnuncio date not null,
     CodiceCondizione int not null,
     constraint IDCOPIA primary key (Numero, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo));

create table COPIE_ORDINE (
     NumeroCopia int not null,
     EAN char(3) not null,
     CodiceRegGroup char(5) not null,
     CodiceEditoriale char(6) not null,
     CodiceTitolo char(6) not null,
     CodiceOrdine int not null,
     constraint IDCOPIE_ORDINE primary key (NumeroCopia, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo));

create table EDITORE (
     CodiceEditoriale char(6) not null,
     Nome varchar(30) not null,
     constraint IDEDITORE primary key (CodiceEditoriale));

create table GENERE (
     CodiceCategoria int not null,
     Codice int not null auto_increment,
     Nome varchar(20) not null,
     Descrizione varchar(100),
     constraint IDGENERE primary key (Codice, CodiceCategoria));

create table GENERE_LIBRO (
     EAN char(3) not null,
     CodiceRegGroup char(5) not null,
     CodiceEditoriale char(6) not null,
     CodiceTitolo char(6) not null,
     CodiceGenere int not null,
     CodiceCategoria int not null,
     constraint IDGENERE_LIBRO primary key (CodiceGenere, CodiceCategoria, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo));

create table GS1 (
     EAN char(3) not null,
     constraint IDGS1 primary key (EAN));

create table IMMAGINE (
     Numero int not null auto_increment,
     Percorso varchar(255) not null,
     NumeroCopia int not null,
     EAN char(3) not null,
     CodiceRegGroup char(5) not null,
     CodiceEditoriale char(6) not null,
     CodiceTitolo char(6) not null,
     constraint IDIMMAGINE primary key (Numero, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo, NumeroCopia));

create table INDIRIZZO (
     UniqueUserID int not null,
     Via varchar(100) not null,
     Civico varchar(10) not null,
     CAP char(5) not null,
     Citta varchar(50) not null,
     CodiceProvincia char(2) not null,
     constraint FKFatturazione_ID primary key (UniqueUserID));

create table LIBRO (
     CodiceEditoriale char(6) not null,
     CodiceRegGroup char(5) not null,
     EAN char(3) not null,
     CodiceTitolo char(6) not null,
     CifraControllo int not null,
     Titolo varchar(50) not null,
     Descrizione varchar(500) not null,
     DataPubblicazione date not null,
     Edizione int,
     constraint ISBN_ID primary key (EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo));

create table NOTIFICA (
     UniqueUserID int not null,
     Numero int not null auto_increment,
     Titolo varchar(50) not null,
     Testo varchar(1000) not null,
     CodiceOrdine int,
     constraint IDNOTIFICA primary key (Numero, UniqueUserID));

create table ORDINE (
     Codice int not null auto_increment,
     DataOrdine date not null,
     Stato varchar(500) not null,
     UniqueUserID int not null,
     constraint IDORDINE primary key (Codice));

create table PROVINCIA (
     Codice char(2) not null,
     Nome varchar(30) not null,
     constraint IDPROVINCIA primary key (Codice));

create table REGGROUP (
     Codice char(5) not null,
     Nome varchar(30) not null,
     constraint IDREGGROUP primary key (Codice));

create table UTENTE (
     UniqueUserID int not null,
     constraint FKAccUtente_ID primary key (UniqueUserID));

create table VENDITORE (
     UniqueUserID int not null,
     constraint FKAccVenditore_ID primary key (UniqueUserID));

alter table AUTORI_LIBRO add constraint FKScr_AUT
     foreign key (CodiceAutore)
     references AUTORE (Codice)
     ON DELETE CASCADE;

alter table AUTORI_LIBRO add constraint FKScr_LIB
     foreign key (EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo)
     references LIBRO (EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo)
     ON DELETE CASCADE;

alter table CARRELLO add constraint FKCAR_UTE
     foreign key (UniqueUserID)
     references UTENTE (UniqueUserID)
     ON DELETE CASCADE;

alter table CARRELLO add constraint FKCAR_COP
     foreign key (NumeroCopia, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo)
     references COPIA (Numero, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo)
     ON DELETE CASCADE;

alter table COPIA add constraint FKCondizioneCopia
     foreign key (CodiceCondizione)
     references CONDIZIONE (Codice)
     ON DELETE RESTRICT;

alter table COPIA add constraint FKCpLibro
     foreign key (EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo)
     references LIBRO (EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo)
     ON DELETE CASCADE;

alter table COPIE_ORDINE add constraint FKCOP_ORD
     foreign key (CodiceOrdine)
     references ORDINE (Codice)
     ON DELETE CASCADE;

alter table COPIE_ORDINE add constraint FKCOP_COP
     foreign key (NumeroCopia, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo)
     references COPIA (Numero, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo)
     ON DELETE RESTRICT;

alter table GENERE add constraint FKCategorizzazione
     foreign key (CodiceCategoria)
     references CATEGORIA (Codice)
     ON DELETE RESTRICT;

alter table GENERE_LIBRO add constraint FKGEN_GEN
     foreign key (CodiceGenere, CodiceCategoria)
     references GENERE (Codice, CodiceCategoria)
     ON DELETE CASCADE;

alter table GENERE_LIBRO add constraint FKGEN_LIB
     foreign key (EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo)
     references LIBRO (EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo)
     ON DELETE CASCADE;

alter table IMMAGINE add constraint FKPresentazione
     foreign key (NumeroCopia, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo)
     references COPIA (Numero, EAN, CodiceRegGroup, CodiceEditoriale, CodiceTitolo)
     ON DELETE CASCADE;

alter table INDIRIZZO add constraint FKProv
     foreign key (CodiceProvincia)
     references PROVINCIA (Codice)
     ON DELETE RESTRICT;

alter table INDIRIZZO add constraint FKFatturazione_FK
     foreign key (UniqueUserID)
     references UTENTE (UniqueUserID)
     ON DELETE CASCADE;

alter table LIBRO add constraint FKAssEan
     foreign key (EAN)
     references GS1 (EAN)
     ON DELETE RESTRICT;

alter table LIBRO add constraint FKAssRegGroup
     foreign key (CodiceRegGroup)
     references REGGROUP (Codice)
     ON DELETE RESTRICT;

alter table LIBRO add constraint FKAssEditore
     foreign key (CodiceEditoriale)
     references EDITORE (CodiceEditoriale)
     ON DELETE RESTRICT;

alter table NOTIFICA add constraint FKNotificaOrdine
     foreign key (CodiceOrdine)
     references ORDINE (Codice)
     ON DELETE CASCADE;

alter table NOTIFICA add constraint FKNotificazione
     foreign key (UniqueUserID)
     references ACCOUNT (UniqueUserID)
     ON DELETE CASCADE;

alter table ORDINE add constraint FKOrdineUtente
     foreign key (UniqueUserID)
     references UTENTE (UniqueUserID)
     ON DELETE RESTRICT;

alter table UTENTE add constraint FKAccUtente_FK
     foreign key (UniqueUserID)
     references ACCOUNT (UniqueUserID)
     ON DELETE CASCADE;

alter table VENDITORE add constraint FKAccVenditore_FK
     foreign key (UniqueUserID)
     references ACCOUNT (UniqueUserID)
     ON DELETE CASCADE;
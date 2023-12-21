DROP TABLE IF EXISTS InscriptionEcole;
DROP TABLE IF EXISTS MangerCantine;
DROP TABLE IF EXISTS ProposerServices;

DROP TABLE IF EXISTS Unions;
DROP TABLE IF EXISTS DemandesUnionCivile;
DROP TABLE IF EXISTS DemandesEtatCivil;
DROP TABLE IF EXISTS DemandesElection;
DROP TABLE IF EXISTS DemandesRestaurationScolaire;
DROP TABLE IF EXISTS DemandesScolaire;
DROP TABLE IF EXISTS DemandesSignalement;

DROP TABLE IF EXISTS Ecoles;
DROP TABLE IF EXISTS Cantines;
DROP TABLE IF EXISTS Lieux;

DROP TABLE IF EXISTS Communes;
DROP TABLE IF EXISTS Départements;
DROP TABLE IF EXISTS Régions;

DROP TABLE IF EXISTS Justificatifs;
DROP TABLE IF EXISTS HistoriqueDemandes;
DROP TABLE IF EXISTS Demandes;

DROP TABLE IF EXISTS Périodes;
DROP TABLE IF EXISTS Citoyens;
DROP TABLE IF EXISTS Enfants;
DROP TABLE IF EXISTS Services;

CREATE TABLE Périodes(
   dateDeb DATE,
   dateFin DATE,
   PRIMARY KEY(dateDeb, dateFin)
);

CREATE TABLE Citoyens(
   nomCit VARCHAR(50),
   prénomCit VARCHAR(50),
   email VARCHAR(50),
   adresseCit VARCHAR(50),
   dateNaissance DATE,
   téléphoneCit VARCHAR(50),
   PRIMARY KEY(nomCit, prénomCit)
);

CREATE TABLE Enfants(
   idE INT AUTO_INCREMENT,
   nomE VARCHAR(50) NOT NULL,
   prénomE VARCHAR(50) NOT NULL,
   PRIMARY KEY(idE)
);

CREATE TABLE Régions(
   codeInseeR VARCHAR(11),
   nomR VARCHAR(50),
   PRIMARY KEY(codeInseeR)
);

CREATE TABLE Départements(
   codeInseeD VARCHAR(11),
   nomD VARCHAR(50),
   codeInseeR VARCHAR(11) NOT NULL,
   PRIMARY KEY(codeInseeD),
   FOREIGN KEY(codeInseeR) REFERENCES Régions(codeInseeR)
);

CREATE TABLE Communes(
   idC INT AUTO_INCREMENT,
   codeInseeCom VARCHAR(18),
   codePostal INT NOT NULL,
   nomCom VARCHAR(50),
   longCom DOUBLE,
   latCom DOUBLE,
   adresseMairie TEXT,
   codeInseeD VARCHAR(18) NOT NULL,
   PRIMARY KEY(idC),
   FOREIGN KEY(codeInseeD) REFERENCES Départements(codeInseeD)
);

CREATE TABLE Lieux(
   idL INT AUTO_INCREMENT,
   nomL VARCHAR(50),
   typeL VARCHAR(50),
   longL VARCHAR(50),
   latL VARCHAR(50),
   PRIMARY KEY(idL, nomL)
);

CREATE TABLE Ecoles(
   idL INT,
   nomL VARCHAR(50),
   adresseEcole VARCHAR(50) NOT NULL,
   nbClasses INT,
   PRIMARY KEY(idL, nomL),
   FOREIGN KEY(idL, nomL) REFERENCES Lieux(idL, nomL)
);

CREATE TABLE Cantines(
   nomCant VARCHAR(50),
   adresseCant VARCHAR(50),
   nbplaces INT,
   nbservices INT,
   longCant VARCHAR(50),
   latCant VARCHAR(50),
   idL INT NOT NULL,
   nomL VARCHAR(50) NOT NULL,
   PRIMARY KEY(nomCant),
   UNIQUE(idL),
   UNIQUE(nomL),
   FOREIGN KEY(idL, nomL) REFERENCES Lieux(idL, nomL)
);

CREATE TABLE Services(
   libellé VARCHAR(50),
   payant_ BOOLEAN,
   descS VARCHAR(100),
   PRIMARY KEY(libellé)
);

CREATE TABLE Demandes(
   idDem INT AUTO_INCREMENT,
   dateDem DATE,
   message TEXT,
   libellé VARCHAR(50) NOT NULL,
   PRIMARY KEY(idDem),
   FOREIGN KEY(libellé) REFERENCES Services(libellé)
);

CREATE TABLE Justificatifs(
   idDem INT,
   numJ INT,
   typeJ VARCHAR(50),
   descJ TEXT,
   cheminFichier VARCHAR(50),
   PRIMARY KEY(idDem, numJ),
   FOREIGN KEY(idDem) REFERENCES Demandes(idDem)
);

CREATE TABLE DemandesUnionCivile(
   typeU VARCHAR(50),
   dateU DATE NOT NULL,
   idDem INT NOT NULL,
   PRIMARY KEY(typeU),
   UNIQUE(idDem),
   FOREIGN KEY(idDem) REFERENCES Demandes(idDem)
);

CREATE TABLE DemandesEtatCivil(
   idDem INT NOT NULL,
   typedoc VARCHAR(50),
   dateEC DATE,
   PRIMARY KEY(idDem),
   FOREIGN KEY(idDem) REFERENCES Demandes(idDem)
);

CREATE TABLE DemandesElection(
   idDem INT NOT NULL,
   bureaudevote VARCHAR(50),
   PRIMARY KEY(idDem),
   FOREIGN KEY(idDem) REFERENCES Demandes(idDem)
);

CREATE TABLE DemandesScolaire(
   idDem INT NOT NULL,
   nomS VARCHAR(50),
   téléphoneS INT,
   idE INT NOT NULL,
   PRIMARY KEY(idDem),
   FOREIGN KEY(idDem) REFERENCES Demandes(idDem),
   FOREIGN KEY(idE) REFERENCES Enfants(idE)
);

CREATE TABLE DemandesRestaurationScolaire(
   idDem INT NOT NULL,
   quotientfamilial DOUBLE,
   cantinesouhaitée VARCHAR(50),
   nomCant VARCHAR(50) NOT NULL,
   PRIMARY KEY(idDem),
   FOREIGN KEY(idDem) REFERENCES DemandesScolaire(idDem),
   FOREIGN KEY(nomCant) REFERENCES Cantines(nomCant)
);

CREATE TABLE DemandesSignalement(
   idDem INT NOT NULL,
   typeS VARCHAR(50),
   idL INT NOT NULL,
   nomL VARCHAR(50) NOT NULL,
   PRIMARY KEY(idDem),
   FOREIGN KEY(idDem) REFERENCES Demandes(idDem),
   FOREIGN KEY(idL, nomL) REFERENCES Lieux(idL, nomL)
);

CREATE TABLE ProposerServices(
   idC INT,
   libellé VARCHAR(50),
   dateDeb DATE,
   dateFin DATE,
   PRIMARY KEY(idC, libellé, dateDeb, dateFin),
   FOREIGN KEY(idC) REFERENCES Communes(idC),
   FOREIGN KEY(libellé) REFERENCES Services(libellé),
   FOREIGN KEY(dateDeb, dateFin) REFERENCES Périodes(dateDeb, dateFin)
);

CREATE TABLE HistoriqueDemandes(
   idDem INT,
   nomCit VARCHAR(50),
   prénomCit VARCHAR(50),
   PRIMARY KEY(idDem),
   FOREIGN KEY(idDem) REFERENCES Demandes(idDem),
   FOREIGN KEY(nomCit, prénomCit) REFERENCES Citoyens(nomCit, prénomCit)
);

CREATE TABLE MangerCantine(
   nomCant VARCHAR(50),
   idE INT,	
   dateDeb DATE,
   dateFin DATE,
   nbJourAbsence INT,
   PRIMARY KEY(nomCant, idE, dateDeb, dateFin),
   FOREIGN KEY(nomCant) REFERENCES Cantines(nomCant),
   FOREIGN KEY(idE) REFERENCES Enfants(idE),
   FOREIGN KEY(dateDeb, dateFin) REFERENCES Périodes(dateDeb, dateFin)
);

CREATE TABLE InscriptionEcole(
   idE INT,
   classe VARCHAR(50),
   premiereInscript_ BOOLEAN,
   idL INT NOT NULL,
   nomL VARCHAR(50) NOT NULL,
   dateDeb DATE NOT NULL,
   dateFin DATE NOT NULL,
   PRIMARY KEY(idE, idL, dateDeb, dateFin),
   FOREIGN KEY(idE) REFERENCES Enfants(idE),
   FOREIGN KEY(idL, nomL) REFERENCES Ecoles(idL, nomL),
   FOREIGN KEY(dateDeb, dateFin) REFERENCES Périodes(dateDeb, dateFin)
);

CREATE TABLE Unions(
   typeU VARCHAR(50),
   nomCit1 VARCHAR(50),
   prénomCit1 VARCHAR(50),
   nomCit2 VARCHAR(50),
   prénomCit2 VARCHAR(50),
   idC INT,
   PRIMARY KEY(typeU, nomCit1, prénomCit1, nomCit2, prénomCit2),
   FOREIGN KEY(nomCit1, prénomCit1) REFERENCES Citoyens(nomCit, prénomCit),
   FOREIGN KEY(nomCit2, prénomCit2) REFERENCES Citoyens(nomCit, prénomCit),
   FOREIGN KEY(idC) REFERENCES Communes(idC)
);

INSERT INTO `Lieux` (`idL`, `nomL`, `typeL`, `longL`, `latL`) VALUES ('0', 'Collège Anne Clair', 'École', '13', '16.2');
INSERT INTO `Lieux` (`idL`, `nomL`, `typeL`, `longL`, `latL`) VALUES ('1', 'Maternelle Apanyan', 'École', '19', '26');
INSERT INTO `Lieux` (`idL`, `nomL`, `typeL`, `longL`, `latL`) VALUES ('2', 'Cantine Scolaire Apanyan', 'Cantine', '19', '26'); 

INSERT INTO `Ecoles` (`idL`, `nomL`, `adresseEcole`, `nbClasses`) VALUES ('0', 'Collège Anne Clair', '13 Avenue Gérard Mano', '15');
INSERT INTO `Ecoles` (`idL`, `nomL`, `adresseEcole`, `nbClasses`) VALUES ('1', 'Maternelle Apanyan', '256 Rue Quoi-coubeh', '3'); 

INSERT INTO `Cantines` (`nomCant`, `adresseCant`, `nbplaces`, `nbservices`, `longCant`, `latCant`, `idL`, `nomL`) VALUES ('Cantine Scolaire Apanyan', '256 Rue Quoi-coubeh', '500', '3', '16', '26', '2', 'Cantine Scolaire Apanyan');


INSERT INTO `Enfants` (`idE`, `nomE`, `prénomE`) VALUES (NULL, 'Pantaleon', 'Diane');
INSERT INTO `Enfants` (`idE`, `nomE`, `prénomE`) VALUES (NULL, 'Dupont', 'Calimero');
INSERT INTO `Enfants` (`idE`, `nomE`, `prénomE`) VALUES (NULL, 'Pantaleon', 'Diane');
INSERT INTO `Enfants` (`idE`, `nomE`, `prénomE`) VALUES (NULL, 'Dior', 'Christian');

INSERT INTO `Périodes` (`dateDeb`, `dateFin`) VALUES ('2023-09-01', '2024-05-31'); 
-- Période scolaire 2023-2024
INSERT INTO `Périodes` (`dateDeb`, `dateFin`) VALUES ('2023-09-04', '2024-06-30'); 

INSERT INTO `MangerCantine` (`nomCant`, `idE`, `dateDeb`, `dateFin`, `nbJourAbsence`) VALUES ('Cantine Scolaire Apanyan', '4', '2023-09-04', '2024-06-30', NULL); 

INSERT INTO `InscriptionEcole` (`idE`, `classe`, `premiereInscript_`, `idL`, `nomL`, `dateDeb`, `dateFin`) VALUES ('1', '4C', '1', '0', 'Collège Anne Clair', '2023-09-01', '2024-05-31');
INSERT INTO `InscriptionEcole` (`idE`, `classe`, `premiereInscript_`, `idL`, `nomL`, `dateDeb`, `dateFin`) VALUES ('3', 'petiteA', '1', '1', 'Maternelle Apanyan', '2023-09-01', '2024-05-31');
INSERT INTO `InscriptionEcole` (`idE`, `classe`, `premiereInscript_`, `idL`, `nomL`, `dateDeb`, `dateFin`) VALUES ('4', 'moyenneA', '0', '1', 'Maternelle Apanyan', '2023-09-01', '2024-05-31'); 

INSERT INTO `Régions` (`codeInseeR`, `nomR`) VALUES ('84', 'Auverge-Rhône-Alpes'); 

INSERT INTO p2200355.Départements SELECT DISTINCT c.code_departement, c.nom_departement, c.code_region FROM dataset.Communes c WHERE c.code_region = 84;	

INSERT INTO p2200355.Communes SELECT DISTINCT NULL, c.code_commune_INSEE, c.code_postal, c.nom_commune_complet, c.longitude, c.latitude, NULL, c.code_departement FROM dataset.Communes c WHERE c.code_region = 84;

INSERT INTO `Services` (`libellé`, `payant_`, `descS`) VALUES ('Élections', '0', 'Gestion de l\'organisation des élections dans votre ville');
INSERT INTO `Services` (`libellé`, `payant_`, `descS`) VALUES ('Etat Civil', '0', 'Gestion des demandes relatives à l\'état civil de vos citoyens');
INSERT INTO `Services` (`libellé`, `payant_`, `descS`) VALUES ('Restauration scolaire', '1', 'Gestion des restaurants scolaires de votre ville');
INSERT INTO `Services` (`libellé`, `payant_`, `descS`) VALUES ('Scolaire', '0', 'Gestion des inscriptions scolaires des différents écoles de votre ville');
INSERT INTO `Services` (`libellé`, `payant_`, `descS`) VALUES ('Signalements', '1', 'Gestion des signalements citoyens de votre ville');
INSERT INTO `Services` (`libellé`, `payant_`, `descS`) VALUES ('Union civils', '1', 'Gestion des unions civils entre les citoyens de votre ville');

INSERT INTO `Citoyens` (`nomCit`, `prénomCit`, `email`, `adresseCit`, `dateNaissance`, `téléphoneCit`) VALUES ('Amalla', 'Enora', 'amallaenora@mail.mail', 'Chez elle', '2005-02-01', 'Tél');
INSERT INTO `Citoyens` (`nomCit`, `prénomCit`, `email`, `adresseCit`, `dateNaissance`, `téléphoneCit`) VALUES ('Pantaleon', 'Jean', 'pantaleonjean@mail.mail', 'Chez lui', '2004-12-31', 'tél2');
INSERT INTO `Citoyens` (`nomCit`, `prénomCit`, `email`, `adresseCit`, `dateNaissance`, `téléphoneCit`) VALUES ('Teluob', 'Sarah', 'teluobsarah@mail.mail', 'chez elle bis', '2004-03-15', 'le sien');
INSERT INTO `Citoyens` (`nomCit`, `prénomCit`, `email`, `adresseCit`, `dateNaissance`, `téléphoneCit`) VALUES ('Furlanetto', 'Camille', 'furlanettocamille@mail.mail', 'chez lui ter', '2004-10-01', 'son num'); 

INSERT INTO `Demandes` (`idDem`, `dateDem`, `message`, `libellé`) VALUES ('0', '2023-12-06', 'J\'aimerai m\'unir', 'Union civils'); 
INSERT INTO `DemandesUnionCivile` (`typeU`, `dateU`, `idDem`) VALUES ('pacs', '2023-12-08', '1'); 


INSERT INTO `Unions` VALUES ('pacs','Amalla', 'Enora', 'Pantaleon', 'Jean', 250);
INSERT INTO `Unions` VALUES ('mariage','Teluob', 'Sarah', 'Furlanetto', 'Camille', 3558);

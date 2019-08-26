
CREATE DATABASE IF NOT EXISTS bdBudgetManagement ;
USE bdBudgetManagement;
CREATE TABLE IF NOT EXISTS categorie 
(
 codeCat  INT NOT NULL AUTO_INCREMENT ,
 intituleCat VARCHAR(75) NOT NULL,
 isDelete BOOLEAN DEFAULT FALSE,
 CONSTRAINT pk_categorie PRIMARY KEY(codecat)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS agence 
(
 codeAg  VARCHAR(30) NOT NULL,
 nomAg VARCHAR(60) NOT NULL,
 RegionAg VARCHAR (30),
 typeAg VARCHAR(60),
 isDelete BOOLEAN DEFAULT FALSE,
 CONSTRAINT pk_agence PRIMARY KEY(codeAg)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS exercice
(
 codeExercice  VARCHAR(30) NOT NULL,
 AnneeExecice YEAR NOT NULL,
 dateDebut DATE NOT NULL,
 dateFin DATE NOT NULL,
 statusExo VARCHAR(15),
 agence VARCHAR(30) NOT NULL,
 isDelete BOOLEAN DEFAULT FALSE,
 CONSTRAINT pk_exercice PRIMARY KEY(codeExercice),
 CONSTRAINT fk_agence FOREIGN KEY(agence) REFERENCES agence(codeAg)  
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS prevision
(
 idPrevision  VARCHAR(30) NOT NULL,
 observationPrevi TEXT,
 montantPrevision DOUBLE NOT NULL,
 codePostBudgetaire VARCHAR(80) NOT NULL,
 exercicePrevi VARCHAR(60) NOT NULL,
 isDelete BOOLEAN DEFAULT FALSE,
 CONSTRAINT pk_prevision PRIMARY KEY(idprevision),
 CONSTRAINT fk_exercice FOREIGN KEY(exerciceprevi) REFERENCES exercice(codeExercice),
  CONSTRAINT fk_postbudgetaire_prevision FOREIGN KEY(codePostBudgetaire) REFERENCES postbudgetaire(numCompte)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS postBusgetaire
(
 numCompte  VARCHAR(30) NOT NULL,
 intitulePost VARCHAR(60) NOT NULL,
 montantPrevision DOUBLE NOT NULL,
 sensPost VARCHAR(60) NOT NULL,
 categorie INT NOT NULL,
 isDelete BOOLEAN DEFAULT FALSE,
 CONSTRAINT pk_postBdgetaire PRIMARY KEY(numCompte),
 CONSTRAINT fk_categorieBudget FOREIGN KEY(categorie) REFERENCES categorie(codeCat)  
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS realisation
(
 refferenceRea  VARCHAR(30) NOT NULL,
 montantRea DOUBLE NOT NULL,
 dateRea DATE NOT NULL,
 observationRea TEXT,
 prevision VARCHAR(60) NOT NULL,
 isDelete BOOLEAN DEFAULT FALSE,
 CONSTRAINT pk_realisation PRIMARY KEY(refferenceRea),
 CONSTRAINT fk_prevision FOREIGN KEY(prevision) REFERENCES prevision(idPrevision)
   
)ENGINE=INNODB;



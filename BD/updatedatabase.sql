CREATE TABLE fonction 
(
codeFon INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
intituleFon VARCHAR(70) NOT NULL,
dateCreat DATE DEFAULT "2001/01/01"
)ENGINE=INNODB;

CREATE TABLE employe 
(
matriculeEmp VARCHAR(60) NOT NULL,
nomEmp VARCHAR(70) NOT NULL,
prenom VARCHAR(70),
telephone VARCHAR(89),
mail VARCHAR(50),
fonctionID  INT NOT NULL, 
CONSTRAINT pk_employe PRIMARY KEY(matriculeEmp),
CONSTRAINT fk_fontion_employe FOREIGN KEY(fonctionID) REFERENCES fonction(codeFon)
)ENGINE=INNODB;


ALTER TABLE realisation ADD autorise_par VARCHAR(60) NOT NULL;

ALTER TABLE realisation ADD CONSTRAINT fk_employe_autorise_realisation FOREIGN KEY(autorise_par) REFERENCES employe(matriculeEmp);


CREATE TABLE groupe
(
id_groupe INT NOT NULL AUTO_INCREMENT,
nom VARCHAR(78) NOT NULL,
CONSTRAINT pk_groupe PRIMARY KEY(id_groupe)
)ENGINE=INNODB;
  
  
CREATE TABLE users
(
user_id VARCHAR(60) NOT NULL,
login VARCHAR(70) NOT NULL,
userspass VARCHAR(70),
question VARCHAR(89),
reponse VARCHAR(50),
groupe_id  INT NOT NULL, 
isDelete INT NOT NULL,
CONSTRAINT pk_users PRIMARY KEY(user_id),
CONSTRAINT fk_users_group_id FOREIGN KEY(groupe_id) REFERENCES groupe(id_groupe)
)ENGINE=INNODB;

CREATE TABLE element
(
id_element INT NOT NULL AUTO_INCREMENT,
nom VARCHAR(78) NOT NULL,
isDelete INT NOT NULL,
CONSTRAINT pk_element PRIMARY KEY(id_element)
)ENGINE=INNODB;

CREATE TABLE permission
(
id_permission INT NOT NULL AUTO_INCREMENT,
libelle VARCHAR(78) NOT NULL,
element_id INT NOT NULL,
isDelete INT NOT NULL,
CONSTRAINT pk_permission PRIMARY KEY(id_permission),
CONSTRAINT fk_element_permission_id FOREIGN KEY(element_id) REFERENCES element(id_element)
)ENGINE=INNODB;

CREATE TABLE groupe_avoir_permission
(
id INT NOT NULL AUTO_INCREMENT,
groupe_id INT NOT NULL,
permission_id INT NOT NULL,
isDelete INT NOT NULL,
CONSTRAINT pk_avoir_perssion PRIMARY KEY(id),
CONSTRAINT fk_avoir_group_id FOREIGN KEY(groupe_id) REFERENCES groupe(id_groupe),
CONSTRAINT fk_avoir_permission_id FOREIGN KEY(permission_id) REFERENCES permission(id_permission)
)ENGINE=INNODB;
 
 ALTER TABLE users ADD users_name VARCHAR(70) NOT NULL; 
  ALTER TABLE users ADD  users_surname VARCHAR(70) NOT NULL; 
 
ALTER TABLE realisation ADD CONSTRAINT fk_realisa_employe_id FOREIGN KEY(effectuer_par) REFERENCES employe(matriculeEmp);
ALTER TABLE realisation ADD CONSTRAINT fk_autorite_employe_id FOREIGN KEY(autorise_par) REFERENCES employe(matriculeEmp);
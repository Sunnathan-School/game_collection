CREATE TABLE CLIENT(
   Id_client INT AUTO_INCREMENT,
   prenom_client VARCHAR(50) NOT NULL,
   email_client VARCHAR(50) NOT NULL,
   mdp_client VARCHAR(50) NOT NULL,
   nom_client VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_client)
);

CREATE TABLE JEUX(
   Id_jeux INT AUTO_INCREMENT,
   nom_jeux VARCHAR(50) NOT NULL,
   description_jeux VARCHAR(50),
   editeur_jeux VARCHAR(50) NOT NULL,
   date_sortie_jeux DATE NOT NULL,
   plateforme_jeux VARCHAR(50),
   couverture_url_jeux VARCHAR(50),
   _site_url_jeux VARCHAR(50),
   PRIMARY KEY(Id_jeux),
   UNIQUE(nom_jeux)
);

CREATE TABLE PLATEFORME(
   Id_plateforme INT AUTO_INCREMENT,
   nom_plateforme VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_plateforme)
);

CREATE TABLE collectionner(
   Id_client INT,
   Id_jeux INT,
   heures_jouees_collection INT NOT NULL,
   date_ajout_collection DATE NOT NULL,
   PRIMARY KEY(Id_client, Id_jeux),
   FOREIGN KEY(Id_client) REFERENCES CLIENT(Id_client),
   FOREIGN KEY(Id_jeux) REFERENCES JEUX(Id_jeux)
);

CREATE TABLE appartenir(
   Id_jeux INT,
   Id_plateforme INT,
   Num_odre_plateforme INT NOT NULL,
   PRIMARY KEY(Id_jeux, Id_plateforme),
   FOREIGN KEY(Id_jeux) REFERENCES JEUX(Id_jeux),
   FOREIGN KEY(Id_plateforme) REFERENCES PLATEFORME(Id_plateforme)
);

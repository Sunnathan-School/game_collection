-- Partie création de tables --

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



-- Partie jeux de données --


INSERT INTO CLIENT (prenom_client, email_client, mdp_client, nom_client) VALUES
('Alex', 'alex@example.com', 'password123', 'Durand'),
('Mila', 'mila@example.com', 'password456', 'Dupont'),
('Lucas', 'lucas@example.com', 'password789', 'Martin');


INSERT INTO JEUX (nom_jeux, description_jeux, editeur_jeux, date_sortie_jeux, couverture_url_jeux, _site_url_jeux) VALUES
('The Witcher 3: Wild Hunt', 'An open-world RPG set in a gritty fantasy universe', 'CD Projekt', '2015-05-18',  'https://th.bing.com/th/id/OIP.ESLUrniRRUtzAk-LMGNjAAAAAA?rs=1&pid=ImgDetMain', 'https://thewitcher.com'),
('Red Dead Redemption 2', 'An epic tale of life in America at the dawn of the modern age', 'Rockstar Games', '2018-10-26', 'https://th.bing.com/th/id/OIP.ecoMHvpEDcaJGEHooAQE4QAAAA?rs=1&pid=ImgDetMain', 'https://www.rockstargames.com/reddeadredemption2/'),
('Super Mario Odyssey', 'Mario embarks on a new journey through unknown worlds', 'Nintendo', '2017-10-27',  'https://th.bing.com/th/id/R.fd3644a9d9258f4cea239d99df14af48?rik=p3dc0OPX9KLzKw&riu=http%3a%2f%2fimages.nintendolife.com%2fnews%2f2017%2f10%2fsuper_mario_odyssey_has_already_cleared_2_million_sales%2fattachment%2f0%2foriginal.jpg&ehk=cABXnhtGW9LOLL%2bYXYbVZJ31MZQ5%2bYH%2f5%2fpuNtvCh5w%3d&risl=&pid=ImgRaw&r=0', 'https://www.nintendo.com/games/detail/super-mario-odyssey-switch/'),
('Halo Infinite', 'The next chapter of the legendary Halo series', '343 Industries', '2021-12-08',  'https://th.bing.com/th/id/R.b88688beade9d2a55595c44a94d4051d?rik=qNwmqZp8c4mgUg&pid=ImgRaw&r=0', 'https://www.halowaypoint.com/en-us/games/halo-infinite'),
('Cyberpunk 2077', 'An open-world, action-adventure story set in Night City', 'CD Projekt', '2020-12-10',  'https://th.bing.com/th/id/R.e70e98eee8f8f2eb33ca0ac0e7469e0a?rik=dlIDk%2bs642X81Q&pid=ImgRaw&r=0', 'https://www.cyberpunk.net');



INSERT INTO PLATEFORME (nom_plateforme) VALUES
('PC'),
('Nintendo'),
('Mobile'),
('Xbox'),
('PlayStation');


INSERT INTO collectionner (Id_client, Id_jeux, heures_jouees_collection, date_ajout_collection) VALUES
(1, 1, 120, '2021-04-05'),
(2, 2, 85, '2022-08-16'),
(3, 3, 50, '2023-02-10'),
(4, 4, 30, '2021-12-15'),
(5, 5, 200, '2020-12-17');



INSERT INTO appartenir (Id_jeux, Id_plateforme, Num_odre_plateforme) VALUES
(1, 1, 1),
(2, 5, 1),
(3, 2, 1),
(4, 4, 1),
(5, 1, 2);
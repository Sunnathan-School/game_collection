-- Partie création de tables --

CREATE TABLE USERS(
   Id_users INT,
   prenom_users VARCHAR(50) NOT NULL,
   email_users VARCHAR(50) NOT NULL,
   mdp_users VARCHAR(50) NOT NULL,
   nom_users VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_users)
);

CREATE TABLE JEUX(
   Id_jeux INT,
   nom_jeux VARCHAR(50) NOT NULL,
   description_jeux VARCHAR(50),
   editeur_jeux VARCHAR(50) NOT NULL,
   date_sortie_jeux DATE NOT NULL,
   plateforme_jeux VARCHAR(50),
   couverture_url_jeux VARCHAR(50),
   site_url_jeux VARCHAR(50),
   PRIMARY KEY(Id_jeux),
   UNIQUE(nom_jeux)
);

CREATE TABLE PLATEFORME(
   Id_plateforme INT,
   nom_plateforme VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_plateforme)
);

CREATE TABLE collectionner(
   Id_users INT,
   Id_jeux INT,
   heures_jouees_collection INT NOT NULL,
   date_ajout_collection DATE NOT NULL,
   PRIMARY KEY(Id_users, Id_jeux),
   FOREIGN KEY(Id_users) REFERENCES USERS(Id_users),
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



INSERT INTO USERS (prenom_users, email_users, mdp_users, nom_users) VALUES
('Alex', 'alex@example.com', 'password123', 'Durand'),
('Mila', 'mila@example.com', 'password456', 'Dupont'),
('Lucas', 'lucas@example.com', 'password789', 'Martin');



INSERT INTO JEUX (Id_jeux, nom_jeux, description_jeux, editeur_jeux, date_sortie_jeux, plateforme_jeux, couverture_url_jeux, site_url_jeux) VALUES
(1, 'The Witcher 3: Wild Hunt', 'An open-world RPG set in a gritty fantasy universe', 'CD Projekt', '2015-05-18', 'PC', 'https://th.bing.com/th/id/OIP.ESLUrniRRUtzAk-LMGNjAAAAAA?rs=1&pid=ImgDetMain', 'https://thewitcher.com'),
(2, 'Red Dead Redemption 2', 'An epic tale of life in America at the dawn of the modern age', 'Rockstar Games', '2018-10-26', 'PlayStation', 'https://th.bing.com/th/id/OIP.ecoMHvpEDcaJGEHooAQE4QAAAA?rs=1&pid=ImgDetMain', 'https://www.rockstargames.com/reddeadredemption2/'),
(3, 'Super Mario Odyssey', 'Mario embarks on a new journey through unknown worlds', 'Nintendo', '2017-10-27', 'Nintendo', 'https://th.bing.com/th/id/R.fd3644a9d9258f4cea239d99df14af48?rik=p3dc0OPX9KLzKw&riu=http%3a%2f%2fimages.nintendolife.com%2fnews%2f2017%2f10%2fsuper_mario_odyssey_has_already_cleared_2_million_sales%2fattachment%2f0%2foriginal.jpg&ehk=cABXnhtGW9LOLL%2bYXYbVZJ31MZQ5%2bYH%2f5%2fpuNtvCh5w%3d&risl=&pid=ImgRaw&r=0', 'https://www.nintendo.com/games/detail/super-mario-odyssey-switch/'),
(4, 'Halo Infinite', 'The next chapter of the legendary Halo series', '343 Industries', '2021-12-08', 'Xbox', 'https://th.bing.com/th/id/R.b88688beade9d2a55595c44a94d4051d?rik=qNwmqZp8c4mgUg&pid=ImgRaw&r=0', 'https://www.halowaypoint.com/en-us/games/halo-infinite'),
(5, 'Cyberpunk 2077', 'An open-world, action-adventure story set in Night City', 'CD Projekt', '2020-12-10', 'PC', 'https://th.bing.com/th/id/R.e70e98eee8f8f2eb33ca0ac0e7469e0a?rik=dlIDk%2bs642X81Q&pid=ImgRaw&r=0', 'https://www.cyberpunk.net');



INSERT INTO PLATEFORME (Id_plateforme, nom_plateforme) VALUES
(1, 'PC'),
(2, 'Nintendo'),
(3, 'Mobile'),
(4, 'Xbox'),
(5, 'PlayStation');



INSERT INTO collectionner (Id_users, Id_jeux, heures_jouees_collection, date_ajout_collection) VALUES
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

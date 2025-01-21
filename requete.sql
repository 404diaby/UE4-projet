DROP DATABASE site;
     CREATE DATABASE site;
            USE site;
CREATE TABLE Utilisateur (
                             id INT AUTO_INCREMENT PRIMARY KEY,
                             nom VARCHAR(100) NOT NULL,
                             prenom VARCHAR(100) NOT NULL,
                             adresse VARCHAR(255),
                             code_postal VARCHAR(10),
                             ville VARCHAR(100),
                             email VARCHAR(255) UNIQUE NOT NULL,
                             role enum('utilisateur','admin') DEFAULT 'utilisateur',
                             mot_de_passe VARCHAR(255) NOT NULL,
                             statut VARCHAR(50),
                             date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                             date_connexion TIMESTAMP NULL,
                             site_1 BOOLEAN DEFAULT FALSE,
                             site_2 BOOLEAN DEFAULT FALSE
);

CREATE TABLE Categorie (
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           nom VARCHAR(255) NOT NULL,
                           description TEXT NULL
);

CREATE TABLE Etat (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      nom VARCHAR(255) NOT NULL
);

CREATE TABLE Statut (
                        id INT AUTO_INCREMENT PRIMARY KEY ,
                        nom VARCHAR(255) NOT NULL,
    libelle VARCHAR(255) NOT NULL
);

CREATE TABLE Annonce (
                         id INT AUTO_INCREMENT PRIMARY KEY ,
                         titre VARCHAR(125) NOT NULL,
                         description VARCHAR(8000) NOT NULL,
                         categorie_id INT NULL,
                         etat_id INT NULL,
                         date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                         prix DECIMAL(10,2) NOT NULL ,
                         image VARCHAR(500) NOT NULL,
                         statut_id INT NULL,
                         vendu BOOLEAN NOT NULL DEFAULT 0,
                         utilisateur_id INT NOT NULL,
                         FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(id) ON DELETE CASCADE,
                         FOREIGN KEY (categorie_id) REFERENCES Categorie(id) ON DELETE SET NULL,
                         FOREIGN KEY (etat_id) REFERENCES Etat(id) ON DELETE SET NULL,
                         FOREIGN KEY (statut_id) REFERENCES Statut(id) ON DELETE SET NULL
);



INSERT INTO `Utilisateur` ( `nom`,prenom, adresse,code_postal,ville,site_1,site_2,`email`, `mot_de_passe`, `role`, `date_inscription`) VALUES
                                                                                                                                           ( 'Dupont',' Jean', '1 rue Lorem','21000','Dijon',false,false,'jean.dupont@example.com','$2y$12$/WRlxwqN54v6wLgiQ7qn9euO92aRtE281g9UhQJc1qz3v0sLRWOLW','utilisateur', '2024-11-19 15:43:42'),
                                                                                                                                           ( 'Diaby','Mamadou','1 rue Lorem','21000','Dijon',false,false,'admin@example.com','$2y$12$/WRlxwqN54v6wLgiQ7qn9euO92aRtE281g9UhQJc1qz3v0sLRWOLW','admin', '2024-11-19 15:43:42'),
                                                                                                                                           ('Dupont', 'Jeannette',  '10 rue des Jouets','21000','Paris',false,false,'jeannette.dupont@email.com', '$2y$12$/WRlxwqN54v6wLgiQ7qn9euO92aRtE281g9UhQJc1qz3v0sLRWOLW','utilisateur','2019-11-19 15:43:42'),
                                                                                                                                           ('Martin', 'Sophie', '25 avenue du Vintage','21000','Lyon',false,false,'sophie.martin@email.com', '$2y$12$/WRlxwqN54v6wLgiQ7qn9euO92aRtE281g9UhQJc1qz3v0sLRWOLW','utilisateur', '2025-11-19 15:43:42'),
                                                                                                                                           ('Lemoine', 'Paul', '5 boulevard du Rétro ','21000','Marseille',false,false,'paul.lemoine@email.com', '$2y$12$/WRlxwqN54v6wLgiQ7qn9euO92aRtE281g9UhQJc1qz3v0sLRWOLW','utilisateur','2024-11-19 15:43:42'),
                                                                                                                                           ('Bernard', 'Claire',  '7 impasse du Jouet','21000','Bordeaux',false,false,'claire.bernard@email.com', '$2y$12$/WRlxwqN54v6wLgiQ7qn9euO92aRtE281g9UhQJc1qz3v0sLRWOLW','utilisateur','2024-11-19 15:43:42'),
                                                                                                                                           ('Morel', 'Antoine',  '12 rue des Enfants','21000','Toulouse',false,false,'antoine.morel@email.com', '$2y$12$/WRlxwqN54v6wLgiQ7qn9euO92aRtE281g9UhQJc1qz3v0sLRWOLW','utilisateur','2024-11-19 15:43:42');

INSERT INTO Categorie (nom, description) VALUES
                                             ('Voitures miniatures', 'Jouets anciens de collection : Majorette, Dinky Toys, etc.'),
                                             ('Poupées & Figurines', 'Poupées anciennes et figurines de collection'),
                                             ('Jeux de société', 'Jeux de plateau et de société vintage'),
                                             ('Peluches & Doudous', "Peluches d'époque et jouets en tissu"),
                                             ('Jouets en bois', 'Jouets artisanaux en bois');

INSERT INTO Statut (nom,libelle) VALUES
                             ('Publié','Publier maintenant'),
                             ('Brouillon','Sauvegarder comme brouillon');

INSERT INTO Etat ( nom ) VALUES
                              ('Neuf'),
                              ('Très bon'),
                              ('Bon'),
                              ( 'Acceptable'),
                              ( 'A restaurer');

INSERT INTO Annonce (titre, description, prix, etat_id, utilisateur_id, categorie_id,statut_id,image) VALUES
-- Voitures Miniatures (Catégorie ID = 1)
    ('Dinky Toys Ferrari 250 GTO', "Rare modèle avec boîte d'origine.", 150.00, 3, 1, 1,1,'ferrari_gto.jpg'),
('Majorette Porsche 911 Turbo', 'Édition spéciale rouge 1970.', 80.00, 2, 2, 1,1,'porsche_911.jpg'),
('Corgi Toys Batmobile', 'Jouet vintage avec figurines.', 120.00, 3, 3, 1,1,'batmobile.jpg'),
('Matchbox Ford Mustang 1965', 'Petites rayures, très rare.', 95.00, 4, 4, 1,1,'mustang_1965.jpg'),
('Hot Wheels Chevrolet Camaro', 'Neuf en boîte, modèle 1980.', 60.00, 1, 5, 1,1,'camaro_1980.jpg'),

-- Poupées & Figurines (Catégorie ID = 2)
('Barbie 1960', 'Parfaite condition avec accessoires.', 200.00, 2, 1, 2,1,'barbie_1960.jpg'),
('Action Man 1975', 'État moyen, manque une botte.', 75.00, 4, 2, 2,1,'actionman_1975.jpg'),
('G.I. Joe 1980', 'Jouet complet avec boîte.', 180.00, 2, 3, 2,1,'gi_joe_1980.jpg'),
('Poupée Corolle Vintage', "Robe d'époque, excellent état.", 130.00, 3, 4, 2,1,'corolle_vintage.jpg'),
('Figurines Star Wars 1977', 'Lot de 3, édition collector.', 250.00, 2, 5, 2,1,'starwars_figurines.jpg'),

-- Jeux de société (Catégorie ID = 3)
('Monopoly édition 1975', 'Jeu complet, légèrement usé.', 50.00, 4, 1, 3,1,'monopoly_1975.jpg'),
('Risk années 80', 'Pièces originales, manque une carte.', 90.00, 3, 2, 3,1,'risk_1980.jpg'),
('Scrabble bois 1960', "En parfait état avec lettres d'origine.", 120.00, 2, 3, 3,1,'scrabble_1960.jpg'),
("Jeu de l’oie vintage", "Édition collector en métal.", 85.00, 3, 4, 3,1,'jeu_oie.jpg'),
("Cluedo 1972", "Complet, boîte légèrement abîmée.", 110.00, 3, 5, 3,1,'cluedo_1972.jpg'),

-- Peluches & Doudous (Catégorie ID = 4)
("Teddy Bear 1950", "Très doux, fourrure d'origine." , 300.00, 2, 1, 4,1,'teddy_bear_1950.jpg'),
('Peluche Disney Mickey 1970', 'Neuf avec étiquette.', 180.00, 1, 2, 4,1,'mickey_1970.jpg'),
('Doudou Lapin 1965', 'Usé mais en bon état.', 95.00, 4, 3, 4,1,'doudou_lapin.jpg'),
('Poupée chiffon artisanale', 'Fait main, parfait état.', 150.00, 2, 4, 4,1,'poupee_chiffon.jpg'),
('Peluche Ours Polaire 1985', 'Collection rare, état impeccable.', 210.00, 2, 5, 4,1,'ours_polaire.jpg'),

-- Jouets en bois (Catégorie ID = 5)
('Train en bois 1940', 'Modèle de collection, superbe état.', 400.00, 2, 1, 5,1,'train_bois_1940.jpg'),
('Cheval à bascule 1970', 'Bois massif, belle finition.', 250.00, 4, 2, 5,1,'cheval_bascule.jpg'),
('Casse-tête bois 1965', 'Complet avec boîte.', 75.00, 2, 3, 5,1,'casse_tete.jpg'),
('Petite voiture en bois', 'Fabrication artisanale.', 60.00, 1, 4, 5,1,'voiture_bois.jpg'),
('Marionnette en bois 1980', 'Mécanisme fonctionnel.', 130.00, 3, 5, 5,1,'marionnette_bois.jpg');

INSERT INTO Image (url, annonce_id, est_principale) VALUES
                                        ('images/ferrari_gto.jpg', 1,1),
                                     --   ('images/ferrari_gto_side.jpg', 1 ,0),
                                        ('images/porsche_911.jpg', 2,1),
                                       -- ('images/porsche_911_back.jpg', 2,0),
                                        ('images/batmobile.jpg', 3,1),
                                       -- ('images/batmobile_packaging.jpg', 3,0),
                                        ('images/mustang_1965.jpg', 4,1),
                                       -- ('images/mustang_1965_side.jpg', 4,0),
                                        ('images/camaro_1980.jpg', 5,1),
                                        ('images/barbie_1960.jpg', 6,1),
                                       -- ('images/barbie_1960_clothes.jpg', 6,0),
                                        ('images/actionman_1975.jpg', 7,1),
                                        ('images/gi_joe_1980.jpg', 8,1),
                                        ('images/corolle_vintage.jpg', 9,1),
                                        ('images/starwars_figurines.jpg', 10,1),
                                        ('images/monopoly_1975.jpg', 11,1),
                                        ('images/risk_1980.jpg', 12,1),
                                        ('images/scrabble_1960.jpg', 13,1),
                                        ('images/jeu_oie.jpg', 14,1),
                                        ('images/cluedo_1972.jpg', 15,1),
                                        ('images/teddy_bear_1950.jpg', 16,1),
                                        ('images/mickey_1970.jpg', 17,1),
                                        ('images/doudou_lapin.jpg', 18,1),
                                        ('images/poupee_chiffon.jpg', 19,1),
                                        ('images/ours_polaire.jpg', 20,1),
                                        ('images/train_bois_1940.jpg', 21,1),
                                       -- ('images/train_bois_1940_side.jpg', 21,0),
                                        ('images/cheval_bascule.jpg', 22,1),
                                       -- ('images/cheval_bascule_front.jpg', 22,0),
                                        ('images/casse_tete.jpg', 23,1),
                                        ('images/voiture_bois.jpg', 24,1),
                                        ('images/marionnette_bois.jpg', 25,1);
                                      --  ('images/camaro_1980_back.jpg', 5,0),
                                      --  ('images/barbie_1960_shoes.jpg', 6,0),
                                      --  ('images/monopoly_1975_board.jpg', 11,0),
                                      --  ('images/scrabble_letters.jpg', 13,0),
                                       -- ('images/teddy_bear_face.jpg', 16,0),
                                      --  ('images/ours_polaire_side.jpg', 20,0),
                                      --  ('images/train_bois_tracks.jpg', 21,0),
                                       -- ('images/cheval_bascule_wood.jpg', 22,0);

/*
CREATE TABLE Image (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       url VARCHAR(500) NOT NULL,
                       est_principale BOOLEAN DEFAULT 0,
                       annonce_id INT NOT NULL,
                       FOREIGN KEY (annonce_id) REFERENCES Annonce(id) ON DELETE CASCADE
);
ALTER TABLE Image ADD CONSTRAINT unique_main_image UNIQUE (annonce_id, est_principale);
*/
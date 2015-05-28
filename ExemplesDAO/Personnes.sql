-- Création de la table Personnes
CREATE TABLE Personnes (
     id INTEGER NOT NULL AUTO_INCREMENT,
     nom varchar(64) NOT NULL,
     prénom varchar(64),
     courriel varchar(128),
     PRIMARY KEY (id)
) CHARSET='utf8' COMMENT='Liste des personnes';

-- 
-- Contenu de la table `Personnes`
-- 
INSERT INTO Personnes (nom, prénom, courriel) 
VALUES ('RENAUDET', 'Stéphane', 'Stephane.Renaudet@iut-valence.fr'),
       ('GENTHIAL', 'Damien', 'Damien.Genthial@iut-valence.fr'),
       ('CHECHAT', 'David', 'David.Chechat@iut-valence.fr'),
       ('PEYREMORTE', 'Éric', 'Eric.Peyremorte@iut-valence.fr'),
       ('EINSTEIN', 'Albert', 'E = mC2'),
       ('DESPROGES', 'Pierre', 'Étonnant non ?');

-- Création de la table Administratifs
CREATE TABLE Administratifs (
     personneId INTEGER NOT NULL,
     bureau varchar(16),
     poste varchar(64),
     PRIMARY KEY (personneId)
);

-- 
-- Contenu de la table `Administratifs`
-- 
INSERT INTO Administratifs (personneId, bureau, poste)
VALUES (1, 'B108', '812'),
       (2, 'B108', '812'),
       (3, 'B109', '837'),
       (4, 'B109', '837');

-- Création de la table Etudiants
CREATE TABLE Etudiants (
     personneId INTEGER NOT NULL,
     formation varchar(32),
     groupe varchar(32),
     PRIMARY KEY (personneId)
);

-- 
-- Contenu de la table `Administratifs`
-- 
INSERT INTO Etudiants (personneId, formation, groupe)
VALUES (5, 'DUT Informatique', 'S1/TD1/TPA'),
       (6, 'DUT Cancerologie', 'Moins de 50 ans');

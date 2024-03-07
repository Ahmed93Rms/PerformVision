CREATE TABLE Utilisateur (
    id_utilisateur SERIAL PRIMARY KEY NOT NULL,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    mail VARCHAR(255),
    password VARCHAR(100),
    telephone VARCHAR(20)
);

INSERT INTO Utilisateur VALUES(1, 'ROOT', 'Admin', 'root@root.com', 'aq15cae3b355c412626382b7e81a2ea9c4bfa79f1a325', 0101010101);

CREATE TABLE Categorie (
    id_categorie SERIAL PRIMARY KEY,
    nom_categorie VARCHAR(50),
    valide_categorie BOOLEAN
);

INSERT INTO Categorie VALUES(1, 'Programmation', True);
INSERT INTO Categorie VALUES(2, 'Base de Données', True);
INSERT INTO Categorie VALUES(3, 'Développement Web', True);
INSERT INTO Categorie VALUES(4, 'Développement Mobile', True);
INSERT INTO Categorie VALUES(5, 'SDI / SDx', True);
INSERT INTO Categorie VALUES(6, 'IA', True);
INSERT INTO Categorie VALUES(7, 'Bureautique', True);
INSERT INTO Categorie VALUES(8, 'Modélisation', True);
INSERT INTO Categorie VALUES(9, 'DataScience', True);
INSERT INTO Categorie VALUES(10, 'Réseaux', True);
INSERT INTO Categorie VALUES(11, 'Mathématique', True);
INSERT INTO Categorie VALUES(12, 'Operating System', True);
INSERT INTO Categorie VALUES(13, 'Autre', True);


CREATE TABLE Theme (
    id_theme SERIAL PRIMARY KEY,
    nom_theme VARCHAR(50),
    valide_theme BOOLEAN,
    id_categorie INT,
    FOREIGN KEY (id_categorie) REFERENCES Categorie(id_categorie)
);

INSERT INTO Theme VALUES(1, 'Python', True, 1);
INSERT INTO Theme VALUES(2, 'C', True, 1);
INSERT INTO Theme VALUES(3, 'C++', True, 1);
INSERT INTO Theme VALUES(4, 'C#', True, 1);
INSERT INTO Theme VALUES(5, 'JAVA', True, 1);
INSERT INTO Theme VALUES(6, 'JAVA SE', True, 1);
INSERT INTO Theme VALUES(7, 'JAVA EE', True, 1);
INSERT INTO Theme VALUES(8, 'PostGreSQL', True, 2);
INSERT INTO Theme VALUES(9, 'SQL Server', True, 2);
INSERT INTO Theme VALUES(10, 'Oracle', True, 2);
INSERT INTO Theme VALUES(11, 'MySQL', True, 2);
INSERT INTO Theme VALUES(12, 'NoSQL', True, 2);
INSERT INTO Theme VALUES(13, 'ACCESS', True, 2);
INSERT INTO Theme VALUES(14, 'HTML CSS', True, 3);
INSERT INTO Theme VALUES(15, 'JavaScript', True, 3);
INSERT INTO Theme VALUES(16, 'PHP', True, 3);
INSERT INTO Theme VALUES(17, 'Android', True, 4);
INSERT INTO Theme VALUES(18, 'Ios', True, 4);
INSERT INTO Theme VALUES(19, 'Multi', True, 4);
INSERT INTO Theme VALUES(20, 'Virtualisation', True, 5);
INSERT INTO Theme VALUES(21, 'Conteneurisation', True, 5);
INSERT INTO Theme VALUES(22, 'Orchestration', True, 5);
INSERT INTO Theme VALUES(23, 'Machine Learning', True, 6);
INSERT INTO Theme VALUES(24, 'Deep Learning', True, 6);
INSERT INTO Theme VALUES(25, 'Word', True, 7);
INSERT INTO Theme VALUES(26, 'Power Point', True, 7);
INSERT INTO Theme VALUES(27, 'Excel', True, 7);
INSERT INTO Theme VALUES(28, 'Merise', True, 8);
INSERT INTO Theme VALUES(29, 'UML', True, 8);
INSERT INTO Theme VALUES(30, 'Calcul', True, 9);
INSERT INTO Theme VALUES(31, 'Bases', True, 10);
INSERT INTO Theme VALUES(32, 'Analyse', True, 11);
INSERT INTO Theme VALUES(33, 'Algèbre', True, 11);
INSERT INTO Theme VALUES(34, 'Géometrie', True, 11);
INSERT INTO Theme VALUES(35, 'Topologie', True, 11);
INSERT INTO Theme VALUES(36, 'Logique', True, 11);
INSERT INTO Theme VALUES(37, 'Système', True, 12);
INSERT INTO Theme VALUES(38, 'Sécurité', True, 12);

CREATE TABLE Public (
    id_publique SERIAL PRIMARY KEY,
    libelle_public VARCHAR(50)
);

CREATE TABLE Niveau (
    id_niveau SERIAL PRIMARY KEY,
    libelle_niveau VARCHAR(100)
);

INSERT INTO Niveau VALUES(1, 'Débutant');
INSERT INTO Niveau VALUES(2, 'Initition');
INSERT INTO Niveau VALUES(3, 'Initié');
INSERT INTO Niveau VALUES(4, 'Intermédiare');
INSERT INTO Niveau VALUES(5, 'Avancé');
INSERT INTO Niveau VALUES(6, 'Confirmé');
INSERT INTO Niveau VALUES(7, 'Expert');


CREATE TABLE Formateur (
    id_utilisateur INT PRIMARY KEY,
    linkedin VARCHAR(100),
    cv VARCHAR(100),
    date_signature DATE,
    signature_electronique TEXT,
    taux_horaire INT,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
);

CREATE TABLE client (
    id_utilisateur INT PRIMARY KEY,
    societe VARCHAR(100),
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
);

CREATE TABLE Moderateur (
    id_utilisateur INT PRIMARY KEY,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
);

CREATE TABLE Admin (
    id_utilisateur INT PRIMARY KEY,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
);

INSERT INTO Admin VALUES(1);

CREATE TABLE AExperiencePedagogique (
    id_utilisateur INT,
    id_theme INT,
    volume_heure_moyen_session INT,
    nombre_sessions_effectuees INT,
    commentaire TEXT,
    PRIMARY KEY (id_utilisateur, id_theme),
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur),
    FOREIGN KEY (id_theme) REFERENCES Theme(id_theme)
);

CREATE TABLE AExpertiseProfessionnelle (
    id_utilisateur INT,
    id_theme INT,
    duree_moyenne_experience INT,
    commentaire TEXT,
    id_niveau INT,
    PRIMARY KEY (id_utilisateur, id_theme),
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur),
    FOREIGN KEY (id_theme) REFERENCES Theme(id_theme),
    FOREIGN KEY (id_niveau) REFERENCES Niveau(id_niveau)
);

CREATE TABLE Activite (
    id_activite SERIAL PRIMARY KEY,
    nom_activite VARCHAR(50),
    image TEXT,
    texte TEXT,
    id_utilisateur INT,
    id_categorie INT,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur),
    FOREIGN KEY (id_categorie) REFERENCES Categorie(id_categorie)
);

CREATE TABLE Discussion (
    id_discussion SERIAL PRIMARY KEY,
    id_utilisateur INT,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
);

CREATE TABLE Message (
    id_message SERIAL PRIMARY KEY,
    texte TEXT,
    date_heure DATE,
    valide_message BOOLEAN,
    lu BOOLEAN,
    id_utilisateur INT,
    id_discussion INT,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur),
    FOREIGN KEY (id_discussion) REFERENCES Discussion(id_discussion)
);

ALTER TABLE client
ADD FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE;

ALTER TABLE formateur
ADD FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE;

### Introducion
DataWare, une entreprise innovante désireuse de révolutionner sa gestion du personnel, a choisi votre équipe pour mener à bien une mission cruciale. Votre mandat consiste à concevoir une interface conviviale exploitant les langages PHP et SQL pour répondre de manière optimale à leurs exigences en matière de gestion des ressources humaines.
### Objectif du Projet
L'objectif principal de ce projet est de concevoir un système de gestion des ressources humaines pour DataWare. Cela implique la création d'une interface utilisateur conviviale et d'une base de données robuste pour stocker et gérer les informations relatives aux équipes et aux membres du personnel.
## Comment utiliser
* Clonez ce référentiel sur votre machine locale à l'aide de git clone.
* Ouvrez les fichiers HTML dans votre navigateur Web pour naviguer à travers les différentes pages.
## Conception en UML
https://lucid.app/lucidchart/128ad176-b9b2-4212-ac70-e8e7af514956/edit?viewport_loc=-3908%2C-783%2C8322%2C3849%2C0_0&invitationId=inv_1792402f-db89-4954-975a-430a7944c2c2
## Cette mon repo
https://github.com/yassinebenbrika/breif-5-1
## cette mon table affichage
http://localhost/breif-5/member.php
## create equipe table
CREATE TABLE equipe (
    id_equipe INT AUTO_INCREMENT PRIMARY KEY,
    nom_de_equipe VARCHAR(255) NOT NULL,
    date_de_creation DATE NOT NULL
);
## create member table
CREATE TABLE equipe (
    id INT AUTO_INCREMENT PRIMARY KEY,<br>
    nom_de_equipe VARCHAR(255) NOT NULL,
    date_de_creation DATE NOT NULL,
    telephone INT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL,
    equipe VARCHAR(255) NOT NULL,
    statut VARCHAR(255) NOT NULL
);




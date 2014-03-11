#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


CREATE TABLE classe(
        id         int (11) Auto_increment  NOT NULL ,
        libelle    Varchar (50) NOT NULL ,
        id_diplome Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE diplome(
        id          int (11) Auto_increment  NOT NULL ,
        libelle     Varchar (50) NOT NULL ,
        annee       Year NOT NULL ,
        conditions  Text NOT NULL ,
        id_personne Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE matiere(
        id            int (11) Auto_increment  NOT NULL ,
        libelle       Varchar (50) NOT NULL ,
        id_thematique Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE thematique(
        id      int (11) Auto_increment  NOT NULL ,
        libelle Varchar (50) NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE salle(
        id   int (11) Auto_increment  NOT NULL ,
        type Varchar (50) NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE cours(
        id          int (11) Auto_increment  NOT NULL ,
        date_cours  Date NOT NULL ,
        heure_debut Time NOT NULL ,
        heure_fin   Time NOT NULL ,
        id_personne Int NOT NULL ,
        id_salle    Int NOT NULL ,
        id_matiere  Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE personne(
        id         int (11) Auto_increment  NOT NULL ,
        nom        Varchar (30) NOT NULL ,
        prenom     Varchar (50) NOT NULL ,
        mail       Varchar (50) NOT NULL ,
        telephone  Varchar (20) NOT NULL ,
        type       Varchar (50) NOT NULL ,
        id_classe  Int NOT NULL ,
        id_cours   Int NOT NULL ,
        id_Cantine Int NOT NULL ,
        PRIMARY KEY (id ) ,
        UNIQUE (mail )
)ENGINE=InnoDB;


CREATE TABLE materiel(
        id          int (11) Auto_increment  NOT NULL ,
        description Varchar (150) NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE Cantine(
        id      int (11) Auto_increment  NOT NULL ,
        annee   Year NOT NULL ,
        semaine Int NOT NULL ,
        jours   Varchar (50) NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE reserver(
        date_emprunt Date NOT NULL ,
        heure_debut  Time NOT NULL ,
        heure_fin    Time NOT NULL ,
        id           Int NOT NULL ,
        id_materiel  Int NOT NULL ,
        PRIMARY KEY (id ,id_materiel )
)ENGINE=InnoDB;


CREATE TABLE utiliser(
        id         Int NOT NULL ,
        id_matiere Int NOT NULL ,
        PRIMARY KEY (id ,id_matiere )
)ENGINE=InnoDB;


CREATE TABLE composer(
        coef       Int NOT NULL ,
        id         Int NOT NULL ,
        id_diplome Int NOT NULL ,
        PRIMARY KEY (id ,id_diplome )
)ENGINE=InnoDB;


CREATE TABLE note(
        valeur     Float ,
        id         Int NOT NULL ,
        id_diplome Int NOT NULL ,
        id_matiere Int NOT NULL ,
        PRIMARY KEY (id ,id_diplome ,id_matiere )
)ENGINE=InnoDB;

ALTER TABLE classe ADD CONSTRAINT FK_classe_id_diplome FOREIGN KEY (id_diplome) REFERENCES diplome(id);
ALTER TABLE diplome ADD CONSTRAINT FK_diplome_id_personne FOREIGN KEY (id_personne) REFERENCES personne(id);
ALTER TABLE matiere ADD CONSTRAINT FK_matiere_id_thematique FOREIGN KEY (id_thematique) REFERENCES thematique(id);
ALTER TABLE cours ADD CONSTRAINT FK_cours_id_personne FOREIGN KEY (id_personne) REFERENCES personne(id);
ALTER TABLE cours ADD CONSTRAINT FK_cours_id_salle FOREIGN KEY (id_salle) REFERENCES salle(id);
ALTER TABLE cours ADD CONSTRAINT FK_cours_id_matiere FOREIGN KEY (id_matiere) REFERENCES matiere(id);
ALTER TABLE personne ADD CONSTRAINT FK_personne_id_classe FOREIGN KEY (id_classe) REFERENCES classe(id);
ALTER TABLE personne ADD CONSTRAINT FK_personne_id_cours FOREIGN KEY (id_cours) REFERENCES cours(id);
ALTER TABLE personne ADD CONSTRAINT FK_personne_id_Cantine FOREIGN KEY (id_Cantine) REFERENCES Cantine(id);
ALTER TABLE reserver ADD CONSTRAINT FK_reserver_id FOREIGN KEY (id) REFERENCES personne(id);
ALTER TABLE reserver ADD CONSTRAINT FK_reserver_id_materiel FOREIGN KEY (id_materiel) REFERENCES materiel(id);
ALTER TABLE utiliser ADD CONSTRAINT FK_utiliser_id FOREIGN KEY (id) REFERENCES salle(id);
ALTER TABLE utiliser ADD CONSTRAINT FK_utiliser_id_matiere FOREIGN KEY (id_matiere) REFERENCES matiere(id);
ALTER TABLE composer ADD CONSTRAINT FK_composer_id FOREIGN KEY (id) REFERENCES matiere(id);
ALTER TABLE composer ADD CONSTRAINT FK_composer_id_diplome FOREIGN KEY (id_diplome) REFERENCES diplome(id);
ALTER TABLE note ADD CONSTRAINT FK_note_id FOREIGN KEY (id) REFERENCES personne(id);
ALTER TABLE note ADD CONSTRAINT FK_note_id_diplome FOREIGN KEY (id_diplome) REFERENCES diplome(id);
ALTER TABLE note ADD CONSTRAINT FK_note_id_matiere FOREIGN KEY (id_matiere) REFERENCES matiere(id);

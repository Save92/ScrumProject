#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


CREATE TABLE personnes(
        id        int (11) Auto_increment  NOT NULL ,
        nom       Varchar (50) NOT NULL ,
        prenom    Varchar (50) NOT NULL ,
        mail      Varchar (50) NOT NULL ,
        telephone Varchar (20) NOT NULL ,
        type      Varchar (40) NOT NULL ,
        id_classe Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE diplome(
        id         int (11) Auto_increment  NOT NULL ,
        libelle    Varchar (50) NOT NULL ,
        annee      Year NOT NULL ,
        conditions Text ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE classe(
        id           int (11) Auto_increment  NOT NULL ,
        nombre_eleve Int NOT NULL ,
        libelle      Varchar (50) NOT NULL ,
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


CREATE TABLE materiel(
        id          int (11) Auto_increment  NOT NULL ,
        description Varchar (250) NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE cours(
        id           int (11) Auto_increment  NOT NULL ,
        date_cours   Date NOT NULL ,
        heure_debut  Time NOT NULL ,
        heure_fin    Time NOT NULL ,
        id_personnes Int NOT NULL ,
        id_salle     Int NOT NULL ,
        id_matiere   Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE salle(
        id   int (11) Auto_increment  NOT NULL ,
        type Varchar (25) NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE posseder(
        id        Int NOT NULL ,
        id_classe Int NOT NULL ,
        PRIMARY KEY (id ,id_classe )
)ENGINE=InnoDB;


CREATE TABLE composer(
        coef       Integer NOT NULL ,
        id         Int NOT NULL ,
        id_matiere Int NOT NULL ,
        PRIMARY KEY (id ,id_matiere )
)ENGINE=InnoDB;


CREATE TABLE reserver(
        date_emprunt Date NOT NULL ,
        heure_debut  Time NOT NULL ,
        heure_fin    Time NOT NULL ,
        id           Int NOT NULL ,
        id_materiel  Int NOT NULL ,
        PRIMARY KEY (id ,id_materiel )
)ENGINE=InnoDB;


CREATE TABLE absent(
        id       Int NOT NULL ,
        id_cours Int NOT NULL ,
        PRIMARY KEY (id ,id_cours )
)ENGINE=InnoDB;


CREATE TABLE utiliser(
        id       Int NOT NULL ,
        id_salle Int NOT NULL ,
        PRIMARY KEY (id ,id_salle )
)ENGINE=InnoDB;

ALTER TABLE personnes ADD CONSTRAINT FK_personnes_id_classe FOREIGN KEY (id_classe) REFERENCES classe(id);
ALTER TABLE matiere ADD CONSTRAINT FK_matiere_id_thematique FOREIGN KEY (id_thematique) REFERENCES thematique(id);
ALTER TABLE cours ADD CONSTRAINT FK_cours_id_personnes FOREIGN KEY (id_personnes) REFERENCES personnes(id);
ALTER TABLE cours ADD CONSTRAINT FK_cours_id_salle FOREIGN KEY (id_salle) REFERENCES salle(id);
ALTER TABLE cours ADD CONSTRAINT FK_cours_id_matiere FOREIGN KEY (id_matiere) REFERENCES matiere(id);
ALTER TABLE posseder ADD CONSTRAINT FK_posseder_id FOREIGN KEY (id) REFERENCES diplome(id);
ALTER TABLE posseder ADD CONSTRAINT FK_posseder_id_classe FOREIGN KEY (id_classe) REFERENCES classe(id);
ALTER TABLE composer ADD CONSTRAINT FK_composer_id FOREIGN KEY (id) REFERENCES diplome(id);
ALTER TABLE composer ADD CONSTRAINT FK_composer_id_matiere FOREIGN KEY (id_matiere) REFERENCES matiere(id);
ALTER TABLE reserver ADD CONSTRAINT FK_reserver_id FOREIGN KEY (id) REFERENCES personnes(id);
ALTER TABLE reserver ADD CONSTRAINT FK_reserver_id_materiel FOREIGN KEY (id_materiel) REFERENCES materiel(id);
ALTER TABLE absent ADD CONSTRAINT FK_absent_id FOREIGN KEY (id) REFERENCES personnes(id);
ALTER TABLE absent ADD CONSTRAINT FK_absent_id_cours FOREIGN KEY (id_cours) REFERENCES cours(id);
ALTER TABLE utiliser ADD CONSTRAINT FK_utiliser_id FOREIGN KEY (id) REFERENCES matiere(id);
ALTER TABLE utiliser ADD CONSTRAINT FK_utiliser_id_salle FOREIGN KEY (id_salle) REFERENCES salle(id);

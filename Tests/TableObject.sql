-- Script de creation de deux tables de test

CREATE TABLE OneAutoIncremented (
	num INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE AssociationTable (
	num INTEGER NOT NULL,
	id INTEGER NOT NULL,
	PRIMARY KEY (num, id)
) COMMENT="Only key";

INSERT INTO OneAutoIncremented () VALUES ();
INSERT INTO OneAutoIncremented () VALUES ();

INSERT INTO AssociationTable (num, id) VALUES (1, 1);
INSERT INTO AssociationTable (num, id) VALUES (1, 2);


DROP TABLE IF EXISTS usuarios ;
CREATE TABLE usuarios(
     codigo INT NOT NULL AUTO_INCREMENT,
     nombre VARCHAR(30) NOT NULL,
     apellidos VARCHAR(30) NOT NULL,
     PRIMARY KEY (codigo)
);

-- Pour crée la base de donner si elle existe pas 
-- CREATE DATABASE IF NOT EXISTS excavator;
-- 
-- -- Pour utiliser la base de donner
 USE excavator;
-- 
-- -- Pour creat la table SCIENTISTS
-- CREATE TABLE  SCIENTISTS (
-- id_scientist int UNSIGNED NOT NULL AUTO_INCREMENT,
-- lastname_scientist varchar(100) NOT NULL,
-- firstname_scientist varchar(50) NOT NULL,
-- mail_scientist varchar(150) NOT NULL,
-- pass_scientist varchar(500) NOT NULL,
-- level_scientist smallint NOT NULL,
-- CONSTRAINT PK_SCIENTISTS PRIMARY KEY (id_scientist)
-- ) ENGINE=InnoDB;
-- 

CREATE USER 'formateur'@'localhost' IDENTIFIED BY 'dwwm2409';
GRANT ALL ON `excavator`.* TO 'formateur'@'localhost';
FLUSH PRIVILEGES;



INSERT INTO scientists VALUES 
(id_scientist,'MORTIMER','Philip','p.mortimer@mifivesec.eu','$argon2id$v=19$m=65536,t=4,p=1$M2laa2VRODdHRDB1MlAyRw$LM6tSZhnXDjWXCZsJrd9DhRYx7UWP1+SJP+DQaznC4M', 2),

(id_scientist,'BLAKE','Francis','f.blake@mifivesec.eu','$argon2id$v=19$m=65536,t=4,p=1$QnBISDV5ekpOaTJ3alJxQg$OWNinALt7XtvL50NN0B6E46bS1tuYN/CJ1tZ/gYQJGI', 1);
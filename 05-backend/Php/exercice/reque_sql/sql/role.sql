USE revision;
DROP USER 'Peter_Benjamin'@'localhost';
CREATE USER 'Peter_Benjamin'@'localhost' IDENTIFIED BY 'Parker';
GRANT ALL ON revision.*TO 'Peter_Benjamin'@'localhost';
FLUSH PRIVILEGES; 

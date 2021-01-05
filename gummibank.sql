#Datenbank erstellen
DROP DATABASE IF EXISTS gummibaerbank;
CREATE DATABASE gummibaerbank;
USE gummibaerbank;

#Tabellen erstellen
CREATE TABLE IF NOT EXISTS mitarbeiter(
mid INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
mvorname VARCHAR(128),
mpasswort VARCHAR(128)
);
CREATE TABLE IF NOT EXISTS kunden (
kid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
kvorname VARCHAR(128),
knachname VARCHAR(128),
ktelefonnummer INT(15),
kemail VARCHAR(128),
kadresse VARCHAR(128),
kpasswort VARCHAR(128),
kverfuegernummer INT(25)
);

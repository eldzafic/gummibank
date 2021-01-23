#Datenbank erstellen
DROP DATABASE IF EXISTS gummibaerbank;
CREATE DATABASE gummibaerbank;
USE gummibaerbank;

#Tabellen erstellen

CREATE TABLE IF NOT EXISTS kunden (
kid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
kvorname VARCHAR(128),
knachname VARCHAR(128),
ktelefonnummer INT(15),
kemail VARCHAR(128),
kadresse VARCHAR(128),
kpasswort VARCHAR(128),
kmitarbeiter BOOLEAN
);

CREATE TABLE IF NOT EXISTS konto (
koid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
kokontostand VARCHAR(128),
koiban VARCHAR(128),
kobic VARCHAR(128),
koverfueger VARCHAR(128),
kid INT(10)
);

CREATE TABLE IF NOT EXISTS ueberweisung (
uid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
uibansender VARCHAR(128),
ubicsenden VARCHAR(128),
uibanempfaenger VARCHAR(128),
ubicempfaenger VARCHAR(128),
uzahlungsreferenz VARCHAR(128),
uverwendungszweck VARCHAR(128),
ubetrag INT(10),
udatum DATETIME,
kid INT(10)
);
# storeProject

This is a store created with for school

## sql data base

    CREATE DATABASE storeDB;
    CREATE TABLE users (
        userID int NOT NULL AUTO_INCREMENT,
        username varchar(32),
        email varchar(255),
        password varchar(255),
        address varchar(255),
        bAdmin BOOL,
        PRIMARY KEY (userID)
    );
    CREATE TABLE products (
        productID int NOT NULL AUTO_INCREMENT,
        naam varchar(32),
        stock int,
        beschrijving varchar(255),
        prijs float(),
        imagePath varchar(255)
        PRIMARY KEY (productID)
    );
    CREATE TABLE bestellingen (
        userID int NOT NULL,
        productID int NOT NULL,
        datum dateTime,
        amount int,
        ?deliveryAdress? varchar(255),
        FOREIGN KEY (userID) REFERENCES users(userID),
        FOREIGN KEY (productID) REFERENCES products(productID),
    );

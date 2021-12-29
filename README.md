# storeProject

This is a store created with for school

## notes

make sure the path for the website is this
/php-mysxl/storeProject/(all the files)

admin:
email: beep@beep.be
pass: beep

## sql data base

    CREATE DATABASE storeDB;
    CREATE TABLE users (
        userID int NOT NULL AUTO_INCREMENT,
        username varchar(32),
        email varchar(255),
        password varchar(255),
        address varchar(255),
        bAdmin int,
        PRIMARY KEY (userID)
    );

    CREATE TABLE categories (
        categoryID int NOT NULL AUTO_INCREMENT,
        name varchar(32),
        description varchar(255),
        PRIMARY KEY (categoryID)
    );

    CREATE TABLE products (
        productID int NOT NULL AUTO_INCREMENT,
        name varchar(32),
        stock int,
        description varchar(255),
        price float,
        imagePath varchar(255),
        categoryID int not null,
        FOREIGN KEY (categoryID) REFERENCES categories(categoryID),
        PRIMARY KEY (productID)
    );

    CREATE TABLE orders (
        orderID int NOT NULL AUTO_INCREMENT,
        userID int NOT NULL,
        productID int NOT NULL,
        payDate dateTime,
        amount int,
        FOREIGN KEY (userID) REFERENCES users(userID),
        FOREIGN KEY (productID) REFERENCES products(productID),
        PRIMARY KEY (orderID)
    );

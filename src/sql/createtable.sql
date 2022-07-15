CREATE TABLE Customer (
    id INT PRIMARY KEY NOT NULL,
    custFullName VARCHAR NOT NULL,
    custUsername VARCHAR NOT NULL,
    custPassword VARCHAR NOT NULL
);

CREATE TABLE Product (
    id INT PRIMARY KEY NOT NULL,
    productName VARCHAR NOT NULL,
    productDesc VARCHAR NOT NULL,
    productImgUrl VARCHAR NOT NULL,
    productPrice FLOAT NOT NULL,
    productSalePrice FLOAT,
    productSaleEnd DATE
);

CREATE TABLE Orders (
    id INT PRIMARY KEY NOT NULL,
    custId INT NOT NULL,
    productId INT NOT NULL,
    orderDate DATE NOT NULL,
    orderDeliveryDate DATE,
    orderStatus INT
);
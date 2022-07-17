CREATE TABLE Customer (
    id SERIAL PRIMARY KEY NOT NULL,
    custFullName VARCHAR NOT NULL,
    custUsername VARCHAR NOT NULL,
    custPassword VARCHAR NOT NULL,
    custAddress VARCHAR,
    custNumber VARCHAR,
    isAdmin BOOLEAN,
    UNIQUE(custUsername)
);

CREATE TABLE Product (
    id SERIAL PRIMARY KEY NOT NULL,
    productName VARCHAR NOT NULL,
    productDesc VARCHAR,
    productImgUrl VARCHAR NOT NULL,
    productPrice FLOAT NOT NULL,
    productSalePrice FLOAT,
    productSaleEnd DATE
);

CREATE TABLE Orders (
    id SERIAL PRIMARY KEY NOT NULL,
    custId INT NOT NULL,
    productId INT NOT NULL,
    orderDate DATE NOT NULL,
    orderDeliveryDate DATE,
    orderStatus INT,
    CONSTRAINT o_customer
        FOREIGN KEY (custId)
        REFERENCES Customer(id),
    CONSTRAINT o_product
        FOREIGN KEY (productId)
        REFERENCES Product(id)
);

INSERT INTO Customer(custFullName, custUsername, custPassword, isAdmin)
VALUES ("Admin", "admin", "123", true)
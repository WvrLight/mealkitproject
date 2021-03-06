CREATE TABLE Customer (
    id SERIAL PRIMARY KEY NOT NULL,
    custFullName VARCHAR NOT NULL,
    custUsername VARCHAR NOT NULL,
    custEmail VARCHAR NOT NULL,
    custPassword VARCHAR NOT NULL,
    custAddress VARCHAR,
    custNumber VARCHAR,
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
    orderDate DATE NOT NULL,
    orderDeliveryDate DATE,
    orderStatus INT NOT NULL,
    CONSTRAINT o_customer
        FOREIGN KEY (custId)
        REFERENCES Customer(id)
);

CREATE TABLE OrderCart (
    productId INT NOT NULL,
    orderId INT NOT NULL,
    CONSTRAINT c_product
        FOREIGN KEY (productId)
        REFERENCES Product(id),
    CONSTRAINT c_order
        FOREIGN KEY (orderId)
        REFERENCES Orders(id)
);

CREATE TABLE Coupon (
    code VARCHAR PRIMARY KEY NOT NULL,
    discountPercent FLOAT NOT NULL,
    isOneTimeUse BOOLEAN NOT NULL,
    couponExpiry DATE NOT NULL,
    isExpired BOOLEAN NOT NULL,
    UNIQUE(code)
)
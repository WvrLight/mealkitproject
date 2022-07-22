TRUNCATE TABLE OrderCart;
TRUNCATE TABLE Orders;
TRUNCATE TABLE Customer;
TRUNCATE TABLE Product;

INSERT INTO Customer(custFullName, custUsername, custPassword, isAdmin)
VALUES ('Admin', 'admin', '123', true);

INSERT INTO Product(productName, productImgUrl, productPrice, productSalePrice)
VALUES ('Pinakbet Meal-kit', 'assets\img\pinakbet.jpg', 210.00, 190.00);

INSERT INTO Product(productName, productImgUrl, productPrice, productSalePrice)
VALUES ('Tinola Meal-kit', 'assets\img\tinola.jpg', 260.00, 190.00);

INSERT INTO Product(productName, productImgUrl, productPrice, productSalePrice)
VALUES ('Chicken Adobo Meal-kit', 'assets\img\adobo.jpg', 200.00, 190.00);
-- Cau 1
SELECT *
FROM Products
INNER JOIN Categories ON Products.categoryID = Categories.categoryID
WHERE Categories.categoryName = 'Guitars' AND Products.listPrice > 500;

-- Cau 2
SELECT *
FROM Products
WHERE YEAR(dateAdded) = 2014 AND MONTH(dateAdded) = 7 AND listPrice > 300
ORDER BY listPrice DESC;

-- Cau 3
SELECT *
FROM Products
INNER JOIN Categories ON Products.categoryID = Categories.categoryID
WHERE Products.productName LIKE '%o%' AND  Categories.categoryName = 'Basses'
ORDER BY productName DESC;

-- Cau4 
SELECT *
FROM (((Products
INNER JOIN Orderitems ON Products.productID = Orderitems.productID)
INNER JOIN Orders ON Orderitems.orderID = Orders.orderID)
INNER JOIN Customers ON Orders.customerID = Customers.customerID)
WHERE Customers.emailAddress LIKE '%@gmail.com%';

-- Cau 5
SELECT *
FROM Products
WHERE YEAR(dateAdded) = 2014 AND listPrice > 300 
ORDER BY listPrice DESC
LIMIT 4;

-- Cau 6
SELECT Addresses.city
FROM ((((Addresses
INNER JOIN Customers ON Addresses.customerID = Customers.customerID)
INNER JOIN Orders ON Customers.customerID = Orders.customerID)
INNER JOIN Orderitems ON Orders.orderID = Orderitems.orderID)
INNER JOIN Products ON Orderitems.productID = Products.productID)
WHERE Products.productName ='Yamaha FG700S';
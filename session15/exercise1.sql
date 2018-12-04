-- Cau 1
SELECT *
FROM products
INNER JOIN categories ON products.categoryID = categories.categoryID
WHERE categories.categoryName = 'Guitars' AND products.listPrice > 500;

-- Cau 2
SELECT *
FROM products
WHERE YEAR(dateAdded) = 2014 AND MONTH(dateAdded) = 7 AND listPrice > 300
ORDER BY listPrice DESC;

-- Cau 3
SELECT *
FROM products
INNER JOIN categories ON products.categoryID = categories.categoryID
WHERE products.productName LIKE '%o%' AND  categories.categoryName = 'Basses'
ORDER BY productName DESC;

-- Cau4 
SELECT *
FROM (((products
INNER JOIN orderitems ON products.productID = orderitems.productID)
INNER JOIN orders ON orderitems.orderID = orders.orderID)
INNER JOIN customers ON orders.customerID = customers.customerID)
WHERE customers.emailAddress LIKE '%@gmail.com%';

-- Cau 5
SELECT *
FROM products
WHERE YEAR(dateAdded) = 2014 AND listPrice > 300 
ORDER BY listPrice DESC
LIMIT 4;

-- Cau 6
SELECT addresses.city
FROM ((((addresses
INNER JOIN customers ON addresses.customerID = customers.customerID)
INNER JOIN orders ON customers.customerID = orders.customerID)
INNER JOIN orderitems ON orders.orderID = orderitems.orderID)
INNER JOIN products ON orderitems.productID = products.productID)
WHERE products.productName ='Yamaha FG700S'
GROUP BY addresses.city;
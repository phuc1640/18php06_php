INSERT INTO products (productName, description, image, price, date) VALUES("iphone", "expensive", "iphone.jpg", 1200, "1996-8-15");
INSERT INTO products (productName, description, image, price, date) VALUES("samsung", "cheap", "samsung.jpg", 100, "1996-8-15");
INSERT INTO products (productName, description, image, price, date) VALUES("oppo", "expensive", "oppo.jpg", 1200, "1996-8-15");

UPDATE products SET productName = "iphone6s" WHERE price > 1000;

SELECT * FROM products WHERE productName LIKE '%ng%' OR (YEAR(date) = 2018 AND MONTH(date) = 11);

DELETE FROM products WHERE description LIKE '%s%' AND price > 2000;
CREATE DATABASE car_dealership;


CREATE TABLE cars ( 
car_id INT AUTO_INCREMENT PRIMARY KEY,
model VARCHAR(255) NOT NULL,
used BOOLEAN NOT NULL, // TRUE for used, FALSE for new 
sale_date DATE,
price DECIMAL(10,2) NOT NULL 
);
 
INSERT INTO cars (model, used, sale_date, price) VALUES 
('Toyota Camry', FALSE, '2023-01-15', 24000.00),
('Honda Accord', TRUE, '2022-11-20', 18000.00),
('Ford Mustang', FALSE, '2023-03-10', 30000.00),
('Chevrolet Malibu', TRUE, '2022-12-05', 15000.00);
('Nissan Altima', FALSE, '2023-02-25', 22000.00);
('BMW 3 Series', TRUE, '2022-10-30', 28000.00);
('Audi A4', FALSE, '2023-04-01', 35000.00);
('Mercedes-Benz C-Class', TRUE, '2022-09-15', 32000.00);
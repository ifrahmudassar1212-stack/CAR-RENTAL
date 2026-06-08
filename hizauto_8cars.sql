-- ============================================================
--   HizAuto Car Rental — Full MySQL Database (8 Cars)
--   Paste this into phpMyAdmin → SQL tab and click GO
-- ============================================================

USE hizauto_db;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS rental_history;
DROP TABLE IF EXISTS payments;
DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS cars;
DROP TABLE IF EXISTS admin;
SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
--   TABLE 1 — admin
-- ============================================================
CREATE TABLE admin (
    admin_id      INT          NOT NULL AUTO_INCREMENT,
    email         VARCHAR(100) NOT NULL UNIQUE,
    password      VARCHAR(255) NOT NULL,
    created_at    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (admin_id)
);

INSERT INTO admin (email, password) VALUES
('hizauto@gmail.com', 'admin123');

-- ============================================================
--   TABLE 2 — cars (8 cars matching your website)
-- ============================================================
CREATE TABLE cars (
    car_id        VARCHAR(10)   NOT NULL,
    car_name      VARCHAR(100)  NOT NULL,
    category      VARCHAR(100)  NOT NULL,
    price_per_day DECIMAL(10,2) NOT NULL,
    image_url     TEXT,
    status        ENUM('Available','Rented','Maintenance') DEFAULT 'Available',
    created_at    TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (car_id)
);

INSERT INTO cars (car_id, car_name, category, price_per_day, image_url, status) VALUES
('CAR01', 'MG Cyberster 2026',   'Sports · Automatic',  120.00, 'https://cache3.pakwheels.com/system/car_generation_pictures/8778/original/Cover.jpg',    'Available'),
('CAR02', 'Audi A5',             'Sedan · Automatic',   200.00, 'https://cache3.pakwheels.com/system/car_generation_pictures/4394/original/Audi_A5_2017.jpg', 'Available'),
('CAR03', 'Toyota Land Cruiser', 'SUV · Automatic',     250.00, 'https://cache3.pakwheels.com/system/car_generation_pictures/16719/original/Cover.jpg',   'Rented'),
('CAR04', 'Honda Civic',         'Sedan · Automatic',   120.00, 'https://cache2.pakwheels.com/system/car_generation_pictures/10345/original/Cover_%2818%29.jpg', 'Available'),
('CAR05', 'Toyota Corolla',      'Sedan · Automatic',   110.00, 'https://cache1.pakwheels.com/system/car_generation_pictures/5361/original/Corolla-X-Cars-Cropped-Pictures-for-Website.jpg', 'Available'),
('CAR06', 'Peugeot 2008',        'SUV · Automatic',     150.00, 'https://cache3.pakwheels.com/system/car_generation_pictures/9124/original/Cover.jpg',    'Available'),
('CAR07', 'Haval H6',            'SUV · Automatic',     170.00, 'https://cache4.pakwheels.com/system/car_generation_pictures/8796/original/Cover.jpg',    'Rented'),
('CAR08', 'Jaecoo J5',           'SUV · Automatic',     130.00, 'https://cache4.pakwheels.com/system/car_generation_pictures/16873/original/Cover.jpg',   'Available');

-- ============================================================
--   TABLE 3 — customers (10 persons)
-- ============================================================
CREATE TABLE customers (
    customer_id   VARCHAR(10)  NOT NULL,
    full_name     VARCHAR(100) NOT NULL,
    email         VARCHAR(100) NOT NULL UNIQUE,
    phone         VARCHAR(25)  NOT NULL,
    city          VARCHAR(60)  NOT NULL,
    joined_date   DATE         NOT NULL,
    PRIMARY KEY (customer_id)
);

INSERT INTO customers (customer_id, full_name, email, phone, city, joined_date) VALUES
('C1001', 'Ali Khan',       'ali.khan@gmail.com',        '+92 300 1234567', 'Lahore',     '2026-01-01'),
('C1002', 'Sara Ahmed',     'sara.ahmed@gmail.com',      '+92 301 2345678', 'Karachi',    '2026-01-10'),
('C1003', 'Usman Malik',    'usman.malik@gmail.com',     '+92 302 3456789', 'Islamabad',  '2026-01-15'),
('C1004', 'Ayesha Noor',    'ayesha.noor@gmail.com',     '+92 303 4567890', 'Peshawar',   '2026-01-20'),
('C1005', 'Bilal Sheikh',   'bilal.sheikh@gmail.com',    '+92 304 5678901', 'Faisalabad', '2026-02-01'),
('C1006', 'Hina Qureshi',   'hina.qureshi@gmail.com',   '+92 305 6789012', 'Multan',     '2026-02-10'),
('C1007', 'Zain Abbas',     'zain.abbas@gmail.com',      '+92 306 7890123', 'Rawalpindi', '2026-02-20'),
('C1008', 'Maria Siddiqui', 'maria.siddiqui@gmail.com',  '+92 307 8901234', 'Lahore',     '2026-03-01'),
('C1009', 'Hamza Butt',     'hamza.butt@gmail.com',      '+92 308 9012345', 'Karachi',    '2026-03-10'),
('C1010', 'Fatima Zahra',   'fatima.zahra@gmail.com',    '+92 309 0123456', 'Islamabad',  '2026-03-20');

-- ============================================================
--   TABLE 4 — payments (10 records, only using 8 cars)
-- ============================================================
CREATE TABLE payments (
    payment_id    VARCHAR(10)  NOT NULL,
    customer_id   VARCHAR(10)  NOT NULL,
    car_id        VARCHAR(10)  NOT NULL,
    payment_mode  ENUM('COD','Credit Card','Debit Card','Bank Transfer') NOT NULL,
    amount        DECIMAL(10,2) NOT NULL,
    payment_date  DATE          NOT NULL,
    PRIMARY KEY (payment_id),
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id) ON DELETE CASCADE,
    FOREIGN KEY (car_id)      REFERENCES cars(car_id)           ON DELETE CASCADE
);

INSERT INTO payments (payment_id, customer_id, car_id, payment_mode, amount, payment_date) VALUES
('P101', 'C1001', 'CAR01', 'COD',           600.00,  '2026-01-05'),
('P102', 'C1002', 'CAR02', 'Credit Card',   800.00,  '2026-01-12'),
('P103', 'C1003', 'CAR03', 'Bank Transfer', 1250.00, '2026-01-18'),
('P104', 'C1004', 'CAR04', 'Debit Card',    480.00,  '2026-01-22'),
('P105', 'C1005', 'CAR05', 'COD',           330.00,  '2026-02-03'),
('P106', 'C1006', 'CAR06', 'Credit Card',   750.00,  '2026-02-14'),
('P107', 'C1007', 'CAR07', 'Bank Transfer', 850.00,  '2026-02-22'),
('P108', 'C1008', 'CAR08', 'COD',           390.00,  '2026-03-05'),
('P109', 'C1009', 'CAR01', 'Credit Card',   600.00,  '2026-03-12'),
('P110', 'C1010', 'CAR06', 'Debit Card',    450.00,  '2026-03-22');

-- ============================================================
--   TABLE 5 — bookings (10 records)
-- ============================================================
CREATE TABLE bookings (
    rental_id     VARCHAR(10)  NOT NULL,
    customer_id   VARCHAR(10)  NOT NULL,
    car_id        VARCHAR(10)  NOT NULL,
    payment_id    VARCHAR(10)  NOT NULL,
    location      VARCHAR(100) NOT NULL,
    date_rent     DATE         NOT NULL,
    date_return   DATE         NOT NULL,
    PRIMARY KEY (rental_id),
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id) ON DELETE CASCADE,
    FOREIGN KEY (car_id)      REFERENCES cars(car_id)           ON DELETE CASCADE,
    FOREIGN KEY (payment_id)  REFERENCES payments(payment_id)   ON DELETE CASCADE
);

INSERT INTO bookings (rental_id, customer_id, car_id, payment_id, location, date_rent, date_return) VALUES
('R101', 'C1001', 'CAR01', 'P101', 'Lahore',     '2026-01-05', '2026-01-10'),
('R102', 'C1002', 'CAR02', 'P102', 'Karachi',    '2026-01-12', '2026-01-16'),
('R103', 'C1003', 'CAR03', 'P103', 'Islamabad',  '2026-01-18', '2026-01-23'),
('R104', 'C1004', 'CAR04', 'P104', 'Peshawar',   '2026-01-22', '2026-01-26'),
('R105', 'C1005', 'CAR05', 'P105', 'Faisalabad', '2026-02-03', '2026-02-06'),
('R106', 'C1006', 'CAR06', 'P106', 'Multan',     '2026-02-14', '2026-02-19'),
('R107', 'C1007', 'CAR07', 'P107', 'Rawalpindi', '2026-02-22', '2026-02-27'),
('R108', 'C1008', 'CAR08', 'P108', 'Lahore',     '2026-03-05', '2026-03-08'),
('R109', 'C1009', 'CAR01', 'P109', 'Karachi',    '2026-03-12', '2026-03-17'),
('R110', 'C1010', 'CAR06', 'P110', 'Islamabad',  '2026-03-22', '2026-03-25');

-- ============================================================
--   TABLE 6 — rental_history (10 records)
-- ============================================================
CREATE TABLE rental_history (
    history_id    VARCHAR(10) NOT NULL,
    car_id        VARCHAR(10) NOT NULL,
    rental_id     VARCHAR(10) NOT NULL,
    payment_id    VARCHAR(10) NOT NULL,
    time_rented   VARCHAR(30) NOT NULL,
    status        ENUM('Completed','Pending','Cancelled') DEFAULT 'Completed',
    PRIMARY KEY (history_id),
    FOREIGN KEY (car_id)     REFERENCES cars(car_id)         ON DELETE CASCADE,
    FOREIGN KEY (rental_id)  REFERENCES bookings(rental_id)  ON DELETE CASCADE,
    FOREIGN KEY (payment_id) REFERENCES payments(payment_id) ON DELETE CASCADE
);

INSERT INTO rental_history (history_id, car_id, rental_id, payment_id, time_rented, status) VALUES
('H101', 'CAR01', 'R101', 'P101', '5 Days', 'Completed'),
('H102', 'CAR02', 'R102', 'P102', '4 Days', 'Completed'),
('H103', 'CAR03', 'R103', 'P103', '5 Days', 'Completed'),
('H104', 'CAR04', 'R104', 'P104', '4 Days', 'Completed'),
('H105', 'CAR05', 'R105', 'P105', '3 Days', 'Completed'),
('H106', 'CAR06', 'R106', 'P106', '5 Days', 'Completed'),
('H107', 'CAR07', 'R107', 'P107', '5 Days', 'Pending'),
('H108', 'CAR08', 'R108', 'P108', '3 Days', 'Completed'),
('H109', 'CAR01', 'R109', 'P109', '5 Days', 'Cancelled'),
('H110', 'CAR06', 'R110', 'P110', '3 Days', 'Pending');

-- ============================================================
--   VERIFY — Run these to check your data
--   SELECT * FROM admin;
--   SELECT * FROM cars;
--   SELECT * FROM customers;
--   SELECT * FROM payments;
--   SELECT * FROM bookings;
--   SELECT * FROM rental_history;
-- ============================================================

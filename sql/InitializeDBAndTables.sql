DROP DATABASE IF EXISTS PatientHealthRecord;
CREATE DATABASE PatientHealthRecord;
USE PatientHealthRecord;

DROP TABLE IF EXISTS system_user;
CREATE TABLE system_user (
    system_user_id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT,
    first_name VARCHAR(25) NOT NULL,
    last_name VARCHAR(25) NOT NULL,
    birth_date DATE NOT NULL,
    phone INT NOT NULL,
    username VARCHAR(25) NOT NULL,
    password VARCHAR(25) NOT NULL,
    address VARCHAR(50) NOT NULL,
    apartment_num INT,
    city VARCHAR(50) NOT NULL,
    state VARCHAR(2) NOT NULL,
    zipcode INT NOT NULL,
    zipcode_ext INT,
    email VARCHAR(50) NOT NULL
);

DROP TABLE IF EXISTS user_role;
CREATE TABLE user_role (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(15) NOT NULL,
    description VARCHAR(100)
);

DROP TABLE IF EXISTS appointments;
CREATE TABLE appointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    physician_id INT NOT NULL,
    patient_id INT,
    date DATE NOT NULL
);

DROP TABLE IF EXISTS patient_lab_tests_performed;
CREATE TABLE patient_lab_tests_performed (
    patient_lab_tests_performed_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    physician_id INT NOT NULL,
    test_id INT NOT NULL,
    test_lab_addr VARCHAR(150),
    results VARCHAR(200)
);

DROP TABLE IF EXISTS lab_tests;
CREATE TABLE lab_tests (
    test_id INT AUTO_INCREMENT PRIMARY KEY,
    test_name VARCHAR(25) NOT NULL,
    description VARCHAR(100)
);

DROP TABLE IF EXISTS patient_prescriptions;
CREATE TABLE patient_prescriptions (
    patient_prescription_id INT AUTO_INCREMENT PRIMARY KEY,
    rx_id INT NOT NULL,
    patient_id INT NOT NULL,
    physician_id INT NOT NULL,
    prescription_date DATE,
    expires DATE,
    dosage VARCHAR(25),
    quantity INT,
    description VARCHAR(100),
    refills INT,
    instructions VARCHAR(150),
    pharmacy_addr VARCHAR(150),
    controlled_substance TINYINT(1)
);

DROP TABLE IF EXISTS prescriptions;
CREATE TABLE prescriptions (
    rx_id INT AUTO_INCREMENT PRIMARY KEY,
    rx_name VARCHAR(50) NOT NULL,
    description VARCHAR(50),
    rx_type VARCHAR(10)
);




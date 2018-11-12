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
    phone VARCHAR(25) NOT NULL,
    username VARCHAR(100) NOT NULL,
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
    date DATE NOT NULL,
    time TIME NOT NULL,
    appointment_status INT NOT NULL
);

DROP TABLE IF EXISTS patient_lab_tests_performed;
CREATE TABLE patient_lab_tests_performed (
    patient_lab_tests_performed_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    physician_id INT NOT NULL,
    test_id INT NOT NULL,
    test_lab_addr VARCHAR(150),
    results VARCHAR(200),
    date_performed DATE
);

DROP TABLE IF EXISTS lab_tests;
CREATE TABLE lab_tests (
    test_id INT AUTO_INCREMENT PRIMARY KEY,
    test_name VARCHAR(100) NOT NULL,
    description VARCHAR(300)
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
    refills INT,
    instructions VARCHAR(150),
    pharmacy_addr VARCHAR(150),
    controlled_substance TINYINT(1)
);

DROP TABLE IF EXISTS prescriptions;
CREATE TABLE prescriptions (
    rx_id INT AUTO_INCREMENT PRIMARY KEY,
    rx_name VARCHAR(50) NOT NULL,
    description VARCHAR(200),
    rx_type VARCHAR(30),
    rx_num VARCHAR(50) NOT NULL
);

INSERT INTO user_role VALUES (
    1,
    "Patient",
    "Patient User"
);

INSERT INTO user_role VALUES (
    2,
    "Physician",
    "Doctor"
);

INSERT INTO system_user VALUES (
    NULL,
    2,
    "Test",
    "Doctor",
    "1970-01-01",
    "2032472285",
    "wjashman",
    "HelloItsMelol!",
    "153 Bayberry Lane",
    "516",
    "Westport",
    "CT",
    "06880",
    "99",
    "ashmanw@mail.sacredheart.edu"
);

INSERT INTO system_user VALUES (
    NULL,
    1,
    "Will",
    "Ashman",
    "1970-01-01",
    "2032472285",
    "wjashman1",
    "HelloItsMelol!",
    "153 Bayberry Lane",
    "516",
    "Westport",
    "CT",
    "06880",
    "99",
    "ashmanw@mail.sacredheart.edu"
);

INSERT INTO system_user VALUES (
    NULL,
    2,
    "Stephanie",
    "Fanelli",
    "1970-01-01",
    "2032472285",
    "wjashman2",
    "HelloItsMelol!",
    "153 Bayberry Lane",
    "516",
    "Westport",
    "CT",
    "06880",
    "99",
    "ashmanw@mail.sacredheart.edu"
);

INSERT INTO system_user VALUES (
    NULL,
    2,
    "Richard",
    "Singer",
    "1970-01-01",
    "2032472285",
    "wjashman3",
    "HelloItsMelol!",
    "153 Bayberry Lane",
    "516",
    "Westporttest",
    "CT",
    "06880",
    "99",
    "ashmanw@mail.sacredheart.edu"
);

INSERT INTO system_user VALUES (
    NULL,
    1,
    "Dhrumi",
    "Patel",
    "1995-06-14",
    "475449837",
    "pateld23",
    "Dhrumegh!",
    "woodridge",
    "402",
    "shelton",
    "CT",
    "06484",
    "99",
    "pateld23@mail.sacredheart.edu"
);

INSERT INTO appointments VALUES (
    NULL,
    2,
    3,
    "2018-09-22",
    "09:00:00",
    1
);

INSERT INTO lab_tests VALUES (
	NULL, 
	"Hemoglobin", 
	"A blood test measurement"
);

INSERT INTO lab_tests VALUES (
	NULL, 
	"Blood Count", 
	"Determines the number of red blood cells and white blood cells"
);

INSERT INTO lab_tests VALUES (
	NULL, 
	"Kidney Fucntion Test", 
	"Various aspects of kidneys"
);

INSERT INTO lab_tests VALUES (
	NULL, 
	"Pregnancy Test", 
	"Whether a women is pregnant or not"
);

INSERT INTO lab_tests VALUES (
	NULL, 
	"ALT", 
	"Screen for liver damage or to help diagonse liver disease"
);

INSERT INTO lab_tests VALUES (
	NULL, 
	"Glucose Tolerance Test", 
	"Procedure to assest the ability of the body to metabolise glucose"
);

INSERT INTO lab_tests VALUES (
	NULL, 
	"Blood Typing", 
	"Classification of blood in terms of distinctive inherited characterisitics"
);

INSERT INTO lab_tests VALUES (
	NULL, 
	"Thymol turbidity", 
	"test for the non-specfic measurement of the globulins"
);

INSERT INTO lab_tests VALUES (
	NULL, 
	"Thyroid Function Test", 
	"procedure of two active thyroid hormones thyroxine"
);

INSERT INTO lab_tests VALUES (
	NULL, 
	"Uroscopy", 
	"medical examination of the urine "
);
INSERT INTO lab_tests 
    (test_id, test_name, description) 
VALUES 
	(NULL, "ANA", "helps to diagnose lupus and to rule out certain other autoimmune diseases"),
	(NULL, "Glycohemoglobin", "monitor a person's diabetes and to aid in treatment decisions"),
	(NULL, "Glucose Level", "Identifies blood glucose level, and to screen for, diagnose, and monitor diabetes, pre-diabetes, and hypoglycemia."),
	(NULL, "Urinalysis", "Analysis of urine by physical, chemical, and microscopical means to test for the presence of disease, drugs, etc."),
	(NULL, "Liver Function Panel (LFT)", "Used to detect liver damage or disease"),
	(NULL, "Complete Blood Count", "Used to measure different parts and features of your blood");

INSERT INTO system_user
	(system_user_id, role_id, first_name, last_name, birth_date, phone, username, password, address, apartment_num, city, state, zipcode, zipcode_ext, email) 
VALUES 
	(NULL, "1", "Renate", "Sigrist", "1987-05-17", "847383728", "renate", "renate123", "woodridge", "401", "shelton", "CT", "06484", "99", "renate@yahoo.com"),
	(NULL, "1", "Hepseeba", "Kode", "1989-09-12", "837837837", "kodeh", "kodeh", "center st", "165", "shelton", "CT", "06484", "99", "kodeh@yahoo.com"),
	(NULL, "1", "Sapna", "Patel", "1978-02-12", "746383683", "sapna", "sapma123", "aspetcuk", "899", "shelton", "CT", "06484", "99", "sapna829@yahoo.co.in"),
        (NULL, "1", "John", "vattikuti", "1994-09-19", "2037465864", "john", "johnvat", "park avenue", "209", "bridgeport", "CT", "06010", "11", "johnvatti@gmail.com"),
 
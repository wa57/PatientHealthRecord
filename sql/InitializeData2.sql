 INSERT INTO lab_tests 
    (test_id, test_name, description) 
VALUES 
	(NULL, "ANA", "helps to diagnose lupus and to rule out certain other autoimmune diseases"),
	(NULL, "Glycohemoglobin", "monitor a person's diabetes and to aid in treatment decisions"),
	(NULL, "Glucose Level", "Identifies blood glucose level, and to screen for, diagnose, and monitor diabetes, pre-diabetes, and hypoglycemia."),
	(NULL, "Urinalysis", "Analysis of urine by physical, chemical, and microscopical means to test for the presence of disease, drugs, etc."),
	(NULL, "Liver Function Panel (LFT)", "Used to detect liver damage or disease"),
	(NULL, "Complete Blood Count", "Used to measure different parts and features of your blood"),
	(NULL, "Thyroid Stimulating Hormone","This test screens and monitors the function of the thyroid."),
	(NULL, "Cholesterol (lipid panel)","Total cholesterol — this test measures all of the cholesterol in all the lipoprotein particles"),
	(NULL, "Magnesium","This test looks at magnesium levels."),
	(NULL, "hs-CRP:","This test assesses levels of an inflammatory marker that can be helpful in assessing risk for heart disease."),
	(NULL, "Wound Cultures", "This test checks a wound for sources of infection (fungus, bacteria).");

INSERT INTO prescriptions
    (rx_id, rx_name, description, rx_type, rx_num) 
VALUES 
	(NULL,"ALLEGRA","Reduces the effects of natural chemical histamine in the body","Antihistamine", '123-456789-01'),
	(NULL,"ATIVAN","Management of anxiety disorders or for the short-term relief","Anxiety", '123-456789-02'),
	(NULL,"CIPRO","Treatment of infections caused by susceptible isolates of the designated microorganisms","Anti-Biotic", '123-456789-03'),
	(NULL,"WELLBUTRIN","Treatment of major depressive disorder (MDD)","Antidepressant", '123-456789-04'),
	(NULL,"FLONASE","Relieve seasonal and year-round allergic and non-allergic nasal symptoms, such as stuffy/runny nose, itching, and sneezing.","Nasal Spray", '123-456789-05'),
	(NULL,"FUROSEMIDE","Extra water by increasing the amount of urine you make","Diuretic", '123-456789-10'),
	(NULL,"PREDNISOLONE","Can treat many diseases and conditions, especially those related to inflammation.","Steroid", '123-456789-08'),
	(NULL,"VICODIN","Used to relieve moderate to severe pain.","Pain Killer", '123-456789-07');


INSERT INTO patient_prescriptions
   (patient_prescription_id, rx_id, patient_id, physician_id, prescription_date, expires, dosage, quantity, refills, instructions, pharmacy_addr, controlled_substance) 
VALUES 
	(NULL, '1', '5', '1', '2018-10-16', '2020-10-15', 'one tablet twice a day', '100', '2', 'Keep out of reach from children', 'Walgreens', '0'),
	(NULL, '2', '5', '3', '2018-09-22', '2021-09-21', ' one pill a day', '50', '2', 'do not take with empty stomach', 'CVS', '0'),
	(NULL, '5', '5', '1', '2018-10-19', '2019-10-18', '2 drops in each nossel', '1', '1', 'Keep at cool place ', 'costco', '0'),
	(NULL, '2', '6', '3', '2018-09-22', '2021-09-21', ' one pill a day', '50', '2', 'do not take with empty stomach', 'CVS', '0'),
	(NULL, '3', '6', '3', '2018-10-21', '2019-10-20', '1 pill a day', '50', '1', 'take with food', 'cvs', '0'),
	(NULL, '4', '7', '4', '2018-10-16', '2019-10-15', '1 pill per day', '100', '1', 'Do not take with empty stomach', 'cvs', '0'),
	(NULL, '5', '8', '1', '2018-10-19', '2019-10-18', '2 drops in each nossel', '1', '1', 'Keep at cool place ', 'costco', '0'),
	(NULL, '8', '9', '3', '2018-10-16', '2019-10-15', '1 pill per day', '50', '2', 'Do not take with empty stomach', 'Walgreens', '0'),
	(NULL, '6', '10', '4', '2018-10-16', '2018-10-15', 'one pill per day', '100', '1', 'Keep it in a cool place', 'CVS', '0'),
	(NULL, '7', '11', '3', '2018-10-17', '2019-10-16', 'take 1 pill, twice a day', '100', '2', 'do not take with empty stomach', 'Walgreens', '0')
			
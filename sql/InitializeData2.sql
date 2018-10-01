INSERT INTO lab_tests 
    (test_id, test_name, description) 
VALUES 
	(NULL, "ANA", "helps to diagnose lupus and to rule out certain other autoimmune diseases"),
	(NULL, "Glycohemoglobin", "monitor a person's diabetes and to aid in treatment decisions"),
	(NULL, "Glucose Level", "Identifies blood glucose level, and to screen for, diagnose, and monitor diabetes, pre-diabetes, and hypoglycemia."),
	(NULL, "Urinalysis", "Analysis of urine by physical, chemical, and microscopical means to test for the presence of disease, drugs, etc."),
	(NULL, "Liver Function Panel (LFT)", "Used to detect liver damage or disease"),
	(NULL, "Complete Blood Count", "Used to measure different parts and features of your blood")
	(NULL, "Thyroid Stimulating Hormone","This test screens and monitors the function of the thyroid.")
	(NULL, "Cholesterol (lipid panel)","Total cholesterol — this test measures all of the cholesterol in all the lipoprotein particles")
	(NULL, "Magnesium","This test looks at magnesium levels.")
	(NULL, "hs-CRP:","This test assesses levels of an inflammatory marker that can be helpful in assessing risk for heart disease.")	
	(NULL, "Wound Cultures", "This test checks a wound for sources of infection (fungus, bacteria).");

INSERT INTO prescriptions
    (rx_id, rx_name,description,rx_type) 
VALUES 
	(NULL,"ALLEGRA","Reduces the effects of natural chemical histamine in the body","Antihistamine"),
	(NULL,"ATIVAN"," Management of anxiety disorders or for the short-term relief","Anxiety"),
	(NULL,"CIPRO","Treatment of infections caused by susceptible isolates of the designated microorganisms","Anti-Biotic"),
	(NULL,"WELLBUTRIN","Treatment of major depressive disorder (MDD)","Antidepressant"),
	(NULL,"FLONASE","Relieve seasonal and year-round allergic and non-allergic nasal symptoms, such as stuffy/runny nose, itching, and sneezing.","Nasal Spray"),
	(NULL,"FUROSEMIDE","Extra water by increasing the amount of urine you make","Diuretic");
	(NULL,"PREDNISOLONE","Can treat many diseases and conditions, especially those related to inflammation.","Steroid");	
	(NULL,"VICODIN","Used to relieve moderate to severe pain.","Pain Killer");	
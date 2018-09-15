<?php
    $api_url = "http://18.214.171.153/api/process.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> - Patient Health Record</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main.css" />
	<script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
	<script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>
	<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
</head>
<body>
    <div class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <h2>Patient Health Record</h2>
            </div>
        </div>
    </div>

    <div class="container body-content">
        <div class="row">
            <aside class="col-sm-2">
                <nav>
                    <ul>
                        <li class="nav-item"><a href="index.php">Home</a></li>
                        <li class="nav-item"><a href="login.php">Login</a></li>
                        <li class="nav-item"><a href="schedule-appointment.php">Schedule Appointment</a></li>
                        <li class="nav-item"><a href="view-lab-reports.php">View Lab Reports</a></li>
                        <li class="nav-item"><a href="view-prescriptions.php">View Prescriptions</a></li>
                        <li class="nav-item"><a href="about.php">About</a></li>
                        <li class="nav-item"><a href="contact.php">Contact</a></li>
                    </ul>
                </nav>
            </aside>
			<div class="col-sm-10">
				<div id="root"></div>
                <input id="ExitButton" type="submit" value="Exit" />
                <input id="BackButton" type="submit" value="Back" />
            </div>
        </div>
        <hr />
        <footer>
            <p>&copy; 2018 - PatientHealthRecord</p>
        </footer>
    </div>
</body>
</html>

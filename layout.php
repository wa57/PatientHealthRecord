<?php
    $api_url = "http://18.214.171.153/api/process.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> - Patient Health Record</title>
    <style>
        .item1 { grid-area: header; }
        .item2 { grid-area: menu; }
        .item3 { grid-area: main; }
        .item4 { grid-area: footer; }

        .container {
            display: grid;
            grid-template-areas:
                'header header header header header header'
                'menu main main main main main'
                'menu footer footer footer footer footer';
            grid-gap: 10px;
            background-color: #2196F3;
            padding: 10px;
        }
        .container > div {
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
            padding: 20px 0;
            font-size: 30px;
        }

</style>
    <link rel="stylesheet" href="css/main.css" />
	<script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
	<script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>
	<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
</head>
<body>
    <div>
        <div class="container">
            <div class="navbar-header">
                <h2>Patient Health Record</h2>
            </div>
        </div>
    </div>

    <div class="container">
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
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> - Patient Health Record</title>
    <style>
        .header { grid-area: header; }
        .menu { grid-area: menu; }
        .main { grid-area: main; }
        .footer { grid-area: footer; }

        .container {
            display: inline-grid;
            grid-template-areas:
                'header header header header header header'
                'menu main main main main main'
                'menu footer footer footer footer footer';
            grid-gap: 10px;
        }

        .booked {
            color: red;
        }

        .available {
            color: green;
        }

        .highlighted {
            background-color: #ffff99;
        }

        .cancel-button {
            background-color: red;
            color: #fff;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="css/main.css">
	<script>
        function GET(query, callback) {
            fetch("api/process.php?" + query, {
                method: 'get',
                headers: {
                    "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
                }
            })
            .then(response => response.json())
            .then(function(response) {
                callback(response);
            });
        }

        function POST(params, callback) {
            fetch("api/process.php", {
                method: 'post',
                headers: {
                    "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
                },
                body: params
            })
            .then(response => response.json())
            .then(function(response) {
                callback(response);
            });
        }
    </script>
</head>
<body>
    <div>
        <h2>Patient Health Record</h2>
    </div>

    <div class="container menu">
        <aside>
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
</body>
</html>

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
    </style>
    <link rel="stylesheet" href="css/main.css" />
	<script>
        function Get(query, callback) {
            var http  = new XMLHttpRequest();
            var url = "api/process.php?";
            http.open('GET', url + query, true);
            http.setRequestHeader("Content-type", "application/json; charset=utf-8");
            http.onload = function() {
                if (http.status >= 200 && http.status < 400) {
                    callback(JSON.parse(http.responseText));
                } else {
                    // We reached our target server, but it returned an error
                }
            };
            http.onerror = function() {
                // There was a connection error of some sort
            };
            http.send();
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

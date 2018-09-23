<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> - Patient Health Record</title>
    <style>
        body {
            background-color: #ebebeb;
        }

        .header { 
            grid-area: header; 
            margin: 0 auto;
        }

        .menu { 
            grid-area: menu;
            margin: 0 auto; 
            background-color: #fff;
            padding: 1.5em;
        }

        .main { 
            grid-area: main; 
            margin: 0 auto;
            background-color: #fff;
            padding: 1.5em;
            padding-top: 0;
        }

        .footer { 
            grid-area: footer; 
            margin: 0 auto;
            background-color: #fff;
            padding: 1.5em;
        }

        .container {
            display: grid;
            grid-template-areas:
                'header header header header header header'
                'menu menu menu menu menu menu'
                'main main main main main main'
                'footer';
            grid-gap: 10px;
            max-width: 940px;
        }

        h2 a {
            text-decoration: none;
        }

        h2 a:visited {
            color: black;
        }

        nav {
            padding-bottom: 35px;
            border-bottom: 1px solid black;
        }

        nav ul {
            list-style-type: none;
            background-color: #333;
        }

        nav li {
            float: left;
        }

        nav li a {
            display: block;
            color: black;
            text-align: center;
            padding: 0 20px;
            text-decoration: none;
        }

        nav li a:hover {
            text-decoration: underline;
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

        #message {
            font-weight: bold;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="css/main.css">
	<script>
        'use strict';

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

        function getUser() {
            return JSON.parse(localStorage.getItem("user"));
        }

        function setUser(user) {
            localStorage.setItem("user", null);
        }

        document.addEventListener("DOMContentLoaded", function() {         
            toggleNavState();

            document.getElementById("logout-link").addEventListener("click", function() {
                setUser(null);
                toggleNavState();
                window.location = "index.php";
            });

            function toggleNavState() {
                var user = getUser();
                var links = document.getElementsByClassName("login-required"); 
                if(user && user !== null) {
                    document.getElementById("login-link").style.display = "none";
                    document.getElementById("logout-link").style.display = "block";
                } else {
                    document.getElementById("login-link").style.display = "block";
                    document.getElementById("logout-link").style.display = "none";
                }

                for (var i = 0; i < links.length; i++) {
                    if(user && user !== null) {
                        links[i].style.display = "block";
                    } else {
                        links[i].style.display = "none";
                    }
                }
            }
        });

    </script>
</head>
<body>
    <div class="container header">
        <h2><a href="index.php">Patient Health Record</a></h2>
    </div>

    <div class="container menu">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li id="login-link"><a href="login.php">Login</a></li>
                <li id="logout-link"><a href="#">Logout</a><li>
                <li class="login-required"><a href="schedule-appointment.php">Schedule Appointment</a></li>
                <li class="login-required"><a href="view-lab-reports.php">View Lab Reports</a></li>
                <li class="login-required"><a href="view-prescriptions.php">View Prescriptions</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>

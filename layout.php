<?php include "api/db_connect.php"; ?>
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

        .header, .menu, .main, .footer{ 
            margin: 0 auto;
            padding: 1.5em;
        }

        .menu { 
            background-color: #fff;
            border-bottom: 1px solid #ebebeb;
        }

        .main { 
            grid-area: main; 
            background-color: #fff;
            padding-top: 0;
            grid-template-columns: 30% 70%;
            grid-column-gap: 1em;
            min-height: 500px;
        }

        .footer { 
            grid-area: footer; 
            background-color: #fff;
            border-top: 1px solid #ebebeb;
        }

        .container {
            display: grid;
            
        }

        h2 a {
            text-decoration: none;
        }

        h2 a:visited {
            color: black;
        }

        nav ul {
            list-style-type: none;
            background-color: #333;
            padding: 0;
            margin: 0;
        }

        nav li {
            float: left;
            margin-right: 1em;
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>
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
    <div class="container">
        <h2>
            <a href="index.php">Patient Health Record</a>
        </h2>
    </div>

    <nav>
        <ul class="nav flex-column">
            <li>
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li id="login-link">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li id="logout-link">
                <a class="nav-link" href="#">Logout</a>
            <li>
            <li class="login-required">
                <a class="nav-link" href="schedule-appointment.php">Schedule Appointment</a>
            </li>
            <li class="login-required">
                <a class="nav-link" href="view-lab-reports.php">View Lab Reports</a>
            </li>
            <li class="login-required">
                <a class="nav-link" href="view-prescriptions.php">View Prescriptions</a>
            </li>
            <li>
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li>
                <a class="nav-link" href="contact.php">Contact</a>
            </li>
        </ul>
    </nav>

</body>
</html>

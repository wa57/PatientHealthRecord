<?php include "api/db_connect.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> - Patient Health Record</title>
    <style>

        main {
            padding: 1em;
        }
        .header, .menu, .main, .footer{ 
            margin: 0 auto;
            padding: 1.5em;
        }

        .menu { 
            background-color: #fff;
            border-bottom: 1px solid #ebebeb;
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

        nav {
            height: 100vh;
            background: #ebebeb;
        }

        nav h4 a {
            color: #F25652;
        }

        nav h4 {
            padding: 1em;
            margin-bottom: 0;
        }

        nav h4 a:hover {
            color: #F25652;
            text-decoration: none;
        }

        nav li a {
            color: black;
            text-decoration: none;
            width: 100%;
            display: block;
            padding: 1rem 1.5rem;
        }

        nav li a:hover {
            background: #575757;
            color: #ebebeb;
            text-decoration: none;
        }

        nav i {
            margin-right: 15px;
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
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
    <div class="container-fluid">
        <div class="row">
            <nav>
                <h4>
                    <a href="?path=homepage">Patient Health Record</a>
                </h4>
                <ul class="nav flex-column">
                    <li>
                        <a href="?path=homepage">
                            <i class="fas fa-home"></i>
                            Home
                        </a>
                    </li>
                    <li id="login-link">
                        <a href="?path=login">
                            <i class="fas fa-sign-in-alt"></i>
                            Login
                        </a>
                    </li>
                    <li id="logout-link">
                        <a href="#">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    <li>
                    <li class="login-required">
                        <a href="?path=schedule-appointment">
                            <i class="fas fa-calendar-alt"></i>
                            Schedule An Appointment
                        </a>
                    </li>
                    <li class="login-required">
                        <a href="?path=view-lab-reports">
                            <i class="fas fa-clipboard-list"></i>
                            View Lab Reports
                        </a>
                    </li>
                    <li class="login-required">
                        <a href="?path=view-prescriptions">
                            <i class="fas fa-prescription-bottle-alt"></i>
                            View Prescriptions
                        </a>
                    </li>
                    <li>
                        <a href="?path=about">
                            <i class="fas fa-user"></i>
                            About
                        </a>
                    </li>
                    <li>
                        <a href="?path=contact">
                            <i class="fas fa-envelope"></i>
                            Contact
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="col">
                <main>
                    <?php
                        if(isset($_GET["path"]))
                        {
                            include $_GET["path"].".php";
                        }
                        else 
                        {
                            include "homepage.php";
                        }
                    ?>
                </main>
            </div>
        </div>
        
    </div>
    

</body>
</html>
